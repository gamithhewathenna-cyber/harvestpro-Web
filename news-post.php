<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/maintenance-gate.php';

$slug = trim($_GET['slug'] ?? '');
$post = $slug !== '' ? get_news_post_by_slug($slug) : null;

if (!$post) {
    http_response_code(404);
}

$brandName    = setting('brand_name', 'Harvest');
$brandLogo    = setting('brand_logo', '');
$brandLogoUrl = $brandLogo ? image_url('brand_logo') : '';
$faviconUrl   = image_url('favicon');
$brandLogoWhite  = setting('brand_logo_white', '');
$brandLogoNavUrl = $brandLogoWhite ? image_url('brand_logo_white') : $brandLogoUrl;

$themePrimary = setting('theme_primary_color', '');
$themeAccent  = setting('theme_accent_color', '');
$ctaBg        = image_url('cta_bg_image', 'assets/images/cta-bg.jpg');

$postImg = $post && $post['featured_image'] ? resolve_image_url($post['featured_image']) : $ctaBg;

$pageTitle = $post ? (($post['seo_title'] ?: $post['title']) . ' — ' . $brandName . ' Pro') : ('Post Not Found — ' . $brandName . ' Pro');
$pageDesc  = $post ? ($post['seo_description'] ?: news_excerpt($post['content'], 160)) : 'This post could not be found.';
$pageImg   = absolute_url($postImg);
$pageKeywords = $post ? trim(($post['seo_keyword'] ?? '') . (!empty($post['seo_keyword']) && !empty($post['seo_keywords_secondary']) ? ', ' : '') . ($post['seo_keywords_secondary'] ?? ''), ', ') : '';

$recentPosts = $post ? get_news_posts(['published_only' => true, 'exclude_id' => $post['id'], 'limit' => 5]) : [];
$shareUrl   = $post ? rawurlencode(absolute_url('/news/' . $post['slug'])) : '';
$shareTitle = $post ? rawurlencode($post['title']) : '';
?>
<!DOCTYPE html>
<html lang="<?= e(current_lang()) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if ($faviconUrl !== ''): ?><link rel="icon" href="<?= e($faviconUrl) ?>"><?php endif; ?>
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDesc) ?>">
<?php if ($pageKeywords !== ''): ?>
<meta name="keywords" content="<?= e($pageKeywords) ?>">
<?php endif; ?>
<?php if ($post): seo_meta_tags('/news/' . $post['slug'], $pageTitle, $pageDesc, $pageImg, $brandName . ' Pro'); endif; ?>
<?php sinhala_font_tags(); ?>
<link rel="stylesheet" href="/assets/css/style.css?v=6.2">
<?php if ($themePrimary !== '' || $themeAccent !== ''): ?>
<style>
:root {
<?php if ($themePrimary !== ''): ?>
  --green-900: color-mix(in srgb, <?= e($themePrimary) ?> 65%, black);
  --green-800: color-mix(in srgb, <?= e($themePrimary) ?> 80%, black);
  --green-700: color-mix(in srgb, <?= e($themePrimary) ?> 92%, black);
  --green-600: <?= e($themePrimary) ?>;
  --green-500: color-mix(in srgb, <?= e($themePrimary) ?> 82%, white);
  --green-050: color-mix(in srgb, <?= e($themePrimary) ?> 8%, white);
<?php endif; ?>
<?php if ($themeAccent !== ''): ?>
  --gold: <?= e($themeAccent) ?>;
  --gold-soft: color-mix(in srgb, <?= e($themeAccent) ?> 85%, white);
<?php endif; ?>
}
</style>
<?php endif; ?>
</head>
<body>

<?php $activeNav = ''; require __DIR__ . '/includes/site-nav.php'; ?>

<?php if (!$post): ?>

  <section class="section" style="padding-top:160px;">
    <div class="container policy-content" style="text-align:center;">
      <h1>Post Not Found</h1>
      <p>This post may have been removed or is no longer published.</p>
      <p style="margin-top:20px;"><a href="/news" class="btn btn-primary">&larr; Back to News &amp; Updates</a></p>
    </div>
  </section>

