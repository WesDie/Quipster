<?php

require_once('db.php');

session_start();

if (isset($_SESSION['logedin']) && $_SESSION['logedin']) {
        $name = $_POST['nameCreateChat'];
        $description = $_POST['descCreateChat'];
        $icon = $_POST['iconCreateChat'];
        $created = date('Y-m-d H:i:s');

        $id = uniqid();
        $stmt = $conn->prepare("SELECT id FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        while ($stmt->rowCount() > 0) {
            $id = uniqid();
            $stmt = $conn->prepare("SELECT id FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->closeCursor();
        }
        $stmt->closeCursor();

        if(empty($name)){
    
        } else if(empty($description)){
    
        }else if(empty($icon)){
           
        } else{

          $sthandler = $conn->prepare("SELECT name FROM chats WHERE name = :name");
          $sthandler->bindParam(':name', $name);
          $sthandler->execute();

          if($sthandler->rowCount() > 0){
            echo "name already exits";
          } else{

            $stmt = $conn->prepare("INSERT INTO chats (id, name, description, created, icon) 
            VALUES (:id, :name, :description, :created, :icon)");
            
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":created", $created);
            $stmt->bindParam(":icon", $icon);
            $stmt->execute();
          }
        }
}