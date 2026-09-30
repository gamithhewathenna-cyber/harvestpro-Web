<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/maintenance-gate.php';

$brandName    = setting('brand_name', 'Harvest');
$brandLogo    = setting('brand_logo', '');
$brandLogoUrl = $brandLogo ? image_url('brand_logo') : '';
$faviconUrl   = image_url('favicon');
$brandLogoWhite  = setting('brand_logo_white', '');
$brandLogoNavUrl = $brandLogoWhite ? image_url('brand_logo_white') : $brandLogoUrl;

$themePrimary = setting('theme_primary_color', '');
$themeAccent  = setting('theme_accent_color', '');
$priceLink    = setting('price_link', '#');
$ctaBg        = image_url('cta_bg_image', 'assets/images/cta-bg.jpg');
$bannerBg     = $ctaBg;

$categorySlug = isset($_GET['category']) ? trim($_GET['category']) : '';
$perPage      = 9;
$page         = max(1, (int)($_GET['page'] ?? 1));

$filterOpts = ['published_only' => true];
if ($categorySlug !== '') {
    $filterOpts['category'] = $categorySlug;
}
$totalPosts = count_news_posts($filterOpts);
$totalPages = max(1, (int)ceil($totalPosts / $perPage));
$page       = min($page, $totalPages);

$posts = get_news_posts($filterOpts + ['limit' => $perPage, 'offset' => ($page - 1) * $perPage]);
$categories = get_news_categories();

$pageTitle = 'News & Updates — ' . $brandName . ' Pro';
$pageDesc  = 'Product updates, announcements and news from Harvest Pro.';
$pageImg   = absolute_url($bannerBg);
?>
<!DOCTYPE html>
<html lang="<?= e(current_lang()) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if ($faviconUrl !== ''): ?><link rel="icon" href="<?= e($faviconUrl) ?>"><?php endif; ?>
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDesc) ?>">
<?php seo_meta_tags('/news', $pageTitle, $pageDesc, $pageImg, $brandName . ' Pro'); ?>
<?php sinhala_font_tags(); ?>
<link rel="stylesheet" href="assets/css/style.css?v=5.4">
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

<!-- ============================= PAGE BANNER ============================= -->
<header class="page-banner" style="background-image:linear-gradient(rgba(10,20,12,.55),rgba(10,20,12,.7)),url('<?= e($bannerBg) ?>');">
  <div class="container">
    <div class="page-banner-inner" style="max-width:760px;">
      <h1>News &amp; <span class="accent">Updates</span></h1>
      <p>Product updates, announcements and news from <?= e($brandName) ?> Pro.</p>
    </div>
  </div>
</header>

<!-- ============================= NEWS LIST ============================= -->
<section class="section">
  <div class="container">

    <?php if ($categories): ?>
      <div class="news-filters">
        <a href="/news" class="news-filter-pill<?= $categorySlug === '' ? ' active' : '' ?>">All</a>
        <?php foreach ($categories as $c): ?>
          <a href="/news?category=<?= e(urlencode($c['slug'])) ?>" class="news-filter-pill<?= $categorySlug === $c['slug'] ? ' active' : '' ?>"><?= e($c['name']) ?></a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if (!$posts): ?>
      <p class="news-empty">No posts yet — check back soon.</p>
    <?php else: ?>
      <div class="news-grid">
        <?php foreach ($posts as $p):
          $img = $p['featured_image'] ? resolve_image_url($p['featured_image']) : '';
          $date = $p['published_at'] ? date('j M Y', strtotime($p['published_at'])) : '';
        ?>
          <a href="/news/<?= e($p['slug']) ?>" class="news-card">
            <div class="news-card-media"<?= $img ? " style=\"background-image:url('" . e($img) . "')\"" : '' ?>>
              <?php if (!$img): ?><span class="news-card-media-fallback"><?= e($brandName) ?></span><?php endif; ?>
            </div>
            <div class="news-card-body">
              <?php if ($p['category_name']): ?><span class="news-card-cat"><?= e($p['category_name']) ?></span><?php endif; ?>
              <h3><?= e($p['title']) ?></h3>
              <p><?= e(news_excerpt($p['content'])) ?></p>
              <?php if ($date): ?><span class="news-card-date"><?= e($date) ?></span><?php endif; ?>
            </div>
          </a>
        <?php endforeach; ?>
      </div>

      <?php if ($totalPages > 1): ?>
        <div class="news-pagination">
          <?php for ($i = 1; $i <= $totalPages; $i++):
            $qs = $categorySlug !== '' ? '?category=' . urlencode($categorySlug) . '&page=' . $i : '?page=' . $i;
          ?>
            <a href="/news<?= e($qs) ?>" class="news-page-num<?= $i === $page ? ' active' : '' ?>"><?= $i ?></a>
          <?php endfor; ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>

  </div>
</section>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
