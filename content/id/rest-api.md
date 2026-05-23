# REST API

Endpoint API tersedia di `routes/api.php`.

## Konten publik (published)

| Method | Endpoint | Keterangan |
|--------|----------|------------|
| GET | `/api/v1/posts` | Daftar post published dengan pagination |
| GET | `/api/v1/posts/{slug}` | Detail post published berdasarkan slug |

### Query parameter

- `per_page`: jumlah item per halaman (dibatasi di sisi controller).

### Bentuk respons

Respons memakai `PostResource` dan mencakup data post beserta relasi utama (kategori, tag, author, dan media terkait jika ada).

Controller: `App\Http\Controllers\Api\V1\PostController`.

## Endpoint user terautentikasi

| Method | Endpoint | Middleware |
|--------|----------|------------|
| GET | `/api/user` | `auth:sanctum` |

Endpoint ini mengembalikan data user dari sesi/token yang valid.

## Otentikasi

Untuk endpoint yang dilindungi, gunakan mekanisme autentikasi yang sesuai (misalnya Laravel Sanctum) untuk klien SPA, mobile, atau integrasi server-to-server.

## CORS & rate limiting

- Atur CORS di `config/cors.php`.
- Terapkan rate limiting pada route/API group untuk melindungi server produksi dari penyalahgunaan.
