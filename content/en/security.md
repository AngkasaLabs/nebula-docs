# Security

## Principles

- Keep **Laravel and dependencies** updated (`composer update` with testing).
- **`APP_DEBUG=false`** in production; never expose `.env`.
- Use **HTTPS** everywhere; set secure cookie flags via session config behind HTTPS.
- **Least privilege** for database users and cloud IAM (S3, etc.).

## Authentication & authorization

- Staff use the admin panel with **verified email** and optional **two-factor authentication** (TOTP) under Settings.
- **Roles and permissions** (Spatie) gate features such as audit log access.

## Content & uploads

- Validate and sanitize user content in themes; the admin uses structured editors but always escape output in Blade (`{{ }}` vs `{!! !!}`).
- **Media** and **theme asset** routes validate paths to prevent traversal (see `web.php` theme asset route).

## Supply chain

- **Plugin and theme packages** are signed (Ed25519 + SHA-256) and verified before install,
  both from the admin upload form and from the marketplace. The signed slug and package
  type are bound to the archive.
- **Core release archives** are signed from v1.13.0 and verified by the updater before
  extraction; unsigned releases at or above that version are rejected.
- The private signing key stays offline (`~/.nebula/keys`). CI only builds **draft**
  releases; the archive is signed locally and the `.sig.json` is attached before publishing.

## Security headers and CSP

Every web response carries `X-Content-Type-Options`, `X-Frame-Options: DENY`,
`Referrer-Policy`, `Permissions-Policy`, `Cross-Origin-Opener-Policy`, and HSTS when the
request is HTTPS. A Content Security Policy is sent as **report-only** in 1.13 with a
per-request nonce for the inline theme bootstrap and Ziggy routes; browsers post violations
to `/csp-report`, which is throttled and size-capped. Set `SECURITY_CSP_REPORT_ONLY=false`
to enforce it once reports are clean, or `SECURITY_HEADERS_ENABLED=false` /
`SECURITY_CSP_ENABLED=false` when a reverse proxy already handles these headers.

## HTML sanitisation

Editor HTML is sanitised on the server before it is stored for any user without the
`unfiltered_html` permission (Admin and Super Admin hold it by default). Scripts, event
handlers, `javascript:` URLs, inline styles, iframes, and objects are removed; headings,
lists, tables, images, and safe links are kept. Post revisions are sanitised when restored.

Content is also sanitised **when it is rendered on the public site**, so rows written before
this policy existed cannot execute scripts even if nobody cleans them first. To clean the
stored HTML itself, use **Settings → Security → Content HTML safety**:

1. **Scan content** checks up to 2,000 items and lists those that would change.
2. **Sanitise N item(s)** writes the cleaned HTML back. Run the scan again to continue with
   the next batch on large sites.

The same audit is available on the command line for operators:

```bash
php artisan content:sanitize            # dry run: report items that would change
php artisan content:sanitize --apply    # write the sanitised HTML back
```

## Static & preview routes

- Static page slugs are constrained by regex.
- Preview routes use dedicated middleware to limit who can view unpublished content.

## Reporting security vulnerabilities

Security of NebulaCMS is a top priority. If you discover a vulnerability, please report it **responsibly**.

**Do not open a public GitHub issue for security reports.**

Send details to **security@angkasalabs.com**. Include:

1. Description of the issue  
2. Steps to reproduce  
3. Potential impact  
4. Suggested fixes (if any)

The maintainers aim to acknowledge reports within **24 hours**, verify impact, ship fixes, and credit reporters when desired. Supported release line: **1.x**.

The same policy is maintained in the repository as [`SECURITY.md`](https://github.com/AngkasaLabs/nebula-cms/blob/main/SECURITY.md) on GitHub.

## See also

- [Configuration](configuration.md)
- [Admin basics](admin-basics.md)
- [Admin reference](admin-reference.md)
