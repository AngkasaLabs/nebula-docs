# Panduan Halaman Statis

## Gambaran umum

NebulaCMS menyediakan sistem aman dan fleksibel untuk membuat halaman statis yang dikodekan manual (bukan disimpan di database). Cocok untuk halaman seperti "Tentang Kami", "Visi & Misi", "Kontak", dan halaman informatif lain berbasis Blade template.

## Fitur keamanan

- **Validasi input:** slug halaman divalidasi untuk mencegah path traversal.
- **Perlindungan path traversal:** hanya karakter alfanumerik, underscore, dan hyphen yang diizinkan.
- **Route constraints:** parameter URL dibatasi dengan pola regex.
- **Dukungan tema dinamis:** memakai tema aktif, bukan nilai hardcoded.
- **Template spesifik:** hanya halaman yang memiliki template yang cocok akan dirender.
- **404 untuk template tidak ada:** respons error yang benar jika template halaman tidak ditemukan.

## Cara kerja

### Definisi route

Route halaman statis didefinisikan sebagai catch-all route di `web.php`:

```php
Route::get('/{page}', [FrontendController::class, 'staticPage'])
    ->name('static.page')
    ->where('page', '[a-zA-Z0-9_-]+');
```

### Method controller

Method `staticPage` pada `FrontendController` memproses request dengan langkah berikut:

1. **Security validation:** memvalidasi parameter halaman.
2. **Dynamic theme support:** memakai tema aktif saat ini.
3. **Hook integration:** menjalankan action `before_static_page` dan filter terkait.
4. **Template hierarchy:** mencari template berurutan:
   - `pages.static.{page}`
   - `pages.{page}`
   - `static.{page}`
5. **Fallback handling:** mencoba namespace `theme::pages.static.{page}` jika perlu.
6. **404 response:** mengembalikan 404 jika template tidak ditemukan.

### Hierarki template

Urutan pencarian template:

1. `pages.static.{page}` - template statis spesifik
2. `pages.{page}` - template halaman umum
3. `static.{page}` - template statis alternatif
4. `theme::pages.static.{page}` - fallback namespace tema

## Membuat halaman statis

### Metode 1: file template kustom

Buat file template spesifik di direktori:

```text
themes/{theme}/views/pages/static/
├── simple-static.blade.php
├── ...
```

Setiap halaman statis harus memiliki file template sendiri.

Contoh:

```text
themes/default/views/pages/static/simple-static.blade.php
```

Akses melalui URL:

```text
https://yoursite.com/simple-static
```

### Metode 2: contoh template

**File:** `themes/default/views/pages/static/simple-static.blade.php`

```blade
@extends('theme::layouts.app')

@section('title', 'Simple Static Page')
@section('meta_description', 'This is a simple static page.')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1>Halo Dunia</h1>
</div>
@endsection

@push('scripts')
<script>
    console.log('Simple Static Page loaded');
</script>
@endpush
```

### Metode 3: hook system

Anda dapat mengubah perilaku halaman statis lewat hook/filter.

**File:** `themes/default/functions.php`

```php
add_filter('static_page_data', function ($data, $page) {
    if ($page === 'simple-static') {
        $data['company_name'] = 'Nama Perusahaan Anda';
        $data['founded_year'] = '2020';
    }
    return $data;
}, 10, 2);

add_filter('static_page_templates', function ($templates, $page) {
    if ($page === 'special') {
        array_unshift($templates, "custom.special");
    }
    return $templates;
}, 10, 2);
```

## Data yang tersedia di template

Variabel umum yang tersedia:

- `$page_slug`: slug halaman statis saat ini.
- `$theme`: nama folder tema aktif.

## Troubleshooting

### Halaman selalu 404

- Pastikan file template ada di:
  `themes/{theme}/views/pages/static/{page}.blade.php`
- Pastikan nama file sama persis dengan slug URL.
- Pastikan karakter slug sesuai pola route (`a-z`, `A-Z`, `0-9`, `_`, `-`).

### Template tidak terpakai

- Cek urutan hierarki template.
- Cek apakah filter `static_page_templates` mengubah urutan template.
- Pastikan tema yang aktif memang tema yang berisi template tersebut.

## Rekomendasi

- Simpan halaman statis di direktori terstruktur dan gunakan penamaan slug yang konsisten.
- Hindari logika berat di Blade; pindahkan ke controller/filter data.
- Dokumentasikan template statis dan slug penting agar tim mudah memelihara.
