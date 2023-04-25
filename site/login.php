<?php
    require 'db.php';
    session_start();

    if (isset($_SESSION['logedin']) && $_SESSION['logedin'] === true) {
        header("location: chat.php");
    }

    if(isset($_POST['email']) && isset($_POST['password']) && !isset($_POST['username'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetch();

        

        if($stmt->rowCount() == 0){
            header('Location: login.php?error=email doesnt exits');
        } else{ 
            if(password_verify($password, $user['password'])){
                $_SESSION['logedin'] = true;
                $_SESSION['email'] = $user['email'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['username'] = $user['username'];
                
                header('Location: chat.php');
            } else {
                header('Location: login.php?error=password incorrect');
            }
        }
    }

    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];
        $created = date('Y-m-d H:i:s');

        if (empty($username)){
            header ("location: login.php?regerror=username is not filled in");
        } else if (empty($email)){
            header ("location: login.php?regerror=email is not filled in");
        } else if (empty($password)){
            header ("location: login.php?regerror=password is not filled in");
        } else {

            $password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sthandler = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $sthandler->bindParam(':email', $email);
            $sthandler->execute();

            if($sthandler->rowCount() > 0){
                header('Location: login.php?regerror=email already exists');
            } else {

                $sthandler = $conn->prepare("SELECT username FROM users WHERE username = :username");
                $sthandler->bindParam(':username', $username);
                $sthandler->execute();

                if($sthandler->rowCount() > 0){
                    header('Location: login.php?regerror=username already exists');
                } else{
                    $id = uniqid();

                    $stmt = $conn->prepare("SELECT id FROM users WHERE id = :id");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
    
                    while ($stmt->rowCount() > 0) {
                        $id = uniqid();
                        $stmt = $conn->prepare("SELECT id FROM users WHERE id = :id");
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                    }
    
                    $stmt = $conn->prepare("INSERT INTO users (email, password, created, username, id) 
                    VALUES (:email, :password, :created, :username, :id)");
                    
                    $stmt->bindParam(":id", $id);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $password);
                    $stmt->bindParam(":username", $username);
                    $stmt->bindParam(":created", $created);
                    $stmt->execute();
                    header('Location: login.php?regaccept=register succes!');
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div id="login" class="mainContainer">
        <div class="topTextLogin">
            <div  class="textInfo">
                <h1>Login</h1>
                <a href="#register">Register</a>
            </div>
            <div class="spacer wave"></div>
        </div>
        <div class="loginForm">
            <form method="POST">
                <label for="" class="inputLabel">E-MAIL</label>
                <br>
                <input type="text" class="inputBox" name="email">
                <br>
                <br>
                <label for="" class="inputLabel">PASSWORD</label>
                <br>
                <input type="text" class="inputBox" name="password">
                <br>
                <a href="#forgotpass" class="forgotPassLink">forgot password?</a>
                <br>
                <br>
                <input type="submit" value="LOGIN" class="submitBtn">
                <?php 
                        if(isset($_GET['regerror'])){
                            ?>
                            <p class="error"><?php echo $_GET['regerror'] ?></p>
                            <?php 
                        }
                    ?>
                    <?php 
                        if(isset($_GET['regaccept'])){
                            ?>
                            <p class="greennote"><?php echo $_GET['regaccept'] ?></p>
                            <?php 
                        }
                    ?>
            </form>
        </div>
        </div>
    </div>
    <div id="register" class="mainContainer">
        <div class="topTextRegister">
            <div  class="textInfo">
                <h1>Register</h1>
                <a href="#login">Login</a>
            </div>
            <div class="spacer wave"></div>
        </div>
        <div class="loginForm">
            <form method="POST">
                <label for="" class="inputLabel">USERNAME</label>
                <br>
                <input name="username" type="text" class="inputBox">
                <br>
                <br>
                <label for="" class="inputLabel">E-MAIL</label>
                <br>
                <input name="email" type="text" class="inputBox">
                <br>
                <br>
                <label for="" class="inputLabel">PASSWORD</label>
                <br>
                <input name="password" type="password" class="inputBox">
                <br>
                <input type="submit" value="LOGIN" class="submitBtn">
                <?php 
                        if(isset($_GET['regerror'])){
                            ?>
                            <p class="error"><?php echo $_GET['regerror'] ?></p>
                            <?php 
                        }
                    ?>
                    <?php 
                        if(isset($_GET['regaccept'])){
                            ?>
                            <p class="greennotes"><?php echo $_GET['regaccept'] ?></p>
                            <?php 
                        }
                    ?>
            </form>
        </div>
        </div>
    </div>
</body>
<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            console.log(entry)
            if(entry.isIntersecting) {
                entry.target.classList.add('show');
            } else  {
                entry.target.classList.remove('show');
            }
        });
    });

    const hiddenElements = document.querySelectorAll('.textInfo, .topText, .topTextRegister, .topTextLogin, .loginForm, .inputBox, .inputLabel, .submitBtn, .forgotPassLink');
    hiddenElements.forEach((el) => observer.observe(el));
</script>
</html>