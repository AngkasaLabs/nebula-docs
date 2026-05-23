# Konfigurasi

## Variabel lingkungan (`.env`)

### Aplikasi dasar

| Variabel | Fungsi |
|----------|--------|
| `APP_NAME` | Nama aplikasi |
| `APP_ENV` | Environment (`local`, `staging`, `production`) |
| `APP_KEY` | Kunci enkripsi aplikasi (`php artisan key:generate`) |
| `APP_DEBUG` | Gunakan `false` pada produksi |
| `APP_URL` | URL dasar aplikasi |

### Database

| Variabel | Fungsi |
|----------|--------|
| `DB_CONNECTION` | Driver database (`mysql`, `pgsql`, dll) |
| `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | Kredensial koneksi database |

### Session, cache, dan queue

Konfigurasi mengikuti standar Laravel. Untuk deployment multi-node, disarankan memakai backend bersama (misalnya Redis) agar session/cache tetap konsisten.

### Media (`config/media.php`)

| Variabel | Fungsi |
|----------|--------|
| `MEDIA_DISK` | Disk media aktif (`public`, `s3`, dll) |
| `MEDIA_IMAGE_VARIANTS` | Aktif/nonaktif pembuatan varian gambar (`thumb/medium/large`) |
| `MEDIA_URL` | Base URL media, biasanya dipakai saat menggunakan CDN |

Jika memakai S3, lengkapi kredensial AWS dan URL bucket/CDN sesuai kebutuhan infrastruktur.

### Locale

NebulaCMS mendukung pergantian locale (misalnya `en` dan `id`). Perpindahan bahasa dilakukan melalui endpoint `locale.switch` (request `POST`).

## Lihat juga

- [Media](media.md)
