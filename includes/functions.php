<?php
/**
 * =====================================================================
 *  Harvest Pro - Helper functions
 * =====================================================================
 */

require_once __DIR__ . '/config.php';

/**
 * Load every row from `settings` into an associative array (cached).
 */
function get_settings(): array
{
    global $pdo;
    static $cache = null;
    if ($cache !== null) {
        return $cache;
    }
    $cache = [];
    $rows = $pdo->query("SELECT setting_key, setting_value FROM settings")->fetchAll();
    foreach ($rows as $row) {
        $cache[$row['setting_key']] = $row['setting_value'];
    }
    return $cache;
}

/**
 * Get a single setting value, with an optional fallback.
 */
function setting(string $key, string $default = ''): string
{
    $settings = get_settings();
    return isset($settings[$key]) && $settings[$key] !== '' ? $settings[$key] : $default;
}

/**
 * HTML-escape a string.
 */
function e(?string $value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

/**
 * Convert a setting value into an escaped, <br>-joined multi-line string.
 */
function nl2br_e(?string $value): string
{
    return nl2br(e($value));
}

/**
 * Resolve a stored image value (uploaded filename or full URL) to a usable URL.
 */
function resolve_image_url(string $value, string $fallback = ''): string
{
    if ($value === '') {
        return $fallback;
    }
    // Already a full URL?
    if (preg_match('#^https?://#i', $value)) {
        return $value;
    }
    return UPLOAD_URL . ltrim($value, '/');
}

/**
 * Return the URL for an uploaded image setting, or a placeholder path.
 */
function image_url(string $key, string $fallback = ''): string
{
    return resolve_image_url(setting($key, ''), $fallback);
}

/**
 * Fetch active feature cards, ordered.
 */
function get_features(): array
{
    global $pdo;
    return $pdo->query(
        "SELECT * FROM features WHERE is_active = 1 ORDER BY sort_order ASC, id ASC"
    )->fetchAll();
}

/**
 * Fetch active hero slides, ordered.
 */
function get_hero_slides(): array
{
    global $pdo;
    return $pdo->query(
        "SELECT * FROM hero_slides WHERE is_active = 1 ORDER BY sort_order ASC, id ASC"
    )->fetchAll();
}
