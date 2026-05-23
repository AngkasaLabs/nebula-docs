# Halaman statis

Halaman statis **tidak** disimpan di database. Halaman ini berupa **template Blade** di tema aktif, lalu diakses lewat route **catch-all**:

```text
GET /{page}  →  static.page
```

Parameter `{page}` divalidasi (alfanumerik, underscore, hyphen). Controller akan merender template menggunakan **template hierarchy** dan hook terkait (lihat `FrontendController::staticPage`).

## Keamanan

- Validasi slug mencegah serangan path traversal.
- Hanya pola template yang diizinkan (whitelist) yang dapat dirender; jika tidak cocok, respons **404** dikembalikan.

## Panduan lengkap

Untuk alur detail, urutan fallback, dan contoh implementasi:

- **[Halaman statis (lengkap)](static-pages-full.md)**

## Lihat juga

- [Perutean Frontend](frontend-routing.md)
- [Sistem tema](theme-system.md)
