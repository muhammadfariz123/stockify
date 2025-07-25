# 📦 Stockify - Sistem Manajemen Stok Gudang

<div align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
  <img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
</div>

<div align="center">
  <h3>🚀 Aplikasi manajemen inventaris berbasis Laravel yang powerful dan user-friendly</h3>
  <p>Dirancang khusus untuk mempermudah pengelolaan stok barang dengan sistem role-based access yang fleksibel</p>
</div>

---

## ✨ Fitur Unggulan

### 🔐 **Multi-Role Access Control**
- **Admin** - Kontrol penuh sistem dan manajemen user
- **Manager Gudang** - Oversight operasional dan approval
- **Staff Gudang** - Operasional harian dan input data

### 📊 **Dashboard & Reporting**
- Dashboard real-time dengan statistik terkini
- Laporan komprehensif (Stok, Transaksi, Audit Trail)
- Export laporan ke format PDF yang profesional
- Grafik dan visualisasi data yang interaktif

### 🧾 **Manajemen Transaksi**
- ✅ Transaksi masuk barang dengan detail supplier
- ✅ Transaksi keluar barang dengan tracking tujuan
- ✅ Riwayat transaksi yang dapat difilter dan dicari
- ✅ Validasi stok otomatis untuk mencegah overselling

### 📦 **Manajemen Inventaris**
- Katalog produk dengan kategori yang terstruktur
- Atribut produk yang fleksibel (ukuran, warna, dll)
- Sistem barcode/SKU untuk tracking yang akurat
- Manajemen multi-lokasi gudang

### 🛠️ **Tools Operasional**
- **Stok Opname** - Audit fisik vs sistem
- **Notifikasi Otomatis** - Alert stok menipis/habis
- **History Tracking** - Log semua aktivitas sistem
- **Backup & Recovery** - Keamanan data terjamin

---

## 🚀 Quick Start Guide

### 📋 Prerequisites
- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL/MariaDB
- Web Server (Apache/Nginx)

### 1️⃣ **Clone Repository**
```bash
git clone https://github.com/muhammadfariz123/stockify.git
cd stockify
```

### 2️⃣ **Install Dependencies**
```bash
# Backend dependencies
composer install

# Frontend dependencies
npm install
```

### 3️⃣ **Environment Setup**
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4️⃣ **Database Configuration**
Edit file `.env` dengan konfigurasi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stock
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5️⃣ **Database Migration & Seeding**
```bash
# Jalankan migration dan seeder
php artisan migrate --seed
```

> 🎉 **Seeder akan membuat akun default:**
> - **Admin:** admin@stockify.com | password: `password`
> - **Manager:** manager@stockify.com | password: `password`  
> - **Staff:** staff@stockify.com | password: `password`

### 6️⃣ **Asset Compilation**
```bash
# Development mode (dengan hot reload)
npm run dev

# Production build
npm run build
```

### 7️⃣ **Launch Application**
```bash
# Start Laravel development server
php artisan serve
```

🌐 **Akses aplikasi di:** [http://localhost:8000](http://localhost:8000)

---

## 👥 Testing Accounts

| Role | Email | Password | Akses Level |
|------|-------|----------|-------------|
| 🔑 **Admin** | admin@stockify.com | `password` | Full Access |
| 📊 **Manager** | manager@stockify.com | `password` | Operational Management |
| 👤 **Staff** | staff@stockify.com | `password` | Daily Operations |

---

## 📁 Struktur Proyek

```
stockify/
├── 📂 app/
│   ├── Http/Controllers/     # Logic controllers per role
│   ├── Models/              # Eloquent models
│   └── Providers/           # Service providers
├── 📂 resources/
│   ├── views/
│   │   ├── admin/          # Admin dashboard views
│   │   ├── manager/        # Manager dashboard views
│   │   └── staff/          # Staff dashboard views
│   └── js/                 # Frontend JavaScript
├── 📂 database/
│   ├── migrations/         # Database schema
│   └── seeders/           # Data seeders
├── 📂 routes/
│   └── web.php            # Role-based routing
└── 📂 public/
    └── assets/            # Compiled assets
```

---

## 🛠️ Tech Stack

| Technology | Purpose | Version |
|------------|---------|---------|
| **Laravel** | Backend Framework | ^10.0 |
| **PHP** | Server Language | ^8.1 |
| **MySQL** | Database | ^8.0 |
| **Vite** | Asset Bundling | ^4.0 |
| **Bootstrap** | UI Framework | ^5.3 |
| **jQuery** | DOM Manipulation | ^3.6 |

---

## 📸 Screenshots

<div align="center">
  <img src="https://via.placeholder.com/800x400/0066cc/ffffff?text=Dashboard+Overview" alt="Dashboard" width="45%">
  <img src="https://via.placeholder.com/800x400/28a745/ffffff?text=Inventory+Management" alt="Inventory" width="45%">
</div>

---

## 🤝 Contributing

Kontribusi sangat diterima! Ikuti langkah berikut:

1. **Fork** repository ini
2. **Create** feature branch (`git checkout -b feature/AmazingFeature`)
3. **Commit** perubahan (`git commit -m 'Add some AmazingFeature'`)
4. **Push** ke branch (`git push origin feature/AmazingFeature`)
5. **Open** Pull Request

### 📝 Contribution Guidelines
- Ikuti PSR-12 coding standard
- Tambahkan tests untuk fitur baru
- Update dokumentasi jika diperlukan
- Pastikan semua tests pass

---

## 📄 License

Proyek ini dilisensikan di bawah **MIT License** - lihat file [LICENSE](LICENSE) untuk detail.

---

## 👤 Author & Contact

<div align="center">
  <img src="https://github.com/muhammadfariz123.png" width="100" style="border-radius: 50%;" alt="Muhammad Fariz">
  
  **Muhammad Fariz**
  
  [![GitHub](https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white)](https://github.com/muhammadfariz123)
  [![Email](https://img.shields.io/badge/Email-D14836?style=for-the-badge&logo=gmail&logoColor=white)](mailto:muhammadfariz123@example.com)
  [![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)](https://linkedin.com/in/muhammadfariz123)
</div>

---

## 🌟 Show Your Support

Jika proyek ini membantu Anda, berikan ⭐ di repository ini!

<div align="center">
  <img src="https://img.shields.io/github/stars/muhammadfariz123/stockify?style=social" alt="Stars">
  <img src="https://img.shields.io/github/forks/muhammadfariz123/stockify?style=social" alt="Forks">
  <img src="https://img.shields.io/github/watchers/muhammadfariz123/stockify?style=social" alt="Watchers">
</div>

---

<div align="center">
  <p>Made with ❤️ for efficient warehouse management</p>
  <p>© 2024 Stockify. All rights reserved.</p>
</div>
