<?php
/**
 * =====================================================================
 *  Harvest Pro - Helper functions
 * =====================================================================
 */

require_once __DIR__ . '/config.php';

/**
 * =====================================================================
 *  Language switching (English / Sinhala)
 * ---------------------------------------------------------------------
 *  ?lang=si|en sets the choice for this session; it then sticks until
 *  changed again. translate()/t() do an exact-string dictionary lookup
 *  and fall back to the original English when a string isn't in the
 *  dictionary (e.g. content an admin edited after it was written), so
 *  nothing ever renders blank.
 * =====================================================================
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'si'], true)) {
    $_SESSION['lang'] = $_GET['lang'];
}
define('CURRENT_LANG', $_SESSION['lang'] ?? 'en');

$GLOBALS['TRANSLATIONS_SI'] = require __DIR__ . '/translations-si.php';

function current_lang(): string
{
    return CURRENT_LANG;
}

/**
 * Translate a piece of admin-authored English content to Sinhala when the
 * visitor has chosen Sinhala. Exact-match dictionary lookup only — values
 * that aren't prose (colors, filenames, URLs, phone numbers…) simply never
 * match a dictionary key and pass through untouched.
 */
function translate(?string $text): string
{
    $text = (string)$text;
    if ($text === '' || current_lang() !== 'si') {
        return $text;
    }
    return $GLOBALS['TRANSLATIONS_SI'][$text] ?? $text;
}

/**
 * Short alias for translate(), for literal strings written in templates.
 */
function t(?string $text): string
{
    return translate($text);
}

/**
 * Resolve a piece of admin-authored content that has its own manually
 * entered Sinhala field (e.g. a hero slide's headline_si) — used for
 * per-row database content that the exact-match dictionary in
 * translate() can never cover, since an admin can add new rows with
 * arbitrary text at any time. Falls back to the dictionary (for content
 * that matches an old default) and then to the English original.
 */
function localized(string $english, ?string $sinhalaOverride): string
{
    if (current_lang() === 'si' && $sinhalaOverride !== null && $sinhalaOverride !== '') {
        return $sinhalaOverride;
    }
    return translate($english);
}

/**
 * One-time schema migration: adds per-slide Sinhala columns to hero_slides
 * if they aren't there yet, so existing installs don't need a manual SQL
 * step. Tracked via a settings flag so the check only runs once ever.
 */
function ensure_hero_slide_si_columns(): void
{
    global $pdo;
    static $checked = false;
    if ($checked) {
        return;
    }
    $checked = true;
    if (setting('schema_hero_si_migrated') === '1') {
        return;
    }
    // Best-effort: if the DB user lacks ALTER privileges or anything else
    // goes wrong, fail silently rather than taking the whole site down —
    // slides simply keep falling back to the dictionary/English until this
    // succeeds (e.g. on a later request, or after a manual DDL grant).
    try {
        $existing = array_column($pdo->query("SHOW COLUMNS FROM hero_slides")->fetchAll(), 'Field');
        $columns = [
            'headline_si'  => 'VARCHAR(255) NULL',
            'subtext_si'   => 'TEXT NULL',
            'btn1_text_si' => 'VARCHAR(100) NULL',
            'btn2_text_si' => 'VARCHAR(100) NULL',
        ];
        foreach ($columns as $name => $definition) {
            if (!in_array($name, $existing, true)) {
                $pdo->exec("ALTER TABLE hero_slides ADD COLUMN `$name` $definition");
            }
        }
        $stmt = $pdo->prepare(
            "INSERT INTO settings (setting_key, setting_value) VALUES ('schema_hero_si_migrated', '1')
             ON DUPLICATE KEY UPDATE setting_value = '1'"
        );
        $stmt->execute();
    } catch (PDOException $e) {
        // Swallow — see comment above.
    }
}

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
    $value = isset($settings[$key]) && $settings[$key] !== '' ? $settings[$key] : $default;
    return translate($value);
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
    $rows = $pdo->query(
        "SELECT * FROM features WHERE is_active = 1 ORDER BY sort_order ASC, id ASC"
    )->fetchAll();
    foreach ($rows as &$row) {
        $row['title']       = translate($row['title'] ?? '');
        $row['description'] = translate($row['description'] ?? '');
    }
    unset($row);
    return $rows;
}

/**
 * Fetch active hero slides, ordered.
 */
