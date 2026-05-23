# Theme system

## Location

Themes live under **`themes/{folder_name}/`**. Public assets may be mirrored or linked under **`public/themes/{folder_name}/`** depending on your workflow.

## Required concepts

- **`theme.json`** — Metadata: name, slug, version, author, optional parent theme for child themes.
- **`functions.php`** — Register hooks, filters, and enqueue CSS/JS via theme actions.
- **`views/`** — Blade templates. The active theme’s `views` path is registered with the `theme` view namespace (`theme::layouts.app`, etc.).
- **`assets/`** — CSS, JavaScript, images referenced from templates or enqueued in `functions.php`.

`App\Providers\ThemeServiceProvider` resolves the active theme from the database (`themes` table), loads parent theme views first when applicable, then child views.

## View namespace

Use **`@extends('theme::layouts.app')`** and **`theme::pages.home`** so templates resolve to the active theme directory.

## Child themes

If `theme.json` declares a parent, view paths from the parent theme can be loaded under the `parent_theme` namespace (see `ThemeServiceProvider`).

## Assets

- Link built CSS/JS with `asset('themes/{folder}/assets/...')` **or**
- Echo tags in `add_action('theme.styles')` / `theme.scripts` from `functions.php`.

## Bundled themes

The repository may ship **default**, **classic-one**, and **child-theme** examples. Custom themes are often gitignored in forks — see project `.gitignore` rules.

## Detailed reference

- **[Theme documentation (full)](theme-documentation-full.md)** — structure, configuration, hierarchy
- **[Theme development guide (full)](theme-development-guide-full.md)** — step-by-step development

## See also

- [Hooks and filters](hooks-and-filters.md)
- [Static pages](static-pages.md)
