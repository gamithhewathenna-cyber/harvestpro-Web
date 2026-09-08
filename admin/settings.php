<?php
require_once __DIR__ . '/auth.php';
require_login();
require_once __DIR__ . '/fields.php';

$groups = field_groups();

/* Every settings section lives on this one scrolling page — no sub-tabs. */
$sectionKeys = ['settings_logo', 'theme', 'seo', 'maintenance'];

$saved  = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $errors[] = 'Security token mismatch. Please retry.';
    } else {
        foreach ($sectionKeys as $gk) {
            foreach ($groups[$gk]['fields'] as $key => [$label, $type]) {
                save_field($pdo, $key, $type);
            }
        }
        $saved = true;
    }
}

$pageTitle = 'Settings';
$page = 'settings';

// Re-query fresh values (bypass static cache)
$fresh = [];
$rows = $pdo->query("SELECT setting_key, setting_value FROM settings")->fetchAll();
foreach ($rows as $r) { $fresh[$r['setting_key']] = $r['setting_value']; }

require __DIR__ . '/header.php';
?>

<?php if ($saved): ?><div class="a-alert a-alert-ok">Changes saved successfully.</div><?php endif; ?>
<?php foreach ($errors as $er): ?><div class="a-alert a-alert-error"><?= e($er) ?></div><?php endforeach; ?>

<form method="post" enctype="multipart/form-data">
  <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">

  <?php foreach ($sectionKeys as $gk): $group = $groups[$gk]; ?>
    <div class="a-card">
      <h2 class="a-card-title"><?= e($group['title']) ?></h2>
      <?php foreach ($group['fields'] as $key => [$label, $type]): ?>
        <?php render_field($key, $label, $type, $fresh[$key] ?? ''); ?>
        <?php if ($key === 'google_site_verification'): ?>
          <p class="a-help" style="margin-top:-10px;margin-bottom:18px;">From Google Search Console's HTML tag verification method, paste only the code — the value of the <code>content="..."</code> attribute, not the whole <code>&lt;meta&gt;</code> tag.</p>
        <?php endif; ?>
        <?php if ($key === 'google_analytics_id'): ?>
          <p class="a-help" style="margin-top:-10px;margin-bottom:18px;">From Google Analytics (Admin &rarr; Data Streams &rarr; your stream), paste just the Measurement ID — it looks like <code>G-XXXXXXXXXX</code>. Once set, the tracking tag loads on every page automatically, and Search Console can also verify ownership through it.</p>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>

  <button type="submit" class="a-btn a-btn-primary">Save Changes</button>
</form>

<?php require __DIR__ . '/footer.php'; ?>
