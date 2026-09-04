-- =============================================================
-- Harvest Pro - Database Schema
-- Import this file via phpMyAdmin in your cPanel
-- =============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

-- -------------------------------------------------------------
-- Table: admins  (admin panel login accounts)
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admins` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(150) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default admin. Username: admin  |  Password: admin123
-- (Change the password immediately after first login.)
INSERT INTO `admins` (`username`, `password`, `full_name`) VALUES
('admin', '$2y$10$VEA.ESLJeCgzrwhpleaTVumzvt0zkd/3cnSBVhSqK3XV6vAdcjgSu', 'Site Administrator');

-- -------------------------------------------------------------
-- Table: settings  (single-value site-wide content: key/value)
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `settings` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `setting_key` VARCHAR(100) NOT NULL,
  `setting_value` LONGTEXT DEFAULT NULL,
  `setting_group` VARCHAR(100) DEFAULT 'general',
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `settings` (`setting_key`, `setting_value`, `setting_group`) VALUES
-- Branding
('brand_name', 'Harvest', 'branding'),
('brand_tagline', 'Managing Every Leaf, Every Day', 'branding'),
('brand_logo', '', 'branding'),

-- Ticker strip
('ticker_items', 'Worker Management|Tea Production Tracking|Automated Payroll|Field Activity Monitoring|Multi-Estate Support|Real-Time Analytics', 'ticker'),

-- Why section
('why_badge', 'Why Harvest Pro', 'why'),
('why_checklist', 'Centralized|plantation management\nReal-time|operational insights\nReduced|manual work\nImproved|workforce accountability\nFaster|decision-making', 'why'),
('why_title_1', 'Everything Your Plantation Needs in', 'why'),
('why_title_2', 'One System', 'why'),
('why_para_1', 'Managing a plantation involves multiple moving parts. Harvest Pro brings them together into a single, easy-to-use platform that reduces paperwork, improves accuracy, and saves valuable time.', 'why'),
('why_para_2', 'Whether you manage one estate or multiple plantations, Harvest Pro provides the visibility and control needed to operate efficiently.', 'why'),
('why_stat_number', '40%', 'why'),
('why_stat_label', 'Reduction In Admin Workload', 'why'),
('why_btn_text', 'Learn more', 'why'),
('why_btn_link', '#features', 'why'),
('why_image_1', '', 'why'),
('why_image_2', '', 'why'),

-- Features section
('features_badge', 'Key Features', 'features'),
('features_title_1', 'Powerful Tools for', 'features'),
('features_title_2', 'Modern Plantation Management', 'features'),

-- How It Helps section
('how_badge', 'How It Helps', 'how'),
('how_title', 'Improve Efficiency Across Every Department', 'how'),
('how_para_1', 'Harvest Pro helps plantation teams stay organized by providing complete visibility into workforce activities, production records, operational costs, and estate performance.', 'how'),
('how_para_2', 'With real-time reporting and streamlined workflows, managers can identify opportunities, solve issues quickly, and focus on continuous growth.', 'how'),
('how_tags', 'Increased productivity|Better workforce management|Improved reporting accuracy|Reduced administrative workload|Better operational control', 'how'),

-- CTA section
('cta_kicker', 'Harvest Pro — Grow Smarter. Manage Better.', 'cta'),
('cta_title', 'Ready to Transform Your Plantation Operations?', 'cta'),
('cta_para', 'Take control of your plantation with a smarter management solution built for modern estates. Harvest Pro provides the tools, insights, and automation needed to improve productivity and streamline daily operations.', 'cta'),
('cta_btn1_text', 'Request a Demo', 'cta'),
('cta_btn1_link', '#contact', 'cta'),
('cta_btn2_text', 'Contact Us', 'cta'),
('cta_btn2_link', '#contact', 'cta'),
('cta_bg_image', '', 'cta'),

-- Maintenance mode
('maintenance_mode', '0', 'maintenance'),
('maintenance_title', 'We''ll be right back', 'maintenance'),
('maintenance_message', 'We''re currently performing scheduled maintenance. Please check back shortly.', 'maintenance'),

-- Settings: Logo
('brand_logo_white', '', 'settings'),

-- Settings: Colour Theme
('theme_primary_color', '', 'settings'),
('theme_accent_color', '', 'settings'),

-- Settings: Search Engine Visibility
('seo_title', '', 'settings'),
('seo_description', '', 'settings'),
('seo_keywords', '', 'settings'),
('seo_noindex', '0', 'settings'),

-- Footer
('footer_about', 'Harvest Pro is a smart plantation management platform that simplifies workforce management, production tracking, payroll, field operations, and reporting – all in one place.', 'footer'),
('footer_company', 'Harvest Pro (Pvt) Ltd,', 'footer'),
('footer_address', '27/1, 1St Lane, Boralesgamuwa, Sri Lanka', 'footer'),
('footer_phone', '0777130597', 'footer'),
('footer_email', 'hello@harvestpro.lk', 'footer'),
('footer_facebook', '#', 'footer'),
('footer_youtube', '#', 'footer'),
('footer_instagram', '#', 'footer'),
('footer_linkedin', '#', 'footer'),
('footer_copyright', '© 2025 Harvest Pro. Grow Smarter. Manage Better.', 'footer'),
('footer_credit', 'Creative Elements (Pvt) Ltd\nKode Tech (Pvt) Ltd', 'footer');

-- -------------------------------------------------------------
-- Table: hero_slides  (repeatable full-width hero slider slides)
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `hero_slides` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `headline` VARCHAR(255) NOT NULL DEFAULT '',
  `subtext` TEXT DEFAULT NULL,
  `btn1_text` VARCHAR(100) DEFAULT NULL,
  `btn1_link` VARCHAR(255) DEFAULT NULL,
  `btn2_text` VARCHAR(100) DEFAULT NULL,
  `btn2_link` VARCHAR(255) DEFAULT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT(11) NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `hero_slides` (`headline`, `subtext`, `btn1_text`, `btn1_link`, `btn2_text`, `btn2_link`, `image`, `sort_order`) VALUES
('Smarter Plantation Management. Better Productivity.', 'A modern platform built for the unique demands of tea estates and plantations — from worker management to real-time production tracking, all from one unified system.', 'Request a Demo', '#contact', 'Explore Features', '#features', '', 1);

-- -------------------------------------------------------------
-- Table: features  (repeatable Key-Feature cards)
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `features` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(200) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `sort_order` INT(11) NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `features` (`title`, `description`, `sort_order`) VALUES
('Worker Assignments', 'Assign daily tasks and monitor workforce activities with ease.', 1),
('Tea Production Tracking', 'Record and analyze daily harvesting and production data.', 2),
('Payroll Management', 'Automate payroll calculations based on productivity and attendance.', 3),
('Field Activity Monitoring', 'Track fertilizer applications, spraying schedules, maintenance work, and other estate activities.', 4),
('Performance Reporting', 'Generate detailed reports for management and operational analysis.', 5),
('Multi-Estate Management', 'Manage multiple estates from a single dashboard.', 6);

-- -------------------------------------------------------------
-- Table: demo_requests  (form submissions / leads)
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `demo_requests` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `phone` VARCHAR(50) DEFAULT NULL,
  `message` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
