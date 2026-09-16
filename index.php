<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/maintenance-gate.php';

$features    = get_features();
$brandName   = setting('brand_name', 'Harvest');
$brandLogo   = setting('brand_logo', '');
$brandLogoUrl= $brandLogo ? image_url('brand_logo') : '';
$faviconUrl  = image_url('favicon');
$brandLogoWhite   = setting('brand_logo_white', '');
// Navbar sits on the dark hero background — prefer the white logo there, falling back to the regular logo.
$brandLogoNavUrl  = $brandLogoWhite ? image_url('brand_logo_white') : $brandLogoUrl;

$themePrimary = setting('theme_primary_color', '');
$themeAccent  = setting('theme_accent_color', '');

$seoTitle       = setting('home_seo_title', '');
$seoDescription = setting('home_seo_description', '');
$seoKeywords    = setting('home_seo_keywords', '');

// Ticker items
$tickerItems = array_filter(array_map('trim', explode('|', setting('ticker_items'))));

// "Live Estate Activity" demo card (left side of the Why section) — fixed
// dummy data for visual showcase, not tied to real estate records.
$liveFeedAgo = function (int $mins): string {
    return current_lang() === 'si' ? $mins . ' මිනි. පෙර' : $mins . 'm ago';
};
$liveFeedItems = [
    ['icon' => 'leaf',    'value' => '128.5 KG', 'part1' => t('Green Leaf Recorded'), 'part2' => 'Section A', 'time' => $liveFeedAgo(2)],
    ['icon' => 'people',  'value' => '24 ' . t('Workers'), 'part1' => t('Attendance Completed'), 'part2' => 'Estate 01', 'time' => $liveFeedAgo(5)],
    ['icon' => 'coins',   'value' => 'Rs. 18,450', 'part1' => t('Payroll Processed'), 'part2' => 'Division B', 'time' => $liveFeedAgo(12)],
    ['icon' => 'bag',     'value' => t('Fertilizer Applied'), 'part1' => 'Section C', 'part2' => '2.5 ' . t('Acres'), 'time' => $liveFeedAgo(18)],
    ['icon' => 'leaf',    'value' => '86.2 KG', 'part1' => t('Green Leaf Recorded'), 'part2' => 'Section D', 'time' => $liveFeedAgo(27)],
    ['icon' => 'check',   'value' => t('Assignment Completed'), 'part1' => t('Tea Plucking'), 'part2' => '12 ' . t('Workers'), 'time' => $liveFeedAgo(34)],
    ['icon' => 'coins',   'value' => 'Rs. 6,800', 'part1' => t('Field Expense Recorded'), 'part2' => '', 'time' => $liveFeedAgo(41)],
    ['icon' => 'factory', 'value' => '145.7 KG', 'part1' => t('Factory Collection Recorded'), 'part2' => '', 'time' => $liveFeedAgo(58)],
];
$liveFeedIcons = [
    'leaf'    => '<svg viewBox="0 0 20 20" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 16c0-7 4-11 11-12 1 7-3 11-11 12Z"/><path d="M6 14c2-3 4-5 8-7"/></svg>',
    'people'  => '<svg viewBox="0 0 20 20" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="7" cy="6.5" r="2.3"/><path d="M2.5 16c0-3 2-5 4.5-5s4.5 2 4.5 5"/><circle cx="14" cy="7.5" r="1.9"/><path d="M11.8 11c2-.3 3.7 1.1 4.2 3.4"/></svg>',
    'coins'   => '<svg viewBox="0 0 20 20" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="10" cy="5.5" rx="6" ry="2.3"/><path d="M4 5.5v4c0 1.3 2.7 2.3 6 2.3s6-1 6-2.3v-4"/><path d="M4 9.5v4c0 1.3 2.7 2.3 6 2.3s6-1 6-2.3v-4"/></svg>',
    'bag'     => '<svg viewBox="0 0 20 20" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M7 4h6l1.5 3H5.5L7 4Z"/><path d="M5 7h10l-1 9a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 7Z"/><path d="M10 10v5"/></svg>',
    'check'   => '<svg viewBox="0 0 20 20" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="10" r="7.5"/><path d="M6.8 10.2l2.1 2.1 4.3-4.6"/></svg>',
    'factory' => '<svg viewBox="0 0 20 20" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 17V9l4 2.5V9l4 2.5V7l6 2v8H2.5Z"/><path d="M15 9V6"/></svg>',
];

// How-it-helps tags
$howTags = array_filter(array_map('trim', explode('|', setting('how_tags'))));

