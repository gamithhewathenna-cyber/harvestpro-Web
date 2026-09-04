<?php
require_once __DIR__ . '/auth.php';
require_login();
$admin = current_admin();
$page  = $page ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($pageTitle) ? e($pageTitle) . ' — ' : '' ?>Harvest Pro Admin</title>
<link rel="stylesheet" href="assets/admin.css">
</head>
<body>
<div class="a-layout">
  <aside class="a-sidebar" id="aSidebar">
    <div class="a-logo">Harvest<span>Pro</span></div>
    <nav class="a-nav">
      <a href="index.php"          class="<?= $page==='dashboard'?'active':'' ?>">Dashboard</a>
      <p class="a-nav-label">Home Page Content</p>
      <a href="section.php?g=branding" class="<?= $page==='branding'?'active':'' ?>">Branding</a>
      <a href="section.php?g=hero"     class="<?= $page==='hero'?'active':'' ?>">Hero Section</a>
      <a href="section.php?g=ticker"   class="<?= $page==='ticker'?'active':'' ?>">Ticker Strip</a>
      <a href="section.php?g=why"      class="<?= $page==='why'?'active':'' ?>">Why Section</a>
      <a href="section.php?g=features" class="<?= $page==='features_head'?'active':'' ?>">Features Heading</a>
      <a href="features.php"           class="<?= $page==='features'?'active':'' ?>">Feature Cards</a>
      <a href="section.php?g=how"      class="<?= $page==='how'?'active':'' ?>">How It Helps</a>
      <a href="section.php?g=cta"      class="<?= $page==='cta'?'active':'' ?>">Call To Action</a>
      <a href="section.php?g=footer"   class="<?= $page==='footer'?'active':'' ?>">Footer</a>
      <p class="a-nav-label">Manage</p>
      <a href="section.php?g=maintenance" class="<?= $page==='maintenance'?'active':'' ?>">Maintenance Mode</a>
      <a href="requests.php"           class="<?= $page==='requests'?'active':'' ?>">Demo Requests</a>
      <a href="account.php"            class="<?= $page==='account'?'active':'' ?>">My Account</a>
    </nav>
  </aside>

  <div class="a-main">
    <header class="a-topbar">
      <button class="a-burger" id="aBurger" aria-label="Menu">&#9776;</button>
      <h1><?= e($pageTitle ?? 'Dashboard') ?></h1>
      <div class="a-top-right">
        <a href="../index.php" target="_blank" class="a-view-site">View Site &rarr;</a>
        <span class="a-user"><?= e($admin['full_name'] ?: $admin['username']) ?></span>
        <a href="logout.php" class="a-logout">Logout</a>
      </div>
    </header>
    <main class="a-content">
