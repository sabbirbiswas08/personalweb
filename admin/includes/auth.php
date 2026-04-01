<?php
// admin/includes/auth.php

require_once __DIR__ . '/db.php';

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['admin_id'])) {
    // Not logged in, redirect to login page
    header("Location: login.php");
    exit;
}
?>
