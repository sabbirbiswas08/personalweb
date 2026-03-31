<?php
// admin/includes/auth.php

require_once __DIR__ . '/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Not logged in, redirect to login page
    header("Location: login.php");
    exit;
}
?>