function get_hero_slides(): array
{
    global $pdo;
    ensure_hero_slide_si_columns();
    $rows = $pdo->query(
        "SELECT * FROM hero_slides WHERE is_active = 1 ORDER BY sort_order ASC, id ASC"
    )->fetchAll();
    foreach ($rows as &$row) {
        $row['headline']  = localized($row['headline'] ?? '', $row['headline_si'] ?? null);
        $row['subtext']   = localized($row['subtext'] ?? '', $row['subtext_si'] ?? null);
        $row['btn1_text'] = localized($row['btn1_text'] ?? '', $row['btn1_text_si'] ?? null);
        $row['btn2_text'] = localized($row['btn2_text'] ?? '', $row['btn2_text_si'] ?? null);
    }
    unset($row);
    return $rows;
}

/**
 * Fetch active feature page sections, ordered.
 */
function get_feature_sections(): array
{
    global $pdo;
    $rows = $pdo->query(
        "SELECT * FROM feature_sections WHERE is_active = 1 ORDER BY sort_order ASC, id ASC"
    )->fetchAll();
    $translatable = ['kicker', 'title', 'intro', 'body', 'list1_heading', 'list1_items', 'list2_heading', 'list2_items', 'note'];
    foreach ($rows as &$row) {
        foreach ($translatable as $field) {
            if (isset($row[$field])) {
                $row[$field] = translate($row[$field]);
            }
        }
    }
    unset($row);
    return $rows;
}

/**
 * Turn a stored map value into an embeddable Google Maps iframe URL.
 * Accepts either a plain address (geocoded via the no-API-key query embed)
 * or a full Maps embed URL pasted from Google Maps' own "Embed a map" tool.
 */
function map_embed_url(string $value): string
{
    if ($value === '') {
        return '';
    }
    if (preg_match('#^https?://#i', $value)) {
        return $value;
    }
    return 'https://maps.google.com/maps?q=' . rawurlencode($value) . '&output=embed';
}

/**
 * Escape a heading and turn any **word** markers into a gold <span class="accent">,
 * so admins can highlight a word or phrase from a plain-text field.
 */
function accent_markup(?string $value): string
{
    return preg_replace('/\*\*(.+?)\*\*/s', '<span class="accent">$1</span>', e($value));
}

/**
 * accent_markup() plus <br>-joined line breaks — for a heading field where the
 * admin also separates visual lines with newlines.
 */
function styled_heading(?string $value): string
{
    return nl2br(accent_markup($value));
}

/**
 * Uppercase initials from a name's first words (e.g. "Creative Elements" -> "CE"),
 * for a text-monogram fallback when no logo image has been uploaded.
 */
function initials(string $name, int $max = 2): string
{
    $out = '';
    foreach (preg_split('/\s+/', trim($name)) as $word) {
        if ($word === '') {
            continue;
        }
        $out .= mb_strtoupper(mb_substr($word, 0, 1));
        if (mb_strlen($out) >= $max) {
            break;
        }
    }
    return $out;
}

/**
 * Ensure a site-relative path (as returned by image_url()'s fallback) is an
 * absolute URL — required for og:image / twitter:image, unlike a plain <img src>.
 */
function absolute_url(string $path): string
{
    if ($path === '' || preg_match('#^https?://#i', $path)) {
        return $path;
    }
    return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
}

/**
 * Print the canonical link + Open Graph / Twitter Card meta tags shared by
 * every public page. $path is the site-root-relative URL (e.g. '/', '/about.php').
 */
function seo_meta_tags(string $path, string $title, string $description, string $image, string $siteName): void
{
    $url = rtrim(BASE_URL, '/') . $path;
    $googleVerify = setting('google_site_verification', '');
    $gaId = setting('google_analytics_id', '');
    ?>
<?php if ($gaId !== ''): ?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= e($gaId) ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', <?= json_encode($gaId, JSON_UNESCAPED_SLASHES) ?>);
</script>
<?php endif; ?>
<?php if ($googleVerify !== ''): ?>
<meta name="google-site-verification" content="<?= e($googleVerify) ?>">
<?php endif; ?>
<link rel="canonical" href="<?= e($url) ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= e($siteName) ?>">
<meta property="og:title" content="<?= e($title) ?>">
<meta property="og:description" content="<?= e($description) ?>">
<meta property="og:url" content="<?= e($url) ?>">
<?php if ($image !== ''): ?>
<meta property="og:image" content="<?= e($image) ?>">
<?php endif; ?>
<meta name="twitter:card" content="<?= $image !== '' ? 'summary_large_image' : 'summary' ?>">
<meta name="twitter:title" content="<?= e($title) ?>">
<meta name="twitter:description" content="<?= e($description) ?>">
<?php if ($image !== ''): ?>
<meta name="twitter:image" content="<?= e($image) ?>">
<?php endif; ?>
    <?php
}
