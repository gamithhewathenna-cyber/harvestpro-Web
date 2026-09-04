<?php
/**
 * =====================================================================
 *  Harvest Pro - Database Configuration
 * ---------------------------------------------------------------------
 *  Edit the four values below with the database details you created
 *  inside your cPanel  ( MySQL Databases  ->  create DB + user ).
 * =====================================================================
 */

define('DB_HOST', 'localhost');          // Almost always 'localhost' on cPanel
define('DB_NAME', 'dispdrvg_harvestprowebsite');
define('DB_USER', 'dispdrvg_harvestprowebsite-admin');
define('DB_PASS', 'duwNHS%H2)ZWl}NP');

// ---------------------------------------------------------------------
//  Site URL helper (auto-detected, no need to edit in most cases)
// ---------------------------------------------------------------------
$scheme   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
$basePath = rtrim(str_replace('\\', '/', dirname(dirname($_SERVER['SCRIPT_NAME'] ?? ''))), '/');
// If the site is inside a subfolder, the admin panel sits one level deeper,
// so we normalise the base path for both front-end and admin.
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
if (basename($scriptDir) === 'admin') {
    $scriptDir = dirname($scriptDir);
}
define('BASE_URL', $scheme . '://' . $host . rtrim($scriptDir, '/'));

// Absolute filesystem path to the /uploads directory
define('UPLOAD_DIR', dirname(__DIR__) . '/uploads/');
define('UPLOAD_URL', BASE_URL . '/uploads/');

// ---------------------------------------------------------------------
//  Establish PDO connection
// ---------------------------------------------------------------------
try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die('Database connection failed. Please check includes/config.php. ');
}
