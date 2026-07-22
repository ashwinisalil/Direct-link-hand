<?php
require_once 'includes/db.php';
$pageTitle = 'Organizations';

// Optional category filter
$category_id = $_GET['category_id'] ?? '';

$categories = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name"), MYSQLI_ASSOC);

if ($category_id !== '') {
    $stmt = mysqli_prepare($conn, "SELECT o.*, c.category_name FROM organizations o
                                    LEFT JOIN categories c ON o.category_id = c.category_id
                                    WHERE o.status = 'Approved' AND o.category_id = ?
                                    ORDER BY o.organization_name");
    mysqli_stmt_bind_param($stmt, "i", $category_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $result = mysqli_query($conn, "SELECT o.*, c.category_name FROM organizations o
                                    LEFT JOIN categories c ON o.category_id = c.category_id
                                    WHERE o.status = 'Approved'
                                    ORDER BY o.organization_name");
}
$organizations = mysqli_fetch_all($result, MYSQLI_ASSOC);

include 'includes/header.php';
include 'includes/navbar.php';
?>

<main class="container page">
    <p class="eyebrow">Directory</p>
    <h1>Approved Organizations</h1>
    <p class="page-lede">Every organization listed here has passed document review. Pick one and the transfer goes straight to them.</p>

    <form method="GET" class="filter-form">
        <label for="category_id">Filter:</label>
        <select id="category_id" name="category_id" onchange="this.form.submit()">
            <option value="">All Categories</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= e($cat['category_id']) ?>" <?= ($category_id == $cat['category_id']) ? 'selected' : '' ?>>
                    <?= e($cat['category_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <div class="card-grid">
        <?php if (empty($organizations)): ?>
            <p>No organizations found for this filter.</p>
        <?php else: ?>
            <?php foreach ($organizations as $org): ?>
                <div class="ticket">
                    <div class="ticket-stub">
                        <span>Org #<?= e(str_pad($org['org_id'], 4, '0', STR_PAD_LEFT)) ?></span>
                        <span class="ticket-stub-right"><?= e($org['category_name'] ?? 'General') ?></span>
                    </div>
                    <div class="ticket-perf"></div>
                    <div class="ticket-body">
                        <h3><?= e($org['organization_name']) ?></h3>
                        <p class="ticket-meta"><?= e($org['city']) ?>, <?= e($org['state']) ?></p>
                        <p><?= e(mb_strimwidth($org['description'] ?? '', 0, 150, '...')) ?></p>
                        <a href="donate.php?org_id=<?= e($org['org_id']) ?>" class="btn btn-small btn-primary">Donate Now</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
