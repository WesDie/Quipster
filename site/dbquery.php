<?php
// need to check if the current logged in user has permission to the chat that they are trying to post messaage
require_once('db.php');

if ($_POST['new'] == 'true') {
    // expect two variables:

    $id = uniqid();
    $stmtId = $conn->prepare("SELECT id FROM messages WHERE id = '$id'");
    $stmtId->execute();

    while ($stmtId->rowCount() > 0) {
        $id = uniqid();
        $stmtId = $conn->prepare("SELECT id FROM messages WHERE id = '$id'");
        $stmtId->execute();
    }

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("INSERT INTO messages (id, chat, user, message) VALUES (:id, 'dev_chat', '645b6d4d40d17', :message)");
    $stmt->bindParam(':id', $id);
    // $stmt->bindParam(':chat', $id);
    $user = "6447906d0b6be";
    // $stmt->bindParam(':user', $user);
    // $stmt->bindParam(':type', $id);
    $stmt->bindParam(':message', $id);
    // $stmt->bindParam(':replyto', $id);

    // $id = $key;

    if ($stmt->execute()) {


        echo json_encode(array("success"));
    }
} else {

    $stmt = $conn->prepare("SELECT * FROM messages WHERE chat = 'dev_chat'");

    if ($stmt->execute()) {
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $newMsgs = $stmt->fetchAll();

        $lastLoaded = $_POST['lastLoaded'];

        $sql = "SELECT * FROM messages WHERE sent >= '$lastLoaded'";

        // $newMsgs = array(
        //     $sql
        // );
        echo json_encode($newMsgs);
    }
}
