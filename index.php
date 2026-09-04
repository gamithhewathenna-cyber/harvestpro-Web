<?php
require_once __DIR__ . '/includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (setting('maintenance_mode') === '1' && empty($_SESSION['admin_id'])) {
    http_response_code(503);
    header('Retry-After: 3600');
    $mTitle = setting('maintenance_title', 'We\'ll be right back');
    $mMsg   = setting('maintenance_message', 'We\'re currently performing scheduled maintenance. Please check back shortly.');
    $mBrand = setting('brand_name', 'Harvest');
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($mTitle) ?> — <?= e($mBrand) ?></title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,500;9..144,600&display=swap" rel="stylesheet">
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body {
    min-height: 100vh; display: flex; align-items: center; justify-content: center;
    background: #0f3d1e; color: #fff; font-family: 'Poppins', sans-serif; text-align: center; padding: 24px;
  }
  .m-box { max-width: 480px; }
  .m-brand { font-family: 'Fraunces', serif; font-size: 22px; font-weight: 600; margin-bottom: 28px; color: #f5b418; }
  h1 { font-family: 'Fraunces', serif; font-size: 32px; font-weight: 600; margin-bottom: 14px; }
  p { font-size: 15px; line-height: 1.6; color: #d7e2da; }
</style>
</head>
<body>
  <div class="m-box">
    <div class="m-brand"><?= e($mBrand) ?> Pro</div>
    <h1><?= e($mTitle) ?></h1>
    <p><?= nl2br_e($mMsg) ?></p>
  </div>
</body>
</html>
<?php
    exit;
}

$features    = get_features();
$brandName   = setting('brand_name', 'Harvest');
$brandLogo   = setting('brand_logo', '');
$brandLogoUrl= $brandLogo ? image_url('brand_logo') : '';
$brandLogoWhite   = setting('brand_logo_white', '');
// Navbar sits on the dark hero background — prefer the white logo there, falling back to the regular logo.
$brandLogoNavUrl  = $brandLogoWhite ? image_url('brand_logo_white') : $brandLogoUrl;

$themePrimary = setting('theme_primary_color', '');
$themeAccent  = setting('theme_accent_color', '');

$seoTitle       = setting('seo_title', '');
$seoDescription = setting('seo_description', '');
$seoKeywords    = setting('seo_keywords', '');
$seoNoindex     = setting('seo_noindex') === '1';

// Ticker items
$tickerItems = array_filter(array_map('trim', explode('|', setting('ticker_items'))));

// Why checklist ("bold|rest" per line)
$whyChecklist = array_filter(array_map('trim', explode("\n", setting('why_checklist'))));

// How-it-helps tags
$howTags = array_filter(array_map('trim', explode('|', setting('how_tags'))));

// Footer credit lines
$footerCredits = array_filter(array_map('trim', explode("\n", setting('footer_credit'))));

$heroBg        = image_url('hero_bg_image', 'assets/images/hero-bg.jpg');
$heroDashboard = image_url('hero_dashboard_image', 'assets/images/dashboard.png');
$whyImg1       = image_url('why_image_1', 'assets/images/why-1.jpg');
$whyImg2       = image_url('why_image_2', 'assets/images/why-2.jpg');
$ctaBg         = image_url('cta_bg_image', 'assets/images/cta-bg.jpg');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($seoTitle !== '' ? $seoTitle : $brandName . ' Pro — Smarter Plantation Management') ?></title>
<meta name="description" content="<?= e($seoDescription !== '' ? $seoDescription : setting('hero_subtitle')) ?>">
<?php if ($seoKeywords !== ''): ?>
<meta name="keywords" content="<?= e($seoKeywords) ?>">
<?php endif; ?>
<meta name="robots" content="<?= $seoNoindex ? 'noindex, nofollow' : 'index, follow' ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&display=swap" rel="stylesheet">
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

<!-- ============================= HEADER / HERO ============================= -->
<header class="hero" id="home" style="background-image:linear-gradient(rgba(10,30,15,.35),rgba(10,30,15,.55)),url('<?= e($heroBg) ?>');">
  <nav class="navbar">
    <a href="#home" class="brand">
      <?php if ($brandLogoNavUrl): ?>
        <img src="<?= e($brandLogoNavUrl) ?>" alt="<?= e($brandName) ?>">
      <?php else: ?>
        <span class="brand-mark"><?= e($brandName) ?></span>
      <?php endif; ?>
    </a>

    <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
      <span></span><span></span><span></span>
    </button>

    <ul class="nav-links" id="navLinks">
      <li><a href="#home" class="active">Home</a></li>
      <li><a href="#">About Us</a></li>
      <li><a href="#features">Features</a></li>
      <li><a href="#contact">Contact Us</a></li>
    </ul>

    <div class="nav-actions">
      <button class="nav-icon" aria-label="Search">
        <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 1 0-.7.7l.27.28v.79l5 4.99L20.49 19l-4.99-5Zm-6 0A4.5 4.5 0 1 1 14 9.5 4.49 4.49 0 0 1 9.5 14Z"/></svg>
      </button>
      <button class="nav-icon" aria-label="Call">
        <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M6.62 10.79a15.53 15.53 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.02-.24 11.36 11.36 0 0 0 3.57.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1 11.36 11.36 0 0 0 .57 3.57 1 1 0 0 1-.25 1.02l-2.2 2.2Z"/></svg>
      </button>
    </div>
  </nav>

  <div class="hero-inner">
    <div class="hero-content">
      <h1 class="hero-title"><?= e(setting('hero_title')) ?></h1>
      <p class="hero-sub"><?= e(setting('hero_subtitle')) ?></p>
      <div class="hero-btns">
        <a href="<?= e(setting('hero_btn1_link')) ?>" class="btn btn-primary"><?= e(setting('hero_btn1_text')) ?></a>
        <a href="<?= e(setting('hero_btn2_link')) ?>" class="btn btn-text"><?= e(setting('hero_btn2_text')) ?> <span>&rarr;</span></a>
      </div>
    </div>
    <div class="hero-visual">
      <img src="<?= e($heroDashboard) ?>" alt="<?= e($brandName) ?> Pro dashboard" loading="lazy">
    </div>
  </div>
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
        <a href="#demoForm" class="btn btn-primary"><?= e(setting('cta_btn1_text')) ?></a>
        <a href="#demoForm" class="btn btn-text light"><?= e(setting('cta_btn2_text')) ?> <span>&rarr;</span></a>
      </div>
    </div>
  </div>
</section>

<!-- ============================= DEMO / CONTACT FORM ============================= -->
<section class="demo section" id="demoForm">
  <div class="container">
    <div class="demo-box">
      <h2>Request a Demo</h2>
      <p class="demo-lead">Leave your details and our team will reach out to schedule a personalised walkthrough.</p>

      <?php if (isset($_GET['sent']) && $_GET['sent'] == '1'): ?>
        <div class="alert alert-success">Thank you! Your request has been received. We'll be in touch soon.</div>
      <?php elseif (isset($_GET['sent']) && $_GET['sent'] == '0'): ?>
        <div class="alert alert-error">Something went wrong. Please try again or email us directly.</div>
      <?php endif; ?>

      <form action="submit.php" method="post" class="demo-form">
        <div class="form-row">
          <div class="form-group">
            <label>Full Name *</label>
            <input type="text" name="name" required>
          </div>
          <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" required>
          </div>
        </div>
        <div class="form-group">
          <label>Phone</label>
          <input type="text" name="phone">
        </div>
        <div class="form-group">
          <label>Message</label>
          <textarea name="message" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Request</button>
      </form>
    </div>
  </div>
</section>

<!-- ============================= FOOTER ============================= -->
<footer class="footer">
  <div class="container footer-grid">
    <div class="footer-brand">
      <?php if ($brandLogoUrl): ?>
        <img src="<?= e($brandLogoUrl) ?>" alt="<?= e($brandName) ?>" class="footer-logo">
      <?php else: ?>
        <span class="brand-mark dark"><?= e($brandName) ?></span>
      <?php endif; ?>
      <p class="footer-about"><?= e(setting('footer_about')) ?></p>
    </div>

    <div class="footer-col">
      <h4>Link</h4>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#features">Features</a></li>
        <li><a href="#contact">Contact Us</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Contact</h4>
      <p><?= e(setting('footer_company')) ?><br><?= nl2br_e(setting('footer_address')) ?></p>
      <p class="footer-phone"><?= e(setting('footer_phone')) ?></p>
      <p><a href="mailto:<?= e(setting('footer_email')) ?>"><?= e(setting('footer_email')) ?></a></p>
    </div>

    <div class="footer-col footer-social-col">
      <div class="socials">
        <a href="<?= e(setting('footer_facebook')) ?>" class="social" aria-label="Facebook"><svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M13 22v-9h3l.5-3.5H13V7.5c0-1 .3-1.7 1.8-1.7H16.6V2.6C16.3 2.6 15.2 2.5 14 2.5c-2.6 0-4.3 1.6-4.3 4.5v2.5H7v3.5h2.7V22H13Z"/></svg></a>
        <a href="<?= e(setting('footer_youtube')) ?>" class="social" aria-label="YouTube"><svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M23 12s0-3.3-.4-4.9a2.5 2.5 0 0 0-1.8-1.8C19.2 5 12 5 12 5s-7.2 0-8.8.4A2.5 2.5 0 0 0 1.4 7.2C1 8.7 1 12 1 12s0 3.3.4 4.9a2.5 2.5 0 0 0 1.8 1.8C4.8 19 12 19 12 19s7.2 0 8.8-.4a2.5 2.5 0 0 0 1.8-1.8C23 15.3 23 12 23 12ZM9.8 15.3V8.7l5.7 3.3-5.7 3.3Z"/></svg></a>
        <a href="<?= e(setting('footer_instagram')) ?>" class="social" aria-label="Instagram"><svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.8.9 1.4.1.4.3 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.8.7-1.4.9-.4.1-1 .3-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.8-.9-1.4-.1-.4-.3-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.8-.7 1.4-.9.4-.1 1-.3 2.2-.4C8.4 2.2 8.8 2.2 12 2.2Zm0 3.2A6.6 6.6 0 1 0 18.6 12 6.6 6.6 0 0 0 12 5.4Zm0 10.9A4.3 4.3 0 1 1 16.3 12 4.3 4.3 0 0 1 12 16.3Zm6.8-11.2a1.5 1.5 0 1 1-1.5-1.5 1.5 1.5 0 0 1 1.5 1.5Z"/></svg></a>
        <a href="<?= e(setting('footer_linkedin')) ?>" class="social" aria-label="LinkedIn"><svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M6.9 8.5H3.6V21h3.3V8.5ZM5.3 3.2A1.9 1.9 0 1 0 5.3 7a1.9 1.9 0 0 0 0-3.8ZM21 21v-6.9c0-3.7-2-5.4-4.6-5.4a4 4 0 0 0-3.6 2h-.1V8.5H9.4V21h3.3v-6.2c0-1.6.3-3.2 2.3-3.2s2 1.9 2 3.3V21H21Z"/></svg></a>
      </div>
      <form class="newsletter" action="submit.php" method="post">
        <input type="hidden" name="newsletter" value="1">
        <input type="email" name="email" placeholder="Email Address" required>
        <button type="submit" aria-label="Subscribe">&rarr;</button>
      </form>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container footer-bottom-inner">
      <span><?= e(setting('footer_copyright')) ?></span>
      <span class="footer-credit">
        <?php foreach ($footerCredits as $c): ?><span><?= e($c) ?></span><?php endforeach; ?>
      </span>
    </div>
  </div>
</footer>

<script src="assets/js/main.js?v=1.0"></script>
</body>
</html>
