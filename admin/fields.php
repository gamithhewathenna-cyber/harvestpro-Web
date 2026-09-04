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
                'brand_logo'    => ['Logo Image', 'image'],
            ],
        ],
        'hero' => [
            'title'  => 'Hero Section',
            'fields' => [
                'hero_title'           => ['Headline', 'textarea'],
                'hero_subtitle'        => ['Sub-text', 'textarea'],
                'hero_btn1_text'       => ['Primary Button Text', 'text'],
                'hero_btn1_link'       => ['Primary Button Link', 'text'],
                'hero_btn2_text'       => ['Secondary Button Text', 'text'],
                'hero_btn2_link'       => ['Secondary Button Link', 'text'],
                'hero_bg_image'        => ['Background Image', 'image'],
                'hero_dashboard_image' => ['Dashboard Screenshot', 'image'],
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