<?php else: ?>

  <header class="page-banner" style="background-image:linear-gradient(rgba(10,20,12,.55),rgba(10,20,12,.7)),url('<?= e($postImg) ?>');">
    <div class="container">
      <div class="page-banner-inner" style="max-width:760px;">
        <?php if ($post['category_name']): ?><span class="news-post-cat"><?= e($post['category_name']) ?></span><?php endif; ?>
        <h1><?= e($post['title']) ?></h1>
        <?php if ($post['published_at']): ?><p><?= e(date('j F Y', strtotime($post['published_at']))) ?></p><?php endif; ?>
      </div>
    </div>
  </header>

  <section class="section">
    <div class="container">
      <div class="news-post-layout">
        <div class="news-post-main news-post-content">
          <p style="margin-bottom:28px;"><a href="/news">&larr; Back to News &amp; Updates</a></p>
          <?= news_render_content($post['content']) ?>
        </div>

        <aside class="news-post-sidebar">
          <div class="news-sidebar-card">
            <h4>Share This Post</h4>
            <div class="socials">
              <a href="https://www.facebook.com/sharer/sharer.php?u=<?= e($shareUrl) ?>" class="social" target="_blank" rel="noopener" aria-label="Share on Facebook">
                <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M13 22v-9h3l.5-3.5H13V7.5c0-1 .3-1.7 1.8-1.7H16.6V2.6C16.3 2.6 15.2 2.5 14 2.5c-2.6 0-4.3 1.6-4.3 4.5v2.5H7v3.5h2.7V22H13Z"/></svg>
              </a>
              <a href="https://twitter.com/intent/tweet?url=<?= e($shareUrl) ?>&text=<?= e($shareTitle) ?>" class="social" target="_blank" rel="noopener" aria-label="Share on X">
                <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M18.9 3H21.6L15.7 10.1L22.6 21H16.9L12.6 14.8L7.7 21H5L11.3 13.4L4.6 3H10.5L14.4 8.7L18.9 3ZM17.9 19.2H19.5L9.4 4.7H7.7L17.9 19.2Z"/></svg>
              </a>
              <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= e($shareUrl) ?>" class="social" target="_blank" rel="noopener" aria-label="Share on LinkedIn">
                <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M6.94 8.5H3.56V20.5H6.94V8.5ZM5.25 3C4.01 3 3 4 3 5.25C3 6.49 4.01 7.5 5.25 7.5C6.49 7.5 7.5 6.49 7.5 5.25C7.5 4 6.49 3 5.25 3ZM20.5 20.5H17.13V14.6C17.13 13.2 17.1 11.4 15.17 11.4C13.21 11.4 12.91 12.92 12.91 14.5V20.5H9.53V8.5H12.77V10H12.82C13.28 9.13 14.4 8.21 16.07 8.21C19.49 8.21 20.5 10.44 20.5 13.9V20.5Z"/></svg>
              </a>
              <a href="https://wa.me/?text=<?= e($shareTitle) ?>%20<?= e($shareUrl) ?>" class="social" target="_blank" rel="noopener" aria-label="Share on WhatsApp">
                <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12c0 1.85.5 3.58 1.35 5.07L2 22l5.05-1.32A9.94 9.94 0 0 0 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2Zm5.2 14.3c-.22.6-1.3 1.15-1.8 1.2-.46.05-1.03.07-1.66-.1-.38-.1-.87-.28-1.5-.55-2.63-1.14-4.35-3.8-4.48-3.98-.13-.18-1.07-1.42-1.07-2.72s.68-1.93.92-2.2c.24-.26.53-.33.7-.33h.5c.16 0 .38-.06.6.46.22.53.75 1.83.82 1.96.07.13.11.29.02.47-.09.18-.14.29-.27.44-.13.16-.28.35-.4.47-.13.13-.27.27-.12.53.16.27.7 1.15 1.5 1.86 1.03.92 1.9 1.2 2.17 1.34.27.13.43.11.59-.07.16-.18.67-.78.85-1.05.18-.27.36-.22.6-.13.25.09 1.58.75 1.85.88.27.13.45.2.51.31.07.11.07.65-.15 1.25Z"/></svg>
              </a>
            </div>
          </div>

          <?php if ($recentPosts): ?>
            <div class="news-sidebar-card">
              <h4>Recent Posts</h4>
              <ul class="news-recent-list">
                <?php foreach ($recentPosts as $rp): ?>
                  <li>
                    <a href="/news/<?= e($rp['slug']) ?>" class="news-recent-item">
                      <?php $rpImg = $rp['featured_image'] ? resolve_image_url($rp['featured_image']) : ''; ?>
                      <span class="news-recent-thumb"<?= $rpImg ? " style=\"background-image:url('" . e($rpImg) . "')\"" : '' ?>></span>
                      <span class="news-recent-info">
                        <span class="news-recent-title"><?= e($rp['title']) ?></span>
                        <?php if ($rp['published_at']): ?><span class="news-recent-date"><?= e(date('j M Y', strtotime($rp['published_at']))) ?></span><?php endif; ?>
                      </span>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
        </aside>
      </div>
    </div>
  </section>

  <!-- ============================= CTA ============================= -->
  <section class="cta" data-bg="linear-gradient(rgba(15,30,18,.72),rgba(15,30,18,.55)),url('<?= e($ctaBg) ?>')">
    <div class="container">
      <div class="cta-inner">
        <p class="cta-kicker"><?= e(setting('cta_kicker')) ?></p>
        <h2 class="cta-title"><?= e(setting('cta_title')) ?></h2>
        <p class="cta-para"><?= e(setting('cta_para')) ?></p>
        <div class="cta-btns">
          <a href="<?= e(setting('cta_btn1_link', '/contact')) ?>" class="btn btn-primary"><?= e(setting('cta_btn1_text')) ?></a>
          <a href="<?= e(setting('cta_btn2_link', '/contact')) ?>" class="btn btn-text light"><?= e(setting('cta_btn2_text')) ?> <span>&rarr;</span></a>
        </div>
      </div>
    </div>
  </section>

<?php endif; ?>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
