<?php
/**
 * robots.txt — served at /robots.txt via the root .htaccess rewrite.
 * Per-page noindex is handled by each page's own <meta name="robots"> tag
 * (see Settings → each page's SEO tab), so this stays a simple, permissive
 * crawl policy — it only blocks non-content paths.
 */
require_once __DIR__ . '/includes/functions.php';

header('Content-Type: text/plain; charset=utf-8');
?>
User-agent: *
Disallow: /admin/
Disallow: /includes/
Disallow: /submit.php
Allow: /

Sitemap: <?= rtrim(BASE_URL, '/') ?>/sitemap.xml
