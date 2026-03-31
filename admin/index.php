<?php
require_once __DIR__ . '/includes/auth.php';
$unread = $pdo->query("SELECT COUNT(*) FROM form_submissions WHERE status='unread'")->fetchColumn();
$total  = $pdo->query("SELECT COUNT(*) FROM form_submissions")->fetchColumn();
$settings = $pdo->query("SELECT setting_key, setting_value FROM settings")->fetchAll(PDO::FETCH_KEY_PAIR);
$admin_email = $settings['admin_email'] ?? 'Not set';
$recent = $pdo->query("SELECT * FROM form_submissions ORDER BY created_at DESC LIMIT 5")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard — Portfolio CMS</title>
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<aside class="sidebar">
  <div class="sidebar-logo"><i class="fas fa-cube"></i> Sabbir<span>.</span>CMS</div>
  <div style="flex:1; overflow-y:auto;">
    <div class="sidebar-section">Main</div>
    <a href="index.php" class="active"><i class="fas fa-gauge-high"></i> Dashboard</a>
    <a href="submissions.php"><i class="fas fa-inbox"></i> Messages
      <?php if($unread): ?><span style="margin-left:auto;background:#6366f1;color:#fff;padding:.15rem .55rem;border-radius:999px;font-size:.7rem;font-weight:700;"><?= $unread ?></span><?php endif; ?>
    </a>
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
    <h1>Welcome back, <?= htmlspecialchars($_SESSION['admin_username']) ?> 👋</h1>
    <p>Here's what's happening on your website today.</p>
  </div>

  <div class="stats-grid">
    <div class="stat-card">
      <div class="sc-label"><i class="fas fa-envelope" style="margin-right:.3rem;"></i> Unread Messages</div>
      <div class="sc-value"><?= $unread ?></div>
      <div class="sc-sub">Pending response</div>
    </div>
    <div class="stat-card" style="border-left-color:#2dd4bf;">
      <div class="sc-label"><i class="fas fa-inbox" style="margin-right:.3rem;"></i> Total Inquiries</div>
      <div class="sc-value"><?= $total ?></div>
      <div class="sc-sub">All-time submissions</div>
    </div>
    <div class="stat-card" style="border-left-color:#a855f7;">
      <div class="sc-label"><i class="fas fa-at" style="margin-right:.3rem;"></i> Notification Email</div>
      <div class="sc-value" style="font-size:.95rem; margin-top:.5rem; word-break:break-all;"><?= htmlspecialchars($admin_email) ?></div>
      <div class="sc-sub">Form alerts go here</div>
    </div>
  </div>

  <div class="admin-card" style="margin-bottom:1.5rem;">
    <div class="section-title">Quick Actions</div>
    <div style="display:flex; flex-wrap:wrap; gap:.75rem;">
      <a href="content.php"     class="btn-admin btn-indigo"><i class="fas fa-pen-to-square"></i> Edit Text & Images</a>
      <a href="submissions.php" class="btn-admin btn-teal"><i class="fas fa-inbox"></i> View All Messages</a>
      <a href="settings.php"    class="btn-admin" style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);color:#c9d0e8;"><i class="fas fa-sliders"></i> Settings & Password</a>
    </div>
  </div>

  <div class="admin-card">
    <div class="section-title">Recent Messages</div>
    <?php if ($recent): ?>
    <div class="table-wrap">
      <table>
        <thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Date</th><th>Status</th><th>Action</th></tr></thead>
        <tbody>
          <?php foreach($recent as $r): ?>
          <tr>
            <td><strong><?= htmlspecialchars($r['first_name'].' '.$r['last_name']) ?></strong></td>
            <td style="color:#7b82a8;"><?= htmlspecialchars($r['email']) ?></td>
            <td><?= htmlspecialchars($r['subject'] ?: '—') ?></td>
            <td style="color:#7b82a8; font-size:.82rem;"><?= date('M j, Y', strtotime($r['created_at'])) ?></td>
            <td><?= $r['status']==='unread' ? '<span class="badge-unread">Unread</span>' : '<span class="badge-read">Read</span>' ?></td>
            <td><a href="submissions.php" class="btn-admin btn-teal" style="padding:.3rem .75rem;font-size:.8rem;"><i class="fas fa-eye"></i></a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
      <div style="text-align:center; padding:3rem 0; color:#4d5475;">
        <i class="fas fa-inbox" style="font-size:2.5rem; display:block; margin-bottom:1rem;"></i>
        No messages yet. They'll show up here once someone submits your contact form.
      </div>
    <?php endif; ?>
  </div>
</main>
</body>
</html>
