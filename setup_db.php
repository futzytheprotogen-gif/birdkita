<?php
/**
 * Database Setup Script
 * Jalankan file ini sekali untuk membuat database dan tabel
 */

require_once 'config.php';

try {
    echo "🔧 Memulai setup database...\n\n";

    // 1. Buat tabel users
    echo "📝 Membuat tabel users...";
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) UNIQUE NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    echo " ✓\n";

    // 2. Buat tabel winners (burung)
    echo "📝 Membuat tabel winners (burung)...";
    $pdo->exec("CREATE TABLE IF NOT EXISTS winners (
        id INT AUTO_INCREMENT PRIMARY KEY,
        bird_name VARCHAR(255) NOT NULL,
        bird_type VARCHAR(255) NOT NULL,
        bird_price VARCHAR(100) NOT NULL,
        image_path VARCHAR(255),
        bird_rank VARCHAR(50),
        uploaded_by INT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    echo " ✓\n";

    // 3. Buat tabel orders (pesanan)
    echo "📝 Membuat tabel orders (pesanan)...";
    $pdo->exec("CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        bird_id INT,
        bird_name VARCHAR(255) NOT NULL,
        bird_type VARCHAR(255),
        bird_price VARCHAR(100),
        quantity INT NOT NULL,
        total_price VARCHAR(100),
        status VARCHAR(50) DEFAULT 'Pending',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (bird_id) REFERENCES winners(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    echo " ✓\n";

    echo "\n✅ Setup database berhasil!\n";
    echo "Silakan login dengan akun Anda atau daftar akun baru.\n";

} catch (Exception $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
