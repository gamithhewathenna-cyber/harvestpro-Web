<?php
require_once __DIR__ . '/auth.php';
require_login();
require_once __DIR__ . '/fields.php'; // handle_upload()

$msg = '';
$err = '';

$textFields = ['kicker', 'title', 'intro', 'body', 'list1_heading', 'list1_items', 'list2_heading', 'list2_items', 'note'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $err = 'Security token mismatch.';
    } else {
        $action = $_POST['action'] ?? '';

        if ($action === 'add') {
            $uploaded = handle_upload('image') ?? '';
            $stmt = $pdo->prepare(
                "INSERT INTO feature_sections (kicker, title, intro, body, list1_heading, list1_items, list2_heading, list2_items, note, image, sort_order, is_active)
                 VALUES (?,?,?,?,?,?,?,?,?,?,?,1)"
            );
            $values = [];
            foreach ($textFields as $f) {
                $values[] = trim($_POST[$f] ?? '');
            }
            $values[] = $uploaded;
            $values[] = (int)($_POST['sort_order'] ?? 0);
            $stmt->execute($values);
            $msg = 'Section added.';
        } elseif ($action === 'update') {
            $id = (int)$_POST['id'];
            $uploaded = handle_upload('image_' . $id);
            $setSql = [];
            $params = [];
            foreach ($textFields as $f) {
                $setSql[] = "$f=?";
                $params[] = trim($_POST[$f] ?? '');
            }
            if ($uploaded !== null) {
                $setSql[] = 'image=?';
                $params[] = $uploaded;
            } elseif (!empty($_POST['remove_image_' . $id])) {
                $setSql[] = 'image=?';
                $params[] = '';
            }
            $setSql[] = 'sort_order=?';
            $params[] = (int)($_POST['sort_order'] ?? 0);
            $setSql[] = 'is_active=?';
            $params[] = isset($_POST['is_active']) ? 1 : 0;
            $params[] = $id;

            $stmt = $pdo->prepare("UPDATE feature_sections SET " . implode(', ', $setSql) . " WHERE id=?");
            $stmt->execute($params);
            $msg = 'Section updated.';
        } elseif ($action === 'delete') {
            $stmt = $pdo->prepare("DELETE FROM feature_sections WHERE id=?");
            $stmt->execute([(int)$_POST['id']]);
            $msg = 'Section deleted.';
        }
    }
}

$sections = $pdo->query("SELECT * FROM feature_sections ORDER BY sort_order ASC, id ASC")->fetchAll();

$pageTitle = 'Feature Sections';
$page = 'feature_sections';
require __DIR__ . '/header.php';
require __DIR__ . '/features-tabs.php';
?>
<?php if ($msg): ?><div class="a-alert a-alert-ok"><?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="a-alert a-alert-error"><?= e($err) ?></div><?php endif; ?>

<div class="a-card">
  <h2 class="a-card-title">Add New Section</h2>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="action" value="add">
    <div class="a-field"><label>Kicker (small label above the heading)</label><input type="text" name="kicker"></div>
    <div class="a-field"><label>Heading</label><input type="text" name="title" required></div>
    <div class="a-field"><label>Intro Paragraph</label><textarea name="intro" rows="2"></textarea></div>
    <div class="a-field"><label>Body Paragraph</label><textarea name="body" rows="2"></textarea></div>
    <div class="a-row">
      <div class="a-field" style="flex:1"><label>List 1 Heading</label><input type="text" name="list1_heading" value="Key Features"></div>
      <div class="a-field" style="flex:1"><label>List 1 Items (one per line)</label><textarea name="list1_items" rows="5"></textarea></div>
    </div>
    <div class="a-row">
      <div class="a-field" style="flex:1"><label>List 2 Heading (optional)</label><input type="text" name="list2_heading"></div>
      <div class="a-field" style="flex:1"><label>List 2 Items (optional, one per line)</label><textarea name="list2_items" rows="5"></textarea></div>
    </div>
    <div class="a-field">
      <label>Closing Note</label>
      <textarea name="note" rows="2"></textarea>
      <small class="a-help">Plain text, or use <code>Title|Text</code> to render it as a highlighted callout box (e.g. an upcoming-feature notice).</small>
    </div>
    <div class="a-field">
      <label>Image</label>
      <div class="a-image-field">
        <input type="file" name="image" accept="image/*">
        <small class="a-help">JPG, PNG, WEBP, GIF or SVG. Max 8 MB.</small>
      </div>
    </div>
    <div class="a-field" style="max-width:140px"><label>Sort Order</label><input type="number" name="sort_order" value="<?= count($sections)+1 ?>"></div>
    <button class="a-btn a-btn-primary"><?= admin_icon('plus', 16) ?> Add Section</button>
  </form>
