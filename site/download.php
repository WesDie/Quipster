<?php
    require 'db.php';
    session_start();

    $sthandler = $conn->prepare("SELECT * FROM users");
    $sthandler->execute();
    $userCount = $sthandler->rowCount();

    $sthandler = $conn->prepare("SELECT * FROM users WHERE status = 'online'");
    $sthandler->execute();
    $userActiveCount = $sthandler->rowCount();

    $sthandler = $conn->prepare("SELECT * FROM messages WHERE type = 'group'");
    $sthandler->execute();
    $messageCount = $sthandler->rowCount();

    $sthandler = $conn->prepare("SELECT * FROM chats");
    $sthandler->execute();
    $groupCount = $sthandler->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quipster | Download</title>
    <link rel="stylesheet" href="land.css">
</head>
<body>
    <img src="https://cdn.discordapp.com/attachments/953594570518691900/1097267231500546068/logoQuipster.png" alt="" class="logoImg">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Hamburger_icon.svg/2048px-Hamburger_icon.svg.png" alt="" class="navIcon">
    <nav class="navbar">
        <a href="land.php">HOME</a>
        <a href="download.php">DOWNLOAD</a>
        <a href="about.php">ABOUT</a>
        <a href="contact.php">CONTACT</a>
        <?php      
            if (isset($_SESSION['logedin']) && $_SESSION['logedin'] === true) {
                ?>  <a class="loginBtn" href="chat.php">OPEN</a> <?php
            } else{
                ?>  <a class="loginBtn" href="login.php#login">LOGIN</a> <?php
            }
        ?>
    </nav>
    <section class="heroSection">
        <div class="heroContainer">
            <div>
                <h1>Download <span>Quipster</span></h1>
                <p>The future of communication is just on click away</p>
                    <!-- <div class="downloadopen-div">
                        <a href="download.exe" download class="downloadBtn">Download for windows</a>
                    </div> -->
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
                    <div class="inner-infoTextContainer" style="text-align: center !important;">
                        <h1 class="hidden">Download For Windows</h1>
                        <p class="hidden" style="margin-bottom: 40px;">Get the best experience with Quipster on desktop</p>
                        <a  href="" class="latestDownloadBtn hidden">Download latest version</a>
                    </div>
                </div>
            </div>
    </section>
    <div class="spacer layer2"></div>
    <section class="infoContainer2">
            <div class="infoDivContainerLog">
                <div class="infoContainerStatsDiv">
                    <div class="inner-infoTextContainer">
                        <h1>Changelog:</h1>
                        <button class="PatchBtn hidden" onclick="DisplayNextChangeLog('0.0.2')">0.0.2 (26-04-2023)</button>
                        <div class="ChangeLogText disabledChangeLog" id="0.0.2">
                            <p class="hidden">Added: Nothing</p>
                            <p class="hidden">Fixed: Nothing</p>
                        </div>
                        <button class="PatchBtn hidden" onclick="DisplayNextChangeLog('0.0.1')">0.0.1 (20-04-2023)</button>
                        <div class="ChangeLogText disabledChangeLog" id="0.0.1">
                            <h2 class="hidden">Desktop updates:</h2>
                            <p class="hidden">Added: Kaas</p>
                            <p class="hidden">Added: Ijsjes</p>
                            <p class="hidden">Added: Cake</p>
                            <p class="hidden">Major fix: If player chats chat dont work</p>
                            <p class="hidden">Minor fix: Chat not working with friend</p>
                            <p class="hidden">Minor fix: can not add friend if has no friends</p>
                            <p class="hidden">Minor fix: cheese is not working while you chat</p>
                            <br>
                            <br>

                            <h2 class="hidden">Website updates:</h2>
                            <p class="hidden">Added: Kaas</p>
                            <p class="hidden">Added: Ijsjes</p>
                            <p class="hidden">Added: Cake</p>
                            <p class="hidden">Minor fix: If player chats chat dont work</p>
                            <p class="hidden">Minor fix: Chat not working with friend</p>
                            <p class="hidden">Minor fix: can not add friend if has no friends</p>
                            <p class="hidden">Minor fix: cheese is not working while you chat</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <div class="spacer layer2" style="transform: rotate(0deg) !important;"></div>
    <section class="infoContainer1">
            <div class="infoDivContainerStats">
                <div class="infoContainerStatsDiv">
                    <div class="inner-infoTextContainer">
                        <h1 class="hidden">Active users:</h1>
                        <p class="hidden"><?php echo $userActiveCount ?></p>
                    </div>
                </div>
                <div class="infoContainerStatsDiv">
                    <div class="inner-infoTextContainer">
                        <h1 class="hidden">Users:</h1>
                        <p class="hidden"><?php echo $userCount ?></p>
                    </div>
                </div>
                <div class="infoContainerStatsDiv">
                    <div class="inner-infoTextContainer">
                        <h1 class="hidden">Messages:</h1>
                        <p class="hidden"><?php echo $messageCount ?></p>
                    </div>
                </div>
                <div class="infoContainerStatsDiv">
                    <div class="inner-infoTextContainer">
                        <h1 class="hidden">Groups:</h1>
                        <p class="hidden"><?php echo $groupCount ?></p>
                    </div>
                </div>
            </div>
    </section>
    <section class="infoContainerEnd">
        <div>
            <h1>Are you ready to experience the future of communication?</h1>
            <a href="" class="downloadBtnEnd">Download for windows</a>
            <a href="" class="openBtnEnd">Open</a>
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


    function DisplayNextChangeLog(version){

        var ChangeLogTextArray = document.getElementsByClassName("ChangeLogText");
        for(var i = 0; i < ChangeLogTextArray.length; i++)
        {
            ChangeLogTextArray[i].classList.remove('enabledChangeLog');
            ChangeLogTextArray[i].classList.add('disabledChangeLog');
        }

        if(document.getElementById(version).classList.contains('enabledChangeLog')){
            document.getElementById(version).classList.remove('enabledChangeLog');
            document.getElementById(version).classList.add('disabledChangeLog');
        } else {
            document.getElementById(version).classList.add('enabledChangeLog');
            document.getElementById(version).classList.remove('disabledChangeLog');
        }
    }
</script>
</html>