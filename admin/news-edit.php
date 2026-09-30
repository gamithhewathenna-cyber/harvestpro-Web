<?php
require_once __DIR__ . '/auth.php';
require_login();
require_once __DIR__ . '/fields.php'; // handle_upload()
ensure_news_tables();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$post = null;
if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM news_posts WHERE id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch();
    if (!$post) {
        header('Location: news.php');
        exit;
    }
}

$err  = '';
$warn = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $err = 'Security token mismatch.';
    } else {
        $title             = trim($_POST['title'] ?? '');
        $content           = str_replace("\r\n", "\n", trim($_POST['content'] ?? ''));
        $categoryId        = !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null;
        $seoTitle          = trim($_POST['seo_title'] ?? '');
        $seoDescription    = trim($_POST['seo_description'] ?? '');
        $seoKeyword        = trim($_POST['seo_keyword'] ?? '');
        $seoKeywordsSecond = trim($_POST['seo_keywords_secondary'] ?? '');
        $slugInput         = trim($_POST['slug'] ?? '');
        $isPublished       = isset($_POST['is_published']) ? 1 : 0;

        // Uploading a Word doc replaces whatever's in the Content box with
        // its extracted text. Non-blocking on failure — the post still
        // saves with whatever was already typed, just with a warning.
        if (!empty($_FILES['content_docx']['name']) && $_FILES['content_docx']['error'] === UPLOAD_ERR_OK) {
            $docxExt = strtolower(pathinfo($_FILES['content_docx']['name'], PATHINFO_EXTENSION));
            if ($docxExt !== 'docx') {
                $warn = 'The content file must be a .docx Word document — it was not imported.';
            } elseif ($_FILES['content_docx']['size'] > 15 * 1024 * 1024) {
                $warn = 'That Word document is over the 15 MB limit — it was not imported.';
            } else {
                $extracted = docx_to_text($_FILES['content_docx']['tmp_name']);
                if ($extracted === null || $extracted === '') {
                    $warn = 'Could not read that Word document — it was not imported.';
                } else {
                    $content = $extracted;
                }
            }
        }

        if ($title === '') {
            $err = 'Post title is required.';
        } else {
            $uploaded = handle_upload('featured_image');
            $baseSlug = news_slugify($slugInput !== '' ? $slugInput : $title);

            if ($post) {
                $slug = news_unique_slug('news_posts', $baseSlug, $post['id']);
                // Existing post: only touch published_at the moment it first goes live.
                $publishedAt = $post['published_at'];
                if ($isPublished && !$publishedAt) {
                    $publishedAt = date('Y-m-d H:i:s');
                }
                $imageSql = '';
                $params = [$title, $slug, $content, $categoryId, $seoTitle, $seoDescription, $seoKeyword, $seoKeywordsSecond, $isPublished, $publishedAt];
                if ($uploaded !== null) {
                    $imageSql = 'featured_image = ?, ';
                    $params[] = $uploaded;
                } elseif (!empty($_POST['remove_image'])) {
                    $imageSql = 'featured_image = ?, ';
                    $params[] = '';
                }
                $params[] = $post['id'];
                $stmt = $pdo->prepare(
                    "UPDATE news_posts SET title=?, slug=?, content=?, category_id=?, seo_title=?, seo_description=?, seo_keyword=?, seo_keywords_secondary=?, is_published=?, published_at=?, {$imageSql}updated_at=NOW() WHERE id=?"
                );
                $stmt->execute($params);
                header('Location: news-edit.php?id=' . $post['id'] . '&saved=1' . ($warn !== '' ? '&warn=' . urlencode($warn) : ''));
                exit;
            } else {
                $slug = news_unique_slug('news_posts', $baseSlug);
                $publishedAt = $isPublished ? date('Y-m-d H:i:s') : null;
                $stmt = $pdo->prepare(
                    "INSERT INTO news_posts (title, slug, content, featured_image, category_id, seo_title, seo_description, seo_keyword, seo_keywords_secondary, is_published, published_at)
                     VALUES (?,?,?,?,?,?,?,?,?,?,?)"
                );
                $stmt->execute([$title, $slug, $content, $uploaded ?? '', $categoryId, $seoTitle, $seoDescription, $seoKeyword, $seoKeywordsSecond, $isPublished, $publishedAt]);
                $newId = (int)$pdo->lastInsertId();
                header('Location: news-edit.php?id=' . $newId . '&saved=1' . ($warn !== '' ? '&warn=' . urlencode($warn) : ''));
                exit;
            }
        }
    }
}

$categories = get_news_categories();

