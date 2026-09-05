<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/maintenance-gate.php';

$features    = get_features();
$brandName   = setting('brand_name', 'Harvest');
$brandLogo   = setting('brand_logo', '');
$brandLogoUrl= $brandLogo ? image_url('brand_logo') : '';
$brandLogoWhite   = setting('brand_logo_white', '');
// Navbar sits on the dark hero background — prefer the white logo there, falling back to the regular logo.
$brandLogoNavUrl  = $brandLogoWhite ? image_url('brand_logo_white') : $brandLogoUrl;

$themePrimary = setting('theme_primary_color', '');
$themeAccent  = setting('theme_accent_color', '');

$seoTitle       = setting('home_seo_title', '');
$seoDescription = setting('home_seo_description', '');
$seoKeywords    = setting('home_seo_keywords', '');
$seoNoindex     = setting('home_seo_noindex') === '1';

// Ticker items
$tickerItems = array_filter(array_map('trim', explode('|', setting('ticker_items'))));

// Why checklist ("bold|rest" per line)
$whyChecklist = array_filter(array_map('trim', explode("\n", setting('why_checklist'))));

// How-it-helps tags
$howTags = array_filter(array_map('trim', explode('|', setting('how_tags'))));

// Hero slider
$heroSlides = get_hero_slides();
if (!$heroSlides) {
    $heroSlides = [[
        'headline'  => 'Smarter Plantation Management. Better Productivity.',
        'subtext'   => 'A modern platform built for the unique demands of tea estates and plantations — from worker management to real-time production tracking, all from one unified system.',
        'btn1_text' => 'Request a Demo', 'btn1_link' => '#contact',
        'btn2_text' => 'Explore Features', 'btn2_link' => '#features',
        'image'     => '',
    ]];
}

$whyImg1       = image_url('why_image_1', 'assets/images/why-1.jpg');
$whyImg2       = image_url('why_image_2', 'assets/images/why-2.jpg');
$ctaBg         = image_url('cta_bg_image', 'assets/images/cta-bg.jpg');

$pageTitle = $seoTitle !== '' ? $seoTitle : $brandName . ' Pro — Smarter Plantation Management';
$pageDesc  = $seoDescription !== '' ? $seoDescription : ($heroSlides[0]['subtext'] ?? '');
$pageImg   = absolute_url(resolve_image_url($heroSlides[0]['image'] ?? '', 'assets/images/hero-bg.jpg'));
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
<?php seo_meta_tags('/', $pageTitle, $pageDesc, $pageImg, $brandName . ' Pro'); ?>
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

<?php $activeNav = 'home'; require __DIR__ . '/includes/site-nav.php'; ?>

<!-- ============================= HEADER / HERO ============================= -->
<header class="hero" id="home">
  <div class="hero-slider" id="heroSlider">
    <?php foreach ($heroSlides as $i => $slide):
        $slideBg = resolve_image_url($slide['image'] ?? '', 'assets/images/hero-bg.jpg');
    ?>
      <div class="hero-slide<?= $i === 0 ? ' active' : '' ?>" style="background-image:linear-gradient(rgba(10,30,15,.4),rgba(10,30,15,.55)),url('<?= e($slideBg) ?>');">
        <div class="hero-inner">
          <div class="hero-content">
            <h1 class="hero-title"><?= e($slide['headline'] ?? '') ?></h1>
            <?php if (!empty($slide['subtext'])): ?><p class="hero-sub"><?= e($slide['subtext']) ?></p><?php endif; ?>
            <div class="hero-btns">
              <?php if (!empty($slide['btn1_text'])): ?>
                <a href="<?= e($slide['btn1_link'] ?: '#') ?>" class="btn btn-primary"><?= e($slide['btn1_text']) ?></a>
              <?php endif; ?>
              <?php if (!empty($slide['btn2_text'])): ?>
                <a href="<?= e($slide['btn2_link'] ?: '#') ?>" class="btn btn-text"><?= e($slide['btn2_text']) ?> <span>&rarr;</span></a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <?php if (count($heroSlides) > 1): ?>
    <button class="hero-arrow prev" id="heroPrev" aria-label="Previous slide">
      <svg viewBox="0 0 20 20" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="12,4 6,10 12,16"/></svg>
    </button>
    <button class="hero-arrow next" id="heroNext" aria-label="Next slide">
      <svg viewBox="0 0 20 20" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="8,4 14,10 8,16"/></svg>
    </button>
    <div class="hero-dots">
      <?php foreach ($heroSlides as $i => $slide): ?>
        <button class="hero-dot<?= $i === 0 ? ' active' : '' ?>" data-slide="<?= $i ?>" aria-label="Go to slide <?= $i + 1 ?>"></button>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</header>

