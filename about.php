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

// Page banner
$aTitle    = setting('about_title', "Built for Plantations,\nby **Industry** & Technology Experts.");
$aSubtitle = setting('about_subtitle', 'Lorem ipsum dolor sit amet consectetur. Velit nulla leo in massa tincidunt nulla elementum nunc. In gravida dictumst in magnis elit morbi.');
$aBannerBg = image_url('about_banner_image', 'assets/images/hero-bg.jpg');

// About Story
$storyBadge   = setting('about_story_badge', 'Our Story');
$storyTitle   = setting('about_story_title', 'About Harvest Pro');
$storyPara1   = setting('about_story_para_1', 'Harvest Pro was developed to address the growing operational challenges faced by plantation and tea estate managers.');
$storyPara2   = setting('about_story_para_2', 'Traditional estate management often relies on manual records, spreadsheets, and disconnected processes. Harvest Pro brings these activities together into a centralized digital platform that improves visibility, accuracy, and efficiency.');
$storyPara3   = setting('about_story_para_3', 'Our mission is to help plantations modernize their operations through technology, enabling managers to make better decisions while reducing administrative complexity.');
$visionTitle  = setting('about_vision_title', 'Our Vision');
$visionText   = setting('about_vision_text', 'To become the leading plantation management platform that empowers estates through digital transformation and data-driven decision-making.');
$missionTitle = setting('about_mission_title', 'Our Mission');
$missionText  = setting('about_mission_text', 'To simplify plantation operations by providing innovative tools that improve productivity, workforce management, and operational performance.');
$aStoryImg    = image_url('about_story_image', 'assets/images/dashboard.png');

// Development Partners
$partnersBadge = setting('about_partners_badge', 'Platform Features');
$partnersTitle = setting('about_partners_title', "Developed by Two Experts,\nUnited by One Goal");
$partner1Name  = setting('about_partner1_name', 'Creative Elements (Pvt) Ltd');
$partner1Desc  = setting('about_partner1_desc', 'Bringing expertise in user experience, business strategy, branding, and digital solutions. Creative Elements ensures Harvest Pro is intuitive, impactful, and truly aligned to user needs.');
$partner1Tags  = array_filter(array_map('trim', explode('|', setting('about_partner1_tags', 'Digital Transformation|UX & Product Strategy|Branding & Innovation'))));
$partner1Logo  = image_url('about_partner1_logo', '');
$partner2Name  = setting('about_partner2_name', 'Kode Tech (Pvt) Ltd');
$partner2Desc  = setting('about_partner2_desc', 'Specializing in software engineering, system architecture, and technology innovation. Kode Tech builds the scalable, reliable backbone that powers everything Harvest Pro does.');
$partner2Tags  = array_filter(array_map('trim', explode('|', setting('about_partner2_tags', 'Software Development|System Architecture|Cloud & Technology Solutions'))));
$partner2Logo  = image_url('about_partner2_logo', '');
$partnersFooter = setting('about_partners_footer', 'Together, we are committed to building smarter solutions that help plantations grow, operate efficiently, and embrace the future of digital estate management');

// Why Choose
$whyBadge = setting('about_why_badge', 'Why Choose');
$whyTitle = setting('about_why_title', 'Why Choose Harvest Pro');
$whyItemsDefault = "Plantation-Focused Solution|Built specifically for tea estates and plantations, helping you manage daily operations in one place.\nEasy-to-Use Interface|A simple, user-friendly system designed for owners, managers, supervisors, and estate teams.\nReal-Time Operational Insights|Track workforce, harvesting, expenses, tasks, and estate performance with up-to-date information.\nScalable for Small and Large Estates|Whether you manage a single estate or multiple plantations, Harvest Pro can grow with your operation.\nContinuous Innovation and Support|Regular improvements, new features, and ongoing support to keep your plantation management running smoothly.";
$whyItems = array_filter(array_map('trim', explode("\n", setting('about_why_items', $whyItemsDefault))));

