<?php
/**
 * Field definitions for each editable settings group + save/upload logic.
 * Each field: key => [label, type]
 *   type: text | textarea | image | list | checklist | credit
 */

function field_groups(): array
{
    return [
        'branding' => [
            'title'  => 'Branding',
            'fields' => [
                'brand_name'    => ['Brand Name', 'text'],
                'brand_tagline' => ['Tagline', 'text'],
            ],
        ],
        'ticker' => [
            'title'  => 'Ticker Strip',
            'fields' => [
                'ticker_items' => ['Ticker Items (separate each with a | )', 'list'],
            ],
        ],
        'why' => [
            'title'  => 'Why Section',
            'fields' => [
                'why_badge'        => ['Badge Text', 'text'],
                'why_checklist'    => ['Checklist (one per line, use bold|rest )', 'checklist'],
                'why_title_1'      => ['Heading (line 1)', 'text'],
                'why_title_2'      => ['Heading Accent (gold)', 'text'],
                'why_para_1'       => ['Paragraph 1', 'textarea'],
                'why_para_2'       => ['Paragraph 2', 'textarea'],
                'why_stat_number'  => ['Stat Number (e.g. 40%)', 'text'],
                'why_stat_label'   => ['Stat Label', 'text'],
                'why_btn_text'     => ['Button Text', 'text'],
                'why_btn_link'     => ['Button Link', 'text'],
                'why_image_1'      => ['Image 1 (top-right photo)', 'image'],
                'why_image_2'      => ['Image 2 (bottom-left photo)', 'image'],
            ],
        ],
        'features' => [
            'title'  => 'Features Heading',
            'fields' => [
                'features_badge'   => ['Badge Text', 'text'],
                'features_title_1' => ['Kicker (small line)', 'text'],
                'features_title_2' => ['Main Heading', 'textarea'],
            ],
        ],
        'how' => [
            'title'  => 'How It Helps',
            'fields' => [
                'how_badge'  => ['Badge Text', 'text'],
                'how_title'  => ['Heading', 'textarea'],
                'how_para_1' => ['Paragraph 1', 'textarea'],
                'how_para_2' => ['Paragraph 2', 'textarea'],
                'how_tags'   => ['Tags (separate each with a | )', 'list'],
            ],
        ],
        'cta' => [
            'title'  => 'Call To Action',
            'fields' => [
                'cta_kicker'    => ['Kicker Text', 'text'],
                'cta_title'     => ['Heading', 'textarea'],
                'cta_para'      => ['Paragraph', 'textarea'],
                'cta_btn1_text' => ['Primary Button Text', 'text'],
                'cta_btn1_link' => ['Primary Button Link', 'text'],
                'cta_btn2_text' => ['Secondary Button Text', 'text'],
                'cta_btn2_link' => ['Secondary Button Link', 'text'],
                'cta_bg_image'  => ['Background Image', 'image'],
            ],
        ],
        'maintenance' => [
            'title'  => 'Maintenance Mode',
            'fields' => [
                'maintenance_mode'    => ['Enable Maintenance Mode', 'checkbox'],
                'maintenance_title'   => ['Page Title', 'text'],
                'maintenance_message' => ['Message shown to visitors', 'textarea'],
            ],
        ],
        'settings_logo' => [
            'title'  => 'Logo',
            'fields' => [
                'brand_logo'       => ['Colour Logo', 'image'],
                'brand_logo_white' => ['White Logo (used on dark backgrounds, e.g. the hero navbar)', 'image'],
            ],
        ],
        'theme' => [
            'title'  => 'Colour Theme',
            'fields' => [
                'theme_primary_color' => ['Primary Colour', 'color'],
                'theme_accent_color'  => ['Accent Colour', 'color'],
            ],
        ],
        'seo' => [
            'title'  => 'Search Engine Visibility',
            'fields' => [
                'seo_title'       => ['Meta Title', 'text'],
                'seo_description' => ['Meta Description', 'textarea'],
                'seo_keywords'    => ['Meta Keywords (comma separated)', 'text'],
                'seo_noindex'     => ['Discourage search engines from indexing this site', 'checkbox'],
            ],
        ],
        'contact_banner' => [
            'title'  => 'Page Banner',
            'fields' => [
                'contact_title_1'      => ['Heading (line 1)', 'text'],
                'contact_title_2'      => ['Heading Accent (gold, line 2)', 'text'],
                'contact_subtitle'     => ['Sub-text', 'textarea'],
                'contact_banner_image' => ['Background Image', 'image'],
            ],
        ],
        'contact_form' => [
            'title'  => 'Request Form',
            'fields' => [
                'contact_form_title'    => ['Form Heading', 'text'],
                'contact_form_subtitle' => ['Form Sub-text', 'text'],
                'contact_form_note'     => ['Footnote below the button', 'text'],
            ],
        ],
        'contact_map' => [
            'title'  => 'Map',
            'fields' => [
                'contact_map' => ['Address or Google Maps Embed URL', 'text'],
            ],
        ],
        'about_banner' => [
            'title'  => 'Page Banner',
            'fields' => [
                'about_title'        => ['Heading (one line per row; wrap a word in **word** for the gold accent)', 'textarea'],
                'about_subtitle'     => ['Sub-text', 'textarea'],
                'about_banner_image' => ['Background Image', 'image'],
            ],
        ],
        'about_story' => [
            'title'  => 'About Story',
            'fields' => [
                'about_story_badge'   => ['Badge Text', 'text'],
                'about_story_title'   => ['Heading', 'text'],
                'about_story_para_1'  => ['Paragraph 1', 'textarea'],
                'about_story_para_2'  => ['Paragraph 2', 'textarea'],
                'about_story_para_3'  => ['Paragraph 3', 'textarea'],
                'about_vision_title'  => ['Vision Box Title', 'text'],
                'about_vision_text'   => ['Vision Box Text', 'textarea'],
                'about_mission_title' => ['Mission Box Title', 'text'],
                'about_mission_text'  => ['Mission Box Text', 'textarea'],
                'about_story_image'   => ['Photo', 'image'],
            ],
        ],
        'about_partners' => [
            'title'  => 'Development Partners',
            'fields' => [
                'about_partners_badge'  => ['Badge Text', 'text'],
                'about_partners_title'  => ['Heading (one line per row)', 'textarea'],
                'about_partner1_logo'   => ['Partner 1 Logo', 'image'],
                'about_partner1_name'   => ['Partner 1 Name', 'text'],
                'about_partner1_desc'   => ['Partner 1 Description', 'textarea'],
                'about_partner1_tags'   => ['Partner 1 Tags (separate each with a | )', 'list'],
                'about_partner2_logo'   => ['Partner 2 Logo', 'image'],
                'about_partner2_name'   => ['Partner 2 Name', 'text'],
                'about_partner2_desc'   => ['Partner 2 Description', 'textarea'],
                'about_partner2_tags'   => ['Partner 2 Tags (separate each with a | )', 'list'],
                'about_partners_footer' => ['Closing Line', 'textarea'],
            ],
        ],
        'about_why' => [
            'title'  => 'Why Choose',
            'fields' => [
                'about_why_badge' => ['Badge Text', 'text'],
                'about_why_title' => ['Heading', 'text'],
                'about_why_items' => ['Cards (one per line, use title|description )', 'checklist'],
            ],
        ],
        'about_cta' => [
            'title'  => 'Call To Action',
            'fields' => [
                'about_cta_kicker'    => ['Kicker Text', 'text'],
                'about_cta_title'     => ['Heading', 'textarea'],
                'about_cta_para'      => ['Paragraph', 'textarea'],
                'about_cta_btn1_text' => ['Primary Button Text', 'text'],
                'about_cta_btn1_link' => ['Primary Button Link', 'text'],
                'about_cta_btn2_text' => ['Secondary Button Text', 'text'],
                'about_cta_btn2_link' => ['Secondary Button Link', 'text'],
                'about_cta_bg_image'  => ['Background Image', 'image'],
            ],
        ],
        'footer' => [
            'title'  => 'Footer',
            'fields' => [
                'footer_about'     => ['About Text', 'textarea'],
                'footer_company'   => ['Company Name', 'text'],
                'footer_address'   => ['Address', 'textarea'],
                'footer_phone'     => ['Phone', 'text'],
                'footer_email'     => ['Email', 'text'],
                'footer_facebook'  => ['Facebook URL', 'text'],
                'footer_youtube'   => ['YouTube URL', 'text'],
                'footer_instagram' => ['Instagram URL', 'text'],
                'footer_linkedin'  => ['LinkedIn URL', 'text'],
                'footer_copyright' => ['Copyright Line', 'text'],
                'footer_credit'    => ['Credit Lines (one per line)', 'credit'],
            ],
        ],
    ];
}

