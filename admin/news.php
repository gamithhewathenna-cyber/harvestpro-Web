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
        if ($action === 'delete') {
            $stmt = $pdo->prepare("DELETE FROM news_posts WHERE id = ?");
            $stmt->execute([(int)$_POST['id']]);
            $msg = 'Post deleted.';
        }
    }
}

$posts = get_news_posts(['published_only' => false]);

$pageTitle = 'News & Updates';
$page = 'news';
require __DIR__ . '/header.php';
?>
<?php if ($msg): ?><div class="a-alert a-alert-ok"><?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="a-alert a-alert-error"><?= e($err) ?></div><?php endif; ?>

<div class="a-card">
  <div style="display:flex; justify-content:space-between; align-items:center; gap:14px; flex-wrap:wrap; margin-bottom:6px;">
    <p class="a-help" style="margin:0;">Posts published here automatically appear on the public <a href="../news" target="_blank" rel="noopener">News &amp; Updates</a> page. Unpublished posts stay hidden.</p>
    <div style="display:flex; gap:10px; flex-shrink:0;">
      <a href="news-categories.php" class="a-btn a-btn-outline"><?= admin_icon('layers', 16) ?> Categories</a>
      <a href="news-edit.php" class="a-btn a-btn-primary"><?= admin_icon('plus', 16) ?> Add New Post</a>
    </div>
  </div>
</div>

<div class="a-card">
  <?php if (!$posts): ?>
    <p>No posts yet — click "Add New Post" above to write your first one.</p>
  <?php else: ?>
    <div class="a-table-wrap">
    <table class="a-table">
      <thead>
        <tr><th>Title</th><th>Category</th><th>Status</th><th>Date</th><th></th></tr>
      </thead>
      <tbody>
        <?php foreach ($posts as $p): ?>
          <tr>
            <td><a href="news-edit.php?id=<?= (int)$p['id'] ?>"><?= e($p['title']) ?></a></td>
            <td><?= e($p['category_name'] ?: '—') ?></td>
            <td>
              <?php if ($p['is_published']): ?>
                <span class="a-badge a-badge-ok">Published</span>
              <?php else: ?>
                <span class="a-badge">Draft</span>
              <?php endif; ?>
            </td>
            <td><?= e($p['published_at'] ? date('j M Y', strtotime($p['published_at'])) : date('j M Y', strtotime($p['created_at']))) ?></td>
            <td style="text-align:right; white-space:nowrap;">
              <a href="news-edit.php?id=<?= (int)$p['id'] ?>" class="a-btn a-btn-outline" style="padding:6px 12px;">Edit</a>
              <form method="post" style="display:inline;" onsubmit="return confirm('Delete this post? This cannot be undone.');">
                <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                <button class="a-btn a-btn-danger" type="submit" style="padding:6px 12px;"><?= admin_icon('trash', 14) ?></button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/footer.php'; ?>
