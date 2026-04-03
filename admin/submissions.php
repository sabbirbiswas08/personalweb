<?php
require_once __DIR__ . '/includes/auth.php';

// Handle actions
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'mark_read') {
            $pdo->prepare("UPDATE form_submissions SET status='read' WHERE id=?")->execute([$_POST['id']]);
            $msg = 'success:Marked as read.';
        } elseif ($_POST['action'] === 'delete') {
            $pdo->prepare("DELETE FROM form_submissions WHERE id=?")->execute([$_POST['id']]);
            $msg = 'success:Message deleted.';
        }
    }
}

$submissions = $pdo->query("SELECT * FROM form_submissions ORDER BY created_at DESC")->fetchAll();
[$type, $text] = $msg ? explode(':', $msg, 2) : ['', ''];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Messages — Portfolio CMS</title>
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .msg-row td { vertical-align: top; }
    .msg-body { color:#a0aec0; font-size:.88rem; line-height:1.6; max-width:340px; white-space:pre-wrap; word-break:break-word; }
    .expand-btn { background:rgba(99,102,241,.1); border:1px solid rgba(99,102,241,.2); border-radius:12px; color:#c7d2fe; cursor:pointer; font-size:.78rem; font-weight:600; padding:.2rem .6rem; margin-top:.5rem; transition:.2s; }
    .expand-btn:hover { background:rgba(99,102,241,.2); border-color:rgba(99,102,241,.4); }
  </style>
</head>
<body>
<aside class="sidebar">
  <div class="sidebar-logo"><i class="fas fa-cube"></i> Sabbir<span>.</span>CMS</div>
  <div style="flex:1;">
    <div class="sidebar-section">Main</div>
    <a href="index.php"><i class="fas fa-gauge-high"></i> Dashboard</a>
    <a href="submissions.php" class="active"><i class="fas fa-inbox"></i> Messages</a>
    <div class="sidebar-section">Website</div>
    <a href="content.php"><i class="fas fa-pen-to-square"></i> Edit Content</a>
    <a href="settings.php"><i class="fas fa-sliders"></i> Settings</a>
    <div class="sidebar-section">View</div>
    <a href="../index.php" target="_blank"><i class="fas fa-arrow-up-right-from-square"></i> Live Site</a>
  </div>
  <div class="sidebar-bottom">
    <a href="logout.php" class="logout-btn"><i class="fas fa-right-from-bracket"></i> Sign Out</a>
  </div>
</aside>

<main class="main">
  <div class="page-header">
    <h1>Contact Messages</h1>
    <p>All inquiries submitted through your website's contact form.</p>
  </div>

  <?php if ($text): ?>
    <div class="<?= $type==='success' ? 'success-banner' : 'error-banner' ?>" style="margin-bottom:1.5rem;">
      <i class="fas <?= $type==='success' ? 'fa-circle-check' : 'fa-circle-exclamation' ?>"></i> <?= htmlspecialchars($text) ?>
    </div>
  <?php endif; ?>

  <div class="admin-card">
    <?php if ($submissions): ?>
    <div class="table-wrap">
      <table>
        <thead>
          <tr><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Date</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
          <?php foreach($submissions as $s): ?>
          <tr class="msg-row">
            <td><strong><?= htmlspecialchars($s['first_name'].' '.$s['last_name']) ?></strong></td>
            <td><a href="mailto:<?= htmlspecialchars($s['email']) ?>" style="color:#818cf8;"><?= htmlspecialchars($s['email']) ?></a></td>
            <td><?= htmlspecialchars($s['subject'] ?: '—') ?></td>
            <td>
              <div class="msg-body" id="msg-<?= $s['id'] ?>">
                <?= nl2br(htmlspecialchars($s['message'])) ?>
              </div>
            </td>
            <td style="font-size:.82rem; color:#7b82a8; white-space:nowrap;"><?= date('M j, Y<br>g:i A', strtotime($s['created_at'])) ?></td>
            <td><?= $s['status']==='unread' ? '<span class="badge-unread">Unread</span>' : '<span class="badge-read">Read</span>' ?></td>
            <td>
              <div style="display:flex; gap:.5rem; flex-wrap:nowrap; align-items:center;">
                <?php if($s['status']==='unread'): ?>
                <form method="POST">
                  <input type="hidden" name="action" value="mark_read">
                  <input type="hidden" name="id" value="<?= $s['id'] ?>">
                  <button type="submit" class="btn-admin btn-teal" style="padding:.35rem .75rem;font-size:.78rem;"><i class="fas fa-check"></i> Read</button>
                </form>
                <?php endif; ?>
                <form method="POST" onsubmit="return confirm('Delete this message permanently?')">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= $s['id'] ?>">
                  <button type="submit" class="btn-admin btn-danger" style="padding:.35rem .75rem;font-size:.78rem;"><i class="fas fa-trash"></i></button>
                </form>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
      <div style="text-align:center; padding:4rem 0; color:#4d5475;">
        <i class="fas fa-inbox" style="font-size:3rem; display:block; margin-bottom:1rem;"></i>
        No messages yet.
      </div>
    <?php endif; ?>
  </div>
</main>

<script>
function toggleMsg(id) {
  const el  = document.getElementById('msg-'+id);
  const btn = el.nextElementSibling;
  if (el.style.maxHeight === 'none') {
    el.style.maxHeight = '60px'; btn.textContent = 'Show more';
  } else {
    el.style.maxHeight = 'none'; btn.textContent = 'Show less';
  }
}
</script>
</body>
</html>
