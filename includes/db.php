<?php
/**
 * Database connection (MySQLi)
 * Direct Link Hands - Online Donation Management System
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');   // XAMPP default: empty password
define('DB_NAME', 'directlinkhands');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

/**
 * Small helper: redirect and stop execution
 */
function redirect($url) {
    header("Location: " . $url);
    exit();
}

/**
 * Small helper: sanitize output
 */
function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
