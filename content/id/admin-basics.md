# Dasar-dasar admin

Halaman ini menjelaskan penggunaan **panel admin** untuk kebutuhan operasional harian. Untuk daftar nama rute dan permission yang dipakai di kode, lihat **[Referensi admin](admin-reference.md)**.

Area admin umumnya berada di **`/admin`** (contoh lokal: `http://localhost:8000/admin`).

## Persiapan awal

- **Akun:** Anda memerlukan akun dengan role yang sesuai.
- **Login:** Buka `/admin`, lalu masuk dengan email dan kata sandi.
- **Verifikasi email:** Pada banyak instalasi, akses admin penuh baru diberikan setelah email diverifikasi.

## Dashboard

Setelah login, Anda akan masuk ke **Dashboard**. Halaman ini menampilkan ringkasan sistem, pintasan kerja, dan status konten sesuai hak akses akun Anda.

## Membuat postingan pertama

1. Buka menu **Posts**.
2. Klik **Create** atau **New post**.
3. Isi **title** dan **content**.
4. Tambahkan **category**, **tags**, dan **featured image** dari pustaka **Media**.
5. Simpan sebagai **draft** atau langsung **publish**.

Untuk postingan terjadwal, pastikan scheduler server aktif. Lihat [Operasional](operations.md).

## Perbedaan pages dan posts

- **Posts**: konten kronologis (umumnya artikel/blog).
- **Pages**: konten statis seperti "About", "Contact", dan laman informasi lain.

## Media library

Menu **Media** dipakai untuk unggah, kelola, dan pakai ulang aset file. Untuk gambar raster, sistem dapat membentuk varian ukuran agar penyajian frontend lebih efisien.

## Users, roles, dan akses

Administrator dapat menambah pengguna dan menetapkan role. Jika sebuah menu tidak terlihat, biasanya akun Anda belum memiliki permission terkait.

## Themes, plugins, menus, settings

- **Themes**: mengatur tampilan publik situs.
- **Plugins**: menambah kemampuan fungsional.
- **Menus**: menyusun struktur navigasi.
- **Settings**: mengatur parameter aplikasi.

## Jika terjadi error

- **403 Forbidden:** cek role/permission akun.
- **500 Internal Server Error:** periksa log Laravel di server (`storage/logs`).

## Lihat juga

- [Referensi admin](admin-reference.md)
- [Model konten](content-model.md)
- [Keamanan](security.md)
