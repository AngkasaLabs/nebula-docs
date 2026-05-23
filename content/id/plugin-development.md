# Pengembangan plugin

## Struktur direktori

```text
plugins/
  └── your-plugin/
      ├── plugin.json   # wajib
      └── index.php     # entry point
```

## `plugin.json` (manifest)

Minimal berisi:

- `name`, `slug`, `version`
- `description`, `author` (disarankan)
- `requires.cms_version` untuk kompatibilitas versi CMS

Contoh:

```json
{
  "name": "Hello World",
  "slug": "hello-world",
  "version": "1.0.0",
  "description": "Contoh plugin sederhana",
  "author": "Nama Anda",
  "requires": { "cms_version": "^1.0.0" }
}
```

## `index.php` (bootstrap)

File ini dimuat saat plugin diaktifkan. Gunakan untuk:

- mendaftarkan hooks (`add_action`, `add_filter`),
- mendaftarkan service/container binding,
- menyiapkan inisialisasi plugin.

Contoh referensi plugin internal:

- `plugins/hello-world/`
- `plugins/reading-time/`

## Kustomisasi Routing (`routes.php`)

Di samping `index.php`, Anda juga dapat menambahkan file `routes.php` di dalam folder plugin. Secara default semua route yang didaftarkan di sini akan otomatis diberi prefix `/_plugin/nama-slug-plugin` beserta *route name prefix* `plugin.nama-slug-plugin.` untuk mencegah tabrakan dengan core CMS.

Mulai sekarang perilaku route group ini bisa dikustomisasi dari `plugin.json` melalui blok `routes`:

```json
{
  "routes": {
    "prefix": "admin/catalog",
    "name_prefix": "admin.catalog",
    "middleware": ["web", "auth", "verified"]
  }
}
```

Catatan:

- `prefix` akan dipasang ke seluruh route di `routes.php`
- `name_prefix` akan ditambahkan otomatis sebagai prefix nama route; titik penutup akan ditambahkan bila belum ada
- `middleware` harus berupa array nama middleware Laravel
- bila blok ini tidak diisi, NebulaCMS tetap memakai prefix aman bawaan `/_plugin/{slug}`
- bila Anda memakai prefix seperti `admin/catalog`, tanggung jawab menghindari bentrok route berada pada plugin tersebut

Contoh `routes.php` untuk konfigurasi di atas:

```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => 'Catalog index')->name('index');
```

Route di atas akan tersedia di URL `/admin/catalog` dengan nama route `admin.catalog.index`.

## Pengaturan Plugin (Settings UI)

Plugin dapat mengatur form *Settings* secara otomatis di menu Admin UI. Cukup definisikan `settings_schema` di `plugin.json` Anda.

```json
  "settings_schema": {
    "fields": [
      { "key": "api_key", "label": "API Key", "type": "text" },
      { "key": "enable_feature", "label": "Enable Feature", "type": "boolean", "default": true }
    ]
  }
```

Nilai-nilai ini akan disimpan sebagai JSON di database pada tabel `plugins`.

## Uninstall Hook (`uninstall.php`)

Ketika pengguna menghapus sebuah plugin melalui Admin UI, file `uninstall.php` (jika ada) akan dijalankan tepat sebelum foldernya dihapus secara permanen. Hal ini sangat berguna untuk proses pembersihan sisa database atau file temporary milik plugin. Sistem akan mengatur environment variable `NEBULA_PLUGIN_UNINSTALL=1` selama eksekusi berlangsung.

## Dependensi & Validasi Syarat Minimum

Anda dapat membatasi batas minimum kompatibilitas yang dibutuhkan dengan mendefinisikannya di blok `requires` di `plugin.json`. Ini tidak hanya memeriksa versi PHP/CMS, tetapi juga dapat memaksakan kebutuhan dependensi dengan plugin lain (melalui `requires.plugins`). NebulaCMS memastikan plugin yang merupakan *dependency* dimuat terlebih dahulu menggunakan fitur *Topological Sort*.

```json
  "requires": {
    "cms_version": "^1.0.0",
    "php": "^8.3",
    "plugins": ["nama-slug-plugin-lain"]
  }
```

## Admin UI

Daftar plugin tersedia di menu **Admin -> Plugins** untuk aktivasi, deaktivasi, pengaturan (*settings*), scan, upload, dan hapus plugin.

### Menambahkan menu admin dari manifest

Plugin kini dapat menambahkan item ke sidebar admin melalui `plugin.json` tanpa perlu mengubah core:

```json
{
  "admin_navigation": [
    {
      "title": "Catalog",
      "href": "/admin/catalog",
      "group": "content",
      "icon": "LayoutGrid",
      "match_paths": ["/admin/catalog", "/admin/catalog/*"]
    }
  ]
}
```

Field yang didukung:

- `title` dan `href` wajib
- `group` opsional: `main`, `content`, atau `admin` (default `admin`)
- `icon` opsional, saat ini mendukung nama ikon sidebar core seperti `ScrollText`, `FileText`, `Settings`, `Puzzle`, `Users`, `Shield`, `Image`, `Paintbrush`, `AlignJustify`, `File`, dan `LayoutGrid`
- `badge` opsional (`true` / string)
- `items` opsional untuk submenu
- `match_paths` opsional untuk membantu status aktif sidebar pada route kustom

### Halaman Inertia milik plugin

Plugin kini dapat menyimpan halaman admin React/TSX di dalam folder plugin sendiri, jadi tidak perlu menaruh page kustom di `resources/js/pages` milik core.

Struktur yang direkomendasikan:

```text
plugins/
  └── your-plugin/
      └── resources/
          └── js/
              └── pages/
                  └── Plugins/
                      └── YourPlugin/
                          └── Admin/
                              └── Dashboard.tsx
```

Lalu render dari controller/plugin:

```php
return Inertia::render('Plugins/YourPlugin/Admin/Dashboard');
```

Catatan:

- resolver Inertia Nebula akan mencari page di core dan juga di `plugins/*/resources/js/pages`
- gunakan namespace page yang unik agar tidak bentrok dengan plugin lain
- pendekatan ini menjaga boundary antara core Nebula dan UI milik plugin eksternal

### Hook baru untuk plugin

Selain manifest, NebulaCMS sekarang menyediakan extension point tambahan untuk plugin:

- `plugin.route_config` (filter) untuk memodifikasi route group plugin sebelum diregistrasikan
- `admin.navigation` (filter) untuk menambah atau memodifikasi item sidebar admin yang dibagikan ke Inertia

## Lihat juga

- [Hooks dan filter](hooks-and-filters.md)
