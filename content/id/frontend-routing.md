# Perutean frontend

Rute publik didefinisikan di `routes/web.php` (beserta file route terkait). Urutan pendaftaran sangat penting: **rute spesifik harus didefinisikan sebelum rute catch-all**.

## Rute utama

| Metode | URI | Nama rute | Tujuan |
|--------|-----|-----------|--------|
| GET | `/` | `home` | Halaman beranda |
| GET | `/feed.xml` | `feed.rss` | Umpan RSS |
| GET | `/sitemap.xml` | `sitemap` | Peta situs XML |
| GET | `/preview/post/{post}` | `preview.post` | Pratinjau post (middleware permission pratinjau) |
| GET | `/preview/page/{page}` | `preview.page` | Pratinjau page |
| POST | `/locale/{locale}` | `locale.switch` | Beralih locale (`en` atau `id`) |
| GET | `/blog` | `blog` | Indeks blog |
| GET | `/blog/{slug}` | `blog.post` | Single post |
| GET | `/pages/{slug}` | `page` | Page berbasis database (slug) |

## Aset tema

| GET | `themes/{theme}/{path}` | Menyajikan aset dari `themes/{theme}/` dengan proteksi path traversal |

## Halaman statis (catch-all)

| GET | `/{page}` | `static.page` | Merender halaman statis berbasis Blade (`/about`, `/download`, dll) |

**Batasan:** parameter `page` dibatasi pola `[a-zA-Z0-9_-]+`. Route ini harus diletakkan di **akhir** agar tidak menimpa route utama seperti `/blog` atau `/admin`.

## Admin & otentikasi

Route di `routes/admin.php`, `routes/auth.php`, dan `routes/settings.php` harus dimuat **sebelum** static catch-all agar alur autentikasi/otorisasi admin tetap benar.

## Pratinjau

Route pratinjau dilindungi middleware agar hanya pengguna berizin (editor/staf terkait) yang dapat mengakses konten pratinjau.

## Lihat juga

- [Halaman statis](static-pages.md)
- [Sistem tema](theme-system.md)
