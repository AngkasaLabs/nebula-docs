# Admin basics

This page describes the **admin panel** in everyday language. For route names and permissions used in code, see **[Admin reference](admin-reference.md)**.

The admin area is usually at **`/your-site/admin`** (for example `http://localhost:8000/admin` in local development).

## Before you can work

- **Account:** You need a user account with a role that allows the actions you need (for example creating posts).
- **Sign in:** Open `/admin` and log in with your email and password.
- **Verified email:** Many installs require you to **confirm your email** once before the full admin is available. Check your inbox for a verification link if you see a notice after login.

## Dashboard

After login you typically land on the **Dashboard**. It gives shortcuts and an overview; exact widgets depend on your NebulaCMS version and permissions.

## Creating your first post

1. Open **Posts** (or **Content**) from the sidebar.
2. Choose **Create** / **New post**.
3. Enter a **title** and **body** using the editor.
4. Optionally set a **category**, **tags**, and a **featured image** (often chosen from the **Media** library or uploaded while editing).
5. Save as **draft** to keep working, or **Publish** when ready.

**Scheduled posts:** Publishing at a future time needs the site’s **scheduler** to run in production. See [Operations](operations.md).

## Pages vs posts

- **Posts** are usually dated blog-style content (news, articles).
- **Pages** are often used for “About”, “Contact”, or other standalone screens. Your theme decides how they appear on the public site.

## Media library

Use **Media** to upload images and files, organize folders if your site supports it, and reuse assets across posts and pages. Images may automatically get smaller sizes (thumbnails) for faster loading.

## Users and access

**Administrators** can invite users and assign **roles**. Roles control who can edit content, manage themes, or change settings. If something is “missing” from your menu, your account may not have that permission.

## Themes, plugins, menus, settings

- **Themes** change how the public site looks (Blade templates, CSS). Only change the active theme if you know what you are doing on a live site.
- **Plugins** add features; they are often installed as ZIP files from the admin when supported.
- **Menus** define navigation for the frontend (labels and links), depending on your theme.
- **Settings** cover site name, SEO, profile, security (including optional two-factor authentication), and similar options.

## If something goes wrong

- **403 / access denied:** Your role may not include that area — ask an administrator.
- **500 errors or blank screens:** Usually a server or configuration issue; someone with server access should check application logs.

## See also

- [Admin reference](admin-reference.md) — route and permission tables for developers.
- [Content model](content-model.md) — how posts, pages, and taxonomies relate.
- [Security](security.md) — good practices for accounts and permissions.
