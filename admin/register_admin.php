<?php
session_start();
require_once '../config.php';

// hanya admin yang boleh akses
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (strlen($username) < 3) $errors[] = "Username minimal 3 karakter";
    if (strlen($password) < 6) $errors[] = "Password minimal 6 karakter";

    if (!$errors) {

        // cek username sudah ada
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->fetch()) {
            $errors[] = "Username sudah terdaftar";
        } else {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare(
                "INSERT INTO users (username, password_hash, role) VALUES (?, ?, 'admin')"
            );
            $stmt->execute([$username, $hash]);

            $success = "Admin baru berhasil dibuat!";
        }
    }
}
?>





<!DOCTYPE html>
<html>
<head>
    <title>Register Admin</title>
</head>
<body>

<h2>Tambah Admin Baru</h2>

<?php if (!empty($errors)): ?>
    <div style="color:red;">
        <?= implode("<br>", $errors) ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div style="color:green;">
        <?= $success ?>
    </div>
<?php endif; ?>

<form method="post">
    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Buat Admin</button>
</form>

<br>
<a href="dashboard_admin.php">Kembali ke Dashboard</a>

</body>
</html>
