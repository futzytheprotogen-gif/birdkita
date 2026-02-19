# 🚀 Quick Start Guide - BirdKita

## ⏱️ Setup dalam 5 Menit!

### Langkah 1: Setup Database (1 min)
```bash
Buka browser → http://localhost/birdkita/setup_db.php
Klik "Setup" atau tunggu otomatis
✓ Database dan tabel siap!
```

### Langkah 2: Buat Akun (1 min)
```bash
Buka → http://localhost/birdkita/register.php
- Username: cobabirdkita
- Password: 123456
Klik "DAFTAR"
✓ Akun berhasil dibuat!
```

### Langkah 3: Login (30 detik)
```bash
Buka → http://localhost/birdkita/index.php
- Username: cobabirdkita  
- Password: 123456
Klik "LOGIN"
✓ Selamat datang di dashboard!
```

### Langkah 4: Main sebagai User (2 min)
```
Di Dashboard:
- 📋 Klik "Galeri" → Lihat burung
- 🔍 Cari dengan search box
- 🐦 Klik item → Detail modal
- 🛒 Isi jumlah → Beli
- 📦 Klik "Pesanan" → Lihat status
- 👤 Klik "Profil" → Info akun
```

### Langkah 5: Admin Panel (Optional)
```
Buat akun lagi dengan username "admin":
- Username: admin
- Password: 123456

Login as admin:
- Klik "Admin Panel" 
- Upload burung baru
- Approve pesanan
- Create admin baru
```

---

## 🎯 Apa yang Bisa Dilakukan?

### Sebagai User (Regular Member)
✅ Browse 11 jenis burung  
✅ Search burung yang dicari  
✅ Melihat detail dengan harga & penghargaan  
✅ Buat pesanan (quantity 1-10)  
✅ Track pesanan (Pending/Confirmed/Rejected)  
✅ Lihat profil & riwayat pesanan  

### Sebagai Admin
✅ Semua fitur user  
✅ Upload burung baru dengan foto  
✅ Kelola pesanan (approve/reject)  
✅ Buat admin account baru  
✅ Lihat statistik (3 card dashboard)  

---

## 📱 Test di Mobile

**DevTools Mobile Emulation:**
```
1. Buka DevTools (F12)
2. Toggle device toolbar (Ctrl+Shift+M)
3. Pilih device:
   - iPhone SE (375px)
   - iPad (768px)
   - Android (412px)
4. Test hamburger menu ✓
5. Test semua halaman
```

---

## 🎨 Feature Highlights

| Feature | Status | Notes |
|---------|--------|-------|
| 🔐 Login/Register | ✅ | Aman dengan password hashing |
| 📱 Mobile Menu | ✅ | Hamburger menu responsif |
| 🐦 Bird Gallery | ✅ | Carousel smooth + search |
| 🛒 Order System | ✅ | Tracking with status |
| 👨‍💼 Admin Panel | ✅ | Upload, manage, create admin |
| 🎨 Design | ✅ | Tema hijau-kuning professional |
| 📊 Responsive | ✅ | Desktop, tablet, mobile |

---

## 🆘 Troubleshooting

### "Koneksi database gagal"
```
✓ Pastikan Laragon running (Start All)
✓ Jalankan setup_db.php di browser
✓ Check config.php jika perlu custom
```

### "Hamburger menu tidak muncul"
```
✓ Resize window ke < 768px
✓ Clear cache browser (Ctrl+Shift+Del)
✓ F12 → Console cek error
```

### "Foto burung tidak upload"
```
✓ File format: JPG, PNG, atau WebP
✓ File size < 5MB
✓ Folder uploads/ harus writable
```

### "Pesanan tidak muncul"
```
✓ Refresh halaman
✓ Periksa user sudah login
✓ Check Database → orders table
```

---

## 📸 Screenshots (Deskripsi)

**Halaman Login**
- Form elegant dengan card design
- Social media icons (WA, IG, Facebook)
- Error message jika login gagal

**Dashboard User**
- Header hijau dengan hamburger menu
- Gallery carousel dengan scroll smooth
- Search box untuk cari burung
- Navigation buttons (Gallery, Orders, Profile)

**Bird Modal**
- Detail lengkap dengan foto
- Quantity input + Beli button
- Responsive di mobile

**Orders Page**
- List pesanan dengan warna status
- Green = Confirmed
- Orange = Pending
- Red = Rejected

**Admin Panel**
- Statistik dashboard (3 kartu)
- Form upload burung
- Order management
- Admin creation form

---

## 🔑 Test Accounts

Buat sendiri dengan cara:
1. Ke register.php
2. Isi username (min 3 char)
3. Isi password (min 6 char)
4. Klik Daftar

Atau gunakan username: `admin` + password: `123456` (buat sendiri)

---

## 📚 Dokumentasi Lengkap

- **README.md** - Setup detail & fitur description
- **IMPLEMENTATION_SUMMARY.md** - Semua perubahan yang dibuat
- **TESTING.md** - Testing procedures & checklist
- **validate.php** - Code validation tool
- **QUICK_START.md** - File ini! 👈

---

## 🎁 Bonus Tips

### Untuk Testing Lebih Cepat:
1. **Multi-browser testing**: Buka 2 browser instances
   - Browser 1: LogIn as User
   - Browser 2: Login as Admin
   - Buat order di User, approve di Admin

2. **Mobile testing**:
   - DevTools emulation vs real device
   - Test touch events
   - Check hamburger menu

3. **Performance testing**:
   - Network throttling di DevTools
   - Check load time
   - Verify images load fast

### Admin Demo:
1. Create dummy bird dengan foto
2. Create multiple orders sebagai different user
3. Approve/reject orders
4. Create new admin

---

## ✅ Checklist Sebelum Go Live

- [ ] Database setup_db.php sudah dijalankan
- [ ] Test di 3 device (desktop, tablet, mobile)
- [ ] Test semua navigation menus
- [ ] Upload test bird dengan foto
- [ ] Create test order
- [ ] Admin approve order
- [ ] Create new admin account
- [ ] Test logout dari semua halaman
- [ ] Clear browser cache
- [ ] Test di 2+ browsers (Chrome, Firefox, Edge)

---

## 🚀 Next Steps

```
1. ✅ Setup selesai
2. ✅ Main sebagai user
3. ✅ Test admin features
4. ✅ Upload burung test
5. 👉 Ready for production!
```

---

## 📞 Support

Butuh bantuan? Ada error?
- 📧 Email: hello@birdkita.com
- 💬 WhatsApp: [Link admin]
- 🐛 Report bug: Create issue di repo

---

**🐦 Happy Testing! 🐦**

Versi: 1.0 | Updated: 2026-02-18 | Status: ✅ Ready
