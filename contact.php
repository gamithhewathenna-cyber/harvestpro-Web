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

$seoTitle       = setting('contact_seo_title', '');
$seoDescription = setting('contact_seo_description', '');
$seoKeywords    = setting('contact_seo_keywords', '');
$seoNoindex     = setting('contact_seo_noindex') === '1';

$cTitle1    = setting('contact_title_1', 'Ready to Modernize');
$cTitle2    = setting('contact_title_2', 'your plantation operations?');
$cSubtitle  = setting('contact_subtitle', 'Contact our team to schedule a demonstration and learn how Harvest Pro can help improve productivity, workforce management, and operational efficiency.');
$cBannerBg  = image_url('contact_banner_image', 'assets/images/cta-bg.jpg');

$cFormTitle    = setting('contact_form_title', 'Request A Demo Today');
$cFormSubtitle = setting('contact_form_subtitle', 'Discover how Harvest Pro can help you grow smarter and manage better.');
$cFormNote     = setting('contact_form_note', '*We typically respond within one business day.');

$mapEmbed = map_embed_url(setting('contact_map', ''));

$pageTitle = $seoTitle !== '' ? $seoTitle : 'Contact Us — ' . $brandName . ' Pro';
$pageDesc  = $seoDescription !== '' ? $seoDescription : $cSubtitle;
$pageImg   = absolute_url($cBannerBg);
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
<?php seo_meta_tags('/contact', $pageTitle, $pageDesc, $pageImg, $brandName . ' Pro'); ?>
<link rel="stylesheet" href="assets/css/style.css?v=1.2">
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

<?php $activeNav = 'contact'; require __DIR__ . '/includes/site-nav.php'; ?>

<!-- ============================= PAGE BANNER ============================= -->
<header class="page-banner" style="background-image:linear-gradient(rgba(10,20,12,.55),rgba(10,20,12,.7)),url('<?= e($cBannerBg) ?>');">
  <div class="container">
    <div class="page-banner-inner">
      <h1><?= e($cTitle1) ?><br><span class="accent"><?= e($cTitle2) ?></span></h1>
      <p><?= e($cSubtitle) ?></p>
    </div>
  </div>
</header>

