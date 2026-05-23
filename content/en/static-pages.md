# Static pages

Static pages are **not** stored as database records. They are **Blade templates** inside the active theme, reached via the **catch-all** route:

```text
GET /{page}  →  static.page
```

The `{page}` segment is validated (alphanumeric, underscore, hyphen). The controller resolves a template using **template hierarchy** and hooks — see `FrontendController::staticPage`.

## Security

- Slug validation prevents path traversal.
- Only whitelisted template patterns are resolved; missing templates return **404**.

## Authoritative guide

Full behavior, hierarchy order, and examples:

- **[Static pages (full)](static-pages-full.md)**

## See also

- [Frontend routing](frontend-routing.md)
- [Theme system](theme-system.md)
