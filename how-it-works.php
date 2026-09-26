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

// All 9 steps' content (title, summary, teaser, tip, sub-steps, screenshot
// image) is admin-editable from Settings → How It Works — see get_hiw_steps()
// in includes/functions.php for the defaults + override logic.
$howSteps = get_hiw_steps();

// Fallback copy for any future step added without content yet (every step
// above currently has its own real content, so this path isn't hit today).
$hiwComingSoonNote = t('Full step-by-step instructions, screenshots and tips for this section will be added shortly.');

$hiwIcons = [
    'user'     => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6.5" r="3.2"/><path d="M3.5 16.5c0-3.6 2.9-6 6.5-6s6.5 2.4 6.5 6"/></svg>',
    'home'     => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9.5 10 3l7 6.5"/><path d="M5 8.5V17h10V8.5"/><path d="M8 17v-5h4v5"/></svg>',
    'settings' => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="10" r="2.6"/><path d="M10 2.8v2M10 15.2v2M17.2 10h-2M4.8 10h-2M15.1 4.9l-1.4 1.4M6.3 13.7l-1.4 1.4M15.1 15.1l-1.4-1.4M6.3 6.3 4.9 4.9"/></svg>',
    'people'   => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="7" cy="6.5" r="2.3"/><path d="M2.5 16c0-3 2-5 4.5-5s4.5 2 4.5 5"/><circle cx="14" cy="7.5" r="1.9"/><path d="M11.8 11c2-.3 3.7 1.1 4.2 3.4"/></svg>',
    'calendar' => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="14" height="12" rx="1.6"/><path d="M3 8h14M7 2.8v3M13 2.8v3"/><path d="M7 11.2h2M11 11.2h2M7 14h2"/></svg>',
    'receipt'  => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 2.5h10v15l-2-1.3-1.5 1.3-1.5-1.3-1.5 1.3-1.5-1.3-2 1.3v-15Z"/><line x1="7.3" y1="6.5" x2="12.7" y2="6.5"/><line x1="7.3" y1="9.5" x2="12.7" y2="9.5"/><line x1="7.3" y1="12.5" x2="11" y2="12.5"/></svg>',
    'leaf'     => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 16c0-7 4-11 11-12 1 7-3 11-11 12Z"/><path d="M6 14c2-3 4-5 8-7"/></svg>',
    'factory'  => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 17V9l4 2.5V9l4 2.5V7l6 2v8H2.5Z"/><path d="M15 9V6"/></svg>',
    'bell'     => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 8.2c0-2.9 2.2-5.2 5-5.2s5 2.3 5 5.2c0 3.6 1 5 1.6 5.8H3.4C4 13.2 5 11.8 5 8.2Z"/><path d="M8.3 16.8a1.9 1.9 0 0 0 3.4 0"/></svg>',
];
$hiwShotSvg = '<svg viewBox="0 0 24 24" width="38" height="38" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="8.5" cy="9.5" r="1.5"/><path d="M21 16l-5-5-4 4-3-3-6 6"/></svg>';
$hiwBulbSvg = '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18h6M10 21h4M12 3a6 6 0 0 0-3.5 10.9c.6.4 1 1.1 1 1.9v.2h5v-.2c0-.8.4-1.5 1-1.9A6 6 0 0 0 12 3Z"/></svg>';

$stepCount = count($howSteps);

$pageTitle = 'How It Works — ' . $brandName . ' Pro';
$pageDesc  = 'See how to set up your tea estate and start managing daily operations with Harvest Pro, step by step.';
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
<?php seo_meta_tags('/how-it-works', $pageTitle, $pageDesc, $pageImg, $brandName . ' Pro'); ?>
<?php sinhala_font_tags(); ?>
<link rel="stylesheet" href="assets/css/style.css?v=5.2">
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

<?php $activeNav = 'how-it-works'; require __DIR__ . '/includes/site-nav.php'; ?>

<!-- ============================= PAGE BANNER ============================= -->
<header class="page-banner" style="background-image:linear-gradient(rgba(10,20,12,.55),rgba(10,20,12,.7)),url('<?= e($bannerBg) ?>');">
  <div class="container">
    <div class="page-banner-inner" style="max-width:760px;">
      <h1><?= e(t('How')) ?> <?= e($brandName) ?> <span class="accent"><?= e(t('Works')) ?></span></h1>
      <p><?= e(t('Set up your tea estate and start managing your daily operations in just a few simple steps.')) ?></p>
    </div>
  </div>
</header>

