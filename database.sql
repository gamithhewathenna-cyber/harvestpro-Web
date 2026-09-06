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

-- Features section (homepage teaser)
('features_badge', 'Key Features', 'features'),
('features_title_1', 'Powerful Tools for', 'features'),
('features_title_2', 'Modern Plantation Management', 'features'),

-- Features page: banner
('features_page_title', 'Everything You Need to Manage Your Tea Estate', 'features_page'),
('features_page_para_1', 'From workforce management and daily field operations to harvesting, payments, expenses, and reporting, the platform brings your essential tea estate operations together in one simple system.', 'features_page'),
('features_page_para_2', 'Manage multiple estates and sections, track daily activities, monitor costs, and get a clearer view of your estate''s performance from anywhere.', 'features_page'),
('features_page_bg_image', '', 'features_page'),

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

-- Settings: Search Engine Visibility (site-wide)
('google_site_verification', 'vaXiRQKZpTwzak12Ic9yvE5Gjfj3in1QjWKJyAqmtOg', 'settings'),

-- Per-page SEO
('home_seo_title', '', 'seo'),
('home_seo_description', '', 'seo'),
('home_seo_keywords', '', 'seo'),
('home_seo_noindex', '0', 'seo'),
('about_seo_title', '', 'seo'),
('about_seo_description', '', 'seo'),
('about_seo_keywords', '', 'seo'),
('about_seo_noindex', '0', 'seo'),
('features_seo_title', '', 'seo'),
('features_seo_description', '', 'seo'),
('features_seo_keywords', '', 'seo'),
('features_seo_noindex', '0', 'seo'),
('contact_seo_title', '', 'seo'),
('contact_seo_description', '', 'seo'),
('contact_seo_keywords', '', 'seo'),
('contact_seo_noindex', '0', 'seo'),

-- Contact page: banner
('contact_title_1', 'Ready to Modernize', 'contact'),
('contact_title_2', 'your plantation operations?', 'contact'),
('contact_subtitle', 'Contact our team to schedule a demonstration and learn how Harvest Pro can help improve productivity, workforce management, and operational efficiency.', 'contact'),
('contact_banner_image', '', 'contact'),

-- Contact page: form
('contact_form_title', 'Request A Demo Today', 'contact'),
('contact_form_subtitle', 'Discover how Harvest Pro can help you grow smarter and manage better.', 'contact'),
('contact_form_note', '*We typically respond within one business day.', 'contact'),

-- Contact page: map
('contact_map', '27/1, 1St Lane, Boralesgamuwa, Sri Lanka', 'contact'),

-- About page: banner
('about_title', 'Built for Plantations,\nby **Industry** & Technology Experts.', 'about'),
('about_subtitle', 'Lorem ipsum dolor sit amet consectetur. Velit nulla leo in massa tincidunt nulla elementum nunc. In gravida dictumst in magnis elit morbi.', 'about'),
('about_banner_image', '', 'about'),

-- About page: story
('about_story_badge', 'Our Story', 'about'),
('about_story_title', 'About Harvest Pro', 'about'),
('about_story_para_1', 'Harvest Pro was developed to address the growing operational challenges faced by plantation and tea estate managers.', 'about'),
('about_story_para_2', 'Traditional estate management often relies on manual records, spreadsheets, and disconnected processes. Harvest Pro brings these activities together into a centralized digital platform that improves visibility, accuracy, and efficiency.', 'about'),
('about_story_para_3', 'Our mission is to help plantations modernize their operations through technology, enabling managers to make better decisions while reducing administrative complexity.', 'about'),
('about_vision_title', 'Our Vision', 'about'),
('about_vision_text', 'To become the leading plantation management platform that empowers estates through digital transformation and data-driven decision-making.', 'about'),
('about_mission_title', 'Our Mission', 'about'),
('about_mission_text', 'To simplify plantation operations by providing innovative tools that improve productivity, workforce management, and operational performance.', 'about'),
('about_story_image', '', 'about'),

-- About page: development partners
('about_partners_badge', 'Platform Features', 'about'),
('about_partners_title', 'Developed by Two Experts,\nUnited by One Goal', 'about'),
('about_partner1_logo', '', 'about'),
('about_partner1_name', 'Creative Elements (Pvt) Ltd', 'about'),
('about_partner1_desc', 'Bringing expertise in user experience, business strategy, branding, and digital solutions. Creative Elements ensures Harvest Pro is intuitive, impactful, and truly aligned to user needs.', 'about'),
('about_partner1_tags', 'Digital Transformation|UX & Product Strategy|Branding & Innovation', 'about'),
('about_partner2_logo', '', 'about'),
('about_partner2_name', 'Kode Tech (Pvt) Ltd', 'about'),
('about_partner2_desc', 'Specializing in software engineering, system architecture, and technology innovation. Kode Tech builds the scalable, reliable backbone that powers everything Harvest Pro does.', 'about'),
('about_partner2_tags', 'Software Development|System Architecture|Cloud & Technology Solutions', 'about'),
('about_partners_footer', 'Together, we are committed to building smarter solutions that help plantations grow, operate efficiently, and embrace the future of digital estate management', 'about'),

