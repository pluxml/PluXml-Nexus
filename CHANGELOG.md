# Changelog

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
