# Plugin development

## Layout

```
plugins/
  └── your-plugin/
      ├── plugin.json      # Manifest (required)
      └── index.php        # Bootstrap (or path from Plugin model)
```

## `plugin.json`

Contains at minimum:

- `name`, `slug`, `version`
- `description`, `author`, `author_url` (recommended)
- `requires.cms_version` — semver constraint when applicable

Example (simplified):

```json
{
  "name": "Hello World",
  "slug": "hello-world",
  "version": "1.0.0",
  "description": "Example plugin.",
  "author": "Your Name",
  "requires": { "cms_version": "^1.0.0" }
}
```

## Bootstrap file

The active plugin’s entry file is loaded during application boot (see `PluginServiceProvider`). Use it to:

- Call `add_action` / `add_filter`
- Register bindings if needed

Study **`plugins/hello-world/`** and **`plugins/reading-time/`** in the repository.

## Custom Routing (`routes.php`)

In addition to `index.php`, you can create a `routes.php` file in your plugin folder. By default, any route registered here is prefixed with `/_plugin/your-plugin-slug` and given the name prefix `plugin.your-plugin-slug.` to prevent conflicts with core CMS routes.

You can now override that route group through the `routes` block in `plugin.json`:

```json
{
  "routes": {
    "prefix": "admin/catalog",
    "name_prefix": "admin.catalog",
    "middleware": ["web", "auth", "verified"]
  }
}
```

Notes:

- `prefix` is applied to every route in `routes.php`
- `name_prefix` is applied to route names; a trailing dot is added automatically when missing
- `middleware` must be an array of Laravel middleware names
- if omitted, NebulaCMS keeps the safe default `/_plugin/{slug}` prefix
- if you choose a custom prefix such as `admin/catalog`, the plugin is responsible for avoiding route collisions

Example `routes.php`:

```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => 'Catalog index')->name('index');
```

With the manifest above, that route becomes available at `/admin/catalog` with the route name `admin.catalog.index`.

## Plugin Settings (Settings UI)

Plugins can effortlessly render a Settings form in the Admin UI. Simply define a `settings_schema` in your `plugin.json`.

```json
  "settings_schema": {
    "fields": [
      { "key": "api_key", "label": "API Key", "type": "text" },
      { "key": "enable_feature", "label": "Enable Feature", "type": "boolean", "default": true }
    ]
  }
```

These values are saved as JSON in the database on the `plugins` table.

## Uninstall Hook (`uninstall.php`)

When a user deletes a plugin from the Admin UI, the `uninstall.php` file (if it exists) will be executed right before the folder is permanently deleted. This is ideal for cleaning up database leftovers or temporary files. The system will set `NEBULA_PLUGIN_UNINSTALL=1` in the environment during its execution.

## Dependencies and Requirement Validation

You can strictly enforce minimum constraints, preventing users from activating the plugin if they aren't met, using the `requires` block in `plugin.json`. This also supports enforcing dependencies on other plugins (`requires.plugins`). NebulaCMS guarantees that dependency plugins are loaded first by sorting them topologically.

```json
  "requires": {
    "cms_version": "^1.0.0",
    "php": "^8.3",
    "plugins": ["another-plugin-slug"]
  }
```

## Admin UI

Plugins appear under **Admin → Plugins** (scan, activate, deactivate, upload, settings, delete). Permissions may apply depending on configuration.

### Add admin sidebar items from the manifest

Plugins can now register admin sidebar items directly from `plugin.json` without patching core:

```json
{
  "admin_navigation": [
    {
      "title": "Catalog",
      "href": "/admin/catalog",
      "group": "content",
      "icon": "LayoutGrid",
      "match_paths": ["/admin/catalog", "/admin/catalog/*"]
    }
  ]
}
```

Supported fields:

- `title` and `href` are required
- `group` is optional: `main`, `content`, or `admin` (defaults to `admin`)
- `icon` is optional; currently it supports the core sidebar icon names such as `ScrollText`, `FileText`, `Settings`, `Puzzle`, `Users`, `Shield`, `Image`, `Paintbrush`, `AlignJustify`, `File`, and `LayoutGrid`
- `badge` is optional (`true` or a string)
- `items` is optional for submenus
- `match_paths` is optional and helps the sidebar stay active on custom route trees

### Plugin-owned Inertia pages

Plugins can now keep their React/TSX admin pages inside the plugin folder instead of placing custom pages under the core `resources/js/pages` directory.

Recommended structure:

```text
plugins/
  └── your-plugin/
      └── resources/
          └── js/
              └── pages/
                  └── Plugins/
                      └── YourPlugin/
                          └── Admin/
                              └── Dashboard.tsx
```

Then render it from the plugin/controller:

```php
return Inertia::render('Plugins/YourPlugin/Admin/Dashboard');
```

Notes:

- the Nebula Inertia resolver now scans both the core pages and `plugins/*/resources/js/pages`
- use a unique page namespace to avoid collisions with other plugins
- this keeps a clean boundary between the Nebula core and external plugin UI

### New plugin hooks

In addition to manifest-based configuration, NebulaCMS now exposes these extension points for plugin authors:

- `plugin.route_config` (filter) to modify the plugin route group before registration
- `admin.navigation` (filter) to append or transform admin sidebar items shared through Inertia

## See also

- [Hooks and filters](hooks-and-filters.md)
- [Hooks and templates (full) — plugin section](hooks-and-templates-full.md)
