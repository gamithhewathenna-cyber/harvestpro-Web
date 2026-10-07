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
 *  ?lang=si|en sets the choice for this session AND drops a 1-year cookie,
 *  so it's remembered on future visits too, not just for the current
 *  browser session. translate()/t() do an exact-string dictionary lookup
 *  and fall back to the original English when a string isn't in the
 *  dictionary (e.g. content an admin edited after it was written), so
 *  nothing ever renders blank.
 * =====================================================================
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$LANG_COOKIE_YEAR = 60 * 60 * 24 * 365;
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'si'], true)) {
    $_SESSION['lang'] = $_GET['lang'];
    if (!headers_sent()) {
        setcookie('hp_lang', $_GET['lang'], time() + $LANG_COOKIE_YEAR, '/');
        setcookie('hp_lang_prompted', '1', time() + $LANG_COOKIE_YEAR, '/');
    }
    $_COOKIE['hp_lang_prompted'] = '1';
} elseif (!isset($_SESSION['lang']) && isset($_COOKIE['hp_lang']) && in_array($_COOKIE['hp_lang'], ['en', 'si'], true)) {
    // Returning visitor whose session expired but who has a saved preference.
    $_SESSION['lang'] = $_COOKIE['hp_lang'];
}
define('CURRENT_LANG', $_SESSION['lang'] ?? 'en');

/** Whether to show the first-visit "Choose Your Preferred Language" popup. */
function should_show_lang_prompt(): bool
{
    return !isset($_COOKIE['hp_lang_prompted']);
}

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
/**
 * One-time schema migration: creates the payment_logos table if it
 * doesn't exist yet, so existing installs don't need a manual SQL step.
 * Tracked via a settings flag so the check only runs once ever.
 */
function ensure_payment_logos_table(): void
{
    global $pdo;
    static $checked = false;
    if ($checked) {
        return;
    }
    $checked = true;
    if (setting('schema_payment_logos_migrated') === '1') {
        return;
    }
    try {
        $pdo->exec(
            "CREATE TABLE IF NOT EXISTS payment_logos (
                id INT(11) NOT NULL AUTO_INCREMENT,
                image VARCHAR(255) NOT NULL,
                alt_text VARCHAR(150) DEFAULT NULL,
                link VARCHAR(255) DEFAULT NULL,
                sort_order INT(11) NOT NULL DEFAULT 0,
                is_active TINYINT(1) NOT NULL DEFAULT 1,
                PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
        );
        $stmt = $pdo->prepare(
            "INSERT INTO settings (setting_key, setting_value) VALUES ('schema_payment_logos_migrated', '1')
             ON DUPLICATE KEY UPDATE setting_value = '1'"
        );
        $stmt->execute();
    } catch (PDOException $e) {
        // Best-effort — see ensure_hero_slide_si_columns() for rationale.
    }
}

/**
 * Fetch active footer payment-method logos, ordered.
 */
function get_payment_logos(): array
{
    global $pdo;
    ensure_payment_logos_table();
    return $pdo->query(
        "SELECT * FROM payment_logos WHERE is_active = 1 ORDER BY sort_order ASC, id ASC"
    )->fetchAll();
}

/**
 * One-time schema migration: creates the youtube_tutorials table if it
 * doesn't exist yet, so existing installs don't need a manual SQL step.
 * Tracked via a settings flag so the check only runs once ever.
 */
function ensure_youtube_tutorials_table(): void
{
    global $pdo;
    static $checked = false;
    if ($checked) {
        return;
    }
    $checked = true;
    if (setting('schema_youtube_tutorials_migrated') === '1') {
        return;
    }
    try {
        $pdo->exec(
            "CREATE TABLE IF NOT EXISTS youtube_tutorials (
                id INT(11) NOT NULL AUTO_INCREMENT,
                title VARCHAR(255) NOT NULL,
                youtube_url VARCHAR(500) NOT NULL,
                sort_order INT(11) NOT NULL DEFAULT 0,
                is_published TINYINT(1) NOT NULL DEFAULT 1,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
        );
        $stmt = $pdo->prepare(
            "INSERT INTO settings (setting_key, setting_value) VALUES ('schema_youtube_tutorials_migrated', '1')
             ON DUPLICATE KEY UPDATE setting_value = '1'"
        );
        $stmt->execute();
    } catch (PDOException $e) {
        // Best-effort — see ensure_hero_slide_si_columns() for rationale.
    }
}

/**
 * Published YouTube tutorials, in admin-chosen order, each with its raw
 * youtube_url resolved to a bare video id for building an embed URL.
 */
