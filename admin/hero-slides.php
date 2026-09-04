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
            $uploaded = handle_upload('image') ?? '';
            $stmt = $pdo->prepare(
                "INSERT INTO hero_slides (headline, subtext, btn1_text, btn1_link, btn2_text, btn2_link, image, sort_order, is_active)
                 VALUES (?,?,?,?,?,?,?,?,1)"
            );
            $stmt->execute([
                trim($_POST['headline'] ?? ''),
                trim($_POST['subtext'] ?? ''),
                trim($_POST['btn1_text'] ?? ''),
                trim($_POST['btn1_link'] ?? ''),
                trim($_POST['btn2_text'] ?? ''),
                trim($_POST['btn2_link'] ?? ''),
                $uploaded,
                (int)($_POST['sort_order'] ?? 0),
            ]);
            $msg = 'Slide added.';
        } elseif ($action === 'update') {
            $id = (int)$_POST['id'];
            $uploaded = handle_upload('image_' . $id);
            $imageSql = '';
            $params = [
                trim($_POST['headline'] ?? ''),
                trim($_POST['subtext'] ?? ''),
                trim($_POST['btn1_text'] ?? ''),
                trim($_POST['btn1_link'] ?? ''),
                trim($_POST['btn2_text'] ?? ''),
                trim($_POST['btn2_link'] ?? ''),
            ];
            if ($uploaded !== null) {
                $imageSql = 'image=?, ';
                $params[] = $uploaded;
            } elseif (!empty($_POST['remove_image_' . $id])) {
                $imageSql = 'image=?, ';
                $params[] = '';
            }
            $params[] = (int)($_POST['sort_order'] ?? 0);
            $params[] = isset($_POST['is_active']) ? 1 : 0;
            $params[] = $id;

            $stmt = $pdo->prepare(
                "UPDATE hero_slides SET headline=?, subtext=?, btn1_text=?, btn1_link=?, btn2_text=?, btn2_link=?, {$imageSql}sort_order=?, is_active=? WHERE id=?"
            );
            $stmt->execute($params);
            $msg = 'Slide updated.';
        } elseif ($action === 'delete') {
            $stmt = $pdo->prepare("DELETE FROM hero_slides WHERE id=?");
            $stmt->execute([(int)$_POST['id']]);
            $msg = 'Slide deleted.';
        }
    }
}

$slides = $pdo->query("SELECT * FROM hero_slides ORDER BY sort_order ASC, id ASC")->fetchAll();

$pageTitle = 'Hero Slider';
$page = 'hero_slides';
require __DIR__ . '/header.php';
require __DIR__ . '/homepage-tabs.php';
?>
<?php if ($msg): ?><div class="a-alert a-alert-ok"><?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="a-alert a-alert-error"><?= e($err) ?></div><?php endif; ?>

<div class="a-card">
  <h2 class="a-card-title">Add New Slide</h2>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="action" value="add">
    <div class="a-field"><label>Headline</label><textarea name="headline" rows="2" required></textarea></div>
    <div class="a-field"><label>Sub-text</label><textarea name="subtext" rows="3"></textarea></div>
    <div class="a-row">
      <div class="a-field" style="flex:1"><label>Primary Button Text</label><input type="text" name="btn1_text" value="Request a Demo"></div>
      <div class="a-field" style="flex:1"><label>Primary Button Link</label><input type="text" name="btn1_link" value="#contact"></div>
    </div>
    <div class="a-row">
      <div class="a-field" style="flex:1"><label>Secondary Button Text</label><input type="text" name="btn2_text" value="Explore Features"></div>
      <div class="a-field" style="flex:1"><label>Secondary Button Link</label><input type="text" name="btn2_link" value="#features"></div>
    </div>
    <div class="a-field">
      <label>Slider Image (full background)</label>
      <div class="a-image-field">
        <input type="file" name="image" accept="image/*">
        <small class="a-help">JPG, PNG, WEBP, GIF or SVG. Max 8 MB. Use a wide, high-resolution photo — it fills the entire hero section.</small>
      </div>
    </div>
    <div class="a-field" style="max-width:140px"><label>Sort Order</label><input type="number" name="sort_order" value="<?= count($slides)+1 ?>"></div>
    <button class="a-btn a-btn-primary"><?= admin_icon('plus', 16) ?> Add Slide</button>
  </form>
</div>

<?php foreach ($slides as $s): ?>
  <div class="a-card">
    <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="action" value="update">
      <input type="hidden" name="id" value="<?= (int)$s['id'] ?>">
      <div class="a-field"><label>Headline</label><textarea name="headline" rows="2" required><?= e($s['headline']) ?></textarea></div>
      <div class="a-field"><label>Sub-text</label><textarea name="subtext" rows="3"><?= e($s['subtext']) ?></textarea></div>
      <div class="a-row">
        <div class="a-field" style="flex:1"><label>Primary Button Text</label><input type="text" name="btn1_text" value="<?= e($s['btn1_text']) ?>"></div>
        <div class="a-field" style="flex:1"><label>Primary Button Link</label><input type="text" name="btn1_link" value="<?= e($s['btn1_link']) ?>"></div>
      </div>
      <div class="a-row">
        <div class="a-field" style="flex:1"><label>Secondary Button Text</label><input type="text" name="btn2_text" value="<?= e($s['btn2_text']) ?>"></div>
        <div class="a-field" style="flex:1"><label>Secondary Button Link</label><input type="text" name="btn2_link" value="<?= e($s['btn2_link']) ?>"></div>
      </div>
      <div class="a-field">
        <label>Slider Image (full background)</label>
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
    <form method="post" onsubmit="return confirm('Delete this slide?');" style="margin-top:10px">
      <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="action" value="delete">
      <input type="hidden" name="id" value="<?= (int)$s['id'] ?>">
      <button class="a-btn a-btn-danger" type="submit"><?= admin_icon('trash', 16) ?> Delete</button>
    </form>
  </div>
<?php endforeach; ?>

<?php if (!$slides): ?>
  <div class="a-card"><p>No slides yet — add one above. Without any slides, the site falls back to a default headline.</p></div>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?>
