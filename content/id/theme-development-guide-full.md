# Panduan Pengembangan Tema NebulaCMS

Panduan ini menjelaskan langkah praktis membuat tema NebulaCMS dari awal sampai siap dipublikasikan. Dokumen ini melengkapi [Dokumentasi Tema](theme-documentation-full.md) dan [Hooks & Template Hierarchy](hooks-and-templates-full.md).

## Daftar isi

1. [Persiapan](#persiapan)
2. [Membuat struktur tema](#membuat-struktur-tema)
3. [Membuat file konfigurasi tema](#membuat-file-konfigurasi-tema)
4. [Membuat `functions.php`](#membuat-functionsphp)
5. [Membuat layout utama](#membuat-layout-utama)
6. [Membuat template halaman](#membuat-template-halaman)
7. [Mengelola aset tema](#mengelola-aset-tema)
8. [Menggunakan hook dan filter](#menggunakan-hook-dan-filter)
9. [Membuat child theme](#membuat-child-theme)
10. [Mempublikasikan tema](#mempublikasikan-tema)

## Persiapan

Sebelum mulai, pastikan:

1. NebulaCMS sudah terpasang dan berjalan.
2. Anda memahami dasar PHP, HTML, CSS, dan JavaScript.
3. Anda memahami dasar templating Blade Laravel.
4. Anda memakai editor kode (misalnya VS Code, Sublime Text, atau PhpStorm).

## Membuat struktur tema

Buat struktur direktori tema di folder `themes`:

```bash
mkdir -p themes/my-theme/assets/{css,js,images}
mkdir -p themes/my-theme/views/{layouts,partials,pages,components}
touch themes/my-theme/theme.json
touch themes/my-theme/functions.php
```

Contoh struktur:

```text
themes/
  └── my-theme/
      ├── assets/
      │   ├── css/
      │   ├── js/
      │   └── images/
      ├── views/
      │   ├── layouts/
      │   ├── partials/
      │   ├── pages/
      │   └── components/
      ├── functions.php
      └── theme.json
```

## Membuat file konfigurasi tema

File `theme.json` menyimpan metadata dan konfigurasi tema:

```json
{
    "name": "My Theme",
    "slug": "my-theme",
    "version": "1.0.0",
    "description": "Tema kustom untuk NebulaCMS",
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
        "layout": {
            "container-width": "1200px",
            "sidebar": "right"
        }
    }
}
```

## Membuat `functions.php`

File `functions.php` dipakai untuk mendaftarkan hook, filter, menu, sidebar, dan aset tema.

```php
<?php

add_action('theme.loaded', function ($theme) {
    register_theme_menus();
    register_theme_sidebars();
    enqueue_theme_assets();
});

function enqueue_theme_assets(): void
{
    add_action('theme.styles', function () {
        echo '<link rel="stylesheet" href="' . theme_asset('css/style.css') . '">';
    });

    add_action('theme.scripts', function () {
        echo '<script src="' . theme_asset('js/main.js') . '"></script>';
    });
}
```

## Membuat layout utama

Buat file `views/layouts/app.blade.php` sebagai layout dasar:

```php
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    {!! do_action('theme.styles') !!}
    @stack('styles')
</head>
<body>
    @include('theme::partials.header')
    <main class="main-content">@yield('content')</main>
    @include('theme::partials.footer')
    {!! do_action('theme.scripts') !!}
    @stack('scripts')
</body>
</html>
```

## Membuat template halaman

Buat template inti berikut:

- `views/partials/header.blade.php`
- `views/partials/footer.blade.php`
- `views/pages/home.blade.php`
- `views/pages/blog.blade.php`
- `views/pages/post.blade.php`

Semua halaman sebaiknya mewarisi layout utama:

```php
@extends('theme::layouts.app')
```

## Mengelola aset tema

Simpan CSS di `assets/css/style.css` dan JavaScript di `assets/js/main.js`, lalu muat melalui hook `theme.styles` dan `theme.scripts`.

## Menggunakan hook dan filter

Hook dan filter memungkinkan kustomisasi tanpa mengubah file inti.

```php
add_filter('blog_posts_per_page', function ($perPage) {
    return 12;
});
```

Contoh lain:

- `home_page_data` untuk menambah data halaman home.
- `related_posts_query` untuk mengubah query related posts.

## Membuat child theme

Child theme dipakai agar kustomisasi tetap aman saat parent theme diperbarui.

Contoh struktur:

```text
themes/
  ├── my-theme/
  └── my-child-theme/
      ├── assets/
      ├── views/
      ├── functions.php
      └── theme.json
```

Contoh `theme.json` child theme:

```json
{
    "name": "My Child Theme",
    "slug": "my-child-theme",
    "version": "1.0.0",
    "description": "Child theme dari My Theme",
    "author": "Nama Anda",
    "preview": "assets/images/preview.svg",
    "requires": {
        "cms_version": "^1.0.0"
    },
    "settings": {
        "parent": "my-theme"
    }
}
```

Contoh memuat aset parent + child:

```php
add_action('theme.loaded', function ($theme) {
    add_action('theme.styles', function () {
        echo '<link rel="stylesheet" href="' . parent_theme_asset('css/style.css') . '">';
        echo '<link rel="stylesheet" href="' . theme_asset('css/style.css') . '">';
    }, 5);
});
```

## Mempublikasikan tema

Publikasikan aset tema ke direktori publik:

```bash
php artisan vendor:publish --tag=theme-assets --force
```

Aktifkan tema:

```bash
php artisan theme:activate my-theme
```

Buat paket ZIP untuk distribusi:

```bash
php artisan theme:package my-theme
```

File ZIP akan dibuat di `storage/app/themes`.

## Penutup

Dengan alur di atas, Anda bisa membangun tema NebulaCMS yang rapi, dapat dipelihara, dan siap dipakai di produksi.
