<?php require_once __DIR__ . '/admin/includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Contact Sabbir Biswas — AI Web Developer. Let's discuss your next website project.">
  <title>Contact — <?= get_site_content($pdo,'site_title','Sabbir Biswas') ?></title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .page-hero { padding: calc(var(--nav-h) + 5rem) 0 4rem; }
    .contact-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap:3rem; align-items:start; }

    /* Info Panel */
    .info-panel {
      background: linear-gradient(145deg, rgba(99,102,241,.12) 0%, rgba(168,85,247,.08) 100%);
      border: 1px solid rgba(99,102,241,.2);
      border-radius: var(--radius-lg);
      padding: 2.5rem;
      position: sticky; top: calc(var(--nav-h) + 2rem);
    }
    .info-item { display:flex; align-items:flex-start; gap:1rem; margin-bottom:2rem; }
    .info-icon {
      width:44px; height:44px; flex-shrink:0;
      background:rgba(99,102,241,.15); border:1px solid rgba(99,102,241,.25);
      border-radius:var(--radius-md);
      display:flex; align-items:center; justify-content:center;
      color:var(--primary-l); font-size:1rem;
    }
    .info-item h4 { font-size:.82rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:.06em; margin-bottom:.2rem; }
    .info-item a, .info-item p { color:var(--text); font-size:.95rem; margin:0; }
    .info-item a:hover { color:var(--primary-l); }
    .social-row { display:flex; gap:.75rem; margin-top:2rem; }

    /* Form Panel */
    .form-panel {
      background: rgba(255,255,255,.03);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      padding: 2.5rem;
    }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
    @media(max-width:600px) { .form-row { grid-template-columns:1fr; } }
    .form-ctrl { width:100%; padding:.88rem 1.1rem; background:rgba(255,255,255,.04); border:1px solid var(--border); border-radius:var(--radius-md); font-family:var(--font-sans); font-size:.95rem; color:var(--text); transition:.2s; }
    .form-ctrl:focus { outline:none; border-color:var(--primary-l); box-shadow:0 0 0 3px rgba(99,102,241,.2); background:rgba(99,102,241,.05); }
    select.form-ctrl option { background:var(--bg-surface); }
    textarea.form-ctrl { min-height:160px; resize:vertical; }

    .spin { display:inline-block; animation:spin .7s linear infinite; }
    @keyframes spin { to { transform:rotate(360deg); } }
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
      <li><a href="portfolio.php"class="nav-link">Work</a></li>
      <li><a href="contact.php"  class="nav-link active">Contact</a></li>
      <li><a href="contact.php"  class="btn btn-primary" style="padding:.6rem 1.4rem;">Hire Me &rarr;</a></li>
    </ul>
    <button class="mobile-menu-btn" id="menuBtn"><i class="fas fa-bars"></i></button>
  </div>
</nav>

<section class="page-hero">
  <div class="container text-center">
    <div class="eyebrow fade-up"><i class="fas fa-paper-plane"></i> Get In Touch</div>
    <h1 class="section-heading fade-up" style="font-size:clamp(2.2rem,4vw,3.2rem); margin:0 auto 1rem;">
      Let's Build Something <span class="grad-text">Together</span>
    </h1>
    <p class="section-sub fade-up" style="margin:0 auto;">Share your project idea and I'll get back to you within 24 hours with a plan.</p>
  </div>
</section>

