<?php
require_once __DIR__ . '/auth.php';
require_login();
require_once __DIR__ . '/fields.php';

$groups = field_groups();
$group  = $groups['price'];
$fields = $group['fields'];
$saved  = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $errors[] = 'Security token mismatch. Please retry.';
    } else {
        foreach ($fields as $key => [$label, $type]) {
            save_field($pdo, $key, $type);
        }
        $saved = true;
    }
}

$pageTitle = $group['title'];
$page = 'price';

// Re-query fresh values (bypass static cache)
$fresh = [];
$rows = $pdo->query("SELECT setting_key, setting_value FROM settings")->fetchAll();
foreach ($rows as $r) { $fresh[$r['setting_key']] = $r['setting_value']; }

require __DIR__ . '/header.php';
?>

<?php if ($saved): ?><div class="a-alert a-alert-ok">Changes saved successfully.</div><?php endif; ?>
<?php foreach ($errors as $er): ?><div class="a-alert a-alert-error"><?= e($er) ?></div><?php endforeach; ?>

<form method="post" class="a-card">
  <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">

  <?php foreach ($fields as $key => [$label, $type]): ?>
    <?php render_field($key, $label, $type, $fresh[$key] ?? ''); ?>
  <?php endforeach; ?>
  <p class="a-help" style="margin-top:-10px;margin-bottom:18px;">This controls where the "Price" button in the main navigation goes — paste a site-relative path (e.g. <code>/pricing</code>) or a full external URL.</p>

  <button type="submit" class="a-btn a-btn-primary">Save Changes</button>
</form>

<?php require __DIR__ . '/footer.php'; ?>
