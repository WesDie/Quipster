<?php
require_once('db.php');

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT * FROM messages WHERE chat = 'dev_chat' LIMIT 0,100");

if ($stmt->execute()) {
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $newMsgs = $stmt->fetchAll();
    foreach ($newMsgs as $post) {
        echo $post;
    }
    // $lastLoaded = $_POST['lastLoaded'];

    // $sql = "SELECT * FROM messages WHERE sent >= '$lastLoaded'";

    // $newMsgs = array(
    //     $sql
    // );
    echo json_encode($newMsgs);
}
