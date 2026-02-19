<?php
session_start();
require_once 'config.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if (strlen($username) < 3) $errors[] = 'Username minimal 3 karakter';
    if (strlen($password) < 6) $errors[] = 'Password minimal 6 karakter';
    if (empty($errors)) {
    // pastikan kolom role ada
    try {
      $pdo->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS `role` ENUM('user','admin') NOT NULL DEFAULT 'user'");
    } catch (Exception $e) {
      try {
        $col = $pdo->query("SHOW COLUMNS FROM users LIKE 'role'")->fetch();
        if (!$col) {
          $pdo->exec("ALTER TABLE users ADD COLUMN `role` VARCHAR(20) NOT NULL DEFAULT 'user'");
        }
      } catch (Exception $e) {
        // ignore
      }
    }

    // cek apakah username sudah ada
    $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
      $errors[] = 'Username sudah terdaftar';
    } else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $pdo->prepare('INSERT INTO users (username, password_hash, role, created_at) VALUES (?, ?, ?, NOW())');
      $stmt->execute([$username, $hash, 'user']);
      header('Location: index.php?registered=1');
      exit;
    }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Register - BirdKita | Marketplace Burung Indonesia</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="page">
    <div class="card">
      <div class="card-left">
        <h1>Buat Akun</h1>
        <p class="muted">Sudah punya akun? <a href="index.php">Login di sini</a></p>
        <?php if ($errors): ?>
          <div class="errors">
            <?php foreach ($errors as $err): ?>
              ✗ <?= htmlspecialchars($err) ?><br>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        <form method="post" class="form">
          <div class="form-group">
            <label for="username">USERNAME</label>
            <input type="text" id="username" name="username" required placeholder="Pilih username unik Anda">
          </div>
          
          <div class="form-group">
            <label for="password">PASSWORD</label>
            <input type="password" id="password" name="password" required placeholder="Minimal 6 karakter">
          </div>
          
          <button class="btn" type="submit">DAFTAR</button>
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