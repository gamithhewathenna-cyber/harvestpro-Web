<?php
/**
 * Shared sticky navbar, included on every public page.
 * Expects $brandName, $brandLogoUrl, $brandLogoNavUrl and $activeNav
 * ('home' | 'about' | 'features' | 'contact' | '') to already be set by the caller.
 */
$activeNav = $activeNav ?? '';
?>
<div class="nav-fixed" id="navFixed">
  <nav class="navbar">
    <a href="index.php#home" class="brand">
      <?php if ($brandLogoNavUrl): ?>
        <img src="<?= e($brandLogoNavUrl) ?>" alt="<?= e($brandName) ?>" class="brand-img brand-img-top">
      <?php else: ?>
        <span class="brand-mark brand-img-top"><?= e($brandName) ?></span>
      <?php endif; ?>
      <?php if ($brandLogoUrl): ?>
        <img src="<?= e($brandLogoUrl) ?>" alt="<?= e($brandName) ?>" class="brand-img brand-img-scrolled">
      <?php else: ?>
        <span class="brand-mark dark brand-img-scrolled"><?= e($brandName) ?></span>
      <?php endif; ?>
    </a>

    <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
      <span></span><span></span><span></span>
    </button>

    <ul class="nav-links" id="navLinks">
      <li><a href="index.php#home" class="<?= $activeNav === 'home' ? 'active' : '' ?>">Home</a></li>
      <li><a href="about.php" class="<?= $activeNav === 'about' ? 'active' : '' ?>">About Us</a></li>
      <li><a href="features.php" class="<?= $activeNav === 'features' ? 'active' : '' ?>">Features</a></li>
      <li><a href="contact.php" class="<?= $activeNav === 'contact' ? 'active' : '' ?>">Contact Us</a></li>
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
</div>