<section class="section" style="padding-top:0;">
  <div class="container">
    <div class="contact-grid">

      <!-- LEFT: Info -->
      <div class="info-panel fade-up">
        <h2 style="font-size:1.4rem; margin-bottom:.5rem;">Contact Information</h2>
        <p style="font-size:.9rem; color:var(--text-muted); margin-bottom:2rem;">Reach out through any of these channels, or fill the form.</p>

        <div class="info-item">
          <div class="info-icon"><i class="fas fa-envelope"></i></div>
          <div>
            <h4>Email</h4>
            <a href="mailto:<?= get_site_content($pdo,'admin_email','hello@sabbirbiswas.com') ?>"><?= get_site_content($pdo,'admin_email','hello@sabbirbiswas.com') ?></a>
          </div>
        </div>
        <div class="info-item">
          <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
          <div>
            <h4>Based In</h4>
            <p>Dhaka, Bangladesh — Working Globally</p>
          </div>
        </div>
        <div class="info-item">
          <div class="info-icon"><i class="fas fa-clock"></i></div>
          <div>
            <h4>Response Time</h4>
            <p>Usually within 24 hours</p>
          </div>
        </div>
        <div class="info-item">
          <div class="info-icon" style="background:rgba(45,212,191,.1); color:var(--teal); border-color:rgba(45,212,191,.25);"><i class="fas fa-circle" style="font-size:.5rem;"></i></div>
          <div>
            <h4>Availability</h4>
            <p style="color:var(--teal-l); font-weight:600;">Open to new projects</p>
          </div>
        </div>

        <div class="social-row">
          <a href="#" class="social-btn"><i class="fab fa-linkedin-in"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-github"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
        </div>
      </div>

      <!-- RIGHT: Form -->
      <div class="form-panel fade-up" style="transition-delay:.15s;">
        <h2 style="font-size:1.4rem; margin-bottom:.25rem;">Send a Message</h2>
        <p style="font-size:.9rem; margin-bottom:2rem;">Tell me about your project and I'll respond with next steps.</p>

        <div id="alertOk"  class="alert-ok">  <i class="fas fa-circle-check"></i> Message sent! I'll reply within 24 hours.</div>
        <div id="alertErr" class="alert-err"> <i class="fas fa-triangle-exclamation"></i> <span id="errText">Something went wrong.</span></div>

        <form id="contactForm">
          <div class="form-row">
            <div class="form-group">
              <label class="form-label">First Name</label>
              <input type="text" name="firstName" class="form-ctrl" required placeholder="John">
            </div>
            <div class="form-group">
              <label class="form-label">Last Name</label>
              <input type="text" name="lastName" class="form-ctrl" required placeholder="Doe">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-ctrl" required placeholder="john@example.com">
          </div>
          <div class="form-group">
            <label class="form-label">Project Type</label>
            <select name="subject" class="form-ctrl" required>
              <option value="" disabled selected>Select a service...</option>
              <option value="AI Website Build">AI Website Build (full deployment)</option>
              <option value="PHP & MySQL Application">PHP &amp; MySQL Application</option>
              <option value="WordPress Development">WordPress Development</option>
              <option value="WooCommerce Store">WooCommerce Store</option>
              <option value="Other Inquiry">Other Inquiry</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Your Message</label>
            <textarea name="message" class="form-ctrl" required placeholder="Tell me about your project — what you need, your timeline, and any specific requirements..."></textarea>
          </div>
          <button type="submit" class="btn btn-primary" id="submitBtn" style="width:100%; font-size:1rem;">
            <i class="fas fa-paper-plane"></i> Send Message
          </button>
        </form>
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

  // AJAX form
  document.getElementById('contactForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('submitBtn');
    const alertOk  = document.getElementById('alertOk');
    const alertErr = document.getElementById('alertErr');
    const errText  = document.getElementById('errText');

    alertOk.classList.remove('show'); alertErr.classList.remove('show');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-circle-notch spin"></i> Sending...';

    try {
      const res  = await fetch('process_contact.php', { method:'POST', body: new FormData(this) });
      const data = await res.json();
      if (data.status === 'success') {
        alertOk.classList.add('show');
        this.reset();
        setTimeout(() => alertOk.classList.remove('show'), 6000);
      } else {
        errText.textContent = data.message || 'Unknown error.';
        alertErr.classList.add('show');
      }
    } catch {
      errText.textContent = 'Network error. Please try again.';
      alertErr.classList.add('show');
    } finally {
      btn.disabled = false;
      btn.innerHTML = '<i class="fas fa-paper-plane"></i> Send Message';
    }
  });
</script>
</body>
</html>
