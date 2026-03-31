<?php
require_once __DIR__ . '/includes/auth.php';

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
    foreach ($_POST['content'] as $key => $val) {
        $check = $pdo->prepare("SELECT COUNT(*) FROM site_content WHERE section_key=?");
        $check->execute([$key]);
        if ($check->fetchColumn() > 0) {
            $pdo->prepare("UPDATE site_content SET content_value=? WHERE section_key=?")->execute([trim($val), $key]);
        } else {
            $pdo->prepare("INSERT INTO site_content (section_key, content_value) VALUES (?,?)")->execute([$key, trim($val)]);
        }
    }
    $msg = 'Content updated successfully.';
}

$rows = $pdo->query("SELECT * FROM site_content ORDER BY section_key ASC")->fetchAll();

// Group by page prefix
$grouped = [];
foreach ($rows as $r) {
    $prefix = explode('_', $r['section_key'])[0];
    $grouped[$prefix][] = $r;
}
$pageLabels = [
    'home'    => ['icon'=>'fa-house',       'label'=>'Home Page'],
    'about'   => ['icon'=>'fa-user',         'label'=>'About Page'],
    'site'    => ['icon'=>'fa-globe',        'label'=>'Site Global'],
    'admin'   => ['icon'=>'fa-at',           'label'=>'Admin / Email'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Content — Portfolio CMS</title>
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .tab-bar { display:flex; gap:.5rem; flex-wrap:wrap; margin-bottom:1.75rem; }
    .tab-btn { padding:.5rem 1.1rem; border:1px solid rgba(255,255,255,.1); border-radius:8px; background:rgba(255,255,255,.04); color:#8b9cba; font-size:.85rem; font-weight:600; cursor:pointer; transition:.2s; }
    .tab-btn.active, .tab-btn:hover { background:rgba(99,102,241,.15); border-color:rgba(99,102,241,.4); color:#c7d2fe; }
    .tab-panel { display:none; }
    .tab-panel.active { display:block; }
    .field-group { margin-bottom:1.5rem; }
    .field-group label { font-size:.83rem; font-weight:700; color:#a5b4fc; display:block; margin-bottom:.3rem; }
    .field-group small { color:#4d5475; font-size:.78rem; display:block; margin-bottom:.5rem; }
    .field-group input, .field-group textarea { width:100%; }
    .field-group textarea { min-height:90px; }
  </style>
</head>
<body>
<aside class="sidebar">
  <div class="sidebar-logo"><i class="fas fa-cube"></i> Sabbir<span>.</span>CMS</div>
  <div style="flex:1;">
    <div class="sidebar-section">Main</div>
    <a href="index.php"><i class="fas fa-gauge-high"></i> Dashboard</a>
    <a href="submissions.php"><i class="fas fa-inbox"></i> Messages</a>
    <div class="sidebar-section">Website</div>
    <a href="content.php" class="active"><i class="fas fa-pen-to-square"></i> Edit Content</a>
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
    <h1>Edit Website Content</h1>
    <p>Update text, headings, descriptions, and image paths for each page.</p>
  </div>

  <?php if ($msg): ?>
    <div class="success-banner" style="margin-bottom:1.5rem;">
      <i class="fas fa-circle-check"></i> <?= htmlspecialchars($msg) ?>
    </div>
  <?php endif; ?>

  <form method="POST">
    <!-- Tab Bar -->
    <div class="tab-bar">
      <?php $first = true; foreach ($grouped as $prefix => $fields): $info = $pageLabels[$prefix] ?? ['icon'=>'fa-file','label'=>ucfirst($prefix).' Page']; ?>
        <button type="button" class="tab-btn <?= $first ? 'active' : '' ?>" onclick="switchTab('<?= $prefix ?>')">
          <i class="fas <?= $info['icon'] ?>" style="margin-right:.4rem;"></i><?= $info['label'] ?>
        </button>
      <?php $first = false; endforeach; ?>
    </div>

    <!-- Tab Panels -->
    <?php $first = true; foreach ($grouped as $prefix => $fields): ?>
      <div class="tab-panel admin-card <?= $first ? 'active' : '' ?>" id="tab-<?= $prefix ?>">
        <div class="section-title"><?= ($pageLabels[$prefix] ?? ['label'=>ucfirst($prefix)])['label'] ?> Fields</div>
        <div class="content-grid">
          <?php foreach ($fields as $f):
            $isLong = strlen($f['content_value'] ?? '') > 80 || str_contains($f['section_key'], 'desc'); ?>
            <div class="field-group">
              <label><?= htmlspecialchars(ucwords(str_replace(['_','-'],' ', $f['section_key']))) ?></label>
              <small>Key: <code style="color:#6366f1;"><?= htmlspecialchars($f['section_key']) ?></code></small>
              <?php if ($isLong): ?>
                <textarea name="content[<?= htmlspecialchars($f['section_key']) ?>]"><?= htmlspecialchars($f['content_value'] ?? '') ?></textarea>
              <?php else: ?>
                <input type="text" name="content[<?= htmlspecialchars($f['section_key']) ?>]" value="<?= htmlspecialchars($f['content_value'] ?? '') ?>">
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php $first = false; endforeach; ?>

    <div style="margin-top:1.5rem; padding:1rem 0;">
      <button type="submit" class="btn-admin btn-indigo" style="padding:.75rem 2rem; font-size:.95rem;">
        <i class="fas fa-floppy-disk"></i> Save All Changes
      </button>
      <span style="margin-left:1rem; font-size:.85rem; color:#4d5475;">Changes go live on the site immediately.</span>
    </div>
  </form>
</main>

<script>
function switchTab(prefix) {
  document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  document.getElementById('tab-'+prefix).classList.add('active');
  event.currentTarget.classList.add('active');
}
</script>
</body>
</html>
