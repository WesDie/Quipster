<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Hello, world!</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="icon" href="favicon.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <link rel="stylesheet" href="chat.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
</head>

<body>
  <div class="left">
    <div class="user">
      <img src="https://lh3.googleusercontent.com/ogw/AOLn63EWRe_Pk06KJLljMCbMzU4A5WphTCsWm7-bG6AtUw=s64-c-mo" alt="">
      <p style="display: inline-block;">Jonatan</p>
      <span class="settings material-symbols-outlined">
        settings
      </span>
    </div>
    <div class="friends">
      Friend requests
    </div>
    <div class="chats">
      chat1
    </div>
  </div>
  <div class="middle"></div>
  <div class="right"></div>
  <div id="fadein"></div>
  <div id="loader-wrapper">
    <div class="loader"></div>
  </div>
  <script type="text/javascript">
    window.onload = function() {
      setTimeout(function() {
        document.getElementById("fadein").remove();
      }, 1000);
    };
  </script>
  <script type="text/javascript">
    $(window).on('load', function() {
      $("#loader-wrapper").fadeOut(700);
    });
  </script>
</body>

</html>