function get_youtube_tutorials(bool $publishedOnly = true): array
{
    global $pdo;
    ensure_youtube_tutorials_table();
    $sql = "SELECT * FROM youtube_tutorials";
    if ($publishedOnly) {
        $sql .= " WHERE is_published = 1";
    }
    $sql .= " ORDER BY sort_order ASC, id ASC";
    try {
        $rows = $pdo->query($sql)->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
    foreach ($rows as &$row) {
        $row['title']    = translate($row['title'] ?? '');
        $row['video_id'] = youtube_video_id($row['youtube_url'] ?? '');
    }
    unset($row);
    return $rows;
}

/**
 * Pull the bare video id out of any common YouTube URL shape
 * (watch?v=, youtu.be/, embed/, shorts/) — returns null if the string
 * doesn't look like a YouTube URL at all, so a stale/typo'd link just
 * silently fails to embed rather than breaking the page.
 */
function youtube_video_id(string $url): ?string
{
    $url = trim($url);
    if ($url === '') {
        return null;
    }
    if (preg_match('#(?:youtube\.com/(?:watch\?v=|embed/|shorts/)|youtu\.be/)([A-Za-z0-9_-]{6,})#i', $url, $m)) {
        return $m[1];
    }
    // Already a bare video id, pasted without the surrounding URL.
    if (preg_match('/^[A-Za-z0-9_-]{6,}$/', $url)) {
        return $url;
    }
    return null;
}

/**
 * One-time schema migration: creates the news_categories/news_posts tables
 * if they don't exist yet, so existing installs don't need a manual SQL
 * step. Tracked via a settings flag so the check only runs once ever.
 */
function ensure_news_tables(): void
{
    global $pdo;
    static $checked = false;
    if ($checked) {
        return;
    }
    $checked = true;
    if (setting('schema_news_migrated') !== '1') {
        try {
            $pdo->exec(
                "CREATE TABLE IF NOT EXISTS news_categories (
                    id INT(11) NOT NULL AUTO_INCREMENT,
                    name VARCHAR(100) NOT NULL,
                    slug VARCHAR(120) NOT NULL,
                    PRIMARY KEY (id),
                    UNIQUE KEY slug (slug)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
            );
            $pdo->exec(
                "CREATE TABLE IF NOT EXISTS news_posts (
                    id INT(11) NOT NULL AUTO_INCREMENT,
                    title VARCHAR(255) NOT NULL,
                    slug VARCHAR(255) NOT NULL,
                    content LONGTEXT,
                    featured_image VARCHAR(255) DEFAULT '',
                    category_id INT(11) DEFAULT NULL,
                    seo_title VARCHAR(255) DEFAULT '',
                    seo_description VARCHAR(500) DEFAULT '',
                    seo_keyword VARCHAR(150) NOT NULL DEFAULT '',
                    seo_keywords_secondary VARCHAR(500) NOT NULL DEFAULT '',
                    is_published TINYINT(1) NOT NULL DEFAULT 0,
                    published_at DATETIME DEFAULT NULL,
                    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (id),
                    UNIQUE KEY slug (slug),
                    KEY category_id (category_id),
                    KEY is_published (is_published)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
            );
            $stmt = $pdo->prepare(
                "INSERT INTO settings (setting_key, setting_value) VALUES ('schema_news_migrated', '1')
                 ON DUPLICATE KEY UPDATE setting_value = '1'"
            );
            $stmt->execute();
        } catch (PDOException $e) {
            // Best-effort — see ensure_hero_slide_si_columns() for rationale.
        }
    }
    ensure_news_seo_columns();
}

/**
 * One-time schema migration: adds the Primary/Secondary keyword columns to
 * news_posts for installs whose news_posts table already existed before
 * these fields were introduced. Tracked via its own settings flag (separate
 * from schema_news_migrated) so it still runs for those installs even
 * though the table-creation step above short-circuits for them.
 */
function ensure_news_seo_columns(): void
{
    global $pdo;
    static $checked = false;
    if ($checked) {
        return;
    }
    $checked = true;
    if (setting('schema_news_seo_migrated') === '1') {
        return;
    }
    try {
        $existing = array_column($pdo->query("SHOW COLUMNS FROM news_posts")->fetchAll(), 'Field');
        $columns = [
            'seo_keyword'            => "VARCHAR(150) NOT NULL DEFAULT ''",
            'seo_keywords_secondary' => "VARCHAR(500) NOT NULL DEFAULT ''",
        ];
        foreach ($columns as $name => $definition) {
            if (!in_array($name, $existing, true)) {
                $pdo->exec("ALTER TABLE news_posts ADD COLUMN `$name` $definition");
            }
        }
        $stmt = $pdo->prepare(
            "INSERT INTO settings (setting_key, setting_value) VALUES ('schema_news_seo_migrated', '1')
             ON DUPLICATE KEY UPDATE setting_value = '1'"
        );
        $stmt->execute();
    } catch (PDOException $e) {
        // Best-effort — see ensure_hero_slide_si_columns() for rationale.
    }
}

/** Turn a title into a URL-safe slug ("New Payroll Feature!" -> "new-payroll-feature"). */
function news_slugify(string $text): string
{
    $slug = strtolower(trim($text));
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');
    if ($slug === '') {
        $slug = 'post-' . substr(bin2hex(random_bytes(4)), 0, 8);
    }
    return $slug;
}

/** Append -2, -3, … to a slug until it no longer collides with another row. */
function news_unique_slug(string $table, string $base, ?int $excludeId = null): string
{
    global $pdo;
    $slug = $base;
    $i = 2;
    while (true) {
        $sql = "SELECT id FROM `$table` WHERE slug = ?";
        $params = [$slug];
        if ($excludeId !== null) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        if (!$stmt->fetch()) {
            return $slug;
        }
        $slug = $base . '-' . $i;
        $i++;
    }
}

/** All categories, alphabetical. */
function get_news_categories(): array
{
    global $pdo;
    ensure_news_tables();
    try {
        return $pdo->query("SELECT * FROM news_categories ORDER BY name ASC")->fetchAll();
    } catch (PDOException $e) {
        // Table missing/unreachable (e.g. the DB user lacks CREATE TABLE
        // privileges and the self-healing migration above couldn't run) —
        // degrade to "no categories" instead of a fatal error.
        return [];
    }
}

/**
 * Published (or, for the admin list, all) news posts, newest first.
 * Options: published_only (bool, default true), category (slug), exclude_id, limit, offset.
 */
function get_news_posts(array $opts = []): array
{
    global $pdo;
    ensure_news_tables();
    $publishedOnly = $opts['published_only'] ?? true;
    $categorySlug  = $opts['category'] ?? null;
    $excludeId     = $opts['exclude_id'] ?? null;

    $sql = "SELECT p.*, c.name AS category_name, c.slug AS category_slug
            FROM news_posts p LEFT JOIN news_categories c ON c.id = p.category_id";
    $where = [];
    $params = [];
    if ($publishedOnly) {
        $where[] = 'p.is_published = 1';
    }
    if ($categorySlug) {
        $where[] = 'c.slug = ?';
        $params[] = $categorySlug;
    }
    if ($excludeId) {
        $where[] = 'p.id != ?';
        $params[] = $excludeId;
    }
    if ($where) {
        $sql .= ' WHERE ' . implode(' AND ', $where);
    }
    $sql .= $publishedOnly ? ' ORDER BY p.published_at DESC, p.id DESC' : ' ORDER BY p.created_at DESC, p.id DESC';
    if (!empty($opts['limit'])) {
        $sql .= ' LIMIT ' . (int)$opts['limit'] . ' OFFSET ' . (int)($opts['offset'] ?? 0);
    }
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
    foreach ($rows as &$row) {
        $row['title']         = translate($row['title'] ?? '');
        $row['content']       = translate($row['content'] ?? '');
        $row['category_name'] = translate($row['category_name'] ?? '');
    }
    unset($row);
    return $rows;
}

/** Count of posts matching the same filters as get_news_posts(), for pagination. */
function count_news_posts(array $opts = []): int
{
    global $pdo;
    ensure_news_tables();
    $publishedOnly = $opts['published_only'] ?? true;
    $categorySlug  = $opts['category'] ?? null;

    $sql = "SELECT COUNT(*) FROM news_posts p LEFT JOIN news_categories c ON c.id = p.category_id";
    $where = [];
    $params = [];
    if ($publishedOnly) {
        $where[] = 'p.is_published = 1';
    }
    if ($categorySlug) {
        $where[] = 'c.slug = ?';
        $params[] = $categorySlug;
    }
    if ($where) {
        $sql .= ' WHERE ' . implode(' AND ', $where);
    }
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return (int)$stmt->fetchColumn();
    } catch (PDOException $e) {
        return 0;
    }
}