-- About page: why choose
('about_why_badge', 'Why Choose', 'about'),
('about_why_title', 'Why Choose Harvest Pro', 'about'),
('about_why_items', 'Plantation-Focused Solution|Built specifically for tea estates and plantations, helping you manage daily operations in one place.\nEasy-to-Use Interface|A simple, user-friendly system designed for owners, managers, supervisors, and estate teams.\nReal-Time Operational Insights|Track workforce, harvesting, expenses, tasks, and estate performance with up-to-date information.\nScalable for Small and Large Estates|Whether you manage a single estate or multiple plantations, Harvest Pro can grow with your operation.\nContinuous Innovation and Support|Regular improvements, new features, and ongoing support to keep your plantation management running smoothly.', 'about'),

-- About page: CTA
('about_cta_kicker', 'Harvest Pro — Grow Smarter. Manage Better.', 'about'),
('about_cta_title', 'Ready to Transform Your Plantation Operations?', 'about'),
('about_cta_para', 'Take control of your plantation with a smarter management solution built for modern estates. Harvest Pro provides the tools, insights, and automation needed to improve productivity and streamline daily operations.', 'about'),
('about_cta_btn1_text', 'Request a Demo', 'about'),
('about_cta_btn1_link', '/contact', 'about'),
('about_cta_btn2_text', 'Contact Us', 'about'),
('about_cta_btn2_link', '/contact', 'about'),
('about_cta_bg_image', '', 'about'),

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
  `icon` VARCHAR(255) DEFAULT NULL,
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
-- Table: feature_sections  (repeatable alternating text/image sections
-- on the dedicated Features page)
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `feature_sections` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kicker` VARCHAR(150) DEFAULT NULL,
  `title` VARCHAR(255) NOT NULL,
  `intro` TEXT DEFAULT NULL,
  `body` TEXT DEFAULT NULL,
  `list1_heading` VARCHAR(150) DEFAULT NULL,
  `list1_items` TEXT DEFAULT NULL,
  `list2_heading` VARCHAR(150) DEFAULT NULL,
  `list2_items` TEXT DEFAULT NULL,
  `note` TEXT DEFAULT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT(11) NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `feature_sections`
  (`kicker`, `title`, `intro`, `body`, `list1_heading`, `list1_items`, `list2_heading`, `list2_items`, `note`, `image`, `sort_order`)
VALUES
('Workforce Management', 'Manage Your Workforce with Ease',
 'Keep your permanent and casual workforce organised with centralised worker profiles and simple daily work allocation.',
 'Register workers with their essential information, assign them to estates and sections, and record their daily work and output in one place.',
 'Key Features', 'Worker registration and profiles\nPermanent and casual worker support\nAssign workers by estate and section\nDaily task assignments\nAssign work by work type\nRecord output in KG, hours, or units\nActive and inactive worker management',
 '', '',
 'The system supports worker details including name, ID, NIC, phone number, gender, assigned estates, and work categories.',
 '', 1),

('Daily Task & Output Management', 'Know What Work Is Happening Every Day',
 'Create daily assignments for workers and maintain a clear record of work completed across your estate.',
 'Supervisors can select the estate, section, work type, worker, and quantity completed, helping management maintain accurate operational records.',
 'Track work such as:', 'Tea plucking\nWeeding\nClearing\nOther configurable estate activities',
 '', 'KG-based work\nHourly work\nUnit-based work',
 'Work types and rates can be configured according to the estate''s requirements.',
 '', 2),

('Payroll & Payments', 'Turn Daily Work into Accurate Payments',
 'Reduce manual calculations by connecting recorded fieldwork directly with worker payments.',
 'The system automatically calculates pay using the configured rate and completed quantity, making it easier to manage both output-based and other types of fieldwork.',
 'Key Features', 'Automatic pay calculation\nRate x quantity calculation\nKG/output-based payments\nHourly and fixed-unit work support\nPending payment tracking\nPartial payment tracking\nPaid status tracking\nWorker payment reports\nPay-slip reports\nPDF and Excel exports',
 '', '',
 'Full Payroll Dashboard — Coming Soon|While payment calculations and reports are already available, the dedicated full payroll dashboard is an upcoming feature.',
 '', 3),

('Harvest Tracking', 'Track Every Kilogram of Green Leaf',
 'Maintain accurate daily harvesting records and understand how different sections and estates are performing.',
 'Harvest information is recorded through daily worker assignments and can be viewed through dashboards and reports.',
 'Key Features', 'Daily green leaf KG recording\nWorker-level harvest output\nSection-wise harvest monitoring\nEstate-wise harvest monitoring\nHistorical harvest summaries\nHarvest performance reporting\nTop-worker visibility',
 '', '',
 'This feature focuses specifically on field harvesting and green leaf KG, rather than factory tea-production processes.',
 '', 4),

('Estate & Section Management', 'Manage Multiple Estates from One System',
 'Organise your operations around the way your tea business actually works.',
 'Create and manage multiple estates and divide them into sections so that workforce activities, harvesting, expenses, and other operational information can be recorded against the correct location.',
 'Key Features', 'Multi-estate management\nSection management\nAssign workers to estates\nSection-based work assignments\nEstate and section performance tracking\nCentralised operational visibility',
 '', '',
 'Estate and section management forms a core part of the platform rather than functioning as a simple secondary setting.',
 '', 5),

('Fertilizer & Field Activity Tracking', 'Stay Ahead of Important Field Activities',
 'Keep important fertilizer applications and recurring estate activities organised.',
 'Record fertilizer applications and use next-cycle reminders to help ensure important field activities aren''t overlooked.',
 'Key Features', 'Fertilizer application tracking\nSection-based records\nNext-cycle reminders\nCalendar reminders\nField activity planning',
 '', '',
 'This gives estate managers visibility beyond harvesting and helps organise recurring field operations.',
 '', 6),

('Expenses & Cost Control', 'Understand Where Your Estate Is Spending',
 'Record operational expenses against estates and sections to maintain a clearer picture of costs across the business.',
 'Create your own expense categories and distinguish between company-paid and worker-paid costs.',
 'Key Features', 'Estate expense logging\nSection expense logging\nCustom expense categories\nCompany-paid costs\nWorker-paid costs\nExpense reports\nCost breakdowns',
 '', '',
 'This allows management to review operational spending alongside workforce and harvest information.',
 '', 7),

('Reports & Insights', 'Turn Daily Estate Data into Useful Information',
 'Get a clearer understanding of your operations through dashboards and downloadable reports.',
 'Instead of relying on scattered records, management can access information covering assignments, payments, expenses, and harvesting from one system.',
 'Available Reporting Areas', 'Daily assignments\nWorker payments\nExpenses\nHarvest\nEstate and section performance',
 'Reporting Features', 'English reports\nSinhala reports\nPDF export\nExcel export',
 'The platform currently supports four key reporting areas: assignments, payments, expenses, and harvest.',
 '', 8),

('Operations Dashboard', 'Your Estate at a Glance',
 'See the important areas of your estate operations from one central dashboard.',
 'Monitor workforce activity, harvesting, payments, expenses, and operational performance without having to go through individual records.',
 'Dashboard Insights', 'Worker information\nHarvest information\nPayroll/payment information\nExpense information\nEstate performance\nSection performance',
 '', '',
 'The dashboard is designed to give management a quick operational overview of the estate.',
 '', 9),

('Live TV Dashboard', 'Keep Your Team Informed in Real Time',
 'Display important estate information on a dedicated TV screen in your office or operational area.',
 'The Live TV Dashboard provides an easy way for management and teams to view key estate information on a larger screen without navigating through the main system.',
 'Ideal for', 'Estate offices\nManagement areas\nOperational displays\nDaily performance visibility',
 '', '',
 'Live TV display is already included among the platform''s current reporting and insight capabilities.',
 '', 10),

('User Roles & Access', 'Give the Right Access to the Right People',
 'Different members of an estate team have different responsibilities. Role-based access helps organise system access according to each person''s operational role.',
 '',
 'Available Roles', 'Administrator\nPlanter\nSupervisor',
 '', '',
 'This helps make the platform suitable for structured estate operations rather than functioning as a generic workforce application.',
 '', 11);

-- -------------------------------------------------------------
-- Table: demo_requests  (form submissions / leads)
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `demo_requests` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `company` VARCHAR(150) DEFAULT NULL,
  `email` VARCHAR(150) NOT NULL,
  `phone` VARCHAR(50) DEFAULT NULL,
  `estates` VARCHAR(50) DEFAULT NULL,
  `message` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
