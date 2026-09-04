<?php
/**
 * Admin session bootstrap + guard.
 * Include at the top of every protected admin page.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once dirname(__DIR__) . '/includes/functions.php';

/* Page keys that belong to the single "Home Page" tab (sidebar highlight + tab bar) */
const HOMEPAGE_TABS = ['branding', 'hero', 'ticker', 'why', 'features_head', 'features', 'how', 'cta', 'footer'];

function require_login(): void
{
    if (empty($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit;
    }
}

function current_admin(): ?array
{
    global $pdo;
    if (empty($_SESSION['admin_id'])) {
        return null;
    }
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE id = ?");
    $stmt->execute([$_SESSION['admin_id']]);
    return $stmt->fetch() ?: null;
}

/* CSRF helpers */
function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}
function csrf_check(): bool
{
    return isset($_POST['csrf'], $_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $_POST['csrf']);
}
