# Start here

Welcome to the NebulaCMS documentation. Pick a path that matches **what you want to do first** — you can always read the rest later.

## I write or edit content (editor, blogger, site owner)

You do not need to know Laravel or PHP to publish posts and pages.

1. Make sure the site is installed and you can open the admin URL (usually **`/admin`**). If you are setting up the server yourself, follow [Installation](installation.md) first.
2. Read **[Admin basics](admin-basics.md)** for signing in, email verification, creating a post, uploading media, and publishing.
3. When you need exact screen names or permissions in code or support tickets, use **[Admin reference](admin-reference.md)** (route names and permissions).

## I install or host the CMS (server, DevOps)

1. **[Installation](installation.md)** — start with **Install from a release ZIP** if you want to avoid the terminal; use the **Developer install** section only if you clone from Git and use Composer/npm.
2. **[Configuration](configuration.md)** — environment variables and important config files.
3. **[Media storage, variants & CDN](media.md)** — uploads, S3, image sizes, and CDN base URLs.
4. **[Operations](operations.md)** — scheduler, cron, and production notes (needed for scheduled posts).

## I build themes or plugins (developer)

1. **[Overview](overview.md)** — how the stack fits together (admin, frontend, hooks, plugins).
2. **[Theme system](theme-system.md)** and **[Plugin development](plugin-development.md)** — structure, `theme.json`, `plugin.json`, lifecycle.
3. **[Hooks and filters](hooks-and-filters.md)** — extending behavior without changing core files.
4. **Extended references** on the [documentation home](/docs) — long-form companions to the guides above (full theme docs, hook catalog, and similar). Prefer the shorter pages first; open a &ldquo;full&rdquo; article when you need exhaustive detail.

## I integrate or automate (API)

- **[REST API](rest-api.md)** — JSON endpoints for published content.

## See also

- [About NebulaCMS](about-nebulacms.md) — project goals, documentation languages, community
- [Overview](overview.md)
- [Installation](installation.md)
