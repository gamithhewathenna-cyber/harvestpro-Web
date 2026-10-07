<?php
require_once __DIR__ . '/auth.php';
require_login();
require_once __DIR__ . '/fields.php'; // save_setting()
ensure_youtube_tutorials_table();

$msg = '';
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $err = 'Security token mismatch.';
    } else {
        $action = $_POST['action'] ?? '';

        if ($action === 'save_settings') {
            save_setting($pdo, 'youtube_channel_url', trim($_POST['youtube_channel_url'] ?? ''));
            save_setting($pdo, 'youtube_popup_title', trim($_POST['youtube_popup_title'] ?? ''));
            save_setting($pdo, 'youtube_popup_tagline', trim($_POST['youtube_popup_tagline'] ?? ''));
            save_setting($pdo, 'youtube_fab_text', trim($_POST['youtube_fab_text'] ?? ''));
            save_setting($pdo, 'youtube_fab_subtext', trim($_POST['youtube_fab_subtext'] ?? ''));
            $msg = 'Settings saved.';
        } elseif ($action === 'add') {
            $title = trim($_POST['title'] ?? '');
            $url   = trim($_POST['youtube_url'] ?? '');
            if ($title === '' || $url === '') {
                $err = 'Both a title and a YouTube link are required.';
            } elseif (youtube_video_id($url) === null) {
                $err = "That doesn't look like a valid YouTube link.";
            } else {
                $stmt = $pdo->prepare(
                    "INSERT INTO youtube_tutorials (title, youtube_url, sort_order, is_published) VALUES (?,?,?,1)"
                );
                $stmt->execute([$title, $url, (int)($_POST['sort_order'] ?? 0)]);
                $msg = 'Tutorial added.';
            }
        } elseif ($action === 'update') {
            $id    = (int)$_POST['id'];
            $title = trim($_POST['title'] ?? '');
            $url   = trim($_POST['youtube_url'] ?? '');
            if ($title === '' || $url === '') {
                $err = 'Both a title and a YouTube link are required.';
            } elseif (youtube_video_id($url) === null) {
                $err = "That doesn't look like a valid YouTube link.";
            } else {
                $stmt = $pdo->prepare(
                    "UPDATE youtube_tutorials SET title=?, youtube_url=?, sort_order=?, is_published=? WHERE id=?"
                );
                $stmt->execute([
                    $title, $url, (int)($_POST['sort_order'] ?? 0),
                    isset($_POST['is_published']) ? 1 : 0, $id,
                ]);
                $msg = 'Tutorial updated.';
            }
        } elseif ($action === 'delete') {
            $stmt = $pdo->prepare("DELETE FROM youtube_tutorials WHERE id = ?");
            $stmt->execute([(int)$_POST['id']]);
            $msg = 'Tutorial deleted.';
        }
    }
}

$tutorials = get_youtube_tutorials(false);

$pageTitle = 'YouTube Tutorials';
$page = 'youtube_tutorials';
require __DIR__ . '/header.php';
?>
<?php if ($msg): ?><div class="a-alert a-alert-ok"><?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="a-alert a-alert-error"><?= e($err) ?></div><?php endif; ?>

<p class="a-help" style="margin-bottom:18px;">
  Powers the floating "<?= e(setting('youtube_fab_text', 'How to Use Harvest Pro')) ?>" button shown at the bottom-left of every public page.
  It's only shown at all once at least one tutorial below is published.
</p>

