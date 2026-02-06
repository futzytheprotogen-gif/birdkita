# BirdKita - Login demo

Instruksi singkat untuk menjalankan di Laragon:

1. Copy folder ini ke `C:\laragon\www\birdkita` (sudah dilakukan jika Anda menggunakan workspace ini).
2. Jalankan Laragon -> Start All (Apache + MySQL).
3. Import database: ada dua pilihan yang aman:
   - Gunakan file minimal `birdkita_fixed.sql` (direkomendasikan) via phpMyAdmin (`http://localhost/phpmyadmin`) atau command line:
     mysql -u root < "C:\\laragon\\www\\birdkita\\birdkita_fixed.sql"
   - Atau buka `http://localhost/birdkita/import.php` dan klik **Run Import** (script akan memilih `birdkita_fixed.sql` bila ada, atau `birdkita.sql` sebagai fallback).
4. Akses di browser: `http://localhost/birdkita`.
5. Daftar akun lewat halaman `Register` lalu login.

Keamanan & catatan:
- Password disimpan menggunakan `password_hash` dan diverifikasi dengan `password_verify`.
- Sesuaikan user/password DB di `config.php` jika Anda mengubah setting Laragon.
- Untuk mempercantik tampilan, ganti `assets/logo.svg` dan `assets/parrot.svg` dengan gambar yang Anda suka.

Selamat mencoba!