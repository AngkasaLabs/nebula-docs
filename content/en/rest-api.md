# REST API

Public JSON endpoints are defined in `routes/api.php`.

## Published posts

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/posts` | Paginated list of **published** posts |
| GET | `/api/v1/posts/{slug}` | Single **published** post by slug |

### Query parameters (`index`)

- **`per_page`** — Page size (capped, e.g. max 50 in controller implementation)

### Response shape

Responses use **`PostResource`** — fields include category, tags, user (author), featured image as exposed by the API resource.

Implementation: `App\Http\Controllers\Api\V1\PostController`.

## Authenticated user

| Method | Endpoint | Middleware |
|--------|----------|------------|
| GET | `/api/user` | `auth:sanctum` |

Returns the authenticated user for token-based clients.

## Authentication

Configure **Laravel Sanctum** (or your chosen guard) for SPA/mobile tokens. Public post endpoints are typically **unauthenticated** read-only.

## CORS & rate limiting

Configure `config/cors.php` and rate limiting in `RouteServiceProvider` or `bootstrap/app.php` as needed for production APIs.

## See also

- [Content model](content-model.md)
