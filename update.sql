-- =====================================================
-- Sabbir Biswas Portfolio — SAFE UPDATE SCRIPT
-- Run this in phpMyAdmin > SQL tab
-- This will NOT delete your submissions or admin user
-- =====================================================

-- Ensure site_content table exists
CREATE TABLE IF NOT EXISTS `site_content` (
  `id`            INT AUTO_INCREMENT PRIMARY KEY,
  `section_key`   VARCHAR(150) NOT NULL UNIQUE,
  `content_value` TEXT,
  `updated_at`    TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Ensure settings table exists
CREATE TABLE IF NOT EXISTS `settings` (
  `id`            INT AUTO_INCREMENT PRIMARY KEY,
  `setting_key`   VARCHAR(100) NOT NULL UNIQUE,
  `setting_value` TEXT NOT NULL,
  `description`   VARCHAR(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── INSERT OR UPDATE all content keys ────────────────
-- Home Page
INSERT INTO site_content (section_key, content_value) VALUES ('home_hero_image', 'images/sabbir.png') ON DUPLICATE KEY UPDATE content_value = 'images/sabbir.png';
INSERT INTO site_content (section_key, content_value) VALUES ('about_image', 'images/sabbir.png') ON DUPLICATE KEY UPDATE content_value = 'images/sabbir.png';
INSERT INTO site_content (section_key, content_value) VALUES ('home_hero_greeting', 'I Build Secure') ON DUPLICATE KEY UPDATE content_value = 'I Build Secure';
INSERT INTO site_content (section_key, content_value) VALUES ('home_hero_name', 'AI-Powered Websites') ON DUPLICATE KEY UPDATE content_value = 'AI-Powered Websites';
INSERT INTO site_content (section_key, content_value) VALUES ('home_hero_subtitle', 'Available for new projects') ON DUPLICATE KEY UPDATE content_value = 'Available for new projects';
INSERT INTO site_content (section_key, content_value) VALUES ('home_hero_desc', 'From a clean HTML file to a fully deployed, database-driven web application with a custom admin panel — built using AI, PHP, MySQL & JavaScript. No page builders, no shortcuts.') ON DUPLICATE KEY UPDATE content_value = VALUES(content_value);
INSERT INTO site_content (section_key, content_value) VALUES ('home_stat_1_number', '50+') ON DUPLICATE KEY UPDATE content_value = '50+';
INSERT INTO site_content (section_key, content_value) VALUES ('home_stat_1_text', 'Projects Delivered') ON DUPLICATE KEY UPDATE content_value = 'Projects Delivered';
INSERT INTO site_content (section_key, content_value) VALUES ('home_stat_2_number', '5 yrs') ON DUPLICATE KEY UPDATE content_value = '5 yrs';
INSERT INTO site_content (section_key, content_value) VALUES ('home_stat_2_text', 'Web Experience') ON DUPLICATE KEY UPDATE content_value = 'Web Experience';
INSERT INTO site_content (section_key, content_value) VALUES ('home_stat_3_number', '100%') ON DUPLICATE KEY UPDATE content_value = '100%';
INSERT INTO site_content (section_key, content_value) VALUES ('home_stat_3_text', 'Client Satisfaction') ON DUPLICATE KEY UPDATE content_value = 'Client Satisfaction';

-- About Page
INSERT INTO site_content (section_key, content_value) VALUES ('about_badge', 'AI Developer Core Stack') ON DUPLICATE KEY UPDATE content_value = 'AI Developer Core Stack';
INSERT INTO site_content (section_key, content_value) VALUES ('about_hero_title', 'Building the Future of the Web') ON DUPLICATE KEY UPDATE content_value = 'Building the Future of the Web';
INSERT INTO site_content (section_key, content_value) VALUES ('about_hero_title_highlight', 'with AI & Real Code') ON DUPLICATE KEY UPDATE content_value = 'with AI & Real Code';

-- Settings
INSERT INTO settings (setting_key, setting_value, description) VALUES ('admin_email', 'hello@sabbirbiswas.com', 'Email where contact form alerts are sent') ON DUPLICATE KEY UPDATE setting_value = setting_value;
INSERT INTO settings (setting_key, setting_value, description) VALUES ('site_title', 'Sabbir Biswas | AI Web Developer', 'Browser tab title for all pages') ON DUPLICATE KEY UPDATE setting_value = 'Sabbir Biswas | AI Web Developer';
