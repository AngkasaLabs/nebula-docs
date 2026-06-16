# Instalasi

Pilih jalur instalasi sesuai **tingkat kenyamanan Anda menggunakan terminal**. Jika menggunakan **arsip ZIP rilis**, Anda **tidak perlu** Git, Composer, atau npm di server hosting standar.

## Pilih jalur

| Situasi | Apa yang harus dilakukan |
|-----------|------------|
| Saya ingin instal di **shared hosting** (cPanel, Plesk, dll.) tanpa terminal | Gunakan **[Instal dari rilis ZIP](#instal-dari-rilis-zip)** — unggah, ekstrak, buka situs, lalu selesaikan di **web installer** (`/install`). |
| Saya sedang **development lokal** atau menggunakan **SSH** dan familiar dengan Composer / npm | Gunakan **[Instalasi pengembang](#instalasi-pengembang-git-dan-build)** — clone repositori, instal dependensi, dan build aset. |

---

## Instal dari rilis ZIP

Ini adalah **jalur termudah** untuk menjalankan NebulaCMS tanpa proses build manual. Arsip rilis resmi dibangun di CI, sehingga **dependensi PHP (`vendor`) dan aset frontend sudah siap pakai**.

### 1. Unduh

- Buka halaman **[Download](/download)** di situs ini. Tautan ini mengarah ke **file ZIP yang sama** dengan **[Rilis GitHub](https://github.com/AngkasaLabs/NebulaCMS/releases)** terbaru.
- Simpan arsip **`nebulacms-vX.Y.Z.zip`** (contoh: `nebulacms-v1.0.1.zip`).

### 2. Unggah dan ekstrak di hosting

Gunakan **File Manager**, **FTP**, atau **SFTP**:

1. Unggah ZIP ke akun Anda (misalnya `public_html` atau subfolder).
2. **Ekstrak** arsip sehingga ada folder berisi `app`, `public`, `artisan`, dll.

### 3. Arahkan document root ke `public`

Laravel menyajikan aplikasi dari direktori **`public`**. Di panel hosting:

- Atur **document root** ke **`.../proyek-anda/public`**, atau
- jika tidak bisa diubah, minta bantuan penyedia hosting.

### 4. Buat database

Buat database **MySQL** dan berikan akses ke pengguna. Catat **host**, **nama database**, **nama pengguna**, dan **kata sandi**.

### 5. Jalankan web installer

1. Buka situs Anda di browser (mis. `https://example.com`).
2. Jika NebulaCMS belum terinstal, Anda akan dialihkan ke **`/install`**.
3. Ikuti langkah di layar: pemeriksaan, database, pengaturan situs, akun admin.

Anda **tidak perlu** mengedit `.env` secara manual; installer akan mengonfigurasikannya.

### Setelah instalasi

- Masuk ke **`/admin`** (lihat [Dasar-dasar admin](admin-basics.md)).
- Atur **cron job** untuk scheduler Laravel (lihat [Operasional](operations.md)).
- Buat symlink storage jika pengunggahan gagal (jalankan `php artisan storage:link`).
- Mulai **v1.7.0**, plugin admin React/Inertia yang membawa folder `dist/` sendiri dapat di-upload di shared hosting **tanpa build frontend ulang di server**. Pastikan paket plugin menyertakan `dist/manifest.json` dan asset hasil build.

---

## Instalasi pengembang (Git dan build)

Bagian ini ditujukan untuk pengembang yang ingin berkontribusi langsung pada kode sumber.

### Syarat

- **PHP** 8.3+
- **Composer** 2.x
- **Node.js** 20+
- **Database**: MySQL 8+ / PostgreSQL

### Clone dan instal

```bash
git clone https://github.com/AngkasaLabs/NebulaCMS nebulacms
cd nebulacms
composer install
npm install
```

### Lingkungan

```bash
cp .env.example .env
php artisan key:generate
```
Ubah `.env` dengan kredensial database Anda.

### Database

```bash
php artisan migrate
php artisan db:seed # opsional
php artisan storage:link
```

### Build frontend

```bash
npm run build
# atau untuk mode dev
npm run dev
```

### Jalankan
```bash
php artisan serve
```
