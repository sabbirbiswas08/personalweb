<?php require_once __DIR__ . '/admin/includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Sabbir Biswas – AI Web Developer & Full-Stack Engineer. Building fully secure, database-driven websites with AI, PHP, MySQL, JavaScript and WordPress.">
  <title><?= get_site_content($pdo,'site_title','Sabbir Biswas | AI Web Developer') ?></title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    /* ── HERO ────────────────────────────────────────── */
    .hero {
      min-height: 100vh;
      padding-top: var(--nav-h);
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    /* Animated grid lines background */
    .hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(99,102,241,.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(99,102,241,.06) 1px, transparent 1px);
      background-size: 60px 60px;
      -webkit-mask-image: radial-gradient(ellipse 70% 70% at 50% 50%, black 30%, transparent 100%);
      mask-image: radial-gradient(ellipse 70% 70% at 50% 50%, black 30%, transparent 100%);
      pointer-events: none;
    }

    /* Glowing orbs */
    .hero-orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      pointer-events: none;
      opacity: .55;
    }
    .orb-1 { width:500px; height:500px; background:#6366f1; top:-15%; left:-10%; animation: orbDrift 12s ease-in-out infinite; }
    .orb-2 { width:400px; height:400px; background:#a855f7; bottom:-10%; right:-5%;  animation: orbDrift 15s ease-in-out infinite reverse; }
    .orb-3 { width:250px; height:250px; background:#2dd4bf; top:30%;   left:50%;    animation: orbDrift 9s ease-in-out infinite; }

    @keyframes orbDrift {
      0%,100% { transform: translate(0,0) scale(1);   }
      33%      { transform: translate(30px,-25px) scale(1.05); }
      66%      { transform: translate(-20px,20px) scale(.95);  }
    }

    .hero-inner {
      position: relative; z-index: 2;
      display: grid;
      grid-template-columns: 1fr 1fr;
      align-items: center;
      gap: 4rem;
      width: 100%;
    }

    /* ── Hero Text ── */
    .hero-pill {
      display: inline-flex; align-items: center; gap: .5rem;
      background: rgba(99,102,241,.12);
      border: 1px solid rgba(99,102,241,.3);
      border-radius: var(--radius-full);
      padding: .4rem 1.1rem;
      font-size: .78rem; font-weight: 700;
      letter-spacing: .12em; text-transform: uppercase;
      color: var(--primary-l);
      margin-bottom: 1.75rem;
    }
    .hero-pill span { width:8px; height:8px; background:var(--teal); border-radius:50%; animation: pulse-ring 2s ease-out infinite; }

    .hero-h1 {
      font-size: clamp(2.6rem, 5vw, 4rem);
      line-height: 1.08;
      letter-spacing: -.04em;
      margin-bottom: 1.5rem;
    }

    .hero-h1 .line-2 {
      display: block;
      background: var(--grad-text);
      background-size: 200%;
      -webkit-background-clip: text; background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: gradShift 5s ease infinite;
    }

    .hero-desc { font-size: 1.1rem; color: var(--text-muted); max-width: 480px; margin-bottom: 2.5rem; line-height: 1.8; }

    .hero-ctas { display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 3.5rem; }

    /* ── Typing badge ── */
    .live-badge {
      display: inline-flex; align-items: center; gap: .5rem;
      background: rgba(45,212,191,.08);
      border: 1px solid rgba(45,212,191,.2);
      border-radius: var(--radius-full);
      padding: .35rem 1rem;
      font-size: .82rem; font-weight: 600; color: var(--teal-l);
    }

    /* ── Hero Image ── */
    .hero-img-wrap {
      position: relative;
      display: flex; justify-content: center;
    }

    .hero-img-ring {
      position: absolute;
      inset: -20px;
      border-radius: 50%;
      background: conic-gradient(from 0deg, transparent 70%, rgba(99,102,241,.6) 85%, rgba(168,85,247,.6) 100%);
      animation: spinRing 8s linear infinite;
      filter: blur(4px);
    }
    @keyframes spinRing { to { transform: rotate(360deg); } }

    .hero-img {
      width: 380px; height: 440px;
      object-fit: cover; object-position: top;
      border-radius: 2rem;
      border: 2px solid rgba(255,255,255,.1);
      box-shadow: 0 30px 80px rgba(0,0,0,.6), var(--glow-primary);
      position: relative; z-index: 2;
      transition: transform .5s var(--ease);
      animation: float 7s ease-in-out infinite;
    }

    /* Floating badges on image */
    .img-badge {
      position: absolute; z-index: 3;
      background: rgba(13,14,26,.85);
      backdrop-filter: blur(12px);
      border: 1px solid var(--border);
      border-radius: var(--radius-md);
      padding: .65rem 1rem;
      display: flex; align-items: center; gap: .6rem;
      font-size: .82rem; font-weight: 600;
      white-space: nowrap;
      box-shadow: var(--shadow-card);
      animation: float 6s ease-in-out infinite;
    }
    .img-badge i { font-size: 1rem; }
    .badge-ai  { bottom: 15%; left: -2rem; animation-delay: 0s; }
    .badge-db  { top: 18%;    right: -2rem; animation-delay: .8s; }
    .badge-sec { bottom: 40%; right: -2rem; animation-delay: 1.6s; font-size: .78rem; }

    /* Stats row */
    .hero-stats { display: flex; gap: 2.5rem; }
    .hstat h4   { font-size: 1.9rem; font-family: var(--font-display); background: var(--grad-text); background-size:200%; -webkit-background-clip:text; background-clip:text; -webkit-text-fill-color:transparent; animation: gradShift 4s ease infinite; }
    .hstat p    { font-size: .82rem; color: var(--text-muted); margin: 0; }

    /* ── HOW I WORK ── */
    .step-num {
      width: 42px; height: 42px;
      background: var(--grad-primary);
      border-radius: var(--radius-md);
      display: flex; align-items: center; justify-content: center;
      font-family: var(--font-display); font-size: 1.1rem; font-weight: 800;
      color: #fff; margin-bottom: 1.25rem;
      box-shadow: var(--glow-primary);
    }

    .svc-grid  { display: grid; gap: 1.5rem; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
    .step-grid { display: grid; gap: 1.5rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); }
    .section-alt { background: var(--bg-surface); position: relative; }
    @media (max-width: 900px) {
      .hero-inner { grid-template-columns: 1fr; text-align: center; }
      .hero-desc  { margin: 0 auto 2.5rem; }
      .hero-ctas  { justify-content: center; margin: 0 auto 3.5rem; }
      .hero-stats { justify-content: center; flex-wrap: wrap; }
      .hero-img-wrap { display: none; }
      .hero-h1 { font-size: 2.4rem; }
    }
  </style>
</head>
<body>

<!-- NAV -->
<nav class="navbar">
  <div class="container flex items-center justify-between">
    <a href="index.php" class="logo">Sabbir<span>.</span></a>
    <ul class="nav-links">
      <li><a href="index.php"   class="nav-link active">Home</a></li>
      <li><a href="about.php"   class="nav-link">About</a></li>
      <li><a href="services.php"class="nav-link">Services</a></li>
      <li><a href="portfolio.php"class="nav-link">Work</a></li>
      <li><a href="contact.php" class="nav-link">Contact</a></li>
      <li><a href="contact.php" class="btn btn-primary" style="padding:.6rem 1.4rem;">Hire Me &rarr;</a></li>
    </ul>
    <button class="mobile-menu-btn" id="menuBtn"><i class="fas fa-bars"></i></button>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-orb orb-1"></div>
  <div class="hero-orb orb-2"></div>
  <div class="hero-orb orb-3"></div>

  <div class="container">
    <div class="hero-inner">

      <!-- Left: Text -->
      <div class="fade-up">
        <div class="hero-pill">
          <span></span>
          Available for new projects
        </div>

        <h1 class="hero-h1">
          I Build Secure<br>
          <span class="line-2">AI-Powered Websites</span>
          with Real Databases
        </h1>

        <p class="hero-desc">
          From a clean HTML file to a fully deployed, database-driven web application with custom admin panel — built using AI architecture, PHP, MySQL &amp; JavaScript. No page builders, no shortcuts.
        </p>

        <div class="hero-ctas">
          <a href="portfolio.php" class="btn btn-primary"><i class="fas fa-rocket"></i> See My Work</a>
          <a href="contact.php"   class="btn btn-ghost">Let's Talk</a>
        </div>

        <div class="hero-stats">
          <div class="hstat">
            <h4>50+</h4>
            <p>Projects Delivered</p>
          </div>
          <div class="hstat">
            <h4>5 yrs</h4>
            <p>Web Experience</p>
          </div>
          <div class="hstat">
            <h4>100%</h4>
            <p>Client Satisfaction</p>
          </div>
        </div>
      </div>

      <!-- Right: Image -->
      <div class="hero-img-wrap fade-up" style="transition-delay:.2s;">
        <div class="hero-img-ring"></div>
        <img src="<?= get_raw_content($pdo,'home_hero_image','images/sabbir.png') ?>"
             alt="Sabbir Biswas — AI Web Developer"
             class="hero-img">

        <div class="img-badge badge-ai">
          <i class="fas fa-robot" style="color:var(--primary-l)"></i>
          AI-Assisted Development
        </div>
        <div class="img-badge badge-db">
          <i class="fas fa-database" style="color:var(--teal)"></i>
          MySQL / Supabase
        </div>
        <div class="img-badge badge-sec">
          <i class="fas fa-shield-halved" style="color:var(--accent-l)"></i>
          Fully Secured &amp; Deployed
        </div>
      </div>

    </div>
  </div>
</section>

<!-- SERVICES OVERVIEW -->
<section class="section section-alt">
  <div class="container">
    <div class="text-center fade-up" style="margin-bottom:4rem;">
      <div class="eyebrow"><i class="fas fa-wand-magic-sparkles"></i> What I Do</div>
      <h2 class="section-heading">Full-Stack Solutions, <span class="grad-text">Powered by AI</span></h2>
      <p class="section-sub" style="margin:0 auto;">I specialize in building complete web applications from concept to deployment — including AI-generated architecture, custom PHP backends, and WordPress CMS.</p>
    </div>

    <div class="svc-grid">

      <div class="card fade-up">
        <div class="icon-box"><i class="fas fa-brain"></i></div>
        <h3>AI Website Development</h3>
        <p>Complete websites built using AI for design, structure, and code generation — then deployed fully functional on live servers with real databases.</p>
        <div class="tech-pills" style="margin-top:1.25rem;">
          <span class="tech-pill">AI Architecture</span>
          <span class="tech-pill">Custom CMS</span>
          <span class="tech-pill">cPanel Deploy</span>
        </div>
      </div>

      <div class="card fade-up" style="transition-delay:.1s;">
        <div class="icon-box"><i class="fas fa-database"></i></div>
        <h3>Database-Driven Apps</h3>
        <p>I build secure, relational MySQL or Supabase backends with custom admin dashboards, form handlers, and API-ready data layers.</p>
        <div class="tech-pills" style="margin-top:1.25rem;">
          <span class="tech-pill">PHP/MySQL</span>
          <span class="tech-pill">Supabase</span>
          <span class="tech-pill">REST APIs</span>
        </div>
      </div>

      <div class="card fade-up" style="transition-delay:.2s;">
        <div class="icon-box"><i class="fab fa-wordpress"></i></div>
        <h3>WordPress Expert</h3>
        <p>Custom themes, Elementor & Gutenberg builds, WooCommerce stores, and mission-critical plugins tailored to your exact brand.</p>
        <div class="tech-pills" style="margin-top:1.25rem;">
          <span class="tech-pill">Elementor Pro</span>
          <span class="tech-pill">WooCommerce</span>
          <span class="tech-pill">Theme Dev</span>
        </div>
      </div>

    </div>
    <div class="text-center" style="margin-top:3rem;">
      <a href="services.php" class="btn btn-ghost fade-up">View All Services <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="section">
  <div class="container">
    <div class="fade-up" style="margin-bottom:4rem;">
      <div class="eyebrow"><i class="fas fa-circle-nodes"></i> The Process</div>
      <h2 class="section-heading">How I Build Your Website,<br><span class="grad-text">From Zero to Live</span></h2>
    </div>
    <div class="step-grid">
      <div class="card fade-up">
        <div class="step-num">01</div>
        <h3 style="margin-bottom:.5rem;">Discovery</h3>
        <p>We define goals, structure, and tech stack. AI helps map out all pages and features before a single line of code is written.</p>
      </div>
      <div class="card fade-up" style="transition-delay:.1s;">
        <div class="step-num">02</div>
        <h3 style="margin-bottom:.5rem;">Design &amp; Build</h3>
        <p>Modern UI crafted with HTML/CSS/JS. Backend logic in PHP, connected to MySQL or Supabase for dynamic data.</p>
      </div>
      <div class="card fade-up" style="transition-delay:.2s;">
        <div class="step-num">03</div>
        <h3 style="margin-bottom:.5rem;">Secure &amp; Test</h3>
        <p>Authentication, session management, input validation, and SQL injection prevention applied before any deployment.</p>
      </div>
      <div class="card fade-up" style="transition-delay:.3s;">
        <div class="step-num">04</div>
        <h3 style="margin-bottom:.5rem;">Deploy Live</h3>
        <p>Uploaded to cPanel via GitHub version control. Database imported, domain configured, and site tested on live server.</p>
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
        <p>AI Web Developer &amp; Full-Stack Engineer building high-quality, database-driven websites from the ground up.</p>
        <div class="social-row">
          <a href="#" class="social-btn"><i class="fab fa-linkedin-in"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-github"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Navigation</h4>
        <ul>
          <li><a href="about.php">About Me</a></li>
          <li><a href="services.php">Services</a></li>
          <li><a href="portfolio.php">Portfolio</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Services</h4>
        <ul>
          <li><a href="services.php">AI Website Building</a></li>
          <li><a href="services.php">PHP &amp; MySQL Apps</a></li>
          <li><a href="services.php">WordPress Customization</a></li>
          <li><a href="services.php">cPanel Deployment</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      &copy; <span id="yr"></span> Sabbir Biswas. All rights reserved. Built with AI + PHP + ❤️
    </div>
  </div>
</footer>

<script>
  document.getElementById('yr').textContent = new Date().getFullYear();

  // Mobile nav
  const btn   = document.getElementById('menuBtn');
  const links = document.querySelector('.nav-links');
  btn.addEventListener('click', () => links.classList.toggle('open'));

  // Intersection observer for animations
  const obs = new IntersectionObserver((entries) => {
    entries.forEach(e => { if(e.isIntersecting) { e.target.classList.add('in-view'); } });
  }, { threshold: .12 });
  document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));

  // Skill bars – trigger on scroll
  const skillObs = new IntersectionObserver((entries) => {
    entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('in-view'); });
  }, { threshold: .3 });
  document.querySelectorAll('.skill-fill').forEach(el => skillObs.observe(el));
</script>

</body>
</html>
