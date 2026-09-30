<?php
require_once __DIR__ . '/auth.php';
require_login();
ensure_news_tables();

$msg = '';
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $err = 'Security token mismatch.';
    } else {
        $action = $_POST['action'] ?? '';

        if ($action === 'add') {
            $name = trim($_POST['name'] ?? '');
            if ($name === '') {
                $err = 'Category name is required.';
            } else {
                $slug = news_unique_slug('news_categories', news_slugify($name));
                $stmt = $pdo->prepare("INSERT INTO news_categories (name, slug) VALUES (?, ?)");
                $stmt->execute([$name, $slug]);
                $msg = 'Category added.';
            }
        } elseif ($action === 'rename') {
            $id = (int)$_POST['id'];
            $name = trim($_POST['name'] ?? '');
            if ($name !== '') {
                $stmt = $pdo->prepare("UPDATE news_categories SET name = ? WHERE id = ?");
                $stmt->execute([$name, $id]);
                $msg = 'Category updated.';
            }
        } elseif ($action === 'delete') {
            $id = (int)$_POST['id'];
            $pdo->prepare("UPDATE news_posts SET category_id = NULL WHERE category_id = ?")->execute([$id]);
            $pdo->prepare("DELETE FROM news_categories WHERE id = ?")->execute([$id]);
            $msg = 'Category deleted. Posts that used it are now uncategorised.';
        }
    }
}

$categories = get_news_categories();

$pageTitle = 'News Categories';
$page = 'news_categories';
require __DIR__ . '/header.php';
?>
<?php if ($msg): ?><div class="a-alert a-alert-ok"><?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="a-alert a-alert-error"><?= e($err) ?></div><?php endif; ?>

<p class="a-help" style="margin-bottom:18px;"><a href="news.php">&larr; Back to News &amp; Updates</a></p>

<div class="a-card">
  <h2 class="a-card-title">Add New Category</h2>
  <form method="post">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="action" value="add">
    <div class="a-field"><label>Category Name</label><input type="text" name="name" required></div>
    <button class="a-btn a-btn-primary"><?= admin_icon('plus', 16) ?> Add Category</button>
  </form>
</div>

<div class="a-card">
  <h2 class="a-card-title">Categories</h2>
  <?php foreach ($categories as $c): ?>
    <div style="display:flex; gap:10px; align-items:center; margin-bottom:12px;">
      <form method="post" style="display:flex; gap:10px; align-items:center; flex:1;">
        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
        <input type="hidden" name="action" value="rename">
        <input type="hidden" name="id" value="<?= (int)$c['id'] ?>">
        <input type="text" name="name" value="<?= e($c['name']) ?>" style="flex:1;">
        <button class="a-btn a-btn-primary" type="submit">Save</button>
      </form>
      <form method="post" onsubmit="return confirm('Delete this category? Posts using it will become uncategorised.');">
        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="id" value="<?= (int)$c['id'] ?>">
        <button class="a-btn a-btn-danger" type="submit"><?= admin_icon('trash', 16) ?></button>
      </form>
    </div>
  <?php endforeach; ?>
  <?php if (!$categories): ?><p>No categories yet — add one above.</p><?php endif; ?>
</div>

<?php require __DIR__ . '/footer.php'; ?>
