# Penyimpanan media, varian, dan CDN

Halaman ini merangkum pengaturan media pada `config/media.php` dan variabel lingkungan `MEDIA_*`.

## Varian gambar

Untuk gambar raster (bukan SVG/GIF), NebulaCMS dapat membuat varian otomatis saat upload:

| Varian | Lebar maksimum |
|--------|----------------|
| `thumb` | 300 px |
| `medium` | 768 px |
| `large` | 1920 px |

Varian diproses dengan [Intervention Image](https://image.intervention.io/). URL varian tersedia di API admin (misalnya `variant_urls`).

Pengaturan penting:

- `MEDIA_IMAGE_VARIANTS=false` untuk menonaktifkan varian otomatis.
- `MEDIA_VARIANT_JPEG_QUALITY` untuk kualitas JPEG (default umum: `82`).

## Storage disk

Setel `MEDIA_DISK` di `.env`:

| Nilai | Fungsi |
|-------|--------|
| `public` | Simpan di `storage/app/public`, akses melalui symlink `public/storage` |
| `s3` | Simpan di object storage S3-compatible |

Jika memakai `s3`, lengkapi variabel AWS seperti `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION`, dan `AWS_BUCKET`.

## CDN dan URL publik

- Untuk disk `public`, Anda dapat mengatur `MEDIA_URL` (misalnya `https://cdn.example.com/storage`) agar URL aset diarahkan ke CDN/reverse proxy.
- Untuk `s3`, set `AWS_URL` jika ingin URL publik custom (misalnya CloudFront).

## Lihat juga

- [Konfigurasi](configuration.md)
- [Model konten](content-model.md)
- [Operasional](operations.md)
