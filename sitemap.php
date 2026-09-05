<?php
/**
 * XML sitemap — served at /sitemap.xml via the root .htaccess rewrite.
 */
require_once __DIR__ . '/includes/functions.php';

header('Content-Type: application/xml; charset=utf-8');

// Site-wide noindex: publish an empty sitemap rather than sending mixed signals.
if (setting('seo_noindex') === '1') {
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>';
    exit;
}

$pages = [
    ['path' => '/',             'file' => 'index.php',    'priority' => '1.0', 'changefreq' => 'weekly'],
    ['path' => '/features.php', 'file' => 'features.php', 'priority' => '0.9', 'changefreq' => 'monthly'],
    ['path' => '/about.php',    'file' => 'about.php',    'priority' => '0.7', 'changefreq' => 'monthly'],
    ['path' => '/contact.php',  'file' => 'contact.php',  'priority' => '0.8', 'changefreq' => 'monthly'],
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($pages as $p):
    $file    = __DIR__ . '/' . $p['file'];
    $lastmod = file_exists($file) ? date('Y-m-d', filemtime($file)) : date('Y-m-d');
?>
  <url>
    <loc><?= e(rtrim(BASE_URL, '/') . $p['path']) ?></loc>
    <lastmod><?= e($lastmod) ?></lastmod>
    <changefreq><?= e($p['changefreq']) ?></changefreq>
    <priority><?= e($p['priority']) ?></priority>
  </url>
<?php endforeach; ?>
</urlset>
