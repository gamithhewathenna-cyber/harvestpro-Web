<?php
require_once __DIR__ . '/auth.php';
require_login();

$msg = '';
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $err = 'Security token mismatch.';
    } else {
        $action = $_POST['action'] ?? '';

        if ($action === 'add') {
            $stmt = $pdo->prepare("INSERT INTO features (title, description, sort_order, is_active) VALUES (?,?,?,1)");
            $stmt->execute([
                trim($_POST['title']),
                trim($_POST['description']),
                (int)($_POST['sort_order'] ?? 0),
            ]);
            $msg = 'Feature added.';
        } elseif ($action === 'update') {
            $stmt = $pdo->prepare("UPDATE features SET title=?, description=?, sort_order=?, is_active=? WHERE id=?");
            $stmt->execute([
                trim($_POST['title']),
                trim($_POST['description']),
                (int)($_POST['sort_order'] ?? 0),
                isset($_POST['is_active']) ? 1 : 0,
                (int)$_POST['id'],
            ]);
            $msg = 'Feature updated.';
        } elseif ($action === 'delete') {
            $stmt = $pdo->prepare("DELETE FROM features WHERE id=?");
            $stmt->execute([(int)$_POST['id']]);
            $msg = 'Feature deleted.';
        }
    }
}

$features = $pdo->query("SELECT * FROM features ORDER BY sort_order ASC, id ASC")->fetchAll();

$pageTitle = 'Feature Cards';
$page = 'features';
require __DIR__ . '/header.php';
require __DIR__ . '/homepage-tabs.php';
?>
<?php if ($msg): ?><div class="a-alert a-alert-ok"><?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="a-alert a-alert-error"><?= e($err) ?></div><?php endif; ?>

<div class="a-card">
  <h2 class="a-card-title">Add New Feature Card</h2>
  <form method="post">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="action" value="add">
    <div class="a-field"><label>Title</label><input type="text" name="title" required></div>
    <div class="a-field"><label>Description</label><textarea name="description" rows="2" required></textarea></div>
    <div class="a-field" style="max-width:120px"><label>Sort Order</label><input type="number" name="sort_order" value="<?= count($features)+1 ?>"></div>
    <button class="a-btn a-btn-primary"><?= admin_icon('plus', 16) ?> Add Feature</button>
  </form>
</div>

<?php foreach ($features as $f): ?>
  <div class="a-card">
    <form method="post">
      <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="action" value="update">
      <input type="hidden" name="id" value="<?= (int)$f['id'] ?>">
      <div class="a-field"><label>Title</label><input type="text" name="title" value="<?= e($f['title']) ?>" required></div>
      <div class="a-field"><label>Description</label><textarea name="description" rows="2" required><?= e($f['description']) ?></textarea></div>
      <div class="a-row">
        <div class="a-field" style="max-width:120px"><label>Sort Order</label><input type="number" name="sort_order" value="<?= (int)$f['sort_order'] ?>"></div>
        <label class="a-check"><input type="checkbox" name="is_active" <?= $f['is_active']?'checked':'' ?>> Active (visible)</label>
      </div>
      <div class="a-actions">
        <button class="a-btn a-btn-primary" type="submit">Save</button>
      </div>
    </form>
    <form method="post" onsubmit="return confirm('Delete this feature card?');" style="margin-top:10px">
      <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="action" value="delete">
      <input type="hidden" name="id" value="<?= (int)$f['id'] ?>">
      <button class="a-btn a-btn-danger" type="submit"><?= admin_icon('trash', 16) ?> Delete</button>
    </form>
  </div>
<?php endforeach; ?>

<?php require __DIR__ . '/footer.php'; ?>
