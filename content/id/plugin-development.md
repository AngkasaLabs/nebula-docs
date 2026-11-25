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
- `group` memilih section sidebar (lihat tabel); nilai tak dikenal otomatis masuk `extensions`
- `icon` opsional; gunakan salah satu nama di bawah, kalau tidak sidebar memakai `Puzzle`
- `badge` opsional (`true` / string)
- `items` opsional untuk submenu (satu level)
- `match_paths` opsional untuk membantu status aktif sidebar pada route kustom
- `order` opsional (integer, default `100`); nilai kecil tampil lebih dulu di dalam section
- `permission` opsional; item hanya dibagikan ke user yang punya permission tersebut

Section dimiliki oleh core supaya sidebar tetap rapi saat plugin bertambah:

| `group` | Tampil sebagai |
| --- | --- |
| `main` | paling atas, tanpa label — untuk menu utama plugin |
| `content` | **Content Management** |
| `commerce` | **Commerce** |
| `tools` | **Tools** |
| `system` | **System** |
| `extensions` | **Extensions** — fallback untuk group tak dikenal/kosong; otomatis dilipat jadi satu item kalau isinya lebih dari enam link datar |

Group lama `admin` diperlakukan sebagai `extensions`.

Nama ikon yang didukung:

`AlignJustify`, `BarChart3`, `BookOpen`, `Boxes`, `Calendar`, `Code`, `CreditCard`, `Database`, `Download`, `File`, `FileText`, `Flag`, `Folder`, `Globe`, `Image`, `Languages`, `LayoutGrid`, `LifeBuoy`, `Mail`, `Megaphone`, `MessageSquare`, `Package`, `Paintbrush`, `Puzzle`, `Receipt`, `Route`, `ScrollText`, `Settings`, `Shield`, `ShoppingCart`, `Store`, `Tag`, `Ticket`, `Truck`, `Users`, `Wrench`, `Zap`

Admin → Plugins menampilkan warning kalau manifest memakai group atau ikon yang tidak dikenal, jadi salah tulis tidak gagal diam-diam.

Sebaiknya gunakan satu parent dengan children, bukan beberapa item datar:

```json
{
  "title": "Commerce",
  "href": "/admin/commerce",
  "group": "commerce",
  "icon": "ShoppingCart",
  "items": [
    { "title": "Shipping", "href": "/admin/commerce/shipping" },
    { "title": "Vouchers", "href": "/admin/commerce/vouchers" }
  ]
}
```

### Halaman admin Inertia prebuilt

Mulai **v1.7.0**, plugin admin berbasis React/Inertia **tidak lagi mengandalkan build Vite global milik core**. Sebagai gantinya, plugin harus membawa **bundle frontend prebuilt** miliknya sendiri agar tetap kompatibel dengan **shared hosting** dan proses upload ZIP tanpa SSH.

Struktur yang direkomendasikan:

```text
plugins/
  └── your-plugin/
      ├── plugin.json
      ├── index.php
      ├── routes.php
      ├── resources/
      │   └── js/
      │       ├── plugin-app.tsx
      │       └── pages/
      │           └── Plugins/
      │               └── YourPlugin/
      │                   └── Admin/
      │                       └── Dashboard.tsx
      ├── vite.prebuilt.config.ts
      └── dist/
          ├── manifest.json
          └── assets/
              └── *.js
```

Contoh blok `frontend` di `plugin.json`:

```json
{
  "frontend": {
    "type": "inertia-prebuilt",
    "manifest": "dist/manifest.json",
    "entrypoints": {
      "Plugins/YourPlugin/Admin/Dashboard": "resources/js/plugin-app.tsx"
    }
  }
}
```

`plugin-app.tsx` bertugas mendaftarkan page React ke runtime host Nebula:

```ts
import Dashboard from './pages/Plugins/YourPlugin/Admin/Dashboard';

window.NebulaCMS?.registerInertiaPage(
  'Plugins/YourPlugin/Admin/Dashboard',
  Dashboard,
);
```

Lalu render dari controller/plugin:

```php
return Inertia::render('Plugins/YourPlugin/Admin/Dashboard');
```

Catatan penting:

- **sertakan folder `dist/` dalam ZIP plugin production**
- `dist/manifest.json` wajib ada untuk plugin dengan `frontend.type = inertia-prebuilt`
- asset plugin akan disajikan lewat route frontend Nebula, jadi user shared hosting **tidak perlu menjalankan `npm run build` di server**
- gunakan namespace page yang unik agar tidak bentrok dengan plugin lain
- lihat **`plugins/starter-inertia-prebuilt/`** sebagai referensi resmi

### Hook baru untuk plugin

Selain manifest, NebulaCMS sekarang menyediakan extension point tambahan untuk plugin:

- `plugin.route_config` (filter) untuk memodifikasi route group plugin sebelum diregistrasikan
- `admin.navigation` (filter) untuk menambah atau memodifikasi item sidebar admin yang dibagikan ke Inertia

## Packaging dan signing

Unggahan admin (**Plugins → Upload Plugin**, **Themes → Upload Theme**) hanya menerima paket yang ditandatangani. ZIP saja akan ditolak: form mewajibkan file `.sig.json` yang cocok dari tool packaging, dan CMS memverifikasi signature Ed25519 serta SHA-256 arsip sebelum ada file yang ditulis ke disk.

Buat paket plugin dari workspace dengan:

```bash
# sekali per mesin: buat signing key (private key tersimpan di ~/.nebula/keys)
php tools/nebula-pack.php keygen local

# naikkan version di plugin.json dulu, lalu build + sign
php tools/nebula-pack.php pack plugins/my-plugin --out=dist
php tools/nebula-pack.php verify dist/my-plugin-1.0.0.zip dist/my-plugin-1.0.0.sig.json --public-key=BASE64
```

`pack` menghasilkan `my-plugin-1.0.0.zip` dan `my-plugin-1.0.0.sig.json`; unggah keduanya. `keygen` mencetak public key untuk `config/nebula.php`.

CMS memercayai key yang terdaftar di `nebula.package_signing_keys`. Key resmi sudah ditanam di `config/nebula.php` dan key dari env **ditambahkan** di atasnya, jadi cukup tambahkan key Anda sendiri:

```dotenv
NEBULA_PACKAGE_SIGNING_KEYS='{"local":"<public key Anda>"}'
```

Catatan:

- Key dengan `key_id` yang sama akan menimpa nilai bawaan. Key resmi tetap dipercaya tanpa perlu disalin ke `.env`.
- Kalau ingin memercayai **hanya** key sendiri (tanpa key resmi), set `NEBULA_PACKAGE_SIGNING_KEYS_REPLACE=true`.
- Signature mengikat slug, type, version, size, dan SHA-256, sehingga paket tidak bisa diubah setelah signing atau dipasang dengan nama/tipe lain.
- Tidak ada tombol bypass. Paket tanpa signature dari pihak ketiga ditolak by design.

## Lihat juga

- [Hooks dan filter](hooks-and-filters.md)
