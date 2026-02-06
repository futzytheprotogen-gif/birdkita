<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - BirdKita</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="page">
    <div class="card">
      <div class="card-left">
        <h1>WELCOME BACK!</h1>
        <p class="muted">Don't have a account? <a href="register.php">Sign up</a></p>
        <form method="post" action="login.php" class="form">
          <label>USERNAME</label>
          <input name="username" required autocomplete="username">
          <label>PASSWORD</label>
          <input type="password" name="password" required autocomplete="current-password">
          <button class="btn" type="submit">Login</button>
        </form>
      </div>
      <div class="card-right">
        <div class="logo-wrap">
          <img class="logo" src="assets/lambang.png" alt="BirdKita">
        </div>
        <div class="socials" aria-label="social links">
          <a class="icon" href="#" title="WhatsApp"><img src="assets/wa.svg" alt="WhatsApp"></a>
          <a class="icon" href="#" title="Instagram"><img src="assets/ig.svg" alt="Instagram"></a>
          <a class="icon" href="#" title="Facebook"><img src="assets/facebook.svg" alt="Facebook"></a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>