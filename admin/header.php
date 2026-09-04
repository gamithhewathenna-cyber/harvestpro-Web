<?php
require_once __DIR__ . '/auth.php';
require_login();
require_once __DIR__ . '/icons.php';
$admin = current_admin();
$page  = $page ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($pageTitle) ? e($pageTitle) . ' — ' : '' ?>Harvest Pro Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/admin.css">
</head>
<body>
<div class="a-layout">
  <aside class="a-sidebar" id="aSidebar">
    <div class="a-logo">Harvest<span>Pro</span></div>
    <nav class="a-nav">
      <a href="index.php" class="<?= $page==='dashboard'?'active':'' ?>"><?= admin_icon('dashboard') ?> Dashboard</a>
      <p class="a-nav-label">Content</p>
      <a href="section.php?g=branding" class="<?= in_array($page, HOMEPAGE_TABS, true)?'active':'' ?>"><?= admin_icon('home') ?> Home Page</a>
      <p class="a-nav-label">Manage</p>
      <a href="section.php?g=settings_logo" class="<?= in_array($page, SETTINGS_TABS, true)?'active':'' ?>"><?= admin_icon('settings') ?> Settings</a>
      <a href="section.php?g=maintenance" class="<?= $page==='maintenance'?'active':'' ?>"><?= admin_icon('wrench') ?> Maintenance Mode</a>
      <a href="requests.php" class="<?= $page==='requests'?'active':'' ?>"><?= admin_icon('inbox') ?> Demo Requests</a>
      <a href="account.php" class="<?= $page==='account'?'active':'' ?>"><?= admin_icon('user') ?> My Account</a>
    </nav>
  </aside>

  <div class="a-main">
    <header class="a-topbar">
      <button class="a-burger" id="aBurger" aria-label="Menu"><?= admin_icon('menu', 20) ?></button>
      <h1><?= e($pageTitle ?? 'Dashboard') ?></h1>
      <div class="a-top-right">
        <a href="../index.php" target="_blank" class="a-view-site"><?= admin_icon('external', 16) ?> View Site</a>
        <span class="a-user-chip">
          <span class="a-user-avatar"><?= e(strtoupper(substr($admin['full_name'] ?: $admin['username'], 0, 1))) ?></span>
          <span class="a-user"><?= e($admin['full_name'] ?: $admin['username']) ?></span>
        </span>
        <a href="logout.php" class="a-logout"><?= admin_icon('logout', 16) ?></a>
      </div>
    </header>
    <main class="a-content">
