<?php
/**
 * Horizontal section tab bar shown at the top of the "How It Works" admin
 * page — one tab per fixed step, matching the tab bar shown on every other
 * multi-section admin page (Home/About/Features/Contact). Included by
 * how-it-works.php, which sets $currentStep before requiring this file.
 */
$howItWorksTabs = [];
foreach (hiw_step_defs() as $stepKey => $stepDef) {
    $howItWorksTabs[] = [
        'key'   => $stepKey,
        'label' => $stepDef['title'],
        'href'  => 'how-it-works.php?step=' . urlencode($stepKey),
    ];
}
?>
<nav class="a-hometabs">
  <?php foreach ($howItWorksTabs as $t): ?>
    <a href="<?= e($t['href']) ?>" class="<?= $currentStep === $t['key'] ? 'active' : '' ?>"><?= e($t['label']) ?></a>
  <?php endforeach; ?>
</nav>
