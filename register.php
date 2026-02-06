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
        // cek apakah username sudah ada
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $errors[] = 'Username sudah terdaftar';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (username, password_hash, created_at) VALUES (?, ?, NOW())');
            $stmt->execute([$username, $hash]);
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
  <title>Register - BirdKita</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="page">
    <div class="card">
      <div class="card-left">
        <h1>CREATE ACCOUNT</h1>
        <p class="muted">have account? <a href="index.php">Login</a></p>
        <?php if ($errors): ?>
          <div class="errors"><?=implode('<br>', array_map('htmlspecialchars', $errors))?></div>
        <?php endif; ?>
        <form method="post" class="form">
          <label>USERNAME</label>
          <input name="username" required>
          <label>PASSWORD</label>
          <input type="password" name="password" required>
          <button class="btn" type="submit">Create</button>
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