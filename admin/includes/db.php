<?php
// admin/includes/db.php

require_once __DIR__ . '/../config.php';

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    // DO NOT output real errors in production
    die("Database Connection failed. Please check your credentials in config.php");
}

/**
 * Helper function to safely get dynamic site content
 */
function get_site_content($pdo, $key, $default = '') {
    $stmt = $pdo->prepare("SELECT content_value FROM site_content WHERE section_key = ?");
    $stmt->execute([$key]);
    $result = $stmt->fetch();
    return $result ? htmlspecialchars($result['content_value']) : htmlspecialchars($default);
}

/**
 * Helper function to safely get dynamic raw content (like image paths)
 */
function get_raw_content($pdo, $key, $default = '') {
    $stmt = $pdo->prepare("SELECT content_value FROM site_content WHERE section_key = ?");
    $stmt->execute([$key]);
    $result = $stmt->fetch();
    return $result ? $result['content_value'] : $default;
}
?>
