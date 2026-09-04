<?php
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Only these pages may be the redirect target + anchor after submitting.
$redirects = [
    'index.php'   => '#demoForm',
    'contact.php' => '#contactForm',
];
$redirect = $redirects[$_POST['redirect'] ?? ''] ?? null;
$redirectPage = $redirect !== null ? $_POST['redirect'] : 'index.php';
$redirectAnchor = $redirect ?? '#demoForm';

// Newsletter subscription reuses the demo_requests table with a note
$isNewsletter = isset($_POST['newsletter']);

$name    = trim($_POST['name'] ?? '');
$company = trim($_POST['company'] ?? '');
$email   = trim($_POST['email'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$estates = trim($_POST['estates'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($isNewsletter) {
    $name    = 'Newsletter Subscriber';
    $message = 'Newsletter signup';
}

// Validation
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || ($name === '' && !$isNewsletter)) {
    header('Location: ' . $redirectPage . '?sent=0' . $redirectAnchor);
    exit;
}

try {
    $stmt = $pdo->prepare(
        "INSERT INTO demo_requests (name, company, email, phone, estates, message) VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->execute([$name, $company, $email, $phone, $estates, $message]);
    header('Location: ' . $redirectPage . '?sent=1' . $redirectAnchor);
} catch (Exception $e) {
    header('Location: ' . $redirectPage . '?sent=0' . $redirectAnchor);
}
exit;