<!-- ============================= TICKER STRIP ============================= -->
<div class="ticker">
  <div class="ticker-track">
    <?php for ($i = 0; $i < 2; $i++): ?>
      <?php foreach ($tickerItems as $item): ?>
        <span class="ticker-item"><span class="diamond">&#9670;</span> <?= e($item) ?></span>
      <?php endforeach; ?>
    <?php endfor; ?>
  </div>
</div>

<!-- ============================= WHY HARVEST PRO ============================= -->
<section class="why section" id="about">
  <div class="container">
    <span class="pill"><span class="pill-arrow">&rarr;</span> <?= e(setting('why_badge')) ?></span>

    <div class="why-grid">
      <div class="why-media">
        <div class="why-checklist">
          <ul>
            <?php foreach ($whyChecklist as $line):
              $parts = explode('|', $line, 2);
              $bold  = trim($parts[0] ?? '');
              $rest  = trim($parts[1] ?? '');
            ?>
              <li><span class="tick">&#10003;</span> <strong><?= e($bold) ?></strong> <?= e($rest) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="why-photo why-photo-top" style="background-image:url('<?= e($whyImg1) ?>');"></div>
        <div class="why-photo why-photo-bottom" style="background-image:url('<?= e($whyImg2) ?>');"></div>

        <div class="why-stat">
          <span class="why-stat-badge"><?= e(setting('why_stat_number')) ?></span>
          <span class="why-stat-label"><?= e(setting('why_stat_label')) ?></span>
        </div>
      </div>

      <div class="why-text">
        <h2 class="why-heading">
          <?= e(setting('why_title_1')) ?>
          <span class="accent"><?= e(setting('why_title_2')) ?></span>
        </h2>
        <p><?= e(setting('why_para_1')) ?></p>
        <p><?= e(setting('why_para_2')) ?></p>
        <a href="<?= e(setting('why_btn_link')) ?>" class="btn btn-outline"><?= e(setting('why_btn_text')) ?> <span>&mdash;</span></a>
      </div>
    </div>
  </div>
</section>

<!-- ============================= KEY FEATURES ============================= -->
<section class="features section" id="features">
  <div class="container">
    <div class="features-card">
      <div class="features-left">
        <span class="pill pill-dark"><span class="pill-arrow yellow">&rarr;</span> <?= e(setting('features_badge')) ?></span>
        <p class="features-kicker"><?= e(setting('features_title_1')) ?></p>
        <h2 class="features-title"><?= e(setting('features_title_2')) ?></h2>
        <div class="features-watermark"><?= e($brandName) ?></div>
      </div>

      <div class="features-right">
        <?php foreach ($features as $f): ?>
          <div class="feature-item">
            <h3><?= e($f['title']) ?></h3>
            <p><?= e($f['description']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============================= HOW IT HELPS ============================= -->
<section class="how section">
  <div class="container">
    <span class="pill"><span class="pill-arrow">&rarr;</span> <?= e(setting('how_badge')) ?></span>
    <div class="how-grid">
      <div class="how-left">
        <h2 class="how-title"><?= e(setting('how_title')) ?></h2>
      </div>
      <div class="how-right">
        <p><?= e(setting('how_para_1')) ?></p>
        <p><?= e(setting('how_para_2')) ?></p>
        <div class="how-tags">
          <?php foreach ($howTags as $tag): ?>
            <span class="tag"><?= e($tag) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================= CTA ============================= -->
<section class="cta" id="contact" style="background-image:linear-gradient(rgba(15,30,18,.72),rgba(15,30,18,.55)),url('<?= e($ctaBg) ?>');">
  <div class="container">
    <div class="cta-inner">
      <p class="cta-kicker"><?= e(setting('cta_kicker')) ?></p>
      <h2 class="cta-title"><?= e(setting('cta_title')) ?></h2>
      <p class="cta-para"><?= e(setting('cta_para')) ?></p>
      <div class="cta-btns">
        <a href="/contact" class="btn btn-primary"><?= e(setting('cta_btn1_text')) ?></a>
        <a href="/contact" class="btn btn-text light"><?= e(setting('cta_btn2_text')) ?> <span>&rarr;</span></a>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
