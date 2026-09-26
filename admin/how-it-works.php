<?php
require_once __DIR__ . '/auth.php';
require_login();
require_once __DIR__ . '/fields.php'; // handle_upload(), save_setting()

$defs = hiw_step_defs();
$msg  = '';
$err  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $err = 'Security token mismatch.';
    } else {
        $key = $_POST['step_key'] ?? '';
        if (!isset($defs[$key])) {
            $err = 'Unknown step.';
        } else {
            save_setting($pdo, "hiw_{$key}_title", trim($_POST['title'] ?? ''));
            save_setting($pdo, "hiw_{$key}_summary", trim($_POST['summary'] ?? ''));
            save_setting($pdo, "hiw_{$key}_teaser", trim($_POST['teaser'] ?? ''));
            save_setting($pdo, "hiw_{$key}_tip", trim($_POST['tip'] ?? ''));

            $substeps = str_replace("\r\n", "\n", trim($_POST['substeps'] ?? ''));
            save_setting($pdo, "hiw_{$key}_substeps", $substeps);

            $uploaded = handle_upload("image_{$key}");
            if ($uploaded !== null) {
                save_setting($pdo, "hiw_{$key}_image", $uploaded);
            } elseif (!empty($_POST["remove_image_{$key}"])) {
                save_setting($pdo, "hiw_{$key}_image", '');
            }
            $msg = ucfirst(str_replace('-', ' ', $key)) . ' saved.';
        }
    }
}

// Which step's tab is showing — the one just saved, or the one requested via ?step=.
$currentStep = $_POST['step_key'] ?? ($_GET['step'] ?? '');
if (!isset($defs[$currentStep])) {
    $currentStep = array_key_first($defs);
}
$def = $defs[$currentStep];

// Re-query fresh values (bypass static cache) so a just-saved field shows up to date.
$fresh = [];
$rows = $pdo->query("SELECT setting_key, setting_value FROM settings")->fetchAll();
foreach ($rows as $r) { $fresh[$r['setting_key']] = $r['setting_value']; }

$title    = $fresh["hiw_{$currentStep}_title"] ?? '';
$summary  = $fresh["hiw_{$currentStep}_summary"] ?? '';
$teaser   = $fresh["hiw_{$currentStep}_teaser"] ?? '';
$tip      = $fresh["hiw_{$currentStep}_tip"] ?? '';
$substeps = $fresh["hiw_{$currentStep}_substeps"] ?? '';
$image    = $fresh["hiw_{$currentStep}_image"] ?? '';

$pageTitle = 'How It Works';
$page = 'how_it_works';
require __DIR__ . '/header.php';
require __DIR__ . '/how-it-works-tabs.php';
?>
<?php if ($msg): ?><div class="a-alert a-alert-ok"><?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="a-alert a-alert-error"><?= e($err) ?></div><?php endif; ?>

<p class="a-help" style="margin-bottom:18px;">
  These 9 tabs are the fixed steps shown on the public <a href="../how-it-works" target="_blank" rel="noopener">How It Works</a> page.
  Leave any text field empty to fall back to its default wording. The Sub-steps box uses one <code>Heading | Description</code> pair per line —
  leave it empty to keep the built-in walkthrough for that step.
</p>

<div class="a-card">
  <h2 class="a-card-title"><?= e($def['title']) ?></h2>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="step_key" value="<?= e($currentStep) ?>">

    <div class="a-field">
      <label>Title</label>
      <input type="text" name="title" value="<?= e($title) ?>" placeholder="<?= e($def['title']) ?>">
    </div>
    <div class="a-field">
      <label>Summary (shown above the screenshot)</label>
      <textarea name="summary" rows="2" placeholder="<?= e($def['summary']) ?>"><?= e($summary) ?></textarea>
    </div>
    <div class="a-field">
      <label>Teaser (short one-liner used in the "Explore All Steps" grid card)</label>
      <input type="text" name="teaser" value="<?= e($teaser) ?>" placeholder="<?= e($def['teaser']) ?>">
    </div>
    <div class="a-field">
      <label>Sub-steps (one per line, as <code>Heading | Description</code>)</label>
      <textarea name="substeps" rows="10" placeholder="<?= e(hiw_substeps_to_lines($def['substeps'])) ?>"><?= e($substeps) ?></textarea>
      <small class="a-help">Leave empty to keep the built-in walkthrough (shown greyed-out above as a preview).</small>
    </div>
    <div class="a-field">
      <label>Tip (highlighted note shown after the sub-steps)</label>
      <textarea name="tip" rows="2" placeholder="<?= e($def['tip']) ?>"><?= e($tip) ?></textarea>
    </div>
    <div class="a-field">
      <label>Screenshot Image</label>
      <div class="a-image-field">
        <?php if ($image !== ''): ?>
          <div class="a-thumb">
            <img src="<?= e(resolve_image_url($image)) ?>" alt="">
            <label class="a-remove"><input type="checkbox" name="remove_image_<?= e($currentStep) ?>" value="1"> Remove</label>
          </div>
        <?php else: ?>
          <span class="a-noimg">No image uploaded yet — the public page shows a placeholder box instead.</span>
        <?php endif; ?>
        <input type="file" name="image_<?= e($currentStep) ?>" accept="image/*">
        <small class="a-help">JPG, PNG, WEBP, GIF or SVG. Max 8 MB. Leave empty to keep the current image.</small>
      </div>
    </div>

    <div class="a-actions">
      <button class="a-btn a-btn-primary" type="submit">Save</button>
    </div>
  </form>
</div>

<?php require __DIR__ . '/footer.php'; ?>
