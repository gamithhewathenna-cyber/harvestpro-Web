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

$pageTitle = 'Privacy Policy — ' . $brandName . ' Pro';
$pageDesc  = 'How Harvest Pro collects, uses, stores, and protects account, plantation, and technical information.';
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
<?php seo_meta_tags('/privacy-policy', $pageTitle, $pageDesc, $pageImg, $brandName . ' Pro'); ?>
<?php sinhala_font_tags(); ?>
<link rel="stylesheet" href="assets/css/style.css?v=3.6">
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
      <h1>Privacy <span class="accent">Policy</span></h1>
      <p>How we collect, use, store, and protect the information you share with Harvest Pro.</p>
    </div>
  </div>
</header>

<!-- ============================= POLICY CONTENT ============================= -->
<section class="policy section">
  <div class="container policy-content">
    <p class="policy-updated">Last Updated: 8 September 2026</p>

    <p>Harvest Pro (Pvt) Ltd ("Harvest Pro", "we", "our", or "us") respects your privacy and is committed to protecting the personal and business information you provide when using our website, software platform, and related services. This Privacy Policy explains how we collect, use, store, and protect information.</p>

    <h2>1. Information We Collect</h2>

    <h3>Account Information</h3>
    <ul>
      <li>Name</li>
      <li>Email address</li>
      <li>Telephone number</li>
      <li>Company or estate name</li>
      <li>Account login information</li>
      <li>User role and account permissions</li>
    </ul>

    <h3>Plantation and Operational Information</h3>
    <ul>
      <li>Estate and division information</li>
      <li>Worker and employee records</li>
      <li>Attendance records</li>
      <li>Work assignments</li>
      <li>Production and harvesting records</li>
      <li>Payroll-related information</li>
      <li>Expenses and operational costs</li>
      <li>Fertilizer and field activity records</li>
      <li>Performance and management reports</li>
    </ul>
    <p>Where worker or employee information is entered by an estate, plantation, company, administrator, or authorized user, that organization is responsible for ensuring it has appropriate authority to collect and process such information.</p>

    <h3>Technical Information</h3>
    <ul>
      <li>IP address</li>
      <li>Browser and device information</li>
      <li>Login activity</li>
      <li>Usage information</li>
      <li>Error and system logs</li>
      <li>Date and time of access</li>
    </ul>

    <h2>2. How We Use Information</h2>
    <ul>
      <li>Create and manage user accounts</li>
      <li>Provide Harvest Pro services and features</li>
      <li>Process and maintain plantation management records</li>
      <li>Generate reports and analytics requested by users</li>
      <li>Provide customer and technical support</li>
      <li>Communicate important service information</li>
      <li>Improve platform performance and functionality</li>
      <li>Detect unauthorized access, fraud, or misuse</li>
      <li>Maintain system security</li>
      <li>Comply with applicable legal and regulatory requirements</li>
    </ul>

    <h2>3. Customer and Worker Data</h2>
    <p>Customers retain responsibility for the operational and personnel data they enter into Harvest Pro. Harvest Pro processes this information to provide the services requested by the customer. Customers are responsible for ensuring they have the necessary permissions, notices, consents, or other lawful basis required to collect and enter employee, worker, contractor, or other third-party information into the platform.</p>

    <h2>4. Data Sharing</h2>
    <p>We do not sell customer or personal information. We may share limited information with trusted third-party service providers where necessary to operate Harvest Pro, including hosting, infrastructure, email, security, backup, analytics, and technical service providers. We may also disclose information where required by applicable law, court order, regulatory authority, or other lawful request.</p>

    <h2>5. Data Security</h2>
    <p>We use reasonable administrative, technical, and organizational safeguards designed to protect information against unauthorized access, loss, misuse, alteration, or disclosure. However, no online platform, server, or electronic storage system can guarantee absolute security. Customers are responsible for protecting login credentials and limiting accounts to authorized users.</p>

    <h2>6. Data Storage and Backups</h2>
    <p>Customer information may be stored using secure cloud infrastructure and may be included in automated system backups. Backup copies may remain temporarily after information has been modified or deleted as part of normal backup and disaster-recovery procedures.</p>

    <h2>7. Data Retention</h2>
    <p>We retain information for as long as reasonably necessary to provide services, maintain accounts, meet contractual obligations, resolve disputes, maintain security and backups, and comply with applicable legal requirements. Following account termination, certain information may remain temporarily within backups or system records before being securely removed according to our retention procedures.</p>

    <h2>8. Account Access and Permissions</h2>
    <p>Customers may assign access to administrators, managers, employees, or other authorized users. The customer is responsible for determining appropriate access permissions and for actions performed through accounts under its organization.</p>

    <h2>9. Cookies and Website Technologies</h2>
    <p>Our website and platform may use cookies and similar technologies to maintain login sessions, remember preferences, improve functionality, analyze usage, and maintain security. Disabling essential cookies may affect platform functionality.</p>

    <h2>10. Your Rights</h2>
    <p>Subject to applicable law, you may request access to, correction of, or deletion of personal information held about you. Certain information may need to be retained for legal, security, contractual, accounting, or legitimate business purposes. For information maintained by an employer, estate, or plantation using Harvest Pro, requests may need to be directed to that organization.</p>

    <h2>11. Third-Party Services</h2>
    <p>Harvest Pro may use or integrate with third-party services. Their processing of information may also be governed by their respective privacy policies. Harvest Pro is not responsible for independent third-party websites or services outside our control.</p>

    <h2>12. Changes to This Privacy Policy</h2>
    <p>We may update this Privacy Policy from time to time to reflect changes to our services, technology, business operations, or legal requirements. The latest version will be published on our website with an updated "Last Updated" date.</p>

    <h2>Contact Us</h2>
    <p>If you have questions about this Privacy Policy or how Harvest Pro handles information, contact us using the details below.</p>

    <div class="policy-contact-card">
      <strong>Harvest Pro (Pvt) Ltd</strong>
      <p>27/1, 1st Lane, Boralesgamuwa, Sri Lanka</p>
      <p>Email: <a href="mailto:hello@harvestpro.lk">hello@harvestpro.lk</a></p>
      <p>Phone: <a href="tel:+94777130597">077 713 0597</a></p>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
