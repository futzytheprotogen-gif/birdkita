# 📁 Project Structure & File Guide

## 📊 Complete File List

```
birdkita/
│
├── 📄 PHP Core Files
│   ├── index.php                    # Login page (public)
│   ├── register.php                 # Registration page (public)
│   ├── login.php                    # Login processor (hidden)
│   ├── logout.php                   # Logout processor (hidden)
│   ├── dashboard.php                # User dashboard (protected)
│   ├── config.php                   # Database configuration
│   ├── setup_db.php                 # Database setup script
│   └── generate_hash.php            # Utility untuk hash password
│
├── 👨‍💼 Admin Section
│   └── admin/
│       └── dashboard_admin.php      # Admin panel (protected)
│
├── 📦 Assets & Media
│   └── assets/
│       ├── lambang.png              # Logo BirdKita (main)
│       ├── logo.svg                 # Logo SVG (header)
│       ├── parrot.svg               # Default bird image
│       ├── wa.svg                   # WhatsApp icon
│       ├── ig.svg                   # Instagram icon
│       └── facebook.svg             # Facebook icon
│
├── 📸 User Uploads
│   └── uploads/                     # Bird photos folder (dynamic)
│       ├── 1708xxx_xxxxx.jpg        # Bird photo 1
│       ├── 1708xxx_xxxxx.jpg        # Bird photo 2
│       └── ...                      # More bird photos
│
├── 🎨 Styles & Scripts
│   └── style.css                    # Main unified stylesheet (1000+ lines)
│
├── 📚 Documentation
│   ├── README.md                    # Main documentation
│   ├── QUICK_START.md               # Quick setup guide
│   ├── IMPLEMENTATION_SUMMARY.md    # What we built
│   ├── TESTING.md                   # Testing procedures
│   ├── PROJECT_STRUCTURE.md         # This file
│   └── hash.php                     # Hash generator utility
│
├── 🧪 Utilities
│   ├── validate.php                 # Code validation tool
│   ├── test_password.php            # Password hash tester
│   └── generate_hash.php            # Generate password hash
│
└── 📋 Config & Data
    ├── config.php                   # Database connection
    └── .htaccess                    # (optional) URL rewrite rules
```

---

## 📄 File Descriptions

### Core Application Files

#### `index.php` (Login Page)
```
Size: ~3KB
Purpose: Display login form for authentication
Features:
- Form fields (username, password)
- Social media links
- Registration link
- Error messages display
- Responsive card layout
```

#### `register.php` (Registration Page)
```
Size: ~3KB
Purpose: User registration interface
Features:
- Registration form
- Input validation feedback
- Password requirements (min 6)
- Link to login page
- Error display
```

#### `login.php` (Login Processor)
```
Size: ~1KB
Purpose: Process login form submission
Features:
- PDO query with prepared statement
- password_verify() for auth
- Session creation
- Role-based redirect (user/admin)
```

#### `logout.php` (Logout Handler)
```
Size: <1KB
Purpose: Destroy session and redirect
Features:
- session_unset()
- session_destroy()
- Redirect to login
```

#### `dashboard.php` (User Dashboard)
```
Size: ~8KB
Purpose: Main user interface
Features:
- Gallery with carousel
- Search functionality
- Orders page
- Profile page
- Order modal
- Mobile hamburger menu
- 300+ lines of PHP & HTML
```

#### `config.php` (Database Config)
```
Size: ~1KB
Purpose: Database connection setup
Features:
- PDO connection
- Error handling
- Database credentials
- charset configuration (utf8mb4)
```

#### `setup_db.php` (Database Setup)
```
Size: ~3KB
Purpose: Auto-create database tables
Features:
- CREATE TABLE IF NOT EXISTS
- Foreign key relationships
- Auto-increment IDs
- UTF-8 charset
- Status messages
```

### Admin Files

#### `admin/dashboard_admin.php`
```
Size: ~10KB
Purpose: Admin control panel
Features:
- Statistics display
- Bird upload form
- Order management
- Admin creation
- Bird gallery preview
- 300+ lines of PHP & HTML
```

### Styling

#### `style.css` (Main Stylesheet)
```
Size: ~20KB
Purpose: All styling for entire application
Features:
- CSS Variables for theming
- Mobile-first responsive
- 1000+ lines of organized CSS
- Component library
- Animation & transitions
- Hamburger menu styles
- Modal & dialog styles
```

### Documentation

#### `README.md`
```
Content:
- Project overview
- Features list
- Setup instructions
- Database configuration
- User types & permissions
- File structure
- Design system
- Troubleshooting
- Support info
```

#### `QUICK_START.md`
```
Content:
- 5-minute setup
- Basic usage guide
- Feature highlights
- Troubleshooting
- Test accounts
- Bonus tips
```

#### `IMPLEMENTATION_SUMMARY.md`
```
Content:
- Changes made
- CSS modernization
- Page updates
- Design system
- Feature checklist
- Performance notes
```

#### `TESTING.md`
```
Content:
- Feature checklist
- Testing procedures
- Test cases
- Edge cases
- Known issues
- Future enhancements
```

### Utilities

