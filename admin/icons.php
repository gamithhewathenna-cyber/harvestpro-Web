<?php
/**
 * Small inline-SVG icon set for the admin panel (no external icon library).
 * Icons inherit color via currentColor, so they follow link/text color and state.
 */
function admin_icon(string $name, int $size = 18): string
{
    $shapes = [
        'dashboard' => '<rect x="2.5" y="2.5" width="6.5" height="6.5" rx="1.5"/><rect x="11" y="2.5" width="6.5" height="6.5" rx="1.5"/><rect x="2.5" y="11" width="6.5" height="6.5" rx="1.5"/><rect x="11" y="11" width="6.5" height="6.5" rx="1.5"/>',
        'home'      => '<polyline points="3,10 10,3.5 17,10"/><path d="M5,8.5 V17 H15 V8.5"/><line x1="8" y1="17" x2="8" y2="12.5"/><line x1="12" y1="17" x2="12" y2="12.5"/>',
        'wrench'    => '<polygon points="10,3 18,17 2,17"/><line x1="10" y1="8" x2="10" y2="11.8"/><circle cx="10" cy="14.3" r="0.9" fill="currentColor" stroke="none"/>',
        'inbox'     => '<rect x="2" y="4.5" width="16" height="11.5" rx="1.5"/><polyline points="2.3,5 10,11.5 17.7,5"/>',
        'user'      => '<circle cx="10" cy="6.7" r="3.1"/><path d="M4 17.5a6 6 0 0 1 12 0"/>',
        'logout'    => '<path d="M8 3H4v14h4"/><polyline points="12,6 16,10 12,14"/><line x1="16" y1="10" x2="7" y2="10"/>',
        'external'  => '<rect x="3" y="6" width="11" height="11" rx="1.5"/><polyline points="9,3 17,3 17,11"/><line x1="17" y1="3" x2="9" y2="11"/>',
        'menu'      => '<line x1="3" y1="6" x2="17" y2="6"/><line x1="3" y1="10" x2="17" y2="10"/><line x1="3" y1="14" x2="17" y2="14"/>',
        'layers'    => '<rect x="3" y="3.5" width="14" height="4.5" rx="1.2"/><rect x="3" y="12" width="14" height="4.5" rx="1.2"/>',
        'file'      => '<rect x="4" y="2" width="12" height="16" rx="1.5"/><line x1="7" y1="6.5" x2="13" y2="6.5"/><line x1="7" y1="10" x2="13" y2="10"/><line x1="7" y1="13.5" x2="10.5" y2="13.5"/>',
        'plus'      => '<line x1="10" y1="3.5" x2="10" y2="16.5"/><line x1="3.5" y1="10" x2="16.5" y2="10"/>',
        'trash'     => '<polyline points="3,5.5 17,5.5"/><path d="M7 5.5V4a1.5 1.5 0 0 1 1.5-1.5h3A1.5 1.5 0 0 1 13 4v1.5"/><path d="M5.5 5.5 6.2 17a1.2 1.2 0 0 0 1.2 1h5.2a1.2 1.2 0 0 0 1.2-1l0.7-11.5"/>',
    ];
    if (!isset($shapes[$name])) {
        return '';
    }
    return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 20 20" fill="none" stroke="currentColor" '
        . 'stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="a-icon" aria-hidden="true">'
        . $shapes[$name] . '</svg>';
}
