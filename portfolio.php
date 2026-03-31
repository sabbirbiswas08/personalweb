<?php require_once __DIR__ . '/admin/includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | <?= get_site_content($pdo, 'site_title') ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .page-header { padding-top: calc(var(--nav-height) + 4rem); padding-bottom: 2rem; text-align: center; }
        .portfolio-filters { display: flex; justify-content: center; gap: 1rem; margin-bottom: 3rem; flex-wrap: wrap; }
        .filter-btn { background: var(--glass-bg); border: var(--glass-border); padding: 0.5rem 1.25rem; border-radius: var(--radius-full); color: var(--color-text-muted); font-weight: 500; cursor: pointer; transition: var(--transition); }
        .filter-btn.active, .filter-btn:hover { background: rgba(6, 182, 212, 0.1); color: var(--color-primary); border-color: var(--color-primary); box-shadow: inset 0 0 10px rgba(6,182,212,0.2); }
        .pulse-coming-soon {
            animation: pulse-glow 2s infinite ease-in-out;
            background: rgba(139, 92, 246, 0.05); border: 1px dashed rgba(139, 92, 246, 0.5);
            display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;
            min-height: 350px; border-radius: var(--radius-lg);
        }
        @keyframes pulse-glow {
            0% { box-shadow: 0 0 0 rgba(139, 92, 246, 0); }
            50% { box-shadow: 0 0 20px rgba(139, 92, 246, 0.2); }
            100% { box-shadow: 0 0 0 rgba(139, 92, 246, 0); }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">Sabbir<span>.</span></a>
            <ul class="nav-links">
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="about.php" class="nav-link">About</a></li>
                <li><a href="services.php" class="nav-link">Services</a></li>
                <li><a href="portfolio.php" class="nav-link active">Portfolio</a></li>
                <li><a href="contact.php" class="nav-link">Contact</a></li>
                <li><a href="contact.php" class="btn btn-primary" style="padding: 0.5rem 1rem;">Hire Me</a></li>
            </ul>
            <button class="mobile-menu-btn"><i class="fas fa-bars"></i></button>
        </div>
    </nav>

    <header class="page-header container fade-in-up">
        <div class="badge"><i class="fas fa-code"></i> My Case Studies</div>
        <h1 class="section-title">Explore My <span>Latest AI Work</span></h1>
        <p class="section-subtitle mx-auto" style="max-width: 600px; margin: 0 auto;">A collection of secure databases, modern UI applications, and fully functional custom deployments.</p>
    </header>

    <section class="section pt-0">
        <div class="container">
            
            <div class="portfolio-filters fade-in-up">
                <button class="filter-btn active">All Projects</button>
                <button class="filter-btn">AI Dashboards</button>
                <button class="filter-btn">Secure DB Systems</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="portfolio-card fade-in-up">
                    <div class="portfolio-img-wrap">
                        <img src="images/ai_dashboard.png" alt="AI Dashboard UI" class="portfolio-img">
                    </div>
                    <div class="portfolio-content">
                        <span class="portfolio-tag" style="background: rgba(6, 182, 212, 0.1); color: var(--color-primary); border-color: rgba(6, 182, 212, 0.3);">PHP & JS App</span>
                        <h3 class="font-bold text-xl" style="margin-bottom:0.5rem; color: #fff;">AI Data Analytics Dashboard</h3>
                        <p class="text-sm">A highly functional, custom-built UI using modern Glassmorphism, driving real-time data flow perfectly into a secure MySQL environment.</p>
                    </div>
                </div>

                <div class="portfolio-card fade-in-up" style="transition-delay: 0.1s;">
                    <div class="portfolio-img-wrap">
                        <img src="images/database_ui.png" alt="Database Interaction Panel" class="portfolio-img">
                    </div>
                    <div class="portfolio-content">
                        <span class="portfolio-tag">Secure MySQL CMS</span>
                        <h3 class="font-bold text-xl" style="margin-bottom:0.5rem; color: #fff;">Scalable Backend Management</h3>
                        <p class="text-sm">Zero WordPress involved. A highly engineered custom PHP backend allowing dynamic structural queries directly from the UI frontend layer.</p>
                    </div>
                </div>

                <div class="portfolio-card fade-in-up" style="transition-delay: 0.2s;">
                    <div class="portfolio-img-wrap">
                        <img src="images/secure_login.png" alt="Secure Login Flow" class="portfolio-img">
                    </div>
                    <div class="portfolio-content">
                        <span class="portfolio-tag" style="background: rgba(16, 185, 129, 0.1); color: #10b981; border-color: rgba(16, 185, 129, 0.3);">Authentication Architecture</span>
                        <h3 class="font-bold text-xl" style="margin-bottom:0.5rem; color: #fff;">Encrypted Portal Design</h3>
                        <p class="text-sm">Server-side authenticated logic flow guarding the AI endpoints utilizing highly secure Session storage mechanisms mitigating typical XSS vectors.</p>
                    </div>
                </div>

                <div class="pulse-coming-soon fade-in-up" style="transition-delay: 0.3s; padding: 2rem;">
                    <i class="fas fa-layer-group" style="font-size: 3rem; color: rgba(139, 92, 246, 0.8); margin-bottom: 1rem; text-shadow: 0 0 10px rgba(139, 92, 246, 0.5);"></i>
                    <h3 class="font-bold text-xl" style="color: #fff;">More Coming Soon...</h3>
                    <p class="text-sm" style="margin-top: 0.5rem;">I am constantly iterating and deploying new AI web applications. Stay tuned for further integrations.</p>
                </div>

            </div>

        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div>
                    <a href="index.php" class="logo footer-logo" style="display:inline-block;">Sabbir<span>.</span></a>
                    <p style="margin-top: 1rem; max-width: 300px;">AI Web Developer specializing in custom database engineering and gorgeous glassmorphism UIs.</p>
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
