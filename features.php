<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/maintenance-gate.php';

$brandName    = setting('brand_name', 'Harvest');
$brandLogo    = setting('brand_logo', '');
$brandLogoUrl = $brandLogo ? image_url('brand_logo') : '';
$brandLogoWhite  = setting('brand_logo_white', '');
$brandLogoNavUrl = $brandLogoWhite ? image_url('brand_logo_white') : $brandLogoUrl;

$themePrimary = setting('theme_primary_color', '');
$themeAccent  = setting('theme_accent_color', '');

$seoTitle       = setting('features_seo_title', '');
$seoDescription = setting('features_seo_description', '');
$seoKeywords    = setting('features_seo_keywords', '');
$seoNoindex     = setting('features_seo_noindex') === '1';

$fpTitle  = setting('features_page_title', 'Everything You Need to Manage Your Tea Estate');
$fpPara1  = setting('features_page_para_1', '');
$fpPara2  = setting('features_page_para_2', '');
$fpBanner = image_url('features_page_bg_image', 'assets/images/hero-bg.jpg');

$sections = get_feature_sections();

$pageTitle = $seoTitle !== '' ? $seoTitle : 'Features — ' . $brandName . ' Pro';
$pageDesc  = $seoDescription !== '' ? $seoDescription : $fpPara1;
$pageImg   = absolute_url($fpBanner);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDesc) ?>">
<?php if ($seoKeywords !== ''): ?>
<meta name="keywords" content="<?= e($seoKeywords) ?>">
<?php endif; ?>
<meta name="robots" content="<?= $seoNoindex ? 'noindex, nofollow' : 'index, follow' ?>">
<?php seo_meta_tags('/features', $pageTitle, $pageDesc, $pageImg, $brandName . ' Pro'); ?>
<link rel="stylesheet" href="assets/css/style.css?v=1.0">
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

<?php $activeNav = 'features'; require __DIR__ . '/includes/site-nav.php'; ?>

<!-- ============================= PAGE BANNER ============================= -->
<header class="page-banner" style="background-image:linear-gradient(rgba(10,20,12,.5),rgba(10,20,12,.68)),url('<?= e($fpBanner) ?>');">
  <div class="container">
    <div class="page-banner-inner" style="max-width:760px;">
      <h1><?= e($fpTitle) ?></h1>
      <?php if ($fpPara1): ?><p><?= e($fpPara1) ?></p><?php endif; ?>
      <?php if ($fpPara2): ?><p style="margin-top:10px;"><?= e($fpPara2) ?></p><?php endif; ?>
    </div>
  </div>
</header>

<!-- ============================= FEATURE SECTIONS ============================= -->
<div class="feature-rows">
  <?php foreach ($sections as $i => $s):
      $img = resolve_image_url($s['image'] ?? '', 'assets/images/dashboard.png');
      $list1Items = array_filter(array_map('trim', explode("\n", $s['list1_items'] ?? '')));
      $list2Items = array_filter(array_map('trim', explode("\n", $s['list2_items'] ?? '')));
      $noteParts  = $s['note'] ? explode('|', $s['note'], 2) : [];
  ?>
    <section class="feature-row section">
      <div class="container feature-row-inner">
        <div class="feature-text">
          <?php if (!empty($s['kicker'])): ?>
            <span class="feature-kicker"><?= e(sprintf('%02d.', $i + 1)) ?> <?= e($s['kicker']) ?></span>
          <?php endif; ?>
          <h2><?= e($s['title']) ?></h2>
          <?php if (!empty($s['intro'])): ?><p><?= e($s['intro']) ?></p><?php endif; ?>
          <?php if (!empty($s['body'])): ?><p><?= e($s['body']) ?></p><?php endif; ?>

          <?php if ($list1Items): ?>
            <?php if (!empty($s['list1_heading'])): ?><h4 class="feature-list-heading"><?= e($s['list1_heading']) ?></h4><?php endif; ?>
            <ul class="feature-list">
              <?php foreach ($list1Items as $item): ?><li><span class="tick">&#10003;</span> <?= e($item) ?></li><?php endforeach; ?>
            </ul>
          <?php endif; ?>

          <?php if ($list2Items): ?>
            <?php if (!empty($s['list2_heading'])): ?><h4 class="feature-list-heading"><?= e($s['list2_heading']) ?></h4><?php endif; ?>
            <ul class="feature-list">
              <?php foreach ($list2Items as $item): ?><li><span class="tick">&#10003;</span> <?= e($item) ?></li><?php endforeach; ?>
            </ul>
          <?php endif; ?>

          <?php if ($noteParts): ?>
            <div class="feature-note">
              <?php if (count($noteParts) > 1): ?>
                <strong><?= e(trim($noteParts[0])) ?></strong><?= e(trim($noteParts[1])) ?>
              <?php else: ?>
                <?= e(trim($noteParts[0])) ?>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="feature-media" data-bg="url('<?= e($img) ?>')"></div>
      </div>
    </section>
  <?php endforeach; ?>

  <?php if (!$sections): ?>
    <section class="section"><div class="container"><p>Feature sections will appear here once added from the admin panel.</p></div></section>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