/** A single published post by slug, or null if it doesn't exist / isn't published. */
function get_news_post_by_slug(string $slug): ?array
{
    global $pdo;
    ensure_news_tables();
    try {
        $stmt = $pdo->prepare(
            "SELECT p.*, c.name AS category_name, c.slug AS category_slug
             FROM news_posts p LEFT JOIN news_categories c ON c.id = p.category_id
             WHERE p.slug = ? AND p.is_published = 1 LIMIT 1"
        );
        $stmt->execute([$slug]);
        $row = $stmt->fetch();
    } catch (PDOException $e) {
        return null;
    }
    if (!$row) {
        return null;
    }
    $row['title']         = translate($row['title'] ?? '');
    $row['content']       = translate($row['content'] ?? '');
    $row['category_name'] = translate($row['category_name'] ?? '');
    return $row;
}

/**
 * Turn [link text](https://example.com) markers inside an already
 * HTML-escaped string into real <a> tags — the admin can type this
 * directly in the Content box, and docx_to_text() writes the same marker
 * for a Word document's own hyperlinks. Operates on already-escaped text
 * (the brackets/parens survive htmlspecialchars() unchanged, so this never
 * double-escapes anything). Only http(s)/mailto/site-relative links are
 * turned into clickable links — anything else (e.g. a javascript: URI) is
 * left as the plain, harmless text it matched.
 */
function news_linkify(string $escapedText): string
{
    return preg_replace_callback('/\[([^\]]+)\]\(([^)\s]+)\)/', function ($m) {
        $url = $m[2];
        if (!preg_match('#^(https?://|mailto:|/)#i', $url)) {
            return $m[0];
        }
        return '<a href="' . $url . '" target="_blank" rel="noopener noreferrer">' . $m[1] . '</a>';
    }, $escapedText);
}

/**
 * Render admin-entered plain-text post content as paragraphs (blank line =
 * new paragraph). A paragraph starting with ##, ###, or #### is rendered as
 * a heading instead of a plain paragraph, and [text](url) becomes a real
 * link — both either typed directly, or carried over automatically from a
 * Word document's Heading 1/2/3 styles and hyperlinks via docx_to_text().
 */
