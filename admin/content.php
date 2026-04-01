<?php
require_once __DIR__ . '/includes/auth.php';

$msg = '';
$error = '';

// Allowed image keys that can be edited
$image_keys = [
    'home_hero_image' => 'Homepage Hero Image',
    'about_image'     => 'About Page Image'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imageUpload'])) {
    $key = $_POST['section_key'] ?? '';
    
    if (array_key_exists($key, $image_keys)) {
        $file = $_FILES['imageUpload'];
        
        if ($file['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
            if (in_array($ext, $allowed)) {
                // Generate safe filename
                $new_filename = $key . '_' . time() . '.' . $ext;
                $upload_path = __DIR__ . '/../images/' . $new_filename;
                $db_path = 'images/' . $new_filename;
                
                if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                    // Update database
                    $check = $pdo->prepare("SELECT COUNT(*) FROM site_content WHERE section_key=?");
                    $check->execute([$key]);
                    if ($check->fetchColumn() > 0) {
                        $pdo->prepare("UPDATE site_content SET content_value=? WHERE section_key=?")->execute([$db_path, $key]);
                    } else {
                        $pdo->prepare("INSERT INTO site_content (section_key, content_value) VALUES (?,?)")->execute([$key, $db_path]);
                    }
                    $msg = "Successfully updated " . $image_keys[$key];
                } else {
                    $error = "Failed to save the uploaded image.";
                }
            } else {
                $error = "Invalid file type. Only JPG, PNG, GIF, and WEBP are allowed.";
            }
        } else {
            $error = "Please select an image to upload.";
        }
    } else {
        $error = "Invalid section selected.";
    }
}

// Fetch current images
$current_images = [];
$stmt = $pdo->query("SELECT section_key, content_value FROM site_content WHERE section_key IN ('home_hero_image', 'about_image')");
while ($row = $stmt->fetch()) {
    $current_images[$row['section_key']] = $row['content_value'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Images — Portfolio CMS</title>
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .image-card { background:rgba(255,255,255,.03); border:1px solid rgba(255,255,255,.08); border-radius:12px; padding:1.5rem; margin-bottom:1.5rem; display:flex; gap:2rem; align-items:center; }
    @media(max-width:768px) { .image-card { flex-direction:column; align-items:flex-start; } }
    .img-preview { width:200px; height:150px; object-fit:cover; border-radius:8px; border:2px solid rgba(255,255,255,.1); background:#000; }
    .upload-form { flex:1; }
    .upload-form h3 { color:#a5b4fc; margin-bottom:.5rem; font-size:1.1rem; }
    .upload-form p { color:#7b82a8; font-size:.85rem; margin-bottom:1rem; }
    .file-input { background:rgba(0,0,0,.2); padding:.5rem; border-radius:6px; border:1px solid rgba(255,255,255,.1); margin-bottom:1rem; width:100%; color:#c7d2fe; }
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
    <a href="content.php" class="active"><i class="fas fa-image"></i> Manage Images</a>
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
    <h1>Manage Website Images</h1>
    <p>Upload and update the main images displayed on your site.</p>
  </div>

  <?php if ($msg): ?>
    <div class="success-banner" style="margin-bottom:1.5rem;">
      <i class="fas fa-circle-check"></i> <?= htmlspecialchars($msg) ?>
    </div>
  <?php endif; ?>
  
  <?php if ($error): ?>
    <div style="background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.3); color:#fca5a5; padding:1rem; border-radius:8px; margin-bottom:1.5rem;">
      <i class="fas fa-triangle-exclamation"></i> <?= htmlspecialchars($error) ?>
    </div>
  <?php endif; ?>

  <?php foreach ($image_keys as $db_key => $label): 
      $current_src = $current_images[$db_key] ?? 'images/sabbir.png';
  ?>
  <div class="image-card">
    <img src="../<?= htmlspecialchars($current_src) ?>" alt="Preview" class="img-preview" onerror="this.src='https://placehold.co/400x300/1e1e2f/4d5475?text=No+Image'">
    
    <div class="upload-form">
      <h3><?= htmlspecialchars($label) ?></h3>
      <p>Current file: <code><?= htmlspecialchars($current_src) ?></code></p>
      
      <form method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; align-items:flex-start;">
        <input type="hidden" name="section_key" value="<?= $db_key ?>">
        <input type="file" name="imageUpload" class="file-input" accept="image/png, image/jpeg, image/gif, image/webp" required>
        <button type="submit" class="btn-admin btn-indigo" style="padding:.5rem 1.5rem;">
          <i class="fas fa-upload"></i> Upload & Replace
        </button>
      </form>
    </div>
  </div>
  <?php endforeach; ?>

</main>
</body>
</html>
