<?php
/**
 * Maintenance-mode gate — include at the very top of every public page,
 * right after functions.php. Renders the maintenance page and exits when
 * the site is in maintenance mode and the visitor isn't a logged-in admin.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (setting('maintenance_mode') === '1' && empty($_SESSION['admin_id'])) {
    http_response_code(503);
    header('Retry-After: 3600');
    $mTitle = setting('maintenance_title', 'We\'ll be right back');
    $mMsg   = setting('maintenance_message', 'We\'re currently performing scheduled maintenance. Please check back shortly.');
    $mBrand = setting('brand_name', 'Harvest');
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($mTitle) ?> — <?= e($mBrand) ?></title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,500;9..144,600&display=swap" rel="stylesheet">
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body {
    min-height: 100vh; display: flex; align-items: center; justify-content: center;
    background: #0f3d1e; color: #fff; font-family: 'Poppins', sans-serif; text-align: center; padding: 24px;
  }
  .m-box { max-width: 480px; }
  .m-brand { font-family: 'Fraunces', serif; font-size: 22px; font-weight: 600; margin-bottom: 28px; color: #f5b418; }
  h1 { font-family: 'Fraunces', serif; font-size: 32px; font-weight: 600; margin-bottom: 14px; }
  p { font-size: 15px; line-height: 1.6; color: #d7e2da; }
</style>
</head>
<body>
  <div class="m-box">
    <div class="m-brand"><?= e($mBrand) ?> Pro</div>
    <h1><?= e($mTitle) ?></h1>
    <p><?= nl2br_e($mMsg) ?></p>
  </div>
</body>
</html>
<?php
    exit;
}
