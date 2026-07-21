<?php
/**
 * ===============================================================
 * ORGANIZATIONS DIRECTORY (organizations.php)
 * ===============================================================
 * Public page listing every APPROVED organization, with an
 * optional dropdown to filter by category (Education, Healthcare,
 * etc). Each card links to donate.php with that organization
 * pre-selected.
 * ===============================================================
 */

require_once 'includes/db.php';
$pageTitle = 'Organizations';

// $_GET['category_id'] comes from the filter dropdown below.
// It's empty ('') when no filter is applied (i.e. "All Categories").
$category_id = $_GET['category_id'] ?? '';

// Categories list, used to build the filter dropdown.
$categories = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name"), MYSQLI_ASSOC);

if ($category_id !== '') {
    // A specific category was chosen — filter by it.
    // We use a prepared statement here because $category_id comes
    // from the URL and could theoretically be tampered with.
    $stmt = mysqli_prepare($conn, "SELECT o.*, c.category_name FROM organizations o
                                    LEFT JOIN categories c ON o.category_id = c.category_id
                                    WHERE o.status = 'Approved' AND o.category_id = ?
                                    ORDER BY o.organization_name");
    mysqli_stmt_bind_param($stmt, "i", $category_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    // No filter — show every approved organization.
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

    <!-- method="GET" so the chosen category shows up in the URL
         (e.g. ?category_id=2), which makes the filtered page linkable
         and lets the browser's back button work as expected. -->
    <form method="GET" class="filter-form">
        <label for="category_id">Filter:</label>
        <!-- onchange="this.form.submit()" auto-submits the form as soon
             as a new category is picked, no separate "Go" button needed -->
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
