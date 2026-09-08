<?php
require_once __DIR__ . '/auth.php';
require_login();
require_once __DIR__ . '/fields.php';

$groups = field_groups();

/* One card per public page — all SEO fields live on this single tab
   instead of being split across each page's own section tabs. Each card
   is its own <form>, so each has its own Save button and only saves its
   own page's fields. */
$seoSections = [
    'home_seo'     => 'Home',
    'about_seo'    => 'About Us',
    'features_seo' => 'Features',
    'contact_seo'  => 'Contact',
];

$saved  = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $errors[] = 'Security token mismatch. Please retry.';
    } else {
        $gk = $_POST['seo_group'] ?? '';
        if (isset($seoSections[$gk])) {
            foreach ($groups[$gk]['fields'] as $key => [$flabel, $type]) {
                save_field($pdo, $key, $type);
            }
            $saved = $gk;
        } else {
            $errors[] = 'Unknown section.';
        }
    }
}

$pageTitle = 'SEO';
$page = 'seo';

// Re-query fresh values (bypass static cache)
$fresh = [];
$rows = $pdo->query("SELECT setting_key, setting_value FROM settings")->fetchAll();
foreach ($rows as $r) { $fresh[$r['setting_key']] = $r['setting_value']; }

require __DIR__ . '/header.php';
?>

<?php foreach ($errors as $er): ?><div class="a-alert a-alert-error"><?= e($er) ?></div><?php endforeach; ?>

<?php foreach ($seoSections as $gk => $label): $group = $groups[$gk]; ?>
  <form method="post" class="a-card">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="seo_group" value="<?= e($gk) ?>">

    <h2 class="a-card-title"><?= e($label) ?></h2>
    <?php if ($saved === $gk): ?><div class="a-alert a-alert-ok">Changes saved successfully.</div><?php endif; ?>

    <?php foreach ($group['fields'] as $key => [$flabel, $type]): ?>
      <?php render_field($key, $flabel, $type, $fresh[$key] ?? ''); ?>
    <?php endforeach; ?>

    <button type="submit" class="a-btn a-btn-primary">Save Changes</button>
  </form>
<?php endforeach; ?>

<?php require __DIR__ . '/footer.php'; ?>