// Pricing section (fixed set of 3 plan tiers)
$trialNote = '14-day free trial on online signup. No charge until you subscribe.';
$pricingDefaults = [
    1 => [
        'label' => 'Basic Tier', 'name' => 'Harvest Pro Base Estate Management Plan', 'price' => '2,000',
        'note' => $trialNote, 'included' => '', 'badge' => '',
        'features' => "Dashboard & Estate Overview\nEmployee & User Management\nService & Daily Assignment\nExpense Tracking\nReminders & Calendar\nReports (Excel & PDF)\nData Backups\nMulti-language Support",
    ],
    2 => [
        'label' => 'Mid Tier', 'name' => 'Harvest Pro Automated Payroll & Estate Plan', 'price' => '5,000',
        'note' => $trialNote, 'included' => 'Everything in Basic Tier, plus:', 'badge' => 'Recommended',
        'features' => "Automated Payroll Processing\nWorker & Plantation Payroll Views\nDaily Payroll Summary\nPayment Tracking & History\nBulk Payment Actions\nEPF / ETF contributions, Form C & R4",
    ],
    3 => [
        'label' => 'Top Tier', 'name' => 'Harvest Pro Complete Tea Factory & Operations Suite', 'price' => '10,000',
        'note' => $trialNote, 'included' => 'Everything in Mid Tier, plus:', 'badge' => '',
        'features' => "Tea Factory Operations\nLeaf Intake & Weighing\nProcessing & Quality Grading\nFactory Inventory & Stock\nBuyer & Sales Management\nFactory Reports & Analytics",
    ],
];
$pricingTiers = [];
foreach ($pricingDefaults as $n => $def) {
    $pricingTiers[] = [
        'label'    => setting("pricing{$n}_label", $def['label']),
        'name'     => setting("pricing{$n}_name", $def['name']),
        'price'    => setting("pricing{$n}_price", $def['price']),
        'note'     => setting("pricing{$n}_note", $def['note']),
        'badge'    => $def['badge'] !== '' ? setting("pricing{$n}_badge", $def['badge']) : '',
        'included' => $def['included'] !== '' ? setting("pricing{$n}_included_label", $def['included']) : '',
        'features' => array_filter(array_map('trim', explode("\n", setting("pricing{$n}_features", $def['features'])))),
        'featured' => $n === 2,
    ];
}
$pricingBtnText = setting('pricing_btn_text', 'Request a Demo – 14-Day Free Trial');
$pricingBtnLink = setting('pricing_btn_link', '#contact');

// Trust section (fixed set of 4 icon cards)
$trustDefaults = [
    1 => ['shield',               'Secure by Design',       'Your estate data is protected with modern security practices.'],
    2 => ['public',                'Always Within Reach',     'Access your plantation operations securely, wherever you are.'],
    3 => ['cloud_done',            'Backed Up & Protected',   'Regular backups help keep your important records safe.'],
    4 => ['admin_panel_settings',  'Access You Control',      'Give the right people access to the right information.'],
];
$trustItems = [];
foreach ($trustDefaults as $n => [$defIcon, $defTitle, $defDesc]) {
    $icon = setting("trust{$n}_icon", $defIcon);
    $ttl  = setting("trust{$n}_title", $defTitle);
    if ($icon === '' && $ttl === '') {
        continue;
    }
    $trustItems[] = [
        'icon'  => $icon,
        'title' => $ttl,
        'desc'  => setting("trust{$n}_desc", $defDesc),
    ];
}

// Hero slider
$heroSlides = get_hero_slides();
if (!$heroSlides) {
    $heroSlides = [[
        'headline'  => t('Smarter Plantation Management. Better Productivity.'),
        'subtext'   => t('A modern platform built for the unique demands of tea estates and plantations — from worker management to real-time production tracking, all from one unified system.'),
        'btn1_text' => t('Request a Demo'), 'btn1_link' => '#contact',
        'btn2_text' => t('Explore Features'), 'btn2_link' => '#features',
        'image'     => '',
    ]];
}

$ctaBg         = image_url('cta_bg_image', 'assets/images/cta-bg.jpg');

$pageTitle = $seoTitle !== '' ? $seoTitle : $brandName . ' Pro — Smarter Plantation Management';
$pageDesc  = $seoDescription !== '' ? $seoDescription : ($heroSlides[0]['subtext'] ?? '');
$pageImg   = absolute_url(resolve_image_url($heroSlides[0]['image'] ?? '', 'assets/images/hero-bg.jpg'));
?>
<!DOCTYPE html>
<html lang="<?= e(current_lang()) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if ($faviconUrl !== ''): ?><link rel="icon" href="<?= e($faviconUrl) ?>"><?php endif; ?>
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDesc) ?>">
<?php if ($seoKeywords !== ''): ?>
<meta name="keywords" content="<?= e($seoKeywords) ?>">
<?php endif; ?>
<?php seo_meta_tags('/', $pageTitle, $pageDesc, $pageImg, $brandName . ' Pro'); ?>
<?php sinhala_font_tags(); ?>
<?php if ($trustItems): ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
<?php endif; ?>
<link rel="stylesheet" href="assets/css/style.css?v=3.2">
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
        <div class="live-feed">
          <div class="live-feed-header">
            <div class="live-feed-status">
              <span class="live-dot"></span>
              <strong><?= e(t('Live')) ?></strong>
              <span class="live-feed-sep"></span>
              <span class="live-feed-sub"><?= e(t('Estate activity now')) ?></span>
            </div>
            <span class="live-feed-badge">
              <?= e(t('Demo Data')) ?>
              <svg viewBox="0 0 20 20" width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="10" cy="10" r="7.3"/><line x1="10" y1="9.3" x2="10" y2="14.2"/><circle cx="10" cy="6.6" r="0.9" fill="currentColor" stroke="none"/></svg>
            </span>
          </div>

          <ul class="live-feed-list">
            <?php foreach ($liveFeedItems as $item): ?>
              <li>
                <span class="live-feed-icon"><?= $liveFeedIcons[$item['icon']] ?? '' ?></span>
                <span class="live-feed-text">
                  <strong><?= e($item['value']) ?></strong>
                  <span><?= e($item['part1']) ?><?php if ($item['part2'] !== ''): ?> &middot; <?= e($item['part2']) ?><?php endif; ?></span>
                </span>
                <span class="live-feed-time"><?= e($item['time']) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>

          <div class="live-feed-stats">
            <div>
              <span class="live-feed-stat-label"><?= e(t('Activities Today')) ?></span>
              <span class="live-feed-stat-value">184</span>
            </div>
            <div>
              <span class="live-feed-stat-label"><?= e(t('Green Leaf Today')) ?></span>
              <span class="live-feed-stat-value">2,840 KG</span>
            </div>
          </div>
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

