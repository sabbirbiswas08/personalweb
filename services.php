<?php require_once __DIR__ . '/admin/includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Services offered by Sabbir Biswas — AI website building, PHP/MySQL, WordPress, eCommerce and cPanel deployment.">
  <title>Services — <?= get_site_content($pdo,'site_title','Sabbir Biswas') ?></title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .page-hero { padding: calc(var(--nav-h) + 5rem) 0 4rem; }
    .service-big-card { background:rgba(255,255,255,.03); border:1px solid var(--border); border-radius:var(--radius-lg); padding:3rem; display:grid; grid-template-columns:1fr 1fr; gap:3rem; align-items:center; position:relative; overflow:hidden; transition:var(--transition); }
    .service-big-card::before { content:''; position:absolute; top:0; right:0; width:300px; height:300px; background:radial-gradient(circle, rgba(99,102,241,.12) 0%, transparent 70%); pointer-events:none; }
    .service-big-card:hover { border-color:var(--border-glow); box-shadow:var(--glow-primary), var(--shadow-card); }
    .service-big-card.accent::before { background:radial-gradient(circle, rgba(168,85,247,.12) 0%, transparent 70%); }
    .service-big-card.accent:hover { border-color:rgba(168,85,247,.45); box-shadow:var(--glow-accent); }
    .sbig-icon { font-size:3rem; margin-bottom:1.5rem; }
    .sbig-icon.ind { color:var(--primary-l); filter:drop-shadow(0 0 12px var(--primary)); }
    .sbig-icon.acc { color:var(--accent-l);  filter:drop-shadow(0 0 12px var(--accent)); }
    .sbig-icon.tel { color:var(--teal-l);    filter:drop-shadow(0 0 12px var(--teal)); }
    .sbig-h { font-size:1.6rem; margin-bottom:.75rem; }
    .sbig-p { margin-bottom:1.5rem; }
    .feature-list { list-style:none; display:flex; flex-direction:column; gap:.6rem; }
    .feature-list li { display:flex; align-items:center; gap:.6rem; font-size:.92rem; color:var(--text-muted); }
    .feature-list li i { color:var(--teal); font-size:.8rem; }
    .cta-banner { background:linear-gradient(135deg, rgba(99,102,241,.15) 0%, rgba(168,85,247,.15) 100%); border:1px solid rgba(99,102,241,.3); border-radius:var(--radius-lg); padding:4rem; text-align:center; position:relative; overflow:hidden; }
    .cta-banner::before { content:''; position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%236366f1' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); pointer-events:none; }
    @media(max-width:900px) { .service-big-card { grid-template-columns:1fr; } }
  </style>
</head>
<body>
<nav class="navbar">
  <div class="container flex items-center justify-between">
    <a href="index.php" class="logo">Sabbir<span>.</span></a>
    <ul class="nav-links">
      <li><a href="index.php"    class="nav-link">Home</a></li>
      <li><a href="about.php"    class="nav-link">About</a></li>
      <li><a href="services.php" class="nav-link active">Services</a></li>
      <li><a href="portfolio.php"class="nav-link">Work</a></li>

      <li><a href="contact.php"  class="btn btn-primary" style="padding:.6rem 1.4rem;">Hire Me &rarr;</a></li>
    </ul>
    <button class="mobile-menu-btn" id="menuBtn"><i class="fas fa-bars"></i></button>
  </div>
</nav>

<section class="page-hero">
  <div class="container text-center">
    <div class="eyebrow fade-up"><i class="fas fa-wand-magic-sparkles"></i> What I Offer</div>
    <h1 class="section-heading fade-up" style="font-size:clamp(2.2rem,4vw,3.2rem); margin:0 auto 1rem;">Full-Stack Services, <span class="grad-text">Powered by AI</span></h1>
    <p class="section-sub fade-up" style="margin:0 auto;">From a blank page to a live, secured, database-driven web application — I handle the full journey.</p>
  </div>
</section>

<section class="section" style="padding-top:0;">
  <div class="container" style="display:flex; flex-direction:column; gap:2rem;">

    <div class="service-big-card fade-up">
      <div>
        <div class="sbig-icon ind"><i class="fas fa-brain"></i></div>
        <h2 class="sbig-h">AI Website Development</h2>
        <p class="sbig-p">I use cutting-edge AI tools to architect, design, and build complete websites — then deploy them on a live server with a real database. Not just prototypes; fully functional products your clients can use from day one.</p>
        <a href="contact.php" class="btn btn-primary"><i class="fas fa-rocket"></i> Get a Custom Site</a>
      </div>
      <ul class="feature-list">
        <li><i class="fas fa-check-circle"></i> AI-designed layout & content architecture</li>
        <li><i class="fas fa-check-circle"></i> Custom PHP backend with admin panel</li>
        <li><i class="fas fa-check-circle"></i> MySQL or Supabase database integration</li>
        <li><i class="fas fa-check-circle"></i> Deployed live on cPanel via GitHub</li>
        <li><i class="fas fa-check-circle"></i> Contact form → database + email alerts</li>
        <li><i class="fas fa-check-circle"></i> Full security: sessions, hashing, validation</li>
      </ul>
    </div>

    <div class="service-big-card accent fade-up" style="transition-delay:.1s;">
      <div>
        <div class="sbig-icon acc"><i class="fas fa-database"></i></div>
        <h2 class="sbig-h">Database-Driven Web Apps</h2>
        <p class="sbig-p">Need something more powerful than a static site? I build relational MySQL or Supabase backends with custom dashboards, secure authentication, REST-ready APIs, and full admin interfaces.</p>
        <a href="contact.php" class="btn btn-ghost">Discuss Your Project</a>
      </div>
      <ul class="feature-list">
        <li><i class="fas fa-check-circle"></i> MySQL schema design & optimization</li>
        <li><i class="fas fa-check-circle"></i> Supabase real-time integration</li>
        <li><i class="fas fa-check-circle"></i> Custom CMS / admin dashboards</li>
        <li><i class="fas fa-check-circle"></i> PDO with prepared statements (no SQL injection)</li>
        <li><i class="fas fa-check-circle"></i> Session-based auth with bcrypt passwords</li>
        <li><i class="fas fa-check-circle"></i> API-ready data layer for future expansion</li>
      </ul>
    </div>

    <div class="service-big-card fade-up" style="transition-delay:.2s; --glow-h:var(--teal);">
      <div>
        <div class="sbig-icon tel"><i class="fab fa-wordpress"></i></div>
        <h2 class="sbig-h">WordPress Expert</h2>
        <p class="sbig-p">For clients who need a proven, editable CMS — I deliver custom WordPress sites using Elementor Pro, Gutenberg blocks, or fully hand-coded themes. WooCommerce stores included.</p>
        <a href="contact.php" class="btn btn-ghost">Book a Consultation</a>
      </div>
      <ul class="feature-list">
        <li><i class="fas fa-check-circle"></i> Custom theme development from scratch</li>
        <li><i class="fas fa-check-circle"></i> Elementor Pro pixel-perfect builds</li>
        <li><i class="fas fa-check-circle"></i> WooCommerce setup & optimization</li>
        <li><i class="fas fa-check-circle"></i> Gutenberg block library development</li>
        <li><i class="fas fa-check-circle"></i> Performance tuning (90+ PageSpeed)</li>
        <li><i class="fas fa-check-circle"></i> Scholarship & LMS directory sites</li>
      </ul>
    </div>

  </div>
</section>

<!-- CTA BANNER -->
<section class="section" style="padding-top:0;">
  <div class="container">
    <div class="cta-banner fade-up">
      <div class="eyebrow" style="margin:0 auto 1.5rem;">Ready to start?</div>
      <h2 style="font-size:2.2rem; margin-bottom:1rem;">Let's Build Something <span class="grad-text">Remarkable</span></h2>
      <p style="max-width:520px; margin:0 auto 2rem;">Every project I take on is built with full attention to security, performance, and real-world deployment. Let's make yours next.</p>
      <a href="contact.php" class="btn btn-primary" style="font-size:1.05rem; padding:.9rem 2.25rem;"><i class="fas fa-paper-plane"></i> Start a Conversation</a>
    </div>
  </div>
</section>

<footer class="footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <a href="index.php" class="logo">Sabbir<span>.</span></a>
        <p>AI Web Developer & Full-Stack Engineer building high-quality, database-driven websites from the ground up.</p>
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
  new IntersectionObserver(e => e.forEach(x => x.isIntersecting && x.target.classList.add('in-view')), {threshold:.1}).observe && document.querySelectorAll('.fade-up').forEach(el => new IntersectionObserver(e => e.forEach(x => x.isIntersecting && x.target.classList.add('in-view')), {threshold:.1}).observe(el));
</script>
</body>
</html>
