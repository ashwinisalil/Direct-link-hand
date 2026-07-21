<?php
/**
 * ===============================================================
 * ADMIN: MANAGE ORGANIZATIONS (admin/organizations.php)
 * ===============================================================
 * This is where the admin approves or rejects organizations that
 * registered themselves via register.php. Every organization
 * (Pending, Approved, or Rejected) shows up here.
 *
 * An organization only becomes visible to the public (on
 * organizations.php / index.php) and able to log in AFTER it is
 * approved here.
 * ===============================================================
 */

require_once '../includes/db.php';
$pageTitle = 'Manage Organizations';

if (!isset($_SESSION['admin_id'])) {
    redirect('../login.php');
}

// Action links look like: ?action=approve&id=5, ?action=reject&id=5,
// or ?action=delete&id=5 — handle whichever one was clicked.
if (isset($_GET['action'], $_GET['id'])) {
    $id = $_GET['id'];

    if ($_GET['action'] === 'approve') {
        $stmt = mysqli_prepare($conn, "UPDATE organizations SET status = 'Approved' WHERE org_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    } elseif ($_GET['action'] === 'reject') {
        $stmt = mysqli_prepare($conn, "UPDATE organizations SET status = 'Rejected' WHERE org_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    } elseif ($_GET['action'] === 'delete') {
        $stmt = mysqli_prepare($conn, "DELETE FROM organizations WHERE org_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    }
    // Redirect back to this same page (without the ?action=... in the
    // URL) so refreshing the browser doesn't repeat the action.
    redirect('organizations.php');
}

// LEFT JOIN so organizations without a category still show up
// (category_name would just be NULL for them).
$organizations = mysqli_fetch_all(mysqli_query($conn, "SELECT o.*, c.category_name FROM organizations o
                                                         LEFT JOIN categories c ON o.category_id = c.category_id
                                                         ORDER BY o.created_at DESC"), MYSQLI_ASSOC);

include '../includes/header.php';
include '../includes/navbar.php';
?>

<main class="container page">
    <h1>Manage Organizations</h1>

    <table class="data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Email</th>
                <th>City</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($organizations)): ?>
                <tr><td colspan="6">No organizations found.</td></tr>
            <?php else: ?>
                <?php foreach ($organizations as $org): ?>
                    <tr>
                        <td><?= e($org['organization_name']) ?></td>
                        <td><?= e($org['category_name'] ?? '-') ?></td>
                        <td><?= e($org['email']) ?></td>
                        <td><?= e($org['city']) ?></td>
                        <!-- strtolower() turns "Approved" into "approved" to match
                             the .status-approved / .status-pending CSS classes -->
                        <td><span class="status status-<?= strtolower(e($org['status'])) ?>"><?= e($org['status']) ?></span></td>
                        <td>
                            <!-- Only show "Approve" if it isn't already approved,
                                 and only show "Reject" if it isn't already rejected -->
                            <?php if ($org['status'] !== 'Approved'): ?>
                                <a href="?action=approve&id=<?= e($org['org_id']) ?>" class="btn btn-small btn-success">Approve</a>
                            <?php endif; ?>
                            <?php if ($org['status'] !== 'Rejected'): ?>
                                <a href="?action=reject&id=<?= e($org['org_id']) ?>" class="btn btn-small btn-warning">Reject</a>
                            <?php endif; ?>
                            <a href="?action=delete&id=<?= e($org['org_id']) ?>"
                               onclick="return confirm('Delete this organization?');"
                               class="btn btn-small btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <p><a href="dashboard.php">&larr; Back to Dashboard</a></p>
</main>

<?php include '../includes/footer.php'; ?>
