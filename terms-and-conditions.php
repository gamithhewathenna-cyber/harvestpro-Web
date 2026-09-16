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

$pageTitle = 'Terms and Conditions — ' . $brandName . ' Pro';
$pageDesc  = 'The terms that govern access to and use of the Harvest Pro website, software platform, and related services.';
$pageImg   = absolute_url('assets/images/hero-bg.jpg');
?>
<!DOCTYPE html>
<html lang="<?= e(current_lang()) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if ($faviconUrl !== ''): ?><link rel="icon" href="<?= e($faviconUrl) ?>"><?php endif; ?>
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDesc) ?>">
<?php seo_meta_tags('/terms-and-conditions', $pageTitle, $pageDesc, $pageImg, $brandName . ' Pro'); ?>
<?php sinhala_font_tags(); ?>
<link rel="stylesheet" href="assets/css/style.css?v=2.7">
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
<header class="page-banner" style="background-image:linear-gradient(rgba(10,20,12,.55),rgba(10,20,12,.7)),url('<?= e(image_url('cta_bg_image', 'assets/images/cta-bg.jpg')) ?>');">
  <div class="container">
    <div class="page-banner-inner">
      <h1>Terms and <span class="accent">Conditions</span></h1>
      <p>The terms that govern access to and use of Harvest Pro.</p>
    </div>
  </div>
</header>

