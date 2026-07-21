<?php
/**
 * ===============================================================
 * DONATION HISTORY (history.php)
 * ===============================================================
 * Shows the logged-in donor a table of every donation THEY have
 * made, newest first. Uses a JOIN to pull the organization's name
 * alongside each donation row.
 * ===============================================================
 */

require_once 'includes/db.php';
$pageTitle = 'My Donations';

// Only a logged-in donor can view their own history.
if (!isset($_SESSION['user_id'])) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];

// JOIN donations with organizations so we can show the organization's
// NAME (not just its ID number) in the table.
$stmt = mysqli_prepare($conn, "SELECT d.*, o.organization_name FROM donations d
                                JOIN organizations o ON d.org_id = o.org_id
                                WHERE d.user_id = ?
                                ORDER BY d.donation_date DESC");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$donations = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);

include 'includes/header.php';
include 'includes/navbar.php';
?>

<main class="container page">
    <h1>My Donation History</h1>

    <table class="data-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Organization</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Receipt #</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($donations)): ?>
                <tr><td colspan="6">You haven't made any donations yet.</td></tr>
            <?php else: ?>
                <?php foreach ($donations as $d): ?>
                    <tr>
                        <!-- strtotime() converts the MySQL datetime text into a
                             timestamp, then date() formats it nicely for humans -->
                        <td><?= e(date('d M Y, h:i A', strtotime($d['donation_date']))) ?></td>
                        <td><?= e($d['organization_name']) ?></td>
                        <!-- number_format adds thousands separators and 2 decimal places -->
                        <td>₹<?= e(number_format($d['amount'], 2)) ?></td>
                        <td><?= e($d['payment_method']) ?></td>
                        <td><?= e($d['payment_status']) ?></td>
                        <td><?= e($d['receipt_number']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include 'includes/footer.php'; ?>
