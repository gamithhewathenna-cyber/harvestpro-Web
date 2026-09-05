<?php
/**
 * Horizontal section tab bar shown at the top of the consolidated
 * "Contact Page" admin tab. Included by section.php.
 */
$contactTabs = [
    ['key' => 'contact_banner', 'label' => 'Page Banner',              'href' => 'section.php?g=contact_banner'],
    ['key' => 'contact_form',   'label' => 'Request Form',             'href' => 'section.php?g=contact_form'],
    ['key' => 'contact_map',    'label' => 'Map',                      'href' => 'section.php?g=contact_map'],
    ['key' => 'contact_seo',    'label' => 'SEO',                      'href' => 'section.php?g=contact_seo'],
];
?>
<nav class="a-hometabs">
  <?php foreach ($contactTabs as $t): ?>
    <a href="<?= e($t['href']) ?>" class="<?= $page === $t['key'] ? 'active' : '' ?>"><?= e($t['label']) ?></a>
  <?php endforeach; ?>
</nav>
