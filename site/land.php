<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quipster | The place to be</title>
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
        <a class="loginBtn" href="login.php#login">LOGIN</a>
    </nav>
    <section class="heroSection">
        <div class="heroContainer">
            <div>
                <h1>Welcome to <span>Quipster</span></h1>
                <p>The place to chat with your friend and make groups.</p>
                <div class="downloadopen-div">
                    <a href="download.exe" download class="downloadBtn">Download for windows</a>
                    <a href="chat.php" class="openBtn">Open in browser</a>
                </div>
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
                        <h1 class="hidden">Chat with anyone at any time</h1>
                        <p class="hidden">Chat with your friend whenever you want you can communicate with your friends at any time. You can also add new friends or make friends at any time.</p>
                    </div>
                </div>
            </div>
    </section>
    <div class="spacer layer2"></div>
    <section class="infoContainer2">
            <div class="infoDivContainerLeftImg">
                <div class="infoContainerTextDiv">
                    <div class="inner-infoTextContainer">
                        <h1 class="hidden">Make groups with unlimited members</h1>
                        <p class="hidden">With Quipster you can make a group with as many members as you want you can also gives any member group permissions</p>
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
                        <h1 class="hidden">A safe place for everyone</h1>
                        <p class="hidden">On Quipster we find it important that everyone has a good experience so if you find that something can be improved or someone is not following our guidelines you can report at any time.</p>
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
</script>
</html>