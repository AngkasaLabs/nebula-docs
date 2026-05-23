# Admin reference (routes & permissions)

The admin panel lives under **`/admin`**. Access requires authentication and **verified email** (`verified` middleware). URLs below are route names you can use in code (`route('admin...')`).

## Dashboard

- **Route:** `admin.dashboard`
- Overview widgets and shortcuts (varies by version).

## Audit log

- **Route:** `admin.audit-log.index`
- **Permission:** `view audit log`
- Lists security-relevant events (sign-ins, content changes) when activity logging is enabled.

## Media

- **Routes:** `admin.media.index`, `admin.media.store`, `admin.media.show`, `admin.media.destroy`, `admin.media.download`
- **Folders:** `admin.media.folders.store`, `admin.media.folders.destroy`
- **Bulk:** `admin.media.bulk-destroy`, `admin.media.move`
- Upload files, organize folders, move/delete assets. Raster images may get **variants** (thumb/medium/large) per `config/media.php`.

## Categories & tags

- **Categories:** `admin.categories.*` (resource)
- **Tags:** `admin.tags.*` (resource)
- Used to classify **posts**. Create before or while editing posts.

## Posts

- **Resource routes:** `admin.posts.index`, `create`, `store`, `show`, `edit`, `update`, `destroy`
- **Publish / unpublish:** `admin.posts.publish`, `admin.posts.unpublish`
- **Autosave:** `admin.posts.autosave`, `admin.posts.autosave.update`
- **Revisions:** `admin.posts.revisions`, `admin.posts.revisions.restore`
- **Bulk actions:** `admin.posts.bulk-action`

Workflow: create drafts, attach category/tags and featured image, publish or schedule. **Scheduled** posts require the scheduler in production (see [Operations](operations.md)).

## Pages

- **Resource routes:** `admin.pages.*`
- **Publish / unpublish:** `admin.pages.publish`, `admin.pages.unpublish`
- Database-backed pages (distinct from theme static pages — see [Static pages](static-pages.md)).

## Users & roles

- **Users:** `admin.users.*` (resource)
- **Roles:** `admin.roles.*` (no `show`)

Assign roles to control access. Permissions are managed via Spatie Permission; some routes (e.g. audit log) check named permissions.

## Themes

- **Routes:** `admin.themes.index`, `admin.themes.activate`, `admin.themes.scan`, `admin.themes.destroy`, `admin.themes.upload`
- Scan the filesystem for themes, activate one, upload ZIP if supported, remove unused themes (with care).

## Plugins

- **Routes:** `admin.plugins.index`, `admin.plugins.activate`, `admin.plugins.deactivate`, `admin.plugins.scan`, `admin.plugins.destroy`, `admin.plugins.upload`

## Menus

- **Resource:** `admin.menus.*`
- **Items:** `admin.menus.items.store`, `admin.menus.items.bulk-store`, `admin.menus.items.update`, `admin.menus.items.destroy`, `admin.menus.items.reorder`

Build navigation structures for the frontend (consumption depends on theme).

## Settings

- **General / SEO:** `admin.settings.general`, `admin.settings.seo`, `admin.settings.update`
- **Cache:** `admin.settings.clear-cache`
- **Security / 2FA:** `admin.settings.security`, `admin.settings.two-factor.*`
- **Profile:** `profile.edit`, `profile.update`, `profile.destroy`
- **Password:** `password.edit`, `password.update`
- **Appearance:** `appearance` (Inertia page)

## Tips

- Use **roles** instead of ad-hoc checks for new staff.
- Clear application cache after changing settings that affect config caches in production.

## See also

- [Admin basics](admin-basics.md) — task-oriented help for editors and first-time users.
- [Content model](content-model.md)
- [Security](security.md)
