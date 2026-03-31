-- Update Script for AI Developer Branding Redesign
-- This script will safely update the text and images without touching your users or form submissions.

-- Home Page Updates
UPDATE `site_content` SET `content_value` = 'Elite AI Web & Database Solutions' WHERE `section_key` = 'home_hero_subtitle';
UPDATE `site_content` SET `content_value` = 'Building Secure & Intelligent Web Apps with' WHERE `section_key` = 'home_hero_greeting';
UPDATE `site_content` SET `content_value` = 'Custom AI & PHP' WHERE `section_key` = 'home_hero_name';
UPDATE `site_content` SET `content_value` = 'I leverage cutting-edge AI architecture, intermediate PHP & MySQL, and expert HTML/CSS/JS to construct robust, high-performance dashboards and deployment environments from scratch.' WHERE `section_key` = 'home_hero_desc';

-- Ensure the stats reflect the new aesthetic
UPDATE `site_content` SET `content_value` = '100% Custom' WHERE `section_key` = 'home_stat_1_number';
UPDATE `site_content` SET `content_value` = 'Database Architecture' WHERE `section_key` = 'home_stat_1_text';
UPDATE `site_content` SET `content_value` = 'Next-Gen' WHERE `section_key` = 'home_stat_2_number';
UPDATE `site_content` SET `content_value` = 'UI Glassmorphism' WHERE `section_key` = 'home_stat_2_text';
UPDATE `site_content` SET `content_value` = 'Fully Secured' WHERE `section_key` = 'home_stat_3_number';
UPDATE `site_content` SET `content_value` = 'Server Environments' WHERE `section_key` = 'home_stat_3_text';

-- About Page Updates
UPDATE `site_content` SET `content_value` = 'AI Developer Core Stack' WHERE `section_key` = 'about_badge';
UPDATE `site_content` SET `content_value` = 'Transforming ideas into scaleable' WHERE `section_key` = 'about_hero_title';
UPDATE `site_content` SET `content_value` = 'Database-Driven AI Apps.' WHERE `section_key` = 'about_hero_title_highlight';

-- Site Title
UPDATE `settings` SET `setting_value` = 'Sabbir Biswas | AI & Full-Stack Developer' WHERE `setting_key` = 'site_title';

-- Update the new portfolio mockup images if they existed in the db, but they are hardcoded in portfolio.php right now!
