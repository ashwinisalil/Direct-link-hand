<?php
/**
 * ===============================================================
 * DATABASE CONNECTION FILE
 * ===============================================================
 * Every page in this project starts with:
 *      require_once 'includes/db.php';
 * so this file runs first and gives every page access to:
 *   - $conn        -> the database connection object
 *   - redirect()   -> a helper to send the user to another page
 *   - e()          -> a helper to safely print user data on screen
 * ===============================================================
 */

// Start a PHP session (if one isn't already running).
// Sessions let us remember who is logged in (user, org, or admin)
// as they move from page to page, using $_SESSION.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ---- Database credentials ----
// These match a default XAMPP/MySQL install: user "root", no password.
// Change DB_NAME below if your database was imported under a different name.
define('DB_HOST', 'sql302.infinityfree.com');
define('DB_USER', 'if0_42443922');
define('DB_PASS', 'directlinkhands');
define('DB_NAME', 'if0_42443922_directlinkhands');

// Leave empty when the site is installed directly in InfinityFree's htdocs.
// For local XAMPP, use '/DirectLinkHands'.
define('BASE_URL', '');

// Open the connection using mysqli (MySQL Improved extension).
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// If the connection failed, stop the whole page and show why.
// mysqli_connect_error() gives the real reason (wrong password,
// database doesn't exist, MySQL not running, etc.)
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

// Make sure text (including special characters) is stored/read correctly.
mysqli_set_charset($conn, "utf8mb4");


/**
 * redirect()
 * Sends the browser to a different page and stops the script immediately.
 * Used after login/logout/register so the user lands on the right page.
 *
 * Example: redirect('login.php');
 */
function redirect($url) {
    header("Location: " . $url);
    exit(); // exit() is important - stops any code below from running
}


/**
 * e()  (short for "escape")
 * Wraps user-provided text before printing it on the page, so that if
 * someone typed HTML/JavaScript into a form field, the browser shows it
 * as plain text instead of running it. This prevents a common attack
 * called XSS (Cross-Site Scripting).
 *
 * Example: <p><?= e($user['full_name']) ?></p>
 */
function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
