<?php
session_start();

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: index.php"); // reload main page
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<meta property="og:type" content="website">
<meta property="og:title" content="jayjoke's website">
<meta property="og:description" content="i made a website bc why not, check my spicy nudes on this website!">
<meta property="og:image" content="pages/photos/1b0563a8ca069a2eace283818af7fd4e.jpg">
<meta property="og:url" content="http://tingler.farted.net/">
<meta charset="UTF-8">
<title>jayjoke's website</title>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    #user-info button,
#user-info a button {
    font-family: MyFont;
    font-size: 14px;
    padding: 6px 12px;
    margin: 2px;
    border: none;
    border-radius: 8px;
    background-color: #000; /* black background */
    color: #fff; /* white text */
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
}

#user-info button:hover,
#user-info a button:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0,0,0,0.4);
}

#user-info form {
    display: inline; /* keep logout button inline with username */
}

  body {
    height: 100%;
    font: MyFont;
  }

  h1, h2, h3, h4, h5, h6, p, a, span, div {
    font-family: MyFont;
  }

  @media (max-width: 980px) {
  #layout {
    flex-direction: column; 
    align-items: center;      
    text-align: center;       
  }
  #content-box {
        width: 700px;
  }

}

@media (max-width: 980px) {
    #layout {
        flex-direction: column !important;
        align-items: center;  
        padding: 10px;      
    }

    #content {
        width: 95vw;        
        max-width: 700px;   
        margin: 0;         
        box-sizing: border-box; 
    }

    #content-box {
        width: 100%;          
        box-sizing: border-box;
    }

    .hide-on-small {
        display: none !important;
        visibility: hidden !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 0 !important
        flex: 0 0 0 !important;
    }
    #navbar { 
    }
    .snoopy {
      display: none !important;}
}
#hamburger {
    display: none;
    font-size: 32px;
    padding: 8px 12px;
    background: #000;
    color: #fff;
    border: none;
    cursor: pointer;
    width: 100%;
    text-align: left;
}

@media (max-width: 980px) {

    #hamburger {
        display: block;
        text-align: center;
        background-color: #f3f3f3;
        color: #000;
        border-bottom: 1px solid #ccc;
    }

    #navbar {
        display: none !important;   
        flex-direction: column !important;
        width: 100%;
        background: #f3f3f3;
        border-bottom: 1px solid #000;
        
    }

    #navbar.show {
        display: flex !important;
    }

    #navbar a {
        padding: 18px;
        border-bottom: 1px solid #ccc;
        width: auto;
        text-align: left;
    }

}



#nudes-popup {
    position: fixed;
    top: 130px;
    left: 0;
    width: 300px;
    height: auto;
    opacity: 1;
    transform: translate(-100%, 0) scale(1); 
    transition: transform 0.6s ease-out, opacity 0.6s ease-out;
    z-index: 9999;
    pointer-events: none;
}

#nudes-popup.show {
    opacity: 1;
    transform: translate(0, 0) scale(1);
}

#nudes-popup.hide {
    opacity: 1;
    transform: translate(-100%, 0) scale(1); 
}

#nudes-popup img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

#explicit-symbol {
  max-width: 2px;
  max-height: 2px;
}

#snow-container {
    pointer-events: none; 
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999; 
    overflow: hidden;
}

.snowflake {
    position: absolute;
    top: -50px;
    color: white;
    font-size: 8px;
    user-select: none;
    pointer-events: none;
    animation-name: fall;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    color: #000;
}

@keyframes fall {
    0% { transform: translateY(0) rotate(0deg); opacity: 1; }
    100% { transform: translateY(100vh) rotate(360deg); opacity: 0.8; }
}

.cursor-particle {
    position: fixed;
    pointer-events: none;
    user-select: none;
    z-index: 999999; 
    opacity: 1;
    font-size: 14px;
    animation: particleFade 0.8s linear forwards;
}

@keyframes particleFade {
    from { opacity: 1; transform: translateY(0) scale(1); }
    to   { opacity: 0; transform: translateY(-20px) scale(0.5); }
}

.snow-cap {
    position: absolute;
    top: -6px;
    left: 0;
    width: 100%;
    height: 0;
    background: white;
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
    filter: drop-shadow(0px 2px 2px rgba(0,0,0,0.15));
    pointer-events: none;
    z-index: 999;
    transition: height 1s ease-out;
    overflow: hidden;
}

.snow-cap::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 150%;
    background: radial-gradient(white 40%, rgba(255,255,255,0) 70%);
    opacity: 0.7;
}

#navbar,
.profile-frame,
.content-box {
    position: relative;
    overflow: visible;
}

.socials {
    text-align: center;
    margin: 50px 0;
    padding-bottom: 35px;
}

.social {
    display: inline-block;
    margin: 0 15px;
    width: 40px;
    height: 40px;
    transition: transform 0.2s, filter 0.2s;
}

.social:hover {
    transform: scale(1.2);
}


