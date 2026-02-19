# 🐦 BirdKita - Marketplace & Komunitas Burung Indonesia

Platform marketplace interaktif untuk jual-beli dan berbagi informasi tentang burung di Indonesia. Dibangun dengan PHP, MySQL, dan desain responsif modern.

## ✨ Fitur Utama

- **👤 Autentikasi Pengguna**: Registrasi, login, dan manajemen profil
- **🐦 Katalog Burung**: Galeri burung yang dapat dijelajahi dan dicari
- **🛒 Sistem Pemesanan**: Beli burung dengan tracking pesanan real-time
- **⚙️ Admin Panel**: Upload burung, kelola pesanan, dan buat admin baru
- **📱 Responsive Design**: Bekerja sempurna di desktop, tablet, dan mobile
- **🎨 Unified Theme**: Tema konsisten di semua halaman dengan warna hijau-kuning

## 🚀 Cara Memulai

### Prerequisites
- Laragon (atau Apache + MySQL)
- Browser modern (Chrome, Firefox, Edge, Safari)

### Setup Langkah Demi Langkah

1. **Copy Project**
   ```bash
   # Project sudah di C:\laragon\www\birdkita (atau sesuaikan path)
   ```

2. **Jalankan Laragon**
   - Buka Laragon → Klik "Start All" (Apache + MySQL otomatis berjalan)

3. **Setup Database**
   - Buka browser: `http://localhost/birdkita/setup_db.php`
   - Script akan membuat tabel otomatis, atau
   - Manual di phpMyAdmin: `http://localhost/phpmyadmin`

4. **Akses Aplikasi**
   - Buka: `http://localhost/birdkita`
   - Daftar akun baru atau hubungi admin untuk akun demo

### Konfigurasi Database (Optional)

Edit `config.php` jika perlu mengubah:
```php
$host = 'localhost';    // Database host
$db   = 'birdkita_db';  // Database name
$user = 'root';         // Database user
$pass = '';             // Database password
```

## 👥 Tipe Pengguna

### Regular User (Member)
- ✓ Browsing katalog burung
- ✓ Mencari burung berdasarkan jenis/harga
- ✓ Membuat pesanan
- ✓ Tracking status pesanan
- ✓ Lihat profil & riwayat pesanan

### Admin
- ✓ Semua fitur regular user
- ✓ Upload burung baru dengan foto
- ✓ Kelola pesanan (konfirmasi/tolak)
- ✓ Buat admin baru
- ✓ Lihat statistik pengguna

## 📁 Struktur Project

```
birdkita/
├── index.php              # Login page
├── register.php           # Registrasi user
├── login.php              # Proses login
├── logout.php             # Proses logout
├── dashboard.php          # Dashboard user (galeri, pesanan, profil)
├── config.php             # Konfigurasi database
├── style.css              # Stylesheet unified
├── setup_db.php           # Database setup script
├── admin/
│   └── dashboard_admin.php # Admin panel
├── assets/                # Gambar dan icon
│   ├── lambang.png
│   ├── logo.svg
│   ├── parrot.svg
│   ├── wa.svg
│   ├── ig.svg
│   └── facebook.svg
├── uploads/               # Folder untuk foto burung
└── README.md             # File ini
```

## 🎨 Desain & Tema

### Palet Warna
- **Primary**: #3f8a54 (Hijau tua - header)
- **Secondary**: #2b6e3f (Hijau gelap - footer)
- **Accent**: #ffd54a (Kuning - highlight)
- **Success**: #0a0 (Hijau terang)
- **Danger**: #c33 (Merah)
- **Warning**: #f90 (Orange)

### Responsive Breakpoints
- **Desktop**: 1200px+
- **Tablet**: 768px - 1199px
- **Mobile**: < 768px (Menu hamburger aktif)

## 🔐 Keamanan

- ✅ Password di-hash dengan `password_hash()` (bcrypt)
- ✅ Verifikasi dengan `password_verify()`
- ✅ Session-based authentication
- ✅ SQL Injection protection via parameterized queries
- ✅ XSS protection via `htmlspecialchars()`
- ✅ Role-based access control (Admin vs User)

## 📱 Fitur Mobile

- ✓ Hamburger menu otomatis di layar kecil
- ✓ Touch-friendly buttons dan forms
- ✓ Responsive grid untuk galeri burung
- ✓ Optimized scrolling untuk carousel
- ✓ Readable font sizes (min 14px on mobile)

## 🐛 Troubleshooting

### Error "Koneksi gagal"
1. Pastikan MySQL sedang berjalan di Laragon
2. Periksa username/password di `config.php`
3. Pastikan database `birdkita_db` sudah dibuat

### Upload foto tidak berfungsi
1. Pastikan folder `uploads/` ada dan writable: `chmod 755 uploads/`
2. Cek tipe file: JPG, PNG, WebP saja yang diizinkan
3. Max file size: 5MB

### Menu hamburger tidak muncul
1. Clear browser cache
2. Buka DevTools (F12) → Console cek error
3. Pastikan JavaScript diaktifkan

## 📧 Support & Kontak

Untuk pertanyaan atau saran:
- WhatsApp: [Hubungi Admin]
- Instagram: [@birdkita]
- Email: hello@birdkita.com

## 📄 Lisensi

Project ini dibuat untuk komunitas burung Indonesia. Bebas digunakan dan dikembangkan.

---

**Dibuat dengan ❤️ untuk petaruh dan pecinta burung Indonesia**

Versi: 1.0 (2026)
