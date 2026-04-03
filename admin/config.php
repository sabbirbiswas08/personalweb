<?php
// admin/config.php
// CHANGE THESE CREDENTIALS WHEN YOU CREATE YOUR CPANEL DATABASE
define('DB_HOST', 'localhost');
define('DB_USER', 'sabbirbi_sabbir_dbuser'); // Change to your cPanel DB username
define('DB_PASS', 'J&qs&i]hywV5');     // Change to your cPanel DB password
define('DB_NAME', 'sabbirbi_sabbir_portfolio'); // Change to your cPanel DB name

// Start secure sessions
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 86400,
    'path' => '/',
    'domain' => '',
    'secure' => false, // Set to true if using HTTPS in cPanel
    'httponly' => true,
    'samesite' => 'Strict'
]);
// SMTP Configuration
define('SMTP_HOST', 'temp.sabbirbiswas.com');
define('SMTP_PORT', 465); // SSL
define('SMTP_USER', 'contact@temp.sabbirbiswas.com');
define('SMTP_PASS', 'nl+w-SW6jXKy'); // REAL PASSWORD UPDATED
define('SMTP_FROM', 'contact@temp.sabbirbiswas.com');

session_start();
?>
