<?php
/**
 * XML sitemap for blog posts only — served at /sitemap-news.xml via the
 * root .htaccess rewrite. Meant to be submitted to Search Console as its
 * own sitemap, separate from the main /sitemap.xml. It's generated fresh
 * from the database on every request, so a newly published post (or one
 * just unpublished/deleted) appears or disappears here automatically —
 * nothing to regenerate or re-submit by hand.
 */
require_once __DIR__ . '/includes/functions.php';

header('Content-Type: application/xml; charset=utf-8');

$newsPosts = get_news_posts(['published_only' => true]);

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($newsPosts as $post): ?>
  <url>
    <loc><?= e(rtrim(BASE_URL, '/') . '/news/' . $post['slug']) ?></loc>
    <lastmod><?= e(date('Y-m-d', strtotime($post['updated_at'] ?? $post['published_at']))) ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.5</priority>
  </url>
<?php endforeach; ?>
</urlset>
