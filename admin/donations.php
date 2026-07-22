<?php
require_once '../includes/db.php';
$pageTitle = 'All Donations';

if (!isset($_SESSION['admin_id'])) {
    redirect('../login.php');
}

$donations = mysqli_fetch_all(mysqli_query($conn, "SELECT d.*, u.full_name, o.organization_name
                                                     FROM donations d
                                                     JOIN users u ON d.user_id = u.user_id
                                                     JOIN organizations o ON d.org_id = o.org_id
                                                     ORDER BY d.donation_date DESC"), MYSQLI_ASSOC);

include '../includes/header.php';
include '../includes/navbar.php';
?>

<main class="container page">
    <h1>All Donations</h1>

    <table class="data-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Donor</th>
                <th>Organization</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Status</th>
                <th>Receipt #</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($donations)): ?>
                <tr><td colspan="7">No donations recorded yet.</td></tr>
            <?php else: ?>
                <?php foreach ($donations as $d): ?>
                    <tr>
                        <td><?= e(date('d M Y, h:i A', strtotime($d['donation_date']))) ?></td>
                        <td><?= e($d['full_name']) ?></td>
                        <td><?= e($d['organization_name']) ?></td>
                        <td>₹<?= e(number_format($d['amount'], 2)) ?></td>
                        <td><?= e($d['payment_method']) ?></td>
                        <td><?= e($d['payment_status']) ?></td>
                        <td><?= e($d['receipt_number']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <p><a href="dashboard.php">&larr; Back to Dashboard</a></p>
</main>

<?php include '../includes/footer.php'; ?>