function news_render_content(string $raw): string
{
    $raw = str_replace("\r\n", "\n", trim($raw));
    if ($raw === '') {
        return '';
    }
    $html = '';
    foreach (preg_split('/\n{2,}/', $raw) as $para) {
        $para = trim($para);
        if ($para === '') {
            continue;
        }
        if (preg_match('/^(#{2,4})\s+(.+)$/s', $para, $m)) {
            $level = strlen($m[1]);
            $headingText = news_linkify(e(trim($m[2])));
            $html .= "<h{$level}>{$headingText}</h{$level}>";
        } else {
            $html .= '<p>' . nl2br(news_linkify(e($para))) . '</p>';
        }
    }
    return $html;
}

/** A short plain-text teaser for listing cards, derived from the post content. */
function news_excerpt(string $raw, int $maxLen = 150): string
{
    $raw = preg_replace('/^#{2,4}\s+/m', '', $raw); // drop heading markers, keep the text
    $raw = preg_replace('/\[([^\]]+)\]\([^)\s]+\)/', '$1', $raw); // drop link markers, keep the link text
    $text = trim(preg_replace('/\s+/', ' ', $raw));
    if (mb_strlen($text) <= $maxLen) {
        return $text;
    }
    return rtrim(mb_substr($text, 0, $maxLen)) . '…';
}

/**
 * Extract plain text from an uploaded .docx file for the "Post Content"
 * field. A .docx is a ZIP archive containing word/document.xml — no
 * external library needed, just PHP's built-in ZipArchive + DOMDocument.
 * Formatting like bold, tables and images isn't preserved, but:
 *  - a paragraph styled as Word's "Heading 1/2/3" comes through as a
 *    ##/###/#### marker so news_render_content() renders it as a real
 *    heading, and
 *  - a Word hyperlink comes through as the same [text](url) marker an
 *    admin can type by hand in the Content box, so news_render_content()
 *    turns both into a real clickable link on the published post.
 * Returns null if the file can't be read (not a valid .docx, or the
 * zip/DOM extensions aren't available on this host).
 */
function docx_to_text(string $filePath): ?string
{
    if (!class_exists('ZipArchive') || !class_exists('DOMDocument')) {
        return null;
    }
    $zip = new ZipArchive();
    if ($zip->open($filePath) !== true) {
        return null;
    }
    $xml     = $zip->getFromName('word/document.xml');
    $relsXml = $zip->getFromName('word/_rels/document.xml.rels');
    $zip->close();
    if ($xml === false || trim($xml) === '') {
        return null;
    }

    // Word stores a hyperlink's actual URL separately from the paragraph
    // that uses it: the run references a relationship id, and this file
    // maps that id to the real target.
    $relMap = [];
    if ($relsXml !== false) {
        $relsDom = new DOMDocument();
        $prev = libxml_use_internal_errors(true);
        if ($relsDom->loadXML($relsXml, LIBXML_NONET | LIBXML_NOENT)) {
            foreach ($relsDom->getElementsByTagName('Relationship') as $rel) {
                if (strpos($rel->getAttribute('Type'), '/hyperlink') !== false) {
                    $relMap[$rel->getAttribute('Id')] = $rel->getAttribute('Target');
                }
            }
        }
        libxml_use_internal_errors($prev);
    }

    $dom = new DOMDocument();
    $prevErrorSetting = libxml_use_internal_errors(true);
    $loaded = $dom->loadXML($xml, LIBXML_NONET | LIBXML_NOENT);
    libxml_use_internal_errors($prevErrorSetting);
    if (!$loaded) {
        return null;
    }

    $xpath = new DOMXPath($dom);
    $xpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
    $relNs = 'http://schemas.openxmlformats.org/officeDocument/2006/relationships';

    $runText = function (DOMNode $context) use ($xpath): string {
        $parts = [];
        foreach ($xpath->query('.//w:t | .//w:tab | .//w:br', $context) as $node) {
            if ($node->localName === 'tab') {
                $parts[] = "\t";
            } elseif ($node->localName === 'br') {
                $parts[] = "\n";
            } else {
                $parts[] = $node->textContent;
            }
        }
        return implode('', $parts);
    };

    $lines = [];
    foreach ($xpath->query('//w:p') as $paragraph) {
        $segments = [];
        foreach ($xpath->query('./w:r | ./w:hyperlink', $paragraph) as $child) {
            if ($child->localName === 'hyperlink') {
                $linkText = trim($runText($child));
                if ($linkText === '') {
                    continue;
                }
                $relId = $child->getAttributeNS($relNs, 'id');
                $url = $relId !== '' ? ($relMap[$relId] ?? '') : '';
                $segments[] = $url !== '' ? "[{$linkText}]({$url})" : $linkText;
            } else {
                $segments[] = $runText($child);
            }
        }
        $text = trim(implode('', $segments));
        if ($text === '') {
            continue;
        }

        // Word marks a paragraph's style — including Heading 1/2/3 — via
        // <w:pPr><w:pStyle w:val="Heading1"/></w:pPr> at the top of the
        // paragraph. The post's own title already acts as the page's <h1>,
        // so Word's Heading 1 maps one level down to ## (<h2>), Heading 2
        // to ### (<h3>), and Heading 3+ to #### (<h4>).
        $styleAttr = $xpath->query('.//w:pStyle/@w:val', $paragraph);
        $style = $styleAttr->length ? $styleAttr->item(0)->nodeValue : '';
        if (preg_match('/heading\s*([1-9])/i', $style, $m)) {
            $level = min(3, (int)$m[1]);
            $text = str_repeat('#', $level + 1) . ' ' . $text;
        }
        $lines[] = $text;
    }

    if (!$lines) {
        return null;
    }
    return implode("\n\n", $lines);
}

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
 * "How It Works" page — a fixed set of 9 steps, each admin-editable (title,
 * summary, teaser, tip, screenshot image, and the sub-step walkthrough)
 * through Settings, but not addable/removable since each one corresponds to
 * a real, fixed area of the system. This function is the single source of
 * truth for the English defaults, used both by the public page and to
 * pre-fill the admin form.
 */
