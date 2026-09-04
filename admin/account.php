<?php
require_once __DIR__ . '/auth.php';
require_login();

$admin = current_admin();
$msg = '';
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $err = 'Security token mismatch.';
    } else {
        $fullName = trim($_POST['full_name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $current  = $_POST['current_password'] ?? '';
        $newPass  = $_POST['new_password'] ?? '';
        $confirm  = $_POST['confirm_password'] ?? '';

        if ($username === '') {
            $err = 'Username cannot be empty.';
        } elseif ($newPass !== '' && $newPass !== $confirm) {
            $err = 'New passwords do not match.';
        } elseif ($newPass !== '' && !password_verify($current, $admin['password'])) {
            $err = 'Current password is incorrect.';
        } else {
            if ($newPass !== '') {
                $hash = password_hash($newPass, PASSWORD_BCRYPT);
                $stmt = $pdo->prepare("UPDATE admins SET full_name=?, username=?, password=? WHERE id=?");
                $stmt->execute([$fullName, $username, $hash, $admin['id']]);
            } else {
                $stmt = $pdo->prepare("UPDATE admins SET full_name=?, username=? WHERE id=?");
                $stmt->execute([$fullName, $username, $admin['id']]);
            }
            $msg = 'Account updated successfully.';
            $admin = current_admin();
        }
    }
}

$pageTitle = 'My Account';
$page = 'account';
require __DIR__ . '/header.php';
?>
<?php if ($msg): ?><div class="a-alert a-alert-ok"><?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="a-alert a-alert-error"><?= e($err) ?></div><?php endif; ?>

<div class="a-card">
  <h2 class="a-card-title">Account Details</h2>
  <form method="post">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
    <div class="a-field"><label>Full Name</label><input type="text" name="full_name" value="<?= e($admin['full_name']) ?>"></div>
    <div class="a-field"><label>Username</label><input type="text" name="username" value="<?= e($admin['username']) ?>" required></div>

    <h3 style="margin:24px 0 8px;font-size:16px;">Change Password</h3>
    <p class="a-help" style="margin-bottom:16px">Leave blank to keep your current password.</p>
    <div class="a-field"><label>Current Password</label><input type="password" name="current_password"></div>
    <div class="a-field"><label>New Password</label><input type="password" name="new_password"></div>
    <div class="a-field"><label>Confirm New Password</label><input type="password" name="confirm_password"></div>

    <button class="a-btn a-btn-primary">Update Account</button>
  </form>
</div>

<?php require __DIR__ . '/footer.php'; ?>