<!-- ============================= PRICING ============================= -->
<section class="pricing section">
  <div class="container">
    <p class="pricing-kicker"><?= e(setting('pricing_kicker', 'Simple, Transparent Plans')) ?></p>
    <h2 class="pricing-title"><?= e(setting('pricing_title', 'Choose Your Plan')) ?></h2>
    <p class="pricing-subtitle"><?= e(setting('pricing_subtitle', 'Scale from basic estate management to payroll and complete tea factory operations.')) ?></p>

    <div class="pricing-grid">
      <?php foreach ($pricingTiers as $tier): ?>
        <div class="pricing-card<?= $tier['featured'] ? ' featured' : '' ?>">
          <?php if ($tier['badge'] !== ''): ?><span class="pricing-badge"><?= e($tier['badge']) ?></span><?php endif; ?>
          <span class="pricing-label"><?= e($tier['label']) ?></span>
          <p class="pricing-name"><?= e($tier['name']) ?></p>
          <div class="pricing-price">
            <span class="pricing-currency">LKR</span>
            <span class="pricing-amount"><?= e($tier['price']) ?></span>
            <span class="pricing-period">/month</span>
          </div>
          <?php if ($tier['note'] !== ''): ?><p class="pricing-note"><?= e($tier['note']) ?></p><?php endif; ?>
          <div class="pricing-divider"></div>
          <?php if ($tier['included'] !== ''): ?><p class="pricing-included"><?= e($tier['included']) ?></p><?php endif; ?>
          <ul class="pricing-features">
            <?php foreach ($tier['features'] as $feat): ?>
              <li>
                <span class="pricing-tick"><svg viewBox="0 0 20 20" width="12" height="12" fill="none" stroke="#fff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><polyline points="5,10.5 8.5,14 15,6.5"/></svg></span>
                <span><?= e($feat) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="pricing-cta">
      <a href="<?= e($pricingBtnLink) ?>" class="btn btn-primary"><?= e($pricingBtnText) ?></a>
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

<?php if ($trustItems): ?>
<!-- ============================= TRUST ============================= -->
<section class="trust section">
  <div class="container">
    <p class="trust-kicker"><?= e(setting('trust_kicker', 'Your Estate. Your Data. Protected.')) ?></p>
    <h2 class="trust-title"><?= e(setting('trust_title', 'Trusted to Keep Your Estate Moving')) ?></h2>
    <div class="trust-grid">
      <?php foreach ($trustItems as $item): ?>
        <div class="trust-card">
          <?php if ($item['icon'] !== ''): ?>
            <span class="trust-icon material-symbols-outlined" aria-hidden="true"><?= e($item['icon']) ?></span>
          <?php endif; ?>
          <h3><?= e($item['title']) ?></h3>
          <p><?= e($item['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============================= CTA ============================= -->
<section class="cta" id="contact" data-bg="linear-gradient(rgba(15,30,18,.72),rgba(15,30,18,.55)),url('<?= e($ctaBg) ?>')">
  <div class="container">
    <div class="cta-inner">
      <p class="cta-kicker"><?= e(setting('cta_kicker')) ?></p>
      <h2 class="cta-title"><?= e(setting('cta_title')) ?></h2>
      <p class="cta-para"><?= e(setting('cta_para')) ?></p>
      <div class="cta-btns">
        <a href="<?= e(setting('cta_btn1_link', '/contact')) ?>" class="btn btn-primary"><?= e(setting('cta_btn1_text')) ?></a>
        <a href="<?= e(setting('cta_btn2_link', '/contact')) ?>" class="btn btn-text light"><?= e(setting('cta_btn2_text')) ?> <span>&rarr;</span></a>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
