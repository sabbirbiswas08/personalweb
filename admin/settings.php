<?php
require_once __DIR__ . '/includes/auth.php';

$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_settings') {
    foreach ($_POST['settings'] as $key => $value) {
        $stmt = $pdo->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = ?");
        $stmt->execute([$value, $key]);
    }
    $success = "Settings successfully updated.";
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_password') {
    $new_password = $_POST['new_password'] ?? '';
    if (strlen($new_password) >= 6) {
        $hash = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE admin_users SET password_hash = ? WHERE id = ?");
        $stmt->execute([$hash, $_SESSION['admin_id']]);
        $success = "Password successfully updated.";
    } else {
        $success = "Error: Password must be at least 6 characters long.";
    }
}

// Fetch settings
$stmt = $pdo->query("SELECT * FROM settings ORDER BY setting_key ASC");
$settings = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings | CMS Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: 'Inter', sans-serif; background: #f9fafb; display: flex; }
        .sidebar { width: 250px; background: #1f2937; color: white; height: 100vh; position: fixed; }
        .sidebar-header { padding: 1.5rem; font-size: 1.25rem; font-weight: 600; border-bottom: 1px solid #374151; }
        .nav-link { display: block; padding: 1rem 1.5rem; color: #d1d5db; text-decoration: none; }
        .nav-link:hover, .nav-link.active { background: #374151; color: white; border-left: 4px solid #3b82f6; }
        .content { margin-left: 250px; padding: 2rem; width: 100%; box-sizing: border-box;}
        h1 { color: #111827; margin-bottom: 0.5rem; }
        .bg-white { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-top: 2rem; max-width: 800px; }
        .form-group { margin-bottom: 1.5rem; }
        label { display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem; }
        .desc { font-size: 0.875rem; color: #6b7280; margin-bottom: 0.5rem; }
        input[type="text"] { width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-family: inherit; font-size: 1rem; box-sizing: border-box;}
        .btn-submit { background: #2563eb; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 1rem; }
        .btn-submit:hover { background: #1d4ed8; }
        .alert { background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 6px; margin-bottom: 2rem; border-left: 4px solid #10b981; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">Portfolio CMS</div>
        <a href="index.php" class="nav-link">Dashboard</a>
        <a href="submissions.php" class="nav-link">Messages</a>
        <a href="content.php" class="nav-link">Edit Content</a>
        <a href="settings.php" class="nav-link active">Settings</a>
        <a href="logout.php" class="nav-link" style="margin-top: 2rem; background: #be123c;">Logout</a>
    </div>

    <div class="content">
        <h1>Admin Settings</h1>
        <p style="color: #6b7280; margin-bottom: 2rem;">Configure where your forms get sent and global site variables.</p>

        <?php if($success): ?>
            <div class="alert"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST" action="" class="bg-white">
            <input type="hidden" name="action" value="save_settings">
            
            <?php foreach($settings as $setting): ?>
                <div class="form-group">
                    <label><?= htmlspecialchars(ucwords(str_replace('_', ' ', $setting['setting_key']))) ?></label>
                    <div class="desc"><?= htmlspecialchars($setting['description']) ?></div>
                    <input type="text" name="settings[<?= $setting['setting_key'] ?>]" value="<?= htmlspecialchars($setting['setting_value']) ?>">
                </div>
            <?php endforeach; ?>

            <button type="submit" class="btn-submit">Save Settings</button>
        </form>

        <form method="POST" action="" class="bg-white">
            <input type="hidden" name="action" value="update_password">
            <h3 style="margin-top: 0; color: #111827;">Change Admin Password</h3>
            <div class="form-group">
                <label>New Password</label>
                <div class="desc">Enter a new secure password. Must be at least 6 characters.</div>
                <input type="password" name="new_password" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-family: inherit; font-size: 1rem; box-sizing: border-box;">
            </div>
            <button type="submit" class="btn-submit" style="background: #10b981;">Update Password</button>
        </form>
    </div>

</body>
</html>
