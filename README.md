# Harvest Pro — Website & Admin Panel

A PHP + MySQL website with an admin panel to manage all Home Page content.
Built to run on standard **cPanel** shared hosting (PHP 7.4+ / 8.x, MySQL/MariaDB).

---

## What's included

```
harvestpro/
├── index.php            ← the public Home Page
├── submit.php           ← handles the demo-request / newsletter form
├── database.sql         ← import this into your MySQL database
├── includes/
│   ├── config.php       ← EDIT THIS: your database credentials
│   └── functions.php
├── admin/               ← the admin panel  (yoursite.com/admin)
├── assets/              ← css, js, and placeholder images
└── uploads/             ← images you upload from the admin panel land here
```

---

## Installation on cPanel (5 steps)

### 1. Upload the files
- Log in to cPanel → **File Manager**.
- Go to `public_html` (or a subfolder like `public_html/harvestpro` if you want it in a subdirectory).
- Upload the **harvestpro.zip** and **Extract** it there.
  (You can move the files out of the `harvestpro` folder into `public_html` directly if you want the site at the domain root.)

### 2. Create the database
- cPanel → **MySQL® Databases**.
- Create a new database, e.g. `harvestpro`. cPanel will name it like `youruser_harvestpro`.
- Create a new database user with a strong password.
- **Add the user to the database** and give it **All Privileges**.
- Note the three values: database name, username, password.

### 3. Import the tables
- cPanel → **phpMyAdmin**.
- Select the database you just created (left sidebar).
- Click the **Import** tab → choose **`database.sql`** → **Go**.
- You should see the tables `admins`, `settings`, `features`, `demo_requests` created.

### 4. Enter your credentials
- Open **`includes/config.php`** (File Manager → right-click → Edit).
- Fill in the four values from step 2:
  ```php
  define('DB_HOST', 'localhost');            // usually 'localhost'
  define('DB_NAME', 'youruser_harvestpro');  // your database name
  define('DB_USER', 'youruser_dbuser');      // your database user
  define('DB_PASS', 'your_password');        // your database password
  ```
- Save.

### 5. Done — open your site
- Visit your domain — the Home Page should load.
- Visit **`yourdomain.com/admin`** to log in to the admin panel.

---

## Admin panel login

```
Username:  admin
Password:  admin123
```

**Change this immediately** after first login:
Admin panel → **My Account** → set a new username and password.

---

## Managing content

Everything on the Home Page is editable from the admin panel sidebar:

| Menu item          | Controls |
|--------------------|----------|
| **Branding**       | Brand name, tagline, logo image |
| **Hero Section**   | Main headline, sub-text, buttons, background + dashboard images |
| **Ticker Strip**   | The scrolling green strip of keywords |
| **Why Section**    | Checklist, heading, paragraphs, stat badge, the two photos, button |
| **Features Heading**| The badge + heading text on the green features card |
| **Feature Cards**  | Add / edit / delete the individual feature boxes |
| **How It Helps**   | Heading, paragraphs, and the grey tags |
| **Call To Action** | Kicker, heading, paragraph, buttons, background image |
| **Footer**         | About text, address, phone, email, social links, credits |
| **Demo Requests**  | View & export every form submission (CSV) |
| **My Account**     | Change your login username / password |

Changes go live on the website immediately after you click **Save**.

### Uploading images
On any section with an image field, choose a file and click **Save**. Images are
stored in the `/uploads` folder. Supported: JPG, PNG, WEBP, GIF, SVG (max 8 MB).
Leave a file field empty to keep the current image. Tick **Remove** to clear it.

---

## Notes

- **Other pages** (About Us, etc.) are intentionally set to `#` links for now,
  as agreed — only the Home Page is built at this stage. The navigation and
  footer already list all menu items, ready for future pages.
- **Placeholder images** are included so the site looks complete out of the box.
  Replace them with your real photos via the admin panel.
- **File permissions:** if image uploads fail, set the `uploads/` folder
  permission to `755` (File Manager → right-click `uploads` → Change Permissions).
- **Security:** passwords are stored hashed (bcrypt), the form and admin actions
  use CSRF protection, and all database queries use prepared statements.
  The `includes/` and `uploads/` folders include `.htaccess` protection.

---

## Requirements

- PHP 7.4 or newer (PHP 8.x recommended) with the **PDO MySQL** extension
  (enabled by default on virtually all cPanel hosts).
- MySQL 5.7+ or MariaDB 10.2+.
