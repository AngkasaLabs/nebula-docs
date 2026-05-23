# Media storage, variants & CDN

This page expands on [`config/media.php`](configuration.md) and the **Media** environment variables described on the [Configuration](configuration.md) page.

## Image variants

For **raster** images (not SVG or GIF), NebulaCMS can generate responsive presets after upload:

| Preset | Typical max width |
|--------|-------------------|
| `thumb` | 300 px |
| `medium` | 768 px |
| `large` | 1920 px |

Generation uses [Intervention Image](https://image.intervention.io/). Variant metadata is stored on the media record; URLs are exposed in the admin API (e.g. `variant_urls`).

- Disable variants globally with **`MEDIA_IMAGE_VARIANTS=false`**, or adjust sizes and quality in **`config/media.php`**.
- **`MEDIA_VARIANT_JPEG_QUALITY`** controls JPEG output quality (default **82**).

## Storage disks

Set **`MEDIA_DISK`** in `.env`:

| Value | Behavior |
|-------|----------|
| `public` (default) | Files under `storage/app/public`; serve via the **`public/storage`** symlink (`php artisan storage:link`). |
| `s3` | Configure **`AWS_ACCESS_KEY_ID`**, **`AWS_SECRET_ACCESS_KEY`**, **`AWS_DEFAULT_REGION`**, **`AWS_BUCKET`**, and ensure IAM allows required object operations. |

See Laravel’s [filesystem documentation](https://laravel.com/docs/filesystem) for disk configuration details.

## CDN and public URLs

- **Local `public` disk:** set **`MEDIA_URL`** to your asset base (for example `https://cdn.example.com/storage`) so `Storage::url()` and generated media URLs point at your CDN or reverse proxy.
- **S3:** set **`AWS_URL`** to your public base URL (for example a CloudFront distribution) so object URLs resolve correctly.

For a full list of **`MEDIA_*`** variables, see the **Media** subsection under [Environment variables](configuration.md).

## See also

- [Configuration](configuration.md)
- [Content model](content-model.md) — how media attaches to posts
- [Operations](operations.md) — backups, `storage/`, production notes
