# 📚 SiPinjam — Sistem Informasi Peminjaman Buku Perpustakaan

Aplikasi berbasis web untuk mendigitalkan pengelolaan perpustakaan sekolah/instansi — mulai dari pencatatan koleksi buku, data anggota, hingga proses peminjaman dan pengembalian — dibangun menggunakan **Laravel** dan **MySQL**, dengan tampilan **Tailwind CSS**.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)
![Tailwind](https://img.shields.io/badge/TailwindCSS-38B2AC?style=flat&logo=tailwind-css&logoColor=white)

---

## 📖 Tentang Project

Pengelolaan perpustakaan secara manual sering merepotkan petugas dalam mencatat stok buku dan melacak siapa saja yang sedang meminjam. **SiPinjam** hadir sebagai solusi terpusat: satu sistem dengan pembagian akses jelas antara **Admin** dan **Anggota/User**, masing-masing dengan fungsi sesuai perannya.

---

## 🎯 Tujuan

- Mempermudah pencatatan data buku dan anggota
- Mengotomasi proses peminjaman & pengembalian
- Mengurangi pencatatan manual berbasis kertas
- Menerapkan sistem hak akses berdasarkan role

---

## ✨ Fitur

### 🔐 Autentikasi
- Login, Register, dan Logout
- Manajemen session pengguna
- Pembagian akses berdasarkan role (Admin/Anggota)

### 👨‍💼 Panel Admin
- **Dashboard** — ringkasan statistik buku, anggota, dan peminjaman aktif
- **Kelola Buku (CRUD)** — tambah, edit, hapus, serta atur stok, kategori, dan kode buku
- **Kelola Anggota** — lihat dan atur data seluruh akun pengguna
- **Kelola Peminjaman** — pantau seluruh transaksi dan perbarui status pengembalian

### 👤 Panel Anggota/User
- Melihat katalog buku dengan info stok real-time
- Meminjam buku secara mandiri dengan batas waktu pengembalian otomatis
- Melihat riwayat peminjaman pribadi (aktif & sudah dikembalikan)
- Mengembalikan buku langsung dari dashboard pribadi

---

## 🛠️ Teknologi

| Komponen | Teknologi |
|---|---|
| Bahasa | PHP |
| Framework | Laravel |
| Database | MySQL / MariaDB |
| Template Engine | Blade |
| Styling | Tailwind CSS |
| Asset Bundler | Vite |
| Dependency Manager | Composer, NPM |

---

## ⚙️ Kebutuhan Sistem

- PHP >= 8.1
- Composer >= 2.0
- Node.js & NPM
- MySQL / MariaDB
- Web server (Apache/Nginx) — atau cukup `php artisan serve` untuk lokal

---

## 🚀 Instalasi

**1. Clone repository**
```bash
git clone https://github.com/username/nama-repo.git
cd nama-repo
```

**2. Install dependency**
```bash
composer install
npm install
```

**3. Siapkan file environment**
```bash
cp .env.example .env
```
Sesuaikan konfigurasi database pada `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

**4. Generate application key**
```bash
php artisan key:generate
```

**5. Migrasi & seeder database**
```bash
php artisan migrate --seed
```

**6. Jalankan aplikasi**

Buka dua terminal:
```bash
# Terminal 1 — server Laravel
php artisan serve

# Terminal 2 — build asset
npm run dev
```

Akses aplikasi di: `http://127.0.0.1:8000`

---

## 🔑 Akun Uji Coba

| Role | Email | Password |
|---|---|---|
| Admin | admin@perpustakaan.com | password |
| Anggota | anggota@perpustakaan.com | password |

> ⚠️ Wajib diganti setelah instalasi demi keamanan.

---

## 🧭 Alur Penggunaan

1. **Login/Registrasi** — anggota baru membuat akun, yang sudah punya akun tinggal login.
2. **Meminjam buku** — pilih buku dari katalog yang tersedia, klik **Pinjam**; data otomatis masuk ke riwayat peminjaman dan stok berkurang.
3. **Mengembalikan buku** — dari halaman riwayat, klik **Kembalikan**; status berubah jadi *Dikembalikan* dan stok bertambah kembali.
4. **Kelola sistem (Admin)** — masuk ke `/admin/dashboard` untuk kontrol penuh atas data buku, anggota, dan transaksi.

---

## 📄 Lisensi

Project ini dibuat untuk kebutuhan pembelajaran, dirilis dengan lisensi **MIT** — bebas digunakan dan dimodifikasi sesuai kebutuhan.