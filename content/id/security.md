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

## Akses konten draf

Pastikan route pratinjau draft dilindungi middleware yang sesuai agar konten non-publik tidak terbuka.

## Pelaporan kerentanan

Jika menemukan celah keamanan, kirim laporan ke **security@angkasalabs.com** dan jangan publikasikan detail eksploit di issue publik.

Panduan resmi tersedia di:
[`SECURITY.md`](https://github.com/AngkasaLabs/nebula-cms/blob/main/SECURITY.md)

## Lihat juga

- [Konfigurasi](configuration.md)
- [Dasar-dasar admin](admin-basics.md)