function hiw_step_defs(): array
{
    return [
        'create-account' => [
            'icon' => 'user', 'title' => 'Create an Account',
            'summary' => 'Sign up for Harvest Pro and start your 14-day free trial. It only takes a few minutes to create your account.',
            'teaser'  => 'Sign up and start your 14-day free trial.',
            'tip'     => 'You can use Harvest Pro free for 14 days before choosing to continue with your selected plan.',
            'substeps' => [
                ['Visit Harvest Pro', 'Go to the Harvest Pro website and click Pricing from the main menu.'],
                ['Choose Your Plan', 'Select the plan that best suits your estate: Basic Tier, Mid Tier, or Top Tier.'],
                ['Get Started', 'Once you have selected your plan, click "Get Started with Plan".'],
                ['Start Your Free Trial', 'Click "Start Your 14-Day Free Trial" to continue.'],
                ['Fill in Your Details', 'Enter the required information, including your personal details, estate details, mobile number, and city.'],
                ['Activate Your Trial', 'Check that all your information is correct, then click "Start 14-Day Trial".'],
                ['Log In to Harvest Pro', 'Your account is now ready. Log in to the Harvest Pro system and start managing your tea estate.'],
            ],
        ],
        'estate-management' => [
            'icon' => 'home', 'title' => 'Estate Management',
            'summary' => 'After logging in to Harvest Pro, the first thing you need to do is set up your estate.',
            'teaser'  => 'Add your estate details and sections.',
            'tip'     => 'Once your sections are added, you can use them throughout Harvest Pro to organize and track your estate operations more accurately.',
            'substeps' => [
                ['Go to Estate Management', 'Click Estate Management from the system menu.'],
                ['Select Your Estate', 'You will see the tea estate you added when creating your Harvest Pro account. Click on the estate name to open and manage your estate.'],
                ['Add Another Estate', 'If you manage more than one tea estate, you can click Add New Estate. To add an additional estate, you will need to select and purchase a new subscription for that estate.'],
                ['Add Sections to Your Estate', 'After selecting your estate, you can create the different sections or fields within your estate — for example, Field 01, Field 02, Field 03, New Tea Section, or Old Tea Section. Enter the section name based on how your estate is divided.'],
            ],
        ],
        'service-management' => [
            'icon' => 'settings', 'title' => 'Service Management',
            'summary' => 'Set up the labour services your estate offers, along with how each one is measured and paid.',
            'teaser'  => 'Add labour services, units, and pay rates.',
            'tip'     => 'Your new service is now ready to use when assigning work to employees in Harvest Pro.',
            'substeps' => [
                ['Go to Service Management', 'From the left-side menu, click Service Management.'],
                ['Add a New Service', 'Click the Add Labour Service button at the top-right of the page. The Add New Service form will appear.'],
                ['Enter the Service Name', 'Enter the type of work or service you want to add — for example, Leaf Plucking, Fertilizing, Pruning, or Weeding.'],
                ['Add a Description', 'Enter a short description of the service if required.'],
                ['Select the Status', 'Set the service status to Active if you want to start using it immediately.'],
                ['Enter the Unit Type', 'Enter how the service will be measured — for example, KG for leaf plucking, Unit for an individual task, Tank for spraying, or Day for daily work.'],
                ['Set the Rate per Unit', 'Enter the amount you pay for each unit. For example, if leaf plucking is paid at LKR 50 per KG, set Unit Type to KG and Rate per Unit to LKR 50. Or, if a worker is paid LKR 2,000 per day, set Unit Type to Day and Rate per Unit to LKR 2,000.'],
                ['Single Quantity Service', 'Tick Single Quantity Service when the service should always be counted as 1 unit — for example, if you pay LKR 2,000 for one full day of work. The quantity field will then be disabled when assigning this service. Leave it unticked for services where the quantity can change, such as 10 KG, 25 KG, or 50 KG of leaf plucking.'],
                ['Add the Service', 'Check the details and click Add Service.'],
            ],
        ],
        'employee-management' => [
            'icon' => 'people', 'title' => 'Employee Management',
            'summary' => 'Add your workers to Harvest Pro and assign them to the right services and estates.',
            'teaser'  => 'Add employees and assign services and estates.',
            'tip'     => 'The employee will now be added to your Harvest Pro Employee Management system.',
            'substeps' => [
                ['Go to Employee Management', 'From the left-side menu, click Employee Management.'],
                ['Add a New Employee', 'Click the Add Employee button at the top-right of the page. The Add New Employee form will appear.'],
                ['Enter Employee Details', "Fill in the employee's information, including full name, phone number, gender, NIC, and status."],
                ['Add Employee ID', "The Employee ID can be automatically assigned by Harvest Pro if you leave the field blank. Alternatively, you can manually enter your own employee ID, such as the employee's ETF number."],
                ['Select Service Categories', 'Under Service Categories, select the services the employee can perform — for example, Fertilizing, Leaf Plucking, Pruning, or Weeding. These categories are based on the services you previously created under Service Management.'],
                ['Assign the Employee to an Estate', 'Under Estates, tick the estate or estates where the employee works. You can assign an employee to one or multiple estates, depending on your requirements.'],
                ['Add Employee', 'Check that all the information is correct, then click Add Employee.'],
            ],
        ],
        'daily-assignment' => [
            'icon' => 'calendar', 'title' => 'Daily Assignment',
            'summary' => 'Record the daily work completed by your employees and let Harvest Pro calculate their payments automatically.',
            'teaser'  => 'Record daily work and auto-calculate payments.',
            'tip'     => 'Your daily assignment is now recorded in Harvest Pro, including the workers, work quantities, and calculated payments.',
            'substeps' => [
                ['Go to Daily Assignment', 'From the left-side menu, click Daily Assignment. This section allows you to record the daily work completed by your employees and automatically calculate their payments based on the service rate.'],
                ['Add a New Assignment', 'Click the Add Assignment button at the top-right of the page. A New Assignment form will appear.'],
                ['Select the Estate', 'Choose the estate where the work was carried out.'],
                ['Select the Section', 'Choose the relevant section of the estate — for example, Field 01, Field 02, or Plantation A.'],
                ['Select the Service', 'Select the service completed by the workers — for example, Leaf Plucking. The system will automatically display the rate you previously set under Service Management, such as LKR 50 per KG.'],
                ['Add Workers', 'Click Add a Worker Below, then click the Search Workers field — your previously added employees will automatically appear. Select the worker you want to add. You can add multiple workers to the same daily assignment.'],
                ['Enter the Work Quantity', "Enter the quantity completed by each worker. For example, if a worker plucked 60 KG of green leaf, enter 60 KG. Harvest Pro will automatically calculate the worker's payment based on the rate: 60 KG × LKR 50 = LKR 3,000. This information will also be used for Payroll."],
                ['Add a Temporary Worker', 'If someone works only on a temporary or daily basis and is not registered as a regular employee, click Add a Temporary Worker Below to record their work for that day without adding them as a permanent employee.'],
                ['Create the Assignment', 'Once all workers and quantities have been entered, check the details and click Create & Add Workers.'],
            ],
        ],
        'expense' => [
            'icon' => 'receipt', 'title' => 'Expense',
            'summary' => 'Record and track all the expenses related to your tea estates.',
            'teaser'  => 'Record and track estate expenses.',
            'tip'     => 'The expense will now be recorded in Harvest Pro, helping you track estate expenses and costs accurately for each estate and section.',
            'substeps' => [
                ['Go to Expenses', 'From the left-side menu, click Expenses. This section allows you to record and track all expenses related to your tea estates.'],
                ['Add a New Expense', 'Click the Add Expense button. The Add New Expense form will appear.'],
                ['Select the Date', 'Choose the date when the expense occurred.'],
                ['Select the Expense Category', 'Choose the appropriate category for the expense — for example, Equipment, Food, Tools, Transport, Utilities, or Other.'],
                ['Add a Description', 'Enter a short description explaining what the expense was for.'],
                ['Enter the Amount', 'Enter the total expense amount in LKR.'],
                ['Select the Estate', 'Select the estate related to the expense. If you manage multiple estates, you can record and track expenses separately for each estate.'],
                ['Select the Section', 'If the expense belongs to a specific section or field, select it under Section. If it is a general estate expense, select All / General.'],
                ['Add the Expense', 'Check all the information and click Add Expense.'],
            ],
        ],
        'fertilizer-management' => [
            'icon' => 'leaf', 'title' => 'Fertilizer Management',
            'summary' => 'Track fertilizer applications and cycles, and know exactly when each field is next due.',
            'teaser'  => 'Track fertilizer applications and due dates.',
            'tip'     => 'This helps you identify which field needs fertilizer next and when it is due, without manually calculating the dates.',
            'substeps' => [
                ['Go to Fertilizer Management', 'From the left-side menu, click Fertilizer Management. Here you can view the fertilizer calendar, applications, cycles, and upcoming due dates.'],
                ['Add a Fertilizer', 'Click Add Fertilizer at the top-right of the page and add the fertilizer types you use on your estate — for example, T200, T750, NPK 15-15-15, or Urea.'],
                ['Add a Fertilizer Cycle', 'Click Add Fertilizer Cycle to record a new fertilizer application and set its next cycle.'],
                ['Select the Estate and Section', 'Select the estate where the fertilizer was applied, then select the relevant section or field — for example, Field 01, Field 02, Plantation A, or Plantation B.'],
                ['Select the Fertilizer', 'Choose the fertilizer type you applied from your previously added fertilizer list — for example, T200.'],
                ['Enter the Application Details', 'Select the application date and enter the amount of fertilizer used — for example, T200 at a quantity of 150 KG.'],
                ['Set the Fertilizer Cycle', 'Enter the number of days before the next fertilizer application is required — for example, 50, 75, or 90 days. If you select a 90-day cycle, Harvest Pro will automatically calculate the next fertilizer due date.'],
                ['Save the Fertilizer Application', 'Check all the details and save the application. The record will now appear on the Fertilizer Management calendar and under All Applications.'],
                ['Track Next Due Dates & Reminders', 'Harvest Pro automatically tracks the fertilizer cycle and shows the last application date, next due date, cycle (e.g. 90 days), days remaining, estate, and section / field.'],
            ],
        ],
        'factory-management' => [
            'icon' => 'factory', 'title' => 'Factory Management',
            'summary' => 'Track green leaf deliveries, factory weights, monthly prices, and profit — from plucking to final payment.',
            'teaser'  => 'Track deliveries, weights, prices, and profit.',
            'tip'     => 'Once Factory Management is set up, your normal process will be: Record Daily Plucking → Assign Leaf to Factory → Enter Factory KG → Add Monthly Price → Check Delivery Value → Add Factory Expenses/Deductions → Check Overview & Net Profit.',
            'substeps' => [
                ['Go to Factory Management', 'From the left-side menu, click Factory Management. You will see five tabs: Overview, Deliveries, Expenses, Monthly Prices, and Factories. When using Factory Management for the first time, start with the Factories tab.'],
                ['Add Your Tea Factory', 'Click the Factories tab and enter the factory details: factory name, location, and status (select Active) — notes are optional. Click Save Factory. If you supply green leaf to more than one factory, you can add each factory separately.'],
                ['Go to Deliveries', 'Click the Deliveries tab. The green leaf KG recorded from your daily plucking will automatically appear here. For example, if your workers plucked 150 KG today, the 150 KG will appear under Deliveries, ready to be assigned to a factory.'],
                ['Assign the Green Leaf to a Factory', 'Select the factory where you delivered the green leaf. If all 150 KG went to one factory, assign the full 150 KG to that factory. If you delivered the leaf to multiple factories, click Split Across Factories — for example, 100 KG to Factory A and 50 KG to Factory B. This allows you to track exactly how much leaf was sent to each factory.'],
                ['Check the Field KG', 'After assigning the delivery, you will see the Field KG — the weight recorded by your estate before the green leaf is weighed at the factory. For example, Field KG: 73 KG.'],
                ['Enter the Factory KG', 'Once the tea factory provides its official weight, enter it under Factory KG — for example, Field KG: 73 KG, Factory KG: 60 KG. Save the factory weight after entering it.'],
                ['Check the Weight Difference', 'Harvest Pro will automatically show the difference between the Field KG and Factory KG — for example, Field KG: 73 KG, Factory KG: 60 KG, Difference: 13 KG. This makes it easy to identify any weight difference between the estate and factory records.'],
                ['Add the Monthly Price', "Once the factory provides the green leaf price for the month, click the Monthly Prices tab. Select the relevant factory, month, and year, then enter the factory's price per KG and save it — for example, September: Rs. 271 per KG."],
                ['Check the Delivery Value', 'Go back to the Deliveries tab. Harvest Pro will use the Factory KG and the applicable Monthly Price to calculate the value of the delivery — for example, Factory KG: 60 KG, Price: Rs. 271 per KG, Value: Rs. 16,260.'],
                ['Add Factory Expenses', 'Click the Expenses tab. Here you can record expenses or deductions related to the factory — enter the factory, date, category, amount (LKR), and an optional description or notes, then click Save Expense.'],
                ['Record Fertilizer or Other Deductions', 'Sometimes the tea factory may provide fertilizer or other items/advances to your estate. For example, if you receive fertilizer from the factory and its cost will be deducted from your month-end payment, record that amount under Factory Expenses. This helps you keep track of the deductions that will affect your final factory payment.'],
                ['Go to Overview', 'Click the Overview tab to see a complete summary of your factory activity. You can filter the information by estate, factory, year, and month.'],
                ['Check Your Factory Summary', 'At the top of the Overview, you can see the Field Weight (total KG recorded by your estate), Factory Weight (total KG recorded by the factory), Unassigned KG (leaf that still needs to be assigned to a factory), Leaf Value (value calculated using the factory KG and monthly price), and Net (final value after applicable recorded deductions).'],
                ['Check the Profit Summary', 'Under Profit Summary, you can see the Value, Expenses, Advances, and Net Profit — giving you a clear picture of the income generated from your green leaf and the deductions recorded against it.'],
                ['Check Factory Performance', 'The Factory Performance section helps you monitor the performance of each factory. You can see the KG supplied, number of deliveries, leaf type, and value for the selected period. This is especially useful if your estate supplies green leaf to multiple factories.'],
                ['Check Recent Deliveries', 'Under Recent Deliveries, you can see the date, factory, leaf type, plucking KG, factory KG, difference, value, and status — helping you quickly review your latest factory deliveries and confirm that the information has been recorded correctly.'],
            ],
        ],
        'reminders-calendar' => [
            'icon' => 'bell', 'title' => 'Reminders & Calendar',
            'summary' => 'Schedule and track important activities across your tea estate — from fertilizer applications and inspections to maintenance, purchasing, and meetings.',
            'teaser'  => 'Schedule and track important estate activities.',
            'tip'     => 'Using Reminders & Calendar helps you keep important estate activities organized and reduces the chance of missing scheduled work or important dates.',
            'substeps' => [
                ['Go to Reminders & Calendar', 'From the left-side menu, click Reminders & Calendar. You will see a calendar where you can view your scheduled reminders and upcoming estate activities.'],
                ['Add a New Reminder', 'Click the Add Reminder button at the top-right of the page. The Add Reminder form will appear.'],
                ['Enter the Event Title', 'Enter a clear event title for the activity you want to remember — for example, Apply Fertilizer, Building Maintenance, Field Inspection, Purchase Estate Supplies, Equipment Service, or Worker Meeting.'],
                ['Add a Description', 'Enter a short description with more information about the task — for example, "Building Maintenance: Check and repair the estate office roof." This helps you understand exactly what needs to be done when you see the reminder later.'],
                ['Select the Start Date', 'Choose the start date for the reminder — the date when the activity should take place or when you want the reminder to begin.'],
                ['Select the Related Estate', 'Choose the estate related to the reminder. If you manage multiple estates in Harvest Pro, make sure you select the correct estate.'],
                ['Select the Plantation / Section', 'Choose the specific plantation or section where the task needs to be completed — for example, Plantation A, Plantation B, Field 01, or Field 02. This makes it easier to manage reminders separately for different areas of your estate.'],
                ['Select the Recurrence', 'Choose how often the reminder should repeat: One-time, Daily, Weekly, Monthly, or Yearly. For example, if you need to carry out an estate inspection every month, select Monthly.'],
                ['Add the Event', 'Once all the information is correct, click Add Event.'],
                ['View Your Reminders', 'Your scheduled activities will appear on the calendar according to their dates. You can also check the All Reminders section to keep track of your scheduled tasks and upcoming activities.'],
            ],
        ],
    ];
}

