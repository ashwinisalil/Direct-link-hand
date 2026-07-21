<?php
/**
 * ===============================================================
 * LOGOUT SCRIPT (logout.php)
 * ===============================================================
 * Works for donors, organizations, and admins alike — it doesn't
 * need to know which one is logged in, it just clears everything.
 * ===============================================================
 */

require_once 'includes/db.php';

// Empty out all session data (user_id, org_id, admin_id, etc.)
$_SESSION = [];

// Destroy the session completely on the server side too.
session_destroy();

// Send them back to the login page.
redirect('login.php');
