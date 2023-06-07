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
                $_SESSION['pfp'] = $user['pfp'];
                
                header('Location: chat.php');
            } else {
                header('Location: login.php?error=password incorrect');
            }
        }
    }

    if(isset($_POST['newPassword']) && isset($_POST['newPasswordCheck'])){

        $newTime = strtotime('-5 minutes'); 
        $tenMinutesAgo = date('Y-m-d H:i:s', $newTime);
    
        $stmt = $conn->prepare("SELECT * FROM password_reset WHERE creation_timestamp < '$tenMinutesAgo'");
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while ($rows= $stmt->fetchAll()) {
                foreach($rows as $row){
                    $token = $row['token'];
                    $stmt = $conn->prepare("DELETE FROM password_reset WHERE token = :token");
                    $stmt->bindParam(":token", $token);
                    $stmt->execute();
                }
            }
        }

        $token = $_GET['token'];
        $password = $_POST['newPassword'];
        $passwordCheck = $_POST['newPasswordCheck'];
        
        $stmt = $conn->prepare("SELECT * FROM password_reset WHERE token = :token");
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        if($stmt->rowCount() === 0){
            header ("location: login.php?regerror=Token is nowwt vaild!");
        } else{
            if(empty($token)){
                header ("location: login.php?regerror=Token is not vaild!");
            } else if(empty($password)){
                header ("location: login.php?regerror=New password is not filled in!");
            }else if(empty($passwordCheck)){
                header ("location: login.php?regerror=New password check is not filled in!");
            } else if($password == $passwordCheck){

                $sthandler = $conn->prepare("SELECT * FROM password_reset WHERE token = :token");
                $sthandler->bindParam(':token', $token);
                $sthandler->execute();

                $tokenInfo= $sthandler->fetch();
                $email = $tokenInfo['email'];

                $password =  password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET password = :password WHERE email = :email");
                $stmt->bindParam(":password", $password);
                $stmt->bindParam(":email", $email);
                $stmt->execute();

                $stmt = $conn->prepare("DELETE FROM password_reset WHERE token = :token");
                $stmt->bindParam(":token", $token);
                $stmt->execute();
                header ("location: login.php#login");
            }
        }
    }

    if(isset($_POST['passForgetEmail'])){
        $passForgetEmail = $_POST['passForgetEmail'];

        
        if(empty($passForgetEmail)){
            header ("location: login.php?passwordNewError=Email is not filled in!");
        } else{
            $sthandler = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $sthandler->bindParam(':email', $passForgetEmail);
            $sthandler->execute();

            if($sthandler->rowCount() > 0){
                $token = bin2hex(random_bytes(32));
                $creation_timestamp = date('Y-m-d H:i:s');

                $stmt = $conn->prepare("INSERT INTO password_reset (email, token, creation_timestamp) 
                VALUES (:email, :token, :creation_timestamp)");
                $stmt->bindParam(":email", $passForgetEmail);
                $stmt->bindParam(":token", $token);
                $stmt->bindParam(":creation_timestamp", $creation_timestamp);
                $stmt->execute();

                $resetLink = "http://localhost/login.php?token=$token#passchange";
                header("Location: login.php?tokenlink=$resetLink");

            } else{
                header ("location: login.php?passwordNewError=Email doesnt exist!");
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
                <input type="text" class="inputBox" name="email" id="email">
                <br>
                <br>
                <label for="" class="inputLabel">PASSWORD</label>
                <br>
                <input type="password" class="inputBox" name="password" id="password">
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
                <input name="username" type="text" class="inputBox" id="username">
                <br>
                <br>
                <label for="" class="inputLabel">E-MAIL</label>
                <br>
                <input name="email" type="text" class="inputBox" id="email">
                <br>
                <br>
                <label for="" class="inputLabel">PASSWORD</label>
                <br>
                <input name="password" type="password" class="inputBox" id="password">
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
    <div id="forgotpass" class="mainContainer">
        <div class="topTextRegister">
            <div  class="textInfo">
                <h1>Password reset</h1>
                <a href="#login">back to login</a>
            </div>
            <div class="spacer wave"></div>
        </div>
        <div class="passwordForgotForm">
            <form method="POST">
                <label for="" class="inputLabel">EMAIL</label>
                <br>
                <input type="text" class="inputBox" name="passForgetEmail" id="email">
                <br>
                <input type="submit" value="SEND" class="submitBtn">
            </form>
        </div>
        </div>
    </div>
    <div id="passchange" class="mainContainer">
        <div class="topTextRegister">
            <div  class="textInfo">
                <h1>Password change</h1>
                <!-- <a href="#login">back to login</a> -->
            </div>
            <div class="spacer wave"></div>
        </div>
        <div class="passwordForgotForm">
            <form method="POST">
                <input type="hidden" class="inputBox" name="id" value="645e00debcd23">
                <label for="" class="inputLabel">NEW PASSWORD</label>
                <br>
                <input type="password" class="inputBox" name="newPassword">
                <label for="" class="inputLabel">NEW PASSWORD CHECK</label>
                <br>
                <input type="password" class="inputBox" name="newPasswordCheck">
                <br>
                <input type="submit" value="SEND" class="submitBtn">
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