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
$stmt = $pdo->prepare('SELECT id, username, password_hash, COALESCE(role, "user") AS role FROM users WHERE username = ?');
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user) {
    if (password_verify($password, $user['password_hash'])) {
        // Password benar, login sukses
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role']
        ];

        if ($user['role'] === 'admin') {
            header('Location: admin/dashboard_admin.php');
        } else {
            header('Location: dashboard.php');
        }
        exit;
    } else {
        // Password salah
        header('Location: index.php?error=1');
        exit;
    }
} else {
    // User tidak ditemukan
    header('Location: index.php?error=1');
    exit;
}
?>
