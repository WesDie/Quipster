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
      <div class="chat selected">
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
        <img src="images/box.png" alt="">
        <p class="user">Jonatan</p>fffffffz
        <p id="message">Consectetur consectetur sint veniam minim magna cupidatat ea mollit aute excepteur. Minim consequat est aliquip anim deserunt reprehenderit id eiusmod ullamco. Commodo proident elit nisi ullamco commodo non nulla consequat cillum. Irure irure laboris sunt minim ea exercitation reprehenderit fugiat sunt ullamco excepteur nulla.</p>
      </div>
    </div>
    <div id="newMessage">
      <input type="text" placeholder="Message das">
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