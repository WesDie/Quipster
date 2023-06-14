<?php
require_once('db.php');
session_start();

if (isset($_SESSION['logedin']) && $_SESSION['logedin']) {
    if (!empty($_POST['chat_id'])) {
        // wants something from a chat 🆗

        $chat = $_POST['chat_id'];
        $user = $_SESSION["id"];
        $stmtCheck = $conn->prepare("SELECT chat, user FROM chatmembers WHERE chat=:chat AND user=:user");
        $stmtCheck->bindParam(':chat', $chat);
        $stmtCheck->bindParam(':user', $user);
        $stmtCheck->execute();
        if ($stmtCheck->rowCount() > 0) {
            // user is valid member of said chat 👍

            if ($_POST['action'] == 'chatUpload') {
                if (!empty(trim($_POST['input']))) {

                    $id = uniqid();
                    $stmtId = $conn->prepare("SELECT id FROM messages WHERE id = '$id'");
                    $stmtId->execute();

                    while ($stmtId->rowCount() > 0) {
                        $id = uniqid();
                        $stmtId = $conn->prepare("SELECT id FROM messages WHERE id = '$id'");
                        $stmtId->execute();
                        $stmtId->closeCursor();
                    }
                    $stmtId->closeCursor();

                    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("INSERT INTO messages (id, chat, user, message) VALUES (:id, :chat, :user, :message)");
                    $stmt->bindParam(':id', $id);
                    $stmt->bindParam(':chat', $chat);
                    $user = $_SESSION['id'];
                    $stmt->bindParam(':user', $user);
                    // $stmt->bindParam(':type', $id);
                    $message = $_POST['input'];
                    $stmt->bindParam(':message', $message);
                    // $stmt->bindParam(':replyto', $id);

                    // $id = $key;

                    if ($stmt->execute()) {
                        echo json_encode(array("success"));
                        $stmt->closeCursor();
                    }
                }
            } elseif ($_POST['action'] == 'chatLoad') {

                // if (strtotime($_POST['lastLoaded'])) {
                $lastLoaded = $_POST['lastLoaded'];

                $stmt = $conn->prepare("SELECT messages.*, users.username, users.pfp
                    FROM messages LEFT JOIN users ON messages.user = users.id
                    WHERE chat = '$chat' AND sent > '$lastLoaded'");

                // $stmt->bindParam(':chat_id', $chat);
                // $stmt->bindParam(':lastLoaded', $lastLoaded);

                if ($stmt->execute()) {
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $newMsgs = $stmt->fetchAll();

                    echo json_encode($newMsgs);

                    $stmt->closeCursor();
                }
            } elseif ($_POST['action'] == 'updateMembers') {
                $stmtCheck = $conn->prepare("SELECT * FROM chats WHERE id=:chat");
                $stmtCheck->bindParam(':chat', $chat);
                $stmtCheck->execute();
                $checkType = $stmtCheck->fetch();

                if($checkType['type'] == "group"){
                    $stmtCheck = $conn->prepare("SELECT * FROM chatmembers WHERE chat=:chat");
                    $stmtCheck->bindParam(':chat', $chat);
                    $stmtCheck->execute();
                    $members = $stmtCheck->fetchAll();
                    $memberList = array();
                    foreach ($members as $member) {
                        $stmtUser = $conn->prepare("SELECT * FROM users WHERE id=:id");
                        $stmtUser->bindParam(':id', $member["user"]);
                        $stmtUser->execute();
                        $user = $stmtUser->fetch();
                        array_push($memberList, $user);
                    }
                    echo json_encode($memberList);
                } else if($checkType['type'] == "duo"){
                    $stmtCheck = $conn->prepare("SELECT * FROM chatmembers WHERE chat=:chat");
                    $stmtCheck->bindParam(':chat', $chat);
                    $stmtCheck->execute();
                    $members = $stmtCheck->fetchAll();
                    $memberList = array("isPrivate" => 'Yes');
                    foreach ($members as $member) {
                        if($member["user"] != $_SESSION['id']){
                            $stmtUser = $conn->prepare("SELECT * FROM users WHERE id=:id");
                            $stmtUser->bindParam(':id', $member["user"]);
                            $stmtUser->execute();
                            $user = $stmtUser->fetch();
                            array_push($memberList, $user);
                        }
                    }
                    echo json_encode($memberList);
                }
            } elseif ($_POST['action'] == 'pinMessage') {
                //echo json_encode($);
            }
        }
    } else {
        // does not want something from a chat 😲

        if ($_POST['action'] == 'uiLoadChats') {
            $user = $_SESSION["id"];
            $stmtCheck = $conn->prepare("SELECT * FROM chatmembers WHERE user=:user");
            $stmtCheck->bindParam(':user', $user);
            $stmtCheck->execute();
            $memberat = $stmtCheck->fetchAll();

            $chats = array();
            foreach ($memberat as $chat) {
                $stmtChat = $conn->prepare("SELECT * FROM chats WHERE id = :id");
                $stmtChat->bindParam(':id', $chat["id"]);
                $stmtChat->execute();
                array_push($chats, $stmtChat->fetch());
            }

            if ($stmtCheck->rowCount() > 0) {
                // if (strtotime($_POST['lastLoaded'])) {
                $lastLoaded = $_POST['lastLoaded'];

                $stmt = $conn->prepare("SELECT name FROM chats WHERE id = :id");

                // $stmt->bindParam(':chat_id', $chat);
                // $stmt->bindParam(':lastLoaded', $lastLoaded);

                if ($stmt->execute()) {
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $newMsgs = $stmt->fetchAll();

                    echo json_encode($newMsgs);

                    $stmt->closeCursor();
                }
            }
        } elseif ($_POST['action'] == 'goOffline') {
            $status = "offline";
            $id = $_SESSION['id'];
            $stmt = $conn->prepare("UPDATE users SET status = :status WHERE id = :id");
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } elseif ($_POST['action'] == 'getProfileData') {
            $userid = $_POST['userid'];
            $stmtCheck = $conn->prepare("SELECT * FROM users WHERE id=:id");
            $stmtCheck->bindParam(':id', $userid);
            $stmtCheck->execute();
            $userinfo = $stmtCheck->fetch();

            echo json_encode($userinfo);
        } elseif ($_POST['action'] == 'getFriendshipStatus') {
            $userid = $_POST['userid'];
            $user1 = $_SESSION['id'];
            $stmtFriend = $conn->prepare("SELECT * FROM friendships WHERE user2 = :userid AND user1 = :user1");
            $stmtFriend->bindParam(':user1', $user1);
            $stmtFriend->bindParam(':userid', $userid);
            $stmtFriend->execute();
            $friendinfo = $stmtFriend->fetch();

            if ($_SESSION['id'] == $userid) {
                echo json_encode(array("isYou" => 'Yes'));
            } else {
                echo json_encode($friendinfo);
            }
        } elseif ($_POST['action'] == 'UpdateFriendRequest') {
            $id = $_SESSION['id'];
            $type = "request";
            $stmtCheck = $conn->prepare("SELECT * FROM friendships WHERE user2=:id AND type=:type");
            $stmtCheck->bindParam(':id', $id);
            $stmtCheck->bindParam(':type', $type);
            $stmtCheck->execute();
            $friendRequest = $stmtCheck->fetchAll();
            $friendRequestList = array();
            foreach ($friendRequest as $fRequest) {
                $stmtUser = $conn->prepare("SELECT * FROM users WHERE id=:id");
                $stmtUser->bindParam(':id', $fRequest["user1"]);
                $stmtUser->execute();
                $user = $stmtUser->fetch();
                array_push($friendRequestList, $user);
            }
            echo json_encode($friendRequestList);
        } elseif ($_POST['action'] == 'UpdateSentFriendRequest') {
            $id = $_SESSION['id'];
            $type = "request";
            $stmtCheck = $conn->prepare("SELECT * FROM friendships WHERE user1=:id AND type=:type");
            $stmtCheck->bindParam(':id', $id);
            $stmtCheck->bindParam(':type', $type);
            $stmtCheck->execute();
            $friendRequest = $stmtCheck->fetchAll();
            $friendRequestList = array();
            foreach ($friendRequest as $fRequest) {
                $stmtUser = $conn->prepare("SELECT * FROM users WHERE id=:id");
                $stmtUser->bindParam(':id', $fRequest["user2"]);
                $stmtUser->execute();
                $user = $stmtUser->fetch();
                array_push($friendRequestList, $user);
            }
            echo json_encode($friendRequestList);
        } elseif ($_POST['action'] == 'acceptFriendRequest') {
            $type = "friends";
            $id = $_POST['userid'];
            $stmt = $conn->prepare("UPDATE friendships SET type = :type WHERE user1 = :id");
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            //Make new private chat

            $id = uniqid();
            while ($stmt->rowCount() > 0) {
                $id = uniqid();
                $stmt = $conn->prepare("SELECT id FROM users WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $stmt->closeCursor();
            }
            $stmt->closeCursor();

            
            $name = "private-chat-";
            $name .= $id;
            $description = "private-chat";
            $icon = "https://cdn4.iconfinder.com/data/icons/social-network-61/32/07_-_Private_Chat-512.png";
            $created = date('Y-m-d H:i:s');
            $type = "duo";

            $stmt = $conn->prepare("INSERT INTO chats (id, name, description, created, icon, type) 
            VALUES (:id, :name, :description, :created, :icon, :type)");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":created", $created);
            $stmt->bindParam(":icon", $icon);
            $stmt->bindParam(":type", $type);
            $stmt->execute();

            $role = "memeber";
            $joined = date('Y-m-d H:i:s');

            $user = $_SESSION['id'];
            $stmt = $conn->prepare("INSERT INTO chatmembers (chat, user, joined, role) 
            VALUES (:chat, :user, :joined, :role)");
            $stmt->bindParam(":chat", $id);
            $stmt->bindParam(":user", $user);
            $stmt->bindParam(":joined", $joined);
            $stmt->bindParam(":role", $role);
            $stmt->execute();


            $user = $_POST['userid'];
            $stmt = $conn->prepare("INSERT INTO chatmembers (chat, user, joined, role) 
            VALUES (:chat, :user, :joined, :role)");
            $stmt->bindParam(":chat", $id);
            $stmt->bindParam(":user", $user);
            $stmt->bindParam(":joined", $joined);
            $stmt->bindParam(":role", $role);
            $stmt->execute();

            echo json_encode("succes");
        } elseif ($_POST['action'] == 'declineFriendRequest') {
            $id = $_POST['userid'];
            $stmt = $conn->prepare("DELETE FROM friendships WHERE user1=:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            echo json_encode("succes");
        } elseif ($_POST['action'] == 'cancelFriendRequest') {
            $id = $_POST['userid'];
            $stmt = $conn->prepare("DELETE FROM friendships WHERE user2=:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            echo json_encode("succes");
        } elseif ($_POST['action'] == 'getProfileAwardsData') {

            $userid = $_POST['userid'];
            $stmtCheck = $conn->prepare("SELECT * FROM user_awards WHERE userid=:userid");
            $stmtCheck->bindParam(':userid', $userid);
            $stmtCheck->execute();
            $awardsinfo = $stmtCheck->fetchAll();

            $awardsList = array();
            foreach ($awardsinfo as $awardinfo) {
                if ($awardinfo['pinned'] == 1) {
                    $stmtChat = $conn->prepare("SELECT * FROM awards WHERE id = :id");
                    $stmtChat->bindParam(':id', $awardinfo["trophyid"]);
                    $stmtChat->execute();
                    $awardsinfo = $stmtChat->fetch();
                    array_push($awardsList, $awardsinfo);
                }
            }

            echo json_encode($awardsList);
        } elseif ($_POST['action'] == 'friendRequest') {

            $user1 = $_SESSION['id'];
            $userid = $_POST['userid'];

            if ($userid != $_SESSION['id']) {
                $type = "request";
                $stmt = $conn->prepare("INSERT INTO friendships (user1, user2, type) 
                VALUES (:user1, :userid, :type)");
                $stmt->bindParam(':user1', $user1);
                $stmt->bindParam(':userid', $userid);
                $stmt->bindParam(':type', $type);
                $stmt->execute();
                echo json_encode("succes");
            } else {
                echo json_encode("no succes");
            }
        }
    }
}