/**
 * Handle an uploaded image file. Returns stored filename or null.
 */
function handle_upload(string $inputName): ?string
{
    if (empty($_FILES[$inputName]['name']) || $_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
    $ext = strtolower(pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed, true)) {
        return null;
    }
    if ($_FILES[$inputName]['size'] > 8 * 1024 * 1024) { // 8 MB cap
        return null;
    }
    if (!is_dir(UPLOAD_DIR)) {
        @mkdir(UPLOAD_DIR, 0755, true);
    }
    $filename = 'img_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    $dest = UPLOAD_DIR . $filename;
    if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $dest)) {
        return $filename;
    }
    return null;
}

/**
 * Persist a single setting key/value.
 */
function save_setting(PDO $pdo, string $key, string $value): void
{
    $stmt = $pdo->prepare(
        "INSERT INTO settings (setting_key, setting_value) VALUES (?, ?)
         ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
    );
    $stmt->execute([$key, $value]);
}

/**
 * Save one posted field, handling its type's upload/remove/validation rules.
 */
function save_field(PDO $pdo, string $key, string $type): void
{
    if ($type === 'image') {
        $uploaded = handle_upload($key);
        if ($uploaded !== null) {
            save_setting($pdo, $key, $uploaded);
        } elseif (!empty($_POST['remove_' . $key])) {
            save_setting($pdo, $key, '');
        }
        // else: keep existing value
    } elseif ($type === 'color') {
        if (!empty($_POST['remove_' . $key])) {
            save_setting($pdo, $key, '');
        } else {
            $val = $_POST[$key] ?? '';
            if (preg_match('/^#[0-9a-fA-F]{6}$/', $val)) {
                save_setting($pdo, $key, $val);
            }
        }
    } else {
        $val = $_POST[$key] ?? '';
        // Normalise CR/LF for textareas/lists
        $val = str_replace("\r\n", "\n", $val);
        save_setting($pdo, $key, trim($val));
    }
}

