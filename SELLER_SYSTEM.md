# Sistem Penjualan Burung - BirdKita

Dokumentasi lengkap sistem penjualan burung untuk pengguna yang ingin menjual burung mereka.

## 📋 Daftar Isi

1. [Panduan Penjual](#panduan-penjual)
2. [Alur Penjualan](#alur-penjualan)
3. [Fitur-Fitur](#fitur-fitur)
4. [Database Schema](#database-schema)
5. [API/Endpoints](#apiendpoints)

---

## Panduan Penjual

### Cara Mulai Berjualan

1. **Login ke Dashboard**
   - Buka `dashboard.php` dan login dengan akun Anda
   - Atau klik tombol "Jual Burung" (💼) di menu navigasi

2. **Akses Halaman Penjualan**
   - Klik tombol "Jual Burung" di navigation menu
   - Atau buka `my_listings.php`

3. **Upload Burung Baru**
   - Isi form "Jual Burung Baru" dengan detail:
     - **Nama Burung** (wajib): Nama spesifik burung Anda
     - **Jenis Burung** (wajib): Pilih dari dropdown
     - **Harga** (wajib): Harga dalam Rupiah
     - **Penghargaan/Prestasi**: Opsional (juara, penghargaan)
     - **Deskripsi**: Detail tentang burung (usiaa, karakter, kesehatan)
     - **Foto**: Upload foto burung Anda

4. **Tunggu Persetujuan Admin**
   - Listing akan masuk status "Menunggu Persetujuan"
   - Admin akan review dalam maksimal 24 jam
   - Anda akan lihat notifikasi status di halaman "Daftar Jual"

5. **Listing Dipublikasi**
   - Setelah disetujui, listing muncul di galeri marketplace
   - Pembeli dapat melihat detail dan membeli burung Anda

---

## Alur Penjualan

```
┌─────────────────────────────────────────────────────────┐
│ Penjual Membuat Listing                                 │
│ (my_listings.php - Upload Burung)                       │
└────────────────┬────────────────────────────────────────┘
                 │
                 ▼
┌─────────────────────────────────────────────────────────┐
│ Status: PENDING (Menunggu Persetujuan Admin)            │
│ - Listing tidak terlihat di marketplace                 │
│ - Penjual dapat menghapus atau menunggu persetujuan     │
└────────────────┬────────────────────────────────────────┘
                 │
         ┌───────┴────────┐
         │                │
         ▼                ▼
   ┌──────────────┐  ┌──────────────┐
   │ APPROVED     │  │ REJECTED     │
   | Dipublikasi  |  | Ditolak      |
   └──────┬───────┘  └──────┬───────┘
          │                 │
          │         ┌───────┘
          │         │
          ▼         ▼
   ┌─────────────────────────┐
   │ Pembeli Melihat Listing │
   │ (dashboard.php - Galeri)│
   └────────────┬────────────┘
                │
         ┌──────┴──────┐
         │             │
         ▼             ▼
   ┌──────────┐   ┌──────────────┐
   │ Lihat    │   │ Lanjut cari  │
   │ Detail   │   │ listing lain  │
   └────┬─────┘   └──────────────┘
        │
        ▼
   ┌──────────────────────────┐
   │ Detail Page              │
   │ (bird_detail.php)        │
   │ - Lihat foto             │
   │ - Info penjual (nama,HP) │
   │ - Baca ulasan            │
   │ - Chat dengan penjual    │
   │ - Beli sekarang          │
   └────┬─────────────────────┘
        │
        ▼
   ┌──────────────────────┐
   │ Pesanan Dibuat       │
   │ (status: Pending)    │
   │ Admin konfirmasi     │
   │ dalam 24 jam         │
   └──────┬───────────────┘
          │
          ▼
   ┌──────────────────────┐
   │ Penjual & Pembeli    │
   │ - Chat untuk arrange │
   │ - Confirm pengiriman │
   │ - Pembayaran         │
   │ - Shipping           │
   └──────────────────────┘
```

---

## Fitur-Fitur

### 1. **Halaman Penjual (my_listings.php)**

**Komponen:**
- **Statistik Dashboard**
  - Total Listing
  - Menunggu Persetujuan
  - Sudah Dipublikasi

- **Form Upload Listing**
  - Input nama burung, jenis, harga
  - Textarea deskripsi
  - Upload gambar dengan preview

- **List Listing Saya**
  - Card untuk setiap listing
  - Tampilkan status (pending/approved/rejected)
  - Alasan penolakan (jika ditolak)
  - Tombol aksi (hapus/lihat)

**Styling:**
- Grid responsive 3 kolom
- Card design dengan gambar
- Status badge dengan warna berbeda
- Form input styling konsisten

### 2. **Halaman Detail Burung (bird_detail.php)**

**Komponen:**
- **Informasi Burung**
  - Foto besar (carousel)
  - Nama, jenis, harga
  - Penghargaan
  - Tanggal upload

- **Info Penjual**
  - Nama penjual
  - Nomor telepon
  - Alamat

- **Tombol Interaksi**
  - Beli Sekarang
  - Chat Penjual

- **Review & Rating**
  - List ulasan dari pembeli
  - Rating bintang 5
  - Form add review (untuk pembeli yang sudah membeli)

**Styling:**
- 2 kolom: foto kiri, info kanan
- Transparent header dengan blur
- Review item dengan border left accent color

### 3. **Admin Dashboard - Seller Approval**

**Komponen:**
- **Statistik Baru**
  - Listing Menunggu Persetujuan
  - Total Penjual
  - Total Listing Aktif

- **Approval Section**
  - Grid listing menunggu
  - Preview gambar & info
  - Tombol Setujui/Tolak
  - Modal untuk alasan penolakan

**Styling:**
- Card design dengan border warning
- Tombol aksi dual (approve/reject)
- Notification modal untuk reason

---

## Database Schema

### Table: `seller_listings`

```sql
CREATE TABLE seller_listings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    bird_name VARCHAR(255) NOT NULL,
    bird_type VARCHAR(255),
    bird_price VARCHAR(100),
    bird_rank VARCHAR(100),
    description TEXT,
    image_path VARCHAR(255),
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    rejection_reason TEXT,
    created_at DATETIME,
    updated_at DATETIME,
    KEY user_id (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
```

**Field Explanation:**
- `id`: Primary key, auto-increment
- `user_id`: Foreign key ke users table (penjual)
- `bird_name`: Nama burung yang dijual
- `bird_type`: Jenis burung (Lovebird, Parrot, dll)
- `bird_price`: Harga dalam Rupiah (string untuk handling format)
- `bird_rank`: Penghargaan/prestasi burung (opsional)
- `description`: Deskripsi detail burung
- `image_path`: Path ke file gambar di uploads folder
- `status`: Status listing (pending/approved/rejected)
- `rejection_reason`: Alasan jika ditolak
- `created_at`: Waktu listing dibuat
- `updated_at`: Waktu listing diupdate

---

## API/Endpoints

### User Seller Endpoints

**GET** `/my_listings.php`
- Menampilkan halaman daftar penjualan user
- Membutuhkan: Session user yang login
- Menampilkan: Form upload + list listing saya

**POST** `/my_listings.php`
- Action: `upload_listing` - Upload listing baru
  - Fields: bird_name, bird_type, bird_price, bird_rank, description, image
  - Response: Message success/error
  
- Action: `delete_listing` - Hapus listing (hanya status pending)
  - Fields: listing_id
  - Response: Message success/error

**GET** `/bird_detail.php?id={listing_id}`
- Menampilkan detail listing/burung
- Menampilkan: Info burung, penjual, review, tombol beli

**POST** `/bird_detail.php`
- Action: `buy_bird` - Buat pesanan
  - Fields: qty
  - Response: Message success
  
- Action: `add_review` - Tambah review (hanya yang sudah beli)
  - Fields: rating, comment
  - Response: Message success

---

## Admin Endpoints

**POST** `/admin/dashboard_admin.php`
- Action: `approve_listing` - Setujui listing
  - Fields: listing_id
  - Response: Update status jadi 'approved'

- Action: `reject_listing` - Tolak listing
  - Fields: listing_id, rejection_reason
  - Response: Update status jadi 'rejected' + simpan alasan

---

## File Structure

```
birdkita/
├── my_listings.php          # Halaman penjual untuk manage listing
├── bird_detail.php          # Halaman detail burung individual
├── dashboard.php            # Updated dengan link ke my_listings
├── admin/
│   └── dashboard_admin.php  # Updated dengan approval section
├── style.css                # Updated dengan styling baru
├── uploads/                 # Folder untuk menyimpan gambar listing
└── config.php               # DB config (unchanged)
```

---

## CSS Classes

### New Component Classes

**Seller Listings:**
- `.seller-listings` - Container listing
- `.listing-card` - Individual listing item
- `.listing-status` - Status badge
- `.listing-image` - Container gambar

**Bird Detail:**
- `.bird-detail-container` - Main container
- `.bird-info` - Info section
- `.seller-info` - Seller details box
- `.review-item` - Individual review

**Admin Approval:**
- `.pending-listings` - List listing menunggu
- `.approval-card` - Card listing untuk approval
- `.approval-actions` - Action button container

---

## Security Considerations

1. **File Upload Validation**
   - Hanya accept image files (jpg, png, gif)
   - Check MIME type
   - Check file size
   - Store di folder terpisah

2. **SQL Injection Prevention**
   - Gunakan prepared statements
   - Validate input sebelum insert

3. **Session Protection**
   - Check user login sebelum akses
   - Check role untuk admin pages
   - Validate ownership listing sebelum delete

4. **XSS Prevention**
   - Use htmlspecialchars() untuk output
   - Sanitize form input

---

## Future Enhancement Ideas

1. ✨ Bulk upload multiple birds
2. ✨ Seller rating & reputation system
3. ✨ Advanced search filter by seller
4. ✨ Wishlist/bookmark listing
5. ✨ Auto-publish after N days if not rejected
6. ✨ Seller analytics & sales stats
7. ✨ Commission system untuk admin
8. ✨ Monthly featured sellers

---

Generated: 2026 | BirdKita Team
