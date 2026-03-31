<?php
/**
 * debug.php — Diagnostic Tool
 * Visit: yoursite.com/debug.php
 * DELETE this file after fixing issues!
 */
require_once __DIR__ . '/admin/includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Site Diagnostics</title>
  <style>
    body { font-family: monospace; background: #0d0e1a; color: #e2e5f0; padding: 2rem; font-size: 14px; }
    h1 { color: #818cf8; border-bottom: 1px solid #333; padding-bottom: 1rem; margin-bottom: 2rem; }
    h2 { color: #a5b4fc; margin-top: 2rem; }
    .ok   { color: #6ee7b7; }
    .fail { color: #fca5a5; }
    .warn { color: #fde68a; }
    table { border-collapse: collapse; width: 100%; margin-top: 1rem; }
    th { background: #1e1f3a; color: #818cf8; padding: .5rem 1rem; text-align: left; }
    td { padding: .5rem 1rem; border-bottom: 1px solid #222; }
    .img-preview { max-height: 80px; border-radius: 6px; margin-top: .25rem; }
  </style>
</head>
<body>
<h1>🔍 Site Diagnostics</h1>

<h2>1. Database Connection</h2>
<?php
try {
    $test = $pdo->query("SELECT 1")->fetchColumn();
    echo '<p class="ok">✅ Database connected successfully (host: ' . DB_HOST . ', db: ' . DB_NAME . ')</p>';
} catch (Exception $e) {
    echo '<p class="fail">❌ Connection error: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>

<h2>2. Tables</h2>
<?php
$tables = ['admin_users', 'form_submissions', 'settings', 'site_content'];
foreach ($tables as $t) {
    try {
        $count = $pdo->query("SELECT COUNT(*) FROM `$t`")->fetchColumn();
        echo "<p class='ok'>✅ Table <strong>$t</strong> — $count rows</p>";
    } catch (Exception $e) {
        echo "<p class='fail'>❌ Table <strong>$t</strong> — MISSING or error: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
?>

<h2>3. Site Content Keys</h2>
<?php
$required = [
    'home_hero_image', 'home_hero_greeting', 'home_hero_name', 'home_hero_subtitle',
    'home_hero_desc', 'home_stat_1_number', 'home_stat_1_text',
    'about_image',
];
try {
    $rows = $pdo->query("SELECT section_key, content_value FROM site_content")->fetchAll(PDO::FETCH_KEY_PAIR);
    echo '<table><tr><th>Key</th><th>Value</th><th>Status</th></tr>';
    foreach ($required as $key) {
        $val = $rows[$key] ?? null;
        $status = $val ? '<span class="ok">✅ Found</span>' : '<span class="fail">❌ MISSING</span>';
        echo "<tr><td>$key</td><td>" . htmlspecialchars($val ?? '—') . "</td><td>$status</td></tr>";
    }
    echo '</table>';
} catch (Exception $e) {
    echo "<p class='fail'>Could not read site_content table.</p>";
}
?>

<h2>4. Settings Keys</h2>
<?php
try {
    $s = $pdo->query("SELECT setting_key, setting_value FROM settings")->fetchAll();
    echo '<table><tr><th>Key</th><th>Value</th></tr>';
    foreach ($s as $row) echo "<tr><td>{$row['setting_key']}</td><td>" . htmlspecialchars($row['setting_value']) . "</td></tr>";
    echo '</table>';
} catch (Exception $e) {
    echo "<p class='fail'>Could not read settings table.</p>";
}
?>

<h2>5. Image Files</h2>
<?php
$images = ['images/sabbir.png', 'images/sabbir biswas.png', 'images/ai_dashboard.png', 'images/database_ui.png', 'images/secure_login.png'];
foreach ($images as $img) {
    $exists = file_exists(__DIR__ . '/' . $img);
    echo $exists
        ? "<p class='ok'>✅ <strong>$img</strong><br><img src='$img' class='img-preview'></p>"
        : "<p class='fail'>❌ NOT FOUND: <strong>$img</strong></p>";
}
?>

<h2>6. Admin Users</h2>
<?php
try {
    $admins = $pdo->query("SELECT id, username, created_at FROM admin_users")->fetchAll();
    echo '<table><tr><th>ID</th><th>Username</th><th>Created</th></tr>';
    foreach ($admins as $a) echo "<tr><td>{$a['id']}</td><td>{$a['username']}</td><td>{$a['created_at']}</td></tr>";
    echo '</table>';
} catch (Exception $e) {
    echo "<p class='fail'>Could not read admin_users.</p>";
}
?>

<h2>7. PHP Version</h2>
<p class="ok">✅ PHP <?= PHP_VERSION ?></p>

<p style="margin-top:3rem; color:#4d5475;">⚠️ <strong>Delete this file once you're done diagnosing!</strong></p>
</body>
</html>
