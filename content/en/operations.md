# Operations & deployment

## Maintenance and updates

Keeping NebulaCMS healthy in production is mostly **routine Laravel operations**:

1. **Application updates** — When you deploy a new release, follow your usual process (Git pull or upload, `composer install` if needed, `npm run build` for developer installs, run migrations). Release ZIP installs should use a fresh CI-built archive when upgrading between versions.
2. **Database migrations** — Run `php artisan migrate` after updates when release notes say the schema changed.
3. **Caches** — After changing config or routes in production, refresh caches (see [Caches](#caches) below) or clear them from **Settings** when the admin offers it.
4. **Dependencies** — Keep PHP and database versions within the ranges stated in [Installation](installation.md).

For **scheduled content** and **backups**, use the sections below. If you are still installing or moving hosts, see [Installation](installation.md) first.

## Task scheduler (scheduled posts)

NebulaCMS registers a schedule in `routes/console.php`:

- Command: `posts:publish-scheduled`
- Frequency: **every minute**

Laravel only runs scheduled tasks when **cron** invokes the scheduler:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

Without cron, scheduled posts will not flip to `published` automatically.

**Local development:** run `php artisan schedule:work` in a separate terminal to test scheduling.

## Caches

Use `php artisan config:cache`, `route:cache`, and `view:cache` in production after deploy; clear via admin **Settings** or Artisan when configuration changes.

## Queues

If you offload work to queues, run workers under **supervisor** or a managed worker service and set `QUEUE_CONNECTION` appropriately.

## Backups

- **Database:** regular dumps (mysqldump, pg_dump, or managed backups).
- **Files:** `storage/app` (uploads) and `public/storage` symlink target; if using S3, rely on bucket policies and versioning.
- **Pre-update backups:** the in-admin updater stores archives in `storage/app/backups` and keeps the newest 5 by default. Change the limit with `NEBULA_BACKUP_RETENTION`, or delete old archives from **Settings → System Update**.

## HTTPS

Set `APP_URL` with `https://` and terminate TLS at your reverse proxy or load balancer.

## See also

- [Installation](installation.md)
- [Configuration](configuration.md)
- [Media storage, variants & CDN](media.md)
- [Security](security.md)
