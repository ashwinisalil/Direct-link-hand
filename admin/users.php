<?php
require_once '../includes/db.php';
$pageTitle = 'Manage Users';

if (!isset($_SESSION['admin_id'])) {
    redirect('../login.php');
}

// Delete a user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    redirect('users.php');
}

$users = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM users ORDER BY created_at DESC"), MYSQLI_ASSOC);

include '../includes/header.php';
include '../includes/navbar.php';
?>

<main class="container page">
    <h1>Manage Donors</h1>

    <table class="data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th>Registered</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($users)): ?>
                <tr><td colspan="6">No users found.</td></tr>
            <?php else: ?>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?= e($u['full_name']) ?></td>
                        <td><?= e($u['email']) ?></td>
                        <td><?= e($u['phone']) ?></td>
                        <td><?= e($u['city']) ?></td>
                        <td><?= e(date('d M Y', strtotime($u['created_at']))) ?></td>
                        <td>
                            <a href="?delete=<?= e($u['user_id']) ?>"
                               onclick="return confirm('Delete this user?');"
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
