-- =============================================================
-- Harvest Pro — Manual database update
-- Run this ONCE against your live database (phpMyAdmin → SQL tab,
-- or any MySQL client). Safe to re-run: every INSERT uses INSERT
-- IGNORE, so it only adds a row if that setting key doesn't exist
-- yet — it will never overwrite anything you've already customized
-- through the admin panel.
-- =============================================================

SET NAMES utf8mb4;

-- -------------------------------------------------------------
-- 1) hero_slides: per-slide Sinhala columns
--    (Normally added automatically the first time the site runs
--    after the update — this is only needed if that self-healing
--    migration couldn't run, e.g. the database user lacks ALTER
--    privileges. The IF() + PREPARE trick below makes each ALTER
--    safe to run even if the column already exists.)
-- -------------------------------------------------------------

SET @dbname = DATABASE();
SET @tablename = 'hero_slides';

SET @columnname = 'headline_si';
SET @sql = (SELECT IF(
  (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE table_schema = @dbname AND table_name = @tablename AND column_name = @columnname) = 0,
  CONCAT('ALTER TABLE `', @tablename, '` ADD COLUMN `', @columnname, '` VARCHAR(255) NULL'),
  'SELECT 1'
));
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @columnname = 'subtext_si';
SET @sql = (SELECT IF(
  (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE table_schema = @dbname AND table_name = @tablename AND column_name = @columnname) = 0,
  CONCAT('ALTER TABLE `', @tablename, '` ADD COLUMN `', @columnname, '` TEXT NULL'),
  'SELECT 1'
));
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @columnname = 'btn1_text_si';
SET @sql = (SELECT IF(
  (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE table_schema = @dbname AND table_name = @tablename AND column_name = @columnname) = 0,
  CONCAT('ALTER TABLE `', @tablename, '` ADD COLUMN `', @columnname, '` VARCHAR(100) NULL'),
  'SELECT 1'
));
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @columnname = 'btn2_text_si';
SET @sql = (SELECT IF(
  (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE table_schema = @dbname AND table_name = @tablename AND column_name = @columnname) = 0,
  CONCAT('ALTER TABLE `', @tablename, '` ADD COLUMN `', @columnname, '` VARCHAR(100) NULL'),
  'SELECT 1'
));
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

-- Backfill the Sinhala translation onto the original seeded hero slide,
-- ONLY if its English headline still matches the untouched default
-- (so it never overwrites a slide you've since edited).
UPDATE hero_slides
SET headline_si = 'වඩා දක්ෂ වතු කළමනාකරණය. වඩා හොඳ ඵලදායිතාව.',
    subtext_si  = 'තේ වතුයායන් සහ වතුයායන්ගේ අනන්‍ය අවශ්‍යතා සඳහා නිර්මාණය කළ නවීන වේදිකාවකි — කම්කරු කළමනාකරණයේ සිට තථ්‍ය කාලීන නිෂ්පාදන නිරීක්ෂණය දක්වා, සියල්ල එක් ඒකාබද්ධ පද්ධතියකින්.',
    btn1_text_si = 'ආදර්ශනයක් ඉල්ලන්න',
    btn2_text_si = 'විශේෂාංග ගවේෂණය කරන්න'
WHERE headline = 'Smarter Plantation Management. Better Productivity.'
  AND (headline_si IS NULL OR headline_si = '');

-- -------------------------------------------------------------
-- 2) settings: Pricing nav link (Admin → Pricing)
-- -------------------------------------------------------------
INSERT IGNORE INTO settings (setting_key, setting_value, setting_group) VALUES
('price_link', '#', 'price');

-- -------------------------------------------------------------
-- 3) settings: Google Analytics tag (Admin → Settings → Search Engine Visibility)
-- -------------------------------------------------------------
INSERT IGNORE INTO settings (setting_key, setting_value, setting_group) VALUES
('google_analytics_id', 'G-FE0XM4D01M', 'settings');

