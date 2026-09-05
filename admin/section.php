<?php
require_once __DIR__ . '/auth.php';
require_login();
require_once __DIR__ . '/fields.php';

$groups = field_groups();

/* Home Page, About Page, Contact Page and Features Page content groups all
   route through this page (each with its own tab bar). Settings lives on its
   own scrolling page. */
$pageMap = [
  'branding' => 'branding', 'ticker' => 'ticker',
  'why' => 'why', 'features' => 'features_head', 'how' => 'how',
  'cta' => 'cta', 'footer' => 'footer',
  'about_banner' => 'about_banner', 'about_story' => 'about_story',
  'about_partners' => 'about_partners', 'about_why' => 'about_why', 'about_cta' => 'about_cta',
  'contact_banner' => 'contact_banner', 'contact_form' => 'contact_form', 'contact_map' => 'contact_map',
  'features_banner' => 'features_banner',
];

$g = $_GET['g'] ?? 'hero';
if (!isset($groups[$g]) || !isset($pageMap[$g])) {
    header('Location: index.php');
    exit;
}
$group  = $groups[$g];
$fields = $group['fields'];
$saved  = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $errors[] = 'Security token mismatch. Please retry.';
    } else {
        foreach ($fields as $key => [$label, $type]) {
            save_field($pdo, $key, $type);
        }
        $saved = true;
    }
}

// Refresh cached settings after save
$pageTitle = $group['title'];
$page = $pageMap[$g] ?? '';

// Re-query fresh values (bypass static cache)
$fresh = [];
$rows = $pdo->query("SELECT setting_key, setting_value FROM settings")->fetchAll();
foreach ($rows as $r) { $fresh[$r['setting_key']] = $r['setting_value']; }

require __DIR__ . '/header.php';
if (in_array($page, HOMEPAGE_TABS, true)) {
    require __DIR__ . '/homepage-tabs.php';
} elseif (in_array($page, ABOUT_TABS, true)) {
    require __DIR__ . '/about-tabs.php';
} elseif (in_array($page, CONTACT_TABS, true)) {
    require __DIR__ . '/contact-tabs.php';
} elseif (in_array($page, FEATURES_PAGE_TABS, true)) {
    require __DIR__ . '/features-tabs.php';
}
?>

<?php if ($saved): ?><div class="a-alert a-alert-ok">Changes saved successfully.</div><?php endif; ?>
<?php foreach ($errors as $er): ?><div class="a-alert a-alert-error"><?= e($er) ?></div><?php endforeach; ?>

<form method="post" enctype="multipart/form-data" class="a-card">
  <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">

  <?php foreach ($fields as $key => [$label, $type]): ?>
    <?php render_field($key, $label, $type, $fresh[$key] ?? ''); ?>
    <?php if ($key === 'contact_map'): ?>
      <p class="a-help" style="margin-top:-10px;margin-bottom:18px;">Paste a plain address (it will be geocoded automatically) or a full embed URL from Google Maps' own "Share &rarr; Embed a map" tool.</p>
    <?php endif; ?>
    <?php if ($key === 'google_site_verification'): ?>
      <p class="a-help" style="margin-top:-10px;margin-bottom:18px;">From Google Search Console's HTML tag verification method, paste only the code — the value of the <code>content="..."</code> attribute, not the whole <code>&lt;meta&gt;</code> tag.</p>
    <?php endif; ?>
  <?php endforeach; ?>

  <button type="submit" class="a-btn a-btn-primary">Save Changes</button>
</form>

<?php require __DIR__ . '/footer.php'; ?>
