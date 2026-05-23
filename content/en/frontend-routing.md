# Frontend routing

Public routes are defined in `routes/web.php` (plus included files). Order matters: **specific routes must be registered before the static catch-all.**

## Main routes

| Method | URI | Name | Purpose |
|--------|-----|------|---------|
| GET | `/` | `home` | Home page |
| GET | `/feed.xml` | `feed.rss` | RSS feed |
| GET | `/sitemap.xml` | `sitemap` | XML sitemap |
| GET | `/preview/post/{post}` | `preview.post` | Preview post (middleware: preview allowed) |
| GET | `/preview/page/{page}` | `preview.page` | Preview page |
| POST | `/locale/{locale}` | `locale.switch` | Switch locale (`en` or `id`) |
| GET | `/blog` | `blog` | Blog index |
| GET | `/blog/{slug}` | `blog.post` | Single post |
| GET | `/pages/{slug}` | `page` | Database page by slug |

## Theme assets

| GET | `themes/{theme}/{path}` | Serves files from `themes/{theme}/` with path traversal protection |

## Static pages (catch-all)

| GET | `/{page}` | `static.page` | Theme Blade templates for static pages (e.g. `/about` → `about`, `/download` → marketing download page) |

**Constraint:** `page` must match `[a-zA-Z0-9_-]+`. This route is **last** so it does not shadow `/blog`, `/admin`, etc.

## Admin & auth

`routes/admin.php`, `routes/auth.php`, and `routes/settings.php` are included **before** the static catch-all so `/admin` and login routes work.

## Previews

Preview routes use middleware to ensure only allowed users (e.g. editors) can see unpublished content. Configure policies/middleware accordingly.

## Further reading

- [Static pages](static-pages.md)
- [Theme system](theme-system.md)
