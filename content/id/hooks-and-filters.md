# Hooks dan filters

NebulaCMS menggunakan `HookService` dengan pola hook CMS yang lazim:

- **Action**: `do_action('name', ...)` untuk mengeksekusi efek samping.
- **Filter**: `apply_filters('name', $value, ...)` untuk memodifikasi nilai.

Untuk mendaftarkan callback:

- `add_action('name', callable, priority)`
- `add_filter('name', callable, priority, accepted_args)`

Callback pada filter **wajib** mengembalikan nilai hasil modifikasi.

Helper hook tersedia di `app/Helpers/HookHelper.php` dan dimuat oleh `HookServiceProvider`.

## Urutan pendaftaran

1. Core provider mendaftarkan hook bawaan.
2. Plugin dimuat (`plugins/{slug}/index.php`).
3. `functions.php` tema dimuat (parent lalu child).

Gunakan `remove_action` / `remove_filter` untuk melepas callback (priority dan callable harus cocok).

## Contoh penggunaan umum

- Menyisipkan tag CSS/JS melalui `theme.styles` dan `theme.scripts`.
- Menyesuaikan query blog dengan `blog_posts_query`.
- Memperkaya data halaman single post melalui `single_post_data`.

## Referensi lengkap

- **[Hooks dan template hierarchy (lengkap)](hooks-and-templates-full.md)**

Halaman ini adalah ringkasan. Untuk katalog hook yang lebih detail, gunakan dokumen referensi lengkap.

## Lihat juga

- [Pengembangan plugin](plugin-development.md)
- [Sistem tema](theme-system.md)
