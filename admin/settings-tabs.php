<?php
/**
 * Horizontal section tab bar shown at the top of the consolidated
 * "Settings" admin tab. Included by section.php.
 */
$settingsTabs = [
    ['key' => 'settings_logo', 'label' => 'Logo',                     'href' => 'section.php?g=settings_logo'],
    ['key' => 'theme',         'label' => 'Colour Theme',             'href' => 'section.php?g=theme'],
    ['key' => 'seo',           'label' => 'Search Engine Visibility', 'href' => 'section.php?g=seo'],
];
?>
<nav class="a-hometabs">
  <?php foreach ($settingsTabs as $t): ?>
    <a href="<?= e($t['href']) ?>" class="<?= $page === $t['key'] ? 'active' : '' ?>"><?= e($t['label']) ?></a>
  <?php endforeach; ?>
</nav>
