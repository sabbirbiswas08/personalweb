<?php
require_once __DIR__ . '/includes/auth.php';

$msg = '';
// Save settings
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'save_settings') {
        foreach ($_POST['settings'] as $key => $val) {
            $pdo->prepare("UPDATE settings SET setting_value=? WHERE setting_key=?")->execute([trim($val), $key]);
        }
        $msg = 'success:Settings saved successfully.';
    } elseif ($_POST['action'] === 'change_password') {
        $np = $_POST['new_password'] ?? '';
        $cp = $_POST['confirm_password'] ?? '';
        if (strlen($np) < 6)        $msg = 'error:Password must be at least 6 characters.';
        elseif ($np !== $cp)        $msg = 'error:Passwords do not match.';
        else {
            $hash = password_hash($np, PASSWORD_DEFAULT);
            $pdo->prepare("UPDATE admin_users SET password_hash=? WHERE id=?")->execute([$hash, $_SESSION['admin_id']]);
            $msg = 'success:Password updated successfully.';
        }
    }
}

$settings = $pdo->query("SELECT * FROM settings ORDER BY setting_key ASC")->fetchAll();
[$mtype, $mtext] = $msg ? explode(':', $msg, 2) : ['',''];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings — Portfolio CMS</title>
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<aside class="sidebar">
  <div class="sidebar-logo"><i class="fas fa-cube"></i> Sabbir<span>.</span>CMS</div>
  <div style="flex:1;">
    <div class="sidebar-section">Main</div>
    <a href="index.php"><i class="fas fa-gauge-high"></i> Dashboard</a>
    <a href="submissions.php"><i class="fas fa-inbox"></i> Messages</a>
    <div class="sidebar-section">Website</div>
    <a href="content.php"><i class="fas fa-pen-to-square"></i> Edit Content</a>
    <a href="settings.php" class="active"><i class="fas fa-sliders"></i> Settings</a>
    <div class="sidebar-section">View</div>
    <a href="../index.php" target="_blank"><i class="fas fa-arrow-up-right-from-square"></i> Live Site</a>
  </div>
  <div class="sidebar-bottom">
    <a href="logout.php" class="logout-btn"><i class="fas fa-right-from-bracket"></i> Sign Out</a>
  </div>
</aside>

<main class="main">
  <div class="page-header">
    <h1>Settings</h1>
    <p>Manage global site configuration and your admin password.</p>
  </div>

  <?php if ($mtext): ?>
    <div class="<?= $mtype==='success' ? 'success-banner' : 'error-banner' ?>">
      <i class="fas <?= $mtype==='success' ? 'fa-circle-check' : 'fa-circle-exclamation' ?>"></i> <?= htmlspecialchars($mtext) ?>
    </div>
  <?php endif; ?>

  <!-- Site Settings -->
  <div class="admin-card" style="margin-bottom:1.5rem;">
    <div class="section-title"><i class="fas fa-globe" style="margin-right:.5rem;color:#818cf8;"></i> Site Settings</div>
    <form method="POST">
      <input type="hidden" name="action" value="save_settings">
      <div class="content-grid">
        <?php foreach($settings as $s): ?>
          <div class="content-item">
            <label><?= htmlspecialchars(ucwords(str_replace('_',' ',$s['setting_key']))) ?></label>
            <small><?= htmlspecialchars($s['description'] ?? '') ?></small>
            <input type="text" name="settings[<?= htmlspecialchars($s['setting_key']) ?>]" value="<?= htmlspecialchars($s['setting_value']) ?>" style="margin-top:.5rem;">
          </div>
        <?php endforeach; ?>
      </div>
      <div style="margin-top:1.75rem;">
        <button type="submit" class="btn-admin btn-indigo"><i class="fas fa-floppy-disk"></i> Save Settings</button>
      </div>
    </form>
  </div>

  <!-- Change Password -->
  <div class="admin-card">
    <div class="section-title"><i class="fas fa-lock" style="margin-right:.5rem;color:#a855f7;"></i> Change Admin Password</div>
    <form method="POST" style="max-width:420px;">
      <input type="hidden" name="action" value="change_password">
      <div style="margin-bottom:1.25rem;">
        <label>New Password <small style="color:#4d5475;">(min 6 characters)</small></label>
        <input type="password" name="new_password" required placeholder="Enter new password">
      </div>
      <div style="margin-bottom:1.5rem;">
        <label>Confirm New Password</label>
        <input type="password" name="confirm_password" required placeholder="Repeat new password">
      </div>
      <button type="submit" class="btn-admin" style="background:linear-gradient(135deg,#a855f7,#6366f1);color:#fff;box-shadow:0 0 20px rgba(168,85,247,.3);"><i class="fas fa-shield-halved"></i> Update Password</button>
    </form>
  </div>
</main>
</body>
</html>
