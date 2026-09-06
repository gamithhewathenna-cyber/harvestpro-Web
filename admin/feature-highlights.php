<?php
require_once __DIR__ . '/auth.php';
require_login();
require_once __DIR__ . '/fields.php'; // handle_upload()

$msg = '';
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $err = 'Security token mismatch.';
    } else {
        $action = $_POST['action'] ?? '';

        if ($action === 'add') {
            $uploaded = handle_upload('icon') ?? '';
            $stmt = $pdo->prepare("INSERT INTO feature_highlights (icon, title, description, sort_order, is_active) VALUES (?,?,?,?,1)");
            $stmt->execute([
                $uploaded,
                trim($_POST['title']),
                trim($_POST['description']),
                (int)($_POST['sort_order'] ?? 0),
            ]);
            $msg = 'Highlight added.';
        } elseif ($action === 'update') {
            $id = (int)$_POST['id'];
            $uploaded = handle_upload('icon_' . $id);
            $iconSql = '';
            $params = [
                trim($_POST['title']),
                trim($_POST['description']),
            ];
            if ($uploaded !== null) {
                $iconSql = 'icon=?, ';
                $params[] = $uploaded;
            } elseif (!empty($_POST['remove_icon_' . $id])) {
                $iconSql = 'icon=?, ';
                $params[] = '';
            }
            $params[] = (int)($_POST['sort_order'] ?? 0);
            $params[] = isset($_POST['is_active']) ? 1 : 0;
            $params[] = $id;

            $stmt = $pdo->prepare("UPDATE feature_highlights SET title=?, description=?, {$iconSql}sort_order=?, is_active=? WHERE id=?");
            $stmt->execute($params);
            $msg = 'Highlight updated.';
        } elseif ($action === 'delete') {
            $stmt = $pdo->prepare("DELETE FROM feature_highlights WHERE id=?");
            $stmt->execute([(int)$_POST['id']]);
            $msg = 'Highlight deleted.';
        }
    }
}

$highlights = $pdo->query("SELECT * FROM feature_highlights ORDER BY sort_order ASC, id ASC")->fetchAll();

$pageTitle = 'Highlight Cards';
$page = 'highlights';
require __DIR__ . '/header.php';
require __DIR__ . '/homepage-tabs.php';
?>
<?php if ($msg): ?><div class="a-alert a-alert-ok"><?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="a-alert a-alert-error"><?= e($err) ?></div><?php endif; ?>

<div class="a-card">
  <h2 class="a-card-title">Add New Highlight Card</h2>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="action" value="add">
    <div class="a-field">
      <label>Icon</label>
      <div class="a-image-field">
        <input type="file" name="icon" accept="image/*">
        <small class="a-help">JPG, PNG, WEBP, GIF or SVG. Max 8 MB. A small square icon works best.</small>
      </div>
    </div>
    <div class="a-field"><label>Heading</label><input type="text" name="title" required></div>
    <div class="a-field"><label>Intro Paragraph</label><textarea name="description" rows="2" required></textarea></div>
    <div class="a-field" style="max-width:120px"><label>Sort Order</label><input type="number" name="sort_order" value="<?= count($highlights)+1 ?>"></div>
    <button class="a-btn a-btn-primary"><?= admin_icon('plus', 16) ?> Add Highlight</button>
  </form>
</div>

<?php foreach ($highlights as $h): ?>
  <div class="a-card">
    <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="action" value="update">
      <input type="hidden" name="id" value="<?= (int)$h['id'] ?>">
      <div class="a-field">
        <label>Icon</label>
        <div class="a-image-field">
          <?php if (!empty($h['icon'])): ?>
            <div class="a-thumb">
              <img src="<?= e(resolve_image_url($h['icon'])) ?>" alt="">
              <label class="a-remove"><input type="checkbox" name="remove_icon_<?= (int)$h['id'] ?>" value="1"> Remove</label>
            </div>
          <?php else: ?>
            <span class="a-noimg">No icon uploaded yet.</span>
          <?php endif; ?>
          <input type="file" name="icon_<?= (int)$h['id'] ?>" accept="image/*">
          <small class="a-help">JPG, PNG, WEBP, GIF or SVG. Max 8 MB. Leave empty to keep the current icon.</small>
        </div>
      </div>
      <div class="a-field"><label>Heading</label><input type="text" name="title" value="<?= e($h['title']) ?>" required></div>
      <div class="a-field"><label>Intro Paragraph</label><textarea name="description" rows="2" required><?= e($h['description']) ?></textarea></div>
      <div class="a-row">
        <div class="a-field" style="max-width:120px"><label>Sort Order</label><input type="number" name="sort_order" value="<?= (int)$h['sort_order'] ?>"></div>
        <label class="a-check"><input type="checkbox" name="is_active" <?= $h['is_active']?'checked':'' ?>> Active (visible)</label>
      </div>
      <div class="a-actions">
        <button class="a-btn a-btn-primary" type="submit">Save</button>
      </div>
    </form>
    <form method="post" onsubmit="return confirm('Delete this highlight card?');" style="margin-top:10px">
      <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="action" value="delete">
      <input type="hidden" name="id" value="<?= (int)$h['id'] ?>">
      <button class="a-btn a-btn-danger" type="submit"><?= admin_icon('trash', 16) ?> Delete</button>
    </form>
  </div>
<?php endforeach; ?>

<?php if (!$highlights): ?>
  <div class="a-card"><p>No highlight cards yet — add one above.</p></div>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?>