<!-- ============================= POLICY CONTENT ============================= -->
<section class="policy section">
  <div class="container policy-content">
    <p class="policy-updated">Last Updated: 10 September 2026</p>

    <p>These Terms and Conditions ("Terms") govern access to and use of the Harvest Pro website, software platform, and related services operated by Harvest Pro (Pvt) Ltd. By registering for, accessing, purchasing, or using Harvest Pro, you agree to these Terms.</p>

    <h2>1. About Harvest Pro</h2>
    <p>Harvest Pro is a plantation management platform designed to assist estates and plantation businesses with operational activities including workforce management, assignments, production tracking, payroll management, field activities, expenses, reporting, analytics, and multi-estate management.</p>

    <h2>2. Account Registration</h2>
    <p>Users may be required to create an account to access Harvest Pro. You agree to provide accurate information, keep account information up to date, maintain the confidentiality of login credentials, restrict access to authorized persons, and notify us of unauthorized account access. You are responsible for activities performed through accounts under your control.</p>

    <h2>3. Authorized Users</h2>
    <p>Organizations may provide platform access to owners, administrators, managers, employees, or other authorized personnel. The subscribing organization is responsible for managing these users and their permissions.</p>

    <h2>4. Customer Data</h2>
    <p>Customers retain ownership of the business and operational data they enter into Harvest Pro. By entering information into the platform, customers authorize Harvest Pro to store, process, back up, and otherwise use that information as necessary to provide the service. Customers are responsible for ensuring that information entered into Harvest Pro has been collected lawfully.</p>

    <h2>5. Acceptable Use</h2>
    <p>You agree not to:</p>
    <ul>
      <li>Attempt to gain unauthorized access to Harvest Pro</li>
      <li>Access another customer's information without authorization</li>
      <li>Introduce malware or harmful software</li>
      <li>Interfere with platform security or availability</li>
      <li>Reverse engineer or improperly copy the platform</li>
      <li>Use Harvest Pro for fraudulent or unlawful activities</li>
      <li>Share accounts with unauthorized parties</li>
      <li>Circumvent subscription, security, or usage restrictions</li>
    </ul>
    <p>We reserve the right to restrict or suspend access where misuse or security risks are identified.</p>

    <h2>6. Subscription and Fees</h2>
    <p>Certain Harvest Pro services may require a paid subscription. First-time online signups may receive a one-time 14-day free trial of the selected plan with no charge until they subscribe. If they stop before the trial ends, no payment is due. The first payment starts a paid billing period from the payment date and is covered by the Refund &amp; Cancellation Policy. Pricing, billing periods, included features, user limits, estate limits, and other subscription conditions will be communicated when purchasing or subscribing to the service. Customers are responsible for paying applicable fees according to the agreed billing schedule.</p>

    <h2>7. Changes to Plans and Pricing</h2>
    <p>Harvest Pro may introduce, modify, or discontinue subscription plans, features, or pricing. Where changes affect an existing paid subscription, we will make reasonable efforts to communicate material changes before they apply to the customer's next applicable billing period.</p>

    <h2>8. Payroll and Financial Calculations</h2>
    <p>Harvest Pro may provide payroll, expense, production, and other operational calculations based on information entered by users. Customers are responsible for reviewing and verifying calculations before using them for salary payments, accounting, taxation, statutory reporting, financial decisions, or other official purposes. Harvest Pro is not a substitute for professional accounting, payroll, tax, legal, or financial advice.</p>

    <h2>9. Service Availability</h2>
    <p>We aim to provide reliable access to Harvest Pro but do not guarantee uninterrupted or error-free operation. Access may occasionally be affected by maintenance, software updates, hosting or infrastructure issues, internet or telecommunications failures, security incidents, third-party service interruptions, or events beyond our reasonable control.</p>

    <h2>10. Backups</h2>
    <p>We may maintain backups as part of normal infrastructure and disaster-recovery processes. Customers should maintain appropriate independent copies of critical business records where necessary.</p>

    <h2>11. Intellectual Property</h2>
    <p>Harvest Pro, including its software, design, interface, branding, code, features, documentation, graphics, and other proprietary materials, is owned by or licensed to Harvest Pro (Pvt) Ltd. Using Harvest Pro does not transfer ownership of our intellectual property to the customer. Customers may not reproduce, resell, distribute, modify, reverse engineer, or commercially exploit Harvest Pro without written authorization.</p>

    <h2>12. Suspension and Termination</h2>
    <p>We may suspend or terminate access where subscription payments remain overdue, these Terms are materially violated, the platform is misused, unauthorized or fraudulent activity is detected, continued access creates a security risk, or we are required to do so by law. Customers may discontinue use subject to their applicable subscription arrangement.</p>

    <h2>13. Limitation of Liability</h2>
    <p>To the extent permitted by applicable law, Harvest Pro (Pvt) Ltd will not be responsible for indirect, incidental, special, or consequential losses resulting from use or inability to use the platform. Customers remain responsible for business decisions made using information, calculations, reports, or analytics generated through Harvest Pro. Nothing in these Terms excludes liability that cannot lawfully be excluded.</p>

    <h2>14. Third-Party Services</h2>
    <p>Harvest Pro may depend on third-party hosting, infrastructure, communications, payment, analytics, or other technology providers. We are not responsible for interruptions or failures caused solely by third-party services outside our reasonable control.</p>

    <h2>15. Changes to the Platform</h2>
    <p>We may improve, update, replace, add, or remove features to maintain and develop Harvest Pro. We will make reasonable efforts to avoid materially disrupting active customers when significant changes are introduced.</p>

    <h2>16. Changes to These Terms</h2>
    <p>We may update these Terms when our services, business practices, or legal obligations change. Updated Terms will be published on our website with the revised "Last Updated" date. Continued use after applicable changes may constitute acceptance of the updated Terms.</p>

    <h2>17. Governing Law</h2>
    <p>These Terms are governed by the laws of the Democratic Socialist Republic of Sri Lanka. Any disputes relating to these Terms or use of Harvest Pro will be subject to the applicable laws and jurisdiction of Sri Lanka.</p>

    <h2>18. Contact</h2>
    <p>For questions about these Terms, contact Harvest Pro using the details below.</p>

    <div class="policy-contact-card">
      <strong>Harvest Pro (Pvt) Ltd</strong>
      <p>27/1, 1st Lane, Boralesgamuwa, Sri Lanka</p>
      <p>Email: <a href="mailto:hello@harvestpro.lk">hello@harvestpro.lk</a></p>
      <p>Phone: <a href="tel:+94777130597">077 713 0597</a></p>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
