<?php
    require 'db.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quipster | About</title>
    <link rel="stylesheet" href="land.css">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">
    <link rel="mask-icon" href="assets/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
    <img src="https://cdn.discordapp.com/attachments/953594570518691900/1097267231500546068/logoQuipster.png" alt="" class="logoImg">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Hamburger_icon.svg/2048px-Hamburger_icon.svg.png" alt="" class="navIcon">
    <nav class="navbar">
        <a href="land">HOME</a>
        <a href="download">DOWNLOAD</a>
        <a href="about">ABOUT</a>
        <a href="contact">CONTACT</a>
        <?php      
            if (isset($_SESSION['logedin']) && $_SESSION['logedin'] === true) {
                ?>  <a class="loginBtn" href="chat">OPEN</a> <?php
            } else{
                ?>  <a class="loginBtn" href="login#login">LOGIN</a> <?php
            }
        ?>
    </nav>
    <section class="heroSection">
        <div class="heroContainer">
            <div>
                <h1>About <span>us</span></h1>
                <p>Do you want to know more about us learn more here!</p>
            </div>
            <div class="image-chat-hero-div">
                <svg class="chatBoxLeft" width="571" height="334" viewBox="0 0 571 334" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="571" height="267.962" rx="60" fill="#ADFFB0"/>
                    <path d="M79.3403 334L38.7631 262.565L119.917 262.565L79.3403 334Z" fill="#ADFFB0"/>
                </svg>  
                <svg class="chatBoxRight" width="571" height="334" viewBox="0 0 571 334" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="571" height="267.962" rx="60" fill="#62FF68"/>
                    <path d="M474.146 334L433.568 262.565L514.723 262.565L474.146 334Z" fill="#62FF68"/>
                </svg>    
            </div>
        </div>
    </section>
    <div class="spacer layer1"></div>
    <section class="infoContainer1">
        <div class="infoDivContainerLeftImg">
            <div class="infoContainerImgDiv">
                <img src="images/box.png" alt="" class="ChatImg">
            </div>
            <div class="infoContainerTextDiv">
                <div class="inner-infoTextContainer">
                    <h1 class="hidden">Information 1</h1>
                    <p class="hidden">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed laoreet nisi. Integer ut pretium nulla. Aenean mattis efficitur elit id consectetur. Mauris vehicula quis ipsum eu molestie. Phasellus pretium felis ac auctor interdum. Ut varius porttitor felis, ac efficitur turpis dignissim ut. Praesent aliquam sapien in magna tincidunt, et tempor dolor ornare. Vivamus id orci ac nisi accumsan varius. Nam pulvinar ut massa in tristique.</p>
                </div>
            </div>
        </div>
    </section>
    <div class="spacer layer2"></div>
    <section class="infoContainer2">
            <div class="infoDivContainerLeftImg">
                <div class="infoContainerTextDiv">
                    <div class="inner-infoTextContainer">
                        <h1 class="hidden">Information 2</h1>
                        <p class="hidden">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed laoreet nisi. Integer ut pretium nulla. Aenean mattis efficitur elit id consectetur. Mauris vehicula quis ipsum eu molestie. Phasellus pretium felis ac auctor interdum. Ut varius porttitor felis, ac efficitur turpis dignissim ut. Praesent aliquam sapien in magna tincidunt, et tempor dolor ornare. Vivamus id orci ac nisi accumsan varius. Nam pulvinar ut massa in tristique.</p>
                    </div>
                </div>
                <div class="infoContainerImgDiv">
                    <img src="https://cdn.discordapp.com/attachments/953594570518691900/1097588718874935426/image.png" alt="" class="ChatImg">
                </div>
            </div>
    </section>
    <div class="spacer layer2" style="transform: rotate(0deg) !important;"></div>
    <section class="infoContainer1">
            <div class="infoDivContainerLeftImg">
                <div class="infoContainerImgDiv">
                    <img src="images/box.png" alt="" class="ChatImg">
                </div>
                <div class="infoContainerTextDiv">
                    <div class="inner-infoTextContainer">
                        <h1 class="hidden">Information 3</h1>
                        <p class="hidden">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed laoreet nisi. Integer ut pretium nulla. Aenean mattis efficitur elit id consectetur. Mauris vehicula quis ipsum eu molestie. Phasellus pretium felis ac auctor interdum. Ut varius porttitor felis, ac efficitur turpis dignissim ut. Praesent aliquam sapien in magna tincidunt, et tempor dolor ornare. Vivamus id orci ac nisi accumsan varius. Nam pulvinar ut massa in tristique.</p>
                    </div>
                </div>
            </div>
    </section>
    <section class="infoContainerEnd">
        <div>
            <h1>Do have any questions? Feel free to contact us</h1>
            <a href="contact.html" class="downloadBtnEnd">Contact us</a>
            <a href="contact.html" class="openBtnEnd">Contact us</a>
        </div>
    </section>
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

    const hiddenElements = document.querySelectorAll('.hidden');
    hiddenElements.forEach((el) => observer.observe(el));
</script>
</html>