# 🌿 Herbal Bolaang Mongondow — Dokumentasi Lengkap

Aplikasi identifikasi dan informasi tanaman herbal Indonesia berbasis **Machine Learning** (MobileNetV2), dibangun dengan **Python Flask** sebagai backend ML dan **Laravel** sebagai backend web sekaligus frontend.

---

## 📋 Daftar Isi

1. [Arsitektur Sistem](#arsitektur-sistem)
2. [Persyaratan Sistem](#persyaratan-sistem)
3. [Struktur Folder](#struktur-folder)
4. [Instalasi & Konfigurasi](#instalasi--konfigurasi)
   - [A. Python Backend (Flask ML API)](#a-python-backend-flask-ml-api)
   - [B. Laravel Backend + Frontend](#b-laravel-backend--frontend)
5. [Konfigurasi Database](#konfigurasi-database)
6. [Menjalankan Aplikasi](#menjalankan-aplikasi)
7. [Akun Default](#akun-default)
8. [Fitur Aplikasi](#fitur-aplikasi)
9. [Troubleshooting](#troubleshooting)

---

## 🏗️ Arsitektur Sistem

```
┌─────────────────────────────────────────────────────┐
│                   PENGGUNA / BROWSER                │
└──────────────────────────┬──────────────────────────┘
                           │
                    HTTP (port 80)
                           │
┌──────────────────────────▼──────────────────────────┐
│              LARAVEL (Web + API Backend)             │
│                    localhost:80                      │
│  - Blade Views (Frontend / UI)                       │
│  - Manajemen data (Plants, Diseases, Recipes)        │
│  - Autentikasi (Admin & User)                        │
│  - Proxy ke Flask API                                │
└──────────────────────────┬──────────────────────────┘
                           │
                HTTP (port 5000)
                           │
┌──────────────────────────▼──────────────────────────┐
│              PYTHON FLASK (ML API)                   │
│                  localhost:5000                      │
│  - Model MobileNetV2 (TensorFlow SavedModel)         │
│  - Endpoint: POST /api/predict                       │
│  - Endpoint: GET  /api/health                        │
│  - Endpoint: GET  /api/classes                       │
└─────────────────────────────────────────────────────┘
                           │
              ┌────────────┴────────────┐
              │                         │
┌─────────────▼──────┐    ┌─────────────▼──────────┐
│  MySQL Database     │    │  Model File             │
│  (herbal_db)        │    │  daun_savedmodel/       │
└─────────────────────┘    └────────────────────────┘
```

---

## 💻 Persyaratan Sistem

### Wajib

| Software | Versi Minimum | Keterangan |
|----------|--------------|------------|
| **PHP** | 8.1+ | Untuk Laravel |
| **Composer** | 2.x | Package manager PHP |
| **Node.js** | 16.x+ | Untuk Vite + Tailwind |
| **NPM** | 8.x+ | Sudah termasuk dalam Node.js |
| **MySQL** | 5.7+ / 8.x | Database utama |
| **Python** | 3.9 – 3.11 | Untuk Flask & TensorFlow |
| **pip** | 23.x+ | Package manager Python |

> ⚠️ **TensorFlow 2.15.0 tidak mendukung Python 3.12+**. Gunakan Python **3.9, 3.10, atau 3.11**.

### Opsional (Direkomendasikan)

| Software | Keterangan |
|----------|------------|
| **Git** | Version control |
| **Virtual Environment** (`venv`) | Isolasi dependensi Python |
| **XAMPP / Laragon** | Mudah menjalankan PHP + MySQL di Windows |

---

## 📁 Struktur Folder

```
tanaman herbal/
├── python/                          # Backend Python (Flask ML API)
│   ├── app.py                       # Entry point Flask
│   ├── requirements.txt             # Dependensi Python
│   └── daun_savedmodel/             # Model TensorFlow SavedModel
│       ├── saved_model.pb
│       ├── fingerprint.pb
│       ├── assets/
│       └── variables/
│
└── web/                             # Backend + Frontend Laravel
    ├── app/
    │   ├── Http/
    │   │   ├── Controllers/         # Logic tiap halaman
    │   │   └── Middleware/          # Auth & Admin middleware
    │   └── Models/                  # Eloquent ORM models
    ├── database/
    │   ├── migrations/              # Skema database
    │   └── seeders/                 # Data awal (plants, diseases, dll)
    ├── resources/
    │   ├── views/                   # Blade templates (HTML)
    │   ├── css/                     # CSS (Tailwind)
    │   └── js/                      # JavaScript
    ├── routes/
    │   ├── web.php                  # Routes halaman web
    │   └── api.php                  # Routes REST API
    ├── .env.example                 # Template konfigurasi environment
    └── public/                      # Document root web server
```

---

## 🚀 Instalasi & Konfigurasi

### A. Python Backend (Flask ML API)

#### 1. Masuk ke folder Python

```bash
cd "tanaman herbal/python"
```

#### 2. Buat Virtual Environment (direkomendasikan)

```bash
# Windows
python -m venv venv
venv\Scripts\activate

# Linux / macOS
python3 -m venv venv
source venv/bin/activate
```

#### 3. Install dependensi Python

```bash
pip install -r requirements.txt
```

Paket yang akan terinstall:

| Package | Versi | Fungsi |
|---------|-------|--------|
| `flask` | 3.0.0 | Web framework untuk API |
| `flask-cors` | 4.0.0 | CORS — izinkan request dari Laravel |
| `tensorflow` | 2.15.0 | Framework ML untuk jalankan model |
| `pillow` | 10.1.0 | Pemrosesan gambar |
| `numpy` | 1.24.3 | Komputasi numerik / array |
| `gunicorn` | 21.2.0 | Production WSGI server (Linux) |

> ⚠️ **Instalasi TensorFlow bisa memakan waktu 5–15 menit** karena ukurannya ±600MB. Pastikan koneksi internet stabil.

---

### B. Laravel Backend + Frontend

#### 1. Masuk ke folder web

```bash
cd "tanaman herbal/web"
```

#### 2. Install dependensi PHP

```bash
composer install
```

#### 3. Install dependensi JavaScript

```bash
npm install
```

Paket JavaScript yang terinstall:

| Package | Versi | Fungsi |
|---------|-------|--------|
| `vite` | ^4.0.0 | Build tool frontend |
| `laravel-vite-plugin` | ^0.7.2 | Integrasi Vite dengan Laravel |
| `tailwindcss` | ^3.3.0 | CSS framework utility-first |
| `@tailwindcss/forms` | ^0.5.3 | Plugin styling form Tailwind |
| `autoprefixer` | ^10.4.14 | CSS prefix otomatis |
| `postcss` | ^8.4.24 | Post-processing CSS |
| `axios` | ^1.1.2 | HTTP client JavaScript |

#### 4. Buat file konfigurasi environment

```bash
cp .env.example .env
```

> Di **Windows** tanpa Git Bash:
> ```bash
> copy .env.example .env
> ```

#### 5. Generate Application Key

```bash
php artisan key:generate
```

#### 6. Konfigurasi file `.env`

Buka file `.env` dan sesuaikan bagian berikut:

```env
APP_NAME="Herbal Bolaang Mongondow"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# ─── Database MySQL ───────────────────────────────────
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=herbal_db       # Nama database (buat dulu di MySQL)
DB_USERNAME=root             # Username MySQL kamu
DB_PASSWORD=                 # Password MySQL kamu

# ─── Flask ML API ─────────────────────────────────────
FLASK_API_URL=http://localhost:5000
FLASK_API_TIMEOUT=30
```

---

## 🗄️ Konfigurasi Database

#### 1. Buat database baru di MySQL

```sql
CREATE DATABASE herbal_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Atau lewat **phpMyAdmin**: buat database baru dengan nama `herbal_db`.

#### 2. Jalankan migrasi (buat semua tabel)

```bash
php artisan migrate
```

Tabel yang akan dibuat:

| Tabel | Keterangan |
|-------|-----------|
| `users` | Data pengguna & admin |
| `plants` | Data 13 tanaman herbal |
| `diseases` | Data penyakit yang bisa diobati |
| `herbal_recipes` | Resep obat herbal |
| `recipe_ingredients` | Bahan-bahan tiap resep |
| `recipe_steps` | Langkah-langkah pembuatan resep |
| `plant_images` | Galeri foto tanaman |
| `plant_detections` | Riwayat deteksi gambar |

#### 3. Jalankan seeder (isi data awal)

```bash
php artisan db:seed
```

Seeder akan mengisi:
- ✅ **1 akun admin** (email: `admin@herbal.com`, password: `password`)
- ✅ **13 tanaman herbal** (Lidah Buaya, Jahe, Kunyit, Sambiloto, dst.)
- ✅ **Penyakit-penyakit** beserta resep herbalnya

> Atau jalankan migrasi + seeder sekaligus:
> ```bash
> php artisan migrate --seed
> ```

#### 4. (Opsional) Reset dan isi ulang database

```bash
php artisan migrate:fresh --seed
```

> ⚠️ Perintah ini **menghapus semua data** dan membuat ulang dari awal.

---

## ▶️ Menjalankan Aplikasi

Kedua server harus berjalan **secara bersamaan**. Buka **2 terminal** terpisah.

### Terminal 1 — Python Flask (ML API)

```bash
# Masuk ke folder python
cd "tanaman herbal/python"

# Aktifkan virtual environment (jika menggunakannya)
venv\Scripts\activate          # Windows
# source venv/bin/activate     # Linux/macOS

# Jalankan Flask server
python app.py
```

Output yang muncul jika berhasil:

```
Loading model from .../daun_savedmodel...
Model loaded successfully!
Starting Flask API server...
Available classes: 13
 * Running on http://0.0.0.0:5000
```

> Verifikasi Flask berjalan: buka http://localhost:5000/api/health di browser.
> Harus muncul: `{"model_loaded": true, "status": "healthy", "version": "1.0.0"}`

---

### Terminal 2 — Laravel Web App

```bash
# Masuk ke folder web
cd "tanaman herbal/web"

# Build assets CSS/JS (Tailwind via Vite)
npm run build

# Jalankan Laravel development server
php artisan serve
```

Output yang muncul jika berhasil:

```
   INFO  Server running on [http://127.0.0.1:8000].
```

> Akses aplikasi di: **http://localhost:8000**

---

### (Alternatif) Mode Development — Hot Reload CSS/JS

Jika ingin edit tampilan dengan **live preview** perubahan CSS/JS, gunakan 3 terminal:

```bash
# Terminal 3 (tambahan) — Vite dev server
cd "tanaman herbal/web"
npm run dev
```

Lalu akses di http://localhost:8000 (Laravel tetap di port 8000, Vite berjalan di background).

---

## 🔑 Akun Default

Setelah menjalankan seeder, akun berikut sudah tersedia:

| Role | Email | Password | URL Login |
|------|-------|----------|-----------|
| **Admin** | `admin@herbal.com` | `password` | http://localhost:8000/login |

> ⚠️ **Ganti password admin** setelah pertama kali login, terutama untuk environment production!

Panel admin tersedia di: **http://localhost:8000/admin/dashboard**

---

## 🌟 Fitur Aplikasi

### Halaman Publik

| URL | Halaman |
|-----|---------|
| `/` | Beranda |
| `/about` | Tentang Aplikasi |
| `/contact` | Kontak |
| `/plants` | Daftar Tanaman Herbal |
| `/plants/{id}` | Detail Tanaman |
| `/diseases` | Daftar Penyakit |
| `/diseases/{slug}` | Detail Penyakit |
| `/recipes` | Daftar Resep Herbal |
| `/recipes/{id}` | Detail Resep |
| `/detection` | Upload Foto untuk Deteksi |
| `/detection/result/{id}` | Hasil Deteksi |
| `/detection/history` | Riwayat Deteksi |

### Panel Admin (`/admin/*`)

| URL | Halaman |
|-----|---------|
| `/admin/dashboard` | Dashboard & Statistik |
| `/admin/plants` | CRUD Tanaman Herbal |
| `/admin/diseases` | CRUD Penyakit |
| `/admin/recipes` | CRUD Resep Herbal |
| `/admin/detections` | Kelola & Monitor Deteksi |
| `/admin/profile` | Edit Profil Admin |

### REST API (untuk Mobile/External)

| Method | Endpoint | Keterangan |
|--------|---------|------------|
| `GET` | `/api/plant-detection` | Daftar semua deteksi |
| `POST` | `/api/plant-detection` | Upload & deteksi tanaman *(auth required)* |
| `GET` | `/api/plant-detection/{id}` | Detail satu deteksi |
| `DELETE` | `/api/plant-detection/{id}` | Hapus deteksi *(auth required)* |
| `GET` | `/api/plant-detection/statistics` | Statistik deteksi |

---

## 🔧 Troubleshooting

### ❌ Error: "Model not loaded" dari Flask

**Penyebab**: File model tidak ditemukan atau Python gagal load TensorFlow.

**Solusi**:
- Pastikan folder `python/daun_savedmodel/` ada dan tidak korup
- Pastikan Python versi 3.9–3.11 (bukan 3.12+)
- Coba jalankan ulang: `python app.py`

---

### ❌ Error: `SQLSTATE[HY000] [1049] Unknown database`

**Penyebab**: Database `herbal_db` belum dibuat.

**Solusi**:
```sql
CREATE DATABASE herbal_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

### ❌ Error: `Class 'App\Http\Controllers\...' not found`

**Penyebab**: Autoload Composer belum diperbarui.

**Solusi**:
```bash
composer dump-autoload
```

---

### ❌ Error: `Vite manifest not found`

**Penyebab**: Asset CSS/JS belum di-build.

**Solusi**:
```bash
npm run build
```

---

### ❌ Error: `cURL error 7: Failed to connect to localhost port 5000`

**Penyebab**: Flask server belum berjalan ketika Laravel mencoba menghubungi ML API.

**Solusi**:
- Pastikan Terminal 1 (Flask) sudah running sebelum mencoba fitur deteksi
- Cek `FLASK_API_URL` di file `.env` sudah benar

---

### ❌ Error: `php_network_getaddresses` atau koneksi database gagal

**Penyebab**: MySQL belum berjalan.

**Solusi**:
- Jalankan MySQL/XAMPP/Laragon terlebih dahulu
- Verifikasi `DB_HOST`, `DB_PORT`, `DB_USERNAME`, `DB_PASSWORD` di `.env`

---

### ❌ Halaman tampil tapi CSS berantakan

**Penyebab**: File CSS belum ter-build atau Vite dev server tidak berjalan.

**Solusi**:
```bash
npm run build
# ATAU untuk development:
npm run dev
```

---

## 📦 Ringkasan Semua Perintah

```bash
# ── PERTAMA KALI (Setup Awal) ─────────────────────────

# 1. Python
cd "tanaman herbal/python"
python -m venv venv
venv\Scripts\activate
pip install -r requirements.txt

# 2. Laravel
cd "tanaman herbal/web"
composer install
npm install
copy .env.example .env
php artisan key:generate
# (Edit .env: isi DB_DATABASE, DB_USERNAME, DB_PASSWORD)
php artisan migrate --seed
npm run build


# ── SETIAP KALI MENJALANKAN ───────────────────────────

# Terminal 1 — Flask ML API
cd "tanaman herbal/python"
venv\Scripts\activate
python app.py

# Terminal 2 — Laravel Web
cd "tanaman herbal/web"
php artisan serve
```

---

## 📞 Informasi Teknis

- **Framework Web**: Laravel 10 (PHP 8.1+)
- **ML Framework**: TensorFlow 2.15.0
- **Model**: MobileNetV2 (SavedModel format)
- **Jumlah Kelas Tanaman**: 13 (Lidah Buaya, Belimbing Botol, Brotowali, Cocor Bebek, Daun Pariya, Daun Sirih, Jahe, Jambu Biji, Kunyit, Mayana, Pepaya, Pohon Jarak, Sambiloto)
- **Input Gambar**: JPEG/PNG, maksimal 10MB, diubah ke 224×224 px
- **CSS**: Tailwind CSS 3.3 via Vite
- **Database**: MySQL dengan Eloquent ORM + SoftDeletes
- **Auth**: Laravel Sanctum (API) + Session (Web)
