<?php
/**
 * =====================================================================
 *  English -> Sinhala dictionary for the public site.
 * ---------------------------------------------------------------------
 *  Keyed by the exact English string as it currently exists in the
 *  database seed (database.sql) or in a template literal. translate()
 *  does an exact-match lookup and returns the original English when a
 *  string isn't found here — e.g. content an admin has since edited —
 *  so nothing ever renders blank or broken.
 *
 *  Only prose belongs in this file. Never add an entry whose key is a
 *  URL, filename, phone number, email, hex color, or physical address —
 *  setting() runs every value through this dictionary, so a matching
 *  key there would get "translated" too.
 * =====================================================================
 */
return [

    // ---- Nav / chrome -------------------------------------------------
    'Home' => 'මුල් පිටුව',
    'About Us' => 'අප ගැන',
    'Pricing' => 'මිල ගණන්',
    'Features' => 'විශේෂාංග',
    'How It Works' => 'එය ක්‍රියා කරන ආකාරය',
    'News & Updates' => 'පුවත් සහ යාවත්කාලීන කිරීම්',
    'Latest News & Updates' => 'නවතම පුවත් සහ යාවත්කාලීන කිරීම්',
    'Product announcements, feature releases and tips from the Harvest Pro team.' =>
        'Harvest Pro කණ්ඩායමෙන් නිෂ්පාදන නිවේදන, විශේෂාංග නිකුතුම් සහ උපදෙස්.',
    'View All Posts' => 'සියලුම සටහන් බලන්න',
    'Contact Us' => 'අප අමතන්න',
    'Call' => 'අමතන්න',
    'System Login' => 'පද්ධතියට පිවිසෙන්න',
    'Toggle navigation' => 'මෙනුව විවෘත කරන්න',

    // ---- Footer ---------------------------------------------------------
    'Link' => 'සබැඳි',
    'Contact' => 'සම්බන්ධතා',
    'Subscribe' => 'දායක වන්න',
    'Safe & Secure Payments' => 'ආරක්ෂිත හා සුරක්ෂිත ගෙවීම්',
    "Let's Talk" => 'කතා කරමු',
    'Secure payments through trusted payment providers.' => 'විශ්වාසනීය ගෙවීම් සපයන්නන් හරහා ආරක්ෂිත ගෙවීම්.',
    '© 2025 Harvest Pro. Grow Smarter. Manage Better.' => '© 2025 Harvest Pro. වඩා දක්ෂ ලෙස වර්ධනය වන්න. වඩා හොඳින් කළමනාකරණය කරන්න.',
    'Harvest Pro is a smart plantation management platform that simplifies workforce management, production tracking, payroll, field operations, and reporting – all in one place.' =>
        'Harvest Pro යනු කම්කරු කළමනාකරණය, නිෂ්පාදන නිරීක්ෂණය, වැටුප්, ක්ෂේත්‍ර මෙහෙයුම් සහ වාර්තාකරණය – සියල්ල එක් තැනකින් සරල කරන ස්මාර්ට් වතු කළමනාකරණ වේදිකාවකි.',

    // ---- Contact form / page literals ------------------------------------
    'Get In Touch' => 'සම්බන්ධ වන්න',
    'Contact Information' => 'සම්බන්ධතා තොරතුරු',
    'Follow Our Journey' => 'අපගේ ගමන අනුගමනය කරන්න',
    'Full Name' => 'සම්පූර්ණ නම',
    'Company / Estate Name' => 'සමාගම / වතුයායේ නම',
    'Email Address' => 'විද්‍යුත් තැපැල් ලිපිනය',
    'Phone Number' => 'දුරකථන අංකය',
    'Number of Estates' => 'වතුයායන් ගණන',
    'Select' => 'තෝරන්න',
    '1 Estate' => 'වතුයායන් 1',
    '2 - 5 Estates' => 'වතුයායන් 2 - 5',
    '6 - 10 Estates' => 'වතුයායන් 6 - 10',
    '10+ Estates' => 'වතුයායන් 10+',
    'Message' => 'පණිවිඩය',
    "Tell us about your plantation and what you're hoping to achieve with Harvest Pro..." =>
        'ඔබේ වතුයාය ගැන සහ Harvest Pro සමඟ ඔබ බලාපොරොත්තු වන දේ ගැන අපට කියන්න...',
    'Send Request' => 'ඉල්ලීම යවන්න',
    "Thank you! Your request has been received. We'll be in touch soon." =>
        'ස්තූතියි! ඔබේ ඉල්ලීම ලැබී ඇත. අපි ඉක්මනින්ම ඔබ හා සම්බන්ධ වන්නෙමු.',
    'Something went wrong. Please try again or email us directly.' =>
        'යම් දෝෂයක් සිදු විය. කරුණාකර නැවත උත්සාහ කරන්න හෝ අපට කෙලින්ම විද්‍යුත් තැපෑලක් එවන්න.',

    // ---- Features page fallback -------------------------------------------
    'Feature sections will appear here once added from the admin panel.' =>
        'පරිපාලක පැනලයෙන් එකතු කළ පසු විශේෂාංග කොටස් මෙහි දිස්වනු ඇත.',

    // ---- Hero (also covers index.php's no-DB-row fallback) -----------------
    'Smarter Plantation Management. Better Productivity.' => 'වඩා දක්ෂ වතු කළමනාකරණය. වඩා හොඳ ඵලදායිතාව.',
    'A modern platform built for the unique demands of tea estates and plantations — from worker management to real-time production tracking, all from one unified system.' =>
        'තේ වතුයායන් සහ වතුයායන්ගේ අනන්‍ය අවශ්‍යතා සඳහා නිර්මාණය කළ නවීන වේදිකාවකි — කම්කරු කළමනාකරණයේ සිට තථ්‍ය කාලීන නිෂ්පාදන නිරීක්ෂණය දක්වා, සියල්ල එක් ඒකාබද්ධ පද්ධතියකින්.',
    'Request a Demo' => 'ආදර්ශනයක් ඉල්ලන්න',
    'Explore Features' => 'විශේෂාංග ගවේෂණය කරන්න',

    // ---- Ticker strip -------------------------------------------------------
    'Worker Management|Tea Production Tracking|Automated Payroll|Field Activity Monitoring|Multi-Estate Support|Real-Time Analytics' =>
        'කම්කරු කළමනාකරණය|තේ නිෂ්පාදන නිරීක්ෂණය|ස්වයංක්‍රීය වැටුප් ගණනය|ක්ෂේත්‍ර ක්‍රියාකාරකම් නිරීක්ෂණය|බහු වතු සහාය|තථ්‍ය කාලීන විශ්ලේෂණ',

    // ---- Why Harvest Pro ------------------------------------------------------
    'Why Harvest Pro' => 'Harvest Pro තෝරාගත යුත්තේ ඇයි',

    // ---- Live Estate Activity demo card (left side of Why section) -----------
    'Live' => 'සජීවී',
    'Estate activity now' => 'දැන් වතුයායේ ක්‍රියාකාරකම්',
    'people viewing now' => 'දැන් නරඹන පිරිස',
    'Activity' => 'ක්‍රියාකාරකම',
    'Start' => 'ආරම්භය',
    'End' => 'අවසානය',
    'Daily progression' => 'දෛනික ප්‍රගතිය',
    'Green Leaf Recorded' => 'අමු දලු වාර්තා විය',
    'Attendance Completed' => 'පැමිණීම සම්පූර්ණයි',
    'Payroll Processed' => 'වැටුප් සකසන ලදී',
    'Field Expenses Recorded' => 'ක්ෂේත්‍ර වියදම් වාර්තා විය',
    'Factory Collection Recorded' => 'කර්මාන්ත ශාලා එකතුව වාර්තා විය',
    'Morning' => 'උදෑසන',
    'Evening' => 'සවස',
    'workers' => 'කම්කරුවන්',
    'No entries yet' => 'තවම ප්‍රවේශයන් නැත',
    'Rate' => 'ගාස්තුව',
    'Starts at %s' => '%s ට ආරම්භ වේ',
    'Fertilizer' => 'පොහොර',
    'Transport' => 'ප්‍රවාහනය',
    'Fuel' => 'ඉන්ධන',
    'Field Maintenance' => 'ක්ෂේත්‍ර නඩත්තුව',
    'Clearing' => 'සෝදිසි කිරීම',
    'Equipment' => 'උපකරණ',
    'Casual Labour' => 'අනියම් කම්කරු',

    'Everything Your Plantation Needs in' => 'ඔබේ වතුයායට අවශ්‍ය සියල්ල',
    'One System' => 'එක් පද්ධතියකින්',
    'Managing a plantation involves multiple moving parts. Harvest Pro brings them together into a single, easy-to-use platform that reduces paperwork, improves accuracy, and saves valuable time.' =>
        'වතුයායක් කළමනාකරණය කිරීමට විවිධ අංග රැසක් සම්බන්ධ වේ. Harvest Pro මඟින් ඒවා සියල්ල, ලේඛන කටයුතු අඩු කරන, නිරවද්‍යතාව වැඩි දියුණු කරන සහ වටිනා කාලය ඉතිරි කරන එක් සරල හා පහසුවෙන් භාවිතා කළ හැකි වේදිකාවකට ගෙන එයි.',
    'Whether you manage one estate or multiple plantations, Harvest Pro provides the visibility and control needed to operate efficiently.' =>
        'ඔබ එක් වතුයායක් හෝ බහු වතුයායන් කළමනාකරණය කළත්, කාර්යක්ෂමව මෙහෙයුම් කිරීමට අවශ්‍ය පැහැදිලි දැක්ම හා පාලනය Harvest Pro මඟින් සපයයි.',
    'Reduction In Admin Workload' => 'පරිපාලන කාර්යභාරයේ අඩුවීම',
    'Learn more' => 'තව දැනගන්න',

    // ---- Key Features (homepage teaser + cards) --------------------------------
    'Key Features' => 'ප්‍රධාන විශේෂාංග',
    'Powerful Tools for' => 'සඳහා ප්‍රබල මෙවලම්',
    'Modern Plantation Management' => 'නවීන වතු කළමනාකරණය',

    'Worker Assignments' => 'කම්කරු පැවරීම්',
    'Assign daily tasks and monitor workforce activities with ease.' => 'දෛනික කාර්යයන් පවරා කම්කරු ක්‍රියාකාරකම් පහසුවෙන් නිරීක්ෂණය කරන්න.',
    'Tea Production Tracking' => 'තේ නිෂ්පාදන නිරීක්ෂණය',
    'Record and analyze daily harvesting and production data.' => 'දෛනික අස්වනු නෙළීම හා නිෂ්පාදන දත්ත වාර්තා කර විශ්ලේෂණය කරන්න.',
    'Payroll Management' => 'වැටුප් කළමනාකරණය',
    'Automate payroll calculations based on productivity and attendance.' => 'ඵලදායිතාව හා පැමිණීම මත පදනම්ව වැටුප් ගණනය ස්වයංක්‍රීය කරන්න.',
    'Field Activity Monitoring' => 'ක්ෂේත්‍ර ක්‍රියාකාරකම් නිරීක්ෂණය',
    'Track fertilizer applications, spraying schedules, maintenance work, and other estate activities.' =>
        'පොහොර යෙදීම්, ඉසින කාලසටහන්, නඩත්තු කටයුතු සහ අනෙකුත් වතු ක්‍රියාකාරකම් නිරීක්ෂණය කරන්න.',
    'Performance Reporting' => 'කාර්යසාධන වාර්තාකරණය',
    'Generate detailed reports for management and operational analysis.' => 'කළමනාකාරිත්වය හා මෙහෙයුම් විශ්ලේෂණය සඳහා විස්තරාත්මක වාර්තා ජනනය කරන්න.',
    'Multi-Estate Management' => 'බහු-වතු කළමනාකරණය',
    'Manage multiple estates from a single dashboard.' => 'එක් උපකරණ පුවරුවකින් බහු වතු කළමනාකරණය කරන්න.',

    // ---- Pricing section --------------------------------------------------------
    'Simple, Transparent Plans' => 'සරල, විනිවිද පෙනෙන සැලසුම්',
    'Choose Your Plan' => 'ඔබේ සැලැස්ම තෝරන්න',
    'Scale from basic estate management to payroll and complete tea factory operations.' =>
        'මූලික වතු කළමනාකරණයේ සිට වැටුප් සහ සම්පූර්ණ තේ කර්මාන්ත ශාලා මෙහෙයුම් දක්වා පරිමාණය කරන්න.',
    '14-day free trial on online signup. No charge until you subscribe.' =>
        'මාර්ගගත ලියාපදිංචියේදී දින 14ක නොමිලේ අත්හදා බැලීමක්. ඔබ දායක වන තෙක් ගාස්තුවක් නැත.',

    'Basic Tier' => 'මූලික මට්ටම',
    'Harvest Pro Base Estate Management Plan' => 'Harvest Pro මූලික වතු කළමනාකරණ සැලැස්ම',
    'Dashboard & Estate Overview
Employee & User Management
Service & Daily Assignment
Expense Tracking
Reminders & Calendar
Reports (Excel & PDF)
Data Backups
Multi-language Support' =>
        'උපකරණ පුවරුව සහ වතු දළ විශ්ලේෂණය
සේවක සහ පරිශීලක කළමනාකරණය
සේවා සහ දෛනික පැවරීම
වියදම් නිරීක්ෂණය
මතක් කිරීම් සහ දින දර්ශනය
වාර්තා (Excel සහ PDF)
දත්ත උපස්ථ
බහුභාෂා සහාය',

    'Mid Tier' => 'මධ්‍යම මට්ටම',
    'Harvest Pro Automated Payroll & Estate Plan' => 'Harvest Pro ස්වයංක්‍රීය වැටුප් සහ වතු සැලැස්ම',
    'Recommended' => 'නිර්දේශිතයි',
    'Everything in Basic Tier, plus:' => 'මූලික මට්ටමේ සියල්ල, තවද:',

    'Top Tier' => 'ඉහළම මට්ටම',
    'Harvest Pro Complete Tea Factory & Operations Suite' => 'Harvest Pro සම්පූර්ණ තේ කර්මාන්ත ශාලා හා මෙහෙයුම් පැකේජය',
    'Everything in Mid Tier, plus:' => 'මධ්‍යම මට්ටමේ සියල්ල, තවද:',
    'Tea Factory Operations
Leaf Intake & Weighing
Processing & Quality Grading
Factory Inventory & Stock
Buyer & Sales Management
Factory Reports & Analytics' =>
        'තේ කර්මාන්ත ශාලා මෙහෙයුම්
කොළ පත් ලැබීම සහ බර කිරීම
සැකසුම සහ ගුණාත්මක ශ්‍රේණිගත කිරීම
කර්මාන්ත ශාලා තොග
ගැනුම්කරු සහ විකුණුම් කළමනාකරණය
කර්මාන්ත ශාලා වාර්තා සහ විශ්ලේෂණ',

    'Automated Payroll Processing
Worker & Plantation Payroll Views
Daily Payroll Summary
Payment Tracking & History
Bulk Payment Actions
EPF / ETF contributions, Form C & R4
Employee loan recoveries' =>
        'ස්වයංක්‍රීය වැටුප් සැකසීම
සේවක හා වතු වැටුප් දසුන්
දෛනික වැටුප් සාරාංශය
ගෙවීම් නිරීක්ෂණය හා ඉතිහාසය
සමූහ ගෙවීම් ක්‍රියාමාර්ග
EPF / ETF දායක මුදල්, Form C සහ R4
සේවක ණය අයකර ගැනීම්',

    'Request a Demo – 14-Day Free Trial' => 'ආදර්ශනයක් ඉල්ලන්න – දින 14ක නොමිලේ අත්හදා බැලීම',

    // ---- Features page banner --------------------------------------------------
    'Everything You Need to Manage Your Tea Estate' => 'ඔබේ තේ වතුයාය කළමනාකරණයට අවශ්‍ය සියල්ල',
    'From workforce management and daily field operations to harvesting, payments, expenses, and reporting, the platform brings your essential tea estate operations together in one simple system.' =>
        'කම්කරු කළමනාකරණයේ සිට දෛනික ක්ෂේත්‍ර මෙහෙයුම්, අස්වනු නෙළීම, ගෙවීම්, වියදම් සහ වාර්තා දක්වා, මෙම වේදිකාව ඔබේ තේ වතුයායේ අත්‍යවශ්‍ය මෙහෙයුම් සියල්ල එක් සරල පද්ධතියකට ගෙන එයි.',
    "Manage multiple estates and sections, track daily activities, monitor costs, and get a clearer view of your estate's performance from anywhere." =>
        'බහු වතු හා අංශ කළමනාකරණය කරන්න, දෛනික ක්‍රියාකාරකම් නිරීක්ෂණය කරන්න, වියදම් පසුවිපරම් කරන්න, සහ ඕනෑම තැනක සිට ඔබේ වතුයායේ කාර්යසාධනය පිළිබඳ පැහැදිලි දැක්මක් ලබාගන්න.',

    // ---- Shared CTA tagline / block (reused across home, about, features) -----
    'Harvest Pro — Grow Smarter. Manage Better.' => 'Harvest Pro — වඩා දක්ෂ ලෙස වර්ධනය වන්න. වඩා හොඳින් කළමනාකරණය කරන්න.',
    'Ready to Transform Your Plantation Operations?' => 'ඔබේ වතු මෙහෙයුම් පරිවර්තනය කිරීමට සූදානම්ද?',
    'Take control of your plantation with a smarter management solution built for modern estates. Harvest Pro provides the tools, insights, and automation needed to improve productivity and streamline daily operations.' =>
        'නවීන වතුයායන් සඳහා නිර්මාණය කළ වඩාත් දක්ෂ කළමනාකරණ විසඳුමක් සමඟ ඔබේ වතුයාය පාලනය කරගන්න. ඵලදායිතාව වැඩි දියුණු කිරීමට සහ දෛනික මෙහෙයුම් සරල කිරීමට අවශ්‍ය මෙවලම්, තීක්ෂණතා සහ ස්වයංක්‍රීයකරණය Harvest Pro මඟින් සපයයි.',

    // ---- How It Helps ------------------------------------------------------------
    'How It Helps' => 'මෙය උපකාර වන ආකාරය',
    'Improve Efficiency Across Every Department' => 'සෑම දෙපාර්තමේන්තුවකම කාර්යක්ෂමතාව වැඩි දියුණු කරන්න',
    'Harvest Pro helps plantation teams stay organized by providing complete visibility into workforce activities, production records, operational costs, and estate performance.' =>
        'කම්කරු ක්‍රියාකාරකම්, නිෂ්පාදන වාර්තා, මෙහෙයුම් වියදම් සහ වතුයායේ කාර්යසාධනය පිළිබඳ සම්පූර්ණ දැක්මක් ලබා දීමෙන් Harvest Pro වතු කණ්ඩායම්වලට සංවිධානාත්මකව සිටීමට උපකාර කරයි.',
    'With real-time reporting and streamlined workflows, managers can identify opportunities, solve issues quickly, and focus on continuous growth.' =>
        'තථ්‍ය කාලීන වාර්තාකරණය සහ සරල කළ කාර්ය ප්‍රවාහයන් සමඟින්, කළමනාකරුවන්ට අවස්ථා හඳුනාගැනීමට, ගැටලු ඉක්මනින් විසඳීමට සහ අඛණ්ඩ වර්ධනය කෙරෙහි අවධානය යොමු කිරීමට හැකි වේ.',
    'Increased productivity|Better workforce management|Improved reporting accuracy|Reduced administrative workload|Better operational control' =>
        'වැඩි ඵලදායිතාව|වඩා හොඳ කම්කරු කළමනාකරණය|වැඩිදියුණු කළ වාර්තා නිරවද්‍යතාව|අඩු කළ පරිපාලන කාර්යභාරය|වඩා හොඳ මෙහෙයුම් පාලනය',

    // ---- Trust section ------------------------------------------------------------
    'Your Estate. Your Data. Protected.' => 'ඔබේ වතුයාය. ඔබේ දත්ත. ආරක්ෂිතයි.',
    'Trusted to Keep Your Estate Moving' => 'ඔබේ වතුයාය ඉදිරියට ගෙන යාමට විශ්වාසනීයයි',
    'Secure by Design' => 'නිර්මාණයෙන්ම ආරක්ෂිතයි',
    'Your estate data is protected with modern security practices.' =>
        'නවීන ආරක්ෂක ක්‍රම මගින් ඔබේ වතුයායේ දත්ත ආරක්ෂා කර ඇත.',
    'Always Within Reach' => 'සැමවිටම ළඟාවිය හැකි',
    'Access your plantation operations securely, wherever you are.' =>
        'ඔබ කොහේ සිටියත්, ඔබේ වතු මෙහෙයුම් ආරක්ෂිතව ප්‍රවේශ වන්න.',
    'Backed Up & Protected' => 'උපස්ථ කර ආරක්ෂා කර ඇත',
    'Regular backups help keep your important records safe.' =>
        'නිතිපතා උපස්ථ කිරීම ඔබේ වැදගත් වාර්තා ආරක්ෂිතව තබා ගැනීමට උපකාර වේ.',
    'Access You Control' => 'ඔබ පාලනය කරන ප්‍රවේශය',
    'Give the right people access to the right information.' =>
        'නිවැරදි තොරතුරු වෙත නිවැරදි පුද්ගලයින්ට ප්‍රවේශය ලබා දෙන්න.',

    // ---- Maintenance mode -----------------------------------------------------------
    "We'll be right back" => 'අපි ඉක්මනින්ම නැවත එන්නම්',
    "We're currently performing scheduled maintenance. Please check back shortly." =>
        'අප දැනට සැලසුම්ගත නඩත්තු කටයුතු සිදු කරමින් සිටිමු. කරුණාකර ටික වේලාවකින් නැවත පරීක්ෂා කරන්න.',

    // ---- Contact page banner / form -----------------------------------------------
    'Ready to Modernize' => 'නවීකරණයට සූදානම්ද',
    'your plantation operations?' => 'ඔබේ වතු මෙහෙයුම්?',
    'Contact our team to schedule a demonstration and learn how Harvest Pro can help improve productivity, workforce management, and operational efficiency.' =>
        'ආදර්ශනයක් සකසා ගැනීමට සහ ඵලදායිතාව, කම්කරු කළමනාකරණය සහ මෙහෙයුම් කාර්යක්ෂමතාව වැඩි දියුණු කිරීමට Harvest Pro උපකාර වන ආකාරය දැනගැනීමට අපගේ කණ්ඩායම අමතන්න.',
    'Request A Demo Today' => 'අද ම ආදර්ශනයක් ඉල්ලන්න',
    'Discover how Harvest Pro can help you grow smarter and manage better.' =>
        'වඩා දක්ෂ ලෙස වර්ධනය වීමට සහ වඩා හොඳින් කළමනාකරණය කිරීමට Harvest Pro ඔබට උපකාර වන ආකාරය සොයාගන්න.',
    '*We typically respond within one business day.' => '*අපි සාමාන්‍යයෙන් වැඩ කරන දින එකක් ඇතුළත පිළිතුරු දෙන්නෙමු.',

    // ---- About page: banner ---------------------------------------------------------
    "Built for Plantations,\nby **Industry** & Technology Experts." =>
        "වතුයායන් සඳහා නිර්මාණය කළ,\n**කර්මාන්ත** හා තාක්ෂණික විශේෂඥයින් විසින්.",

    // ---- About page: story ------------------------------------------------------------
    'Our Story' => 'අපගේ කථාව',
    'About Harvest Pro' => 'Harvest Pro පිළිබඳව',
    'Harvest Pro was developed to address the growing operational challenges faced by plantation and tea estate managers.' =>
        'වතු හා තේ වතුයාය කළමනාකරුවන් මුහුණ දෙන වර්ධනය වන මෙහෙයුම් අභියෝගවලට විසඳුමක් ලෙස Harvest Pro සංවර්ධනය කරන ලදී.',
    'Traditional estate management often relies on manual records, spreadsheets, and disconnected processes. Harvest Pro brings these activities together into a centralized digital platform that improves visibility, accuracy, and efficiency.' =>
        'සාම්ප්‍රදායික වතු කළමනාකරණය බොහෝවිට අතින් තබන වාර්තා, ස්ප්‍රෙඩ්ෂීට් සහ වෙන් වූ ක්‍රියාවලීන් මත රඳා පවතී. Harvest Pro මෙම ක්‍රියාකාරකම් සියල්ල, පැහැදිලි දැක්ම, නිරවද්‍යතාව සහ කාර්යක්ෂමතාව වැඩි දියුණු කරන කේන්ද්‍රීයගත ඩිජිටල් වේදිකාවකට ගෙන එයි.',
    'Our mission is to help plantations modernize their operations through technology, enabling managers to make better decisions while reducing administrative complexity.' =>
        'තාක්ෂණය හරහා වතුයායන්ට ඔවුන්ගේ මෙහෙයුම් නවීකරණය කිරීමට උපකාර කිරීම සහ පරිපාලන සංකීර්ණත්වය අඩු කරමින් කළමනාකරුවන්ට වඩා හොඳ තීරණ ගැනීමට හැකියාව ලබාදීම අපගේ මෙහෙවර වේ.',
    'Our Vision' => 'අපගේ දැක්ම',
    'To become the leading plantation management platform that empowers estates through digital transformation and data-driven decision-making.' =>
        'ඩිජිටල් පරිවර්තනය සහ දත්ත මත පදනම් වූ තීරණ ගැනීම හරහා වතුයායන් සවිබල ගැන්වෙන ප්‍රමුඛතම වතු කළමනාකරණ වේදිකාව බවට පත්වීම.',
    'Our Mission' => 'අපගේ මෙහෙවර',
    'To simplify plantation operations by providing innovative tools that improve productivity, workforce management, and operational performance.' =>
        'ඵලදායිතාව, කම්කරු කළමනාකරණය සහ මෙහෙයුම් කාර්යසාධනය වැඩි දියුණු කරන නවීන මෙවලම් සැපයීමෙන් වතු මෙහෙයුම් සරල කිරීම.',

    // ---- About page: development partners --------------------------------------------
    'Platform Features' => 'වේදිකා විශේෂාංග',
    "Developed by Two Experts,\nUnited by One Goal" => "විශේෂඥයින් දෙදෙනෙකු විසින් සංවර්ධනය කළ,\nඑක් ඉලක්කයකින් එකට එකතු වූ",
    'Bringing expertise in user experience, business strategy, branding, and digital solutions. Creative Elements ensures Harvest Pro is intuitive, impactful, and truly aligned to user needs.' =>
        'පරිශීලක අත්දැකීම්, ව්‍යාපාරික උපාය මාර්ග, සන්නාමකරණය සහ ඩිජිටල් විසඳුම් පිළිබඳ ප්‍රවීණත්වය ගෙන එයි. Harvest Pro පහසුවෙන් භාවිතා කළ හැකි, බලපෑමක් ඇති කරන සහ පරිශීලක අවශ්‍යතාවලට නියමිත ලෙස ගැලපෙන බව Creative Elements සහතික කරයි.',
    'Digital Transformation|UX & Product Strategy|Branding & Innovation' =>
        'ඩිජිටල් පරිවර්තනය|UX සහ නිෂ්පාදන උපාය මාර්ග|සන්නාමකරණය සහ නවෝත්පාදනය',
    'Specializing in software engineering, system architecture, and technology innovation. Kode Tech builds the scalable, reliable backbone that powers everything Harvest Pro does.' =>
        'මෘදුකාංග ඉංජිනේරු විද්‍යාව, පද්ධති ගෘහ නිර්මාණ ශිල්පය සහ තාක්ෂණික නවෝත්පාදනයන් පිළිබඳ විශේෂඥතාව. Harvest Pro හි සෑම දෙයක්ම බලගැන්වන පරිමාණය කළ හැකි, විශ්වාසදායක පදනම Kode Tech විසින් තනා ඇත.',
    'Software Development|System Architecture|Cloud & Technology Solutions' =>
        'මෘදුකාංග සංවර්ධනය|පද්ධති ගෘහ නිර්මාණ ශිල්පය|ක්ලවුඩ් සහ තාක්ෂණික විසඳුම්',
    'Together, we are committed to building smarter solutions that help plantations grow, operate efficiently, and embrace the future of digital estate management' =>
        'එකට එක්ව, වතුයායන්ට වර්ධනය වීමට, කාර්යක්ෂමව මෙහෙයුම් කිරීමට සහ ඩිජිටල් වතු කළමනාකරණයේ අනාගතය වැළඳගැනීමට උපකාර වන වඩාත් දක්ෂ විසඳුම් තැනීමට අපි කැපවී සිටිමු.',

    // ---- About page: why choose -------------------------------------------------------
    'Why Choose' => 'තෝරාගත යුත්තේ ඇයි',
    'Why Choose Harvest Pro' => 'Harvest Pro තෝරාගත යුත්තේ ඇයි',
    'Plantation-Focused Solution|Built specifically for tea estates and plantations, helping you manage daily operations in one place.
Easy-to-Use Interface|A simple, user-friendly system designed for owners, managers, supervisors, and estate teams.
Real-Time Operational Insights|Track workforce, harvesting, expenses, tasks, and estate performance with up-to-date information.
Scalable for Small and Large Estates|Whether you manage a single estate or multiple plantations, Harvest Pro can grow with your operation.
Continuous Innovation and Support|Regular improvements, new features, and ongoing support to keep your plantation management running smoothly.' =>
        'වතුයාය-කේන්ද්‍රීය විසඳුමක්|තේ වතුයායන් හා වතු සඳහාම විශේෂයෙන් නිර්මාණය කර ඇති අතර, දෛනික මෙහෙයුම් එක් තැනකින් කළමනාකරණය කිරීමට උපකාර වේ.
පහසුවෙන් භාවිතා කළ හැකි අතුරු මුහුණතක්|හිමිකරුවන්, කළමනාකරුවන්, අධීක්ෂකවරුන් සහ වතු කණ්ඩායම් සඳහා නිර්මාණය කළ සරල, පරිශීලක හිතකාමී පද්ධතියකි.
තථ්‍ය කාලීන මෙහෙයුම් තීක්ෂණතා|යාවත්කාලීන තොරතුරු සමඟ කම්කරුවන්, අස්වනු නෙළීම, වියදම්, කාර්යයන් සහ වතුයායේ කාර්යසාධනය නිරීක්ෂණය කරන්න.
කුඩා හා විශාල වතු සඳහා පරිමාණය කළ හැකි|ඔබ එක් වතුයායක් හෝ බහු වතුයායන් කළමනාකරණය කළත්, Harvest Pro ඔබේ මෙහෙයුම සමඟ වර්ධනය විය හැක.
අඛණ්ඩ නවෝත්පාදනය හා සහාය|ඔබේ වතු කළමනාකරණය සුමටව පවත්වාගෙන යාම සඳහා නිතිපතා දියුණු කිරීම්, නව විශේෂාංග සහ අඛණ්ඩ සහාය.',

    // =====================================================================
    //  Features page: 11 detailed sections
    // =====================================================================

    // 1. Workforce Management
    'Workforce Management' => 'කම්කරු කළමනාකරණය',
    'Manage Your Workforce with Ease' => 'ඔබේ කම්කරුවන් පහසුවෙන් කළමනාකරණය කරන්න',
    'Keep your permanent and casual workforce organised with centralised worker profiles and simple daily work allocation.' =>
        'කේන්ද්‍රීයගත කම්කරු පැතිකඩ සහ සරල දෛනික කාර්ය පැවරීම් සමඟ ඔබේ ස්ථිර හා අනියම් කම්කරුවන් සංවිධානාත්මකව තබාගන්න.',
    'Register workers with their essential information, assign them to estates and sections, and record their daily work and output in one place.' =>
        'කම්කරුවන් ඔවුන්ගේ අත්‍යවශ්‍ය තොරතුරු සමඟ ලියාපදිංචි කරන්න, ඔවුන්ව වතු සහ අංශවලට පවරන්න, සහ ඔවුන්ගේ දෛනික කාර්යය හා ප්‍රතිදානය එක් තැනකින් වාර්තා කරන්න.',
    'Worker registration and profiles
Permanent and casual worker support
Assign workers by estate and section
Daily task assignments
Assign work by work type
Record output in KG, hours, or units
Active and inactive worker management' =>
        'කම්කරු ලියාපදිංචිය සහ පැතිකඩ
ස්ථිර හා අනියම් කම්කරු සහාය
වතුව හා අංශය අනුව කම්කරුවන් පැවරීම
දෛනික කාර්ය පැවරීම්
කාර්ය වර්ගය අනුව කාර්යය පැවරීම
කිලෝග්‍රෑම්, පැය හෝ ඒකක වශයෙන් ප්‍රතිදානය වාර්තා කිරීම
ක්‍රියාශීලී හා අක්‍රීය කම්කරු කළමනාකරණය',
    'The system supports worker details including name, ID, NIC, phone number, gender, assigned estates, and work categories.' =>
        'නම, හැඳුනුම්පත් අංකය, ජා.හැ.අංකය, දුරකථන අංකය, ස්ත්‍රී/පුරුෂ භාවය, පවරන ලද වතු සහ කාර්ය ප්‍රවර්ග ඇතුළු කම්කරු විස්තර පද්ධතිය මඟින් සහාය දක්වයි.',

    // 2. Daily Task & Output Management
    'Daily Task & Output Management' => 'දෛනික කාර්ය හා ප්‍රතිදාන කළමනාකරණය',
    'Know What Work Is Happening Every Day' => 'සෑම දිනකම සිදුවන කාර්යය දැනගන්න',
    'Create daily assignments for workers and maintain a clear record of work completed across your estate.' =>
        'කම්කරුවන් සඳහා දෛනික පැවරීම් සාදන්න සහ ඔබේ වතුයාය පුරා සම්පූර්ණ කළ කාර්යයේ පැහැදිලි වාර්තාවක් පවත්වාගෙන යන්න.',
    'Supervisors can select the estate, section, work type, worker, and quantity completed, helping management maintain accurate operational records.' =>
        'අධීක්ෂකවරුන්ට වතුව, අංශය, කාර්ය වර්ගය, කම්කරුවා සහ සම්පූර්ණ කළ ප්‍රමාණය තෝරාගත හැකි අතර, එමඟින් කළමනාකාරිත්වයට නිවැරදි මෙහෙයුම් වාර්තා පවත්වාගැනීමට උපකාර වේ.',
    'Track work such as:' => 'මෙවැනි කාර්යයන් නිරීක්ෂණය කරන්න:',
    'Tea plucking
Weeding
Clearing
Other configurable estate activities' =>
        'තේ නෙළීම
වල් නෙළීම
සෝදිසි කිරීම
වෙනත් සකසාගත හැකි වතු ක්‍රියාකාරකම්',
    'KG-based work
Hourly work
Unit-based work' =>
        'කිලෝග්‍රෑම් පදනම් කාර්යය
පැය පදනම් කාර්යය
ඒකක පදනම් කාර්යය',
    "Work types and rates can be configured according to the estate's requirements." =>
        'වතුයායේ අවශ්‍යතා අනුව කාර්ය වර්ග හා ගාස්තු සකසාගත හැක.',

    // 3. Payroll & Payments
    'Payroll & Payments' => 'වැටුප් හා ගෙවීම්',
    'Turn Daily Work into Accurate Payments' => 'දෛනික කාර්යය නිවැරදි ගෙවීම් බවට පත් කරන්න',
    'Reduce manual calculations by connecting recorded fieldwork directly with worker payments.' =>
        'වාර්තා කළ ක්ෂේත්‍ර කාර්යය කම්කරු ගෙවීම් සමඟ කෙලින්ම සම්බන්ධ කිරීමෙන් අතින් කරන ගණනය කිරීම් අඩු කරන්න.',
    'The system automatically calculates pay using the configured rate and completed quantity, making it easier to manage both output-based and other types of fieldwork.' =>
        'සකසන ලද ගාස්තුව හා සම්පූර්ණ කළ ප්‍රමාණය භාවිතයෙන් පද්ධතිය ස්වයංක්‍රීයව වැටුප ගණනය කරන අතර, ප්‍රතිදාන පදනම් හා වෙනත් ක්ෂේත්‍ර කාර්ය වර්ග කළමනාකරණය කිරීම පහසු කරයි.',
    'Automatic pay calculation
Rate x quantity calculation
KG/output-based payments
Hourly and fixed-unit work support
Pending payment tracking
Partial payment tracking
Paid status tracking
Worker payment reports
Pay-slip reports
PDF and Excel exports' =>
        'ස්වයංක්‍රීය වැටුප් ගණනය
ගාස්තුව x ප්‍රමාණය ගණනය
කිලෝග්‍රෑම්/ප්‍රතිදාන පදනම් ගෙවීම්
පැය හා නියත-ඒකක කාර්ය සහාය
ගෙවීමට ඇති ගෙවීම් නිරීක්ෂණය
පාර්ශවික ගෙවීම් නිරීක්ෂණය
ගෙවූ තත්ත්වය නිරීක්ෂණය
කම්කරු ගෙවීම් වාර්තා
වැටුප් පත්‍ර වාර්තා
PDF හා Excel නිර්යාත',
    'Full Payroll Dashboard — Coming Soon|While payment calculations and reports are already available, the dedicated full payroll dashboard is an upcoming feature.' =>
        'සම්පූර්ණ වැටුප් උපකරණ පුවරුව — ඉක්මනින්|ගෙවීම් ගණනය සහ වාර්තා දැනටමත් ලබා ගත හැකි වුවද, විශේෂිත සම්පූර්ණ වැටුප් උපකරණ පුවරුව ඉදිරියේදී එකතු වන විශේෂාංගයකි.',

    // 4. Harvest Tracking
    'Harvest Tracking' => 'අස්වනු නිරීක්ෂණය',
    'Track Every Kilogram of Green Leaf' => 'සෑම කිලෝග්‍රෑමයක් කොළ පතක්ම නිරීක්ෂණය කරන්න',
    'Maintain accurate daily harvesting records and understand how different sections and estates are performing.' =>
        'නිවැරදි දෛනික අස්වනු නෙළීමේ වාර්තා පවත්වාගෙන යන්න සහ විවිධ අංශ හා වතු කටයුතු කරන ආකාරය තේරුම් ගන්න.',
    'Harvest information is recorded through daily worker assignments and can be viewed through dashboards and reports.' =>
        'අස්වනු තොරතුරු දෛනික කම්කරු පැවරීම් හරහා වාර්තා කරනු ලබන අතර, උපකරණ පුවරු හා වාර්තා හරහා නැරඹිය හැක.',
    'Daily green leaf KG recording
Worker-level harvest output
Section-wise harvest monitoring
Estate-wise harvest monitoring
Historical harvest summaries
Harvest performance reporting
Top-worker visibility' =>
        'දෛනික කොළ පත් කිලෝග්‍රෑම් වාර්තාකරණය
කම්කරු මට්ටමේ අස්වනු ප්‍රතිදානය
අංශ අනුව අස්වනු නිරීක්ෂණය
වතු අනුව අස්වනු නිරීක්ෂණය
ඓතිහාසික අස්වනු සාරාංශ
අස්වනු කාර්යසාධන වාර්තාකරණය
ඉහළම කම්කරුවන් පිළිබඳ දැක්ම',
    'This feature focuses specifically on field harvesting and green leaf KG, rather than factory tea-production processes.' =>
        'මෙම විශේෂාංගය කර්මාන්ත ශාලා තේ නිෂ්පාදන ක්‍රියාවලීන් වෙනුවට, විශේෂයෙන් ක්ෂේත්‍ර අස්වනු නෙළීම හා කොළ පත් කිලෝග්‍රෑම් කෙරෙහි අවධානය යොමු කරයි.',

    // 5. Estate & Section Management
    'Estate & Section Management' => 'වතු හා අංශ කළමනාකරණය',
    'Manage Multiple Estates from One System' => 'එක් පද්ධතියකින් බහු වතු කළමනාකරණය කරන්න',
    "Organise your operations around the way your tea business actually works." =>
        'ඔබේ තේ ව්‍යාපාරය ඇත්තටම ක්‍රියාත්මක වන ආකාරයට ඔබේ මෙහෙයුම් සංවිධානය කරන්න.',
    'Create and manage multiple estates and divide them into sections so that workforce activities, harvesting, expenses, and other operational information can be recorded against the correct location.' =>
        'කම්කරු ක්‍රියාකාරකම්, අස්වනු නෙළීම, වියදම් සහ වෙනත් මෙහෙයුම් තොරතුරු නිවැරදි ස්ථානයට එරෙහිව වාර්තා කළ හැකි වන පරිදි බහු වතු නිර්මාණය කර කළමනාකරණය කර ඒවා අංශවලට බෙදන්න.',
    'Multi-estate management
Section management
Assign workers to estates
Section-based work assignments
Estate and section performance tracking
Centralised operational visibility' =>
        'බහු-වතු කළමනාකරණය
අංශ කළමනාකරණය
කම්කරුවන් වතුවලට පැවරීම
අංශ පදනම් කාර්ය පැවරීම්
වතු හා අංශ කාර්යසාධන නිරීක්ෂණය
කේන්ද්‍රීයගත මෙහෙයුම් දැක්ම',
    'Estate and section management forms a core part of the platform rather than functioning as a simple secondary setting.' =>
        'වතු හා අංශ කළමනාකරණය සරල ද්විතීයික සැකසුමක් ලෙස ක්‍රියා කරනවා වෙනුවට වේදිකාවේ ප්‍රධාන අංගයක් වේ.',

    // 6. Fertilizer & Field Activity Tracking
    'Fertilizer & Field Activity Tracking' => 'පොහොර හා ක්ෂේත්‍ර ක්‍රියාකාරකම් නිරීක්ෂණය',
    'Stay Ahead of Important Field Activities' => 'වැදගත් ක්ෂේත්‍ර ක්‍රියාකාරකම්වලින් ඉදිරියෙන් සිටින්න',
    'Keep important fertilizer applications and recurring estate activities organised.' =>
        'වැදගත් පොහොර යෙදීම් හා නැවත නැවත සිදුවන වතු ක්‍රියාකාරකම් සංවිධානාත්මකව තබාගන්න.',
    "Record fertilizer applications and use next-cycle reminders to help ensure important field activities aren't overlooked." =>
        'පොහොර යෙදීම් වාර්තා කර, වැදගත් ක්ෂේත්‍ර ක්‍රියාකාරකම් නොසලකා හරිනු නොලැබෙන බව සහතික කර ගැනීමට ඊළඟ චක්‍රය සඳහා මතක් කිරීම් භාවිතා කරන්න.',
    'Fertilizer application tracking
Section-based records
Next-cycle reminders
Calendar reminders
Field activity planning' =>
        'පොහොර යෙදීම් නිරීක්ෂණය
අංශ පදනම් වාර්තා
ඊළඟ චක්‍ර මතක් කිරීම්
දින දර්ශන මතක් කිරීම්
ක්ෂේත්‍ර ක්‍රියාකාරකම් සැලසුම්කරණය',
    'This gives estate managers visibility beyond harvesting and helps organise recurring field operations.' =>
        'මෙය වතු කළමනාකරුවන්ට අස්වනු නෙළීමෙන් ඔබ්බට දැක්මක් ලබා දෙන අතර, නැවත නැවත සිදුවන ක්ෂේත්‍ර මෙහෙයුම් සංවිධානය කිරීමට උපකාර වේ.',

    // 7. Expenses & Cost Control
    'Expenses & Cost Control' => 'වියදම් හා පිරිවැය පාලනය',
    'Understand Where Your Estate Is Spending' => 'ඔබේ වතුයාය වියදම් කරන්නේ කොහේද යන්න තේරුම් ගන්න',
    'Record operational expenses against estates and sections to maintain a clearer picture of costs across the business.' =>
        'ව්‍යාපාරය පුරා වියදම් පිළිබඳ පැහැදිලි චිත්‍රයක් පවත්වාගැනීමට වතු හා අංශවලට එරෙහිව මෙහෙයුම් වියදම් වාර්තා කරන්න.',
    'Create your own expense categories and distinguish between company-paid and worker-paid costs.' =>
        'ඔබේම වියදම් ප්‍රවර්ග සාදාගෙන සමාගම-ගෙවන සහ කම්කරු-ගෙවන වියදම් අතර වෙනස හඳුනාගන්න.',
    'Estate expense logging
Section expense logging
Custom expense categories
Company-paid costs
Worker-paid costs
Expense reports
Cost breakdowns' =>
        'වතු වියදම් සටහන් කිරීම
අංශ වියදම් සටහන් කිරීම
අභිරුචි වියදම් ප්‍රවර්ග
සමාගම-ගෙවන වියදම්
කම්කරු-ගෙවන වියදම්
වියදම් වාර්තා
පිරිවැය විග්‍රහයන්',
    'This allows management to review operational spending alongside workforce and harvest information.' =>
        'මෙය කම්කරු හා අස්වනු තොරතුරු සමඟින් මෙහෙයුම් වියදම් සමාලෝචනය කිරීමට කළමනාකාරිත්වයට ඉඩ සලසයි.',

    // 8. Reports & Insights
    'Reports & Insights' => 'වාර්තා හා තීක්ෂණතා',
    'Turn Daily Estate Data into Useful Information' => 'දෛනික වතු දත්ත ප්‍රයෝජනවත් තොරතුරු බවට පත් කරන්න',
    'Get a clearer understanding of your operations through dashboards and downloadable reports.' =>
        'උපකරණ පුවරු හා බාගත කළ හැකි වාර්තා හරහා ඔබේ මෙහෙයුම් පිළිබඳ පැහැදිලි අවබෝධයක් ලබාගන්න.',
    'Instead of relying on scattered records, management can access information covering assignments, payments, expenses, and harvesting from one system.' =>
        'විසිරුණු වාර්තා මත රඳා පැවතීම වෙනුවට, කළමනාකාරිත්වයට පැවරීම්, ගෙවීම්, වියදම් සහ අස්වනු නෙළීම ආවරණය කරන තොරතුරු එක් පද්ධතියකින් ලබාගත හැක.',
    'Available Reporting Areas' => 'ලබාගත හැකි වාර්තා අංශ',
    'Daily assignments
Worker payments
Expenses
Harvest
Estate and section performance' =>
        'දෛනික පැවරීම්
කම්කරු ගෙවීම්
වියදම්
අස්වනු නෙළීම
වතු හා අංශ කාර්යසාධනය',
    'Reporting Features' => 'වාර්තාකරණ විශේෂාංග',
    'English reports
Sinhala reports
PDF export
Excel export' =>
        'ඉංග්‍රීසි වාර්තා
සිංහල වාර්තා
PDF නිර්යාතය
Excel නිර්යාතය',
    'The platform currently supports four key reporting areas: assignments, payments, expenses, and harvest.' =>
        'වේදිකාව දැනට ප්‍රධාන වාර්තා අංශ හතරකට සහාය දක්වයි: පැවරීම්, ගෙවීම්, වියදම් සහ අස්වනු නෙළීම.',

    // 9. Operations Dashboard
    'Operations Dashboard' => 'මෙහෙයුම් උපකරණ පුවරුව',
    'Your Estate at a Glance' => 'එක් බැල්මකින් ඔබේ වතුයාය',
    'See the important areas of your estate operations from one central dashboard.' =>
        'එක් කේන්ද්‍රීය උපකරණ පුවරුවකින් ඔබේ වතු මෙහෙයුම්වල වැදගත් අංශ බලන්න.',
    'Monitor workforce activity, harvesting, payments, expenses, and operational performance without having to go through individual records.' =>
        'තනි තනි වාර්තා හරහා යාමට අවශ්‍ය නොවී කම්කරු ක්‍රියාකාරකම්, අස්වනු නෙළීම, ගෙවීම්, වියදම් සහ මෙහෙයුම් කාර්යසාධනය නිරීක්ෂණය කරන්න.',
    'Dashboard Insights' => 'උපකරණ පුවරු තීක්ෂණතා',
    'Worker information
Harvest information
Payroll/payment information
Expense information
Estate performance
Section performance' =>
        'කම්කරු තොරතුරු
අස්වනු තොරතුරු
වැටුප්/ගෙවීම් තොරතුරු
වියදම් තොරතුරු
වතු කාර්යසාධනය
අංශ කාර්යසාධනය',
    'The dashboard is designed to give management a quick operational overview of the estate.' =>
        'උපකරණ පුවරුව කළමනාකාරිත්වයට වතුයායේ ඉක්මන් මෙහෙයුම් දළ විශ්ලේෂණයක් ලබා දීමට නිර්මාණය කර ඇත.',

    // 10. Live TV Dashboard
    'Live TV Dashboard' => 'සජීවී රූපවාහිනී උපකරණ පුවරුව',
    'Keep Your Team Informed in Real Time' => 'ඔබේ කණ්ඩායම තථ්‍ය කාලීනව දැනුවත් කරන්න',
    'Display important estate information on a dedicated TV screen in your office or operational area.' =>
        'ඔබේ කාර්යාලයේ හෝ මෙහෙයුම් ප්‍රදේශයේ විශේෂිත රූපවාහිනී තිරයක වැදගත් වතු තොරතුරු පෙන්වන්න.',
    'The Live TV Dashboard provides an easy way for management and teams to view key estate information on a larger screen without navigating through the main system.' =>
        'ප්‍රධාන පද්ධතිය හරහා යාමකින් තොරව විශාල තිරයක ප්‍රධාන වතු තොරතුරු නැරඹීමට කළමනාකාරිත්වයට හා කණ්ඩායම්වලට පහසු ක්‍රමයක් සජීවී රූපවාහිනී උපකරණ පුවරුව සපයයි.',
    'Ideal for' => 'සුදුසුම වන්නේ',
    'Estate offices
Management areas
Operational displays
Daily performance visibility' =>
        'වතු කාර්යාල
කළමනාකරණ ප්‍රදේශ
මෙහෙයුම් සංදර්ශන
දෛනික කාර්යසාධන දැක්ම',
    "Live TV display is already included among the platform's current reporting and insight capabilities." =>
        'සජීවී රූපවාහිනී සංදර්ශනය දැනටමත් වේදිකාවේ වත්මන් වාර්තාකරණ හා තීක්ෂණතා හැකියාවන් අතරට ඇතුළත් වේ.',

    // 11. User Roles & Access
    'User Roles & Access' => 'පරිශීලක භූමිකා හා ප්‍රවේශය',
    'Give the Right Access to the Right People' => 'නිවැරදි පුද්ගලයින්ට නිවැරදි ප්‍රවේශය ලබාදෙන්න',
    "Different members of an estate team have different responsibilities. Role-based access helps organise system access according to each person's operational role." =>
        'වතු කණ්ඩායමක විවිධ සාමාජිකයින්ට විවිධ වගකීම් ඇත. භූමිකා-පදනම් ප්‍රවේශය සෑම පුද්ගලයෙකුගේම මෙහෙයුම් භූමිකාවට අනුව පද්ධති ප්‍රවේශය සංවිධානය කිරීමට උපකාර වේ.',
    'Available Roles' => 'ලබාගත හැකි භූමිකා',
    'Administrator
Planter
Supervisor' =>
        'පරිපාලක
වගාකරු
අධීක්ෂක',
    'This helps make the platform suitable for structured estate operations rather than functioning as a generic workforce application.' =>
        'මෙය සාමාන්‍ය කම්කරු යෙදුමක් ලෙස ක්‍රියා කරනවා වෙනුවට, ව්‍යූහගත වතු මෙහෙයුම් සඳහා වේදිකාව සුදුසු කිරීමට උපකාර වේ.',

    // ---- How It Works page ---------------------------------------------
    // Sinhala reorders "How {Brand} Works" as "{Brand} ක්‍රියා කරන ආකාරය"
    // (literally "the way {Brand} works"), so the English "How" prefix has
    // no separate word here — it's folded into the translated suffix below.
    'How' => '',
    'Works' => 'ක්‍රියා කරන ආකාරය',
    'Set up your tea estate and start managing your daily operations in just a few simple steps.' =>
        'ඔබේ තේ වතුයාය සකසා සරල පියවර කිහිපයකින් ඔබේ දෛනික මෙහෙයුම් කළමනාකරණය කිරීම ආරම්භ කරන්න.',
    'Create an Account' => 'ගිණුමක් සාදන්න',
    'Sign up for Harvest Pro and start your 14-day free trial. It only takes a few minutes to create your account.' =>
        'Harvest Pro සඳහා ලියාපදිංචි වී ඔබේ දින 14 නොමිලේ අත්හදා බැලීම ආරම්භ කරන්න. ගිණුමක් සෑදීමට විනාඩි කිහිපයක් පමණක් ගතවේ.',
    'Visit Harvest Pro' => 'Harvest Pro වෙබ් අඩවියට පිවිසෙන්න',
    'Go to the Harvest Pro website and click Pricing from the main menu.' =>
        'Harvest Pro වෙබ් අඩවියට ගොස් ප්‍රධාන මෙනුවෙන් Pricing ක්ලික් කරන්න.',
    'Select the plan that best suits your estate: Basic Tier, Mid Tier, or Top Tier.' =>
        'ඔබේ වතුයායට වඩාත් ගැලපෙන සැලැස්ම තෝරන්න: Basic Tier, Mid Tier, හෝ Top Tier.',
    'Get Started' => 'ආරම්භ කරන්න',
    'Once you have selected your plan, click "Get Started with Plan".' =>
        'ඔබ සැලැස්ම තෝරාගත් පසු, "Get Started with Plan" ක්ලික් කරන්න.',
    'Start Your Free Trial' => 'ඔබේ නොමිලේ අත්හදා බැලීම ආරම්භ කරන්න',
    'Click "Start Your 14-Day Free Trial" to continue.' =>
        'ඉදිරියට යාමට "Start Your 14-Day Free Trial" ක්ලික් කරන්න.',
    'Fill in Your Details' => 'ඔබේ විස්තර පුරවන්න',
    'Enter the required information, including your personal details, estate details, mobile number, and city.' =>
        'ඔබේ පුද්ගලික විස්තර, වතුයාය විස්තර, ජංගම දුරකථන අංකය සහ නගරය ඇතුළුව අවශ්‍ය තොරතුරු ඇතුළත් කරන්න.',
    'Activate Your Trial' => 'ඔබේ අත්හදා බැලීම සක්‍රිය කරන්න',
    'Check that all your information is correct, then click "Start 14-Day Trial".' =>
        'ඔබේ සියලුම තොරතුරු නිවැරදි දැයි පරීක්ෂා කර, පසුව "Start 14-Day Trial" ක්ලික් කරන්න.',
    'Log In to Harvest Pro' => 'Harvest Pro වෙත පිවිසෙන්න',
    'Your account is now ready. Log in to the Harvest Pro system and start managing your tea estate.' =>
        'ඔබේ ගිණුම දැන් සූදානම්. Harvest Pro පද්ධතියට පිවිස ඔබේ තේ වතුයාය කළමනාකරණය කිරීම ආරම්භ කරන්න.',
    'You can use Harvest Pro free for 14 days before choosing to continue with your selected plan.' =>
        'ඔබ තෝරාගත් සැලැස්ම සමඟ ඉදිරියට යාමට තීරණය කිරීමට පෙර, ඔබට Harvest Pro දින 14ක් නොමිලේ භාවිත කළ හැක.',
    'Estate Management' => 'වතුයාය කළමනාකරණය',
    'After logging in to Harvest Pro, the first thing you need to do is set up your estate.' =>
        'Harvest Pro වෙත පිවිසීමෙන් පසු, ඔබ මුලින්ම කළ යුතු දේ නම් ඔබේ වතුයාය සැකසීමයි.',
    'Add your estate details and sections.' => 'ඔබේ වතුයාය විස්තර සහ අංශ එකතු කරන්න.',
    'Go to Estate Management' => 'Estate Management වෙත යන්න',
    'Click Estate Management from the system menu.' => 'පද්ධති මෙනුවෙන් Estate Management ක්ලික් කරන්න.',
    'Select Your Estate' => 'ඔබේ වතුයාය තෝරන්න',
    'You will see the tea estate you added when creating your Harvest Pro account. Click on the estate name to open and manage your estate.' =>
        'ඔබේ Harvest Pro ගිණුම සෑදූ විට ඔබ එකතු කළ තේ වතුයාය ඔබට පෙනෙනු ඇත. ඔබේ වතුයාය විවෘත කර කළමනාකරණය කිරීමට වතුයාය නම ක්ලික් කරන්න.',
    'Add Another Estate' => 'තවත් වතුයායක් එකතු කරන්න',
    'If you manage more than one tea estate, you can click Add New Estate. To add an additional estate, you will need to select and purchase a new subscription for that estate.' =>
        'ඔබ තේ වතුයායක් කිහිපයක් කළමනාකරණය කරන්නේ නම්, ඔබට Add New Estate ක්ලික් කළ හැක. අමතර වතුයායක් එකතු කිරීමට, එම වතුයාය සඳහා නව දායකත්වයක් තෝරාගෙන මිලදී ගත යුතුය.',
    'Add Sections to Your Estate' => 'ඔබේ වතුයායට අංශ එකතු කරන්න',
    'After selecting your estate, you can create the different sections or fields within your estate — for example, Field 01, Field 02, Field 03, New Tea Section, or Old Tea Section. Enter the section name based on how your estate is divided.' =>
        'ඔබේ වතුයාය තෝරාගත් පසු, ඔබට එහි විවිධ අංශ හෝ කුඹුරු නිර්මාණය කළ හැක — උදාහරණයක් ලෙස, Field 01, Field 02, Field 03, New Tea Section, හෝ Old Tea Section. ඔබේ වතුයාය බෙදී ඇති ආකාරයට අනුව අංශයේ නම ඇතුළත් කරන්න.',
    'Once your sections are added, you can use them throughout Harvest Pro to organize and track your estate operations more accurately.' =>
        'ඔබේ අංශ එකතු කළ පසු, ඔබේ වතුයාය මෙහෙයුම් වඩාත් නිවැරදිව සංවිධානය කර නිරීක්ෂණය කිරීමට Harvest Pro පුරාම ඒවා භාවිත කළ හැක.',
    'Service Management' => 'සේවා කළමනාකරණය',
    'Set up the labour services your estate offers, along with how each one is measured and paid.' =>
        'ඔබේ වතුයාය ලබාදෙන කම්කරු සේවා සහ ඒ එක් එක් මනින හා ගෙවන ආකාරය සකසන්න.',
    'Add labour services, units, and pay rates.' => 'කම්කරු සේවා, ඒකක සහ ගෙවීම් අනුපාත එකතු කරන්න.',
    'Go to Service Management' => 'Service Management වෙත යන්න',
    'From the left-side menu, click Service Management.' => 'වම් පස මෙනුවෙන් Service Management ක්ලික් කරන්න.',
    'Add a New Service' => 'නව සේවාවක් එකතු කරන්න',
    'Click the Add Labour Service button at the top-right of the page. The Add New Service form will appear.' =>
        'පිටුවේ ඉහළ දකුණේ ඇති Add Labour Service බොත්තම ක්ලික් කරන්න. Add New Service පෝරමය දිස්වනු ඇත.',
    'Enter the Service Name' => 'සේවා නම ඇතුළත් කරන්න',
    'Enter the type of work or service you want to add — for example, Leaf Plucking, Fertilizing, Pruning, or Weeding.' =>
        'ඔබට එකතු කිරීමට අවශ්‍ය කාර්යයේ හෝ සේවාවේ වර්ගය ඇතුළත් කරන්න — උදාහරණයක් ලෙස, Leaf Plucking, Fertilizing, Pruning, හෝ Weeding.',
    'Add a Description' => 'විස්තරයක් එකතු කරන්න',
    'Enter a short description of the service if required.' => 'අවශ්‍ය නම් සේවාවේ කෙටි විස්තරයක් ඇතුළත් කරන්න.',
    'Select the Status' => 'තත්ත්වය තෝරන්න',
    'Set the service status to Active if you want to start using it immediately.' =>
        'වහාම භාවිතා කිරීමට අවශ්‍ය නම් සේවා තත්ත්වය Active ලෙස සකසන්න.',
    'Enter the Unit Type' => 'ඒකක වර්ගය ඇතුළත් කරන්න',
    'Enter how the service will be measured — for example, KG for leaf plucking, Unit for an individual task, Tank for spraying, or Day for daily work.' =>
        'සේවාව මනින ආකාරය ඇතුළත් කරන්න — උදාහරණයක් ලෙස, දලු කැඩීම සඳහා KG, තනි කාර්යයක් සඳහා Unit, ඉසීම සඳහා Tank, හෝ දෛනික වැඩ සඳහා Day.',
    'Set the Rate per Unit' => 'ඒකකයකට අනුපාතය සකසන්න',
    'Enter the amount you pay for each unit. For example, if leaf plucking is paid at LKR 50 per KG, set Unit Type to KG and Rate per Unit to LKR 50. Or, if a worker is paid LKR 2,000 per day, set Unit Type to Day and Rate per Unit to LKR 2,000.' =>
        'එක් ඒකකයකට ඔබ ගෙවන මුදල ඇතුළත් කරන්න. උදාහරණයක් ලෙස, දලු කැඩීම KG එකකට රු. 50ක් ගෙවනවා නම්, Unit Type ලෙස KG සහ Rate per Unit ලෙස රු. 50 සකසන්න. නැතහොත් කම්කරුවෙකුට දිනකට රු. 2,000ක් ගෙවනවා නම්, Unit Type ලෙස Day සහ Rate per Unit ලෙස රු. 2,000 සකසන්න.',
    'Single Quantity Service' => 'තනි ප්‍රමාණ සේවාව',
    'Tick Single Quantity Service when the service should always be counted as 1 unit — for example, if you pay LKR 2,000 for one full day of work. The quantity field will then be disabled when assigning this service. Leave it unticked for services where the quantity can change, such as 10 KG, 25 KG, or 50 KG of leaf plucking.' =>
        'සේවාව සැමවිටම ඒකකයක් 1ක් ලෙස ගණන් කළ යුතු විට Single Quantity Service ලකුණු කරන්න — උදාහරණයක් ලෙස, සම්පූර්ණ දිනක වැඩකට රු. 2,000ක් ගෙවනවා නම්. එවිට මෙම සේවාව පවරන විට ප්‍රමාණය ක්ෂේත්‍රය අක්‍රිය වේ. දලු කැඩීමේ KG 10, 25, හෝ 50 වැනි ප්‍රමාණය වෙනස් විය හැකි සේවා සඳහා එය ලකුණු නොකර තබන්න.',
    'Add the Service' => 'සේවාව එකතු කරන්න',
    'Check the details and click Add Service.' => 'විස්තර පරීක්ෂා කර Add Service ක්ලික් කරන්න.',
    'Your new service is now ready to use when assigning work to employees in Harvest Pro.' =>
        'Harvest Pro හි සේවකයන්ට වැඩ පැවරීමේදී භාවිතා කිරීමට ඔබේ නව සේවාව දැන් සූදානම්.',
    'Employee Management' => 'සේවක කළමනාකරණය',
    'Add your workers to Harvest Pro and assign them to the right services and estates.' =>
        'ඔබේ කම්කරුවන් Harvest Pro වෙත එකතු කර නිවැරදි සේවා සහ වතුයායන් වෙත පවරන්න.',
    'Add employees and assign services and estates.' => 'සේවකයන් එකතු කර සේවා සහ වතුයායන් පවරන්න.',
    'Go to Employee Management' => 'Employee Management වෙත යන්න',
    'From the left-side menu, click Employee Management.' => 'වම් පස මෙනුවෙන් Employee Management ක්ලික් කරන්න.',
    'Add a New Employee' => 'නව සේවකයෙකු එකතු කරන්න',
    'Click the Add Employee button at the top-right of the page. The Add New Employee form will appear.' =>
        'පිටුවේ ඉහළ දකුණේ ඇති Add Employee බොත්තම ක්ලික් කරන්න. Add New Employee පෝරමය දිස්වනු ඇත.',
    'Enter Employee Details' => 'සේවක විස්තර ඇතුළත් කරන්න',
    "Fill in the employee's information, including full name, phone number, gender, NIC, and status." =>
        'සම්පූර්ණ නම, දුරකථන අංකය, ස්ත්‍රී පුරුෂ භාවය, ජාතික හැඳුනුම්පත් අංකය සහ තත්ත්වය ඇතුළුව සේවකයාගේ තොරතුරු පුරවන්න.',
    'Add Employee ID' => 'සේවක හැඳුනුම්පත් අංකය එකතු කරන්න',
    "The Employee ID can be automatically assigned by Harvest Pro if you leave the field blank. Alternatively, you can manually enter your own employee ID, such as the employee's ETF number." =>
        'ක්ෂේත්‍රය හිස්ව තැබුවහොත් සේවක හැඳුනුම්පත් අංකය Harvest Pro මගින් ස්වයංක්‍රීයව පවරනු ලැබේ. විකල්පයක් ලෙස, සේවකයාගේ ETF අංකය වැනි ඔබේම හැඳුනුම්පත් අංකයක් ඔබට අතින් ඇතුළත් කළ හැක.',
    'Select Service Categories' => 'සේවා කාණ්ඩ තෝරන්න',
    'Under Service Categories, select the services the employee can perform — for example, Fertilizing, Leaf Plucking, Pruning, or Weeding. These categories are based on the services you previously created under Service Management.' =>
        'Service Categories යටතේ, සේවකයාට කළ හැකි සේවා තෝරන්න — උදාහරණයක් ලෙස, Fertilizing, Leaf Plucking, Pruning, හෝ Weeding. මෙම කාණ්ඩ ඔබ පෙර Service Management යටතේ සාදන ලද සේවා මත පදනම් වේ.',
    'Assign the Employee to an Estate' => 'සේවකයා වතුයායකට පවරන්න',
    'Under Estates, tick the estate or estates where the employee works. You can assign an employee to one or multiple estates, depending on your requirements.' =>
        'Estates යටතේ, සේවකයා වැඩ කරන වතුයාය හෝ වතුයායන් ලකුණු කරන්න. ඔබේ අවශ්‍යතාවය අනුව සේවකයෙකු එක් වතුයායකට හෝ කිහිපයකට පවරා ගත හැක.',
    'Add Employee' => 'සේවකයා එකතු කරන්න',
    'Check that all the information is correct, then click Add Employee.' => 'සියලුම තොරතුරු නිවැරදි දැයි පරීක්ෂා කර, පසුව Add Employee ක්ලික් කරන්න.',
    'The employee will now be added to your Harvest Pro Employee Management system.' =>
        'සේවකයා දැන් ඔබේ Harvest Pro Employee Management පද්ධතියට එකතු වනු ඇත.',
    'Daily Assignment' => 'දෛනික පැවරුම්',
    'Record the daily work completed by your employees and let Harvest Pro calculate their payments automatically.' =>
        'ඔබේ සේවකයන් විසින් සම්පූර්ණ කරන ලද දෛනික වැඩ වාර්තා කර, ඔවුන්ගේ ගෙවීම් ස්වයංක්‍රීයව ගණනය කිරීමට Harvest Pro ට ඉඩ දෙන්න.',
    'Record daily work and auto-calculate payments.' => 'දෛනික වැඩ වාර්තා කර ගෙවීම් ස්වයංක්‍රීයව ගණනය කරන්න.',
    'Go to Daily Assignment' => 'Daily Assignment වෙත යන්න',
    'From the left-side menu, click Daily Assignment. This section allows you to record the daily work completed by your employees and automatically calculate their payments based on the service rate.' =>
        'වම් පස මෙනුවෙන් Daily Assignment ක්ලික් කරන්න. මෙම කොටස ඔබට ඔබේ සේවකයන්ගේ දෛනික වැඩ වාර්තා කර, සේවා අනුපාතය මත පදනම්ව ඔවුන්ගේ ගෙවීම් ස්වයංක්‍රීයව ගණනය කිරීමට ඉඩ දෙයි.',
    'Add a New Assignment' => 'නව පැවරුමක් එකතු කරන්න',
    'Click the Add Assignment button at the top-right of the page. A New Assignment form will appear.' =>
        'පිටුවේ ඉහළ දකුණේ ඇති Add Assignment බොත්තම ක්ලික් කරන්න. New Assignment පෝරමය දිස්වනු ඇත.',
    'Select the Estate' => 'වතුයාය තෝරන්න',
    'Choose the estate where the work was carried out.' => 'වැඩ සිදු කරන ලද වතුයාය තෝරන්න.',
    'Select the Section' => 'අංශය තෝරන්න',
    'Choose the relevant section of the estate — for example, Field 01, Field 02, or Plantation A.' =>
        'වතුයායේ අදාළ අංශය තෝරන්න — උදාහරණයක් ලෙස, Field 01, Field 02, හෝ Plantation A.',
    'Select the Service' => 'සේවාව තෝරන්න',
    'Select the service completed by the workers — for example, Leaf Plucking. The system will automatically display the rate you previously set under Service Management, such as LKR 50 per KG.' =>
        'කම්කරුවන් විසින් සම්පූර්ණ කරන ලද සේවාව තෝරන්න — උදාහරණයක් ලෙස, Leaf Plucking. ඔබ පෙර Service Management යටතේ සකසන ලද අනුපාතය, උදාහරණයක් ලෙස KG එකකට රු. 50, පද්ධතිය ස්වයංක්‍රීයව පෙන්වයි.',
    'Add Workers' => 'කම්කරුවන් එකතු කරන්න',
    'Click Add a Worker Below, then click the Search Workers field — your previously added employees will automatically appear. Select the worker you want to add. You can add multiple workers to the same daily assignment.' =>
        'Add a Worker Below ක්ලික් කර, පසුව Search Workers ක්ෂේත්‍රය ක්ලික් කරන්න — ඔබ පෙර එකතු කළ සේවකයන් ස්වයංක්‍රීයව දිස්වනු ඇත. ඔබට එකතු කිරීමට අවශ්‍ය කම්කරුවා තෝරන්න. එකම දෛනික පැවරුමට ඔබට කම්කරුවන් කිහිප දෙනෙකු එකතු කළ හැක.',
    'Enter the Work Quantity' => 'වැඩ ප්‍රමාණය ඇතුළත් කරන්න',
    "Enter the quantity completed by each worker. For example, if a worker plucked 60 KG of green leaf, enter 60 KG. Harvest Pro will automatically calculate the worker's payment based on the rate: 60 KG × LKR 50 = LKR 3,000. This information will also be used for Payroll." =>
        'එක් එක් කම්කරුවා විසින් සම්පූර්ණ කරන ලද ප්‍රමාණය ඇතුළත් කරන්න. උදාහරණයක් ලෙස, කම්කරුවෙකු අමු දලු KG 60ක් කැඩුවේ නම්, 60 KG ඇතුළත් කරන්න. Harvest Pro අනුපාතය මත පදනම්ව කම්කරුවාගේ ගෙවීම ස්වයංක්‍රීයව ගණනය කරයි: 60 KG × රු. 50 = රු. 3,000. මෙම තොරතුරු Payroll සඳහාද භාවිතා වේ.',
    'Add a Temporary Worker' => 'තාවකාලික කම්කරුවෙකු එකතු කරන්න',
    'If someone works only on a temporary or daily basis and is not registered as a regular employee, click Add a Temporary Worker Below to record their work for that day without adding them as a permanent employee.' =>
        'යමෙක් තාවකාලික හෝ දෛනික පදනමින් පමණක් වැඩ කරන අතර නිත්‍ය සේවකයෙකු ලෙස ලියාපදිංචි වී නොමැති නම්, ඔහුව ස්ථිර සේවකයෙකු ලෙස එකතු නොකර එදින වැඩ වාර්තා කිරීමට Add a Temporary Worker Below ක්ලික් කරන්න.',
    'Create the Assignment' => 'පැවරුම සාදන්න',
    'Once all workers and quantities have been entered, check the details and click Create & Add Workers.' =>
        'සියලුම කම්කරුවන් සහ ප්‍රමාණයන් ඇතුළත් කළ පසු, විස්තර පරීක්ෂා කර Create & Add Workers ක්ලික් කරන්න.',
    'Your daily assignment is now recorded in Harvest Pro, including the workers, work quantities, and calculated payments.' =>
        'ඔබේ දෛනික පැවරුම දැන්, කම්කරුවන්, වැඩ ප්‍රමාණයන් සහ ගණනය කළ ගෙවීම් ඇතුළුව Harvest Pro හි වාර්තා වී ඇත.',
    'Expense' => 'වියදම්',
    'Record and track all the expenses related to your tea estates.' => 'ඔබේ තේ වතුයායන් සම්බන්ධ සියලුම වියදම් වාර්තා කර නිරීක්ෂණය කරන්න.',
    'Record and track estate expenses.' => 'වතුයාය වියදම් වාර්තා කර නිරීක්ෂණය කරන්න.',
    'Go to Expenses' => 'Expenses වෙත යන්න',
    'From the left-side menu, click Expenses. This section allows you to record and track all expenses related to your tea estates.' =>
        'වම් පස මෙනුවෙන් Expenses ක්ලික් කරන්න. මෙම කොටස ඔබට ඔබේ තේ වතුයායන් සම්බන්ධ සියලුම වියදම් වාර්තා කර නිරීක්ෂණය කිරීමට ඉඩ දෙයි.',
    'Add a New Expense' => 'නව වියදමක් එකතු කරන්න',
    'Click the Add Expense button. The Add New Expense form will appear.' =>
        'Add Expense බොත්තම ක්ලික් කරන්න. Add New Expense පෝරමය දිස්වනු ඇත.',
    'Select the Date' => 'දිනය තෝරන්න',
    'Choose the date when the expense occurred.' => 'වියදම සිදුවූ දිනය තෝරන්න.',
    'Select the Expense Category' => 'වියදම් කාණ්ඩය තෝරන්න',
    'Choose the appropriate category for the expense — for example, Equipment, Food, Tools, Transport, Utilities, or Other.' =>
        'වියදම සඳහා සුදුසු කාණ්ඩය තෝරන්න — උදාහරණයක් ලෙස, Equipment, Food, Tools, Transport, Utilities, හෝ Other.',
    'Enter a short description explaining what the expense was for.' => 'වියදම කුමක් සඳහාදැයි පැහැදිලි කරන කෙටි විස්තරයක් ඇතුළත් කරන්න.',
    'Enter the Amount' => 'මුදල ඇතුළත් කරන්න',
    'Enter the total expense amount in LKR.' => 'මුළු වියදම් මුදල LKR වලින් ඇතුළත් කරන්න.',
    'Select the estate related to the expense. If you manage multiple estates, you can record and track expenses separately for each estate.' =>
        'වියදම සම්බන්ධ වතුයාය තෝරන්න. ඔබ වතුයායන් කිහිපයක් කළමනාකරණය කරන්නේ නම්, එක් එක් වතුයාය සඳහා වෙන වෙනම වියදම් වාර්තා කර නිරීක්ෂණය කළ හැක.',
    'If the expense belongs to a specific section or field, select it under Section. If it is a general estate expense, select All / General.' =>
        'වියදම නිශ්චිත අංශයකට හෝ කුඹුරකට අයත් නම්, එය Section යටතේ තෝරන්න. එය සාමාන්‍ය වතුයාය වියදමක් නම්, All / General තෝරන්න.',
    'Add the Expense' => 'වියදම එකතු කරන්න',
    'Check all the information and click Add Expense.' => 'සියලුම තොරතුරු පරීක්ෂා කර Add Expense ක්ලික් කරන්න.',
    'The expense will now be recorded in Harvest Pro, helping you track estate expenses and costs accurately for each estate and section.' =>
        'වියදම දැන් Harvest Pro හි වාර්තා වනු ඇත, එය එක් එක් වතුයාය සහ අංශය සඳහා වියදම් සහ පිරිවැය නිවැරදිව නිරීක්ෂණය කිරීමට ඔබට උපකාර වේ.',
    'Fertilizer Management' => 'පොහොර කළමනාකරණය',
    'Track fertilizer applications and cycles, and know exactly when each field is next due.' =>
        'පොහොර යෙදීම් සහ චක්‍ර නිරීක්ෂණය කර, එක් එක් ක්ෂේත්‍රය ඊළඟට ලබාදිය යුත්තේ කවදාදැයි හරියටම දැනගන්න.',
    'Track fertilizer applications and due dates.' => 'පොහොර යෙදීම් සහ නියමිත දින නිරීක්ෂණය කරන්න.',
    'Go to Fertilizer Management' => 'Fertilizer Management වෙත යන්න',
    'From the left-side menu, click Fertilizer Management. Here you can view the fertilizer calendar, applications, cycles, and upcoming due dates.' =>
        'වම් පස මෙනුවෙන් Fertilizer Management ක්ලික් කරන්න. මෙහිදී ඔබට පොහොර දින දර්ශනය, යෙදීම්, චක්‍ර සහ ඉදිරි නියමිත දින බැලිය හැක.',
    'Add a Fertilizer' => 'පොහොරක් එකතු කරන්න',
    'Click Add Fertilizer at the top-right of the page and add the fertilizer types you use on your estate — for example, T200, T750, NPK 15-15-15, or Urea.' =>
        'පිටුවේ ඉහළ දකුණේ ඇති Add Fertilizer ක්ලික් කර, ඔබේ වතුයායේ භාවිතා කරන පොහොර වර්ග එකතු කරන්න — උදාහරණයක් ලෙස, T200, T750, NPK 15-15-15, හෝ Urea.',
    'Add a Fertilizer Cycle' => 'පොහොර චක්‍රයක් එකතු කරන්න',
    'Click Add Fertilizer Cycle to record a new fertilizer application and set its next cycle.' =>
        'නව පොහොර යෙදීමක් වාර්තා කර එහි ඊළඟ චක්‍රය සැකසීමට Add Fertilizer Cycle ක්ලික් කරන්න.',
    'Select the Estate and Section' => 'වතුයාය සහ අංශය තෝරන්න',
    'Select the estate where the fertilizer was applied, then select the relevant section or field — for example, Field 01, Field 02, Plantation A, or Plantation B.' =>
        'පොහොර යෙදූ වතුයාය තෝරන්න, පසුව අදාළ අංශය හෝ කුඹුර තෝරන්න — උදාහරණයක් ලෙස, Field 01, Field 02, Plantation A, හෝ Plantation B.',
    'Select the Fertilizer' => 'පොහොර තෝරන්න',
    'Choose the fertilizer type you applied from your previously added fertilizer list — for example, T200.' =>
        'ඔබ පෙර එකතු කළ පොහොර ලැයිස්තුවෙන් ඔබ යෙදූ පොහොර වර්ගය තෝරන්න — උදාහරණයක් ලෙස, T200.',
    'Enter the Application Details' => 'යෙදීමේ විස්තර ඇතුළත් කරන්න',
    'Select the application date and enter the amount of fertilizer used — for example, T200 at a quantity of 150 KG.' =>
        'යෙදූ දිනය තෝරා භාවිතා කළ පොහොර ප්‍රමාණය ඇතුළත් කරන්න — උදාහරණයක් ලෙස, T200 KG 150ක ප්‍රමාණයකින්.',
    'Set the Fertilizer Cycle' => 'පොහොර චක්‍රය සකසන්න',
    'Enter the number of days before the next fertilizer application is required — for example, 50, 75, or 90 days. If you select a 90-day cycle, Harvest Pro will automatically calculate the next fertilizer due date.' =>
        'ඊළඟ පොහොර යෙදීම අවශ්‍ය වන්නේ දින කීයකින්දැයි ඇතුළත් කරන්න — උදාහරණයක් ලෙස, දින 50, 75, හෝ 90. ඔබ දින 90ක චක්‍රයක් තෝරාගතහොත්, Harvest Pro ඊළඟ පොහොර නියමිත දිනය ස්වයංක්‍රීයව ගණනය කරයි.',
    'Save the Fertilizer Application' => 'පොහොර යෙදීම සුරකින්න',
    'Check all the details and save the application. The record will now appear on the Fertilizer Management calendar and under All Applications.' =>
        'සියලුම විස්තර පරීක්ෂා කර යෙදීම සුරකින්න. වාර්තාව දැන් Fertilizer Management දින දර්ශනයේ සහ All Applications යටතේ දිස්වනු ඇත.',
    'Track Next Due Dates & Reminders' => 'ඊළඟ නියමිත දින හා මතක් කිරීම් නිරීක්ෂණය කරන්න',
    'Harvest Pro automatically tracks the fertilizer cycle and shows the last application date, next due date, cycle (e.g. 90 days), days remaining, estate, and section / field.' =>
        'Harvest Pro පොහොර චක්‍රය ස්වයංක්‍රීයව නිරීක්ෂණය කර අවසන් යෙදූ දිනය, ඊළඟ නියමිත දිනය, චක්‍රය (උදා. දින 90), ඉතිරි දින ගණන, වතුයාය සහ අංශය / කුඹුර පෙන්වයි.',
    'This helps you identify which field needs fertilizer next and when it is due, without manually calculating the dates.' =>
        'මෙය ඊළඟට පොහොර අවශ්‍ය ක්ෂේත්‍රය සහ එය නියමිත වන්නේ කවදාදැයි, දින අතින් ගණනය නොකර හඳුනාගැනීමට උපකාර වේ.',
    'Factory Management' => 'කර්මාන්ත ශාලා කළමනාකරණය',
    'Track green leaf deliveries, factory weights, monthly prices, and profit — from plucking to final payment.' =>
        'අමු දලු බෙදාහැරීම්, කර්මාන්ත ශාලා බර, මාසික මිල ගණන් සහ ලාභය — කැඩීමේ සිට අවසාන ගෙවීම දක්වා නිරීක්ෂණය කරන්න.',
    'Track deliveries, weights, prices, and profit.' => 'බෙදාහැරීම්, බර, මිල ගණන් සහ ලාභය නිරීක්ෂණය කරන්න.',
    'Go to Factory Management' => 'Factory Management වෙත යන්න',
    'From the left-side menu, click Factory Management. You will see five tabs: Overview, Deliveries, Expenses, Monthly Prices, and Factories. When using Factory Management for the first time, start with the Factories tab.' =>
        'වම් පස මෙනුවෙන් Factory Management ක්ලික් කරන්න. ඔබට tab පහක් පෙනෙනු ඇත: Overview, Deliveries, Expenses, Monthly Prices, සහ Factories. Factory Management පළමු වරට භාවිතා කරන විට, Factories tab එකෙන් ආරම්භ කරන්න.',
    'Add Your Tea Factory' => 'ඔබේ තේ කර්මාන්ත ශාලාව එකතු කරන්න',
    'Click the Factories tab and enter the factory details: factory name, location, and status (select Active) — notes are optional. Click Save Factory. If you supply green leaf to more than one factory, you can add each factory separately.' =>
        'Factories tab එක ක්ලික් කර කර්මාන්ත ශාලා විස්තර ඇතුළත් කරන්න: කර්මාන්ත ශාලා නම, ස්ථානය, තත්ත්වය (Active තෝරන්න) — සටහන් අත්‍යවශ්‍ය නොවේ. Save Factory ක්ලික් කරන්න. ඔබ කර්මාන්ත ශාලා කිහිපයකට අමු දලු සපයනවා නම්, එක් එක් කර්මාන්ත ශාලාව වෙන වෙනම එකතු කළ හැක.',
    'Go to Deliveries' => 'Deliveries වෙත යන්න',
    'Click the Deliveries tab. The green leaf KG recorded from your daily plucking will automatically appear here. For example, if your workers plucked 150 KG today, the 150 KG will appear under Deliveries, ready to be assigned to a factory.' =>
        'Deliveries tab එක ක්ලික් කරන්න. ඔබේ දෛනික දලු කැඩීමෙන් වාර්තා වන අමු දලු KG ප්‍රමාණය මෙහි ස්වයංක්‍රීයව දිස්වනු ඇත. උදාහරණයක් ලෙස, ඔබේ කම්කරුවන් අද KG 150ක් කැඩුවේ නම්, එම KG 150 කර්මාන්ත ශාලාවකට පැවරීමට සූදානම්ව Deliveries යටතේ දිස්වනු ඇත.',
    'Assign the Green Leaf to a Factory' => 'අමු දලු කර්මාන්ත ශාලාවකට පවරන්න',
    'Select the factory where you delivered the green leaf. If all 150 KG went to one factory, assign the full 150 KG to that factory. If you delivered the leaf to multiple factories, click Split Across Factories — for example, 100 KG to Factory A and 50 KG to Factory B. This allows you to track exactly how much leaf was sent to each factory.' =>
        'ඔබ අමු දලු බෙදාහළ කර්මාන්ත ශාලාව තෝරන්න. KG 150ම එක් කර්මාන්ත ශාලාවකට ගියේ නම්, එම KG 150ම එම කර්මාන්ත ශාලාවට පවරන්න. ඔබ දලු කර්මාන්ත ශාලා කිහිපයකට බෙදාහළේ නම්, Split Across Factories ක්ලික් කරන්න — උදාහරණයක් ලෙස, Factory A ට KG 100ක් සහ Factory B ට KG 50ක්. මෙය එක් එක් කර්මාන්ත ශාලාවට යවන ලද දලු ප්‍රමාණය හරියටම නිරීක්ෂණය කිරීමට ඉඩ දෙයි.',
    'Check the Field KG' => 'Field KG පරීක්ෂා කරන්න',
    'After assigning the delivery, you will see the Field KG — the weight recorded by your estate before the green leaf is weighed at the factory. For example, Field KG: 73 KG.' =>
        'බෙදාහැරීම පැවරූ පසු, ඔබට Field KG පෙනෙනු ඇත — කර්මාන්ත ශාලාවේදී අමු දලු කිරන්නට පෙර ඔබේ වතුයාය මගින් වාර්තා කරන ලද බර. උදාහරණයක් ලෙස, Field KG: 73 KG.',
    'Enter the Factory KG' => 'Factory KG ඇතුළත් කරන්න',
    'Once the tea factory provides its official weight, enter it under Factory KG — for example, Field KG: 73 KG, Factory KG: 60 KG. Save the factory weight after entering it.' =>
        'තේ කර්මාන්ත ශාලාව එහි නිල බර ලබා දුන් පසු, එය Factory KG යටතේ ඇතුළත් කරන්න — උදාහරණයක් ලෙස, Field KG: 73 KG, Factory KG: 60 KG. ඇතුළත් කිරීමෙන් පසු කර්මාන්ත ශාලා බර සුරකින්න.',
    'Check the Weight Difference' => 'බර වෙනස පරීක්ෂා කරන්න',
    'Harvest Pro will automatically show the difference between the Field KG and Factory KG — for example, Field KG: 73 KG, Factory KG: 60 KG, Difference: 13 KG. This makes it easy to identify any weight difference between the estate and factory records.' =>
        'Harvest Pro Field KG සහ Factory KG අතර වෙනස ස්වයංක්‍රීයව පෙන්වයි — උදාහරණයක් ලෙස, Field KG: 73 KG, Factory KG: 60 KG, Difference: 13 KG. මෙය වතුයාය සහ කර්මාන්ත ශාලා වාර්තා අතර ඕනෑම බර වෙනසක් හඳුනාගැනීම පහසු කරයි.',
    'Add the Monthly Price' => 'මාසික මිල එකතු කරන්න',
    "Once the factory provides the green leaf price for the month, click the Monthly Prices tab. Select the relevant factory, month, and year, then enter the factory's price per KG and save it — for example, September: Rs. 271 per KG." =>
        'කර්මාන්ත ශාලාව එම මාසයේ අමු දලු මිල ලබා දුන් පසු, Monthly Prices tab එක ක්ලික් කරන්න. අදාළ කර්මාන්ත ශාලාව, මාසය සහ වර්ෂය තෝරා, කර්මාන්ත ශාලාවේ KG එකකට මිල ඇතුළත් කර සුරකින්න — උදාහරණයක් ලෙස, September: රු. 271 KG එකකට.',
    'Check the Delivery Value' => 'බෙදාහැරීමේ අගය පරීක්ෂා කරන්න',
    'Go back to the Deliveries tab. Harvest Pro will use the Factory KG and the applicable Monthly Price to calculate the value of the delivery — for example, Factory KG: 60 KG, Price: Rs. 271 per KG, Value: Rs. 16,260.' =>
        'Deliveries tab එකට ආපසු යන්න. Harvest Pro Factory KG සහ අදාළ Monthly Price භාවිතා කර බෙදාහැරීමේ අගය ගණනය කරයි — උදාහරණයක් ලෙස, Factory KG: 60 KG, Price: රු. 271 KG එකකට, Value: රු. 16,260.',
    'Add Factory Expenses' => 'කර්මාන්ත ශාලා වියදම් එකතු කරන්න',
    'Click the Expenses tab. Here you can record expenses or deductions related to the factory — enter the factory, date, category, amount (LKR), and an optional description or notes, then click Save Expense.' =>
        'Expenses tab එක ක්ලික් කරන්න. මෙහිදී ඔබට කර්මාන්ත ශාලාව සම්බන්ධ වියදම් හෝ අඩුකිරීම් වාර්තා කළ හැක — කර්මාන්ත ශාලාව, දිනය, කාණ්ඩය, මුදල (LKR), සහ අත්‍යවශ්‍ය නොවන විස්තරයක්/සටහනක් ඇතුළත් කර, Save Expense ක්ලික් කරන්න.',
    'Record Fertilizer or Other Deductions' => 'පොහොර හෝ වෙනත් අඩුකිරීම් වාර්තා කරන්න',
    'Sometimes the tea factory may provide fertilizer or other items/advances to your estate. For example, if you receive fertilizer from the factory and its cost will be deducted from your month-end payment, record that amount under Factory Expenses. This helps you keep track of the deductions that will affect your final factory payment.' =>
        'සමහර විට තේ කර්මාන්ත ශාලාව ඔබේ වතුයායට පොහොර හෝ වෙනත් උපකරණ/අත්තිකාරම් ලබා දිය හැක. උදාහරණයක් ලෙස, ඔබ කර්මාන්ත ශාලාවෙන් පොහොර ලබාගෙන එහි වියදම ඔබේ මාසාන්ත ගෙවීමෙන් අඩු කරන්නේ නම්, එම මුදල Factory Expenses යටතේ වාර්තා කරන්න. මෙය ඔබේ අවසාන කර්මාන්ත ශාලා ගෙවීමට බලපාන අඩුකිරීම් නිරීක්ෂණය කිරීමට උපකාර වේ.',
    'Go to Overview' => 'Overview වෙත යන්න',
    'Click the Overview tab to see a complete summary of your factory activity. You can filter the information by estate, factory, year, and month.' =>
        'ඔබේ කර්මාන්ත ශාලා ක්‍රියාකාරකම් පිළිබඳ සම්පූර්ණ සාරාංශයක් බැලීමට Overview tab එක ක්ලික් කරන්න. ඔබට වතුයාය, කර්මාන්ත ශාලාව, වර්ෂය සහ මාසය අනුව තොරතුරු පෙරහන් කළ හැක.',
    'Check Your Factory Summary' => 'ඔබේ කර්මාන්ත ශාලා සාරාංශය පරීක්ෂා කරන්න',
    'At the top of the Overview, you can see the Field Weight (total KG recorded by your estate), Factory Weight (total KG recorded by the factory), Unassigned KG (leaf that still needs to be assigned to a factory), Leaf Value (value calculated using the factory KG and monthly price), and Net (final value after applicable recorded deductions).' =>
        'Overview එකේ ඉහළින්, ඔබට Field Weight (ඔබේ වතුයාය මගින් වාර්තා කළ මුළු KG), Factory Weight (කර්මාන්ත ශාලාව මගින් වාර්තා කළ මුළු KG), Unassigned KG (තවම කර්මාන්ත ශාලාවකට පැවරිය යුතු දලු), Leaf Value (කර්මාන්ත ශාලා KG සහ මාසික මිල භාවිතයෙන් ගණනය කළ අගය), සහ Net (අදාළ අඩුකිරීම් වලින් පසු අවසාන අගය) දැක ගත හැක.',
    'Check the Profit Summary' => 'ලාභ සාරාංශය පරීක්ෂා කරන්න',
    'Under Profit Summary, you can see the Value, Expenses, Advances, and Net Profit — giving you a clear picture of the income generated from your green leaf and the deductions recorded against it.' =>
        'Profit Summary යටතේ, ඔබට Value, Expenses, Advances, සහ Net Profit දැක ගත හැක — මෙය ඔබේ අමු දලුවෙන් ලැබෙන ආදායම සහ ඊට එරෙහිව වාර්තා කළ අඩුකිරීම් පිළිබඳ පැහැදිලි චිත්‍රයක් ලබා දෙයි.',
    'Check Factory Performance' => 'කර්මාන්ත ශාලා කාර්යසාධනය පරීක්ෂා කරන්න',
    'The Factory Performance section helps you monitor the performance of each factory. You can see the KG supplied, number of deliveries, leaf type, and value for the selected period. This is especially useful if your estate supplies green leaf to multiple factories.' =>
        'Factory Performance කොටස එක් එක් කර්මාන්ත ශාලාවේ කාර්යසාධනය නිරීක්ෂණය කිරීමට උපකාර වේ. තෝරාගත් කාල සීමාව සඳහා සපයන ලද KG, බෙදාහැරීම් ගණන, දලු වර්ගය සහ අගය ඔබට දැක ගත හැක. ඔබේ වතුයාය කර්මාන්ත ශාලා කිහිපයකට අමු දලු සපයනවා නම් මෙය විශේෂයෙන් ප්‍රයෝජනවත් වේ.',
    'Check Recent Deliveries' => 'මෑත බෙදාහැරීම් පරීක්ෂා කරන්න',
    'Under Recent Deliveries, you can see the date, factory, leaf type, plucking KG, factory KG, difference, value, and status — helping you quickly review your latest factory deliveries and confirm that the information has been recorded correctly.' =>
        'Recent Deliveries යටතේ, ඔබට දිනය, කර්මාන්ත ශාලාව, දලු වර්ගය, plucking KG, factory KG, වෙනස, අගය සහ තත්ත්වය දැක ගත හැක — මෙය ඔබේ නවතම කර්මාන්ත ශාලා බෙදාහැරීම් ඉක්මනින් සමාලෝචනය කර තොරතුරු නිවැරදිව වාර්තා වී ඇති බව තහවුරු කර ගැනීමට උපකාර වේ.',
    'Once Factory Management is set up, your normal process will be: Record Daily Plucking → Assign Leaf to Factory → Enter Factory KG → Add Monthly Price → Check Delivery Value → Add Factory Expenses/Deductions → Check Overview & Net Profit.' =>
        'Factory Management සකසා ගත් පසු, ඔබේ සාමාන්‍ය ක්‍රියාවලිය මෙසේ වේ: Record Daily Plucking → Assign Leaf to Factory → Enter Factory KG → Add Monthly Price → Check Delivery Value → Add Factory Expenses/Deductions → Check Overview & Net Profit.',
    'Reminders & Calendar' => 'මතක් කිරීම් සහ දින දර්ශනය',
    'Full step-by-step instructions, screenshots and tips for this section will be added shortly.' =>
        'මෙම කොටස සඳහා පියවරෙන් පියවර උපදෙස්, තිර රූප සහ ඉඟි ඉක්මනින් එකතු කරනු ලැබේ.',
    'STEP %02d' => 'පියවර %02d',
    'Previous step' => 'පෙර පියවර',
    'Next step' => 'ඊළඟ පියවර',
    'Screenshot placeholder' => 'තිර රූපය මෙහි එකතු වේ',
    'Coming soon' => 'ඉක්මනින් එයි',
    'Previous' => 'පෙර',
    'Next:' => 'ඊළඟට:',
    'Back to Start' => 'ආරම්භයට ආපසු',
    'Explore All Steps' => 'සියලුම පියවර ගවේෂණය කරන්න',
    'From setup to daily operations, get familiar with everything Harvest Pro can do for your estate.' =>
        'සැකසීමේ සිට දෛනික මෙහෙයුම් දක්වා, Harvest Pro ට ඔබේ වතුයාය සඳහා කළ හැකි සියල්ල ගැන හුරු වන්න.',
    'Sign up and start your 14-day free trial.' => 'ලියාපදිංචි වී ඔබේ දින 14 නොමිලේ අත්හදා බැලීම ආරම්භ කරන්න.',
    'Ready to Manage Your Estate Smarter?' => 'ඔබේ වතුයාය වඩාත් දක්ෂ ලෙස කළමනාකරණය කිරීමට සූදානම්ද?',
    'Start your 14-day free trial and set up your estate today.' =>
        'අද දින ඔබේ දින 14 නොමිලේ අත්හදා බැලීම ආරම්භ කර ඔබේ වතුයාය සකසන්න.',
    'Start Free Trial' => 'නොමිලේ අත්හදා බැලීම ආරම්භ කරන්න',
    'Contact Support' => 'සහාය අමතන්න',

    // ---- YouTube tutorials popup ----------------------------------------
    'Close' => 'වසන්න',
    'Harvest Pro Tutorials' => 'Harvest Pro මාර්ගෝපදේශ',
    'Step-by-step guides for new users' => 'නව පරිශීලකයින් සඳහා පියවරෙන් පියවර මාර්ගෝපදේශ',
    'View All Tutorials on YouTube' => 'YouTube හි සියලුම මාර්ගෝපදේශ බලන්න',
    'How to Use Harvest Pro' => 'Harvest Pro භාවිතා කරන ආකාරය',
    'Step-by-step video tutorials' => 'පියවරෙන් පියවර වීඩියෝ මාර්ගෝපදේශ',
    'Welcome to Harvest Pro' => 'Harvest Pro වෙත සාදරයෙන් පිළිගනිමු',
    'Learn how to get started easily with our step-by-step video tutorials.' =>
        'අපගේ පියවරෙන් පියවර වීඩියෝ මාර්ගෝපදේශ සමඟ පහසුවෙන් ආරම්භ කරන්නේ කෙසේදැයි ඉගෙන ගන්න.',

    // ---- How It Works — Reminders & Calendar ---------------------------
    'Schedule and track important activities across your tea estate — from fertilizer applications and inspections to maintenance, purchasing, and meetings.' =>
        'ඔබේ තේ වතුයාය පුරා වැදගත් ක්‍රියාකාරකම් සැලසුම් කර නිරීක්ෂණය කරන්න — පොහොර යෙදීම් සහ පරීක්ෂණවල සිට නඩත්තු, මිලදී ගැනීම් සහ රැස්වීම් දක්වා.',
    'Schedule and track important estate activities.' => 'වැදගත් වතුයාය ක්‍රියාකාරකම් සැලසුම් කර නිරීක්ෂණය කරන්න.',
    'Go to Reminders & Calendar' => 'Reminders & Calendar වෙත යන්න',
    'From the left-side menu, click Reminders & Calendar. You will see a calendar where you can view your scheduled reminders and upcoming estate activities.' =>
        'වම් පස මෙනුවෙන් Reminders & Calendar ක්ලික් කරන්න. ඔබේ නියමිත මතක් කිරීම් සහ ඉදිරි වතුයාය ක්‍රියාකාරකම් බැලිය හැකි දින දර්ශනයක් ඔබට පෙනෙනු ඇත.',
    'Add a New Reminder' => 'නව මතක් කිරීමක් එකතු කරන්න',
    'Click the Add Reminder button at the top-right of the page. The Add Reminder form will appear.' =>
        'පිටුවේ ඉහළ දකුණේ ඇති Add Reminder බොත්තම ක්ලික් කරන්න. Add Reminder පෝරමය දිස්වනු ඇත.',
    'Enter the Event Title' => 'සිද්ධියේ මාතෘකාව ඇතුළත් කරන්න',
    'Enter a clear event title for the activity you want to remember — for example, Apply Fertilizer, Building Maintenance, Field Inspection, Purchase Estate Supplies, Equipment Service, or Worker Meeting.' =>
        'ඔබට මතක තබා ගැනීමට අවශ්‍ය ක්‍රියාකාරකම සඳහා පැහැදිලි මාතෘකාවක් ඇතුළත් කරන්න — උදාහරණයක් ලෙස, Apply Fertilizer, Building Maintenance, Field Inspection, Purchase Estate Supplies, Equipment Service, හෝ Worker Meeting.',
    'Enter a short description with more information about the task — for example, "Building Maintenance: Check and repair the estate office roof." This helps you understand exactly what needs to be done when you see the reminder later.' =>
        'කාර්යය පිළිබඳ වැඩිදුර තොරතුරු සහිත කෙටි විස්තරයක් ඇතුළත් කරන්න — උදාහරණයක් ලෙස, "Building Maintenance: Check and repair the estate office roof." මෙය පසුව ඔබ මතක් කිරීම දකින විට හරියටම කළ යුතු දේ තේරුම් ගැනීමට උපකාර වේ.',
    'Select the Start Date' => 'ආරම්භක දිනය තෝරන්න',
    'Choose the start date for the reminder — the date when the activity should take place or when you want the reminder to begin.' =>
        'මතක් කිරීම සඳහා ආරම්භක දිනය තෝරන්න — ක්‍රියාකාරකම සිදුවිය යුතු දිනය හෝ මතක් කිරීම ආරම්භ විය යුතු දිනය.',
    'Select the Related Estate' => 'අදාළ වතුයාය තෝරන්න',
    'Choose the estate related to the reminder. If you manage multiple estates in Harvest Pro, make sure you select the correct estate.' =>
        'මතක් කිරීම සම්බන්ධ වතුයාය තෝරන්න. ඔබ Harvest Pro හි වතුයායන් කිහිපයක් කළමනාකරණය කරන්නේ නම්, නිවැරදි වතුයාය තෝරාගෙන ඇති බව සහතික කරගන්න.',
    'Select the Plantation / Section' => 'වගාව / අංශය තෝරන්න',
    'Choose the specific plantation or section where the task needs to be completed — for example, Plantation A, Plantation B, Field 01, or Field 02. This makes it easier to manage reminders separately for different areas of your estate.' =>
        'කාර්යය සම්පූර්ණ කළ යුතු නිශ්චිත වගාව හෝ අංශය තෝරන්න — උදාහරණයක් ලෙස, Plantation A, Plantation B, Field 01, හෝ Field 02. මෙය ඔබේ වතුයායේ විවිධ ප්‍රදේශ සඳහා මතක් කිරීම් වෙන වෙනම කළමනාකරණය කිරීම පහසු කරයි.',
    'Select the Recurrence' => 'පුනරාවර්තනය තෝරන්න',
    'Choose how often the reminder should repeat: One-time, Daily, Weekly, Monthly, or Yearly. For example, if you need to carry out an estate inspection every month, select Monthly.' =>
        'මතක් කිරීම කොපමණ වාරයක් පුනරාවර්තනය විය යුතුදැයි තෝරන්න: One-time, Daily, Weekly, Monthly, හෝ Yearly. උදාහරණයක් ලෙස, ඔබට සෑම මසකම වතුයාය පරීක්ෂණයක් සිදු කිරීමට අවශ්‍ය නම්, Monthly තෝරන්න.',
    'Add the Event' => 'සිද්ධිය එකතු කරන්න',
    'Once all the information is correct, click Add Event.' => 'සියලුම තොරතුරු නිවැරදි වූ පසු, Add Event ක්ලික් කරන්න.',
    'View Your Reminders' => 'ඔබේ මතක් කිරීම් බලන්න',
    'Your scheduled activities will appear on the calendar according to their dates. You can also check the All Reminders section to keep track of your scheduled tasks and upcoming activities.' =>
        'ඔබේ නියමිත ක්‍රියාකාරකම් ඒවායේ දිනයන්ට අනුව දින දර්ශනයේ දිස්වනු ඇත. ඔබේ නියමිත කාර්යයන් සහ ඉදිරි ක්‍රියාකාරකම් නිරීක්ෂණය කිරීමට ඔබට All Reminders කොටසද පරීක්ෂා කළ හැක.',
    'Using Reminders & Calendar helps you keep important estate activities organized and reduces the chance of missing scheduled work or important dates.' =>
        'Reminders & Calendar භාවිතය වැදගත් වතුයාය ක්‍රියාකාරකම් සංවිධානාත්මකව තබා ගැනීමට උපකාර වන අතර, නියමිත වැඩ හෝ වැදගත් දින මග හැරීමේ ඉඩකඩ අඩු කරයි.',

];
