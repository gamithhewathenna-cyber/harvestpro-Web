<?php
require_once __DIR__ . '/auth.php';
require_login();

$featureCount = (int)$pdo->query("SELECT COUNT(*) FROM features")->fetchColumn();
$reqCount     = (int)$pdo->query("SELECT COUNT(*) FROM demo_requests")->fetchColumn();
$recent       = $pdo->query("SELECT * FROM demo_requests ORDER BY created_at DESC LIMIT 5")->fetchAll();

$pageTitle = 'Dashboard';
$page = 'dashboard';
require __DIR__ . '/header.php';
?>
<div class="a-stats">
  <div class="a-stat">
    <span class="a-stat-num"><?= $featureCount ?></span>
    <span class="a-stat-label">Feature Cards</span>
    <a href="features.php">Manage &rarr;</a>
  </div>
  <div class="a-stat">
    <span class="a-stat-num"><?= $reqCount ?></span>
    <span class="a-stat-label">Demo Requests</span>
    <a href="requests.php">View &rarr;</a>
  </div>
  <div class="a-stat">
    <span class="a-stat-num">9</span>
    <span class="a-stat-label">Editable Sections</span>
    <a href="section.php?g=hero">Edit &rarr;</a>
  </div>
</div>

<div class="a-card">
  <h2 class="a-card-title">Welcome</h2>
  <p>Open <strong>Home Page</strong> in the sidebar to edit every part of the home page — use the
     section tabs at the top to jump between them. Every piece of text and every image
     on the public site can be changed here — your changes go live immediately.</p>
  <p style="margin-top:12px;">Quick links:
    <a href="section.php?g=hero">Hero</a> ·
    <a href="section.php?g=why">Why Section</a> ·
    <a href="features.php">Feature Cards</a> ·
    <a href="section.php?g=cta">Call To Action</a> ·
    <a href="section.php?g=footer">Footer</a>
  </p>
</div>

<div class="a-card">
  <h2 class="a-card-title">Recent Demo Requests</h2>
  <?php if (!$recent): ?>
    <p>No requests yet.</p>
  <?php else: ?>
    <table class="a-table">
      <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Date</th></tr></thead>
      <tbody>
        <?php foreach ($recent as $r): ?>
          <tr>
            <td><?= e($r['name']) ?></td>
            <td><?= e($r['email']) ?></td>
            <td><?= e($r['phone']) ?></td>
            <td><?= e(date('d M Y, H:i', strtotime($r['created_at']))) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/footer.php'; ?>
