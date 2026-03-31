<?php require_once __DIR__ . '/admin/includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Portfolio of Sabbir Biswas — AI-built websites, PHP/MySQL applications, and WordPress projects.">
  <title>Work — <?= get_site_content($pdo,'site_title','Sabbir Biswas') ?></title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .page-hero { padding: calc(var(--nav-h) + 5rem) 0 4rem; }
    .projects-grid { display:grid; grid-template-columns:repeat(3, 1fr); gap:1.75rem; }
    @media(max-width:900px) { .projects-grid { grid-template-columns:1fr 1fr; } }
    @media(max-width:600px) { .projects-grid { grid-template-columns:1fr; } }
    .coming-card {
      border:1px dashed rgba(99,102,241,.3);
      border-radius:var(--radius-lg);
      padding:3rem 2rem;
      display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center;
      background:rgba(99,102,241,.03);
      animation: pulseCard 3s ease-in-out infinite;
    }
    @keyframes pulseCard {
      0%,100% { border-color:rgba(99,102,241,.3); box-shadow:none; }
      50% { border-color:rgba(99,102,241,.6); box-shadow:0 0 24px rgba(99,102,241,.12); }
    }
    .proj-result { margin-top:.75rem; font-size:.82rem; font-weight:600; color:var(--teal-l); display:flex; align-items:center; gap:.4rem; }
  </style>
</head>
<body>
<nav class="navbar">
  <div class="container flex items-center justify-between">
    <a href="index.php" class="logo">Sabbir<span>.</span></a>
    <ul class="nav-links">
      <li><a href="index.php"    class="nav-link">Home</a></li>
      <li><a href="about.php"    class="nav-link">About</a></li>
      <li><a href="services.php" class="nav-link">Services</a></li>
      <li><a href="portfolio.php"class="nav-link active">Work</a></li>
      <li><a href="contact.php"  class="nav-link">Contact</a></li>
      <li><a href="contact.php"  class="btn btn-primary" style="padding:.6rem 1.4rem;">Hire Me &rarr;</a></li>
    </ul>
    <button class="mobile-menu-btn" id="menuBtn"><i class="fas fa-bars"></i></button>
  </div>
</nav>

<section class="page-hero">
  <div class="container text-center">
    <div class="eyebrow fade-up"><i class="fas fa-layer-group"></i> My Work</div>
    <h1 class="section-heading fade-up" style="font-size:clamp(2.2rem,4vw,3.2rem); margin:0 auto 1rem;">
      Projects Built with <span class="grad-text">AI + Real Code</span>
    </h1>
    <p class="section-sub fade-up" style="margin:0 auto;">Every project here was designed with AI, built with PHP/MySQL or JavaScript, deployed live on a real server — no page builders, no shortcuts.</p>
  </div>
</section>

