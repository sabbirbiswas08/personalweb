-- Database Schema for Custom Portfolio CMS

-- 1. Create Admin Users Table
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert a default admin user (Username: admin, Password: password123)
-- YOU MUST CHANGE THIS PASSWORD IMMEDIATELY AFTER LOGGING IN
INSERT INTO `admin_users` (`username`, `password_hash`, `email`) VALUES
('admin', '$2y$10$O9b2g1bK2Mvj.qT0P9.M4um6HkT5m4rE3o3zWQ9T9iC.z.c.y.56', 'admin@example.com');


-- 2. Create Form Submissions Table
CREATE TABLE IF NOT EXISTS `form_submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read','replied') DEFAULT 'unread',
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 3. Create Settings Table (For Admin Email, etc)
CREATE TABLE IF NOT EXISTS `settings` (
  `setting_key` varchar(50) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default settings
INSERT INTO `settings` (`setting_key`, `setting_value`, `description`) VALUES
('admin_email', 'hello@sabbirbiswas.com', 'Where contact form submissions are sent'),
('site_title', 'Sabbir Biswas | WordPress Developer', 'Browser tab title');


-- 4. Create Dynamic Content Table
CREATE TABLE IF NOT EXISTS `site_content` (
  `section_key` varchar(100) NOT NULL,
  `content_type` enum('text','long_text','image') NOT NULL,
  `content_value` text NOT NULL,
  `description` varchar(255) DEFAULT '',
  PRIMARY KEY (`section_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert base content for Home Page
INSERT INTO `site_content` (`section_key`, `content_type`, `content_value`, `description`) VALUES
('home_hero_subtitle', 'text', 'Top Rated WordPress Developer', 'Badge text above hero title'),
('home_hero_greeting', 'text', 'Hello, I''m', 'Greeting text in home hero'),
('home_hero_name', 'text', 'Sabbir Biswas', 'Highlighted name in home hero'),
('home_hero_desc', 'long_text', 'I specialize in Elementor, Gutenberg, custom theme development, and building high-converting WordPress websites tailored to your business goals.', 'Main description underneath the name'),
('home_hero_image', 'image', 'images/sabbir.png', 'The main image on the right side of home page'),
('home_stat_1_number', 'text', '5+', 'First stat number'),
('home_stat_1_text', 'text', 'Years Experience', 'First stat text'),
('home_stat_2_number', 'text', '200+', 'Second stat number'),
('home_stat_2_text', 'text', 'Projects Completed', 'Second stat text'),
('home_stat_3_number', 'text', '100%', 'Third stat number'),
('home_stat_3_text', 'text', 'Client Satisfaction', 'Third stat text'),

-- Base Content for About Page
('about_badge', 'text', 'Know More About Me', 'About page top badge'),
('about_hero_title', 'text', 'Hi, I''m Sabbir Biswas, a passionate', 'About hero heading part 1'),
('about_hero_title_highlight', 'text', 'WordPress Expert.', 'About hero heading highlighted text'),
('about_image', 'image', 'images/sabbir biswas.png', 'The main image on the right side of about page');
