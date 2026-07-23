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

<main>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <span class="badge">✔ Verified Organizations</span>

            <h1>Every Donation Reaches the Right Hands.</h1>

            <p>
                Support trusted organizations with complete transparency.
                Every organization is verified before joining Direct Link Hands,
                ensuring your contribution reaches those who need it most.
            </p>

            <div class="hero-buttons">
                <a href="organizations.php" class="btn btn-primary">
                    Browse Organizations
                </a>

                <a href="register.php" class="btn btn-outline">
                    Join Now
                </a>
            </div>

            <div class="hero-stats">
                <div>
                    <h3>100%</h3>
                    <p>Verified NGOs</p>
                </div>

                <div>
                    <h3>Secure</h3>
                    <p>Payments</p>
                </div>

                <div>
                    <h3>Transparent</h3>
                    <p>Donations</p>
                </div>
            </div>

        </div>

        <div class="hero-image">
            <img src="assets/images/charity.png" alt="Helping Hands">
        </div>
    </section>


    <!-- Why Choose -->
    <section class="features">

        <h2>Why Choose Direct Link Hands?</h2>

        <div class="feature-grid">

            <div class="feature-card">
                <i class="fas fa-check-circle"></i>
                <h3>Verified Organizations</h3>
                <p>
                    Every organization is carefully verified before it is allowed
                    to receive donations.
                </p>
            </div>

            <div class="feature-card">
                <i class="fas fa-lock"></i>
                <h3>Secure Donations</h3>
                <p>
                    Safe payment processing with complete transaction records.
                </p>
            </div>

            <div class="feature-card">
                <i class="fas fa-hand-holding-heart"></i>
                <h3>Direct Support</h3>
                <p>
                    Your donation goes directly to the selected organization.
                </p>
            </div>

        </div>

    </section>


    <!-- Featured Organizations -->

    <section class="featured-section">

        <div class="section-title">
            <h2>Featured Organizations</h2>
            <a href="organizations.php">View All →</a>
        </div>

        <div class="org-grid">

            <?php if(empty($organizations)): ?>

                <p>No organizations available.</p>

            <?php else: ?>

                <?php foreach($organizations as $org): ?>

                    <div class="org-card">

                        <div class="org-top">
                            <span class="verified">
                                ✔ Verified
                            </span>
                        </div>

                        <h3><?= e($org['organization_name']) ?></h3>

                        <p class="location">
                            📍 <?= e($org['city']) ?>,
                            <?= e($org['state']) ?>
                        </p>

                        <p>
                            <?= e(mb_strimwidth($org['description'] ?? '',0,140,'...')) ?>
                        </p>

                        <a class="btn btn-primary"
                           href="donate.php?org_id=<?= $org['org_id'] ?>">
                            Donate Now
                        </a>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </section>


    <!-- CTA -->

    <section class="cta">

        <h2>Together We Can Make a Difference</h2>

        <p>
            Join thousands of donors supporting verified organizations across
            the country.
        </p>

        <a href="register.php" class="btn btn-primary">
            Become a Donor
        </a>

    </section>

</main>


<?php include 'includes/footer.php'; ?>
