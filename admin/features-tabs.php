<?php
/**
 * Horizontal section tab bar shown at the top of the consolidated
 * "Features Page" admin tab. Included by section.php and feature-sections.php.
 */
$featuresPageTabs = [
    ['key' => 'features_banner',  'label' => 'Page Banner',       'href' => 'section.php?g=features_banner'],
    ['key' => 'feature_sections', 'label' => 'Feature Sections',  'href' => 'feature-sections.php'],
    ['key' => 'features_seo',     'label' => 'SEO',               'href' => 'section.php?g=features_seo'],
];
?>
<nav class="a-hometabs">
  <?php foreach ($featuresPageTabs as $t): ?>
    <a href="<?= e($t['href']) ?>" class="<?= $page === $t['key'] ? 'active' : '' ?>"><?= e($t['label']) ?></a>
  <?php endforeach; ?>
</nav>
