/**
 * main.js — Sabbir Biswas Portfolio
 * Handles: mobile nav, navbar scroll effect, scroll animations
 */

document.addEventListener('DOMContentLoaded', () => {

  /* ── MOBILE NAV ─────────────────────────────────────────── */
  const menuBtn  = document.getElementById('menuBtn');
  const navLinks = document.querySelector('.nav-links');
  const icon     = menuBtn?.querySelector('i');

  if (menuBtn && navLinks) {
    menuBtn.addEventListener('click', () => {
      navLinks.classList.toggle('open');
      if (icon) {
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-xmark');
      }
    });

    // Close menu when a link is clicked
    navLinks.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => {
        navLinks.classList.remove('open');
        if (icon) { icon.classList.add('fa-bars'); icon.classList.remove('fa-xmark'); }
      });
    });
  }

  /* ── NAVBAR SCROLL SHADOW ───────────────────────────────── */
  const navbar = document.querySelector('.navbar');
  if (navbar) {
    const onScroll = () => {
      navbar.style.background = window.scrollY > 30
        ? 'rgba(13,14,26,0.95)'
        : 'rgba(13,14,26,0.70)';
    };
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  /* ── SCROLL ANIMATIONS (.fade-up) ───────────────────────── */
  const obs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in-view');
        obs.unobserve(entry.target); // fire once
      }
    });
  }, { threshold: 0.12 });

  document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));

  /* ── SKILL BARS ─────────────────────────────────────────── */
  const skillObs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in-view');
        skillObs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.3 });

  document.querySelectorAll('.skill-fill').forEach(el => skillObs.observe(el));

  /* ── AUTO ACTIVE NAV LINK ───────────────────────────────── */
  const path = location.pathname.split('/').pop() || 'index.php';
  document.querySelectorAll('a.nav-link').forEach(a => {
    const href = a.getAttribute('href');
    if (href === path || (path === '' && href === 'index.php')) {
      a.classList.add('active');
    } else {
      a.classList.remove('active');
    }
  });

});
