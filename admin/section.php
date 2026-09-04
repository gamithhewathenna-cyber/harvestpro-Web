<?php
require_once __DIR__ . '/auth.php';
require_login();
require_once __DIR__ . '/fields.php';

$groups = field_groups();
$g = $_GET['g'] ?? 'hero';
if (!isset($groups[$g])) {
    header('Location: index.php');
    exit;
}
$group  = $groups[$g];
$fields = $group['fields'];
$saved  = false;
$errors = [];

/* map group -> sidebar highlight key */
$pageMap = [
  'branding' => 'branding', 'hero' => 'hero', 'ticker' => 'ticker',
  'why' => 'why', 'features' => 'features_head', 'how' => 'how',
  'cta' => 'cta', 'maintenance' => 'maintenance', 'footer' => 'footer',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $errors[] = 'Security token mismatch. Please retry.';
    } else {
        foreach ($fields as $key => [$label, $type]) {
            if ($type === 'image') {
                // File upload
                $uploaded = handle_upload($key);
                if ($uploaded !== null) {
                    save_setting($pdo, $key, $uploaded);
                } elseif (!empty($_POST['remove_' . $key])) {
                    save_setting($pdo, $key, '');
                }
                // else: keep existing value
            } else {
                $val = $_POST[$key] ?? '';
                // Normalise CR/LF for textareas/lists
                $val = str_replace("\r\n", "\n", $val);
                save_setting($pdo, $key, trim($val));
            }
        }
        $saved = true;
    }
}

// Refresh cached settings after save
$pageTitle = $group['title'];
$page = $pageMap[$g] ?? '';

// Re-query fresh values (bypass static cache)
$fresh = [];
$rows = $pdo->query("SELECT setting_key, setting_value FROM settings")->fetchAll();
foreach ($rows as $r) { $fresh[$r['setting_key']] = $r['setting_value']; }

require __DIR__ . '/header.php';
?>

<?php if ($saved): ?><div class="a-alert a-alert-ok">Changes saved successfully.</div><?php endif; ?>
<?php foreach ($errors as $er): ?><div class="a-alert a-alert-error"><?= e($er) ?></div><?php endforeach; ?>

<form method="post" enctype="multipart/form-data" class="a-card">
  <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">

  <?php foreach ($fields as $key => [$label, $type]):
      $value = $fresh[$key] ?? '';
  ?>
    <div class="a-field">
      <label><?= e($label) ?></label>

      <?php if ($type === 'text'): ?>
        <input type="text" name="<?= e($key) ?>" value="<?= e($value) ?>">

      <?php elseif ($type === 'textarea' || $type === 'credit' || $type === 'checklist'): ?>
        <textarea name="<?= e($key) ?>" rows="<?= $type==='textarea'?3:4 ?>"><?= e($value) ?></textarea>
        <?php if ($type === 'checklist'): ?>
          <small class="a-help">One item per line. Text before the <code>|</code> shows in bold. Example: <code>Centralized|plantation management</code></small>
        <?php elseif ($type === 'credit'): ?>
          <small class="a-help">One credit line per line.</small>
        <?php endif; ?>

      <?php elseif ($type === 'list'): ?>
        <input type="text" name="<?= e($key) ?>" value="<?= e($value) ?>">
        <small class="a-help">Separate each item with a vertical bar <code>|</code></small>

      <?php elseif ($type === 'checkbox'): ?>
        <label class="a-check">
          <input type="checkbox" name="<?= e($key) ?>" value="1" <?= $value === '1' ? 'checked' : '' ?>>
          Enabled
        </label>

      <?php elseif ($type === 'image'): ?>
        <div class="a-image-field">
          <?php if ($value !== ''):
              $thumbUrl = preg_match('#^https?://#i', $value) ? $value : (UPLOAD_URL . ltrim($value, '/'));
          ?>
            <div class="a-thumb">
              <img src="<?= e($thumbUrl) ?>" alt="">
              <label class="a-remove"><input type="checkbox" name="remove_<?= e($key) ?>" value="1"> Remove</label>
            </div>
          <?php else: ?>
            <span class="a-noimg">No image uploaded yet.</span>
          <?php endif; ?>
          <input type="file" name="<?= e($key) ?>" accept="image/*">
          <small class="a-help">JPG, PNG, WEBP, GIF or SVG. Max 8 MB. Leave empty to keep the current image.</small>
        </div>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>

  <button type="submit" class="a-btn a-btn-primary">Save Changes</button>
</form>

<?php require __DIR__ . '/footer.php'; ?>
