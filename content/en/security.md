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