</div>

<?php foreach ($sections as $s): ?>
  <div class="a-card">
    <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="action" value="update">
      <input type="hidden" name="id" value="<?= (int)$s['id'] ?>">
      <div class="a-field"><label>Kicker (small label above the heading)</label><input type="text" name="kicker" value="<?= e($s['kicker']) ?>"></div>
      <div class="a-field"><label>Heading</label><input type="text" name="title" value="<?= e($s['title']) ?>" required></div>
      <div class="a-field"><label>Intro Paragraph</label><textarea name="intro" rows="2"><?= e($s['intro']) ?></textarea></div>
      <div class="a-field"><label>Body Paragraph</label><textarea name="body" rows="2"><?= e($s['body']) ?></textarea></div>
      <div class="a-row">
        <div class="a-field" style="flex:1"><label>List 1 Heading</label><input type="text" name="list1_heading" value="<?= e($s['list1_heading']) ?>"></div>
        <div class="a-field" style="flex:1"><label>List 1 Items (one per line)</label><textarea name="list1_items" rows="5"><?= e($s['list1_items']) ?></textarea></div>
      </div>
      <div class="a-row">
        <div class="a-field" style="flex:1"><label>List 2 Heading (optional)</label><input type="text" name="list2_heading" value="<?= e($s['list2_heading']) ?>"></div>
        <div class="a-field" style="flex:1"><label>List 2 Items (optional, one per line)</label><textarea name="list2_items" rows="5"><?= e($s['list2_items']) ?></textarea></div>
      </div>
      <div class="a-field">
        <label>Closing Note</label>
        <textarea name="note" rows="2"><?= e($s['note']) ?></textarea>
        <small class="a-help">Plain text, or use <code>Title|Text</code> to render it as a highlighted callout box (e.g. an upcoming-feature notice).</small>
      </div>
      <div class="a-field">
        <label>Image</label>
        <div class="a-image-field">
          <?php if ($s['image']): ?>
            <div class="a-thumb">
              <img src="<?= e(resolve_image_url($s['image'])) ?>" alt="">
              <label class="a-remove"><input type="checkbox" name="remove_image_<?= (int)$s['id'] ?>" value="1"> Remove</label>
            </div>
          <?php else: ?>
            <span class="a-noimg">No image uploaded yet.</span>
          <?php endif; ?>
          <input type="file" name="image_<?= (int)$s['id'] ?>" accept="image/*">
          <small class="a-help">JPG, PNG, WEBP, GIF or SVG. Max 8 MB. Leave empty to keep the current image.</small>
        </div>
      </div>
      <div class="a-row">
        <div class="a-field" style="max-width:140px"><label>Sort Order</label><input type="number" name="sort_order" value="<?= (int)$s['sort_order'] ?>"></div>
        <label class="a-check"><input type="checkbox" name="is_active" <?= $s['is_active']?'checked':'' ?>> Active (visible)</label>
      </div>
      <div class="a-actions">
        <button class="a-btn a-btn-primary" type="submit">Save</button>
      </div>
    </form>
    <form method="post" onsubmit="return confirm('Delete this section?');" style="margin-top:10px">
      <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="action" value="delete">
      <input type="hidden" name="id" value="<?= (int)$s['id'] ?>">
      <button class="a-btn a-btn-danger" type="submit"><?= admin_icon('trash', 16) ?> Delete</button>
    </form>
  </div>
<?php endforeach; ?>

<?php if (!$sections): ?>
  <div class="a-card"><p>No sections yet — add one above.</p></div>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?>