-- -------------------------------------------------------------
-- 4) settings: Trust section (Admin → Home Page → Trust Section)
-- -------------------------------------------------------------
INSERT IGNORE INTO settings (setting_key, setting_value, setting_group) VALUES
('trust_kicker', 'Your Estate. Your Data. Protected.', 'trust'),
('trust_title', 'Trusted to Keep Your Estate Moving', 'trust'),
('trust1_icon', 'shield', 'trust'),
('trust1_title', 'Secure by Design', 'trust'),
('trust1_desc', 'Your estate data is protected with modern security practices.', 'trust'),
('trust2_icon', 'public', 'trust'),
('trust2_title', 'Always Within Reach', 'trust'),
('trust2_desc', 'Access your plantation operations securely, wherever you are.', 'trust'),
('trust3_icon', 'cloud_done', 'trust'),
('trust3_title', 'Backed Up & Protected', 'trust'),
('trust3_desc', 'Regular backups help keep your important records safe.', 'trust'),
('trust4_icon', 'admin_panel_settings', 'trust'),
('trust4_title', 'Access You Control', 'trust'),
('trust4_desc', 'Give the right people access to the right information.', 'trust');

-- -------------------------------------------------------------
-- 5) settings: Pricing section (Admin → Home Page → Pricing Section)
-- -------------------------------------------------------------
INSERT IGNORE INTO settings (setting_key, setting_value, setting_group) VALUES
('pricing_kicker', 'Simple, Transparent Plans', 'pricing_section'),
('pricing_title', 'Choose Your Plan', 'pricing_section'),
('pricing_subtitle', 'Scale from basic estate management to payroll and complete tea factory operations.', 'pricing_section'),
('pricing1_label', 'Basic Tier', 'pricing_section'),
('pricing1_name', 'Harvest Pro Base Estate Management Plan', 'pricing_section'),
('pricing1_price', '2,000', 'pricing_section'),
('pricing1_note', '14-day free trial on online signup. No charge until you subscribe.', 'pricing_section'),
('pricing1_features', 'Dashboard & Estate Overview\nEmployee & User Management\nService & Daily Assignment\nExpense Tracking\nReminders & Calendar\nReports (Excel & PDF)\nData Backups\nMulti-language Support', 'pricing_section'),
('pricing2_label', 'Mid Tier', 'pricing_section'),
('pricing2_name', 'Harvest Pro Automated Payroll & Estate Plan', 'pricing_section'),
('pricing2_price', '5,000', 'pricing_section'),
('pricing2_note', '14-day free trial on online signup. No charge until you subscribe.', 'pricing_section'),
('pricing2_badge', 'Recommended', 'pricing_section'),
('pricing2_included_label', 'Everything in Basic Tier, plus:', 'pricing_section'),
('pricing2_features', 'Automated Payroll Processing\nWorker & Plantation Payroll Views\nDaily Payroll Summary\nPayment Tracking & History\nBulk Payment Actions\nEPF / ETF contributions, Form C & R4', 'pricing_section'),
('pricing3_label', 'Top Tier', 'pricing_section'),
('pricing3_name', 'Harvest Pro Complete Tea Factory & Operations Suite', 'pricing_section'),
('pricing3_price', '10,000', 'pricing_section'),
('pricing3_note', '14-day free trial on online signup. No charge until you subscribe.', 'pricing_section'),
('pricing3_included_label', 'Everything in Mid Tier, plus:', 'pricing_section'),
('pricing3_features', 'Tea Factory Operations\nLeaf Intake & Weighing\nProcessing & Quality Grading\nFactory Inventory & Stock\nBuyer & Sales Management\nFactory Reports & Analytics', 'pricing_section'),
('pricing_btn_text', 'Request a Demo – 14-Day Free Trial', 'pricing_section'),
('pricing_btn_link', '#contact', 'pricing_section');

-- -------------------------------------------------------------
-- 6) settings: Favicon field exists in the admin now — no row needed
--    until you actually upload one (empty is the correct default).
-- -------------------------------------------------------------

-- -------------------------------------------------------------
-- 7) Optional cleanup: rows that are no longer read by any page
--    (leaving these in place is completely harmless — only run
--    this block if you want the settings table fully tidy).
-- -------------------------------------------------------------
-- DELETE FROM settings WHERE setting_key IN (
--   'home_seo_noindex', 'about_seo_noindex', 'features_seo_noindex', 'contact_seo_noindex',
--   'footer_youtube', 'footer_linkedin'
-- );
