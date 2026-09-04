<?php
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Newsletter subscription reuses the demo_requests table with a note
$isNewsletter = isset($_POST['newsletter']);

$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($isNewsletter) {
    $name    = 'Newsletter Subscriber';
    $message = 'Newsletter signup';
}

// Validation
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || ($name === '' && !$isNewsletter)) {
    header('Location: index.php?sent=0#demoForm');
    exit;
}

try {
    $stmt = $pdo->prepare(
        "INSERT INTO demo_requests (name, email, phone, message) VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([$name, $email, $phone, $message]);
    header('Location: index.php?sent=1#demoForm');
} catch (Exception $e) {
    header('Location: index.php?sent=0#demoForm');
}
exit;
