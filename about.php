<?php require_once __DIR__ . '/admin/includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Sabbir | <?= get_site_content($pdo, 'site_title') ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .about-hero { padding-top: calc(var(--nav-height) + 4rem); padding-bottom: 4rem; }
        .about-image { width: 100%; border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); max-height: 600px; object-fit: cover; }
        .experience-timeline { border-left: 2px solid var(--color-primary); padding-left: 2rem; margin-top: 2rem; }
        .timeline-item { position: relative; margin-bottom: 2rem; }
        .timeline-item::before { content: ''; position: absolute; left: -2.4rem; top: 0; width: 16px; height: 16px; border-radius: 50%; background: var(--color-primary); border: 4px solid var(--color-bg); box-shadow: 0 0 0 2px var(--color-primary); }
        .timeline-date { font-size: 0.875rem; color: var(--color-primary); font-weight: 600; margin-bottom: 0.5rem; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">Sabbir<span>.</span></a>
            <ul class="nav-links">
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="about.php" class="nav-link active">About</a></li>
                <li><a href="services.php" class="nav-link">Services</a></li>
                <li><a href="portfolio.php" class="nav-link">Portfolio</a></li>
                <li><a href="contact.php" class="nav-link">Contact</a></li>
                <li><a href="contact.php" class="btn btn-primary" style="padding: 0.5rem 1rem;">Hire Me</a></li>
            </ul>
            <button class="mobile-menu-btn"><i class="fas fa-bars"></i></button>
        </div>
    </nav>

    <section class="section about-hero container fade-in-up">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <div class="badge"><?= get_site_content($pdo, 'about_badge') ?></div>
                <h1 class="section-title"><?= get_site_content($pdo, 'about_hero_title') ?> <span><?= get_site_content($pdo, 'about_hero_title_highlight') ?></span></h1>
                <p>For over 5 years, I have been building high-performing, visually stunning web experiences. I specialize in WordPress theme customization, Elementor and Gutenberg development, and crafting tailored eCommerce and landing pages.</p>
                <p>My goal is not just to build standard websites, but to construct robust, reliable digital platforms that accelerate business growth and leave lasting impressions.</p>
                
                <h3 class="font-bold text-lg" style="margin-top:2rem;">My Working Style</h3>
                <ul class="flex-col gap-2" style="margin-top: 1rem; color: var(--color-text-muted);">
                    <li><i class="fas fa-check-circle text-primary"></i> <strong>Client First:</strong> Transparent communication and setting clear milestones.</li>
                    <li><i class="fas fa-check-circle text-primary"></i> <strong>Quality Output:</strong> Clean code, responsive design, and blazing fast speeds.</li>
                    <li><i class="fas fa-check-circle text-primary"></i> <strong>Future Proof:</strong> Empowering you to easily manage and update your content.</li>
                </ul>
            </div>
            <div>
                <img src="<?= get_raw_content($pdo, 'about_image') ?>" alt="Sabbir Biswas - About Me" class="about-image">
            </div>
        </div>
    </section>

    <section class="section section-bg-alt">
        <div class="container grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="fade-in-up">
                <h2 class="section-title">My Core <span>Strengths</span></h2>
                <div class="flex-col gap-4" style="margin-top: 2rem;">
                    
                    <div>
                        <div class="flex justify-between font-bold" style="margin-bottom:0.5rem;">
                            <span>WordPress Development (Custom Themes, Plugins)</span>
                            <span>95%</span>
                        </div>
                        <div style="height: 8px; width:100%; background:rgba(0,0,0,0.1); border-radius:4px;">
                            <div style="height:100%; width:95%; background:var(--color-primary); border-radius:4px;"></div>
                        </div>
                    </div>

                    <div style="margin-top:1.5rem;">
                        <div class="flex justify-between font-bold" style="margin-bottom:0.5rem;">
                            <span>Elementor & Page Builders</span>
                            <span>98%</span>
                        </div>
                        <div style="height: 8px; width:100%; background:rgba(0,0,0,0.1); border-radius:4px;">
                            <div style="height:100%; width:98%; background:var(--color-primary); border-radius:4px;"></div>
                        </div>
                    </div>

                    <div style="margin-top:1.5rem;">
                        <div class="flex justify-between font-bold" style="margin-bottom:0.5rem;">
                            <span>WooCommerce / eCommerce Integrations</span>
                            <span>90%</span>
                        </div>
                        <div style="height: 8px; width:100%; background:rgba(0,0,0,0.1); border-radius:4px;">
                            <div style="height:100%; width:90%; background:var(--color-primary); border-radius:4px;"></div>
                        </div>
                    </div>

                    <div style="margin-top:1.5rem;">
                        <div class="flex justify-between font-bold" style="margin-bottom:0.5rem;">
                            <span>Performance Optimization & SEO</span>
                            <span>90%</span>
                        </div>
                        <div style="height: 8px; width:100%; background:rgba(0,0,0,0.1); border-radius:4px;">
                            <div style="height:100%; width:90%; background:var(--color-primary); border-radius:4px;"></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="fade-in-up" style="transition-delay:0.2s;">
                <h2 class="section-title">Professional <span>Journey</span></h2>
                <div class="experience-timeline">
                    <div class="timeline-item">
                        <div class="timeline-date">2020 - Present</div>
                        <h4 class="font-bold text-xl">Freelance Premium WordPress Developer</h4>
                        <p>Specializing in full-stack WordPress solutions, delivering tailored themes, robust eCommerce architectures, and custom integrations for global clients.</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-date">2018 - 2020</div>
                        <h4 class="font-bold text-xl">Web Designer & Frontend Dev</h4>
                        <p>Focused on responsive web design, UI/UX principles, and mastering HTML, CSS, and JS before transitioning exclusively into deep WordPress tech.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div>
                    <a href="index.php" class="logo footer-logo" style="display:inline-block;">Sabbir<span>.</span></a>
                    <p style="margin-top: 1rem; max-width: 300px;">Professional WordPress & Elementor Developer. Building websites that drive results and look amazing.</p>
                </div>
                <div>
                    <h4 class="footer-title">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="about.php">About Me</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="portfolio.php">Portfolio</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; <span id="year"></span> Sabbir Biswas. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script src="js/main.js"></script>
    <script>document.getElementById('year').textContent = new Date().getFullYear();</script>
</body>
</html>
