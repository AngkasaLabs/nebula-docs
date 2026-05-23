# Dokumentasi Tema NebulaCMS

## Daftar isi

1. [Pengantar](#pengantar)
2. [Struktur tema](#struktur-tema)
3. [Pengembangan tema](#pengembangan-tema)
4. [Konfigurasi tema](#konfigurasi-tema)
5. [Sistem template](#sistem-template)
6. [Hooks tema](#hooks-tema)
7. [Manajemen aset](#manajemen-aset)
8. [Child themes](#child-themes)
9. [Praktik terbaik](#praktik-terbaik)

## Pengantar

Tema NebulaCMS mengatur tampilan visual dan tata letak situs. Dokumen ini merangkum konsep inti untuk membuat, menyesuaikan, dan memelihara tema.

## Struktur tema

### Struktur dasar

Minimal, sebuah tema memiliki struktur berikut:

```text
themes/
  └── your-theme/
      ├── assets/
      │   ├── css/
      │   │   └── style.css
      │   ├── js/
      │   │   └── main.js
      │   └── images/
      │       └── preview.svg
      ├── views/
      │   ├── layouts/
      │   │   └── app.blade.php
      │   ├── partials/
      │   │   ├── header.blade.php
      │   │   ├── footer.blade.php
      │   │   └── sidebar.blade.php
      │   └── pages/
      │       ├── home.blade.php
      │       ├── blog.blade.php
      │       ├── post.blade.php
      │       ├── page.blade.php
      │       ├── category.blade.php
      │       ├── tag.blade.php
      │       ├── search.blade.php
      │       └── 404.blade.php
      ├── functions.php
      └── theme.json
```

### File wajib

- `theme.json`: metadata dan konfigurasi tema.
- `functions.php`: hooks, filters, menu, sidebar, aset.
- `views/layouts/app.blade.php`: layout utama.
- `assets/css/style.css`: stylesheet utama.

## Pengembangan tema

### Membuat tema baru

1. Buat direktori baru di `themes`.
2. Buat struktur dasar file/folder.
3. Buat `theme.json`.
4. Buat `functions.php`.
5. Tambahkan template di `views`.

### Metadata tema (`theme.json`)

```json
{
    "name": "Your Theme Name",
    "slug": "your-theme",
    "version": "1.0.0",
    "description": "Deskripsi tema",
    "author": "Nama Anda",
    "preview": "assets/images/preview.svg",
    "requires": {
        "cms_version": "^1.0.0"
    },
    "settings": {
        "colors": {
            "primary": "#0d6efd",
            "secondary": "#6c757d"
        },
        "typography": {
            "font-family": "Arial, sans-serif",
            "font-size": "16px"
        },
        "layout": {
            "container-width": "1200px",
            "sidebar": "right"
        }
    }
}
```

## Konfigurasi tema

### Fungsi tema (`functions.php`)

Di file ini Anda dapat:

- mendaftarkan hook dan filter,
- memuat CSS/JS tema,
- menambahkan menu dan sidebar,
- menambahkan data tambahan untuk view.

Contoh minimal:

```php
add_action('theme.loaded', function ($theme) {
    add_action('theme.styles', function () {
        echo '<link rel="stylesheet" href="' . theme_asset('css/style.css') . '">';
    });
});
```

## Sistem template

Template dipilih berdasarkan route dan hierarki fallback. Contoh urutan:

- Home: `theme::templates.home` -> `theme::home` -> `theme::index`
- Post: `theme::templates.post-{slug}` -> `theme::post-{slug}` -> `theme::post` -> `theme::single`
- Page: `theme::templates.page-{slug}` -> `theme::page` -> `theme::index`

Struktur ini membantu Anda membuat template yang spesifik tanpa mengorbankan fallback default.

## Hooks tema

Hook penting yang umum dipakai:

- Siklus tema: `theme.loaded`, `theme.before_activate`, `theme.after_activate`, `theme.before_delete`, `theme.after_delete`
- Rendering aset: `theme.styles`, `theme.scripts`
- Data halaman: `home_page_data`, `before_post`, `related_posts_query`, `related_posts_count`

## Manajemen aset

### Mendaftarkan aset

Muat CSS/JS dari `functions.php`:

```php
add_action('theme.styles', function () {
    echo '<link rel="stylesheet" href="' . theme_asset('css/style.css') . '">';
});

add_action('theme.scripts', function () {
    echo '<script src="' . theme_asset('js/main.js') . '"></script>';
});
```

### Menampilkan aset di layout

Di layout utama, panggil:

```php
{!! do_action('theme.styles') !!}
{!! do_action('theme.scripts') !!}
```

### Publish aset

```bash
php artisan vendor:publish --tag=theme-assets --force
```

## Child themes

Child theme memungkinkan override parent theme tanpa mengubah file parent secara langsung.

### Struktur

```text
themes/
  ├── parent-theme/
  └── child-theme/
      ├── assets/
      ├── views/
      ├── functions.php
      └── theme.json
```

### Konfigurasi child

Di `theme.json` child, tentukan parent:

```json
{
    "slug": "child-theme",
    "settings": {
        "parent": "parent-theme"
    }
}
```

## Praktik terbaik

### Keamanan

- Validasi semua input.
- Escape output di Blade dengan `{{ }}` jika tidak membutuhkan HTML mentah.
- Batasi penggunaan `{!! !!}` hanya untuk konten yang sudah disanitasi.

### Kinerja

- Minify CSS/JS untuk produksi.
- Gunakan cache view dan config pada environment produksi.
- Hindari query berat langsung di template Blade.

### Maintainability

- Pecah template ke partials dan components.
- Gunakan penamaan file yang konsisten.
- Dokumentasikan hook/filter kustom di tema.