<section class="section" style="padding-top:0;">
  <div class="container">
    <div class="projects-grid">

      <!-- Project 1 -->
      <div class="proj-card fade-up">
        <img src="images/ai_dashboard.png" alt="AI Analytics Dashboard" class="proj-img">
        <div class="proj-body">
          <div class="proj-tag">PHP + MySQL</div>
          <h3>AI Analytics Dashboard</h3>
          <p>A custom-built dark-mode admin panel with real-time data visualisation, secure login, and a MySQL backend. Built 100% with AI assistance + PHP.</p>
          <div class="proj-result"><i class="fas fa-arrow-trend-up"></i> Deployed live on cPanel</div>
        </div>
      </div>

      <!-- Project 2 -->
      <div class="proj-card fade-up" style="transition-delay:.1s;">
        <img src="images/database_ui.png" alt="Database Management UI" class="proj-img">
        <div class="proj-body">
          <div class="proj-tag">Supabase + JS</div>
          <h3>Database Management Panel</h3>
          <p>Interactive Supabase-backed admin panel with chart visualizations, filterable tables, and row-level security policies configured server-side.</p>
          <div class="proj-result"><i class="fas fa-arrow-trend-up"></i> Zero SQL injection vectors</div>
        </div>
      </div>

      <!-- Project 3 -->
      <div class="proj-card fade-up" style="transition-delay:.2s;">
        <img src="images/secure_login.png" alt="Secure Authentication Portal" class="proj-img">
        <div class="proj-body">
          <div class="proj-tag">PHP Authentication</div>
          <h3>Encrypted Login Portal</h3>
          <p>Full authentication system with bcrypt password hashing, secure session management, CSRF protection, and rate-limiting on the server side.</p>
          <div class="proj-result"><i class="fas fa-shield-halved"></i> Production-grade security</div>
        </div>
      </div>

      <!-- This portfolio site itself -->
      <div class="proj-card fade-up" style="transition-delay:.3s;">
        <div style="height:240px; background:linear-gradient(135deg, rgba(99,102,241,.15), rgba(168,85,247,.15)); display:flex; align-items:center; justify-content:center;">
          <i class="fas fa-globe" style="font-size:5rem; color:var(--primary-l); filter:drop-shadow(0 0 20px var(--primary));"></i>
        </div>
        <div class="proj-body">
          <div class="proj-tag" style="background:rgba(45,212,191,.1);color:var(--teal-l);border-color:rgba(45,212,191,.3);">This Website</div>
          <h3>This Portfolio — Built with AI</h3>
          <p>This exact website was architected, designed, and deployed using AI assistance. PHP backend, MySQL CMS, custom admin panel + GitHub → cPanel deployment.</p>
          <div class="proj-result"><i class="fas fa-robot"></i> 100% AI-assisted, Real Code</div>
        </div>
      </div>

      <!-- Coming soon x2 -->
      <div class="coming-card fade-up" style="transition-delay:.4s;">
        <i class="fas fa-code" style="font-size:2.5rem; color:rgba(99,102,241,.5); margin-bottom:1.25rem;"></i>
        <h3 style="font-size:1.1rem; margin-bottom:.5rem; color:var(--text);">More Coming Soon</h3>
        <p style="font-size:.88rem; color:var(--text-muted); margin:0;">New projects are constantly in the pipeline. Check back regularly.</p>
      </div>

      <div class="coming-card fade-up" style="transition-delay:.5s; background:rgba(168,85,247,.03); border-color:rgba(168,85,247,.3); animation-name:pulseCardPurp;">
        <style>@keyframes pulseCardPurp {0%,100%{border-color:rgba(168,85,247,.3)}50%{border-color:rgba(168,85,247,.6);box-shadow:0 0 24px rgba(168,85,247,.1)}}</style>
        <i class="fas fa-handshake" style="font-size:2.5rem; color:rgba(168,85,247,.6); margin-bottom:1.25rem;"></i>
        <h3 style="font-size:1.1rem; margin-bottom:.75rem; color:var(--text);">Your Project Here?</h3>
        <p style="font-size:.88rem; color:var(--text-muted); margin:0 0 1.25rem;">Let's build something together and add it to this list.</p>
        <a href="contact.php" class="btn btn-primary" style="padding:.6rem 1.4rem; font-size:.88rem;"><i class="fas fa-paper-plane"></i> Get in Touch</a>
      </div>

    </div>
  </div>
</section>

<footer class="footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <a href="index.php" class="logo">Sabbir<span>.</span></a>
        <p>AI Web Developer building secure, database-driven sites with real PHP, MySQL, and deployed on live servers.</p>
        <div class="social-row">
          <a href="#" class="social-btn"><i class="fab fa-linkedin-in"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-github"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
        </div>
      </div>
      <div class="footer-col"><h4>Navigation</h4><ul>
        <li><a href="about.php">About Me</a></li><li><a href="services.php">Services</a></li>
        <li><a href="portfolio.php">Portfolio</a></li><li><a href="contact.php">Contact</a></li>
      </ul></div>
      <div class="footer-col"><h4>Services</h4><ul>
        <li><a href="services.php">AI Website Building</a></li><li><a href="services.php">PHP &amp; MySQL Apps</a></li>
        <li><a href="services.php">WordPress Dev</a></li><li><a href="services.php">cPanel Deployment</a></li>
      </ul></div>
    </div>
    <div class="footer-bottom">&copy; <span id="yr"></span> Sabbir Biswas. All rights reserved.</div>
  </div>
</footer>

<script>
  document.getElementById('yr').textContent = new Date().getFullYear();
  document.getElementById('menuBtn').addEventListener('click', () => document.querySelector('.nav-links').classList.toggle('open'));
  const obs = new IntersectionObserver(e => e.forEach(x => x.isIntersecting && x.target.classList.add('in-view')), {threshold:.1});
  document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));
</script>
</body>
</html>