<div class="a-card">
  <h2 class="a-card-title">Popup Text &amp; Button</h2>
  <form method="post">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="action" value="save_settings">
    <div class="a-row">
      <div class="a-field" style="flex:1"><label>Floating Button — Title</label><input type="text" name="youtube_fab_text" value="<?= e(setting('youtube_fab_text', 'How to Use Harvest Pro')) ?>"></div>
      <div class="a-field" style="flex:1"><label>Floating Button — Subtext</label><input type="text" name="youtube_fab_subtext" value="<?= e(setting('youtube_fab_subtext', 'Step-by-step video tutorials')) ?>"></div>
    </div>
    <div class="a-field"><label>Popup Heading</label><input type="text" name="youtube_popup_title" value="<?= e(setting('youtube_popup_title', 'Welcome to Harvest Pro')) ?>"></div>
    <div class="a-field"><label>Popup Tagline</label><input type="text" name="youtube_popup_tagline" value="<?= e(setting('youtube_popup_tagline', 'Learn how to get started easily with our step-by-step video tutorials.')) ?>"></div>
    <div class="a-field">
      <label>"View All Tutorials" Link (your YouTube channel or playlist URL)</label>
      <input type="text" name="youtube_channel_url" value="<?= e(setting('youtube_channel_url', '')) ?>" placeholder="https://www.youtube.com/@yourchannel">
      <small class="a-help">The button under the tutorial list opens this. Leave empty to hide that button.</small>
    </div>
    <div class="a-actions"><button class="a-btn a-btn-primary" type="submit">Save</button></div>
  </form>
</div>

<div class="a-card">
  <h2 class="a-card-title">Add New Tutorial</h2>
  <form method="post">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="action" value="add">
    <div class="a-field"><label>Title</label><input type="text" name="title" required placeholder="e.g. Create Your Account"></div>
    <div class="a-field"><label>YouTube Link</label><input type="text" name="youtube_url" required placeholder="https://www.youtube.com/watch?v=..."></div>
    <div class="a-field" style="max-width:140px"><label>Sort Order</label><input type="number" name="sort_order" value="<?= count($tutorials) + 1 ?>"></div>
    <button class="a-btn a-btn-primary"><?= admin_icon('plus', 16) ?> Add Tutorial</button>
  </form>
</div>

<?php foreach ($tutorials as $i => $t): ?>
  <details class="a-card yt-accordion">
    <summary class="yt-accordion-summary">
      <span class="yt-accordion-num"><?= e(sprintf('%02d', $i + 1)) ?></span>
      <span class="yt-accordion-title"><?= e($t['title']) ?></span>
      <span class="a-badge <?= $t['is_published'] ? 'a-badge-ok' : '' ?>"><?= $t['is_published'] ? 'Published' : 'Draft' ?></span>
      <span class="yt-accordion-chevron"><svg width="14" height="14" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="5,7.5 10,12.5 15,7.5"/></svg></span>
    </summary>
    <div class="yt-accordion-body">
      <form method="post">
        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id" value="<?= (int)$t['id'] ?>">
        <div class="a-field"><label>Title</label><input type="text" name="title" value="<?= e($t['title']) ?>" required></div>
        <div class="a-field"><label>YouTube Link</label><input type="text" name="youtube_url" value="<?= e($t['youtube_url']) ?>" required></div>
        <?php if ($t['video_id']): ?>
          <div class="a-field">
            <label>Preview</label>
            <img src="https://img.youtube.com/vi/<?= e($t['video_id']) ?>/mqdefault.jpg" alt="" style="width:200px; border-radius:8px; display:block;">
          </div>
        <?php endif; ?>
        <div class="a-row">
          <div class="a-field" style="max-width:140px"><label>Sort Order</label><input type="number" name="sort_order" value="<?= (int)$t['sort_order'] ?>"></div>
          <label class="a-check"><input type="checkbox" name="is_published" <?= $t['is_published'] ? 'checked' : '' ?>> Published (visible in the popup)</label>
        </div>
        <div class="a-actions"><button class="a-btn a-btn-primary" type="submit">Save</button></div>
      </form>
      <form method="post" onsubmit="return confirm('Delete this tutorial?');" style="margin-top:10px">
        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="id" value="<?= (int)$t['id'] ?>">
        <button class="a-btn a-btn-danger" type="submit"><?= admin_icon('trash', 16) ?> Delete</button>
      </form>
    </div>
  </details>
<?php endforeach; ?>

<?php if (!$tutorials): ?>
  <div class="a-card"><p>No tutorials yet — add one above. The floating button stays hidden on the public site until at least one is published.</p></div>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?>
