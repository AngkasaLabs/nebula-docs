# Content model (posts & pages)

## Posts (`posts` table)

| Field (concept) | Notes |
|-----------------|--------|
| `user_id` | Author (foreign key to `users`) |
| `category_id` | Single category per post |
| `title`, `slug` | Unique slug for URLs |
| `excerpt`, `content` | Body content |
| `featured_image_id` | Optional media reference |
| `status` | Typically `draft`, `published`, `scheduled` (and other states if migrations add them) |
| `published_at` | Used for ordering and scheduled publishing |
| `views` | View counter (if enabled) |
| Soft deletes | `deleted_at` |

### Author accessor

The `Post` model exposes **`author`** as an accessor that returns the same as **`user`** (for theme compatibility). Queries and foreign keys use **`user_id`**, not `author_id`.

### Taxonomies

- **Category:** `belongsTo` one category.
- **Tags:** `belongsToMany` via `post_tag` pivot.

### Scopes

Common scopes include `published()`, `scheduled()`, `draft()` — see `App\Models\Post`.

## Pages (`pages` table)

CMS pages stored in the database with their own slug and content, managed from **Admin → Pages**. They are rendered through the frontend controller and theme templates (see [Frontend routing](frontend-routing.md)).

## Media (`media` table)

Files stored on the configured disk (`public` or `s3`). Image variants may be stored in JSON/metadata for responsive URLs.

## Categories & tags

- **Category:** hierarchical or flat depending on implementation; posts reference one category.
- **Tag:** many-to-many with posts.

## Revisions

Posts may store revision history (`PostRevision` model) for rollback from the admin UI.

## Further reading

- [Admin basics — Posts & pages](admin-basics.md)
- [Admin reference](admin-reference.md)
- [Media storage, variants & CDN](media.md) — uploads, disks, and URLs
- [REST API](rest-api.md) for published posts only
