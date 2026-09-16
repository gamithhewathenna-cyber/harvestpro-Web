<?php
require_once __DIR__ . '/auth.php';
require_login();
require_once __DIR__ . '/fields.php'; // handle_upload()
ensure_payment_logos_table();

$msg = '';
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $err = 'Security token mismatch.';
    } else {
        $action = $_POST['action'] ?? '';

        if ($action === 'add') {
            $uploaded = handle_upload('image');
            if ($uploaded === null) {
                $err = 'Please choose an image to upload.';
            } else {
                $stmt = $pdo->prepare(
                    "INSERT INTO payment_logos (image, alt_text, link, sort_order, is_active)
                     VALUES (?,?,?,?,1)"
                );
                $stmt->execute([
                    $uploaded,
                    trim($_POST['alt_text'] ?? ''),
                    trim($_POST['link'] ?? ''),
                    (int)($_POST['sort_order'] ?? 0),
                ]);
                $msg = 'Logo added.';
            }
        } elseif ($action === 'update') {
            $id = (int)$_POST['id'];
            $uploaded = handle_upload('image_' . $id);
            $imageSql = '';
            $params = [
                trim($_POST['alt_text'] ?? ''),
                trim($_POST['link'] ?? ''),
            ];
            if ($uploaded !== null) {
                $imageSql = 'image=?, ';
                $params[] = $uploaded;
            }
            $params[] = (int)($_POST['sort_order'] ?? 0);
            $params[] = isset($_POST['is_active']) ? 1 : 0;
            $params[] = $id;

            $stmt = $pdo->prepare(
                "UPDATE payment_logos SET alt_text=?, link=?, {$imageSql}sort_order=?, is_active=? WHERE id=?"
            );
            $stmt->execute($params);
            $msg = 'Logo updated.';
        } elseif ($action === 'delete') {
            $stmt = $pdo->prepare("DELETE FROM payment_logos WHERE id=?");
            $stmt->execute([(int)$_POST['id']]);
            $msg = 'Logo deleted.';
        }
    }
}

$logos = $pdo->query("SELECT * FROM payment_logos ORDER BY sort_order ASC, id ASC")->fetchAll();

$pageTitle = 'Payment Logos';
$page = 'payment_logos';
require __DIR__ . '/header.php';
require __DIR__ . '/homepage-tabs.php';
?>
<?php if ($msg): ?><div class="a-alert a-alert-ok"><?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="a-alert a-alert-error"><?= e($err) ?></div><?php endif; ?>

<div class="a-card">
  <h2 class="a-card-title">Add New Logo</h2>
  <p class="a-help" style="margin-top:-6px;">Shown in the footer, below the newsletter field. Add as many as you like — PayHere, Visa, Mastercard, etc.</p>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="action" value="add">
    <div class="a-field">
      <label>Logo Image</label>
      <div class="a-image-field">
        <input type="file" name="image" accept="image/*" required>
        <small class="a-help">JPG, PNG, WEBP, GIF or SVG. Max 8 MB. A wide, short image (like a payment badge) works best.</small>
      </div>
    </div>
    <div class="a-row">
      <div class="a-field" style="flex:1"><label>Alt Text (e.g. PayHere)</label><input type="text" name="alt_text"></div>
      <div class="a-field" style="flex:1"><label>Link (optional — e.g. https://www.payhere.lk)</label><input type="text" name="link"></div>
    </div>
    <div class="a-field" style="max-width:140px"><label>Sort Order</label><input type="number" name="sort_order" value="<?= count($logos)+1 ?>"></div>
    <button class="a-btn a-btn-primary"><?= admin_icon('plus', 16) ?> Add Logo</button>
  </form>
</div>

<?php foreach ($logos as $l): ?>
  <div class="a-card">
    <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="action" value="update">
      <input type="hidden" name="id" value="<?= (int)$l['id'] ?>">
      <div class="a-field">
        <label>Logo Image</label>
        <div class="a-image-field">
          <?php if ($l['image']): ?>
            <div class="a-thumb">
              <img src="<?= e(resolve_image_url($l['image'])) ?>" alt="" style="max-height:60px;width:auto;">
            </div>
          <?php else: ?>
            <span class="a-noimg">No image uploaded yet.</span>
          <?php endif; ?>
          <input type="file" name="image_<?= (int)$l['id'] ?>" accept="image/*">
          <small class="a-help">Leave empty to keep the current image.</small>
        </div>
      </div>
      <div class="a-row">
        <div class="a-field" style="flex:1"><label>Alt Text</label><input type="text" name="alt_text" value="<?= e($l['alt_text'] ?? '') ?>"></div>
        <div class="a-field" style="flex:1"><label>Link (optional)</label><input type="text" name="link" value="<?= e($l['link'] ?? '') ?>"></div>
      </div>
      <div class="a-row">
        <div class="a-field" style="max-width:140px"><label>Sort Order</label><input type="number" name="sort_order" value="<?= (int)$l['sort_order'] ?>"></div>
        <label class="a-check"><input type="checkbox" name="is_active" <?= $l['is_active']?'checked':'' ?>> Active (visible)</label>
      </div>
      <div class="a-actions">
        <button class="a-btn a-btn-primary" type="submit">Save</button>
      </div>
    </form>
    <form method="post" onsubmit="return confirm('Delete this logo?');" style="margin-top:10px">
      <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="action" value="delete">
      <input type="hidden" name="id" value="<?= (int)$l['id'] ?>">
      <button class="a-btn a-btn-danger" type="submit"><?= admin_icon('trash', 16) ?> Delete</button>
    </form>
  </div>
<?php endforeach; ?>

<?php if (!$logos): ?>
  <div class="a-card"><p>No payment logos yet — add one above.</p></div>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?>
