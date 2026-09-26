<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/maintenance-gate.php';

$brandName    = setting('brand_name', 'Harvest');
$brandLogo    = setting('brand_logo', '');
$brandLogoUrl = $brandLogo ? image_url('brand_logo') : '';
$faviconUrl   = image_url('favicon');
$brandLogoWhite  = setting('brand_logo_white', '');
$brandLogoNavUrl = $brandLogoWhite ? image_url('brand_logo_white') : $brandLogoUrl;

$themePrimary = setting('theme_primary_color', '');
$themeAccent  = setting('theme_accent_color', '');
$priceLink    = setting('price_link', '#');
$ctaBg        = image_url('cta_bg_image', 'assets/images/cta-bg.jpg');
$bannerBg     = $ctaBg;

// Fallback copy for any future step added without content yet (every step
// below currently has its own real content, so this path isn't hit today).
$hiwComingSoonNote = t('Full step-by-step instructions, screenshots and tips for this section will be added shortly.');

$howSteps = [
    [
        'key'      => 'create-account',
        'icon'     => 'user',
        'title'    => t('Create an Account'),
        'summary'  => t('Sign up for Harvest Pro and start your 14-day free trial. It only takes a few minutes to create your account.'),
        'teaser'   => t('Sign up and start your 14-day free trial.'),
        'substeps' => [
            [t('Visit Harvest Pro'), t('Go to the Harvest Pro website and click Pricing from the main menu.')],
            [t('Choose Your Plan'), t('Select the plan that best suits your estate: Basic Tier, Mid Tier, or Top Tier.')],
            [t('Get Started'), t('Once you have selected your plan, click "Get Started with Plan".')],
            [t('Start Your Free Trial'), t('Click "Start Your 14-Day Free Trial" to continue.')],
            [t('Fill in Your Details'), t('Enter the required information, including your personal details, estate details, mobile number, and city.')],
            [t('Activate Your Trial'), t('Check that all your information is correct, then click "Start 14-Day Trial".')],
            [t('Log In to Harvest Pro'), t('Your account is now ready. Log in to the Harvest Pro system and start managing your tea estate.')],
        ],
        'tip' => t('You can use Harvest Pro free for 14 days before choosing to continue with your selected plan.'),
    ],
    [
        'key'      => 'estate-management',
        'icon'     => 'home',
        'title'    => t('Estate Management'),
        'summary'  => t('After logging in to Harvest Pro, the first thing you need to do is set up your estate.'),
        'teaser'   => t('Add your estate details and sections.'),
        'substeps' => [
            [t('Go to Estate Management'), t('Click Estate Management from the system menu.')],
            [t('Select Your Estate'), t('You will see the tea estate you added when creating your Harvest Pro account. Click on the estate name to open and manage your estate.')],
            [t('Add Another Estate'), t('If you manage more than one tea estate, you can click Add New Estate. To add an additional estate, you will need to select and purchase a new subscription for that estate.')],
            [t('Add Sections to Your Estate'), t('After selecting your estate, you can create the different sections or fields within your estate — for example, Field 01, Field 02, Field 03, New Tea Section, or Old Tea Section. Enter the section name based on how your estate is divided.')],
        ],
        'tip' => t('Once your sections are added, you can use them throughout Harvest Pro to organize and track your estate operations more accurately.'),
    ],
    [
        'key'      => 'service-management',
        'icon'     => 'settings',
        'title'    => t('Service Management'),
        'summary'  => t('Set up the labour services your estate offers, along with how each one is measured and paid.'),
        'teaser'   => t('Add labour services, units, and pay rates.'),
        'substeps' => [
            [t('Go to Service Management'), t('From the left-side menu, click Service Management.')],
            [t('Add a New Service'), t('Click the Add Labour Service button at the top-right of the page. The Add New Service form will appear.')],
            [t('Enter the Service Name'), t('Enter the type of work or service you want to add — for example, Leaf Plucking, Fertilizing, Pruning, or Weeding.')],
            [t('Add a Description'), t('Enter a short description of the service if required.')],
            [t('Select the Status'), t('Set the service status to Active if you want to start using it immediately.')],
            [t('Enter the Unit Type'), t('Enter how the service will be measured — for example, KG for leaf plucking, Unit for an individual task, Tank for spraying, or Day for daily work.')],
            [t('Set the Rate per Unit'), t('Enter the amount you pay for each unit. For example, if leaf plucking is paid at LKR 50 per KG, set Unit Type to KG and Rate per Unit to LKR 50. Or, if a worker is paid LKR 2,000 per day, set Unit Type to Day and Rate per Unit to LKR 2,000.')],
            [t('Single Quantity Service'), t('Tick Single Quantity Service when the service should always be counted as 1 unit — for example, if you pay LKR 2,000 for one full day of work. The quantity field will then be disabled when assigning this service. Leave it unticked for services where the quantity can change, such as 10 KG, 25 KG, or 50 KG of leaf plucking.')],
            [t('Add the Service'), t('Check the details and click Add Service.')],
        ],
        'tip' => t('Your new service is now ready to use when assigning work to employees in Harvest Pro.'),
    ],
    [
        'key'      => 'employee-management',
        'icon'     => 'people',
        'title'    => t('Employee Management'),
        'summary'  => t('Add your workers to Harvest Pro and assign them to the right services and estates.'),
        'teaser'   => t('Add employees and assign services and estates.'),
        'substeps' => [
            [t('Go to Employee Management'), t('From the left-side menu, click Employee Management.')],
            [t('Add a New Employee'), t('Click the Add Employee button at the top-right of the page. The Add New Employee form will appear.')],
            [t('Enter Employee Details'), t("Fill in the employee's information, including full name, phone number, gender, NIC, and status.")],
            [t('Add Employee ID'), t("The Employee ID can be automatically assigned by Harvest Pro if you leave the field blank. Alternatively, you can manually enter your own employee ID, such as the employee's ETF number.")],
            [t('Select Service Categories'), t('Under Service Categories, select the services the employee can perform — for example, Fertilizing, Leaf Plucking, Pruning, or Weeding. These categories are based on the services you previously created under Service Management.')],
            [t('Assign the Employee to an Estate'), t('Under Estates, tick the estate or estates where the employee works. You can assign an employee to one or multiple estates, depending on your requirements.')],
            [t('Add Employee'), t('Check that all the information is correct, then click Add Employee.')],
        ],
        'tip' => t('The employee will now be added to your Harvest Pro Employee Management system.'),
    ],
    [
        'key'      => 'daily-assignment',
        'icon'     => 'calendar',
        'title'    => t('Daily Assignment'),
        'summary'  => t('Record the daily work completed by your employees and let Harvest Pro calculate their payments automatically.'),
        'teaser'   => t('Record daily work and auto-calculate payments.'),
        'substeps' => [
            [t('Go to Daily Assignment'), t('From the left-side menu, click Daily Assignment. This section allows you to record the daily work completed by your employees and automatically calculate their payments based on the service rate.')],
            [t('Add a New Assignment'), t('Click the Add Assignment button at the top-right of the page. A New Assignment form will appear.')],
            [t('Select the Estate'), t('Choose the estate where the work was carried out.')],
            [t('Select the Section'), t('Choose the relevant section of the estate — for example, Field 01, Field 02, or Plantation A.')],
            [t('Select the Service'), t('Select the service completed by the workers — for example, Leaf Plucking. The system will automatically display the rate you previously set under Service Management, such as LKR 50 per KG.')],
            [t('Add Workers'), t('Click Add a Worker Below, then click the Search Workers field — your previously added employees will automatically appear. Select the worker you want to add. You can add multiple workers to the same daily assignment.')],
            [t('Enter the Work Quantity'), t("Enter the quantity completed by each worker. For example, if a worker plucked 60 KG of green leaf, enter 60 KG. Harvest Pro will automatically calculate the worker's payment based on the rate: 60 KG × LKR 50 = LKR 3,000. This information will also be used for Payroll.")],
            [t('Add a Temporary Worker'), t('If someone works only on a temporary or daily basis and is not registered as a regular employee, click Add a Temporary Worker Below to record their work for that day without adding them as a permanent employee.')],
            [t('Create the Assignment'), t('Once all workers and quantities have been entered, check the details and click Create & Add Workers.')],
        ],
        'tip' => t('Your daily assignment is now recorded in Harvest Pro, including the workers, work quantities, and calculated payments.'),
    ],
    [
        'key'      => 'expense',
        'icon'     => 'receipt',
        'title'    => t('Expense'),
        'summary'  => t('Record and track all the expenses related to your tea estates.'),
        'teaser'   => t('Record and track estate expenses.'),
        'substeps' => [
            [t('Go to Expenses'), t('From the left-side menu, click Expenses. This section allows you to record and track all expenses related to your tea estates.')],
            [t('Add a New Expense'), t('Click the Add Expense button. The Add New Expense form will appear.')],
            [t('Select the Date'), t('Choose the date when the expense occurred.')],
            [t('Select the Expense Category'), t('Choose the appropriate category for the expense — for example, Equipment, Food, Tools, Transport, Utilities, or Other.')],
            [t('Add a Description'), t('Enter a short description explaining what the expense was for.')],
            [t('Enter the Amount'), t('Enter the total expense amount in LKR.')],
            [t('Select the Estate'), t('Select the estate related to the expense. If you manage multiple estates, you can record and track expenses separately for each estate.')],
            [t('Select the Section'), t('If the expense belongs to a specific section or field, select it under Section. If it is a general estate expense, select All / General.')],
            [t('Add the Expense'), t('Check all the information and click Add Expense.')],
        ],
        'tip' => t('The expense will now be recorded in Harvest Pro, helping you track estate expenses and costs accurately for each estate and section.'),
    ],
    [
        'key'      => 'fertilizer-management',
        'icon'     => 'leaf',
        'title'    => t('Fertilizer Management'),
        'summary'  => t('Track fertilizer applications and cycles, and know exactly when each field is next due.'),
        'teaser'   => t('Track fertilizer applications and due dates.'),
        'substeps' => [
            [t('Go to Fertilizer Management'), t('From the left-side menu, click Fertilizer Management. Here you can view the fertilizer calendar, applications, cycles, and upcoming due dates.')],
            [t('Add a Fertilizer'), t('Click Add Fertilizer at the top-right of the page and add the fertilizer types you use on your estate — for example, T200, T750, NPK 15-15-15, or Urea.')],
            [t('Add a Fertilizer Cycle'), t('Click Add Fertilizer Cycle to record a new fertilizer application and set its next cycle.')],
            [t('Select the Estate and Section'), t('Select the estate where the fertilizer was applied, then select the relevant section or field — for example, Field 01, Field 02, Plantation A, or Plantation B.')],
            [t('Select the Fertilizer'), t('Choose the fertilizer type you applied from your previously added fertilizer list — for example, T200.')],
            [t('Enter the Application Details'), t('Select the application date and enter the amount of fertilizer used — for example, T200 at a quantity of 150 KG.')],
            [t('Set the Fertilizer Cycle'), t('Enter the number of days before the next fertilizer application is required — for example, 50, 75, or 90 days. If you select a 90-day cycle, Harvest Pro will automatically calculate the next fertilizer due date.')],
            [t('Save the Fertilizer Application'), t('Check all the details and save the application. The record will now appear on the Fertilizer Management calendar and under All Applications.')],
            [t('Track Next Due Dates & Reminders'), t('Harvest Pro automatically tracks the fertilizer cycle and shows the last application date, next due date, cycle (e.g. 90 days), days remaining, estate, and section / field.')],
        ],
        'tip' => t('This helps you identify which field needs fertilizer next and when it is due, without manually calculating the dates.'),
    ],
    [
        'key'      => 'factory-management',
        'icon'     => 'factory',
        'title'    => t('Factory Management'),
        'summary'  => t('Track green leaf deliveries, factory weights, monthly prices, and profit — from plucking to final payment.'),
        'teaser'   => t('Track deliveries, weights, prices, and profit.'),
        'substeps' => [
            [t('Go to Factory Management'), t('From the left-side menu, click Factory Management. You will see five tabs: Overview, Deliveries, Expenses, Monthly Prices, and Factories. When using Factory Management for the first time, start with the Factories tab.')],
            [t('Add Your Tea Factory'), t('Click the Factories tab and enter the factory details: factory name, location, and status (select Active) — notes are optional. Click Save Factory. If you supply green leaf to more than one factory, you can add each factory separately.')],
            [t('Go to Deliveries'), t('Click the Deliveries tab. The green leaf KG recorded from your daily plucking will automatically appear here. For example, if your workers plucked 150 KG today, the 150 KG will appear under Deliveries, ready to be assigned to a factory.')],
            [t('Assign the Green Leaf to a Factory'), t('Select the factory where you delivered the green leaf. If all 150 KG went to one factory, assign the full 150 KG to that factory. If you delivered the leaf to multiple factories, click Split Across Factories — for example, 100 KG to Factory A and 50 KG to Factory B. This allows you to track exactly how much leaf was sent to each factory.')],
            [t('Check the Field KG'), t('After assigning the delivery, you will see the Field KG — the weight recorded by your estate before the green leaf is weighed at the factory. For example, Field KG: 73 KG.')],
            [t('Enter the Factory KG'), t('Once the tea factory provides its official weight, enter it under Factory KG — for example, Field KG: 73 KG, Factory KG: 60 KG. Save the factory weight after entering it.')],
            [t('Check the Weight Difference'), t('Harvest Pro will automatically show the difference between the Field KG and Factory KG — for example, Field KG: 73 KG, Factory KG: 60 KG, Difference: 13 KG. This makes it easy to identify any weight difference between the estate and factory records.')],
            [t('Add the Monthly Price'), t("Once the factory provides the green leaf price for the month, click the Monthly Prices tab. Select the relevant factory, month, and year, then enter the factory's price per KG and save it — for example, September: Rs. 271 per KG.")],
            [t('Check the Delivery Value'), t('Go back to the Deliveries tab. Harvest Pro will use the Factory KG and the applicable Monthly Price to calculate the value of the delivery — for example, Factory KG: 60 KG, Price: Rs. 271 per KG, Value: Rs. 16,260.')],
            [t('Add Factory Expenses'), t('Click the Expenses tab. Here you can record expenses or deductions related to the factory — enter the factory, date, category, amount (LKR), and an optional description or notes, then click Save Expense.')],
            [t('Record Fertilizer or Other Deductions'), t('Sometimes the tea factory may provide fertilizer or other items/advances to your estate. For example, if you receive fertilizer from the factory and its cost will be deducted from your month-end payment, record that amount under Factory Expenses. This helps you keep track of the deductions that will affect your final factory payment.')],
            [t('Go to Overview'), t('Click the Overview tab to see a complete summary of your factory activity. You can filter the information by estate, factory, year, and month.')],
            [t('Check Your Factory Summary'), t('At the top of the Overview, you can see the Field Weight (total KG recorded by your estate), Factory Weight (total KG recorded by the factory), Unassigned KG (leaf that still needs to be assigned to a factory), Leaf Value (value calculated using the factory KG and monthly price), and Net (final value after applicable recorded deductions).')],
            [t('Check the Profit Summary'), t('Under Profit Summary, you can see the Value, Expenses, Advances, and Net Profit — giving you a clear picture of the income generated from your green leaf and the deductions recorded against it.')],
            [t('Check Factory Performance'), t('The Factory Performance section helps you monitor the performance of each factory. You can see the KG supplied, number of deliveries, leaf type, and value for the selected period. This is especially useful if your estate supplies green leaf to multiple factories.')],
            [t('Check Recent Deliveries'), t('Under Recent Deliveries, you can see the date, factory, leaf type, plucking KG, factory KG, difference, value, and status — helping you quickly review your latest factory deliveries and confirm that the information has been recorded correctly.')],
        ],
        'tip' => t('Once Factory Management is set up, your normal process will be: Record Daily Plucking → Assign Leaf to Factory → Enter Factory KG → Add Monthly Price → Check Delivery Value → Add Factory Expenses/Deductions → Check Overview & Net Profit.'),
    ],
    [
        'key'      => 'reminders-calendar',
        'icon'     => 'bell',
        'title'    => t('Reminders & Calendar'),
        'summary'  => t('Schedule and track important activities across your tea estate — from fertilizer applications and inspections to maintenance, purchasing, and meetings.'),
        'teaser'   => t('Schedule and track important estate activities.'),
        'substeps' => [
            [t('Go to Reminders & Calendar'), t('From the left-side menu, click Reminders & Calendar. You will see a calendar where you can view your scheduled reminders and upcoming estate activities.')],
            [t('Add a New Reminder'), t('Click the Add Reminder button at the top-right of the page. The Add Reminder form will appear.')],
            [t('Enter the Event Title'), t('Enter a clear event title for the activity you want to remember — for example, Apply Fertilizer, Building Maintenance, Field Inspection, Purchase Estate Supplies, Equipment Service, or Worker Meeting.')],
            [t('Add a Description'), t('Enter a short description with more information about the task — for example, "Building Maintenance: Check and repair the estate office roof." This helps you understand exactly what needs to be done when you see the reminder later.')],
            [t('Select the Start Date'), t('Choose the start date for the reminder — the date when the activity should take place or when you want the reminder to begin.')],
            [t('Select the Related Estate'), t('Choose the estate related to the reminder. If you manage multiple estates in Harvest Pro, make sure you select the correct estate.')],
            [t('Select the Plantation / Section'), t('Choose the specific plantation or section where the task needs to be completed — for example, Plantation A, Plantation B, Field 01, or Field 02. This makes it easier to manage reminders separately for different areas of your estate.')],
            [t('Select the Recurrence'), t('Choose how often the reminder should repeat: One-time, Daily, Weekly, Monthly, or Yearly. For example, if you need to carry out an estate inspection every month, select Monthly.')],
            [t('Add the Event'), t('Once all the information is correct, click Add Event.')],
            [t('View Your Reminders'), t('Your scheduled activities will appear on the calendar according to their dates. You can also check the All Reminders section to keep track of your scheduled tasks and upcoming activities.')],
        ],
        'tip' => t('Using Reminders & Calendar helps you keep important estate activities organized and reduces the chance of missing scheduled work or important dates.'),
    ],
];

