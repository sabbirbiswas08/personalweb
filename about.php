<?php require_once __DIR__ . '/admin/includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="About Sabbir Biswas — AI Web Developer specializing in PHP, MySQL, JavaScript and WordPress custom solutions.">
  <title>About — <?= get_site_content($pdo,'site_title','Sabbir Biswas') ?></title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .page-hero { padding: calc(var(--nav-h) + 5rem) 0 5rem; }
    .about-photo { width:100%; max-width:420px; border-radius: var(--radius-lg); border:1px solid var(--border); box-shadow: 0 24px 60px rgba(0,0,0,.6), var(--glow-primary); object-fit:cover; height:500px; }
    .timeline { border-left: 2px solid rgba(99,102,241,.3); padding-left: 2rem; margin-top:2rem; }
    .tl-item { position:relative; margin-bottom:2rem; }
    .tl-item::before { content:''; position:absolute; left:-2.4rem; top:.25rem; width:12px; height:12px; border-radius:50%; background:var(--primary); box-shadow:0 0 12px var(--primary); border:2px solid var(--bg); }
    .tl-date { font-size:.78rem; font-weight:700; color:var(--primary-l); letter-spacing:.06em; text-transform:uppercase; margin-bottom:.25rem; }
    .tl-item h4 { color:var(--text); font-size:1rem; margin-bottom:.25rem; }
    .tl-item p  { font-size:.9rem; color:var(--text-muted); margin:0; }
  </style>
</head>
<body>
<nav class="navbar">
  <div class="container flex items-center justify-between">
    <a href="index.php" class="logo">Sabbir<span>.</span></a>
    <ul class="nav-links">
      <li><a href="index.php"    class="nav-link">Home</a></li>
      <li><a href="about.php"    class="nav-link active">About</a></li>
      <li><a href="services.php" class="nav-link">Services</a></li>
      <li><a href="portfolio.php"class="nav-link">Work</a></li>
      <li><a href="contact.php"  class="nav-link">Contact</a></li>
      <li><a href="contact.php"  class="btn btn-primary" style="padding:.6rem 1.4rem;">Hire Me &rarr;</a></li>
    </ul>
    <button class="mobile-menu-btn" id="menuBtn"><i class="fas fa-bars"></i></button>
  </div>
</nav>

<!-- HEADER -->
<section class="page-hero">
  <div class="container">
    <div class="eyebrow fade-up"><i class="fas fa-user"></i> About Me</div>
    <h1 class="section-heading fade-up" style="font-size:clamp(2.2rem,4vw,3.2rem); max-width:700px;">
      Building the Future of the Web with <span class="grad-text">AI & Real Code</span>
    </h1>
  </div>
</section>

<!-- ABOUT GRID -->
<section class="section" style="padding-top:0;">
  <div class="container">
    <div class="grid gap-12" style="grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); align-items:start;">
      <div class="fade-up">
        <img src="images/sabbir.png"
             alt="Sabbir Biswas"
             class="about-photo float"
             onerror="this.src='images/sabbir biswas.png'">
      </div>
      <div class="fade-up" style="transition-delay:.15s;">
        <div class="eyebrow">My Story</div>
        <h2 style="font-size:1.9rem; margin-bottom:1.25rem;">Hi, I'm <span class="grad-text">Sabbir Biswas</span></h2>
        <p>I'm an AI-assisted full-stack web developer who builds complete, production-ready websites from scratch — no templates, no shortcuts. I combine modern AI tools for architecture and design with real PHP, MySQL, HTML/CSS, and JavaScript to create secure, database-driven applications.</p>
        <p>What makes me different is the full workflow: I design, build the backend, configure the database, and deploy it live on cPanel with proper security — all in one. Clients get a fully functional, maintainable product they actually understand.</p>
        <p>I also have deep expertise in WordPress — custom themes, Elementor/Gutenberg development, WooCommerce, and performance optimization — for clients who need proven CMS solutions.</p>

        <div style="display:flex; gap:1rem; flex-wrap:wrap; margin-top:2rem;">
          <a href="portfolio.php" class="btn btn-primary"><i class="fas fa-rocket"></i> View My Work</a>
          <a href="contact.php"   class="btn btn-ghost">Let's collaborate</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SKILLS -->
