<?php
require_once __DIR__ . '/includes/auth.php';

$msg = '';
$error = '';

// Allowed image keys that can be edited, with their default fallback paths
$image_details = [
    'home_hero_image' => [
        'label' => 'Homepage Hero Image',
        'default' => 'images/sabbir.png'
    ],
    'about_image' => [
        'label' => 'About Page Image',
        'default' => 'images/sabbir.png'
    ],
    'portfolio_img_1' => [
        'label' => 'Portfolio Image 1 (AI Dashboard)',
        'default' => 'images/ai_dashboard.png'
    ],
    'portfolio_img_2' => [
        'label' => 'Portfolio Image 2 (Database UI)',
        'default' => 'images/database_ui.png'
    ],
    'portfolio_img_3' => [
        'label' => 'Portfolio Image 3 (Secure Login)',
        'default' => 'images/secure_login.png'
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imageUpload'])) {
    $key = $_POST['section_key'] ?? '';
    
    if (array_key_exists($key, $image_details)) {
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
                    $msg = "Successfully updated " . $image_details[$key]['label'];
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
$keys_list = "'" . implode("','", array_keys($image_details)) . "'";
$stmt = $pdo->query("SELECT section_key, content_value FROM site_content WHERE section_key IN ($keys_list)");
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
    .view-controls { display:flex; gap:.5rem; margin-bottom:1.5rem; justify-content:flex-end; }
    .view-btn { background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.1); color:#8b9cba; padding:.4rem .8rem; border-radius:6px; cursor:pointer; transition:.2s; }
    .view-btn:hover, .view-btn.active { background:rgba(99,102,241,.15); border-color:rgba(99,102,241,.4); color:#c7d2fe; }
    
    /* Layout Container */
    .image-container { display:flex; flex-direction:column; gap:1.5rem; }
    
    /* Card Styles for List View (Default) */
    .image-card { background:rgba(255,255,255,.03); border:1px solid rgba(255,255,255,.08); border-radius:12px; padding:1.5rem; display:flex; gap:2rem; align-items:center; transition:.3s; }
    .img-preview { width:200px; height:150px; object-fit:cover; border-radius:8px; border:2px solid rgba(255,255,255,.1); background:#000; flex-shrink:0; }
    .upload-form { flex:1; display:flex; flex-direction:column; align-items:flex-start; }
    
    /* Grid View overrides */
    .image-container.grid-view { display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:1.5rem; }
    .image-container.grid-view .image-card { flex-direction:column; gap:1rem; padding:1.25rem; align-items:stretch; }
    .image-container.grid-view .img-preview { width:100%; height:180px; }
    .image-container.grid-view .upload-form { flex:none; }
    
    @media(max-width:768px) { .image-card { flex-direction:column; align-items:flex-start; } .img-preview { width:100%; height:200px; } }
    
    .upload-form h3 { color:#a5b4fc; margin-bottom:.5rem; font-size:1.1rem; word-break:break-word; }
    .upload-form p { color:#7b82a8; font-size:.85rem; margin-bottom:1rem; word-break:break-all; }
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
  <div class="page-header" style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:1rem;">
    <div>
      <h1>Manage Website Images</h1>
      <p>Upload and update the main images displayed on your site.</p>
    </div>
    
    <div class="view-controls">
      <button class="view-btn active" id="btnList" onclick="setView('list')"><i class="fas fa-list"></i> List</button>
      <button class="view-btn" id="btnGrid" onclick="setView('grid')"><i class="fas fa-border-all"></i> Grid</button>
    </div>
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

  <div class="image-container list-view" id="imgContainer">
    <?php foreach ($image_details as $db_key => $details): 
        // Get image from DB, or fallback to the specific correct default image
        $current_src = $current_images[$db_key] ?? $details['default'];
    ?>
    <div class="image-card">
      <!-- Use exactly the correct default image for each unique position -->
      <img src="../<?= htmlspecialchars($current_src) ?>" alt="Preview" class="img-preview" onerror="this.src='../<?= htmlspecialchars($details['default']) ?>'">
      
      <div class="upload-form">
        <h3><?= htmlspecialchars($details['label']) ?></h3>
        <p>Current file: <code><?= htmlspecialchars($current_src) ?></code></p>
        
        <form method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; align-items:flex-start; width:100%;">
          <input type="hidden" name="section_key" value="<?= $db_key ?>">
          <input type="file" name="imageUpload" class="file-input" accept="image/png, image/jpeg, image/gif, image/webp" required>
          <button type="submit" class="btn-admin btn-indigo" style="padding:.5rem 1.5rem; width:100%; justify-content:center;">
            <i class="fas fa-upload"></i> Upload & Replace
          </button>
        </form>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

</main>

<script>
  // Simple view toggler
  function setView(view) {
    const container = document.getElementById('imgContainer');
    const btnList = document.getElementById('btnList');
    const btnGrid = document.getElementById('btnGrid');
    
    if (view === 'grid') {
      container.classList.remove('list-view');
      container.classList.add('grid-view');
      btnGrid.classList.add('active');
      btnList.classList.remove('active');
      localStorage.setItem('adminImgView', 'grid');
    } else {
      container.classList.remove('grid-view');
      container.classList.add('list-view');
      btnList.classList.add('active');
      btnGrid.classList.remove('active');
      localStorage.setItem('adminImgView', 'list');
    }
  }

  // Restore saved view preference
  if (localStorage.getItem('adminImgView') === 'grid') {
    setView('grid');
  }
</script>
</body>
</html>
