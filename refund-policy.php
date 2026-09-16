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

$pageTitle = 'Refund & Cancellation Policy — ' . $brandName . ' Pro';
$pageDesc  = 'How subscription payments, the 14-day free trial, cancellations, and refund requests work at Harvest Pro.';
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
<?php seo_meta_tags('/refund-policy', $pageTitle, $pageDesc, $pageImg, $brandName . ' Pro'); ?>
<link rel="stylesheet" href="assets/css/style.css?v=2.0">
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
      <h1>Refund &amp; <span class="accent">Cancellation Policy</span></h1>
      <p>How subscription payments, the free trial, cancellations, and refund requests work.</p>
    </div>
  </div>
</header>

<!-- ============================= POLICY CONTENT ============================= -->
<section class="policy section">
  <div class="container policy-content">
    <p class="policy-updated">Last Updated: 10 September 2026</p>

    <p>This Refund &amp; Cancellation Policy applies to subscriptions and services purchased from Harvest Pro (Pvt) Ltd. As Harvest Pro is a digital software service, physical product returns do not apply. A 14-day free trial may be offered on first online signup; the trial itself is not a paid purchase.</p>

    <h2>1. Subscription Payments</h2>
    <p>Harvest Pro subscription fees are charged according to the subscription plan and billing period selected or agreed upon by the customer. Customers are responsible for reviewing applicable pricing, features, and billing period before completing payment.</p>

    <h2>2. Free Trial</h2>
    <p>First-time online registrations (without a prepaid coupon or access key) may receive a one-time 14-day free trial of the selected plan. There is no charge during the trial. If you stop using Harvest Pro or cancel before the trial ends, you will not be charged. The trial is available once per planter account. Prepaid coupon or complimentary accounts do not receive a trial.</p>
    <p>The first payment after a trial starts a normal paid subscription period from the payment date. Unused trial days are not added to the paid period. That first payment, and later subscription payments, are covered by the digital-service refund rules in this policy.</p>

    <h2>3. Cancellation</h2>
    <p>Customers may request cancellation of their Harvest Pro subscription by contacting us at <a href="mailto:hello@harvestpro.lk">hello@harvestpro.lk</a> or from Billing. Cancellation will prevent future subscription renewals once processed. During a free trial, you keep access until the trial ends and will not be charged if you stop before day 14. For paid subscriptions, unless otherwise agreed in writing, customers may continue using the applicable paid service until the end of the billing period for which payment has already been made.</p>

    <h2>4. Refunds</h2>
    <p>Because Harvest Pro provides access to digital software and services, subscription payments are generally non-refundable once the applicable subscription period has started. However, we may review refund requests individually in circumstances such as:</p>
    <ul>
      <li>An accidental duplicate payment</li>
      <li>An incorrect charge caused by a billing error</li>
      <li>Payment processed after a confirmed cancellation due to an error on our part</li>
      <li>A significant technical issue preventing reasonable use of the paid service that Harvest Pro is unable to resolve</li>
    </ul>
    <p>Approval of a refund is at our discretion, subject to applicable consumer protection laws and contractual obligations. Nothing in this policy limits any refund or other remedy that a customer is legally entitled to receive under applicable law.</p>

    <h2>5. Change of Mind</h2>
    <p>Refunds are generally not provided simply because a customer:</p>
    <ul>
      <li>Changes their mind after purchasing a subscription</li>
      <li>Decides not to use the platform</li>
      <li>Fails to use available features during the subscription period</li>
      <li>No longer requires the service</li>
    </ul>
    <p>We encourage customers to request a demonstration and confirm that Harvest Pro meets their operational requirements before purchasing a subscription.</p>

    <h2>6. Subscription Upgrades or Changes</h2>
    <p>Customers wishing to upgrade, downgrade, or change their subscription should contact Harvest Pro. Any applicable pricing adjustment will depend on the selected plan and current billing arrangement.</p>

    <h2>7. Account Termination for Violations</h2>
    <p>If an account is suspended or terminated because of fraud, abuse, unlawful activity, unauthorized access, or a material violation of our Terms and Conditions, payments already made may not be refundable, except where otherwise required by applicable law.</p>

    <h2>8. Refund Processing</h2>
    <p>Where a refund is approved, it will normally be returned through the original payment method where reasonably possible. Processing times may vary depending on the payment provider, bank, or financial institution.</p>

    <h2>9. Data Following Cancellation</h2>
    <p>Customers should export or retain copies of important business records before account access ends. Following cancellation or termination, customer information may be retained for a limited period for backup, security, legal, or administrative purposes before deletion according to our data-retention procedures.</p>

    <h2>10. Contact Us</h2>
    <p>For subscription cancellations, billing issues, or refund requests, contact Harvest Pro using the details below. When contacting us about a payment, please include your account or company name and relevant payment details so we can review the request.</p>

    <div class="policy-contact-card">
      <strong>Harvest Pro (Pvt) Ltd</strong>
      <p>27/1, 1st Lane, Boralesgamuwa, Sri Lanka</p>
      <p>Email: <a href="mailto:hello@harvestpro.lk">hello@harvestpro.lk</a></p>
      <p>Phone: <a href="tel:+94777130597">077 713 0597</a></p>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
