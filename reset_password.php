<?php
require_once __DIR__ . '/admin/includes/db.php';

// Generate correct secure hash for "password123"
$new_hash = password_hash('password123', PASSWORD_DEFAULT);

// Update database
$stmt = $pdo->prepare("UPDATE admin_users SET password_hash = ? WHERE username = 'admin'");
if ($stmt->execute([$new_hash])) {
    echo "<h1>PASSWORD RESET SUCCESFUL!</h1>";
    echo "<p>Your password has been successfully fixed and is now set to <strong>password123</strong>.</p>";
    echo "<a href='admin/login.php'>Click here to Login</a>";
    
    // Attempt automatic cleanup of this file for security
    @unlink(__FILE__);
} else {
    echo "<h1>DATABASE ERROR</h1>";
    echo "<p>Could not update the database.</p>";
}
?>
