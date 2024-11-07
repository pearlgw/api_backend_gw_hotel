# ERD HotelSystem
![hotel-system](https://github.com/pearlgw/api_backend_gw_hotel/blob/master/contentGithub/hotelSystem.png)

# Panduan Menjalankan Proyek Laravel

Panduan ini menjelaskan langkah-langkah untuk menjalankan proyek Laravel yang telah di-clone dari GitHub

### Langkah 1: Clone Repository

Langkah pertama adalah meng-clone repository proyek dari GitHub ke mesin lokal Anda. Jalankan perintah berikut di terminal:

```bash
git clone https://github.com/pearlgw/api_backend_gw_hotel.git
```
### Langkah 2: Menyalin File .env

```bash
cd api_backend_gw_hotel
```

### Langkah 3: Instalasi Dependensi

```bash
composer install
```

### Langkah 4: Menghasilkan Key Aplikasi

```bash
php artisan key:generate
```

### Langkah 5: Membuat Link Storage

```bash
php artisan storage:link
```

### Langkah 6: Migrasi Database

```bash
php artisan migrate
```

### Langkah 7: Menjalankan Seeder

```bash
php artisan db:seed
```

### Langkah 8: Menjalankan Server

```bash
php artisan serve
```