<!-- ============================= CONTACT ============================= -->
<section class="contact-section" id="contactForm">
  <div class="container">
    <div class="contact-grid">
      <div class="contact-info">
        <span class="pill pill-dark"><span class="pill-arrow">&rarr;</span> Get In Touch</span>

        <div>
          <h3>Contact Information</h3>
          <ul class="contact-list" style="margin-top:20px;">
            <li>
              <span class="contact-icon"><svg viewBox="0 0 20 20" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="2" width="8" height="16" rx="2"/><line x1="8.5" y1="15" x2="11.5" y2="15"/></svg></span>
              <span><?= e(setting('footer_phone')) ?></span>
            </li>
            <li>
              <span class="contact-icon"><svg viewBox="0 0 20 20" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4.5" width="16" height="11" rx="1.5"/><polyline points="2.5,5.5 10,11.5 17.5,5.5"/></svg></span>
              <span><?= e(setting('footer_email')) ?></span>
            </li>
            <li>
              <span class="contact-icon"><svg viewBox="0 0 20 20" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="10" r="6"/><circle cx="10" cy="10" r="1.6" fill="currentColor" stroke="none"/><line x1="10" y1="1.5" x2="10" y2="3.8"/><line x1="10" y1="16.2" x2="10" y2="18.5"/><line x1="1.5" y1="10" x2="3.8" y2="10"/><line x1="16.2" y1="10" x2="18.5" y2="10"/></svg></span>
              <span><?= nl2br_e(setting('footer_address')) ?></span>
            </li>
          </ul>
        </div>

        <div class="contact-follow">
          <h4>Follow Our Journey</h4>
          <div class="contact-socials">
            <a href="<?= e(setting('footer_facebook')) ?>" class="social" aria-label="Facebook"><svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M13 22v-9h3l.5-3.5H13V7.5c0-1 .3-1.7 1.8-1.7H16.6V2.6C16.3 2.6 15.2 2.5 14 2.5c-2.6 0-4.3 1.6-4.3 4.5v2.5H7v3.5h2.7V22H13Z"/></svg></a>
            <a href="<?= e(setting('footer_youtube')) ?>" class="social" aria-label="YouTube"><svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M23 12s0-3.3-.4-4.9a2.5 2.5 0 0 0-1.8-1.8C19.2 5 12 5 12 5s-7.2 0-8.8.4A2.5 2.5 0 0 0 1.4 7.2C1 8.7 1 12 1 12s0 3.3.4 4.9a2.5 2.5 0 0 0 1.8 1.8C4.8 19 12 19 12 19s7.2 0 8.8-.4a2.5 2.5 0 0 0 1.8-1.8C23 15.3 23 12 23 12ZM9.8 15.3V8.7l5.7 3.3-5.7 3.3Z"/></svg></a>
            <a href="<?= e(setting('footer_linkedin')) ?>" class="social" aria-label="LinkedIn"><svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M6.9 8.5H3.6V21h3.3V8.5ZM5.3 3.2A1.9 1.9 0 1 0 5.3 7a1.9 1.9 0 0 0 0-3.8ZM21 21v-6.9c0-3.7-2-5.4-4.6-5.4a4 4 0 0 0-3.6 2h-.1V8.5H9.4V21h3.3v-6.2c0-1.6.3-3.2 2.3-3.2s2 1.9 2 3.3V21H21Z"/></svg></a>
            <a href="<?= e(setting('footer_instagram')) ?>" class="social" aria-label="Instagram"><svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.8.9 1.4.1.4.3 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.8.7-1.4.9-.4.1-1 .3-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.8-.9-1.4-.1-.4-.3-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.8-.7 1.4-.9.4-.1 1-.3 2.2-.4C8.4 2.2 8.8 2.2 12 2.2Zm0 3.2A6.6 6.6 0 1 0 18.6 12 6.6 6.6 0 0 0 12 5.4Zm0 10.9A4.3 4.3 0 1 1 16.3 12 4.3 4.3 0 0 1 12 16.3Zm6.8-11.2a1.5 1.5 0 1 1-1.5-1.5 1.5 1.5 0 0 1 1.5 1.5Z"/></svg></a>
          </div>
        </div>
      </div>

      <div class="contact-form-col">
        <div class="contact-form-inner">
          <h2><?= e($cFormTitle) ?></h2>
          <p class="demo-lead"><?= e($cFormSubtitle) ?></p>

          <?php if (isset($_GET['sent']) && $_GET['sent'] == '1'): ?>
            <div class="alert alert-success">Thank you! Your request has been received. We'll be in touch soon.</div>
          <?php elseif (isset($_GET['sent']) && $_GET['sent'] == '0'): ?>
            <div class="alert alert-error">Something went wrong. Please try again or email us directly.</div>
          <?php endif; ?>

          <form action="submit.php" method="post" class="demo-form">
            <input type="hidden" name="redirect" value="/contact">
            <div class="form-row">
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required>
              </div>
              <div class="form-group">
                <label>Company / Estate Name</label>
                <input type="text" name="company">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required>
              </div>
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone">
              </div>
            </div>
            <div class="form-group">
              <label>Number of Estates</label>
              <select name="estates">
                <option value="">Select</option>
                <option>1 Estate</option>
                <option>2 - 5 Estates</option>
                <option>6 - 10 Estates</option>
                <option>10+ Estates</option>
              </select>
            </div>
            <div class="form-group">
              <label>Message</label>
              <textarea name="message" rows="6" placeholder="Tell us about your plantation and what you're hoping to achieve with Harvest Pro..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Request <span>&rarr;</span></button>
            <p class="contact-form-note"><?= e($cFormNote) ?></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================= MAP ============================= -->
<?php if ($mapEmbed !== ''): ?>
<section class="map-section">
  <div class="container">
    <div class="map-embed">
      <iframe src="<?= e($mapEmbed) ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="<?= e($brandName) ?> location"></iframe>
    </div>
  </div>
</section>
<?php endif; ?>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
