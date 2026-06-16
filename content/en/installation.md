# Installation

Pick the path that matches **how comfortable you are with the terminal** (command line). You do **not** need Git, Composer, or npm on your computer if you use the **release ZIP** — that package is built for typical shared hosting.

## Choose your path

| Situation | What to do |
|-----------|------------|
| I want to install on **shared hosting** (cPanel, Plesk, etc.) and prefer **no terminal** | Use **[Install from a release ZIP](#install-from-a-release-zip)** — upload, extract, open the site, finish in the **web installer** (`/install`). |
| I am **developing locally** or I use **SSH** and know Composer / npm | Use **[Developer install](#developer-install-git-and-build)** — clone the repo, install dependencies, build assets. |

---

## Install from a release ZIP

This is the **simplest path** for people who only want to **run NebulaCMS**, not develop it. Official release archives are built in CI with **PHP dependencies (`vendor`) and frontend assets already compiled**, so you do **not** run `composer install` or `npm run build` on the server.

### 1. Download

- Open the **[Download](/download)** page on this site. It links to the **same ZIP file** as the latest **[GitHub Release](https://github.com/AngkasaLabs/NebulaCMS/releases)** (built in CI with dependencies and a production asset build).
- Save the **`nebulacms-vX.Y.Z.zip`** archive (for example `nebulacms-v1.0.1.zip`).

### 2. Upload and extract on your host

Use your host’s **File Manager**, **FTP**, or **SFTP** (not the terminal — a graphical app is fine):

1. Upload the ZIP to your account (e.g. `public_html` or a subfolder).
2. **Extract** the archive so you get a project folder containing `app`, `public`, `artisan`, etc.

### 3. Point the website to the `public` folder

Laravel serves the site from the **`public`** directory. In your hosting control panel:

- Set the **document root** (or “web root”) to **`.../your-project/public`**, **or**
- If you cannot change the document root, ask your host’s documentation or support how to point the domain at a subfolder’s `public` folder.

If the document root cannot be changed, you may need help from someone with server experience — this is a common Laravel requirement.

### 4. Create a database

In the hosting panel, create a **MySQL** database and a user with full access to it. Note the **host**, **database name**, **username**, and **password** — you will enter them in the installer.

### 5. Run the web installer (no terminal)

1. Open your site in the browser (e.g. `https://example.com`).
2. If NebulaCMS is not installed yet, you should be redirected to the **installer** at **`/install`**.
3. Follow the steps on screen: **requirements**, **database**, **site settings**, **admin account**.

You do **not** need to type shell commands for this flow. The installer writes configuration, runs migrations, and creates your first user. You also **do not** need to copy `.env.example` to `.env` by hand before opening `/install` — the wizard creates `.env` from `.env.example` when it applies your settings.

### After installation

- Sign in at **`/admin`** (see [Admin basics](admin-basics.md)).
- **Scheduled posts** in production still need the server **cron** to run Laravel’s scheduler — see [Operations](operations.md). That step often uses a one-line entry in the hosting panel (“Cron jobs”) rather than a full terminal.
- If **media uploads** fail with missing storage URLs, your host may need the **`public/storage`** symlink. Some panels offer a “run artisan” tool; otherwise ask support to run `php artisan storage:link` once, or use SSH if available.
- Starting with **v1.7.0**, React/Inertia admin plugins that ship their own `dist/` bundle can be uploaded on shared hosting **without rebuilding frontend assets on the server**. Production plugin ZIPs should include `dist/manifest.json` and their compiled asset files.

### Updates and ongoing maintenance

After the site is live, plan for **upgrades, caches, backups, and security** the same way you would for any Laravel app. A concise checklist lives under [Maintenance and updates](operations.md#maintenance-and-updates) in **Operations** — start there when you are moving to a new NebulaCMS version or tuning production.

### When the ZIP path is not enough

You may still need a **friend, agency, or hosting support** if: PHP version is below 8.3, extensions are missing, document root cannot target `public/`, or folder permissions block `storage/` and `bootstrap/cache/`.

---

## Developer install (Git and build)

Use this when you contribute to the codebase, run tests, or want the latest unreleased changes from Git.

### Requirements

- **PHP** 8.3 or newer with extensions typical for Laravel (mbstring, openssl, pdo, tokenizer, xml, ctype, json, fileinfo; BCMath recommended).
- **Composer** 2.x
- **Node.js** 20+ and **npm** (or pnpm/yarn if you adapt scripts)
- **Database**: MySQL 8+ or PostgreSQL
- **Web server**: PHP-FPM + Nginx/Apache, or `php artisan serve` for local development

### Clone and install dependencies

```bash
git clone https://github.com/AngkasaLabs/NebulaCMS nebulacms
cd nebulacms
composer install
npm install
```

### Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set at minimum:

- `APP_NAME`, `APP_URL`, `APP_ENV`, `APP_DEBUG`
- `DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- `MAIL_*` if you need email (verification, password reset)

### Database

```bash
php artisan migrate
php artisan db:seed   # optional: default roles/users if your seeders provide them
```

Create `storage` symlink for public disk uploads:

```bash
php artisan storage:link
```

### Frontend assets

```bash
npm run build
```

For development with hot reload:

```bash
npm run dev
```

### Run the application

```bash
php artisan serve
```

Visit `APP_URL` (e.g. `http://localhost:8000`). Register the first user or use seeded credentials if available. Alternatively use the **web installer** at `/install` if `storage/installed.lock` is not present.

## Common issues

| Problem | Hint |
|---------|------|
| 500 / blank page | Check `storage/logs/laravel.log`, `APP_DEBUG=true` locally |
| Vite manifest missing | Run `npm run build` or `npm run dev` (developer install); release ZIP includes a build |
| Permission errors on `storage/` or `bootstrap/cache/` | Ensure the web user can write these directories |
| Database connection refused | Verify `DB_*` and that the DB service is running |
| Installer does not appear | Ensure `storage/installed.lock` is absent and `CheckInstallation` middleware allows `/install` |

## Next steps

- [Start here](start-here.md) — pick documentation by role (editor, host, or developer)
- [Configuration](configuration.md)
- [Operations — scheduler](operations.md) for scheduled posts in production