$hiwIcons = [
    'user'     => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6.5" r="3.2"/><path d="M3.5 16.5c0-3.6 2.9-6 6.5-6s6.5 2.4 6.5 6"/></svg>',
    'home'     => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9.5 10 3l7 6.5"/><path d="M5 8.5V17h10V8.5"/><path d="M8 17v-5h4v5"/></svg>',
    'settings' => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="10" r="2.6"/><path d="M10 2.8v2M10 15.2v2M17.2 10h-2M4.8 10h-2M15.1 4.9l-1.4 1.4M6.3 13.7l-1.4 1.4M15.1 15.1l-1.4-1.4M6.3 6.3 4.9 4.9"/></svg>',
    'people'   => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="7" cy="6.5" r="2.3"/><path d="M2.5 16c0-3 2-5 4.5-5s4.5 2 4.5 5"/><circle cx="14" cy="7.5" r="1.9"/><path d="M11.8 11c2-.3 3.7 1.1 4.2 3.4"/></svg>',
    'calendar' => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="14" height="12" rx="1.6"/><path d="M3 8h14M7 2.8v3M13 2.8v3"/><path d="M7 11.2h2M11 11.2h2M7 14h2"/></svg>',
    'receipt'  => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 2.5h10v15l-2-1.3-1.5 1.3-1.5-1.3-1.5 1.3-1.5-1.3-2 1.3v-15Z"/><line x1="7.3" y1="6.5" x2="12.7" y2="6.5"/><line x1="7.3" y1="9.5" x2="12.7" y2="9.5"/><line x1="7.3" y1="12.5" x2="11" y2="12.5"/></svg>',
    'leaf'     => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 16c0-7 4-11 11-12 1 7-3 11-11 12Z"/><path d="M6 14c2-3 4-5 8-7"/></svg>',
    'factory'  => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 17V9l4 2.5V9l4 2.5V7l6 2v8H2.5Z"/><path d="M15 9V6"/></svg>',
    'bell'     => '<svg viewBox="0 0 20 20" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 8.2c0-2.9 2.2-5.2 5-5.2s5 2.3 5 5.2c0 3.6 1 5 1.6 5.8H3.4C4 13.2 5 11.8 5 8.2Z"/><path d="M8.3 16.8a1.9 1.9 0 0 0 3.4 0"/></svg>',
];
$hiwShotSvg = '<svg viewBox="0 0 24 24" width="38" height="38" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="8.5" cy="9.5" r="1.5"/><path d="M21 16l-5-5-4 4-3-3-6 6"/></svg>';
$hiwBulbSvg = '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18h6M10 21h4M12 3a6 6 0 0 0-3.5 10.9c.6.4 1 1.1 1 1.9v.2h5v-.2c0-.8.4-1.5 1-1.9A6 6 0 0 0 12 3Z"/></svg>';

