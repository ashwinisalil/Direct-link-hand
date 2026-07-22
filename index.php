<?php
/**
 * ===============================================================
 * HOME PAGE (index.php)
 * ===============================================================
 * Sections on this page, top to bottom:
 *   1. Hero          - intro text + illustration + route diagram
 *   2. Impact stats   - live counts pulled from the database
 *   3. Categories     - browse by cause, with organization counts
 *   4. Featured orgs  - newest approved organizations
 *   5. Why us         - 3 feature cards explaining the platform
 *   6. CTA banner     - final call-to-action to register
 * ===============================================================
 */

require_once 'includes/db.php';
$pageTitle = 'Home';
include 'includes/header.php';
include 'includes/navbar.php';

// ---- Featured organizations: 6 most recently approved ----
$result = mysqli_query($conn, "SELECT org_id, organization_name, city, state, description
                                FROM organizations
                                WHERE status = 'Approved'
                                ORDER BY created_at DESC
                                LIMIT 6");
$organizations = mysqli_fetch_all($result, MYSQLI_ASSOC);

// ---- Impact stats: live totals shown to every visitor ----
$approvedOrgCount = mysqli_fetch_row(mysqli_query($conn,
    "SELECT COUNT(*) FROM organizations WHERE status = 'Approved'"))[0];
$totalDonationCount = mysqli_fetch_row(mysqli_query($conn,
    "SELECT COUNT(*) FROM donations WHERE payment_status = 'Completed'"))[0];
$totalRaised = mysqli_fetch_row(mysqli_query($conn,
    "SELECT COALESCE(SUM(amount),0) FROM donations WHERE payment_status = 'Completed'"))[0];
$categoryCount = mysqli_fetch_row(mysqli_query($conn,
    "SELECT COUNT(*) FROM categories"))[0];

// ---- Categories: each with a live count of approved organizations ----
// LEFT JOIN + COUNT so categories with 0 approved organizations still show up
$categoryResult = mysqli_query($conn, "SELECT c.category_id, c.category_name,
                                               COUNT(o.org_id) AS org_count
                                        FROM categories c
                                        LEFT JOIN organizations o
                                               ON o.category_id = c.category_id
                                              AND o.status = 'Approved'
                                        GROUP BY c.category_id, c.category_name
                                        ORDER BY c.category_name");
$categories = mysqli_fetch_all($categoryResult, MYSQLI_ASSOC);

// A small set of hand-made icons (see /images) is cycled through the
// category cards purely for visual variety — they aren't tied to any
// specific category's meaning.
$categoryIcons = ['icon-leaf.svg', 'icon-seedling.svg', 'icon-globe.svg', 'icon-hands.svg'];
?>

<main class="container">

    <!-- ============ 1. HERO ============ -->
    <section class="hero hero-flex">
        <div class="hero-text">
            <p class="eyebrow">Verified · Direct · Traceable</p>
            <h1>A straight line from your hand to theirs.</h1>
            <p class="lede">No middlemen, no vague "impact reports." Every donation on Direct Link Hands
               moves straight to a document-verified organization, with a receipt to prove it.</p>
            <div>
                <a href="organizations.php" class="btn btn-primary">Browse Organizations</a>
                <a href="register.php" class="btn btn-secondary">Get Started</a>
            </div>
        </div>
        <div class="hero-visual">
            <img src="/DirectLinkHands/images/illustration-hero.svg" alt="Illustration of hands cupped around a growing seedling" width="480" height="360">
        </div>
    </section>

    <!-- Route diagram: You -> Direct Link Hands -> Organization -->
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

    <!-- ============ 2. IMPACT STATS (live from the database) ============ -->
    <section class="page">
        <p class="eyebrow">Right now, on this platform</p>
        <h2>Our Collective Impact</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <img src="/DirectLinkHands/images/icon-hands.svg" alt="" class="stat-icon">
                <h3><?= e($approvedOrgCount) ?></h3>
                <p>Verified Organizations</p>
            </div>
            <div class="stat-card">
                <img src="/DirectLinkHands/images/icon-leaf.svg" alt="" class="stat-icon">
                <h3><?= e($totalDonationCount) ?></h3>
                <p>Donations Completed</p>
            </div>
            <div class="stat-card">
                <img src="/DirectLinkHands/images/icon-globe.svg" alt="" class="stat-icon">
                <h3><?= e($categoryCount) ?></h3>
                <p>Causes Supported</p>
            </div>
            <div class="stat-card">
                <img src="/DirectLinkHands/images/icon-seedling.svg" alt="" class="stat-icon">
                <h3>₹<?= e(number_format($totalRaised, 0)) ?></h3>
                <p>Total Raised</p>
            </div>
        </div>
    </section>

    <!-- ============ 3. CATEGORIES ============ -->
    <section class="page">
        <p class="eyebrow">Browse by cause</p>
        <h2>Every Category, One Direct Line</h2>
        <div class="card-grid">
            <?php foreach ($categories as $i => $cat): ?>
                <a href="organizations.php?category_id=<?= e($cat['category_id']) ?>" class="category-card">
                    <img src="/DirectLinkHands/images/<?= e($categoryIcons[$i % count($categoryIcons)]) ?>" alt="" class="category-icon">
                    <h3><?= e($cat['category_name']) ?></h3>
                    <p class="ticket-meta"><?= e($cat['org_count']) ?> organization<?= $cat['org_count'] == 1 ? '' : 's' ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ============ 4. FEATURED ORGANIZATIONS ============ -->
    <section class="page">
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

    <!-- ============ 5. WHY DIRECT LINK HANDS ============ -->
    <section class="page">
        <p class="eyebrow">Why us</p>
        <h2>Built for Trust, Not Just Traffic</h2>
        <div class="card-grid">
            <div class="feature-card">
                <img src="/DirectLinkHands/images/icon-hands.svg" alt="" class="feature-icon">
                <h3>Document-Verified</h3>
                <p>Every organization submits a registration certificate, PAN card, and government certification before going live.</p>
            </div>
            <div class="feature-card">
                <img src="/DirectLinkHands/images/icon-globe.svg" alt="" class="feature-icon">
                <h3>Fully Transparent</h3>
                <p>Every donation is logged with a receipt number and payment reference you can look up any time.</p>
            </div>
            <div class="feature-card">
                <img src="/DirectLinkHands/images/icon-seedling.svg" alt="" class="feature-icon">
                <h3>Real, Direct Impact</h3>
                <p>Your donation goes straight to the organization you picked — no pooled funds, no black-box allocation.</p>
            </div>
        </div>
    </section>

    <!-- ============ 6. CTA BANNER ============ -->
    <section class="cta-banner">
        <img src="/DirectLinkHands/images/icon-leaf.svg" alt="" class="cta-icon">
        <h2>Ready to make a direct impact?</h2>
        <p>Join as a donor in under a minute, or register your organization for review.</p>
        <div>
            <a href="register.php" class="btn btn-primary">Create an Account</a>
            <a href="organizations.php" class="btn btn-secondary-inverse">Browse Organizations</a>
        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>
