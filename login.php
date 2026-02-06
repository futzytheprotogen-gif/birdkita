<?php
session_start();
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
if ($username === '' || $password === '') {
    header('Location: index.php?error=1');
    exit;
}
$stmt = $pdo->prepare('SELECT id, username, password_hash FROM users WHERE username = ?');
$stmt->execute([$username]);
$user = $stmt->fetch();
if ($user && password_verify($password, $user['password_hash'])) {
    // login sukses
    $_SESSION['user'] = ['id' => $user['id'], 'username' => $user['username']];
    header('Location: dashboard.php');
    exit;
} else {
    header('Location: index.php?error=1');
    exit;
}
?>