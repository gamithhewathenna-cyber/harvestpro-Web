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

$seoTitle       = setting('about_seo_title', '');
$seoDescription = setting('about_seo_description', '');
$seoKeywords    = setting('about_seo_keywords', '');
$seoNoindex     = setting('about_seo_noindex') === '1';

$aTitle      = setting('about_title', "Built for Plantations,\nby **Industry** & Technology Experts.");
$aSubtitle   = setting('about_subtitle', '');
$aBannerBg   = image_url('about_banner_image', 'assets/images/hero-bg.jpg');

$aStoryImg = image_url('about_story_image', 'assets/images/dashboard.png');

$partner1Tags = array_filter(array_map('trim', explode('|', setting('about_partner1_tags'))));
$partner2Tags = array_filter(array_map('trim', explode('|', setting('about_partner2_tags'))));
$partner1Logo = image_url('about_partner1_logo', '');
$partner2Logo = image_url('about_partner2_logo', '');

$whyItems = array_filter(array_map('trim', explode("\n", setting('about_why_items'))));

$aCtaBg = image_url('about_cta_bg_image', 'assets/images/cta-bg.jpg');

$pageTitle = $seoTitle !== '' ? $seoTitle : 'About Us — ' . $brandName . ' Pro';
$pageDesc  = $seoDescription !== '' ? $seoDescription : $aSubtitle;
$pageImg   = absolute_url($aBannerBg);
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
<?php seo_meta_tags('/about', $pageTitle, $pageDesc, $pageImg, $brandName . ' Pro'); ?>
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

<?php $activeNav = 'about'; require __DIR__ . '/includes/site-nav.php'; ?>

<!-- ============================= PAGE BANNER ============================= -->
<header class="page-banner" style="background-image:linear-gradient(rgba(10,20,12,.45),rgba(10,20,12,.65)),url('<?= e($aBannerBg) ?>');">
  <div class="container">
    <div class="page-banner-inner">
      <h1><?= styled_heading($aTitle) ?></h1>
      <p><?= e($aSubtitle) ?></p>
    </div>
  </div>
</header>

<!-- ============================= ABOUT STORY ============================= -->
<section class="about-story section">
  <div class="container">
    <div class="about-story-grid">
      <div class="about-story-panel">
        <span class="pill pill-dark"><span class="pill-arrow">&rarr;</span> <?= e(setting('about_story_badge')) ?></span>
        <h2><?= e(setting('about_story_title')) ?></h2>
        <p><?= e(setting('about_story_para_1')) ?></p>
        <p><?= e(setting('about_story_para_2')) ?></p>
        <p><?= e(setting('about_story_para_3')) ?></p>

        <div class="about-story-boxes">
          <div class="about-story-box">
            <h4><?= e(setting('about_vision_title')) ?></h4>
            <p><?= e(setting('about_vision_text')) ?></p>
          </div>
          <div class="about-story-box">
            <h4><?= e(setting('about_mission_title')) ?></h4>
            <p><?= e(setting('about_mission_text')) ?></p>
          </div>
        </div>
      </div>

      <div class="about-story-photo" style="background-image:url('<?= e($aStoryImg) ?>');"></div>
    </div>
  </div>
</section>

<!-- ============================= DEVELOPMENT PARTNERS ============================= -->
<section class="partners section">
  <div class="container">
    <div class="partners-head">
      <span class="pill"><span class="pill-arrow">&rarr;</span> <?= e(setting('about_partners_badge')) ?></span>
      <h2><?= styled_heading(setting('about_partners_title')) ?></h2>
    </div>

    <div class="partners-grid">
      <div class="partner-card">
        <?php if ($partner1Logo): ?>
          <img src="<?= e($partner1Logo) ?>" alt="<?= e(setting('about_partner1_name')) ?>" class="partner-logo">
        <?php else: ?>
          <span class="partner-logo-fallback"><?= e(initials(setting('about_partner1_name', 'CE'))) ?></span>
        <?php endif; ?>
        <h3><?= e(setting('about_partner1_name')) ?></h3>
        <p><?= e(setting('about_partner1_desc')) ?></p>
        <div class="partner-tags">
          <?php foreach ($partner1Tags as $tag): ?><span class="partner-tag"><?= e($tag) ?></span><?php endforeach; ?>
        </div>
      </div>

      <div class="partner-card">
        <?php if ($partner2Logo): ?>
          <img src="<?= e($partner2Logo) ?>" alt="<?= e(setting('about_partner2_name')) ?>" class="partner-logo">
        <?php else: ?>
          <span class="partner-logo-fallback"><?= e(initials(setting('about_partner2_name', 'K'))) ?></span>
        <?php endif; ?>
        <h3><?= e(setting('about_partner2_name')) ?></h3>
        <p><?= e(setting('about_partner2_desc')) ?></p>
        <div class="partner-tags">
          <?php foreach ($partner2Tags as $tag): ?><span class="partner-tag"><?= e($tag) ?></span><?php endforeach; ?>
        </div>
      </div>
    </div>

    <p class="partners-footer"><?= e(setting('about_partners_footer')) ?></p>
  </div>
</section>

<!-- ============================= WHY CHOOSE ============================= -->
<section class="why-choose section">
  <div class="container">
    <span class="pill pill-dark"><span class="pill-arrow">&rarr;</span> <?= e(setting('about_why_badge')) ?></span>
    <h2 class="why-choose-title"><?= e(setting('about_why_title')) ?></h2>

    <div class="why-choose-grid">
      <?php foreach ($whyItems as $line):
          $parts = explode('|', $line, 2);
          $title = trim($parts[0] ?? '');
          $desc  = trim($parts[1] ?? '');
      ?>
        <div class="why-choose-card">
          <h4><?= e($title) ?></h4>
          <p><?= e($desc) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================= CTA ============================= -->
<section class="cta" style="background-image:linear-gradient(rgba(15,30,18,.72),rgba(15,30,18,.55)),url('<?= e($aCtaBg) ?>');">
  <div class="container">
    <div class="cta-inner">
      <p class="cta-kicker"><?= e(setting('about_cta_kicker')) ?></p>
      <h2 class="cta-title"><?= e(setting('about_cta_title')) ?></h2>
      <p class="cta-para"><?= e(setting('about_cta_para')) ?></p>
      <div class="cta-btns">
        <a href="<?= e(setting('about_cta_btn1_link')) ?>" class="btn btn-primary"><?= e(setting('about_cta_btn1_text')) ?></a>
        <a href="<?= e(setting('about_cta_btn2_link')) ?>" class="btn btn-text light"><?= e(setting('about_cta_btn2_text')) ?> <span>&rarr;</span></a>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
