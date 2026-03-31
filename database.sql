-- =====================================================
-- Sabbir Biswas Portfolio Database
-- FULL SETUP — run this once in phpMyAdmin
-- =====================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ── ADMIN USERS ──────────────────────────────────────
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id`            INT AUTO_INCREMENT PRIMARY KEY,
  `username`      VARCHAR(100) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at`    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default: username=admin  password=password123
-- (Change immediately after first login via Settings page)
INSERT INTO `admin_users` (`username`, `password_hash`) VALUES
('admin', '$2y$12$eA5x6Gd9Lq0cV3NEfFnRQuexMz.WvAVHW2Bh8xfY5I8V7K3D4lbcG');

-- ── FORM SUBMISSIONS ──────────────────────────────────
DROP TABLE IF EXISTS `form_submissions`;
CREATE TABLE `form_submissions` (
  `id`         INT AUTO_INCREMENT PRIMARY KEY,
  `first_name` VARCHAR(100) NOT NULL,
  `last_name`  VARCHAR(100) NOT NULL,
  `email`      VARCHAR(150) NOT NULL,
  `subject`    VARCHAR(200) DEFAULT '',
  `message`    TEXT NOT NULL,
  `status`     ENUM('unread','read') DEFAULT 'unread',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── SETTINGS ─────────────────────────────────────────
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id`            INT AUTO_INCREMENT PRIMARY KEY,
  `setting_key`   VARCHAR(100) NOT NULL UNIQUE,
  `setting_value` TEXT NOT NULL,
  `description`   VARCHAR(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `settings` (`setting_key`, `setting_value`, `description`) VALUES
('admin_email', 'hello@sabbirbiswas.com',              'Email address where contact form submissions are sent'),
('site_title',  'Sabbir Biswas | AI Web Developer',    'Browser tab title shown for all pages');

-- ── SITE CONTENT ─────────────────────────────────────
DROP TABLE IF EXISTS `site_content`;
CREATE TABLE `site_content` (
  `id`            INT AUTO_INCREMENT PRIMARY KEY,
  `section_key`   VARCHAR(150) NOT NULL UNIQUE,
  `content_value` TEXT,
  `updated_at`    TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `site_content` (`section_key`, `content_value`) VALUES
-- ── Home Page
('home_hero_image',       'images/sabbir.jpg'),
('home_hero_pill',        'Available for new projects'),
('home_hero_h1_line1',    'I Build Secure'),
('home_hero_h1_line2',    'AI-Powered Websites'),
('home_hero_h1_line3',    'with Real Databases'),
('home_hero_desc',        'From a clean HTML file to a fully deployed, database-driven web application with custom admin panel — built using AI architecture, PHP, MySQL & JavaScript. No page builders, no shortcuts.'),
('home_stat_1_number',    '50+'),
('home_stat_1_text',      'Projects Delivered'),
('home_stat_2_number',    '5 yrs'),
('home_stat_2_text',      'Web Experience'),
('home_stat_3_number',    '100%'),
('home_stat_3_text',      'Client Satisfaction'),

-- ── About Page
('about_image',               'images/sabbir.jpg'),
('about_hero_title',          'Building the Future of the Web with AI & Real Code'),
('about_intro_p1',            'I am an AI-assisted full-stack web developer who builds production-ready websites from scratch — no templates, no shortcuts.'),
('about_intro_p2',            'What makes me different is the full workflow: I design, build the backend, configure the database, and deploy live on cPanel with proper security — all in one.'),

-- ── Admin / Settings
('admin_email_display',   'hello@sabbirbiswas.com');

SET FOREIGN_KEY_CHECKS = 1;
