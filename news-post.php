<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/maintenance-gate.php';

$slug = trim($_GET['slug'] ?? '');
$post = $slug !== '' ? get_news_post_by_slug($slug) : null;

if (!$post) {
    http_response_code(404);
}

$brandName    = setting('brand_name', 'Harvest');
$brandLogo    = setting('brand_logo', '');
$brandLogoUrl = $brandLogo ? image_url('brand_logo') : '';
$faviconUrl   = image_url('favicon');
$brandLogoWhite  = setting('brand_logo_white', '');
$brandLogoNavUrl = $brandLogoWhite ? image_url('brand_logo_white') : $brandLogoUrl;

$themePrimary = setting('theme_primary_color', '');
$themeAccent  = setting('theme_accent_color', '');
$ctaBg        = image_url('cta_bg_image', 'assets/images/cta-bg.jpg');

$postImg = $post && $post['featured_image'] ? resolve_image_url($post['featured_image']) : $ctaBg;

$pageTitle = $post ? (($post['seo_title'] ?: $post['title']) . ' — ' . $brandName . ' Pro') : ('Post Not Found — ' . $brandName . ' Pro');
$pageDesc  = $post ? ($post['seo_description'] ?: news_excerpt($post['content'], 160)) : 'This post could not be found.';
$pageImg   = absolute_url($postImg);
$pageKeywords = $post ? trim(($post['seo_keyword'] ?? '') . (!empty($post['seo_keyword']) && !empty($post['seo_keywords_secondary']) ? ', ' : '') . ($post['seo_keywords_secondary'] ?? ''), ', ') : '';
?>
<!DOCTYPE html>
<html lang="<?= e(current_lang()) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if ($faviconUrl !== ''): ?><link rel="icon" href="<?= e($faviconUrl) ?>"><?php endif; ?>
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDesc) ?>">
<?php if ($pageKeywords !== ''): ?>
<meta name="keywords" content="<?= e($pageKeywords) ?>">
<?php endif; ?>
<?php if ($post): seo_meta_tags('/news/' . $post['slug'], $pageTitle, $pageDesc, $pageImg, $brandName . ' Pro'); endif; ?>
<?php sinhala_font_tags(); ?>
<link rel="stylesheet" href="/assets/css/style.css?v=5.4">
<?php if ($themePrimary !== '' || $themeAccent !== ''): ?>
<style>
:root {
<?php if ($themePrimary !== ''): ?>
  --green-900: color-mix(in srgb, <?= e($themePrimary) ?> 65%, black);
  --green-800: color-mix(in srgb, <?= e($themePrimary) ?> 80%, black);
  --green-700: color-mix(in srgb, <?= e($themePrimary) ?> 92%, black);
  --green-600: <?= e($themePrimary) ?>;
  --green-500: color-mix(in srgb, <?= e($themePrimary) ?> 82%, white);
  --green-050: color-mix(in srgb, <?= e($themePrimary) ?> 8%, white);
<?php endif; ?>
<?php if ($themeAccent !== ''): ?>
  --gold: <?= e($themeAccent) ?>;
  --gold-soft: color-mix(in srgb, <?= e($themeAccent) ?> 85%, white);
<?php endif; ?>
}
</style>
<?php endif; ?>
</head>
<body>

<?php $activeNav = ''; require __DIR__ . '/includes/site-nav.php'; ?>

<?php if (!$post): ?>

  <section class="section" style="padding-top:160px;">
    <div class="container policy-content" style="text-align:center;">
      <h1>Post Not Found</h1>
      <p>This post may have been removed or is no longer published.</p>
      <p style="margin-top:20px;"><a href="/news" class="btn btn-primary">&larr; Back to News &amp; Updates</a></p>
    </div>
  </section>

<?php else: ?>

  <header class="page-banner" style="background-image:linear-gradient(rgba(10,20,12,.55),rgba(10,20,12,.7)),url('<?= e($postImg) ?>');">
    <div class="container">
      <div class="page-banner-inner" style="max-width:760px;">
        <?php if ($post['category_name']): ?><span class="news-post-cat"><?= e($post['category_name']) ?></span><?php endif; ?>
        <h1><?= e($post['title']) ?></h1>
        <?php if ($post['published_at']): ?><p><?= e(date('j F Y', strtotime($post['published_at']))) ?></p><?php endif; ?>
      </div>
    </div>
  </header>

  <section class="section">
    <div class="container policy-content news-post-content">
      <p style="margin-bottom:28px;"><a href="/news">&larr; Back to News &amp; Updates</a></p>
      <?= news_render_content($post['content']) ?>
    </div>
  </section>

<?php endif; ?>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
