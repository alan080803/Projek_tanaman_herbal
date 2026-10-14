# Aplikasi Web Tanaman Herbal Indonesia

Web application untuk identifikasi tanaman herbal dan direktori racikan obat tradisional berbasis Laravel.

## 📋 Fitur Utama

### Halaman Public (Pengunjung)
- **Landing Page** - Homepage dengan informasi aplikasi
- **Direktori 20 Penyakit** - Katalog penyakit umum dengan info lengkap (gejala, penyebab, pencegahan)
- **Database Tanaman Herbal** - 12+ tanaman herbal Indonesia dengan detail manfaat
- **Racikan Obat Herbal** - Resep lengkap dengan bahan, takaran, dan cara pembuatan
- **Deteksi Tanaman** - Upload foto untuk identifikasi (integrasi ML MobileNetV2 - pending)

### Dashboard Admin
- **Management Penyakit** - CRUD penyakit dengan upload gambar
- **Management Tanaman** - CRUD tanaman + galeri foto multi-upload
- **Management Racikan** - CRUD racikan dengan ingredients & step-by-step
- **Monitoring Deteksi** - Riwayat dan statistik deteksi pengguna
- **Analytics Dashboard** - Overview statistik aplikasi

## 🛠️ Tech Stack

- Laravel 10.x | MySQL/PostgreSQL | Laravel Auth | MobileNetV2 (ML - pending)

## 📦 Instalasi

### 1. Install Dependencies
```bash
composer install
```

### 2. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:
```env
DB_DATABASE=herbal_medicine
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Database & Seeding
```bash
# Buat database
mysql -u root -p
CREATE DATABASE herbal_medicine;
exit;

# Run migration & seed data
php artisan migrate:fresh --seed
```

**Data yang di-seed:**
- ✅ 1 Admin user (admin@herbal.com / password)
- ✅ 12 Tanaman herbal
- ✅ 20 Jenis penyakit
- ✅ 20+ Racikan lengkap dengan bahan & langkah

### 4. Setup Storage & Run
```bash
php artisan storage:link
php artisan serve
```

Aplikasi: **http://localhost:8000**

## 🔐 Login Admin

```
URL: http://localhost:8000/login
Email: admin@herbal.com
Password: password
```

⚠️ **Segera ganti password setelah login pertama!**

## 📂 Struktur Backend

### Controllers
```
Public (untuk pengunjung):
- HomeController          # Landing, about, contact
- DiseaseController       # List & detail penyakit
- PlantController         # List & detail tanaman
- RecipeController        # List & detail racikan
- DetectionController     # Upload & hasil deteksi

Admin (untuk dashboard):
- Admin/DashboardController     # Analytics
- Admin/DiseaseController       # CRUD penyakit
- Admin/PlantController         # CRUD tanaman + galeri
- Admin/RecipeController        # CRUD racikan
- Admin/DetectionController     # Monitoring deteksi
```

### Models & Database
```
- User                  # User dengan is_admin flag
- Plant                 # Tanaman herbal
- PlantImage            # Galeri foto tanaman
- Disease               # Penyakit
- HerbalRecipe          # Racikan obat herbal
- RecipeIngredient      # Bahan racikan
- RecipeStep            # Langkah pembuatan
- PlantDetection        # Riwayat deteksi ML
```

### Middleware
- **AdminMiddleware** - Proteksi route admin (cek is_admin)

## 🛣️ Routes

### Public
```
GET  /                          # Landing
GET  /diseases                  # List penyakit
GET  /diseases/{slug}           # Detail penyakit + racikan
GET  /plants                    # List tanaman
GET  /recipes                   # List racikan
GET  /detection                 # Form upload deteksi
POST /detection/upload          # Process upload
```

### Admin (protected: auth + admin middleware)
```
GET  /admin/dashboard           # Dashboard

# Resource routes (index, create, store, show, edit, update, destroy)
/admin/diseases
/admin/plants
/admin/recipes
/admin/detections               # Monitoring & statistics
```

## 🔧 Development Commands

```bash
php artisan serve              # Run dev server
php artisan migrate:fresh --seed    # Reset DB + seed
php artisan storage:link       # Link storage folder
php artisan cache:clear        # Clear cache
```

## 🎨 Next Steps: Frontend Development

Backend sudah siap. Selanjutnya buat **Blade Templates**:

```
resources/views/
├── layouts/
│   ├── app.blade.php          # Layout public
│   └── admin.blade.php        # Layout admin
├── landing/index.blade.php
├── diseases/index.blade.php & show.blade.php
├── plants/index.blade.php & show.blade.php
├── recipes/index.blade.php & show.blade.php
├── detection/index.blade.php, result.blade.php, history.blade.php
├── auth/login.blade.php
└── admin/
    ├── dashboard/index.blade.php
    ├── diseases/{index,create,edit,show}.blade.php
    ├── plants/{index,create,edit,show}.blade.php
    ├── recipes/{index,create,edit,show}.blade.php
    └── detections/{index,show,statistics}.blade.php
```

## 🤖 Integrasi ML (TODO)

Untuk mengintegrasikan model MobileNetV2, update `DetectionController@upload`:

```php
// Setelah upload, call ML model
$result = $this->mlService->detectPlant($imagePath);

$detection->update([
    'plant_id' => $result['plant_id'],
    'confidence_score' => $result['confidence'],
    'detection_status' => 'success',
    'detected_at' => now(),
]);
```

Buat service class `app/Services/PlantDetectionService.php` untuk komunikasi dengan ML model (Python Flask/FastAPI atau TensorFlow.js).

## 📊 Sample Data

**12 Tanaman:** Jahe, Kunyit, Temulawak, Kencur, Lengkuas, Daun Sirsak, Sambiloto, Kemangi, Lidah Buaya, Mint, Daun Pepaya, Sereh

**20 Penyakit:** Batuk, Flu, Demam, Masuk Angin, Maag, Diare, Hipertensi, Diabetes, Kolesterol, Asam Urat, Anemia, Insomnia, Sakit Kepala, Radang Tenggorokan, Wasir, Asma, Keputihan, Jerawat, Rematik, Vertigo

Setiap penyakit memiliki racikan lengkap dengan bahan, takaran, dan cara pembuatan.

## 📝 Notes

- Public registration **disabled** (admin only)
- Image upload via Laravel Storage (`storage/app/public/`)
- Soft deletes enabled untuk Disease, Plant, HerbalRecipe
- Validation di semua controller
- Admin routes protected dengan middleware

## 🚀 Production Checklist

- [ ] Ganti password admin default
- [ ] Set `APP_ENV=production` dan `APP_DEBUG=false`
- [ ] Setup database backup otomatis
- [ ] Konfigurasi storage (S3 jika perlu)
- [ ] Setup SSL (HTTPS)
- [ ] Optimize: `composer install --optimize-autoloader --no-dev`
- [ ] Cache: `php artisan config:cache && php artisan route:cache`

---

**Status Backend:** ✅ **COMPLETE & READY**  
**Next Step:** Buat Blade Templates untuk frontend  
**ML Integration:** Pending (struktur sudah siap)

*Developed for Herbal Medicine Detection System - 2026*

