# Hooks & Template Hierarchy di NebulaCMS

## Gambaran umum

NebulaCMS menyediakan sistem **hook** agar tema dan plugin dapat memperluas perilaku tanpa mengubah file inti.

- **Action**: menjalankan efek samping (misalnya logging, inject markup, dispatch event).
- **Filter**: menerima nilai, memodifikasi nilai, lalu **wajib** mengembalikan nilai hasil modifikasi.

Implementasi inti ada di `App\Services\HookService`, dengan helper global pada `app/Helpers/HookHelper.php`.

## Tempat mendaftarkan hook

| Lokasi | File | Kapan dimuat |
|--------|------|--------------|
| Tema aktif | `themes/{folder}/functions.php` | Saat bootstrap tema |
| Tema induk | `themes/{parent}/functions.php` | Dimuat sebelum child theme |
| Plugin | `plugins/{slug}/index.php` | Saat bootstrap plugin |

Gunakan `add_action` / `add_filter` untuk subscribe.  
Pemanggilan `do_action` / `apply_filters` umumnya dilakukan dari sisi core.

## Dasar penggunaan

### Action

```php
add_action('example.action', function ($arg1, $arg2) {
    // efek samping, tidak perlu return
}, 10);

do_action('example.action', $arg1, $arg2);
```

### Filter

```php
add_filter('example.filter', function ($value, $context) {
    $value['extra'] = true;
    return $value; // wajib return
}, 10, 2);

$value = apply_filters('example.filter', $value, $context);
```

### Prioritas

- Nilai prioritas lebih kecil dieksekusi lebih dulu.
- Prioritas default: `10`.

### Melepas hook

```php
remove_action('example.action', $callback, 10);
remove_filter('example.filter', $callback, 10);
```

## Template hierarchy

Resolver template menyusun daftar kandidat view berdasarkan konteks route dan data konten.

Urutan fallback umum:

- Home: `pages.home` -> `pages.index` -> `index`
- Blog/archive: `pages.blog` -> `pages.archive` -> `archive` -> `index`
- Category: `pages.category-{slug}` -> `pages.category` -> `archive` -> `index`
- Single post: `pages.{postType}-{slug}` -> `pages.{postType}` -> `pages.single` -> `single` -> `index`
- Page: `pages.page-{slug}` -> `pages.page` -> `page` -> `index`

Jika child theme aktif, resolver akan mencoba path child terlebih dahulu, lalu fallback ke parent theme.

## Hook yang sering dipakai

### Plugin lifecycle

- `plugin.loading`
- `plugin.loaded`
- `plugins.loaded`
- `plugin.register_routes`
- `plugin.route_config`
- `admin.navigation`

### Theme lifecycle

- `theme.loaded`
- `theme.before_activate`
- `theme.after_activate`
- `theme.before_delete`
- `theme.after_delete`

### Theme rendering

- `theme.styles`
- `theme.scripts`
- `theme.view_path_base`
- `theme.parent_view_path_base`
- `theme.assets_path_base`

### Frontend data hooks

- Home: `before_home_page`, `home_page_data`
- Blog: `blog_posts_query`, `blog_posts_per_page`, `blog_page_data`
- Single post: `before_single_post`, `single_post_data`, `related_posts_query`, `related_posts_count`
- Static page: `before_static_page`, `static_page_data`, `static_page_templates`

## Contoh praktis

### Menambah CSS khusus halaman home

```php
add_action('before_home_page', function () {
    echo '<style>.home-banner{padding:2rem 0}</style>';
});
```

### Mengubah jumlah post per halaman blog

```php
add_filter('blog_posts_per_page', function ($perPage) {
    return 12;
});
```

### Menambah kandidat template halaman statis

```php
add_filter('static_page_templates', function ($templates, $page) {
    if ($page === 'special') {
        array_unshift($templates, 'pages.static.special');
    }
    return $templates;
}, 10, 2);
```

## Praktik terbaik

- Gunakan nama hook yang jelas dan konsisten.
- Untuk filter, selalu jaga kompatibilitas tipe data input/output.
- Hindari query berat di callback yang dipanggil pada setiap request.
- Dokumentasikan hook kustom yang Anda publikasikan untuk tema/plugin lain.

## Lihat juga

- [Hooks dan filter](hooks-and-filters.md)
- [Sistem tema](theme-system.md)
- [Panduan pengembangan tema](theme-development-guide-full.md)