$pageTitle = $post ? 'Edit Post' : 'New Post';
$page = 'news_edit';
require __DIR__ . '/header.php';
?>
<?php if (!empty($_GET['saved'])): ?><div class="a-alert a-alert-ok">Post saved.</div><?php endif; ?>
<?php if ($err): ?><div class="a-alert a-alert-error"><?= e($err) ?></div><?php endif; ?>
<?php if ($warn !== '' || !empty($_GET['warn'])): ?><div class="a-alert a-alert-error"><?= e($warn !== '' ? $warn : $_GET['warn']) ?></div><?php endif; ?>

<p class="a-help" style="margin-bottom:18px;"><a href="news.php">&larr; Back to all posts</a></p>

<div class="a-card">
  <h2 class="a-card-title"><?= $post ? 'Edit Post' : 'New Post' ?></h2>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">

    <div class="a-field">
      <label>Post Title</label>
      <input type="text" name="title" value="<?= e($post['title'] ?? '') ?>" required>
    </div>

    <div class="a-field">
      <label>URL Slug</label>
      <input type="text" name="slug" value="<?= e($post['slug'] ?? '') ?>" placeholder="auto-generated from the title if left blank">
      <small class="a-help">Shown in the address bar as <code>/news/<?= e($post['slug'] ?? 'your-slug-here') ?></code>. Leave blank to auto-generate from the title.</small>
    </div>

    <div class="a-field">
      <label>Post Content / Description</label>
      <textarea name="content" rows="14"><?= e($post['content'] ?? '') ?></textarea>
      <small class="a-help">Leave a blank line between paragraphs.</small>
    </div>

    <div class="a-field">
      <label>Or Upload a Word Document (.docx)</label>
      <input type="file" name="content_docx" accept=".docx">
      <small class="a-help">Its text will replace whatever's in the Content box above when you click Save — only the text and paragraph breaks are imported, not formatting like bold, tables or images. Max 15 MB.</small>
    </div>

    <div class="a-field">
      <label>Featured Image</label>
      <div class="a-image-field">
        <?php if (!empty($post['featured_image'])): ?>
          <div class="a-thumb">
            <img src="<?= e(resolve_image_url($post['featured_image'])) ?>" alt="">
            <label class="a-remove"><input type="checkbox" name="remove_image" value="1"> Remove</label>
          </div>
        <?php else: ?>
          <span class="a-noimg">No image uploaded yet.</span>
        <?php endif; ?>
        <input type="file" name="featured_image" accept="image/*">
        <small class="a-help">JPG, PNG, WEBP, GIF or SVG. Max 15 MB.</small>
      </div>
    </div>

    <div class="a-field">
      <label>Category</label>
      <select name="category_id">
        <option value="">— None —</option>
        <?php foreach ($categories as $c): ?>
          <option value="<?= (int)$c['id'] ?>" <?= (!empty($post['category_id']) && (int)$post['category_id'] === (int)$c['id']) ? 'selected' : '' ?>><?= e($c['name']) ?></option>
        <?php endforeach; ?>
      </select>
      <small class="a-help">Need a new one? <a href="news-categories.php">Manage categories</a> — it'll show up here once added.</small>
    </div>

    <div class="a-field">
      <label>SEO Title</label>
      <input type="text" name="seo_title" value="<?= e($post['seo_title'] ?? '') ?>" placeholder="<?= e($post['title'] ?? '') ?>">
    </div>
    <div class="a-field">
      <label>SEO Meta Description</label>
      <textarea name="seo_description" rows="2"><?= e($post['seo_description'] ?? '') ?></textarea>
    </div>
    <div class="a-field">
      <label>Primary Keyword</label>
      <input type="text" name="seo_keyword" value="<?= e($post['seo_keyword'] ?? '') ?>">
    </div>
    <div class="a-field">
      <label>Secondary Keywords</label>
      <input type="text" name="seo_keywords_secondary" value="<?= e($post['seo_keywords_secondary'] ?? '') ?>" placeholder="separate each with a comma">
    </div>

    <div class="a-field">
      <label class="a-check">
        <input type="checkbox" name="is_published" value="1" <?= !empty($post['is_published']) ? 'checked' : '' ?>>
        Published (visible on the public News &amp; Updates page)
      </label>
    </div>

    <div class="a-actions">
      <button class="a-btn a-btn-primary" type="submit">Save Post</button>
    </div>
  </form>
</div>

<?php if ($post): ?>
<div class="a-card">
  <form method="post" action="news.php" onsubmit="return confirm('Delete this post? This cannot be undone.');">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="id" value="<?= (int)$post['id'] ?>">
    <button class="a-btn a-btn-danger" type="submit"><?= admin_icon('trash', 16) ?> Delete Post</button>
  </form>
</div>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?>