$stepCount = count($howSteps);

$pageTitle = 'How It Works — ' . $brandName . ' Pro';
$pageDesc  = 'See how to set up your tea estate and start managing daily operations with Harvest Pro, step by step.';
$pageImg   = absolute_url($bannerBg);
?>
<!DOCTYPE html>
<html lang="<?= e(current_lang()) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if ($faviconUrl !== ''): ?><link rel="icon" href="<?= e($faviconUrl) ?>"><?php endif; ?>
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDesc) ?>">
<?php seo_meta_tags('/how-it-works', $pageTitle, $pageDesc, $pageImg, $brandName . ' Pro'); ?>
<?php sinhala_font_tags(); ?>
<link rel="stylesheet" href="assets/css/style.css?v=4.4">
<?php if ($themePrimary !== '' || $themeAccent !== ''): ?>
<style>
:root {
<?php if ($themePrimary !== ''): ?>
  --green-900: color-mix(in srgb, <?= e($themePrimary) ?> 65%, black);
  --green-800: color-mix(in srgb, <?= e($themePrimary) ?> 80%, black);
  --green-700: color-mix(in srgb, <?= e($themePrimary) ?> 92%, black);
  --green-600: <?= e($themePrimary) ?>;
  --green-500: color-mix(in srgb, <?= e($themePrimary) ?> 82%, white);
  --green-050: color-mix(in srgb, <?= e($themePrimary) ?> 8%, white);
<?php endif; ?>
<?php if ($themeAccent !== ''): ?>
  --gold: <?= e($themeAccent) ?>;
  --gold-soft: color-mix(in srgb, <?= e($themeAccent) ?> 85%, white);
<?php endif; ?>
}
</style>
<?php endif; ?>
</head>
<body>