/**
 * Turn admin-entered "Heading|Body" lines (one sub-step per line) into
 * [[heading, body], ...] pairs.
 */
function hiw_parse_substeps(string $raw): array
{
    $out = [];
    foreach (preg_split('/\r\n|\r|\n/', $raw) as $line) {
        $line = trim($line);
        if ($line === '') {
            continue;
        }
        $parts = explode('|', $line, 2);
        $out[] = [trim($parts[0]), trim($parts[1] ?? '')];
    }
    return $out;
}

/**
 * The reverse of hiw_parse_substeps() — used to pre-fill the admin textarea
 * with the current (default or saved) sub-steps.
 */
function hiw_substeps_to_lines(array $pairs): string
{
    $lines = [];
    foreach ($pairs as [$heading, $body]) {
        $lines[] = $heading . '|' . $body;
    }
    return implode("\n", $lines);
}

/**
 * Assemble the "How It Works" steps for the public page: admin-entered
 * Settings values where present, otherwise the English defaults — each
 * translated for Sinhala visitors. Sub-steps go through the same per-line
 * translate() pass whether they came from an admin override or the built-in
 * default: translate() is a safe no-op for text it doesn't recognise (it
 * just returns the English unchanged), so a genuine custom sub-step still
 * shows in English while one that happens to match the dictionary — e.g.
 * the built-in wording re-saved verbatim via a settings seed script — still
 * gets translated correctly.
 */
