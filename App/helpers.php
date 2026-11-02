<?php
/**
 * Global helpers available in the views
 */

/**
 * Escape a value for output in HTML text or in a quoted attribute
 *
 * @param mixed $value
 * @return string
 */
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Return the URL only if it uses the http or https scheme, so that a user supplied
 * link can not run script (javascript:, data:...)
 *
 * @param mixed $url
 * @return string
 */
function safe_url($url): string
{
    return preg_match('#^https?://#i', (string) $url) ? (string) $url : '';
}
