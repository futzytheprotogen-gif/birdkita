<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

$error = isset($_GET['error']) ? 1 : 0;
$registered = isset($_GET['registered']) ? 1 : 0;
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - BirdKita | Marketplace Burung Indonesia</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="page">
    <div class="card">
      <div class="card-left">
        <h1>Selamat Datang!</h1>
        <p class="muted">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        
        <?php if ($registered): ?>
          <div class="messages">✓ Akun berhasil dibuat! Silakan login.</div>
        <?php endif; ?>
        <?php if ($error): ?>
          <div class="errors">✗ Username atau password salah.</div>
        <?php endif; ?>
        
        <form method="post" action="login.php" class="form">
          <div class="form-group">
            <label for="username">USERNAME</label>
            <input type="text" id="username" name="username" required autocomplete="username" placeholder="Masukkan username Anda">
          </div>
          
          <div class="form-group">
            <label for="password">PASSWORD</label>
            <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda">
          </div>
          
          <button class="btn" type="submit">LOGIN</button>
        </form>
      </div>
      
      <div class="card-right">
        <img class="card-logo" src="assets/lambang.png" alt="BirdKita Logo">
        <div class="socials" aria-label="social links">
          <a class="icon" href="https://wa.me/" title="WhatsApp" target="_blank"><img src="assets/wa.svg" alt="WhatsApp"></a>
          <a class="icon" href="https://instagram.com/" title="Instagram" target="_blank"><img src="assets/ig.svg" alt="Instagram"></a>
          <a class="icon" href="https://facebook.com/" title="Facebook" target="_blank"><img src="assets/facebook.svg" alt="Facebook"></a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>