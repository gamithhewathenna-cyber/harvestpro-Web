<?php
/**
 * Horizontal section tab bar shown at the top of the consolidated
 * "Home Page" admin tab. Included by section.php and features.php.
 */
$homepageTabs = [
    ['key' => 'branding',      'label' => 'Branding',         'href' => 'section.php?g=branding'],
    ['key' => 'hero_slides',   'label' => 'Hero Slider',      'href' => 'hero-slides.php'],
    ['key' => 'ticker',        'label' => 'Ticker Strip',     'href' => 'section.php?g=ticker'],
    ['key' => 'why',           'label' => 'Why Section',      'href' => 'section.php?g=why'],
    ['key' => 'features_head', 'label' => 'Features Heading', 'href' => 'section.php?g=features'],
    ['key' => 'features',      'label' => 'Feature Cards',    'href' => 'features.php'],
    ['key' => 'how',           'label' => 'How It Helps',     'href' => 'section.php?g=how'],
    ['key' => 'cta',           'label' => 'Call To Action',   'href' => 'section.php?g=cta'],
    ['key' => 'footer',        'label' => 'Footer',           'href' => 'section.php?g=footer'],
];
?>
<nav class="a-hometabs">
  <?php foreach ($homepageTabs as $t): ?>
    <a href="<?= e($t['href']) ?>" class="<?= $page === $t['key'] ? 'active' : '' ?>"><?= e($t['label']) ?></a>
  <?php endforeach; ?>
</nav>
