# Glossary of Terms (EN-ID)

This page is the terminology reference for the NebulaCMS Indonesian documentation.
Its purpose is to keep diction, tone, and meaning consistent across every document.

## General principles

- Use the Indonesian equivalent when the meaning is clear and commonly used.
- Keep the English or borrowed term when it is technically more precise.
- Avoid literal translations of technical terms when they make the meaning unclear.
- Use the same term consistently on every page.

## Core terms

| English | Standard term in ID docs | Usage notes |
|--------|--------------------------|-------------|
| Admin panel | panel admin | Primary form in all documents |
| Action | action | Do not translate to "aksi" when it refers to an API hook |
| API endpoint | endpoint API | "titik akhir API" is acceptable in narrative context |
| Asset | aset | Common standard |
| Authentication | autentikasi | |
| Authorization | otorisasi | |
| Backup | backup | "pencadangan" is acceptable in formal sentences |
| Blade template | template Blade | |
| Build | build | "proses build" is acceptable |
| Cache | cache | Not "singgahan" |
| Callback | callback | |
| Catch-all route | route catch-all | |
| Child theme | child theme | "tema turunan" is acceptable when explaining |
| Configuration | konfigurasi | |
| Content model | model konten | |
| Controller | controller | |
| Core | core | "inti sistem" is acceptable in narrative context |
| Cron job | cron job | |
| Database | database | |
| Debug | debug | |
| Deployment | deployment | "penerapan" is acceptable when context requires it |
| Draft | draft | |
| Environment variables | variabel lingkungan | |
| Fallback | fallback | |
| Featured image | featured image | "gambar unggulan" is acceptable in editorial context |
| Filter | filter | Do not translate to "saringan" for a feature name |
| Foreign key | foreign key | |
| Frontend | frontend | |
| Full-text | full-text | |
| Helper | helper | |
| Hook | hook | Do not translate to "pengait" for a feature name |
| Hosting | hosting | |
| Inertia response | response Inertia | |
| JSON payload | payload JSON | |
| Locale | locale | |
| Manifest | manifest | |
| Media library | media library | "pustaka media" is acceptable in UI context |
| Middleware | middleware | |
| Migration | migrasi | |
| Namespace | namespace | |
| Page | page | "halaman" is acceptable in general UI context |
| Parent theme | parent theme | "tema induk" is acceptable when explaining |
| Permission | permission | Not "izin kuasa" |
| Plugin | plugin | |
| Post | post | "postingan" is acceptable in editorial context |
| Preview | preview | "pratinjau" is acceptable in general sentences |
| Publish | publish | "terbitkan" is acceptable as a UI verb |
| Queue | queue | |
| Rate limiting | rate limiting | |
| Release | rilis | |
| Render | render | "merender" is acceptable in technical sentences |
| Repository | repositori | |
| Request | request | |
| Response | response | |
| REST API | REST API | |
| Role | role | |
| Route | route | Not "rute" when it refers to a code route name |
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
| Upload | upload | "unggah" is acceptable in general UI context |
| User | user | "pengguna" is acceptable outside code context |
| Validation | validasi | |
| Variant (image) | varian gambar | |
| View | view | "tampilan" is acceptable in narrative context |
| Web installer | web installer | |
| Worker | worker | |

## Term style guidelines

- For API names, functions, and configuration keys, use the original form:
  - `add_action`, `apply_filters`, `theme.styles`, `APP_DEBUG`, `MEDIA_DISK`.
- In narrative text, use the standard form while keeping it technical:
  - "This route is protected by the `auth` middleware."
  - "The filter must return the modified value."
- When a term has two equally common forms, pick one as the default:
  - use **route** (not "rute") in code context,
  - use **permission** (not "izin") in role/ACL context,
  - use **hook**/**filter** as feature terms.

## Sentence consistency examples

- "The admin panel uses the `admin.posts.index` route and checks the relevant permission."
- "Themes can extend behaviour through the `theme.loaded` hook and view data filters."
- "If the template is not found, the resolver falls back according to the template hierarchy."
