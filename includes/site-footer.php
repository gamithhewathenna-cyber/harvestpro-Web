<?php
/**
 * Shared footer + closing scripts, included on every public page.
 * Expects $brandName, $brandLogoUrl already set by the caller.
 */
$footerCredits = array_filter(array_map('trim', explode("\n", setting('footer_credit'))));
$paymentLogos = get_payment_logos();
?>
<!-- ============================= FOOTER ============================= -->
<footer class="footer">
  <div class="container footer-grid">
    <div class="footer-brand">
      <?php if ($brandLogoUrl): ?>
        <img src="<?= e($brandLogoUrl) ?>" alt="<?= e($brandName) ?>" class="footer-logo" loading="lazy">
      <?php else: ?>
        <span class="brand-mark dark"><?= e($brandName) ?></span>
      <?php endif; ?>
      <p class="footer-about"><?= e(setting('footer_about')) ?></p>
    </div>

    <div class="footer-col">
      <h4><?= e(t('Link')) ?></h4>
      <ul>
        <li><a href="/"><?= e(t('Home')) ?></a></li>
        <li><a href="/about"><?= e(t('About Us')) ?></a></li>
        <li><a href="<?= e($priceLink ?? setting('price_link', '#')) ?>"><?= e(t('Pricing')) ?></a></li>
        <li><a href="/features"><?= e(t('Features')) ?></a></li>
        <li><a href="/contact"><?= e(t('Contact Us')) ?></a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4><?= e(t('Contact')) ?></h4>
      <p><?= e(setting('footer_company')) ?><br><?= nl2br_e(setting('footer_address')) ?></p>
      <p class="footer-phone"><?= e(setting('footer_phone')) ?></p>
      <p><a href="mailto:<?= e(setting('footer_email')) ?>"><?= e(setting('footer_email')) ?></a></p>
      <div class="socials">
        <a href="<?= e(setting('footer_facebook')) ?>" class="social" aria-label="Facebook"><svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M13 22v-9h3l.5-3.5H13V7.5c0-1 .3-1.7 1.8-1.7H16.6V2.6C16.3 2.6 15.2 2.5 14 2.5c-2.6 0-4.3 1.6-4.3 4.5v2.5H7v3.5h2.7V22H13Z"/></svg></a>
        <a href="<?= e(setting('footer_instagram')) ?>" class="social" aria-label="Instagram"><svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.8.9 1.4.1.4.3 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.8.7-1.4.9-.4.1-1 .3-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.8-.9-1.4-.1-.4-.3-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.8-.7 1.4-.9.4-.1 1-.3 2.2-.4C8.4 2.2 8.8 2.2 12 2.2Zm0 3.2A6.6 6.6 0 1 0 18.6 12 6.6 6.6 0 0 0 12 5.4Zm0 10.9A4.3 4.3 0 1 1 16.3 12 4.3 4.3 0 0 1 12 16.3Zm6.8-11.2a1.5 1.5 0 1 1-1.5-1.5 1.5 1.5 0 0 1 1.5 1.5Z"/></svg></a>
      </div>
    </div>

    <div class="footer-col footer-social-col">
      <?php if ($paymentLogos): ?>
        <div class="footer-payment">
          <h4><?= e(t('Safe & Secure Payments')) ?></h4>
          <p><?= e(t('Secure payments through trusted payment providers.')) ?></p>
          <div class="footer-payment-logos">
            <?php foreach ($paymentLogos as $logo):
                $logoImg = resolve_image_url($logo['image']);
                $logoAlt = $logo['alt_text'] ?: '';
                $logoLink = $logo['link'] ?? '';
            ?>
              <?php if ($logoLink !== ''): ?>
                <a href="<?= e($logoLink) ?>" target="_blank" rel="noopener"><img src="<?= e($logoImg) ?>" alt="<?= e($logoAlt) ?>" class="footer-payment-logo" loading="lazy"></a>
              <?php else: ?>
                <img src="<?= e($logoImg) ?>" alt="<?= e($logoAlt) ?>" class="footer-payment-logo" loading="lazy">
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container footer-bottom-inner">
      <span><?= e(setting('footer_copyright')) ?> &middot; <a href="/terms-and-conditions" class="footer-legal">Terms &amp; Conditions</a> &middot; <a href="/privacy-policy" class="footer-legal">Privacy Policy</a> &middot; <a href="/refund-policy" class="footer-legal">Refund &amp; Cancellation Policy</a></span>
      <span class="footer-credit">
        <?php foreach ($footerCredits as $c): ?><span><?= e($c) ?></span><?php endforeach; ?>
      </span>
    </div>
  </div>
</footer>

<?php
$whatsappNumber = preg_replace('/[^0-9]/', '', setting('whatsapp_number', ''));
if (setting('whatsapp_enabled') === '1' && $whatsappNumber !== ''):
    $whatsappMessage = setting('whatsapp_message', '');
    $whatsappUrl = 'https://wa.me/' . $whatsappNumber . ($whatsappMessage !== '' ? '?text=' . rawurlencode($whatsappMessage) : '');
?>
<a href="<?= e($whatsappUrl) ?>" class="whatsapp-fab" target="_blank" rel="noopener" aria-label="WhatsApp">
  <span class="whatsapp-fab-icon"><svg viewBox="0 0 32 32" width="22" height="22" fill="#fff"><path d="M16.02 3C9.4 3 4 8.4 4 15.02c0 2.35.65 4.55 1.78 6.43L4 29l7.73-1.75a11.96 11.96 0 0 0 4.29.79h.01c6.62 0 12.02-5.4 12.02-12.02C28.05 8.4 22.65 3 16.02 3Zm0 21.9h-.01a9.9 9.9 0 0 1-5.04-1.38l-.36-.21-4.59 1.04 1.06-4.47-.24-.37a9.85 9.85 0 0 1-1.52-5.29c0-5.46 4.44-9.9 9.9-9.9 5.45 0 9.89 4.44 9.89 9.9 0 5.46-4.44 9.68-9.09 9.68Zm5.42-7.4c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.25-.46-2.38-1.47-.88-.78-1.47-1.75-1.65-2.05-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.6-.91-2.2-.24-.57-.49-.5-.67-.5-.17 0-.37-.02-.57-.02-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48 0 1.46 1.07 2.87 1.22 3.07.15.2 2.1 3.2 5.08 4.49.71.31 1.26.49 1.69.62.71.23 1.36.2 1.87.12.57-.08 1.76-.72 2.01-1.42.25-.7.25-1.29.17-1.42-.07-.12-.27-.2-.57-.35Z"/></svg></span>
  <span class="whatsapp-fab-text"><?= e(setting('whatsapp_button_text', "Let's Talk")) ?></span>
</a>
<?php endif; ?>

<script src="assets/js/main.js?v=1.4"></script>
</body>
</html>
