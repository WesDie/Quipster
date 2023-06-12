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
        }
    }
}