<?php $activeNav = 'how-it-works'; require __DIR__ . '/includes/site-nav.php'; ?>

<!-- ============================= PAGE BANNER ============================= -->
<header class="page-banner" style="background-image:linear-gradient(rgba(10,20,12,.55),rgba(10,20,12,.7)),url('<?= e($bannerBg) ?>');">
  <div class="container">
    <div class="page-banner-inner" style="max-width:760px;">
      <h1><?= e(t('How')) ?> <?= e($brandName) ?> <span class="accent"><?= e(t('Works')) ?></span></h1>
      <p><?= e(t('Set up your tea estate and start managing your daily operations in just a few simple steps.')) ?></p>
    </div>
  </div>
</header>

<!-- ============================= STEP TABS ============================= -->
<section class="section" style="padding-bottom:70px;">
  <div class="container">

    <div class="hiw-ribbon-wrap">
      <div class="hiw-ribbon" id="hiwRibbon">
        <?php foreach ($howSteps as $i => $s): ?>
          <button type="button" class="hiw-pill<?= $i === 0 ? ' active' : '' ?>" data-step="<?= e($s['key']) ?>">
            <span class="hiw-pill-num"><?= $i + 1 ?></span>
            <span class="hiw-pill-label"><?= e($s['title']) ?></span>
          </button>
        <?php endforeach; ?>
      </div>
    </div>

    <div id="hiwPanels">
      <?php foreach ($howSteps as $i => $s): ?>
        <div class="hiw-panel<?= $i === 0 ? ' active' : '' ?>" data-step-panel="<?= e($s['key']) ?>">
          <div class="hiw-panel-head">
            <div>
              <span class="hiw-eyebrow"><?= e(sprintf(t('STEP %02d'), $i + 1)) ?></span>
              <h2><?= e($s['title']) ?></h2>
            </div>
            <div class="hiw-panel-nav">
              <span class="hiw-counter"><?= $i + 1 ?> / <?= $stepCount ?></span>
              <button type="button" class="hiw-nav-btn" data-hiw-prev aria-label="<?= e(t('Previous step')) ?>">&larr;</button>
              <button type="button" class="hiw-nav-btn" data-hiw-next aria-label="<?= e(t('Next step')) ?>">&rarr;</button>
            </div>
          </div>

          <p class="hiw-summary"><?= e($s['summary']) ?></p>

          <div class="hiw-shot">
            <?= $hiwShotSvg ?>
            <span><?= e(t('Screenshot placeholder')) ?></span>
          </div>

          <?php if ($s['substeps']): ?>
            <div class="hiw-substeps">
              <?php foreach ($s['substeps'] as $j => $sub): ?>
                <div class="hiw-substep">
                  <span class="hiw-substep-num"><?= $j + 1 ?></span>
                  <div>
                    <h4><?= e($sub[0]) ?></h4>
                    <p><?= e($sub[1]) ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <?php if (!empty($s['tip'])): ?>
              <div class="hiw-tip">
                <?= $hiwBulbSvg ?>
                <p><?= e($s['tip']) ?></p>
              </div>
            <?php endif; ?>
          <?php else: ?>
            <div class="hiw-placeholder-note">
              <span class="hiw-badge"><?= e(t('Coming soon')) ?></span>
              <p><?= e($hiwComingSoonNote) ?></p>
            </div>
          <?php endif; ?>

          <div class="hiw-panel-foot">
            <button type="button" class="btn btn-outline" data-hiw-prev><?= e(t('Previous')) ?></button>
            <button type="button" class="btn btn-primary" data-hiw-next>
              <?php if ($i < $stepCount - 1): ?>
                <?= e(t('Next:')) ?> <?= e($howSteps[$i + 1]['title']) ?>
              <?php else: ?>
                <?= e(t('Back to Start')) ?>
              <?php endif; ?>
              <span>&rarr;</span>
            </button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================= EXPLORE ALL STEPS ============================= -->
