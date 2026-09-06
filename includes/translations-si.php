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
    'Features' => 'විශේෂාංග',
    'Contact Us' => 'අප අමතන්න',
    'Search' => 'සොයන්න',
    'Call' => 'අමතන්න',
    'Toggle navigation' => 'මෙනුව විවෘත කරන්න',

    // ---- Footer ---------------------------------------------------------
    'Link' => 'සබැඳි',
    'Contact' => 'සම්බන්ධතා',
    'Subscribe' => 'දායක වන්න',
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
    'Centralized|plantation management
Real-time|operational insights
Reduced|manual work
Improved|workforce accountability
Faster|decision-making' =>
        'කේන්ද්‍රීයගත|වතු කළමනාකරණය
තථ්‍ය කාලීන|මෙහෙයුම් තීක්ෂණතා
අඩු කළ|අතින් කරන කටයුතු
වැඩිදියුණු කළ|කම්කරු වගවීම
වේගවත්|තීරණ ගැනීම',
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

];
