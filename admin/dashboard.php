<?php
/**
 * ===============================================================
 * ADMIN DASHBOARD (admin/dashboard.php)
 * ===============================================================
 * Landing page after admin login. Shows a handful of site-wide
 * totals (COUNT / SUM queries) and links to the 3 management pages.
 *
 * NOTE: this file lives inside the admin/ folder, so all paths to
 * includes/ use "../includes/..." (one level up) instead of
 * "includes/..." like the top-level pages use.
 * ===============================================================
 */

require_once '../includes/db.php';
$pageTitle = 'Admin Dashboard';

// Only someone who successfully logged in as Admin (see login.php)
// may view this page.
if (!isset($_SESSION['admin_id'])) {
    redirect('../login.php');
}

// Each of these runs a single aggregate query and pulls out the one
// number it returns. mysqli_fetch_row() returns a plain array like
// [0 => 42], so [0] grabs that first (and only) value.
$totalUsers     = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM users"))[0];
$totalOrgs      = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM organizations"))[0];
$pendingOrgs    = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM organizations WHERE status = 'Pending'"))[0];
// COALESCE(SUM(...), 0) makes sure we get 0 instead of NULL if there are no donations yet
$totalDonated   = mysqli_fetch_row(mysqli_query($conn, "SELECT COALESCE(SUM(amount),0) FROM donations WHERE payment_status = 'Completed'"))[0];
$totalDonations = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM donations"))[0];

include '../includes/header.php';
include '../includes/navbar.php';
?>

<main class="container page">
    <h1>Admin Dashboard</h1>

    <div class="stats-grid">
        <div class="stat-card">
            <h3><?= e($totalUsers) ?></h3>
            <p>Registered Donors</p>
        </div>
        <div class="stat-card">
            <h3><?= e($totalOrgs) ?></h3>
            <p>Organizations</p>
        </div>
        <div class="stat-card">
            <h3><?= e($pendingOrgs) ?></h3>
            <p>Pending Approvals</p>
        </div>
        <div class="stat-card">
            <h3><?= e($totalDonations) ?></h3>
            <p>Total Donations</p>
        </div>
        <div class="stat-card">
            <h3>₹<?= e(number_format($totalDonated, 2)) ?></h3>
            <p>Total Amount Raised</p>
        </div>
    </div>

    <nav class="admin-quicklinks">
        <a href="users.php" class="btn btn-secondary">Manage Users</a>
        <a href="organizations.php" class="btn btn-secondary">Manage Organizations</a>
        <a href="donations.php" class="btn btn-secondary">View Donations</a>
    </nav>
</main>

<?php include '../includes/footer.php'; ?>
