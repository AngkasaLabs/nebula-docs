# Configuration

## Environment variables (`.env`)

### Application

| Variable | Purpose |
|----------|---------|
| `APP_NAME` | Application name |
| `APP_ENV` | `local`, `staging`, `production` |
| `APP_KEY` | Encryption key (`php artisan key:generate`) |
| `APP_DEBUG` | Must be `false` in production |
| `APP_URL` | Canonical URL (used for URLs and asset generation) |

### Database

| Variable | Purpose |
|----------|---------|
| `DB_CONNECTION` | `mysql`, `pgsql`, etc. |
| `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | Connection details |

### Session & cache

Configure as usual for Laravel (`SESSION_DRIVER`, `CACHE_STORE`, `QUEUE_CONNECTION`). For multi-server deployments, use Redis or database-backed sessions.

### Media (see `config/media.php`)

| Variable | Purpose |
|----------|---------|
| `MEDIA_DISK` | `public` (default) or `s3` |
| `MEDIA_IMAGE_VARIANTS` | `true`/`false` — generate thumb/medium/large variants |
| `MEDIA_VARIANT_JPEG_QUALITY` | JPEG quality for variants (default 82) |

When using **S3**, set `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION`, `AWS_BUCKET`, and optionally `AWS_URL` for CloudFront/CDN.

For **local public disk**, set `MEDIA_URL` if assets are served from a CDN base URL. See [Media storage, variants & CDN](media.md) for presets, disks, and CDN setup.

### Locale

The app supports session-based locale switching for public routes (`en`, `id`) via `locale.switch` (POST). Ensure your session and cookie domain settings match your deployment.

## Config files (reference)

| File | Topic |
|------|--------|
| `config/media.php` | Disk, image variants presets |
| `config/filesystems.php` | Disks including `s3` |
| `config/permission.php` | Spatie permission (if customized) |

## Further reading

- [Media storage, variants & CDN](media.md)
- [Operations](operations.md)
