<?php
/**
 * ===============================================================
 * ABOUT PAGE (about.php)
 * ===============================================================
 * A static informational page — no database writes happen here,
 * just a page explaining how the platform works in 3 steps.
 * ===============================================================
 */

require_once 'includes/db.php';
$pageTitle = 'About Us';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<main class="container page">
    <p class="eyebrow">About</p>
    <h1>Why "Direct Link"</h1>
    <p class="page-lede">
        Direct Link Hands exists to close the gap between someone who wants to help and the
        organization already doing the work. No pooled funds, no black-box allocation &mdash;
        every donation is routed to the organization the donor chose, and a receipt records
        exactly where it went.
    </p>

    <!-- 3-step explanation of the platform's workflow -->
    <div class="card-grid">
        <div class="ticket">
            <div class="ticket-stub"><span>Step 01</span><span class="ticket-stub-right">Verify</span></div>
            <div class="ticket-perf"></div>
            <div class="ticket-body">
                <h3>Organizations apply</h3>
                <p>Registration certificate, PAN, and government certification are submitted for review before an organization can appear on the platform.</p>
            </div>
        </div>
        <div class="ticket">
            <div class="ticket-stub"><span>Step 02</span><span class="ticket-stub-right">Approve</span></div>
            <div class="ticket-perf"></div>
            <div class="ticket-body">
                <h3>Admin reviews</h3>
                <p>Our team checks submitted documents and approves legitimate organizations across education, healthcare, orphan care, animal welfare, disaster relief, and medical aid.</p>
            </div>
        </div>
        <div class="ticket">
            <div class="ticket-stub"><span>Step 03</span><span class="ticket-stub-right">Donate</span></div>
            <div class="ticket-perf"></div>
            <div class="ticket-body">
                <h3>Donors give directly</h3>
                <p>You choose the organization, the amount, and the payment method. The transfer is recorded with a receipt number you can look up anytime.</p>
            </div>
        </div>
    </div>

    <h2>Our Mission</h2>
    <p>
        We aim to remove the friction between people who want to help and the
        organizations doing the work on the ground.
    </p>
</main>

<?php include 'includes/footer.php'; ?>
