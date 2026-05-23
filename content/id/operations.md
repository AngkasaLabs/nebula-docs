# Operasional dan deployment

## Pemeliharaan dan pembaruan

Menjaga NebulaCMS tetap andal di produksi pada dasarnya mengikuti **operasi standar Laravel**:

1. **Pembaruan aplikasi**: saat versi baru dirilis, jalankan alur update biasa (`git pull`/upload, `composer install`, `npm run build`, dsb.).
2. **Migrasi database**: jalankan `php artisan migrate` jika ada perubahan skema.
3. **Cache**: setelah mengubah `config`/`route` di produksi, regenerasi cache.
4. **Dependensi**: pastikan versi PHP dan database sesuai syarat kompatibilitas.

## Scheduler (publikasi terjadwal)

NebulaCMS mendaftarkan jadwal tugas di `routes/console.php`:

- Command: `posts:publish-scheduled`
- Frekuensi: **setiap menit**

Laravel hanya mengeksekusi scheduler jika **cron** aktif:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

Tanpa cron tersebut, postingan terjadwal tidak akan terbit otomatis.

## Cache

Gunakan `php artisan config:cache`, `route:cache`, dan `view:cache` pada sistem produksi.

## Queue

Gunakan `supervisor` (atau process manager setara) untuk worker queue jangka panjang.

## Backup

- **Database:** lakukan dump berkala.
- **Files:** backup `storage/app/public` (lokasi unggahan).

## HTTPS

Pastikan menyetel `APP_URL` memakai awalan `https://`.

## Lihat juga

- [Instalasi](installation.md)
- [Konfigurasi](configuration.md)
- [Penyimpanan media, varian, dan CDN](media.md)
- [Keamanan](security.md)
