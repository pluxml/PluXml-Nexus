# Changelog

## 2.2 - 2026-11-26

- ADD theme illustration image upload in backoffice (add/edit)
- ADD theme image display on theme list and theme detail pages

## 2.1 - 2026-11-24

- FIX profiles: list users who only have themes and show their themes on the profile page

## 2.0 - 2026-11-23

- Themes management (add, remove, edit, search)
- Upgrade Slim from 4.12.0 to 4.15.3 (nikic/fast-route 1.3.1, psr/http-factory 1.1.0, psr/log 3.0.2)
- Supports PHP 8.4/8.5 and PHPStan 2
- Security: escape HTML entities in the default error renderer (CVE-2026-48157)
- Security: stop decoding route arguments twice to prevent route constraint bypass (GHSA-h377-p8x2-prf9)

## 1.8 - 2026-11-04

- ADD PluXml Nexus version displayed in the backoffice for admin users (#2)
- FIX warning on profile edit: undefined array key "password" (#3)
- FIX empty website displayed on the profile page (#4)

## 1.7 - 2026/11/04

**Warning** : this release needs a `composer dump-autoload` (`App/helpers.php` is now loaded by the Composer autoloader)

- ADD timestamp comparison on signup form submission against bots
- ADD handle active category
- FIX typo in lost password mail template
- FIX security: backoffice actions were run before checking the authentication
- FIX security: users could edit the profile or password of another user
- FIX security: users could edit or delete the plugins of other users
- FIX security: SQL injection in all database queries
- FIX security: XSS in all views (escaped output, only http(s) links accepted)
- FIX new plugin file ignored when editing a plugin
- FIX profile website never saved
- FIX profile website mandatory
- FIX clear error message when a plugin file exceeds the server upload limit
- FIX plugin edit errors displayed on the edit form
- ADD `.user.ini` raising the PHP upload limit to 10M for plugin files (denied in `.htaccess`)
- OTHER view helpers loaded by the Composer autoloader

## 1.6 - 2023/11/17

**Warning** : `settings.php` needs to be updated with new constants (see `setting-sample.php` : `MAIL_LOSTPASSWORD_SUBJECT` and `MAIL_LOSTPASSWORD_BODY`)

- FIX active tabs CSS class
- FIX syntax error on themes view
- FIX lost password

## 1.5 - 2023/11/17

- ADD user can change his password
- FIX error when removing a user
- FIX add plugin form Warning: Undefined array key
- FIX add plugin save Warning: Undefined array key
- OTHER dependencies update
