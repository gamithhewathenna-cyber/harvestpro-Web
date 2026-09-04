<?php
require_once __DIR__ . '/auth.php';
require_login();

// CSV export
if (isset($_GET['export'])) {
    $rows = $pdo->query("SELECT * FROM demo_requests ORDER BY created_at DESC")->fetchAll();
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="demo_requests.csv"');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['ID', 'Name', 'Email', 'Phone', 'Message', 'Date']);
    foreach ($rows as $r) {
        fputcsv($out, [$r['id'], $r['name'], $r['email'], $r['phone'], $r['message'], $r['created_at']]);
    }
    fclose($out);
    exit;
}

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_check() && ($_POST['action'] ?? '') === 'delete') {
    $stmt = $pdo->prepare("DELETE FROM demo_requests WHERE id=?");
    $stmt->execute([(int)$_POST['id']]);
    $msg = 'Request deleted.';
}

$rows = $pdo->query("SELECT * FROM demo_requests ORDER BY created_at DESC")->fetchAll();

$pageTitle = 'Demo Requests';
$page = 'requests';
require __DIR__ . '/header.php';
?>
<?php if ($msg): ?><div class="a-alert a-alert-ok"><?= e($msg) ?></div><?php endif; ?>

<div class="a-card">
  <div class="a-row-between">
    <h2 class="a-card-title">All Requests (<?= count($rows) ?>)</h2>
    <?php if ($rows): ?><a href="requests.php?export=1" class="a-btn a-btn-outline">Export CSV</a><?php endif; ?>
  </div>

  <?php if (!$rows): ?>
    <p>No demo requests received yet.</p>
  <?php else: ?>
    <div class="a-table-wrap">
    <table class="a-table">
      <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Date</th><th></th></tr></thead>
      <tbody>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td><?= e($r['name']) ?></td>
            <td><a href="mailto:<?= e($r['email']) ?>"><?= e($r['email']) ?></a></td>
            <td><?= e($r['phone']) ?></td>
            <td class="a-msg"><?= e($r['message']) ?></td>
            <td><?= e(date('d M Y, H:i', strtotime($r['created_at']))) ?></td>
            <td>
              <form method="post" onsubmit="return confirm('Delete this request?');">
                <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                <button class="a-btn a-btn-danger sm">Delete</button>
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
