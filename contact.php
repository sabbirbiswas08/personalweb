<?php require_once __DIR__ . '/admin/includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | <?= get_site_content($pdo, 'site_title') ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .page-header { padding-top: calc(var(--nav-height) + 4rem); padding-bottom: 2rem; text-align: center; }
        .contact-info-box { background: var(--color-primary); color: white; padding: 3rem; border-radius: var(--radius-lg); height: 100%; display: flex; flex-direction: column; justify-content: space-between; }
        .info-item { display: flex; align-items: flex-start; margin-bottom: 2rem; }
        .info-icon { font-size: 1.5rem; margin-right: 1.5rem; margin-top: 0.25rem; color: var(--color-accent); }
        .info-details h4 { color: white; font-size: 1.25rem; margin-bottom: 0.25rem; }
        .info-details p, .info-details a { color: rgba(255,255,255,0.8); }
        .social-circles { display: flex; gap: 1rem; margin-top: 2rem; }
        .social-circle { width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.1); color: white; border-radius: 50%; font-size: 1.25rem; transition: var(--transition); }
        .social-circle:hover { background: white; color: var(--color-primary); transform: translateY(-3px); }
        .success-msg { display: none; background: #10B981; color: white; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; font-weight: 500; }
        .success-msg.active { display: block; }
        .error-msg { display: none; background: #ef4444; color: white; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; font-weight: 500; }
        .error-msg.active { display: block; }
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
                <li><a href="portfolio.php" class="nav-link">Portfolio</a></li>
                <li><a href="contact.php" class="nav-link active">Contact</a></li>
                <li><a href="contact.php" class="btn btn-primary" style="padding: 0.5rem 1rem;">Hire Me</a></li>
            </ul>
            <button class="mobile-menu-btn"><i class="fas fa-bars"></i></button>
        </div>
    </nav>

    <header class="page-header container fade-in-up">
        <div class="badge">Get in Touch</div>
        <h1 class="section-title">Let's Discuss Your <span>Project</span></h1>
        <p class="section-subtitle mx-auto" style="max-width: 600px; margin: 0 auto;">Whether you have a clear vision or need a strategic consultation, I am here to help you turn ideas into reality.</p>
    </header>

    <section class="section pt-0">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8" style="background: var(--color-bg); padding: 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); border: 1px solid rgba(0,0,0,0.05);">
                
                <div class="contact-info-box fade-in-up">
                    <div>
                        <h3 class="font-bold text-2xl" style="color: white; margin-bottom: 2rem;">Contact Information</h3>
                        <p style="color: rgba(255,255,255,0.8); margin-bottom: 3rem;">Fill out the form and I will get back to you within 24 hours.</p>

                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                            <div class="info-details">
                                <h4>Call Me</h4>
                                <a href="tel:+1234567890">+123 456 7890</a>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-envelope"></i></div>
                            <div class="info-details">
                                <h4>Email</h4>
                                <a href="mailto:<?= get_site_content($pdo, 'admin_email', 'hello@sabbirbiswas.com') ?>"><?= get_site_content($pdo, 'admin_email', 'hello@sabbirbiswas.com') ?></a>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="info-details">
                                <h4>Location</h4>
                                <p>Working globally, based in Dhaka, BD</p>
                            </div>
                        </div>
                    </div>

                    <div class="social-circles">
                        <a href="#" class="social-circle"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-circle"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-circle"><i class="fab fa-github"></i></a>
                        <a href="#" class="social-circle"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>

                <div class="fade-in-up" style="padding: 2rem; display: flex; flex-direction: column; justify-content: center;">
                    
                    <div id="successMessage" class="success-msg">
                        <i class="fas fa-check-circle" style="margin-right:8px;"></i> Thank you! Your message has been safely saved and emailed to the admin.
                    </div>
                    
                    <div id="errorMessage" class="error-msg">
                        <i class="fas fa-exclamation-triangle" style="margin-right:8px;"></i> <span id="errorText">An error occurred.</span>
                    </div>

                    <form id="contactForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" id="firstName" name="firstName" class="form-control" required placeholder="John">
                            </div>
                            <div class="form-group">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" id="lastName" name="lastName" class="form-control" required placeholder="Doe">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" required placeholder="john@example.com">
                        </div>

                        <div class="form-group">
                            <label for="subject" class="form-label">Project Type</label>
                            <select id="subject" name="subject" class="form-control" required>
                                <option value="" disabled selected>Select an option...</option>
                                <option value="New WordPress Website">New WordPress Website</option>
                                <option value="eCommerce Store">eCommerce Store</option>
                                <option value="Website Redesign">Website Redesign</option>
                                <option value="Other Inquiry">Other Inquiry</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">Message</label>
                            <textarea id="message" name="message" class="form-control" required placeholder="Tell me a bit about what you're looking to achieve..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message <i class="fas fa-paper-plane" style="margin-left:8px;"></i></button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-bottom">
                &copy; <span id="year"></span> Sabbir Biswas. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script src="js/main.js"></script>
    <script>
        document.getElementById('year').textContent = new Date().getFullYear();

        // AJAX Form Submission
        const form = document.getElementById('contactForm');
        const successMsg = document.getElementById('successMessage');
        const errorMsg = document.getElementById('errorMessage');
        const errorText = document.getElementById('errorText');

        if(form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                
                successMsg.classList.remove('active');
                errorMsg.classList.remove('active');

                const btn = form.querySelector('button[type="submit"]');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Sending...';
                btn.disabled = true;

                const formData = new FormData(form);

                fetch('process_contact.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if(data.status === 'success') {
                        successMsg.classList.add('active');
                        form.reset();
                    } else {
                        errorText.textContent = data.message;
                        errorMsg.classList.add('active');
                    }
                })
                .catch(err => {
                    errorText.textContent = "A network error occurred connecting to the backend.";
                    errorMsg.classList.add('active');
                })
                .finally(() => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                    
                    if(successMsg.classList.contains('active')) {
                        setTimeout(() => successMsg.classList.remove('active'), 5000);
                    }
                });
            });
        }
    </script>
</body>
</html>
