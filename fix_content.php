<?php
/**
 * fix_content.php — One-click database content fixer
 * Visit: yoursite.com/fix_content.php
 * This script will safely add all missing content keys and fix image paths.
 * DELETE this file after running it!
 */
require_once __DIR__ . '/admin/includes/db.php';

$fixes = [
    // Image paths (fix .jpg → .png)
    ['home_hero_image', 'images/sabbir.png'],
    ['about_image',     'images/sabbir.png'],

    // Missing hero keys
    ['home_hero_greeting', 'I Build Secure'],
    ['home_hero_name',     'AI-Powered Websites'],
    ['home_hero_subtitle', 'Available for new projects'],
    ['home_hero_desc',     'From a clean HTML file to a fully deployed, database-driven web application with custom admin panel — built using AI, PHP, MySQL & JavaScript. No page builders, no shortcuts.'],

    // Stats
    ['home_stat_1_number', '50+'],
    ['home_stat_1_text',   'Projects Delivered'],
    ['home_stat_2_number', '5 yrs'],
    ['home_stat_2_text',   'Web Experience'],
    ['home_stat_3_number', '100%'],
    ['home_stat_3_text',   'Client Satisfaction'],

    // About page
    ['about_badge',               'AI Developer & Full-Stack Engineer'],
    ['about_hero_title',          'Building the Future of the Web'],
    ['about_hero_title_highlight','with AI & Real Code'],

    // Site settings
    ['site_title_content', 'Sabbir Biswas | AI Web Developer'],
];

// Run fixes
$results = [];
foreach ($fixes as [$key, $value]) {
    try {
        $stmt = $pdo->prepare("INSERT INTO site_content (section_key, content_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE content_value = VALUES(content_value)");
        $stmt->execute([$key, $value]);
        $results[] = ['key' => $key, 'value' => $value, 'ok' => true];
    } catch (Exception $e) {
        $results[] = ['key' => $key, 'value' => $value, 'ok' => false, 'err' => $e->getMessage()];
    }
}

// Also fix settings
try {
    $pdo->prepare("INSERT INTO settings (setting_key, setting_value, description) VALUES ('site_title', 'Sabbir Biswas | AI Web Developer', 'Browser tab title') ON DUPLICATE KEY UPDATE setting_value = 'Sabbir Biswas | AI Web Developer'")->execute();
} catch (Exception $e) { /* ignore */ }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Content Fix</title>
  <style>
    body { font-family: monospace; background:#0d0e1a; color:#e2e5f0; padding:2rem; }
    h1 { color:#818cf8; margin-bottom:2rem; }
    .ok   { color:#6ee7b7; } .fail { color:#fca5a5; }
    table { border-collapse:collapse; width:100%; }
    th { background:#1e1f3a; color:#818cf8; padding:.5rem 1rem; text-align:left; }
    td { padding:.5rem 1rem; border-bottom:1px solid #222; font-size:13px; }
    .done { background:rgba(16,185,129,.1); border:1px solid rgba(16,185,129,.3); color:#6ee7b7; padding:1.5rem; border-radius:10px; margin-top:2rem; font-size:1.1rem; }
    a.btn { display:inline-block; margin-top:1.5rem; padding:.75rem 1.5rem; background:linear-gradient(135deg,#6366f1,#8b5cf6); color:#fff; border-radius:8px; text-decoration:none; font-weight:700; }
  </style>
</head>
<body>
<h1>🔧 Content Fix Results</h1>
<table>
  <tr><th>Key</th><th>Value Set</th><th>Status</th></tr>
  <?php foreach($results as $r): ?>
  <tr>
    <td><?= htmlspecialchars($r['key']) ?></td>
    <td><?= htmlspecialchars($r['value']) ?></td>
    <td class="<?= $r['ok'] ? 'ok' : 'fail' ?>"><?= $r['ok'] ? '✅ Fixed' : '❌ '.$r['err'] ?></td>
  </tr>
  <?php endforeach; ?>
</table>

<div class="done">
  ✅ All done! Your website content has been updated.<br>
  <strong>⚠️ Please delete this file from your server now for security!</strong>
</div>

<a href="index.php" class="btn">→ View Live Site</a>
&nbsp;
<a href="admin/login.php" class="btn" style="background:linear-gradient(135deg,#2dd4bf,#6366f1);">→ Admin Panel</a>

<?php
// Self-delete for security (works on most servers)
@unlink(__FILE__);
?>
</body>
</html>
