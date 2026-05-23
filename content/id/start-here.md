# Mulai dari sini

Selamat datang di dokumentasi NebulaCMS. Pilih jalur yang paling sesuai dengan **tujuan awal Anda**, lalu lanjutkan ke dokumen pendukung sesuai kebutuhan.

## Saya menulis atau mengedit konten (editor, blogger, pemilik situs)

Anda tidak perlu memahami Laravel atau PHP untuk mempublikasikan post dan page.

1. Pastikan situs sudah terinstal dan Anda bisa membuka URL admin (biasanya **`/admin`**). Jika Anda menyiapkan server sendiri, ikuti [Instalasi](installation.md) terlebih dahulu.
2. Baca **[Dasar-dasar Admin](admin-basics.md)** untuk masuk, verifikasi email, membuat postingan, mengunggah media, dan mempublikasikan.
3. Saat Anda membutuhkan nama route atau permission yang presisi (misalnya untuk dukungan teknis), gunakan **[Referensi admin](admin-reference.md)**.

## Saya instal atau meng-host CMS (server, DevOps)

1. **[Instalasi](installation.md)** — mulai dari **Instal dari rilis ZIP** jika ingin tanpa terminal; gunakan **Instalasi pengembang** jika Anda clone dari Git dan memakai Composer/npm.
2. **[Konfigurasi](configuration.md)** — variabel lingkungan dan file pengaturan penting.
3. **[Penyimpanan media, varian, dan CDN](media.md)** — upload, S3, ukuran gambar, dan base URL CDN.
4. **[Operasional](operations.md)** — penjadwal, cron, dan catatan produksi (diperlukan untuk postingan yang dijadwalkan).

## Saya membangun tema atau plugin (pengembang)

1. **[Gambaran umum](overview.md)** — cara komponen utama saling terhubung (admin, frontend, hooks, plugin).
2. **[Sistem Tema](theme-system.md)** dan **[Pengembangan Plugin](plugin-development.md)** — struktur, `theme.json`, `plugin.json`, siklus hidup.
3. **[Hooks dan Filter](hooks-and-filters.md)** — memperluas perilaku tanpa mengubah file inti.
4. **Referensi lanjutan** di [beranda dokumentasi](/docs) — dokumentasi tema lengkap, katalog hook, dan materi mendalam lain. Mulai dari dokumen ringkas, lalu buka artikel "lengkap" bila diperlukan.

## Saya mengintegrasikan atau mengotomasi (API)

- **[REST API](rest-api.md)** — endpoint JSON untuk konten published.

## Lihat juga

- [Tentang NebulaCMS](about-nebulacms.md) — visi proyek, bahasa dokumentasi, komunitas
- [Gambaran umum](overview.md)
- [Instalasi](installation.md)
