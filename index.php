<?php require_once __DIR__ . '/admin/includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= get_site_content($pdo, 'site_title', 'Sabbir Biswas | WordPress Developer') ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero { min-height: 100vh; display: flex; align-items: center; padding-top: var(--nav-height); position: relative; overflow: hidden; }
        .hero::before { content: ''; position: absolute; top: -10%; right: -5%; width: 50%; height: 50%; background: radial-gradient(circle, rgba(37,99,235,0.08) 0%, rgba(255,255,255,0) 70%); z-index: -1; border-radius: 50%; }
        .hero-content { flex: 1; max-width: 600px; }
        .hero-title { font-size: 3.5rem; line-height: 1.1; margin-bottom: 1.5rem; letter-spacing: -1px; }
        .hero-title span { color: var(--color-primary); display: block; }
        .hero-desc { font-size: 1.25rem; margin-bottom: 2.5rem; color: var(--color-text-muted); }
        .hero-image-wrap { flex: 1; display: flex; justify-content: flex-end; position: relative; }
        .hero-image { max-width: 450px; width: 100%; border-radius: 2rem; box-shadow: var(--shadow-hard); border: 2px solid var(--color-text); position: relative; z-index: 2; }
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-top: 4rem; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 3rem; }
        .stat-item h3 { font-size: 2.5rem; color: var(--color-primary); margin-bottom: 0.5rem; }
        @media (max-width: 992px) { .hero .container { flex-direction: column; text-align: center; } .hero-content { margin-bottom: 4rem; display: flex; flex-direction: column; align-items: center; } .hero-title { font-size: 2.75rem; } .hero-image-wrap { justify-content: center; } }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">Sabbir<span>.</span></a>
            <ul class="nav-links">
                <li><a href="index.php" class="nav-link active">Home</a></li>
                <li><a href="about.php" class="nav-link">About</a></li>
                <li><a href="services.php" class="nav-link">Services</a></li>
                <li><a href="portfolio.php" class="nav-link">Portfolio</a></li>
                <li><a href="contact.php" class="nav-link">Contact</a></li>
                <li><a href="contact.php" class="btn btn-primary" style="padding: 0.5rem 1rem;">Hire Me</a></li>
            </ul>
            <button class="mobile-menu-btn"><i class="fas fa-bars"></i></button>
        </div>
    </nav>

    <section class="hero container">
        <div class="flex items-center justify-between" style="width: 100%;">
            <div class="hero-content fade-in-up">
                <div class="badge"><i class="fas fa-star"></i> <?= get_site_content($pdo, 'home_hero_subtitle') ?></div>
                <h1 class="hero-title"><?= get_site_content($pdo, 'home_hero_greeting') ?> <br><span><?= get_site_content($pdo, 'home_hero_name') ?></span></h1>
                <p class="hero-desc"><?= get_site_content($pdo, 'home_hero_desc') ?></p>
                <div class="flex gap-4">
                    <a href="portfolio.php" class="btn btn-primary">View My Work <i class="fas fa-arrow-right" style="margin-left: 8px;"></i></a>
                    <a href="contact.php" class="btn btn-outline">Contact Me</a>
                </div>

                <div class="stats-grid">
                    <div class="stat-item">
                        <h3><?= get_site_content($pdo, 'home_stat_1_number') ?></h3>
                        <p><?= get_site_content($pdo, 'home_stat_1_text') ?></p>
                    </div>
                    <div class="stat-item">
                        <h3><?= get_site_content($pdo, 'home_stat_2_number') ?></h3>
                        <p><?= get_site_content($pdo, 'home_stat_2_text') ?></p>
                    </div>
                    <div class="stat-item">
                        <h3><?= get_site_content($pdo, 'home_stat_3_number') ?></h3>
                        <p><?= get_site_content($pdo, 'home_stat_3_text') ?></p>
                    </div>
                </div>
            </div>
            
            <div class="hero-image-wrap fade-in-up" style="transition-delay: 0.2s;">
                <img src="<?= get_raw_content($pdo, 'home_hero_image') ?>" alt="Sabbir Biswas - WordPress Developer" class="hero-image">
            </div>
        </div>
    </section>

    <!-- Services Overview (Hardcoded mostly for structure, can make dynamic later if requested) -->
    <section class="section section-bg-alt">
        <div class="container">
            <div class="section-header fade-in-up">
                <h2 class="section-title">What I <span>Do</span></h2>
                <p class="section-subtitle">Delivering high-performance, modern, and scalable WordPress solutions.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="card fade-in-up">
                    <div class="service-icon"><i class="fab fa-wordpress"></i></div>
                    <h3 class="service-title">WordPress Design</h3>
                    <p>Custom, scalable, and responsive WordPress websites built from scratch to elevate your brand presence.</p>
                </div>
                <div class="card fade-in-up" style="transition-delay: 0.1s;">
                    <div class="service-icon"><i class="fas fa-paint-brush"></i></div>
                    <h3 class="service-title">Elementor Expert</h3>
                    <p>Pixel-perfect designs built visually via Elementor, ensuring you can easily edit content later.</p>
                </div>
                <div class="card fade-in-up" style="transition-delay: 0.2s;">
                    <div class="service-icon"><i class="fas fa-shopping-cart"></i></div>
                    <h3 class="service-title">eCommerce Setup</h3>
                    <p>Highly optimized WooCommerce stores designed to increase sales, conversions, and customer trust.</p>
                </div>
            </div>
            
            <div class="text-center" style="margin-top: 3rem;">
                <a href="services.php" class="btn btn-outline fade-in-up">See All Services</a>
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
                <div>
                    <h4 class="footer-title">Connect</h4>
                    <ul class="footer-links" style="display:flex; gap: 1rem; font-size: 1.5rem;">
                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fab fa-github"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
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
