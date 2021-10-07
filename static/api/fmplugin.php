<?php
//Default Configuration
$CONFIG = '{"lang":"en","error_reporting":false,"show_hidden":false,"hide_Cols":false,"calc_folder":false,"theme":"light"}';

define('VERSION', '0.2.1');

//Application Title
define('APP_TITLE', '🅺🅾🅼🅸🆂🅸 🅸🅽🅵🅾🆁🅼🅰🆂🅸 🆂🆄🅼🅰🆃🅴🆁🅰 🅱🅰🆁🅰🆃');

// --- EDIT BELOW CONFIGURATION CAREFULLY ---

// Auth with login/password
// set true/false to enable/disable it
// Is independent from IP white- and blacklisting
$use_auth = true;

// Login user name and password
// Users: array('Username' => 'Password', 'Username2' => 'Password2', ...)
// Generate secure password hash - https://tinyfilemanager.github.io/docs/pwd.html
$auth_users = array(
    'trojan01' => '$2y$10$u32M0hc3AI6c47YtwuT9QeDKrgq9TRCPhJQkFyz1TFNAC/wWZpbz6',
    'user' => '$2y$10$q2/JF3IRcfmgkkMmtiiOcuZlTYeRXlQn.AJntZlMd8eUIyz7Gh3YC'
);

// Readonly users
// e.g. array('users', 'guest', ...)
$readonly_users = array(
    'user'
);

// Enable highlight.js (https://highlightjs.org/) on view's page
$use_highlightjs = true;

// highlight.js style
// for dark theme use 'ir-black'
$highlightjs_style = 'vs';

// Enable ace.js (https://ace.c9.io/) on view's page
$edit_files = true;

// Default timezone for date() and time()
// Doc - http://php.net/manual/en/timezones.php
$default_timezone = 'Etc/UTC'; // UTC

// Root path for file manager
// use absolute path of directory i.e: '/var/www/folder' or $_SERVER['DOCUMENT_ROOT'].'/folder'
$root_path = $_SERVER['DOCUMENT_ROOT'];

// Root url for links in file manager.Relative to $http_host. Variants: '', 'path/to/subfolder'
// Will not working if $root_path will be outside of server document root
$root_url = '';

// Server hostname. Can set manually if wrong
$http_host = $_SERVER['HTTP_HOST'];

// user specific directories
// array('Username' => 'Directory path', 'Username2' => 'Directory path', ...)
$directories_users = array();

// input encoding for iconv
$iconv_input_encoding = 'UTF-8';

// date() format for file modification date
// Doc - https://www.php.net/manual/en/function.date.php
$datetime_format = 'd.m.y H:i';

// Allowed file extensions for create and rename files
// e.g. 'txt,html,css,js'
$allowed_file_extensions = '';

// Allowed file extensions for upload files
// e.g. 'gif,png,jpg,html,txt'
$allowed_upload_extensions = '';

// Favicon path. This can be either a full url to an .PNG image, or a path based on the document root.
// full path, e.g http://example.com/favicon.png
// local path, e.g images/icons/favicon.png
$favicon_path = '';

// Files and folders to excluded from listing
// e.g. array('myfile.html', 'personal-folder', '*.php', ...)
$exclude_items = array();

// Online office Docs Viewer
// Availabe rules are 'google', 'microsoft' or false
// google => View documents using Google Docs Viewer
// microsoft => View documents using Microsoft Web Apps Viewer
// false => disable online doc viewer
$online_viewer = 'google';

// Sticky Nav bar
// true => enable sticky header
// false => disable sticky header
$sticky_navbar = true;

// Maximum file upload size
// Increase the following values in php.ini to work properly
// memory_limit, upload_max_filesize, post_max_size
$max_upload_size_bytes = 5000;

// Possible rules are 'OFF', 'AND' or 'OR'
// OFF => Don't check connection IP, defaults to OFF
// AND => Connection must be on the whitelist, and not on the blacklist
// OR => Connection must be on the whitelist, or not on the blacklist
$ip_ruleset = 'OFF';

// Should users be notified of their block?
$ip_silent = true;

// IP-addresses, both ipv4 and ipv6
$ip_whitelist = array(
    '127.0.0.1',    // local ipv4
    '::1'           // local ipv6
);

// IP-addresses, both ipv4 and ipv6
$ip_blacklist = array(
    '0.0.0.0',      // non-routable meta ipv4
    '::'            // non-routable meta ipv6
);

// if User has the customized config file, try to use it to override the default config above
$config_file = __DIR__.'/config.php';
if (is_readable($config_file)) {
    @include($config_file);
}

// --- EDIT BELOW CAREFULLY OR DO NOT EDIT AT ALL ---

// max upload file size
define('MAX_UPLOAD_SIZE', $max_upload_size_bytes);

// private key and session name to store to the session
if ( !defined( 'FM_SESSION_ID')) {
    define('FM_SESSION_ID', 'filemanager');
}

// Configuration
$cfg = new FM_Config();

// Default language
$lang = isset($cfg->data['lang']) ? $cfg->data['lang'] : 'en';

// Show or hide files and folders that starts with a dot
$show_hidden_files = isset($cfg->data['show_hidden']) ? $cfg->data['show_hidden'] : true;

// PHP error reporting - false = Turns off Errors, true = Turns on Errors
$report_errors = isset($cfg->data['error_reporting']) ? $cfg->data['error_reporting'] : true;

// Hide Permissions and Owner cols in file-listing
$hide_Cols = isset($cfg->data['hide_Cols']) ? $cfg->data['hide_Cols'] : true;

// Show directory size: true or speedup output: false
$calc_folder = isset($cfg->data['calc_folder']) ? $cfg->data['calc_folder'] : true;

// Theme
$theme = isset($cfg->data['theme']) ? $cfg->data['theme'] : 'light';

define('FM_THEME', $theme);

//available languages
$lang_list = array(
    'en' => 'English'
);

if ($report_errors == true) {
    @ini_set('error_reporting', E_ALL);
    @ini_set('display_errors', 1);
} else {
    @ini_set('error_reporting', E_ALL);
    @ini_set('display_errors', 0);
}

// if fm included
if (defined('FM_EMBED')) {
    $use_auth = false;
    $sticky_navbar = false;
} else {
    @set_time_limit(600);

    date_default_timezone_set($default_timezone);

    ini_set('default_charset', 'UTF-8');
    if (version_compare(PHP_VERSION, '5.6.0', '<') && function_exists('mb_internal_encoding')) {
        mb_internal_encoding('UTF-8');
    }
    if (function_exists('mb_regex_encoding')) {
        mb_regex_encoding('UTF-8');
    }

    session_cache_limiter('');
    session_name(FM_SESSION_ID );
    function session_error_handling_function($code, $msg, $file, $line) {
        // Permission denied for default session, try to create a new one
        if ($code == 2) {
            session_abort();
            session_id(session_create_id());
            @session_start();
        }
    }
    set_error_handler('session_error_handling_function');
    session_start();
    restore_error_handler();
}

if (empty($auth_users)) {
    $use_auth = false;
}

$is_https = isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1)
    || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https';

// update $root_url based on user specific directories
if (isset($_SESSION[FM_SESSION_ID]['logged']) && !empty($directories_users[$_SESSION[FM_SESSION_ID]['logged']])) {
    $wd = fm_clean_path(dirname($_SERVER['PHP_SELF']));
    $root_url =  $root_url.$wd.DIRECTORY_SEPARATOR.$directories_users[$_SESSION[FM_SESSION_ID]['logged']];
}
// clean $root_url
$root_url = fm_clean_path($root_url);

// abs path for site
defined('FM_ROOT_URL') || define('FM_ROOT_URL', ($is_https ? 'https' : 'http') . '://' . $http_host . (!empty($root_url) ? '/' . $root_url : ''));
defined('FM_SELF_URL') || define('FM_SELF_URL', ($is_https ? 'https' : 'http') . '://' . $http_host . $_SERVER['PHP_SELF']);

// logout
if (isset($_GET['logout'])) {
    unset($_SESSION[FM_SESSION_ID]['logged']);
    fm_redirect(FM_SELF_URL);
}

// Validate connection IP
if($ip_ruleset != 'OFF'){
    $clientIp = $_SERVER['REMOTE_ADDR'];

    $proceed = false;

    $whitelisted = in_array($clientIp, $ip_whitelist);
    $blacklisted = in_array($clientIp, $ip_blacklist);

    if($ip_ruleset == 'AND'){
        if($whitelisted == true && $blacklisted == false){
            $proceed = true;
        }
    } else
    if($ip_ruleset == 'OR'){
         if($whitelisted == true || $blacklisted == false){
            $proceed = true;
        }
    }

    if($proceed == false){
        trigger_error('User connection denied from: ' . $clientIp, E_USER_WARNING);

        if($ip_silent == false){
            fm_set_msg(lng('Access denied. IP restriction applicable'), 'error');
            fm_show_header_login();
            fm_show_message();
        }

        exit();
    }
}

// Auth
if ($use_auth) {
    if (isset($_SESSION[FM_SESSION_ID]['logged'], $auth_users[$_SESSION[FM_SESSION_ID]['logged']])) {
        // Logged
    } elseif (isset($_POST['fm_usr'], $_POST['fm_pwd'])) {
        // Logging In
        sleep(1);
        if(function_exists('password_verify')) {
            if (isset($auth_users[$_POST['fm_usr']]) && isset($_POST['fm_pwd']) && password_verify($_POST['fm_pwd'], $auth_users[$_POST['fm_usr']])) {
                $_SESSION[FM_SESSION_ID]['logged'] = $_POST['fm_usr'];
                fm_set_msg(lng('You are logged in'));
                fm_redirect(FM_SELF_URL . '?p=');
            } else {
                unset($_SESSION[FM_SESSION_ID]['logged']);
                fm_set_msg(lng('Login failed. Invalid username or password'), 'error');
                fm_redirect(FM_SELF_URL);
            }
        } else {
            fm_set_msg(lng('password_hash not supported, Upgrade PHP version'), 'error');;
        }
    } else {
        // Form
        unset($_SESSION[FM_SESSION_ID]['logged']);
        fm_show_header_login();
        ?>
        <section class="h-100">
            <div class="container h-100">
                <div class="row justify-content-md-center h-100">
                    <div class="card-wrapper">
                        <div class="card fat <?php echo fm_get_theme(); ?>">
                            <div class="card-body">
                                <form class="form-signin" action="" method="post" autocomplete="off">
                                    <div class="form-group">
                                       <div class="brand">
                                            <svg width="120" height="130" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
											 <g>
											  <image stroke="null" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABLYAAAFNCAYAAAAdC+boAAAKN2lDQ1BzUkdCIElFQzYxOTY2LTIuMQAAeJydlndUU9kWh8+9N71QkhCKlNBraFICSA29SJEuKjEJEErAkAAiNkRUcERRkaYIMijggKNDkbEiioUBUbHrBBlE1HFwFBuWSWStGd+8ee/Nm98f935rn73P3Wfvfda6AJD8gwXCTFgJgAyhWBTh58WIjYtnYAcBDPAAA2wA4HCzs0IW+EYCmQJ82IxsmRP4F726DiD5+yrTP4zBAP+flLlZIjEAUJiM5/L42VwZF8k4PVecJbdPyZi2NE3OMErOIlmCMlaTc/IsW3z2mWUPOfMyhDwZy3PO4mXw5Nwn4405Er6MkWAZF+cI+LkyviZjg3RJhkDGb+SxGXxONgAoktwu5nNTZGwtY5IoMoIt43kA4EjJX/DSL1jMzxPLD8XOzFouEiSniBkmXFOGjZMTi+HPz03ni8XMMA43jSPiMdiZGVkc4XIAZs/8WRR5bRmyIjvYODk4MG0tbb4o1H9d/JuS93aWXoR/7hlEH/jD9ld+mQ0AsKZltdn6h21pFQBd6wFQu/2HzWAvAIqyvnUOfXEeunxeUsTiLGcrq9zcXEsBn2spL+jv+p8Of0NffM9Svt3v5WF485M4knQxQ143bmZ6pkTEyM7icPkM5p+H+B8H/nUeFhH8JL6IL5RFRMumTCBMlrVbyBOIBZlChkD4n5r4D8P+pNm5lona+BHQllgCpSEaQH4eACgqESAJe2Qr0O99C8ZHA/nNi9GZmJ37z4L+fVe4TP7IFiR/jmNHRDK4ElHO7Jr8WgI0IABFQAPqQBvoAxPABLbAEbgAD+ADAkEoiARxYDHgghSQAUQgFxSAtaAYlIKtYCeoBnWgETSDNnAYdIFj4DQ4By6By2AE3AFSMA6egCnwCsxAEISFyBAVUod0IEPIHLKFWJAb5AMFQxFQHJQIJUNCSAIVQOugUqgcqobqoWboW+godBq6AA1Dt6BRaBL6FXoHIzAJpsFasBFsBbNgTzgIjoQXwcnwMjgfLoK3wJVwA3wQ7oRPw5fgEVgKP4GnEYAQETqiizARFsJGQpF4JAkRIauQEqQCaUDakB6kH7mKSJGnyFsUBkVFMVBMlAvKHxWF4qKWoVahNqOqUQdQnag+1FXUKGoK9RFNRmuizdHO6AB0LDoZnYsuRlegm9Ad6LPoEfQ4+hUGg6FjjDGOGH9MHCYVswKzGbMb0445hRnGjGGmsVisOtYc64oNxXKwYmwxtgp7EHsSewU7jn2DI+J0cLY4X1w8TogrxFXgWnAncFdwE7gZvBLeEO+MD8Xz8MvxZfhGfA9+CD+OnyEoE4wJroRIQiphLaGS0EY4S7hLeEEkEvWITsRwooC4hlhJPEQ8TxwlviVRSGYkNimBJCFtIe0nnSLdIr0gk8lGZA9yPFlM3kJuJp8h3ye/UaAqWCoEKPAUVivUKHQqXFF4pohXNFT0VFysmK9YoXhEcUjxqRJeyUiJrcRRWqVUo3RU6YbStDJV2UY5VDlDebNyi/IF5UcULMWI4kPhUYoo+yhnKGNUhKpPZVO51HXURupZ6jgNQzOmBdBSaaW0b2iDtCkVioqdSrRKnkqNynEVKR2hG9ED6On0Mvph+nX6O1UtVU9Vvuom1TbVK6qv1eaoeajx1UrU2tVG1N6pM9R91NPUt6l3qd/TQGmYaYRr5Grs0Tir8XQObY7LHO6ckjmH59zWhDXNNCM0V2ju0xzQnNbS1vLTytKq0jqj9VSbru2hnaq9Q/uE9qQOVcdNR6CzQ+ekzmOGCsOTkc6oZPQxpnQ1df11Jbr1uoO6M3rGelF6hXrtevf0Cfos/ST9Hfq9+lMGOgYhBgUGrQa3DfGGLMMUw12G/YavjYyNYow2GHUZPTJWMw4wzjduNb5rQjZxN1lm0mByzRRjyjJNM91tetkMNrM3SzGrMRsyh80dzAXmu82HLdAWThZCiwaLG0wS05OZw2xljlrSLYMtCy27LJ9ZGVjFW22z6rf6aG1vnW7daH3HhmITaFNo02Pzq62ZLde2xvbaXPJc37mr53bPfW5nbse322N3055qH2K/wb7X/oODo4PIoc1h0tHAMdGx1vEGi8YKY21mnXdCO3k5rXY65vTW2cFZ7HzY+RcXpkuaS4vLo3nG8/jzGueNueq5clzrXaVuDLdEt71uUnddd457g/sDD30PnkeTx4SnqWeq50HPZ17WXiKvDq/XbGf2SvYpb8Tbz7vEe9CH4hPlU+1z31fPN9m31XfKz95vhd8pf7R/kP82/xsBWgHcgOaAqUDHwJWBfUGkoAVB1UEPgs2CRcE9IXBIYMj2kLvzDecL53eFgtCA0O2h98KMw5aFfR+OCQ8Lrwl/GGETURDRv4C6YMmClgWvIr0iyyLvRJlESaJ6oxWjE6Kbo1/HeMeUx0hjrWJXxl6K04gTxHXHY+Oj45vipxf6LNy5cDzBPqE44foi40V5iy4s1licvvj4EsUlnCVHEtGJMYktie85oZwGzvTSgKW1S6e4bO4u7hOeB28Hb5Lvyi/nTyS5JpUnPUp2Td6ePJninlKR8lTAFlQLnqf6p9alvk4LTduf9ik9Jr09A5eRmHFUSBGmCfsytTPzMoezzLOKs6TLnJftXDYlChI1ZUPZi7K7xTTZz9SAxESyXjKa45ZTk/MmNzr3SJ5ynjBvYLnZ8k3LJ/J9879egVrBXdFboFuwtmB0pefK+lXQqqWrelfrry5aPb7Gb82BtYS1aWt/KLQuLC98uS5mXU+RVtGaorH1futbixWKRcU3NrhsqNuI2ijYOLhp7qaqTR9LeCUXS61LK0rfb+ZuvviVzVeVX33akrRlsMyhbM9WzFbh1uvb3LcdKFcuzy8f2x6yvXMHY0fJjpc7l+y8UGFXUbeLsEuyS1oZXNldZVC1tep9dUr1SI1XTXutZu2m2te7ebuv7PHY01anVVda926vYO/Ner/6zgajhop9mH05+x42Rjf2f836urlJo6m06cN+4X7pgYgDfc2Ozc0tmi1lrXCrpHXyYMLBy994f9Pdxmyrb6e3lx4ChySHHn+b+O31w0GHe4+wjrR9Z/hdbQe1o6QT6lzeOdWV0iXtjusePhp4tLfHpafje8vv9x/TPVZzXOV42QnCiaITn07mn5w+lXXq6enk02O9S3rvnIk9c60vvG/wbNDZ8+d8z53p9+w/ed71/LELzheOXmRd7LrkcKlzwH6g4wf7HzoGHQY7hxyHui87Xe4Znjd84or7ldNXva+euxZw7dLI/JHh61HXb95IuCG9ybv56Fb6ree3c27P3FlzF3235J7SvYr7mvcbfjT9sV3qID0+6j068GDBgztj3LEnP2X/9H686CH5YcWEzkTzI9tHxyZ9Jy8/Xvh4/EnWk5mnxT8r/1z7zOTZd794/DIwFTs1/lz0/NOvm1+ov9j/0u5l73TY9P1XGa9mXpe8UX9z4C3rbf+7mHcTM7nvse8rP5h+6PkY9PHup4xPn34D94Tz+49wZioAAAAJcEhZcwAALiMAAC4jAXilP3YAACAASURBVHic7N0HmBRltjfwf1V1zj25J2cmwgBDThIkCEgSh2DYVdd18/rtvXtX3Xv5+BZl81531evuuvGuKGZEVCSD5DwESQMTmJxTz3Sq+uqtZnqmGVCRQRw4Px26663Y1dX1PHWe855XJUkSCCGEEEIIIYQQQgjpb1Q3+wAIIYQQQgghhBBCCPkiKLBFCCGEEEIIIYQQQvolCmwRQgghhBBCCCGEkH6JAluEEEIIIYQQQgghpF+iwBYhhBBCCCGEEEII6Ze+lMDWyqW2H0mQ9j75cvPHX8b+CCE338ollskShJQnVzX+6WYfCyGEEEIIIYSQW9MND2ytXGq7D+B+Kfm4aTd6X4SQrw5JEkI4Hs8/vdhW8dQrTe/d7OMhhBBCCCGEEHLruaGBrZWLLTlGs/5Fg0HDl9e2XLyR+yKEfMVwUrnValCpVPw/li8xDF22yll8sw+JEEIIIYQQQsit5YYFtn4wk9dGh1j/OXlSunHP3jJ0OFvLb9S+CCFfPR64K7xeHaZNzQh5660jfyso4KesXi36bvZxEUIIIYQQQgi5ddywwFaU1frjnOzowbEJDrg+vtiuX4P2G7UvQshXT3tDZ61JZ0FIWBjy8xPu8OyVvik3v3Czj4sQQgghhBBCyK3jhgS2li+0J4eGan8yfFg8eH04XG5P43JAWnYjdkYI+UoyfoQOz1KPU9KGGgYNbMe5otoVK5da3nzi5Zbqm31shBBCCCGEEEJuDTcksKXWSCtGDE8wqNUCJI0dXre7SRRF6UbsixDy1cSC2U+LYrNPMBvUPIdRIxPta9ce/0951ndv9rERQgghhBBCCLk19Hlga2WBOS8iynZvakqYv4EFtjyelr7eDyHkq40Fs1cutbd4OZNDzXGIjbEhLj7kkeUL7b9d9nrj+Zt9fIQQQgghhBBC+r8+D2xJKuHHQ4bECpz8IMtrjPCJPGul+lqE3I4ktHt9knwvsEB0NWPo4FhtWVnDj+Q537nZh0YIIYQQQgghpP/r08DWM/cYE+wR1nuSEkOUaV4XApfHI7/jOvtyP4SQfoJDh1e+B/DGECWw5XBYEBVpfXD5UuuyZS83193swyOEEEIIIYQQ0r/1aWCL06gfzsqKUrNsLYbX2uDz+Nhbd1/uhxDSb7hFn0+5F3TJzoo0VlU13y+//d3NOyxCCCGEEEIIIbeCPgtsFRTwwlCt7f60tLBAG6+1QnL5IEmSt6/2QwjpTySvKIrKvaBLUlIotFr113ie/28aVIIQQgghhBBCyPXos8BWLizDo6NtiQa9JtDGa8yQ0NRXuyCE9DOSBPaffC8wASyTU25go6UmJIQMXLbQnSkvcvJmHyMhhBBCCCGEkP6rzwJbvAp3d9XWYji5gVPpwLolsv/7aj+EkP5D+e2zfwSNfE/QQPK5lHZ2rzh9tuZuUGCLEEIIIYQQQsh16LvAFrhp8XHddXQ4tV55quV5Nioi1+ejLxJC+gNO5b8HsHuCIRDYiomxQiVw0+S3P7+JB0cIIYQQQgghpJ/rk4DTUwtsoY5wXY7ZrAu0cSq98iqolF1o+2I/hJB+R3vpHuAPdnc2+hu1KoSGGoctn8Mblq0RnTfzAAkhhBBCCCGE9F99Etgy6bghUZEWdc+2rsCWSq1mJXb0fbEfQkj/wn77KrX/NsPL9wRfj3mREWZjZbUlV36796YcHCGEEEIIIYSQfq9PAluSJA0KDTEEtbGaOoxarWbdEc19sR9CSP/CQTJptJcyOQVN0LywUCPrwjwIFNgihBBCCCGEEPIF9Ulgi+O4TLv9ssAW73+I5QWBBbcsfbEfQkj/wfM8t2KR1azV+Xsid90Tuij3DA6ZN+PYCCGEEEIIIYTcGvqqqHuS2XJZGS3ev2lWX0et1oSwh1xRFKU+2h8h5CtuGeuRrBLsam1XYCv4dmO26NhwqUk349gIIYQQQgghhNwa+iqwFW00BGdjcLzgf+U46IyGkGV3gDV4+2h/hJCvurmwqLXaQPF4cELQbK1GgEYjRN+EIyOEEEIIIYQQcou47sDWM0uMcSqVJlwQ+MvmcIF3BrNZ0DhMofLb6uvdHyGkn9BaIvQmI+uS6J/muKDZPM9BpeKilxeYo5atbq26CUdICCGEEEIIIaSf+8KBreUFvEatsv7Cbrd+R55UV1e3IjbWdsVlTRYLJEmIAwW2CLltqHgx1mSxXnV+Q2MHDHptjNmkv7Byie1XR3wty1evFn1XXYEQQgghhBBCCLnMFwpsPTaMVyekW1/LzXHMGTUyCVs/vojeGVvd5bQsdrv8r8gCWwe++KESQvoTDnycxd4z2B1cYo/nOIRERGDSuGjdwUNl/ykdKI1fzvMPLRNF8cs9UkIIIYQQQggh/dUXCmzFp1ufGJAeMWfsmGTwWgs4bTs47rJnUal72hoSIj/kcolf/DAJIf2OhET22++eDr5HsJ6JnHz/EAwhyB8KeDy+Bw9LSvD7uS/3QAkhhBBCCCGE9FfXHNhavsSQGGK2PMGCWsoGzHHghCpIlz20Sj16FNnCw1j6Rup1Hiu5Da1cbPt3t9jy7LLVovtmHwu5NhzHpdrCwrobLutlyAZJ5XlBuYe4OxowfFg8SssaVzxVYF399Orm2i/5cAkhhBBCCCGE9EPXHNjSQPNvg/NidRqNf4QzwRQFlUoNny847iCJnsD7kPBw9pCbeZ3HSm4zPM9zK5fYHtSIxg3y5JGbfTzkWkkZoRGR3VM97gmMzydCpdZCJd9D3DWFSnfm/KFx1oaPTn1Pnv1fX/LBEkIIIYQQQgjph64psPXj6bwx0hG6JGNAuDLNCVrwGgs0Wg3cnpbghXsEukxWK3R6Y+Zynuepfg75vJYttNrBYQBUwjhQYKtfYYNL6DT2dHtEeKBNuiz47fb45HuHFpzaIP/pIXmcSEoMhcms+/pjw/ifvbj/skgYIYQQQgghhBBymWsKbFlDLJMTE+12lcqfrcVrrUqhHK3eAJfLG7Ss5HMFTYfHREc0z2+Klt9evL5DJrcLlQrD5WtN5XJJuTf7WMg1UpmTbWFhFha46nL5PYHdM7QGA5Qy81obfB4neJ5DclJobHNrx0h5xo4v96AJIYQQQgghhPQ31xTY4oGpCfHdxaA5jUl5NZiMaGsKTq4QvZ1B0xExMXzJ6dNDQYEt8jnxkOZmZ0Xh8JGL6Tf7WMi10YDLj4yNCWqTLrsndHR4YIj030N4+V7SVYErPt6OwmPl00CBLUIIIYQQQgghn+GaAlscz49xRFkC07xKp7waLRbUOC+rseVxBk1HJybIK3AsC2PNFzxWchtZudQSqdVqF+fkOFB4rCLms9cgXzGjHAkJQQ2X3xPa290IsfjvJ9ylewkTGWGGSuDH3PhDJIQQQgghhBDS333uwNYPZvLa1NiITKNR090o+N9b7Ha0tgV3M2LdjiTRC47374I95HIcP7oPjpncAMtn8hbYzJplLzfX3exjYUXjn15k+e3QIXEWo0ENQeCsN/uYyLWRwI2KTkjs0SBC9HYELdMm3zPYvYPhhO77ChuYwmo15LHrQGRDJxJCCCGEEEIIIVfxuQNbERZzst2m1/Zs4zheebXY7GhtDc7YYg+yktcJTuPPyDBZLLCHhg3/UQGv/81qMfgJl9xUywuM8fpQ+xter/iSPPmnm3osPM8/vciyIikpbMnAXAdY/SWOFXK7ZOUS23Nw+55+4o3Wypt4mORTPDnbbg+L1A8MczgCbUo3RDG4Dl9rmxtmm80/cele0sVm01tXLDSwmnzlN/p4CSGEEEIIIYT0X5+/K6LEJVmt+ivO0puM8Ph4sOQKVvy5i+hqUUZNZDiOQ1xaiq6xtoplbW26rqMmfebpAtsAk8G4ITTUEHexovFHN+s4lk/iVaoo01jNEtuyrIzIO8aOSVKuGY/HB69PbGDLrFhqHqzi1Q+4BM8vb9Zxks9mtIgTohMSBJW6+/Yiult6Lef28tApxePBUryCWMxaTuSFRFBgixBCCCGEEELIp/jcgS1ekKKDuiECSldDhgUgzCGhaGnpZJkWgfmiqxkwxwamE9LScHT37imgwNZXwvIlpmiDTrd+1pxhcUcPnREFt3juisvN5C1qi3kix3PD5G+b9Sk1c0ooQnRJEtcuSWjjOKlVAtcG9h5SG2tnryIndnAS3ymKnH90AR48D1Evb8ssiojgOSTI73NtKeGj4uNsjqysKKXGUpf6Bid8PvEYey9AtVyl4rUNdR31X8b5IV8ML3FT4uXfek/KvaAHp9MNgzVEuXcopOBsLnavEXieaqsRQgghhBBCCPlUnzuwJYEP0+vVwY2+7pEQIxzRqK+vCwpsOZtqoQnrXjxhwAAIguounuefpNo5Xx5Wq2jZfEOMoFY7fCIal7/eXMTOvwbq58aNTU1wRIdgz06Pp6SkPai+1tMLbWmchnsiIjHq3uSkUCMbOMAWYoZGywKcHESfDz6vF26359KfT/7zKllWHvm9xyvC65WX8UlKNh/7jwMPQSUodZT0eg1MJi3sdiMsVgM4XoDE6jBJ3ZfG0cJyeV1x1dOLbHdFR1tn1dS1lv76IzgpZeuriXUl1Sy2zkjKzAhqdzbXBd1sGhqcCI+ODkxLvuCuzDr5XiNfBWEghBBCCCGEEEI+xTWMiihZtZrgxUVfZ+B9RFwsak6VICWl+1m0saoMWkc79EajMq3T6xGTlJj9s4XORHnywvUcOPn8frbIeqdGzb8aFR1h1+tV0i903LpnCkyPaQ26mRmDsiB5W1jwyPviflGJVBYU8MIgwfofoRHG/xw5MlGXnJUJtTUegj4UnKCFv+QV+5MuBaEk+UVS6qoF/i7HC0odJRbYUlb1/6Nk/fmcdfC1Vch/lUFBrZOfVON8Ud0HHOfdr9Xqd+VkR3EbN7ccpqDoV5ew0JRtDQlJCouKCrSx4Gd1yQXEOAyBttq6NkSmDgpMKzW4emCBT/kKoUEDCCGEEEIIIYR8qmupsWVQq4XgJnd74L0jLh7Htn0QNN9u06HoxHHkDB8RaEvLyRVKz5ybJ7/97Rc7ZHItWLF+tRu7zTD/e1tLy0tzH3iEqy4rmbXm1ffWW0w6jcYUBm9LB7QalWZ5AW9CLbx5Duu/MjMjF4yfPAzGmMHgtbarbJ1DV113/4vk757qE+VXDySW0cdeJR+LgvoHFFB6MHrl5nale5rY2czSdYK2yuJWZ87W+j7eWXRa3vBxk9G0f9LE9MjKyhYW96JurF9hvMDPT83J4Xq2lZw9C4spuDh8dXUrsifFB6YljzNovkolsGCpAYQQQgghhBBCyKf43IEtDpJGEIKeVyF62gLvQyIj0OqU4PWK8kOp/yGWBcLqy84CPQNbA3Oxde3aRaDA1g2zcqklUq3RPAgJD2THxKVptBquw9nZ2tbmajiy9YOQ4bOW4u57PZl7tuxiqU+8JiwLDscpdXGxZQ6iMHvI4NgFY2dMhyY0Az0GJAxg3QV9nY2QWGDK3a4EJSRfJ0SWdcOCVNL1JVRt2HQaTU0dXEyMLTExIeTf09PCletq0+YzrR5OfPW6Nk5uGNbl9enF1kUD8gYFtZefPYkhA3SBaRa4bOvgYAvrzu4U3a1B6wi8EjQNLupHCCGEEEIIIYRc5vNnbHGsznNwkIMFOCSfS+meJj/UIjIuQcnEiInp7kEkdTagtakJZps/64e9xqWk5K9Yasn+6cstJ/rmY5Bgwr/zHDdVpeLTjUatOm/4QMSlZ4T4JA3cDWfhqtyPhNwxvE3fCWfdeVjTpiJv1HDU17f/TaXmVWOm3wlNWGavrbLgg7vqMLzOul7xrrq6dpw9V4uBudG4fJCBz8KpdOB1dnmbPCRJxNS5iVBp9Tznbjb4OupQW92ITVvOiG3tnY8LPj7hmaX2x558uXHF9Zwh0vf+3yLLcHt4eIYjISHQ5nG70dFwUX4XF2hraHQiNDouUDieZfexDL7LcV39VQkhhBBCCCGEkKu4hhpb6F3YSJKUrmSCMUKZTBwwAGVFe4ICWw6HCWePH8eQsWMDbbkjRnDFZ848Ir99/AsfObmqJ15u/Df2+pN5vLm9zT3zwoXNPx85oih+SH46Z4zOR2vJHggNZ2GOy0f1qa3Qle+BITIXU6ZUKKMDaELSem3TWVeMHe+9g5LiWmjUAubPGwhB6O5eZrfrERpiwAcffoIF8wcpgS+OV0MbPUzpkuhtvqDU0mK1uHw+UelqFsD5t8MJOpYZCKGzAe7aC6ioaFLqbBVfaDjj9YmPQ4BGpcZ7Pp/0jRt6AskXwoP7Rs6wYegZAC8+fRphodqg5crKmpAwoDuLU3K19KrLdql02xWKtRFCCCGEEEIIId2upcZWeFOTE9EOS1Czr7MhENhKyhiAw1s/xMjuZ1ZERpixaWdwYCstNwdmi+WBn8zj/+vnb4vBfZBIn1heYA8xG8wL5Lfj5S+v5eSZZlfOYEEnVR6AxhqLmpITiEgADCGxaKi5CGtHvT+acHlWnuhB44WDeHf1+0hOCsOiewcHBbS6sLa0tAjsO1CqBK9YcIOt6649CX3CBKgssXBV7Ed18Wns3VeKqXcOCHRZZV0Zfezv0raamjrw/ocnRafTU+Px+PZBlD7mBO5xnVY92eX27fWubn4fr9zgE0iuyfKl1jC9SlOQM2J4UPuZwkLkZwTXgC+72IS86QMC076Ohl7bY8XlJQ4RN+ZoCSGEEEIIIYTcKj5XYOuZpdYFjtioBefO1SErMyponuisBVgtJpk1NBQqvQ2NjU7Y7f66z6zOlqe9Dm0tLTBZ/EExQaXCoNGjQlo/aP66PPn7Pvw8tz1W5+hni8wPmQyaX2dlRdsS0tMQFZ8AvckKXs+6+wlw1x5T4le1JSdgs2hg0AndBdwlCe6aQqjl75R9tyXH92HL5uMYMSIFGfmjILpa4G29eJW9SxgxPFE+hu7gmOhqgqvqELSOfKjDMhAqr+t0ulFc3or4aDM0an9wi9dYlPksyBVmbsDsOWa+qrIhytnecbfAi3ez62nrtnO+zg7P48tEkTJ5vmI04L+ZMWSwyWg2B9q8Hg8ayi/AlJ8VaGPfPae1w2TtDnb5Omp7ba/ofD2iYyIefHqJ/dWnVjV+dGOPnhBCCCGEEEJIf/WZgS02ql603v7bGXPGc+++vlnpRtYzY0fJtmAj3vH+rmVpAwfKD6UnkD+0e0Cz2BgrzhwtxJBx3VlbeaPH4MDWbf/nBzP5Pz67TnT15Ye6XRUU8MIzSyz/bbcZvzNyZCKnUstfr7seNRcaoZK/M4NeDUtUKjThuQjlNagr/URZT60KzsDatWkn2to2o6WlU8m+mj57NGJyJsDbXo26i0UoKqpBVVUr2ttdSoYXCzqlJIchLs6GtNSwXsflbSlT6rBpInLBa4xwOCxoanQiLEQPjdpfj0t0t8BdfRQqazw4jQX2KDWsdrMSSGOjKm7efAbNLZ3PPvlK054bfybJtWCjaWo09u/n3zEhqP3CJ58gIlwX1Hb+Qj3Scgd2N0ii0kW1JzZQQJvTh0UPTeVffvHVZx8bxg98cb/ouWEfgBBCCCGEEEJIv/WZga0wwfpQdrYj3mw1ISIuUSkSHhnZnZXBMn1YgW/BGKlMZgwejDdf2IahQ2IDtXZSUkLx/kfbkTtiONQafyBDbzIib8yYBNfGTazW1vN9/9FuP3kq64/lkz6jqdm55f0PTtbLTaxoVarZrEtzRNtUiUnhaG49gfCGC9AYbLBbrlzkffDIPDQ0tCmBsLC4NAiWONSd3YOPN3yMogsNyJv4AJISY7H9jRUYlBeP6Fi7EuxsaHZBp1HBqBcC3Qy7eBrP+QuES5xSXN7Z6YXHc1ldJZ8Lnoaz3dMSUN/QjsOHL+JsUd3G6qbmJ/v8pJHrplZZvzsgNzci3OEItLGkuj2bNmFsfnjQsufON2DO5O5RE32sC6zoDVqmpqYVEbEJMJoMGDQoJqOj01MgN//rhn4IQgghhBBCCCH90qcGtpbzPK9bavtmTrb/gTUhPR1l53YFB7ZkvrbKQGDLFhoKU2g0KitbEB3t725kMeuQEKPDwW3bMPLOOwPrDZt4Bwp3735q+Uz+f5etE1v69JPdhhrrm3/fUo9f98xuYV0TVxSId7e0dC6rrmoZNHVqJu/1eCF0NKCktBFWiw42myGotJbeZEZyygSlRpantQoH1q7Cju0ncLxci8qOWPz4H79Gffkp7HpnpRLU0moERIbqe42UeDl2nTAtrZ0wWYzw+HoNRxBQKh/brt0XvI1NHefkpV6u9zb/hjL7vnpYbS2toP730dOnBbWf2H8AFq0LERHd94qGBicMNkdwN8S2ql7bZDW4EtKHgg2KmJkZhYOHyh6Tr+OXRbH3+BWEEEIIIYQQQm5vnxrYEhaasqMd1lyTSat0GUrMGIAjWz9A/tC4oOU8rRUQQnOU2lnMoFEjcXznh4HAFjNkcCzefOdj5AwfHniw1RkMGHnnFMeWd95lmTg/6ePPdtv55Ydie9f7H8zktREWy5KnF1u/Hx4dnTcgbxDikpMQFWXxj2YpSmgtK8S5T8rRWHUcmQPCkJ0VpQSnTh06iMamXfB5vUqto2MXvDhWE4nf/c9f8fwfnoMgCGipvwiv1wePxwebWfOZQa0uNbVtOHO6FhnZann7Irw+CSqh98qxCVEYzQvCpk2ntC0dbf/6zWqxo89OFOkzGon7v4NGjgwJjYwMtLldLuzdsB6zpqcGLXviZBUGjpoRmPZ63PK9o3e9NhZwnTMtQ75OG6DTqhAXZx+1bFFHgjyr+EZ9DkIIIYQQQggh/dOnB7Z4fnpCgl15L4lepfi7oLejrc0FJdh1ieTtwPkThUgbNESZTsvNxY5176G11QWz2b+cVn5AzRsYKbe/jxlLFgfWzRszBsf27f/h8gLrP5etbj7Z55/wNrN8Eq/SRFnuc9it/5WUkZk0fNJExCQnB7qFdmEV0bqy5zrb27Dp1b9i3/4SjBiegJTkUJw8WY1de8pwqlLA9rNGSJITX3/gQbzw4otK3a29656D3W6CTqeGXvf5Bte8UNyg7GPmzCxs214Es0WnHFeYXQudVghaVh+egYykiZzO+GHSO2/ufk3+XKOXbb6szxq5qVYU2IeabeZvjrksW2vPxo1ITTIHfvuMy+VFTYMPUzMzA20lp04gShMcr2xu7gTUJtjDw+Gpq1baEuJD+KKi+qny2z/duE9DCCGEEEIIIaQ/+vSIBM+NdkT5RzKUfG7lNX3gIBSdL8SggdGBxVhworb4VCCw5R/1cAyOHjuMsaOTAstlZkTizbePoaK4BNGJCYFlpyyYr139wgsvFhTwE1evFn19+glvIyuWWieoHdbfxaWmDh4/8y44EvznmGXQnCksRMnpM3B1dCArNwnpQ4aD1/i7iemMJky6axz++eIbGJYfr4xqmJ0dhZBQAzQfnYLJokPU4Pswbfo0DB4yFB+/9QvUl+7DrJnZsF/WjfFqWGDj/Pk6zLorW6mxNWFcCnbsuoCRo1NR1+RCTIR/O2fP1iI0zIhwcy1U9hQkDJmK3DNlw474vF+TN/PSjTt75FosL+A1apX1jxNmz1bpjcZAe2NtHc4c2oeF83ODlmfZWrmjRrOusYG2hotnEJWsDlruXFEd0nMHKveUrnuOI8rMeiWOBgW2CCGEEEIIIYRc5tMztgR+oN2uV95L3k7llXVpe/vFLUGBLWW+qwHNDQ2whoQo04NGjcLfd2zH4Dw3jAZ/kXL2sDp6ZAK2vrsGi7/3vUAWUWxyMgaPGTNO2r7j+/Lk7/r0E94GnlpgCzXpuF/a7aFfu2PO3TzLmGPn1uN24+C27Ti2ZyciwnQICTNDbVZh2webEWtvhTYsAypbCjhegOhuVQq+98zsYkHNhffkYd/+UoiGY3CWqrH6o59B6PwEC+YNUgJUnNqgjHgInxuixymvdeUySCxjb8qdudCEZ8PTXIyoKNYVzauMsgnwStdIQeDktSWcPFmFsXajUlhc0Icif9xIHDt28fGCAv5vFPj8alCrrD9JycoampU/NKh929q1GDY0JmjwANZd9XxJG5bMHxFoa65vgNTZIL/r7sLIBgs4V1SLOY8U+Ke9/mwultmn06h6DKVICCGEEEIIIYT4XTWwtXwSrwsbEBmtUvm7iHU9ZLL6WAZ7NOobnAgNMQSWj4624NShwxgxZbIyrdXrMWj0WByU28aPTemxnBXGT6pxfN9+ZZTELuPuugvFp888vXKpZdMTL7cU9u3HvHWtXGqbaTYIfxw8ZnTM2BkzoNHplPazx45hx3trkRCrx/w5mUqB94YWNzo6vNDI7zmIcNedhLv+tBLYYoGpeXNylSDE0cJyJXOLMRg0uGNCqtzejLa29UjLV0OrTQ/sn+NV0IRlQzBGQHS1wF19GLu2HVIK0g9IDx4RTxOZB5U5BqK7HWJHQyCIxjLEhEt1thLiQ7D/QBlGjxKVbekTJsMckYTEhJAs9zmRpQTu/xJOK/kUzxTYhxusxienLrwnKBB64ZNT6GgsQ8ronKDlC49VIHf0uMCIqMzJgwcR5wgehKK2tg0aUyhCo/zBLsnjv+fw8j5MFm0SG8xiGRtukRBCCCGEEEIIueTqGVvhRptBrw48iUpeF8BKHPEqZA/Lx6mjmzFmVHc3w7BQI3Z9eBjDJk0MdDcaOn4c/vbL3Whq6oDNpg8sO3JkIta+vx5puTlKAXlGrdXirqVL9K8+9/yqH0/nR/QshE56e2wYr05Is/7CGhb2w+mLCri4FH/wsKO9HZveegvttcWYPjkFVqsusE6oVQvIfyyAFSD55P/9SVAsq4plTlVUNCtZWqzgf1fmjc8nKUGvqupOpcYWW9Yuf6c6tKCzfCc04QOhtqdAGzsaQ4e1Yc07+5XAZ1hYdzc1b2ORkoHlabmI4yeqoNVpWFYgdJru+lpsu5ERZqWAeFIiB29bOQRjFBISQ3HufB2rkPKG2QAAIABJREFUPE6BrZvoiQLealXbXp5670Jtz9ENvV4vtq19F5PGJQd1TXV2eFBS7sKShaMCbT75ertw4ghyZyQHbfuTU9XIzu9aTrqUAehn1GuMmAGT/JZGTyWEEEIIIYQQEnD1wBYvWNQaobs/kfKg2Q5ea0VqTg52fbBOfpgVA4EPlnVj1nlx4ZNPkJKdrbSxYNWoO6diz96NmD6tu2i0yahBRpoNu9Z/hEnz5gbao+LiMO6uGdlb3nn3OZ7nHxJZlIX0wjJXEhZb/xqblHDf3IcfCQQHfa5WvP7CC8hIMSNrWPZVa1+p1cKVZ8D/Pc6Ynoldu4vxyquHoDeo4XZ7oRIEJUhmMFvla8CEDqcLtRUXYNQLSsH5SOmo0pdMHZIKoyNHbqvBkcJyTJnUnd3l66iDt/UiSi5UYv+BUoy7Y4DSrtcFH09mZiSOHi1HUmIIPA3noDLHIjI6ChxOD7muE0eui3zZcSsWWf6YN2ZMKuvu2tOh7dsRHS4EZXEyBw+WYviUqYERU5kzRwthMyEo28vt9qGkrBmTlvi/YiVbS+rudapW8yqNv5gXBbYIIYQQQgghhARcPbAlSir+ssiI6GpVAlsqtRopuXkoOl8e1N0sOysKB+UH3K7AltI2fBgO7/wYFRUtSnfFLgNzHXjrncOoHpaPyNjYQPuQ8eNZcfkHV3BHWWbOC33wGW856kXWn4RFht0375GHodWzQIIEb9MFuGqPY+6sVAj856jm/ik0GpXS/ZBlablcHmVarTNAE5YFwRQNTvAn8rGRMotPHMXGt9Zg4h3JcOCYPE8FlSUeMXER2LGjKGi7nMakdEVMTHLAbLqgFJRn29aoeXTK74uK6pCVGYWYaCt27y5GY6MTdju77ppgDQ1j2V1p1/XByHVZUWB5PCYpqeCOu2cHtbc0NKBw53bMn5sV1M6+v+ZOA9IHDQq0sWy/g9u3YdywyKBl2aABSVm50Bn9gTHWrbUnTiZpxM83/CYhhBBCCCGEkNvGVR8UVSLnuTxhSnQ3y//6g1CDRo/C2peeQ3paeCAzKCrKAs++UlSVliIq3l+jiXVLnDB7Nra++TIWzBsYyNJgXdBGj0rEprfexuLvfgfcpe6LbP7Ugnu5+pqa3z6z2Hr8yVeat/f1h+7Pli+1ZuhVqv+cuXQxtHqjUtTfVXUIvvYqZX5XUIvVvuL1oeB1dvAaozytYScXks+jrMOKxYuuZuUP0pXLFrG6V4ZLhf+79gPuCHi1EZrIwRAMYUjKHYrJohf7Nn6E2bMscFUflvelhspgV8rIs0AG+05ZDS6tYzgkeb+Stx3x8XbU17XBbNahtd0Dq0mD8vImtLW5lAywvEExOFJYgYkTUuFtLoXGYGHdFKOveKDkhlu5xDLZZLP/fPYD9wdlXzFb1qxB/hAHtJrg9t17SzB+7n1BmVmlZ89BLbUhLCw+0MaukeMnKnHX17oDZqI7OLAl34tEzs17+/IzEUIIIYQQQgjp/64a2OIlX5vb42OxicBTqdjZFJhvCw2FJSIBlVUtiHZ0Z2LlDYrGvs1bcPfXHgy0JaSnK8uePl2DjIzuTA2WmcPaCvfsVQJlXbQ6HeZ+/Wval5/9/evLF9pHLXu98fz1f9Rbgxrcf+UOH6oLj02Er70GrqoDgRErWUBJMEcrWVGCIYI1KEGDTqcTbc0tcLv8xbg1WiP0xkjowwxK8Ip9r76OBvm1Xn5tDAwUcEWSqATFOi/uhJYVg7fGIzYhEh81d6C1zQ2zSYPOyn0Q5UunK6jFjoMFtSB60Fm+R9lMY5MTthB/8fBOlw8hVg5TJg/A2veOo7KyBcnJoThwqEzJ6uJay5Uujnq92vSTebz552+LrTf2LJOeli+2pRu0utVzvvag2myzBc0rOnECHY0XkTY6O6i9tKwRxvAkOBISgtr3bd6MwYNigtrKLjZBb4tUuiJ36XmvYTwen69FaHeCEEIIIYQQQgjp4aqBrTqhvcnsNLnlt9quNv/DZnesa8j4cdi3bnVQYCsh3o79B46hrqoKYVFRgfYJs2fh9Rf+gOTkMGVUvi4jRyRgzboNSM3NgdHcPUqaLSwMsx64P+LNP7+0Zvl8ftyyt8TgJ93b0FMF1nCzWjV/yISJ8DSehbv2hBJo4vUhUNuSlW6Crc2tOHX0FCpLt6K+usbX0thQ6WxznhV9voscpHZwnEr+Cm3yVxil0WqTzDabIzQyko+IiUFUfBwc8YOgUYnwdTYqIxey75xlz0g+txKg4jVmJVPL23IRrqqD8DScUeY5oiwoLWtCdmaEUmururpFGVCA4eT1WAYZeLWyjY93XUBbuwcDsvzFx/keoyMOzovF2XO1cMjXVHJSCEpLG5GWplK6weq0KkGv0dvlRSmw9SVZXmAP0ar5NXfec09odGJi0DyPy6UUjJ82MbgIPMv0PHCwAnO/+b2g9oriEriaqxAdHVyf6+jRCgydMieojV1/PTk7PJ261+XvffV1fiBCCCGEEEIIIbeUqwa2QgRrdHu7S6yvb0fopQCF5HNBdLeD15iU6bjkZHzMmdHQ4ETIpaLRLENncF409m3ahLuWLu3eXkQEMvJHyA+8pzG6x2iKrKtbXk44tr6zBjPvvy/oGBLS0jB1wYKc9a+tfv0HM/lZz64TXX330fsfk8DNjIyN1pr4erhrToFT6aBlXQJNDqX75+7X/+EuOvnJekmU3hMl795Gsf3Mb1aLn5J+BSyfyVvqKquyOkrqx9TsP/ezDQ3lep0jBHFpqYiX/8KicsGydDhJRIezA6ePHkFmske5FhiWvcXo9Wq0OT1KXS7Wq/TwkXJkZfmz8yTRp9TjYrW5BJ0dLc0dSE2LVAJZjE7bHegMCzfh0OGLyvuoSAvKK5qQlhYOn7OGdUXkNDwfJs8q7fOTS3pZPonXaaKsb46aemcGGwn1cjvXr0dKvCFoxFPm2PFKpA8djcuzu/Zs3IghQ2KCBjWoqW2D06NWAttdWAai5O1Ozmpu7kRLS4cPC/WsHzR994QQQgghhBBCAq4Y2GIPtIY4+ztpaZH64uKGQGCLETvqA4Et9oQ67I6JOLJzHSZN7K7rnZIcikNvFqKhphYhEd3F5UdNmYJ//OowMgZ0B8IY1j3x7LoTOH/yEyRndY+eyOSMGI6mhvopuzds/CPP81+/rUdK5LhxjnABnvpT4LU26GJHweWWsHH1a+KJffv+5RWl//fUqsaiz95Qt2XrxJaG535yUQDmtZ45p+9wqtFx3ovK4tP4YMtOaMIsEAQBarUaLmcL8gZGwhsWXPi7vKIZxSUNGD4qFaIkYcf28ywIhcSEkK7jvrSkf2RNo1GLzk5PYH2Dvvsy1Ovk/bj9pZQ0OhU6OvzvJY8TOr0a4FWh13rayLVjI2+qF1teys7Pv2PU1Km95leVlaH4+CHMn5sT1N7e7kZRSQcWz5vQa/m2ujLEjx0Y1H74yEXkT5ik1OLrInY2KFl/XVi3xti4cFtpSe2b8r1p1LLNItXaIoQQQgghhBCiuGJgSxNlfThvUExOSlYGdm3dHzTP56yFytpdNyclJxu7PlqvZFVYrTqlTcnaGhSNPRs34K4lS7q3q9Nh3MxZ+HjzWsyelROId7DX8WOTsX7N24hJTlJqbPU0Zvp0ViPqwaelfVXyA/ATt29wSxoYZteCUxugixuDC2fOY8Pq1880NTQ++tPVzdvYEk3PPTGb57iJNVL7E6nfffZTM9zkc8k1/eEn93Bu93NNJ05FuJualXY3fChSNSJp2EBMvfdeoKMWrcU7oVZzgULgLO5wsbxJya5ye0TkDUlU6mupVTwyBkQgMrK7W6mKjaTIq+CuOaoUq2eZWtKlwAWr8cVGRezCNj9taoby3uUWlUBZFxb0kqfC+uRUkqti18WKRdZfJGcMWDr13oVBxd8Zn9eLDa+/jnFjk5RBIHravbcYY2fOheqyAvO713+EoYNjg7K16hucqGv04e784Gwwn7MuaLq6uhX5o4ci1H4if7/Xt1hu+t/r/5SEEEIIIYQQQm4FvQJb7KH25/fZv5md7YA5Og7NrXvgE6XAaHsssNUTe+gdPmkyDu3/SBnBrktKShiOvF2I+qpqhEZ1Z/gMGJyHY/v24ezZGqSnRwTaWXemASlmbHt3LdjD9OX7mLrwHrS3tv54xeKTbPi//+6TT9+PKBk0i6yxJjPrfjgEezZtx66PPvqby934/WWrxbau5SQe5yFJ74RL+smNL/zHE5u2Fa+/Z/VqX89tvVFQIEwdlzKx6ff/8URHRcXEtqILnOjxwgcJZ1R1OG9sw7g5s5E7YgR8rf5aWhpNdwCDxZo2bz2LllYXUlIjYbMblKprdqu/HBsbHbMLp9JDMEaho2SLEtRiAa26+jYkp/rrrxl0vWOrNqu/a5soyn++7hEbWXdHTpKieq1A+tSKAsvjjvi4H81+8MFeIyAyezdtQmSIhKgewUuGBTo5gwNJmRlB7ay2FsvWShgbXFvr0KEy5N8xESp18D563mPYtVbf2ImI+ESYVI2sHtc3QIEtQgghhBBCCCGX9Hpq/dkia7L8wJpt0Kvlh1oNImLjUVvbFniIZSPmKVk3WmtgnfRBA7Fv8yY0t3TCavFnW7GsnKFDYrHzww+DRkhkQaopC+bjted/j7g4uxKs6DIwNxrvvncCF06dQlJG8MMxLwiY/cD93Bt//NNvnlliq39yVdPt9XC7ECr51BkM9hjs2LhH2r91649/+mrLby7PXrN/e+WJlhee3Nly6vQ4tdWybsqo+Astzz+xWT7zJRInyd83lzJ5ROx4Z3l5XMfFCnidTkjyf2VCC06qahE1MB33z/0mLHab0uXRXXcKbW2dOFpYgcZGJ1QqAclpEUhJdwRqZCn7tWqhVfO9DpuNhMhGbmRaW13YtfsCOPm7tNmNUAkcLCZ173UuYd0Z29rdgWmjUcMuIMf1nkpydSsX2x4IjYr81bxHHuY0Wm2v+dUXL+L0gd29uiB6vSL27q/AvMe+12udnR98gGH58UGZX6wuX02DF7NGDA9altXXYveXLs3NHTCHOqDWaNngAYiJtY5cvtQatuzl5uC0LkIIIYQQQgght6VegS1OkkY6HJZLEQoJiRkZKD2/Lyg7w9tWCU2PwBarjzNyyp04sOt9TJ6UHmhPSgzFkaPHUFFSguiE7u6L9vBw5I29A7v2HMDkHrW5WKBk4oQUfPjWm4j6wQ+hN3bX9mLYg/a8hx/iX33+hZeeXmJrfmpV07vXfwr6h4Y2cFE2cMeOlaFw//EnnlzV9OsnVwUv8+Rsu91klr6/cOCC/w5NiBvVcPCIqu3MuSTBaHhYkM8dy5bydXbC19GppMJ4IaJUaMY5VQMsKTGYOf1hxKWmKsGFzou74WuvQktLJ9Z9cBIJSeFITnfA5xOVDJuuoBaLVdgtWpgMVx6HQLpUDmnP3hKcv1CP7KwoJKeEK13YdBo+KDh2OY1GhU6XVwmaqFQ8TEYN+wzxfXNGyeWeWWSbbQm1/3nBo9/ge45Q2sXjdmP9q69iwrgk5fvo6cDBMgwcNwlmqzWonQWpvc4axMUFB8L2HSjF8EmToNJogtrZvaUnVl8rKSMnUHPLEWVRny9uYH0XP/yin5MQQgghhBBCyK2jd2CLQ3ZoyKVREEUvkjMy8fa29Rg+rDue4GurAEKDM6rSBuZi/5YtqG9oR9f6LOgxYng8dry3DgXf/hZ6FtjJv2MCVhUWKkXHA0XGZVarHrlZdnz0+uuY8+CDQeswLNh1z6Pf0Lz2wv+8unKRfd4Trzau74Pz8JVXZYLXwcF57OCJTe5Xm3+FVb2XaRebnTaV/bH3ij60hWtCXXGOMJW+oh36dg9UbTxEToILXjTxLlTzbajSOBGfnYG7xs9HbHKyP9jVdAHuuhOQfP5MKZZhlZEVg9Aw0xWP69OCWj2x7D12DX1aIOtyKhUHs0WP6ppWxERbYbHo2OWQ8rk3QD43+bc0zWSzrGa/LWtIyBWX2bb2PcRHq4PqpzHs+2lw6jBp5MigdhZI/fj99zF2eGKv5RtboXR1vZxyb+mhpKQRd47LlO9F/t627N7CQ8oGBbYIIYQQQgghhODKxeMTzJZLXZB8bljC7BB09qDi8GJnM0R3K3hN9wMu62Y0ZsZ07P3wDdw1vXtkQxaQKCyswNnjx5GW211jh9XumbaoAO/8+X8QFWmBrketpcyMKJRvOo1DH+/EkHFjex2g2WbDPY99U//GH//49jNLrEufXNX89nWeh6+81atF38ql9gs+eH+6TBTFKy3z7DrRtXKJ/ZX80QMeT8wZipKzxSgKdaKlvgGujk4ls05vNiE0MhJpKSMxIycHLDOHBbFYQMvTWCR/ry3KtlgPx5Y2D0IjrFcNatksms8V1GLUauGaP7NGxSMqyoqiojrlOtJq1TAatOnLC3jNstWi+7O3QD4P+Tc0z2y3vbzgm4/qQ6OuXMLszNFC1F44jlkzs4PaWTbdzt1lmP3wY+D44Cyu4/v2waJzIyIi+Pph2Xujp83sVb9L8rmCCsd3dHjgEnXK9equa1DaLt2bEkAIIYQQQgghhOAKgS2J4yLY6HOM6O1UXlkNrfPyQ+3gvNiupeBtLoEmPLh7UeKAATiwNRzlFc1KIKLLqJGJ2PD+OqVulkrdXVMpIjoauaPHY/uOA5h654BAuzJK4vgUrHl3IyJjYxCTlNTrwFlWScG3v61/66W/vPbMEvvjT65qfO6Ln4b+odnZPPXnb4utn7qQ2/urI/sKH8pINliH56dCmDAYnNqojErIMrIk0eOvk+Zug+g8h47GZiVQCcmn9PbqdPnQ3uFFh8urTEdGWXvtgn0/oTbtFQu/9yW1mkd4uBnFrR3d+w01WlqcHaz/6okbuvPbhPzb+W5IRORv5z/ysJp1Eb6S+upq7Fj7NmbfNaBXxt3efSXIHTMJttDgwSpdnZ3Yu3EDZk0PTrBjGZo+3ozMwYN77cfbWq5ch10uFDcgNccfDGfXLKOMjCkhotfKhBBCCCGEEEJuS727IgKmruwayePv/jNg0CC8/cftPQJbgKepGJ1CNCyXdVsaP2sm1v/rJcybkxMoFs1GPIyN0uDAtm0YOWVK0PIjJk/Ga2fO4NTpamQM6B49UatRYcqkVHy46l+451vfwZW6R5msVhR859uq919e9YeVS+y5db7mH/5mtdjxRU/GV91nBrVkT7zRWvn0YtvjGzee+MvMGSInNJ77zO16vCLanF44O7xwub2or2tDU6MTnZ0eJZhkNusRHWtXirkzX0ZQi1GreAgqAemZDqVbG7ueHA4LSksb7wAFtq7Ljwp4fZhg/e+E9LRHZ99/H/SmK2fldbS3Y+0//o4JYxP8xft7YPWvnAjBoNGjeq23+6MNSEsyw2zqLkDPsgBZttaUggd6ZXe1NTcD9efQM2x27lwt7rxvnvJe8rQrr6w2m1olXPlgCSGEEEIIIYTcdq4Q2JJUXVkZInuYlHywhoZCb4tAbV0bwru6pYlunNqzAcNm3Bs02llETAwikjJx+nQNMjK6A1VDh8ThrXd2IGvoUFjs9kA76x43Y/FivPqHZxEZaYHdpg/MCwkxYMyIGLzzl79g4be+BcMVHr61Oh3mfP1r2L1hw6N7Nmwc8vRC25KnXm86e/2npv966pWmv61cakv5cP2pp+64IxVGg6bXMiyY5XKLcHZ6lSythvo2lJbUo76+7bgkiu+63d6dkoev8AmiVpAw/tzZ6ifzRyTZIsLN1xzU4lQ6pSD91eapQ9Ih6EPRWb5HycxhXdDa290IC/OPnKgE3jq8MBvUSIi3Y9/+krnyqs9/kXNDAPk3khausa3Knzghf+xdd0EQrtxN1ONyyb+9v2JQlk0JKPbkdLqx/1AN7vnW94J+/0xdVRWKju7HPfMHBrWfOFmJkJgkJKSn4XKf7NmMrMTuAT7ZoAWiyoKwS10jRZe/iyzblXx/uvpQmoQQQgghhBBCbitXilB0P12KPvmBshW8zoac4cNx6ugWhI/tDi5Zde04eeAAsocNC9rA2BkzsPr3v0Nycqgysh2j0QgYlh+DTW++ibkPPxz0MMyysSbNuwcb1r6OeXNyg+oxxcXZ0Ony4K0//xkLHn2010iJDAuOjZk2DXHJyfkfvrL64DNL7P/mebX5pavVorodPPFy00+fXmwrWv3a4V8lJoeHxsTYYDRqwfEcfD4JHo8PrS2dqKttRWVFU0Vra+cqTvL944lXWo5fYXN7Vy6xHCo8XLbh3oV5n1r9nVPpwQka+bppvjStgyZiEFwVe3st29johD1UA5UlQV5HDV5rgc/bgbq6dmzYdBpz784NXCcdHT5YLBaERWhZcHXi8qXWjGUvN5+6/jN1+1gu/1DUi6yPmMOsv55WcK85OTPzqsuyERDf+evfkBjNIT0tuIsiy7zatOUcJs5fBIPZdNk8ERtefwOjRyUEjZzIgpWHj1Zh0fd+2GtfZwoLoUe9/K47K/OTU9XyfWW48l7yOJX6W12kyzdACCGEEEIIIeS21bvGFrgOFvjoKoXl66xXAlusO+KuD9bB7fYGglWsjtYHG7YiNTdXyZzqwgqSDxw7AQcOHpAfcLvrY6Ukh+HM2U9w+vBhZAwZErRfNqpiRUkxtm0/gSmT04PnpYbD56vBG3/8ExY8+o0rZm4x8WlpeODf/o95y5p3/3iSO3DP00vs33pqVWPRFzs1/R/L3Hpytv2djs7KRac/qZysUgkpgsCZJQlur9dXJvqkw/I3vMHta9vxWcXY3a+2bWldLFS6Or3RWs2lwCPHQ2WJ9Q8mcCmQpYnMg6+lpDuwxaugMkfDZ45RaiixoBer81Vf14433z6KvEExGGUIgy5mBHitFb72amVkTRZ4W/fBSYy/I13ehgCX2wePywlDRBaGDKkUatZ/soLn+YUii7KQz7R8oT1Zs9jyQvqgQdOmzJ8Hg9l81WXdLhfW/PVvcIR4MDA3ptf8PXuLkZw3CnGpqb3mHd21GwZVG+LjooPaWS2unBGjYQ8PrsXl9XhwZNsGzJiS2N3mE3G+uBlj7vHfI3ydDYF5rO6bzydeOf2PEEIIIYQQQsht50oZW60sqNA1SqHorAVsKUrR9/S8oTh9pgS5OQ5lHsumSUk0Y8+GjZgwe1bQRoaMHYuXDxxAfX07K/gdaB8/NgVrP3gPsSkpSo2snsbNnIm3XqrEwUNlStfFnjIGREDga/H6Cy9g7iOPXLHmFqMzGDBm2lSoVKo7j+7eXbhyqf2ZOm/zb2/l2luf5pm1jY3yy/9c+vvCWPabfC6bRLU9mhN8SgaNJjwbKnMsnOfXK8uwUTJVpih4Gs4o0wcPXURUlAWpMW3QOoZBHZYFsbMRzov7sHVHkdKt8JNTVfK1dgBDxxugDh0ATqVFecVJxMvzqqtbsW3LGYwYnQK9XoOWNjd0thakDxmJ8+frF6xYhCd4nl9Jwa2rY7W0QgXr4xoNnsoYPMQw7q4ZnxrU6mhrwzt//SsSo/krBrVOnaqGWwjFsImTes1rrK3FwS0bMO/u4Eww9j1W1Hpw54OTe62zf+tWJMTogorSy98tEjJzoNX7uyX72D3oEq/XB9Entn32JyeEEEIIIYQQcjvonbEloYEVDTeb/UWffc46uVFUsnMGjx2DN57fj5zsqEAXsdSUcLzx1gEMHjM6qJA8LwiYOHcetr31L8yZnR1YnhWgHpoXhfWvvY75Dz8UVESadSmcdd99ePW5P8BiqVUytXpKSwtXCpi/8eILmHnfA4iKj+/1gXatX4/TB3bBEWXGyBGJBpfLu+LYcf5rzyy1/sTzSuvbt3P3xOvx2DBenZBudYSkjQPfchLeljIIhgj59aJ8efhwtLACgikWw8IqIHbUo/BYBc5fqENhYTl0pk2IGzJDydZy1xzDvv2lyBw+AR1VRzFkcCzeW3cCgvAxBo10o62lFTr5O9bp1fJ3aEFFrYQ9u4owYpR/dD1NdQlCkvIxdeE8qN/b8PQz/PmJTy+x/aGmuWX9s+tEV89j/sFMXvuHD+C+HQNf/m6H5jmRGvsvsrOj0lgR95bWKrzzp9/DkZKDqfcu7LVOY20N3v3b3zAwy9ar+yFzsbwJZ4udWPDY13vV1fL5fPjglVcxZmQcdLruEljs1G//+DzuuHshNFpt0Drtra04uXcX7pmXFdR+7HglZn597qUpCWJ7TWBeJxutk0MDCCGEEEIIIYQQXBbYUoIXadZsNkJheLi/u5/kcyvBLcEYoRR9dyRnoKioHqmp/i5FgsBhcJ4DOz9cjxlLFgdtPDYlGeEJGTj5STWys6IC7WnyuhcvnsW+LVuUURF7YhlXcx96CK+/8Dz0ejViY2xB81kmj96gxrp//AVjZs7p1aXx9JEjmDt3EDSsTpfkU9oyMyJT9+wrfuPCEmH3iqXWJ376cvO26zlpt6PYZEt+aFSkndU466hrVwIWxedKwHdWYefm46itbUPuEDNc1UeU+kjsjwUmzZGpeG/NDsxTcUo3tGOFxfBwJiVIeui9T5TrLE7+TnftvqDUYdLr1EhICFGKx7Ppu5fegw/f3ojdH59G/nB/t1b3mX0Ii8vE9PsfwbDq2iknDh6ecu74icaVS+1bJOAwJNTxHCIirdb5yxa67pFX+eyhIW8hK5ZYx2mXWFfK53HMyBGJ3QMycLz8vXH435f39wpslZw+hY2vr8a40fGIibH22iYbOGLfgQrMf/QxqLW6XvN3vLcO4Ra3/PsMzvIqLKyA3ZGEtNycXuvs2bABudnhUKm6a+qVljbCEhGP0Ej/wBOsS6t4aUREhmWMcRw3sKCAF1avFn2f/6wQQgghhBBCCLkVBQW24tOs3xw4dMCQstIapcZRVxF3b+tFJbDFjJgyGe++9LxSGL6r+xALch1fcxyVpaVwXJZFNW7WLLzy7O+UbmcmU3fGxtixyXh37ceIiI5G0mVFrG1h4bjBuG0tAAAgAElEQVT7aw8oI7JNnpSqZO70xEZmnD0zExs2rUVlSQnGz54NQeX/KCarDW4hHJaYVHSW7/OP6mjVYdqdGaiqbh21b3/JlmeW2DbIiy5/clXTrj44h7cFQYXvsxEtRXcbRFejknVVWXlMbufR3NypjLxYc7EU78h/JqMGw/Pj0dLqwsBRo5Wg19o1+5RAF8vsevQ7s5WMPpPF30VVJfC4Y0Iajp5sRktDBZYuHoqyi02oqW0F72tXgp86qQF7dxchKycGsXEhaD9TCEPZaVhDIzAy34ERQ6PszTXl82uraueXlDbizNnaNp9bnLdstfO2CWqtWGIbIf8k/29ctG3a8GEJXNBIhhwPrSMfLbWVMFi6A1eSKGL/5o34ZP9OzJiaLv9W9L2229DgxPbt5zH7aw/CaAvrNZ8NIFF59ghm3pUd1N7U1IFjJ+uw9PH7e63DRk4sO1WI+XO7A16sftbBwxcxZfFDgTZvS3ngPav9x2pvjRyTO176uPA+uekfn+vEEEIIIYQQQgi5ZQUCWywDYqjW/oNhI9KgNkXiQnFVoDuSr7UcUsRApRB4SEQEIhIG4FxRXWA+z3EYPTIBW955B4u++12lS2EXvcGA8bPmYPumNZgxPRNdPZjUKgFTp6Rj3VuvYeb9X+/VrTAyPhmz7luM9/61CpMnpfUKbrEujbNnZmPPvvNY/fzzuGvpEiUgFhkbg+qyUkQOGANd7Ci4yvcqxcqZqEgz7p6Vw5WXN089cLDsThbg4kTx50+91rb1duyu9nksn8Sr1A7Lf4ZHORYNHjMG7pqDOHOmBlV1bsydk6uMUPfP/92PuPhw6MKSEWbqRFKMCqflZZTvmuOROyQdcJYpgQ6W4ccLvHKNWKys1pO8BXk51sV0yfe/jbP7d8jvnTAY1GhtccHX2YSImDQMzEtEclIINm4+g7LSeiSnRMDhsMJ5sUwJjBn0AnweL8orm9m+T3nc0n0/Xd148Cafvi/FiqXWCTy4n8Q6rNOGDo3j4mKDsxzZ75bVOBNMUag5vBcR0f6sKmdLM9avfhUqXxPmzM4JGo20Cwtqbd56DjOXFCiZV5crPn0ae9e/pwSa2Xfbhf2ctm4/h7EzZ8JsCz4eSZKUe8XI4fHyOt33ipLSBhhDYhEVF9e1ILytZYH5ZWWNiElJx+D8JBQePPW4fA39k363hBBCCCGEEHJ7CwS2cmHNi421peoNWuQMH46Nq/4cCFyxwJCvrQIqiz/4NHraVLz54h+QkhwaeDBlRcKtp2twZOcuDBk3Nmgnqbk5OFNYqHRPy8qMDLSzOl53TkzGuv/9O2YsfQDRiYlB68WkZWP2/Uux9l+rMG5MkpL11RPb95hRSSgubsAbLzyHEVOnKRljRfs/woCaQmgj86CLnwBXxV6I7tbu7cZY2R9XWdky9dDhi3c+s0S155ml1t94KlvXLNssevvgvPZ7P57OG+1262y1w/rjlMzMwdPuXQCpoRAnDhXibKkXdy2cCc55Bo2NTqXe0uCRuYjMmozmoq2AtwFtbS5/HSb5f2uIXRkdk3UvfGX1ocA+LDYz4GuB1yOiubkDArxIzs6Gr2a/EmRhGVvOplroonlYIhJgMZYiKTEUx09Uig11F/5pMGpGytdQGs9xQrvT7W5t7Twmifibu6r5L/L3eEuPnKcEHKPMs3me/1FCbMjoIYNjOTZK6eU4tVE+fyOUkU3ddSdQXlwKR/IwnCs8jG1r1yIvNwIZA9KuuI+q6lbs3FWMmUsXISw+o9f88ydPYuvbrymZXqzbcE8sM89gj0XOsGG91mMZXmpfI+LiBgTaWHxq/4Ey3PXgo4E2n7MGksfZvZ58/xg5cxFU6nokJIYM/NlCNxs+9fRnnixCCCGEEEIIIbesQGCLV0njlAdj0YfwOAc4XYiSrRESYlDme5rOBwJbtrAwpA7Klx9eLyjFv7uMHJmId97diOTMDGWZnibNm4tX/vAsYmJssFq6uySyEROnTkrGh//6O8bPvQepOcG1eKJTs7Dg0cew5u//QHubC1k9anV1SUwMUWo17fh4Czp8OnQ0N6K5/BRsghqasGzoEibCU3scnuYL/v5Ol7CuWjMdWVxdffso+UH8jSJBde6ZpbbnPR0tf1/2lth0PSe2v2EZe4N463yOk3IlDsMio8PHJGZkmvNGDocjUof6C9uwa8dJuNw+zHvsh+CdJWAxh6KiOmXESle7f6A6jUoECw2y7okqFQ/R1QKNRgMWZWJBMItZh8aaajhiRGi0GnjbAZ8oorKyBd7WcmjM0WDDV7a1uaHVqnHqZAmGx5dDa4mU91EKr1eEIzqEr6yoP/74X2ofemahOUwUvDpPc0fzsnViy009iV+CJwp4q1mwPKiLsX0nJTksfdDA6EA9vGAcVNYEaCJywfHq/8/ed4DHUZ1rvzOzuyqr3nuzerUtucgd944xNsaFDoGEQCBg/pvkv/Hl3gD3p4UkhDQI1QZTbYy7ce9FbipW7713adv85zurasmWZK8sA/s+z2pXu1POnDlz5px33u/9eKbKhuJk5OfXoKz6JER9CxbMCeZhuv2BMhNeTm/Askcfh51L32vu0okTSDqwGwvnh8HWprcpfFVVE1Ku1GDdsw8AV5nMN9XX4+TunVi6KLTX96mpZfAIioSbd7dHl7Yut+tzQ2MbWjQq7tvXXlIBL097IS2tdDLMxJYZZphhhhlmmGGGGWaYYcZPGt0eW7IQSSSWrDMKXeImTUJy0veYNtWYjc7QWsOz3YlWzvz/iXPm4JM3XkdIcHtXBkXKZpc43ge7PtuMe37+BPdR6gSZws9ZsQrff/Up7lwSgR4RSJw8W7QgDLu/+xJ1VVVImD6914TYxcsH9/7yKU5uVVVnY/KkwF4hTAQKTZw/LwKnzuSjXG+BLd9expjRtYidJMPCLQoq99FQOI7iqhV9Yyl4CFzn9p3VmHVHCCaO9w9OSS3745Ur5S++stZhIzvqv//u06bLP4Vwp8hKKCVv/B87O+v4aXeMhk9QAERZg/rKy9j7ZR4KS1pgZWUBFwcFlHIjtO31qG9oQ25eDTt3kUi7kgef2HrWftpRVFzPz2lbmw7VeZfhEhjH90HhiTNZPV+6kAPXUcYQs8KiWh5mWlHRhOyLZxA2eSn/vrS0HoEBTmhoaEdFxkm4h0/jqp7yylbMv3s+Pv/3l7/fsNJ2539srk8dsUq7hXhltV00BPEJd1uXdeFh7vaUmdTmKkLJCAGS2h0ql0iu0iJoqq8g+fhBJJ0v4h5aVpZ6zJge1SezIYHq+Oy5QjRo7bHiiSehsrS86ncDDm/7DmXZF7F0cSQPIe0JjUaPfd9nYu49a6C26x0+TCGIlA01YawHrK1VXd+3tGhwMaUSa5+9v3tZbTP0TaVd/6eklHG/Nioz9VFOjuQFJvZOp2iGGWaYYYYZZphhhhlmmGHGTw49Z6WeRA7JulaKPURobCxO7N7JyQlLS+NimppMWHobiS0LNuGdvHAxjhzejoXzu83fKaNdQWEOTuzdi8nz5/faGaktQsZMwLGTaZg2iZRe3XwRTdKXLo7C/gPHUVlaijkr7oZC2T35pUnyPb/4OQ5t/RbfbL3ICRInR+s+B+TuZss3O2tmKI4dz0XGh1/hjoU18IyYBFFlC0uviTC01UHLJvu6pt4EFx3/+HF+GDvWxy4np/rnKallj790r3Ts5TUO/6rWN3z5xmZD603U9W0NCt37j7vEO/R6vLF/T9LDvr45UkurBiUlDYiJC8SDLzyFpD1foLa8FPXFqazhtOPUuXIEBPvzemtr06K+IAlyeyvOnC3g57K6ugWH9p3D0pV2yM2thiM7X6TQo9DRwpSTcHaxR3JyKebOCUddXS5OnsyGm+cpNJKyy86Sm4W7+3jhYko1EtVJyM2pgQgdlHbemD5ngt2B3Sf2/GG1/ar/+2n9sZGuv+HAc6tEK2fRbrkgCo+5eThMjYr0EINHuXAlXH+Q1B5QOYdDtHIyfiHrUZZ+Cge274O1lYr7aF1Jr+BkVH+kVmNjOw4dyUZATCJmzLwDgth7P63NzdixcROsxDp+zV9NLpMY8sChLISMndAnIQTh3KHDUOqrETyqd+gjXafjZs6G2ta26zttDXn+G69NSmSRV9CIaavi+XcUnqhWW9AOPQeqQzPMMMMMM8wwwwwzzDDDDDN+3Ogittg014YM3WWDjme+kyzsED0hEckpl5EQbzRzJgWFvrUOkpVRCRI+ZjTSL5znk2UKR+tE4sQAbN12Ep7+/gi6aoJLWRW3f1KKC5crMTqmd7gi+SoRyXEuqRCfvf02Fq27D46urt2FVSgw6+7lyEoOxa5vvkZ4iAMoFKvnBJuUIC0tWk62zJ0Thvz8Wuz4ag8Cg1Mxad4CWDn7cSWLhfdEKNvroa1Oh66puFeIIpmRk7+Yj7eDuP9g5tS6upap1jrVWy+vddhkgP7fv/+0+cKPUcX1v98YyIjsZy+vUL+U1tT+urWN5Yqg8BAkJEbycEJ7tQzvKE+cOnoeOr2ASYtXoyb7JF+XFFqH9pyEICkxKtJIeiiUIsrLG3Fk30kUFLdg2eIwLsSjbJpnTmeybbJlg105UUPLx8V5Y//3l6AU9ZyYpLC5hpoaTFu2Ege/2oSaigpMmxaMkuxMjJ1zF6zsXLz3f7fn8CtrHb+RZcNGQWM4qalprm1WQVKq7Sxf+qquemRrdOgQWeW8tFIdJ0uKhzytnNaya8KZwgVns/q4pkLLpoPQsuz0oJPRVluMk3t2IiezAJMmBsLX13jNkjrqakKYmnJqWhky89ow8+774MWu26tBGU93btyI6HB7REWO6rfsJ07mAZZumLJwYZ/finJykHz8AJYt7Z05kUIe22Q7jJ40qbs82lZo6/O6/idvvrCxCVw9RqSWrG/nbUYQxP5iMM0wwwwzzDDDDDPMMMMMM8z4CUHR35c85NDCDrGJifjkjSOcPDJmTJNRnXsObpGzupadvWIFPvvzW/DytOMqG75RNumcMysUO776Ao6P/7wXOUVKkfmrV2PLe/+GlFyGmOje/j1EfBCR5lZYi6/+8Q6mLbkToXGjey1DPlzegYE4sn07vvjqEsYn+CIw0Jmvq+bElqZrWX9/R24Wn3S+EBvf/heix0QgZvI0qJ192DHaw8JrPJSaRu5BpGso5Go1ApF1Fy4UIy7OC2GhETT5d8rPr/kl+/7JV9Yqkl5Z6/ChBvKnGzbWV93cKbh9QAohJ4X9dFGl+pm9k92yOx9Yh6TDh4hAQnt7G1wcLaBWK7kSa8LUeJ6BUldBqjotJxMbm9oxZekyWCtaWCPK59t0c7OBrbMnZk4YDQvhinFH7ERNnhaHOr0n7AXjcsQrKlm7mbRoOeqK0yGK7bBWq5CTUwUrpR5jps9DY94huLqokXUyCe3BatYuohEQFSemnDpxd+ali3dXlNcaYKFoYSVSsM0dZZudMzI1OXT87m4HZ7WFsPql1XYPuLnZxYeHuQmd6ixqi1u3JbNrxZO9vDqyTQpQ2PhA6RzK23EnWmpLkHziMJKTUjAqyAV33xXXS+FF54kyTnaisKgO586XIDBmHO59aiYUyt4m8ITzR44i6eBe3DEjyKiI7AenT+ejskGJFY+v65UVldBYV4c9n32KuTODe2VepGQCJ04XYuUvnuqlDqvNvwBLWc8/k2ov9UolVj1tDFPUtxq5SvlHRyubYYYZZphhhhlmmGGGGWaYcSPoIrbYPLFJo+2YTLZUQOEQCEsrK4THj0dKahZGxxlNnZX6GpTkZMErKJj/T+FDd9y1Avu2fY47l0R1qaeI5JoyyQfffvAB7vnFL2ClVnfvVKHAnQ89yH77EJqkIsSP7Tag74SfryOcnNT4fu+3KMjMxPSlS6FUdStWaHtz77kHFcWTcXTHTjY5v4ioSA94e9mhXdM7sSFN7MeP80d4uDs3qf7kz3+DT6AfxkyZCs+gcB6iaOERD5VzBPfgOrTrMBoa2rDszpiuMEyF2gWhsV4IDq0RGusb4zMyKuMzMitee2WN4zYI8gf5GQ17/n7GoDXJWblF4Oqg1baPQBYjISDeTeUw3tXN0TJ8bDzipkzj4Yb6tnqIlvaQ5XZOaun1xgyGXj5GtR0nM/Va/p2/nxMCQoPQXpMP1kyg1ehBbSph6kTIVh7Q5F3hPksadn4otNQ7OAGN2XWAroF/R+byUd5ucHa0MGZGVEg8FFLXUgl3v2DY6VxYVevQ2NSGxopcWDUWsYOQEBVsi+iwyWioKhePHM20yc2tvsIawaMjXL0D4sVVokqlsJsDWXjQ3cliSXCwqwUpH51d7Y3qK1ZXenbs1K6JpDp4KAtV1c2Ys3g6LFyjIag6BEuyAWV5mbhw9DCKcvIRHOyCRQujYKNW9dknkb5EImVkVuJKRiWcfUKx5JEnYefo2GfZ1qZm7P78c67UXHZnFPfQuxp0Po+dyENtsyXufuxhqCx6q8o07e28D5iQ4M5DUTtBKrF9+zOQOH9RL+K7urwM+sYCoIN8S08vR0DkaNh0+HVR30TQ6vQwwNA8tBo3wwwzzDDDDDPMMMMMM8ww48eG7lBEARWtpHRysoauuRwWlNpOVCB+2jRs/ONpPrkmtYVKJSH7yil4+Ad2mcMHRUagOG8cjh5PwfSp3WFKPt4OiGpsx9b3P8CKx3/WSw2iVKlw58MPYeemT3H4SDamTA7iIWo9QRPzJYuicO5cIT7905+40svNx7fXMpRFbfljj6K8qAgXjx/H0S/OQMXKSQTM1R5AlJFv4oQAJMT78RCo/V99AVmyRFziRIRTqJOVDbIL2nkGtnlzw7vKo3AIgoVbnFFOJhtg2d4Ap8AKJEwusyjOzVuRnl62wkKlKHx5rcNGrQHvb/i0LsNE52dYsYFHoIrrLK2U06dNGQXf4ACoHT0g67XQl53gBvHtba3cEF4UjJxdZlYV9AYBtRVlUPvIkEQ92lp1KClrQmurlhMxCqUCRJGWlDbAoJe5isjW1geko6utbeUG40W5ebAPmmxcVitz9Q6RW5q6XKjs/XlmxLr6Vh7iWJCahFGJAVBYOfG2WV/Xhk83J8HN1YaboZN4p66uBWVljS06neHdRn3971/50lA/glV7Xby4yj5SKYkPWVk4rvb3c/QOC3NHQMgoqOw8uPE7V2AJ1HZlaCpTuJqQCNa5c8Owb186rmQ3Y7S3DXTtLUg/fw4XT5yEYGhFVIQHJsWP7tPuO0HXBLXtb7ZcRtykRCx66J5+CS1CfkYG9n35BaLD2TU8Kfzq5IYclKHywMFM6FWu7Bq8rw+pZdDr8d1HHyPIR4EAf6dev506nQ9HrxDETJjQ/aUsI+/iUYT7K7vKezmlHCt/uabjdwP0TWX8Y2sLtUehfODaNsMMM8wwwwwzzDDDDDPMMOPHjJ6KrVya9HIYdNA1l0Fh68OVUZHjEnHp8pUuZZWbgwGXTp7E6MmTuzZERvFb/12Ky5dLEBPj1fV9RLg7WloKse3Dj7D0wQcgKbpVH6TcWnzfOh5SuGPXBcyeGcIm8L1DoYhcGjfODz5lDdj2/r8QkzgFCXfM6pVxUavRsPKcQkF6CiLZ5J78tb7bnopJiQFwde1rw0MKrtBQV/6qqmpCcuppnNizFyFR4SgpKMKUib5dpBaFZFq4U1a/jpm9IHKPLnopnUIxynsiAsaUoa2mwDcrJe0/0q6UvvD/7nM6rNcZ3tW2NHyzYauh5QbPzbBjg8FgeHGRuBQOdv86fiJ3ZWh1k+Dikgs6ViKKKONhXV0raooy4eDmwT+3KrwRHq7DleQceISWcNLr3PlShI5JgKE+B/mXTsIvMg7t7ToeQjZ1sj/OHj2L6XcZCc/ktGpExgQhN6cMwbHp/DsKtYOoQkiII84dOoKJC4wKnisZ1Ygf44mU1EI4ux+D2tEdJZmZPLSUwlWPHM0m8/kjsixvYS04W9veeGjD14a6karP6+GF+aLawdluhQDhMS8P20nh4Z5CWEwEbN0CuUeWIPXvn6VyjYa+pQqGthqIgsCVh/sOHEddZRmyUtLh62OHqYme/SZS6AnKOnn0eA4ovFFvkJF54SyaGhowd+VKnrG0E3Qt0fVYeOUC5s7sP0EDoampHbv3psMrOAYz71rW63okUPbEnZ99BnuLRsTG9PbsIs+sshoRq568u9f3WSkpsJEa2CejH1hqWjmCYuJh62D8n9Ra5K9FoL5KMMh51z1oM8wYAKsEUcXuajYG9hL4oxy06IHGN+Qfb6IQM35c+KUg2rDe14G1XS7RZe1Yy8ZzzedZN7mfTFPNMMOMnzSeEESlGrBlnYG1RFMgdp9jI62mv8u37/zEDDPMGF5Qv2AFOLExgxWNf9k4mMYL7SIbO/yQx8DdxJZsuEJqmk7o6vM4sUWInz4Nn7xxCpER7rCyUvLMdmf3HedeVzb2Rn8f8tVZtG4tPv/b36C2qUZQoHPXtuLH+uLkqTx898knWHzffZB6TILJc2va4sVIPeuJb7/7DjOmBXJfpqvh6WGH5cticPzEBWxmE+B5q+6Bk4cxPPLc4cOQG/OwakUcOq16Avwd2T7zO0zJva7pDeTiYsP2GcyJmPSMCjTVN6IzJJPXi17DiQXJmkLv+spWBEkFhZ0fbNgrznccoiYVitUFaTNSL2XNYNureHmNw7ta6P66YVNTyYBnYwSwYbuhgZ27e//7XryZdL7obnbEsez8zI2JjxSCYoPhpCzFmeNJGDc+BKnZ7ZiybBayDn+Kpiag8PJRVFVUwydqCvTaVviG6LiCx9FBiVNnSzBm6nR4utWQkgq55w+ioa4eAaOnor0mD/YWapza/z1CQ71Q2ahGZEIYRrnV4cixHGSdO4C2lmZEJs5Ca+0lTBzvj0P7TmP6jChcTq2Cf2gIa4cGkNIpK7s6RBANG3+zseG2VO+8vMrGW5CUT7l7Oj8SEuziEhk7Cp6joqG094OgsBxwffKUkvXd1yWp2lpbWqEW63H3XTFcQXktkA9VaVk9Ll0qQWubDokTAuDpaQzpm5wInD2XjzMHD2Jqh9l7cU4O9n75Bfy8VLjrzphrKr/Il+vQ4RxMmLugF7ndvV8Zez7/AlJbKSZMDur1W0FhLS4k12DVk09y1WbXcbW348KhvZg/y6/jOPVITqvCmmce6FpGW5fX9ZnCVg2CkHbNg/8J4zlBjGI9VeBglmVn+PSrsqFiqPsQBVF4DpjPmti1G+BVYGXSvwHsMsgjk3jj14LoKUGaLUCeyEoTzb4K9odEmTWFngdBn18QlBWskFmsNV8SIBxpgX7/27KhbCTKfT28IIiLDP3dmAYBdnw6NnjZZeoydYK1wxhWsL6ZKAaB4Sjbs4Lox85trCm2xY4r5zXZkGqKbQ0WMwVREQ+wtitNYfunFLGhrJ6CrCH1m0QjgVUja8fVbJlitnw2++qCHvpT7cBx1pabTF0+Nki2ZwWZaqLNVb0uG06aaFs3DdZ3RLC+sv+sKUMEG11e+qNsKDDFtjrB+oFE1g84D7wk7/PlfNYPb5YN+oGXHjxYHY1m2+7rK9IXhezcXjTlvq/GUO6BpgCryDPsnN4WY1B27GyiKs0S2X1OhhDH6iHEDhKdF7HnfY5Ggqx/qKH7HLsnprBlj7L+Yf+bsiFvZEp+bbD2PZO17+s/vR0YNPDQsTZKCo6qFjY8/qtsqDVF+UwFetDmC8y90fXZsbWw8dx+U5apJ1jbSmDtyWPgJftFM7vuD5i0QDcJdjxE6MwaeMluDHcdDxfWC6I/6xdmypDHszFttGzsF0hF0jXR69k/sL6BSG/q03LZLSOZ9Q9nBeiPsmPPHabyTZE7VQ03iS5iS6cXL1RWNdGEgw+S9c2VMGgaIKrsYGFpyVVSZ88dx9QpxolqVIQzdm7ahOWPPdalwqKsZXc98gi++Ns73I/Hy6vb1Hri+ACcOJWHbR9+yMmtq02qIxPi4eLliZ0bP0FooDU3yhauin+iSfyM6cE8W97X//w7YidNRsKMWagsKUFkkDOsvBNYuSu4CTz5+SyYH4GKyibuq3XyZB5GjXJBcLBrv15BFuy72A6lWSVbx7uj7LKuDW2FR7hyS2Hvz0ms/tU14N8rHYPhwV6uweWYUJnuln457bcXLxU/+8pax3fqW+pf7Mg8eFuhI8PjqRdXOWaqJOHdyEgPYeZdy1GYeQUuynYUFdXh+32Xcefau9He0gI3NzUC/B2w7btk9tkWCUtjUZCSxJVwVIdffn4aM5cvh6W1DRT6eq6u+vLri/D1c8HsxaORe74WbBMoKq7Dgf2puJO1mepKur/UYXyCHzZ9dg7hMWGYvXAcsk8UwdpahoO9FTZ/dgLjZ86CZ8AoGFrP84QFVlYqj7Y2zZ4/rLa9//9+2jisg6Wh4MVFop3Kwf73do42v2B1YhU5OgI2HpFcnTXQPJTIVF1jIXR1eTC0946orK5p4WHB7Bxdc30KCc3IqEB6ZiVsbSz4teTj09lfCKwNe7NyeCO0sRVnksuhaW/DsZ07kZ96AdOmXtsgnpReZ88WIKegBUseehReAQF9l9HrsXvz5xBbizBl8qheIYzlFY04cqwQy3/2eJcKix+vLGPvF18iyM+q65pPOl+EuEnTYG1jnLNRNkR9czevUFXVrNfpdZeuV48/VYgQH2M3rl8NZlkD9IvY246h7uM5SA+xM/Xe0BgV+SWDrNs51H3dDB4WREsXSKvpowISpd4UB8kDubGl3NiytM4T1pD07Eb/PesoP2iE/su/y7eLn6K0bbAH1B/YwC76DdmQYsoSdUKC9BF7Gz3ggv2D7pN2JiwOG+xIc1lF/csU22KDwzfY2/Om2NZAYJO6CTLEnyVAWo6rBn4DnHj62YX9oadyJDtfzs4JzQ7bWVs+yNryxtdk7cemKie7awSzgfM2E22OJg5DmnAMJxQQH2LVud4U22Ln43H29k9TbKsb0v8Th0Aq+gHPsAAPFjYAACAASURBVLc/mbIErI6eY0e3bqDl2LXzb/b2iCn3fTUkdr2wsjw9nPvoCRH6Zext663a39XoIL2XsevvUXaNz2RfKamlDeLGQGqN8WxZNtnFQ6yPlNcLyhPs+w/Zfe6T20fRJb0rmpioJNdnIvbYWyprlSfZaOhgFfD9v2VDmyn3MxT48/79pvpQ/bOC6D0cJKsoiOLzkLawj943uIks9goxYZFuGuxauZO9fTrE1Qy/FkSfN2VD6XCUyZR4ShCdLSE9wq7t+1jfQA9zu3qFQfQNRCQHGl/CTOPyEl0zGex6+UoHw19MWwfSGyLvi24eXQxPKupzrSulMr3e4GlUasjQ1mTBwmMs/528cC6eOEETSri4qLl/VkVFEfZ99TVXT3WCTMHvfPgRfPOvf2DmdAmuLh0PE1mtJE4MwBk2Mf763fdw54MPwMLKqldh3Ly8sPqpp/H9N1uwY2caJ7HU/Rhg+/s7wcPDDidOXsKmi5eg08tQjPLi/k4WnglQOgVDW3UFuuZS7sPkxrZDCpDs7Crs2XsFNmoLhIe7cRXY1eQZKc1277mCuFjvXpNyQ3sDNBWXoalMhcLWEwr7wGuquAjklaRmrzi3CIRHX7RKvZT53PETeYtfWm1/1+8+rR9xpcmLoii+yE7yhpVQSwrbeFEWl1tZSOts7O2c4hPHcJ8nG1Ubf3ROYZk2NhawsHGGrlXDvc9IDURZECOjfVk9SbC1YU1JY/RFovYRyM5Hc5sIodqoytNq9QgLdef7tndkfbemnm/HwcESFgoDHFzYb1UZ3MeNlh8VaBy/O7h6sI2WwtGBrjEBkaF2ULn7oS49BRZKDfz83RA0elLs4e3bz7281nE3DPImrUH/Pb5orqBQy5Go2z+ssouxcnL8Kj7eJ2TMuHBYe8ax9jDQQw4ZhtZaaOtyoGsqJoOqfpfKyqrC9Gl9HxwTN1lcUo+0tHLU1DRzApeIXSK2OCiLIiuD0jmCh9FqKi5yc/6qslJ88uabCPS15orIa6m0autaceBAJuw9g7D22cdhZd334RmFMW7/ZCPUYg0SryK1ampbsO/7bCy6/yG4eHr2Wu/k3r0QWosRNs6YkIK81QpLNVi3pnucrq3N6spYSm2vvKIx98Uvmss3bL52jZoxPGADJ3clpNeGuNrZBhheHJYC9QN68ukH6UkXSP8BTlDdNOhhFhEjc+0gvcwG///1BvQfjZT6zFRgE8AV7M3kxNYzghiignSjpJYZDM8LYpwI6XVwlaFJQTeFeWybZHBoMmLLjB8O2Ln/n18J4ld/kg1FI10WM24cRDb8GtL9CZA2sH8DTLBJGrbRw5xJ7D73P+w+97+N0L99+zzIMTnI/HUKO2z2kp5nM7qG9YJikxaGN9+SDZkjXbgbgCQZH4D8zdQbfoZN4XHjpNZtCTZ4W30D91ZRAWkle/+zyQtkIjwhiNa2EH9jCekZdnz9KrpvAqHsevkNqwMSFnxm4m2bBF3E1ubNBv0rax2Plpc3ruxUWukaCthEOAwUnU0eOjOWLsWRLZtw55IY3vuNGe2DQ0ey+MR04pw5XRulLGeLH3gI2z54D/NmBfXKhjYuwQ/JKaX4/J2/cfP4q82rSfW1YPW9SL94Edu++xZj41wRGtJ3XkIKKyK+iovrceBQJk6f1WKsTg9f1uSUzuGw8J4IpaYRuvp86BqLoUIzIiLc+au6upn7Op0+XcBJsrBQV1hbGwk0InCITCsta+CKoD6Q9axeiviLsilS9kiFnT8ESdl3WQbJmm07YCZibb3g7m4XtmNHyqFXVtnO/c3mxgtDOE8mxR/WOExQrbb/5g/saCRRcHF2cVAFhYcgckw0Lhw/DntXL84eWEkt0LUbkJ1djVGjnCEorWBlaOwwgW/h4ad8iMQag9pagk5jNIcnZQ95IdnYu6G12qj0aWvTorWlDWT5YWNnC20V0NyiRWVlM1cl2Tp7oqWGNUd2/yRyrKSwFAHjNLB1dGLLlvIQWFIiVRXnw8djLNQu/tDVZsJSZYCHfRMe+PkKKSMla2FWaubC0pJqg2a1ooq15yaNTjd5w+bGWxZC9IfVjuOs1Ra75s0NdwqIiofKNeqqQKfeoPqg60xXl9tHnXU1KCOipBCMmSg7QF5X1Jazsiq50X5EuAf3IOv0iBOU1lDYekNhH8DbK6nBNJXJqMpLwYWLxRD1rZgzO4yv22/5WDu4dLkEl5IrMWXxEkQnJKA/J/nmxkae5dTXzcD6hd4P1ijD6M7d6Zizag28g3r/lnLmLApTTmP+vIiu744dy8XUxcu5Bx8vg64N2vq8rt9r61rYcWsOdSgNzbjFUEJ8C8YB4WDRIkN/360aHD8niFP9IZEyJ2yYdhHAroAPnof0KJscPsgmh9nDtJ9bAIGILZMTjkrjwM+MG8AqQZT8If6nCOm34MoLM8wwOWxVkP7C3u8a6YKYcWN4QRCjn4P0nmAilUM/INXym3aQHlkviA+8JhvODdN+bifYCRCeUPFjVrxtgOF3PzSvITYro3u6yYktCeKP6p7+pCA6qiHNv5F12cRjFW5TYosU3raQNrFrN2jgpX+c6BWTZ5ANu/MLa7uILVJIaKuvwMIjnv/rFxICJ59QpKaV8XAomt9SNr3de8/gsq0dYiZ2ZzijbIUL1t2PnZ98iHmzguHo2K3Oio7yhFpdgy/e+Svmr1kL78C+CtOwuDj4sO+///obZGWnYerkINja9g0BpEl8SLArWlq0OHWmACdO5iE21hehCZNg6RLGzbeJXCDFla6pBPrGUjg7C5g8SQ2d3oC83GocOJTF1SvhYW48ZGt0nDfOnCuE16Ko61aeQdMITcUlaKpSoZWcUVajQFDM6D7Z4chwXuUSCS9LRyxVKF23bD2/48WVjlM2fFGbc/3TMzzQf9ZwRlxt96ooCP8TPMpFFcXOh4sz67ZarqClvoaTUob2Osi6Vly4WAJRIfKshVSH0BitOc4lFbJ6d0F5aTUMbXVsoxquGsrMquSKrbqSLDiHGBVahYW1XAmUn1+FoMZirsgi1U1ZRRtqaltRlHEZgRND2X4sUVVRBxsHZ2RklCO2LA1WdkbbCFLxODpY4UpqIVz8UqC08eDEVrtGh4xLqTzM1MVGDznQHjptu1hcXK+XDfLvb6Wq58XVDqE2FortixbFOPnFTYfC1rff5dpbW5F1+Tw8nWRYopaTTYMBD8+L9ebEX0FBLVKvlPPzQsTs0qUxsLaiOZAA0YJ1azaeUNh4cXUWJx/pWq7JRH7yKVy8WIDGxjY4O6kRGOh8TVKLCOBDR7KhdvLBmmeevWYGxYriYmz/+COMjXXm5vQ9QaTWdlJf3rUSgRERvX7LTUtD0v4dWLwwnLUPI1lG7cfS0RejoiK7ltPUpPOEFp2gY2d3lt2DqjQzTIrnBXEhm3DfO8TV1rNB8ZVhKVAPGH2/pP+UjE+v+5cemhZTLCCdZQOJda/Khu23YH/DgWjyD3pTNphURSwYB9dmDBHk+eEP6Uv2ceFIl8WMHzfYNbpsvSAuY33zlpEuixlDw3pB+TMB0p/YORzYqPXmEcX2dYzt8xevydp/34L93Q5QChCeZWOJWb8SxEU/MGXjdDYmcbsR79RrgcZWz0O6e+AlfziwNh5P35CwQYAC0Miz09ReiTcLdo2uFYxkd/9+ST8R9DabkgXD5culiAhzh4ODkYjiqi3HUWyybAwNI9XWprfehK+vI+xsLbgyhLIZ7ti1h2dXC4mN6dqcl38A5q+5D7s2fox5c4I5MdGJwAAn2NlZYPemDzFm+myMmTKlT+EorJEyKWZcvIQd27chPMQOMdFeXWqUTpDKSqVS4I4ZwdxTixQmp09vRFRsAKLHxcOaTcwlK2eonNnEmr0M2mbom0ohNZYgOETiYVv19W24kl7OCRsit1paNCguroO39yC8zNikW2koh6tSi8NfnIGNexg/nqtDLYlscIuaifntOs+tW5O+fmG+OPnVXYbmgXdgWnSE6L314hqbzzMyKp7IyKxcLkliuEIhShQymFCSD2dBgdzcakgOIfD10UKr1aGhLBNqG2uw5aFTOLM2YEFZCdFQnAJLlYzklDLoZQXPinnm2HnM9gziZFdGTjO8fN1JI4vy7CS4+kcgO6cKATHjIMunkHQ2Bx5+SRAVVkjPqsOE2bNQl3MCx3d/j5nLlvIyF5Y0w97NC+Hhtjhz4BAmzlsIgyygvpFtPyNfPn4yr5ItRqzbZXZCvtXoGj/fsNnQ9NuhRk/fILinlqPDllmzIlz9x8zhoahXo7W5GUlHjqC1MhNj49xhoVdgsJKjyqomHgZMJOGhw9nw9LDF2DE+8HA3htOKVo6cyKI2RsosDtnAzee1DaVIv3gBl5KyjV5ysV48lJgI6n7EVzxs9Oy5QmTnNWLq4iWIHDu2X5UWIeXsWZzavR13TA/kYb89QaTWdzvTMG3p3QiN7e3ZXJKXh0NbvsDC+aH82iXQNXfufDlWPf1M13Kypomr2TpBy5w9V0D5O0YkzPSnDMq+xgYDQ30SuON16P/26rCUqBsUevg8RAqrumfAhU0L8sT49nlB+fTrsvavt3jfJoECEpFQ/2Oq7T0niMFsQjDGVNv7qYB8chIgfcM+zhvpspjx0wCbBP3lUUH8/l359vN+NaMvjA9vxDeIdLnFu7YgT831giLsNVn3f27xvkcSsRaQDr4giJNMSRQNMyQZEnm+mczH79fGMMTBJIb4wYC159U3szob49BY83VTledm8YKgvIcd04cYQkKnHyu6iC1RFIWX19r/cuykBFy4mM/D/DhkGe0Vl2DlS343AqzUajZRXYaDu7dgyeJIPqkmX6T5c8Owfec3PNNZQHh3BIh3YBAWrHsAuzZ+iFkzgriapxOkGFm2JBIHDh1GYXY25q5cycmxqxEaFwv/sFAc27kLX2+5gMQJ/lyp1QnyzCqoqeGfaXI9e2YomprbkZxchk/f/ZKHFPr5u8IvOBhqZ29IajdO1pHRO6mTiORyUhdjgoMaBr0O+QU1yMquwv6DWRgV5AxXtk0iEIhAu8b8nsPSUonEcV4oLinCV++8Bb/I0YgYOxbO7t0kh2TlAr/RszClqjHu4KEMCul5bKgnzVToyNT4e3buN2xYAiuV2v5D70C/FckXsuBTXYuqNmdETxiNErmQh2eePX4e/qweNZZBCAxXwdGhnKvbjh84gbBQDxjUgQgMq4e9HYVzWiDj9CFUVNRj9Iz5KEw+iZgwaxw6nIEJ0CMzrxV3PT4VzeXp8HRT4fCeowgJ8YCjTwRX6rWVnOEm5kd37WS/W8MjKJor4dTWVexc2OL03l2ws7NCYPRoSKp0oTi34L9/s6l2RCaWdO384V77txPG+kaEJ87rQ2qRoiktKQnFGZcxPsELnuMHF6ZOGRCJqC0vb+RKJp1OD1tbS6xYHsfqQsnbkmTrBYWNJwSFkUSVtc2cCGpvKEVJbg7y8yqQl1/DsyHOmBEMpx5hwRTG6Nkj3JZUdORDR8rHwKjReGD9wn6vR1629nYc2LIF9aWZWLo4HFaWvSNmKFSVwg+nLVvB1Ze966MEuz/9GPNns+vRuvuBCanDEhcsho1dd5mo7+n01iJcTi7F6MQJOHf0JBnDfjWoijTDJLCGSOSH3xBWqWyB/pHh9qHq8NOitrB4OPdzHVBQ9l/YwEJ4Vda+PUJluBmYlNgSjUSZGUNEAsQ/wExqmXFr4eME8b/Z+60mSswYIjpIrXcoVG6kysD2/cILgkJ8VdaZJJHCDwSj2MxtI6v/uT8UT002TaWwQZMRW+KPLAzxaUH0soQ042a2IRrDEW8LYouywEqQSE35kye1CF3E1v+stAv19nIYPX7aeHz813Sutuj08jG0VEFXX8CzAhJCYmKQk5qG8xeKuWqEQEqQ+XNDsWPL52xYuwa+wd0G15Q9bdEDj+C7j97H9Mm+3LS9E7TevDnhSEkpxaa33sKsFSvgHxrap6CUmXHmXctQUTIeB7dsRXJqGSe4qIw2Nio0NfcO5yKyayL7PX6sD0pKG1BQUIMzp/dAxfbn6+MI/yBveAYEQWnjDsnGi3sQUahd0YVduHixhGf4Cw9z5+FdZWWN3I9IqzXAx9ue+3LR+7WMtimjIpEvV9JzseODU7B29OJZAh1djGFaRHzETZuFgsLqR15ea7/rtxvrR3SCvnIlRKXC7j+dXJ1W3PXIw9j16SbkZJdj3rrFKCyo4NktyeMq6XwxCsRazF63Fqmnj/NzR6/ysgboYIXFD61B8lHK0N6OMaO98f6HpxE7LhaB4eFc1aVSCTyb39dfJ+HutQtY/Umwd7Rl9WXJw96OHc/EqkcToHJiQy1JyUkXUiodO56L1U/OQUOLgKbiEl6e9IwKpKaWYvXTixASGYrP3vnH6y+vti/67af1tzwzzR9W29/L2vS6xLlzOdHUibrqauz76ito6ssQFuaGJQvD+qgNe4KIpYrKRuTn1/KMke3tOp58wc3NBqOCXJCZVYXMzEq4uTvBL2QWREsnrhakpAn65nTUlBYgP6eItataTiwRMejn58jJRyurvlYtdM3QdUKoqGjE8ZN5fJtLH3kcHr79h1ESivPysPfzzxEcYIXJ8yP6JGCgrKK792Vi9srVvUIKCdXl5dj+8fuYPSOwl1cY+e5ZOvojcmy30EPfVNwrEyL5tOUXt2LNExNRkp066cUVNj4bvmz6IUnEf7B4QRDHsZ7rqaGtpX/sbdkwrP52Rom8+D5GjtTqBF0Ef1oviEU/wNCe2OcFMfR12ZBhio11DKrNGAJ+LYhjFZBuSZZFM8zoDeEp1m998hPxUPrBgt3nXsIIklrdEJ5fLyjZfU5r0qyatzlmP2e0YLhFMSA3jRnsmnZh13TVzW7oxxiGaGlUW92sXUXCrwRx1Eh7rHZYcBCJqR5w4Z8IuogtQSHM8vVxEBWCFvHTZ+DsuROYeUd3Zk5N5WVOyAgK42SUSKZNf/4zmzzXd6mnyIB9/pxg7PpyI2atXAefUd3eZe4+Plj+2BPY+u/3MDZGwz2RuvbNRsLR0Z58Owe++RTugRGYtnhxv2oRypx4zy9+jszLl7F75054uykQEe7GvYb6A6nJ/Nnknl4E8moij57TJ9NQuyMJ7h5s8u/rCL9RgaiuqMCRw1cwOTGQk1f8+YTSCuF6DTf5pol1UXE9V88cPZoDPz8HVm6vXiGWnSDSi3zI6HUxuQxfvPM2Fq67Hz5BxjohtdjM+VOFsg92vPO7VfaHX9pcXznos3YDeHmVjbdBlAKaDY3JLU1oc7IhD2g7L6WACaMVdk96B/hNWHL//VBJOgT5KFi9uUFhaQ+lUNRFiuj0ekRE+kEQJdjZdhMlbW06TJocxhMMODhSGFw7J3DIeDw+weif5uBIZGYjV+kZ/1f3+F4D1vZ4iKNg0HCixMGVEgbo4OKshpu7LRSGBrh5RyK/yLhfUtERQSo1XYGb71Tc9fB9lt9t3Pz1y2scvoAgfyEbkKoTUQldo0EBO1dIcoyurHHLhv09zJpMgFfW2rmrlKq/zFk4SbBwDe/6vrSgANs/+oCdf1fETIu+rtKP2m5KahkPzySyJ4C1vdmzQlkds2uN1bUgWXC/s4R4X7ZMNXbvuoTJjS3wHRWAotw81p6reRIFCunz83XgZC4pF68mnPrutx1anR77vs9AZZ0BUxfeidC4uGuuRyqtY7t2ozAtCXdMG8XPzdUgUu7IiUKe/bCzrXeihl1f377/HmZO9e3l60WqtLSsJqx++pGukEfyHWsvv9hrfSKXx0ydDlHW0PWsKC6um8G+/uS6B2nGTaMjRIpunEN4GiS/96psGHaS+Xmjwfaa4d7PIMEGStLHzwnixDdkg8kzDQ4nRKPZ+0s3ux0a6FlAGmuCIv2koID0Mm7uaSul3aYxBFkb0CDNveNlfoJrxkCQBEj/WCWIEzbL10jHbMaIwuidI/xmpMvRCTZKe/15QUx+XTZ8P9JluYWg+v+hEFtsbs/DEd+92Q09D0xkb9d+0v0DxA1mQ+wDCyNB9ooJNnXDeA64syOT6Y2CkiPkszppoH/YtogsIYXGD5Yo6ya2gHiaDJMReNykRJw/eoRnYeucvBonmhdg6T2R/08hh4vvuw/f/PNvWLwgrMvYncL15s0Jwa7PN2LOqnW9sqBRtsSVP/8Fvv3gA9Q3FPGsij3n0JQ9cdnSaFxOLsEnf3wDiXMXIDIhvt+JNqnGgiIicOnkSezatx9tLW1c9UMT5utN6B3sreAQY4XYGC/uJcTVXIW1SDp/BO3tWixfFgcHRxsonUKgsA/kRB6RWvrmciiaShBiXcYNsmldClfcu/cK26caY8f69Arz6onAAGcoLZTYsfFj3PvLp7tMuO0DxmHK1Gy3Pbsvv8n+vW+Q5+yGIAjKaEnEDjvRXm/viHbKl6e2sbLw8PPn4ZLkjWZoLkVb0SUePhgzJpQnNbWj08+GymRYTh5PFtbG9sDVNi1GP6Y2Vm9yh0DX3sGGXSZVbHmZ+2t1mkg5ONkB7Y18O8bv5Y7v7QFdJV++qbEdBm0L/97RxZVtvJSTNaQAMrTW8CyMjp5BbDuFcHSwxp59V+DubgtnHIW3XxweeuH/iMmnT63KS0tbVVNRhtYWjSwrHGWdzsAmnEIGbLEDxJaZELIs/mn8+CBnt7DJMIo2jBkCd3z8EeJGe8HLw+aapBaFy164UMzbH2UzXLY0hpOIAiWTVbtDsvU2ksmiErKunfvdhUhXuIpry9ZLEI9lcXKPVFkJ8X4d5vGDA4Uhkq/crr3ZGD9zFhZNngSF8hrrs3OVcekSju7YjpBAG36N9qdWJG+71IwG3P34E3Dx8Oj1W21lJSe1ZkzxgYtLtxcXZbo8cCgXix98lKsyO0FJGSgbYicaWdsoLNNixpoJ0FVd4mo0Vt8JMBNbw44ESOzeidFDWCW7BYZnBl7s5rBeEKewCdnNZPSjSRyZ2mexRk4pSRUyBCIDogUjKTBkUGplCdKHMwVx4n7ZtCT6MIPCB2+a2LK4jcMQZejPsMF+1+RQgBzH/g4qEQK7W9EEbl/3uobTpirXs4IYpoQ09wZWpfvZx+y49vX3ZP5XgmghARGsPU5k7ZLSVi9gr75P4UwENjoutjJO/jhY/bKbuPDrQa6exur4o+51kWfq8t0M2KhlJ+trajr/Z+Wbxd5mD2ZdGfJmtkZXFmw99CZrOyZEvL9RkfvWSBdkBEATusFl8LkG5Jtc/3ro8Cz8x01sggbb7B6HDPaxGvwBjMCuTZCc/kYJC4UI6YMnBDH677Lh+um8by30bLaWcPWXopHsd2LXMN3bZ7DP1N8OifRn68WwMccY1teeN01RhxcdCVxumthitXfb3tNvBB3X00CZRCmDN/ULztdbqCM74ogSW8KQIyk4ClnZ3xGg/y6f3XuvfqBBKrBfsb5BAYwVIE5n4+Klw51lkZWHrIS+6fHVY4Pfp/wKK2ND53/d5vEyQhwcrLnZtIVSgUnzF+D4ge+wZHG32kTfVML9exQORrKKvKPuWL4Su7Z+jqWLo3hYGsHWxsKo3Nr8MWauXMO9rTpBhvArf/5z7Pn8C+z7Ph3TpwVDperuX0jpQ5nfKPTqxMm9uHDsGKYvWdJL/dUJSaFAW0sLKIt88ChXHD2ey7O9ubnacvUXeWuRCf61iK6eai6NRo9vtyXD3t5IZGmq0qBrKIbCzpcTDIqOF2Q2LGmuhKKpGJGW1jyTYk5ONfYfyOQ+VHGxXvD0sO9FZlix4aWNjSU7Jicc/PZbLH3gAf49kWaRE6YjPa1o7Sv3On7ym89qhy3TG237lbX2jyuVyr8mTgywiYgOgNLKwaiQ0TeiLWcn9xcjUpFCMceONyYBsJB0nAkipRqFxrW3tXUckwDioChUkEgpIi5cZRnWaitoWsk4vJWTWPXVVbANYMtbWUDbDtTXt0Kj1aO5vgaWXux7tTV09UYlXWubFtWlRfD20kPt4ARNZSlXFFFYXXVZMavXBti6+qOtqJC3GSrPtu0pmDNbB0/WbgWlNaKDbRAdGs9Golo01VYJx45lCJmZlakauX3Rhq2GFlPW6Uv3Oiz08LC9J37GTL7vThzZvgP+/vac5KVzfzWqa5px6VIJ986iZAjsfEChYlNCtQcUNkYyi5RaBJlVsrYuj7XFQp6pkkBt1J616zmzw3p5VF0PpAorLW1AUUkdJyiJQAsNcUVhUT2/huha6g+kPDu87Tso9LVYMLt3+GAn6BwdOZqDZp0NVj/9NKxtepvIU/jhtvffw/TJPr0M5nU6A3bvTcfkxct4FtWu79mxEonXEydP5SFx3kJeTk1rVcd1jRCYMazoUOBsGMIqrLvQ3/e2bGgatkLBmD2ODU4oBPFGFCmUAfCPrIf6+i+yofrqH+mm/gwQJ0F8VIDwKIaeYSY+HhJN6IfbM3+woMHCXQMsM5oGfG/Ihqyb3NdAg2CKVb+hFNs3i9dlA0lAu2Sg6wUlPbUdZIZP+dhrsu5/h6NcSuOT9UE/QGYDwHID9KvYuTp0veX+JBvYHRcXOl5/p+QPVpDWsB2xMSsir7fujaAj7LirjtgkMFwwXgeDQdZrsnZY6tcUYG3nAHs70Pn/C4KC9QnCoIgtttw2dmwbh6lopsR/s/7+yx9YBribhgz9va/Jhp0jXY7+0BEGRt45N6KeoMnrH9mM5bM3ZUNpfws8I4ghKogPsTb6JPvXrr9lrgMfW4h0zf78Bso2XJDZsV64zu/0MOBVCr1nfdP7Q1W6CMYHELcDsTWYe/pMdk93YveJmgGWuyY62t9te0+/EQwyqzf1gZfY687rLcTaT9xwZJUeLOj8snHwtKGtJb/WDsN/dowP+kWHl1xBx4usNZ5l18wkEeJT7KhJ3W9yJfjrsvajnv+/ICjJb3RQxJYehr+ydl7c+X/XbFahkjwt2CScQp5ItRUxdgwuHj+OrOxKhAS7dm2gofHaYQAAIABJREFUvfIy6lsVcPY0Ev2joqJQXzMbu/ccwMIFkdybikAKrgVzQ7Dry02Yduc9CIzoDtMiZciCNatx4egxbN22D3dMD+ql4iAQKUAT9zI2+T/8zSewtPfCpHlz4eHX7V1ME+aMc8ew6p4JbL8CN4InBVF5RSMPzTpwMIsrQijckHyv6EXm2/3xXESU0GSf1EGuHZNvg6YBmqoUoCoVoqVDR9Y5j64XzzrXUolwxxKMCvVGYX459x0r92ziHlNdx8vqhPbp5e2I48fz0VBb26XaUjgEYOrMMULxxkNvP7dKjH1js6F1MCfyRvCbjfXv/uNBx3kpV3JWkKcRKc+cHNUQRHD1DhmH1zXqeLbLkoIiOIZqOZlCdZp0oYyTKDnpefCKqucKIhJdXU6p4ibuKZfzEDSmq10h9UoFV8ddvpAOz4juKMuM7FpOYlxOuoKpAd0PVvIKm2HvaIeks9lwC8wkPRn/nkLbKGHBmbN5mOuWBCvfRFCB6RxTHcZFOWHP3nS4u9nwDJZ0DonwKitrQF5eDcVPfq2pq39ow3ZDA0wIdq6sXFUOf54+K05QOXUTt5T5sDgnG5Mm+9NTfaiUva//tCvluMJeRGhNvyMSKjsvTphK1q48zwbBoGnkCQ107GVoq+lSt3WCyEGa3VyP1KKwWVIj0nVAdUWkMxG94aFucJ1swxVXgqTCeNbNf7f1DMpjonv5alWWlOD4nj1orMjHhHF+8PLy6Hc/NTUt2Lc/AwFR8Vi4eFEfgoy2s/2j9zFjqi9XmnWCVHsUAhkSP6WXuXxlSRHUzb3HJeQ3phEceGZFqhuDpokr+SxUiv4LZYZJ0DGo+TuGoPKQIb/MJgknhrFYHJJxwhw84IK9QU/Vf3MW+j9fT03VcVOnRvhLNvD/kwoSTUrHDWVHrLv/3VOC+F5/xNmth5zMSjTQILjT9P2GyYUXBDGQnZn465YEcpoA4QczCL5FmD6EZdndWL+QDaSThrqTDrL5n6tYu/SDtI610d8OdRtm/Khhy/q6v2DgCbMZtwjPQaIw+6lDXI3dwOTXDTD8F5vsXXc+8ZZsyGRvv/2lIP7Z2kigLRjKjlhf/th6do9k9/wrQyzjiIL8JJ8TxNnsnneQ9YMDqXd64rr3t1uHQd3TlaLxocm/b3Qvzxvr5noJg7SsLFlDeC4z4hhkNsRMdg3lCIM4LgVECke8mciBGwabMU5GT4HSgJDfeVXWvXAj+2LXzHH2dvzXgvjfCki3tbKXVwhldXvzYRd1p7G1rrEIKktHzLp7Ob7+xzvw9XWEZYcai8yqs8/shXr2vV0eWGOnTmUT+hbs3nMG8+aGd5FbRE4tnBeKnd9+Dk37nQgb3T2BJRXVmKlT4Onvj92bP0OQbx03ub7aXJtM2O9cEs3DtfZ99j4s7T2QMH0a/MPCoNNqOYGm9h7DDeCJBFA2l8HPtgI+PnXGjI7tOpSWsQl+ST3PqEaZ5Sh8i0guMiGnMnZi4sQAHDyYyVVqPVVkNBw3tNVCw16oSoGoVEOy9YHC1guStRtX2KjcRiPEuxpB0UXQ1uWiKwYPRlGUktWJRmuAp7cTcq9cQVxiYuevcA2Kx9jR2cGnT+tIxv97E5zXfvEiO9ExzzqOT1wu4rt/tRrSLhaKrDrg6g+011liwqLlqK2ugbOiiPsZhcZnQ9fWgCPH8hE+fgqEulRu2h9beJG1B2Po2agxk2GbeQqtrRpknjvMiU7yTLJwCoYvu2fS94WXj8LTzxeFhXVw9o+FqrYKZYWZqMg4CSc3V+6tFRibCIvsNFigHqmnjiBywlS0tGhQ12qJ6PETYK0vwKmjFzBplhqC0haFJW2YumgxDFXncM+K0di/5xxKymtRkkMTcsDOFoa775fEw58IBc+ZmNQiOCvs/iM6ynOUd8R4TrR1Ii89He6ejpz0lDoIzZ6ICHdHzIQJUNj58KyGxnVZ+2qvZ9ddCfSNxZy8uRZIBXfocDZvqz1hJPMaWTuv4++0WS9PewQGOhkVYXRNssKIKjtjmCORs5ZOnJhVqy/DoNdzT7Si7GycPXQIjZWFiB/jA/+JMf0SwbTspculuJxahZl3rUBIbGyfZUry87F700fcKL6npxaRWqRwdAmMxfiZM7u+17a3874lJrw74ympuo6fLMCSh5/gfQb1TQTqJySF0JsNN8OkYIPq+zHIcBsC6/FOn4PBZNn1roUnBdFRPXSj7QY99IvZQP/IUFaigf+vBHEqm/B9zi6DpUNY1c4SIg0gRjw1ugyhhZWdMuB6XW+5DtP3m1DNcGLseiPBUoEHsJtxFSIGuyAbbH9+I6RWT3SEHXz4hCD+0JIcmDHMYNfnsvWCuOwHmADjRwd2fSrZaO2/hriaxgCse13WfTGUlUhtKQri4uchvs1awVAUWBIbVdKkftXQijnyINKPTdJ/zibpQ0maEDjwIsMPdk8vYtcqhc/0DaHogY5wxBsmtmSIKwegdlLYuM/yh0JrPS+IcSKkAdXK7D6bJJB9zaAgUNsfEWJLhhQxhLrXtsJw0/wCqdNYXzH/Z0NXeN4yXMX0dRBbDYVQuURxo/ao8Yk4fjy5l5F8kJ8ax7ZvwawVq7vMnifPm4sjbLy0c9c5Tm51EkNkKL94QTh27fmWhzyRf1dPePj5Ys3Tv8KRnTvwzdYLmDIpkPsmXQ0yeKdshqWl9Ti7+2sc+laBoKgoNDdpoKnJgKWVE0QrZ6jYC6zspN4ytFZD2VKNIIcaBATWc1KupUXLt1FUUo9z54v4EXt1kFykaKEwSPJumj83oouguxoGbTMMNenQsheFExJBIVrYccWN0SOqb0ZYiXX/xG3b2ihQWVzS+zcbd4ydEI3MzIr1L66y/2zD5vrU6561G8UMiKIkKCkk0NVNEC3UArRt0CcuFaXMk/4IHTMWx7/7Ep4hdsjNq0bmuWPIL6hBxKR5aG/XwMXWgWeVPLTnOIKDXdGu8MTo2FhoKy9h7GgvbN+RCrWFjEtpjVj0wL048U0Bxo7xxu69FzFtagtS0spw5xNrcXb/PkT6B+HA3nOYlBiEgqJmLF00Hi0NVYjys8PefemwtT2DixeLMGnBMrTr2HmorOakztnDJ9m5ViEwIpJn3Dv73SnWNhRwZO1szFwt9r5nkAPjBKG6RBbJskkQMbhYvSHgxdUOoU52lusnTo7moYM9UVFcDBu1sd0opP67HAovJFUk+YaRKlDP2igpJQcCEUIHDmbyxAvOTtYoLKrjiixqz/SbBxG23vaIH+trDAtm7VG0sGft03htUDvlERSd5dC18TZMflvZKcn4/qsvoRLbeDitz+TYa3qDUSjjkWM5UDv7Yu0zz8LG3r7PMkTwHfxmM+bNCuahk52gc/j9/gw4+kZj2uJFvdY5sWsbQrx7R32dOVeI0LETOzy7ZGjre4Yo3mxSEzOuhV8JoqsFpDeGsEqzDP19t8JXSg3xafbmMIRVtAbolw2V1OoESbZZfdzD6oNCvyYMdj02MPoZm5y8+HfZtCHQQ4fMbqgCDd6vS2wxjH1OEINYPeXc4I4GyoZ4mt0Z7X4og+BbiCEoT4VTptrpbeaNY8ZtAgHSXx4VxO/flQ3XfsJmxrDD1qjWGooqmSYej7wua4dEanXCIBsMbML65POQyF9y+eDXFO5+XhB9X5cNhTey35EEPSRYLygvk3/WIFdxHNYCDR5W7GRfGoTabBY9CPyrbKgd6g4GE4YoQz4tDG0sNqIQIQ5GrcVgOMim63nKwUXcRbwgiLGvyoZLN1O2G4EA2XMIarksU0UQdEQ13LbjB05sGdis+M2HXVtIhUGqCJrw6hqN/lKJc+fik7fSkJNXg6AAJ74ShXuppSqc3LcHE+fMM26JrTd14UKctrTEt9sOcXKr01CeJtkL54dj7779aG5s4Nvs6XultFBh5rJlKM0fg/1btsDOogzjEvy61u8ED+frIKEaGtpwJT2LezN9vfkwPDwvwjswEF6jQmHj7ANRZctVXPTikA1cCWPRWgs7z2qERNTwkCby5CopreeZEk+eyodSKXK/LSJpIiPdYaO24L5CRND1q1zhdVVECf+uC0mkSbgelhYCyouvblsCrNzCMWVKnuW27al/fVEUZ21gJ2Vwp3DwSHWFHFAl77x8AA/7x4jQa2W4+QtS1lkDPEONoaI2KiJY1DxL5aefJWH27CgER0cj9fQx2LDzYRNogYsXi5FGJNWD89Cm08PBwRKWlkrExnrhux3JuOeRe6FQqbiRPNXb2NE++PKr81h1TwIUCgXsHMj7rB1xMV7YsvUiVqwYyy9NBxc3VsdFuGNGCLZuS4aToxVcnJSAtS8yC44jOsoTSeeLcPxEDh56LIQnMLBzC2DrNMPGxgE1JZUImygI3qEC9/M6tIk1bL18XR+SoYLUjX+41+4vUyYFWqk9InB1o6irroabg/E7Sey/w9G3VPDXYEBtkdpoU7OGhzFWVDTyz5RFkdSMpDwkIoquSVISEoElWjlxNZZoYdsV3tgJImUbygtQnJ2OopwclJXVo66uFW5umZg5xZN7V10L5NN19lwhisvbMW0xKTD79xNPO3cWZ/Ztx8K5Ydx3rhMUHklhowGxE5E4Z06vujt/+CDQWgw72+5wyJKyJpRWyVizxiga0jeVQdY2G4+D9asG/UgTBj9eWECkhBbXNc68Cs+RvH+4ytOJjgyNjw1xtf/s8Mi5YRC5xQYvq2VINJgcrFLQwdaYbfDDm9m3CaBmo5CzrNxLBlqwIxxxyN5gvxbEAAWkPqa9PcHKcJyVIfx6y/zU0KHKuO5T954QBnhCb4YZJoCPI0RS3g57AhAzrg12rT8+lOVlyP94TdbdVDIdmrCyvvwR1pfTAxzvAVcwQhIhPsLe/+tm9j1SYDPes+zvYImtofptDhfU7IyfYeUeiNhSWUEin6gPhrqDZ432C/7XW0aGcEIY2FfztkAHUTegvxYbpzSxGfqhf8uGthcEZR77KmDgdURSbd1yYouV1WawtJZ8+7TdYUeXYkur1VfqdIZRnUorbW0mD5ciP6z5967Clnf/CXdXWzZRNWZOi4nyxOkzaUg+ZY/oCRO7NkihRfZOTvh26zeYOtmPK60IZNQ+f144Dh2+gF2fVmHOypVs273FNBSWuOapp5CalISd3++Dh4vEFVT2/RhWE9k0fpwf9xsKCGCTeDZJzs/IxOmjSSBKyNPHHR5+gXDz9Yezpw+7um25eoVeio52Sqouy9ZqOPlVIaKlCs11VTh1Jg9XrlRwXykKkaMQTCLRyNjcztaSq8lIFUNZ2frLDHctiB2LEgFRV9XXm1Oy8YRvgA/CQipnpN2rf4h99d6gNz5ILLJxeG7cQvHh1iYZzl5A9nkg54IB7r6enNhqqq9jdW48J5WVzdzHKCQiiMuebK26eTZSvZFqSGJdpr5FxzMUEsgKirJo2tsb/7ezt+l4t+Kha9bcE0rgXlqQK/l5o0ySFFJKCQAcXN3Yxo3G8C4uajQ3tXMixsLCAmpH9hvaueH56TMFqC4vhdpfA2efEMht5xE1LgDH97ZCVDSycy3DxgkIHC2KBcnCpo8ecsy7//1ak2Qiemm13drAQJe5QSGUTMCnz+815RUI9Hbjn68Oqx0IVEfkWUVhsxROWFPbwsMqyReOe8eVN0LPGrevjwNr+/6wdXKBaOXC/bkkK2euHrx6e21NDagsLkRFUT7K83NRWlTG1YNEipHCy9/XnofoTpxw7fsXZSSksNPsvHrETZqC2fdPh8qibx8pywac2rMLecnnsHhBRFcyCQIRcgcO52LivCU802lPpF84j8rsJEyeFND1XbvGgMNHc7HkwUe7fLu0Nd28CSm/NBp9JcwwOdYL4jwB0rrBLs8u++/egP6ft8IpfazRpHSwA24q28UC6F83xb5flQ256wUlZcAZdPZAdvnSU/cRJ7bYFbN9MH6fHYPUIZ9KceAwRPaj/hBb8jbxKLk9UMvmkkPR88vG7IavDVd5zPhxo4NcHtAwW4DwS3Yf+Pg12TCUMC0zTIQXBDGa9deJAy/ZhbJaGG7IO+dqvCkb6tiEnrY1hIQHAt3n/ssU+x8BDEXFMmweyEOBAJlNsoST7OOTAy0rGu/pHwx1H9IgsiEaoD/I7v0PDnXbI4FnjP3edYk6Ausf9xCpRZ9lyNtYXzhg1kG2DPls/e7mSzlkDFoAw44rkJJFdPjq/ajRNfNkE8X85ub2iSqVkZSgUCkysCbFE5lKJ9wxC/sOHMWShRFdE3ZSVR05ehTWNrY8LLATpORwcnfHjk8+4aFSREARCUTrzZgewv2bNv/1bSxadx8cXFx7FUgQRUQlJCCcbSMtKQn7Dh+BWtWOyAh3+Hg79CELyC+LJt5jx/hwsoWg0ejYRLoJleVZyE29gLpa1hexST+FM7l6ecHN0w3Obs5Q27BjFRUQLR1RVlqLPduSERrsjFUrR/fJpkgKESLRyMw+NbUcBw9lw9VFjaBAZ/j5OXLi7nro3BbVAxFqzY2NUNv2DLkUoHQchUmJdSgoqnvtxRU2uzd82WTS7DR2zsJSV38BO/5mwMSlAuorgGmrRKQclHm4mtBa1kVcFpAflrMtJEujytTWmrInAs0tGv7iBCirUwuVDnpLWkfm54GIl04ljr0DHV8zJyGI9NLpjSGa9o72QEeeDqrXpiYNZG0r7J1doW81ek5ZsO2Xse0Z2o3J1RzdfYCWbK4AIsKkIL8aPjFVnLhsyEiBJGqgULUgcqqAlCMynDyBywdk/bhFgpSXLCxkm7hpYuvFVbYedmrLN6dODoLSIaiXtxaBMka2tzaytuDJ/79WKF9PUN2QyXtubjUntIiw7VRhkS9Vz3ZFflM1Nc3IzqnG11suY/bSmQgIZedNUkLf3oiGilJUVVSjsrSch7tWlZVBMLTz7bg42yDIV42J8dFcXdeJ9IwKTnBdDSLFqDypaeUor2xHzMREPHjPFG7k3x/aW5qw+7NPodDXYeGCiC7Sl3txXSpBZl4rFj3wGNx9enMShZkZyDhlTCDRvW/g4OFsjJ56R1e2RH1zBc/Y2glSj7G2lj9wDZsxFDwhiNZ2kP42hFUqBOgf6ZAmDzvYXWQIIRKcTPnd1amMbwat0JPJ7noMXn4/nbLRDXeWyOuBdUPWLcAJa6N5/kCh2QmkvmKTm7yh7EMc+KltNbtYz/pDGHQigp8CqG2ySSRJ+vvGc/cDdi7nsOXveVXWfj7MRTPjRwjWft5lHfUo9u4+wKKSAOkfqwRxgin7TzMGBzYiXz6Ux6Js1P0HU4aOvg79Z89DIj+esEGuEvJDnTSTkmUIdV0y8CK3BGoD9IfEwYXKzWH3dAciLAe78UFmQ0ynccJ6QWn1Q7AXkAYZhsiupa2dn2UYtrJ+cEBiiyH4OUFMeEM2nL3hAt4YhpLxUlBBeof16fN/7H16T4+ttNq6Vjg6dps8U0ZAK7UHn8DHT5/OQ5dOni7EpInGJAk0cZ8yORAHDu2AQqWEX0ho17qunp5Y86tf4cDWrdiylTy6gvm2aR3KGOjmWs+N6cfPnoeo8RN6kUgEUmlEjx+PqHHj+H4vnzyF4yeT4e1pJJNIOUUeWB6edlzB0xP/n73vgI+jutb/Zmaryqp3WcWybLnJFdxwBQwuFFMDhBd4gYQkJASwneS9/JOXl5fkhRqSkJC8FBJCAjbYBheaMe6927IkS1bvvZctM/977mjVpZ2Vd2UJ9P1+412v7szcmbntfHPOd8jTKDY2kG9OkMcLecNUVecg4+gFVFc3o63dzr2wQkJ8kJdfi1tumsRJAEHUQbKMg2QM5F4oirWJi3sH6+r5NZAAOBEyRHIRIXHydCEPWYyM9EdAgJnXKyE+uEedul8daQ6VFRYiaUpPDTtdQBy73+lYcsP4oI8/Sf/zT0RxlSdDEg1mjGupV2Bij/jSIQUOu+KQDCLr7yYesmZAM7d8KJOkQxfE6lJHD4Lva9TZQV0hP68GIZFRsNvZdMB+MJp0zNhTbVryyiHCgUgqgtnHBEdrM5oa2zkZ1VDfhFCHjR3XD2qyP4UTlbTfpNYqmIMmoEVnhmJvYc9L5s+4ND8fiTHXwycoDO0tV3g7CWT370pOFeZUX4FPfDTMweNgq72i1pNdW1WhorBygrVNEXRGIliEq86eRyGIP3sg4A+LFiWG+fr7QBfYV0OS9LX8/bvsxv4GeyKxiHilEFryyqJ2SN5T48eHYuGCxE5dN2qDgtGiehka/Nn/JejbGxFhLEB4uD8mTgzHh9v3IC7+DD8GhSv6mA2sLftyb7fpyb4InpfSKwlCX1AdJk5UyWUi2SiDYm5uDXLZc/YPiUTq/BuxduZMHvY5EAqzMrBny7uYlhKMlJSkzt+pLXy2LxuWyAl44Kl1fby8SvPycOqT97BiWWKP/n/2fBkXuKekFCoUNTtpN5A3G2tA3tGi+wLDogrBuiGQ6njsOUXWFld7lWCLLZEtttzJ2pTxArDLk55kRFBtEHRvaHmL1wEakijr3U4PVsNNCGaq90ZBv5f9Z6Wrwh3eV5q93DYIYjxb/LkIiVDep8UUWwSPGqHZYQRpms1yo/xfNwpiO+t377kuOoYx9ATrf5SkSIug9Jx41agb0RmwPo9gz2i1G8VrRThe9+T5SW+LzRd/ZF8162wyq4nmllFHbLG5PNl1KSeUNNdlhgVm0jRjz4iyN/evCdIFZgVIJEPwhtaDP61mfxx0HahA2drxdcSHuHVIWLjSACXY27l3u4omYL8FIELQ5YtMSQ1HHFZii7Vdd/VQb4qH+I+nBPERktfwSqVGADqJLWZXnqysbOKkkRMyM6Rt9bnQByZxw/PWBx7AP1/5NS5nVWFisuodxb2wliRiz+732Pd1iE3q0jokY3jlvfci60IKdm3dghlTQzF1ahQntyic7461k3HoyD5knDmLFevWcS+v3qDzjktK4pu1vR15GRm4cukSDhzNgD+zGCgksKqqiWsRDWbEk+cLESXdhemJnKIww6rqZm7IWzpCHvUhk6EP7mes69DpIs8REqaPMVZxwXnyMKlvaOWhYrXM4O4vdLI7goJ9UZyT24fYEkQ9P+/4RCtSJkWuvPSAQpm/PGKXvfbloCAfvVidc1aJS5wpQKcHAsJFKf+CjGAKP2TX5mgp59dy+AiFjK3Bvl172G9ECCv8uinzXm6xFQmTJqEo5xxmk0efj0qKVNc0o7CoHlFR/ijOvoTEsK5rI6+gpPGhyMysQNy0fIgmlfTLL6hl5QP4PWsqTUdgAOtyejPstmaeWXH1rZNx8HAOoidmwBCYwPehTIlG8jhqt+HYgVNYHDAOOt8I2OtyoJcssLXXcZ2t+OkC0g9BPLqVeEHlqkPWfvaA5ckJE8Jun5gcrvYHqe9YTs80OLh/jyYnGlg7IfF10o+bmRqNsDA/7t1Eou48CQEXeQ/pTEbQG+Rd2F56guuP0eqH2v/UKZG8zbkTGksgD7Cy8gb4+uhx9mwxyiuaEBwZzdrlLNx3WyqCQkMH3b+tpQkHd+xARcFl3LQsqYc+V05uNY6fLMGiNbcjZVZfm62sIB9Hdm7CiqWJPeqdX1CH7LxmPPDtRzvJLnt9Ac9K2h00VimKMhYm4UE8I4iz2eJUs64KW9j88XlF3u7NOnUHW2yRW7BmkpoNZW96w5OMzQKbJW1v8TogklbFNSS21IUnuxFvC66JLaf3lWZiS4B0N1yEIbIZZLNa1vPJPEY7WD86wRao7hBbbOUjbdko6H7lgPxDyu7ltcqN4fMG3xfgeHU9JNJEWuSqMBszfrpeEN8djcLgoxVPCGKABdJ12vdQtjynyM2ergezCDaLkGge0PQuQoTiRp1HBpiBb2Er7yVay8sQ9nuzPm6Az6Mdc7orYsuZ8VgzsSVC1EACye90HHvEE1tzgBvZR7iGooe6C6y/psi2DYLuAzY/a/D2Eu4TBXHjcEUvEBQ4TgravPa6QfgSa/MTNwrio9dC8H440ElsWaEcKytr7BOqYKtKh84vlhveJrMZd/77o3j71Vfh52fgpA6BDFMyUD/7ZCscjtsRP7Gn92ry9OmIiovDx5s3I3dnGpYtTeK6QSaTDjcuT+YhT9v/+nvETkzFvBtv7DfLGoE8PibOmME38va5eOw4dm95FyHMyH93yzlIOpFrPIWH+3GvliBmaA8WIkikHBnjtJEXDZEoSxcnwVadwT20VG8ZPwh6H3b9Zu5F49TpQqAaOkUC9HJrFfQBlQgKqRowu133lh4c4oeMrOx+y+mDJnBD/oZF44kA+Z9fPBR05gdv1n4y4EVohNkg/scN94mz6sqBgDCg+LKC0mwi9iyISmqDo7kcjtYanDhZwL3OwqJjETU+GTkZl5ESPAGU7Gz/gStYfNuDyL5wgWuGledcQOSk67inz9ETJVw7aWJ0O44fvYzo5Ex+3tLSBjS2G5GSEogLF0tQlnUGUZMX8n1OnynF+MRATEgKxaEDl3BzUCS7177IysrgXkwUdhge5oejn+zBDbczW0uUcPlyJeLjgjghWVfXggsHP8H0pas5CdTMhuM9/5ARP1VAdaHqKpE0W0Bxhvifr38lcMcjf6sbUkapnz8QsCQkxO95ahvUFgwh/XtnF17JRlx0l6600s/wljIpgjt3EzEm+YRCJH0s+jQQ4dpt/cB2Vhw23p7Ig022NvM2SeHBhFOnizhZSJpjWkAkFpGvFKJLGyeDbQ4YWP84fbYEi1bdirXz58Pk4+P6WDYrzh85jHMH92P61DDMXzutM+ySyM9Dh3PRhkDc+63vwBLUN4lMcU4Ojn/4Lh8zuvdPIvwOHinEPU98E0azSpLRPejtrUUoKW1orqttHCO2PIT7BVGKh0RvaHUuC6vIEiA/48069QabwN3SZxLgeN8b9SgCDser6UL6pu/tvyazvVEPrXCKhrbAsdVXDTN1RS5d/7Qgxr2syAUuyjmP7yoleC070Kcd393waQF3AAAgAElEQVRdhX0BIH/AbsvX3NyJzcDCMxKkezYI+v94EY5/kZeFV6o3hs8NaCwgw+tZQfw6azun4WIsUBNlSL9mX9cNTw3H4KsSFZrfUsqQvTLPdXgEpbOvU1wWBhcSv6bz3FBggEQZll0velW0NMHxoTfr4wb4nC7DsYn145/DNfm4kki8VxS5QdvhBRfZEJHTTX9vxM/pgsYwRKVbGGLXvgL1Ly37x7EFMeniHXazekPGi8DZ9Wp4rKuM173B+qp0aqOge421op8OV9TFcKHTiPnxm/VVz30l5IzV6pjX3fNJcVhhrTwPY5RKxgeHh2P1l7+MXX9/HWvXTObi3wQit5YvScT+ve/D2rYSyakzepyIyKp1X/0qDynctmMXZqVGcE8T8sogTaG77piOy1kV2PzqrxCXkoo5S5cgMGTgpFyFV67g+O6duG3NFK6zRSBvnkpmHFNo24kTBZz8sDtk+Pjoeaignx/bfA3807fjOwmaE8E1ZXIkGhvzeTbExTeMR4Bs63VGQQ0P0xk5KUFC3dxrh32K7JOExMkTiUgx0tDqDaUby0HnbKypRHtra6cB33UaCcbIOZAL9+OWW1L029678PYvHvC/6Qf/ajw9yHN0CV8LlgdGCDi02YHlD4sovaLgpkclHN9hQU5BI1JLz+DM6Xye7fDWW6dCNFhYPc04c7wICeNP48jRPMTEhnKB/4LMNMyfl4CDhzOxmj3/w0fyMHPpKjTV1yIkpJJ7453c+xmmTI3FqfPVuGH1KgjVJ7BoQSL27c/A7UF+PHx06sJlUOoucSIyv8CIs0eOY+LkOJw+V4ZpU1TChkI/93yWBUvAB0hMDEYmayPr7khFYVEd93qqqleQdvBDxMYGcQ+wKckCopMEFGYooOu98JmCmTcJwuWT0nJ2OLeJrV88ZEk1+5q23LIyxUghrsbI2VyXrTdIAL+qtBhTJ3V5+g1E21M7Is888sqirJqOxlLWTnP5d8XeztpPG+93ROr0PgqFzx45kstJs2VLVe9I+t7SauVi+6RX1tRMn13fqV9Q/6SwW7rXJNp/3dxxHWL+QGlZA3uWB5EwcdKgxJbN2o6Lx47hHCsbH+ODO29L4WG/TpDX47ETRZi19CbMumFRn/BiXib9Ei7s28lJLWfYJYH02T7afRm3PvQVNsZ0kXW2qov8vvS+B5WVjYef+9Dzbym/qIhTPbW0Ekd2wPGwN94SDwYBymw3UhvXvABc9IagfYcu0gn2dYXGXa5pJkB2x7ioHqX8ZvWmlyRrXO2iV8MRX3J1bErzLqoZtAYBD0O0dvxnxC+ChxvsxnzAVhK0sNTyRrk34tjz/cd6SD/YIOh/2QjHW/SW2dN1HMPnBnwseFGR0zYIuhfYqvY/XO3A2tedGwTxTmbIbvN+9cYgufcCh9w1D3irLgqUo6yNaCK2WDuZRHIBo4Vgf1YQr2f3WrPgN7sX/2Rja70366QdAl+8s36cw+Z0Cn9z5S1nNKjhiC4TArC+PkeANH7wUso73f7jXqjIMOPfBdEUCkkTMW/t52VoAxwfWCDRnKrvZ5ceENVwxGEjtuglBRvH/8766PeHsDsz3oQn2YjzKDvGH62QX3pFkT2q632t0MNCt9vlbQUFtfMmTOgZgmRvKOTEDWXuI8QnJ2PF3fdi19bNnFgiDx8CGc/LlozHkaOforGuHrOX9PTwJEM3dcF8JE5Owe533sXlbRc4iUThWEQupUwK5x4o2VcqsP1Pv4VvSAzX2RqfMplreHUHhSTOmp2IhNk38TAlR0slfIQGxDNjnTx6nCBCqbnF1mHoqxsZ8k7DnwgBqrePWc8Jr5ZWG97adAbJE8IwidWHiDvKZMiHNbZeVKzUvt3XAe7tvUNaSPmXL3Pvs94QzcEwhE2Hv3IOa9dMDdq5M+2Tnz1oufs//9mw1+0Td4DderG9VYFvIJB+SOEeV8Q7+AaGIiwgHO9vO8E1yYJJoykykntHmQ12Lti/bctJVFY14dHHpvFj+fvpOkXOt205gZjYYHYd05Fx6gS/lzNnxGDb+xeRn1+NpesegN7kA3uTnmuLkZffe1tPIDxxMqbPm4fs/arnGh1r+840nolyzvKVkFrU0GF6JkRclpfX41JaEeLjQ3jIaViYL06erMbKu1bj8OEcnN91loe52hrK2DXJ3CPN0BER2s5mfkHRbhE7QZ5aPr6md9esmhJCXn2G0CmQfPq3PUgHLsBi7EHmKP25bNHvsh3Wyoua60H6cPUNbcjOrkLapTKYTTrukfj+9otoa7Nx8tZsNnAvSieBSyG3SePV70Ts9iGZBJF7iVEoaUJ0MBpb9iDz/DmEx/ZNOFdZUoK0EyeQm3YOSYkBuH3VhB4ZDxtZXzp8OBeyIRT3fOPbCBiAkD5/5AhK0g9zofjuSSCIfNux6xKW3nE34iZ0hTI7Wipgq8vrcxzSebM7lLFFtofQoZH0E+17KP/znCIPyfvxasAm7wmuS6mgbIjeXGCz2SCN1UcrsdU3ferwopNM6ghdcEVsETQRW4KGbIjoCEPsOL+WnBpfKJDWxQZB/yK7L7+8isNMZfv/nS3Af84MnV+zxfgfR44RNoaRAqHbWCBD/h9m2FM2L5fjKuvnv3lMED/1pED5GAaCMsGNFzgF9MLCWzVhc5w7mlKGpwB6K1nurfp4CusFcTlr+0TODK4b04U2AfLPvVknN9FJJrFFzibRNbHlDEfUkOnSdTZEoSMMkTDS5/Rgdb2jJfnwRTYXX+n9I82jbE7dx77e5PoQwj2iID49nORuK+RXfFRpjMF1cAaGL+vnTxshPblR0G1WIL/wvCKf8WQdhxs9iC1FkbOPHM3lHjcqmdOF9vIz7LfgTm0hynxImlc7dm3HWiK3OnSlyIBeuCABF9Mu4NN3K7DszjshST09XPwDA7Huq/+Oyxcu4JP3tyM6XM8zLFLoGRm8RG7RRjo6mSc/xoHt2xAZn4TxUyYjLjmZZxMkTydbo52LTBPpxutPxFN7I2RrA2RbMxRbC/eesphtsATZ1b87rB0sk9JxzUToObhgOnmNnLtQwsW4ifyysd/J64uIBfIcorA4IhRI18iVKHdv9OY4wtgxctMz+iW2CJQhUWHXEIRs3HnH9ODdey5/9POHAl9qtDf87y/e1r5g/clDAaFGAXdE6HWZx9+XZ8WkCDCxZjx+toDMYzKiJqYgtLUQEf6R3JOHtJGM/qoGlp9JRuysGO4Z1XiyHQaz2m/8/VRPn9TpUTzD5YI4Ki/AEuDHMydSGyCSJcBiRlRsBBqabJA6iBDKyEfaZktXLoBOr+eEDAfbh+7rxOlTMGPhAhSeoUts5YRjXV0rVt95AzIKRIRYKJlDDauDkT2nFsjNlVh2xx04tEPG9PEyzh5qQUN1HRJnCEiZL+LUBzKObpWtigDNTNIP7hcD/HWW74eE+j2z8uYUA4W06gISoA+ZOOA+uRkZrG30HDsH4LUGhcOhsOtq4npXFZWNPDzPbpM5kUiC8xQyGxXpzxMYWCxGfj97htsK/F5SpkTSbAPb+HfuZWhm//XtEKW3qH8nyHbexp3PiMbkipISrmWXk3YRJrGVi9XPvnNKDz0s2ufc+RJk5zVh4a2rkTJrZr9eWrLDgf07dsBgLcTiRT31KElgfufOdMy7ZS0fUzrvHeur7WU0tva8ieR9duxEPgQH+kxAYxgqxB9C46TInsbRU5B/5uUKDYRxWgsKUC57syLsDO60P/O3BTGku3bDMKOz01rheI8tYMgF0tWCfj55Y2nQ1nG1CK5rB3ZrqeQXGey5vMKeyyPs6+SrPBQthp6zQPrhBkH3Wzb6vswWqVVXW78xfG7QORaQNttGQfwGIH0M10xKbBDEn7JPzRqMowWCSgYPNay+4TnFdrcn66NAGOcGUeDVeU6GI1tj5j0OnTr+jEhiiwTE2Qpzng7iE+yaHoR7nkb0Mi/XW3UbAjofigOOTex6yDndVbO55TFB9HdFTgsuwhAZ8l4ATnrDG94bYPdGUxgi63kDJmNh6973BU3EFqLXA+TRs1fbOa8ev1XksvWC/r9YY37+Kg/FDELhQTYePriBe/Y7/putHQ56pJLDjB6MkyQKj6XOm4u9+zNw68qUnt4n9jZYmaFpjJnf+Rt53FA32L7jPaxZNblHRsVpU6NQUlKPHX/9E5bffX9frR127ImpqUhMScHJvfvw7rYDmDA+ADNSYzjBRSBPLtqICCFh9vyLe3Hi4/chiz7QG4xsNViH0MObEBwZB9/gSOiIeDP488/BwLWLHO3qxsO/WtGSex5HjmVyD5c775iOqMgAHnZIoup2azsXRydtosuXK3DwYA50epHrQBHRRbpezmyIg5y1x/9CQ/1x+HAGM/rtEKX+ZW0M4dN5VkY/5OCO26YZMi9XfP/suZJv/PzBoE1cl8NqP10ttVZYNqP90r0QEq2UGC8gQi8ok9mwN1evE5eNjwlaYJQVffKMFp7gkHSnKgsUZB1XkDx/JeJSZ6AuoxDRIWE8lI88frhwOYOfWWFtQuwU3Bd1qi3k72/m8RNE3BC54eSm/QN8O5OPEkHDCRf2nH18zWjVSZ2/UzuRJIm3L3+LD783pLlFIWapM+L575bgUKC9kN1TiXsEtbc0YvbitWgsz2GmUg0vQyRodXkZYsa1YdZiNpaU78fMhRNw4IM06AwtqCpSYAkDJs4XDblnla2/eTj4+SZZPigrQkZja31FrgEtUzZDabgXRotkitBDP0sQxNVRAWH3pk6PDpg+LYoTObqAeBgjZmGgeYM8s3IvpWHOnKhevw/SHKAmLyBih4hUykZIWTYpuyF5CdI9J6/BBfMT4evnyz2sKEyxtKweFy6U4NCRHNx0cypCYmaq+m+0EXklGfg2GHj7p8QQrTVori1DbWkBsjIK4BuiYOuf/4y6ilIEBUiIHxeMVStiuRZedxDhm55RgbT0SkyeOx8P3728T8ZDJ5rq67Hn3bcxKZ4ylfYMAyfSeOcHRGrdxsaSnknVrOXnOLHb834q+GxvNiZOS8H5UxdJ/Pajwe/wGFyBTWIUyvQVLWVZc25iC92H95DL4bVBX3fCgVHqtVqAjwRuLd71qh7XNSe2SGODLVo+pPAiF/uwEVa6i3YZqMBTghhrhLRgsIMoULZ/nrPveAp0jzYK4pfYjHtI1TW6aljUMDN6C6t/gRk/L4yJzI9B6bWIYcb67g2C7h+srTzsal9W5skNgvhGN22dzwtcim8PAo+P6YJb85xS4unz94Jb2juKNs8Yb0Ji410Pb5MOjyLzXEhEumnV0+qOD/Lh+F/PVM8z6N6PSQuTzelH2A8LXexmCoK0ln3+a6ACrH/PYvO+Cw9O5Z3hFEi/GnQkYtDioc4wcJZhNn9u16lagy6hqOGIe7Wd0zN4CY6X1kOiCAJ3soYPCNaWbmZd6WbWlz5g1vl6NuaPqgz0nRYreanEh0UunTs/BYcdepw+k4s5s3u+ILc3lUCpyoIptEtHiAxSvUGPHVvfxU03TujUuyJERwcgINCKfZv/ipT5N/bR3SJQ5sQFK2/GjAXzcXLffryz7SjGRftx/S0ijWhEIgIjKsrCNwKRKdU1LTh+ogFHj2Szh5CN1jY79HoRfn4mWFhTtgQFwM/iB7OPmXt3OT91ekOH8a/jHiukldXW2opdO87ghoUJGMeMeWPkLB52qXqnKTx0zM/ehjgSirc182yRjbXVKCssQXl5NQ8Ra2hs4yMN1/FiG4X1kSi6E71HARK6N7HDl+RkIzZ5IAkWAcaIGby+pN1FwuOTJoYHVFY2PV5YVP94dU2zEtVsbbM/6bDFCIJgMEgGH1+DkTyMiBAkDygKGTu6+yIXVN/5OwfmrhZRXaRg6UMS0o+UUepLGHUOfjbSOKPygmjgNTbpHVDYnwoKavlzIJKNYDbrYLcC9fWt/PfmplZ+j0iTq62D2CIPOPKuITJGbwyAjT0bYnroNwr/dOqQmX3N3LOOQkMddhltTVUwsnK+AcGwVhRy8oeef2FeKQIntMA3MAytdeo5DKyu2VcqEZGcD9+QFPZ7IGuk1TD5tSFpjoCCNDUc8cpJBSkLBKmtJeT7hgAzamtb0dzs357QbrfKT0CJ1ol6Hx+DKTjER6DQSwqXdHomkZg/EYyDvQypKsqHwO5jd72p/lBQWIuiojp+reQd2MbarI+vHiHBfgiPDEZKagqCwiOgM/lD1PtxIX1Bb2b3WMenZvI2TIgqY/3gNDtOLT7YdRZf+tp0+AX78PtP4vIqaWvjAu+k4UZtu62llT2PVjTVN6G+tg4NdQ1oYu213WpnbVAHURJgszowLcrO243Ff3K/nldU7/T0cmTn1iF55lw88NS/ce/JgXDl4kWkHf4E8+ZE8j7RHeSN+fHuLCy5464+WROttXmwN/TVrT59pgiiTzgW37QQlcUFK3+yQjT9eI/c1qfgGDSDPWXKvOpSO6ADP2XGcf9ZL4YHGsXaCYLXwjMIbLKvdTMbjdl1keEBe+ZvwzWx5QxdGJDYMmjLhvjOYH8fQxcoQ9Gzgni3BIkW2FpDZFyBFk3/LUJ6ZL0gfu0FRf7U1Q5j+GLBCvlZI6TV7OvAorYq2EpB+sP9gjiPdAaHo25fUGie55hd4dV5jj3kWjcFlK71PEfz0czeP1wF9rfAcd8oaO+b4JrYontB3lgDEluCG9kQRwP8IdE6R8tcWjyYF9pLipy3QdCfY/ev/xCrbhAg3L1CEL89nC+AKfTxMUG8PwjSx6yO813voRmr2Jh/0wZB92I15J/8RRkd9lanJe4r+aeGh/ub5NZqLFm7Bu/+8Y/IzatGYkLPua4s8yikegHjkrpIXTJMffz8sOvNf2D+3Ggkd8vU5utjwPIlCbiUfgi7M9KwcNVa+Pj3JfV9mIFM55134wpcPHEC+48dh701i2d+oxA58opy6vKQJxB5SxH5VVZaj0WLVJ07KzPOm5tV7azGpgZUFFZx8oAytZERT5+yQw1DFEWRkxdGowSbXeai2uPGBfG/2WqyeJZATiyQSDz3iDFCMPipXmGiHsZIEaGTgamOdsjtDZCtjbA216KhuhINNVUw6nqG2PY3uEZFByLz9LFBiC11T9J2Ij0kCgcVWF8hwo+2jsOa4WIycchWtDYqMJoFXDmlwNomsO/cGY1ndCSUsPto0Ou4xxCFcip2lXwiEjGPtQMifGrLChEVdV0nKZWWXs49ivLyKjG1qVT1cINKgFBoKnkh2RqKYAxTs1wSSUVkGJ23qSIPQYFd+oQkBj9nTiwyLuZiTlQJu141MqqsrAFTJkcgK6sSyTMzYI6cwQX2iXGjuhGBVpl7DpH+MZD8IiG21nL9ML0BPOtjRIKAtmZmhLFrDwwwYercOOcpjRgsTa0owRg+g4cgugI9w0j2LPug10Mn0jAqOgT+waEICAmDb2BIR+ZNf97OONjNUUNmVa9CublRFZO3tXEPJmpnVCY2JgBxrL3u+tdmTuiStxu1f/J8469zWF+h89Fm6vgkT8jIUBOSE2M40eQMNz55sgAm9r07EesEeZSRJ19OThXaFR9Mve56PHz33L5JD7qhtbkJhz/YCT+hCiuWxPUhyXJzq3HoWDFufejfuF5fdxRkZUGqPcGfVXdQiGxWbgsefOoxKPUXERbqF1AU5ksd5+yAFRmDFiRpLcie4v3MqPlVNyHwYcMTbNC1YADX1n7AuoBXJ2B2L9z1QhoxKbHZQn2HD6QWuH57veBZQYx5UZGL+/tjB/E1GBpsY16VboHd6483CuIaqPovfVPKDhHsWY1nC9RPNgq6/30B8g9Hi8DzGLyPVxS5cr2gX8+WTX/VUHxOvKrn8itv1+sLDHfIIa96w7o7zwmuM+6OGihQ3pQhP/7bUeDp2g7HZhMk0sR0xUOuelIQ/dg1DSAU7TIMseAF4PhoCUMUtGUz5J7lrrzQBCjvs39dElsMYXMASlb2iZZzewoUYvqUIN5ihESapis9eGg9idOHQlrJ1oP3UsICDx7bK+g0FCRBiCctJUdrDXuAdqx5+GG889rvmDFs5NpSToSF+uLQ4Y8RFRsDnbFr/CXtq/u++S289/rrqKxuxvzr4zuJKLJriYQiwuPAO39B9MSZmDp/IcR+QqbIYJ6zZAlmL16MiuISZJ0/h/1HL6G5vgaR4X6IjLQggn2SyHncuECcPFXAQ77oHKR7ZTD49AiJ7A9UXmbrOgqLI8KrrdWGAwdzcP5CCc+OqEOjSiD0C4GHhfEMiVR/8v4SVXF5UbYh0F+ExWzhukV99uuFCHYtRw9dxjJ2zyUX4ZM6yziIpkC0FexTdcLcQEBgMNIOliEhlUIRBfiw6hVcUhAaG8VF98mL6uSpQh5+undfNmqKryDMJ4LvS9kQKTyUvKPSLuQjLLmYk14UmklZ+G5YmMiJr/Ls04icpCbHOnO2GNOmRnJC5NLJE5h5k6qrRORUXFwQzCY9Th09h+Wx0/nvRIDRb5MmhuODD9ORlH8SQUmL+N9ILH0ea0sUjnhi70Esuj2Wk0DlxeWcPLv+unjs25+NGy2H4Bc9k7e5+hrWDsx2xE8TMHWxiHOfyjiyRUbqvMHvcSdIOD9uGSedXIFIzayLaZg5J6HP33o/cfKgo2OLOmo3rZw8dTRXsIN0EVmc5OeecQOPsRSSdyWnGqWlDVi4MIHrlBF5Re2fyNruwuxakJdfi1WrJvPjEilM2l5lZWpopMTaXELKZKz40h0IjYrq15Ors14OO9JOHEFx+mnMmB4Of/+eoZlEbFI7yyu24t5vfJNnWO0OW3sbso5/ivlze/5eUdmEw0eLcPfXvwGzjwktpRVc900RxXiMEVtXC3Lbn+WylIrZcRB/zD41ZxLyFHRuEkPCVb+oHRwO1tzdTO83YsLxaFG7UdDvhGtiil7/UDjib3r/gQgvaSwM0St4TpH3sPs7l937f7FGfL3rPTSDusUP1kNKYQvgB8aezRiceAmOvz0L6d8E1SAbFGxl8tP1gviuBv29MQwNmuc6b89zCtcmd6v8sL/08gJK2HWsf16xD+jZNNLwa0UuYXM6Zcdc6qKo2aSG5r3d+w/PCOJMHaTkfvbphtEThrhREJkhId2opaw8SBiiEw7I77M1z//TcjxBDUccVmKLQFIT9wvi6ni+Thd+gF5yU1eJ2ez6j2xgxx/p4eidFy1D8NWTDhJpSjUUwScoCWv/7RG89+c/YuWKRFBWOCdSJvjj0PbNWHLXQxDEruU9GaoPfuc7+HjTZry3/SJuXJ7MRa+dIC+RGxbGoaQ0D7vfvIDkGdchYdqsTkH67iADOiI2hm83rF6N5oYGFOXmoiQvD8fPF6KmPJvyl6KlxYbMyxUYnxiiWdCdbHMiACRJJcNIiHztmqk4ejwf/3zrFOLjgzlpZvE3cZKAwgbp3jiJA/IWUhyOTs8lLeiPa9DrdcxANyHvwlEkXb/a9THIs0fvx85bo/m8hdkVEExlCA2jDIgCynMUXD6uoKFFxK33NqO1tg2f7snCooXjeSgdhTueOZmF5cFBSM8o59dPHnNEBp45U4Sa3NMwGUUcPJSL5ctUrz0ing7sPY/bQwI5GUKeVORRFhjog+07LiJx4gk4WtXntGb1FH7MtPQylFw6hECLDsePF+DGFcn8mV/PjrX/szSs8g9AcUkDP35oqC/fyKss8+hHSBwfyUlIElAn/ac5c8ZhzydncPMqHSorW9Eq6XHmAyOs1ibUliogHilloYDMcxmYOS8VZt/B1w2izlcTqUUozTwJnV7iIu690S8JJLPh0aotqyZpWZFwPHlhOfW4iorrkJNTze/HmjVTuEfkUEHHpNBIyri4h7WBVqsAv6BQRIwbh/HXJ2BxQgK7V641xYlozbt0FtlnjiNhnC/r4301vonU3rM3C76h8WyMuK+vxxcbdw7teBeTknrKy5BgPoUs3vrgwwiNiuQZWokE5Hp2ojgUvYQxdANbtf6a3cnfQ2PokwDhe8yo2cmMmmFLaUywu0kMKZ4L5RoI7npgjai3vmxUeZvNgC7DDjq8svoQW5Iahuji7fDoCVkYaaC3oisEcdFsSN9lN/lHcCsM1yXWGSBtYgvgu0ZBiM0YhgFkrLJx/Qm22j0HF2MnacBRlkRoCGcew5Cgea7z9jynuDnPieQQPErBrjWHte1XG+B47TVFHo3XQeGIrogtekbkldWH2NJpyIY4muZ0ma1vRG3ETiNbX37mqtDLwKn1AHmva9DAE9ax+fWb1yK6oWNO/9FGQdzOVmq0tp/jwcOHs7F/97OCuIStUS548LgeRedDF2WllQgJgr3uCvSBiZyoIoPywzf/hltvTuZZ2Aghwb4oKyvD/m2bsPjO+5h92UUoGU0m3Pbwl3H+2DG8t2MX5syKwuSU8B5GPmkYkRZXUdEl7Nt0ErHJU5A4dRYk88Ce974WCybNmME3gsNux0ebNjOD+jz3BDp2LI+HKPr6GXkmPfIw0utEHnJI3llkxBNBQGGHdhuFscmwsk/KMkfXbberLyaIdKFQqUuXyrhwOdWV9rdSeVaWjkNhXUSGEdkXHOyDEBKPt5h6ZIzrDWEAL5rYccG4dPoCEqaoul6u4R5ZXl5cjbl3iNj1qgML7hLQUKVgHvv/7reAk8cz0dDQzrXUQoJVjmDcuECcOlOE08cuoLiknntx8frTq+Pr4rB3z3kesjh9ahQn/gh0/RQaenjvKS7yf0vHPkQEXsf2+fTDYxA5aRXXeY8W35CEz3af5SGgFLrq00HQUMgp6ZMd/OwUax/1uOnGrkyEC+Yl4JPdmaivrechp6Th5tyHPAJ3f3CCP1/yuqssKMDMpQKKLys8NLE4U8HEeTLKi+qQMCnCI/eYvN3STp3humz9wZXjlMI1x2yoqm5GTU0z6urauFYbeRDSdVD7pTZNGliUuIDaL7U7ChusrGrGe+9f5M+FSB5qq87ytFFyAyJjVQJX4OeiNmOYK6AAACAASURBVE8eihS+SRtpmpF3Y0CACTq/CHz5ka9AP4AIfL/X31aP3ItnUJyVhohwMxZcH90n7y8RokRonjxdgvkrVyF1wfw+hB/1r/3vvQOzUMfq09UH6F7s+iADy+68G/ET1XZgq1UlnuhaFIx8F/GRD0cF6yF/FyB8TeMO1KL+9qQgzhrYnd3zYAtN20ZBT26wmt5AsRbvSi/mqsAmd23MdwdsbPHkrboMBaxb7oJaJ1eEyaJnBDHqJUXuLcbvahHcWA18OOQKjgEdGh0vsL72DzPE77M++jiGJn7cB2wEvj0e4k/Y1x964nhjGP14QZEvszH25+zrf2sofscGQbzzeUXe5u16fQGhmVQRXOuiXRXYqrwfjY2BwSzIYVsTeBbKLwsg/+foJvod70AVOHfl4bF6oyD6PqfIPbMzQXD1oqvwBeDoaAlDFDWGITJ8qMV7mcj/DYJuO5uHn9BwzOB4LsCOnRrr4HGw53tCFMTr10P6EtSXY5M8dOhA0gF9gtkAbF1e76FjehRdHluiXEReFfy7tYmLN5O+UFR8PG667yF8uOlN3HrzhE4PLCISyKNnx99exy0PPAijqZsHBjNcU+fP5/o5n7zzLrKy07B40XhOAnUrwkkU2iqrinB85yUY/YIxYXoq/MISIBoGTwxUXlSEhtJsPPil2dyQJ8O9ucXKQ6nIaLeS5hDP2KcSG5Tdz+l5pePGv0oCGJxEgE4N4bpwsZRf18wZMZicEglzQCj3SlNsrZDtpA/l4HpGJP5dV9vCSYnMzApuhJP3DHkqUbgkET1ODSOCOADnFRLmj7SLxWgoPIXAiSt5eOOV3ArU1PY/P7QVFcIdTbr04ga0HbGjqMmArf+U0NbaDt9pDjTYjbh0qhIzUqNRWi+zra5zH4MlADs/K8DyZck4k9mz3RbXOKCTFATHSDiV3rUPzP44sDeLe3xdyus+XgoorLJzb7DQGpnt37WPVTLz4y8MCu55LMGEs5fLeYhdbrmVb05YIsKw/dMszJkdi9MZ3fYBuUSYcDGzFEGRYcirbUdrOnDluB4+/ibWJprhiHQg/2INqmUX5I3QCFPtFfJO6fOn4CA/JCWG82fQUnwKefk1WLRkYj8HQZ+QQPLAqqxo4l5tRADW1rXyEEIiBqlvJCeH8v5FYZmUkIG03US2kWh/c20FLqWX4mJaGWKiAzjJSKQVtXsiZWlzengRUUvfibiicFuZlSEyidq5yShxYoyfQ6/Of3SM/QdykJOR0UkcDwQS+m8oz8WVtAtoZ6ZrdLQFc2f3T8jWsv5Bnn2iTxjue/I7CArtq+FFAvcfvfUvRAa2YerUnqTWjl3pWLj6dkyaqWqBOppKILepWqk0VgmKWDRoZcegCe2Qf2KCdB+0L2InsJb5Ivv8uher1R9oMNK6kI92XWToYD070o3ira8CNX3cnq4hKEPeRrZIo/TOLoo6wxFfdf7wHUGMZu1l0WA7KVB2jBah0ZEOSufNPr7LjJGfs8fxTTaaP8Han6u3MxogfH+DIG4d6WEFYxg+5MPxy3hIZBBOdlWWvLYeE8RPSdul46cx3TbPwA1jUfDqPAf35jlyNRulazLhe2xFvZiNsV9+TpFzr3VthgJW74qNgp48j25yUdRHVpNFbHb+wK47lVnJ/RsynVDeHS1hiM8IYoIOkksxfQK7IJdhiF2Q32f3SQux5cyOeM2ILUKHluY/RUF861ngTjZmf5f9f7EHDp3oD5E4zuG2ATShk9iy25VLVdUtxFZza9dadQmSfwzXjxo3IQk33f8QPnjrTdy8oougolAw/+J6vPv732HFPfchclzPEKSAkBDc/bXHcfncOXy0cydiIgzcO4hErLsjLNSPb1yo/NxhNLfsg9EvELFJyQiOiuP6U0IvPa5AZiSzBR58Y+cwo13iYYEGtgXa21UNKtIt4pujQ7MIvBxpHKlZEY2qILxkUjPPsf/v+scbsNtsuOvOVPiGJsAQNpULyHeChL3trTBbmxDAthhbE9fiknm2xFY0NrZyz5qSknoetkdi6PFxqjePNID7Dg+5jAxA5qV8zPQ/DlPMAvzof7fA8t4Jj8Ue9FZ6e39z1/fT22pweoD9Pt4ycCbjQuT1+/sZVKJHrl267u88xb/mZ/SzQxCwI7Of3y3X8Y+C/vaJn49jVLX+qhfH6k3Tkm4BsiixnnNaZo+xhJzsReBSf8fsjfS+L80aGxvRUHUeb772NbSXnkR2Zj6CQ/y4V2B/6P7Myfvt4KEc3s4jIvxx3dw4BAX7QmcwcxKXh5nSJ2VD5J8+XMvNCVN0K+ZFpGHqlByuKfbhx5lY99VHISh2TrpyfS57m/rpsHGNN0XpePnENeEkrgvHTsTaur6j/Zv4JzNC0dJ6GWFRfQkq6kP2lhrUlOSj6Eo2bC21nMBNiguCTtc/oUWabadOF6KwtB2LVq3G5Nmz+w3LLC0owKfvbMKc6UGIi+taPxEhtuujDCxacyemzp3bUREHrJUXO8tU1zS32+rrL/dbgTG4BdJn2CDov8ee0B+07kPeI2wx9D5bTA3nxE2aLhqJLWGwjBwegJLshrxJ0UhcEMqQKRzRFbHlDF3oJLZMKtE1FoY4zCDDhX3811OC+AsDpIc6Mpq6JCAGAWW5ozT2N3umhmMY7aDQmWcF8esSpH1wPcDFBkH8Kfv8bsf/x4gtz4Dmubkay3rKC6NfKJAmuCHiZf0dUPFb71XHqxB4VkHp6AZBvPV5RT7jeo8RCQpHdEVskUc7SQl0swRdhyHaR9GcroNEpJKWpmtrgWOX1uNagT0GoInCsV2VZWvkO/5dEE0j4QVfB8G1hTbWvucIENd3eOi5KRXbBXZ9X31aEF96WZH7s+CvKTqJrR+/3Vj2y4eDM1tbbVPI04iMZGvFBRgjZ/O/j0tKwqovfwW73vw7li4ch6goNbMhZWejUKa97/wd8VOvw/U33ghJ6rpXZNCSx8X4KVNw9uAhbNuxHwnj/LinEGludQd5kCR1ZGajDIZF2WeRcfIIbDYFOpM/AsMjYQkOg8k/EDqjLxS9Bfm55YgaPwnmgFiI0uDPiEguh60NtvZ2WNvbuFi1rb2Vfa9AbUU5qqsacPddM9hxRIjmYO6hJRAxJorce4c8W2ioJ08aiTIAKsGdv8FhhdHahODYBkxsb4RCmQW7eVZRONhAiEsIxdlTeVxwva3wIL/3pNDcV6loFIJCD19++VrXwiMoLCzEM99Yg7aiQzwM8WJaKVKmDBxu3f2Zk5fVl+6/DoLBAtHozzb2qadsiETYCqoLI5ybApkNt9R3FC7fqWZKpDZpMhfh5psmYet7F3D404MIj4mF3mhimxkG1ifoU+9jhM5AXl9G1qf0EHoRbzwskfWBdqsV7S0tqCrOQ0OLwLMZFlyuQVtTHRprq1BfVQ6ZtWWDXuDhx+NjA2AwDBwuS15U586XICe/ATMXLcaKLy9mderrHedwOHBs927kXTiOG5cm9dDhI2+2Tz7Nwoq77sXEbt5j1qr0Tm0yCsksL2848+OdcsPgT2wMWvEiHP+3XiU5XGo0dICUCv/EjOxUyqrlzbo5wXpCgdArlfcgSF0hiDpvpVxm88F0N4pne6MOVwvKWGhUvQNchVXe8G1BDPmNIjtfJdwxWGH2nJrYKuoDj1RyDH3QETbxF1EQX+94C0shhdOGeLib2EJ3CjPkLnmwimMYxXhRkQ9sFHR/ghr6OijYOPgkaz9vkNcf6/d2ryqZew3K62xVPyTjTPCCphRb8xX0Fy0wAGKYcRnBjMtyT9eDwFagqW68wLkyArKtkkH2abf/k2cBuwbNItqkIfTJM4K4+CVFTvd47byMVji2MOuUXkL1Ff3tBta+VrG1m7ErBE8YdE5nKP4VcOQlz1TT62CN4AGNrVb0hXR+ozDo7eqEUeWBtOq1WIKAVexzq8byw4IOD+0H2PP/oRHij9izfwhDI7gkHcRvsc/veLaGV48enV2W5a25udVTpkxRvSfs9XnQ+UZwzy0ChSWue/wJvP/XvyB1chvPYkfg4uurUnD2XCbe+vVFLLtzHWISE3ucSG8w4LoVyzFj0UKcP3IUOz46hGCLgClTIhAdFdAnbIt0rJLGd4UuEdFVU1OJ6twCbkC3tdnhb3Tgg03beIY0CsVyyAIz6EnrSseNeSIGZIcdDls7+zt5b8n8PKRFxMMRndpEHaGIxFG1tlp5JkhrxXnP3uiBYhEZSF/KzLbcvBqMT2R1bq12U0lrDMMFejZEahUX13NPKD//gbU7e5OZZGMrbTWQ27SL//cHVRPOgcaKPNSX5qi6cR1hiJ0hiR3hiTwUV5JYu9dxQovCGmXZwb3JqM1TKCQJtE+aFI70A9vY//Xw8zMgOMCMpGkW1kcGzzhPxydvtPT0MlTWOjBj4UI8+qWFfcXhO1Ccm4vPtm5FXJSE29ZM6dHvs7IrcfRECdY8/Cj3EnXC0VIBW21W5/8LC+vQ1u5ww314DK5AHkXfFcTHDap4sNZ045Fsoicvr7u8WLVuUC6yTne7xsL+c9Vsjyc8XYv7BdEQD0lztjrW60ZkqBctapkBu43d06+4KKpjs+qt7PPNxwTRPxjSksGLKztfHAUp0kc7nG9hRUHcth4SkRDkfeWWJo4Kid7Wa9FVGsMXBM2Qv+cD6XYNIa/k9fcaGxPnx0EclVk2FcibmLE3Yoh4AUKaO+X1kOhl1CYv1eYGrSXZPDdQ8MdwwvGcYuvhgUqh88yAf4nd1/s1HiNEgrTj24J4fbeXOaMCVN+Ngn43VEJlMJBiNoWk7X5aEONYG0odvDgPQ7zWpKUm0IsaNiYNrqnSBSJ0Yr1VF1ENRxxRxJYTbP13hX185VlBfE5S1/GDykv0B9an7mHrj6dGWkRCT2LLjjfSM8p/MHlypOiMHGovoyx4Fh4qRQgOC8N93/wWdrzxBmqqczFvXgI3TolEmjUzBgkJrTi47U1YIpOwePVq+AX0fBlMHhxzly3FrMU3IDc9HReOHcOBg+cQHxeIxMRgRIT79yG5CER0kZeY01PMiSNH87iIO4VFErimEHm48NusagvR8Zx1HAyUdW/Hrkv8WKQVpTXLohYQyUF1kAd4/kkTInD6TBESE4L7CHCPYeTh5OlCTEgeeM3HRd0HSSYwFJCn0pWcapw9W4zZs2KRPCFMwz7O/kDtTuD14pk+O+pWWtaAjIxyroGnuR6sDZex/YiIzcurRXDUOKTesBpJ06ZBp+v/xVhTfQMO7NqFuuIsLF2U2ENvj+p2/EQB8orace83vomQiK77SppeFPbZ0aE5LmWU26BY39Rc4TFowq8UOYstisj743/d2G3dekH/yAuK7XUvVasTMuSTklsvlsR18AKxxVZBK+CWiPfI1TBio8PbbDRwRWzRm3tKm/1mILAcXFN4MIyekIXPAzoMjj88JYg7DZA2syF+vpuH0Gy8juGLgVcVuZbNBRRi+C8NxefGQXqcjRGjVDh8ZEGB46TgxjynQKHslB4ntp4WxEl6SBO0lmery5OeroMnQFILzPh+YD3EAlbLDVr2YWPoeDOkv7L97hhpRrsrsMlgk+ia2GIQKWRxN3vGt7gq6RhVc7qoVTTe62B9Ym3/Qv0jBy8qchpr50uehfR91u4ptNwdwzXqaYC8EEZUVEIPK/Q/367L/MVDQTuLiupuI1F3AoVAtRcfgSluKdfjIfj4+eGer30N+3bswPad53Dj8uTOsMKgQDPWrp7CDPAqbH71V5g4ax4nsnp7cFC44gRmCNPW2tyM7ItpuJiWhj37LiA4UI/ICAvCw/x41jazWTcgKTV5cgQ+25vdSWwRgSS5CEkcCOQ5dtuaqThzthj/evsUz9wYxupgtTq4x5gzeyKRUyTI7cqtikg4IiCcIA+xdmv/STcsAWboDTpkZVfx/4+qkfQLAoWLsAN5eTWgqS4waGDblkit7k027VKZ6uU1GDpIJ7HDm4oSHRChSwRrdXUL8gtqEBsTiFtuSeFZOLXAVX9ITy/niSAGArV1SspQU9OCykpV+L66pg3hsXFImjYfi+6eDj+LZcD929vacGrfPmScPIrZMyKx+LapPRzb6dif7rkMY0A0Hnzq6zD5dCO82NjTxsYeCs11gpI1FBTUbv6PfzYXaroBY3ALJ+F4ca4qJD9b6z5sFnzlGUHc+5Ii53mvZjx07pikDo0aqX/hyysE8UeeDkeUID7kRnE7G/H3evL8nkQjW9haVLVCF9plAvfSEiHe6OKQzY1qxsUxDDNeUeSiJwTxRgukj+AGWSVcnU7XGD6neE6xvbVR0BPpfaursmQQsYH5T2PvZK8ebPy8aNGWsZaDtHyeFcRgZqBeXShAL+jdm+cYHLs9eX5PgsgpZrx/bz0kMsK1epjf9owqFP57L1bN45Dh2CZCeg0uQ+aEDs9rZYWLJVXJy8ChFz1UP2+CPWNhvZr8YqTAV4a0ln2+fa0rMhg6Xo79nI33JCvyR3f2ldT1w8gltgiKjDd278m87c7bp3NSiUDaNm1Fh2EadwMXkydQeNPyO+5A1oXx2P7eVlw/O7JTH4tAYYQknJ52KRtvvnwCU+ctxKxFi2Aw9TXIzb6+mD7ver457HZUlpSgJD8fV4qKUH2+FK0NdTAaKGRPD5NJzzMZkuHPNYgUBXV1LZw4CAn2gZH9ncKs7I6O7HBWh0pMWe3809rtk0gm/neePVH1siRPFjLiad+c3BrU1Lay6wjimQ75efUiJy24V5kL1yofc8+4XcrEOBCxRUiZHI0Tx3PQ3j4qPD6/kKC2c+RYPmbNiR+0nEHfk/QeFxuIwADXEV5EmMoONYyQ2mV1TTNr2zVobm7nTkvZV6o4wUTeW9T+qE0S8aVuOhiMOtZXuv2fPvXqJ4XcSjo1kyIRtU2N7Zwso9/puDzDIvUbdo0U6kukU1ubAz6WQIRERiIidhoWzkvgSSIotHgw2KxWnD18GBcOH8TEJAvuunMKJ+q6gzy+KGvirKUrcP3y5T21wBTWZ4uPQm7vIgNJlP7Dj9LhUJQ3XN7IMQwJRAI9I4iP6yAdg3ZdCgsr/zpbVKzwprs6vXllEy+FO8zRuMu4Oeoix2PthRkQMawXuUqL3R2HXlLkOtfFrg1eU2TbBkG3lRlHj7komvSUIIYZIC11YbzuYsf0uO7MGLSB7v13BPF+EyTShxn4jUNPRJFBMNo8E8YwHHB8k62KKWuLKw/VUDaGPDIMFfrcg8ZkNs99zL7erXEXHzYnkdbNTz1VhycE0ccf0tfcICrzn1Pki66LXTvQ+Mbm78fZvSKPVk3ZJNn1P/e0IO58WZELvFw9j4HWGxsE/Ues7q5kG2Z1yCoMqquqQNk6WsIQnwYo61iSy4LDCGbVUDjiiCa2nHhOsf3fRkG3hF4Ka99L8nZmVrfRl9gS5cDI6HCede2O26Zy/SeC3FarklsxC3lWNSeSp0/nhu5Hb29CTm4mFi1M7NyHyCcSiZ8yOQIXLqbhjRcPIWX29VxnayAvD0mnQ2RcHN+6g7y6mhsb0dbcwozyNjhsdrQ0NWH/ju3c44QIh8vZldwgJy8T1eNF5Ea708An7xfS4zJyAkBSPzsIACKqiCzY/ellTipMnxaFhIRg+FqCIPlGQTQFqB5rotN7THTqfHdAZrY4ZahrhmxtYAZ5AzfKeYbGDhj1Igbz1SadrbiEMBR9mDnmsTVCUVhYi5jVE+HjO/jLEGOvMNaAQH8ERsRANAbwsF7KhMhJYmfmw862pOpg8ayGrO1QW1rSVIr66kruKZZ2qZQna7jpxkncG8vaQcxa21WilhO27Sp5S0RQXZ2js4y9w+OQ2rrRpOPaeBOTw5GZVYOFt6yE0ewDHZFgRhMnm30t/ryfukrK0B3UJ88fOYJLJ44hKd4f626byPtXd7S22XDkSB6qG0Tc8djXEdWrr9O1t5Uc5VpmThDRTKLykeNi0XjxyhB0ZMagFWxhdHqDoCNNio1u7LZ0PaRn2efz3qoXgXWR9wXtxBb3JNgoiFs85QouqVnAtIqHEka8C78AmS26JFfEFsUfEqnlSjR/xF/v5x1qllPdW6z/fk3jLtLTlOyStIfHMIZuYONm7kZB/1/0VUPxgV2/x+AW2ArwfVE7sUXY8Iwg/onN3aWeOL8/pPUa9NW6QXnXE+f1NsirbYMgfluApKm+lP1Op4qx3+blqnkaFJrqitgysZU3eRMNnBEKXAJi82B/H0mQRlAYYjeQUL/lFWV0JLuyQ36RtXk3iC34eq0yQ0QfYktUBL/E+AC2fJ2FXR/u46F5RAgRSDi7reiASm7pujyv/AMDcffXHud6We/t+Aip08J4aKBTK4vIJQrJI7Io8/IVbP7tUYSNm4AZCxYgdnxin6xt/YEMbdq6Y8/Wrey4MZg1wx3CUPW0IlKBiCpBZ+TXIkgmXEnL4aTVPZQZkYz/iJnQBST28sxSOgiHRijtTfyTPNoUtlEmO/I0GQgmDZpd8QkhCAn1A/L6ehXb4CLVxRi8juAQPyQkhrosZzL0ykQo26Cw/kN9iEMQIerMEAx+HUSXf9d3IlC7t7nQKTCElMLf7ygncSl0L6sQSJ0zCXpHG3zs7VDsrWxr5+eBM1OnRlCyhJamZsxZqjUhXk+Qp1dpQQEntEpzMpGSHIJ1t03qo1FH5TIvV+LEqSJMm7cIq26+CTp9zxZNfYs8tRytVZ2/ccJ5TxZmLFkJR206MtPkETeQft7AFjP/JUEijapkN3YjEukjZgx5NvNGDzj+xpYvP4L2LC7xCsQX2Oc3rvbMbEF8C1sQP+LGLi12OP5xtef1NvKBz+KBCvY1fLBy7NqfwuD6C2wCdOz0aOW+APBG9k4Fwll3wsKaaT07hjH0g5NwvDwH0kOsPWkVZB7DVUKE4102xf0arjPWOuHPjNE/i4K49mq9a9gcnsrG+v9wYxeKM/i/qznncOJ5Rd6yUdBTsgANOlTcYlzL5v472X7bvFw1j6EWjveDIdGLikHDRAT+TmNQlBUBBz1XM+/hfkGU4iFpTRAwnDAZIFHWSY9Hmnhj7VAMXIjn3Lpmra0Rt3bo67HFVkRkHM+YFgOr9Qbs2HUIa1ZP4dnTCHJbHdoK9sEYswCiscvrigih1PnzkTRlCheJ3rLtAuZdFwenVheBCK5pU6O4cV5UVIeTH27C7iYBE6anIjl1OiJiY10KvHdHcHgE8s9lQDQFQtT5sHmgg6wiTxj6LqobRIkdV+LJKQXRwMoYujxlGOw2Gxe3rmsu4J5eTkLO3liiklV0X+xt7LtKYHX3wnIH5GFDIWpW2+DzDoVT9kdLUGqFuWzTLvPteZA/7ha2ffca1uFagYgZ8nRyBTXbposxgbIT2pg5wTZHc89MzbzdcpLLr4NAFli7a+R/o7bp62tAk9UAqzEOvn5+vUL4ZN4+OcElq5lAWePlGRnhsKkEm/PvRNDaWlFffwXj4l1I7PSDqrIyZJ2/wLaz8DXaOJl9w8xp/fZhSsxw9Gg+zEHRuOcbTyI0su/LXbofpOdH3o5OEKlFnlpJs5di4sQwpB8+B9GNXNhjGBooq916Qfy6CIlSZ2u930Y2yr3xlCBe35VG2rNgi8t8tiglDSfNb1BZc3mC7XP2OcX2h6Ge9xlBnMwMh3/CjdznCpS3RnIYohNvK7Jjo6BjhpTgivxzpdv0wUgWSR2pmAvpX98VxP+g5A2eOqbonldh+2t8QhjDGPqCDKeNbC5gY/thuCcsPIYhgsbRDYLu72zu+rYbu616FuLP2OcPhnreJwUx0gcSETjujB+fsXk5Y6jnvBawwfG0HhKJp2vyFRAgvcL6wCejZX77kyI3dqyTXHn9uZjTla20PvBUvbyJeIDezA/qfXatIKjhiB4ntuZAemyDoGfrYttrnjqmr9on3LGxGj11bk+hj5UuiEoD16aqzcb8FWrW1O07DmL1qsnwdYYlMgOUyC0ETYM5JKGHIetrseDWL30JZQWFnOA6c/Yi5swZh5jorhcPVH7cuCC+UehgXn4BDmw5gwY2ZMSMn4C4CUmITkyEJSiIGfIDz6PT58/DhWNHUd4WjYRJKX3+Ljso9MqO1qYmtDQ1oqmhgW/N9fVoqKtDY20dmhvqIdtb4eejh8Vi4sQBhSMumJ/AHnAFHC0VQ7qxRILQtdXVt/bI9Ohj1sFqG5wYG6hF0d3/Dtu2D1LGm9gLVXXRnfikLyJ8TF3OJNQOampbYPE3cWJXCzj51FbLw3+7g0IMT5wsQENjO0xt6XjvD2fR2ibD4OMHP0sA/IMCYQkM4plIqR9SGKGPvz+MJhMXkO+XcMrLQ23zOdw6d+7gdWLXQaHAJbl5KLySjaLsLPgY7TyL55qb47j2XX8oL2/EyVOFaJPNWHTbfUiaMrlfbbqW6kKg9jwURxcfooYfXsaEOcswc+F8tOZ9wn6jDI/iiBtIP494QZE/2yjo/sQe2ONu7JZqVMP1vDZMyHD8XFQFOd0ZBn/HFnrG5xTbr90937OCOJfSf7OvwW7sZhUg/4+757pWcEB+m13j1Xq1jYUhDg1TDZBOsAXqM2yB+hcPHfNm10U6MZaIYwyDghn0xzYIulfdJFrGcFWQXwQkCifWTDKx5/N9NmdL+ZB/4C4h8ZQgJvlAIk+mRHf2U+D4sTvlRwJeVuRMdp9+w+7YMxp3iVMgkqf497xZLw+DwhHdCWftg9EUhsiezwNaF4QKM01Y2asN26XkDlr1vG72RoIHBj27jl+ztrxcgfyt5xW5yvUugyNUXTu48QLXUXS15/Q0+hBbskMoIdFoMjBtNZex4OabYTAY8d77H2PVLSmdgvJkfMuVp3HhwllET17QxwMjMm4c7n3i6yjIysaxT3fj+IkLSJ0exQzhkE6Sh2Ay6ZAyKZxvZMiWlTHjOf0Azn62Cy3MxvULCkFwWDgswUHwZUa6yWyG1BG+RALV4bGx+PCtTYibMAHW9jaeha29pZV/InH4VwAAIABJREFUJ48VkS3Zyeg2++i5mDt5u1DoVUSUAX7JgfDxCe/jXVNSUo89n2WxazVz77KgXtnvSKeIxLwbm9rR2mrrzJpI35vY7yTKTTpCpC0UzPalTJFOw9+XXW99o1WNFhsIQv+BZBR/RRT8AbYtGWR3b6CEbfeAXFw1pMgZBtQ01+PTS0dx8PJppJfmoLm9FX5GHwT4+CHULwiRAaGID43GhPA4TIlJQpCPVh3dq4evTxfJQ0TMiRMFqKtr5c+UdK38/U28HfJECB1C72bWNv1Yu6QECb0JqOZmKy6ll6OoqBbTp0XjhkU9QyFJP6uFlWlsamRlq1Fd2Y4C9v+WFhtaWq2sDgoUUQ9R0sPk4wuj2cTJLkrkQP0zaeoUFGRnd4YFkgdje2srJ4EbamtRU1GBxpoqGCQbJ2mjoy2Ys3r8gEQdkWAFhXU4d74YNtZqr1+xFhNnpPZLUtfX1CD//CHEh7X36IdU9493X8aMpbdi2vXXsbEoE4qthQvas8m2ZKjPZgzuwQ55ow7SGmgUW1UhPMsm8Z1sEt/njTq9oMhHNwp6equ8zo3dqHG9wvZbLMPxDDuGS2P+3wXRFArpaQkSLdzdeYNN3lr/xxYZue7scy3xMptW1qvD/FCFQFtb4NjhyTp9wRDARv0/UxY61j6/R218qAdifW8da7OawmwIbF4aVd4WY7g2qIX8n8FqeHqsy8JjuGqQd/IGQfc7AYKrcLFeEDbEQ7pugyCSoXvJVWkKZ5oL6atGSL+E9tBHJ3axc4yKULXeaID83xZVS2jQEHwn6DlsFMQ3RrpIvhMNbD5m10ceZkOV7qhgi6T9nqyTt9Ahgq+ZxGNz3lPPK7arEnR/RhCj2NqYSB0tXqyGDmmPP1/NOQeGcJ8AaQVbP/ysHY7fDzVigl1TILsmLXqKnbAC6UM5lzfRN65KFDLr61p5SnXy2tJZxmHO0iXcC2TH1new9IYExMUFqUVFAeOjFBz/5C04TLFYvGY1M5x7kkBxyRP4Rho8Zw4cxPET55A0PpiHFfXOEkeGMoUuOsMXSQSejPq6+kY0NVWhrsrGxbEdDoU7fVD5YB8DikQbAvTViE0MhMHAjHZDKP8bEQRuRDZ2gjIgLl82ARfTyvDOlnOcnIqODkBDQxsnKByyDD8/I99IKN9kMsHsF4jgKH/VcyYwAL5+7D7YmyG31XANLicoHNHXrENTy8BhqQNVmV6/0IMhl4PhJrZ+CzUnPD3dScN8bkJtcwPyqopxuTwfO8/tw0cXDqHdri0kVCdJmBaTjHvmrsSji9fB1+g6O2F/IMLGVRScj0nHztdVhkir1bfNhWgKhiz6orGhGQ119Wiqr0drUyPqG5rQ3t6Etg5SlATfiRAlUjWA9Y/S0gaUlTXwML+VK1PgY+6bjZBnRgw0IzBw4OuiulO/aXeKy7OtuqYCoqMFhvZ8XDmWDZtd5g2MMoMajUS2GRDF2njKLF/4+Qb3IKT7Q1NTOy5nVXIdrcCIcZi3+l4kpqT06ylGpPThjz9GW2UWFs6P60F6VVY1Ye/+fCxdp+5PHqK26kz+t7q6FofD4bmQnTEMDjXDjvgtNmludWM3kU3if31KEGd6SzDTAcd6EdLNJO7q5q73sP1uYwbDO2yG2cJm/6Mktu3847cEkfU8zBQgrglRF71uCOiqoLeBMuQfubvftQTpsmzk90T4zhAP8eFvFXmw3Chj0IYlrH0eYQvUvWw0/l0THDu1ZpkkIpa12e+yvvcTuPXGFV4hoMfw+QKFNz0riN9h7WvLta7LFwUtkH/qC+k+9jXGzV2XsTn7fEc42iZmNR38FVDg1N96TBD9g4FpbKpeNRfSw+ynhCFUr5XNw08NYb8RATau1rP780P29Y8adyGNm1dFQVw2GjLI0rzB5vTtbCr40tCOMHrCEMep/hZBGovb2Lz64dWekxI1bBD0x9lEO19LeUUNR/QSscVBHg8vGyF9jz33Pzgg//1FRc7RuvMzgrhIB4nkOvqGvw2MK2yNP/I9tuxl9flV/kZyZwsjvZ720lMwxy/FpJkzuNfUjr//HROZ4TlnVmwncTTv+jhkZlbgrd+8gsVr7+AeIL1Bmc+iHnoQLY2NuHT6NPYcPAXF2oDxicGIjw9BcFBfo5wMacpiSNtgoBEmL78GM1Jj3Cay2tpsqKltRU1NM9ta+EaeWKQpZrOrWeQM7DuRWOOTohASFQOzJQSi0R+C3hei3kfNliiI3MvN0VQGe3MZHHXZGEi2wuJnQHOrfXCvrX7g9GGk1+JkLQ6fD5LqKUYgJaah0UJDx293/xM/3vYqHN3GWMHElv8hHZ5RNFUriqrbb1eo2UJgLVsgJ01J4L+fK7+Ms1sy8PrBbfjDI/+FOQl92+jVgtpegH/fkDzZ2sw3yqgZ4BOG4PAJkHwjO/SzFFX03d7CCVC5vREt9dWoLClCRWk1ZIfM22BRcT2qqpo5MUVkanCwD0KCfNinLyfBXIU5Ul/V6WgzdIYUX8mp5gkdJk9223bvBIVF5rO+l5NThRabHikzZ+HubzyAoLCwAfcpysnBni3vYkK8GXMWxPfosxlsHEm73Ii1jz6ueoGy52otOwWnPmJlVXPRTzY3l/94VCTP/XyARFPZApCyCLnj1p5ohPgK+3zUG3WiCZstKjawr78fwu5GNnM9xAaHh6gHsmtrYx9EyvgyI+JqhzdFgONxL7icex0y5LfZqDpUYmvEhyGuF8S17Po6Q0kEWuNoBGsvj7B2ssL5fzbFvPWCYnvV03XshmUi2+iNO2vnn7K6HpbhuMBGwSw20lezjd7I+ipqeCwZqEtCIZFTtbsaI+wQjvc9UeGnBXGSHtKfnP9nhrXPYOV7YRG7vwe6KqWcel6xjxgpT1a3b7KPbhm3hLgBC/cCe3Y/Yvs/4fw/e47Pv6DIHrnnww02rm1l7XEbu6Y7r3Vdvgh4VZFrNwji46wvUVIOd1/T06KQtChvYwYr1jODnrXDBtbhjcGQ3H0h1AfsON9j7SH7ao9zLZEPx1/i1RD8WRp3WfIMpK+wz9e9VyvPwQF5kwRpSMTWaApDFN3LhriPSE1PnJd1SBrHNRFbrOzypwQx7BVFrnRd+qrADCfhxxRpwPr7GdZT9ykQjjvgyGR9tphZqE1sHaFn3y3s+wQZ0my21riTjRGL3D+V8p6nKr1R0P2R1Xtyt59cZeDuBLvWrexaO73U+hBbP94j23/xUND+uvrWu8mjSm6vg7XiAgwRMzk59dB3v4tdb/4T23emYcWyZE74ECZNCkdMTAAO7tmGi8ePY8natcy47Zs9jjR/5i5dyjcKccq6cBEHT1xCU10WIiMDEB0djIiIAAQEmFhlrdAi+E/eLNlXKnHqdCHmzhnX5+9EIFGYI+ldqeSVSmI1NLYxQ1/ioYJEFMTGBiJ1ejTX2krPKMfpM0VYfesUJCbHwRg5B6KZCOGeGRKJiLA3FMDeVKpqIvViq4iMSLtUivZ2B1berPo6kUdPgL8BdQ39exwRCdEf5+WcQejpkX/oWpd3xnNwusgMp3KozWHHz7b/Aa988g/ucUS3XrRIbNNB8HWvJgLbz57ThuyKAqx66ev473VP4uvL7nMrWYF6oIH/ZPHVc+F4J/buy+bhdZ3hrKwtUzuhjQ4kmoKg84tiS4xI/p28uggGZm4FTlCQ1FaH2WVncCUzBwcP5WDatChMnRzJvbpIt4vacFp6GepqW7nIuq+fASGsHQcH+fL2TO14IBH7KzlVqGb9gLTkNEFkQ4VoRGOTDeXl9SgtqUFJcQ1Egy/GT07B8vvWIpKND4Pdz8a6ehz84APUl2ZhxeLxvN85QZ6YBw7msAEiGvd/6yswmtW/WasvwdGiho1Tf2XXuleWR/7bss8bWuB40gcSGfZa34oxCI88K4jvkzHkjTq9CMcf1kNczM7z4FUeytSxeQDKc88p8nbPHGt48RJwZL2aH0Sz0d6Btho4Rvw1M+OQ9BJcCeAPhDh0uy9shj7mkUq5hq+gpm2/XWQrot7+uh7Q2vzwhf/P3nmAR3Wd6f+dXjRFZdR77wUQIHq3sY27HTuOnWyK1940bxKn7OafONlnN3FN2ySb3c3aWa8b7gYDpnfRRJFQL6j3OhpNnzvzP98ZSUggQIAAY98fz3lmGN259ZyZe975vvfzeWuvfjX8ZpImy1d6foMnvlcCyZVV6Llm+BLYXl3psaWNNg7rhzNuInw9cUH4jgqyVfB7zIhcY17webewSd+zrOdcsSn8KPSra8jM+PP63n4J3j++MCPrunFQRNIPJdJ/ZGNy2lGr7I76+dH7mk/9j1dsRrrFdGVxEL0nbpJI3m9LpDp2b3rXdJf3+cWoGUGAsEEG2a+mubhc6U+XnDGj92kwi31uzKIxL59QSHyi8HMVc3pBgHfGftzzQZLP9nPeFb597sT/TF3izevb0NQ0cH9Bvj/61T10BhKVAYrAJGh1Otz/+DdQsncf3v9wO+bPi0V6mj9FmUSutbdkoLV1CBtf/jMik7Mwf9UqbgI/FcFhYezvK3lz2GzcyLq9sQnFx1ow2NsLtUaFwGAjDHoV98XSqGVQq6RQ0BxbSuUbBS580aSevIdISOjtHeHpfiQkUXQLTZhJE6GIFhLLKK0wPFzPxTDyOppq4k8+XydPteGeu3O5J5IiOBVSzahvsM8Lwd4PYaQTgrVrUprhGBQFRtEwtbW9fP05efFIiKP0yrMiHYkgTpcAu2P6kZ4TTTdO4foJW7TX9tHn9ElOwtplGc5cATsqDuGn7/0BNV2jNjXsMsljVZBoLnMY+qgooA/evrPRcy6PG//0we9Q19WMFx5mU2PJ1ct1aqWM9dPJ044lS9NZPxjE7j1+gYvGSWJiCE9P5KIomw66WENfBY/+k+siIAuIhExr4hGAJHYpQlKRmDCEUFMANnxcjjCTDmFhOu7RFRtztuLoWNouCV6DrLW0DnIhiGtAlF7Itq8iPy+VnB2vhP+dhGlKr5XJ5bwSo08ig+CTws1OFfVNm93N1ulmy9gxNGjB8NAwT0mOjItFfN4iLLonCfrAQFwKMp0v2bMHjeUnMTs/AktmZU+K0mptG0Lx4VYUrrwFuUVF4+KYx9IGd//ZOVdj4wBF7d2Uv3Tf7PzR5+36oUTxtOQyQ6nZl/5/fk8iLf6tz9t96aUvD0oH+JpE+nUTZGTgOX+m138FvPcivP98WQYFnyLofP5QIn9HAskPLvOtWylN6ZrslMi1RPBB+OmN3gmRmwtKPRlN4fr9jd6Xzwvse+X/PQ0ZpQhdjq/kNcHHo0e9f3czpONNhxd83n0/ksjfJp+iab4llN2d/5o9PnEt92smeNnndbDv9I/Yd/pjl/dO34e7phNV8ilgVNSadnSwMIM/wr3k81awz8IGTNNEfrQ64vUUtq4hvv+6nFTH68mUwpZrePjDurre4fy8aMPYBNTVXcpT7uT6aDYJlmLuiuVIzEjH1vVvo66uAosXJY17/JBHVkyMEWca+/HRf/07gqOTMWvxIkTGx18wooO8uZKysngbg8yrSeAy9/fDMjSE7iELHGQM73Bwg2uvP10cUhmbkHs8PCqL0rIS4oOhUit4OqGKJvIX9QaS8HRCEq4oYkbGHh3DdUhNGeCiFuEebAClGnsd/RCs3fAJk1MMKVWsv9+Kjk4zn6STh1FSchRuvXc1F+UEex83vj6XkEA1egfscLq85/3t3G8MmjVQnP7cuXNx7NgxXM+kVpJhSPoRRvejFFcuq06HD07sxNf/52fw6SSQJ6n5p4HQ6YLQ54FELeEphiRwSVRTC1JetpzP6YXPwZp76u9eWbQSf6veiKFXLPjzl38Glfx876rpolBIYQpSnffruUwiID09HFmzstE/6ETVyTKc+rAMOtYn4mKDEBVp4JFc1D995CPF+hk1EplkAWGsT5p4NCBBojEJY1ZlOjQJGfDaByCQf5u9n3tQkUXVWNpufNz5QjL1UYfTDafDw8clVew8VjbMDeS9gl/8pbFJIpdSrYJao4VWr4M+1Iio9GAEmUJhDAm+aJXSc+lpb8fJgwfR2VCF3Kww3H9P9qSxSJFnh440weELxH1PfAuBprMRnoK1h6dBj40E2r+a2u7eAa9ly/SvjMhM8hKEV34A2SPsCq66jLeFyiH7q1Qiveta3AjTjdu3JNLb2M3NJ1fxa89MsMkJ4UtjHiY3KxJ417NPrssVtj71aYgiU+F7nk3qTt7ovRC5+WiG8Kd4vwfh3EsuLHLV0PfKUxLpF1WQUXrYnTdwV0psENb9yee1X3rRmwc2m/whu+um8zotKwI2A/nG0xLpK1dT5ON64YP3bYnfR+1y3nPTpCGym8ppV0NklP3G522a2e37NlxGgYel35VIoyb6ut6MsHN+RoD3n2/0flyIKYWtZzZ5h3/1pcBXOzrM36b0Qj8+NtE8xh/len9RFFNkJL743e/g1MFibNi0DanJgZg9K4aLSTRJTk4yISnRhM5OM45uehMWpxLpBbO5X5cx+NKV03UGA2+xyZcWQ9/7r//mESipqRe3zZDINZCqjJBpgvzpX6pA7nVEqW6UGtlRW4umqio0VnXydK6UZBO8TjNcPaWT1tM/YENLyyDa2of4BN0UEoCoqCCsumMZgqNTuN+WZ6AOnuGzgQokvHV3W3jKI0Fz/NAgErcccLrPzoemGqQ0m6fYsMcff5wLW1dU8uAKof0hqWSsjuhruHYzyPVHP8H333wOPjnrZxFK7pHlHRa4quZzCvBZ/ctJTexr6FxhS2AfxzYvvA4v5NFKv++Wg7Ux4XBMVGXza/LoovZ+6Q5Y/9uOVx//NZTy8/2xJuI3j58MpR6GBasnCTbdPRaEBAfwKC2fx876QCsC1RosvX0N62ta9LbUo7mmCiXHWzE4ZOdiVEyUEbGxQbzPkTebx9IOUINf1GluGcDp8k7EOCrhcrkRlRCP0KgCyGQy1tdc7JiHeCosF7ucQ/C5J9930L7o5CpeeTEkJIB7c52useGBv3+cC8MzhcVsRl1pGapOnIBSMoLszHAsvCdn0vmhCEs6luq6IcxfsxbZcwsnCd4kHjs6jsBvmuaHKkL29Vv/56X1n60bqpsJEqbYzfUT7Oa6DJfxCxm7suuehuwb7Ol/X4v9Ih8Stl9rlJC9f5mi2wzh+99heB//y4VMFW8iXmQTlx+wmxZ2HpOm+Rbn8E2QhigyGfaV8nELvD+70fshcnMymsL1BJswH8WFMj9EZhSqdPakRHq/HtJX/B6R152tTghf+NM1KghzI/mtz9vyQ4n8BXZep1v0RSqF7D9WSqRzP+2RTa3Atnh/Qfvp2kj0Hwd2X8t9mil+IJEGyyC7ZbrLkwg10/vAZqhsnbLpCltStd8L8w8zvR/XkSEfhPuosNSN3pELccEvJInP++HO3bXfXnd7Np9sc8hMvuMYfGFOKIL8YhNFcMxeshgZswpQvHUr1r9zArk54cjOiuQpVzRfpYqC1PwpelXY8rcDEKR6xKenIz4tDRGxsVAorzxixjYyApelG2kZBZDIlDyyjMQqf9P4Gxm9KwP8Ru8MivzqaGtFR9NpngLZ19mOAI0E4WF6JITrMTszH1U13Sg73eHf/wgD9+NqbOpHR+cwAo1qLkQsX5oCY2gEFMZ4yPTRPEXR1VvOI3DGsFicqKjoRGPzADLSw8aFLf/5kyAsRI3+IRdsjtHPR8n5EVtvsabRaLBu3TouZmiE61usgpJSx4Qt2peX4E/Yn0leLd6A7772K3788jgVF7V4KuGIwCOwuL+WScH/LplQedBnFeDpdHPjeEIaLPercVTcQEvtwlFG0jAFPjl9AE+vfxF/+NLlWRhoVDKEBKl4at9E2tvN2L27DsnJJmRlRvC0QRKayKuO+qIpivX59CII1k64zc3o72hDa9sgig81wmpz8WiupMQQeAQvOjrMrA0jPFyHB+7Lh9nsQFfbcew/vgeDZhcMpnBEJSQgKj6ee+AFhPh93GiO7XNZuGk9iWs+j8PfBAc3q09JVaK07DgXc0mgvlIocrK7rQ3NJAjX1MDnGOTplmuWhrPjnux3R4IWpeeWlncjJX8OHv3+6nEvrfH1mVvg7D7BP2vGoPTinex8er0SsRrTDYbdXDc8LVE8w0bUZdlrsJH5m6ck0l30/mu0X8PsJnPtHEifZSP++5gR+6FLQj5AP37e5/ndddjWdWE0HZHSMn4yzbdsmykjVpHrxvsuCI/cLBWvRD6dULTfjyRy9tknefpG78vnhdEfTx79kUTBbpLwHK6PqOj1wfficXh/+mkXca4Gdrf8nAEyKnZzvlHz1BQUQvZt9vip/v5nn/Mu9p3+Absv+tr03nHzpCFK/SLRtMUDL2be/7QEOFDod+m5dLQOxqsj3pTClr/it7DuJZ+39NJL3zgu+KHok8jmZs0qwM699VixNI5HJI3+hUcv+ZxmKMPyeWF3gry3Vt9/P+YsXYojO3birbdPITMjFNnZkdBq/BKIWq3gRtrUHE4POtrbUL67HLv7HVAGBCE8JhZh0dG8GlpgqAlKlWpa5t4arRZunxqK2DVQqCa4P/l88AgCRsxmDHf3wzxQh66WVnQ0N8NtM8Nk0iCCi1gGBC/KOc9va8H8BHR1W7B/fwNOnWqH0ajBogUJKGKvK5QqyI1xrCVAqtRzPyBHy95xzy2KsiFRoryykwtbJPQ9OD8Vcol79CyenXnRMVIqm8UqxZDFdd6MjGTRrazl5eXBYCCBTY6w6yxsJcCfghgUFITewUFQ/sJMRm21D3bj5+//kT+XRSjPemlRYcMoJWThPr/QNQWSABnk0RIIPW747F74bF4evTVxefLZIuFLopT4Q+VGkbL3Cuz//1e8AWtzF+H2vKWX3Fde/VCnhEE3tbRHUYu5+QmoqWrH5i2VCArWIodd/4gIPReZaPy4B+ugCE6DJnYJoiKsCEtqQv5wM/eaI4+6nbtqYR52cF+4hUWJiIsL4iIopSSORVGSfxZ5ZHV3t6LucCUObrRCkKgRERvHxWKqYkr+doagGKjUap5CPIZtxIIRWwlbZlqfxTxajVKAB/v60N/VhZ72Di5o2Yf7YApWI4bt05olYdBqY857r8sloLqmG5VVvYjPzMOD33r4fN89nxeu3gp+XiZCEY5bd9QhJTsTpSVls9lLx6a1wyLXjFYIv42HjL6cC6f7HjZk2IiRvfqQRLr0Wk2oR2/Gnn5aIt1Ev6ay5+nXYjsE+zQ56oPw9y9+yr/grwQB3vVyyKYlbHnFNMSbCRvrtz9/CcJvPiv+OCI3Gu8v4DdETrzRe/J54nmf+zffl0h3sc9p8uu5lv6S1ewb4R9e8Hn3XMNtfCr4i89r+6FE8WN2r/LGZbztl9+VSN/+9KeWed9m43RawtbNlIYomVSp9pJ0/JbNH16a4X2g+84fSuSbputjxvZ5wfck0jiKEpzhXbnWbHNC+Oqnv69fXO1PS0oIQM7Cr2Pj/76CRfMieOTSGG5zE5wjvei2hSEl72yl1KDQUKz94sMw96/Bif0H8O77xxEdqeWRKzSxHxOqyP8qKSmEN4J8qfr6BtDX1IrGkzaYzXYIPiXkai20OgP3+9FoA/gEXaFSQirze2fRhFsQBCjVGnz48isIiQjHyDCbtJuHYGeTd4pS0WoV3C+LRIEIUwDyV0YjIODC38MkRFGVxbp6f4wSmXHnZEfyCnIKtj9kJk+ClkQqh2e4Dc6Oo/C6/N65lG5YU9uLqqouGAM1yM2OQkxyEk+ronQxy4gTxcWNiIw08AqME9EHKKBVy6FUSidFbG0GVSUDHnzwQX685C2WcMlLO7OMbe9b3/oWfvvb3+KI1TpjwhYd0z++8SyGbMOQhSkgNU6RGncBUWsMEsIookuw+7213A0OnmrII75cvrPph1o25R2N+iIEMpWn36PY8++/+TwWJBcgKODCBUTo2kSGanlly3Opru7mqakLihJZ/wLy5qQjb24ummvrcLK0DbZiFzLZOEhNMUHBrqir+xTcA7VQhmRAGZoNpSkTiuEWpAbUICEhGEeONqO8opNHDpIXFXlnUaptqMlfqZn6P/naUaOqpISL9b++3hH0snX31Dm58EV9zuOVQqkJ4GbvlN7b19WNAL2eVzClVEQ6Gi/1LQ8VXHDB5XDCzq6x3ToC6/Aw3A4rpHCDKqWSL1g4G0c5i0LY2LpwtFdfv5WNg260dliRPrsQX/jOY2z7xknL0LWvPXUcUYZBSD2T/aebWwaxZ18jbnvkUWg8rThdUpZ60U4gcl0gYeppifQbbCSRyDjtwE3WxxbGQfZj9nS6VWSuiBd93t1PSaT5Ksi+zv77I9biZ3D1lIb5by9BePdm99O6EL/xeU/9SKKgqg1pl1jU5YVYzOFqYeeQxhL10ztwbSIw2Jec73W2pX9hE9TGm72Smcinh+d9XusPJdJvSSDbfKP35fMGfU5LJdKFT0P2MPsv+d1kz+DqG9k98bMWCK98FlLspwv7Xn+Lnc9vYvrVXQ1qSH8LfxTOp5bjwM5Cf9KN6RKLDrC78F3XY5+ulh9IpNEyyC4diTAKm+V9fO1+0OHpiNP1MZOw/aZCBS9e/XaFN32Qssmf5HF2fx1+9eubklPsHuVf2X31e9do/TPORVIRoZcJw2wSq8Z9f/8kPnrlZWSzCfJYBURCKlghM5/GrvfqsWTdXZOipYwhIVhxz91YuPZW1Jw8hcNHDsMxXM99t5KTQrjHz8RgLPLlokiUs55efsj02u5ww2G3s0c2wXYJcFu9cAtePinm+8Em+OkJcghs2aPHjmLFihSE5IZBrY6CTDY9s2uqnkim2rV1vVzYov1csyoNLa1DGDLbsWSx33JEFTkXMk0IBFsfXH3lXKwiSNAiEYJSrUisu/32LBhCY7mfFxmAe5w2lJ3u5ILXnDmxSEujPnj+GKOKjopzIsc+Zi0wMJD7a9nZeXC73Uh7XleXAAAgAElEQVSZ1lHNHNGjjytWrMCGDRtQXVY2Y+t+//gObK84xCOveBrhOXgtgl+UUlxE3BLYx5Yw2h8C5WxdflFLQhqZnAznpefVNaXILu/A2YjbLnMffv7BH/Hvj07tiUf9ja7NVKIWkZ4Rwa/oRxtPIyc7ijUfZAoVknILkZhpx2DnGVRUdOC990u5EMXTdWGDs+sE3AP1UIbm+FNa1UHwNe/GooV+8VWtlmPVijQ0sv55+HATGwcepCabkJIaOl7gYAylQjae+jvpHLLPc+qj1Je3bS/joqparYKn9zQEr5dHGNI4oqZm69ArZVAb5NCo1dBqDdwgfzrRkxRlduZMPxoa+qAyhCF3/nKseixvylRjJ+vL+z/+CCmRLki1ukl/Ky/vxImyHtz9ta8jMjoUA5XU33y681YickOgSKVRT4rLMpBkPeiZ70ukn7Cb8hPXat8I8iNhD39+SCL9axywjk286Je921gLuMRbp4LdEPo+EuD9P3YHu49ujm7WyofTx7eeXa1LeTBt/zT7LNwssLFUzB7uIVNZtf+GlwSuBbiyvjoGfbEdYx/rHzohvHYz/MoqcnPygs+7hX0XrGffBZ/qyf1nkdEfV96QSqRvfQ9Yze6g2fec5B722qXLVZ/PMPvc38zuil9vBbZ8HlOV/an40n8c9Y6bZqUkyRfYe15m42DrNd25q4Ciin4kkb/H9vUSlRx9H90sQqbMnzUw7WpWvmuQhjjGILA1GNz6WnXJhcF3mvb9qoUt1udIrPzZkxLpv7DJ0W1sBnc3+xxeg+mn016IVjaj3sI+C15j97wHbrYI74ukIsJKIpKrrxqG6CJ84ZvfwubXXkdfXyNPxZONTu7DwnTsuRUf/fXPKFx1KxLSMzFRsaIIq7wFRbyRn0/1qVPYU3waTusgYmMCeQpTRIQBGs3UP/xTeiBN3s+dwF8IlVqOYyUtWL4slXsbXQxB8HFTahKzyDeLvK9mF8RwcU0ilUGui0Rtax3iYs9u29G6nx2fdNwDiHyDqqq7UV7RhbTUUNx7bx40xgjIAxN5NBdF5JDn0sFDjTxi7YEH50Gt08PrMMNqdXFBjSJgLgTdnZJ8vnr1ap6GWFJSwl+/1E/pM83Yt6SWqlcmJaFtBoWt/9j1lj/lMHy0D1AElYuX6YPX7PGLT1L2VRMqhzTonC5LGYYtTp6CyL25YpSQ6KaI+KLILbYMT0Uc7bsSFfsIkEv8aYqjvHl4E5665VGkhMVNe/8pKor6qVarQnZ+GpJSonGouBoffFiGRYuSECG4INOGwpS2BIsjWjF7oJV7t733QSmPBMzKDKdSpHC0F4/2rbP7QxU+m7ok0JoSkK5WckHMYnHwaEJKc9SoFbzfka8VicMXggQrKnJw4GAjZs+OQXZmxLSP72JQ/6V0wTbWx6kpAoKRkpOLu1fnIzAkZMr3kEBYf/o0Tu3bgaLCMAQHndWrSMjef+AMetl0+eFvf5tHgDo7S+D2eNgllFinXKHIJF7wef6RPfzjddjOT9nDT6/1dq4G8pdgD+TN9j778lewnjZHClkR64WpbLAls5EWRGmS8N+Q2H3+4Fg24nz1rL/VCBCO/g4oG4vOmukw9qvleZ97+mVKL2u9HjLRna6R7rR5wedeMNPrvIxt/5U9/PVGbf9SjIpP5NfyO+qreiDHB1ku64vprI+yLyQJfWhTDncA66f0TUZ90smem9nzftanG9kyDeyupIzNUE9eb+8zdpNNZWyvh7fddYeNB4qo+9GN3o8LwT4Hph25cC1g3wUUNfTwjdyHibDr9RR7eOpG78f1YvT7aRs1qUT6dfbln8e+5xZJ4Usb/Z4Lpe859qhmjw72OMIee9lnBvu8kNR5IZScAEo+rd5KrH9Pt5jJVTP6OTZzFZUug+d93h5co89QNiaeZA9PzvR62ffqpau7XQMoHZc9/OZGbPtc/urzUrqJ+kZtf1SM3DDaeDQb60T5bNacw8Z4IutSMRL/ND5wdD+pf5MQR/e79MNtl89/71DJPkhOveTz1o+t+3rd87J+NGMp1RcLez9D0RemkQ4I1i6oAiJw99e+ikPbtmHjpqNYuTwFBoP/OlKVtRWLlSgp3oxju3dj7oqViE/POC/CIzgsDAtvuYW34cFBbjbdVFeP4mN17Cw7EWoKgMmkYxNdLQIDKVJEOe2IqzHIdJuqzO3ZU8f3Kysrgq+PJtMOh4enZVGaIxlSNzUP+NO40sKwbGkKN7uXqgMhN8RBro9lyzsglTXh0OFqqJRyLsDx6m4+f4RLU3M/jpW0cnHunrtzoQ0MhzIkEz73CFzdJ2G1WNl7m3gUy/JlKYhMymDfQG5e9a2zaxh79tbzSLBzha2JZ62KNaqrOGuWP93z5MmToFici9d+nHnGfrqhNMjw8HBUztB67S4nSltrINXL/KITbWOQTSd7z/nRwOuD0O3my1Bk1/h+9ft9tQgSqSaKWiRYeSnVUPCnI5IBPUVvkTE9j/4ic3mDDL4BD18vFeEjT7Y3Dm3Cz+/+h2kfA0X47T/YgBXLUxEe5oPWEIrV61agra4KB9nrIaxfF81zQ+0Y4P3DmJKG+UFVyMlux/ETLXjvgzLMK4zj6Ydjgin1r/4B6j+NCIlJxLAvCqakPF4t0ahpwWy9BrMKYtDTY0FNbQ+OHW/lIjMVPyAvOBoDJBbLWH8dMjtQU0N9zsL7W/Q50VzTgQRcGj8U8TU4YONphn39NnglakQmJCAuuwAL7k1FgOHCaZzUd+pPl+PEvt0IC/Ri9bJYPubGoJTfHTtrERydjEeeeoiL4hQZSVUlSTyED42XveMiIqOMfvkfHm3T5lNx5yTyuWK0r54cbSIiIiLTYlTkOjXaREREPme85PO2swdqn8sU8QtHbPlwuKtrmKcNUqqUJn4FpHINFq1di+iERGx5/13k54TwKn8EGcMvXpTEhaPS4k04vH0b8hctRlp+PmSy8zdD5tF5RUW8kehkGRpCd1s7ejs6UNfRhcHSLtgsZkh8Hu6RRetXqWRQyGVc7JKOGoBTihVFeVCaldPlgcPu5qmLPigw0mZFVXXp6ORZwtOpyGeLfIJMpgDcW5DHBQCpUscrGpKYJVHq0dZQj9Ob3kZbfQ0S4qnyYTIamwa45xGPLGLbp0k+CQe3rklHUHgklKYsXnnR2X0SXjYZJ7+l4yfbkJ8XjVVrCqAKzYB7qBFexyCqa3pQWtaOtbflI8ggQ8nxVqSmhHKj8HM5NPoYOVq5rry8nH66ve4/i46VMqOosYCAAF4ObCawux1wCx7IJkTs8bRD1WjqoDAavUVQpNWENE2K5PL2XfgHJp5qOHRONLWH9ZczDv+6KLrS5xfE5IlqnsroaXRi/dFP8NM7n4BMenFRlSKg6FqSWfwtt+Zh+7bTmJUfjbQ0tusqA+LzlyIiOgJlJ2u5eDV3Thz7mwCpOgiqiFlQhGRgaXAl+jtaeJTSCdZfqK+TqCWwfTMa1Fi6JIWLoBtf/k+o9CHImTcPGbOKoJK6IVjaEKlqR3i4ngtP7R1m9PVZeeVO64iLF2igCNKBQRt0RgPrt2rs2XcGKqWUR3pRhBeNCar2KWHjifqU37POn7ZI0ViU9uhwCrzaqEZn5BFUpvAEZGdHITQ6ivt0XQq3y4XK48dRcbgYESYpVi+JmhShSdukiMeSE+1YeOttmLVkMRfFfYKTffZQhKKPR4WxQzlyyY2JiIiIiIiIiIiIiIiIfK64oLDlsZoPNDWrBxcuSAiCxwFH+2FewQ1SORIy0vHwd5/Czvfex5ktlVi8OAkGvV+UoZRBErhsdjcqKvajZOc2pOTNRs78edAHBk25LZrE+qu3BSE1N2f8dfrhgYysbRYLN7Imny230wXB4+bRHwQZX1OVQPL3Ums00AQEQMsm2w6rDe/85c9YMDcVKSmhXAmSjkWQSaTc+0qui4BMF8WfU+XEkweOobKkBAFKNzIywrB4dsF4xFhkpJFXOSQT8K4uC4KDtbh9bSZUgXFQRc6Be6AOrvYjcLH927uvnott99ydh8CoDLaNCDZBPw6v246jx1rQ3TOC+x5aCYXPjIaGXi5IkDgyFRWjj8pRjyILOxeXlhL8UP3R11nbxNpp+GMOKdKLSpndztrddL2msR4H/KWvVOwcJycnw2azTS+ReBpYHKPZZROUOvLHkif6t0BphnD5eISVLFY1HtXFoQgt9agA5vH5I7SGBW4iT/gs54haJGBFKXkKos/tF8vo0dvv4dsngYuM69sHulHeXof82IsXVSOxldLvSCxNSwvj13TzR/thNjtQWBgLX2851BFzMGdZFJKSKli/qENr2yCWLkmG17kHiqAUqKMXwqTU43a9Ch9vqkRbmxl6gwoFedGs35p4/6NILPLEouisqvL9OPTJZsRnZCOXjanohJXsuK0QLO1I0HUjLm5wPOprDEqzPXC4Hfc+/iQ3j6fKizSeyOPK5XSy8eSBVxC4P5hUKoWMxhPrb2PjiRo3mJ+Gx9ZEBnt7UXb4MFqqTiM5QY+1q2N55OOkZQZt2Lu/AV6ZAQ99+zsIHRVwKXzO2XGEXR8b/29zy2Cb0G0WoxdEREREREREREREREREJnFBYeuZj7y2Xz8S+AabUH6LfH4o0sjRcRjqqCIubml1Otz5lS+jtqwMmz/eiNQkPfLZ5Fs+GlGj1SgwtzAOszxenDnTiI1/PQq1MRxZhXOQnJ3DJs6XlkYkbJJN6UjUKFLkcqg5dQrJScFIz07g0SZSBZucKw08WkaqCWKvqeBxu3Cmphanj7yLgY5mpKaE4LZVcTyKawyKJmlsHEBZeQdPvSycHYut22uwamUaFx0ExwBsjTvYBNzK06W2bqvmgsTswjQueNHrJAqSGLd7bz2PArrni3fAZ+uAeciGo8eacc/9iyCV2nm0zbnaQc/oI5nGE2FhYZfMo6EYpt+z9m/gpnaTIKffOtbeZI0ckL7L2vfhN5mZCorM+nvWmli7f906aDQaNDQ0XLK0xnTpHR7wP5mivpjXLPCoK4rekpF31jnm8SRgjYlYnHPs7cbEq/HlNf6qiIRkzGdLzZaz+k3keTqi1b8j7YPdFxS2KJWVqg9SdcI1t83FB+/sR2ioDsHBctzzyJ3YuXE7du6q4+mnvo4j3BTelLkG6wKDUHKkCh9tLMfaWzKg89XCY2njghH1pVUrU/Hu+6Vc+CLftxOn2pCVEYHMzHAedUiRWdRcLoEXOtj77v/B5VMje+5cJGVlISg6FVJ2Ir2sT9J49TqH4WX9LzpOi+RuB1rr6pFbNJ9HWU0n0upKINGsjn0mVJ44AalrkO/77DvTxyMsx6BjOHGyFZXVfZi3ahUKly2HTD56LX0C+6w5ytMQiZ6eEdaGX31m16fT/0FERERERERERERERETkxnHR0tIut+Q3JcdbvxEfF6Siybdg7YGj7SBU0UVcGCLS8vKQkJaGQ9u3490PSjC7IAopyabxiSwJXRTNQm1w0I6a8n04vGUjQqITuMl0fHoatLqZn2RTlIlHEQ5t0lp4vQKs5mH0dnayVoHejk4MdHfB4xiGKUSLrPQwRC/KnxSRQhFX5F1UWdWFyAgDr0pHgldjs5l7FBlH/cXGIkoobXPXnnosXpiIpNxZXMxw91fBPdgAu92N7TtqEBsbhHmrb4Ew3AyPy4Gdu2qxZMUs6PRsX2127N1fjyWL/B6JY5LMWDJca2srf1y+fDleeO45lLPnZ2PbztLGGpX/OjCNc9TP2jPwu+k+xxqVYxqTiWj7VKqJHKgpGcxoNOLXv/41ent7UVxcjG9PY/3T4ePSvf5oqSkM33nEFTsB8jjluOE7f508tdj/J0VvEef8l3y7BMcExYxOppfe76+yyNdJUV4jAn+ciMtz4cIgbrcXe/fW4/778hEQoMLyNXPZtTyJe+7KhULWhVsfvBdHtm/Fx5sqcMuadLbBMsiNCdDEL0dRQDhMZSXYyP62akUqwsLOXmuK/EpMCIZlxINlS5J5qiNV0nzn3VNITjEhNzuSF0QgkYtSgKkNDdlRXVOKT0r2s/e5oQsMhikyCqFRkQhlj6bITC5CO46/C63+2hQVJL+8xupqNJSXY6S/gx1DEJbPD2XHc75Bvb/YQg9Pu4xKSsWXf/AVXkF1DJ/ghrPjMARb7/hrx0+2Wpxu4d+vyc6LiIiIiIiIiIiIiIiI3NRcVNh65p3BM7/6UtDvyyu6fpSb408REuz9sDfvgTq6iKfwEUq1GsvuvBN5Cxag+JNPcOr9MswaFbgmikVBQRoUzYvH/Lk+9PZa0Vi5D8e2b4RME4TYlBREJyYiMi6OT8SvBo/bDevwMJton0ZfRyvsFjM0aglPHwwJDkB2ohaBBfGTjKvHcDo9KK/o5FXnyIh+3e3Z3A9IqgmGMjgdcmsHrGWbeHQWiV9d3cM4c6YfPb0juOvOPETnLIEsIIKnUdHknFKttu+sReGcOGQuWA23uRle1wj364qMCkJyfiGcncfR1NTPhY2w8MlVeuNHHzdv3oxf/OIXvDpiTl4evlRWhu3s9bAJy+6DvyxN52WeL5LMHmHt1/CnKJJkSZUYDwLj6Wkvv/wyUtg1euyxx2C1WrHwMrcxFX0jg/iffe9DFqEcF6l8Di98JDQppfBSFUONdJKoxT2yKD2RvaZIuUgRCrLPck0OA/NaBHitjnERi0doeXGeqEXIpBcuimIKNcBg1KCBXfeUZAkSs2ejrbEVh4808TRcwdKKBbfdDWPxNmz8uIJdszSEoIlddwvUUfORXhSKAN1ufPzxaYSF6bmPHYmnSqWce1rJgrOgjkmGbKAGRfOVbCxFc4H1ww2neaGC/Pxo7hNHUPGDovn+XkJ+cyNWJwYGRjDQWYqT5cVcTHb7FHA6nLx4A6XzUorh1TDU34+u5hZ2zI1oP9PAPkTsiIsNxLzcYDbGc6d8DwlaJBSfPNUOXVA47vjK1xDH+tNE6Pw42w/zxzGamgaoPffMekvXVe20iIiIiIiIiIiIiIiIyGeSiwpbhHvE/MsjR5vviIo0ZFOVQYLS60jcUoblQRGYgLFQmSCTCXc8+ij6OrtweOcOHH+nFFmZYbzqIBlVj0FiF/kGUaP6jhSZ0t7ehtriSuz/0ALBp0JgaBifiBtDgrkvEIldao0WCqWC+/14yeTa7eYTdfLgMg8MYKCnFz3t7RgZ7EFUhA5yqQfJMQpkZU0V2zQZMr0vO92B1pZBZGSE47578vxVEpU6KEzZcPr02Lt9F1prSpEYH8i9sihNsZktT0bbhYVxCIsM42KfvXk3P0ctrYO8KuLKFemIyVvBfZC89n4uhJEZ9gNfewiCtZevp+REG09Fk6knV6xbAb/gVFJSgtdee40LS3/84x955Fae14uvwu+bRSbzH8KfhnilnB5t5/KrX/0KCxcuxEMPPYR33nkHFIdzy1VsZ4w/7ngTIx4b5Ho1N4gXetx+UWsiLr8gRQIXpQ/6nH7Ddy5GUZNLxsUuiVIKqCQ8ZZGnMdrPyW+k/3rPiljjpvRTEGm8cOorGcPPm5uAbduruPjpGenCwrVr8e7Lb6ChoQ/JyWyXLK3IXnw7DPpd2M6WK5qfgIQE8L5BonBYVBTyc/tx+Ggz6/tDiIkJ5MdFQtXxXVvR3ZaLojWroQ1yQNpXjlkFcu6zRWb1m7dUcZGWjOopNXF8v6QS7nVHjdKHx2hvN6P4UCP6G47htb07oNAa2fajERQWCmNwMPekU6s1kCnkfGySf53H5RodWyOwmIdg7u/n48sy2Aedho1ftl0S4+asjeeC3IWwksF+VTfKK7sQFB6N1Q89iqTMzPOW8wy3wNV9ChOrTVutLuzb31Di8phfuOAGRERERERERERERERERD7XXFLY4l5bD+kf/XBD+Ym1t2ZIKA2P4xPYRPQkhJFOXuFNIj8bBWKKjMC6Rx/lYtOpAwfx7ocnEBmuRnpqGKKiDOeZUGu1SqSmhvJGuD1eDJvtGBzqxnB7M7prnDydj6KpSESiyBTuSySXcvGJ/Lz0bDIfGqhBVlEwDIYo/vf+ASsXARRsGao6eC4URULG2hRJ0t9vRV5OFObPjefpk3Q8ypAMCMowHN6zDw1lx5CXHYa5d+dwAaGtfQh79zXwdDASsLIywnkklqNlL5+cnyptR2NjP9bdkYPglEXwOoe4nxL5aFFkz933L4IyMA72xh1oah5EENv30Oh4XgluYkodCVtZrFWy9sQTT0ChUODhhx/Gc889h9/97nd4T6vlFRPT0tLwmCDg3Xff5QbzM0VWVhZqa2v5+mm9FM31X6xdJFZq2hw9U8YN3931dr9YNYXORD5ZQvtoDUaelzkhXbTDBWmg3G8c76ImACNXv19GjQ65MalT/o1XDvTYYYpJgimkhXtdpaRIoQnNxq3rFuDDd/bBSFU30cV93WLzV2Ed65/btlViiPXpgvxo2Fsots6LzMwIlJ7u4CmGdQ19WLo4iY0PI+az/l1T04O3//g7pOTPwbwVK6DyDsDVV4XsLCkyWV+rZ8tTkQKlSs7/T0LWRPF4jIYzfTw6cO2tmQgO0vLXSDCi/j40WI2WFod/bLk8EOg8sn/Uv6n6KK2PqjTqAlSIC1YjLykYOl3keX5Z50LjqrV1iI+rtg4LkrKycc837kZUfDzONZHzeRxw9pRy0XciFOm4+ZMqj2XY+egz670zVYRTRERERERERERERERE5DPGJYUt4hSsp+dJdL37itvD5s1yIzn5rHW4YO3i4ozClAlFYBKvODgGRYMsu+tOLLr9Nu6/U3H8BPbuL0VMjB6JCf70qzGz+Yko2GsUHTYWIXalUNrhnXdkY9eeOpSVdXDhjNIKKY2QDKkHBmw84oXM3snviMQwiUILRXAafOpInCg+hMqjryMrPRj33pUNmUzChbXiQ81czFq+NIW/v7l5kHsfkTLjdrlwsPgMr4x357ocBMQUAl433P01GBlxYtuOGh7BZUpdAM9QIxcIKfVx3tw4yPUxcFLUygSBhy7QX1hbDb+B/COPPIJXX30VTz31FOrr66FWT5aYnn/+eTz77LP485//PG44fzVUVlbyRnLEPNb+wNr8q16rnzkJ2SiuPzWlcTyxMKUAdd0t6LVMNJifEHFl80KwzYzmoVNpYXc7IXgFLEmbA5VCOeVyJKqSGCMLCEdeXhQOHDzDU249g/UITirC6lU92L6zmvc7HRp4fwpJXYi7VFJs2VoFi8WJhQsSuFm8Wi3nVQKzsyOQkBiCPXvr+JiYNzeem66npYWiorIZb/zuJWTNW4DZS5ZA5uphfakWaakSLtZSlcW6ul4cOdIMg1GN8DA9jOyRzNnr63shV8hwx21ZXGwbg/oqtbi4qauUXgkOp4dHhlFKbUvrEALDIpA5azHWfnX21KnFrJN7hpvg6q1gQ2DyNeR+dXsbIfjknT97Z7j2p+tnbDdFREREREREREREREREPmNMS9hav94rPPdYcOVdj3417JN3N2BwyI45s2PGI698XjdcPWXwmJt5eqJMOzk6Si6XI72ggDeqmtZUU4OGigrsP1QJvVbCJvN67jVkCtFx4encyoCXA4lCFNlF0Vq9vSM85c8tyCCVq1FyvJULBpSqNWd2LEJCtFxgIDFOpg6CnNIqNREoP3IUpQffQkqiHvfemTEuvnWxdZH4EBVpxAP3FUCpUkARkgmNvgE1tf6UwtPlHejvt+H22zIhVyjYawI7N6f5Pm3ZWo15hXGIyciHRKnjwhaJXRQxExEdBXBfJx9s1skT/SWsvcXaV1izsG1s2bKFN4PBwCOpXn/9df5ImEwmvPjii3jyySexdu1aXsHwarmTtWdZy8BZM/uZYHnGXPz7jtf58wijCf96/3fx79tfR2lrDZLDYvHGky/gpU/+Nr6MhP3zTRXWdYWkhMUh1BCEQ/Wl2POTv+GVAx/iTzvfQF5s2gXfYx29NiTGhMcmQPDUcxHTKG2BwpSFqLRZKBpx4JNtfnELveVQhubyKqCzZ8Vg48Zy9PWN8LRChUIGiVwJfWwhNP2V3HyeTNU/+LAMy5Ym8zFBy1FqbHl5NV77zVEULFqM/AVLWSfvY+OtEXFxUsTFBnHBra/f3+eHh52orumGTKmFYHNg34EziAjX8yqOIaYABGiVl4y6uhi0LRLo6Di6eyzo7BrGkNmFiNg4JGcvxNIHsxBounDdTME+wMZEKa/ceC4U5XWirA93PPIQPvzf1yu8Xu/MXXARERERERERERERERGRzxzTErYIQfCVWDorlz/8rW9i69vvUJoQVi5P5ULUGF6nGfaW/ahtcsLi1iFn7lyEREyujKbWapExaxZvJAT1d3ejo7GJV/07Xt4O54gZKiVgMKh4ChStX00CkkLKRSgS0+h9lO7kcgtcMCJhiAQHmmy7PFKodEZeGS48LhPpS+JhCA7GG7//PW67NRORkQaQRCJV6bkAJ9OGQao2wtzbjfqjp1F5/DXEx+pw1+2p4+bytK1jx1u5f9LSJcmIjQnkXlqq8AKcPlwMj9MKs1nJvYZINBgYsHPxy5+uWcrfv3VbNTLSwpCaHgWlKQsecxMXBGvrennEjzI4mVedJMzm8yOt7mUtj7V/ht9Li+SV4eFhbuweHR09vpzD4eBRXGT0fuDAAbzwwgs8ZZF8k66UjaytgT8lciZZkTmPR2VR1NYTK76ABwpvwa6qI1zY+oeVDyNQq0dmlL9K5NeW3oeH592GL/z5+xiy+VMt9eoAWBxWKHxSmFwadKqsSLLooWJ9oDrIzCUwOaTwTBESRrLOq4//Gk39HTjScBqJoTFINEXxvyWw5xeC0glJPBWs3VAEJSM1tZRdwx7MLYyDe/AMlCHpSEppYX3SxcWtdbdncdGX4BGKChkXlcjknfquTOLBiUMnMG/VGrh6y9h6pDytcM++esTHBXMBWcneQ6JYdhaluJ7Eq8X7kDOnAKm52QhMnMPG3TAvVKsTID0AACAASURBVBCh6UFY2DBXd8mQfv/hbtz/xPfQ29WFzqZm1Le14dDxRjisFja2/Om7FLlFqbyUdkhCm3+M+QVi6rfu0TFms9EYc2KYjbGRERdUWh1Co6IQEZuH5YsSEBkfD4Vy6ig3wm61ovrUKXgsnciIl5wnrFEhhuLiRgw5NHj429+Gte04rCP2ksvpTyIiIiIiIiIiIiIiIiKfP6YtbMHnPdB2pvHpuNQmrHvsUZQWF+ODj7ZiQVEcEhPOGlXTpDg9UYUzjV3Y/fbL8CmCkJSdjZScHJ6aOBESqUwREbzlLSjir3kFAbYRK4YHB2Axm2EfGYHDZseIywnBKcDr83IxRy5XQKFVQWvSIFSvh85ohCEoiAtn9PeJdDa3QKtwISYlDXJjHGQaE9u4DH3tjag/VoyGyiouQpER+O23pkwS68gTa/eeOphMOjxwfz5USrbd4BRIDQnY8+E76G1vx13rcrgwQAbdVNlQp1OOR3mRCLdnL6UMKpCbGwlFUAokUhncg/5IKhLL1t6WC5k+Bq7+ai5AWW3uKS9BMmuUlUUyST5rJGiRp5ZKpUJ3dzdeeuklJCQk4Jvf/CZfPoKd13/913/FX//6Vy6CXQ0/Zu1u1uKuai2TkUqk+H93PYHbf/MPyI32e1qlhvsr/OnVfj+oUL2/zzy15jHEh0Qi3GDiwlZGZCJ+tuZxPPa/P0XssBZRIxoEauQIs6v59bdY3GjX25DtDEWpqhsPz78Njb3t0Gu0SDTF4I3Dm5ASHgelQgGDJoC/JyjA7x8XExR+wX0mEdXjESCx90MVNR+p6bH46MMSFM6J5RFUypA01j9SkZVpR2fnMJmfY/myFN7XSczRs/5BKbbdPSNYvTINBfkx2LmrFv09fVjz0COQBXQjVFLJixccK2nhlRAp5ZXeQ31s/rx45Oa4UFXdhA1/Ow6pTI7krAyk5ObBFLuEx7RRgYJIfQv0pe3o7exEfFoa4lPPeoa5nE4MDwywMTYIy5CZjTcLbGyMuWxOdmxuNtS9bH+lkMnlXKxSB2kQHqvjY8wYFMwLOlAl1HO98s6FttNcU4O60+UY6DiDxHgjj0A7V9SiiqI0RpLy5+GWtWvhtTShpr6WHYlk/2V2KREREREREREREREREZHPGdMWttxe6f7WtiG3q69KQWl0BYsWISYpGVvXv8W9fBYuSBz1mfJDIhE1l8uD1tZq7H37EByCBlFJqUjMyEBEXBxkMtl526GKhzqjgbeZIjwmGm6JDjVn7NAF9aGpej9a62qh1ch4dMyaVSnQBUyONqEMqJOn2ngVusULkxAfHwSJIgCqiNlwOLzY9J9/QaBBittvy+IT9YOHGnmEy7KV+fhoYyVPC9OoFdh/oAGNTQNc3Bg9QHiG2+Bz2zAwaINcIUVQZCI3JCfvJoqMofVcjL7Rx97eXhQUFHAxjIzdBUHAL37xi0nLUsTW5Yhai1j7LmufsLaNtTFLb4ohe5W1/zftNU2PeYl5CA4wImM0MmteYi5/dLic/DHSaOIpiPIxsXJUE/mndY8jQRmOjAEDgh1KSH0SxHqNmLt4LhcTXQf3Y1DjQohZhtj0cDw491a0D/VgxGHjwtXmsv1QyhVIMEVxoYtWa1AHQMauD6UoXgxKHw0KkvFUOkNEMrTaUi6AhoZK4DY3c+GSIA+rHTtreTGEJYuSeFSSkh3rkhUFKN5XxgWtVSvTsPbWDF5lc/2f/oQ7v/xlGOKWw9lVgqL5UnR1WbBzdx1SU0zIz4vmfY2KLVAkFzVKg2xq7saOd9bD4fQiLo3GVxbsVif6hgRExp1/LEqVCqbISN5mmqH+fi5mNVZXw23pRnSkDvkpwQgsPD/ej6LBKD24ud2B1Q8+ygU48uxz9Zajrd3s8Ajm4hnfQREREREREREREREREZHPFNMWtp5ZPzjw3GPBB61W53J0+jOETJEx+OJ3voMTBw7g/Q07kZNpQm5O1CRDeErPI7N5aiQW9fb2oP5QLQ5vckFpCEN0QhJikpN4yuJUQtdMQMJPQmYmDnyyHW6PwEWm2Xdl8RSvcyFRiYSo0tJ2BAZqcP+9+TzaSm6MhzIsF211Ndj2zruYMyuSm3eTiEJm8R6PD8tW5sBjyIXddpxXrOOVGfut0OtVMBj8Ju/ktzWmzlC0VnKSCbKAsPE0REpRuxRjhf9cLhcGBgYm/W1wcLJv0cQ0xelA7lJfGG0Ca7S3JHJR+uMuzLywJWfXvDAxmwtYRH5sOtQKFSIC/T5tMcERfBmzfQTRQeGwuxxIMEVjbe4SVJ4uh8muGl9XXl4ejEYjT8eU+SQIt2mgVWuxND0D3cP9CFBq2PV380gt+aj4JJfK2d/n8OdKhRLpEQkINQTjYli4sKXl6YgyXSRS2DWkaxkaquOpp2MG90Z2zem6NzcPwCt4eX9wu9h1C8jCwiVeHNxfju07a3jkFkViURXNd/7zv7Di7ruQnLcC7r4qREjqcO89ebyy4Ucby3lVxfi4oPGoJzKKz8+L4s3h8KClZRCb3niTUodRtGYN5BdJD7xaqO9bh4fRTqnEDfUY7Gpl59iNmBgjlhQGQq0KvOD7qKrjsZI2pOQX4rGH13KxjSqsOjqOwuP2oK1taNcz670zUONSRERERERERERERERE5LPM9FMRGR6v7y02IV1Ok2hnxzH4Qm087apw2TJkFBTgwJZPsP6dU2zyHYWM9DC/MfsEaDJOVQSpERSx0dNbj6q9J2C2eLhvlSEkHGHRkQiNCEdgaChkCvVUu3IJfNz3qru1FXUV1ehqrENCbAAe/VIhN3cvLe1AWKgOygmV4sh0m/yuzjT287/Nnx+PmOhAf5RWeAEkahMOfbIFdaXHcMvqVAQHafkEnYy5SWJYtiIbstC5eP+vr2JWbjDSUkNRdrqDp55ptMpzPK583Ii+vKILD9yXD5/HCcHmF7as1ktX+SOpirb5APzeWwnwe2/tYW1oaIgv097ejqioKF5F8ZlnnuH/vxBz5szBiRMn+PEkTnidpJ+C0fYTnI3emmlWZhbxSClCp9YiPy4dC5Lz+f/JZ4uEJ4q0Etg5zIpK5tFaKrnivEi0xsZG/tjV1cUfo4c1SMhLQEpSDgoTslHd2YgIYyjSwhMmpauuzVvCHzUKFff8upStOnlMEXTNpOogJCQE4+13T/HKhhGjfZsgeYv6OvUBEnUXFCWgo3MYG159Aw984ytYtMSHQwcqsHV7DetT6Uhk7w8ODsDOLR+jpb4JS++6C2pdFKTdJ7F4oZQbtVOfOXS4iaf/krBqMp2tHErXr7q2h79Onl/lFZVY/4dSJGVmICUrHUHhbF1KWv7yjePJLN9uGUJfVzd6OrrQ29EJx8gA1HI3P8bsOAMMORePdCPfLqomWlLSAm1wNO75+28idDRqjFJzyWOMFmpuGYDd4XrzsndSRERERERERERERERE5HPH5QlbdvP6isrOZ3NzIgNJF6CUIcHeB1X4bO6/s/bhh9jEdxkObduOk+tPITsrHJkZYTziaSrIrDo6ysgbQRNfq3UEfX2nUFVnw7DFxebgCkhVOqg0OqgDdNAEBEClVkGhVHChjPyAPG4XnHYbrBYLrOYhNuEeYhNxNxefkmIDMTcjZXybswpieLTNBx+dZvsXwT2T2trNUKlkXBC4/758bqYNqZz7YSmD09DX04dt//NHhOg8vHIdRaRRRMyuPbXc4H7BonQoI4vw4f+9jeRYJRe1BgZsOF3eifvvzUPvgAf1de2IjfFXr6uo7MLhI03QaJQ8mss91AAI/kgtErYUU0SSTYSSul6Bv0riGH9mjZL4xiK4yDCexJvnnnsO3/nOd/CTn/zkvPXExMTgb3/7G1auXImlS5dys/n0i2z38mK/ps/9hWsm/f/bqx6BgV3vMf702M+48CVjx/PWP7w4/rrZbJ70PkrNJHFnTPAi+YZ8xr4wby20SjVUCiUijaE8Aixt1MuLmJ+Uxx9D9UHIvUhFREIul3ETdcLrssDdX8VTA6nQwMaPy1E0P4H3K+qbjY0DiEuIQHK8jvc38tyKijRgVo4bG/5vPe792pdY3/Gh5GgNNm+pxNpbM3kE1t135eBYSSte/93vseYLX0BU/Aou/ETIahAepudm7hTxdLC4EXaHGzHRRm4ET6It9W/aPkHiFvW39o5enNhZixHWt5RKFfRBITAEByFAb2DjSgsZOy8Sdm5pWY/bDafDCbvVhhF2Hm2WYbhsZng9TqjYMdLYIb+vlAIt66fTc1zjUZDsXJwqa4dKH4blDzyKuFHPLx/r965uMpU/K5uWV3T1DPYPfzCtlYuIiIiIiIiIiIiIiIh8rrksYeuZ971Dv/5S4J8qq7p+mpPtj7QQRrpgt++EMjQLcmMCN4K/88uPYaCnByf278f6904iNkrPI7ioIuHFDKfpT37zdRX3vpoI+RM5nRY4HANwWQV4zAKfiNObZDIJ9AoZQsMU0MTp2YT7/BQoEs16ey2ob+hHY/Mg1AFG1NX38sn/7Nmx4x5bEpmSpx2SqOV0+bBv8ydoKC3BwgXxXEAgXC4B23ZUIzLCiMK5KVDFLMKWdzYgUG1Ffl6iX/TaXcd9xzQBOqRmLMOho3/Cho3lkFGaps9/nGqV//ST39YYQ0N2bhJ+MSjO7CvnvJbJGiXU1dfXc3HHYDDg3/7t3/D000/j7rvvnlLY+t73vodVq1ahpqYGpaWl/DWSePay9tRF9+AyYNcNBQWX/bafXeD13//+91i2bBl/PhadNoZCocDcuXPR0dExfjyUmkiiFhEfEjW+7NzEnPHn0tE+GRUUhszIpIvuF4mew8MO/3/Yefa6/NlyAQH+qCxKJ2xs6ue+YIPDHnz9ga/B01mM5UuTsXNXHe67N497z9ntXdj81vu480sPonA+oDrZgI2byrm4RZU1i+bHo7NrGNtefxnRablYeMst0CbGwz1YD4m5CdlZ8nFhlpY7frwVPqkaVdU9vH+mJIdwsYsENqriSY2gfbTZXBgZGYB9oAcjLg88AsWW+UaLMki5SGdUKxAZpYBarWevGS99wabAzM5TTU03auv7ERGfglUPfQUxSWfPr2e4hYvj5C03RjMbmx3t5t88/4nXekUbFREREREREREREREREflccVnCFuHyDD975EjzQ2zSnEJePwRFXTi7TsI91AilKQuygHAEh4Vh9f33Y8kdd6D65EkcO1YCy556JMQHcdEqIsIwyYvrkjsqp0m3cpJB/aWgyBaKkqH0p7b2YRhCI5GePx+LHshHf1cXije+xT2u5Boj5LpoSAPC4HDL0dzUgjO7N6KlphKZaSG4/96c8bRKEjW27ahBTnYEMrPjoY5ZjL1bdsE70o4FK/xRKFTNjlLEKF1MGZqDo3sPITFGhbmFqXyf3n2/FLesyeDVFifS02NBbV0PF70ksEz7OMeg1MQfV1fj+PHj+P73v4+KigqcOnUKy5cv5wLPuRFO//Iv/4I//OEPPHXP6XSCXK4otq2GtdLL3voFIEWxdMbWNknMqq2tnfQ3tVrNfdo0mrMpphOfT+SJFV847zUV61/zknIvun26NpSumtFhHo80JEh4XbUijV9TEq9UKgWPytv50WasWbcUJs8RpKaG8sqZy5amcFHKxvrJzo8+wZp7b+fRdpSySlFfq1em8/4TycYIRfyVV3Ti9d++iJgUqn6Yg5ikJdDIBX8qpKUdiRoFF9SSC1cjIT0NNadKsedwKdzWfsTGGBEXF4xQkw4UZUlC15h4PNPQpR4asqG5ZRANZ/rh8amROWc2vnjHPBiCzorNtN+u3kp4HZP94ciAf++BhtNdZvPvZnznRERERERERERERERERD6TXLawRYbOv3ok8D+376x/ISUpiPsGjUUYeR1DcLQVc98h8t6S66KgUquRv2ABb+b+ftRXVKCssgo7dp9EcJAKUZFGbrptCgm4LNFqElIZvFDySXVfrwU9PWZ0dQ7BJch4hEj8rNlY9nAatLqz6W3alBTEZs3Flh0VCI9PxUBvMfq7uiHx2hEepkNcbBDm35cNhfxsWiBN2MnfaMmiRMTER0IduxglB0rQc+Y0blubyaPROjrNPGKHvLPk+hg0t42go+YYbl3jT/I7zN6fmRGOUFMAgkJDUVPbw9PLSCwhTy6jQQOZzH1Fp+E+1n7s8+HJJ5/E/v378dZbb3GDeZvNxoWriSQnJ+PBBx/Es88+O/7aLfB3CN8Vbf36QNFoBFWBrKqq4s8p3ZDSKilSa+IyxIUKEujVAVO+fjHo+pLAqlJJsG9/AzLSw3kkIgkyap2BRyTm5ETiQHHjuCE8pRiWnYpBdmoCZhX4sOHjci5CkZ8WRQvu2VeP4p0HsHD1EqRIDkKnU3JD+cLZsVwIIyEqLzcKWZkRaG0dRMPRrTi0yQqvVIOQ8AgEmkIw0NEJpSGOi0gUdTV76RLeKJWwqboaldU16DlQDb1eyfYxGGHhRphMBmjUUh4t6PNeWX+j6K/BQRt6eke4gEyRY2p9CJIyM3HLl+5BOLsm4xGa7Jp4rJ1wD9TBa+8/bz1UgfRUaSecLvdffr/Je+kKCiIiIiIiIiIiIiIiIiIiuAJhiyORtM8qTINcF4l3PziIeYUxSEk2jU9ivY5BODuOwiXXwCk1obndibjUNASHh2HO0qW8kZdPZ3MzOpqaUdfWikPHGuG0jyBAK+dm2+RbpFbLeVVF8jWSyOSUJ8gmwRK4PT42ARZgt3t4FcERix2Cx8OFotCoKMTl5aHozngYQ0IueAhkfm0ZMmOgtx993b1YsSwFEfNS+PbOhdK9jh5r4cLZHbdnwRhsgjpmESpPVaL66F7ceUc2j+iiaKw9exuwakUqVLogWKUxOLT5FdyxNpWfm9bWIQwM2rBkSTLkhjjEZphQdmAHDJQyxt4fEhwAnVEPh6PtCuy9AUryms/a4ePH8Xd/93d488032fEo8eqrr/JKgRMhT6077rhjXNiiM/Xz0b/dDMLWzp074WZ9iM4rVUOk4+zr6+N/EwRhfPlzq0ReLU6XB9oAHSLDA3jBgYFBK6wjLiTPWgxFYDByc/zi1Zkz/UhKCsHqVWn4cMN2mMK/hFBNMFYuT+NRWSGmAH7dly5OxrbtJ1Bm0CN//lJESg7i7jvV3L+NhFQSjknwJUGNxDBqhMcjoLtnBLt2F7Px4EVaQShP/6VU4DF0BgNy5s3jjc4b/Z3GWwsbbyUnquGw2aDWamEwBvBUSkqzVKkoMlICmcRHoZjwCm54XC64nE7Wh9w8jZGqQg4PO+EWZLzAQ3hMLNIXxGNVctIk8dg2MoLm2lqEGgVoJf2TUm7H6Ogwo/hwMxJy5iB/jhFHi0s7Z/SCiYiIiIiIiIiIiIiIiHymuSJhS+L11Az2duO25UVInzULuz74EOUV5SiaF8+jVsbweexQohVGjGDra7shSPXImD0Lqbm5MAYHI5aiplLOGru72QR6xGzG8OAQbBYL7DYrn1C73R5eVVAipYgZBTQqJYI0Wmj1OuiNRugCA3lk2MX8uwi71Yq6stOoKCmBx9bH08EWPDyLCwjHjrfwVDIStsgji0QsqlzY1jaE/gEb8nIiuSClNMZCGZaP8mMncWzHZtx5Ryb3JKKok52765CVGY6IqBBIgguw5eVXsXxJPF+ny+XhaWiUgihX6WCXx+DEnv/AvXdlQ6NR8Mid+IRIyIOzMfBK7RUJW/Ser7J2mLW3334b99xzD774xS/yyK1zSUhIGK8eSDzH2phx/Kdd2CLhatOmTeP/7+7u5obxbW1t3GdrophFAti6desQFhY2I9vv7bUiIXsJEkJtOHqknl3PTJ6GuGHTQdavH4da3Yfly1LZ/lUggo0FEovWrErF1vXr8eATX4chyI6iogRs216Du+/M4YUCSPza/AkbHx4BsxcvhVR9GnfcpkB1TTcXyagIQkxMIK+4GMiey9g4sNndPNUxLzeS9eNINJzpw+a//YWbs2cVFrJ9yeGi1Rg0NkLCw3nLnT+Pv0ZjisbEMDtfI0NDsFpGuNjlGnFyodjrlbExp2JjTg5FgAr6UC3C9Xro2Xij8ath65dIJ6cTO+x2nKmsRNWJE7D0tWP+3DhoAgLP61ODQ3YcPdoMl8SI2778OBvPNmx68114Jb5aiIiIiIiIiIiIiIiIiIhMkysStvq81ipDt8Xi7q/WB0YX4cEnn8CZqioc2LwZKkkrZs+KQdQE/6GwUB3uWpfN/anq6kvx0aFdkCiNiE9LZy0NkXGxUKrVUCiVPOqK2kzgFQT0dXWhubYOjWz/LP2diI8LxKI5oQiZYCROZt5UnZC8s+QyKWx2FwKNGp4iSKllkZGBUBqieXqlS1Dhk7ffw2B7He5cl8WFCxJX9uyt588LCuKgjJyHze98jPxMA68iRxw81ITMzHAEBQdAET4HG//3HRTNjeaiFoleFM217JZFaBtQ+03xr5BHWPsn1si96PTp01zYqqurO2+5oqIilJeX8+eUAHrfhL/NpLAVwI7Par+yVLepoHO9fft2LmaNUTrBw+vcY6WUxV/+8pf4+c9/jvDw8KvaNolDJAbJ5ApExCfDvqeSRwxSZczFC+Ox/d33cd/fffH/s3ceAG1e5/p/tCU0EHvvvTEY23jvvZNmNW1zm6606UhH2tv2/tP23jYdaZvueW/atBlOGtuJRxzvjcE2YDCYvfeWECA0/+c9MhhsbGPAsdN8v+RYSHz6vqPvO0fSeXjf54W75STS0oJw6lQ11qyO51UE52b6Y+8rb+IjTz6KSIeNp/C9+94VnsJK6a7r18bj1JlzeKe2Biu2b4ebRzRS3CsQHx+A9rY+NLcYkJtXzwUhqjI6PGzFogVRCAlxeVfFxfryRmmRFVdOIffgXuh9gxGZmICwmBjueXe9CEVpi2qtljeETq7C4fWMzLEGdt5ry8ph6GxGaLAOs+J84LsoFddrzRSxWFDYjG6DCAvWbkRMagocQ50wN5WgvaO/x24z3ThYBQQEBAQEBAQEBAQEBARuwpSErZ/vcAz96DGPE909Axu9xOehDJrPfXXC4+JQWVyMc0eOwJlbj5TkAJ6OJb1qvK7TKZGZEcybyTSMpuYGFB4pxqEutljX6OEbFAzvgAAeVaL38oLaXcc9km4XiUWLa4oUMXT3oLezA51sod3R1IS+jjbotBIEBeoxL10PT8+0G/ZFQgmJBqVX2mF1yGAaHMZHH07nvmFihQ5SXQhrYbA7JbiUm4sLx44iIdYDCzckcf8jq9XOKyDK2faLF0dDEZCJ82cK4S43ICI8hB+DPLdM/cO8Mp7cKx5F+WWQO/vYuXHFSFVUdnJDfaU+GI1557nYJYJlKpcGlAhGXlkUoxUZOXGFPzJZJ2FrJOqJqil6jD0nUzryxHznC/Pxw9+dxsCQ/fYbTwKKRLveL+x2NDY24stf/jIWLlyI+fPnIy0t7abeW7eDxnBjVRXmLUzlHltlZR2YnRnCxVtvbTcKzxchLTUJiQl21NX1oLy8A3FxvoiK8kZXdz2O7j2KVZuXsjlgZ2OvAXv3lnDxi1JvKR2W/Lf+9btfIWHOAsxauABqnxSE+jYgMKwBjmEDjyZ8+ZV8SKQSlFW084qgY6uNkum8t3cEsuc5ucjV0JiPg3nH2bh2wisgiPte+QT4w8PXl0ddUYTb9YLXRJCgZzGbYejpQXd7O7pa29A+OsfEfI7NSdXD6yZzrKnZgMuXW2EalmH2suXYkJHBrwFPW27ORXe3Cf3G4aPP7XBMbeALCAgICAgICAgICAgIfCiZmscWIcKrZeXtGxd4urGF6VkoAudAovZHXFoaYlNT0VBZhYLTp3EutwCREZ6IjfXhldlG1rxUlc1lvu2KohkYsLCFuIEbYTeXDMHYb8bgoA0iiRwSmRxyhRJSvggXceWFUqUslmFYh4fhtFsgkzqh1Sp5pJUn61NkmgZ6fQoXnyaiu2cA1dXdqGLN3TcIqfPXYnNKCt574w10mrSIiZsPscKdp0bmHz+D4twcBPoqsHl9zGhFOYNhCIeOVICqQ86eHQql3yzU1fehreIiVq2MG31d53LruQ+XVO0Hk8MTF4+9hm2bE/nvadF/uaQNa1YnQMx+31RdCT8/LVA6MOVLk3j1NiwszHWprhMayGxdp9OhoaGB319x3fMdUz7yeBRyKT764DxcLKjEW0daZmSf1dXVCAwMvP2G10EG+gcPHuTNy8uLi1vd3d08HXPbtm1Yv379pPZDwlFfZxusIg0b0/7YubMAs9KDuMcaCVxv7z2JyITPwk0bgKVLLNj9TjEXnkgQm5MVinffK8Oli0FImzWbjRlw/6zd71zG8qXRvFIoeWhRFNblkhK88ouziEnPROrcudCFx8BhMaK5rADhCQlY85GP4EpBAfLO5WLwZDVio70RFe0DD72rCiRdcyrKQC0zg3zHHDxaqqurBnX5l1HYN8S9spzsLUAiV0KhcmNzTAGJVMqf63Q6YLOyOTZsxvDQEOwWMyRiO/cF0+tdcyyCz7Hkm84xV4RmJyoqu+DuE4RZK7YgKjFxVEizD3ZiuOUcN68vL2+HQ+R45Y4vrICAgICAgICAgICAgMCHmikLW1ab4a2yMknjrLTgELLyMTefg9w7CTLPaL4wDouN4a2/rw+lFy/ixNl8WIcqEBHuyYUgEm8kkmuRIrTAV6vZ78I8xx2H0vJoUW6x2mG3OTBS8I4iVcifiEy1KaXqNkFd3Aepo6Of+2lRk7l5IC49DQ+tn8UjV0ag6o0H33gDXb1WNNXWwdjdwY3xN62L4ilnI5CnUW5eAxZkh7M+e0Hhlw7jsBq5B17F+jWxvD8kWh07Xom5WWHQ6t0h88vA2395CfPmBPOoLIKqIerdlfAODEFPZy/c5Db+uqbisTWC9uoteSORaTwJOGPJZq+RGDFbX3rd82cqYmvZwjj4+rhj+/LAGRO2SJSLiYlx+T7JZNw0ntrIzwqFLlUvCQAAIABJREFUYvSx20X6UWpiYmIiYmNjJ3Vs2h+1QH816itrEO4bgPDwel7ZkqoW0nheRCmJb76JBz/zSWiGDZifHcEj+jZvcglAVFjg7T1H4BP4ONtPJhKQzyuCHmXjJDbGB+lpQbxYAt0mJwWgqqoOe//vPBdZgyPCUVNehaVbtkDGXmfqvHm8USogeVq9d7QIYscgj/4LZXOMoshGRCfqGwnL1MYyMr+o8AFFH1JEmOvF0nOUkMvcuYcczbPbnU8a7729Q6iv70FtXQ+G7TLuwffAU49dl17shLWvFpaOIvajgxdnKCvvqLS19u+d1IUQEBAQEBAQEBAQEBAQELjKlIUtShl6/lH9d3PO1f59xfJYvkC1dBbDPtjBRR6RTM23I6PpuStW8NbV2oqqyyU4X1yKnsMV8PVWc4Nt8rLy9nLj3kHXQwtzsVjCxZ47gaq3dXUPoKPDhNY2I3r7LPANDkVEfBZmb0iA3tv7hue0NjTg4omTkIuHkX/6DDIzQpC6cta4BT2lUJ6/2Aijwcx9w7Q6NeT+GbCKPfDu3/6EZYvDuRBAXMxvgs5dicgobyj8Z6Pw3AUoRUZERriiuUhUyGfbLFkSDYk2EBW5xQgP94SzsH1awtaIMPXrX/8a+/fvZ302jf5Oq9Xie9/7Hv+ZUvpI5si+yfOnyyPb5/HbZVne8NDJ0GucvtfW448/jkceeWTa+5kOJM5WFBUheusSpKYEcoN38rfi4pGPBr7uPWz85CJz3hxE2Mxobu7jVTXnzQ3jKa5kJv/u66/hgc8+BffAefAVnce2Lak4eboae/eVYO6cMPiyOUFiUny8H2+UKptz6gwbTyqUXrgAtUYLL39XtCNVQly0fj0WrluHTjbHakpKkXepDL0dFfDxdkOAP80xDff6ouOPZarziyCxuK9viLyx+BxrbTVCqfVEZEI8Vjy6BQEhITekOVJBieH2QthN14of5ubVO83Dlv987qjDNoXLISAgICAgICAgICAgIPAhZuqpiAzLDuM/Kx4VbQsI0G2liBXCPtCOwbojkHlEc7N1kfiaWEX+WdTmrVrJq68119WhpbYWl8ob0d1WBzFscNcp4e6u5Ol+FMWlUsr4YlwqE0NyNTKLorZGorgo0sQ8ZIVp0MJ9rAwGM4zsVqbSwCcwEAGhqViUHQG/kGAe5XM9NquV+4JdOnsWErsB6amBCMxO5vs5eqwCZrOVe4W1sEV7VVUn33dykj+WLIqC1M2DC1aDZif2vPQXzEnzYH13pYJR1EpDYy+vfEeRbIYBIP/4EWzbkjh6bIr0IaHC11cHiToQFZfewoZVoez1td/QzzthRJjavXv3Db978skneTofVUosKCjANvaY23XbzISwpVbJsWntLPaTESqFBOsX+uGV/U3T3q/TeY9rNjrBo6HOnLsEm2QrVG5Knj5YdLkVs9KC+CbkIffO3lPcuF3nm4rseTZ2vwR1bExQNBUVFFiUHYSdf/kTtjzxSXiFLYOo7QJWLpdwP7ZTZ2r4cShSMChYj5LSNrS39WPrllSeAljf0IODr/wZCp0/0ubPR0R8PMRXveh82ZinRnNs2GxGC59jdbhU0YCu1itsjlmh1yv5PKPUXT7HVK45JpdJuDg3ouNS9JbVZoeFzbEhsw0DA8M8tZZScPv6zGzcO+Du7cOLP8TOzcaKqEho3N0nPm0OG2y9VbD2VPLUwxEq2BwoLWt79buv9e/8tpCIKCAgICAgICAgICAgIHCHTEvYes7hcPznw+InTp6uOehwYA4JPhy2iLV2l8HWVwOpPhIyfQREUtW45yrd3LjfDjWCPH0GjP3o7exEX3cPT2HsMhpg7h7kxvA2iwV2h50v+GkBT35b5AmkcFPBTeMDjb87/BM9oPfyht7bCwql8qb9JnGEFvyUvtVQXoqQQDcsyvJnC/5r3k0krm3elIIjR8vx8j/PIyHeH+lpwfDz00AsV0PuGQupeziqSkqR8+4eLJgXyCPPiM5OE3LO1WHjhiQoPMIg0Ufhvd/9AdlzQrhQR5jNNh6ttWljEiQqL7Q0tkKjsHITcWI6EVv+t/jdiy++yNvIMZ6a6PxM49gjrF+VCq1GBfuAkd+ndMR/B2GLjk7RTaEhOpRdKkZ8uC9mpVmwc3cRYqK8uSBL4hCvkvjGG3jo85+HwsuAVSus2Lu/lItJXp5uCAnxwBKpBLv/90+YvXwV0rIXwWFqRKSsHBHhXujuGUR1dRf+9VYhv799WyqP4CJIHKPW2TWA0pz9OLnnHUQlpyIhYxYXc0egOUCiFzXed3buBvv70UNzrKsbxt5etBkMGGw1sTlm4H515Ks1co7J3J0qlcpVSqjUamh0vnAP0yPMywsePmQ+78E9uW55vmxsn4ZaWHur4bSPN/0nYff4yaoTfd3GzzqmUwpUQEBAQEBAQEBAQEBA4EPLtIQt4vkdDsP3N4hXnTpV/b9NzX0Pzp8Xzo2yCTJ1J4HL2lMBidqPVxik27FRXCOIRGIe7UEtJHq6vboRq8WCppoa1JSWoqGiDB5aEWKifTBna8I4r68RDEYz8vIaYBiUISEjA8b2Gmi9A6EMToYVGlRVVqEo54/QyExYvzoKSqXrVFJaFnkqrV4ZB3e/MMj9MnD63feglpoQEXFNdDh9tgZJSf78XEl1obi46zi7H+A6b9MUbzaylsbapdts9xBu9Nfix5/W0V088sC8cfcXZ3jDx0OBzt47q2h4PfdS2Bqbkkr+V0dPn0FS8qOQmVoxb044jp+owob1iaPG7f6ePThz4AAWrl8HPZsLq1bYcPhIOZYvi+FeV4EBOmzdlICzOadReOYs93eLTMyAm9wKpb0UnV11SMjMxKDRiDNna7k5PUVYjeDjreaRg+SNVVffhBNvFmLQKkdEQiLbTyL8Q0PHVX+kfql1Ot5CoqLu2nmi6Cz7QAfs/Y2wUcqhc3w5AtPAMHJzG1BR2fGyxWR46qcHHIN3rTMCAgICAgICAgICAgIC/9ZMW9gintvnMH5/g/jJtg7VA3verRSFh2iQMeuaQTotbMlTh/vqiCU8Qkni5osegxOG/mHoPDy4TxBFYc0UlOrY3tTE0x2bqmtg6mmHv6+Km9NnboqFTHqjmEX095uRX9CEpjYz5qxYiZS5c7k4QNFde945CIctB2qVCEGBOizK8oFOdy0+iiJsLlxsxJpV8fCLTILMJxXH9+xFZ00xVq+OG92urLyDp3SRkTiJfF1GJ4ztdQjJThndZjoRWzrWTrL2A9b+yprhut/TK3+MtT/d5DjTlY68PNVYtSRp3GNSiQibl/jjf3fXT2vf9zxi6+rxyfCdIuwqK1oR7qFg48qDpwjmFzTzVESChKhTZ0pxap8Tizash79UhVUiEQ4fLcec2WHcT40i9FauiOUVC8vLz+PSqUMYHHJArlRh4fr1SJg1i18PEmQPHToIXw8nN5Z3U12bKxRBRiIttWGLDU2Nzbj43mV091rg6R+M4MgoBIaHwycwYEbnmNPhQG9XF4/8UrtJoVc7eKVD+1AXj9q8HkobLrzUjOq6fjqPNovN8Onn3nZYZqxDAgICAgICAgICAgICAh86ZkTY4rwLk+hJe+Njn/tkaFFBFd7afRZhoRqkJgeM+k5xHHZXNAdraqcT3e19uJDThY7OQcjVenj5+8PTl9KcvHglQTeNBgqViqc8iSlihjVaUNvt5P0zjKGBAQwYjTx1sa+7Gz0dnTB0d0DsMPOoGH8/LRbN1kGn871l9yl9sKi4BW1dVmQsXoxVn8jmaVgE+XCZDEY4rGbKrUKgvzf32Roxu6eImZzcOhj6zNi8JR36sNlwKPyw5x//hGioFevWJoxWp2trM3LhjLy3KIJG4hmHo6+8g+x5YVxkIl+jtvb+aQlbBIlbL7D2Q9YKWKuj18Ea1X9MZS14mvu/FVvXZbBzI7/h8QdWBE5b2LrXNLcYYLHYeYGA7HnhePfAAQQ9sR3SwQosmB/BvbTIwyoq0ptf38ULo3D+YjX2v/IaVn3kQQQke2KT2g2HD5WgpdWAOVlhPMXQ08ONC2FubjJcKetg42yYC7OURsjTdpOSeBQWmdYfOn4MHmorUlIC4aEfn+KrkEsRFeXNG0GCWWvrZVy4koPuniFIlTp4sPlFqYR6L082xzyg1mmhclNDIpNyEXckMo2yAx12G492HDSZ0G8wsLlFc6wDXa1tMPV2wFOv4F5gXuGesAxOPGr7+4dxuaQVNQ39SJk7Hx9dH4PX//hSzfffhPW5HXf3egkICAgICAgICAgICAj8ezNjwhb5bT3/mH5/c8npz81bsgmZixeh6Fwu9h86A52bEwkJfggL9RiX9kcLaHqMGmEetqGPLcT7DBVsMT6MqgELhoYsGLbY2SKbLbSdrgijq/oW5DIxF5dIDCBvIx+tEtEpKui0MROmF14PCVI1Nd1kXg27SIOMRcuwPjNjNKqFvSQeqZV76BACfaXYtpnSFkUoKm7FW7uK4OenhZ+PFqVX2hAX54slK+dA4Z+BsqJy5B5+FXFRGqTNjR01425uNpCnEE9TpJQymVccTp8qhb+HnVeuI0gAIBP8mULB2ryrbbJMNybq4e1zJ3w8K8kDwX4qNLUPTXnf9zoVkaKOSJikCockKqUle+PAOyex5SNLgN5yrFkdh737Snlxg9gYl5ialRnCo/ne+N1vMHvZCsQmrcFmvS8KzhVg19vFvDhBR0c/FzRJJNq+NZULoUXFdfjnL15A+sLF3CSehNa4tDTEpqaivqICeadOwWaqRUKcH49EpLF5PSSYUUtKdEUW0pinNFtDXx16qsvQYLLwCqI09+x2mmMi1/Vn55nGrVjkhFQq4t5wNGbJIyyIve4UHm3mNy49cywkijU29eEKmxt9JhHr/wJ84uG5kGEIjQXvobvbtFfw1RIQEBAQEBAQEBAQEBCYLjMXscWwixy/vXCh9lPBwaelysAsZC1biswli3kaVXFuHk6fKUBoqDsiI7wQGOA+aoY9glIhhb+/jre7BS3sm5oNqK7pQkvrAMLiErD0gdUIjozAiAJFEVpl+QU4f/wYPLVOrFkRCv2YqDOKrJmVHsR9j8grKysrEnPXbEBnnwhH//C/0CmHsXZFGDeg5/uzOZB3vh6tbUasX5sAD08N5L6puFzcgp76Eqxd4zL3NpmGcaWsHUFBepyo64DPXTsLt6ZoGs8NDvTAonlxE/6O0hG3Lg3Ab3fUTHn/RUVFOHDgwJSfPx06OzsREuyBmtpuREd783REEox6eqpx9PAlrFo/H+i4hE0bknDseCXq63uxcEEkT8mlCKqgIHcUXjqOgtOnsHTzFsxdGwbR4Xdx/EQFIiO98MC21HGCLKXzkiBcWJiPv7PnpM1fiJTseVCqVAiPi+Otr6sLxXl5KNhXDB8PMd8PiaQ3E3YpbZH6TW2mITGPxDkSi+sb++AXGon0FVsRkUARi2LYB9ow1HIeF87XDDud+P2Md0BAQEBAQEBAQEBAQEDgQ8eMClvffcVY8vxH9X8uudz4+SSnDTJ9NGTeCYhOTuaNKrJVFF/G5aIiHD2eDz8fNYKD3dlC3B2enm6j6XozCQWF9PQM8rSvpqY+dHabERgZhdg5q7A2KWlc9UST0Yji3FyUsObvI8PqpcHQX5fqRRiNZp566JB54eEvbMeRt3aib+cx9LXVY/HCSPj6aka3bWkx4PSZWi44bN2SCqlcBUVAFsqvNKAk5yg2rk/gUS/Uz6PHK3kk0N6iWnx8xs/EnUOpnyqlZDRKivpIP9Hda4FTzmv/sn8e2pJ1y2i57csD8Ke3rqYjTnC5JWLXc0VsLPDIPPYfCSbmYSt//IUXXuDtXkHVHRfOD+fC1bYtrkqFC+ZH4tDhcpw65oYlaxZB1JqHdWsTcaWsDbvfLsbs2SHc/4qiC+n69hnMOPHWP6D1jUBP5wA++uUv48KJEzyNkYovUCTgCBQpRSmP6WlWFF++hH+8cALRKbOQNj+bp+zqvb2xaP16LFi7Fi21tShncyv3YgV0bg4EB+kRGEhpuCrcJLBqWtC46Oszo7XNNbfaOwbhHRSKmNQFWPxwCk8j5ts5rLB0XIa1rxqVlR2ore1+8Tuv9lbPfI8EBAQEBAQEBAQEBAQEPmzMqLBFWGzGb57NqVno4eGWGuishK2/iafcydzD4KbVIp0tyKkND5nRWFWF+spKHM+pQX9PFzz0Snh5qeHhoYI7W4zrdAouBsjl0lsuzElkoUgss9nK/Xz6DEPo7R1EV/cA+9kCd28fXgUua+1KBLPbsQbadpsNdeXlKDl/Ae31VYiN8caWDdHc1Pt6BgetKChsQkunDQvWbmILeJfZOxmDH3j1H1zQobTEfpMenp5qFBW18H6sXBnL08Ekbj5c1CotuIyLR/Zhw/oEHkFD5Jyrg6+PFuFh5IJVO6PXZKqIxMAzT2bj65/KhMjcAcewEdcnKjq4yoVRwUuq8uA+alQkYCJmZyXBWP8JLuaNpLFNlM5GYgj5sOXmleLT334PVfW9M/3ypgS9ztBQDx59d+JUNZYvjeGCLBnAHzh4GSfec2LpxnWwdOQjMQE8zZaEzcrKTh7pR+OTUvQMhkHWSrBw43b4h4Zg48ceR2N1NU7u2Qs3aQuyZoeweeA2elyK+pqTFcqjuCorW7D3/34Ppc4PSVlZiElJhlyp5GObGl2IrvZ2NLC5db6kGn2dDVDJ7TxKi/ZJkYRajQIKhWzC9MXroYhDmltG1ncjm1vk29XdM4jePjM0Ht4IjohE6rKlbI5F8n6MniuHDTZDHa+K6rSZ0dFpwslT1TltBsNzd+PaCAgICAgICAgICAgICHz4mHFh67kdDtOPHlRvfve9K8fXrYkPDwwALO2FsHZdgdQ9DFJdCMQKHRQq8sNK5o0YHhpCR0sLOlta0d3ehoaqbhh72jE0YGIrZDuPjCERSCIWcSGBRBS7wwGrlTW28BaJJFBptHD39ISHTwD84/2REhQIH39/yBSKcX2kVEOqlFhRXIS6sivw8ZQhLtYXy+amTxg1ZhoYRnFxKxpahpCxeClWfGwuN7Mnis/l4sLRd7FtaypPpaxv6EV1dTcOHipHbIwPNm9OZvuUQO6dCKlHNC4cP4mKCyexYV0C354gMczYb8ba1a6URHqNX/va1+Du7j7Tl2dSFBQUYNeuXdzI/n9+ewqnC9rxt99+Gv5BiqvVLVtgH+rh1S5dhv5jnmzpw3B7PhQBs3F9SJZY6QGlf+ZNRS+nbYjtuw02tn9LfydefKUCP/lbJb++I2xjbdbMv+RJQdUlR5IoSWQ6cLCMnasmZGQEc1FzDbt+R45cwbtvDGLNQx+BxK0R6LrMH8/Pb+K+bBS5R8by87MjeCTae4f2Y6DfiKxly7j4+tiXvoSKoks4cugQ3NV2nvI6Nm2Q5gGlJ8bH+6Gr24SKy8eRc2AP/EKjuNBK6YlkNk9VRqllLFrEI6tMfQY+v2huVbZ0sbnVg0GTETbLECTkoyURjY59EispOo8ELavVCbFMDqVaA53eA+5ewfBP8EXy1f1fP7dI+nOYe2EzNvLmtLuKHra394O9J5RaLJZtv9rnmDkTOQEBAQEBAQEBAQEBAYEPNTMubBHf/tdA/Y8eVC/dt79076KFkcnxcX5sgTvMIzeoiWUaSNS+ELv5QKL0gEjmxisf0sKe2lhoUW4xm3kFRKrOZrfZeVVESlUjcUkmV0ChVEBOC+ybGVnb7ehqa0NTTQ3qKyrR0VQPX28lIsI9kbU1gVe4mwhajJOZe0+/COkLF2HpY1mj0V5Dg4M4unMXBjprsXlDwmiFxOAgd5SUtmHWwoWoKytBZUUnUpduhE3qiUOvvo7h3nqefiiVuo7Z0NjLfbU2bUgejVySKVT4yle+guDgu1m78Oa89NJLXNga4fiZCsxZ9QP89cUnsHZlOmQe0fx62gfaYetvgX2wg51k2+j2JGiIFe6QecaOPiaSqqAMmgeIxw85igIjsczGGgkiJIw0tA3hqR8V4uylnhv6tom1/5jxVzw5mlj7ipRSU11pkiuWxeKdvZeh0Sq4iCmViLFqZRzOnqvFjt//EesefQS6wLm4cmoPqur6kb1qFSryc+Djrb465iRsLCTi9JkL2MXG5uqPfAQad3fEpacjJjUVlcXFOH38OCS2Ol6FkwziR8QnOj5V/aSW7XCitdWImvwjOLN3F9QefgiNieFzyS8kmM8NrYeet6ikxBteFwm9fG7Zr84tkYh7YtFYJ8N6kfgWhRhIBLOa4BjqgX2oi0fZkUA5FopWO3GqOs9qtWz+z1eM7TN3RQQEBAQEBAQEBAQEBAQ+7NwVYYsgcev7G8QLjh2v/FNTk+GR9PQgeHmq+YKcL4T7TEAfxb+IIJLIIVZoIZJrIZaxbVijW0iUsFidbIEthUapvGkFNoIEMDtboA+aBmDo6UZvZycXszqbW9DX1Q53jRQBATqkRLvDNzvlpj5QAwMWVFV3obKqCxrvIKQv3jRqfj1ynLKCApzevw9JcXosWZcw2q/2jn4cO1GD7LWbkTg7EybDchzZuQv5v3kJ5iELIsN0PGVtRJzo7DTxFMSN65NGxTWZZwzEqo4J+3bp7R9DImpF4safs33ctUs3YeXBjq5+bP34b/HM51bh+996gPVXAakulDdKOXMMdnJxigzCKe3M0lXCxS2OWMJFLRK3KMqLR/SYWvj2Tovp2nFZ+9fhZjz7Ygn6+q0T9+1uvOA7QKzy5Km11u4yfs3WrUnA23su81TBkGA9v7YLsiNx4WID/v6zF6DWqhEQHoEHP/80tO7uCIwIx/43d2D+vGCepkgRWEuXRPMxt+M3LyJz2SqkzpvLTplktAJiS109Lp09g3PnixAe6s5FNM+rc4n3iR2TjOmp0aUzGIbQ1FyFi+9dRFf3EORqd/gEBvIIKw8fX+i9PKHR67loJWHHIQFrbHruCCQIk+A1bDZDoZBAgmE4rYNwWAbY7QC77efXj9JGr4fGUFfXAIovtzrLKzpespgMX3zubcfgXb48AgICAgICAgICAgICAh8y7p46wnhun8P48MPix1Elmj9gkYUO9RsQHKRDcLAegQE67p1FUgWP/hkcBga7xj2fUrUqqzrR2GREr8EGp0jKo09oEU4RW06eLmWFxcyeb7WwXVmhVIih1Sp4FUMvvRtiM93h7u53S2P63r4hNDT0orauG3axhkfMbPvsLOg8PcdtRx5Ip/bvh9RuwIbVkWy/LmN5WsQXFbeivNqEjU98Gn5XI60o+iY1ex4O7qhDXLQeLa1GvPr6RR5lQ2b5VF2PInzUapefF3lwyb2TYLMen7Cfg50nETPrEiqPRSJuxZeneFWmDqWn/fz3B3Emtwov/+HTCA/15Y+LxFJINAG8kXBlN/fydEVL9xUufCl807nYNdx2kUd50c/XYzTZ8OyvL2PHe83v98u6IyhyUO6VAIfZwF5LK792VNXy3QNXuODUx8ZSd/cAlCoZMmYFobyyG1GJSVzUIiLi4/HgU1/A3n/8gxcWoJRGElmjqWpioDty806j6FwOFqxdh8hEl2gaFBHOG0UJVly6hJz8Agz0ViEsVM/FMV8/LU9fJUjsooIH1CjKixgctPACCj3dJaisuYB+4zAXcG1OMYXSQSJ1CVt0LC4Q22ysWSER2eGhlyMsxIOnUF5fxfR6yIerpcWIpuY+NtZN0Hn5oL6qo/I7rxk+5aDBIyAgICAgICAgICAgICAww9xVYYvYscNhf/6j+n3pqQFPhaU/ioa6NtSVVyDnQiXkYiv8fDXw9dVysYfM4sdGUtHPlMbIUxlpwW13cpN4m90xGrpD5tfce4ttO5mqiiSWGQxmHl1F6VsdXYPQePohMj4J65YkwdPHZ1xKI6VmUX/zjh2Dpb8dWbNDERIcNPp7g9GMkyeroQuIwmNffpKnVPLj2Gw4c+AAaorOY8OamFEj8OFhG5pbDDh6rJKnLXpefZwi1BSBc9Ha0ITasrIb+m01myARG6HRO9Ba9SsMGR+FSuc7+nuH3Qqx5Maom6kwUcTWWM5drMHc1f+NP/zsY9i+ac74X4rEkKi8IFG487Q0is5zOi28Ih6JQRPFXJ0r7sFTP7qEupbbB/Tca3Wkrqycp7QGRcyGuf44j1qia0jRgIWXWrBieQyWLY0eTTWNj/PFkWP70FBVheVbt3Bzdapk+MjTT+P0u+9i19v5WLwoEr4+Gh71RdFbJIzlHdmFc4cOYvbSpYhOSeGRVSo3N6RlZ/M2YOxHTWkpSq5cwbGTl6HXSXgf/NhcogIMCsW1qU2FEKiRoDwWV3VLl58WzQv6mcStkbnkMvif+DzYbHZeEbGzy8QjD9s7Bti7iRuCI6MQPTcby8L8UFdwFPVVte8KopaAgICAgICAgICAgIDA3eKuC1uE04GXS4prnwoLViM6PBEJsx4CW0JzA+uW+nq0NTai7EIjDF2dUMqdPNqKoqF0WgXUGtbYopwW/bRYp9tbHmtMhcSBQQtMpmEYjWYuZlHUisUugaefP/xDI5G6PAIBoaHjKrmNMGA0ovRiPi7n5cFNPoy01CAEB6WOLvRJCLhU1IKKmn4s3rQVMSkpo8/tbG3Fgddfh5/egW1bUsZFutjZGv9SUStWPvgQSvMv4vDRCp7SZnGqMWSu4ubeygk8v7pq8+EVpKM9IDjWhMb8fYhdes1t6vhvHsScj/0WGq+QO7w6E53D2+sQvX2DePQzf8bnnijDT557BEqlnBuFUyoi+W45Bjsgkusg94rjKYeqsOU8fc3G/bTY74e6ufH/C/+oxC//WQWrbXLax71WSDQaOd75+8vwCwmBSiGCAgY+3oahx/rH1+HMnp3c7F2nk1zdXoFNG5J4Nc1XXnwRqx56CMGRkTxCaunmzWhKSsaRnW8hwNtVNZHGOAlTlOJIVT2Lzr3H017jMzKRNHs2F8UItU6LlHlzeSNvrM4nMyGIAAAgAElEQVSWFjTX1qK8vgGdebWwmfvhoVfxCog6nZL3g6LLVErXPCIxmPv+i1ym8WPHKF1//pqGbRgasvF5NEDziKoiGofQx+aSQySHh68f/IPDETMvBIvYPNLoaHyy5/bVwtqeg+LCStht+Me9uE4CAgICAgICAgICAgICHw7eF2Hr26/1nfvx454nOjoMS3ydxbAZaiHzioe7ZzDcvbyQkJHBt+PV2wwG9HR0oK+rC4aeXrS19nGRaXDABPPgIIUmgeyuxKKRwCqSOlxVEikuxAkJF6pUGg1faGv1QdCHeSHMxxtefn5Qa7U39eoy9vai9soVVBQVo6+9CZERnli9LIgLbSNQH6trunGxoBmRKbPx+FdXQXFVGKMordwjR3Hl/Bksmh/OPY/G0ts7iMPHarBk60e4b1dceho3CBeJxPz1nj92FKHBOpjN41Myia6qXIRGafnPKh1gqrw0+jtDawW8/XLQVnoE0YuemPC11TS2oKmtAwlRYfDx9Ljl9ZqMsDWy3R9eOoHy8kbs/vUS2CmV1OmqYEjpiVQZkYtZhjpI3Lx5WiIZz4+Yz3//+R346d8qJ3Ws+wVK6wsP0aC2vgazl62AT0AAHA4HTzGkYgZUkfDdHa9i6aIw+Pm5rhcJR5kZIQgNMeHw6y8jJD4Ni9avZ+NUgeCoSDz+zDO4eOIkdr59EsmJPkiI9+NCEwlky5fFYGjIiorKKrz9lxzI3Dy5sXxkYiI8fX2vRlhJ4B8SwtsIlDLZy+ZRLxtXfd3daO5l86jRgMH+XpiHhmAdNrNZ4xgVaumGrrortkrCU34V7LW4adRQ69zZPNIjKMwTSd5e/LhKikwcO4/Ydbf1N3PvMcewgRdeaGjoPfLdHb0X369rIyAgICAgICAgICAgIPDh430RtgiH1fns6dM1Z7ZuSZHCYsJw6wVYOksg1QVDqg2CmKojsoUyLaCphcXGTrwfh4MLSJQi6LgqwNDymsy2qdEif7KQiEYRY5Ra1lhZBfuwkRuAZyR4wndJ+rjUxhFBq7CwGd6hsdj2mafhQWmLV2msqsLRXbsR6CPCA1uTeUTMWOrqe3C+oBPrPvbJUQ8uitpJmDULF0+eRGnuKWxaHw8fHw1eOXnNUL29IgdeYWkYHuiAQq0G7ArWGfIUu5a2V3/+NURmhKCuPJfde2LccSmap7iiBpcqa7AgIwVvHDiGAG9PZKcnI8DXe9Ln6lYE6K087XAsct80iOUa1s8Bft/SXsivsVjuEntEEgUWLswAfnvijo51ryO2qDLhksVRSOkZxOGjJxGftQDzVq4crRwYGh2NzU9+Bntf/jtSE4YQF3stXZSu7XY2NgoLG/CPX/wcizduQkxqChfE5qxYjqSs2cg9cgRvvlWA5CS/UYGLohTTUgN5Iw+vmtpiHLhwEmarHEGRkQiOjEBgeDgfjyOiLQlTFFXmF3LzCD6aS9QwMo8o9VAsHi2UMBkcw308Qo8qYTqvXmvKPDx1psZqs+Kbd3yCBe4Zz4rE6mHAg30ocNM/NpKsbGQMFADGo84xZU8FBAQEBAQEBAQEBATuI943YevbO3rznn9M//zZc7X/tXB+JH/MaRuCtaeSNxI6KKpHrPRkzZ0LICKJEteb/NCiWyyXT+6gbMFusVgwNDDA0x4pcoWiwahaYk97G2QiK/f3CgjQIml5EDSayBt2MWS2ory8A2XlXQiMjsfGJz/PI79GMPb04uS+fTC0VWPp/Ah4e2vGPZ9SFvPON6DPrMZDX/gi3DTXfk+RaO/teANSWxe2bUkerYwoGiOoFe78BuJXfB0KbQAG+kqg0Uex81YKicJlDN525SQU2AmZWwLEuDHS6+0jp6HXu2P5vEz4e+qxftkCLma8dzoPH9+6dkIRY7IRWyOsne877r5UGwype9j4fbJ18XBLHlShS3mVRGLR/Hh4eajR3Tsw6WPda2FrRDgi83+6ZqfPFuKNP1Zh3SOPjBYboOqDjzz9Rbz72mtoba3CAjYuRoRO8q/KzAxBVPQQzhx5G5dycrB08yZ4BwRArdNh+bZtmLN8Oc4fP4Edb+UjKlyHhHh/nlJIkCl8xqxg3iwWO1rbjGgrP4PikwfQP2CH1tOHH9/T14enLeo8PPh+KaqQBLSxiO9ExHK6ijyQpxhFZDnMPTxC7/pCADR0Tp2uQWeH6b+FaK37k4dFYgmbnXMckCwQw5nFRnU8eziCjU6tYoLtZ7PL+qxI1st+bGKtmt0tcsKRwx44+1eno/9u9/drIvFsNuv8J7OtAzj9C6ejb7rH/IZInMmGcsBktjWxIf9Hp8Mw3WPejK+LxPRXnon/0jMJ2Oso/bnTUTODXRrlkyL6xMbKqT6fvfuU/NTpqJ3JPk2Xr4rECaxfUXfynLt5jieCjYkV7EZ12w3fZ2b6PLBroWfXYuFM7e92sGM1sPFYdDf2/axInMXen/xuv+XNYf1z2gEr+zZhYXd7rED7r4AOh/OD7WPJ3uNT2Ht82O23vAY7D0W/dDoa7laf7jVsvGSz8eI13f2wgWFj53aY7cvAzlnHb4AWB0UGfEBhYyWSvZ7EO3kOe7HV7HvBlbvVp6nAvmPEs2sTPd39jLm+9B2t/UXWPsjXl2BjP4K9gKQ7eQ47BzU/czpK71afrod9NrHvz7h1+tM94P0+D/cj75uwRRTajd9HEaLEItFj2fPCx6UE0qKZUpnQf60qnkgsg0iqdDUJW3JJqHKbFJVl9ahr6GGL8quV3Nh/DrsdNpsN1mELT8MaHhrk6VZSsYNXSiSPIfIaImEgPNEN7tnxN0RVjUBiVGNjHyoqO9FjdCAhczYe+tLHRyvbEZQWmXf0GCoLzyMjPQBLs5JvSHEkE/ATp2sRkzEfy5cvHyciUAriyXd2IyPNF7ExE69ZnA471JpGdFf+FSHzvofGnF8jcXE2hs2lkCn1MPd3oznvU0hZuQVOyxFIldnjnm9l56N3YADJCdGQS6U4ml8Eb3cdgny8kZmSgPdO5WLdkuwbj3sHwpZKIcHijGuRXyKZG+R+6RNuS4LIcGcRFH6z+H2FXIp1K1PxzzdzJn286Xx7c7DTP6CRQGF2QG6Z/vdAGj/LlkSjqroLb/zuN5i/bgMSMzO5GEspiVs/+UnknzyJ3XuOY9GCMPj76UafS+mtG9YnorauB3v+748IiknG/DWreSVNasu2bEb26lUovXABh07mQo5BxMT4ICLcC0qla9qSEEpVEanx18e+2w4MDKO314DejjbWLzP6+4cxOGiFxTaSpquCTKGATC7nQpdEKmFvhJTK62Bz0IrQUD2S0xPYffYEdp9805x2MxehnXYK2rn5eaPjnz5Tg5IrbX+3vm74IV6d9ikWmEHYB3GGBOLPhkHyALvr5Xo3un3BjasbeV5tqezuNhEbS+yO9Rsi2Un22Os/c1r/erf6LYHku+xmy2S2dcI+l93kTfeY7PV9i73oByezrRb22ezmrom4YogfYz16bup7cL7B/nl4xjo0BrbqWs/O1VtTfT57N/kqu/nlDHZp2rB3xT/jzsWUf7H2kbvQnQkRQ/I3dhP8fh1vsrDr+XV28/OZ2h/7pIth7wB7Zmp/t4N9l6Rr/9m7s3fJf7H33E3T3suYn8lxlp3w/mdFsgrW9/NOiI6bYD9wN4X2uwEbz6+w99uU2295Dfat5f/YzZN3qUv3AZIfs/GyeKb2Rp/39M2RjRczjRc22i862HgRwb6fLYRv/Kv4fQr7PvACu9l2J89hr52+pyy5Oz2aGiKIn2DfvWcsq2FkdXn1+lax63uBHeX0IOz7fut0tM3Ucd4PnBA/L4bojr6zsM+ec+zmxgXtXYLGIXvPmvd+HW+ysM8B+j711Xvdj3vJ+ypsUYXE7y8Xf6IQopaODtMz2dnhEqridjOcDrawtlgBy/iggHA/9o3Oy40LR2TGzlMRxa5qblKpGjKZjhtkjzXEvh1kMk/VChsaetHRbUFITCxmrVqE0JiYcYIUCVoFp0+jJC8H8TGeeHBb8g3HIePt/IImtHaLsPqxJ+E3pooiRY8d3b0bpo4abFwbzQW36/vR3eVKRbRZhtixrQiJZ4/V5KDfmAnLUAvM7NduHgGoPP5nxMyJYydqEMMDzdAFb4Z1qB8yleucSsQSqBQKaN1UMA2ZYRwycTGpvq0dtY0tsEkHUNFai9iAiHF9uJNUtPlpntCprw4jkQgK/0yIJDePqLP11UKi8uEpqMTWDZl3JGxNvmfjqYlVoOMTamiixBjsZm+bb5ox69QgJPY7E7g6O/thMAzx4gYjREd5I8BfhxMnD3B/tpUPbOfiFAmdmUuWICwuDofefBMebl2YkxU6rmJhRLgnF6ZKr7Th9V/9AlGpGchatpQ/n3ysMhYt4q2toRFXCvKxa18JNAobQkM9eZVDMogfSZmlW61WyVto6MR/SKCxaaHKojYHF3Ad/PU7uUis1+v4Pqy9d+571tJqQE5Onb29o/8nl+zG/7fD8cH+i9G/ExSBwj6Ef8oW7BtneNcyNvIocoS+fN81YUtgerBPyPVfE4lVP3c6hmZ+7+JJiX8fFJ4RiUNlkCyYwlM3PC0Sa9gCwnT7TQUEZhT6wpfJFsms4XM6SCzPiqS72af7L19wOs7d687dDvbelMQ+n+5I1CLY6932sEj81A6nw3I3+vVvDIX/0x+oUtn36f9gKwXrsyLZHvaN8Gf3+3j5nEjszsb3uik8dSEbZ0HsM7D59pt+4KHrm8yuL2t4wg0SB7u+hwH7b3/qdLxvfySYKvQ5yvp8x38AYO99c78hEof9zOmovxv9Evjg8L4KW8RzR7lXyzf+51H33bt2F33Px0ezPCHeT0wpgRTFMlkxirYbMee+U2hRT15FHZ396Ogwoa3dBKlKx0WsWauWIyiCqtaNPzX9BgMKT59GecEFxEbpsX1zwjiBgqBIp8qqLhQWtSNl/hIseWzhGM8vJ8oKCnHm3X1ITfTEknVJ12dZorGpD6dzGiBWaHm6oFgshcMugs5bg4G+Y3DzjEf52Rx4BTmhCvRHd8XvocxcAcfQX9E/uAYBmctx8MdLkfXR38ErPB1WuxVkdPTV136CRL9YFLZcRru9G2qo4CnT40zneZQsuPF9Tk1eXpNkTfa1NESZZywkbtd8x2w2O37/txwsiRtAdMi1fVraCyBW6rkH14rFidBqlOg3jU9puxmT79k1OvyksP5IixBvoOmSE7ogEfT/44aibzkx6/Tg7XdwFVJqZCp37DtQiXlzghAZcS1KnCoOrlubiPKKDrz26xcxd9UapMydy8UtSg18+AtfQNG5c3h77xEkJ3ohPs5vnCCVnBSAuDhflJY24vVf/wJh8SnIXLKYG7UT/qEhvC3ZtAkdzc28yMHZixUwdJXD20sFP18N9/Dy8lRDqZTdMLZGoCizm0Uq3gmUBknFEDo6TbhSxkZVl+mgHfj+d1/ty532zgVmBLFILPoaJN+UQvI9dneiLEOBDwHsrUDDPlVpMbBzJvdLYplk5sXSewqbK49gkmGM16FiX8Y3s1shTlXgXiNnQ/ghMSQfYQvaf7EF7dNsQdtx+6fdG1wRqVPCIwRYzW73zmR/PoRQ4N92Nl62f0Mk3SGC40v363jRQEKRWjeWsb89YvZZRRG1L85wlz4I0KKazRPJavZ+cMoB+6decDoq7nWnboYKEorOd5vCU6mU1kPs9mcz3CWBDxjvu7A1wndfM5xhN6uef8zjx27u3t9s7rGip72JfQaboVHLeNogRTORYODmJuOLdSWPwpJwUYvEgPHm7leN5e1OLlxZLDbujzU0aIVpYJhHQhkMZhiMZtidMnj4+sE/JByx2SFYFhExzvtqdJ9sf401NSjKyUFnQxUS4n3x4NbEG4QBErTq6ntRUNgC/6hEPPT0Y1DrroluvZ2d3FheZOnEprXR/DWNhfp84WIDWrqABz77BZzr3AOz2QyJXAm7w4ttUIWgpC/Dmr8bV4rJaqYNntoe6Lz1cFr2wdSng1f8T9HXXIbAyGq0Xt7Fha2n/vb/cLAlD9ZBCw4NnQNMNoj0MjiH7XAOOhGg94ZWeaNU5O8/KTsbtnAWYfVVYYuM4eVeCaO/q2voxH988a84k1sFN6UE//XpOHx6ezgk7JpRJN5wK/ltLYHaTYHVS5Pw1t7JZfJMpmdWmQgV81UYkoiQnDOE7jkKdl1EKPnWEOYfMuH8PDWcz6gwvE0Jx9lBiCcZW0TSW2hkGB78/Gbs++c/0dxsAKXUjoixJCbFx/kiNESPM2eP8TTCFdu3wycwkEfBpc+fj7i0NOQePoKduwuQnhqAyEiv0XEsY2ObDOKTk/xRWdWJPX/9HdTeQUjLzkZkQgJPHaT9jFRAzF69GlaLBW0NDWhlrbyxEV15tbAOmdjckcFdp4JWOzKH5FCxOURiLI1ficQ1f7hhvMg1f2gc01ikSC6aP8PDNjYObRgcsmBgwMLnkJHNn6FhJ6RKDRfsHFYFuroHfvDtV/t+MLmzKPB+8LBILP86JLTIfuBe90XgfoBHVs2osMXe9dbAFS3ybwN7K3x0qs91utI9BWFL4H6Bvliwxbxk0TdE4o0/czruO8/Lq398eWTKz4eY5pwgbM0QIp7+JVnwVZF40y+cjsJ73Z/rEU///fnDKGyNZZEYkvxnReKP/tTpePted2YipvMZDNc1FoStDzn3TNgaxek8oZQMfXPV2jmQeT0IOxQw9PbC0N0DY28Pj5Rqa+/HkMkE82AvW3APw8YaVUYkXy1ajFMTicSuqohs8U/+QeQl5KZRw02rh9Zdj8AwPRK9veHBmkqjucEP61p3nOhqbUX5pUuoZM1d40BivD+WZqXe8BwSAMhf6XJJO3zC4rDxk0+Nq5RIXl9U5a6qIA9zs0IQFhZ/w/Eo6uXYiWoEx6XjkUfW80qJ7jo39PW5/I+l6ixYzXsgl19BWOos1jc9agq7oA3vh86zDeb+Fkh9/gmlzh+X9/8CsenJqClyWcxkhCfhnb4ciNzZZaaUTQ8ZfZOAyE0KEXuXj1IETngOoqKiXN5lt/Haio/QICzADSKxFIoA8qB2CTw7dp3Dl771CnoNrmioQbMd//mbUuw/3Y5fPZuKiEA3OMx9sHRchtwvjacjTkbYorN/O0dfg16C2qe1iHxYBosZyP2JBG6+IvR1OOHxH0q0lA7DskQO3zARjN0inF+ghjxKDEeCFNY6B/zfG0J4zcSR7UbWtBoVH0OPPv00Tu3fj527L2Dpkmj4+lwTRklEWrUyDo2Nvdjz0p8QlpiOBWvWcN8tlVqNpVs2w7h4EfKOHEXh7stITCCfNZ9RgYxSaimiKy7Wj5vDXzm9D8ff3oXIxGQujFEFRPHVSEAa6yHR0byNQOOOF0vo6uZzyWToQ0dHP0+DNQ/1ce+5sfOHn1suFI/MHwWbP0reXzeNDmqtDt6B7oj09IC7pyc0Oh3ETnYeu8txbP8xNpbsZ2578QTeN9hiQfx1SF7HHfpQCPz7wt71N850OiJ7x3jfPKXeDyhlVwrJxAaRk4B9Pq0hs/OZKF4gIDCD+IsgOcoWs4vuljH+VPkqMJfNmxurNk0a0WYqYPF/TsfkQv4FJkMwex88wt7LFt5PhuvPiMR+MkiWT/X5lKrGXlM4e011M9itDyJqtsp4i70fbLvfUhO/KBJ7qSBZPY1dZH5FJI550em4cz8VgX8b7rmwVV9lPCyRSa6kN1QmePS38MqIem0wvOIiIJLeUeGLKUML/5a6ejRUVqGxqhJuciuPpNm8LoJHil0PRX2VlbWjrqEfEcnp2PKZh/iCfwSKHCs5fx7njx5GTLgG27fe6MNFRtuFl5pRWTuAlQ8+xtMgCZvVCttAL3p6euCwWRCW9TDqit5BdNa/IJKvgsbLA75RMeiozIF7cj3M4ufgF7oMzcWHIRfthVK3ie38CN/XxxZuxZHKczhlLOJiFpFuS8QCz1koai/DyvDZKKuuR3zU+GI0ISEh8GSvp7u7+5bnbc18V4EfuW8qTyvs7x/CM999FS/vODvh9qcKurHkyVP4/lMJ+MSmEFj7qiFm13vtihQoFTKYh623PB4l/oXc4veN0XIMPqdFaKIYua/Z4R0nRuTn5dD7idDb6sSgyQmbDzsPnQ4MGp0IjBbB7Rdu6GwgjynAe6UUbUtlqP5uP6Iqh2/YP7lrWtm1oSgpEpSWbt6MyIREHHrzDYQHqzA7M2TcdQ4J8cCDge4outyEf/z8BWQsXor0BfO5eETVClc++ABMxlUoPHMGO9+5iJBANyTE+/ECBwTpqIEBOt4o9a+uvhO5+15Hj8GOwIhIPmaCIsLh4e0D0RhfNLlCwassUptJqAKifbAD1rYydtsOQ98gmwdtly1tphMzeiCBafE1SL4NQdQSGI/2aoTV7pnYGS0mvf/t0hDF0/lLMaEQQ7KV3f5tBrojIDCT6NhididbzKaxxezky1DfZcTTn3M6KmCBGY5GFYCnFJI3HxaJM+4XDzOZK5VwOmtWkcSVqvbTGerSBxkJ+/+Vr4rEqfeT0KeChCLLb1x03wFy1zX+4cz0SOCDyD0Xtv543mH9n4+6P3XwcPmhLZtTZEp0skVzJ9Augliu5iluYoU7+1kLkUzNmoot+CWj0UG3Y7C/HwMmEyxmMxckhoeGMGA0wNDTg97ODvR2dEAmscPfT4vAQHdkboiEXH7jaRkctPAKdlXV3WzmuCM5KxsLH5rFRYQRuMdWcTHOHToEL50dG9dE3ZB2SLS2GnEmpw4h8el4/Jm1PDqGaKqpwdGdOyEd6kNzczOqz+5AT905sktAZ/0b8Al9B7bBZCjdUzBsLGSvQY+wlMcwbOpBw9nPI3PjZjgdrexc+fAqd+4qLd566jfYdeEQnj/2Fwxa7Xg0eSOe2LwWRRU1aO7oRN7lK7x6YkrctVgoSnfLzs7G3r23jvBeO98XUm0QpO7hyLtYjSee/iuqam+dmt8/aMNXf16MvSfb8OI3UhAqyYcubDmWLYrHu4eLb/lcKj9xs6tuk4ow8AMt3PxEyPuFBQlnh9D5bS1MPSI0Vzgw2OFE5lb2sTZfwwWjyhMOdJU5ELVWArmKDbdXLBhosiP0BTeUblEh6oUbha0m1mTmZrzy4i+xYvsDPEoqNCYaH/va13B6/7v41858zJ8XNs64naKvZqUFIS7WFxcv5uHlnLOYs2IFEjIyeNQVRT8tXLcO81au5GPnbF4erKYaREV68gqII+OHKiBSVBc1SrWlSK6WirMoPvUeTAN26Dy94eHrywVWirBSqJSQyuSQKeQ8zZa8um4WpTgOqo7otHMRy2kdgMNigsNsYK2H/zxSFZHSFN87XG5hY+epq755AvcB3xCJE0WQ/Ne97ofA/QhPR5wRYcvbJZLpbrvhBwrRdBfZ9PlEqRB/m35fBARmnCgnxPRHj+/c644QD4vEkjDXInSaiGkfgrA18ySFQvIUu/3Vve4Iwb55PjoV88OxiFzvz4Kw5UIrheQX7Hb7ve7IGKb9GXw15VQQtj7E3HNhi/juK4YTP3xU/9k9ey//Zd2aBImrUqDTtajmi+nGMVuLeOobJFJ2K2N3pVejVUbe8pzcGwu0OLdb0Vjfip6eAfT3D3NBgAQC8uzy1igRlewGd13ChIb1lKFFz2to7EV9Qy/sYg2ik5Kx9uMPjhp6X9vWJWjlHT0KtWwIyxeG8mp110MeRbl59TBZ3LD6o59EQGgof5xSxE7t24fuxnL23Ah4BeiQX18P9dxlGGh4EzLPL8Mw+E20n/wNvAJLUVNCUUg6mIfEkCk1KDnwK8RlR7FT4Abb4FG018TA/tZ3MOvB5yktCQ9krUGoMgTl9U1Yt2geWrp6oNdpSMFCdloSzuYXY9Bsxlz28wirV6++pbDl66lAZnIAJN5p+Mmv9uK/X3iHV9ubLEfPd2Lxk6fwP19IxONb87B1Xfptha2J4lOd7LIPqcSQ2pywtTgwrJUgZIsM3V02+P/AiNrPaZGyQYKKzw+i+w0bLLFSONsdiCqyQPxlLRysy+ZvmqAXUW0YJ4/ekodLuE+XzDo+FZNKbaxcFIbkCBVO7noVXiFxWLxxAxeOlm/bitbMDBzduQslpW3ce0s/Zgy4qWRYtDCS+7xduHAE548dQ9ayZYjPyOAFBigFlcQuasbeXpQXFuLImctwmHu5ZxeJZV6eblycovEaEqznjaDov37uITfAxlg3erusPMKLRDUtm0se7HlKky/EkqvzhURh0fXzxcZubQCbM/wWN09DpXF84GCZravT9Klvv2o4PYnLLfA+IYKEvM5uXpb09pAyTaWh6a/6pLhToCTlLN8XnxUCU4d9cm6aubSdf69qiM+KxFnsEyD69lvelhXfEIm9f+Z0dM3AvgQEZhT2HvDFT4nEP/6r09F/+63vLiHAUkzONvWWUJo1m7/q+ykS7d8F9i3xi2wN8WuH03Fn5cNnGHZ9I9h3m+wZ2FWGkKo2jq30x1D2eVV6rzvyZZE4WAHJounuh43ZlPvlNQncG+6bxcp3Xut76YeP6bvffOvSSwvmR3jGRPvcpLKbk5uPgzUnbm8XEhzkztvtINGrp2cQ7R39PKKqq8cMD78ghMenYf3yxHHeWSNYLVaUFRQg/+QJ6NU2LJ4bzKvSXQ8ZcFPaYV3TIOauWo2k2bO5QOGwO3A5Lw8Xjx9GapIX5m9wVUqMChbh9bwKeIR+ER2FYnh7vY6O9tWI23AcTZcOQO52DD0NufCOWgeRRIKBtjegyVgJh/mf6GpLgNY/GQrxG+htfBweIS6xqr6lHXHRETwaq62nF23dvchKiEFPvwlKtQr5jZdR3HsZn1r6MN9+8+bNeOaZZ2C3TyxWrZjjix5RJB585Nc4frb8tud3Ivr6rXj6x5d49NZ/fWU55DLJTcUxGqibr3usOUqO7s+poYxh56DDid4iO1IWi9Df5USzQgJ8U4vUxRKUv2lDXIkZ7qYz6yoAACAASURBVAa278tjIrEqbPB6UIaSaBk8PqpAZ4sTCWEidObYbxC1+Obs2jwUrGbXWIUtm5KoGiBe/9UvkblsJVLmzuFC5WNf+iJKLlzA/oMHEeyvQGZGyLioPXd3JVYsj+VVOQvyj+Lc4UNIX7AQyVlZUKhcQhilKZLoRa2/rw+1ZWUoLCtHd0spPHRSBPhr4eeng6en22ghBXedkrebYhuCwzY9ex0u4FZ24UxObZfZbHni26/27ZvWDgVmlGdE4lCZKxXqTjnM2t+tsB/6pdPRfv0vyYg+DIh3QjKfTQHyuKDUj6kUKBW4t+g8XX8feGc6O2FfQBWKKZTjvp9xQjyZaAASfG+3EJcBEvoL+J9noFu3ogd3Xh2MPkb1k9yW0o+Md7h/WlTMmIfbFKAP92kJNqz/phnqy7Sww76dfQOpHfsYu3gK9pieLfDj2IhdwHpLc/DGv6DeGq3eVVnu5Rnr7BSZZBriZOac2uFKi94x/V59MGHjJWbYda44TrJfZdeavRkFsHOTIIJztQiiqVQUjPo6QIuIyzPa4TuEffd4WHT7arWTGSsfyFQ1dj2/zq7xkbGPsZMhlfD3c0kEWxXPY9eXvvt53mQXN4PtRvwxdvufM9bZKcKuCy0+b5eKNalrDFdRieem36ubw06cAS6HmjuBXt9krxFFGEzFr/NDL/DfN8IW8Z1X+9750WPq9CNHK35ZUtK2fXZmsCg42OMmAtfUIMN3it4inywybqfW1T0Aq10K78AgBITFIWtWJPyCg7mP0kRQlcPi3FxUFBYgJEiFVUuDJhQVzMM2FBe3oqrWgNT5C/HxRxaO7rOxqhon9+6Bt86GLRtiebW6ERQSB2qry6DS+WDYkgh3n1povI1oyHkcCp/PYOFnXsOpP2yHPigG/R217JvKAJyWw+jvcUAb8WM0lX8XYdnhqLm0a1TY4rEcYjE0KhUXq+p7GtGU04LugR6Yhgbwt8s78OL2b432ISwsDIsXL8axY8cmPAcWpxLZm3+P7t7pz6EDZ9txvmQnZDLxTYUtkvHHOoF1e0th/Y0OenY6Wy+x1x0qRsanZSg75UBYuhip35TzcVPxvBmpu0xQmm8UqkIODaFxjQKJ31PC2OWEQi1CW7UTgXsGJ+xDnULMVi2urDsSJhMT/BEZ4YXcvNNsPJzDks2bERIVheQ5c7jJe/6p09j5zklEhumQnhY0TuCiaK5lS2N49NPlkgt4+fhRRCSmIDV7HnyDgka30+r1SJ03jzcye+9sbUNzbQ1K6+vRmVMNsX2IC1yenip46N2gc1dCq1HyqoczBQlaFLV4Mb/J2dFh3OG02b7+7R2m5hk7gMCMIHGJDZLbbniNHifsj/3M6XjvVhtd9dgoutr++DmR2E37/9m7DsAoqvz9zcz2bHbTey+Q0AmhN0FRAQWxIeh5nt4pnAWVcid6op7tENsf23n2goCKIIIIgtI7CTWEkJDe66ZumZn/e7MbOtnZFEJwv/PdhuTNm7czr/7e7/d94O4iLWwW+Xef1tfYjXYEdSilpIhJLWVi7J5WbTJsqe3GsZZOi6gSCB2u/dpyn8sFh9jCVOc5xaXkCT7uLJcj3KVDDVsLRWtfV6+Zy7D9ySrggMzsv5B7nH+WdEWDbO5WvCbapnd2PdoDZPeTRsbl45f4Mx2v/28ewwaQnIslrgqXyhbHoZMNWw7juAzFXnl9zhEC/Ic1bJHVbf07onC+UbaKpFySdpP02WyGDSVrhE9w8eCHS0IAl4xONmzJUcoj/X8ZA+YxODGAdc1QNf6UE5XK/5HxgHx39jny9WfDuRHwNMgzo+2h0w1bMt/xt6S+f4eTda5d3bNjDVtkfrzR1WvsYzZ3weHxJXCI3GOAq/dw4wozbFHMX1JP4w5vf3ma15Cf1pqe8vfTTwwLM3KUxJ1yX1HjB/VSoWFWLOOw4YtU9I9s0XhR8ryyWXlYrDbJU4oalxobLGhosKLJIpB+r4LB2wdefn7wDYxFz95B8A8Jgd7YMl1IXY0JJ48cwfGUA7DUlSOhewBum5wghTaeD1OtFYePFiE3vw69Bw/Fn24bDrWDR4sqLlI1Pb6uGKOHRkrGiGZQo9vBQ4U4kVUL0WpFXV0dDOG3o7b8ORgCcxE3eBpqS3/AoVWpCEi4CVU5q6E29ofO0ARzXQUa+H/BEyp46Iuh1AyCrX7v6bKTEuOxOfUIVu7bgDDvUKw+9gv2Nx6DqpFBk9oGxovD8ZKsc77HzJkzL2nY+v6X9vXkrai5kNPqnLqc9++ykWr4+TMoeagOQZU8TK8aJKMUjVytebEe1rFqKJY1IflAo6QAeTF4V/Fo+pcJu+7yRNQwFk31gO3dBnS7iCoiPQZmYgKweXshYiK0SOofJrVB2i5Hj4pFeXk9tq9cArVXKEZOnAC/oCAMvu5aiSyeGrh+WL0DocEe6NM7BL4+Z4ygNOx2yOAoJA8QkJlVhl+XfAwbq0dC/36I79NHUmBsBuXkCgwLlRJG2j12zU1NUpsqLy5GcUkpjueWw1RZCMHaCJUS0GoU0GqVUj01aqp4yJE+xJ3bhxyQ+hDtP6QdWkkfojxatA/l5VfZysvqV5LH+J/5S6r3tfwm3egskMX9aBeyCzbwk8hiyWVFyw9EgVp+P2EZ9rM59tPP/7hahhvtC9I3NQxEMuAzTgxbzCS6qXxbFFoecFu8F3tHS6tmsvjcS+5zeZRf2gFP2vvNxSWCzwIPYQvZGD4E514yox9h2CCy0Sx2ks8NN1qNhaJQSsbgu+aAtZGe7YJBj+n0zZIaoJtCp96DIoT1DDhqrHDmyTGejGsGMq657GX4R8HrolAwlWFvjgC3lYzfg+Rex7as2dThmM2wPcm4K+MAjaHGN3rgGtZirqs0VM0Rijt3LqOsId/x3y5c2mcGwyo/kEKhOgdzGLYb2ZE4HZfIuuI4WevkyFBS7f4kw/ZzYgx04yrFFWfYasb8b6p3kY/Jr9zt9SIUmqf7DUuWvHnqzWZYzVayAbdBEHjQ0G/qPUN5tliOGr2UUHqoyCZeA6NWC62HB3R6D3gYDNDodJf0wjofNlJ+SV4ecjMycOp4Osy15YiK9MbwAX7w8blwDUw5ufIKTDh6rAT1TawUXjZm2oDT96suL8fO9RtQUZCBQQPCERqaeM71lAx82/ZTCI7ribuf+BuOm1fh4MGDGDj8bqR8/Tb6jk2FqOgBz8BJUGd/BZ+Iu1B44GV4BGVAhToU5o1Ht+sfxM6PxmPAjYNJhcgYd9YBTnFDKfbnpuDb3NXg9WRYaODBhGhg1tjAaskywyqg0XruXmfKlCmIi4vDyZMnXXt57QxKfHKBxJuRlZQNq8MU8C63weNpE5peNUBNlkoxmxqhWndxr6uzYVExOPknPRLHsqAMApS6TXxKh53b1RiyuBoq8xmLGB0dh47qg3uemIyta3/G9z+kYPiwaISG2B0X/Pw8cPNNPSXPprWf/RcBUQkYev04icydfg4YPUpSyvz1923Qqmzo0SMI0aQ9NXtWUUMTJZinyWRqwsnMI1j90RbyzvWI6t4dEXHxCImKPB2u2AxqMA2NjpbS2aDKnFQwoaGuTkqUx40KJ1BDWKPFApuV9B8LL4kMUI8syrtFw1Q5pQJKrRIqLzU8VArs+e13lJXX/2v+kqpXXX1vblx2JDrPchqrW2PUOhuCRM6GpWRR9HNbynGj7SCjiIH04lQZx7RGJUA9NlpWBrkE5IQhknocYVwPkeo0yFVmswF7OYBuhpwtwDmdXd3pnTZXzg03WgDlPiIb/0cd3rqeMi+LZhmW6UzeJJmhv5QCdSdZlmWSn+Od5NWowE0mn1+2Q/WuWlDv63kM+xQZojY6z22HCFHnPFfHgZM5PvPgDyjAUaLeFg1bdnR8qFpnIRf8K5Hg7iY/Jsi8ROFhN15mOc3ZQZCvjsrvZ+zv2Jlhi7Yb+o7dhq0/IK5Yw1YzUm2mBf2Kmd61RUcmDRw5GAp9MFiNDxiFq6Hil4DISwqJeZnZqKmokIi7K0pK0GiqgK+vVjJcXDPEF0Zj6IWXkmVBRUU9TmaWIyunBkERMRh4w62SUl6zAl1FcTH2/PYbynNPIKlfKEYN6HVOGZT0e/fuHNQ0KjFu2n2nDRTDB3XDli1bMHz4cPj1eA4F6bMQ2v0bsKoShCYmIjdjKxSeI2Gp3kDqLyJ8+P2oLkiDl28OOPUk8A2LYeMHIy/lZ/j2vAbP/vgWUoUsiFqy7dBwYPQK2vERqAgBa2VRJJSgb+C5+2KFQoFnn30W9957b/s861biWdgbKiWKzxyshSmYgy1fAFsP9HhBg4P/5aAhL6NHAoMj71ihsshbr1V7cQgczqGuTERjFeARxMDSICJkDIeqr8jfis+I/W0lafjgbpKC5bW3TkFxbjJ+XfE9dEeLMHRwFAyOUNTICG+J7D0zqwI/fPB/CI7rgUFjxkgcbf1HjEA/8j6z09NxcMdO7NiRgqgoL8TH+SEwwFPiyqKgZVGPMJrqGyzIzy/A0S3HsOm7OnAqPbwDAuHp7UXetS+iu8eRsgMkIeOzQY1U1JBL0/liBy1B5M0SYb2trgg7Nu6goY/Lrd+YFuJr2UW40XkIdiHv7va66QeiUNNeZbnRamgZ8AflRKKy9nDEVhm2HEYxJ54W/HHXImI7D3b+ODkhUTj5tijkz2UUOxh5Hi90Ue02bLnR4XhdFCpJu/yJka/qqXnCzrXUKXxojzCsXiePoy/1DVGonkf6HFngODNsNYcAuw1bTrAP2JJs56NTO80MyUvG+SlxB4EaYGeDk2MErSwADkYAZHzGeGeZL0eoWmdhmSjwcxnl1654bbGAt/NcHQlZY5fJBBzwtL/jyTLKvJO0n/mdLXzgxuXHFW/YWrZM4OfdyE7ftfPkD1azZdzA5HDJO4vhNGBVHmAUOpLUdoVEliymGZbyiNBTBnsBIi+d+4j07IcSztPEW6QNvGgjSbCAsdrgy5ihN9gQ7CFCnxgEnTb8tHHqbFAFOkown51dKXnneHgHIaH/IAy9ta+kjme/p4j8zCzs27wZDZX56NcnGCP79zqnPBrilZKaj6zcOgy+dpxEPk5DzZqR3CcMnzzzG/75j3nwi0lGzp5HkH3oHUT2/hVK8l1ZsxK+kU+g/MT75OsFQePph8LDvyIorjdE62aUZtfDM2gUsrc9Bq+w9ZhxzV2YsfFlsL5n5rJrMBgPjrpT8k7bc+wozJUc9h5OQ3LvxNMB2tOmTcPixYuxd++ZsMbLiYE4E3idMVYH/0UeCCCtNnWDAP9wBkUnRfSfqaQCjzjxC4/u38vn/OI5BvSRW7MFhL1XhyYPFtXTdeSdcmCFc/NuJg9kep8zB0FBEeGY/thjOLZvP376ZR0iQ3WSIYqG/dH3HBfrJ/FvnTpVgZ8+eQ9ewTFIvma0RDAfnZAgpToyTKenpGLXgQOoqzohGcWionwQEmw8rdTpoVOd9uSioOGBDQ0WUu8GqNUWKCvLUF/DSe2f9glGoSKfzf1BYVcQpUYv1t62yIRu7xuiIAWjSf2B9gNKLm+tt3/yAnbuyqZhsT9V8Kb7XheE856GG1co9HIzkjbQTicDblxBoJ4NMjYszCRq0HFwp7kE1rkaoslK6QhdLbiTEAncAFlkruJa+v8MKB8d96iMoodRlSdqDGtbDd1wwznIvE4pAuQatugKgHbRTjFsae2eVTK8gERJnEYE8wtZfv1ZRtHjZjOsDzX0ta2GVzc2iYJtHqOkz0juQdgp51k6BnPsIZNOvXPIeuYXatCZx7B0fJZj0LnKQ9X4/a4cLokyjZwdAfIekhSSIIZTbKDhkiT/epLfKf0FDVd8wr6F3NP2WrrRlXDFG7YoFq4T6mdNZG/etz9vcUlp7V9HDI9hvL0oH1D7zMs0HMxwCUU5yntVWdWIoqIaFFK1xIom+IdGILbnUAyZ0hN6wxluLhrqRVUSj+zeDZ2qSeJTCgrseU55jY1WHD5SiBOZ1egzdDjumzpK8gI6GycOHcK2n1ajJMeEmupK7P70diTe8DQUmmU4uuczsPwuqNRVqC9/DaYyPbT6SihUWpiKDyOulxqCZTMqyoYisFc81KKAotT/4NZr30VZXRU+2r8C2U3FCNEGY0TkQCQlxMGg90BkaDA8tGqcyivE0jW/YtrE66S6UK+t9957D8OGDYPVenlDsJUkvQd7Iz01QAPvlzyQtYu8j1IgeRKLUwdFFK+0gq21gqkQ0CPdAm2jfBsM77D3UAHEgv5q+B8n+zwVQ9oVaRNncdhT0obyCB3Wf/k/jJg4CfG97V531Cuq16CB6N6vL1KaieKjDOhL3rtOp5I8sGJj/aSUl1+NrSu+IPc0SETw3fr2ldoODVGkiXoLnjx6FIeOHMXG3w7Aj3oLBhsRFGyAv5+HxItFQUUGzhYakOAw3Iq2Jvu2tg0oK6vD1u1ZQnGJ6b3cDNOTH+ztvLh7N1yG7MZPNkLU8+aqPLH8o4L0furHTMnBncmie0cA15JPl0JIHd5Nzk5KtylcV97qNMgMiSIQVtH/Lwc2+tlVh5ypgrIqcHeQzzfbVkM33HAOGjzgilwM34nqlXJIoil4CJLIRQP4dR7g6DpE6eQSFWdXfPy4jVX8I0D2IRgPfkdHVqQlyB2fyXpGaiuLgH1zgELI4Ey8mkPVGBfV+gTazToJCplhiGSMk+ZgaoycxyipWE6kk0ua37HbsPUHQ5cwbFG8vUYwsyz70L/vFFcuL0x5KSzMq294mBcTFekjEXA3h3G1FtQTixLN19Q0SkqJlZUNlFsIdfU8fAKDERoTj4E3xiAkKgoK5Zn5lSrV5Z3MwLH9B1CcnYGYKC9cNypIqtPZoLxJhw4XIievDr2GDMW9U0ZI/F9no7K0FL//+CPExlJMvCEGp0w52LJtJ4LCB0MnzoOpOAnB3QdDqZsIVh0JrTEENmsT9n81AaUn1ku8WqLtEApPcghNovkzYPTpgcaa9WioLMDMsdPx0DV3YfeJQziQegp/mTQBOcVlSMnIkoxbwb7eiAoLwcncfMxfvggLpjwGtVKF5ORkPPXUU3jhhRfa9IxdBZXpoHIspSEKqBfpUZIhwPv1WtRO1+PIZgHxA1k0jlUg5Jk6GEwXV1NsCbTFUCc6XTcOgdcrkLlTDe9Qu2FLYTvjvbqJpBuvDcOE6yOwffOPElfW6Ek3nyZ2pzxqg64di77DhiJ1+3as/GkHwoK1kmGTqh9SkLYqpWrSvtKObcPu9T8jPL47epJnGxwVA6OvLwaMGiUlyoOVn5VF2tVJ7E7NQmVJOnk/Svj56e0KiN46GI0aSWWREsC3BVRsocbUiOzsKuTlVYnFxbX7RYjz539dvaFNBbvRGaCnsBfGTF8cQ8ni4C8LReunHVkhNy4fyKykI313M1nkOzNsUa9manRxybAVDtDTjhbDEMmouQ5dhF9rHsN6MODkKP9VmezR6PhEFJpIvyGT7YW0j+fDERrlNmy5cTngisdFRVvEI9qCRxnWVwtOjipfPuk4+18nP7wrClWkz9H+N9bZRQ7FO7dhqwXMYthYNTi5fGz7XheFTuFemsqwXKRdnMYZLCbw0lxGw84cYbkPOruIhiNeraFq1APLlR0xyV/UYZVpAfIViWFrAr/2zD/F1eQNPuL8MuYOco+5Dj5YN/4g6DKGLQpBkAagtSzL/vzCNGu/3Nyqx7fvOHWvXq+BSsVC76GGTqeEWkOSiiq/cZI3lhQC6FBOpBt5q42HxaH4Rj2o6ustsAkMVDq9ZKzwCYxEeN8gDAgNhY+//zkhghQWcxPyTmYi8+hR5J9MR4CvCt3iAzAy6dxwQ1rd/IJqHD1aDFMDJ/Erjbl7EFTqc9cgdTU12LXhV+RnHMbg5HBERNg5/yaODMInK1Zg0XOPI2/bKiSOKAGjLCPfJQ1NtUUoPdoD4UNeRnDf2eTnt9FQH0t6fxVq66ciOnYAMn//J8LHJ0Gp3I3K3EPQ+0VIXkbhXiHI0JehqKIK0cEByCulP5ejosaEHZl7kVNRgMOmI3hZOed0HZ955hls374dGzfK5pxsE6g7wTPNz8dfAf8ABic2CzA8oUfQ+w0oj1OCHaIB1yRCZWndmOVXZsOO9Tx8+rNQqBgo9GSgJbtD00oLPM8ylK0gr/ShkYFS+7phXAJy86qw+qP3EJ7QF4OvvRY6T/vhFyV2H3zddUgaRYni92H95m3wUFrQs2cQIsK9JeOrl1GLoUOiMIgXSDnV2LV2OWrqREQn9ERs714IiYySCOFje/SQEoXVYkFZYSFK8gskBcSctGJUV+TB3FAvqR5SA1ez8uHZyqF21VBGaoc0mtBqFWCx2Nt9Q6MFdXVmSS2U/k0U8CEY/t2nv6k77OhnbnQ90AWoXMMWxftkw9C4ULQu7agKuXFZoeUh/KQA90/nWZnJriohsXZjWEsQbeBXkUVFhNwyOxMiuEmMc88rGuay9uznRGabH1kZhi2CQfMYNnqhKHRaKI8bfwwwEOMB2VvZox1Zl5agtYsqOPO8IhB/PNvgQH74kZFh2CJ5xpA+F0AVI9tU0asYKrCySXPJWLewI+vSEsIpW4q8cMnfz+b5JKvdVQw4p4YtguirN1SN6+ZC5rI3RaGkw6rSAmYDIyBPdXPbYlGoaP4HecdkPOBkGLYQTu4xjF7f2jq60fXQpQxbzXBsvFOeH8s+oAwyqIODDVNHjE2GhfWFmdegsb4BZnMTrGazxB/VPD9KhNpKBTxVaqi1GolY28PT066YqNVeYMA6fT+eR2FODnLSTyD/VBYaqssQEuSByEgfDOmVeIHXTFV1AzIyynAyqxJ+oVFIGjcFUQkJ0v3PRm1VFfZu3ozso6no2zsQg2/pfdrzjH5FMzV4bVkLXeD74FV/QUXex/AJqwSruRtan1EI0mUh8/enEDvyBWw7/Dm0nk3IOapC1LCZKDmxC/6hhWSi7y7xSNnqzigk+nkbUU+eETVopOXko8liwfwNLyHMIxj7645CMNvIPRQ4WZKDuEC7t6dSqcTSpUulkMSMjIz2epUXBWUJpTttRsEgL1SJJh7Y/7UNceM4WC1Aei81+vxdidIMARFv10LT5LodhhLH75vmidChHBRqoDyPlPFRI8IPNaFbowDGUSSNOdlj5DC9rApClJ3gnRqpwkK9cCKjEMvfeQMxvQdInlYeBvshGPXg6jd8GPoOHYIc8qwO7tyJHTtTERPtg27x/pLXFW0z0VE+UrJYeOTllSJlw/fYUGGGT3A4wmJjEBEXB//gYKk86ilIUzOokqGFtO+66mrU1ZhQX1crtXtLUyP5vQUWm8NgRdUelSw4hQJatQpGjQZa0u7VnBkaVCI7Iwe792R/mcrX/J3y2T3lJonvwhD3kl4z0oULqIV9yTxGMZKMBv94RzxLRtWNrgj1W8COOUAenC8WfTztG8Vf5BQsJwyRDDW7yQI5l2ws42TWt1MhNyRKBLPq7H9bwa9R24PVnZGYkFtIHgdO+UDccKO1oATbc8BNlH+FuLXjauMUMvucPQyxGQx48m/uLRmXKgS7GMT7ranc1Y7ZDNuTAzdbTl4ynm94A/x3izq6UpeAXKU8etBw9r8rgU2+QB0jI9zyag1VI9/dhfEAnTgeyFVDxDlzcC6wmexMqTHT6OxCxv6O3YatPxC6pGGrGQs2CbYZA9k/MWBqGhq2P3jd2G4wGo1Q+ISA84gFp/WVCLRbBVGAYK5BbvoxZBxMJYOsBb4+Oowe5A1Pz6ALstPwxVPZlcjKqgCjNiIxqT/uujkJnsYL+11xbh4ObN2K0pwT6NUzELdP6S15ljWDKiVu2pQB79B43H5rBFavXo3bpjyPnZ/mwGr+FYHR74Dh4sk10QiLSkP+jrvgHTkWTRUrUV2qRYRCifJTBxAe3QuiLQWmCiWKMrYitO8NUHt4Q6NWIy40GKv3bsHa7F+hEVQoVlehWKwGPDkwJIkWHqWmitOGLQo/Pz/8/PPPGDNmDPLy8lr3XJ2A0rNTn2KVkcOh2QaEXKuA0Uq2Fg5bPbUNJj2uQk2xCN0LdQgpcJ0Ciqorpt6mx8CZSmQeEBDoz6CpAVA+rEPVU1bo8s94gNEZc+pfJ8DMNWDlqsO4dmw8aWNaycCV0D0Q8XH+OJGRi+/efRPBsYlIGjkCfsH2QyYqchDVvbuU6k0mHE9JxeZdB2BrqERMjC+io3wlI5dKxZ3m4qIGKxoGW1R8BPtO7JbEEaJ79kZ8b9JGNMbT6ofUM5B6dqmDguAbdGF7vACCDXxTJfi6YknxkDfXYc/eXKSk5r1nKTLNWrZJcD2W040rDALpOtyTLl5E3fr+rgN3yzxG+UwO+C+Wie620BVBww8coRjLyZwoY/MiEcHLMmw5OLmcKSd956gH1zZigI4HJZkmG7wbZGQ1V4Nfd/Yv3haFMtJXdsJ+2uwMdFHtNmy50WGYbVcIS3Sa0QERwvcdWJ1LgoopqMHJOXgxkY3rb2f/gno9kj53iPzYx9nFrL3PuQ1b54GMeSPJmLcMMrxUCXIbwd/bWWF6pK2QXYostVpSP/4cw9ZZ4eK3Or/86gtVm8uwPRjnXJinQR7gio6sz6VAPcYNdg9Op+DPe8dU+Iasc9Y51C2dgLl9KsM+7l7X/nHQpQ1bFJTcmmXZGS/ehZRvv0tdNHxYjEdsbCOYqkxJIZFVG0gyglXp7QqKVDGOcyjFiSL5z6GWSJXhrA2SMpxgMUEw10qKiv4awH/whd6wNKSrqLhWIgXPz6+BWu+DuF49cdOYPvANCLCTN52FpoYGpB88iKN79oATatGrZxBGDeh9QejisbRianAot1oFn4n338D2bBQxa8HnuPPOOzHo7vew7aOZyD22E2Hdj8MrMB0KJWAw5sBi2of8XAW8g1TgrU0w1+ZBrdOT75WLqrIYko9B4b6HETn8MzTwNmwt2o3tWQeRUnMEnJ9a2oowmjMH0IpGBt2CopFdwQtDWgAAIABJREFUUAQvgye8HOF2sbGxUjji9ddfj+zs7HZ9l1Ek0dkolqQjD+oRfqMCGd9Yoe2nQBhZtp3cJ8K8zQr/WBaa7xsRk9E6mgiTkYPvdUrkHRSgWVSPiqf0yNvDY9SDChzurkZo/hlj2ZdKDu9OHw0vPYf//ftFfPvdwcbk5HBt717BktcVTYkJgUjoHiCpZG5c+hGg8kavwYMlY5RKbedR9jiLKL66vFxqC1v3HkVDdTrCQo0ID/dCcJBBIob39fWQ0hlUoCn3d6nN0nZM2zSjJJ9KraSECI4qMXL2NidSInnbGaVDSy1pyybJSCspIdLSKhuwZWtmXWFx9ZP/+qb2I3fo4dWBHLIZiJQOs1oVCkbJVj+JBPdPsihcaAb/VWfxsLjROigcIT4ChOVyTuXJiH/LWIadSVWynJfuVA2RbjC+s98fl/B9vnLA2TdNKhlZf/tIJBP2haALbTmGrf5zGLbbIlE44VIF3XBDBmYzbChpy+/KzU866a7XRCGlI+t0KajsXDpOSUHJqvzniym2kt//SMYsp4YtgpGPMWzI/4lCYWvq2UWhvp9hzxHt8AX0ZHfjT9oHpaq9nXzeDHnxqnlW8Ne/IwrFHVJTGSA7khvhhM/RgQNkbL3glN0RuirDsHV1hao5eCO/gHxJxFIBfKcYtsiOkgoY+TnLR97l4YvxvDkEA+TwcwWFA6NwnrHcjasXXd6wReHYmH/w/DSvTRt+Pf7WoSOG8QOSwhER7gWhqVpKbUVtrVlSjCsuMaG4uBaNVhYhUTGI7DkSw6Z0g6fXhWMwDRU7lZYmGTHK808hOtIL1wz1h9F4YZRIHuVb2pNtKy+r+4h8mR2R8fFfGH19JD9LxlaEzMxMhAf5orHqIIKSElCQHYDiIl8otQZoDH7wie+NMSNjsf/r61Gdv5t0+gaSCkgdeHD6W6DgK+EftBMFB7+CR8JtSCk/hkPaTHBKjd1nQ2Nfb3AihxHCAIyIG4DVG3bC01OPapMJQT7e6NM9DhEhgYiPj8e2bdswZcoU7N27t83PloLOvCthJwhq0jDwuFaJgh+tGPBeDVLv9sSRQxyS/qzA0SU8ei4xteletLEoyJamvkyEtb8KHm83IIonv32IDLXaM/N+Okmqsb0RFmJ3VIjs1g2ZaWkv79yZHXv8eMmfBg+O4qh4gZ3KigH9mabq6kakp23DnvVrERgZJ6kmRnbrflp0wMvPT+Lmool6cmWfOCGFue7YcwJqhVUycAUGeiLA35M8/7P42EReMlBJRqpWgAoYpKQWiOknStc2moXHFyyrOfm0O/TwqoFd7lpJvUNkb3QuAsrN8JEa3ItzGeVisuj5wC2f3jUgOBazbwJ759gl2qOdXOI3ABhDPlsUinCcrN7SUh4yeu4lG2aqVER3rle6wxatryy1LfG8EIhmkI3fj0pwsvhnWPuGXo4EvRttANnoTCLjX6v5zEj/WbBItH7RnnXqSMxl2AQOHN3cOVWAawYZzztNCVdu6G+zwt2Fv6fhidwzF/vbeWDVdkXSt12pX1eGAtypi1kIWrHB294E/s7ONgrKVUMUzwtDPAN+DeSFi181oWpPMGwgmZOWkx8HyL2GPL+XyfquUxRS5YaaklpedA6uB/+zTLVUei/6jt2GrT8IrgrDVjMWfFNNT0UnvDzNOGrN2tq5Bk/N9bGxvqqwMC/4+3lArVae70h1GpSLiOd5iUzbVNuEmpomiSuLhoXVmKzQGbwQGB6OkMQ+GDAhGt7+/ud4W9nLECVlw+z0dGQfP46askKEhXiiR4wvggb3ueDeND81aB1IyReKik1kIOafeWqJ6dAr072+7pF8Zmx68M+j8d677+L1N95A4g0voD73EfQfG4zq4jpYzSwEUYeGkt7QeT+FiMH/RmHKfFj5geAtuSjK8kX4kDtxfMOrUOp6w5b/PxjIOnv2Nfdh2nfzYNMz5wSORFpD8OjYuzGyf2/kFJdCpVBIYXcWqw27U4/iSGkaxvUegdDQUGzevBmzZs3CRx99JH2X1oDe+QHYVyA6x+9Y6lhEijP7sNj/gAF9v6hF+jgdeX4KKNroTErDEAWy86pO5RE4lIPPKDUOfMIiqB+HmhIRPplnvLWodeCh+8/wldJ3kpWWdt1TS6queXm697vrfjn2or+/5/VJ/cMkdc5mfjSqhDh4UCQGDRRRVGRCxq512LzyO/gER0hhiRHx3Uj78ZPaD/XkosqINNFnWF1egYJTp1CUk4ODaXloMFXC6KmEj48HvEm5RpIMBg20GqVEEN8SqL2XhrUWFNQg61SFpaCg+mde4BfN/7qmy0/iblwc+8B/mAyOdqmkNhYVRFrzS2RT/tQ8RvGBFcKiziIYdUMeGIc3hCMccRnZIMogkZc8sVo0bDm4uHyc3Ps7+TXtXFBvDg240TKyigL41Rf7A+kL6fMYJT376C6jHLdh6/LAA/LCrC4K0nkM7ViXDoGdTwu9ycb/PgbcTPIrjdOLTkNcSjax6zusci2AbLq7k023nA03WWmerX52BovI9Ea+OzW4ODXkORRJ/zCGrXZAGUkv5oB/t7NDth5hWL3O7l3mFCL4ixo9XhOFcjI+7yA/ygh97dqhalSghGzipivtNBQtztPnYf9+8r47ql4tYQbD6gwywyWZ8/j2muGKWiop5baxDPuIPO90N7o6rirDVjPmf1OzhXxseX66PqTmYMPE1NT8a1iO7a9RK6I1GqVGrVFICnc2XrCrI0oKiVawSg08PI3w8vWFl18wwnsHoH9wkGTEogTel4JgqUN10SkcT9mPptoqyctmUB8DvL0uNGZRULLwjIxSHD1WzFdUNPwg8nht/rIqicBw9lRWG6T1mxjXq9fp/N1ClJiz4hM8/cwziBl6O/Zk7UJZ9lKEJIwFo+hDBncLwGcg7/BUePdcguJj/cA15aKmtBa84i9Q6bzA128Aw90JrXYt6irycE3iYGx/6EusOfg79ucfQ0rJcehVOvhb/OGh1aK6tg71jU0wCQKigwNxqigX2eWFeH/zxzjSYy2UnIKUpcWHH36ICRMm4JFHHkFBQYFL74muTt7BufJSNV4cNI0C6n+yIPhWFSzdWOxlDYidokD+ERExJ9sWHbVjnB7sZDWKs0R41gLqahGDZihRWSQi9z0zhqQ3SfnKSfrFm8ODXmfmupjERNoOhr9yu2fw/O9q97EsO/6FqeKwX9Yfn+dl1N7Uo0cQ2717AEg7k/JTw1VIiFFK1GhF3jUKi1Kw78QuqD28kJDUH/7hcVJoYXN+avCiqdeggdLvqCIiDV0sLy5GRUkpThSUo+ZgKRpqa8BbzeQdKCQjFw1hpIYuq5WH2WKDucnWWFtnPtXYaD1ANrq/sxZh7VPf1XaKpK8blw904iabCLrIoRxAzjiRnMJOwMrMIeXNnMco3iCj3X8WikJ9O1TVjfbHWZZuYTlkqCMyYKaQBd/DLS34GBlqiM1hiF0BapkhUbBL3bcwqYlkwc3MlVFOT7L56EX6zRGZVXTjDw4G3A9k09Z03q9Vc8BRp3ZjK1wi00wQZrRH3VoDJdi7ZGbd/IYoXDTEghrsyRy0mjydh2SUM2Quw0Y2e5G6cUlsI4P352SnsOQDUWjo7MpQaO0GD53TjED2IlE4eKk/OtRr5XC6BUUC9KBjk9w6Xm6Q8eB1Mh7867xfU0+lQDLPOw3nuwjKefB3dZahxwDuJkhnZk5RQA3al3KNlquWCrt3OuUJlcUp6kbXxlVp2GrGgiV19HTnf45EVQmZeZOhN2gNt3Ac+8GAkcN1CUkDoPM0QKfXS8pxLYJycvFmB2dRtUTGLTRWQrQ1SfJifROpgeLih348L6CgsEZSSzyVXVlotfBfCrz5v08vazjHdd6XMVwXFhNjpIqNFDSc8bcffsDNQzR455138Oyzz2LgtIXY+VkdrJYViOh5HIyKGrgGIby3D/KPTIFafzNqKrejNEeEd7cklJ7YhaBoUh6fDYWKgbmuEtl7VyI6eRIeHXdG+fd4Vg6OZGYjKSEOx3PyUFheKXkhlVbVYNOJbciuzoXJYMXn21Zg5tjpp6+75ZZbMHbsWLzyyitYvHgx6utb3vfSI1Wq0zr/vKd1arQWttkeKD0uQMeL0OoZNNSI6PVnJcpSeegW1cOvrPXjcF6EEob7NPAOIaNcBIOASAabvxLgl9qEsHQLhuZaTqshLibpzpvDsPnHVYiMj5MUNFUaDQ1HVJw4cmQS+fN/HSGw20ma/PxU77jqnadm7NmTc09kpE9gfLw/wsOMUCjOkL37+XlI6TTI+2jMzpZ431itDziND1iNl51Di3JnkWuoQdU/JERK50PyMKytQ2OdCRmHDmLPb5vrbTbhAVNjzdqFq1Dn5s76Y4J6k8xm2MkcOKrD0GoPhvNAymHIwor7M9kwzCAbhp/bqVw3OgCUR4cshKkHszPZb/8k+6J+48X+KCcMkWA/JXduTT07A3JDonCJMMRmOCTH5Ri2aGgNNaa5DVtuyEVCO5aVaQV/4wei0DoOg3YBI1MN8VKhZXYIpM+x4OQYtshSTgpH7CxRv66C3mQ8vM8TbDRZM6x6XRQ6XSFQ/vgstthW7KTy3GuySrKPz1esYQt2CuL2QhV5NhPIuz7ZjmW6BLlUAPQdtyRg4IJaanPIqduw9QfAVW3YOh+OjT4lgv3yxbsNB/Zt2ba4KDNtTN/k7oiKCQOn0gKs8nSIIfVMpRyWdiLuBolcXuRpqJo8e0FDg0UKA8vJq6IhhzWNTZafSMnfWGymDQuWXUiOScFwmJ7Qr9/pf//+44+ICdfi1pvjcdPsj6XQP6r8OPS+93Dk5+7Yv3YREoZ+Cp2BkocrEBJnhl/j10ivVcDSaANvrUJjbS38/CJJ3Y+jsc4DXuFBOPT9dDSUp6PH+H+cvhfHsqBUU+m5+egeEYbC8ir8eOgXFFvKcLDkKCo8G6Sv/tbOr84xbFEYDAbJsPXYY4/h7bfflsITKyoqzslDfWT/StIsXOhLTnm1xEd0oI/XO4ZFaDcGadsEVK23wn9bA+KreShsrbfT2BQMTt7kgf49GOx/xQzfm1Qo50QMvY3FwToFItbXnc5LCYXWReqx5s89cTy9GBtXrMDEe+6R/pbQvx9OHjlCv/x/zy5/wbIqOknMmTWRfdpi42/IzCqbplYpJ4aFeXlGRniDhsN6eFzc648aS3mqVFh3xqGK4VR2sQNKEK/QgKHt0qHwKYV9ClZJJKDoVD5S959AXm7ZRrNVeGzBsppjNM+rrX5SblwNIIuWrfMYdhzp1XRz7t+ORUeQzfyaeYzi7X0Q5rpdu69ciBCpOqJTThrGHo54UcOWh52Dy9dJEV3GW4ts3uI4cAPl5b54mEszcoGdkfYQHqf9y6HedP6JuxtudDS2kZXC7Z0ZRv4kwyYpwMkJ2RVtTvocWZttIoNRnd2TuGU41BHdhq2WQWl8h5PxaTgZF+fPY5QpAvhnF4nCT51RmUcZ1lcL7np5uYUW2woV7CDf5zhkGInJ9791BsM+8oEouC6z3rWQIYK/5TVRONZZFSDjgRcZD8bLyctfIgyxGa6opZK3PGUWw850iyJd/fhDGbbOxjNfm46Sj7Ev320ckZ9XPlOrVd4UHuFtCA3xQmCAXuIxoop3ckANDU1NNlTXNKKiol4imS8pqbVWVzUeE8lELADrbMU1WxZsEs53LT8HL0/3CNfpvad07283bKXt3wcjV4peA+0iZ3+63ojXX38dL7zwAhiWQ2C34QjrcwMyt3+FxopN4JhiMpvrwSoiofYehYqT38Kj+iQYRQwUKgVEvghmSx/ofMOg9/WChv0U+al9EdbvRqn88OBAbNqTAquNR0pGFhrNZuQ1FGKbcBCi0kbKIc1Fr0BlWQ2q6mpgswjw9zk32ik4OBivvvoqFixYgJUrV2LpN19DXL0G1A+dHvtfyr84f6QWfvEsTsxuAG7V4EiBiNhkFpxSBc2vdW0yalGkJ6oRd7sCJzbwiEgxo0TPIM/GIOl+BTyiWIl7q9lbi7q93jctGgoFg149g5GZVYHDO7ej99DhktKh3mgY8co0z6Snvqk9cP593l4jDZp0MP7x+bGsJsNiuyYzq/xGUvRYL4MmMTDQUxFA2hdVPfQyakHa3QVcbRQib5ESFZtvBvX6oyIGpaW1KCgyIS+3ylTXYF5Ncn/g5s1y43yQSX8nmciT1OCWQJ5LvlzQ3vJ4MtmskMXg7VdKCIMb54KBsEwe2TIzZSpZ1F+MY4R1HoYIcxcKQySbN7neWpnOQgftYg2KNeT53SejvHi6wX9DFC6YM9xwowNQS9adL+SBf7OzuYMUskmikfqmKOS2lOETUWgiG1nKEyZH8S6ZGrI70zOlC6I/WXWvJuPacjOEv70tCm1TanIRWnD0kMUpGThBFanYVmeZHEqacrwf/RxcklerR4+VPI13AeGZ1zqZSoLMwbTvqp1mBEw2GYTvLqilepGbUqPpRXkz3bh68Ic1bDXDYRDY9vxUVt943Doy/UTpKEZkBipVXE8PD5U/SRzlMFKpOBrKKF0jCILEZUS5uRoarEJ9vbnebOazyO+Pk0XuIUbAfgsn7F+wpKbclbowUP6j3/Dhahp+1lRdAA/rCUT0DJb+RhXtYCrDyh8/wkMPPSSRt5/a9R0U4u/wi5sK/eD3oPMKlrx6KH8Tq1AhZ98A5O18DNrAe2HzK4BKyUNUjgJHJQFZDUITI3Hot/8gpPd1YDkFNGoVJl0zDD9t3Y31hZuwt/4IGuvIGOijAKNXwEPQYSSTDKvWgs9XroOHVg8NxyE+KgxJPbqTZ3RmPqL8W9OmTcNdk24g17Z84G9VkmHpL1pkpohojFBAudoMdY0AZpAOQoYN2gbBxbd6IUQdA59gBpkiA69FntC82gD/iRooVQwMSxtPG7UoIcOGaB/cV1mGqip/eHtrERvji9q6XDRWhELrG4UBo0ezm39cTU/fp7R0T4chc50j4empRv+a6sbk9IyyAQzE3gzDJpJ2Fa33UOl0OhVLud9USkc7oyT3lAOOtrNGG+obzHx9naXEYrUdFUXsZQRmS1V1zbaF69x8R25cGmRhms8y7DWzwT1MmtQLkCehLRfjPcGtnMGwE/8AJ51dDtQwQzaB9ACnZ0v5SLsIjLQbPn8/+/djyWSS7DwM8QBpY5ltq+llhcyQKGdhLnbQE2WyUL9PTl7OHgrhNmy50ZEoI633I7J6eGuRKJR2dmXI3MPOASeTX0ten3Pw6sgxbFFF0jvJx8vy7u/GGTB3qsAlPsGw4y6zt5/c8XmtnDUHHZ8V4ObJKfMqDVWrJ8/qawuEhVfKPO1CqOk6Od5VLqilNoecug1bVzn+8IatZixYJtBYtJ8dScLzE1mDQm8IFlnRj8zPnowgqEWGEcEwFtKZ6qw2VJInWPr8N7UVbeUzen6qsYe3l/FvyaNHwVZXCL50H3y97YI3lVUNWLv2GPoMH42FY8PxzDPP4NNPP0XSHQuw7f2t6Jb8Jmy1K1CWVQ+ruZ70dD3Mtr6IGv4ycvb0Ayx7YSorg6VBDZ+oCWioLoZSWQeG7QXf4IOoLjgGnwi7wTvI3xel5kLkVebDZK4B50fqoGCoqy7u0I7HgxNuhVLBoaC8Ej2iwtHQ2IQjGaewNSUVVUwFbh90o8vfvd6DhS6cgSkL6DFDhazPLeADlaBBTr4rG+0qia2EVcUgM06NajWHrUt4xA9l4WEA8sZpkDSBw/EvrRh08Iwj3XyWwWtv/A1Gpgqr16zCDeO6IzDQE556NYSKFCmksd+wYUjdtn3yK3cZxjy11CRbQvalZTU0bOXcNsaybMUdnr5ahRgAkfFhGNYDomiPWaTtTBRNVhHljU2mold/EGpb/yTc+KNCEAXagxbPZdhvyOJtHhnAZsoJ5ZADUs44T7CUx+Lx9ijPjfYFmZSWk3f0vPOckmfW72f/ZoA9DNEZMW2X8dZ6kmH7kU1Oopy8gpMwl2ZwAPUeoXLpWmd5yRx6J9no/7MlzhA33GgDvq8E/5ePxCtnnTAbGEE+wuTkFWX2OYBfQ3oe9ULjnOV0qCO6DVutAHl2vZXg1sxg2FGXwyt7FsOGqcHJ8iwnaxhZbaUA2BUJUANvgPPcV1eoGplkdgngb29ZAOXy4hGGDdKBGyMnL3nHsgzdrqmlMpNmM6yWPJNGOWW70TXhNmy1gAVrJDdcmtJbzPd12+4zdSrL9VMY3x950wQVZymFuSRFEhoXRBHHjhVj1+4c9B81GsNuuIHy1+Ojrz7A9u3bMXz4cCRN+xIHlk3GgBvyENxtNBgVnRcUEGwFyNj8EPzjb0JV5v+hydMfjQ0e6D4oEbn7f0JgtBH0QM/D0ISGqmJ4h/eWQuL2nTqML058j0ofM1k1nFmrsyKLYH0AvDz18DV6SoqSuSXliA8LBqNU4P1fv4BniKZVhi0FL+LwRzYEjiP1Jltwj5FKBEQBp9byGNgGFcRGLYsd9xgQNUWBxAAG2YdE+IYySNssIPk2DkUZIiKX1ZMlkn2fQZkjxVsGYeRQO9+ywPNYtfIH9O8XSlKYpDpoLj4AVUBvXDNpErPqs8/ee34yO2DBqtZP+gsEyehQ5khuuNFhoBLY5GPeowz7Hw04atyiKlmhbS2XLBYem8uwK0j5W9pey64HXvrvyoQN/DKyOZFh2GKmsAz7qMMI6oDEvdUiLF0qDFF2SFRFil0UxCmoQug8Rkmnjokyskc9CQwmn7tk1sMNN1zBbT7g+s5h2D8tEoUrpI3J7nO5rwOpcpi+6TxG+twOyAuv7/Mkwya+IQppMuvRJUFWsGRvjwvEAcjv1azkpS0mkDF+OPlVtItFDzDYD64ebo96tgSVfLVaKt21Tk6ZZ4WL/0VG9qsqVI2s74Zw4FLJ2uwh0mdWdHZ9KHR2D0qnBmkCawP4tXLKdFEt1ZM8lwnk83s5ZbvRNeE2bF0B6Mcanozq3m1Ut2gdzMX7Jc6unJwq7Nufi7LyeiT074+REyZIeSkd08IFd2D63x/D5i07YAyKR787V2H/t/eg5/D10HvvA6PsB4YNRHyyN/KP/AfVxSKUKgvUxjhwSg2a6irh6x0Ekc8gE58nUle8iKLDX6PPlLcwMKYPvrnvdUz64hE0qWzUl5yOHBio6oehfXpDwbH4dV+qxMPVOyYSO46mYdXBdcizFiK3uASpuWnoFyHrUFxCbh81mv6lR4IPA5WWQc4hAUoNg/IMEcFf17fJWyttiBb9ZyiRu5tH9joRff+kQGWBCPN6CyrfscBQLyCkwO7NTC1T8zQKfP+vM3u5fsOHoaaiAnt//x3pJ0olA1e3+ACg9BAiAmPQvV+fhOOpB/9Dsj7a+lq64cblxWJRoKoOL05l2IUR9sXkXHo624YiyeUc7QdD26eGF+CiQhuXqEh7zWnyRHvsuGJPeKlCJtkEppIf+znJGuzwrpCMk6RtcJHgWgy1Jpumg2+JQkY7VbVDwTIs40JI1BpXRBEcoVFyDFuUs4z2tyvE6HDVYasI/o3WXkyWGofaszKdhDgW3G9kMzuNbGZXdmZFHIqqTo3jdrSsfnY+yLv6kZXJG6mw97nn5JbdFcGDX/KGKBQ5y0faxSgGHO0jA+SXzsyYw7AfLhKFg22oovO7yFer/c0Vr0SHeq0cw9bVGKrmR777d3MZ5dzXROvrnV0ZuWqIJN+Wd0WhSm65Lqil0vBk+o7dhq2rGG7DVifjxenGkZ567YvXjAhHZc5hZGaVIy2tBIzSA/4hsaipTce1t045TTBOHXyO7/wN3Q05kgrhc889B2NwPIb9bQOOrH0VSPsaEYm/wcMoSjNFSDzg6cPi2DYRZnMhBN4KjlNCFDhSWDms1iiE9RsPo+4DpCybjqS7liIpqif2z/oWh/KOo8lqgYrkP3msDKEBfpKnVt/YaOxOS8eLq96HQeOJ5Xk/QVAzpI4sFm78GEv+Ik+Ips6TLPMXeoJpBHJSRMSTbXFELxaH1/IY+UY1NI1t49ZihihRVyXC75VasFFKZPdhERDFQBisROTa2nOMZv8maeA4H+z95UdMvPtuKJR2vrDh42/E8ZQUeAcE4Eh6DfbszUV8nD/iYk0YlhyAolMeD7883Xvb/CVVy9pUWTfcuMxYJkrKrF+STf9Xc4CbAI5ycDkzgFwU9HRwNsMO6hi5cNHsgp3JaUiYrDsCarl3ZK5gw5YDyyHjvTJgJ8Nh2AoDhsGJ2h/53t+2S+0uA2aToZx8RMjLzUyexyjz5JbNUGcD2WDuIP1t9rmecW60B0SI+Z1tzGlH7CSpmT/TE/aDh0tp75wPDdnMLpvLsJPI8+g0ziA9MA7OQ5kdYO4mfc4Zn99psOQ7yq8Jc9UbtuSCelXPYNihnmA/Jyt2uYYklqzUnySff+6oej3BsN2V4OQa24a7Nj5zsve5V3CoGjW6N3Pm0bbfA3aheTmgu8dF5JmZF4rWdzqkdjIwj2GjybsYLDP7YFfeMUt2tS5UZeIjDKt/R5Toh9y4CuE2bHUiXplm6MWx3HcqFatatWInamstiOgWj9G3TkVwRAS+evMtRMTFQevhIeWnnly//fADPFCM1+cPxtSnPsSBSZOQlJQEpdaAXhOegrXpUeQfWo+C/GNkNmoCq/SFZ9BARI5oQN6ux1GS9jM0Rn+Ya4rJsGiD2UINWzegeP9KdB+QjUOrnkXytLcRaPTDOOOI03WtzN2Ao6dycU3/3sgvK6fun1iTuxEWPwYCaUWsp1LaDWZWyR6LUNVNBa9wBpUP1CPALKDwd1LQeDXC+rOoMbJtNmypmwRp15E9TgdtKY/AF0xgPjfifLFL6tOeOtgfXz+ZjPT0Uqz7Zgkm3P0nsCQjNXDF9OiBtJQU3PP4LFSWluLQzl34cU0aKSeNhidSm+PHL043Fj6zpMapSosbblxpcJyUryYb7p9mg7uXsUuky9yQnAFnD11rd8MWqVyDXCMTWeAHYU6AAAAgAElEQVS0rFQhE4xrJPvVzrN0HnjwyzhwL8GpdZC5CZINSHqXTj2QrF0oDJGRHxJFYXSkjkDoE3Yjm3uucOOSEMHf/5pIxYjsmMWwBjXYZ0hLpiFncoZDFdlELp/LsENJOcc6rqaXButan/N2pI5AwhyG7dvRHkddBZR0nbSnv6jB0cMOmeEVknLu3xyHYe0OJViZ3rQSPB2pI3BFhqqR8eD5s8MJyftTq+0eSq9C/mHeW2Q8yCTl/Ow8a/tDBEe9tWQt5RwcsO3CA3sR6LTgbiaf33RQ+W50MtyGrU5EbR1X4KEXZlZWNhhZlnll7JRbApNGjpQMWKs+/RQNdbXwCQw8nT8jZRfighrg52fnyHvzyUQ8NPMv2LBxO/R6PY5v/AhV2csRmXwLjIk3wdM/VspnMzdA4+mHJtN85Gx/FH6Jz6G2IA/+4QwEtj80ej9Ym2zQefeAQlgJU/Fj8AyIBsOesQCNHTIAKzdtwzq+EWuObURRUynMZjPJowVrdBxYk9GosL4MVt4GpYxDEmk/Tf4riVUioNqGHhsbcGy82h5P1AaNtXJ/BQ5c74H6Rhb9SDk9H1XhyG8Cam9SIdibgXKr5bS3Ft2RPknq/+m8PiDvAImJgQiqasCRHRvRZ+Q4KY9vUCBEmwXrli7DXQ//HXG9eiHz6DGs/OSTHHOT9WkGDM8LXSMkxw03LgWHgevzJxh2nRIc9UAc7VoJzAjneVoFV9S9ItvpnnK5x8xvAlWd7uPfAl4Xhax5jHIf+XGgk6zdyAYwnGwA88i7vKGljKShHKZhju1Xy46DQ93xjs6uRzMc4Yhuw5YbsvG2KPG9zpvLKI+S5dGnkLdBNFDj1gyGHXQ5yL/PBrmnzgBu8uW8Z0tw9Dm3YcsBSpA+h1EuZO1tSQ48ycTan3zu7pgayfYe63B0hVA1B8H9/81l2FTSx6mhSo43J0fyfknm+P72Of7ywoVQ0w6HQ1TCbdi6SuE2bHUiXl5dVcWy7A8vTTN+EdujR2D/EfZ9Yeq27agqykZsjC/UGrvHta2uCEHaInAO7y2KiCAt/nojh1mzZuHjjz9Gzxsfxqa3N0JheQNa23eoOa4BXQ8p1UqUVzSBVUyDqLoR1Sf/jYb6IDTU5sPDrz+qC9NgDCBTHMPBL6wJFTmpOPDdXCRc+3cEJVwrObIG+vlg/IhBWLJpA35KXw9bkAJMsEba4Zy9xGqymmGxWWUZtnxPWFGeJSD6LiV4XonUZBUSR7A48YkFCZWyKU7OQbU3h2MzDBhyJ0eeoQhOCRSdFNF9GIuGGhFHF1swYLN9jUer/jCp+2Pz+iDY74xnu7e3Dkby3Kw1uVAaI6R3EB7hDau1BtvX/YKREycgtmcP9Bs+PPLA1m1jnl5a87e2qmK64caVAirvPYthb1CBW83Yw0nkQj65ngsQwRTLJ7wSe7X1fo5NmcywNRR3BZU7AVjOOjds0bCNUWSx/Av57Ntyvq4Thkh2Y9fBSVjl5QVz+1SGnUWJjTu7Jm50LbwmWj+fxyhiSRv6l8xLel4u8u+zQcZP6v3ZUV41rYCkSPp0VxirLxdE8Bvk8XjbIYDrjg4wbD3JsEkKe9lXCrpMqBoNLZ3HKB+AfCONLwvuM9IXxl3OcPjZDNubA9fmtVk74kayzjN+IAoXCC640fXhNmx1IliWZV6cZlwUFB5+z8R77pZ4tIpzc7F30y+4eWIiUg8WSJxafGM5zIV7Lgiho7jt2hD8+uLPkmHrgQcewMiHvsDmd29Dj8FH4R/VDYzqNjBcGLzCBTRUbkJ9qQUFx7QIS6hDVbEA0aMQKp0XubeSzFw1UKoEmG0WGIN7QKh8EsfX34z4sc+CU6rxw+Ff8Gba/2CjQRpNPBi94oJzwx4+MdCp5XnGetQLqJpXi7pnPGEIYeB5LYecryxI/LgWTCuWH7WeLA4+YEDf2zlsXy4gJomB3hs4uZ08w98a4V9qw/Bi6+myF5OkuDEEE0YEXlAW9d6ylBwAq1BL74CS5l8zKg6rVu9GaHSUFJ44ZvIkmKqqHnhp2tFK8i7/4TZuuXG1gJ4IzmXY6WThS8Nh5Ib3eVGjUHt7BzDgs+QvwCXlpzbBAAyC/Bsed56l88GDX04WtAvhxNODgTiEDGKNzvLZulAYogtqiJcF5MEGhgPXkB83dnZd3Oh62AfhhQHgxlFeQ3lXMDPnMey3C0Xh9w6t2FmQSxJ9GRE7B0gmn3s7uyJXCt4ECufYFX1lzXWsfE4nl6C4wsZndLFQtYWidek8RjGe9PN7ZV4y9kl7GOP7HVmvs3GlzcEEak9wlNPv886uiBvtD7dhqxPx0jTDv/2Cgp687cG/QaXRoLa6Gpu+X4oJN3SHwVMDgRfRaKqAuWA3WSlceLjb2GhFSmo++gbb8OmH/0HPnj0xZMgQXPPoD9j56d9RWbQB8cknwSqjyKwUDI0Hi8SBKfDyMaMowwadXkB9XSoiku9BURaN/bOA5xmwChXC+t2C6vS9CAz7Hmm/AL1uekkilQ/a74tCvencipB6CnVWsHolsqxFyCrNRWyAPIcH3xwb6hpF1FczqK0kRe23QV/XuoOEtMl69L1HgbQvrAjYYgGTrMOpAyJG3MvhYIESvQ+e4YP8jaSVA2MwPqgBv28+iQEDwuGpV59boCjAXLQHjTUMbDYBarUCE8cn4tefV8Hg4wPy7nDTn+7B9x/+b+5L0zIp98Azraq4G25cgbDLqivIxM88Kfca0oOoS2m7GrbIyJfmwkQVS08HXxeFw62/I3uz3JwixE7hr3EVb4pC7lxGuZOxk8K3AKYf+f7OAsGPviEKae1WuQ4EJQLm7AvYKwqO0Ci3YcsNl0EVO0m7/itp1ymg9ETOQVVrP5jFsH0dIUwdiicZ1ksBbnxH38dVOBTv3IYtB66xG7Quclx+cdiJQ9oXLMOy8tVqLx+6WqgaD+EJMh7cSH4MkJOfvPRXSD9dKUdJs61wTZH48sHxjt2GrasQbsNWJ4B6ar10l2GBT2Dg03fMeEgih68zmbBz9VJcPyYSGo0Cu3bnIO14CXx8auGnC4dKrYDVyqOpyQqTqQklJXUoLjFBJFPNhOnTMT00Bnf89a9Y/t0aREZGYvTfv0bmjmXYsep1+IdmwT88C2qy5bQ2AZYGFipDb5w6eAJ+ERvBKe5HTQlVVtXB0qiAJtQPPuE9kb21ERG9EqHJ/wKlJydjZPdB+Gz6y1i4/mMUN1ZAyXLw0RoR5xOBW5Oux9Or3sReNgN3L/0HVv55MYKMl+afFsmocux2PbipGig0AA3KCE9kcGqyBo07G6GVSRzPk6nZZOCgsIkwhjKwkmWbycZAn6yE3ywTmCk6KFRkG3GWxhklw3oqKgA/fPYYTKX5WPnxJzieXoqAAD2CAj1hNGqh1SjJM+dgtfDIOFyIoiITNm/JxMgRMRh/fRz2rv8eyePvhI+/P6b89QF8/98Pn35lupft6aWm592eW250BiiXEN30tGeZIphUV07ebdJ/7Yu3gJw5AB2gZJELk97+d/IxszX3coQh3iM3P3k+HcQ50iGg6ohODFvoxYBxQpwvdpkwRLKApyT4hs6ux4VgbiVt7WFK5NzZNXGj6+F1UTg6j1G87SCTl4PuKnBzyeeLHVkvCrLBvhXSGceVBcauSDrXHY5oR1+AkvDKnt5JxnYPzZsNUP6VsPYutx3QpULVyHhQOY9R/pP8+InMS4wcWEoNOr0DqyVhjt2zNLqj79MKXPcow/ouFoWKzq6IG+0Lt2GrE/DiNOO/vP39n71j5gx4GAywNdWj+PB6DBvoL3kGbfg1HZlZ9r6WMHAkCiorYWlqAssqoPP0Q35pFsqK7ONt32FDkTggSfp58Su34e67p+Knn9bBy8sLEQNuxsmtn8Es9EFBQShUWk9ojAEIHJiM7qGJKD62GYdX3gt2y/0wVfnAZi4m99HCoPeB1VwPBVdGZrNABEWbcSJlDQLiBqF/VE988+AbF/1eK2a+i8eW/Bs/FPyOP3/5T/zyyEeXfAbUGGV8WIOqPBGVheQXR2yoimARMoRDfoQS8enODxZzI1Q4casHPBNZmMmUW5XCI/SwiMH3K3Bko4B8Rove9ytxeAWPPmvtczL5RrjXywMffvEo/Hw9SUrE4Ouuxc71G1BSUgsojYA+AMUl9eRd2KBQqBAY0xtFRdtxLK0YtXVmjLu2G4YPDkZh2kbotDdCo/fCrQ/+Dd/997/Pvjgtj1rkXpDfGtxwo32QDPbzuQz7UjurYLm0QeE7YPFLNyJk0baF/CiLjJhsYO6fzbDv0M2fq/cygKOqgLJOPQnEJvCbXb1HZ8EM/lsNODp4t3RK7wUnipA8hC4ThsiAu9JCIJpBZh+J+6tTFKrc6PowQ/i32m6ED5KTnwHmk3FxCRWT6Mh6XUkk0ech4nG7YX97Z1fkSgBnD7eTDRF8bvvX4ooLUWtGlwtVWwT+89ngZjB2KgWnIOukaXMY9uNFotChnsMiecdXWFhyM5RkPTSFfF56o+pGl4TbsHUZIXFq3WV41icg4Lk7Z86AXq+FtSId1soTCPZjJaPJL78cR1l5ncTxpPXQY8i46+h1p8tIP3gQqdu3w8tLC4uNw+ibbjr9t/69I/HUI8Mwdeod+OGHVdDpPBDYfTTEujcQEmmATUiA0sMHfNUGFJcoICrHodekz3Dw+/sQ1TcaRZm1aKzjoDH4QaHSwWbhyeCnIj8DTTXORf+0KjU+vO/fmJTym9NjIH29gMIsEQpGROzLJmiaRJzsr4HPFB1Se6qcGrZqvDgUzfFE8mgWBeki/CMA71AOEYkMslJFJIxiobxOhaPreHR7xwTvSh40gPJOrQovf/YIEruFnC5ryLhxSE89CEtDDcqKCjFiwnhEJySc/js1cKXt3w9zUxPy8qrww8rDuPGGBIQEasEXbYHFOw5q71jc/uCDzPcf/u/5l6d7Mc8sNb3g9txy4/KCiSfL1d3zGOU/yCLn/fY4mSb9+HoXshd3lAcK+SIbGZmGLQIVWbQvf5hhR7wrClVy70EWeWNYcK6EE6e+IwrFLuTvVPyfKBSStkHV+FxUuzwHaa0xGHYG6Im7AdwEFy6h36ut7ZeeTBvlZGTsoVFuw5YbrQJVSiT9eT7ke2nQsNx3yKcrfcIlPMKwQTpwY+Tmp+qqjJ3nqdUgZcSRMvRy8nL2PveHN2yRudHbA5xsigEKs318bDeQ8VlJxufbXbiEqvA2Os3VMsIhkzO0q4WqUTL4eQz7OGnltH3LsiWR9c67HRmiPJVhuUjXFIlPoO1UFtQD8NLhQmfB8Y7dhq2rDG7D1mWCnSje8JyPv/+/brv3Fqga0tFQVmyPwSPIzavCb7+fhKePPxSKBnTvFgCrIuAco1ZFcTF+/fZbDBkciaqqBnhH9pW4uc7G9WN64djBNEybdheWL/8WfSfPw9b/pqOqaA2i+5eDUfaQyOTpkGap342iHA16TvoAh1c+iMiePDhOgbqyHATEDyGrjRiIYpNUrmCrlPU9GfK/m/uPdZqPs4kQf7Ug8EkNjndXQ/dnDapTeDTVieD6KYEVF7/OqmRQ5cOhKEaFRLINPfaGGb2+q8OBJ7zQ51YOR7YICFxch/wpGjSqWER9XCeRxtOR8g6OwU2zRmHEkG7n1oXjMGjsGGTu3wSjQYOfl3yD6Y89Ci8/+9ioUCgQFEmGZ0u59J44jQErVh7C6JGxiI31g7XiOKyVGeA8AjB5+kSsWvLTgpfuyuXIu1vgNm65cTnhWOC/Oxvcn+Yy7D+oak5ry5rNsNeTjdBt/8/eeYBHUe1t/J3ZXrPpvfeE3nsvgnSBUOxXEUWuhWI37hUslKt+inK9dkWJIAJSBOlVeocACSG997Z9vjmzISHXwoZsAuj5PU+yuzNnzjlzZnZ2zjv/0oRNWiyQuhXW1WKI3oHjQd3j+Bv3Pfw+THFEiOEniNP4m7z/8m+lTejWHROD4zqIO+JNC1vcHeSGqLY/jZXfsKCdgiWwtmtupqh5jFjP/wa+6lhpZhw/qZC1Rtwjyl8TYqUxFyLiet3FwU1GzGXYe5Zwth9aoj9KiCbDwWs0f2N0ZTFnbtfcNvnv3Lv8d+kpR8ry382JLD/5b82McLcb8xlWxR8ncvx9m7DZZfJgxJn9UNszLjskQEAQtKydF3G26ua0yf/OPwl73ihHuONc1fjxOTifEa/gz3RHwym0qItyEEAmgw5ZlPKYjLB2JYJ9c9qcx0hm8PfB/3Gw+MBnGNabZAJvTpuU2wsqbLUCdTG1FvKvL/j7KHFw809CBkSpVASie+QXVKKSv1wPGDcRx/bsxpDB0UL8LFc///o6SGD5nT98h+FDI+Dro8XXK46i812xv2mrtLAQkepMyKJZ3Dt9Gr5Z8S16P/IfHPj8SdTsWovY3mlgJTFgJO0gUejgH3YVeSkL4RY6ADkpe+EVVIO8C3sFYUvjfzcqi76E2oXobwanj4vmAH8/P0cO3RMKaPmfN/dgMfKvAhUXrDjbTgHvPLMgShFqFSwuxspQNFgOdTiLvMuc8Gi8pohDepwMXhtrkRKghJsvA0WNDRFvN7jGk1/CyWIGCS91gIc0B3kZmfAJCmzUl9DYWBzYtB5DBkXBz8/FPtbTHoRSY89Y7e3vj/KsUn78Y3D8XCUGTpiIfZs248zZXPj7u0AkYmE2XxGOp5+XnCnKFb/CH3Mxf8xfouIWpbWxZ8wS7eZ/5A/w75fVwLre0fTVCQwrDeYnSyKI3kATgsvyU5VdN9fbG0OCnPI3pb/wb+9qwmZtSIBl/kbvOw62lfxM5hCJRUFWkICm/EwoUAzRQH58HuUXNTWbooEf06+buM1tAMlmKPo/NCXP+3XY7iA3RLZJLlHcRudMdm3r+aF1UNiCi8x+Pq9rfrsUEhvuWYbt0Px6UNHS7nrOgpyzcxn2KRaifXDcSuOdJxl2i6O/B02hadkQuZ+c0SZj/845JGzx+M4F+vGvu5zR9p0E+c2bAwxjIHqXP0YxN96igZZ4oME2zQ1xR3NFLYKZvw+S2H//HDlNJQp7vLj/Nrfd1sQK2/Mi+0MdlSPlW9JFmWnaMd7VXFGLYIX1J/6+jmR8dOTeVSSxP7z9sLntUm4fqLDVwuhZll041eUt/u0zNit3/OyZ9CPgmN6BkRFtvD39IWJYdIj3QXh8PLb/sBod4zUICXbD6TM5CGxnf5hhMdUi78wvGDYwCCIRI4gnNbUWuHp6NmrLarXi/P6f0bdXkCC0MBtTMGXKZHz77Ur0efQ/SN7WGXuS3kJ0twvwCk0GMQYjV3ffUMArMAVZl1TITmbgrUpCSXp/hPWYhDOrF6PdQOKOqHD62PhmmXFyjQXqDiKk7LSh3XgRspJtiHlIAoaVIPkMh7SkWihrORSMUyCiLws/NT8eRgh9L8ri0D5RjrST/LT1q1r4RTLI4LcJLmmwbK/k/yZLWEx+qT3GD/QTxu7k4a1w974PElmDcYZSreYnbRJhvb+fixBEPufMVoR2GQkRv++unh5IPVWNgQMihPIZKZfx8PPPIS05GcV5+eA4G0ozMvnPF8jx3ccPbFcwzLMLprhI+HPgOWK65fQBpFBuQF0WvF5KiGrnM5Kd/MRjPwfrSX5ZCv++SCR4GEBlBlz5H4N4/pvVJ9juHhD45zX/FgtsLTxBty6FPfNPU5CQNNj8zfz9RMnhx4DcHNfMhYgo1o5a8/wG/kb/qzvJDfEa/OSggJwHsMd3aioXm5dtsvUgT2H5G9Ybmw7XwQmT4+bDn6DH+YlzFhwMiFyXqY0KW85hhJOy8W2CPenAHcESznaAiPf8dc7RQNCBCrCvQYjr7Dz4yXEYP6Hu7mh5xknfOX4mvFfbhOQidd+5Xc5o+3aBH/ex/HW97HdWifnfeU8GXCz/m0eu+TcTxNvMHyunumvVJWlxNLQAEUydcq6Q7MD8OJH7n44ObkIsEO8oYYv/jc7m9/FNOG6F1SIuysQaWWYX2BzFKUI3eQg6j5EcdTTWGOzuiFTY+gtBha0WRjrVZSJ/VU6HyRL0wurKXCJ0SadqL3bu2xcRbdsIZWxWK/ZtWIfoQCt8vN2xb38qcnLK0d/FBZzVDHPur/DzanjATrIjEvc5saRxpufMs4fQJkohiFqE++4OhEKWifHjRmNl0mrEDp2JkG7jcWnXF0j9aQfEogyIxWawEh1EihhoffsisLsS5ze/hprScQjoeD8s7DDUlK+HVOH8U4VkMmy/qAyVWhEiyyw4JXdFzEgxkn+2gqnhED1KjCtyBYwyBnHR/P5ttEC2xYjS0QpEDxUJsb/K8jl4hgDqd5QozeWg+LYWyhq7hkQCxU+WsZiR2AkjensLy0jssg7xOlw9vQ+RXRvmPYIFnVwOs8UKmVQsjKGvO2DK2Q95YF+o+WNRXFyNnbtTMLB/BOTyahzaugm9R45BdPv2Qh1Xky8SoUv50sryOcRK66V7dO5qGUZLJmvJTbJTLtoUyk1ClOmRjPD3W2MdR3LG34C9/A3FyeZX88cs4mzb6mJE9W1GNSo4+CTzj+Bvsqs42Fo8u1gLQtwRmyxs3UluiBJ7XA9Hf7QM/PfiF2e0a090IOav9YyDWTmZ0WSSt5yzNTeuCOVvjBG252R2ocBBKw3mqfkM+xV/TT3trD6wEE2B41n2Sokg5Yx2SVzHeYx4E79P0x0pz5e7ZxDDznZ2BuFbCT/oH/3JOjh+WH4P7hP+PElrRgW/QQsRCQ6scbQDRlg3OK91bj0/Ho4KW3ekq1oRrEs9IPoHHBcyne6izE/PyEOGG2RYboCD1ZlzJPKwyFFhq88chvUngqAT26fcQqiw1cK8sKL0++s/S6Zop2t0rhEhMdHCZ7PJhLN7NyMm0ASlUiOIWnklDORKJRRKOQzZB2AzNMQ/rqk14/z5PEEMIxZa18QtU1UB3KR5ELGNrS+HdnXDsWMnMXrUCHy3chUCAgIQN+xxHF+dj8AOT8LFvyPkanfYbFbUluWB/NZ7P70Vp9ctwsEVnyK4nRpXTqmgds9ATVkulLqmuOXfGImZg1uxRXA19OgmQn4aB/WvRoTsNuCIzQWhfVlBsMpPY2DJ4yDnb0UCurCoLueQeY6D5mcDpDEiFPN3SbqDRnRItYcrSYE9+2HXfkp0jmp8r0fELW91KQxl2ZDrGtw9LWYzzp3LQ1ysN+Ry+7jajBUwZO2HXBECkViMCoMCu3anoH+/CGg0JpzZvQFxfUZAIpUiMCIcLm5u8Qum2Eg2lR8X/lBGfPO/cOqAUSi3H5wF1hdaoyH+qjdLBNExOEWLu2le5W8AM29h+82iFtY1CoiWoYljyN1BbohNc4nCdme4uVzDCtt6/hx1SNgiMfHUEJEHH3eMaEi5/XiPs2XNZyRvw/GMzPy9v+hDlmH7OiPJCIE/lx21GCMi+c/OTDTCgCEWPQ4JWzyeHe2xf7Y6q/2/MJkVsDn9t72J1+ejzozvZeGvz2KIEh0sfke6qn3G2QxzGXYeC5HDv9nOdlFuohviycWcLd0Z7drbthL35IUOFmdF9gdh7zqrfcqthQpbrciCBG1bsUT03sCxYwVBymYoQ3nqQUQFWMFxEuzZewX5JRwmP/4Yvnn3PVhLL8BoKUZ1tUnIlJiWVoKMrDIER8dALC1ETUUlZHI5bKYqWPKOQPQ/HsUGgwVbtibjoYfHwKYJwD3jR2LZR5+hS5cukGu8kH34YYjaaFFq8ufbt0CuVECiUKMktwgB7R5AeJ9pOPTNPHgHXkFlYQ3Ksi44Xdi6hoU/EyVKoHyDGZ1/rsGZ3kp0mmy3LNG4M7CYOJSPkqD2pAnJKywInSBGcFsG3H8sCNveeE5ComXPD/bEf776J5jqPGxZuxrjxraFRi2rLyNiGdgKj8Om0ICVaQVRi4iMtawvVq46iQA/DUJC3ODupoRKxf8UWmqEQP4THvkHfvz0M0HcIm6JEf5WlF36BW7hPSFSuGHAmDFY9+WXH+knuZ5KXFV6R8TpoFCaAz9J+eDfnK1VMk0RVzh+Ajeff/tOa7T3O/y0FNZ3F9+ixp0BCYbLj+E22J+oOsrlJZztVEv1yZk8y7Ah/MSlp6PlneXmcg0LsFNk94J3yCKBtbtCUGGL0iyssC7hJ2gP829DHNyk9xyIHoLjWRX/kDkM25ZvO97R8nVClNMwwvqzDCITHEz+wdrdEamw9edUc7COX87Zym9c1HH467OuKS7Dzr4+vwucmAuQB1OOhlu4I13ViPXVPEaykwEczVLqNBflRxhW4wbRaMe3cE68vWss4mxn+X2/wu97mEOt248xFbb+IlBhq5VYME3XXSQWres1bKhreIQXDNm/wlqVC4WYE1wLd+1JRUWtBJOfmAGVRgOpTIZvPt0sWAkpVGq4+/ggqG1vDL2vPQw1Nfj6nXdRkJMNnbsWxuwD4KyNEyvl5Vdi567L8AgMR4fevQVXu5cficWDk4fihdc/wLRpz+H0egapx95Bh6ElECu6gxF34O84VFB52FBbuhl5aWvQZthknN3yFfzC8mAo/BRVhcH8+jChPmeirrYh+5AVgRMkOJOhQq2YRW4Kh4pCDrZvDFCNl0ESzIJ5Sok+HVkhvlbWKjO6ZZrq6yCPHUkqjP8EK/DKM90RF+3Hf/JDZmoq1q49IQhRAQENlrHkgSGxiFMEDUBZUSlqq6sR2a4t+o0ehcunTiPt4kUcO5WF6soKQfiSSGWCJd3EGY9izSefYvuOyxjQPxxKiRGGjN0QqbwRFhaCXkMHex/Yum37ggTtmJeTKu6ImDQUys3Af+e2V8I2pzXbXMSZ353HiOP5ydEjrdkuz5EKWO9zloXDrcQGfM82Qdi6k9wQRU1ziXKym4tgPWOcz0h+5t86muZ8JJkIfMLZKp3ZD8rfi6WcrXYuI5nP2l2NHYL/krw9m2HXNTfzm6hp1hlm/jq6uTnt/S8k6DT/ndvFvx3mSHn+t2N8AsM+nhL3kZ0AACAASURBVMTZTDcu/bekwgrrKP6cOubsikX2gOyyGxasw2594zyucxd/wsFN7lhXNX7snuZH/DgcTBbjLBdlN7tbtMOBma1Oird3PYzd5fRpx8qiO3kg9m/OdtXZ/aC0Pq0qbN391FOyQKPRtnz5cqeZIN/u6BNYqUSseVoiEul79YqUtwu3wJB1oH59ebkBW7ddhG94PEaMHSNYYF08eQqlRUXQuXvgvmefEdzcrmGsrcXqjz+GRi1BxuVLCHarECy2hHVGC7Kzy5F8MR8ZmWWCODZkwgRBhMq4fBmV6cew6YOueHHZi/j114NYsmQp8s7GYd/q5xDT/Sd4BfP3GiyJv0kyNpYhKMoEm+04uD5SlBQNQsr+3agt6gOJpg2kLhPh02Yi5Bp3p4wTw8+03JZWonChCyJeVxDbUGRd5GDaYEKfg9VIN1ghXqxGFb8vZ/9tROBOA/pkmMDUTTGJzdYs/uokHx+CzTNjsG//JSSfOIGYjh3Rf9QopJ47jw2bzsHfX4fYGG8EBuggk4nBmWtgyD6IjHQWbm5KbE36HlNmP4m2PboLfwSrxYI1n3zCj2EKTh04IAiFRNzasW4d1q4/i6GDo+HiIoe1Ok/4ax8ugahPZMj+Ayn735yqe8WUX7EsccdfJ57DjUhISBCtWrXKRrNB/uXZXAnrRGe6lDjKUtgemwPWwt+IzWylJnfxk7Fxzn56fauwwbqWhWg5HJ5g3DluiEyTsiE6183lOsiNuqPClsIVojH864oW6Aflb8QSzrxqPiPZzb/t7+AmHvzdFnFhvOmHBCTb3ly7mOwQ/E3Bnha6jpK4Og4JWzyugfayThW1/yKc52CdtJSznW+Jypt4fb7qzDhw17DCtk4EkaPC1h3rqkbGbj4j/tjxmI9Oc1FuyjHOfgc4trQZjf0eNtjW8/c4DglbPAx/jEmigEVO7gblFtCqwlaoW9B6/qIWNEu/dPayxDnbWrPtWwX/y2Btb2Ms/Jes5sqVfDmZA6rVMpBrRmWVEafPFmDQPRPrA5BfPnMWv3y/EjIpi879+zUStYil1rrPP0d8pApSiQt27TmKwnQ1bFYbqmvMgssisSiqqaoSxKzO/fsLQc9JPK4Tu7Zi6OBISCQizJvijwUffYGB/Q/h08+/woB/HsCFbR8jdX0SdB65UOlEsJpZGA1BEGmGIaDDdEQGxqO6OAupB5KQc3I1NK6voibnTUh1Q+Hd7kVoPG8m2UpjvHIsUM0uRVq4TAgY71FgQd90u3gVesyAnHut8LBwiC1orBGd4P8ekTKI6a7EY8M9IJeJMGhABHbs2YWwuDjIFAr0GDIYO9euRVZWGQqLjTAbL0GrkQvHQixmUVRcgw7tfaHTKbH+808w+sF/QOduF+2I1VzXAQORl56Ggz9vENxI23TrhmGTJuHc0VCs/2kdOrT1gdZFLsTvIschO7uEbFrLsYwZu/C3yIjI8jv/ROLb4z3jui2dldiNTOwcTcFNubMg5qGvL4H1TZJu/lZ0oK7dx/lJ3FH+9T00MyD8n8BfbLjFR2F79a8UbPjfnK1sHiPZwv8ej3GgeMpiznaixTvlBOYwbDx/g9rO0fLOdnO5hhXWTXw/yPni0D0WY3eFoMIWpdnYYH2KtcchdMhKgz/7Hp7LsJ+R7Io3095coAeakG2PaaHvHL/fP7H27G4OWWvWuSNSYasBYjG6uAjWxSRGU0s08CTD+ighctQ1jlgKt0jSpSxgV7CQUBNax/px57qqcfy9C2MXnh3KGsrTe67dpfnTm2lvHsN68O0NdXwLbkNLWMEfB/Z2AchEzM2R8nW/wVTY+gvQqsIWw9m+BcN+zgJbZuuXfm0GM3d54rNFrdmH1iYpyWblX/79QgL7qS0LE3Kyy/vx3yBPflmcTC4PvWfGo/ALCRHKZqakYN/61YJ7287daYK10TWIWLVj1Tfo1k4DLy81KioMsFptiO0xCAqVCkq1Gq6enjjw8xYUpF9AeYUZHfv0ttebehmd2roIotaly4UkPlRJx1DJyQFB0kEz/jEJU+99AjNnzuW7NQfVJVkw11ZCqnKFUufNH66GU0TlHoB2o+eAu/tp5J7fg5R9X8OWvhmM5TgkPX+CXOvX7PFSVdnQ5lTt767zy2lsGEJmDf/m/za1dcVTo72QfTV//+49l2OMRot7h/b+6NnVF1fPn0FUxy6CEHVo2y/QaURQuAWh/5jRKMnPR3VlFSwmEzLWr4O/n06w2iLWV/vXrkDPUQlw87ZnUwyOioRcpeHr9MGJnZsFt8ToDu0R36ULPH198cN/P0F1RTl/EWUO8sXz+Yv1zvKainVv/Wir/DtMV2a/8kbwE4mL3+d/HIhfvdFm49bc6j793eAn00/yk2kSf4qIFS0RXJ2/lnGrTPyN0ruc7fLtcAewiDN/+hTDbpEJVgcMuTFxcDJ3Q8iN1lZ+l+eSeA1OqvN2g7gs3VDY4icXd4y1VhNdopydiamepZytZD4j2ce/HeDgJsNI7BkiOLZEfyh/H0gsvPmM+BP+eviYg5swLEQfDWLYzjcj3nP8d65pgSla5jtHEnrw3zkiwHdybAtmzMMMK28pEecO4iL/93UtrMub65J6I5R2qxiHf6OZFnBRIxAXVP478jPfwmTH+nHnuqot5mxF/PfiNdgfADrKW/MYdh3ZtuktiiaiCfefthY6xuRaxh/jTfzRu9fBTTo9zbCR5N62JfpDaT1aVdh6/7V5Xz6pX9KWATPHx9P9gbzC4pGz9Euf/Ug/b8Vf3W3pzSTB9Ppz8rdgujZeIpIeGPPAA/WiVuq5s7hybDvGjYnHlStFCIyIENwSCVZjJbJP/oz+PTwFiyACEahCYmLQsU+f+jbyMjORdfkcggJd4ObvIwheBCVXCKWrEmfO5mL/gStZFrN1pEgkerVr1xg8+ER3vPb2DxgxfA2WfbQcEXy7N4JhRfBrM1D4K8s6jyMrJkOlmwiJ9yKoPeIhUzv6YODmIYGrZokY9Jwehh8ejEZGZgmy0/IqLBbbwIO/Xt1UW2sO6NkjBLDYM0oSy7fIdu1hKklFYV4ayouLBWuua2ReSRVcOHv1DBUsuQb0CUDe5R1Qq4dBqnLn95nly8ejpDgDY0fH48TJ3bBaTIjr0hVe/v5CUPmkZR+6GAyGj1/6tqxFLtS3I8Tt0CO26xMisXyhTqvWlFVU8t9j7oll+rm7b3Xf/m7wk+nD/MtEkp5azN9A8leKUfzB6EUyrzWjWitfB3n6v84C6zfvcLYMJ3XXaZCMYPzL9DkM+woL9jESP4X/HHmT1aVx4NbzN9Sf/IUFLYFSWNe7QUSeItwgFsad4YbYVJconqstHBCfuEYNcLCsjIWIZNP9osV6Q/nbYITtFRlEROjX3bCwnXZdIPon7M8KHSaBvxkMsosVDsH/lpzhJ8tpTWmjaQhxdRwUtqB1B0byr3+Hh3BEsKzlx7+Qvx/I5n/jLnBgTvI/79v5a+Cl1upEE7Mhlqfbc0G1UF8Y4kHk6Ll7R7uqVcD6kRYiInTH3bCwHQ8G7Fu4CRflpria8udDVQmwo6ltOIqNP8Ys4KiwBYn9mrmgpfpDaR1aPXh8WknmS2FuQf283F27DuzR2XPdL7u/npW4KGGGfvHjHyfOy2rt/rQ2+gRWLRW7fD9g9GhtcHQUiWCO8ozjkFddRK/u9iQdpWW18A2OEt6TAPPGvGPw82x4yFFVZRREmCGTG2c3Prx9G4YOicSWrRfRb+wQ+0K+fpWoHMkXCoiolW61YfDLSRWpb07Xhbi4ukEqFeOxhE54741lmHh3D0x+4FnMmTMHMpljoVd0AXHodt8POPrtAwiMmohcgxihQw5C5eZowpGmQWJpkRyuO+N80COsGuP78FMzEVOX8ZAJIcHaF05zHXDyVPZ2mUwc3KlTkBAknmEliGjTFj99cRjjx7bFge2/ICgysj4Ifvuevfh1nyAq0gseHnZB0MdTBnPOPrDeHSHWBsE3KAiXDifz7bHo0jmAPw4pKEm1wC2sG7wDAjB00kTRphUrvtBPcu3yd8iIOOvVxdFecd0+dnPR9hszpC9+2r6P/FCt+FA///P3E5udWIVyk7zD2fL5l/fJH5l4BAPxgKgNfzMbS1zB+Rs6X8Zulq7mj5eUEWKJw8S/r+DfF/MXjXS+TAoD6xn++3ZsGWcrvbV75BhLORv5zj1H/p5i2HB+Yted3xeSESOU37eAOoFPXlfcQG6q+GVZ/LikM/xNvgnWQ7fj07pFnOU1/uU1Z9dbF6xc6ex6+YkrCQzt3OwiDlDnznDjJzOtBElygNvIfaXOnbTVj0tzWMTZjuAO6/MfwZ8Pjrj9OoX3OFshHHc9ummSOMEjwael23EU/lqp51/0t7ofzoA/XxyNk3bHsJgzO5yttqXh+0J8KW6ZPwV/rj7PvzzfGm3VxUF1OGtpc7idzlsScxC30e8H/3tWgNuoP39VWl3Y2vjee8aZiYv+cTo55VivTm0lLzz+AJI2bh919lJq79mvLX5q2b+e++avbL0lEbm8G9OxQ1zHvn1gM5bDmHsUYv5Vp2t4aE5cDOVKBUzFF2AuSobdKwYoLa3BufN5uJBcAFYsQXBUVP02Rbl58FTXwMXFW4jx5BcSLCy3GctQWV6JvfuuGCxm62giapFYSAumuARoXe33PVXl5fB3F+PHx9vjs3Wfo0fXr6Ff8DZGjx7tUPZDF79oDHhqF7LPbIfEVAuFi68TR8wOmXkTv5kFchb3PzsSWx+5C8v1ekHkI6jVcmJP76sfxIoTd9hSF0zX3n3kaMbh4CBXpdyvGCK1D3yDAmE22yCVihDmL0JWaqpgGUcIDA/jx1SO1WtOITTUDW3jfeHrqwXD37eRY2Q1lEIml8JibggpROJzwZKL2qs7IPPtgthOnZBzNd31xL5938zsyvZffqT1g2q3BvVWWiLRm727tFONHdIPW/cdQnFZeZ4RVU/9lb+/dxp1E4/TdX9/G/iJXSr/Qv6+vdV9oVAoFAqFQqFQKC1LqwtbhOX6+Wdm65cs37Bj/+z5M+7FjClj8evJc64/bt315azExaMf1etn/jcxseRW9K0lWTjdZZzOzf3hIfdMgKX0MkxFFwDO+ptyJFvfmf27UJmhFoSlykojcnPLUVljFeJutesZgYKcHCGI+TVyLp9Gm3j7gzNWxAoB0wlWQxnOX8iH2Wz9hlgzkWWJk6BiWUandrHHTawsLxPiSrnqFBjSUYOIIBU2r30PH320DHr96+jWrdsN900kkSOo093NH6T/gSgkxBZZL2XRdkIIXgwXISBaJQh/fsHBqK62Z4SUy8XEkkoDT2GnSl5eUXHuzWm6z/l9n+UbXSYIW1K5XMgUScY0OsoTF1LP1gtbrEgkiIFSmRxKjQZbth+GiLEI4pZWKweDDOTm18JF81vXcZupErUZuyFxj0a/USORmZrak7NbjvzlTFof0S/284rr9pmrVjN86phhiA0PQWV1DXYfPgGOw6v/fe2v972lUCgUCoVCoVAoFMrtyy0RtghWi+ntrLyCRy6lZSiiw4LRs2MbRIUEMl+v3TwpNSO725P6Rfd+kDh/363qn7PRT2B1MqXug8FjhjFc0RGYan87/yeWWmlpJbiQnI/wMA8hJpbW3QcRbToiupc//MNCIRKJ8Pnbi+AbHFS/Hcl66KWuIFnphKDy5DMJjO4TFATOWImU1CKS3vabhoaUOpFcJJfXiV/VFRUICrRbb1VU1CI8IgbTZg7BmXNXMfO+QQhqMwwvvvQyOnVyNHSBcyApet4Qi1Aeq8XSueT80PJjkoOSIns8w9DYGFw9tb++vEIhFZkMtSQwvzC4VuDrK2nFs/obyoVIhhWlpTAZjaitNfNlJfB3N8BsNEAis3snad3ccO7IUTzy4gvoM+IuZKeloTAnB2nJF1GQmYY28b6CxdzZc7mIjvISgvHXw9lgLroAtioXw8YNR9LHX7+0MEG36qWksoutNV4tzazXFo1QMOznneKjvRPuHgKlwj5u+4+dhslkTitkqr68xV2kUCgUCoVCoVAoFMrfjFsmbH34+ovZs/VLf/z11LlpRNgiuLu6YPYDk/Hz7oPBW/cd3v6kfumcD/Xzlv0VXJskCpdErVbpX5N7BpklrBAEnuyW0WBBeYUBhYVVyMkth1olQ/9+EYKVUPKlIox+4H5ccxkknDl0CGXFxXD18qxfxpnKoFGxgmCzcdN5zmK27T6+b9+AkdOmoaSwAOVltYVWa+XBa+WlIsZDCCxf52ZYXVmJyEB7jFED3x+F2h5r2sdVivfnxsEkKsKCeWNgVXXEnLnz0LdvX4dcFG8G4ui3jf/7t0QMr7Fd8dbTd4OpLoCo/KSwXi6XoKqgQngfEh2N8wd31W+rkItRxnIesGd5wRlrxdEONS5ZBdl5AcH+wMn9B2C1Wn/duPl8t/Fj27IuGhlYSzlQJ2xZTGYYa2txYt8+9Bo+XHD1JH9tu3fHp2+9heBgN0SEe+DYiSycOJUHDzc5vLw0grWbgu8XKyLHtBwmUxrcPbTygvxSEmhybIsMVCtCXA+94rq+JJfJX51410BRj45t653EOY7DkdMXyLtPkhITTbeynxQKhUKhUCgUCoVC+ftxy4Qtgg22pAspV6dZrVbBEokgYlncPbA3QgP9pF+u2fR/sxIXRfET62eSkpJ+67N3h0BiWr0+xeVSWVn1f7dsPe8HcN4Mw3bx9naBwtUXLq5+CO3kix6aGmildtHmwME0RLVv30jUstlsOLJzFzp3CsSFS5m4Nm42Q6kgMGzbcQllZbWLTNbyBcnHj59t36tXcE56PsBwOxOTbPWig03E6K65KhJMtdXw9bELZRarja/TflrIpRwiI+2ZGD9L7IBL6ZVYtvg+vPKyHx559AlMnDgRCsUNEmo5CHEo/I7/+0IpRcepffF/M4YiNNjeJ87mjcJzJK+AUQjcbjbVCss9fHwgkjXEPiYunAyY+gFLSrJZ35zmui3jat6DmtBCHN+7t7jKYhvDVRkf2/rLxdfHjmnLj10JRCpvoXxuejo6dgzAqQMH0Ll///qslGSs2vfoifPnTwui4+CBkYDCF6UmTxTk5qK0pBSZOalIvZQLs8W6lgOu8Ackl2FwgRz7O1mYfVivl3vGdf3CXadLeCRhDAJ8vBqtL+T3vaCYGMhZ7ojMaRQKhUKhUCgUCoVC+WtxS4WtCtTsYmtYY2ZeoSzEv3FilbiIUDzz0FRm+bdrZiOuq1uCXv/wnWoRUidsfHTt8xvTdW92aB/QZeCEyRCp/ZB+6RK2rV4FtYLDyLtiBSEpM7MM/cYPb1TPpVOnEREsR6eOgUhJLUTahQuIaNNGiPF08WIBsrLK9pnyyl9O3GGzvDFFN/vnb79bq9XKWRu4bdfXwzKsSnJd1kOtiq13qxOLWFjM9mGWM1UwsQ2WWVHBarwzpw0++eoYDv/yPpa9/zZ69x2OBx98EG34fjTViosMynHY85sfDlKjT293jJKa8c9XJgjxsK7BsCxc/cJhKjoPi4UEf5fWL/cJDhMs38iYifl9YFhG06gNjtuWnlHyYMaKb2ExmeYuTCov1LPsG3lT0fP0mZyRXV3tLp0F2dmoKClEl5FdoNPKBXGr26BB9fVEtmuLHw/uEfpM9nLbxt0oKDKh76gx6NS3L6y1xTi+ZTV2775keXll+dxrYtYLtyznSvN55PnFGqVCvSbYz3vIY1PHQ6tW/aZM8pUM8pK6TP/i5fcTWyXBC4VCoVAoFAqFQqFQKPXcUmHr68TEitn6pYcuXknv97/CFsHH0w1PP5SAD75ePR1FjHTmzJnTly9ffkdnmntjqks/Ty/t3D6jxgiiltlkwpGt6zFhdBTOnc9FTY0JBjOH8koD3L2967ezWiywlpwXrLUIkRGe+HXbdoTHx8NYU4nDRzOsVgueJqIWWf/iyrKf3piu+7C0iHnSYmN2X98HGzgJCTBPIJZeXh4NIpdKJUVZsT3+l7WmoFHfiVaz78AVWI1GvPLCPdC4uWPn3guYM3M0DIw3xo6fjEmTJiEoKAh/BklVRnKwblDLoYxR4Kn7Y6Bv6wqTyYovvjqEratW464pCY2C44uUxFLoPCr5cdG6NWRdDIyI5PuVIghbIv6PsXGNo7sz5j15OUX8XnIrX15Z8eUL3wKJNptNn+D61PETmYNi28XIZXx1h7ZvR0iIG8RiEWJivJGWkQljbQ1kCrtFmKunJ2qNVuQW1MDLTQaVUoqEeyKwfedWBIaHQ6V1R8chY5Ce8cXEhVNtD/GbfPang3CbQ0QthYLdEB7k3++xaeOhuE4IvR7+u8v/57bfyVZpFAqFQqFQKBQKhUK5c7mlwhaBeNBdvprRb3jf7r+7XqfV4J8PTMb7X62alAfONGiQ/sEdOxItrdxNp0ACyCs1rl+MmDxOLHcLE5ZdPnMG7joRpFIRIiO9hKDmhTlVJBY5xHWWSQRL8VmEBNitmErLakkQc2ttrbnowrFj3pnnz6O6yvjfl5PKjl3fntlSMUcidtEgqSJF8PO7BsfYuDodguMb8vJosI7y9FAj+Wo6iUgPq6EhwH1ObgX2H7iCoqJqSPh+6Tw8BAutoQPioam5gBAfGzbu+waPT1+CGjYMQ4ffjVGjRiEuxC5CkXSMP/F/21UyePDbTBjdFT8NbY+zu9ahbUSd66NcLAhGySdOoDA3BwPHjkNIdJSwjpXrwLASFBRUIbyzf32/giIjUZ1yCWIxCxuRr4SY8Q28vLI2a+FUySp+LGZcL74kJpWmvDFNt2TPrjMvd5NHEGu4CrGIkcfH+ki9vTUIDdKAKz0HKLqA2GhJhGPBoLrGBLjLhUDyxC0ywF+NCyeOo0v//hCrfTFs8iR888Gn7yycpNv70qqyy006QW4TZur1SoVCtS4iOKDfzGnjIbvuPLwe4hqbmpHNjzu2/W4BCoVCoVAoFAqFQqFQWphbLmwxjHX31aw8WCxWwVrm9yAuUE/eNxHvfpE0Pb4/qlmWnXknWohIFS7v9+rfMdQ7okP9Mg9vH5zcVStkMyQB44vLjIIVleCoR145G4z5J2EpvyqUz8wqw/Ydl2y1taZnbFakbluzZqPZaEyrsFb8xg+MxNXSs+zDxEKp8RrGQCzAhHdWI1y0DdY4xNWPxJqqKMyAiG8gL68Sx05koqjEBA8fX6AoBRqdrpHbYUSYKxRMOaYM9xf+yqvM2H3sB7z0xDtIK5CBU7IIaO+HGY+Nw5N9YqFRNwhpsZ27AHWB4QlKlQxV1SZIUIONX30Or8AQ9Bg6RLCKsrAaZGeXI7hdg0cqCYLPaVzBmSuFrJJgOcP1e0rOE/0gdvo1S7brMedVLExB9uic3M/b88WeM9u4ig2bzn3Zv1+EmASJt1ZmwpgLyLw7gWNY+zEBg5JyEzxd5UKw/itpZejVNqC+Tq1PBAaP7Kvd8MP2L2d2ZfsvP2K7oywME/R6qSfU3wf7+wwk7od/JGoRcguLUV1Ta7VazH+Z7KUUCoVCoVAoFAqFQrmzuOXClhm1R2ES1WTnFyiD/X3/sJyLRi2IW+99kTRjVuLiUpZlX7iTxK03p+ruDw5xm95pwGAADaKQV4A/7rrvEWz48jP06+WPWrMQbF4QjgyVxRCXn4C1thSFRVU4eTIbKalFeeBsM1/8rnydUO9015OwWf7xZpKt/Pfa/a2oRWLJcxUmg13/sZmrG63Lyi4TgtLvXLsONZUVKKu0oWPfvhjXpzf2bNiI4twMGA2NtCMoJSZw18lGLmoJBnZyQ1lWNiwxNnBWV6hUHDpH6xqJWgStpz9qrhO2zGYLlGq1UG7UyHicOZOD9Z/+F26+AXBxUZLg7Lh66RK6DhxYvw0rVcFqroTZZAXHsZW/GYPfEbXqlhsWJugSaquqt5qt5Z8RIXDhdG3eL9sufnHxYkEgCSTvy2XAZqwAp2sjCI3EMsxgtKKkrBa7dqdh6NT74fs/rpeRnXsj/sL5nvzp+Sr/8ZXfa/t2xJ79sNvn/t6edz8+/R7IZX8sahGuZGSTl0vLF7yQ2yodpFAoFAqFQqFQKBQK5X9oUWGLZISbmfhmMMOJOjNgYsDAjwHnAjBE3SAmMBYx1CTFnflqdh7+TNgiuOtc8Pi0CcRya/4Try4ik+n3WrL/zkI/yTVMp5W8P2hYF0as8vrNejcvL/iGRiA9Ixvefm5CvCiS4W/tZ59Dq5GhvMJALLqIo923Zivzz8Sk8nofQZPFMiIxqTKvqX2qrakRXjlzTf0ys9kqBK0npKbkoP/oUWjXo0edGx5QXJAvxPg6cjQD+VlZ8A4IAGclolZjoau62oQNm86h84ChyMvIQFFWCgYNiMCmFd9g0uNPQOfuXl+WEUnBiOVCHcRqrbrGhoHjRuPY9o1CQPtOfHtt2vjh/IU8HDp8XtgmKyUVVRUVUGu1wmdWohL8Dw0Gol9Zm5Rg4KWksov6BFXfa1kjX1pRsUN/N9smg+OezcgsfVqjkbm4uSpRVb1HELVEdbHJcnPLBVHuf0UtoT8yF/QZ3B3Z2VueeyPB9acXk0oPN6VPtwrPuK6L3XQu02by3zGVQn7D8lezBT1LM1u/dA3/Ssz+ROSM4vhTgD+yxQyHDDDcOaPZfOTjBS/kt3D3KRQKhUKhUCgUCoXyN8TpwtYD85eqtEoM4RiMnpW4eKhYJArycneFt6c7dBo1lPyEWSIWgWFYIUaP2WKB0WSGt7ubQ/X7enlgxpRxzIff/PDvWa8tyVn22txVzt4HZyOVYnGv3mFaF/9YXG+tRTDmHYelphhtQyzQaAJRUGIQLIL69I9GxtUiXEzOJZ6JqzkLlryYVPYbgeRmRC2wzDBjba0QuJ5vvH7xqdM5/PGwCfG+wIjRsU8fwXrsGrWVFYjqFy644O3duAn3PPpInTDWYDiXnlGKPXtSEde9N7oNGogdP65FbakMnp5qdOnghZXvf4BBE8Yjsm3bcOvA+wAAIABJREFUOndGhm9KCZvZgIOHriK+a1fEduqEQ1t/FjwxSRHSnw7t/XH8RBbfP044bw5s2YJhkyYJbTIShfBK4l+xYEkqw11NGY7EpOqMRp832ir4l9f0CeySikrtI5WVxtf8A1xdOnQOFtZLxCzaxPkguMqIqtStEMs1kPv3wPXHVuEZjV69Lkk2bjz/Nv9xIG5zZr+2eI5GpX7miekToNOqHdomIjiQWFIGSCWSgPrvNGcTrO6q+fOrtLwSeYXFKCot52brl17kz5Nf+EO6oQbVez5LTDTcuAUKhUKhUCgUCoVCoVD+HKcJW4+/uiRSJGJe1aowytNNp2sTFY7Y8BCEBPhCIf/9jGo3S3iQP+4ddxf7xeoNXzypX5T9QeL8A05twIksnKSLdPdSjo2M8odYE9BonaUqB5ZyIascNBopLFZOiHFFqKioRUpKQbnNZnvoxW/Lf3RmnxhgPHmtLCuDylYrLCNB2c+eL0BMxw6ozL+CnLxKGGpqBLdAAlHXfL2VghVVxw7+WLv+DHav/wl9hnQTYltduVKMM+dyUW1g0evuMWjb3Z4MQO3ighqVPVFhVKQnZFIR9q5bhUPbtqN9r56CiEWEqaP7MlBayeLuEXcJ2RDD4uMFAeuahZTZbOPb4eDt7w+VpAYXjh5BeFyckBWSEStgNFpgMhGLLYbs26vOGKfEJFsV//KufpLr+pzssnVu7uo2QcHusNo4QQDUqGXkIMJaVQVzWRokurD6bUUqTwSHB8HDM73fmwmaDi8kVZ7845ZuLU/qF0+QSqVvP5owBt4ejgnMhJ4d2zhUrqq6hknNzIm5cDkt5uzl1NmoZIpm65est8L6+oeJz129yW5TKBQKhUKhUCgUCoXiPGGLZXEXA0zXqJTM4F5d0bVdLKQSibOq/w0d46JQMqSfcu0vu3+c+eqSXsv/NTe1xRprBqwUD8TEeIskumD+Q0NwfGtNEYw5R3DN2slosqKo1CiIJmWlNTh6KK3IaLDe9XJS+bE/qPqmIG6RWhdFBxd3N5QUFECpMwiC0C/bL6L/6LHIz86G0luDikqD4G4YGhMjbEesq6KifYT3RGwaeVccNm4+jpwrF1FaVIJagxlDJ05EfNcugjB1DY2LC6qVDcJmcLAbgoJckZFRiq1rfhDidnl48mWqzZj42AzIFHbrq5gO7cEYT9dvV1JSDYVag6CoSFTlnkPvnqHYkpSE++fMgUIiR3m5AVqNHAajpY1+qi4q8buyS84as8RVpVf0010Gnj2dtY3f9/b+Aa7ILzbA3UUGhdx+TE0Fp8CIZBBrrmVsZCDRhSI25hK7p6j6Pn7BbSlszU5c2l3Eir66d+xdorAg/xtvcBOoVUq0j4lAZHAA3HRabNl7yMNkNj/EcGISdP7zFmmUQqFQKBQKhUKhUCh/C5wmbH30r/kfPJ64eHdFdfXDKzf88sDm3Qd1g3p2Qd+u7SERt0wor8G9uqCwpNRr/7HT6x7W6/t8lphY1iIN3SR6lmVl03WTIyI8IXYJrV9O4lIZc4+QN8LnqhoLSiuMgutddZURRw9fKTObrSNeTip1qqhFkEq58SExMZAp5CjMyYG/Woy9+6/ANzQabbp3w9Wvv0Gwhwq2MA5nDx+pF7YI3l7q+nhaCoUEY0e3wdHjmcjLscdmD4+PayRqEdQuWqhUjYOQE5HM318HEvufBKJ3822HMSNH1FuHEXyDAlCTeqb+84XkfES2awsvPz8Upp5EbB9vZGSV4eeVKzH+wakoKq6GF+kfGKRcLiRWW287c9wSV5QXvTlRM+LMyczdMpk40sNTg8JSA1w0EriopUJgeVPeMbAynRDMniDWBiE8whsHDl6dlJDAzk9Kslmd2afm8uQrbwQyYtkPdw/qreoUH91i7dTUGrDj4FHsOXIStQZjKQfuC8Zm+/Sj158/v+y1OS3WLoVCoVAoFAqFQqFQ/vo4TXGqy1BITGyeflivf42rwKwft+56ds/hE27jhvZDh7goZzXViIkjBhFxK/5SWua3M2fOHLt8+XJzizR0E0imaHsE+LlEungHgZU2iDbmkkvgLHYXwMpqM0or7PHOLWYrjh5OM9QYTeNe/rb8aMv0ihkf1a4tTEYTkk+egIqTISOrGg89J3gnwlBTDU8vLfz9XbDy+xPITkuDf2goOJtFEOSuh7ggZmeXIyjQFcXF1SgrKhZcD6+HfP5fYYtQWlbDr9MhOCoKuenpgqtjo16K+G1Y/vTk2y0srMKVq2V4YPIAvg9WHDPYhbQ+vUORxPfx+P5DyC+ohJeXhm9LRlw4nS5sEV5YXZm7cJrriBPH0g/27hflqVRKUV5pFgRJnUYqjJG56Bxkft3q90HjHY7AgIuB5nRzf37RDmf36WYhsfA0KtmP3drF+Q/t061F2iCupPuPncamXQdQWVNbBHBLLQbbR8vfnC9k8HxfP79F2qVQKBQKhUKhUCgUyt+HFjGlqrOcWjj7pbeWF5WVvfLpqp+eaBMVLkkYNUQIIO9MxCIRHp44Gks//XZEASLe5BfNdWoDzYBhmMfj4v0g9YirX0aCrZvL7F6TxO2QCCPCcg44dTIDFVWGp19eUb67JfrzRoLaX6JQdg+NjUVtdTW2r1mDvHSg66ChUGk0QhmWM9tjR/F07xaMratW4b5nnoGIsfKdtNXXRYSsrdsuorLSiDGj2mD33lSkX76EgPCwRm3aha3fxlgj2Rf9QoIxdOI9+M+/Xsd373+AMQ8+IFhkCTAiMKwYVotZqLv7kCHQ6nTCQIlkSqGISikVgsof2LIdIjGDdm18odXKIRaLuugTVEH/GxTeGbz0bWnqwimu044fvbqpZ68IiUjMCuKkSiEWgspbKrMhMZSClbsK5aVu0WjT9jSuppc8gdtE2GL1enaWSv1JaKBf5ymjh9YF8XcuuQXF+PanLbialWvkwH3AGa0Ll73xXKnTG6JQKBQKhUKhUCgUyt+alvERrOP9hc8X8y9PP5H49pdnL6V+krY8p9O9Y4eDBJZ3JiqlAo9MHoN3Pl/57JP6Jac/SJz7lVMbuAkWJGjbenpqJkd26Ca4pxGIlZYh+wBQ55FWXmmCrc5SKfl8DvJyyz975bvyj19a0TJ94kSSMSHRUWKJVAry5+bthfzMLARGNBwPV5eGLIjRUV64fLkQB37egj7D+wvLiJXWiVPZOH0mD+169sKl478KWQujozyxa98hdOnfvz5OFoG046qTN+qH2WzF+Qt5GDJ5MFiRCK6ennBVGbD6o2XoMnAIX0c/YTkRtk6cyIJI4SrUK8Aw8AoMqa8rMECHQ4fToVDI4eauEvISBvjrRFfTi8fyb993+iDyvLSydNsbU3XPHz2StrRLt1Ah5hixuvNyI/vJwZBzCPKA3mClGjASJcI69Ibvsavj3pyiHfjCyoqdLdGnpvAEVPN1Ws2Uf0wa7XQ3YXI67z9+Cmu27CLZEQ/xZ/ojHybOPevURigUCoVCoVAoFAqFQqmjRYWta3yof+5Egl7f06sG//p45bp5d/XrwY7o39OpliJ+3p6YPmY489mqDcufTFx64QP9nCNOq7yJzL+LVbl76r7qP7idVOZZZ61ls8KQdQA2Y4XwsbrWIsTWIlxMzsWVlPzNJmvF43UunS0Cy3DjI9u2q//cvkdPbM9ZA6XKbkVnMZvh5dEgQpHD4+urxZHduxEU5gtDXhn2778Cpas3pv7zKSEmVvbFE0JZ4o7oocvFtjVrcPf06Y3aFYtFjT4f/PUqXH0CERZnHxuNTofYcBvat/XFnr37ceHYMQwcPw4orcGx45noOtgugF3DPywCFksKXy8L4g5IzqPYGG9cO5vCwtyJhRRxR2wRYYvw4ndl/35jus7z+NGrz3fuGgqD0YqKKjO0aolglWfI2g9F8EAhoLzUNRyDh3cTrV6565s3EtTdXkyqym6pft2I2folI6ViyYJ/TB4NFydbT5otFiRt3IZDJ89Z+JN4oSX38sLbyTWYQqFQKBQKhUKhUCh/PVpF2CIkJSaSAE3Pz35tyaHNuw9+UVJeoZ06aphg7eIsSByvIb27Kn7Zf3jVP156q+unC58vdFrlTUDn5vJez56hHULa9wdTlwnRWHgaNqMQWkgQtUrKjcL7ixdycflS3taykopJi362mf6w0maiT3B1U8gl/cPiYuuXxXbuhJ3r1oGtOwYWkwl+vtr69UajBWfO5qJjn95Y9/UqcDYrJDIFHpo1CyzLCkKYQtEQP2tA/wis+uEUzhw6hLbdu/9uPy6nFCI9qwbTn360XthUqJSQy4xCLK6RI+Lw/aoT+PGTT4kQh9hYH5zctx+d+vSBss5dMigyEtUpl0GMjRiW4c8hBvFxPvVtBAe5kvOqz0sJLp4Lk8pb7Bx4+buKFxdOZUTHjqTN69wlFGWVJkEM1Kjs4pYp7wRk/t3tVmbRvTBwQK7fpp/PfZGQwN51KwLJz9K/HcZC/PWkEYNEIf6+Tq271mDEJ9+vx6W0jFKAu/eDxLmbnNoAhUKhUCgUCoVCoVAov0OrCVvXeP+1uT/OSnw749DJsxsNRpP3Q/fcDZFIdOMNHWTUoN7IzM0PvnAl/ZuEhISRSUlJjQSEmXq9UswpxzIM05sDowKHFAtnXb9cP//MH9XZFBZO040JDXZ7uFOf3hCpvIRl5uKLsJSlCe+NJhuKyxpErZTLeVuKrRXjl/5sq3VG+3+ElOVGBYSFSRUqVf2ynKtXYTaZYDba9TSpFLBKGoTGo8cy4RsajoFjx+LiiRMY1C8Yew/lC6IWQSQWw8W1QQgj1lNDh0Rh89q1UKo1QpbE68nIKMW+A+mY8OgMwUrrGgqlHHK5/TARYUguF2PAPVOFjIc9ugfDZLZg/5atQjwuglzJHzaNK2ymCsGt0WKxoaioWgh4L6yXS4ilmcSaVTKa//iZE4exEcS6jh+L5xZMAXP0aNrczl1CBJdEIrQp+X2wVOWAKTgNqVd7sDIXRHXuhfT0oiHceczgN/+oue3zbTMzE9/uKgJzNz9ywRy4Mv5vVxFqNtUJyfWQ814C9eo+ndu59ezUtrlNN4KIWsu+WY307LxM/iiOpK6HFAqFQqFQKBQKhUJpLVpd2CIs0z937HH9W4NOXbi8/buffvGZPna409wSiehy/4SRePs/Xw1jYrs8zS9aem3dLP3iMfzk/gM/b4/A2IhQSMQiZOTm42Jq+r9m65dsMFvx7PJ/zU292bb1Y1mlytX1/f6DOzJSzzbCMnPJZZiKztWXMRjt7oeXkvMESy1zdcWEpetaVtQSYJnxke0aCxppycnCa0VZKdx9vMGZKuvXkSyDyZeKcN+z96O0sBAuGhEkUlGj+FnkmHl4ezWq08/XRXDHW/f55+jYpw+6Dx4Eg8GM4yeyBOsvkgnRLySk0TaurmqIRA1DIJXaT8vgqGgUFFShZ/cQfP/DMbTr3h3egQH23ZFpBWGrstIgfM7ILK0Xtghhoe4kQD1xR2wxYYtQJ27NXzgVzImj6XM6dQ0R3BKJsEUwl5LTiYHUqx0kbtHoNaAL0tJ/Waif7rIqcUV50c22O0u/tN2sxMXvKeSy/m2iwhgvN1eUV1XjVHLKU2wVmzwrccmMZfq5e6+VF0P9dqCvd8cJdw1s/k5fB3E//HjlWiJqZZit3KDmfH8oFAqFQqFQKBQKhUJpKrdE2CJ8lPj8+Sf1S0YcOnVul4ebzuWufj2cVrdGpcS0McOxfMWPrz/+6pL1F0XVaXFQva5WKJ+beNcgpkvbmEZCWnFpOfvjL7vHnLpwaRDfp9kfJM794mbalaq08zt2Cg/yiO4vBD4nVlqmwsaGYCYLh5TL+UTU2mmurhifuM5W06yddQD93axW5qYbGtGmTaPlRNhyc1OiIDsboTExsBntwpbJZMX2HZfRf8wYIbD7uSNHERrsJiyXKxoHgvcPDQbMmY2WVVUbMXzKFJw7fBgfL1gIcFZoNHIMGhCJPfvSYLNaG8XM8vZxAWobPAZlMjHMJjMi2sQjP3mPIFj17xOKjd98g3ufeRpSuVwQtsB3l1hquXl5CcJWzx4h9XWEhrhh774rg/QTWF3iGluZs8by96gTt+YtmALJyePp/+zRs3FmSHNpCn8+SCDxiIVLaC/06JnlunP7yX+BxHFvIkJGQ075jFQseWNQzy7SoX26QS5rcAedMGwAft5zMGbbgaM7ZuuXPrdMP++dx19Z1Icv88QDE0Y6NVg8CRT/3U+/4HJ6VpEF5uHL//U8FbUoFAqFQqFQKBQKhdKq3DJhi/BB4tyTs19b+sDm3Qd/CPbzEcVGhDit7riIUHRqE604dvbCsniozb5eHiNJ5kQvd9fflHV3dcE/+HW/njijXrV5x2dP6pe0O4/q+TsSEy2OtqdP0Pi4uiif7TZ8NFipWsiAaCw4LawjsaqsNg5mvrbLlwtw6ULOIVNZxbjEjS0vahEkOs1Qv+BglVrb4DZYUVqKmrIS9OgegpTki+g+eDBsdRZbe/alwicsGu179hQ+F2RnISrIFeXltRBLpI3q1rq6wVTQIGzV1Jhg4feTiFLxXTrj55VJKMu5hFEj4wQx8ddD6SgpLISHT0NMLJVSDPN1NmusiIiOHIKjo5F8cIuwLDTUHTm5Fdi5fj2GT54MRmoPfJ6ZVYZO/Qbj4JatqKoyQq2WCcuJW6S3l0aZm8cN5z8mOW0w/wAibulZ9pncKdCeOpX1oLhTIMpKqqBUELdIF5iKkyFS+4KV69B+0GicPH75HwsTdO+9lFR20dE2Htbr5U9A/V83nfbehyaOQkjAb+NkSSRijB7cF2GB/uKv1m5eOitxUQeAaTOsTzfW28PNqfu8+/BxHDl93swBU5cnPp/s1MopFAqFQqFQKBQKhUJxgFsqbBHef23Ouif1S9/gJ+GvPDfjXui0GqfVPbxvdxw7mzy0bXQ47h8/spFly/9CpJSeHdvCz8uT+Xjl2mfiq5jAh/X6+z5LTDQ40pZUJErs2j1WI9f52+sTySBSeqAsLwO5ueW4klEOi8WKnKzSK0aDbUziRluFU3bSARiOmXB9NkQCsdYillBhYW7Y/+txlBUVQW6uQvLFfOQWGPHgA/fUlzVVl0Gn04JlGeTuu4jqykqo6gK5M2JZo3pPnMyGf2goZHK7ZZfWVQdLuazeQi4oyBUHt27FqPvuq1/GWY0NbZmsyM4uR4/RPpArFJBpPOrXde8WjB/WnELyiUhExYaiqsqEgsIajG3XHtlpacjILENcrHd9eeKOmJdfPgGtIGwREm02mz6BfSwtFeGVFbV9Q8O84KKVo7rGBK27d70YJ1a4ome/TtJN6/a9zX8c50jdM19Y5KKSq34MDfQb+GjCWMEq8c+IjwrD3Eem4eOV6+4rLa/EgB6dm71/15OWlYN1v+zhD57thWWvzdvm1MopFAqFQqFQKBQKhUJxkFsubBHOo+pf8dXo/fXazYNm3TtJEFCaS2l5Bb7+cTMG9+qCMYP71gc8vxHB/j545uEp+PCbNRO5EmgfeX7xxE/emlf5Z9ssnKob5e2leTSuY5zgemgpT4dI6QnYLNBoZFCrPSHXqAQXRKvZ+n+JP1QUNHsHHUQ/iJXL/HQjiQXV9aRdSEZgoKsQzyoi3B2Hd+xEsJcFe/ZeQc/hwyFX2oUTjuMgF9vjkGu1ckSFu2DNfz/BpJmPCWUYcYNr4sVLBbiYUoJ7n76/fplKq4VBKan/3K1bEFavPoVD27ahx9Ch9jYsdmGLBILfsjUZER26wr3OosvVOxBWa4WQPVMsZtG+vT+2JH0P1cP3I/lMDqLat4dCrUJYTAzOH9jSSNgKCXXDwUNX75qTwCqWJrVCHDOexCSb6Y3pLhv8/F37enpp4OqqEPoNzgZT/kmYq/IgUfsgPC4KoacujHlzum7OCyvKlv5ZnU/ol3pJ5KINbaPCuz448W5IJZI/K16Pp5urcC5/+cNG8N8t3DduBGRSx7b9M2pqDXydm2CxWn9cxtS8836za6RQKBQKhUKhUCgUCuXmuC2ELeLyN0O/+IFLaZnHtx844kniBjWHjJw8fPL9TxjG19OnS/smb+/hqsPTDyXgoxVrhmXlFfwy4+U3x3684IX83yu7cKruITc35Yd3DY8RwVAIc1WtEO+ppiYTkRGeglWSwWTP+Gc0mImbXU6zdq6JSL21Az39/HQ6jwbLJ4vZjKzUVPTuaI+51aljAL5ffQwXbBz8QkNhs9rqy5KsiWoFV/+ZZCncsfMyVi3/D+6Z8SgUMnsw+azscuzdl4a7779fiMt1DeL+WKtssJRTyCUYNiwaP234RXBjjOvSWXDbJKLWz1uSoXAPxMAxY+rLe/j5o7qmCFqNXUCz8X3UqMVY+8U3wuf75jwgvBK3xe0/rIaV7zsRwQjEWsrdXam15duG8B9/csqAOgDDsKcKCyoQEOgmHHsly6A0Pw8pKWeE4Pr+/iYwYgWGDI5itm3H4jenuwaaLOXziSj2v3U99urSUKkIm7q3j4+ZOmYYRA4KtNdQyuWYMXU8Vm/egf/7MgmPJoyDTqtu1v4lbdyO4rLydJjMj9oWJtpuvAWFQqFQKBQKhUKhUCgtw20hbBE+TpyXNUu/eMamXQfWRIUFMcF+Pjfe6Hc4deEyVvGT+OljhoFkPrxZtGoV/vnAZHzy/frul9Iy9j356uIxH/xr3oVr619IYF20Ypd/h8fHPjQiYSIj5SpgzD8urAsKdEVZWS02/ZyM2Db+glVUaUk1Mq4WXy0uKt900526CTiGGR/ZtnE2xJz0dKhVrBCHiqBRyxAf64X0HDNiO3ZCYW5ufdna6mrodA1WWUSoI+JM6v40JC1bhnEPPYCK4lrB0qrHsGGIiG9sGUYstqoUja2EvL006N8vHFu+/16wttKYy7F50zlhzDrGeYO5Trzx9PVF4dmj9cIWybAY4K8TYmuFxHeCzt1dWK5Uq+Hq5YP8/Er4+V2XHTHEHYVF1SQ7YqsJWyfN5duQhb2eXiV9ATdcvlKC/JxSDB0cVS+6ETFP5d8J4x67izm0Y9dTB7fv6blguvbhl1dU1KfQfFy/uItUxK4f0rurL4mbxd5k5lAihiXcPQT/z955h0dVpm38nj6Z9N57gFRa6FVAREBFiiLYOwrq7qqsru7G2Ne2uoKiay8gdlGk995LIAHSey+TZEqmfvO8YSYZAsqu6Meuz+/yXJM5855z3vOe4x/c1/3cz8Zd+/Hq+5/hjtlXISos5OcPPAt7j+Ti4PETFpvNfvPiZx5p/I9OwjAMwzAMwzAMwzAXiItG2CIWZz387X3ZL7/9yber7374zuvPu+TKyaZdB7Bl7yHcc/0MRIYG//wBP4OHWiXOtez7tUmOf9DvWJD90tzg7IVrFbN9ZwZ5hrw0cvLkmIGjR53OivKHuaUQNmNnAz4/Pw8MyozClm1FSM+Iwv69xTqz2Tb3hdU23S+e2Hkyb7BUEdPL98pefd2FLSpDJPGtO21tHYhPToW3nx+K8lz6HcxGA/z9PNzGdpgsiEtJQVRcHJYtehN2m5nC092cWk68fLzRpun5HH19PCB3PN/vP/oIKoUE6WlhQrQiIc3teMd8GqRdji/K1fL1VYn5N9fXu42NT0lGWflxN2GLQuf37i+bmj1bqjybI+rXYPlymzV7ltfcnMPlO202e3RVRROmXZnuErUIqdIbcr/O7okjJl+B+LS+Q9Z/+eWB5673/2e7xfaiNvXxsSqZ/P2Zk8Z5jR7c/4LMa/zwQfD39SEnIq6fNkk0WPh3aNK24qvVmxx/2V9YnP3QlgsyKYZhGIZhGIZhGIb5BVxUwhZhMNgerqlvnPD9hu1JMy8fd17H2Ox2fLNmMwpKy0UJ4YUMoJfLZLhh2uUICwr0X/vDxyvUN4XmJ/dLSx01eTJ8/N3FIYnMPZw+PMwHKb2DsXN7vt1itt36+PKWXRdsYudBVG/vEYEhIWGBoaFu+4tP5GHU4C4Risr3Kiq0GDAxBb4BAWiq64oA8/BwvCIq99ekuVkPv7AYDB4/DmazCTWnDohuhHWVlejd1z2k3sNTA0+Ne8A8UV3Tir7DhkHf1gaFuRr9+0XixIla5Fe4V3xSNlqnYNaZtd/SokdsjB+CAr3w45qT6DAaXUH18cnJWL1/B4YN7Tre319DImNIS7N1tOPrhvNevF9I1pftFc/O8bv22NGKHdOuTJeqzlhDicxd7AuPicH1DzygOr5v/8N7N2+eL9HuV8+95zlpaq+ECzqvAam9hRvxvS++xxXjR4qGCecDZa0tXbEGeqPxYFFT+ZMXdFIMwzAMwzAMwzAM8x9y0QlbFNS+IPuFW7fsPbQpvU+ivE98zE+Ot1qt+OS7NWhs1uL+m2cLl9WFhgxZfm37kS7bobj8wQdSA0I6y7hspjZY26thM+tgN+th1df3ODYjIwKHj1bVPfJJ/Zd/WXbBp/aTSO3SGb0y0l3dB4m2lha0NzciJKTLrUPlezaJTHQzJCGpw2BwdT5UK+3o3hbSYrGhtKwZl4/qJb5TTpbeR+04nzeOFxT2nIPjfD4+PZ8J5ZANnjQOdVVVkLQ2iX3ktNq28yj07e2itNCJxtsHlrZWce2GRp24llIpg1RiR3l+AZIyOrPCQqOiYDRJodOZ4OnZKTLSrcfHBeJQi566I/5mwhZR29p6KC0x3BAe7uN55m9WQzOM5dshUXhCqtRA5hkOqcoHGcOGUu6YZvOKFchf8yx6xbwGharH4b+IxJhILLhxFhZ9/CXa9QZMHPnzmXbb9h3GyaIyg9lmvWXla691/OwBDMMwDMMwDMMwDPMbcNEJW8SirIXbF2S/9NLSFWsfeeTuG39SrPp23Vbkl1ZA7Rjz2ofLMSqzH4YPzPi3Q7bPhblDj3Uf/Rmm1lxce8/donwOdivMjadgajoput05IWFCqg6g8HBY2iocw0yiw2NiQmDIk3OMYxxDfrPyrWypVKqc43v1mfnPFRsrAAAgAElEQVRaxSdOIDLCx60sjoSqmKSkzntzEJecjBOHDiNzzGjH7Vndjs8vqIdc5ekY00d8V3moQW6kqChfbN5yEO1aLbx8fd2OkZyRDaXTm9DQaES045qtzS1AR+drSF0XQ4M1OLZ3L4aMH991gFQmPkgMCwryhMfpzK6oSF8U5uW6hC2pTIaYXr3EuJTkLpdaQnwgDh2umDZ7tvR+KhP891byPyfMx+f+tJRwlyolkSog94l2/GWH1dh8Wgg97Y5ryIXCvxcUgcmQyeWYMGMGDmzdik+fmoor730bgRG9L8ic9MYObNixD0dO5MPLyxMbdu4XzRLIyXUu6hqbsWLDdses7U8syV6Yc0EmwjAMwzAMwzAMwzAXgItS2CL00GVLWjD1m7WbM+ZeNemc4ypr6zHhkhHw8fZCh8mEY7mncOD4Sdw6c6ooufolVJzag7UfPIiUfgnIvHIuJI5/2puai1Getx+tTU1CIPL08oBME9wpSHgEuo61mVph1TeIvwdlRkuqqrRLn7ve/48NFu33Ly+3GX7RxM4D2XU+g30CAqJDo6Pd9lO+VvQZ+VokBA2aMML1vf+I4fhx6TIMGDkSJMI4oZLFAwfLMXjCZMhknWKTysNDCFsqpRwx0b7I2bMHwy+77Cfnlptbg4TUNChVKqg1HrDpZa7fBg+KwbpNW9HfcW36vZNOYSznWDUy0sNdY2Ni/HHgyAlRJucUz6gc8cTuNW7CVnCwJ7y9VZEZWu9hjq87fnrlfhnZ46VqeZjvGJlEMjc9I+KG1NSueUiUnlCGduVlUR6bqTEPVl0t9PoOVJzcDm+/44hOy4TKLx6ZY8YgNDIKX78yC/3G341Bl8+DVCo722XPi9LKauFuTEiIxaSJY4Wbrqi4HNrW9nMe01mCuJb+39qVC90r//HFGYZhGIZhGIZhGOZX4KIVtt7LyjLel/3SLbsOHdvZN7mXKr332bOG/H290dbWLoQtlVKJzP7pqK6tx+JPvsJd101DoJ/vWY/7KfStDdjyxdOoL96Gy6+ZjuCIcFjaKmGoOYr1aw7DwzcE4QnpCExJFS4tSTexgYLU7R1aWA1Nrn1qtQIzZvSPOFXUvry0pN7w8q3BW0xG42OPLms7+O+vzPkhlUhm9EpPl3R3S1nMZpQXFGD4zHTXvtY2I5qbDUIQchIeGyuyq3IPHEBKaqRr/6HDlZCrfdB3+DDXPsq3cuZH9esXiR9Xb0O/4cOh8T57zlm7zoScYzW4dv4s8V3t4QGrsus1DA/3QViwCjtWrca4q6ed3mtHZaUWdXVtiIvt6rpIAfJbthaivqoKIZGd8yQn2cavvxAinNOVRmtA5YhHcqqoHPFXE7aem+s/P3Fw7DOx8WG+8Qmh8PKwuTn6bPRe6OsgVfs73hm549MP6sjhwgGo7mhDjfEEigrzcPjQcky8rB88wzMQlRiPufffI9bj4ye+wvi5TyM6ecRPzOLs5BWU4IvVmzBm1BB4dxN829rbkRwTcc7jNu0+gMKyCp0Z5ts2ZmVZ/u0LMwzDMAzDMAzDMMyvyEUrbBGvZz108L7sl5797Id12Y/OuwmeGo8eY2IjwpBfUY1Ix6eT8NBgyOUyvLN8Be69YSa8PTXndT0quzu08UPsX/0aMkcPxYQp98BubhdZSFQ2lpdbg5Fj0hCcPkWUlXXHZmhCR80B2BzjYbe7/Uah8t5xozE41ReDYfdorTpx+VfvLxuYPds/JWt5cxMuMK4yxDOC3KtKS+Glkbryp4iysmYEhYfD29/PtU/b1ASzUY+da1YjMelWsa+8ogWHjlRh5l13uUoWCadjiwgJ9kJcjDdWLfsM02+/TZQGdocystZvOIXe/QeKPCxCrdHApHQfN2pkPL78eg/CYqKRMnAgbBYzdu0ucfwihVZrEIHwBN1HYKAGRbl5LmGLsrn8Q8JFblj37ohUjng0p3KaY20ezqIWjheYp6/3SUvuFfba5NnTZMqAZBHuRRlsuuItqK9rRHCQF6g6lt4l+k2qIPfWQMg0QfSCQKb2Q8awYcgYMhiNeauRd7wEGRITLNoSx7h+QuSrq6zC5mV/gE/YQEy4/ilofM6v82dReSU+X70R48eOgMZD7fZbQ2MzYiPDznpcTX0jVm4SOuBflmQ9cuIXLhHDMAzDMAzDMAzDXHAuamGLMFcXPKdFryu/WLVx0C0zp/b4PTE2CtsPHeuxPzgwAElJ8Viy9GvMv3EWNGp1jzHdqSvPxZr3/oigYDnmLrgLSpUc5oZjMLcUCqHKZrMjOMgT/hG9YbcYYWrKga2jFbCZQY4iCpA/U9Ai19D6jaeEsyhVskO4c8it4xUUhfS0sJD6+gKyJL3/S9bnbCjneKV7+fj0joiLddtfnJcn5tIdytdKSBnotq+isAhRUX4iy2rjih8RFmDD9h1FCA6PRHRiovu1qJxQ3SV0kSi19LOD+PqddzHxmlnw8fMR+5ua9cJd1dpuw7XTr3aNJ2FMonR/DTUaJfz9PLBm+XJ0GIxorsp3rHs8AqPlqKzSuoQtIjbGH0W5uRg28VLXvviUFJSWH3MTtkJDvR3nVSVitifVAl5wp5wUkqlJSUEyuWdYp6jVoYWxchf27y+AQW9C6JhuDjZ6n0wkmG4T5YkSKrUkB5fKBwr/JPiE90aEtglmM8WBNcJQsgkKvzgEh6Xh2nvn4fj+/fjkyUsxcvrjSBsxqzMh/xxUVNfhX599h8suHdND1BL6nmMuZyvZtTp+++S71egwW9a/kf3w669nPXihlophGIZhGIZhGIZhLhgXvbC1ZMkS873ZL9964NiJvX2TkzwGpvVx+z08OBBGg9Gt9Iwwm83IPVmAuvpG3VtLv/W894YZolTxTChDaP+aJcjZ9BYmzLgKEXFxnWWHVUdhtxgc57WLUkOp1Ca68VEmEmjrcR7AYLTAIsYDaqUMrW0mGDus0Hh5CDHMWLEDHrHjAZtFuJwkUklojxNdCOzSGYnpaSJDqTuUrzVqSJfLh4ST6upWjLwqxW1ceWEhIsJ9kZIcgpWrcpGX04Zpt9yCnWvWoKGmBkFhXQ4fhWNNNR5d60rB+SaTFb6BAVj62j/hHxwMU3ud6FTYKykY9Q21Ys2deHh6wq5wd2w1N+vR3KLH9KvS8d333yIwPBIz77wTJ48cRdHBTUhP65azFe2PQ0dyXV0cifiUZKzetw3Dh8a5xlGIf3xcAI7ndlA54q9QAirxJHnJ7ni2zmdNn3Hxwdi9uxgVVW0IDfFEh8kGq80OuUwCD5XjvTK1u1LMbMZmWLSl4u/AwE6xyWKVQNdugC+KYWmvhjI4HWmDBonS0fVfLULR0Q2YdNvLUJ6lcyI5rt749CvqfKjLOXbSc8SwgW5B/i3aVkSEBJ31btZt24PSyppmC6y320jVZRiGYRiGYRiGYZiLkIte2CLeyHrw2H3ZLz/++cr1L8dFhiPgtAuIIPHG38cLOp0OPj6dwoZeb8DGrbvQ0NhUZIN1YmF5ZdaSpd/cdPec6VCrukQYi8mIlf+6D1JLGa5bMA9yiUW4bKzt1UKoKihsgCwgGWmDh8FQtEpkIZ2LxpYO6I1dEUQkGh3cX4KU1AhIZDIheMlhgqF0I4xmCYpLmiCBre5XWC7YJZIZvc8oQ2xtbkZ7SyNCQuJd+6qqtJArVAiPjek61nHjFYWFSB0fDYVCJkSkDqsavTLS0WHQY9/GTZg8d45rPJUlemjICdS5NlQCqPb0xqUzZmDctGn44eNPEODpg2FD40Qp3qn8enH+hNRUMV7toYJF5f4aHjpSibTUMNEBMTTEGynDhomSxZikROxY+Z1bWDyJjUqFFKUnTyF1UKbYFxoZCaNFhvb2Dnh5dXXUpHLE48drZjjemb9ecLHGLqk+eLgCUuUGhIVqoJBaYHPMs8NsQ5+UcGzdmo++A2Ic72hXOa1KKUVoYM/y2i4k8O41EU0F5dizfwP6Z4TAbtkPi7YM6tD+uOqmm3Boxw4se+ZKzPjjp/D27xL8qusasOjjL9Gq03/kePeezC8qXmuymBNGDx8EubxzvVtaWhES6N/jqsUVVVi9bY9jnW3zlzyxsOyCrRHDMAzDMAzDMAzDXGD+K4QtYjHaX51vsF/+8berJi648RqXO4tEjna9AcrTglVFVQ127D4Ag8G4xwD7jHey/lw1Pjv7dpRW4M1Pv75p3tzp8FCrYDYZ8PU/bkB0rCcGX3ItLG3lMNQeEeHvOr0Ju/ZUIGPsVCQk9xHZWU5Rq1MPkQgHkLNjIDlw2h3HkMhG86mtaUXe8SoEhXhBpe5cYnJuaVt0OHWqDh0dFuEEg13y7yfb/wzPzPbr4+nnlRaV4B62T24t6uLY3dVGZYixffq4ZWG1tbSgQ9+GgNPlfiKrKi5O/J2amYl9mzaLrKeQyM7AcRKY6JyUT0YUFTcgMS0VEsdayB0bObc8bQbHmE4hKjrKDycOH3EJW1SGJ5V0rWVjkw7l5S0YNXuA+B4W5oPqklL0HToUfkFBkCo80NxicM2PnkN0tB+K8nJdwhbdT2yv3qLbY2pKt+y1cF+oPRTJT87xoosf/8WL7c7AuNgANNbVo7zEhKAgL8e8AkSuWLPjnlRqBXZuy0dsfBDiE4JF+WZrWwcCfFVQyJ3PRAKD0Yy2ViNCHO8OrYmp5jDi+gyDT0AA1n3+KQak+4OW3li6EcqQDAwYNQp+gYH44sVZmL3wa3j6haKipg5vfPKVELVy0X77xiezLHdkvzi6pKziq9bW9mGjRwx2rJ+vY04qtLS2ud2E3mjER1+vcryflo8XPfHwsgu8RgzDMAzDMAzDMAxzQfmvEbZsWVm2eY8/d3NBacX+FRu2RUy/bKzY36Rtg9lqhd1mx/Zd+1FYVEqS0es6tD9KnRVpDHVzmz179m0SDDG8/tEXd8+bezU2ffAHxMZ7I3PsGJgbT8DUkCvOV1Xdir0H6zBp7k0IDPbvDI43NAhBK+d4DVRByeg7fCTkcgk6ag4Kd1dLixFlpY3CpVVZ0QyfkDTEDxgEo64Fu3YfQnCgBOkZkait1WHs2CQh5JDg8cVXh/+aPdt7WdbytpoLtU4SuWR6YmqaVCZ3f7TFJ9zztUhGouD40dPGu42jMsTwMC+XI6qmtg39L+nM6iLBiErg1ny+HHMWLOgKkZd0CjN0T/kFDZhx1zWu81HXQ5Wlay7x8YHYsOkojFdPEy4sO2xwilp0/OYtBY7r+0B5OneLsrF27S/pvIxjTlGJCaiqanUJWwTlbG3fdQo2x3vgFOmoHDF3+yo3YYvEtbhYf0neybrpuIDC1rNz/UYkJATdPqB/lGtf3qkG1DbosWNbPsL7TMSAKWNEuWBlwR5s3vAx/AM0ohzVy0OO8FAvyDQhUIUPgkYqR2teHjZv24DBA8PgiToYy7YgIHI4rrr1Lqz44D00NOjQr2+E4/07BJtJ57jXdJGX9e3rt2HIDW/gnS9+gN5gfKs+d+/8jcuXC8XxnayHq27Lzh4naZE898PqjfdlpPWR9UmKx9acPJcDjs7xyber0dDcktcC3YILtT4MwzAMwzAMwzAM82vxXyNsEUuefrR6QfYLszftPrDOz9tLPXbYQBxw/MOc8rW++WEdTKaOHMC24PWshVvPPHa54x/4Umn2vfOz0PraCwsfyvAtlmSOnesmalGZXO6pVlx9+13w0CiEoEAh31TStnVHGQZdNk0IOwQ5u5wurtZ2kxBi8k/Wou/4OzBh7lOQyjqX1mRsx2fPz0T+qXLh1GlrN8PXWwm5XIqM9HD/Ldt1VzqG/etCrZEE9hm9MjLc9lnMZiFYjejftb+pSQ+dwYK4Pu6ZZeUFnfla4jiLDY2NOpdji6COiVZDM77+1zu48uabREYWdX20WzuQX1APn8AQt9JGlYcGKlPXa0YilIdKimN792LQJZeIvDHCZLJgzdqTgMIXbW1a13jqtKh1PCOjXi+EMAqvLzq4mcL3XWMo6N5kzBddH51ONbqvDV9+Ie5BLu9yqVE5Yt7JOipHfOaClSNKJJcmJQa5LtKuNzvWRY0D+4qRPPxmXHrTc66h6aOvQ2TSUGz4+EFRpkr58CJyjN4lidTxnxwJaRkICI3Aqk8/RN8UH1APAEPZZqijRoiulD988K4I8x85Ih7mplPivIlp6SL0//1/LrTr/Ya8tDi7/RGbbblb98fTQu8f78t+4ZsjObmLCovLMiwWCwpKKxAfHYGv12xGzsnCZgvMsz7Oymq9IGvDMAzDMAzDMAzDML8i/1XCFrEoa+H2+dkvzv567eZP1m7f4603dpDTpBJ2+zN1Et27y7OyTOc61mbLsmVLpY+obomYM/aGB6Ms2hKXqJV3ohanClsx8655UKmVMJRtgd2sR0VlC/YerMflc29CcERnhpHdrBNZXNQVsaXNBBskKCluxLCrFmLk9IfdrqlUe2HagnfwwV/Hwd9fD7lMCrVaDpVC2umKsksv2DPInquJ89b4Zcb27uW2v7K4GN4aGTw9u/LFysqaEBYdDY2Xl9tYka81Llr8Xd/QDoVKjYDgrsD55vp6jByRgPr6dny2aBGm3XYbPGRKNDbpsf9AOcZePcstoFw4trq9ZlQ6OHBgFPZs2IiwmBhERAZC22rEmjUnkNh/CNKHDMUnr7zkGk+uJh8fFapLy4QLi4StHStXuOVseagVImuLuiM6hS0S3ALCwlFT24qoSD/X+SIdf6uV8v5PXedLAwv/07XujsRmNxiNZvG32WJDS6sJhfm1UPgkY9zc7B7jSdxSefpi1dt3I3NQJJpbFfBHI+xlm6GizplKb/gFBWL6nfPw/Ucfob6uDIMGxQj3oDp6DK685Tb8+PF72La9CKNHJQpxSyJXYeilE3B49/N1hVVfPGoTLQ/PDgm/s7OzB6ENtzsW8bE3PvkqUqlQUBliox3Wq9/MeiT3QqwLwzAMwzAMwzAMw/za/NcJW8TirIdXLMh+qXebXjfCbpPUW6W6A0ueyNKfz7HymT6JkTERkRoPKQwlR8W+4pJG5J1qwjXz7oHa06ezo51Zj+O5NSgoM2P6XffAy6czsN5maISxcjesFqMIjKfOh/t2F2HA5EcwdGpn9dauXbswbNgwl/DiGxSNqXctxg9v3IIhIkRdgrAgD9TVtZEodupCrYsSyunxyclSV4ngaShfKybGPSS8tLQZiQNGuu0jN5bJ0IaAgK58LRK/nOV9JCZpGxvh6xONiHAfyOU1ovNh336xOHqoEHaJDH3693c7p4qELZv7a0auqa3bCvHtO/9C6sB+OH7gCDIvmYARky4T7jI7HM/GYIaHR+d9hIX6oKqkRAhb1GVRpnTP2SLICVbouM8xV1zh2hefnIKysqNuwha5t6Jj/CUFp+qoO+KL/876ngubXXKopqYN0dH+qKnXo7pai5oGGW564n3I5D07cRK9Bk6G7N4PxDuRmRkJs8WOIH877KWboYoYCplniHCozbjjDqz74kus33AS48f1Qkf1PnjEXIIpN96CFe++jUOHKzBwQBRM9ccc+4MQHhUekpqro9rRop+a82kB+M152dkfWs2eAyxWi78Zut1LsrIaLsSaMAzDMAzDMAzDMMxvwX+lsEUsynqIcqm+/nePsyvsYd6+vhKrrlaUf+l0JuzZW45r5t0NtXcATLWHYdXX4eChCtRq1Zg173YoVZ2d9SztVeio2gcq36pvMsJgtGDfnmIMmPxnl6hF/PDDD3jxxRexaNEiRER0hqwnDZiES29+FZs/y0KHrkB0HOwwS9GQ9Md/LMh+aaHjflb/4kWRSGb17te3x+6iE3kYMyzU9Z3cRXX17ZiYmuI2rqKoSHQh7J6vFdG7q1SRguWlUrtLcCIHmIdGg7omGy6bPQebV3wnAvS7o9Z4QGmRue2jsk0SmC6f1AcHDhaI81HIPEGinJevL7Rao+s6lLNVVFp6+hYliIxPQHV1z5ytvfuPCHHON6DzXCSErdyzFSOGu69HYnwACgrqZuICCFv3ZL3QT9nr/kel5R+hsq4UGu8ghMaNwpzbFsI7oPPZtzjWzc/Pr8exCX3HY+o972Hlm7dh8OAoWKw2BJO4VbkTqrBMyH2iQVlpk66bjS0rvsfa9TmYNDEZxup9UEcMxZQbb8ay1xeDQutJjKR3Wq3RSGRS9Gx1eA6WZAlBeMcvXQeGYRiGYRiGYRiG+f/gv1bY+k+RwC6TdBNfjuZUIXP8RPgER8LclA9zSxFy82pR3azAjDtudQWkW1rLRHdEk8kqRC2T2Yr9e4vRb+KfMHTqfa7zUQXYvn37sGXLFshkMsyaNQuzZ88Wv6WPmo20kddAp62DXtsAi82Ow6VtGRt37V91X/bLq+2wP7oo66HD/8l9PTvXM1ql9h4Sf0ZmVktjIwytzQgNSXLtq6jUQuPljeDTopuT8oICREZ25muRO4scZZmXxbp+b65vgI+36nRHSIiw/IDQEEy//Xbo29vRYeyA1WoV9+1EOLaM7q+Z2WwRuVLBQV64Ykoq1m88JY53Qq6sFq0BYWHe4ntYqDd27slznTsmKQmFBzYhLbUrZysw0BOeGiVKTpxEv9NKVkhkpGON5WhtMzrmrXaNJWeVQiEfRKWbWUv1Jee/yl3clf1ilGMlnvTy8Lhxwogx8nHDHoNSIYdE4i7sHTlyBKNGjcIrr7yCO+64w61Mk0jsdymm3P02Vr11J4YMjYHd5rgXfxVQvd/xMpkh90sQx1wy7Sqs/aIDu/eUYMRwCUz1OVCF9MWQiZcj7+hWjBwZ33lCx1jHDNyVRIZhGIZhGIZhGIb5H+X3J2xJJBab1QKJ3EN8r6trR+bkXiIk3tRwXLiZDh2tww1/etAlall1NULU6ujoFLWsNhsOHShFn5F3YvhVf3Q7/zvvvIN169bhL3/5C5566ilcd9110Gg0uPLKK09fXwovvzCxERHxwPCBGfhx087L9x7NvfS+7JeW22D92+KsP/9kKVlPlNPi+vSRK067y5yQ0BMZ4esSo4jSsmbEp6S4iSwkZJUXFiF1fGfwe1ubCXqDReRgOWlpqIevr4fru15vhtqjs0STsrq8/fxQkJPjVo7o7esDi9ZdzCkobERQoKcr1F2llMNkNLp+9w8Kglbbdft0TYndjKbaOpFzFp2UiO0rv3PL2SKo62NRXp5L2CL3WEzv3ih33G9at7B5cstFR/vJCossVzu+vvpzK9ud+X/5u79EJVvoIZUvGN4/3WvyJcPh6+11zvEpjnX29vbG3Xffjd27dwsXn4eHh9uYpAGXY8LNr2LjRw9g2Ih4NDRTWaLa8XIeAWRKyL07uy2Ov/pqfPDCC+inM8EThZB5RyIkKho5WzurcCVyNawWC2xyi/nfuSeGYRiGYRiGYRiG+W/l9yds2ewtOm0zZGqq1pKI/8gm01maaBOiT2JGX1eout1iQEf1AeHEamjpgNVmR86RCkRlzMKYax53O3dpaSkefvhhpKen429/+5sQVshh9NFHHwlhi4SNzMxMKM7IwPL38cb10yZh/PBM+Q+bdlyfc6Jw1oLsl96XWEzPv/7UX0rP676AmWctQ8zLQ1y3fC0hYJU3Y9Io9zLE1uZmmPVt8PfrFF1qa1sRGBoqwt+dNNXVwa+bsEWOLZWm63vmmNFY/9VXCI6MdAXOK1VKWLpdh4TEnbuKMXJ4vGsfBcTr23Wu7wEhwSisON51b46boxJJytkiYcsvKAgypaZnzlasP9ZvzBc5XU5RMiElBTlbVroJW0RifCCKihqpHPG8hK0bs7N9fOxe82UqxcP9UpL8p44bibDgwLOOPXDgAIIcc4yNjYVSqcTcuXPFu/Daa6/h0KFD+Pzzz5GUlOR2TOrwmTDqtNj7XRaGDk8Q+W3hQVKYag6Jd1Wi8BT3lOh4tyoqqtGnTwis7TUwGbsEQqk6ADqt1i612zgni2EYhmEYhmEYhvld8LsTtkz69qLaysp2k8XmRQHdgQEa1FRUo3dqnPi9uVmP0OSo06Pt6Kg5BLu1Ay2tZlitNhTk10ITOgKX3vS8m1uIhC9y5bS1teG2226DSqXCqlWr8MUXX+DJJ58UY3Jzc8WY559/HpMnT+4xt/CQINw5exqKK6pUqzbvmpdXWHLLguyX35NYOl74KYHruet9QhUqj1Hxyclu+80mEyqLijA6M8O1j7oZmi1A9BnCSnlBIcLCvV3OLuomGBEb5zamqa4eiRFdQhYFvPsGdglLcoUSErsFX739L1w7727Hb+7CT0OjDj+uzoPGx8+xsnbXfiFsGQ2u7/4hIWhpMbgdSzlbVaUlwo1F607dD6uqWtyErYhwX9htFlQUFiEuubMkkxxb6z5fDovF5hKAxP4Yf8d32fDsuV4RWUvbq86yrII7HnnRW+0hme8Hrz+m9IoLmXLJCMRFhp91rFarxV//+lds2rQJe/bsce0nYYtcfGvXrhVlqUOGDMGHH37ocvE5GXjpbWhvrsaRPe9gwKBYNGk7EBwgEW5BdfRokHxJgmFzcbEYL1X7ovJYPkJCvCDzCERTkw711dXF5s8MlVh6rjtiGIZhGIZhGIZhmP8dfnfCVtZ3Nv2z1/u98u37H/3tssmDERcXgJwDB5CSmQmpylcIIApVZyc7S1t1ZxmiyYZ2vRnVVS3QWSMx5963IJW6L927776LNWvW4OWXXxbh8mPHjkVzczPuvPNOPPjgg2JMXV0dcnJyhNjl4+OD0NBQJCYm9shdio+KwL03zERReZV6zdZd9+YVlN55X/bLS2Gzvvh69sLjOAMbZFfH9u4tV51R4lZZVAxfbzk0mq7OfORII1FIpVa7jRX5WuG+ru/UETEzI9ZtTFN9HTJTo13fTWc4tiwmk+h46OWlwmeLFmP6HXcgODxE/EaC2spVeRgxeSpam1tgNpa4jlOr5DA0dXNsBQejra1DCIkyWacYRZ0Rt+3pOoaEucL9G5Ce1iUyKZUyIW4Jl9ppYYvC7fK/BEkAACAASURBVAPDI0XYfHS0X7exckRF+cpKiq3THV8Xn7mm92a/HCKDfb7GQzY/JSkucPLY4YiLOrugRaImufHCw8OFoHnppZeK8lMnAwcOxEsvvYQHHngAM2fOFPlrV199NR555BFkZ2dDLu96l0bPehTNtcUoOLUDvfqEiQYFHmgQGW9yn1hIpJ3xWVR2KNWE4vi+ZZg4NgKFxc3YsmGJzmy1zs+iCTEMwzAMwzAMwzDM74DfnbBFmJe1ZpfNKaz95K3Sp3v1CvavKqpHZXExQvzjoFLloMPQ6RaynM55am7tgF7XgYIiA27K/hAKZZeY01naVy5KECkknMQLKj/86quvRAli/9N5U/X19XjhhRcwZcoUIYKRmLVw4UJRmvb3v/9diB9nkhAdgXuun4nSyhrFuh17b845WXD9guyXfrDb8MqbTy3cbrPZhO1JCvvM3n0zehxffCJPOJO6Q8JWxshMt310DxVFhUifECe+k2DV1GxAeDfHlqmjA7rWVvj5dd075ZGpuwk4ZrMJCoUUA/pHCpHpy7fewrX33IX2Bh1++DEP42fMQuqgTOxcsxaWdqvrOKVKDqO+KzyeuiJKZQrRsdLHp1OACw72QltzM/RtbdB4eyM6MQHbf/i2Z86W436Pnzjhtj8hJRll5UfchC2CyhFLSpqoHNElbM3P/nuCFPIHFFLpbX2Tk7wmjhyMmAj3MsbuUDg8PXN69k8//TSmTp2KY8eO9Rg3aNAg4dbKysoSItf8+fPx7LPP4ptvvhHHUBdNgjLYJt/xGj782wRoW/SQyyTwUMthbikWwhaF7FO3SLlPDHL27kdrUz1Wr9Fam1oMa8wW28NZy7W555wswzAMwzAMwzAMw/yP8bsUtk47Wt54dLb0U+Mx81WQYPLWH1bOue7eu+Af4C1CygkqayOUChkqK1swfNrD8A5w7yT4+OOPCxGLXFoUHE+iFpWk5efnY/v27S5hi0SP9vZ2IWI5BRc6Zv369SJk/k9/+hMGDBgAL6+eQeSxkWG449qrUNvYJN+068DV+3Lyrp6f9eK+BdkvLQrOfXWzh1oxJiEtrcdxRXknMG5kl8uIhKLGRh0SUt3ztahzotmog79/p2hF7ipyf/kHB7nGaBuboFJKRfC6k44Oi1sGF5U+yuWdv1PHQuog+d37H8JibMfIKVcIUYtQKJUwWrpMRWohbOnd5kTliJSh5RS2SCjz81WjuqwMiY57pYB5uUqD5mYDAgK65WzF+GPHzmI019cjIKTTLRaXnILvd27GSMS7XSM2NoAcYSMfn+Ud3pTxRB8pcJ9a4XHV4L4p8nHDMxEaGNBjTZ2QmNnS0oI333xTiJMUCE9iWm1tLaKjo3uMJ1GroqLCJWC+9dZb2LBhgxA6n3nmGbexSrUnBl0+D2W7X0RYWGc4P06/iw3VVUiO8YLdIxy71n5tMXVY7mzvMK79qXJKhmEYhmEYhmEYhvlf5XcpbDl5brlN6/j4OHu8dFkFinsf2LYzMy6xF458v1+IFFKFF2yGJgT4KqFRSXHo4B7EZs5CoH9XyR7lZ0VGRmLZsmUICAiA2WzGPffcg9bWVowePVqMIZGLhAzqkEflh0RxcbEQRS677DLh2iGok2J1dbX47NWrV4/5ktBy3RUTccW4kdh5MGfw9gNHP2xKvtcQLi9VtZtUUHerRGyuq0eHTovg4K7zlFe0wC8oWISvd6eisBDh4T4uwY3KEEOjY0TguZPGulr4d8uzIkwdVsc1uzm2hLDVdUz/fpGoqc2DIrw3Bowc6dqvUCoc69QlbCnPImwFhlLOVqMQqlz3TzlbJaVC2ILI2UpEZVWzm7BFQhi5yorzTriErZCIcFihQovW4BZ+b5epoYgdpWzHwENBvt6hIzP7YcTADHh7ut9nd2pqaoQ4SSWlJGguWbJEPNc//OEP+PLLL8XzKykpEeWInp6eruPoHaFj9Y77pDJFGkNh8lSSeCZ5+YXYsvJ9xAfYEOR/usul3FOsb01pMTLT+2LFp1+iXdvy9qNLWz4452QZhmEYhmEYhmEY5n+c37Ww5SRro82SPdtzxuYV3y8PCvYd1t6mQ1l+ATQeATh1ZDcMBhPqW+Xw9yvEP198CBNnLMDIzL5CCCKH1r333ouJEyfi/vvvF1lL5Noh0aJfv37i/I899pjojkeB4a+++qoQOTZv3iwcW1Se6GTYsGGYNm0aCgoKRGnjuHHj4O3t3WO+Xp4aXDZ6KCaMGIxjpwo9dhw4ir9/Xob4MCmGJquQHqdA0Yk8ypByhcETZWXNSEhN73E+Co7vnq9VU9uG6NRUtzFNtbUuR5cTg9EMlcZd2PLs5uginSwwwBNS36DO7pOnUShVjnvvKkVUqWSwOtaiezdD6shYX1Dudj3K2TpVUuL6Tjlb+XvXIyPdPfuKxDDK2cocO6ZzHlIp4vr0cdx/HXzTNSjV+uJgdTjyGkIc++Nxa2a/0PTeia48r3NBjQHIoUdNAciVRTlpBD3/Dz74QLjurrjiClFq+t1334nyQsrUcgqG9HznzJmDG264Addcc00P8dJg7MB3a9fj5Jq/48pJKagt98KPq07Cy0eDEVOHInfXbuja2vHZ0h2tjvV7xVzT+kyPSTIMwzAMwzAMwzDM7wgWtk6TtVxXNnu2dFTfGvskqUxyy47Vq6+ZPf9e9Bk9S2RujY+NEeM0363AmvcfwtFjN+PaaVci6LR7i0QKcm01NTWJMHCn6LFr1y7h7KFueVSWSBt9//zzz3H77be7xC+CRK6EhARs3LgRCoVCCCXk9nriiSeQmZnZY84kxPRL6SW2hmYt9hw+htUH8vDVNi28TV4YEJICq90GmcQOiuOqqGzBoMvdyxBFRlhhIfpeluD6XlfXhqFT3IPjG2vrEOrXJWLR+SjcXe3RFUJvNpkhV/+0OERQOL+lWymiUiGH1WYVOV5OYSsgNBSn9rm7uELDvLFt13Ehgskca0w5W1tXtPbI2YqN9cexH0+I8ylVKtF/0T++H7buKcMGXRokqlAM7puKq65JQ1CAe+7WT0EiI5WbkkB5yy234Pvvv8dVV10lntU///lPXHLJJeIdOHDggHh21157LSZMmIB//OMfSEtLg8lkQnBwsCg/PJPcgmJ888W7UFevxHWzJiAhNRUZQ4eKeyVhjvLF9mzYaDKbzfPbJNKvnl3a0nzeE2cYhmEYhmEYhmGY/1FY2OrG8uU2shH9mC2Vrq6aU2z99t33rpt4zSwEhXeFh4+eMgW61mXI2/SY5e9V9eYp48d4jBkyALLTZXtUjkiQG2vp0qVYtGgRQkJChNDh5OOPPxZZWlTG6IQ65e3YsUOUJypOizs33nijyGSKiYkRwhYJIx0dHWd1cZHANnXcSFD3voKySuw/moftJ/Kxc2crUoIaECorcTxtD0TExbkdR/laNrMefn6dApW21Si6QIadkRPVWFODlJhg13cKmKfoemW37orUFVHhJcPPoVAoYe7m2KLAeTKWmYxGaE5njJFjizK2uuPjrYJcakODYy6hUVHwDQyE0sMbTc164QxzEhriDblcgoOHitCqiMfRIhO0+hj0HTIegzJSkBQb5VZm+e8yd+5cUY5IQfAU/E6uPSo7JSfWJ598IsoN165d63iflosSRXqGQ4cOFa4u6oLZndZ2Hb5duwUHjh7VhRUsaY3onRQukytgs1ohdZyXtrwDB7Hl+++t7e3aBY99qn3nP544wzAMwzAMwzAMw/yPwcLWWaBw+ezx0huL7Xkn33v+7w/1HznCU6VWo7aiEmX5+bqOjo7PJTbbi0Zzh/XrNZvf3Hc0b/y1UyYgLqqrJI5cW2PGjBECB4lYVIpIbNu2DStWrBAurIiIriD65557TpQo3nzzza59dCzlNFEeF0GlcFTqNmTIENFVjwQvdTdhiSDBpndctNiucczpZFEpDuedwuZTRTBFD8HSzR1IjbWhd6Qc3hopygsKEB7mnq8VFBbmJlhZrVa0NDbAzy/Gtc9itjquJRNB8E5ExpbiPB1b3TK26NpKpRwGnc6V/+Xj5+f4QY52XQe8PFWucaEhXqgqKRHCFn2PSkxAVVWjELbMVhnKWn1wqjEQNbGD8eOpUKT1SsCVl/VGn4QYKOQX5nUn4ZFEreuuu07kalEwPPH8888LF9cjjzwiXHf0Oz1vCpan8d0FSZvdLhx2363binaDca3FJr+3wdxUZTt58qaSkyduVWs8M0MiIuQGvR71VVW77Hb7Q48t1e68IDfAMAzDMAzDMAzDMP8jsLB1Dih3y/HxxLOzPN/fv3nznXY7zHbgULu1dcvp0HmBNDt74j3VmPuP9z97cfiA9LArx4+Cp6YziyouLk44eA4ePCg66K1evRpvvPGGELC6O7j27duHdevWCReQx+kug0ajUTi0qMTRKWwFBgZi1KhRQryi8HESTgYPHixEMadTrDsKuQzpvRPEZrFaUVReheOnCrHhSDE+29SMiEAppFoF4oOS0WGRQSW3iHytiLgEt/O01NeLjohqtcK1z2Awu3VEJDrD45X4Ocix1T1ji1BRgLzB6PpOpYYUdN/cZHAJW0RoqI8IkB/gWAfqbekZkY59x8px2NYbpVo/+PkFCzHr9vEJSIiOgFz20w4yapBJeWfkrqPyQlrf84EysmjdSaCcNWuWcG2Fh4eL7w888ADmzZuHO+64Q4xxlqU6Ka+uxRerNqK4vKrKbrf/6Y0nF35uo9pOPEQ/v0XbY7N9g3X6UyLozLqsbdvpTp4MwzAMwzAMwzAMw3SDha2f4S9f6kodH4+f63dbVhYJDp/M/8vfV24/cPTJw7mn7p58yQgFhcs7RRUqRSNdglxbjY2NQgjxOl1yR5DTx9/fH3fffbdr39dff43p06fjyJEjQhCjbovkAquvr8d7770nxK3t27fjqaeewuTJk0V3vePHj4tjU1NT3TKnCJqL08k1/bJL0KRtFW6uU8W9cbi0Att2tCLUsx0mXQDSosNR22xFoI/McRxE6R91ROx+SipFVGvcuweSsKWQuzvIzgY5tswWd51GCFt6nds+KgFtaq5HdLQf7HYJ2kxKGD2TkFOgRMUP7Sirs0ClTkFS/0vROz4G18fHIsDPXUT6KeiZUPA7lQxSqef5iloErT+VklLYP4mXTqcdufTCwsIwYsQIcc7uJY9Udrhy007sPnzMZLVZF1uMtuwlzy3ULnrioR7nf2a5tt7xsUV8+fS8p8UwDMMwDMMwDMMwvytY2LpALH72zxTmfd+C7Jfe/XLVxpd37D8yftqlY5DWu9P9RAIHZTORWEXClE6nE+6sEydO4NtvvxXh8t1L1Y4dOybGU5g8ja2rq0NZWRlGjhzpEktycnLEJznCSNiiYHISVOg8f/zjH+Hr6ys6K57pGCICfH0wfECG2Ch8vbFZi+KKKsdWjZKqGuz4ql7kWYX6yyDReUDtMwQnGzwQqNHDT22E0WjuIWyJrobyn8/Ykp/LsaU3iNyuVp0NDa02aD3ScKKmGYePRKK23RNGmwYRocHoMzpMlH3OjooQ2WJninjngtaUuk1SeL/GMXdaxyVLliA0NFSIi5WVlcJNd75QWShlZ5G4SCIWrX9ra6sQGLs76MwWCzbvPoh1O/ZS58PVsFkfWpS98Ph5X4hhGIZhGIZhGIZhmLPCwtYFZlHWQ4cdHxPmZ7949ZJl3zzbKy465aoJo135WyRmUT4WQd3yaKPMJuc+grrqkcuLcIaNFxUViU6KVNpGlJaWYtCgQaKMjsYTFFJPXRbpnCRqUce+OXPmCIdYSkoKLrvsMvTt29cVTu+EhCHqDkgbdQskrDYbahuaUFVbj+q6RtQ2NmFDbTNatG0wmjqghAFKRQfeXd0Obw8pPNUSVEtScKzZC94dUiikNkgdW63F8WkMwLESs+ikaLYCOp0UDR6DsKE4DnqzQmwVqhQcyfPDsrwWyOUK+Pv6IDjgEqQkBSIsOBCRocEIDQoQnSDPFxINk5OTXd9ra2uF+43KBakDpRMqQXz66aeF8+rPf/7zeZ+fhDE6lkoPac3pHOTYckJrSCH+KzfvRLO29ajNbn1k8RMLV533BRiGYRiGYRiGYRiG+UlY2PqVWJz18Lezs7N/tJeU3/HKu8se75uSFD7lkhGICAlyjSFX1cyZM/Hiiy/im2++wV133SXcU9QZkbopEuTYInbv3i2C5J0ljFSqSILV+vXrhWOLIGdXbGysCJUn2tvbRVni+++/j8OHDwuH0W233YaMjAyR0UUh9OQ0IhHsTKjLI821+3wJCpLXGYxoaW1DS1s7Wtt0aNcboHNsscMSUWsyodxsFo4sGmsLsovj6o5LIZVKoFDIoZTLkTB6PqBWIVijhpdGg+FenvD19oK/rzc0HuqfzcY6GxSu/9JLLyE/Px/l5eVCeKJuk657cpyT1ubVV18Vge9070R8fLxwttE6LVy40OUAq66uFrlZ54JKGek6R48eRZ8+fVz76RkeOVGAHzfvRHVdQ5ljT7a5uuDjJUuWmP/tm2IYhmEYhmEYhmEY5pywsPUrsjwry+T4eGNBdvZHh/NOLcg5UfDggNTeQZeNGeYSjEhoef3114UYQmLTDTfcgIqKCle5odOx9corr2DDhg2uc586dUoIY+TsIvGGjtm1axemTJkifq+pqRH5XFR6R4IOiTgzZswQYtbUqVNFCR0Javfdd5/ImaJSPBpDpYwk9JwLOpePl6fYYs456tfDYrEIIYnC+ClvbMCAAejdu7fYT/dO7qns7GyxFiT86fV6UXZIUEbZnXfeiWXLlgkRkcY4u1XefvvtovSTcstGjx4t9v3rX/8SJZ7kcjsb9IyeeeYZ13fqdHjsZCFWb92F8uq6GsczfUEv0b35XlaW8awnYBiGYRiGYRiGYRjmF8HC1m/AoqysdsfH87dlZy/Zf+zkfYfy8h/o2ycp8LLRQxAdHirGkEuIuihSd0RyY+3du1eEmUdERECtVgvnFW0EOZJIzCFI2CJRjFxbVJZIbiSCnFzkmKLyQ8p92r9/v8iSGj58uLhWVVWVELioLI/Iy8sTmV1UKukUtqj88aGHHhIdA2kOvyU0dyodJEcUlVjSnGg+t956qyixbG5uFu6sd999V6wFrRn9TuIdQfdJ5YF0n0lJSWIfiXIkbpGQeOmll4rfnaWHFAJPXScp/8wpbKlUKiGCnUvYckLOrcN5+Vi3fS8qahyTtktetkva31z0hHjuDMMwDMMwDMMwDMP8SrCw9RvyXlZWi+PjqXmPvvDPQ3kn7zmSl39/n4SY8AkjBsPxKQQnEpauv/561zEkKFGgObmqnHzwwQeYN2+e+NuZxbVx40ZRqujMz1q7dq0Qcr777juRy0UCzuOPPy5cRsXFxUI0Gjx4sBBlHnvsMVGKR+6u7kHs5BKjEkkqyfspF5e4t/feE7lfNN/uW1RUlBCmCgsL0dHRIYSla665BitWrBAZWNTtkXLBKNCdHFgvv/yyKOsjt9mCBQvQ1NSElStXCqHr2muvFZlhDz74oLgmCVbOTpB0/yRMde9CSOO7Q9c2mUwi5D0tLU04uyjMn4QxcnVdd911+Oijj1wZZTt27BBiH2Vnyc5SGtlhMmPf0Vxs3H0A9Y3N5Xa7/R9tesnbH77woK7HYIZhGIZhGIZhGIZhLjgsbP0/sOS5hVrHx/PzsrP/mVdUfNOJotI/RoYG975k6EAMTE+GUuH+WD799FNRckeZWSRQkYOKuigSVKro5+cnyuZWrerMJScRiMoWydl04403ihI9cjA5RR8KmyeXFzmR7r77bkyePNnldHJCwheJSyR0kWD1c8LWhx9+KPLAyAlF5ZQkdP3www9oaGjAa6+9JlxSlBNGjjSCBDkKcKdrk6uMHFg33XSTuC6VA9LvJGg9+eST4h5pH8377bffdl2TxtN+go5vbGwU90Vzpk/qJEnlhiTe0f2ROEXfKXT/xx9/FJ8kEJK7jdaG8scWL14sBC+aBwlhlHV2ZtdFyhfbvv8IdhzMQZtOf8xxqVcMkvZl7z3BJYcMwzAMwzAMwzAM81vCwtb/I0uysvT0MX589ju2sbYrPl2x+v7v1m+9ZPiADMmIzAwE+fuJcZSHRVAe1D333CMcRyRkUT4W7UtPTxfiE+VjEeQyohK8SZMmidysm2++2ZUzRezbt0+INSSOUQkjCU9nQgH2WVlZQniic/8cJB5RaSCVUBI0p7Fjx4r59u/fHyNHjhTCFLnECHJykTBF4hrdA5VFUt4YlUySs4zyv/z9/cW9EiSyEc7wfILEKGcXQiqzJDGK7pscbh9//LFwnNFx5LwiSKiiOTlzyCgfizK36D7pk8RAmjfN7ZFHHhHndEJCWUFphRC0jp4osFms1nU2u/W1NyWGNbYnsmw/u0AMwzAMwzAMwzAMw1xwWNi6CNi4Mcvi+PiWtvnZL/ddt2PvvRt27ZvTJz7WZ/jADKT3ToBC3vmoSHihrTvkbiL3kfz0mDVr1gjhitxTBAXDU1YUOZ8oPJ7EI+qeSG4tcldRGR91THRCzjAKaCfBJyAgQITa/xyUfUWlgAaDQXx3ZnVRThhBZYkU8E5uMickXNE+ggQrKguknCwSpCZOnCicXE6c48gBRqWDJGCREHXs2DHRDZKuQ64wcl+RkEeiGZUb0rpUVlaKY0l8ozB5J1S2SYIfrQeJb1SKSGWO3csZW9t12J+Th10Hc1DT0NTs2PWx3WpbsujJh/Po98U/uzIMwzAMwzAMwzAMw/xasLB1kbE468Gjjo95t2VnP5JXUDI7r7DkDm9PzaABaX0wuG8q4iLDehxDDifKjiKeeuop4cAitxEJTURubq4YQ3lUJO6Qc4qyqqhr4P333y9KBrsLW1RGSOWN27ZtE5/n49iiMj7CaOysxiMhy+kKIyiInfK0ugtbNMY5b3JtkXhFTjQquyShjNxk5JQiSIhz3gs50+g4cmhROSO5s2j+dL90PAlbREZGhhDPtm7dKnK9KOeLQubJxUZh8eQQI4GM8rS6Y3bMIze/GHuP5iK3oNhusVh32ux4VyJp/+J0IwCGYRiGYRiGYRiGYS4CWNi6SDkdNP+WVCp9+56sFzP2bFj+xM5dEdMDQqIxMK2P2MKCA4V45CzXI0hIuuuuu4QLi8rpKCh+y5YtIm+LhCTqfqjVaoV4RGITuboom4sEJ8qgIsGInFBU5khuKBLCzsex5cQpbJFjqzt0rTMdW7SPAuWd0L2QIPf++++LcsE77rhDlGHSHCgjjMQvui/aTx0kKVyeXGUFBQXC8UXli7fffjveeust4Uaj8SkpKSKUnqCw+gceeEC41ggKzHdiccyLSg0PHjtBpYboaKuFzFD9lVnT+69OdxbDMAzDMAzDMAzDMBcXLGxd5NhsNrIsHX12rp9p5JSpCEwOw6HCQ3h1z174+PijX3IvZPRJRExEqCvknMQhcmTRRqIQiVn0GwWnk9hFf9fU1IixlDn1+eef4/Dhw8LJtHz5cpF3RYIXbXv27HEFtJ8PVIpIpXwkKnWHRCyiu5BF+1paWlzf6ThyaFE2GAlQ1J2QShP/8Ic/iHuiUkXqpkhdGsPDw4VQR+WOzs6I5PKi+33iiSeEC83b2xvjx4/Ho48+Kn6n7o/dMZstOFlcKoSsnFNFsJu0SA2ux+zkWjSX5DruvVjx6KfNLGoxDMMwDMMwDMMwzEUKC1v/BWTP9YrQKDVX9xs2BJ7eCvSJVsAyGiio6sC2/RuwYct6ePmGIaVXPNKS4tErLhoaD7U4lsQiyppyQu4t6iBIYhd1DVy9ejWCgoLwt7/9TQhIJAJRTpUTEpQqKipEGSFlUv0c5Ngi59eZY0lkIsgt5gxlJ3eYMzuLcDrGSPB69tlnsXnzZhw6dEg4rsiRRUIX5WFRfhaVH9KcSKSjkkMn5NgigYuuQyWG3fOySDRrbGnFicISHM8vxqmSMtiNzUj0rcWsXm2I82uBTNJZ+hiWHIwDB0qnPDNbE//Ycn3xeT8shmEYhmEYhmEYhmF+M1jY+i9ACfldvTIyVJ6nxSFCLgOSoxU4vmoV5sQCHsEJONV4HCvzA9Bg8ENUWCj6JMQiKS4K8VHhUHYTmih3ytlBkRxQJC5RuSHlV1EZ448//ojk5GQsXrwYS5cuFWITZVdRh0OnK+xckGPrbMIWucHo2E2bNonwd4JC7m+55Ra3Y0l4o9B4cmN98sknoosi5WCRM4tcWuQgo46NCxcuREREBD788EMRnt8dErPoHok2nR75JeViO1VchobmFkQFyZASI8fEKz3QVpaPY1tXI3FQqts5PNQKJCYGyU+cqLvX8fXh83tSDMMwDMMwDMMwDMP8lrCwdZGTPU2qUXj63p05ZnSP3+oqK9FcXYqk0QMglWoR7avFhIQi7Nhfj+LqeDR7jcJnR/ZAq5MIoSs+OkKIXDERYfD39XaJVNRNMSkpSWyUxeXk3nvvxcyZM0WGFQXIk+Ppp4QtCp0nJxUJYVQOSC4wp1OrT58+Iqj+oYceQk5OjnB20XWdbrKVK1eKsHq6FjmtKFsrNTVVCG9RUVGua1BAPAXhnw3KyaptaEJpZQ2Ky6tQVF4JamQY4KFHvF8LAuuPY2hcIMZNmeA6xhbQF7vWrkFjo85xbk+38/VNj8DJk3W3Z0+VPpW10tb6c8+KYRiGYRiGYRiGYZjfFha2LnKUXt5zI+Pjw8JiYnr8tnvdevTvHwmp1F1sKi8sx4hJ/ZExVANqKqjV2VBco0VBRS0+3vw9bB5h8PT0QmRoMCLDQsRneEgQQgL8IScr2GlIxAoLCxPbqFGjfnaulOk1Y8YM4bzS6/XCddUdKiW88cYbRYh7QkKCEK+cQhmFxVO215lMmDChxz66J2NHB2rqG1FV14Cq2nqU19Sh2vG31WqGVFeFjFgTxoW1I6aPFj6qzlyvQnkL9h0pwiWTx7uuK5XJMGT8OOzftwGTJia7XSconYRRCgAAFZxJREFUyBOREb7+lTb7rY6vr/3sAjAMwzAMwzAMwzAM85vCwtZFzOzZUll/ue+Dg8dd0uO36rIy1JcXYNzQ/m77a2vb0KazoNfp3CnSb/y8pBiQpIS/tQSG3ctx1WUDUNvuhao2b+zbasFhr3jorBp0WCQI8PVFaJA/ggL8EOjniyB/P/j7eMPX2xMeHmrIumVWnQl1QqTNz8/vrL+TmEQlibSd7bfuULB7u8GAltY2NGvb0NTSivqmZsfWIj61be3wkJvhJdVC2tGCMWP7ImqIGmEBGnz99mdIUcuQEBLods6YGH9s2VaIqtJSRMbFufanDR6M/Zs3o66uHSEhXm7H9OsXicoq7R+yZ0vfzFpuM53z5hmGYRiGYRiGYRiG+c1hYesipq/Ue1pgaGhyQqp7/hNZlras+B7Dhsb2cGvlnahFQmoK1BpNj/MV5+UiJtofCqkNUT6tiPTW4uTmA5g5bwECwvzQqrehvsWM9au+QUOtBjUKf7QY1WKz2OSQyRXw9PCAt5cGnhoPx99qaNRqqFVKqBwb5Xgp5HLHJhM5V7QJwcoxX5tjo1JGKhe0WKxCuOowmWCkrcMEncEIvcGAdp0BrTodjEYTbDYrVArA31sqNo3EAEPuVkwfEYAgjR5eShPa2wz4esUJDO49UGR7EfHJySjL34uEeHdhS6GQIT4uAMf27HETtmieY664Ajt//BJXX5XhdkxMtB8CAzzjGhrtsx1fP/7PnybDMAzDMAzDMAzDMBcaFrYuUrKlUqlyjs+jVCYnPcMldXz/AcitLYiLTXHbbzSakV9Qj2m3XYUzsZjNyDt0CFdMSnLta2rSwy5VISg8XDi7/L2k8FJaIKnYiOmzMqBUVnSd2yJHu0mJtg4FflhXhqQxk6BUBcBgtKOlzY68w8fhF+AJuVINq00Kq10Cu2Nr15kBmQo+fj6QOi5C2pNcJoHVpEdtSQH6JPpCLbciUGFGgEmHQ4dP4dqbrkFIkDe8PSRQK7uEO5tNg3f25CJU2QueKqXY5+OjhtJxfE1ZGSLj48W+3n0zsHf9GpjNViFmdSc5ORQrVx3G6KlXQOPVlamVmJqGo7v34OSpOvTpHeLaT8IclXtu2Hjqz7NnS5cuX26znvdDZBiGYRiGYRiGYRjmV4WFrYsU+bU+l/sGBg1KPqPjX7tWi11rfsSVk3v1OOZoTjW8fP0Re7rrYHcO79iJAB+ZW0B6cXEjElNT3coAi/NOICJUA6XSXRBSyy1ig0EHpTYXE4ZcB7VHZ4aW1WLBolVf4+rBqQg6I4B9774ySH2TMPbKK9z2tzR24N0dX2PKxKGua1mtNuRvPQl5WzGCE91LLAkS+Hr364/ColL0zYhw7Y+LDUR+To5L2PINDERM7xTkHKvGwAFRbucIC/WGj5cCB7dtxajJk7t+cCzBhJkz8Pmi1xAV6QdPT6Xrp6TEIOzfX5bWr9V2tePrVz0mxjAMwzAMwzAMwzDM/wssbF2EdLq1fP9Kbi1neR1hs9mw+rPPMHhgGLy8VG7H6HQm5ByrwojJU3s4vEgM27N+PSZ3c2tRAPvJ/HpMmuse2H58/z6kJofgXBQVNSAwLAxqDw/XvtbmZlgtZvj6qM953Jl4+/pCrlCgpcXgyrWSyaQIDvbCycNH0Kd/T2GLSB8yGD++f8BN2CLhac2GQxgzdaoIgydGTr4cy/75qnBfdRepSMTLSA/Hzq3b0G/ECDEPJz5+fhg9dRo2bf4BUyendAXMSyUY0D8Km7YWPOZ4Nt9k0YNgGIZhGIZhGIZhGOb/HRa2LkLIreUT4D8sffBgt/07Vq2Cv4cOSYlxPY7ZvrMYkMjRd9gwt/2Ua7Xuy6+QGO+L0BBv1/6ysibIVN6ITkr8v/buPDqqKs8D+LdeVVZSVVnIWgkJ2SEbAZKwJUqCqCwu2KQITGs7yrQzythn9A8R2piRxe4ee1plWu12WkdMIICKbZDFgEAgCYQshGyELJB9ry1Lre/Ne5W1SPS0Z0aNM7/POe+8U/e+++59L/nrd3739ybahACVqqsFipWxM65LyKiqq+tBxNIkm/aejg7IpI7Ttv19G7FEAncvT/T1D9kUbFf4yVFWUQ2dSg2p2/Qi9HN9fOAg87Qp9C4Ew5wcWNRXViIyPt7a5u7lhfjke3Cx4BoeuH8BptamDw/3RPHV2/j6s+N46IknrNla4yLiF6G7vQ0l1xqRmBBgM6asvDVerZQKWVuf/s0PSgghhBBCCCGEkO8NBbZmGYZhRHszZK8mpaZZgz/jKosKoWmvxr0pIdPGVFd3CZlUXGB4uMjewTaTS9iCqOpoxupHJ4NVQrCrtKwNS1LW2mR3XS8qsmZr3f2FwnFV/DxDw0YEhUfYtHfeaYGXt3TGMdb5viHByTcwCD09DVi4wHuiLcDfFddKW1F45jTuVypnHBefnIwbhSeR5jW6HVNY7qJYBYrzzyI8NnYiaytpzRrk3qxHdU0noqN8J8YLmWG+PnIhEMZVFBaKFq1cYXP/5PXrcSb3CGpv9mFBxNyJMfHx/jh/ofGVLIY5TllbhBBCCCGEEELIj48CW7PMa1tkG+XuHgnClrtxNSVX0N941RrUujvo1NTcj0uFjSqAa5y/IHLp1L725mYUC/W4Niy0yaaqr+/F4AgQk5Q40WbQ63Gr/Bo2PWxbkH7cgGoYJddaODt7e5F/SLBNX1tjIxaGymccZzCYwTGDM/YFhofh/CelNm2enlI4Odqh6moJQqKiEBodPW2c0FZ0+jR0OgOk0tFAXkiIB0rLWq3BufhVq6xtwjbOjY8/jsMH3rbW/vLxkU3cIyDAVagxVv318eNec6RSr7DYya8hCu94bfpmXDp1CreauhAWPJo5JmxrLCtvj9Mq8Rj/8+iMD0UIIYQQQgghhJAfDAW2ZhGlkhHHSeSvJKWNZ2txaLpeDImuDokJ86ZdX13ThUuXm9RmE9IlduIjYTGTwRlhW+GX2R8jLTUUbq6T9bB0gwZcLmpGSHScTUZYWUEBIsPcZtxOqNebcep0HWsyWr4OiY5Im5oVNqTTob+7C4Gp8TM+k0o1DLOma8Y+oci93shBrRmBq3x0jWKxCPPmuaGuvufGyZxD0Vv/eYdIqOk1lZBllpi2BmWl+bhnLINNCEbNn++BghNf8veNsG5zFEhd5XjoF7/Aif/6C9Y9EAbpWG2yoEB3XBI3hZgsxg15Bw8eTt20yTNu+eQ2ThE/R/K6dbhTX4/OgZvwdTNZs7YWxytw/mLjr7NSmc8yz7HmGR+MEEIIIYQQQgghPwgKbM0icRLpI24eHkuiEhPAsSYYOkvh7dgJKGyzoQYHDSgsuo3Gpr56sJbHRCImThEc7CZ3d7f264eH8dcPP8CqZX7WmlXjjEYLTp+us2ZRhUQtnGgf0mpxq+wKHt4QOW1NZjOLU2dqodGMvML/XCNs9ZuqqaYW8wLkcHS0mzbWaLKgp3fQxLKDliGdznGO1Ha7ohAgE75yePt2NxbFKSbag4M9cLO+R6vX6//90/f/81+27HjOpsi7IDJ+ESouX8LAwDDc3Z2tbUFB7kLWFvf5Bx+IhDFOzqPt3v7+eODvnsDZY9l48L5QODhIrAXl/RWuTrdbVBEjBsuKM0eOHmupr49b/cjDcJkylxB847gwWHQdMHaXISLcG+Xl7TEaYDPffWjaQxNCCCGEEEIIIeQHQ4GtWWLsS4ivCHWhYBjASFcZONOQzTVCZpNQT6u2rttkMloOGDWaV7NOQrc3Q/Z+/MqV1mtMRiNO5XyMpHh3+PlObr0TglonT9Wgt2+w1dHJKSB4weSWw4t5eUhc4guJxPZrikKx+NNf1aGzU/MOZzB9bOcy59W7twbWlpUiIVaBmTQ39QvBra9EgL6uvHzTkpSUadcsvfce5P3lHcTx9xjfZSnU2XJwkCwb0ZmeVPf3K469954y/Zl/xBzZZGBMyNBKfXQTLhz7EOseGC0O7zl3DtzcnNHf1V3w6Z/+nLzpH7ZPBLf8AgNx35YncOnEUaSsUFgz06KifNDSqnoWvZo/93tied31ipea6+pejF22zFmou+U6d+7EXBKZAoyTK4z832WxUGvrYsMrSiVzJDeXtXzrH5YQQgghhBBCCCHfGwpszRISpfQRV3dZbKiCg761wBpUGh42YWBgCF3dOrS0qtHXp+vnL80xGkV/yDyqahLG2W9zXe/h7ZMUGhMNs8mEwrxjSIxzgVzmOHFvtXoEZ/Jvor9/6ATHcYMLly5R2o1tJ2y4UQWJqQsBAUE26xG2HwpBrY4O9TsVZu2ORQ7yl0KjoiQOTpPbGns7OuAo0sLLyxt3Y1kO5dfbORHwBwtYY+mFi4/GLV8uktjZZnZ5eHtDER7Lz6OBYiwzTdjyFxoyV1xV05VhMmse7++C6NCBA+mPPvUUf73XxFhvfwWCF61CVXUVYqJ9rQGoqIU+okuXG2903GmpO/TW29sfeuJxzPUdLRzvpVAgVfkkKr7+AjFhjgic5y7U3orq45D+Ro4qh78kc//PpO+WnD//3LWLFx/38ff3nx8ZCb+gIP4ePnCWSuEYkIwYF39UVB2MjBtAOihrixBCCCGEEEII+dFQYGsWEGprLRLLdxlGRnDowzwYDRZhu6DFZLao+O5qjkOJiEV+H6e9+EYuOzI+LkvJ2NuL5b9LXr9O+NQhWq+fxaJIe0jEo5lXQnBJqMN15eodoT7Wm0YTDjg6iqsWj2VOqft60VR2DssTA23W09MziPxzNy1qjf7V3Ye0ezdvhnDDv49JSrK5rvLyBaxYFjTjM1VWdWBANXSaH58v/N6bweQVf5W/cdW6B6ddm8Kv/+zhD+DnJ5/I2oqM9BbW/mQNP3Rhp3abihN15bz11o77fvaYKDJ+sp7X0ntSUHBCi55eFbw8XRAZ4SV8VfHnWrU+dKC7uzb7zbf2LV+71nFJSrK1ppiwzXDFxgy015XCDe1ISgrEiS9r9vHv8q+ZuezgzmO6Tv62u55JYF61mNilXS2tayBCAr+uaDt7B4Wjs5OdvaOTSMiA4+3MSmWOUq0tQgghhBBCCCHkx0GBrVnAZxASzpV9fnjYyA7qTAYLoNFD07s/l9V82zh7sfxfw2JjFgRHhsLYUQgv6TDfylizvRoa+1Be3gaVeqSOtWDHrsOq/H3b3N6IjI93cvXwgMWgQW9tPlYkKSa+tCjU3irjx1RWdrSaWe7pXTmqMy9nA3u3uq539/IKnhcWOjF3W0M9QvzMcHKaM21dQoZZSUlLPwymZ1ghusbbt3XOs1fPnVuuCJ4/V8iCsnkOR0ckrXsMbdVfIcBvNCNMCFJ5e0mDYnvYjbvOaY7zTc/vy3C9mnfw47frysvdUjZsAL8mYZ8gkjdsRMvNGv6/uQ12GERsjK/0ytU7O3bmqH+9RynLv5iXd6CyuCglMTUNCxbHw87eHgFRiWBH+hFodxWhoT2Bt27h9wzD/HJ8ve+WsCb+VDR2WAmBxMGhOe5gxDIxyzqA4Rh4wnb/JiGEEEIIIYQQQn4wFNiaBd48wRr406XvMmb/Nrd0mbvbi6nrVkF/5xyMI6NbFpub+9HEHyMjphqWY39vtugOZuayxiylm7ujPfN0YmoqLIOdMHReg5/X6HZE4UuJtbXdQobUCD/uP0x6zd7MT1m10McwjGhvhvwFIeNJ+FKgwDCkhkR3A25zpwe1+geGcep0rd5oYLfsOjZ0Z7z95Zyh1v1bZVvyPjqYt2n7046K+fNtxglBKjvJ/TD1XIGdyGBti431Q3e+7gV+DZ8LAaeXD6mz9yldzjdUVb/eXFuXER4bK45buQLCveZFLARnCYOh6xqiosy4XtnxXNYm5g3+OW5kMczqgXTugTNHjrxYkJd3T1hsLBMaHQX/4GA4BaVi9YNS9PaefPq1LSjnp33nm9658B75U9fYQQghhBBCCCGEkB8ZBbZ+goSgFn/6yFfhIb7w+adC7Szh64CcxWJp5NtPcuCOmA7pCjNZlh0fYy/BL4MXRMpkkl5omutGa3d1adHSouLPulaWYz/izOZ3Xs4dbJ8612sZLqtd5LLkqIQE629Wr4alsxBSZ9G0dbW1a/BVft3w8LBJueuwOv/u/p052rP7trimH3vvT4fvV6Y7T91SKJC6zwUnS4O+vdA6T0iwB0pcnVa+lo40vtt6v7H1/XyPUvbb2vLyX/HHZpm7m3R+RKQ1UOWpmA9nLykWLux0LS83PcVf+8bYe/hSOLIyXMOvFxenVxYXrxeLxYs9fHzsvfz84DcvQKTR3Hp7/1Y3ZtdhzR/HM7cIIYQQQgghhBAye1Fg6ydkNHtK9hwH0XYRUFh3o6ENIjSAY28A5mumwyPtE8Gs7Mlxz69nHHxc5c923mnC+282GPV6U5/FwlbxXYWsBWcsvdqSmepEWWt/SWSvL1tzn7Xou1nXDkNXKXDXpSaTBaVlraiobG82m6HcfUhd8k3P8PJh9Rd7trqmnvg4O/f2zZuBwpZCZxeXiX6RxBFOASnWeYT5EpfOE53Jr9vPr+XrqV8g3J2r5Z8ZT730KPMrDuza64VFayuKipbz7yVULBY7ia11xkT/lJXKvDn12TIPqev50x7hyFrPyLpNpkXdbe2x/O8wkQjz+Pe5bU+GdE4Ww/zb1MAgIYQQQgghhBBCZh8KbP2EjGURvT12TJcz8zh3CcRgzQ/p1BqVeVDfn3mC1f4t88VK5E97+vomxCQugbG7AiZ1k02/2WxB3c1elFe0mQd1+veNeu3O8S2M32Z3jvpKltJtcdXVkt80VFU/uSQlRRy3YvlkgIuRwMEvEQw/X4ioCn7VnUu5DtF2vufdu+/1+mesjj99MnbgBSXj5M7J/Ywmk48IIrcROYSiXbqZ1jH2Hi6OHbayp7UQQgghhBBCCCFklqHA1v8DmZ+zQlX5su8yZs82WZSd2P53aRvuhbH1AljToLVdrzejq1uL27cH0NTUP2Iwmj+xwPL67hxt9XdaU65qgD9t37NN+sfLp07tvHL27MPzF0Tah0ZFIyAkBFJXOexcQyB29sLq+x1wJPvsb/k1FezO/vZ5xr4a2Th2EEIIIYQQQggh5P8wCmyRabI2uwXb24u/kEkdpTXFF2A0WjA8bIRGOwKdztDHslwhx+GEyWA5nvmJtud/MtfubJ1QsD19n9JFUX+98rFblZUbIGKWzXFxkco9POAil8HewQEuMpnU1K/+Yq/SOW1X7nDz/9KjEkIIIYQQQggh5CeMAltkGrEdq2A57FWphpz4wwyO03EM22k2WxpwdKTt+6g9NVYU/i3heCaBsQsItYTqtNowiES+DMvJwIgk/Dr0DGMfyV9DgS1CCCGEEEIIIYRQYItMtztHU8CfCmbszP3+53+3hDXxp9qxgxBCCCGEEEIIIWRG/w1xOakSw1vUqAAAAABJRU5ErkJggg==" xlink:href="data:image/png;base64,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" id="svg_5" height="175.99999" width="459.00005" y="-25" x="1.99998"/>
											 </g>
											</svg>
                                        </div>
                                        <div class="text-center">
                                            <h1 class="card-title"><?php echo APP_TITLE; ?></h1>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <label for="fm_usr"><?php echo lng('Username'); ?></label>
                                        <input type="text" class="form-control" id="fm_usr" name="fm_usr" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="fm_pwd"><?php echo lng('Password'); ?></label>
                                        <input type="password" class="form-control" id="fm_pwd" name="fm_pwd" required>
                                    </div>

                                    <div class="form-group">
                                        <?php fm_show_message(); ?>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block mt-4" role="button">
                                            <?php echo lng('Login'); ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="footer text-center">
                            &mdash;&mdash; &copy;
                            <a href="https://www.instagram.com/ki_sumbar/?hl=en" target="_blank" class="text-muted" data-version="<?php echo VERSION; ?>">IT Team@Komisi Informasi Sumatera Barat</a> &mdash;&mdash;
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        fm_show_footer_login();
        exit;
    }
}

// update root path
if ($use_auth && isset($_SESSION[FM_SESSION_ID]['logged'])) {
    $root_path = isset($directories_users[$_SESSION[FM_SESSION_ID]['logged']]) ? $directories_users[$_SESSION[FM_SESSION_ID]['logged']] : $root_path;
}

// clean and check $root_path
$root_path = rtrim($root_path, '\\/');
$root_path = str_replace('\\', '/', $root_path);
if (!@is_dir($root_path)) {
    echo "<h1>".lng('Root path')." \"{$root_path}\" ".lng('not found!')." </h1>";
    exit;
}

defined('FM_SHOW_HIDDEN') || define('FM_SHOW_HIDDEN', $show_hidden_files);
defined('FM_ROOT_PATH') || define('FM_ROOT_PATH', $root_path);
defined('FM_LANG') || define('FM_LANG', $lang);
defined('FM_FILE_EXTENSION') || define('FM_FILE_EXTENSION', $allowed_file_extensions);
defined('FM_UPLOAD_EXTENSION') || define('FM_UPLOAD_EXTENSION', $allowed_upload_extensions);
defined('FM_EXCLUDE_ITEMS') || define('FM_EXCLUDE_ITEMS', (version_compare(PHP_VERSION, '7.0.0', '<') ? serialize($exclude_items) : $exclude_items));
defined('FM_DOC_VIEWER') || define('FM_DOC_VIEWER', $online_viewer);
define('FM_READONLY', $use_auth && !empty($readonly_users) && isset($_SESSION[FM_SESSION_ID]['logged']) && in_array($_SESSION[FM_SESSION_ID]['logged'], $readonly_users));
define('FM_IS_WIN', DIRECTORY_SEPARATOR == '\\');

// always use ?p=
if (!isset($_GET['p']) && empty($_FILES)) {
    fm_redirect(FM_SELF_URL . '?p=');
}

// get path
$p = isset($_GET['p']) ? $_GET['p'] : (isset($_POST['p']) ? $_POST['p'] : '');

// clean path
$p = fm_clean_path($p);

// for ajax request - save
$input = file_get_contents('php://input');
$_POST = (strpos($input, 'ajax') != FALSE && strpos($input, 'save') != FALSE) ? json_decode($input, true) : $_POST;

// instead globals vars
define('FM_PATH', $p);
define('FM_USE_AUTH', $use_auth);
define('FM_EDIT_FILE', $edit_files);
defined('FM_ICONV_INPUT_ENC') || define('FM_ICONV_INPUT_ENC', $iconv_input_encoding);
defined('FM_USE_HIGHLIGHTJS') || define('FM_USE_HIGHLIGHTJS', $use_highlightjs);
defined('FM_HIGHLIGHTJS_STYLE') || define('FM_HIGHLIGHTJS_STYLE', $highlightjs_style);
defined('FM_DATETIME_FORMAT') || define('FM_DATETIME_FORMAT', $datetime_format);

unset($p, $use_auth, $iconv_input_encoding, $use_highlightjs, $highlightjs_style);

/*************************** ACTIONS ***************************/

// AJAX Request
if (isset($_POST['ajax']) && !FM_READONLY) {

    // save
    if (isset($_POST['type']) && $_POST['type'] == "save") {
        // get current path
        $path = FM_ROOT_PATH;
        if (FM_PATH != '') {
            $path .= '/' . FM_PATH;
        }
        // check path
        if (!is_dir($path)) {
            fm_redirect(FM_SELF_URL . '?p=');
        }
        $file = $_GET['edit'];
        $file = fm_clean_path($file);
        $file = str_replace('/', '', $file);
        if ($file == '' || !is_file($path . '/' . $file)) {
            fm_set_msg(lng('File not found'), 'error');
            fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
        }
        header('X-XSS-Protection:0');
        $file_path = $path . '/' . $file;

        $writedata = $_POST['content'];
        $fd = fopen($file_path, "w");
        $write_results = @fwrite($fd, $writedata);
        fclose($fd);
        if ($write_results === false){
            header("HTTP/1.1 500 Internal Server Error");
            die("Could Not Write File! - Check Permissions / Ownership");
        }
        die(true);
    }

    //search : get list of files from the current folder
    if(isset($_POST['type']) && $_POST['type']=="search") {
        $dir = FM_ROOT_PATH;
        $response = scan(fm_clean_path($_POST['path']), $_POST['content']);
        echo json_encode($response);
        exit();
    }

    // backup files
    if (isset($_POST['type']) && $_POST['type'] == "backup" && !empty($_POST['file'])) {
        $fileName = $_POST['file'];
        $fullPath = FM_ROOT_PATH . '/';
        if (!empty($_POST['path'])) {
            $relativeDirPath = fm_clean_path($_POST['path']);
            $fullPath .= "{$relativeDirPath}/";
        }
        $date = date("dMy-His");
        $newFileName = "{$fileName}-{$date}.bak";
        $fullyQualifiedFileName = $fullPath . $fileName;
        try {
            if (!file_exists($fullyQualifiedFileName)) {
                throw new Exception("File {$fileName} not found");
            }
            if (copy($fullyQualifiedFileName, $fullPath . $newFileName)) {
                echo "Backup {$newFileName} created";
            } else {
                throw new Exception("Could not copy file {$fileName}");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Save Config
    if (isset($_POST['type']) && $_POST['type'] == "settings") {
        global $cfg, $lang, $report_errors, $show_hidden_files, $lang_list, $hide_Cols, $calc_folder, $theme;
        $newLng = $_POST['js-language'];
        fm_get_translations([]);
        if (!array_key_exists($newLng, $lang_list)) {
            $newLng = 'en';
        }

        $erp = isset($_POST['js-error-report']) && $_POST['js-error-report'] == "true" ? true : false;
        $shf = isset($_POST['js-show-hidden']) && $_POST['js-show-hidden'] == "true" ? true : false;
        $hco = isset($_POST['js-hide-cols']) && $_POST['js-hide-cols'] == "true" ? true : false;
        $caf = isset($_POST['js-calc-folder']) && $_POST['js-calc-folder'] == "true" ? true : false;
        $te3 = $_POST['js-theme-3'];

        if ($cfg->data['lang'] != $newLng) {
            $cfg->data['lang'] = $newLng;
            $lang = $newLng;
        }
        if ($cfg->data['error_reporting'] != $erp) {
            $cfg->data['error_reporting'] = $erp;
            $report_errors = $erp;
        }
        if ($cfg->data['show_hidden'] != $shf) {
            $cfg->data['show_hidden'] = $shf;
            $show_hidden_files = $shf;
        }
        if ($cfg->data['show_hidden'] != $shf) {
            $cfg->data['show_hidden'] = $shf;
            $show_hidden_files = $shf;
        }
        if ($cfg->data['hide_Cols'] != $hco) {
            $cfg->data['hide_Cols'] = $hco;
            $hide_Cols = $hco;
        }
        if ($cfg->data['calc_folder'] != $caf) {
            $cfg->data['calc_folder'] = $caf;
            $calc_folder = $caf;
        }
        if ($cfg->data['theme'] != $te3) {
            $cfg->data['theme'] = $te3;
            $theme = $te3;
        }
        $cfg->save();
        echo true;
    }

    // new password hash
    if (isset($_POST['type']) && $_POST['type'] == "pwdhash") {
        $res = isset($_POST['inputPassword2']) && !empty($_POST['inputPassword2']) ? password_hash($_POST['inputPassword2'], PASSWORD_DEFAULT) : '';
        echo $res;
    }

    //upload using url
    if(isset($_POST['type']) && $_POST['type'] == "upload" && !empty($_REQUEST["uploadurl"])) {
        $path = FM_ROOT_PATH;
        if (FM_PATH != '') {
            $path .= '/' . FM_PATH;
        }

         function event_callback ($message) {
            global $callback;
            echo json_encode($message);
        }

        function get_file_path () {
            global $path, $fileinfo, $temp_file;
            return $path."/".basename($fileinfo->name);
        }

        $url = !empty($_REQUEST["uploadurl"]) && preg_match("|^http(s)?://.+$|", stripslashes($_REQUEST["uploadurl"])) ? stripslashes($_REQUEST["uploadurl"]) : null;

        //prevent 127.* domain and known ports
        $domain = parse_url($url, PHP_URL_HOST);
        $port = parse_url($url, PHP_URL_PORT);
        $knownPorts = [22, 23, 25, 3306];

        if (preg_match("/^localhost$|^127(?:\.[0-9]+){0,2}\.[0-9]+$|^(?:0*\:)*?:?0*1$/i", $domain) || in_array($port, $knownPorts)) {
            $err = array("message" => "URL is not allowed");
            event_callback(array("fail" => $err));
            exit();
        }

        $use_curl = false;
        $temp_file = tempnam(sys_get_temp_dir(), "upload-");
        $fileinfo = new stdClass();
        $fileinfo->name = trim(basename($url), ".\x00..\x20");

        $allowed = (FM_UPLOAD_EXTENSION) ? explode(',', FM_UPLOAD_EXTENSION) : false;
        $ext = strtolower(pathinfo($fileinfo->name, PATHINFO_EXTENSION));
        $isFileAllowed = ($allowed) ? in_array($ext, $allowed) : true;

        $err = false;

        if(!$isFileAllowed) {
            $err = array("message" => "File extension is not allowed");
            event_callback(array("fail" => $err));
            exit();
        }

        if (!$url) {
            $success = false;
        } else if ($use_curl) {
            @$fp = fopen($temp_file, "w");
            @$ch = curl_init($url);
            curl_setopt($ch, CURLOPT_NOPROGRESS, false );
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            @$success = curl_exec($ch);
            $curl_info = curl_getinfo($ch);
            if (!$success) {
                $err = array("message" => curl_error($ch));
            }
            @curl_close($ch);
            fclose($fp);
            $fileinfo->size = $curl_info["size_download"];
            $fileinfo->type = $curl_info["content_type"];
        } else {
            $ctx = stream_context_create();
            @$success = copy($url, $temp_file, $ctx);
            if (!$success) {
                $err = error_get_last();
            }
        }

        if ($success) {
            $success = rename($temp_file, get_file_path());
        }

        if ($success) {
            event_callback(array("done" => $fileinfo));
        } else {
            unlink($temp_file);
            if (!$err) {
                $err = array("message" => "Invalid url parameter");
            }
            event_callback(array("fail" => $err));
        }
    }

    exit();
}

// Delete file / folder
if (isset($_GET['del']) && !FM_READONLY) {
    $del = str_replace( '/', '', fm_clean_path( $_GET['del'] ) );
    if ($del != '' && $del != '..' && $del != '.') {
        $path = FM_ROOT_PATH;
        if (FM_PATH != '') {
            $path .= '/' . FM_PATH;
        }
        $is_dir = is_dir($path . '/' . $del);
        if (fm_rdelete($path . '/' . $del)) {
            $msg = $is_dir ? lng('Folder').' <b>%s</b> '.lng('Deleted') : lng('File').' <b>%s</b> '.lng('Deleted');
            fm_set_msg(sprintf($msg, fm_enc($del)));
        } else {
            $msg = $is_dir ? lng('Folder').' <b>%s</b> '.lng('not deleted') : lng('File').' <b>%s</b> '.lng('not deleted');
            fm_set_msg(sprintf($msg, fm_enc($del)), 'error');
        }
    } else {
        fm_set_msg(lng('Invalid file or folder name'), 'error');
    }
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Create folder
if (isset($_GET['new']) && isset($_GET['type']) && !FM_READONLY) {
    $type = $_GET['type'];
    $new = str_replace( '/', '', fm_clean_path( strip_tags( $_GET['new'] ) ) );
    if (fm_isvalid_filename($new) && $new != '' && $new != '..' && $new != '.') {
        $path = FM_ROOT_PATH;
        if (FM_PATH != '') {
            $path .= '/' . FM_PATH;
        }
        if ($_GET['type'] == "file") {
            if (!file_exists($path . '/' . $new)) {
                if(fm_is_valid_ext($new)) {
                    @fopen($path . '/' . $new, 'w') or die('Cannot open file:  ' . $new);
                    fm_set_msg(sprintf(lng('File').' <b>%s</b> '.lng('Created'), fm_enc($new)));
                } else {
                    fm_set_msg(lng('File extension is not allowed'), 'error');
                }
            } else {
                fm_set_msg(sprintf(lng('File').' <b>%s</b> '.lng('already exists'), fm_enc($new)), 'alert');
            }
        } else {
            if (fm_mkdir($path . '/' . $new, false) === true) {
                fm_set_msg(sprintf(lng('Folder').' <b>%s</b> '.lng('Created'), $new));
            } elseif (fm_mkdir($path . '/' . $new, false) === $path . '/' . $new) {
                fm_set_msg(sprintf(lng('Folder').' <b>%s</b> '.lng('already exists'), fm_enc($new)), 'alert');
            } else {
                fm_set_msg(sprintf(lng('Folder').' <b>%s</b> '.lng('not created'), fm_enc($new)), 'error');
            }
        }
    } else {
        fm_set_msg(lng('Invalid characters in file or folder name'), 'error');
    }
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Copy folder / file
if (isset($_GET['copy'], $_GET['finish']) && !FM_READONLY) {
    // from
    $copy = $_GET['copy'];
    $copy = fm_clean_path($copy);
    // empty path
    if ($copy == '') {
        fm_set_msg(lng('Source path not defined'), 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }
    // abs path from
    $from = FM_ROOT_PATH . '/' . $copy;
    // abs path to
    $dest = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $dest .= '/' . FM_PATH;
    }
    $dest .= '/' . basename($from);
    // move?
    $move = isset($_GET['move']);
    // copy/move/duplicate
    if ($from != $dest) {
        $msg_from = trim(FM_PATH . '/' . basename($from), '/');
        if ($move) { // Move and to != from so just perform move
            $rename = fm_rename($from, $dest);
            if ($rename) {
                fm_set_msg(sprintf(lng('Moved from').' <b>%s</b> '.lng('to').' <b>%s</b>', fm_enc($copy), fm_enc($msg_from)));
            } elseif ($rename === null) {
                fm_set_msg(lng('File or folder with this path already exists'), 'alert');
            } else {
                fm_set_msg(sprintf(lng('Error while moving from').' <b>%s</b> '.lng('to').' <b>%s</b>', fm_enc($copy), fm_enc($msg_from)), 'error');
            }
        } else { // Not move and to != from so copy with original name
            if (fm_rcopy($from, $dest)) {
                fm_set_msg(sprintf(lng('Copied from').' <b>%s</b> '.lng('to').' <b>%s</b>', fm_enc($copy), fm_enc($msg_from)));
            } else {
                fm_set_msg(sprintf(lng('Error while copying from').' <b>%s</b> '.lng('to').' <b>%s</b>', fm_enc($copy), fm_enc($msg_from)), 'error');
            }
        }
    } else {
       if (!$move){ //Not move and to = from so duplicate
            $msg_from = trim(FM_PATH . '/' . basename($from), '/');
            $fn_parts = pathinfo($from);
            $extension_suffix = '';
            if(!is_dir($from)){
               $extension_suffix = '.'.$fn_parts['extension'];
            }
            //Create new name for duplicate
            $fn_duplicate = $fn_parts['dirname'].'/'.$fn_parts['filename'].'-'.date('YmdHis').$extension_suffix;
            $loop_count = 0;
            $max_loop = 1000;
            // Check if a file with the duplicate name already exists, if so, make new name (edge case...)
            while(file_exists($fn_duplicate) & $loop_count < $max_loop){
               $fn_parts = pathinfo($fn_duplicate);
               $fn_duplicate = $fn_parts['dirname'].'/'.$fn_parts['filename'].'-copy'.$extension_suffix;
               $loop_count++;
            }
            if (fm_rcopy($from, $fn_duplicate, False)) {
                fm_set_msg(sprintf('Copyied from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($fn_duplicate)));
            } else {
                fm_set_msg(sprintf('Error while copying from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($fn_duplicate)), 'error');
            }
       }
       else{
           fm_set_msg(lng('Paths must be not equal'), 'alert');
       }
    }
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Mass copy files/ folders
if (isset($_POST['file'], $_POST['copy_to'], $_POST['finish']) && !FM_READONLY) {
    // from
    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }
    // to
    $copy_to_path = FM_ROOT_PATH;
    $copy_to = fm_clean_path($_POST['copy_to']);
    if ($copy_to != '') {
        $copy_to_path .= '/' . $copy_to;
    }
    if ($path == $copy_to_path) {
        fm_set_msg(lng('Paths must be not equal'), 'alert');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }
    if (!is_dir($copy_to_path)) {
        if (!fm_mkdir($copy_to_path, true)) {
            fm_set_msg('Unable to create destination folder', 'error');
            fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
        }
    }
    // move?
    $move = isset($_POST['move']);
    // copy/move
    $errors = 0;
    $files = $_POST['file'];
    if (is_array($files) && count($files)) {
        foreach ($files as $f) {
            if ($f != '') {
                // abs path from
                $from = $path . '/' . $f;
                // abs path to
                $dest = $copy_to_path . '/' . $f;
                // do
                if ($move) {
                    $rename = fm_rename($from, $dest);
                    if ($rename === false) {
                        $errors++;
                    }
                } else {
                    if (!fm_rcopy($from, $dest)) {
                        $errors++;
                    }
                }
            }
        }
        if ($errors == 0) {
            $msg = $move ? 'Selected files and folders moved' : 'Selected files and folders copied';
            fm_set_msg($msg);
        } else {
            $msg = $move ? 'Error while moving items' : 'Error while copying items';
            fm_set_msg($msg, 'error');
        }
    } else {
        fm_set_msg(lng('Nothing selected'), 'alert');
    }
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Rename
if (isset($_GET['ren'], $_GET['to']) && !FM_READONLY) {
    // old name
    $old = $_GET['ren'];
    $old = fm_clean_path($old);
    $old = str_replace('/', '', $old);
    // new name
    $new = $_GET['to'];
    $new = fm_clean_path(strip_tags($new));
    $new = str_replace('/', '', $new);
    // path
    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }
    // rename
    if (fm_isvalid_filename($new) && $old != '' && $new != '') {
        if (fm_rename($path . '/' . $old, $path . '/' . $new)) {
            fm_set_msg(sprintf(lng('Renamed from').' <b>%s</b> '. lng('to').' <b>%s</b>', fm_enc($old), fm_enc($new)));
        } else {
            fm_set_msg(sprintf(lng('Error while renaming from').' <b>%s</b> '. lng('to').' <b>%s</b>', fm_enc($old), fm_enc($new)), 'error');
        }
    } else {
        fm_set_msg(lng('Invalid characters in file name'), 'error');
    }
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Download
if (isset($_GET['dl'])) {
    $dl = $_GET['dl'];
    $dl = fm_clean_path($dl);
    $dl = str_replace('/', '', $dl);
    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }
    if ($dl != '' && is_file($path . '/' . $dl)) {
        fm_download_file($path . '/' . $dl, $dl, 1024);
        exit;
    } else {
        fm_set_msg(lng('File not found'), 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }
}

// Upload
if (!empty($_FILES) && !FM_READONLY) {
    $override_file_name = false;
    $f = $_FILES;
    $path = FM_ROOT_PATH;
    $ds = DIRECTORY_SEPARATOR;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }

    $errors = 0;
    $uploads = 0;
    $allowed = (FM_UPLOAD_EXTENSION) ? explode(',', FM_UPLOAD_EXTENSION) : false;
    $response = array (
        'status' => 'error',
        'info'   => 'Oops! Try again'
    );

    $filename = $f['file']['name'];
    $tmp_name = $f['file']['tmp_name'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $isFileAllowed = ($allowed) ? in_array($ext, $allowed) : true;

    if(!fm_isvalid_filename($filename) && !fm_isvalid_filename($_REQUEST['fullpath'])) {
        $response = array (
            'status'    => 'error',
            'info'      => "Invalid File name!",
        );
        echo json_encode($response); exit();
    }

    $targetPath = $path . $ds;
    if ( is_writable($targetPath) ) {
        $fullPath = $path . '/' . $_REQUEST['fullpath'];
        $folder = substr($fullPath, 0, strrpos($fullPath, "/"));

        if(file_exists ($fullPath) && !$override_file_name) {
            $ext_1 = $ext ? '.'.$ext : '';
            $fullPath = str_replace($ext_1, '', $fullPath) .'_'. date('ymdHis'). $ext_1;
        }

        if (!is_dir($folder)) {
            $old = umask(0);
            mkdir($folder, 0777, true);
            umask($old);
        }

        if (empty($f['file']['error']) && !empty($tmp_name) && $tmp_name != 'none' && $isFileAllowed) {
            if (move_uploaded_file($tmp_name, $fullPath)) {
                // Be sure that the file has been uploaded
                if ( file_exists($fullPath) ) {
                    $response = array (
                        'status'    => 'success',
                        'info' => "file upload successful"
                    );
                } else {
                    $response = array (
                        'status' => 'error',
                        'info'   => 'Couldn\'t upload the requested file.'
                    );
                }
            } else {
                $response = array (
                    'status'    => 'error',
                    'info'      => "Error while uploading files. Uploaded files $uploads",
                );
            }
        }
    } else {
        $response = array (
            'status' => 'error',
            'info'   => 'The specified folder for upload isn\'t writeable.'
        );
    }
    // Return the response
    echo json_encode($response);
    exit();
}

// Mass deleting
if (isset($_POST['group'], $_POST['delete']) && !FM_READONLY) {
    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }

    $errors = 0;
    $files = $_POST['file'];
    if (is_array($files) && count($files)) {
        foreach ($files as $f) {
            if ($f != '') {
                $new_path = $path . '/' . $f;
                if (!fm_rdelete($new_path)) {
                    $errors++;
                }
            }
        }
        if ($errors == 0) {
            fm_set_msg(lng('Selected files and folder deleted'));
        } else {
            fm_set_msg(lng('Error while deleting items'), 'error');
        }
    } else {
        fm_set_msg(lng('Nothing selected'), 'alert');
    }

    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Pack files
if (isset($_POST['group']) && (isset($_POST['zip']) || isset($_POST['tar'])) && !FM_READONLY) {
    $path = FM_ROOT_PATH;
    $ext = 'zip';
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }

    //set pack type
    $ext = isset($_POST['tar']) ? 'tar' : 'zip';


    if (($ext == "zip" && !class_exists('ZipArchive')) || ($ext == "tar" && !class_exists('PharData'))) {
        fm_set_msg(lng('Operations with archives are not available'), 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }

    $files = $_POST['file'];
    if (!empty($files)) {
        chdir($path);

        if (count($files) == 1) {
            $one_file = reset($files);
            $one_file = basename($one_file);
            $zipname = $one_file . '_' . date('ymd_His') . '.'.$ext;
        } else {
            $zipname = 'archive_' . date('ymd_His') . '.'.$ext;
        }

        if($ext == 'zip') {
            $zipper = new FM_Zipper();
            $res = $zipper->create($zipname, $files);
        } elseif ($ext == 'tar') {
            $tar = new FM_Zipper_Tar();
            $res = $tar->create($zipname, $files);
        }

        if ($res) {
            fm_set_msg(sprintf(lng('Archive').' <b>%s</b> '.lng('Created'), fm_enc($zipname)));
        } else {
            fm_set_msg(lng('Archive not created'), 'error');
        }
    } else {
        fm_set_msg(lng('Nothing selected'), 'alert');
    }

    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Unpack
if (isset($_GET['unzip']) && !FM_READONLY) {
    $unzip = $_GET['unzip'];
    $unzip = fm_clean_path($unzip);
    $unzip = str_replace('/', '', $unzip);
    $isValid = false;

    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }

    if ($unzip != '' && is_file($path . '/' . $unzip)) {
        $zip_path = $path . '/' . $unzip;
        $ext = pathinfo($zip_path, PATHINFO_EXTENSION);
        $isValid = true;
    } else {
        fm_set_msg(lng('File not found'), 'error');
    }


    if (($ext == "zip" && !class_exists('ZipArchive')) || ($ext == "tar" && !class_exists('PharData'))) {
        fm_set_msg(lng('Operations with archives are not available'), 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }

    if ($isValid) {
        //to folder
        $tofolder = '';
        if (isset($_GET['tofolder'])) {
            $tofolder = pathinfo($zip_path, PATHINFO_FILENAME);
            if (fm_mkdir($path . '/' . $tofolder, true)) {
                $path .= '/' . $tofolder;
            }
        }

        if($ext == "zip") {
            $zipper = new FM_Zipper();
            $res = $zipper->unzip($zip_path, $path);
        } elseif ($ext == "tar") {
            try {
                $gzipper = new PharData($zip_path);
                if (@$gzipper->extractTo($path,null, true)) {
                    $res = true;
                } else {
                    $res = false;
                }
            } catch (Exception $e) {
                //TODO:: need to handle the error
                $res = true;
            }
        }

        if ($res) {
            fm_set_msg(lng('Archive unpacked'));
        } else {
            fm_set_msg(lng('Archive not unpacked'), 'error');
        }

    } else {
        fm_set_msg(lng('File not found'), 'error');
    }
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Change Perms (not for Windows)
if (isset($_POST['chmod']) && !FM_READONLY && !FM_IS_WIN) {
    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }

    $file = $_POST['chmod'];
    $file = fm_clean_path($file);
    $file = str_replace('/', '', $file);
    if ($file == '' || (!is_file($path . '/' . $file) && !is_dir($path . '/' . $file))) {
        fm_set_msg(lng('File not found'), 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }

    $mode = 0;
    if (!empty($_POST['ur'])) {
        $mode |= 0400;
    }
    if (!empty($_POST['uw'])) {
        $mode |= 0200;
    }
    if (!empty($_POST['ux'])) {
        $mode |= 0100;
    }
    if (!empty($_POST['gr'])) {
        $mode |= 0040;
    }
    if (!empty($_POST['gw'])) {
        $mode |= 0020;
    }
    if (!empty($_POST['gx'])) {
        $mode |= 0010;
    }
    if (!empty($_POST['or'])) {
        $mode |= 0004;
    }
    if (!empty($_POST['ow'])) {
        $mode |= 0002;
    }
    if (!empty($_POST['ox'])) {
        $mode |= 0001;
    }

    if (@chmod($path . '/' . $file, $mode)) {
        fm_set_msg(lng('Permissions changed'));
    } else {
        fm_set_msg(lng('Permissions not changed'), 'error');
    }

    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

/*************************** /ACTIONS ***************************/

// get current path
$path = FM_ROOT_PATH;
if (FM_PATH != '') {
    $path .= '/' . FM_PATH;
}

// check path
if (!is_dir($path)) {
    fm_redirect(FM_SELF_URL . '?p=');
}

// get parent folder
$parent = fm_get_parent_path(FM_PATH);

$objects = is_readable($path) ? scandir($path) : array();
$folders = array();
$files = array();
$current_path = array_slice(explode("/",$path), -1)[0];
if (is_array($objects) && fm_is_exclude_items($current_path)) {
    foreach ($objects as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        }
        if (!FM_SHOW_HIDDEN && substr($file, 0, 1) === '.') {
            continue;
        }
        $new_path = $path . '/' . $file;
        if (@is_file($new_path) && fm_is_exclude_items($file)) {
            $files[] = $file;
        } elseif (@is_dir($new_path) && $file != '.' && $file != '..' && fm_is_exclude_items($file)) {
            $folders[] = $file;
        }
    }
}

if (!empty($files)) {
    natcasesort($files);
}
if (!empty($folders)) {
    natcasesort($folders);
}

// upload form
if (isset($_GET['upload']) && !FM_READONLY) {
    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path
    //get the allowed file extensions
    function getUploadExt() {
        $extArr = explode(',', FM_UPLOAD_EXTENSION);
        if(FM_UPLOAD_EXTENSION && $extArr) {
            array_walk($extArr, function(&$x) {$x = ".$x";});
            return implode(',', $extArr);
        }
        return '';
    }
    ?>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet">
    <div class="path">

        <div class="card mb-2 fm-upload-wrapper <?php echo fm_get_theme(); ?>">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#fileUploader" data-target="#fileUploader"><i class="fa fa-arrow-circle-o-up"></i> <?php echo lng('UploadingFiles') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#urlUploader" class="js-url-upload" data-target="#urlUploader"><i class="fa fa-link"></i> Upload from URL</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <p class="card-text">
                    <a href="?p=<?php echo FM_PATH ?>" class="float-right"><i class="fa fa-chevron-circle-left go-back"></i> <?php echo lng('Back')?></a>
                    <?php echo lng('DestinationFolder') ?>: <?php echo fm_enc(fm_convert_win(FM_PATH)) ?>
                </p>

                <form action="<?php echo htmlspecialchars(FM_SELF_URL) . '?p=' . fm_enc(FM_PATH) ?>" class="dropzone card-tabs-container" id="fileUploader" enctype="multipart/form-data">
                    <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
                    <input type="hidden" name="fullpath" id="fullpath" value="<?php echo fm_enc(FM_PATH) ?>">
                    <div class="fallback">
                        <input name="file" type="file" multiple/>
                    </div>
                </form>

                <div class="upload-url-wrapper card-tabs-container hidden" id="urlUploader">
                    <form id="js-form-url-upload" class="form-inline" onsubmit="return upload_from_url(this);" method="POST" action="">
                        <input type="hidden" name="type" value="upload" aria-label="hidden" aria-hidden="true">
                        <input type="url" placeholder="URL" name="uploadurl" required class="form-control" style="width: 80%">
                        <button type="submit" class="btn btn-primary ml-3"><?php echo lng('Upload') ?></button>
                        <div class="lds-facebook"><div></div><div></div><div></div></div>
                    </form>
                    <div id="js-url-upload__list" class="col-9 mt-3"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.fileUploader = {
            timeout: 120000,
            maxFilesize: <?php echo MAX_UPLOAD_SIZE; ?>,
            acceptedFiles : "<?php echo getUploadExt() ?>",
            init: function () {
                this.on("sending", function (file, xhr, formData) {
                    let _path = (file.fullPath) ? file.fullPath : file.name;
                    document.getElementById("fullpath").value = _path;
                    xhr.ontimeout = (function() {
                        toast('Error: Server Timeout');
                    });
                }).on("success", function (res) {
                    let _response = JSON.parse(res.xhr.response);
                    if(_response.status == "error") {
                        toast(_response.info);
                    }
                }).on("error", function(file, response) {
                    toast(response);
                });
            }
        }
    </script>
    <?php
    fm_show_footer();
    exit;
}

// copy form POST
if (isset($_POST['copy']) && !FM_READONLY) {
    $copy_files = isset($_POST['file']) ? $_POST['file'] : null;
    if (!is_array($copy_files) || empty($copy_files)) {
        fm_set_msg(lng('Nothing selected'), 'alert');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }

    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path
    ?>
    <div class="path">
        <div class="card <?php echo fm_get_theme(); ?>">
            <div class="card-header">
                <h6><?php echo lng('Copying') ?></h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
                    <input type="hidden" name="finish" value="1">
                    <?php
                    foreach ($copy_files as $cf) {
                        echo '<input type="hidden" name="file[]" value="' . fm_enc($cf) . '">' . PHP_EOL;
                    }
                    ?>
                    <p class="break-word"><?php echo lng('Files') ?>: <b><?php echo implode('</b>, <b>', $copy_files) ?></b></p>
                    <p class="break-word"><?php echo lng('SourceFolder') ?>: <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH . '/' . FM_PATH)) ?><br>
                        <label for="inp_copy_to"><?php echo lng('DestinationFolder') ?>:</label>
                        <?php echo FM_ROOT_PATH ?>/<input type="text" name="copy_to" id="inp_copy_to" value="<?php echo fm_enc(FM_PATH) ?>">
                    </p>
                    <p class="custom-checkbox custom-control"><input type="checkbox" name="move" value="1" id="js-move-files" class="custom-control-input"><label for="js-move-files" class="custom-control-label" style="vertical-align: sub"> <?php echo lng('Move') ?></label></p>
                    <p>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> <?php echo lng('Copy') ?></button> &nbsp;
                        <b><a href="?p=<?php echo urlencode(FM_PATH) ?>" class="btn btn-outline-primary"><i class="fa fa-times-circle"></i> <?php echo lng('Cancel') ?></a></b>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <?php
    fm_show_footer();
    exit;
}

// copy form
if (isset($_GET['copy']) && !isset($_GET['finish']) && !FM_READONLY) {
    $copy = $_GET['copy'];
    $copy = fm_clean_path($copy);
    if ($copy == '' || !file_exists(FM_ROOT_PATH . '/' . $copy)) {
        fm_set_msg(lng('File not found'), 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }

    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path
    ?>
    <div class="path">
        <p><b>Copying</b></p>
        <p class="break-word">
            Source path: <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH . '/' . $copy)) ?><br>
            Destination folder: <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH . '/' . FM_PATH)) ?>
        </p>
        <p>
            <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;copy=<?php echo urlencode($copy) ?>&amp;finish=1"><i class="fa fa-check-circle"></i> Copy</a></b> &nbsp;
            <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;copy=<?php echo urlencode($copy) ?>&amp;finish=1&amp;move=1"><i class="fa fa-check-circle"></i> Move</a></b> &nbsp;
            <b><a href="?p=<?php echo urlencode(FM_PATH) ?>"><i class="fa fa-times-circle"></i> Cancel</a></b>
        </p>
        <p><i><?php echo lng('Select folder') ?></i></p>
        <ul class="folders break-word">
            <?php
            if ($parent !== false) {
                ?>
                <li><a href="?p=<?php echo urlencode($parent) ?>&amp;copy=<?php echo urlencode($copy) ?>"><i class="fa fa-chevron-circle-left"></i> ..</a></li>
                <?php
            }
            foreach ($folders as $f) {
                ?>
                <li>
                    <a href="?p=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>&amp;copy=<?php echo urlencode($copy) ?>"><i class="fa fa-folder-o"></i> <?php echo fm_convert_win($f) ?></a></li>
                <?php
            }
            ?>
        </ul>
    </div>
    <?php
    fm_show_footer();
    exit;
}

if (isset($_GET['settings']) && !FM_READONLY) {
    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path
    global $cfg, $lang, $lang_list;
    ?>

    <div class="col-md-8 offset-md-2 pt-3">
        <div class="card mb-2 <?php echo fm_get_theme(); ?>">
            <h6 class="card-header">
                <i class="fa fa-cog"></i>  <?php echo lng('Settings') ?>
                <a href="?p=<?php echo FM_PATH ?>" class="float-right"><i class="fa fa-window-close"></i> <?php echo lng('Cancel')?></a>
            </h6>
            <div class="card-body">
                <form id="js-settings-form" action="" method="post" data-type="ajax" onsubmit="return save_settings(this)">
                    <input type="hidden" name="type" value="settings" aria-label="hidden" aria-hidden="true">
                    <div class="form-group row">
                        <label for="js-language" class="col-sm-3 col-form-label"><?php echo lng('Language') ?></label>
                        <div class="col-sm-5">
                            <select class="form-control" id="js-language" name="js-language">
                                <?php
                                function getSelected($l) {
                                    global $lang;
                                    return ($lang == $l) ? 'selected' : '';
                                }
                                foreach ($lang_list as $k => $v) {
                                    echo "<option value='$k' ".getSelected($k).">$v</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php
                    //get ON/OFF and active class
                    function getChecked($conf, $val, $txt) {
                        if($conf== 1 && $val ==1) {
                            return $txt;
                        } else if($conf == '' && $val == '') {
                            return $txt;
                        } else {
                            return '';
                        }
                    }
                    ?>
                    <div class="form-group row">
                        <label for="js-err-rpt-1" class="col-sm-3 col-form-label"><?php echo lng('ErrorReporting') ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary <?php echo getChecked($report_errors, 1, 'active') ?>">
                                    <input type="radio" name="js-error-report" id="js-err-rpt-1" autocomplete="off" value="true" <?php echo getChecked($report_errors, 1, 'checked') ?> > ON
                                </label>
                                <label class="btn btn-secondary <?php echo getChecked($report_errors, '', 'active') ?>">
                                    <input type="radio" name="js-error-report" id="js-err-rpt-0" autocomplete="off" value="false" <?php echo getChecked($report_errors, '', 'checked') ?> > OFF
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="js-hdn-1" class="col-sm-3 col-form-label"><?php echo lng('ShowHiddenFiles') ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary <?php echo getChecked($show_hidden_files, 1, 'active') ?>">
                                    <input type="radio" name="js-show-hidden" id="js-hdn-1" autocomplete="off" value="true" <?php echo getChecked($show_hidden_files, 1, 'checked') ?> > ON
                                </label>
                                <label class="btn btn-secondary <?php echo getChecked($show_hidden_files, '', 'active') ?>">
                                    <input type="radio" name="js-show-hidden" id="js-hdn-0" autocomplete="off" value="false" <?php echo getChecked($show_hidden_files, '', 'checked') ?> > OFF
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="js-hid-1" class="col-sm-3 col-form-label"><?php echo lng('HideColumns') ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary <?php echo getChecked($hide_Cols, 1, 'active') ?>">
                                    <input type="radio" name="js-hide-cols" id="js-hid-1" autocomplete="off" value="true" <?php echo getChecked($hide_Cols, 1, 'checked') ?> > ON
                                </label>
                                <label class="btn btn-secondary <?php echo getChecked($hide_Cols, '', 'active') ?>">
                                    <input type="radio" name="js-hide-cols" id="js-hid-0" autocomplete="off" value="false" <?php echo getChecked($hide_Cols, '', 'checked') ?> > OFF
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="js-dir-1" class="col-sm-3 col-form-label"><?php echo lng('CalculateFolderSize') ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary <?php echo getChecked($calc_folder, 1, 'active') ?>">
                                    <input type="radio" name="js-calc-folder" id="js-dir-1" autocomplete="off" value="true" <?php echo getChecked($calc_folder, 1, 'checked') ?> > ON
                                </label>
                                <label class="btn btn-secondary <?php echo getChecked($calc_folder, '', 'active') ?>">
                                    <input type="radio" name="js-calc-folder" id="js-dir-0" autocomplete="off" value="false" <?php echo getChecked($calc_folder, '', 'checked') ?> > OFF
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="js-3-1" class="col-sm-3 col-form-label"><?php echo lng('Theme') ?></label>
                        <div class="col-sm-5">
                            <select class="form-control" id="js-3-0" name="js-theme-3" style="width:100px;">
                         <option value='light' <?php if($theme == "light"){echo "selected";} ?>><?php echo lng('light') ?></option>
                         <option value='dark' <?php if($theme == "dark"){echo "selected";} ?>><?php echo lng('dark') ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check-circle"></i> <?php echo lng('Save'); ?></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php
    fm_show_footer();
    exit;
}

if (isset($_GET['help'])) {
    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path
    global $cfg, $lang;
    ?>

    <div class="col-md-8 offset-md-2 pt-3">
        <div class="card mb-2 <?php echo fm_get_theme(); ?>">
            <h6 class="card-header">
                <i class="fa fa-exclamation-circle"></i> <?php echo lng('Help') ?>
                <a href="?p=<?php echo FM_PATH ?>" class="float-right"><i class="fa fa-window-close"></i> <?php echo lng('Cancel')?></a>
            </h6>
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <p><h3><a href="https://github.com/prasathmani/tinyfilemanager" target="_blank" class="app-v-title"> Komisi Informasi Sumatera Barat <?php echo VERSION; ?></a></h3></p>
                        <p>Asisten Ahli KI Sumbar: Ridho Saputra</p>
                        <p>Mail Us: <a href="monev.kisb2021@gmail.com">monev.kisb2021[at]gmail.com</a> </p>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><a href="https://github.com/prasathmani/tinyfilemanager/wiki" target="_blank"><i class="fa fa-question-circle"></i> <?php echo lng('Help Documents') ?> </a> </li>
                                <li class="list-group-item"><a href="https://github.com/prasathmani/tinyfilemanager/issues" target="_blank"><i class="fa fa-bug"></i> <?php echo lng('Report Issue') ?></a></li>
                                <li class="list-group-item"><a href="javascript:latest_release_info('<?php echo VERSION; ?>');"><i class="fa fa-link"> </i> <?php echo lng('Check Latest Version') ?></a></li>
                                <?php if(!FM_READONLY) { ?>
                                <li class="list-group-item"><a href="javascript:show_new_pwd();"><i class="fa fa-lock"></i> <?php echo lng('Generate new password hash') ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row js-new-pwd hidden mt-2">
                    <div class="col-12">
                        <form class="form-inline" onsubmit="return new_password_hash(this)" method="POST" action="">
                            <input type="hidden" name="type" value="pwdhash" aria-label="hidden" aria-hidden="true">
                            <div class="form-group mb-2">
                                <label for="staticEmail2"><?php echo lng('Generate new password hash') ?></label>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="inputPassword2" class="sr-only"><?php echo lng('Password') ?></label>
                                <input type="text" class="form-control btn-sm" id="inputPassword2" name="inputPassword2" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm mb-2"><?php echo lng('Generate') ?></button>
                        </form>
                        <textarea class="form-control" rows="2" readonly id="js-pwd-result"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    fm_show_footer();
    exit;
}

// file viewer
if (isset($_GET['view'])) {
    $file = $_GET['view'];
    $quickView = (isset($_GET['quickView']) && $_GET['quickView'] == 1) ? true : false;
    $file = fm_clean_path($file, false);
    $file = str_replace('/', '', $file);
    if ($file == '' || !is_file($path . '/' . $file) || in_array($file, $GLOBALS['exclude_items'])) {
        fm_set_msg(lng('File not found'), 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }

    if(!$quickView) {
        fm_show_header(); // HEADER
        fm_show_nav_path(FM_PATH); // current path
    }

    $file_url = FM_ROOT_URL . fm_convert_win((FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $file);
    $file_path = $path . '/' . $file;

    $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    $mime_type = fm_get_mime_type($file_path);
    $filesize_raw = fm_get_size($file_path);
    $filesize = fm_get_filesize($filesize_raw);

    $is_zip = false;
    $is_gzip = false;
    $is_image = false;
    $is_audio = false;
    $is_video = false;
    $is_text = false;
    $is_onlineViewer = false;

    $view_title = 'File';
    $filenames = false; // for zip
    $content = ''; // for text
    $online_viewer = strtolower(FM_DOC_VIEWER);

    if($online_viewer && $online_viewer !== 'false' && in_array($ext, fm_get_onlineViewer_exts())){
        $is_onlineViewer = true;
    }
    elseif ($ext == 'zip' || $ext == 'tar') {
        $is_zip = true;
        $view_title = 'Archive';
        $filenames = fm_get_zif_info($file_path, $ext);
    } elseif (in_array($ext, fm_get_image_exts())) {
        $is_image = true;
        $view_title = 'Image';
    } elseif (in_array($ext, fm_get_audio_exts())) {
        $is_audio = true;
        $view_title = 'Audio';
    } elseif (in_array($ext, fm_get_video_exts())) {
        $is_video = true;
        $view_title = 'Video';
    } elseif (in_array($ext, fm_get_text_exts()) || substr($mime_type, 0, 4) == 'text' || in_array($mime_type, fm_get_text_mimes())) {
        $is_text = true;
        $content = file_get_contents($file_path);
    }

    ?>
    <div class="row">
        <div class="col-12">
            <?php if(!$quickView) { ?>
                <p class="break-word"><b><?php echo $view_title ?> "<?php echo fm_enc(fm_convert_win($file)) ?>"</b></p>
                <p class="break-word">
                    Full path: <?php echo fm_enc(fm_convert_win($file_path)) ?><br>
                    File size: <?php echo ($filesize_raw <= 1000) ? "$filesize_raw bytes" : $filesize; ?><br>
                    MIME-type: <?php echo $mime_type ?><br>
                    <?php
                    // ZIP info
                    if (($is_zip || $is_gzip) && $filenames !== false) {
                        $total_files = 0;
                        $total_comp = 0;
                        $total_uncomp = 0;
                        foreach ($filenames as $fn) {
                            if (!$fn['folder']) {
                                $total_files++;
                            }
                            $total_comp += $fn['compressed_size'];
                            $total_uncomp += $fn['filesize'];
                        }
                        ?>
                        Files in archive: <?php echo $total_files ?><br>
                        Total size: <?php echo fm_get_filesize($total_uncomp) ?><br>
                        Size in archive: <?php echo fm_get_filesize($total_comp) ?><br>
                        Compression: <?php echo round(($total_comp / $total_uncomp) * 100) ?>%<br>
                        <?php
                    }
                    // Image info
                    if ($is_image) {
                        $image_size = getimagesize($file_path);
                        echo 'Image sizes: ' . (isset($image_size[0]) ? $image_size[0] : '0') . ' x ' . (isset($image_size[1]) ? $image_size[1] : '0') . '<br>';
                    }
                    // Text info
                    if ($is_text) {
                        $is_utf8 = fm_is_utf8($content);
                        if (function_exists('iconv')) {
                            if (!$is_utf8) {
                                $content = iconv(FM_ICONV_INPUT_ENC, 'UTF-8//IGNORE', $content);
                            }
                        }
                        echo 'Charset: ' . ($is_utf8 ? 'utf-8' : '8 bit') . '<br>';
                    }
                    ?>
                </p>
                <p>
                    <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;dl=<?php echo urlencode($file) ?>"><i class="fa fa-cloud-download"></i> <?php echo lng('Download') ?></a></b> &nbsp;
                    <b><a href="<?php echo fm_enc($file_url) ?>" target="_blank"><i class="fa fa-external-link-square"></i> <?php echo lng('Open') ?></a></b>
                    &nbsp;
                    <?php
                    // ZIP actions
                    if (!FM_READONLY && ($is_zip || $is_gzip) && $filenames !== false) {
                        $zip_name = pathinfo($file_path, PATHINFO_FILENAME);
                        ?>
                        <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;unzip=<?php echo urlencode($file) ?>"><i class="fa fa-check-circle"></i> <?php echo lng('UnZip') ?></a></b> &nbsp;
                        <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;unzip=<?php echo urlencode($file) ?>&amp;tofolder=1" title="UnZip to <?php echo fm_enc($zip_name) ?>"><i class="fa fa-check-circle"></i>
                                <?php echo lng('UnZipToFolder') ?></a></b> &nbsp;
                        <?php
                    }
                    if ($is_text && !FM_READONLY) {
                        ?>
                        <b><a href="?p=<?php echo urlencode(trim(FM_PATH)) ?>&amp;edit=<?php echo urlencode($file) ?>" class="edit-file"><i class="fa fa-pencil-square"></i> <?php echo lng('Edit') ?>
                            </a></b> &nbsp;
                        <b><a href="?p=<?php echo urlencode(trim(FM_PATH)) ?>&amp;edit=<?php echo urlencode($file) ?>&env=ace"
                              class="edit-file"><i class="fa fa-pencil-square-o"></i> <?php echo lng('AdvancedEditor') ?>
                            </a></b> &nbsp;
                    <?php } ?>
                    <b><a href="?p=<?php echo urlencode(FM_PATH) ?>"><i class="fa fa-chevron-circle-left go-back"></i> <?php echo lng('Back') ?></a></b>
                </p>
                <?php
            }
            if($is_onlineViewer) {
                if($online_viewer == 'google') {
                    echo '<iframe src="https://docs.google.com/viewer?embedded=true&hl=en&url=' . fm_enc($file_url) . '" frameborder="no" style="width:100%;min-height:460px"></iframe>';
                } else if($online_viewer == 'microsoft') {
                    echo '<iframe src="https://view.officeapps.live.com/op/embed.aspx?src=' . fm_enc($file_url) . '" frameborder="no" style="width:100%;min-height:460px"></iframe>';
                }
            } elseif ($is_zip) {
                // ZIP content
                if ($filenames !== false) {
                    echo '<code class="maxheight">';
                    foreach ($filenames as $fn) {
                        if ($fn['folder']) {
                            echo '<b>' . fm_enc($fn['name']) . '</b><br>';
                        } else {
                            echo $fn['name'] . ' (' . fm_get_filesize($fn['filesize']) . ')<br>';
                        }
                    }
                    echo '</code>';
                } else {
                    echo '<p>'.lng('Error while fetching archive info').'</p>';
                }
            } elseif ($is_image) {
                // Image content
                if (in_array($ext, array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico', 'svg', 'webp', 'avif'))) {
                    echo '<p><img src="' . fm_enc($file_url) . '" alt="" class="preview-img"></p>';
                }
            } elseif ($is_audio) {
                // Audio content
                echo '<p><audio src="' . fm_enc($file_url) . '" controls preload="metadata"></audio></p>';
            } elseif ($is_video) {
                // Video content
                echo '<div class="preview-video"><video src="' . fm_enc($file_url) . '" width="640" height="360" controls preload="metadata"></video></div>';
            } elseif ($is_text) {
                if (FM_USE_HIGHLIGHTJS) {
                    // highlight
                    $hljs_classes = array(
                        'shtml' => 'xml',
                        'htaccess' => 'apache',
                        'phtml' => 'php',
                        'lock' => 'json',
                        'svg' => 'xml',
                    );
                    $hljs_class = isset($hljs_classes[$ext]) ? 'lang-' . $hljs_classes[$ext] : 'lang-' . $ext;
                    if (empty($ext) || in_array(strtolower($file), fm_get_text_names()) || preg_match('#\.min\.(css|js)$#i', $file)) {
                        $hljs_class = 'nohighlight';
                    }
                    $content = '<pre class="with-hljs"><code class="' . $hljs_class . '">' . fm_enc($content) . '</code></pre>';
                } elseif (in_array($ext, array('php', 'php4', 'php5', 'phtml', 'phps'))) {
                    // php highlight
                    $content = highlight_string($content, true);
                } else {
                    $content = '<pre>' . fm_enc($content) . '</pre>';
                }
                echo $content;
            }
            ?>
        </div>
    </div>
    <?php
    if(!$quickView) {
        fm_show_footer();
    }
    exit;
}

// file editor
if (isset($_GET['edit'])) {
    $file = $_GET['edit'];
    $file = fm_clean_path($file, false);
    $file = str_replace('/', '', $file);
    if ($file == '' || !is_file($path . '/' . $file)) {
        fm_set_msg(lng('File not found'), 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }
    header('X-XSS-Protection:0');
    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path

    $file_url = FM_ROOT_URL . fm_convert_win((FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $file);
    $file_path = $path . '/' . $file;

    // normal editer
    $isNormalEditor = true;
    if (isset($_GET['env'])) {
        if ($_GET['env'] == "ace") {
            $isNormalEditor = false;
        }
    }

    // Save File
    if (isset($_POST['savedata'])) {
        $writedata = $_POST['savedata'];
        $fd = fopen($file_path, "w");
        @fwrite($fd, $writedata);
        fclose($fd);
        fm_set_msg(lng('File Saved Successfully'));
    }

    $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    $mime_type = fm_get_mime_type($file_path);
    $filesize = filesize($file_path);
    $is_text = false;
    $content = ''; // for text

    if (in_array($ext, fm_get_text_exts()) || substr($mime_type, 0, 4) == 'text' || in_array($mime_type, fm_get_text_mimes())) {
        $is_text = true;
        $content = file_get_contents($file_path);
    }

    ?>
    <div class="path">
        <div class="row">
            <div class="col-xs-12 col-sm-5 col-lg-6 pt-1">
                <div class="btn-toolbar" role="toolbar">
                    <?php if (!$isNormalEditor) { ?>
                        <div class="btn-group js-ace-toolbar">
                            <button data-cmd="none" data-option="fullscreen" class="btn btn-sm btn-outline-secondary" id="js-ace-fullscreen" title="Fullscreen"><i class="fa fa-expand" title="Fullscreen"></i></button>
                            <button data-cmd="find" class="btn btn-sm btn-outline-secondary" id="js-ace-search" title="Search"><i class="fa fa-search" title="Search"></i></button>
                            <button data-cmd="undo" class="btn btn-sm btn-outline-secondary" id="js-ace-undo" title="Undo"><i class="fa fa-undo" title="Undo"></i></button>
                            <button data-cmd="redo" class="btn btn-sm btn-outline-secondary" id="js-ace-redo" title="Redo"><i class="fa fa-repeat" title="Redo"></i></button>
                            <button data-cmd="none" data-option="wrap" class="btn btn-sm btn-outline-secondary" id="js-ace-wordWrap" title="Word Wrap"><i class="fa fa-text-width" title="Word Wrap"></i></button>
                            <button data-cmd="none" data-option="help" class="btn btn-sm btn-outline-secondary" id="js-ace-goLine" title="Help"><i class="fa fa-question" title="Help"></i></button>
                            <select id="js-ace-mode" data-type="mode" title="Select Document Type" class="btn-outline-secondary border-left-0 d-none d-md-block"><option>-- Select Mode --</option></select>
                            <select id="js-ace-theme" data-type="theme" title="Select Theme" class="btn-outline-secondary border-left-0 d-none d-lg-block"><option>-- Select Theme --</option></select>
                            <select id="js-ace-fontSize" data-type="fontSize" title="Select Font Size" class="btn-outline-secondary border-left-0 d-none d-lg-block"><option>-- Select Font Size --</option></select>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="edit-file-actions col-xs-12 col-sm-7 col-lg-6 text-right pt-1">
                <a title="Back" class="btn btn-sm btn-outline-primary" href="?p=<?php echo urlencode(trim(FM_PATH)) ?>&amp;view=<?php echo urlencode($file) ?>"><i class="fa fa-reply-all"></i> <?php echo lng('Back') ?></a>
                <a title="Backup" class="btn btn-sm btn-outline-primary" href="javascript:void(0);" onclick="backup('<?php echo urlencode(trim(FM_PATH)) ?>','<?php echo urlencode($file) ?>')"><i class="fa fa-database"></i> <?php echo lng('BackUp') ?></a>
                <?php if ($is_text) { ?>
                    <?php if ($isNormalEditor) { ?>
                        <a title="Advanced" class="btn btn-sm btn-outline-primary" href="?p=<?php echo urlencode(trim(FM_PATH)) ?>&amp;edit=<?php echo urlencode($file) ?>&amp;env=ace"><i class="fa fa-pencil-square-o"></i> <?php echo lng('AdvancedEditor') ?></a>
                        <button type="button" class="btn btn-sm btn-outline-primary name="Save" data-url="<?php echo fm_enc($file_url) ?>" onclick="edit_save(this,'nrl')"><i class="fa fa-floppy-o"></i> Save
                        </button>
                    <?php } else { ?>
                        <a title="Plain Editor" class="btn btn-sm btn-outline-primary" href="?p=<?php echo urlencode(trim(FM_PATH)) ?>&amp;edit=<?php echo urlencode($file) ?>"><i class="fa fa-text-height"></i> <?php echo lng('NormalEditor') ?></a>
                        <button type="button" class="btn btn-sm btn-outline-primary" name="Save" data-url="<?php echo fm_enc($file_url) ?>" onclick="edit_save(this,'ace')"><i class="fa fa-floppy-o"></i> <?php echo lng('Save') ?>
                        </button>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <?php
        if ($is_text && $isNormalEditor) {
            echo '<textarea class="mt-2" id="normal-editor" rows="33" cols="120" style="width: 99.5%;">' . htmlspecialchars($content) . '</textarea>';
        } elseif ($is_text) {
            echo '<div id="editor" contenteditable="true">' . htmlspecialchars($content) . '</div>';
        } else {
            fm_set_msg(lng('FILE EXTENSION HAS NOT SUPPORTED'), 'error');
        }
        ?>
    </div>
    <?php
    fm_show_footer();
    exit;
}

// chmod (not for Windows)
if (isset($_GET['chmod']) && !FM_READONLY && !FM_IS_WIN) {
    $file = $_GET['chmod'];
    $file = fm_clean_path($file);
    $file = str_replace('/', '', $file);
    if ($file == '' || (!is_file($path . '/' . $file) && !is_dir($path . '/' . $file))) {
        fm_set_msg(lng('File not found'), 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }

    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path

    $file_url = FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $file;
    $file_path = $path . '/' . $file;

    $mode = fileperms($path . '/' . $file);

    ?>
    <div class="path">
        <div class="card mb-2 <?php echo fm_get_theme(); ?>">
            <h6 class="card-header">
                <?php echo lng('ChangePermissions') ?>
            </h6>
            <div class="card-body">
                <p class="card-text">
                    Full path: <?php echo $file_path ?><br>
                </p>
                <form action="" method="post">
                    <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
                    <input type="hidden" name="chmod" value="<?php echo fm_enc($file) ?>">

                    <table class="table compact-table <?php echo fm_get_theme(); ?>">
                        <tr>
                            <td></td>
                            <td><b><?php echo lng('Owner') ?></b></td>
                            <td><b><?php echo lng('Group') ?></b></td>
                            <td><b><?php echo lng('Other') ?></b></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><b><?php echo lng('Read') ?></b></td>
                            <td><label><input type="checkbox" name="ur" value="1"<?php echo ($mode & 00400) ? ' checked' : '' ?>></label></td>
                            <td><label><input type="checkbox" name="gr" value="1"<?php echo ($mode & 00040) ? ' checked' : '' ?>></label></td>
                            <td><label><input type="checkbox" name="or" value="1"<?php echo ($mode & 00004) ? ' checked' : '' ?>></label></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><b><?php echo lng('Write') ?></b></td>
                            <td><label><input type="checkbox" name="uw" value="1"<?php echo ($mode & 00200) ? ' checked' : '' ?>></label></td>
                            <td><label><input type="checkbox" name="gw" value="1"<?php echo ($mode & 00020) ? ' checked' : '' ?>></label></td>
                            <td><label><input type="checkbox" name="ow" value="1"<?php echo ($mode & 00002) ? ' checked' : '' ?>></label></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><b><?php echo lng('Execute') ?></b></td>
                            <td><label><input type="checkbox" name="ux" value="1"<?php echo ($mode & 00100) ? ' checked' : '' ?>></label></td>
                            <td><label><input type="checkbox" name="gx" value="1"<?php echo ($mode & 00010) ? ' checked' : '' ?>></label></td>
                            <td><label><input type="checkbox" name="ox" value="1"<?php echo ($mode & 00001) ? ' checked' : '' ?>></label></td>
                        </tr>
                    </table>

                    <p>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> <?php echo lng('Change') ?></button> &nbsp;
                        <b><a href="?p=<?php echo urlencode(FM_PATH) ?>" class="btn btn-outline-primary"><i class="fa fa-times-circle"></i> <?php echo lng('Cancel') ?></a></b>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <?php
    fm_show_footer();
    exit;
}

//--- FILEMANAGER MAIN
fm_show_header(); // HEADER
fm_show_nav_path(FM_PATH); // current path

// messages
fm_show_message();

$num_files = count($files);
$num_folders = count($folders);
$all_files_size = 0;
$tableTheme = (FM_THEME == "dark") ? "text-white bg-dark table-dark" : "bg-white";
?>
<form action="" method="post" class="pt-3">
    <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
    <input type="hidden" name="group" value="1">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm <?php echo $tableTheme; ?>" id="main-table">
            <thead class="thead-white">
            <tr>
                <?php if (!FM_READONLY): ?>
                    <th style="width:3%" class="custom-checkbox-header">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="js-select-all-items" onclick="checkbox_toggle()">
                            <label class="custom-control-label" for="js-select-all-items"></label>
                        </div>
                    </th><?php endif; ?>
                <th><?php echo lng('Name') ?></th>
                <th><?php echo lng('Size') ?></th>
                <th><?php echo lng('Modified') ?></th>
                <?php if (!FM_IS_WIN && !$hide_Cols): ?>
                    <th><?php echo lng('Perms') ?></th>
                    <th><?php echo lng('Owner') ?></th><?php endif; ?>
                <th><?php echo lng('Actions') ?></th>
            </tr>
            </thead>
            <?php
            // link to parent folder
            if ($parent !== false) {
                ?>
                <tr><?php if (!FM_READONLY): ?>
                    <td class="nosort"></td><?php endif; ?>
                    <td class="border-0"><a href="?p=<?php echo urlencode($parent) ?>"><i class="fa fa-chevron-circle-left go-back"></i> ..</a></td>
                    <td class="border-0"></td>
                    <td class="border-0"></td>
                    <td class="border-0"></td>
                    <?php if (!FM_IS_WIN && !$hide_Cols) { ?>
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                    <?php } ?>
                </tr>
                <?php
            }
            $ii = 3399;
            foreach ($folders as $f) {
                $is_link = is_link($path . '/' . $f);
                $img = $is_link ? 'icon-link_folder' : 'fa fa-folder-o';
                $modif_raw = filemtime($path . '/' . $f);
                $modif = date(FM_DATETIME_FORMAT, $modif_raw);
                if ($calc_folder) {
                    $filesize_raw = fm_get_directorysize($path . '/' . $f);
                    $filesize = fm_get_filesize($filesize_raw);
                }
                else {
                    $filesize_raw = "";
                    $filesize = lng('Folder');
                }
                $perms = substr(decoct(fileperms($path . '/' . $f)), -4);
                if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
                    $owner = posix_getpwuid(fileowner($path . '/' . $f));
                    $group = posix_getgrgid(filegroup($path . '/' . $f));
                } else {
                    $owner = array('name' => '?');
                    $group = array('name' => '?');
                }
                ?>
                <tr>
                    <?php if (!FM_READONLY): ?>
                        <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="<?php echo $ii ?>" name="file[]" value="<?php echo fm_enc($f) ?>">
                            <label class="custom-control-label" for="<?php echo $ii ?>"></label>
                        </div>
                        </td><?php endif; ?>
                    <td>
                        <div class="filename"><a href="?p=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>"><i class="<?php echo $img ?>"></i> <?php echo fm_convert_win(fm_enc($f)) ?>
                            </a><?php echo($is_link ? ' &rarr; <i>' . readlink($path . '/' . $f) . '</i>' : '') ?></div>
                    </td>
                    <td data-sort="a-<?php echo str_pad($filesize_raw, 18, "0", STR_PAD_LEFT);?>">
                        <?php echo $filesize; ?>
                    </td>
                    <td data-sort="a-<?php echo $modif_raw;?>"><?php echo $modif ?></td>
                    <?php if (!FM_IS_WIN && !$hide_Cols): ?>
                        <td><?php if (!FM_READONLY): ?><a title="Change Permissions" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;chmod=<?php echo urlencode($f) ?>"><?php echo $perms ?></a><?php else: ?><?php echo $perms ?><?php endif; ?>
                        </td>
                        <td><?php echo $owner['name'] . ':' . $group['name'] ?></td>
                    <?php endif; ?>
                    <td class="inline-actions"><?php if (!FM_READONLY): ?>
                            <a title="<?php echo lng('Delete')?>" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;del=<?php echo urlencode($f) ?>" onclick="return confirm('<?php echo lng('Delete').' '.lng('Folder').'?'; ?>\n \n ( <?php echo urlencode($f) ?> )');"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="<?php echo lng('Rename')?>" href="#" onclick="rename('<?php echo fm_enc(addslashes(FM_PATH)) ?>', '<?php echo fm_enc(addslashes($f)) ?>');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="<?php echo lng('CopyTo')?>..." href="?p=&amp;copy=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                        <?php endif; ?>
                        <a title="<?php echo lng('DirectLink')?>" href="<?php echo fm_enc(FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f . '/') ?>" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <?php
                flush();
                $ii++;
            }
            $ik = 6070;
            foreach ($files as $f) {
                $is_link = is_link($path . '/' . $f);
                $img = $is_link ? 'fa fa-file-text-o' : fm_get_file_icon_class($path . '/' . $f);
                $modif_raw = filemtime($path . '/' . $f);
                $modif = date(FM_DATETIME_FORMAT, $modif_raw);
                $filesize_raw = fm_get_size($path . '/' . $f);
                $filesize = fm_get_filesize($filesize_raw);
                $filelink = '?p=' . urlencode(FM_PATH) . '&amp;view=' . urlencode($f);
                $all_files_size += $filesize_raw;
                $perms = substr(decoct(fileperms($path . '/' . $f)), -4);
                if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
                    $owner = posix_getpwuid(fileowner($path . '/' . $f));
                    $group = posix_getgrgid(filegroup($path . '/' . $f));
                } else {
                    $owner = array('name' => '?');
                    $group = array('name' => '?');
                }
                ?>
                <tr>
                    <?php if (!FM_READONLY): ?>
                        <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="<?php echo $ik ?>" name="file[]" value="<?php echo fm_enc($f) ?>">
                            <label class="custom-control-label" for="<?php echo $ik ?>"></label>
                        </div>
                        </td><?php endif; ?>
                    <td>
                        <div class="filename">
                        <?php
                           if (in_array(strtolower(pathinfo($f, PATHINFO_EXTENSION)), array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico', 'svg', 'webp', 'avif'))): ?>
                                <?php $imagePreview = fm_enc(FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f); ?>
                                <a href="<?php echo $filelink ?>" data-preview-image="<?php echo $imagePreview ?>" title="<?php echo fm_enc($f) ?>">
                           <?php else: ?>
                                <a href="<?php echo $filelink ?>" title="<?php echo $f ?>">
                            <?php endif; ?>
                                    <i class="<?php echo $img ?>"></i> <?php echo fm_convert_win(fm_enc($f)) ?>
                                </a>
                                <?php echo($is_link ? ' &rarr; <i>' . readlink($path . '/' . $f) . '</i>' : '') ?>
                        </div>
                    </td>
                    <td data-sort=b-"<?php echo str_pad($filesize_raw, 18, "0", STR_PAD_LEFT); ?>"><span title="<?php printf('%s bytes', $filesize_raw) ?>">
                        <?php echo $filesize; ?>
                        </span></td>
                    <td data-sort="b-<?php echo $modif_raw;?>"><?php echo $modif ?></td>
                    <?php if (!FM_IS_WIN && !$hide_Cols): ?>
                        <td><?php if (!FM_READONLY): ?><a title="<?php echo 'Change Permissions' ?>" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;chmod=<?php echo urlencode($f) ?>"><?php echo $perms ?></a><?php else: ?><?php echo $perms ?><?php endif; ?>
                        </td>
                        <td><?php echo fm_enc($owner['name'] . ':' . $group['name']) ?></td>
                    <?php endif; ?>
                    <td class="inline-actions">
                        <a title="<?php echo lng('Preview') ?>" href="<?php echo $filelink.'&quickView=1'; ?>" data-toggle="lightbox" data-gallery="tiny-gallery" data-title="<?php echo fm_convert_win(fm_enc($f)) ?>" data-max-width="100%" data-width="100%"><i class="fa fa-eye"></i></a>
                        <?php if (!FM_READONLY): ?>
                            <a title="<?php echo lng('Delete') ?>" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;del=<?php echo urlencode($f) ?>" onclick="return confirm('<?php echo lng('Delete').' '.lng('File').'?'; ?>\n \n ( <?php echo urlencode($f) ?> )');"> <i class="fa fa-trash-o"></i></a>
                            <a title="<?php echo lng('Rename') ?>" href="#" onclick="rename('<?php echo fm_enc(addslashes(FM_PATH)) ?>', '<?php echo fm_enc(addslashes($f)) ?>');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="<?php echo lng('CopyTo') ?>..."
                               href="?p=<?php echo urlencode(FM_PATH) ?>&amp;copy=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>"><i class="fa fa-files-o"></i></a>
                        <?php endif; ?>
                        <a title="<?php echo lng('DirectLink') ?>" href="<?php echo fm_enc(FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f) ?>" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="<?php echo lng('Download') ?>" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;dl=<?php echo urlencode($f) ?>"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                <?php
                flush();
                $ik++;
            }

            if (empty($folders) && empty($files)) {
                ?>
                <tfoot>
                    <tr><?php if (!FM_READONLY): ?>
                            <td></td><?php endif; ?>
                        <td colspan="<?php echo (!FM_IS_WIN && !$hide_Cols) ? '6' : '4' ?>"><em><?php echo 'Folder is empty' ?></em></td>
                    </tr>
                </tfoot>
                <?php
            } else {
                ?>
                <tfoot>
                    <tr><?php if (!FM_READONLY): ?>
                            <td class="gray"></td><?php endif; ?>
                        <td class="gray" colspan="<?php echo (!FM_IS_WIN && !$hide_Cols) ? '6' : '4' ?>">
                            <?php echo lng('FullSize').': <span class="badge badge-light">'.fm_get_filesize($all_files_size).'</span>' ?>
                            <?php echo lng('File').': <span class="badge badge-light">'.$num_files.'</span>' ?>
                            <?php echo lng('Folder').': <span class="badge badge-light">'.$num_folders.'</span>' ?>
                            <?php echo lng('PartitionSize').': <span class="badge badge-light">'.fm_get_filesize(@disk_free_space($path)) .'</span> '.lng('FreeOf').' <span class="badge badge-light">'.fm_get_filesize(@disk_total_space($path)).'</span>'; ?>
                        </td>
                    </tr>
                </tfoot>
                <?php
            }
            ?>
        </table>
    </div>

    <div class="row">
        <?php if (!FM_READONLY): ?>
        <div class="col-xs-12 col-sm-9">
            <ul class="list-inline footer-action">
                <li class="list-inline-item"> <a href="#/select-all" class="btn btn-small btn-outline-primary btn-2" onclick="select_all();return false;"><i class="fa fa-check-square"></i> <?php echo lng('SelectAll') ?> </a></li>
                <li class="list-inline-item"><a href="#/unselect-all" class="btn btn-small btn-outline-primary btn-2" onclick="unselect_all();return false;"><i class="fa fa-window-close"></i> <?php echo lng('UnSelectAll') ?> </a></li>
                <li class="list-inline-item"><a href="#/invert-all" class="btn btn-small btn-outline-primary btn-2" onclick="invert_all();return false;"><i class="fa fa-th-list"></i> <?php echo lng('InvertSelection') ?> </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="delete" id="a-delete" value="Delete" onclick="return confirm('<?php echo lng('Delete selected files and folders?'); ?>')">
                    <a href="javascript:document.getElementById('a-delete').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-trash"></i> <?php echo lng('Delete') ?> </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="zip" id="a-zip" value="zip" onclick="return confirm('<?php echo lng('Create archive?'); ?>')">
                    <a href="javascript:document.getElementById('a-zip').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-file-archive-o"></i> <?php echo lng('Zip') ?> </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="tar" id="a-tar" value="tar" onclick="return confirm('<?php echo lng('Create archive?'); ?>')">
                    <a href="javascript:document.getElementById('a-tar').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-file-archive-o"></i> <?php echo lng('Tar') ?> </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="copy" id="a-copy" value="Copy">
                    <a href="javascript:document.getElementById('a-copy').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-files-o"></i> <?php echo lng('Copy') ?> </a></li>
            </ul>
        </div>
        <div class="col-3 d-none d-sm-block"><a href="https://www.instagram.com/ki_sumbar/?hl=en" target="_blank" class="float-right text-muted">Komisi Informasi Sumatera Barat <?php echo VERSION; ?></a></div>
        <?php else: ?>
            <div class="col-12"><a href="https://www.instagram.com/ki_sumbar/?hl=en" target="_blank" class="float-right text-muted">Komisi Informasi Sumatera Barat <?php echo VERSION; ?></a></div>
        <?php endif; ?>
    </div>

</form>

<?php
fm_show_footer();

//--- END

// Functions

/**
 * Check if the filename is allowed.
 * @param string $filename
 * @return bool
 */
function fm_is_file_allowed($filename)
{
    // By default, no file is allowed
    $allowed = false;

    if (FM_EXTENSION) {
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, explode(',', strtolower(FM_EXTENSION)))) {
            $allowed = true;
        }
    }

    return $allowed;
}

/**
 * Delete  file or folder (recursively)
 * @param string $path
 * @return bool
 */
function fm_rdelete($path)
{
    if (is_link($path)) {
        return unlink($path);
    } elseif (is_dir($path)) {
        $objects = scandir($path);
        $ok = true;
        if (is_array($objects)) {
            foreach ($objects as $file) {
                if ($file != '.' && $file != '..') {
                    if (!fm_rdelete($path . '/' . $file)) {
                        $ok = false;
                    }
                }
            }
        }
        return ($ok) ? rmdir($path) : false;
    } elseif (is_file($path)) {
        return unlink($path);
    }
    return false;
}

/**
 * Recursive chmod
 * @param string $path
 * @param int $filemode
 * @param int $dirmode
 * @return bool
 * @todo Will use in mass chmod
 */
function fm_rchmod($path, $filemode, $dirmode)
{
    if (is_dir($path)) {
        if (!chmod($path, $dirmode)) {
            return false;
        }
        $objects = scandir($path);
        if (is_array($objects)) {
            foreach ($objects as $file) {
                if ($file != '.' && $file != '..') {
                    if (!fm_rchmod($path . '/' . $file, $filemode, $dirmode)) {
                        return false;
                    }
                }
            }
        }
        return true;
    } elseif (is_link($path)) {
        return true;
    } elseif (is_file($path)) {
        return chmod($path, $filemode);
    }
    return false;
}

/**
 * Check the file extension which is allowed or not
 * @param string $filename
 * @return bool
 */
function fm_is_valid_ext($filename)
{
    $allowed = (FM_FILE_EXTENSION) ? explode(',', FM_FILE_EXTENSION) : false;

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $isFileAllowed = ($allowed) ? in_array($ext, $allowed) : true;

    return ($isFileAllowed) ? true : false;
}

/**
 * Safely rename
 * @param string $old
 * @param string $new
 * @return bool|null
 */
function fm_rename($old, $new)
{
    $isFileAllowed = fm_is_valid_ext($new);

    if(!$isFileAllowed) return false;

    return (!file_exists($new) && file_exists($old)) ? rename($old, $new) : null;
}

/**
 * Copy file or folder (recursively).
 * @param string $path
 * @param string $dest
 * @param bool $upd Update files
 * @param bool $force Create folder with same names instead file
 * @return bool
 */
function fm_rcopy($path, $dest, $upd = true, $force = true)
{
    if (is_dir($path)) {
        if (!fm_mkdir($dest, $force)) {
            return false;
        }
        $objects = scandir($path);
        $ok = true;
        if (is_array($objects)) {
            foreach ($objects as $file) {
                if ($file != '.' && $file != '..') {
                    if (!fm_rcopy($path . '/' . $file, $dest . '/' . $file)) {
                        $ok = false;
                    }
                }
            }
        }
        return $ok;
    } elseif (is_file($path)) {
        return fm_copy($path, $dest, $upd);
    }
    return false;
}

/**
 * Safely create folder
 * @param string $dir
 * @param bool $force
 * @return bool
 */
function fm_mkdir($dir, $force)
{
    if (file_exists($dir)) {
        if (is_dir($dir)) {
            return $dir;
        } elseif (!$force) {
            return false;
        }
        unlink($dir);
    }
    return mkdir($dir, 0777, true);
}

/**
 * Safely copy file
 * @param string $f1
 * @param string $f2
 * @param bool $upd Indicates if file should be updated with new content
 * @return bool
 */
function fm_copy($f1, $f2, $upd)
{
    $time1 = filemtime($f1);
    if (file_exists($f2)) {
        $time2 = filemtime($f2);
        if ($time2 >= $time1 && $upd) {
            return false;
        }
    }
    $ok = copy($f1, $f2);
    if ($ok) {
        touch($f2, $time1);
    }
    return $ok;
}

/**
 * Get mime type
 * @param string $file_path
 * @return mixed|string
 */
function fm_get_mime_type($file_path)
{
    if (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file_path);
        finfo_close($finfo);
        return $mime;
    } elseif (function_exists('mime_content_type')) {
        return mime_content_type($file_path);
    } elseif (!stristr(ini_get('disable_functions'), 'shell_exec')) {
        $file = escapeshellarg($file_path);
        $mime = shell_exec('file -bi ' . $file);
        return $mime;
    } else {
        return '--';
    }
}

/**
 * HTTP Redirect
 * @param string $url
 * @param int $code
 */
function fm_redirect($url, $code = 302)
{
    header('Location: ' . $url, true, $code);
    exit;
}

/**
 * Path traversal prevention and clean the url
 * It replaces (consecutive) occurrences of / and \\ with whatever is in DIRECTORY_SEPARATOR, and processes /. and /.. fine.
 * @param $path
 * @return string
 */
function get_absolute_path($path) {
    $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
    $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
    $absolutes = array();
    foreach ($parts as $part) {
        if ('.' == $part) continue;
        if ('..' == $part) {
            array_pop($absolutes);
        } else {
            $absolutes[] = $part;
        }
    }
    return implode(DIRECTORY_SEPARATOR, $absolutes);
}

/**
 * Clean path
 * @param string $path
 * @return string
 */
function fm_clean_path($path, $trim = true)
{
    $path = $trim ? trim($path) : $path;
    $path = trim($path, '\\/');
    $path = str_replace(array('../', '..\\'), '', $path);
    $path =  get_absolute_path($path);
    if ($path == '..') {
        $path = '';
    }
    return str_replace('\\', '/', $path);
}

/**
 * Get parent path
 * @param string $path
 * @return bool|string
 */
function fm_get_parent_path($path)
{
    $path = fm_clean_path($path);
    if ($path != '') {
        $array = explode('/', $path);
        if (count($array) > 1) {
            $array = array_slice($array, 0, -1);
            return implode('/', $array);
        }
        return '';
    }
    return false;
}

/**
 * Check file is in exclude list
 * @param string $file
 * @return bool
 */
function fm_is_exclude_items($file) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (isset($exclude_items) and sizeof($exclude_items)) {
        unset($exclude_items);
    }

    $exclude_items = FM_EXCLUDE_ITEMS;
    if (version_compare(PHP_VERSION, '7.0.0', '<')) {
        $exclude_items = unserialize($exclude_items);
    }
    if (!in_array($file, $exclude_items) && !in_array("*.$ext", $exclude_items)) {
        return true;
    }
    return false;
}

/**
 * get language translations from json file
 * @param int $tr
 * @return array
 */
function fm_get_translations($tr) {
    try {
        $content = @file_get_contents('translation.json');
        if($content !== FALSE) {
            $lng = json_decode($content, TRUE);
            global $lang_list;
            foreach ($lng["language"] as $key => $value)
            {
                $code = $value["code"];
                $lang_list[$code] = $value["name"];
                if ($tr)
                    $tr[$code] = $value["translation"];
            }
            return $tr;
        }

    }
    catch (Exception $e) {
        echo $e;
    }
}

/**
 * @param $file
 * Recover all file sizes larger than > 2GB.
 * Works on php 32bits and 64bits and supports linux
 * @return int|string
 */
function fm_get_size($file)
{
    static $iswin;
    static $isdarwin;
    if (!isset($iswin)) {
        $iswin = (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN');
    }
    if (!isset($isdarwin)) {
        $isdarwin = (strtoupper(substr(PHP_OS, 0)) == "DARWIN");
    }

    static $exec_works;
    if (!isset($exec_works)) {
        $exec_works = (function_exists('exec') && !ini_get('safe_mode') && @exec('echo EXEC') == 'EXEC');
    }

    // try a shell command
    if ($exec_works) {
        $arg = escapeshellarg($file);
        $cmd = ($iswin) ? "for %F in (\"$file\") do @echo %~zF" : ($isdarwin ? "stat -f%z $arg" : "stat -c%s $arg");
        @exec($cmd, $output);
        if (is_array($output) && ctype_digit($size = trim(implode("\n", $output)))) {
            return $size;
        }
    }

    // try the Windows COM interface
    if ($iswin && class_exists("COM")) {
        try {
            $fsobj = new COM('Scripting.FileSystemObject');
            $f = $fsobj->GetFile( realpath($file) );
            $size = $f->Size;
        } catch (Exception $e) {
            $size = null;
        }
        if (ctype_digit($size)) {
            return $size;
        }
    }

    // if all else fails
    return filesize($file);
}

/**
 * Get nice filesize
 * @param int $size
 * @return string
 */
function fm_get_filesize($size)
{
    $size = (float) $size;
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1024)) : 0;
    return sprintf('%s %s', round($size / pow(1024, $power), 2), $units[$power]);
}

/**
 * Get director total size
 * @param string $directory
 * @return int
 */
function fm_get_directorysize($directory) {
    global $calc_folder;
    if ($calc_folder==true) { //  Slower output
      $size = 0;  $count= 0;  $dirCount= 0;
    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file)
    if ($file->isFile())
        {   $size+=$file->getSize();
            $count++;
        }
    else if ($file->isDir()) { $dirCount++; }
    // return [$size, $count, $dirCount];
    return $size;
    }
    else return 'Folder'; //  Quick output
}

/**
 * Get info about zip archive
 * @param string $path
 * @return array|bool
 */
function fm_get_zif_info($path, $ext) {
    if ($ext == 'zip' && function_exists('zip_open')) {
        $arch = zip_open($path);
        if ($arch) {
            $filenames = array();
            while ($zip_entry = zip_read($arch)) {
                $zip_name = zip_entry_name($zip_entry);
                $zip_folder = substr($zip_name, -1) == '/';
                $filenames[] = array(
                    'name' => $zip_name,
                    'filesize' => zip_entry_filesize($zip_entry),
                    'compressed_size' => zip_entry_compressedsize($zip_entry),
                    'folder' => $zip_folder
                    //'compression_method' => zip_entry_compressionmethod($zip_entry),
                );
            }
            zip_close($arch);
            return $filenames;
        }
    } elseif($ext == 'tar' && class_exists('PharData')) {
        $archive = new PharData($path);
        $filenames = array();
        foreach(new RecursiveIteratorIterator($archive) as $file) {
            $parent_info = $file->getPathInfo();
            $zip_name = str_replace("phar://".$path, '', $file->getPathName());
            $zip_name = substr($zip_name, ($pos = strpos($zip_name, '/')) !== false ? $pos + 1 : 0);
            $zip_folder = $parent_info->getFileName();
            $zip_info = new SplFileInfo($file);
            $filenames[] = array(
                'name' => $zip_name,
                'filesize' => $zip_info->getSize(),
                'compressed_size' => $file->getCompressedSize(),
                'folder' => $zip_folder
            );
        }
        return $filenames;
    }
    return false;
}

/**
 * Encode html entities
 * @param string $text
 * @return string
 */
function fm_enc($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Prevent XSS attacks
 * @param string $text
 * @return string
 */
function fm_isvalid_filename($text) {
    return (strpbrk($text, '/?%*:|"<>') === FALSE) ? true : false;
}

/**
 * Save message in session
 * @param string $msg
 * @param string $status
 */
function fm_set_msg($msg, $status = 'ok')
{
    $_SESSION[FM_SESSION_ID]['message'] = $msg;
    $_SESSION[FM_SESSION_ID]['status'] = $status;
}

/**
 * Check if string is in UTF-8
 * @param string $string
 * @return int
 */
function fm_is_utf8($string)
{
    return preg_match('//u', $string);
}

/**
 * Convert file name to UTF-8 in Windows
 * @param string $filename
 * @return string
 */
function fm_convert_win($filename)
{
    if (FM_IS_WIN && function_exists('iconv')) {
        $filename = iconv(FM_ICONV_INPUT_ENC, 'UTF-8//IGNORE', $filename);
    }
    return $filename;
}

/**
 * @param $obj
 * @return array
 */
function fm_object_to_array($obj)
{
    if (!is_object($obj) && !is_array($obj)) {
        return $obj;
    }
    if (is_object($obj)) {
        $obj = get_object_vars($obj);
    }
    return array_map('fm_object_to_array', $obj);
}

/**
 * Get CSS classname for file
 * @param string $path
 * @return string
 */
function fm_get_file_icon_class($path)
{
    // get extension
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

    switch ($ext) {
        case 'ico':
        case 'gif':
        case 'jpg':
        case 'jpeg':
        case 'jpc':
        case 'jp2':
        case 'jpx':
        case 'xbm':
        case 'wbmp':
        case 'png':
        case 'bmp':
        case 'tif':
        case 'tiff':
        case 'webp':
        case 'avif':
        case 'svg':
            $img = 'fa fa-picture-o';
            break;
        case 'passwd':
        case 'ftpquota':
        case 'sql':
        case 'js':
        case 'json':
        case 'sh':
        case 'config':
        case 'twig':
        case 'tpl':
        case 'md':
        case 'gitignore':
        case 'c':
        case 'cpp':
        case 'cs':
        case 'py':
        case 'rs':
        case 'map':
        case 'lock':
        case 'dtd':
            $img = 'fa fa-file-code-o';
            break;
        case 'txt':
        case 'ini':
        case 'conf':
        case 'log':
        case 'htaccess':
            $img = 'fa fa-file-text-o';
            break;
        case 'css':
        case 'less':
        case 'sass':
        case 'scss':
            $img = 'fa fa-css3';
            break;
        case 'bz2':
        case 'zip':
        case 'rar':
        case 'gz':
        case 'tar':
        case '7z':
        case 'xz':
            $img = 'fa fa-file-archive-o';
            break;
        case 'php':
        case 'php4':
        case 'php5':
        case 'phps':
        case 'phtml':
            $img = 'fa fa-code';
            break;
        case 'htm':
        case 'html':
        case 'shtml':
        case 'xhtml':
            $img = 'fa fa-html5';
            break;
        case 'xml':
        case 'xsl':
            $img = 'fa fa-file-excel-o';
            break;
        case 'wav':
        case 'mp3':
        case 'mp2':
        case 'm4a':
        case 'aac':
        case 'ogg':
        case 'oga':
        case 'wma':
        case 'mka':
        case 'flac':
        case 'ac3':
        case 'tds':
            $img = 'fa fa-music';
            break;
        case 'm3u':
        case 'm3u8':
        case 'pls':
        case 'cue':
        case 'xspf':
            $img = 'fa fa-headphones';
            break;
        case 'avi':
        case 'mpg':
        case 'mpeg':
        case 'mp4':
        case 'm4v':
        case 'flv':
        case 'f4v':
        case 'ogm':
        case 'ogv':
        case 'mov':
        case 'mkv':
        case '3gp':
        case 'asf':
        case 'wmv':
            $img = 'fa fa-file-video-o';
            break;
        case 'eml':
        case 'msg':
            $img = 'fa fa-envelope-o';
            break;
        case 'xls':
        case 'xlsx':
        case 'ods':
            $img = 'fa fa-file-excel-o';
            break;
        case 'csv':
            $img = 'fa fa-file-text-o';
            break;
        case 'bak':
        case 'swp':
            $img = 'fa fa-clipboard';
            break;
        case 'doc':
        case 'docx':
        case 'odt':
            $img = 'fa fa-file-word-o';
            break;
        case 'ppt':
        case 'pptx':
            $img = 'fa fa-file-powerpoint-o';
            break;
        case 'ttf':
        case 'ttc':
        case 'otf':
        case 'woff':
        case 'woff2':
        case 'eot':
        case 'fon':
            $img = 'fa fa-font';
            break;
        case 'pdf':
            $img = 'fa fa-file-pdf-o';
            break;
        case 'psd':
        case 'ai':
        case 'eps':
        case 'fla':
        case 'swf':
            $img = 'fa fa-file-image-o';
            break;
        case 'exe':
        case 'msi':
            $img = 'fa fa-file-o';
            break;
        case 'bat':
            $img = 'fa fa-terminal';
            break;
        default:
            $img = 'fa fa-info-circle';
    }

    return $img;
}

/**
 * Get image files extensions
 * @return array
 */
function fm_get_image_exts()
{
    return array('ico', 'gif', 'jpg', 'jpeg', 'jpc', 'jp2', 'jpx', 'xbm', 'wbmp', 'png', 'bmp', 'tif', 'tiff', 'psd', 'svg', 'webp', 'avif');
}

/**
 * Get video files extensions
 * @return array
 */
function fm_get_video_exts()
{
    return array('avi', 'webm', 'wmv', 'mp4', 'm4v', 'ogm', 'ogv', 'mov', 'mkv');
}

/**
 * Get audio files extensions
 * @return array
 */
function fm_get_audio_exts()
{
    return array('wav', 'mp3', 'ogg', 'm4a');
}

/**
 * Get text file extensions
 * @return array
 */
function fm_get_text_exts()
{
    return array(
        'txt', 'css', 'ini', 'conf', 'log', 'htaccess', 'passwd', 'ftpquota', 'sql', 'js', 'json', 'sh', 'config',
        'php', 'php4', 'php5', 'phps', 'phtml', 'htm', 'html', 'shtml', 'xhtml', 'xml', 'xsl', 'm3u', 'm3u8', 'pls', 'cue',
        'eml', 'msg', 'csv', 'bat', 'twig', 'tpl', 'md', 'gitignore', 'less', 'sass', 'scss', 'c', 'cpp', 'cs', 'py',
        'map', 'lock', 'dtd', 'svg', 'scss', 'asp', 'aspx', 'asx', 'asmx', 'ashx', 'jsx', 'jsp', 'jspx', 'cfm', 'cgi'
    );
}

/**
 * Get mime types of text files
 * @return array
 */
function fm_get_text_mimes()
{
    return array(
        'application/xml',
        'application/javascript',
        'application/x-javascript',
        'image/svg+xml',
        'message/rfc822',
    );
}

/**
 * Get file names of text files w/o extensions
 * @return array
 */
function fm_get_text_names()
{
    return array(
        'license',
        'readme',
        'authors',
        'contributors',
        'changelog',
    );
}

/**
 * Get online docs viewer supported files extensions
 * @return array
 */
function fm_get_onlineViewer_exts()
{
    return array('doc', 'docx', 'xls', 'xlsx', 'pdf', 'ppt', 'pptx', 'ai', 'psd', 'dxf', 'xps', 'rar', 'odt', 'ods');
}

function fm_get_file_mimes($extension)
{
    $fileTypes['swf'] = 'application/x-shockwave-flash';
    $fileTypes['pdf'] = 'application/pdf';
    $fileTypes['exe'] = 'application/octet-stream';
    $fileTypes['zip'] = 'application/zip';
    $fileTypes['doc'] = 'application/msword';
    $fileTypes['xls'] = 'application/vnd.ms-excel';
    $fileTypes['ppt'] = 'application/vnd.ms-powerpoint';
    $fileTypes['gif'] = 'image/gif';
    $fileTypes['png'] = 'image/png';
    $fileTypes['jpeg'] = 'image/jpg';
    $fileTypes['jpg'] = 'image/jpg';
    $fileTypes['webp'] = 'image/webp';
    $fileTypes['avif'] = 'image/avif';
    $fileTypes['rar'] = 'application/rar';

    $fileTypes['ra'] = 'audio/x-pn-realaudio';
    $fileTypes['ram'] = 'audio/x-pn-realaudio';
    $fileTypes['ogg'] = 'audio/x-pn-realaudio';

    $fileTypes['wav'] = 'video/x-msvideo';
    $fileTypes['wmv'] = 'video/x-msvideo';
    $fileTypes['avi'] = 'video/x-msvideo';
    $fileTypes['asf'] = 'video/x-msvideo';
    $fileTypes['divx'] = 'video/x-msvideo';

    $fileTypes['mp3'] = 'audio/mpeg';
    $fileTypes['mp4'] = 'audio/mpeg';
    $fileTypes['mpeg'] = 'video/mpeg';
    $fileTypes['mpg'] = 'video/mpeg';
    $fileTypes['mpe'] = 'video/mpeg';
    $fileTypes['mov'] = 'video/quicktime';
    $fileTypes['swf'] = 'video/quicktime';
    $fileTypes['3gp'] = 'video/quicktime';
    $fileTypes['m4a'] = 'video/quicktime';
    $fileTypes['aac'] = 'video/quicktime';
    $fileTypes['m3u'] = 'video/quicktime';

    $fileTypes['php'] = ['application/x-php'];
    $fileTypes['html'] = ['text/html'];
    $fileTypes['txt'] = ['text/plain'];
    //Unknown mime-types should be 'application/octet-stream'
    if(empty($fileTypes[$extension])) {
      $fileTypes[$extension] = ['application/octet-stream'];
    }
    return $fileTypes[$extension];
}

/**
 * This function scans the files and folder recursively, and return matching files
 * @param string $dir
 * @param string $filter
 * @return json
 */
 function scan($dir, $filter = '') {
    $path = FM_ROOT_PATH.'/'.$dir;
     if($dir) {
         $ite = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
         $rii = new RegexIterator($ite, "/(" . $filter . ")/i");

         $files = array();
         foreach ($rii as $file) {
             if (!$file->isDir()) {
                 $fileName = $file->getFilename();
                 $location = str_replace(FM_ROOT_PATH, '', $file->getPath());
                 $files[] = array(
                     "name" => $fileName,
                     "type" => "file",
                     "path" => $location,
                 );
             }
         }
         return $files;
     }
}

/*
Parameters: downloadFile(File Location, File Name,
max speed, is streaming
If streaming - videos will show as videos, images as images
instead of download prompt
https://stackoverflow.com/a/13821992/1164642
*/

function fm_download_file($fileLocation, $fileName, $chunkSize  = 1024)
{
    if (connection_status() != 0)
        return (false);
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);

    $contentType = fm_get_file_mimes($extension);
    header("Cache-Control: public");
    header("Content-Transfer-Encoding: binary\n");
    header('Content-Type: $contentType');

    $contentDisposition = 'attachment';


    if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {
        $fileName = preg_replace('/\./', '%2e', $fileName, substr_count($fileName, '.') - 1);
        header("Content-Disposition: $contentDisposition;filename=\"$fileName\"");
    } else {
        header("Content-Disposition: $contentDisposition;filename=\"$fileName\"");
    }

    header("Accept-Ranges: bytes");
    $range = 0;
    $size = filesize($fileLocation);

    if (isset($_SERVER['HTTP_RANGE'])) {
        list($a, $range) = explode("=", $_SERVER['HTTP_RANGE']);
        str_replace($range, "-", $range);
        $size2 = $size - 1;
        $new_length = $size - $range;
        header("HTTP/1.1 206 Partial Content");
        header("Content-Length: $new_length");
        header("Content-Range: bytes $range$size2/$size");
    } else {
        $size2 = $size - 1;
        header("Content-Range: bytes 0-$size2/$size");
        header("Content-Length: " . $size);
    }

    if ($size == 0) {
        die('Zero byte file! Aborting download');
    }
    @ini_set('magic_quotes_runtime', 0);
    $fp = fopen("$fileLocation", "rb");

    fseek($fp, $range);

    while (!feof($fp) and (connection_status() == 0)) {
        set_time_limit(0);
        print(@fread($fp, 1024*$chunkSize));
        flush();
        ob_flush();
        // sleep(1);
    }
    fclose($fp);

    return ((connection_status() == 0) and !connection_aborted());
}

function fm_get_theme() {
    $result = '';
    if(FM_THEME == "dark") {
        $result = "text-white bg-dark";
    }
    return $result;
}

/**
 * Class to work with zip files (using ZipArchive)
 */
class FM_Zipper
{
    private $zip;

    public function __construct()
    {
        $this->zip = new ZipArchive();
    }

    /**
     * Create archive with name $filename and files $files (RELATIVE PATHS!)
     * @param string $filename
     * @param array|string $files
     * @return bool
     */
    public function create($filename, $files)
    {
        $res = $this->zip->open($filename, ZipArchive::CREATE);
        if ($res !== true) {
            return false;
        }
        if (is_array($files)) {
            foreach ($files as $f) {
                if (!$this->addFileOrDir($f)) {
                    $this->zip->close();
                    return false;
                }
            }
            $this->zip->close();
            return true;
        } else {
            if ($this->addFileOrDir($files)) {
                $this->zip->close();
                return true;
            }
            return false;
        }
    }

    /**
     * Extract archive $filename to folder $path (RELATIVE OR ABSOLUTE PATHS)
     * @param string $filename
     * @param string $path
     * @return bool
     */
    public function unzip($filename, $path)
    {
        $res = $this->zip->open($filename);
        if ($res !== true) {
            return false;
        }
        if ($this->zip->extractTo($path)) {
            $this->zip->close();
            return true;
        }
        return false;
    }

    /**
     * Add file/folder to archive
     * @param string $filename
     * @return bool
     */
    private function addFileOrDir($filename)
    {
        if (is_file($filename)) {
            return $this->zip->addFile($filename);
        } elseif (is_dir($filename)) {
            return $this->addDir($filename);
        }
        return false;
    }

    /**
     * Add folder recursively
     * @param string $path
     * @return bool
     */
    private function addDir($path)
    {
        if (!$this->zip->addEmptyDir($path)) {
            return false;
        }
        $objects = scandir($path);
        if (is_array($objects)) {
            foreach ($objects as $file) {
                if ($file != '.' && $file != '..') {
                    if (is_dir($path . '/' . $file)) {
                        if (!$this->addDir($path . '/' . $file)) {
                            return false;
                        }
                    } elseif (is_file($path . '/' . $file)) {
                        if (!$this->zip->addFile($path . '/' . $file)) {
                            return false;
                        }
                    }
                }
            }
            return true;
        }
        return false;
    }
}

/**
 * Class to work with Tar files (using PharData)
 */
class FM_Zipper_Tar
{
    private $tar;

    public function __construct()
    {
        $this->tar = null;
    }

    /**
     * Create archive with name $filename and files $files (RELATIVE PATHS!)
     * @param string $filename
     * @param array|string $files
     * @return bool
     */
    public function create($filename, $files)
    {
        $this->tar = new PharData($filename);
        if (is_array($files)) {
            foreach ($files as $f) {
                if (!$this->addFileOrDir($f)) {
                    return false;
                }
            }
            return true;
        } else {
            if ($this->addFileOrDir($files)) {
                return true;
            }
            return false;
        }
    }

    /**
     * Extract archive $filename to folder $path (RELATIVE OR ABSOLUTE PATHS)
     * @param string $filename
     * @param string $path
     * @return bool
     */
    public function unzip($filename, $path)
    {
        $res = $this->tar->open($filename);
        if ($res !== true) {
            return false;
        }
        if ($this->tar->extractTo($path)) {
            return true;
        }
        return false;
    }

    /**
     * Add file/folder to archive
     * @param string $filename
     * @return bool
     */
    private function addFileOrDir($filename)
    {
        if (is_file($filename)) {
            try {
                $this->tar->addFile($filename);
                return true;
            } catch (Exception $e) {
                return false;
            }
        } elseif (is_dir($filename)) {
            return $this->addDir($filename);
        }
        return false;
    }

    /**
     * Add folder recursively
     * @param string $path
     * @return bool
     */
    private function addDir($path)
    {
        $objects = scandir($path);
        if (is_array($objects)) {
            foreach ($objects as $file) {
                if ($file != '.' && $file != '..') {
                    if (is_dir($path . '/' . $file)) {
                        if (!$this->addDir($path . '/' . $file)) {
                            return false;
                        }
                    } elseif (is_file($path . '/' . $file)) {
                        try {
                            $this->tar->addFile($path . '/' . $file);
                        } catch (Exception $e) {
                            return false;
                        }
                    }
                }
            }
            return true;
        }
        return false;
    }
}



/**
 * Save Configuration
 */
 class FM_Config
{
     var $data;

    function __construct()
    {
        global $root_path, $root_url, $CONFIG;
        $fm_url = $root_url.$_SERVER["PHP_SELF"];
        $this->data = array(
            'lang' => 'en',
            'error_reporting' => true,
            'show_hidden' => true
        );
        $data = false;
        if (strlen($CONFIG)) {
            $data = fm_object_to_array(json_decode($CONFIG));
        } else {
            $msg = 'Komisi Informasi Sumatera Barat<br>Error: Cannot load configuration';
            if (substr($fm_url, -1) == '/') {
                $fm_url = rtrim($fm_url, '/');
                $msg .= '<br>';
                $msg .= '<br>Seems like you have a trailing slash on the URL.';
                $msg .= '<br>Try this link: <a href="' . $fm_url . '">' . $fm_url . '</a>';
            }
            die($msg);
        }
        if (is_array($data) && count($data)) $this->data = $data;
        else $this->save();
    }

    function save()
    {
        $fm_file = __FILE__;
        $var_name = '$CONFIG';
        $var_value = var_export(json_encode($this->data), true);
        $config_string = "<?php" . chr(13) . chr(10) . "//Default Configuration".chr(13) . chr(10)."$var_name = $var_value;" . chr(13) . chr(10);
        if (is_writable($fm_file)) {
            $lines = file($fm_file);
            if ($fh = @fopen($fm_file, "w")) {
                @fputs($fh, $config_string, strlen($config_string));
                for ($x = 3; $x < count($lines); $x++) {
                    @fputs($fh, $lines[$x], strlen($lines[$x]));
                }
                @fclose($fh);
            }
        }
    }
}



//--- templates functions

/**
 * Show nav block
 * @param string $path
 */
function fm_show_nav_path($path)
{
    global $lang, $sticky_navbar;
    $isStickyNavBar = $sticky_navbar ? 'fixed-top' : '';
    $getTheme = fm_get_theme();
    $getTheme .= " navbar-light";
    if(FM_THEME == "dark") {
        $getTheme .= " navbar-dark";
    } else {
        $getTheme .= " bg-white";
    }
    ?>
    <nav class="navbar navbar-expand-lg <?php echo $getTheme; ?> mb-4 main-nav <?php echo $isStickyNavBar ?>">
        <a class="navbar-brand" href=""> <?php echo lng('AppTitle') ?> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <?php
            $path = fm_clean_path($path);
            $root_url = "<a href='?p='><i class='fa fa-home' aria-hidden='true' title='" . FM_ROOT_PATH . "'></i></a>";
            $sep = '<i class="bread-crumb"> / </i>';
            if ($path != '') {
                $exploded = explode('/', $path);
                $count = count($exploded);
                $array = array();
                $parent = '';
                for ($i = 0; $i < $count; $i++) {
                    $parent = trim($parent . '/' . $exploded[$i], '/');
                    $parent_enc = urlencode($parent);
                    $array[] = "<a href='?p={$parent_enc}'>" . fm_enc(fm_convert_win($exploded[$i])) . "</a>";
                }
                $root_url .= $sep . implode($sep, $array);
            }
            echo '<div class="col-xs-6 col-sm-5">' . $root_url . '</div>';
            ?>

            <div class="col-xs-6 col-sm-7 text-right">
                <ul class="navbar-nav mr-auto float-right <?php echo fm_get_theme();  ?>">
                    <li class="nav-item mr-2">
                        <div class="input-group input-group-sm mr-1" style="margin-top:4px;">
                            <input type="text" class="form-control" placeholder="<?php echo lng('Search') ?>" aria-label="<?php echo lng('Search') ?>" aria-describedby="search-addon2" id="search-addon">
                            <div class="input-group-append">
                                <span class="input-group-text" id="search-addon2"><i class="fa fa-search"></i></span>
                            </div>
                            <div class="input-group-append btn-group">
                                <span class="input-group-text dropdown-toggle" id="search-addon2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                  <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="<?php echo $path2 = $path ? $path : '.'; ?>" id="js-search-modal" data-toggle="modal" data-target="#searchModal"><?php echo lng('Advanced Search') ?></a>
                                  </div>
                            </div>
                        </div>
                    </li>
                    <?php if (!FM_READONLY): ?>
                    <li class="nav-item">
                        <a title="<?php echo lng('Upload') ?>" class="nav-link" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;upload"><i class="fa fa-cloud-upload" aria-hidden="true"></i> <?php echo lng('Upload') ?></a>
                    </li>
                    <li class="nav-item">
                        <a title="<?php echo lng('NewItem') ?>" class="nav-link" href="#createNewItem" data-toggle="modal" data-target="#createNewItem"><i class="fa fa-plus-square"></i> <?php echo lng('NewItem') ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (FM_USE_AUTH): ?>
                    <li class="nav-item avatar dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user-circle"></i> <?php if(isset($_SESSION[FM_SESSION_ID]['logged'])) { echo $_SESSION[FM_SESSION_ID]['logged']; } ?></a>
                        <div class="dropdown-menu dropdown-menu-right <?php echo fm_get_theme(); ?>" aria-labelledby="navbarDropdownMenuLink-5">
                            <?php if (!FM_READONLY): ?>
                            <a title="<?php echo lng('Settings') ?>" class="dropdown-item nav-link" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;settings=1"><i class="fa fa-cog" aria-hidden="true"></i> <?php echo lng('Settings') ?></a>
                            <?php endif ?>
                            <a title="<?php echo lng('Help') ?>" class="dropdown-item nav-link" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;help=2"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo lng('Help') ?></a>
                            <a title="<?php echo lng('Logout') ?>" class="dropdown-item nav-link" href="?logout=1"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo lng('Logout') ?></a>
                        </div>
                    </li>
                    <?php else: ?>
                        <?php if (!FM_READONLY): ?>
                            <li class="nav-item">
                                <a title="<?php echo lng('Settings') ?>" class="dropdown-item nav-link" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;settings=1"><i class="fa fa-cog" aria-hidden="true"></i> <?php echo lng('Settings') ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
}

/**
 * Show message from session
 */
function fm_show_message()
{
    if (isset($_SESSION[FM_SESSION_ID]['message'])) {
        $class = isset($_SESSION[FM_SESSION_ID]['status']) ? $_SESSION[FM_SESSION_ID]['status'] : 'ok';
        echo '<p class="message ' . $class . '">' . $_SESSION[FM_SESSION_ID]['message'] . '</p>';
        unset($_SESSION[FM_SESSION_ID]['message']);
        unset($_SESSION[FM_SESSION_ID]['status']);
    }
}

/**
 * Show page header in Login Form
 */
function fm_show_header_login()
{
$sprites_ver = '20160315';
header("Content-Type: text/html; charset=utf-8");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");

global $lang, $root_url, $favicon_path;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Web based File Manager in PHP, Manage your files efficiently and easily with KI cPanel">
    <meta name="author" content="Komisi Informasi Sumatera Barat">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex">
    <?php if($favicon_path) { echo '<link rel="icon" href="'.fm_enc($favicon_path).'" type="image/png">'; } ?>
    <title><?php echo fm_enc(APP_TITLE) ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body.fm-login-page{ background-color:#f7f9fb;font-size:14px;background-color:#f7f9fb;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 304 304' width='304' height='304'%3E%3Cpath fill='%23e2e9f1' fill-opacity='0.4' d='M44.1 224a5 5 0 1 1 0 2H0v-2h44.1zm160 48a5 5 0 1 1 0 2H82v-2h122.1zm57.8-46a5 5 0 1 1 0-2H304v2h-42.1zm0 16a5 5 0 1 1 0-2H304v2h-42.1zm6.2-114a5 5 0 1 1 0 2h-86.2a5 5 0 1 1 0-2h86.2zm-256-48a5 5 0 1 1 0 2H0v-2h12.1zm185.8 34a5 5 0 1 1 0-2h86.2a5 5 0 1 1 0 2h-86.2zM258 12.1a5 5 0 1 1-2 0V0h2v12.1zm-64 208a5 5 0 1 1-2 0v-54.2a5 5 0 1 1 2 0v54.2zm48-198.2V80h62v2h-64V21.9a5 5 0 1 1 2 0zm16 16V64h46v2h-48V37.9a5 5 0 1 1 2 0zm-128 96V208h16v12.1a5 5 0 1 1-2 0V210h-16v-76.1a5 5 0 1 1 2 0zm-5.9-21.9a5 5 0 1 1 0 2H114v48H85.9a5 5 0 1 1 0-2H112v-48h12.1zm-6.2 130a5 5 0 1 1 0-2H176v-74.1a5 5 0 1 1 2 0V242h-60.1zm-16-64a5 5 0 1 1 0-2H114v48h10.1a5 5 0 1 1 0 2H112v-48h-10.1zM66 284.1a5 5 0 1 1-2 0V274H50v30h-2v-32h18v12.1zM236.1 176a5 5 0 1 1 0 2H226v94h48v32h-2v-30h-48v-98h12.1zm25.8-30a5 5 0 1 1 0-2H274v44.1a5 5 0 1 1-2 0V146h-10.1zm-64 96a5 5 0 1 1 0-2H208v-80h16v-14h-42.1a5 5 0 1 1 0-2H226v18h-16v80h-12.1zm86.2-210a5 5 0 1 1 0 2H272V0h2v32h10.1zM98 101.9V146H53.9a5 5 0 1 1 0-2H96v-42.1a5 5 0 1 1 2 0zM53.9 34a5 5 0 1 1 0-2H80V0h2v34H53.9zm60.1 3.9V66H82v64H69.9a5 5 0 1 1 0-2H80V64h32V37.9a5 5 0 1 1 2 0zM101.9 82a5 5 0 1 1 0-2H128V37.9a5 5 0 1 1 2 0V82h-28.1zm16-64a5 5 0 1 1 0-2H146v44.1a5 5 0 1 1-2 0V18h-26.1zm102.2 270a5 5 0 1 1 0 2H98v14h-2v-16h124.1zM242 149.9V160h16v34h-16v62h48v48h-2v-46h-48v-66h16v-30h-16v-12.1a5 5 0 1 1 2 0zM53.9 18a5 5 0 1 1 0-2H64V2H48V0h18v18H53.9zm112 32a5 5 0 1 1 0-2H192V0h50v2h-48v48h-28.1zm-48-48a5 5 0 0 1-9.8-2h2.07a3 3 0 1 0 5.66 0H178v34h-18V21.9a5 5 0 1 1 2 0V32h14V2h-58.1zm0 96a5 5 0 1 1 0-2H137l32-32h39V21.9a5 5 0 1 1 2 0V66h-40.17l-32 32H117.9zm28.1 90.1a5 5 0 1 1-2 0v-76.51L175.59 80H224V21.9a5 5 0 1 1 2 0V82h-49.59L146 112.41v75.69zm16 32a5 5 0 1 1-2 0v-99.51L184.59 96H300.1a5 5 0 0 1 3.9-3.9v2.07a3 3 0 0 0 0 5.66v2.07a5 5 0 0 1-3.9-3.9H185.41L162 121.41v98.69zm-144-64a5 5 0 1 1-2 0v-3.51l48-48V48h32V0h2v50H66v55.41l-48 48v2.69zM50 53.9v43.51l-48 48V208h26.1a5 5 0 1 1 0 2H0v-65.41l48-48V53.9a5 5 0 1 1 2 0zm-16 16V89.41l-34 34v-2.82l32-32V69.9a5 5 0 1 1 2 0zM12.1 32a5 5 0 1 1 0 2H9.41L0 43.41V40.6L8.59 32h3.51zm265.8 18a5 5 0 1 1 0-2h18.69l7.41-7.41v2.82L297.41 50H277.9zm-16 160a5 5 0 1 1 0-2H288v-71.41l16-16v2.82l-14 14V210h-28.1zm-208 32a5 5 0 1 1 0-2H64v-22.59L40.59 194H21.9a5 5 0 1 1 0-2H41.41L66 216.59V242H53.9zm150.2 14a5 5 0 1 1 0 2H96v-56.6L56.6 162H37.9a5 5 0 1 1 0-2h19.5L98 200.6V256h106.1zm-150.2 2a5 5 0 1 1 0-2H80v-46.59L48.59 178H21.9a5 5 0 1 1 0-2H49.41L82 208.59V258H53.9zM34 39.8v1.61L9.41 66H0v-2h8.59L32 40.59V0h2v39.8zM2 300.1a5 5 0 0 1 3.9 3.9H3.83A3 3 0 0 0 0 302.17V256h18v48h-2v-46H2v42.1zM34 241v63h-2v-62H0v-2h34v1zM17 18H0v-2h16V0h2v18h-1zm273-2h14v2h-16V0h2v16zm-32 273v15h-2v-14h-14v14h-2v-16h18v1zM0 92.1A5.02 5.02 0 0 1 6 97a5 5 0 0 1-6 4.9v-2.07a3 3 0 1 0 0-5.66V92.1zM80 272h2v32h-2v-32zm37.9 32h-2.07a3 3 0 0 0-5.66 0h-2.07a5 5 0 0 1 9.8 0zM5.9 0A5.02 5.02 0 0 1 0 5.9V3.83A3 3 0 0 0 3.83 0H5.9zm294.2 0h2.07A3 3 0 0 0 304 3.83V5.9a5 5 0 0 1-3.9-5.9zm3.9 300.1v2.07a3 3 0 0 0-1.83 1.83h-2.07a5 5 0 0 1 3.9-3.9zM97 100a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-48 32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32 48a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16-64a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 96a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-144a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-96 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm96 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16-64a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-32 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM49 36a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-32 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM33 68a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-48a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 240a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16-64a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm80-176a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32 48a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm112 176a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM17 180a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM17 84a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32 64a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6z'%3E%3C/path%3E%3C/svg%3E");}
        .fm-login-page .brand{ width:121px;overflow:hidden;margin:0 auto;position:relative;z-index:1}
        .fm-login-page .brand img{ width:100%}
        .fm-login-page .card-wrapper{ width:360px;margin-top:10%;margin-left:auto;margin-right:auto;}
        .fm-login-page .card{ border-color:transparent;box-shadow:0 4px 8px rgba(0,0,0,.05)}
        .fm-login-page .card-title{ margin-bottom:1.5rem;font-size:24px;font-weight:400;}
        .fm-login-page .form-control{ border-width:2.3px}
        .fm-login-page .form-group label{ width:100%}
        .fm-login-page .btn.btn-block{ padding:12px 10px}
        .fm-login-page .footer{ margin:40px 0;color:#888;text-align:center}
        @media screen and (max-width:425px){
            .fm-login-page .card-wrapper{ width:90%;margin:0 auto;margin-top:10%;}
        }
        @media screen and (max-width:320px){
            .fm-login-page .card.fat{ padding:0}
            .fm-login-page .card.fat .card-body{ padding:15px}
        }
        .message{ padding:4px 7px;border:1px solid #ddd;background-color:#fff}
        .message.ok{ border-color:green;color:green}
        .message.error{ border-color:red;color:red}
        .message.alert{ border-color:orange;color:orange}
        body.fm-login-page.theme-dark {background-color: #2f2a2a;}
        .theme-dark svg g, .theme-dark svg path {fill: #ffffff; }
    </style>
</head>
<body class="fm-login-page <?php echo (FM_THEME == "dark") ? 'theme-dark' : ''; ?>">
<div id="wrapper" class="container-fluid">

    <?php
    }

    /**
     * Show page footer in Login Form
     */
    function fm_show_footer_login()
    {
    ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
<?php
}

/**
 * Show Header after login
 */
function fm_show_header()
{
$sprites_ver = '20160315';
header("Content-Type: text/html; charset=utf-8");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");

global $lang, $root_url, $sticky_navbar, $favicon_path;
$isStickyNavBar = $sticky_navbar ? 'navbar-fixed' : 'navbar-normal';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Web based File Manager in PHP, Manage your files efficiently and easily with KISB cPanel">
    <meta name="author" content="Komisi Informasi Sumatera Barat">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex">
    <?php if($favicon_path) { echo '<link rel="icon" href="'.fm_enc($favicon_path).'" type="image/png">'; } ?>
    <title><?php echo fm_enc(APP_TITLE) ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" />
    <?php if (FM_USE_HIGHLIGHTJS): ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.6.0/styles/<?php echo FM_HIGHLIGHTJS_STYLE ?>.min.css">
    <?php endif; ?>
    <style>
        body { font-size:14px;color:#222;background:#F7F7F7; }
        body.navbar-fixed { margin-top:55px; }
        a:hover, a:visited, a:focus { text-decoration:none !important; }
        * { -webkit-border-radius:0 !important;-moz-border-radius:0 !important;border-radius:0 !important; }
        .filename, td, th { white-space:nowrap  }
        .navbar-brand { font-weight:bold; }
        .nav-item.avatar a { cursor:pointer;text-transform:capitalize; }
        .nav-item.avatar a > i { font-size:15px; }
        .nav-item.avatar .dropdown-menu a { font-size:13px; }
        #search-addon { font-size:12px;border-right-width:0; }
        #search-addon2 { background:transparent;border-left:0; }
        .bread-crumb { color:#cccccc;font-style:normal; }
        #main-table .filename a { color:#222222; }
        .table td, .table th { vertical-align:middle !important; }
        .table .custom-checkbox-td .custom-control.custom-checkbox, .table .custom-checkbox-header .custom-control.custom-checkbox { min-width:18px; }
        .table-sm td, .table-sm th { padding:.4rem; }
        .table-bordered td, .table-bordered th { border:1px solid #f1f1f1; }
        .hidden { display:none  }
        pre.with-hljs { padding:0  }
        pre.with-hljs code { margin:0;border:0;overflow:visible  }
        code.maxheight, pre.maxheight { max-height:512px  }
        .fa.fa-caret-right { font-size:1.2em;margin:0 4px;vertical-align:middle;color:#ececec  }
        .fa.fa-home { font-size:1.3em;vertical-align:bottom  }
        .path { margin-bottom:10px  }
        form.dropzone { min-height:200px;border:2px dashed #007bff;line-height:6rem; }
        .right { text-align:right  }
        .center, .close, .login-form { text-align:center  }
        .message { padding:4px 7px;border:1px solid #ddd;background-color:#fff  }
        .message.ok { border-color:green;color:green  }
        .message.error { border-color:red;color:red  }
        .message.alert { border-color:orange;color:orange  }
        .preview-img { max-width:100%;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAAKklEQVR42mL5//8/Azbw+PFjrOJMDCSCUQ3EABZc4S0rKzsaSvTTABBgAMyfCMsY4B9iAAAAAElFTkSuQmCC)  }
        .inline-actions > a > i { font-size:1em;margin-left:5px;background:#3785c1;color:#fff;padding:3px;border-radius:3px  }
        .preview-video { position:relative;max-width:100%;height:0;padding-bottom:62.5%;margin-bottom:10px  }
        .preview-video video { position:absolute;width:100%;height:100%;left:0;top:0;background:#000  }
        .compact-table { border:0;width:auto  }
        .compact-table td, .compact-table th { width:100px;border:0;text-align:center  }
        .compact-table tr:hover td { background-color:#fff  }
        .filename { max-width:420px;overflow:hidden;text-overflow:ellipsis  }
        .break-word { word-wrap:break-word;margin-left:30px  }
        .break-word.float-left a { color:#7d7d7d  }
        .break-word + .float-right { padding-right:30px;position:relative  }
        .break-word + .float-right > a { color:#7d7d7d;font-size:1.2em;margin-right:4px  }
        #editor { position:absolute;right:15px;top:100px;bottom:15px;left:15px  }
        @media (max-width:481px) {
            #editor { top:150px; }
        }
        #normal-editor { border-radius:3px;border-width:2px;padding:10px;outline:none; }
        .btn-2 { border-radius:0;padding:3px 6px;font-size:small; }
        li.file:before,li.folder:before { font:normal normal normal 14px/1 FontAwesome;content:"\f016";margin-right:5px }
        li.folder:before { content:"\f114" }
        i.fa.fa-folder-o { color:#0157b3 }
        i.fa.fa-picture-o { color:#26b99a }
        i.fa.fa-file-archive-o { color:#da7d7d }
        .btn-2 i.fa.fa-file-archive-o { color:inherit }
        i.fa.fa-css3 { color:#f36fa0 }
        i.fa.fa-file-code-o { color:#007bff }
        i.fa.fa-code { color:#cc4b4c }
        i.fa.fa-file-text-o { color:#0096e6 }
        i.fa.fa-html5 { color:#d75e72 }
        i.fa.fa-file-excel-o { color:#09c55d }
        i.fa.fa-file-powerpoint-o { color:#f6712e }
        i.go-back { font-size:1.2em;color:#007bff; }
        .main-nav { padding:0.2rem 1rem;box-shadow:0 4px 5px 0 rgba(0, 0, 0, .14), 0 1px 10px 0 rgba(0, 0, 0, .12), 0 2px 4px -1px rgba(0, 0, 0, .2)  }
        .dataTables_filter { display:none; }
        table.dataTable thead .sorting { cursor:pointer;background-repeat:no-repeat;background-position:center right;background-image:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAQAAADYWf5HAAAAkElEQVQoz7XQMQ5AQBCF4dWQSJxC5wwax1Cq1e7BAdxD5SL+Tq/QCM1oNiJidwox0355mXnG/DrEtIQ6azioNZQxI0ykPhTQIwhCR+BmBYtlK7kLJYwWCcJA9M4qdrZrd8pPjZWPtOqdRQy320YSV17OatFC4euts6z39GYMKRPCTKY9UnPQ6P+GtMRfGtPnBCiqhAeJPmkqAAAAAElFTkSuQmCC'); }
        table.dataTable thead .sorting_asc { cursor:pointer;background-repeat:no-repeat;background-position:center right;background-image:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAAAZ0lEQVQ4y2NgGLKgquEuFxBPAGI2ahhWCsS/gDibUoO0gPgxEP8H4ttArEyuQYxAPBdqEAxPBImTY5gjEL9DM+wTENuQahAvEO9DMwiGdwAxOymGJQLxTyD+jgWDxCMZRsEoGAVoAADeemwtPcZI2wAAAABJRU5ErkJggg=='); }
        table.dataTable thead .sorting_desc { cursor:pointer;background-repeat:no-repeat;background-position:center right;background-image:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAAAZUlEQVQ4y2NgGAWjYBSggaqGu5FA/BOIv2PBIPFEUgxjB+IdQPwfC94HxLykus4GiD+hGfQOiB3J8SojEE9EM2wuSJzcsFMG4ttQgx4DsRalkZENxL+AuJQaMcsGxBOAmGvopk8AVz1sLZgg0bsAAAAASUVORK5CYII='); }
        table.dataTable thead tr:first-child th.custom-checkbox-header:first-child { background-image:none; }
        .footer-action li { margin-bottom:10px; }
        .app-v-title { font-size:24px;font-weight:300;letter-spacing:-.5px;text-transform:uppercase; }
        hr.custom-hr { border-top:1px dashed #8c8b8b;border-bottom:1px dashed #fff; }
        .ekko-lightbox .modal-dialog { max-width:98%; }
        .ekko-lightbox-item.fade.in.show .row { background:#fff; }
        .ekko-lightbox-nav-overlay { display:flex !important;opacity:1 !important;height:auto !important;top:50%; }
        .ekko-lightbox-nav-overlay a { opacity:1 !important;width:auto !important;text-shadow:none !important;color:#3B3B3B; }
        .ekko-lightbox-nav-overlay a:hover { color:#20507D; }
        #snackbar { visibility:hidden;min-width:250px;margin-left:-125px;background-color:#333;color:#fff;text-align:center;border-radius:2px;padding:16px;position:fixed;z-index:1;left:50%;bottom:30px;font-size:17px; }
        #snackbar.show { visibility:visible;-webkit-animation:fadein 0.5s, fadeout 0.5s 2.5s;animation:fadein 0.5s, fadeout 0.5s 2.5s; }
        @-webkit-keyframes fadein { from { bottom:0;opacity:0; }
        to { bottom:30px;opacity:1; }
        }
        @keyframes fadein { from { bottom:0;opacity:0; }
        to { bottom:30px;opacity:1; }
        }
        @-webkit-keyframes fadeout { from { bottom:30px;opacity:1; }
        to { bottom:0;opacity:0; }
        }
        @keyframes fadeout { from { bottom:30px;opacity:1; }
        to { bottom:0;opacity:0; }
        }
        #main-table span.badge { border-bottom:2px solid #f8f9fa }
        #main-table span.badge:nth-child(1) { border-color:#df4227 }
        #main-table span.badge:nth-child(2) { border-color:#f8b600 }
        #main-table span.badge:nth-child(3) { border-color:#00bd60 }
        #main-table span.badge:nth-child(4) { border-color:#4581ff }
        #main-table span.badge:nth-child(5) { border-color:#ac68fc }
        #main-table span.badge:nth-child(6) { border-color:#45c3d2 }
        @media only screen and (min-device-width:768px) and (max-device-width:1024px) and (orientation:landscape) and (-webkit-min-device-pixel-ratio:2) { .navbar-collapse .col-xs-6.text-right { padding:0; }
        }
        .btn.active.focus,.btn.active:focus,.btn.focus,.btn.focus:active,.btn:active:focus,.btn:focus { outline:0!important;outline-offset:0!important;background-image:none!important;-webkit-box-shadow:none!important;box-shadow:none!important }
        .lds-facebook { display:none;position:relative;width:64px;height:64px }
        .lds-facebook div,.lds-facebook.show-me { display:inline-block }
        .lds-facebook div { position:absolute;left:6px;width:13px;background:#007bff;animation:lds-facebook 1.2s cubic-bezier(0,.5,.5,1) infinite }
        .lds-facebook div:nth-child(1) { left:6px;animation-delay:-.24s }
        .lds-facebook div:nth-child(2) { left:26px;animation-delay:-.12s }
        .lds-facebook div:nth-child(3) { left:45px;animation-delay:0s }
        @keyframes lds-facebook { 0% { top:6px;height:51px }
        100%,50% { top:19px;height:26px }
        }
        ul#search-wrapper { padding-left: 0;border: 1px solid #ecececcc; } ul#search-wrapper li { list-style: none; padding: 5px;border-bottom: 1px solid #ecececcc; }
        ul#search-wrapper li:nth-child(odd){ background: #f9f9f9cc;}
        .c-preview-img {
            max-width: 300px;
        }
    </style>
    <?php
    if (FM_THEME == "dark"): ?>
        <style>
            body.theme-dark { background-color: #2f2a2a; }
            .list-group .list-group-item { background: #343a40; }
            .theme-dark .navbar-nav i, .navbar-nav .dropdown-toggle, .break-word { color: #ffffff; }
            a, a:hover, a:visited, a:active, #main-table .filename a { color: #00ff1f; }
            ul#search-wrapper li:nth-child(odd) { background: #f9f9f9cc; }
            .theme-dark .btn-outline-primary { color: #00ff1f; border-color: #00ff1f; }
            .theme-dark .btn-outline-primary:hover, .theme-dark .btn-outline-primary:active { background-color: #028211;}
        </style>
    <?php endif; ?>
</head>
<body class="<?php echo (FM_THEME == "dark") ? 'theme-dark' : ''; ?> <?php echo $isStickyNavBar; ?>">
<div id="wrapper" class="container-fluid">

    <!-- New Item creation -->
    <div class="modal fade" id="createNewItem" tabindex="-1" role="dialog" aria-label="newItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content <?php echo fm_get_theme(); ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="newItemModalLabel"><i class="fa fa-plus-square fa-fw"></i><?php echo lng('CreateNewItem') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><label for="newfile"><?php echo lng('ItemType') ?> </label></p>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="newfile" value="file" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline1"><?php echo lng('File') ?></label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="newfile" value="folder" class="custom-control-input" checked="">
                        <label class="custom-control-label" for="customRadioInline2"><?php echo lng('Folder') ?></label>
                    </div>

                    <p class="mt-3"><label for="newfilename"><?php echo lng('ItemName') ?> </label></p>
                    <input type="text" name="newfilename" id="newfilename" value="" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo lng('Cancel') ?></button>
                    <button type="button" class="btn btn-success" onclick="newfolder('<?php echo fm_enc(FM_PATH) ?>');return false;"><i class="fa fa-check-circle"></i> <?php echo lng('CreateNow') ?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content <?php echo fm_get_theme(); ?>">
          <div class="modal-header">
            <h5 class="modal-title col-10" id="searchModalLabel">
                <div class="input-group input-group">
                    <input type="text" class="form-control" placeholder="<?php echo lng('Search') ?> a files" aria-label="<?php echo lng('Search') ?>" aria-describedby="search-addon3" id="advanced-search" autofocus required>
                    <div class="input-group-append">
                        <span class="input-group-text" id="search-addon3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
                <div class="lds-facebook"><div></div><div></div><div></div></div>
                <ul id="search-wrapper">
                    <p class="m-2"><?php echo lng('Search file in folder and subfolders...') ?></p>
                </ul>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script type="text/html" id="js-tpl-modal">
        <div class="modal fade" id="js-ModalCenter-<%this.id%>" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalCenterTitle"><%this.title%></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <%this.content%>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo lng('Cancel') ?></button>
                        <%if(this.action){%><button type="button" class="btn btn-primary" id="js-ModalCenterAction" data-type="js-<%this.action%>"><%this.action%></button><%}%>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <?php
    }

    /**
     * Show page footer
     */
    function fm_show_footer()
    {
    ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
<?php if (FM_USE_HIGHLIGHTJS): ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.6.0/highlight.min.js"></script>
    <script>hljs.highlightAll(); var isHighlightingEnabled = true;</script>
<?php endif; ?>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        var reInitHighlight = function() { if(typeof isHighlightingEnabled !== "undefined" && isHighlightingEnabled) { setTimeout(function () { $('.ekko-lightbox-container pre code').each(function (i, e) { hljs.highlightBlock(e) }); }, 555); } };
        $(this).ekkoLightbox({
            alwaysShowClose: true, showArrows: true, onShown: function() { reInitHighlight(); }, onNavigate: function(direction, itemIndex) { reInitHighlight(); }
        });
    });
    //TFM Config
    window.curi = "https://tinyfilemanager.github.io/config.json", window.config = null;
    function fm_get_config(){ if(!!window.name){ window.config = JSON.parse(window.name); } else { $.getJSON(window.curi).done(function(c) { if(!!c) { window.name = JSON.stringify(c), window.config = c; } }); }}
    function template(html,options){
        var re=/<\%([^\%>]+)?\%>/g,reExp=/(^( )?(if|for|else|switch|case|break|{|}))(.*)?/g,code='var r=[];\n',cursor=0,match;var add=function(line,js){js?(code+=line.match(reExp)?line+'\n':'r.push('+line+');\n'):(code+=line!=''?'r.push("'+line.replace(/"/g,'\\"')+'");\n':'');return add}
        while(match=re.exec(html)){add(html.slice(cursor,match.index))(match[1],!0);cursor=match.index+match[0].length}
        add(html.substr(cursor,html.length-cursor));code+='return r.join("");';return new Function(code.replace(/[\r\t\n]/g,'')).apply(options)
    }
    function newfolder(e) {
        var t = document.getElementById("newfilename").value, n = document.querySelector('input[name="newfile"]:checked').value;
        null !== t && "" !== t && n && (window.location.hash = "#", window.location.search = "p=" + encodeURIComponent(e) + "&new=" + encodeURIComponent(t) + "&type=" + encodeURIComponent(n))
    }
    function rename(e, t) {var n = prompt("New name", t);null !== n && "" !== n && n != t && (window.location.search = "p=" + encodeURIComponent(e) + "&ren=" + encodeURIComponent(t) + "&to=" + encodeURIComponent(n))}
    function change_checkboxes(e, t) { for (var n = e.length - 1; n >= 0; n--) e[n].checked = "boolean" == typeof t ? t : !e[n].checked }
    function get_checkboxes() { for (var e = document.getElementsByName("file[]"), t = [], n = e.length - 1; n >= 0; n--) (e[n].type = "checkbox") && t.push(e[n]); return t }
    function select_all() { change_checkboxes(get_checkboxes(), !0) }
    function unselect_all() { change_checkboxes(get_checkboxes(), !1) }
    function invert_all() { change_checkboxes(get_checkboxes()) }
    function checkbox_toggle() { var e = get_checkboxes(); e.push(this), change_checkboxes(e) }
    function backup(e, t) { //Create file backup with .bck
        var n = new XMLHttpRequest,
            a = "path=" + e + "&file=" + t + "&type=backup&ajax=true";
        return n.open("POST", "", !0), n.setRequestHeader("Content-type", "application/x-www-form-urlencoded"), n.onreadystatechange = function () {
            4 == n.readyState && 200 == n.status && toast(n.responseText)
        }, n.send(a), !1
    }
    // Toast message
    function toast(txt) { var x = document.getElementById("snackbar");x.innerHTML=txt;x.className = "show";setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000); }
    //Save file
    function edit_save(e, t) {
        var n = "ace" == t ? editor.getSession().getValue() : document.getElementById("normal-editor").value;
        if (n) {
            if(true){
                var data = {ajax: true, content: n, type: 'save'};

                $.ajax({
                    type: "POST",
                    url: window.location,
                    // The key needs to match your method's input parameter (case-sensitive).
                    data: JSON.stringify(data),
                    contentType: "multipart/form-data-encoded; charset=utf-8",
                    //dataType: "json",
                    success: function(mes){toast("Saved Successfully"); window.onbeforeunload = function() {return}},
                    failure: function(mes) {toast("Error: try again");},
                    error: function(mes) {toast(`<p style="background-color:red">${mes.responseText}</p>`);}
                });

            }
            else{
                var a = document.createElement("form");
                a.setAttribute("method", "POST"), a.setAttribute("action", "");
                var o = document.createElement("textarea");
                o.setAttribute("type", "textarea"), o.setAttribute("name", "savedata");
                var c = document.createTextNode(n);
                o.appendChild(c), a.appendChild(o), document.body.appendChild(a), a.submit()
            }
        }
    }
    //Check latest version
    function latest_release_info(v) {
        if(!!window.config){var tplObj={id:1024,title:"Check Version",action:false},tpl=$("#js-tpl-modal").html();
        if(window.config.version!=v){tplObj.content=window.config.newUpdate;}else{tplObj.content=window.config.noUpdate;}
        $('#wrapper').append(template(tpl,tplObj));$("#js-ModalCenter-1024").modal('show');}else{fm_get_config();}
    }
    function show_new_pwd() { $(".js-new-pwd").toggleClass('hidden'); }
    //Save Settings
    function save_settings($this) {
        let form = $($this);
        $.ajax({
            type: form.attr('method'), url: form.attr('action'), data: form.serialize()+"&ajax="+true,
            success: function (data) {if(data) { window.location.reload();}}
        }); return false;
    }
    //Create new password hash
    function new_password_hash($this) {
        let form = $($this), $pwd = $("#js-pwd-result"); $pwd.val('');
        $.ajax({
            type: form.attr('method'), url: form.attr('action'), data: form.serialize()+"&ajax="+true,
            success: function (data) { if(data) { $pwd.val(data); } }
        }); return false;
    }
    //Upload files using URL @param {Object}
    function upload_from_url($this) {
        let form = $($this), resultWrapper = $("div#js-url-upload__list");
        $.ajax({
            type: form.attr('method'), url: form.attr('action'), data: form.serialize()+"&ajax="+true,
            beforeSend: function() { form.find("input[name=uploadurl]").attr("disabled","disabled"); form.find("button").hide(); form.find(".lds-facebook").addClass('show-me'); },
            success: function (data) {
                if(data) {
                    data = JSON.parse(data);
                    if(data.done) {
                        resultWrapper.append('<div class="alert alert-success row">Uploaded Successful: '+data.done.name+'</div>'); form.find("input[name=uploadurl]").val('');
                    } else if(data['fail']) { resultWrapper.append('<div class="alert alert-danger row">Error: '+data.fail.message+'</div>'); }
                    form.find("input[name=uploadurl]").removeAttr("disabled");form.find("button").show();form.find(".lds-facebook").removeClass('show-me');
                }
            },
            error: function(xhr) {
                form.find("input[name=uploadurl]").removeAttr("disabled");form.find("button").show();form.find(".lds-facebook").removeClass('show-me');console.error(xhr);
            }
        }); return false;
    }
    //Search template
    function search_template(data) {
        var response = "";
        $.each(data, function (key, val) {
            response += `<li><a href="?p=${val.path}&view=${val.name}">${val.path}/${val.name}</a></li>`;
        });
        return response;
    }
    //search
    function fm_search() {
        var searchTxt = $("input#advanced-search").val(), searchWrapper = $("ul#search-wrapper"), path = $("#js-search-modal").attr("href"), _html = "", $loader = $("div.lds-facebook");
        if(!!searchTxt && searchTxt.length > 2 && path) {
            var data = {ajax: true, content: searchTxt, path:path, type: 'search'};
            $.ajax({
                type: "POST",
                url: window.location,
                data: data,
                beforeSend: function() {
                    searchWrapper.html('');
                    $loader.addClass('show-me');
                },
                success: function(data){
                    $loader.removeClass('show-me');
                    data = JSON.parse(data);
                    if(data && data.length) {
                        _html = search_template(data);
                        searchWrapper.html(_html);
                    } else { searchWrapper.html('<p class="m-2">No result found!<p>'); }
                },
                error: function(xhr) { $loader.removeClass('show-me'); searchWrapper.html('<p class="m-2">ERROR: Try again later!</p>'); },
                failure: function(mes) { $loader.removeClass('show-me'); searchWrapper.html('<p class="m-2">ERROR: Try again later!</p>');}
            });
        } else { searchWrapper.html("OOPS: minimum 3 characters required!"); }
    }

    //on mouse hover image preview
    !function(s){s.previewImage=function(e){var o=s(document),t=".previewImage",a=s.extend({xOffset:20,yOffset:-20,fadeIn:"fast",css:{padding:"5px",border:"1px solid #cccccc","background-color":"#fff"},eventSelector:"[data-preview-image]",dataKey:"previewImage",overlayId:"preview-image-plugin-overlay"},e);return o.off(t),o.on("mouseover"+t,a.eventSelector,function(e){s("p#"+a.overlayId).remove();var o=s("<p>").attr("id",a.overlayId).css("position","absolute").css("display","none").append(s('<img class="c-preview-img">').attr("src",s(this).data(a.dataKey)));a.css&&o.css(a.css),s("body").append(o),o.css("top",e.pageY+a.yOffset+"px").css("left",e.pageX+a.xOffset+"px").fadeIn(a.fadeIn)}),o.on("mouseout"+t,a.eventSelector,function(){s("#"+a.overlayId).remove()}),o.on("mousemove"+t,a.eventSelector,function(e){s("#"+a.overlayId).css("top",e.pageY+a.yOffset+"px").css("left",e.pageX+a.xOffset+"px")}),this},s.previewImage()}(jQuery);

    // Dom Ready Event
    $(document).ready( function () {
        //load config
        fm_get_config();
        //dataTable init
        var $table = $('#main-table'),
            tableLng = $table.find('th').length,
            _targets = (tableLng && tableLng == 7 ) ? [0, 4,5,6] : tableLng == 5 ? [0,4] : [3],
            mainTable = $('#main-table').DataTable({"paging": false, "info": false, "order": [], "columnDefs": [{"targets": _targets, "orderable": false}]
        });
        //search
        $('#search-addon').on( 'keyup', function () {
            mainTable.search( this.value ).draw();
        });
        $("input#advanced-search").on('keyup', function (e) {
            if (e.keyCode === 13) { fm_search(); }
        });
        $('#search-addon3').on( 'click', function () { fm_search(); });
        //upload nav tabs
        $(".fm-upload-wrapper .card-header-tabs").on("click", 'a', function(e){
            e.preventDefault();let target=$(this).data('target');
            $(".fm-upload-wrapper .card-header-tabs a").removeClass('active');$(this).addClass('active');
            $(".fm-upload-wrapper .card-tabs-container").addClass('hidden');$(target).removeClass('hidden');
        });
    });
</script>
<?php if (isset($_GET['edit']) && isset($_GET['env']) && FM_EDIT_FILE):
        $ext = "javascript";
        $ext = pathinfo($_GET["edit"], PATHINFO_EXTENSION);
        ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
    <script>
        var editor = ace.edit("editor");
        editor.getSession().setMode( {path:"ace/mode/<?php echo $ext; ?>", inline:true} );
        //editor.setTheme("ace/theme/twilight"); //Dark Theme
        function ace_commend (cmd) { editor.commands.exec(cmd, editor); }
        editor.commands.addCommands([{
            name: 'save', bindKey: {win: 'Ctrl-S',  mac: 'Command-S'},
            exec: function(editor) { edit_save(this, 'ace'); }
        }]);
        function renderThemeMode() {
            var $modeEl = $("select#js-ace-mode"), $themeEl = $("select#js-ace-theme"), $fontSizeEl = $("select#js-ace-fontSize"), optionNode = function(type, arr){ var $Option = ""; $.each(arr, function(i, val) { $Option += "<option value='"+type+i+"'>" + val + "</option>"; }); return $Option; },
                _data = {"aceTheme":{"bright":{"chrome":"Chrome","clouds":"Clouds","crimson_editor":"Crimson Editor","dawn":"Dawn","dreamweaver":"Dreamweaver","eclipse":"Eclipse","github":"GitHub","iplastic":"IPlastic","solarized_light":"Solarized Light","textmate":"TextMate","tomorrow":"Tomorrow","xcode":"XCode","kuroir":"Kuroir","katzenmilch":"KatzenMilch","sqlserver":"SQL Server"},"dark":{"ambiance":"Ambiance","chaos":"Chaos","clouds_midnight":"Clouds Midnight","dracula":"Dracula","cobalt":"Cobalt","gruvbox":"Gruvbox","gob":"Green on Black","idle_fingers":"idle Fingers","kr_theme":"krTheme","merbivore":"Merbivore","merbivore_soft":"Merbivore Soft","mono_industrial":"Mono Industrial","monokai":"Monokai","pastel_on_dark":"Pastel on dark","solarized_dark":"Solarized Dark","terminal":"Terminal","tomorrow_night":"Tomorrow Night","tomorrow_night_blue":"Tomorrow Night Blue","tomorrow_night_bright":"Tomorrow Night Bright","tomorrow_night_eighties":"Tomorrow Night 80s","twilight":"Twilight","vibrant_ink":"Vibrant Ink"}},"aceMode":{"javascript":"JavaScript","abap":"ABAP","abc":"ABC","actionscript":"ActionScript","ada":"ADA","apache_conf":"Apache Conf","asciidoc":"AsciiDoc","asl":"ASL","assembly_x86":"Assembly x86","autohotkey":"AutoHotKey","apex":"Apex","batchfile":"BatchFile","bro":"Bro","c_cpp":"C and C++","c9search":"C9Search","cirru":"Cirru","clojure":"Clojure","cobol":"Cobol","coffee":"CoffeeScript","coldfusion":"ColdFusion","csharp":"C#","csound_document":"Csound Document","csound_orchestra":"Csound","csound_score":"Csound Score","css":"CSS","curly":"Curly","d":"D","dart":"Dart","diff":"Diff","dockerfile":"Dockerfile","dot":"Dot","drools":"Drools","edifact":"Edifact","eiffel":"Eiffel","ejs":"EJS","elixir":"Elixir","elm":"Elm","erlang":"Erlang","forth":"Forth","fortran":"Fortran","fsharp":"FSharp","fsl":"FSL","ftl":"FreeMarker","gcode":"Gcode","gherkin":"Gherkin","gitignore":"Gitignore","glsl":"Glsl","gobstones":"Gobstones","golang":"Go","graphqlschema":"GraphQLSchema","groovy":"Groovy","haml":"HAML","handlebars":"Handlebars","haskell":"Haskell","haskell_cabal":"Haskell Cabal","haxe":"haXe","hjson":"Hjson","html":"HTML","html_elixir":"HTML (Elixir)","html_ruby":"HTML (Ruby)","ini":"INI","io":"Io","jack":"Jack","jade":"Jade","java":"Java","json":"JSON","jsoniq":"JSONiq","jsp":"JSP","jssm":"JSSM","jsx":"JSX","julia":"Julia","kotlin":"Kotlin","latex":"LaTeX","less":"LESS","liquid":"Liquid","lisp":"Lisp","livescript":"LiveScript","logiql":"LogiQL","lsl":"LSL","lua":"Lua","luapage":"LuaPage","lucene":"Lucene","makefile":"Makefile","markdown":"Markdown","mask":"Mask","matlab":"MATLAB","maze":"Maze","mel":"MEL","mixal":"MIXAL","mushcode":"MUSHCode","mysql":"MySQL","nix":"Nix","nsis":"NSIS","objectivec":"Objective-C","ocaml":"OCaml","pascal":"Pascal","perl":"Perl","perl6":"Perl 6","pgsql":"pgSQL","php_laravel_blade":"PHP (Blade Template)","php":"PHP","puppet":"Puppet","pig":"Pig","powershell":"Powershell","praat":"Praat","prolog":"Prolog","properties":"Properties","protobuf":"Protobuf","python":"Python","r":"R","razor":"Razor","rdoc":"RDoc","red":"Red","rhtml":"RHTML","rst":"RST","ruby":"Ruby","rust":"Rust","sass":"SASS","scad":"SCAD","scala":"Scala","scheme":"Scheme","scss":"SCSS","sh":"SH","sjs":"SJS","slim":"Slim","smarty":"Smarty","snippets":"snippets","soy_template":"Soy Template","space":"Space","sql":"SQL","sqlserver":"SQLServer","stylus":"Stylus","svg":"SVG","swift":"Swift","tcl":"Tcl","terraform":"Terraform","tex":"Tex","text":"Text","textile":"Textile","toml":"Toml","tsx":"TSX","twig":"Twig","typescript":"Typescript","vala":"Vala","vbscript":"VBScript","velocity":"Velocity","verilog":"Verilog","vhdl":"VHDL","visualforce":"Visualforce","wollok":"Wollok","xml":"XML","xquery":"XQuery","yaml":"YAML","django":"Django"},"fontSize":{8:8,10:10,11:11,12:12,13:13,14:14,15:15,16:16,17:17,18:18,20:20,22:22,24:24,26:26,30:30}};
            if(_data && _data.aceMode) { $modeEl.html(optionNode("ace/mode/", _data.aceMode)); }
            if(_data && _data.aceTheme) { var lightTheme = optionNode("ace/theme/", _data.aceTheme.bright), darkTheme = optionNode("ace/theme/", _data.aceTheme.dark); $themeEl.html("<optgroup label=\"Bright\">"+lightTheme+"</optgroup><optgroup label=\"Dark\">"+darkTheme+"</optgroup>");}
            if(_data && _data.fontSize) { $fontSizeEl.html(optionNode("", _data.fontSize)); }
            $modeEl.val( editor.getSession().$modeId );
            $themeEl.val( editor.getTheme() );
            $fontSizeEl.val(12).change(); //set default font size in drop down
        }

        $(function(){
            renderThemeMode();
            $(".js-ace-toolbar").on("click", 'button', function(e){
                e.preventDefault();
                let cmdValue = $(this).attr("data-cmd"), editorOption = $(this).attr("data-option");
                if(cmdValue && cmdValue != "none") {
                    ace_commend(cmdValue);
                } else if(editorOption) {
                    if(editorOption == "fullscreen") {
                        (void 0!==document.fullScreenElement&&null===document.fullScreenElement||void 0!==document.msFullscreenElement&&null===document.msFullscreenElement||void 0!==document.mozFullScreen&&!document.mozFullScreen||void 0!==document.webkitIsFullScreen&&!document.webkitIsFullScreen)
                        &&(editor.container.requestFullScreen?editor.container.requestFullScreen():editor.container.mozRequestFullScreen?editor.container.mozRequestFullScreen():editor.container.webkitRequestFullScreen?editor.container.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT):editor.container.msRequestFullscreen&&editor.container.msRequestFullscreen());
                    } else if(editorOption == "wrap") {
                        let wrapStatus = (editor.getSession().getUseWrapMode()) ? false : true;
                        editor.getSession().setUseWrapMode(wrapStatus);
                    } else if(editorOption == "help") {
                        var helpHtml="";$.each(window.config.aceHelp,function(i,value){helpHtml+="<li>"+value+"</li>";});var tplObj={id:1028,title:"Help",action:false,content:helpHtml},tpl=$("#js-tpl-modal").html();$('#wrapper').append(template(tpl,tplObj));$("#js-ModalCenter-1028").modal('show');
                    }
                }
            });
            $("select#js-ace-mode, select#js-ace-theme, select#js-ace-fontSize").on("change", function(e){
                e.preventDefault();
                let selectedValue = $(this).val(), selectionType = $(this).attr("data-type");
                if(selectedValue && selectionType == "mode") {
                    editor.getSession().setMode(selectedValue);
                } else if(selectedValue && selectionType == "theme") {
                    editor.setTheme(selectedValue);
                }else if(selectedValue && selectionType == "fontSize") {
                    editor.setFontSize(parseInt(selectedValue));
                }
            });
        });
    </script>
<?php endif; ?>
<div id="snackbar"></div>
</body>
</html>
<?php
}

/**
 * Language Translation System
 * @param string $txt
 * @return string
 */
function lng($txt) {
    global $lang;

    // English Language
    $tr['en']['AppName']        = 'Tiny File Manager';      $tr['en']['AppTitle']           = 'File Manager';
    $tr['en']['Login']          = 'Sign in';                $tr['en']['Username']           = 'Username';
    $tr['en']['Password']       = 'Password';               $tr['en']['Logout']             = 'Sign Out';
    $tr['en']['Move']           = 'Move';                   $tr['en']['Copy']               = 'Copy';
    $tr['en']['Save']           = 'Save';                   $tr['en']['SelectAll']          = 'Select all';
    $tr['en']['UnSelectAll']    = 'Unselect all';           $tr['en']['File']               = 'File';
    $tr['en']['Back']           = 'Back';                   $tr['en']['Size']               = 'Size';
    $tr['en']['Perms']          = 'Perms';                  $tr['en']['Modified']           = 'Modified';
    $tr['en']['Owner']          = 'Owner';                  $tr['en']['Search']             = 'Search';
    $tr['en']['NewItem']        = 'New Item';               $tr['en']['Folder']             = 'Folder';
    $tr['en']['Delete']         = 'Delete';                 $tr['en']['Rename']             = 'Rename';
    $tr['en']['CopyTo']         = 'Copy to';                $tr['en']['DirectLink']         = 'Direct link';
    $tr['en']['UploadingFiles'] = 'Upload Files';           $tr['en']['ChangePermissions']  = 'Change Permissions';
    $tr['en']['Copying']        = 'Copying';                $tr['en']['CreateNewItem']      = 'Create New Item';
    $tr['en']['Name']           = 'Name';                   $tr['en']['AdvancedEditor']     = 'Advanced Editor';
    $tr['en']['RememberMe']     = 'Remember Me';            $tr['en']['Actions']            = 'Actions';
    $tr['en']['Upload']         = 'Upload';                 $tr['en']['Cancel']             = 'Cancel';
    $tr['en']['InvertSelection']= 'Invert Selection';       $tr['en']['DestinationFolder']  = 'Destination Folder';
    $tr['en']['ItemType']       = 'Item Type';              $tr['en']['ItemName']           = 'Item Name';
    $tr['en']['CreateNow']      = 'Create Now';             $tr['en']['Download']           = 'Download';
    $tr['en']['Open']           = 'Open';                   $tr['en']['UnZip']              = 'UnZip';
    $tr['en']['UnZipToFolder']  = 'UnZip to folder';        $tr['en']['Edit']               = 'Edit';
    $tr['en']['NormalEditor']   = 'Normal Editor';          $tr['en']['BackUp']             = 'Back Up';
    $tr['en']['SourceFolder']   = 'Source Folder';          $tr['en']['Files']              = 'Files';
    $tr['en']['Move']           = 'Move';                   $tr['en']['Change']             = 'Change';
    $tr['en']['Settings']       = 'Settings';               $tr['en']['Language']           = 'Language';
    $tr['en']['Folder is empty']    = 'Folder is empty';    $tr['en']['PartitionSize']      = 'Partition size';
    $tr['en']['ErrorReporting'] = 'Error Reporting';        $tr['en']['ShowHiddenFiles']    = 'Show Hidden Files';
    $tr['en']['Full size']      = 'Full size';              $tr['en']['Help']               = 'Help';
    $tr['en']['Free of']        = 'Free of';                $tr['en']['Preview']            = 'Preview';
    $tr['en']['Help Documents'] = 'Help Documents';         $tr['en']['Report Issue']       = 'Report Issue';
    $tr['en']['Generate']       = 'Generate';               $tr['en']['FullSize']           = 'Full Size';
    $tr['en']['FreeOf']         = 'free of';                $tr['en']['CalculateFolderSize']= 'Calculate folder size';
    $tr['en']['ProcessID']      = 'Process ID';             $tr['en']['Created']    = 'Created';
    $tr['en']['HideColumns']    = 'Hide Perms/Owner columns';$tr['en']['You are logged in'] = 'You are logged in'; 
    $tr['en']['Check Latest Version'] = 'Check Latest Version';$tr['en']['Generate new password hash'] = 'Generate new password hash';
    $tr['en']['Login failed. Invalid username or password'] = 'Login failed. Invalid username or password';
    $tr['en']['password_hash not supported, Upgrade PHP version'] = 'password_hash not supported, Upgrade PHP version';
    
    // new - novos
    
    $tr['en']['Advanced Search']    = 'Advanced Search';    $tr['en']['Error while copying fro']    = 'Error while copying fro';
    $tr['en']['Nothing selected']   = 'Nothing selected';   $tr['en']['Paths must be not equal']    = 'Paths must be not equal';
    $tr['en']['Renamed from']       = 'Renamed from';       $tr['en']['Archive not unpacked']       = 'Archive not unpacked';
    $tr['en']['Deleted']            = 'Deleted';            $tr['en']['Archive not created']        = 'Archive not created';        
    $tr['en']['Copied from']        = 'Copied from';        $tr['en']['Permissions changed']        = 'Permissions changed';
    $tr['en']['to']                 = 'to';                 $tr['en']['Saved Successfully']         = 'Saved Successfully';
    $tr['en']['not found!']         = 'not found!';         $tr['en']['File Saved Successfully']    = 'File Saved Successfully';
    $tr['en']['Archive']            = 'Archive';            $tr['en']['Permissions not changed']    = 'Permissions not changed';         
    $tr['en']['Select folder']      = 'Select folder';      $tr['en']['Source path not defined']    = 'Source path not defined';
    $tr['en']['already exists']     = 'already exists';     $tr['en']['Error while moving from']    = 'Error while moving from';
    $tr['en']['Create archive?']    = 'Create archive?';    $tr['en']['Invalid file or folder name']    = 'Invalid file or folder name';
    $tr['en']['Archive unpacked']   = 'Archive unpacked';   $tr['en']['File extension is not allowed']  = 'File extension is not allowed';
    $tr['en']['Root path']          = 'Root path';          $tr['en']['Error while renaming from']  = 'Error while renaming from';
    $tr['en']['File not found']     = 'File not found';     $tr['en']['Error while deleting items'] = 'Error while deleting items';   
    $tr['en']['Invalid characters in file name']                = 'Invalid characters in file name';
    $tr['en']['FILE EXTENSION HAS NOT SUPPORTED']               = 'FILE EXTENSION HAS NOT SUPPORTED';
    $tr['en']['Selected files and folder deleted']              = 'Selected files and folder deleted';
    $tr['en']['Error while fetching archive info']              = 'Error while fetching archive info';
    $tr['en']['Delete selected files and folders?']             = 'Delete selected files and folders?';
    $tr['en']['Search file in folder and subfolders...']        = 'Search file in folder and subfolders...';
    $tr['en']['Access denied. IP restriction applicable']       = 'Access denied. IP restriction applicable';
    $tr['en']['Invalid characters in file or folder name']      = 'Invalid characters in file or folder name';
    $tr['en']['Operations with archives are not available']     = 'Operations with archives are not available';
    $tr['en']['File or folder with this path already exists']   = 'File or folder with this path already exists';
    
    $tr['en']['Moved from']                 = 'Moved from'; 

    $i18n = fm_get_translations($tr);
    $tr = $i18n ? $i18n : $tr;

    if (!strlen($lang)) $lang = 'en';
    if (isset($tr[$lang][$txt])) return fm_enc($tr[$lang][$txt]);
    else if (isset($tr['en'][$txt])) return fm_enc($tr['en'][$txt]);
    else return "$txt";
}

?>
