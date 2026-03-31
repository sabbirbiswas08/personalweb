<?php
require_once __DIR__ . '/includes/auth.php';

$success = '';

// Handle save
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_content') {
    foreach ($_POST['content'] as $key => $value) {
        $stmt = $pdo->prepare("UPDATE site_content SET content_value = ? WHERE section_key = ?");
        $stmt->execute([$value, $key]);
    }
    $success = "Content successfully updated. Your website is now live with the new text/images!";
}

// Fetch content
$stmt = $pdo->query("SELECT * FROM site_content ORDER BY section_key ASC");
$contents = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Content | CMS Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: 'Inter', sans-serif; background: #f9fafb; display: flex; }
        .sidebar { width: 250px; background: #1f2937; color: white; height: 100vh; position: fixed; }
        .sidebar-header { padding: 1.5rem; font-size: 1.25rem; font-weight: 600; border-bottom: 1px solid #374151; }
        .nav-link { display: block; padding: 1rem 1.5rem; color: #d1d5db; text-decoration: none; }
        .nav-link:hover, .nav-link.active { background: #374151; color: white; border-left: 4px solid #3b82f6; }
        .content { margin-left: 250px; padding: 2rem; width: 100%; box-sizing: border-box;}
        h1 { color: #111827; margin-bottom: 0.5rem; }
        .bg-white { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-top: 2rem;}
        .form-group { margin-bottom: 1.5rem; border-bottom: 1px solid #f3f4f6; padding-bottom: 1.5rem; }
        label { display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem; }
        .desc { font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem; }
        input[type="text"], textarea { width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-family: inherit; font-size: 1rem; box-sizing: border-box;}
        textarea { height: 150px; resize: vertical; }
        .btn-submit { background: #2563eb; color: white; border: none; padding: 1rem 2rem; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 1rem; position: sticky; bottom: 2rem; width: 100%; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-submit:hover { background: #1d4ed8; }
        .alert { background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 6px; margin-bottom: 2rem; border-left: 4px solid #10b981; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">Portfolio CMS</div>
        <a href="index.php" class="nav-link">Dashboard</a>
        <a href="submissions.php" class="nav-link">Messages</a>
        <a href="content.php" class="nav-link active">Edit Content</a>
        <a href="settings.php" class="nav-link">Settings</a>
        <a href="logout.php" class="nav-link" style="margin-top: 2rem; background: #be123c;">Logout</a>
    </div>

    <div class="content">
        <h1>Website Content Manager</h1>
        <p style="color: #6b7280; margin-bottom: 2rem;">Modify the text and image paths displayed on your frontend pages.</p>

        <?php if($success): ?>
            <div class="alert"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST" action="" class="bg-white">
            <input type="hidden" name="action" value="save_content">
            
            <?php foreach($contents as $item): ?>
                <div class="form-group">
                    <label><?= htmlspecialchars(ucwords(str_replace('_', ' ', $item['section_key']))) ?></label>
                    <div class="desc"><?= htmlspecialchars($item['description']) ?></div>
                    
                    <?php if($item['content_type'] === 'text' || $item['content_type'] === 'image'): ?>
                        <input type="text" name="content[<?= $item['section_key'] ?>]" value="<?= htmlspecialchars($item['content_value']) ?>">
                    <?php elseif($item['content_type'] === 'long_text'): ?>
                        <textarea name="content[<?= $item['section_key'] ?>]"><?= htmlspecialchars($item['content_value']) ?></textarea>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="btn-submit">Save All Changes</button>
        </form>
    </div>

</body>
</html>
