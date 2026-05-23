# Sistem tema

## Lokasi

Tema berada di bawah **`themes/{folder_name}/`**. Aset publik dapat dipublikasikan ke **`public/themes/{folder_name}/`** sesuai alur kerja deployment.

## Konsep inti

- **`theme.json`** — metadata tema (name, slug, version, author), termasuk opsi parent untuk child theme.
- **`functions.php`** — pendaftaran hooks, filters, dan pemanggilan aset CSS/JS.
- **`views/`** — template Blade tema yang diregistrasi pada namespace `theme::`.
- **`assets/`** — CSS, JavaScript, dan gambar untuk kebutuhan frontend.

`App\Providers\ThemeServiceProvider` menentukan tema aktif dari tabel `themes`, memuat parent theme terlebih dahulu (jika ada), lalu child theme.

## Namespace tampilan

Gunakan **`@extends('theme::layouts.app')`** dan referensi seperti **`theme::pages.home`** agar resolver view selalu mengarah ke direktori tema aktif.

## Child themes

Jika `theme.json` mendeklarasikan parent theme, path view parent dapat diakses melalui namespace `parent_theme` (lihat `ThemeServiceProvider`).

## Aset

- Tautkan CSS/JS build lewat `asset('themes/{folder}/assets/...')`, atau
- Cetak tag aset melalui `add_action('theme.styles')` dan `add_action('theme.scripts')` di `functions.php`.

## Tema bawaan

Repositori dapat menyertakan tema contoh seperti **default**, **classic-one**, dan **child-theme**. Tema kustom biasanya diabaikan (`.gitignore`) pada fork proyek.

## Referensi lengkap

- **[Dokumentasi tema (lengkap)](theme-documentation-full.md)** — struktur, konfigurasi, hierarchy
- **[Panduan pengembangan tema (lengkap)](theme-development-guide-full.md)** — panduan implementasi langkah demi langkah

## Lihat juga

- [Hooks dan filters](hooks-and-filters.md)
- [Halaman statis](static-pages.md)
