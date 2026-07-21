<?php
/**
 * ===============================================================
 * ORGANIZATION DASHBOARD (organization/dashboard.php)
 * ===============================================================
 * Landing page for a logged-in organization. Shows its own totals
 * (how much it has received) and its 10 most recent donations.
 * ===============================================================
 */

require_once '../includes/db.php';
$pageTitle = 'Organization Dashboard';

// Only a logged-in (and already-approved) organization can see this.
if (!isset($_SESSION['org_id'])) {
    redirect('../login.php');
}

$org_id = $_SESSION['org_id'];

// This organization's own profile info (name, status, etc.)
$stmt = mysqli_prepare($conn, "SELECT * FROM organizations WHERE org_id = ?");
mysqli_stmt_bind_param($stmt, "i", $org_id);
mysqli_stmt_execute($stmt);
$org = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

// How many donations has this org received in total?
$stmt = mysqli_prepare($conn, "SELECT COUNT(*) FROM donations WHERE org_id = ?");
mysqli_stmt_bind_param($stmt, "i", $org_id);
mysqli_stmt_execute($stmt);
$totalDonations = mysqli_fetch_row(mysqli_stmt_get_result($stmt))[0];

// Total amount received (only counting "Completed" donations)
$stmt = mysqli_prepare($conn, "SELECT COALESCE(SUM(amount),0) FROM donations WHERE org_id = ? AND payment_status = 'Completed'");
mysqli_stmt_bind_param($stmt, "i", $org_id);
mysqli_stmt_execute($stmt);
$totalAmount = mysqli_fetch_row(mysqli_stmt_get_result($stmt))[0];

// The 10 most recent donations this org has received, with donor names
$stmt = mysqli_prepare($conn, "SELECT d.*, u.full_name FROM donations d
                                JOIN users u ON d.user_id = u.user_id
                                WHERE d.org_id = ?
                                ORDER BY d.donation_date DESC LIMIT 10");
mysqli_stmt_bind_param($stmt, "i", $org_id);
mysqli_stmt_execute($stmt);
$recentDonations = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);

include '../includes/header.php';
include '../includes/navbar.php';
?>

<main class="container page">
    <h1><?= e($org['organization_name']) ?> Dashboard</h1>
    <p>Status: <span class="status status-<?= strtolower(e($org['status'])) ?>"><?= e($org['status']) ?></span></p>

    <div class="stats-grid">
        <div class="stat-card">
            <h3><?= e($totalDonations) ?></h3>
            <p>Total Donations Received</p>
        </div>
        <div class="stat-card">
            <h3>₹<?= e(number_format($totalAmount, 2)) ?></h3>
            <p>Total Amount Raised</p>
        </div>
    </div>

    <nav class="admin-quicklinks">
        <a href="profile.php" class="btn btn-secondary">Edit Profile</a>
        <a href="upload_documents.php" class="btn btn-secondary">Upload Documents</a>
    </nav>

    <h2>Recent Donations</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Donor</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($recentDonations)): ?>
                <tr><td colspan="4">No donations received yet.</td></tr>
            <?php else: ?>
                <?php foreach ($recentDonations as $d): ?>
                    <tr>
                        <td><?= e(date('d M Y', strtotime($d['donation_date']))) ?></td>
                        <td><?= e($d['full_name']) ?></td>
                        <td>₹<?= e(number_format($d['amount'], 2)) ?></td>
                        <td><?= e($d['payment_status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include '../includes/footer.php'; ?>
