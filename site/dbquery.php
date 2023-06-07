<?php
// need to check if the current logged in user has permission to the chat that they are trying to post messaage
require_once('db.php');

session_start();

if (isset($_SESSION['logedin']) && $_SESSION['logedin']) {
    $chat = "dev_chat";
    $chat = $_POST['chat_id'];
    $user = $_SESSION["id"];
    $stmtCheck = $conn->prepare("SELECT chat, user FROM chatmembers WHERE chat=:chat AND user=:user");
    $stmtCheck->bindParam(':chat', $chat);
    $stmtCheck->bindParam(':user', $user);
    $stmtCheck->execute();
    if ($stmtCheck->rowCount() > 0) {
        if ($_POST['new'] == 'true') {
            if (!empty(trim($_POST['input']))) {
                // expect two variables:

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
                $stmt = $conn->prepare("INSERT INTO messages (id, chat, user, message) VALUES (:id, 'dev_chat', :user, :message)");
                $stmt->bindParam(':id', $id);
                // $stmt->bindParam(':chat', $id);
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
        } else {
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
        }
        // $conn = null;
    }
}


if (isset($_SESSION['logedin']) && $_SESSION['logedin']) {
if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['icon'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $icon = $_POST['icon'];
    $created = date('Y-m-d H:i:s');
    $id = uniqid();


    $sthandler = $conn->prepare("SELECT name FROM chats WHERE name = :name");
    $sthandler->bindParam(':name', $name);
    $sthandler->execute();

    if(empty($name)){

    } else if(empty($description)){

    }else if(empty($icon)){
        if($sthandler->rowCount() > 0){
          echo "name already exits";
        } else{
          $stmt = $conn->prepare("INSERT INTO chats (name, description, created, icon, id) 
          VALUES (:email, :password, :created, :username, :id)");
          
          $stmt->bindParam(":id", $id);
          $stmt->bindParam(":description", $description);
          $stmt->bindParam(":created", $created);
          $stmt->bindParam(":icon", $icon);
          $stmt->bindParam(":id", $id);
          $stmt->execute();
        }
    }
  }
}