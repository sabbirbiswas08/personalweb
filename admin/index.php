<?php
require_once __DIR__ . '/includes/auth.php';

// Quick stats
$forms_stmt = $pdo->query("SELECT COUNT(*) FROM form_submissions WHERE status = 'unread'");
$unread_forms = $forms_stmt->fetchColumn();

// Fetch general settings
$settings_stmt = $pdo->query("SELECT setting_key, setting_value FROM settings");
$settings_all = $settings_stmt->fetchAll(PDO::FETCH_KEY_PAIR);
$admin_email = $settings_all['admin_email'] ?? 'Not set';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | CMS Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: 'Inter', sans-serif; background: #09090b; color: #f8fafc; display: flex; }
        .sidebar { width: 250px; background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border-right: 1px solid rgba(255, 255, 255, 0.05); color: white; height: 100vh; position: fixed; display: flex; flex-direction: column; }
        .sidebar-header { padding: 1.5rem; font-size: 1.25rem; font-weight: 600; border-bottom: 1px solid rgba(255, 255, 255, 0.05); color: #06b6d4; }
        .nav-link { display: block; padding: 1rem 1.5rem; color: #94a3b8; text-decoration: none; transition: 0.2s; }
        .nav-link:hover, .nav-link.active { background: rgba(6, 182, 212, 0.1); color: white; border-left: 4px solid #06b6d4; }
        .content { margin-left: 250px; padding: 2rem; width: 100%; }
        .card { background: rgba(255,255,255,0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.5); }
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; }
        .stat-card { background: rgba(255,255,255,0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem; border-radius: 8px; border-left: 4px solid #06b6d4; }
        h1, h2, h3 { color: #f8fafc; margin-top: 0; }
        .badge { background: #8b5cf6; color: white; padding: 2px 8px; border-radius: 999px; font-size: 0.75rem; margin-left: auto; float: right; box-shadow: 0 0 10px rgba(139, 92, 246, 0.5); }
        ul li a { color: #06b6d4 !important; transition: 0.3s; }
        ul li a:hover { color: #8b5cf6 !important; text-shadow: 0 0 8px rgba(139, 92, 246, 0.5); }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">Portfolio CMS</div>
        <a href="index.php" class="nav-link active">Dashboard</a>
        <a href="submissions.php" class="nav-link">Messages <?php if($unread_forms) echo "<span class='badge'>$unread_forms</span>"; ?></a>
        <a href="content.php" class="nav-link">Edit Content</a>
        <a href="settings.php" class="nav-link">Settings</a>
        <a href="../index.php" class="nav-link" target="_blank" style="margin-top: auto; background: #374151;">View Live Site ↗</a>
        <a href="logout.php" class="nav-link" style="background: #be123c;">Logout</a>
    </div>

    <div class="content">
        <h1>Welcome back, <?= htmlspecialchars($_SESSION['admin_username']) ?>!</h1>
        <p style="color: #6b7280; margin-bottom: 2rem;">Here is what's happening on your website today.</p>

        <div class="stat-grid">
            <div class="stat-card">
                <h3 style="color: #6b7280; font-size: 0.875rem;">Unread Inquiries</h3>
                <div style="font-size: 2rem; font-weight: 600; color: #111827;"><?= $unread_forms ?></div>
            </div>
            <div class="stat-card" style="border-left-color: #10b981;">
                <h3 style="color: #6b7280; font-size: 0.875rem;">Admin Email Configured</h3>
                <div style="font-size: 1rem; font-weight: 600; color: #111827; margin-top: 1rem;"><?= htmlspecialchars($admin_email) ?></div>
            </div>
        </div>
        
        <div class="card" style="margin-top: 2rem;">
            <h3>Quick Actions</h3>
            <ul style="line-height: 1.8; color: #374151;">
                <li><a href="content.php" style="color: #2563eb;">Edit Website Text & Images</a></li>
                <li><a href="submissions.php" style="color: #2563eb;">Read Contact Messages</a></li>
                <li><a href="settings.php" style="color: #2563eb;">Change Password & Admin Settings</a></li>
            </ul>
        </div>
    </div>

</body>
</html>
