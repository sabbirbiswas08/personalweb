<?php
require_once __DIR__ . '/includes/auth.php';

// Handle Action
if (isset($_GET['mark_read'])) {
    $id = (int) $_GET['mark_read'];
    $stmt = $pdo->prepare("UPDATE form_submissions SET status = 'read' WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: submissions.php");
    exit;
}

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM form_submissions WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: submissions.php");
    exit;
}

// Fetch submissions
$stmt = $pdo->query("SELECT * FROM form_submissions ORDER BY created_at DESC");
$submissions = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Messages | CMS Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: 'Inter', sans-serif; background: #f9fafb; display: flex; }
        .sidebar { width: 250px; background: #1f2937; color: white; height: 100vh; position: fixed; }
        .sidebar-header { padding: 1.5rem; font-size: 1.25rem; font-weight: 600; border-bottom: 1px solid #374151; }
        .nav-link { display: block; padding: 1rem 1.5rem; color: #d1d5db; text-decoration: none; }
        .nav-link:hover, .nav-link.active { background: #374151; color: white; border-left: 4px solid #3b82f6; }
        .content { margin-left: 250px; padding: 2rem; width: 100%; box-sizing: border-box;}
        h1 { color: #111827; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden; }
        th, td { text-align: left; padding: 1rem; border-bottom: 1px solid #e5e7eb; }
        th { background: #f3f4f6; color: #374151; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; }
        tr:last-child td { border-bottom: none; }
        .unread { font-weight: 600; background: #eff6ff; }
        .badge { font-size: 0.75rem; padding: 0.25rem 0.5rem; border-radius: 9999px; }
        .badge-unread { background: #fee2e2; color: #991b1b; }
        .badge-read { background: #d1fae5; color: #065f46; }
        .btn { padding: 0.25rem 0.5rem; font-size: 0.75rem; background: #2563eb; color: white; text-decoration: none; border-radius: 4px; border: none; cursor: pointer;}
        .btn-danger { background: #dc2626; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">Portfolio CMS</div>
        <a href="index.php" class="nav-link">Dashboard</a>
        <a href="submissions.php" class="nav-link active">Messages</a>
        <a href="content.php" class="nav-link">Edit Content</a>
        <a href="settings.php" class="nav-link">Settings</a>
        <a href="logout.php" class="nav-link" style="margin-top: 2rem; background: #be123c;">Logout</a>
    </div>

    <div class="content">
        <h1>Contact Form Submissions</h1>
        
        <?php if(empty($submissions)): ?>
            <p style="color: #6b7280; margin-top: 2rem;">No messages yet.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($submissions as $msg): ?>
                        <tr class="<?= $msg['status'] === 'unread' ? 'unread' : '' ?>">
                            <td><span class="badge <?= $msg['status'] === 'unread' ? 'badge-unread' : 'badge-read' ?>"><?= htmlspecialchars($msg['status']) ?></span></td>
                            <td><?= htmlspecialchars($msg['first_name'] . ' ' . $msg['last_name']) ?></td>
                            <td><a href="mailto:<?= htmlspecialchars($msg['email']) ?>"><?= htmlspecialchars($msg['email']) ?></a></td>
                            <td><?= htmlspecialchars($msg['subject']) ?></td>
                            <td style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <?= nl2br(htmlspecialchars($msg['message'])) ?>
                            </td>
                            <td><?= date('M d, Y', strtotime($msg['created_at'])) ?></td>
                            <td>
                                <?php if($msg['status'] === 'unread'): ?>
                                    <a href="?mark_read=<?= $msg['id'] ?>" class="btn">Mark Read</a>
                                <?php endif; ?>
                                <a href="?delete=<?= $msg['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this message?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</body>
</html>
