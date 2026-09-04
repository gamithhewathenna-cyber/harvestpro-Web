<?php
/**
 * Horizontal section tab bar shown at the top of the consolidated
 * "About Page" admin tab. Included by section.php.
 */
$aboutTabs = [
    ['key' => 'about_banner',   'label' => 'Page Banner',          'href' => 'section.php?g=about_banner'],
    ['key' => 'about_story',    'label' => 'About Story',          'href' => 'section.php?g=about_story'],
    ['key' => 'about_partners', 'label' => 'Development Partners', 'href' => 'section.php?g=about_partners'],
    ['key' => 'about_why',      'label' => 'Why Choose',           'href' => 'section.php?g=about_why'],
    ['key' => 'about_cta',      'label' => 'Call To Action',       'href' => 'section.php?g=about_cta'],
];
?>
<nav class="a-hometabs">
  <?php foreach ($aboutTabs as $t): ?>
    <a href="<?= e($t['href']) ?>" class="<?= $page === $t['key'] ? 'active' : '' ?>"><?= e($t['label']) ?></a>
  <?php endforeach; ?>
</nav>
