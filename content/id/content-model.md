# Model konten (posts & pages)

## Postingan (tabel `posts`)

| Bidang | Keterangan |
|-----------------|---------|
| `user_id` | Penulis (foreign key ke `users`) |
| `category_id` | Satu kategori per postingan |
| `title`, `slug` | Slug unik untuk URL |
| `excerpt`, `content` | Isi konten |
| `featured_image_id` | Referensi media (opsional) |
| `status` | Umumnya `draft`, `published`, `scheduled` (dapat bertambah sesuai migrasi) |
| `published_at` | Waktu publikasi (untuk urutan dan scheduling) |
| `views` | Jumlah tayangan (jika diaktifkan) |
| Soft delete | `deleted_at` |

### Author accessor

Model `Post` mengekspos **`author`** sebagai accessor yang setara dengan **`user`** demi kompatibilitas tema. Query dan foreign key tetap menggunakan **`user_id`**, bukan `author_id`.

### Taksonomi

- **Category:** relasi `belongsTo` ke satu kategori.
- **Tag:** relasi `belongsToMany` melalui tabel pivot `post_tag`.

### Scopes

Scope umum meliputi `published()`, `scheduled()`, dan `draft()` — lihat `App\Models\Post`.

## Pages (tabel `pages`)

Page disimpan di database dengan slug dan kontennya sendiri, lalu dikelola dari **Admin -> Pages**. Rendering dilakukan oleh controller frontend dan template tema (lihat [Perutean frontend](frontend-routing.md)).

## Media (tabel `media`)

File disimpan pada disk terkonfigurasi (`public` atau `s3`). Metadata/JSON varian gambar dipakai untuk menyediakan URL responsif.

## Categories & tags

- **Category:** bisa hierarkis atau datar sesuai implementasi; setiap post merujuk satu category.
- **Tag:** relasi many-to-many dengan post.

## Revisi

Post dapat menyimpan histori revisi (model `PostRevision`) untuk pemulihan versi sebelumnya (rollback) dari UI admin.

## Lihat juga

- [Dasar-dasar admin](admin-basics.md)
- [Referensi admin](admin-reference.md)
- [Penyimpanan media, varian, dan CDN](media.md)
- [REST API](rest-api.md) untuk konten published
