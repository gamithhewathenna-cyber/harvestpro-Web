<?php
/**
 * Full-screen preloader shown while the page loads, included right after
 * <body>. Expects $brandName to already be set by the caller. JS (main.js)
 * fades it out on window 'load'; if JS never runs, the <noscript> block
 * below hides it immediately so the site is never stuck behind it.
 */
?>
<div class="preloader" id="preloader" aria-hidden="true">
  <span class="preloader-layer preloader-layer-1"></span>
  <span class="preloader-layer preloader-layer-2"></span>
  <span class="preloader-layer preloader-layer-3"></span>
  <div class="preloader-inner">
    <span class="preloader-mark"><?= e($brandName ?? 'Harvest') ?></span>
    <div class="preloader-bar"><span></span></div>
  </div>
</div>
<noscript><style>.preloader{display:none!important}body{overflow:auto!important}</style></noscript>
