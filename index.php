<!-- Build Date 5, Mon, 2024 -> 6:23AM -->
<!DOCTYPE html>
<html lang="en-us" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <title>PulseContact • Home</title>
  <!-- <script src="https://unpkg.com/swup@2.0.0/dist/swup.min.js"></script> -->
  <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
</head>
<body class="flex">
  <?php include 'includes/header.php'; ?>
  <main class="app-main-content-variants grid transition-slide" id="swup">
    <div class="app-main-content-variants__reviews flex">
      <h1>PulseContact, New Contact Register build for <span>You</span>, <span>Anything</span>, <span>Anywhere.</span></h1>
      <span>This sotware is Open-source, build at <a href="https://">ATP Social by Franck M</a></span>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi quasi molestias est id corporis aliquid cumque facere provident dolor natus modi ipsum quis rerum aliquam illum eaque ut, inventore adipisci. <br>
        <span>To use this software, you need to account.</span>
      </p>
      <div class="flex get-started-container">
        <a  class="button outlined-btn">Learn More</a>
        <a href="includes/authentification.php" class="button primary-btn flex" data-swup>
        Get New Account
        <svg xmlns="http://www.w3.org/2000/svg" id="Bold" viewBox="0 0 24 24" width="512" height="512"><path d="M19.122,18.394l3.919-3.919a3.585,3.585,0,0,0,0-4.95L19.122,5.606A1.5,1.5,0,0,0,17,7.727l2.78,2.781-18.25.023a1.5,1.5,0,0,0-1.5,1.5v0a1.5,1.5,0,0,0,1.5,1.5l18.231-.023L17,16.273a1.5,1.5,0,0,0,2.121,2.121Z"/></svg>  
      </a>
      </div>
    </div>
    <div class="app-main-content-variants__objects flex">
      <dotlottie-player src="https://lottie.host/946b532d-c7dd-4ac7-9388-fd147290b3de/FIy0J41uzR.json" background="transparent" speed="1" style="width: 500px; height: 500px;" loop autoplay></dotlottie-player>
    </div>
  </main>
  <?php include 'includes/footer.php'; ?>
</body>
<script type="module">
  import Swup from 'https://unpkg.com/swup@4?module';
  const swup = new Swup();
</script>
</html>