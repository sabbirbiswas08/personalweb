<?php
require_once __DIR__ . '/includes/auth.php';

// Quick stats
$forms_stmt = $pdo->query("SELECT COUNT(*) FROM form_submissions WHERE status = 'unread'");
$unread_forms = $forms_stmt->fetchColumn();

// Fetch general settings
$settings_stmt = $pdo->query("SELECT * FROM settings");
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
        body { margin: 0; font-family: 'Inter', sans-serif; background: #f9fafb; display: flex; }
        .sidebar { width: 250px; background: #1f2937; color: white; height: 100vh; position: fixed; display: flex; flex-direction: column; }
        .sidebar-header { padding: 1.5rem; font-size: 1.25rem; font-weight: 600; border-bottom: 1px solid #374151; }
        .nav-link { display: block; padding: 1rem 1.5rem; color: #d1d5db; text-decoration: none; transition: 0.2s; }
        .nav-link:hover, .nav-link.active { background: #374151; color: white; border-left: 4px solid #3b82f6; }
        .content { margin-left: 250px; padding: 2rem; width: 100%; }
        .card { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 1.5rem; }
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; }
        .stat-card { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #3b82f6; }
        h1, h2, h3 { color: #111827; margin-top: 0; }
        .badge { background: #ef4444; color: white; padding: 2px 8px; border-radius: 999px; font-size: 0.75rem; margin-left: auto; float: right; }
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