<!-- ============================= STEP TABS ============================= -->
<section class="section" style="padding-bottom:70px;">
  <div class="container">

    <div class="hiw-box">
    <div class="hiw-ribbon-wrap">
      <div class="hiw-ribbon" id="hiwRibbon">
        <?php foreach ($howSteps as $i => $s): ?>
          <button type="button" class="hiw-pill<?= $i === 0 ? ' active' : '' ?>" data-step="<?= e($s['key']) ?>">
            <span class="hiw-pill-num"><?= $i + 1 ?></span>
            <span class="hiw-pill-label"><?= e($s['title']) ?></span>
          </button>
        <?php endforeach; ?>
      </div>
    </div>

    <div id="hiwPanels">
      <?php foreach ($howSteps as $i => $s): ?>
        <div class="hiw-panel<?= $i === 0 ? ' active' : '' ?>" data-step-panel="<?= e($s['key']) ?>">
          <div class="hiw-panel-head">
            <div>
              <span class="hiw-eyebrow"><?= e(sprintf(t('STEP %02d'), $i + 1)) ?></span>
              <h2><?= e($s['title']) ?></h2>
            </div>
            <div class="hiw-panel-nav">
              <span class="hiw-counter"><?= $i + 1 ?> / <?= $stepCount ?></span>
              <button type="button" class="hiw-nav-btn" data-hiw-prev aria-label="<?= e(t('Previous step')) ?>">&larr;</button>
              <button type="button" class="hiw-nav-btn" data-hiw-next aria-label="<?= e(t('Next step')) ?>">&rarr;</button>
            </div>
          </div>

          <p class="hiw-summary"><?= e($s['summary']) ?></p>

          <?php if (!empty($s['image'])): ?>
            <div class="hiw-shot hiw-shot-img">
              <img src="<?= e($s['image']) ?>" alt="<?= e($s['title']) ?>">
            </div>
          <?php else: ?>
            <div class="hiw-shot">
              <?= $hiwShotSvg ?>
              <span><?= e(t('Screenshot placeholder')) ?></span>
            </div>
          <?php endif; ?>

          <?php if ($s['substeps']): ?>
            <div class="hiw-substeps">
              <?php foreach ($s['substeps'] as $j => $sub): ?>
                <div class="hiw-substep">
                  <span class="hiw-substep-num"><?= $j + 1 ?></span>
                  <div>
                    <h4><?= e($sub[0]) ?></h4>
                    <p><?= e($sub[1]) ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <?php if (!empty($s['tip'])): ?>
              <div class="hiw-tip">
                <?= $hiwBulbSvg ?>
                <p><?= e($s['tip']) ?></p>
              </div>
            <?php endif; ?>
          <?php else: ?>
            <div class="hiw-placeholder-note">
              <span class="hiw-badge"><?= e(t('Coming soon')) ?></span>
              <p><?= e($hiwComingSoonNote) ?></p>
            </div>
          <?php endif; ?>

          <div class="hiw-panel-foot">
            <button type="button" class="btn btn-outline" data-hiw-prev><?= e(t('Previous')) ?></button>
            <button type="button" class="btn btn-primary" data-hiw-next>
              <?php if ($i < $stepCount - 1): ?>
                <?= e(t('Next:')) ?> <?= e($howSteps[$i + 1]['title']) ?>
              <?php else: ?>
                <?= e(t('Back to Start')) ?>
              <?php endif; ?>
              <span>&rarr;</span>
            </button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    </div>
  </div>
</section>

<!-- ============================= EXPLORE ALL STEPS ============================= -->
<section class="section" style="padding-top:0;">
  <div class="container">
    <div class="hiw-explore-head">
      <h2><?= e(t('Explore All Steps')) ?></h2>
      <p><?= e(t('From setup to daily operations, get familiar with everything Harvest Pro can do for your estate.')) ?></p>
    </div>
    <div class="hiw-grid">
      <?php foreach ($howSteps as $i => $s): ?>
        <button type="button" class="hiw-card" data-step="<?= e($s['key']) ?>">
          <span class="hiw-card-icon"><?= $hiwIcons[$s['icon']] ?? '' ?></span>
          <span class="hiw-card-num"><?= e(sprintf('%02d', $i + 1)) ?></span>
          <span class="hiw-card-title"><?= e($s['title']) ?></span>
          <span class="hiw-card-desc"><?= e($s['teaser'] ?? t('Coming soon')) ?></span>
        </button>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================= CTA ============================= -->
<section class="cta" data-bg="linear-gradient(rgba(15,30,18,.72),rgba(15,30,18,.55)),url('<?= e($ctaBg) ?>')">
  <div class="container">
    <div class="cta-inner">
      <h2 class="cta-title"><?= e(t('Ready to Manage Your Estate Smarter?')) ?></h2>
      <p class="cta-para"><?= e(t('Start your 14-day free trial and set up your estate today.')) ?></p>
      <div class="cta-btns">
        <a href="<?= e($priceLink) ?>" class="btn btn-primary"><?= e(t('Start Free Trial')) ?> <span>&rarr;</span></a>
        <a href="/contact" class="btn btn-text light"><?= e(t('Contact Support')) ?></a>
      </div>
    </div>
  </div>
</section>
<script src="assets/js/how-it-works.js?v=1.0" defer></script>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
