<?php
/**
 * Shared footer + closing scripts, included on every public page.
 * Expects $brandName, $brandLogoUrl already set by the caller.
 */
$footerCredits = array_filter(array_map('trim', explode("\n", setting('footer_credit'))));
?>
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
        <li><a href="/#home">Home</a></li>
        <li><a href="/about">About Us</a></li>
        <li><a href="/features">Features</a></li>
        <li><a href="/contact">Contact Us</a></li>
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