/**
 * Render one field's input markup for a given current value.
 */
function render_field(string $key, string $label, string $type, string $value): void
{
    ?>
    <div class="a-field">
      <label><?= e($label) ?></label>

      <?php if ($type === 'text'): ?>
        <input type="text" name="<?= e($key) ?>" value="<?= e($value) ?>">

      <?php elseif ($type === 'textarea' || $type === 'credit' || $type === 'checklist'): ?>
        <textarea name="<?= e($key) ?>" rows="<?= $type==='textarea'?5:4 ?>"><?= e($value) ?></textarea>
        <?php if ($type === 'checklist'): ?>
          <small class="a-help">One item per line. Text before the <code>|</code> shows in bold. Example: <code>Centralized|plantation management</code></small>
        <?php elseif ($type === 'credit'): ?>
          <small class="a-help">One credit line per line.</small>
        <?php endif; ?>

      <?php elseif ($type === 'list'): ?>
        <input type="text" name="<?= e($key) ?>" value="<?= e($value) ?>">
        <small class="a-help">Separate each item with a vertical bar <code>|</code></small>

      <?php elseif ($type === 'checkbox'): ?>
        <label class="a-check">
          <input type="checkbox" name="<?= e($key) ?>" value="1" <?= $value === '1' ? 'checked' : '' ?>>
          Enabled
        </label>

      <?php elseif ($type === 'color'): ?>
        <div class="a-color-field">
          <input type="color" name="<?= e($key) ?>" value="<?= e($value !== '' ? $value : '#1c6b34') ?>">
          <?php if ($value !== ''): ?>
            <label class="a-remove"><input type="checkbox" name="remove_<?= e($key) ?>" value="1"> Reset to default</label>
          <?php endif; ?>
        </div>

      <?php elseif ($type === 'image'): ?>
        <div class="a-image-field">
          <?php if ($value !== ''):
              $thumbUrl = preg_match('#^https?://#i', $value) ? $value : (UPLOAD_URL . ltrim($value, '/'));
          ?>
            <div class="a-thumb">
              <img src="<?= e($thumbUrl) ?>" alt="">
              <label class="a-remove"><input type="checkbox" name="remove_<?= e($key) ?>" value="1"> Remove</label>
            </div>
          <?php else: ?>
            <span class="a-noimg">No image uploaded yet.</span>
          <?php endif; ?>
          <input type="file" name="<?= e($key) ?>" accept="image/*">
          <small class="a-help">JPG, PNG, WEBP, GIF or SVG. Max 8 MB. Leave empty to keep the current image.</small>
        </div>
      <?php endif; ?>
    </div>
    <?php
}