.social.discord:hover {
    filter: drop-shadow(0 0 15px #7289da); 
}

.social.snapchat:hover {
    filter: drop-shadow(0 0 15px #fffc00); 
}

.social.tiktok:hover {
    filter: drop-shadow(0 0 15px #69c9d0); 
    
}

.social.instagram:hover {
    filter: drop-shadow(0 0 15px #e1306c); 
}

.icon {
    width: 100%;
    height: 100%;
}

#mc-status-box {       
    padding 20px;      
    background-image:
    linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)),
    url('https://www.filterforge.com/filters/11635-v2.jpg');
    background-size: 48px 48px;
    background-repeat: repeat;
    border: 4px solid #2b1e13;
    border-radius: 10px;
    box-shadow: 0 0 12px rgba(0,0,0,0.5);
    text-align: center;
    color: white;
    
}


.vaulted {
    display: none !important;
    visibility: hidden !important;
    margin: 0 !important;
    padding: 0 !important;
    width: 0 !important
    flex: 0 0 0 !important;
}

</style>



<body> <div id="snow-container"></div>

<div id="user-info">
<?php if(isset($_SESSION['username'])): ?>
    Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?>
    <form method="POST" style="display:inline;">
        <button type="submit" name="logout">Logout</button>
    </form>
<?php else: ?>
    <a href="login.php"><button>Login / Register</button></a>
<?php endif; ?>
</div>

<div id="banner">Resolving ongoing issues<br><PROGRESS value="12" max="100"></PROGRESS></div>
<button id="hamburger">☰</button>
<div id="navbar">
  <a href="?page=home" data-page="home.php">Home</a>
  <a href="?page=about" data-page="about.php">About/Updates</a>
  <a href="?page=projects" data-page="projects.php">Projects</a>
  <a href="?page=tools" data-page="tools.php">Tools</a>
  <a href="?page=explore" data-page="explore.php">Explore UGP</a>
  <a href="?page=page_editor" data-page="page_editor.php">Upload</a>
  <a href="?page=nudes" data-page="nudes.php">my nudes 😳🌶️</a>
</div>

<div id="layout">
  <div id="nudes-popup">
    <img src="nudes.png" alt="nudes">
</div>
  <img class="snoopy" src="assets/snoopy.png" alt="Snoopy">
  <div id="profile">
    <div class="vaulted">
      <img style="border: 3px solid black;" class="pfp" src="https://cdn.discordapp.com/avatars/1375505838092976161/f0b88ce7f56f8bdb4fd79e45e1b3fe86.webp?size=4096" alt="Profile">
      <div id="pfp-hover-text">My Discord PFP</div>
    </div>
  </img>
    <p class="vaulted" class="cf"><cf>jayjoke</cf></p>
    
    <div id="music-player-container">
        <div id="album-cover-container">
            <img class="album-cover" src="storage/mockup@1x.png" alt="Album Cover">
            <div id="hover-text">its the jolly season! ❄️❤️</div>
        </div>
        <div class="songmarquee">
          <span id="song-title">A Nonsense Christmas - Sabrina Carpenter<br><br></span>
        </div>
        <div id="music-player">
            <audio id="audioPlayer" autoplay>
                <source src="storage/anonsensechristmas.mp3" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
            <button id="pauseBtn">⏸️</button>
        </div>
    </div>
  </div>
  <div id="content" class="lined-thick">
  <div id="content-box">
    <?php
      // Determine which page to show
      $page = isset($_GET['page']) ? $_GET['page'] : 'home';

      // Only allow known pages for security
      $allowed_pages = ['home', 'about', 'projects', 'tools', 'nudes', 'qr'];

      if (!in_array($page, $allowed_pages)) {
          echo "<p>Page not found.</p>";
      } else {
          if ($page === 'qr') {
              // Include the QR page directly in the content frame
              include 'pages/qr.php';
          } else {
              // For other pages, you can still use your dynamic JS loader
              echo "Loading…"; // JS will fetch pages/[page].php into #content-box
          }
      }
    ?>
  </div>
</div>

</div>
</div>
</div>



<script src="script.js"></script>
<!-- Socials Section -->
<div class="socials">
    <a href="https://discord.com/users/1375505838092976161" target="_blank" class="social discord">
        <img src="assets/icons/discord.svg" alt="Discord" class="icon">
    </a>

    <a href="https://snapchat.com/add/jayd.069" target="_blank" class="social snapchat">
        <img src="assets/icons/snapchat.svg" alt="Snapchat" class="icon">
    </a>

    <a href="https://tiktok.com/@jayd.069" target="_blank" class="social tiktok">
        <img src="assets/icons/tiktok.svg" alt="TikTok" class="icon">
    </a>

    <a href="https://instagram.com/jayd.069" target="_blank" class="social instagram">
        <img src="assets/icons/instagram.svg" alt="Instagram" class="icon">
    </a>
</div>


</div>



</body>
  

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="libs/qr.js"></script>

</html>