function get_hiw_steps(): array
{
    $raw = get_settings();
    $steps = [];
    foreach (hiw_step_defs() as $key => $def) {
        $substepsRaw = trim($raw["hiw_{$key}_substeps"] ?? '');
        if ($substepsRaw === '') {
            $substepsRaw = hiw_substeps_to_lines($def['substeps']);
        }
        $substeps = [];
        foreach (hiw_parse_substeps($substepsRaw) as [$heading, $body]) {
            $substeps[] = [t($heading), t($body)];
        }
        $steps[] = [
            'key'      => $key,
            'icon'     => $def['icon'],
            'title'    => setting("hiw_{$key}_title", $def['title']),
            'summary'  => setting("hiw_{$key}_summary", $def['summary']),
            'teaser'   => setting("hiw_{$key}_teaser", $def['teaser']),
            'tip'      => setting("hiw_{$key}_tip", $def['tip']),
            'substeps' => $substeps,
            'image'    => image_url("hiw_{$key}_image"),
        ];
    }
    return $steps;
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
 * Print the Google Fonts <link> tags for Noto Sans Sinhala — only on
 * Sinhala-language pages, so English visitors never pay for the font
 * request. The site's CSS font stacks already list Noto Sans Sinhala
 * as a fallback, so once it's loaded the browser picks it up
 * automatically for any Sinhala glyphs, with no per-element markup.
 */
function sinhala_font_tags(): void
{
    if (current_lang() !== 'si') {
        return;
    }
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+Sinhala:wght@400;500;600;700&display=swap">
    <?php
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
