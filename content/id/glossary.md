# Glosarium Istilah (EN-ID)

Dokumen ini menjadi acuan istilah teknis untuk dokumentasi NebulaCMS Bahasa Indonesia.
Tujuannya menjaga konsistensi diksi, bobot bahasa, dan ketepatan makna lintas dokumen.

## Prinsip umum

- Gunakan padanan Indonesia jika maknanya jelas dan lazim.
- Pertahankan istilah serapan/English jika lebih presisi secara teknis.
- Hindari menerjemahkan istilah teknis secara harfiah jika membuat makna kabur.
- Gunakan istilah yang sama secara konsisten di semua halaman.

## Istilah inti

| English | Istilah baku di docs ID | Catatan pemakaian |
|--------|--------------------------|-------------------|
| Admin panel | panel admin | Bentuk utama di semua dokumen |
| Action | action | Jangan diterjemahkan menjadi "aksi" jika merujuk hook API |
| API endpoint | endpoint API | Boleh "titik akhir API" dalam konteks naratif |
| Asset | aset | Standar umum |
| Authentication | autentikasi | |
| Authorization | otorisasi | |
| Backup | backup | Boleh "pencadangan" pada kalimat formal |
| Blade template | template Blade | |
| Build | build | Boleh "proses build" |
| Cache | cache | Bukan "singgahan" |
| Callback | callback | |
| Catch-all route | route catch-all | |
| Child theme | child theme | Boleh "tema turunan" saat penjelasan |
| Configuration | konfigurasi | |
| Content model | model konten | |
| Controller | controller | |
| Core | core | Boleh "inti sistem" jika konteks naratif |
| Cron job | cron job | |
| Database | database | |
| Debug | debug | |
| Deployment | deployment | Boleh "penerapan" jika dibutuhkan konteks |
| Draft | draft | |
| Environment variables | variabel lingkungan | |
| Fallback | fallback | |
| Featured image | featured image | Boleh "gambar unggulan" jika konteks editorial |
| Filter | filter | Jangan diterjemahkan jadi "saringan" untuk nama fitur |
| Foreign key | foreign key | |
| Frontend | frontend | |
| Full-text | full-text | |
| Helper | helper | |
| Hook | hook | Jangan diterjemahkan jadi "pengait" untuk nama fitur |
| Hosting | hosting | |
| Inertia response | response Inertia | |
| JSON payload | payload JSON | |
| Locale | locale | |
| Manifest | manifest | |
| Media library | media library | Boleh "pustaka media" pada konteks UI |
| Middleware | middleware | |
| Migration | migrasi | |
| Namespace | namespace | |
| Page | page | Boleh "halaman" pada konteks umum UI |
| Parent theme | parent theme | Boleh "tema induk" pada penjelasan |
| Permission | permission | Bukan "izin kuasa" |
| Plugin | plugin | |
| Post | post | Boleh "postingan" pada konteks editorial |
| Preview | preview | Boleh "pratinjau" di kalimat umum |
| Publish | publish | Boleh "terbitkan" sebagai kata kerja UI |
| Queue | queue | |
| Rate limiting | rate limiting | |
| Release | rilis | |
| Render | render | Boleh "merender" dalam kalimat teknis |
| Repository | repositori | |
| Request | request | |
| Response | response | |
| REST API | REST API | |
| Role | role | |
| Route | route | Bukan "rute" jika merujuk nama route kode |
| Scheduler | scheduler | |
| Scope | scope | |
| Seed / seeder | seed / seeder | |
| Slug | slug | |
| Soft delete | soft delete | |
| Stack | stack | |
| Static page | halaman statis | |
| Storage disk | storage disk | |
| Template hierarchy | template hierarchy | |
| Theme | tema | |
| Upload | upload | Boleh "unggah" pada konteks UI umum |
| User | user | Boleh "pengguna" pada konteks non-kode |
| Validation | validasi | |
| Variant (image) | varian gambar | |
| View | view | Boleh "tampilan" pada konteks naratif |
| Web installer | web installer | |
| Worker | worker | |

## Pedoman gaya istilah

- Untuk nama API/fungsi/kunci konfigurasi, gunakan bentuk asli:
  - `add_action`, `apply_filters`, `theme.styles`, `APP_DEBUG`, `MEDIA_DISK`.
- Untuk narasi, gunakan bentuk baku yang tetap teknis:
  - "Route ini dilindungi middleware `auth`."
  - "Filter harus mengembalikan nilai hasil modifikasi."
- Saat istilah punya dua bentuk yang sama-sama lazim, pilih satu sebagai default:
  - gunakan **route** (bukan rute) untuk konteks kode,
  - gunakan **permission** (bukan izin) untuk konteks role/ACL,
  - gunakan **hook**/**filter** sebagai istilah fitur.

## Contoh konsistensi kalimat

- "Panel admin memakai route `admin.posts.index` dan memeriksa permission yang relevan."
- "Tema dapat memperluas perilaku melalui hook `theme.loaded` dan filter data view."
- "Jika template tidak ditemukan, resolver akan memakai fallback sesuai template hierarchy."
