<?php
require_once 'includes/db.php';
$pageTitle = 'Home';
include 'includes/header.php';
include 'includes/navbar.php';

// Fetch a few approved organizations to feature
$result = mysqli_query($conn, "SELECT org_id, organization_name, city, state, description
                                FROM organizations
                                WHERE status = 'Approved'
                                ORDER BY created_at DESC
                                LIMIT 6");
$organizations = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<main class="container">
    <section class="hero">
        <p class="eyebrow">Verified · Direct · Traceable</p>
        <h1>A straight line from your hand to theirs.</h1>
        <p class="lede">No middlemen, no vague "impact reports." Every donation on Direct Link Hands
           moves straight to a document-verified organization, with a receipt to prove it.</p>

        <div class="route">
            <div class="route-node">
                <span class="route-label">Donor</span>
                <strong>You</strong>
            </div>
            <div class="route-line"></div>
            <div class="route-node route-hub">
                <span class="route-label">Verified Transfer</span>
                <strong>Direct Link Hands</strong>
            </div>
            <div class="route-line"></div>
            <div class="route-node">
                <span class="route-label">Recipient</span>
                <strong>Organization</strong>
            </div>
        </div>

        <a href="organizations.php" class="btn btn-primary">Browse Organizations</a>
        <a href="register.php" class="btn btn-secondary">Get Started</a>
    </section>

    <section class="featured-orgs page">
        <p class="eyebrow">Featured</p>
        <h2>Organizations receiving support right now</h2>
        <div class="card-grid">
            <?php if (empty($organizations)): ?>
                <p>No approved organizations yet. Check back soon!</p>
            <?php else: ?>
                <?php foreach ($organizations as $org): ?>
                    <div class="ticket">
                        <div class="ticket-stub">
                            <span>Org #<?= e(str_pad($org['org_id'], 4, '0', STR_PAD_LEFT)) ?></span>
                            <span class="ticket-stub-right">Verified</span>
                        </div>
                        <div class="ticket-perf"></div>
                        <div class="ticket-body">
                            <h3><?= e($org['organization_name']) ?></h3>
                            <p class="ticket-meta"><?= e($org['city']) ?>, <?= e($org['state']) ?></p>
                            <p><?= e(mb_strimwidth($org['description'] ?? '', 0, 120, '...')) ?></p>
                            <a href="donate.php?org_id=<?= e($org['org_id']) ?>" class="btn btn-small btn-primary">Donate Now</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
