<?php
/**
 * XML sitemap — served at /sitemap.xml via the root .htaccess rewrite.
 */
require_once __DIR__ . '/includes/functions.php';

header('Content-Type: application/xml; charset=utf-8');

// Each page has its own noindex toggle — a noindexed page is left out of the
// sitemap entirely rather than sending mixed signals.
$pages = [
    ['path' => '/',         'file' => 'index.php',    'noindex_key' => 'home_seo_noindex',     'priority' => '1.0', 'changefreq' => 'weekly'],
    ['path' => '/features', 'file' => 'features.php', 'noindex_key' => 'features_seo_noindex', 'priority' => '0.9', 'changefreq' => 'monthly'],
    ['path' => '/about',    'file' => 'about.php',    'noindex_key' => 'about_seo_noindex',    'priority' => '0.7', 'changefreq' => 'monthly'],
    ['path' => '/contact',  'file' => 'contact.php',  'noindex_key' => 'contact_seo_noindex',  'priority' => '0.8', 'changefreq' => 'monthly'],
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($pages as $p):
    if (setting($p['noindex_key']) === '1') {
        continue;
    }
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
