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
  <div id="left">
    <div class="user">
      <img src="images/box.png" alt="">
      <p style="display: inline-block;">Jonatan</p>
      <button onclick="SettingsToggle()" class="settings material-symbols-outlined">
        settings
      </button>
    </div>
    <div class="spacer wave"></div>
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
  <div id="middle">
    <div class="top">
      <button onclick="Toggle(true)" id="toggleLeft" class="material-symbols-outlined">
        chevron_left
      </button>
      <p>
        chat title
      </p>
      <button onclick="Toggle(false)" id="toggleRight" class="material-symbols-outlined" style="float: right;">
        chevron_right
      </button>
    </div>
    <div id="currentchat">
      <div class="message">
        <img src="https://cdn.discordapp.com/avatars/450354935901716481/35eb0ba4d3e6115a758c8a658317ce72.webp?size=128" alt="" draggable="false">
        <div class="user">
          <b>Wes</b>
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
      <div class="message">
        <img src="https://cdn.discordapp.com/avatars/612355034419560449/ab133ea0a5a822d4a6fbbde202957206.webp?size=128" alt="">
        <div class="user">
          <b>Jonatan</b>
          <span class="timestamp">Today at 13:31</span>
        </div>
        <p id="message">
          CREATE TABLE `users` (
          `id` varchar (13),
          `username` varchar (255),
          `email` varchar (255),
          `password` varchar (1024),
          `pfp` varchar (255),
          `created` date,
          `status` enum ("online","idle","nodisturb","offline"),
          `lastonline` datetime,
          `banned` datetime,
          PRIMARY KEY (`id`)
          );

          CREATE TABLE `chats` (
          `id` varchar (13),
          `name` varchar (255),
          `icon` varchar (255),
          `description` varchar (1024),
          `created` date,
          `type` enum ("duo","group"),
          `reported` enum ("false","true"),
          PRIMARY KEY (`id`)
          );

          CREATE TABLE `messages` (
          `id` varchar (13),
          `chat` varchar (13),
          `user` varchar (13),
          `sent` datetime,
          `type` enum ("text","media"),
          `message` varchar (255),
          `replyto` varchar (13),
          `pinned` enum ("false","true"),
          PRIMARY KEY (`id`),
          FOREIGN KEY (`user`) REFERENCES `users`(`id`),
          FOREIGN KEY (`chat`) REFERENCES `chats`(`id`)
          );

          CREATE TABLE `emojis` (
          `id` varchar (13),
          `name` varchar (255),
          `emoji` varchar (255),
          PRIMARY KEY (`id`)
          );

          CREATE TABLE `reactions` (
          `message` varchar (13),
          `emoji` varchar (13),
          FOREIGN KEY (`message`) REFERENCES `messages`(`id`),
          FOREIGN KEY (`emoji`) REFERENCES `emojis`(`id`)
          );

          CREATE TABLE `chatmembers` (
          `chat` varchar (13),
          `user` varchar (13),
          `joined` datetime,
          `role` enum ("banned","member","admin","owner"),
          FOREIGN KEY (`chat`) REFERENCES `chats`(`id`),
          FOREIGN KEY (`user`) REFERENCES `users`(`id`)
          );

          CREATE TABLE `friendships` (
          `user1` varchar (13),
          `user2` varchar (13),
          `type` enum ("request","friends","block"),
          FOREIGN KEY (`user2`) REFERENCES `users`(`id`),
          FOREIGN KEY (`user1`) REFERENCES `users`(`id`)
          );
        </p>
      </div>
    </div>
    <div id="newMessage">
      <input type="text" placeholder="Message Wes...">
      <button class="material-symbols-outlined">
        send
      </button>
    </div>
  </div>
  <div id="right">
    <div class="top">
      Members
    </div>
    <div class="members">
      <?php
      for ($i = 0; $i < 10; $i++) {
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
    </div>
    <button>Invite members</button>
  </div>
  <div id="settings" style="display: none">
    <div class="back">
      <button onclick="SettingsToggle()" class="material-symbols-outlined">close</button>
    </div>
    <div id="catagories">
      <button class="catagory selected">
        Profile
      </button>
      <button class="catagory">
        Privacy
      </button>
      <button class="catagory">
        Notification
      </button>
      <button class="catagory">
        Chat
      </button>
      <button class="catagory">
        Media
      </button>
      <button class="catagory">
        Security
      </button>
      <button class="catagory">
        Language
      </button>
      <button class="catagory" inert>
        Help and support
      </button>
      <button class="catagory">
        Account
      </button>
      <button class="catagory">
        Logout
      </button>
    </div>
    <div class="setting">
      <p>Dummy setting</p>
    </div>
  </div>




  <!-- <div id="fadein"></div>
  <div id="loader-wrapper">
    <div class="loader"></div>
  </div> -->
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