// CTA
$aCtaKicker   = setting('about_cta_kicker', 'Harvest Pro — Grow Smarter. Manage Better.');
$aCtaTitle    = setting('about_cta_title', 'Ready to Transform Your Plantation Operations?');
$aCtaPara     = setting('about_cta_para', 'Take control of your plantation with a smarter management solution built for modern estates. Harvest Pro provides the tools, insights, and automation needed to improve productivity and streamline daily operations.');
$aCtaBtn1Text = setting('about_cta_btn1_text', 'Request a Demo');
$aCtaBtn1Link = setting('about_cta_btn1_link', '/contact');
$aCtaBtn2Text = setting('about_cta_btn2_text', 'Contact Us');
$aCtaBtn2Link = setting('about_cta_btn2_link', '/contact');
$aCtaBg       = image_url('about_cta_bg_image', 'assets/images/cta-bg.jpg');

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
        <span class="pill pill-dark"><span class="pill-arrow">&rarr;</span> <?= e($storyBadge) ?></span>
        <h2><?= e($storyTitle) ?></h2>
        <p><?= e($storyPara1) ?></p>
        <p><?= e($storyPara2) ?></p>
        <p><?= e($storyPara3) ?></p>

        <div class="about-story-boxes">
          <div class="about-story-box">
            <h4><?= e($visionTitle) ?></h4>
            <p><?= e($visionText) ?></p>
          </div>
          <div class="about-story-box">
            <h4><?= e($missionTitle) ?></h4>
            <p><?= e($missionText) ?></p>
          </div>
        </div>
      </div>

      <div class="about-story-photo" data-bg="url('<?= e($aStoryImg) ?>')"></div>
    </div>
  </div>
</section>

<!-- ============================= DEVELOPMENT PARTNERS ============================= -->
<section class="partners section">
  <div class="container">
    <div class="partners-head">
      <span class="pill"><span class="pill-arrow">&rarr;</span> <?= e($partnersBadge) ?></span>
      <h2><?= styled_heading($partnersTitle) ?></h2>
    </div>

    <div class="partners-grid">
      <div class="partner-card">
        <?php if ($partner1Logo): ?>
          <img src="<?= e($partner1Logo) ?>" alt="<?= e($partner1Name) ?>" class="partner-logo" loading="lazy">
        <?php else: ?>
          <span class="partner-logo-fallback"><?= e(initials($partner1Name)) ?></span>
        <?php endif; ?>
        <h3><?= e($partner1Name) ?></h3>
        <p><?= e($partner1Desc) ?></p>
        <div class="partner-tags">
          <?php foreach ($partner1Tags as $tag): ?><span class="partner-tag"><?= e($tag) ?></span><?php endforeach; ?>
        </div>
      </div>

      <div class="partner-card">
        <?php if ($partner2Logo): ?>
          <img src="<?= e($partner2Logo) ?>" alt="<?= e($partner2Name) ?>" class="partner-logo" loading="lazy">
        <?php else: ?>
          <span class="partner-logo-fallback"><?= e(initials($partner2Name)) ?></span>
        <?php endif; ?>
        <h3><?= e($partner2Name) ?></h3>
        <p><?= e($partner2Desc) ?></p>
        <div class="partner-tags">
          <?php foreach ($partner2Tags as $tag): ?><span class="partner-tag"><?= e($tag) ?></span><?php endforeach; ?>
        </div>
      </div>
    </div>

    <p class="partners-footer"><?= e($partnersFooter) ?></p>
  </div>
</section>

<!-- ============================= WHY CHOOSE ============================= -->
<section class="why-choose section">
  <div class="container">
    <span class="pill pill-dark"><span class="pill-arrow">&rarr;</span> <?= e($whyBadge) ?></span>
    <h2 class="why-choose-title"><?= e($whyTitle) ?></h2>

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
<section class="cta" data-bg="linear-gradient(rgba(15,30,18,.72),rgba(15,30,18,.55)),url('<?= e($aCtaBg) ?>')">
  <div class="container">
    <div class="cta-inner">
      <p class="cta-kicker"><?= e($aCtaKicker) ?></p>
      <h2 class="cta-title"><?= e($aCtaTitle) ?></h2>
      <p class="cta-para"><?= e($aCtaPara) ?></p>
      <div class="cta-btns">
        <a href="<?= e($aCtaBtn1Link) ?>" class="btn btn-primary"><?= e($aCtaBtn1Text) ?></a>
        <a href="<?= e($aCtaBtn2Link) ?>" class="btn btn-text light"><?= e($aCtaBtn2Text) ?> <span>&rarr;</span></a>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
