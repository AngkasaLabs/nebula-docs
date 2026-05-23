# Referensi admin (route & permission)

Panel admin berada di **`/admin`**. Akses memerlukan autentikasi dan **email terverifikasi** (middleware `verified`). Daftar berikut adalah nama route yang dapat dipakai di kode dengan `route('admin...')`.

## Dashboard

- **Route:** `admin.dashboard`
- Menampilkan ringkasan widget dan pintasan kerja.

## Audit log

- **Route:** `admin.audit-log.index`
- **Permission:** `view audit log`
- Menampilkan aktivitas penting terkait keamanan (login, perubahan konten) saat fitur log aktivitas aktif.

## Media

- **Routes:** `admin.media.index`, `admin.media.store`, `admin.media.show`, `admin.media.destroy`, `admin.media.download`
- **Folders:** `admin.media.folders.store`, `admin.media.folders.destroy`
- **Bulk:** `admin.media.bulk-destroy`, `admin.media.move`
- Untuk unggah file, kelola folder, pindah/hapus aset. Gambar raster dapat memiliki varian (`thumb/medium/large`) sesuai `config/media.php`.

## Categories & tags

- **Categories:** `admin.categories.*` (resource)
- **Tags:** `admin.tags.*` (resource)
- Dipakai untuk klasifikasi **posts**. Bisa dibuat sebelum atau saat mengedit post.

## Posts

- **Resource routes:** `admin.posts.index`, `create`, `store`, `show`, `edit`, `update`, `destroy`
- **Publish / unpublish:** `admin.posts.publish`, `admin.posts.unpublish`
- **Autosave:** `admin.posts.autosave`, `admin.posts.autosave.update`
- **Revisions:** `admin.posts.revisions`, `admin.posts.revisions.restore`
- **Bulk actions:** `admin.posts.bulk-action`

Alur umum: buat draft, isi category/tags dan featured image, lalu publish atau jadwalkan. Post terjadwal membutuhkan scheduler produksi (lihat [Operasional](operations.md)).

## Pages

- **Resource routes:** `admin.pages.*`
- **Publish / unpublish:** `admin.pages.publish`, `admin.pages.unpublish`
- Pages berasal dari database (berbeda dengan halaman statis tema; lihat [Halaman statis](static-pages.md)).

## Users & roles

- **Users:** `admin.users.*` (resource)
- **Roles:** `admin.roles.*` (tanpa `show`)

Gunakan role untuk mengatur akses staf. Permission dikelola oleh Spatie Laravel Permission; beberapa route memeriksa permission bernama khusus (misalnya audit log).

## Themes

- **Routes:** `admin.themes.index`, `admin.themes.activate`, `admin.themes.scan`, `admin.themes.destroy`, `admin.themes.upload`
- Untuk scan tema dari filesystem, aktivasi tema, upload ZIP (jika didukung), dan hapus tema yang tidak dipakai.

## Plugins

- **Routes:** `admin.plugins.index`, `admin.plugins.activate`, `admin.plugins.deactivate`, `admin.plugins.scan`, `admin.plugins.destroy`, `admin.plugins.upload`

## Menus

- **Resource:** `admin.menus.*`
- **Items:** `admin.menus.items.store`, `admin.menus.items.bulk-store`, `admin.menus.items.update`, `admin.menus.items.destroy`, `admin.menus.items.reorder`

Dipakai untuk menyusun navigasi frontend (render akhirnya tergantung tema aktif).

## Settings

- **General / SEO:** `admin.settings.general`, `admin.settings.seo`, `admin.settings.update`
- **Cache:** `admin.settings.clear-cache`
- **Security / 2FA:** `admin.settings.security`, `admin.settings.two-factor.*`
- **Profile:** `profile.edit`, `profile.update`, `profile.destroy`
- **Password:** `password.edit`, `password.update`
- **Appearance:** `appearance` (halaman Inertia)

## Tips

- Gunakan **roles** untuk staf baru, hindari akses ad-hoc per pengguna jika tidak perlu.
- Bersihkan cache aplikasi setelah mengubah pengaturan yang memengaruhi cache konfigurasi di produksi.

## Lihat juga

- [Dasar-dasar admin](admin-basics.md)
- [Model konten](content-model.md)
- [Keamanan](security.md)