#### `validate.php`
```
Size: ~3KB
Purpose: Code validation & status report
Usage: http://localhost/birdkita/validate.php
Shows:
- File existence check
- Feature checklist
- Design theme
- Security info
```

#### `test_password.php`
```
Purpose: Test password hashing
Usage: For development & debugging
Shows:
- password_hash() output
- password_verify() test
```

#### `generate_hash.php`
```
Purpose: Generate password hashes
Usage: For testing admin accounts
Shows:
- Hash generation
- Copy-paste ready
```

---

## 🗂️ Directory Permissions

```
uploads/          - Must be writable (chmod 755)
                  - For storing bird photos
                  - Auto-created if missing

assets/           - Public readable
                  - Contains images & icons

.gitignore        - Optional, for deployment
                  - Should exclude: config.php (optional)
                  - Should exclude: uploads/*
```

---

## 📊 File Size Summary

```
style.css                    ~20KB  (Largest)
dashboard.php               ~8KB   
admin/dashboard_admin.php   ~10KB  
config.php                  ~1KB   (Smallest)
─────────────────────────────────
Total                       ~80KB  (Without images)
```

---

## 🔄 Data Flow

### User Registration
```
register.php (form display)
    ↓
register.php (form submit) 
    ↓
config.php (database check)
    ↓
users table INSERT
    ↓
index.php (redirect to login)
```

### User Login
```
index.php (form display)
    ↓
login.php (form submit)
    ↓
config.php (database query)
    ↓
password_verify() check
    ↓
$_SESSION creation
    ↓
dashboard.php (redirect)
```

### Admin Upload Bird
```
admin/dashboard_admin.php (form)
    ↓
File upload validation
    ↓
Move file to uploads/
    ↓
config.php (database INSERT)
    ↓
winners table INSERT
    ↓
Notify user (success/error)
```

### User Order
```
dashboard.php (gallery modal)
    ↓
showBirdDetail() JavaScript
    ↓
Buy form submission
    ↓
config.php (bird data fetch)
    ↓
orders table INSERT
    ↓
Notify user (success)
    ↓
Orders page shows new order
```

---

## 💾 Database Schema

### `users` Table
```sql
- id (INT, PK, AI)
- username (VARCHAR 255, UNIQUE)
- password_hash (VARCHAR 255)
- role (ENUM: 'user', 'admin')
- created_at (DATETIME)
```

### `winners` Table (Burung)
```sql
- id (INT, PK, AI)
- bird_name (VARCHAR 255)
- bird_type (VARCHAR 255)
- bird_price (VARCHAR 100)
- image_path (VARCHAR 255)
- bird_rank (VARCHAR 50)
- uploaded_by (INT, FK → users.id)
- created_at (DATETIME)
```

### `orders` Table
```sql
- id (INT, PK, AI)
- user_id (INT, FK → users.id)
- bird_id (INT, FK → winners.id)
- bird_name (VARCHAR 255)
- bird_type (VARCHAR 255)
- bird_price (VARCHAR 100)
- quantity (INT)
- total_price (VARCHAR 100)
- status (VARCHAR 50: Pending/Confirmed/Rejected)
- created_at (DATETIME)
```

---

## 🔐 Protected Pages

```
dashboard.php             - Requires login
admin/dashboard_admin.php - Requires admin role
login.php                 - POST only
```

## 🔓 Public Pages

```
index.php                 - Login form (public)
register.php              - Registration form (public)
logout.php                - Destroy session
validate.php              - Status check
setup_db.php              - Setup script
```

---

## 🛠️ Utilities for Development

### Check System Status
```
http://localhost/birdkita/validate.php
- File check
- Feature checklist
- Theme info
- Security status
```

### Test Password Hashing
```
http://localhost/birdkita/test_password.php
- Hash generation
- Verification test
```

### Generate Hash for Admin
```
http://localhost/birdkita/generate_hash.php
- Input password
- Get hash output
```

---

## 📝 File Naming Convention

```
PHP Files:        lowercase.php
CSS Files:        lowercase.css
Image Files:      descriptive_name.ext
Upload Files:     timestamp_random.ext
Documentation:    UPPERCASE.md
Utilities:        lowercase.php
```

---

## 🚀 Deployment Checklist

- [ ] Config.php updated with live database
- [ ] uploads/ folder exists and writable
- [ ] setup_db.php run on production
- [ ] .htaccess configured (optional)
- [ ] PHP version 7.4+ installed
- [ ] MySQL 5.7+ installed
- [ ] File permissions set correctly
- [ ] SSL certificate installed
- [ ] Backups configured

---

## 📞 File Support Matrix

| File | Purpose | Protected | Size |
|------|---------|-----------|------|
| index.php | Login | No | 3KB |
| register.php | Register | No | 3KB |
| login.php | Auth | No | 1KB |
| logout.php | Logout | No | <1KB |
| dashboard.php | User Dashboard | Yes | 8KB |
| admin/dashboard_admin.php | Admin Panel | Yes | 10KB |
| config.php | Database | Yes | 1KB |
| style.css | Styling | No | 20KB |
| setup_db.php | Setup | No | 3KB |

---

**Last Updated**: February 18, 2026  
**Project Version**: 1.0  
**Documentation Version**: 1.0
