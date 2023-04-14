<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Hello, world!</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="icon" href="favicon.png">
</head>
<body>
  <div id="fadein"></div>
  <style>
    /* For best practice, move CSS below to an external CSS file. */
    @keyframes fadeinall {
    0% {
      opacity: 1; }
    97% {
      opacity: 0; }
    98% {
      opacity: 0;
      -webkit-transform: translateY(0);
      transform: translateY(0); }
    100% {
      opacity: 0;
      -webkit-transform: translateY(-100%);
      transform: translateY(-100%);
      z-index: -1; } }
    #fadein {
      opacity: 1;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      -webkit-transform: translateY(0);
      -ms-transform: translateY(0);
      transform: translateY(0);
      background-color: #FFFFFF;
      z-index: 999;
      -webkit-animation-fill-mode: forwards;
      animation-fill-mode: forwards;
      -webkit-animation: fadeinall 1s normal both;
      animation: fadeinall 1s normal both;
      -webkit-animation-delay: 0.3s;
      animation-delay: 0.3s; }
  </style>
  <div id="loader-wrapper">
    <div class="loader"></div>
  </div>
  <style>
    /* For best practice, move CSS below to an external CSS file. */
    @keyframes rotation {
      0% {
        transform: rotate(0deg); }
      100% {
        transform: rotate(360deg); } }
    #loader-wrapper {
      background-color: #FFFFFF;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 999;
      width: 100%;
      height: 100%;
      text-align: center; }
    .loader {
      width: 40px;
      height: 40px;
      border: 5px solid #000000;
      border-bottom-color: transparent;
      border-radius: 50%;
      margin-top:calc(50vh - 20px);
      display: inline-block;
      box-sizing: border-box;
      -webkit-animation: rotation 1s linear infinite;
      animation: rotation 1s linear infinite; }
  </style>
  <h1>Hello, world!</h1>
  <div id="cookie-notice" style="width: 100%; position: fixed; z-index: 1000; bottom: 0; left: 0; background-color: lightgray;">
    <p>This website uses cookies so that we can provide you with the best website experience. By clicking “I Accept” you acknowledge the use of cookies and to our <a href="#"><u>Privacy Policy</u></a>.</p>
    <a id="i-accept">I Accept</a>
  </div>
  <div style="width: 100%; position: fixed; z-index: 1000; top: 0; left: 0; background: lightgray;"><p>This is an announcemet.</p><div onClick="parentNode.remove()">Close [X]</div></div>
  <!-- ░░░░░▄▄▄▄▀▀▀▀▀▀▀▀▄▄▄▄▄▄░░░░░░░░ -->
  <!-- ░░░░░█░░░░▒▒▒▒▒▒▒▒▒▒▒▒░░▀▀▄░░░░ -->
  <!-- ░░░░█░░░▒▒▒▒▒▒░░░░░░░░▒▒▒░░█░░░ -->
  <!-- ░░░█░░░░░░▄██▀▄▄░░░░░▄▄▄░░░░█░░ -->
  <!-- ░▄▀▒▄▄▄▒░█▀▀▀▀▄▄█░░░██▄▄█░░░░█░ -->
  <!-- █░▒█▒▄░▀▄▄▄▀░░░░░░░░█░░░▒▒▒▒▒░█ -->
  <!-- █░▒█░█▀▄▄░░░░░█▀░░░░▀▄░░▄▀▀▀▄▒█ -->
  <!-- ░█░▀▄░█▄░█▀▄▄░▀░▀▀░▄▄▀░░░░█░░█░ -->
  <!-- ░░█░░░▀▄▀█▄▄░█▀▀▀▄▄▄▄▀▀█▀██░█░░ -->
  <!-- ░░░█░░░░██░░▀█▄▄▄█▄▄█▄████░█░░░ -->
  <!-- ░░░░█░░░░▀▀▄░█░░░█░█▀██████░█░░ -->
  <!-- ░░░░░▀▄░░░░░▀▀▄▄▄█▄█▄█▄█▄▀░░█░░ -->
  <!-- ░░░░░░░▀▄▄░▒▒▒▒░░░░░░░░░░▒░░░█░ -->
  <!-- ░░░░░░░░░░▀▀▄▄░▒▒▒▒▒▒▒▒▒▒░░░░█░ -->
  <!-- ░░░░░░░░░░░░░░▀▄▄▄▄▄░░░░░░░▄█░░ -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript">
    (function($){
        $('#i-accept').on('click', function() {   
            if(localStorage.hidecookiebar !== '1') {
                $('#cookie-notice').hide();
                localStorage.hidecookiebar='1';
            }  
        });
        if(localStorage.hidecookiebar == '1') {
            $('#cookie-notice').hide();
        };
    })(jQuery);
  </script>
  <script type="text/javascript">
  window.onload = function(){
      setTimeout(function(){
          document.getElementById("fadein").remove();
      },1000);
  };
  </script>
  <script type="text/javascript">
    $(window).on('load', function() {
        $("#loader-wrapper").fadeOut(700);
    });
  </script>
  <script src="app.js"></script>
</body>
</html>