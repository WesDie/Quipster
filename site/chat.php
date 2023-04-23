<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Quipster APP</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Quipster APP" />
  <link rel="icon" href="assets/favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <link rel="stylesheet" href="chat.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  <script src="chat.js"></script>
</head>

<body>
  <div class="left">
    <div class="user">
      <img src="images/box.png" alt="">
      <p style="display: inline-block;">Jonatan</p>
      <span class="settings material-symbols-outlined">
        settings
      </span>
    </div>
    <hr>
    <div class="friends">
      Friend requests
    </div>
    <div class="chats">
      <div class="chat selected" data-id="9ds13dh13d13">
        <img src="/images/box.png" alt="">
        <p>das</p>
        <button class="material-symbols-outlined">
          more_horiz
        </button>
      </div>
      <?php
      for ($i = 0; $i < 20; $i++) {
      ?>
        <div class="chat">
          <img src="/images/box.png" alt="">
          <p>das</p>
          <button class="material-symbols-outlined">
            more_horiz
          </button>
        </div>
      <?php
      }
      ?>
      <div>
        Create new chat
      </div>
    </div>
  </div>
  <div class="middle">
    <div class="top">
      <button onclick="Toggle(true)" id="toggleLeft" class="material-symbols-outlined">
        chevron_left
      </button>
      <p style="display: inline;">
        chat title
      </p>
      <button onclick="Toggle(false)" id="toggleRight" class="material-symbols-outlined" style="float: right;">
        chevron_right
      </button>
    </div>
    <div class="spacer wave"></div>
    <div id="currentchat">

      <div class="message">
        <img src="https://cdn.discordapp.com/avatars/450354935901716481/35eb0ba4d3e6115a758c8a658317ce72.webp?size=128" alt="" draggable="false">
        <div class="user">
          <b>Wehs</b>
          <span class="timestamp">Today at 12:13</span>
        </div>
        <p id="message">Consectetur consectetur sint veniam minim magna cupidatat ea mollit aute excepteur. Minim consequat est aliquip anim deserunt reprehenderit id eiusmod ullamco. Commodo proident elit nisi ullamco commodo non nulla consequat cillum. Irure irure laboris sunt minim ea exercitation reprehenderit fugiat sunt ullamco excepteur nulla.</p>
      </div>
      <div class="message">
        <img src="https://cdn.discordapp.com/avatars/612355034419560449/ab133ea0a5a822d4a6fbbde202957206.webp?size=128" alt="">
        <div class="user">
          <b>Jonatan</b>
          <span class="timestamp">Today at 12:34</span>
        </div>
        <p id="message">Anim anim elit ullamco anim minim. Esse minim elit laborum ad. Irure nisi nostrud pariatur nulla eiusmod cillum ex esse amet duis. Ullamco non est est fugiat aute.</p>
      </div>
    </div>
    <div id="newMessage">
      <input type="text" placeholder="Message Whes...">
      <button class="material-symbols-outlined">
        send
      </button>
    </div>
  </div>
  <div class="right">
    <p>pizza</p>
  </div>
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