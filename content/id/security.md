# Keamanan

## Rekomendasi utama

- Selalu perbarui Laravel dan dependensi proyek.
- Gunakan `APP_DEBUG=false` pada produksi.
- Aktifkan HTTPS dan secure cookie/session.
- Terapkan prinsip **least privilege** untuk akun database dan IAM (misalnya S3/AWS).

## Autentikasi & otorisasi

- Gunakan login dengan verifikasi email.
- Aktifkan 2FA jika diperlukan.
- Kelola akses dengan role/permission (Spatie Permission), bukan pengecekan ad-hoc.

## Konten publik & media

- Escape output Blade dengan `{{ }}` untuk mencegah XSS.
- Gunakan `{!! !!}` hanya untuk konten yang sudah disanitasi.
- Lindungi route dan filesystem dari serangan path traversal.

## Header keamanan dan CSP

Setiap respons web mengirim `X-Content-Type-Options`, `X-Frame-Options: DENY`,
`Referrer-Policy`, `Permissions-Policy`, `Cross-Origin-Opener-Policy`, dan HSTS saat
request HTTPS. Content Security Policy dikirim sebagai **report-only** di 1.13 dengan
nonce per-request untuk inline script tema dan route Ziggy; browser mengirim laporan ke
`/csp-report`, yang dibatasi rate dan ukurannya. Set `SECURITY_CSP_REPORT_ONLY=false`
untuk menegakkannya setelah laporan bersih, atau matikan lewat
`SECURITY_HEADERS_ENABLED=false` / `SECURITY_CSP_ENABLED=false` jika reverse proxy sudah
menangani header ini.

## Sanitasi HTML

HTML editor disanitasi di server sebelum disimpan untuk user tanpa permission
`unfiltered_html` (default: hanya Admin dan Super Admin). Script, event handler, URL
`javascript:`, inline style, iframe, dan object dibuang; heading, list, tabel, gambar, dan
link aman dipertahankan. Revisi post disanitasi saat dipulihkan.

Konten juga disanitasi **saat dirender di situs publik**, sehingga data lama tidak bisa
menjalankan script walau belum dibersihkan. Untuk membersihkan HTML yang tersimpan, buka
**Settings → Security → Content HTML safety**:

1. **Scan content** memeriksa hingga 2.000 item dan menampilkan yang akan berubah.
2. **Sanitise N item(s)** menulis HTML hasil sanitasi. Jalankan scan lagi untuk batch
   berikutnya pada situs besar.

Audit yang sama tersedia lewat CLI untuk operator:

```bash
php artisan content:sanitize            # dry run: laporkan item yang akan berubah
php artisan content:sanitize --apply    # tulis HTML hasil sanitasi
```

## Akses konten draf

Pastikan route pratinjau draft dilindungi middleware yang sesuai agar konten non-publik tidak terbuka.

## Pelaporan kerentanan

Jika menemukan celah keamanan, kirim laporan ke **security@angkasalabs.com** dan jangan publikasikan detail eksploit di issue publik.

Panduan resmi tersedia di:
[`SECURITY.md`](https://github.com/AngkasaLabs/nebula-cms/blob/main/SECURITY.md)

## Lihat juga

- [Konfigurasi](configuration.md)
- [Dasar-dasar admin](admin-basics.md)