<section class="section section-alt">
  <div class="container">
    <div class="grid gap-8" style="grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));">

      <div class="fade-up">
        <div class="eyebrow"><i class="fas fa-code"></i> Technical Skills</div>
        <h2 class="section-heading" style="font-size:1.9rem;">What I <span class="grad-text">Know</span></h2>

        <div style="margin-top:2rem;">
          <div class="skill-label"><span>HTML &amp; CSS</span><span>100%</span></div>
          <div class="skill-bar"><div class="skill-fill" style="--w:1.0;"></div></div>

          <div class="skill-label"><span>JavaScript</span><span>90%</span></div>
          <div class="skill-bar"><div class="skill-fill" style="--w:.9;"></div></div>

          <div class="skill-label"><span>PHP (Intermediate)</span><span>75%</span></div>
          <div class="skill-bar"><div class="skill-fill" style="--w:.75;"></div></div>

          <div class="skill-label"><span>MySQL / Databases</span><span>75%</span></div>
          <div class="skill-bar"><div class="skill-fill" style="--w:.75;"></div></div>

          <div class="skill-label"><span>AI Architecture &amp; Prompting</span><span>95%</span></div>
          <div class="skill-bar"><div class="skill-fill" style="--w:.95;"></div></div>

          <div class="skill-label"><span>WordPress &amp; Elementor</span><span>95%</span></div>
          <div class="skill-bar"><div class="skill-fill" style="--w:.95;"></div></div>
        </div>
      </div>

      <div class="fade-up" style="transition-delay:.15s;">
        <div class="eyebrow"><i class="fas fa-briefcase"></i> Experience</div>
        <h2 class="section-heading" style="font-size:1.9rem;">My <span class="grad-text">Journey</span></h2>
        <div class="timeline">
          <div class="tl-item">
            <div class="tl-date">2023 – Present</div>
            <h4>AI-Assisted Full-Stack Web Developer</h4>
            <p>Building fully functional, database-driven web apps using AI tools, PHP/MySQL, and custom admin panels deployed on live cPanel servers.</p>
          </div>
          <div class="tl-item">
            <div class="tl-date">2020 – Present</div>
            <h4>Freelance WordPress Developer</h4>
            <p>Custom themes, Elementor Pro builds, WooCommerce stores, and performance optimization for global clients.</p>
          </div>
          <div class="tl-item">
            <div class="tl-date">2018 – 2020</div>
            <h4>Frontend Web Designer</h4>
            <p>Mastered HTML, CSS, and responsive web design. Built the visual foundation that powers my development work today.</p>
          </div>
        </div>

        <div class="tech-pills" style="margin-top:2rem;">
          <span class="tech-pill">AI Tools</span>
          <span class="tech-pill">PHP</span>
          <span class="tech-pill">MySQL</span>
          <span class="tech-pill">JavaScript</span>
          <span class="tech-pill">HTML/CSS</span>
          <span class="tech-pill">WordPress</span>
          <span class="tech-pill">Supabase</span>
          <span class="tech-pill">cPanel</span>
          <span class="tech-pill">GitHub</span>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- FOOTER -->
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
        <li><a href="about.php">About Me</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="portfolio.php">Portfolio</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul></div>
      <div class="footer-col"><h4>Services</h4><ul>
        <li><a href="services.php">AI Website Building</a></li>
        <li><a href="services.php">PHP &amp; MySQL Apps</a></li>
        <li><a href="services.php">WordPress Dev</a></li>
        <li><a href="services.php">cPanel Deployment</a></li>
      </ul></div>
    </div>
    <div class="footer-bottom">&copy; <span id="yr"></span> Sabbir Biswas. All rights reserved.</div>
  </div>
</footer>

<script>
  document.getElementById('yr').textContent = new Date().getFullYear();
  document.getElementById('menuBtn').addEventListener('click', () => document.querySelector('.nav-links').classList.toggle('open'));
  const obs = new IntersectionObserver(e => e.forEach(x => x.isIntersecting && x.target.classList.add('in-view')), {threshold:.12});
  document.querySelectorAll('.fade-up, .skill-fill').forEach(el => obs.observe(el));
</script>
</body>
</html>