<section class="section" style="padding-top:0;">
  <div class="container">
    <div class="hiw-explore-head">
      <h2><?= e(t('Explore All Steps')) ?></h2>
      <p><?= e(t('From setup to daily operations, get familiar with everything Harvest Pro can do for your estate.')) ?></p>
    </div>
    <div class="hiw-grid">
      <?php foreach ($howSteps as $i => $s): ?>
        <button type="button" class="hiw-card" data-step="<?= e($s['key']) ?>">
          <span class="hiw-card-icon"><?= $hiwIcons[$s['icon']] ?? '' ?></span>
          <span class="hiw-card-num"><?= e(sprintf('%02d', $i + 1)) ?></span>
          <span class="hiw-card-title"><?= e($s['title']) ?></span>
          <span class="hiw-card-desc"><?= e($s['teaser'] ?? t('Coming soon')) ?></span>
        </button>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================= CTA ============================= -->
<section class="cta" data-bg="linear-gradient(rgba(15,30,18,.72),rgba(15,30,18,.55)),url('<?= e($ctaBg) ?>')">
  <div class="container">
    <div class="cta-inner">
      <h2 class="cta-title"><?= e(t('Ready to Manage Your Estate Smarter?')) ?></h2>
      <p class="cta-para"><?= e(t('Start your 14-day free trial and set up your estate today.')) ?></p>
      <div class="cta-btns">
        <a href="<?= e($priceLink) ?>" class="btn btn-primary"><?= e(t('Start Free Trial')) ?> <span>&rarr;</span></a>
        <a href="/contact" class="btn btn-text light"><?= e(t('Contact Support')) ?></a>
      </div>
    </div>
  </div>
</section>
<script src="assets/js/how-it-works.js?v=1.0" defer></script>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
