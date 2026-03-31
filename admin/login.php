<?php
require_once __DIR__ . '/config.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if (isset($_SESSION['admin_id'])) { header('Location: index.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4', DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
        $stmt->execute([trim($_POST['username'] ?? '')]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($_POST['password'] ?? '', $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            header('Location: index.php'); exit;
        } else { $error = 'Invalid username or password.'; }
    } catch (PDOException $e) { $error = 'Database error. Check config.php credentials.'; }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — Portfolio CMS</title>
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body { display:flex; align-items:center; justify-content:center; min-height:100vh; background:#0d0e1a; background-image:radial-gradient(ellipse 60% 50% at 30% 20%, rgba(99,102,241,.12) 0%, transparent 60%), radial-gradient(ellipse 50% 50% at 80% 80%, rgba(168,85,247,.09) 0%, transparent 60%); }
    .login-wrap { width:100%; max-width:420px; padding:1rem; }
    .login-logo { font-family:'Plus Jakarta Sans',sans-serif; font-size:2rem; font-weight:800; color:#f0f2ff; text-align:center; margin-bottom:.3rem; }
    .login-logo span { color:#818cf8; }
    .login-sub { text-align:center; color:#7b82a8; font-size:.9rem; margin-bottom:2rem; }
    .login-card { background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.08); border-radius:18px; padding:2.5rem; box-shadow:0 24px 64px rgba(0,0,0,.55), inset 0 1px 0 rgba(255,255,255,.07); }
    .login-card h2 { font-family:'Plus Jakarta Sans',sans-serif; font-size:1.35rem; color:#f0f2ff; margin-bottom:.25rem; }
    .login-card .hint { color:#7b82a8; font-size:.875rem; margin-bottom:2rem; }
    .fg { margin-bottom:1.25rem; }
    .fg label { display:block; font-size:.83rem; font-weight:600; color:#8b9cba; margin-bottom:.45rem; }
    .iw { position:relative; }
    .iw i { position:absolute; left:1rem; top:50%; transform:translateY(-50%); color:#4d5475; font-size:.875rem; pointer-events:none; }
    .iw input { width:100%; padding:.85rem 1rem .85rem 2.75rem; background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.1); border-radius:10px; font-family:inherit; font-size:.93rem; color:#e2e5f0; transition:.2s; }
    .iw input:focus { outline:none; border-color:#6366f1; box-shadow:0 0 0 3px rgba(99,102,241,.2); background:rgba(99,102,241,.05); }
    .btn-login { width:100%; padding:.92rem; background:linear-gradient(135deg,#6366f1,#8b5cf6); color:#fff; border:none; border-radius:10px; font-size:1rem; font-weight:700; cursor:pointer; transition:.3s; margin-top:.75rem; box-shadow:0 0 28px rgba(99,102,241,.35); font-family:inherit; letter-spacing:.01em; }
    .btn-login:hover { box-shadow:0 0 40px rgba(168,85,247,.5); transform:translateY(-2px); }
    .err { background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.3); color:#fca5a5; padding:.8rem 1rem; border-radius:8px; margin-bottom:1.25rem; font-size:.875rem; display:flex; align-items:center; gap:.5rem; }
  </style>
</head>
<body>
  <div class="login-wrap">
    <div class="login-logo">Sabbir<span>.</span></div>
    <div class="login-sub">Portfolio Content Management System</div>
    <div class="login-card">
      <h2>Sign In</h2>
      <p class="hint">Enter your admin credentials to continue</p>
      <?php if ($error): ?>
        <div class="err"><i class="fas fa-circle-exclamation"></i> <?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <form method="POST">
        <div class="fg"><label>Username</label><div class="iw"><i class="fas fa-user"></i><input type="text" name="username" required autocomplete="username" placeholder="admin"></div></div>
        <div class="fg"><label>Password</label><div class="iw"><i class="fas fa-lock"></i><input type="password" name="password" required autocomplete="current-password" placeholder="••••••••"></div></div>
        <button type="submit" class="btn-login">Sign In &nbsp;<i class="fas fa-arrow-right"></i></button>
      </form>
    </div>
  </div>
</body>
</html>
