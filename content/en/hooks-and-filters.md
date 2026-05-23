# Hooks and filters

NebulaCMS uses a **HookService** modeled on common CMS hook patterns:

- **Actions** — `do_action('name', ...)`; listeners use `add_action('name', callable, priority)`.
- **Filters** — `apply_filters('name', $value, ...)`; listeners must **return** the modified value via `add_filter`.

Helpers are defined in `app/Helpers/HookHelper.php` and loaded from `HookServiceProvider`.

## Registration order

1. Core providers register default hooks.
2. **Plugins** load (`plugins/{slug}/index.php` or equivalent).
3. **Theme** `functions.php` runs for parent then child theme.

Use **`remove_action` / `remove_filter`** if you need to unregister callbacks (match priority and callable).

## Common use cases

- Inject analytics or meta tags on `theme.styles` / `theme.scripts`.
- Adjust blog query via `blog_posts_query` or per-view data filters (see codebase for exact hook names).
- Extend single post data with `single_post_data` filter.

## Full reference

Hook names, execution order, and examples:

- **[Hooks and templates (full)](hooks-and-templates-full.md)**

Use that file as the detailed catalog; this page is the entry point.

## See also

- [Plugin development](plugin-development.md)
- [Theme system](theme-system.md)
