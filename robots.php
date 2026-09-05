<?php
/**
 * robots.txt — served at /robots.txt via the root .htaccess rewrite.
 */
require_once __DIR__ . '/includes/functions.php';

header('Content-Type: text/plain; charset=utf-8');

$noindex = setting('seo_noindex') === '1';
?>
User-agent: *
<?php if ($noindex): ?>
Disallow: /
<?php else: ?>
Disallow: /admin/
Disallow: /includes/
Disallow: /submit.php
Allow: /
<?php endif; ?>

Sitemap: <?= rtrim(BASE_URL, '/') ?>/sitemap.xml
