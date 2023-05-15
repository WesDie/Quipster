<?php
session_start();

if (isset($_SESSION['logedin']) && $_SESSION['logedin']) {
  require_once("db.php");
?>
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
        <img src="https://cdn.discordapp.com/avatars/612355034419560449/ab133ea0a5a822d4a6fbbde202957206.webp?size=128" alt="">
        <p style="display: inline-block;"><?php echo "{$_SESSION['username']}" ?></p>
        <button onclick="SettingsToggle()" class="settings material-symbols-outlined">
          settings
        </button>
      </div>
      <div class="spacer wave"></div>
      <div class="friends">
        Friend requests
      </div>
      <div class="list">
        <?php
        for ($i = 0; $i < 20; $i++) {
        ?>
          <div class="list-item<?php echo $i == 4 ? " selected" : "" ?>">
            <img src="https://cdn.discordapp.com/avatars/450354935901716481/35eb0ba4d3e6115a758c8a658317ce72.webp?size=128" alt="">
            <p>das ilad gfhadiygfadfiygasdsda</p>
            <button class="material-symbols-outlined">
              more_horiz
            </button>
          </div>
        <?php
        }
        ?>
      </div>
      <div>
        Create new chat
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
      </div>
      <div id="newMessage">
        <input type="text" placeholder="Message Wes...">
        <button onclick="SendMessage()" class="material-symbols-outlined">
          send
        </button>
      </div>
    </div>
    <div id="right">
      <div class="top">
        Members
      </div>
      <div class="list">
        <?php
        for ($i = 0; $i < 10; $i++) {
        ?>
          <div class="list-item">
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


    <div id="context-menu">
      <div class="item">
        <button>Emoji</button>
      </div>
      <div class="item">
        <button>Reply</button>
      </div>
      <div class="divider"></div>
      <div class="item">
        <button>idk</button>
      </div>
    </div>
    <script>
      const contextMenu = document.getElementById("context-menu");

      window.addEventListener("contextmenu", e => {
        e.preventDefault();
        contextMenu.style.display = "none";
        let x = e.clientX,
          y = e.clientY,
          winWidth = window.innerWidth,
          winHeight = window.innerHeight,
          cmWidth = contextMenu.offsetWidth,
          cmHeight = contextMenu.offsetHeight;

        x = x > winWidth - cmWidth ? winWidth - cmWidth - 5 : x;
        y = y > winHeight - cmHeight ? winHeight - cmHeight - 5 : y;

        contextMenu.style.left = `${x}px`;
        contextMenu.style.top = `${y}px`;
        contextMenu.style.display = "grid";
      });

      function ContextMenu() {
        let x = e.clientX,
          y = e.clientY,
          winWidth = window.innerWidth,
          winHeight = window.innerHeight,
          cmWidth = contextMenu.offsetWidth,
          cmHeight = contextMenu.offsetHeight;

        x = x > winWidth - cmWidth ? winWidth - cmWidth - 5 : x;
        y = y > winHeight - cmHeight ? winHeight - cmHeight - 5 : y;

        contextMenu.style.left = `${x}px`;
        contextMenu.style.top = `${y}px`;
        contextMenu.style.display = "grid";
      }

      document.addEventListener("click", () => contextMenu.style.display = "none");
    </script>
  </body>

  </html>
<?php
} else {
  session_destroy();
  exit(header("Location: /login.php#login"));
}
