<?php
session_start();

if (isset($_SESSION['logedin']) && $_SESSION['logedin']) {
  require_once("db.php");


  
  if(isset($_GET['logout'])){
    if($_GET['logout'] == 1){
        session_destroy();
        header("location: index.php");
    }
  }

  $status = "online";
  $id = $_SESSION['id'];
  $stmt = $conn->prepare("UPDATE users SET status = :status WHERE id = :id");
  $stmt->bindParam(':status', $status);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Chat | Quipster</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Quipster APP">
    <link rel="icon" href="assets/favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="chat.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">
    <link rel="mask-icon" href="assets/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <script src="chat.js"></script>
    <script>
      $(window).on('load', function() {
        // $("#loader-wrapper").fadeOut(700);

        // if (window.innerWidth <= 800) {
        //   console.log("hier a");
        //   Small();
        // } else if (window.outerWidth >= 1800) {
        //   console.log("hier c");
        //   Large();
        // } else if (window.innerWidth >= 800 && window.innerWidth <= 1800) {
        //   console.log("hier b");
        //   Medium();
        // } else {
        //   console.log("welp");
        // }

        // when page first opened, check windows width:
        if (window.innerWidth <= 800) {
          Small();
        } else if (window.outerWidth >= 1200) {
          Large();
        } else if (window.innerWidth >= 800 && window.innerWidth <= 1200) {
          Medium();
          console.log("dsad");
        } else {
          console.log("welp");
        }

        // same as above but everytime:
        mqSmall.addEventListener('change', function(e) {
          if (e.matches) {
            Small();
          }
        });
        mqMedium.addEventListener('change', function(e) {
          if (e.matches) {
            Medium();
            console.log("dsa")
          }
        });
        mqLarge.addEventListener('change', function(e) {
          if (e.matches) {
            Large();
          }
        });
      });

      setInterval(function() {
        UpdateMessages(lastLoadedX, "dev_chat");
      }, 1000);
    </script>
  </head>

  <body>
    <div id="left">
      <div class="user">
        <img src="<?php if ($_SESSION['pfp'] != null) {
                    echo "{$_SESSION['pfp']}";
                  } else {
                    echo "https://soccerpointeclaire.com/wp-content/uploads/2021/06/default-profile-pic-e1513291410505.jpg";
                  } ?>" alt="">
        <p style="display: inline-block;"><?php echo "{$_SESSION['username']}" ?></p>
        <button onclick="LeftTabsToggle()" id="requestToggle" class="material-symbols-outlined">
          notifications
        </button>
        <button onclick="SettingsToggle()" class="material-symbols-outlined">
          settings
        </button>
      </div>
      <div class="spacer wave"></div>
      <div id="chats" class="chats tab open">
        <div class="list">
          <?php
          $user = $_SESSION["id"];
          $stmtChats = $conn->prepare("SELECT * FROM chatmembers WHERE user=:user");
          $stmtChats->bindParam(':user', $user);
          $stmtChats->execute();
          $chats = $stmtChats->fetchAll();
          foreach ($chats as $chat) {
            $stmtChat = $conn->prepare("SELECT * FROM chats WHERE id=:id");
            $stmtChat->bindParam(':id', $chat["chat"]);
            $stmtChat->execute();
            $chat = $stmtChat->fetch();
          ?>
            <div onclick="ChangeChat('<?php echo $chat['id'] ?>')" class="list-item<?php echo !true ? " selected" : "" ?>">
              <img src="<?php echo $chat["icon"] ?>" alt="">
              <p><?php echo $chat["name"] ?></p>
              <button class="material-symbols-outlined">
                more_horiz
              </button>
            </div>
          <?php
          }
          ?>
        </div>
        <button class="filled" onclick="CreateChatModal()">
          Create new chat
        </button>
      </div>
      <div id="requests" class="requests tab">
        <div id="switchSides">
          <button onclick="LeftChildToggle(true)" class="filled selected">
            Friends requests
          </button>
          <button onclick="LeftChildToggle(false)" class="filled">
            Chat requests
          </button>
        </div>
        <div id="tabFriend" class="tab open">
          <div class="list">
            <?php

            ?>
            <div class="list-item<?php echo !true ? " selected" : "" ?>">
              <img src="<?php echo '$chat["icon"]' ?>" alt="">
              <p><?php echo 'No friend requests' ?></p>
              <!-- <button class="material-symbols-outlined">
                more_horiz
              </button> -->
            </div>
          </div>
          <button class="filled">
            Add friend
          </button>
        </div>
        <div id="tabChat" class="tab">
          <div class="list">
            <div class="list-item<?php echo !true ? " selected" : "" ?>">
              <img src="<?php echo '$chat["icon"]' ?>" alt="">
              <p><?php echo 'No chat invites' ?></p>
              <!-- <button class="material-symbols-outlined">
                more_horiz
              </button> -->
            </div>
          </div>
          <!-- <button class="filled">
            Create new chat
          </button> -->
        </div>
      </div>
    </div>
    <div id="middle">
      <div class="top">
        <button onclick="Toggle(true)" id="toggleLeft" class="material-symbols-outlined">
          chevron_left
        </button>
        <p>
          <?php
          $stmtChatTitle = $conn->prepare("SELECT * FROM chats WHERE id=:id");
          $chatr = "dev_chat";
          $stmtChatTitle->bindParam(':id', $chatr);
          $stmtChatTitle->execute();
          $user = $stmtChatTitle->fetch();
          echo $user["name"];
          ?>
        </p>
        <button onclick="Toggle(false)" id="toggleRight" class="material-symbols-outlined" style="float: right;">
          chevron_right
        </button>
      </div>
      <div id="currentchat">
      </div>
      <div id="newMessage">
        <input id="inpurt" type="text" placeholder="Message Wes...">
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
        $chat = "dev_chat";
        // $chat = $_POST['chat_id'];
        $user = $_SESSION["id"];
        $stmtCheck = $conn->prepare("SELECT * FROM chatmembers WHERE chat=:chat");
        $stmtCheck->bindParam(':chat', $chat);
        $stmtCheck->execute();
        $members = $stmtCheck->fetchAll();
        foreach ($members as $member) {
          $stmtUser = $conn->prepare("SELECT * FROM users WHERE id=:id");
          $stmtUser->bindParam(':id', $member["user"]);
          $stmtUser->execute();
          $user = $stmtUser->fetch();
        ?>
          <div class="list-item">
            <img src="<?php
                      echo !empty($user['pfp']) ?
                        $user['pfp'] :
                        "https://cdn.discordapp.com/avatars/450354935901716481/35eb0ba4d3e6115a758c8a658317ce72.webp?size=128";
                      ?>" alt="">
            <p><?php echo $user["username"] ?></p>
            <button class="material-symbols-outlined">
              more_horiz
            </button>
          </div>
        <?php
        }
        ?>
      </div>
      <button class="filled">
        Invite members
      </button>
    </div>
    <div id="settings" style="display: none">
      <div class="back">
        <button onclick="SettingsToggle()" class="material-symbols-outlined">close</button>
      </div>
      <div id="catagories">
        <button class="catagory selected" onclick="SettingsTabToggle('Profile')" id="profile">
          Profile
        </button>
        <button class="catagory" onclick="SettingsTabToggle('Account')" id="account">
          Account
        </button>
        <button class="catagory" onclick="SettingsTabToggle('Privacy')" id="privacy">
          Privacy
        </button>
        <button class="catagory" onclick="SettingsTabToggle('Notification')" id="notification">
          Notification
        </button>
        <button class="catagory" onclick="SettingsTabToggle('Chat')" id="chat">
          Chat
        </button>
        <button class="catagory" onclick="SettingsTabToggle('Security')" id="security">
          Security
        </button>
        <button class="catagory" onclick="SettingsTabToggle('HelpAndSupport')" id="helpandsupport">
          Help and support
        </button>
      </div>
      <div class="setting">
        <p>Settings</p>
      </div>
      <div id="settingTabContainer">
         <div id="Profile">
            Profile
         </div>
         <div id="Account">
            <div class="sectionSettingsTab">
                <h3>Email:</h3>
                <input type="text">
                <button class="settingsButton" onclick="ChangePasswordBoxModal()">Change</button>
                <br>
                <h3>Change Password:</h3>
                <button class="settingsButton" onclick="ChangePasswordBoxModal()">Change</button>
                <br>
                <h3>2FA:</h3>
                <button class="settingsButton" onclick="ChangePasswordBoxModal()">Enable 2FA</button>
                <br>
                <button class="settingsButton settingsLogoutButton" onclick="logout()">Logout</button>
            </div>
         </div>
         <div id="Privacy">
            Privacy
         </div>
         <div id="Notification">
            Notification
         </div>
         <div id="Chat">
            Chat
         </div>
         <div id="Security">
            Security
         </div>
         <div id="HelpAndSupport">
            HelpAndSupport
         </div>
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
    <dialog id="InviteMembersBox">
      <form>
        <p>
          <label>Favorite animal:
            <select>
              <option value="default">Choose…</option>
              <option>Brine shrimp</option>
              <option>Red panda</option>
              <option>Spider monkey</option>
            </select>
          </label>
        </p>
        <div>
          <button value="cancel" formmethod="dialog">Cancel</button>
          <button id="confirmBtn" value="default">Confirm</button>
        </div>
      </form>
    </dialog>

    <dialog id="CreateChatBox" class="CreateBox">
      <h1>Create chat</h1>
      <form class="createChatContainer">
        <p>
          <label>Name: *
            <input type="text" name="name" id="nameCreateChat">
          </label>
        </p>
        <p>
          <label>Description: *
            <input type="text" name="description" id="descCreateChat">
          </label>
        </p>
        <p>
          <label>Icon (url): *
            <input type="text" name="icon" id="iconCreateChat">
          </label>
        </p>
        <div class="btnDialogSelection">
          <button value="cancel" formmethod="dialog">Cancel</button>
          <button id="confirmBtn" type="button" onclick="CreateChat()">Confirm</button>
        </div>
      </form>
    </dialog>
    <dialog id="changePasswordBox" class="CreateBox">
      <h1>Change password</h1>
      <form class="createChatContainer">
        <p>
          <label>Current Password: *
            <input type="text" name="name" id="nameCreateChat">
          </label>
        </p>
        <p>
          <label>New Password: *
            <input type="text" name="description" id="descCreateChat">
          </label>
        </p>
        <p>
          <label>New Password check: *
            <input type="text" name="icon" id="iconCreateChat">
          </label>
        </p>
        <div class="btnDialogSelection">
          <button value="cancel" formmethod="dialog">Cancel</button>
          <button id="confirmBtn" type="button" onclick="">Confirm</button>
        </div>
      </form>
    </dialog>
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
