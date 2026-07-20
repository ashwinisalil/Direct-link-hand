<?php
include("php/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Us | Direct Link Hands</title>

    <link rel="stylesheet" href="css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<!-- ================= NAVBAR ================= -->

<nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top">

<div class="container">

<a class="navbar-brand fw-bold" href="index.php">

<i class="fa-solid fa-hand-holding-heart"></i>

Direct Link Hands

</a>

<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a href="index.php" class="nav-link">Home</a>
</li>

<li class="nav-item">
<a href="about.php" class="nav-link">About</a>
</li>

<li class="nav-item">
<a href="organizations.php" class="nav-link">Organizations</a>
</li>

<li class="nav-item">
<a href="contact.php" class="nav-link active">Contact</a>
</li>

<li class="nav-item">
<a href="login.php" class="nav-link">Login</a>
</li>

</ul>

</div>

</div>

</nav>

<!-- ================= HERO ================= -->

<section class="hero">

<div class="container text-center">

<h1>

Contact Us

</h1>

<p>

We would love to hear from you.

Get in touch with our team anytime.

</p>

</div>

</section>

<!-- ================= CONTACT INFO ================= -->

<section class="container py-5">

<div class="row">

<div class="col-lg-4">

<div class="card shadow border-0 h-100">

<div class="card-body text-center">

<i class="fa-solid fa-location-dot fa-3x text-success mb-3"></i>

<h4>

Office Address

</h4>

<p>

Direct Link Hands

Narhe,

Pune,

Maharashtra,

India

</p>

</div>

</div>

</div>

<div class="col-lg-4">

<div class="card shadow border-0 h-100">

<div class="card-body text-center">

<i class="fa-solid fa-phone fa-3x text-success mb-3"></i>

<h4>

Phone

</h4>

<p>

+91 9876543210

</p>

<p>

+91 9123456780

</p>

</div>

</div>

</div>

<div class="col-lg-4">

<div class="card shadow border-0 h-100">

<div class="card-body text-center">

<i class="fa-solid fa-envelope fa-3x text-success mb-3"></i>

<h4>

Email

</h4>

<p>

support@directlinkhands.com

</p>

<p>

info@directlinkhands.com

</p>

</div>

</div>

</div>

</div>

</section>

<!-- ================= CONTACT FORM ================= -->

<section class="container pb-5">

<div class="row">

<div class="col-lg-7">

<div class="card shadow border-0">

<div class="card-body p-4">

<h3 class="mb-4">

Send us a Message

</h3>

<form action="php/contact_process.php" method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>Full Name</label>

<input
type="text"
class="form-control"
name="name"
required>

</div>

<div class="col-md-6 mb-3">

<label>Email</label>

<input
type="email"
class="form-control"
name="email"
required>

</div>

<div class="col-md-12 mb-3">

<label>Subject</label>

<input
type="text"
class="form-control"
name="subject"
required>

</div>

<div class="col-md-12 mb-3">

<label>Message</label>

<textarea
rows="6"
class="form-control"
name="message"
required></textarea>

</div>

<div class="d-grid">

<button
class="btn btn-success btn-lg">

<i class="fa-solid fa-paper-plane"></i>

Send Message

</button>

</div>

</div>

</div>

</div>

</div>
<!-- Right Side -->

<div class="col-lg-5">

<div class="card shadow border-0">

<div class="card-body">

<h3 class="mb-4">

Office Hours

</h3>

<table class="table">

<tr>

<td>

Monday - Friday

</td>

<td>

9:00 AM - 6:00 PM

</td>

</tr>

<tr>

<td>

Saturday

</td>

<td>

10:00 AM - 4:00 PM

</td>

</tr>

<tr>

<td>

Sunday

</td>

<td>

Closed

</td>

</tr>

</table>

<hr>

<h4>

Follow Us

</h4>

<div class="mt-3">

<a href="#" class="btn btn-outline-success me-2">

<i class="fab fa-facebook-f"></i>

</a>

<a href="#" class="btn btn-outline-success me-2">

<i class="fab fa-instagram"></i>

</a>

<a href="#" class="btn btn-outline-success me-2">

<i class="fab fa-twitter"></i>

</a>

<a href="#" class="btn btn-outline-success">

<i class="fab fa-linkedin-in"></i>

</a>

</div>

</div>

</div>

</div>

</div>

</section>

<!-- ================= MAP SECTION ================= -->

<section class="container pb-5">

<div class="card shadow border-0">

<div class="card-body">

<h2 class="text-center mb-4">

Find Us

</h2>

<img src="images/map-placeholder.png"
class="img-fluid rounded"
alt="Map">

</div>

</div>

</section>

<!-- ================= FAQ ================= -->

<section class="container py-5">

<h2 class="text-center mb-5">

Frequently Asked Questions

</h2>

<div class="accordion" id="faq">

<div class="accordion-item">

<h2 class="accordion-header">

<button
class="accordion-button"
data-bs-toggle="collapse"
data-bs-target="#q1">

How do I donate?

</button>

</h2>

<div
id="q1"
class="accordion-collapse collapse show"
data-bs-parent="#faq">

<div class="accordion-body">

Select an organization, choose a campaign,
enter your donation amount and proceed
with secure payment.

</div>

</div>

</div>

<div class="accordion-item">

<h2 class="accordion-header">

<button
class="accordion-button collapsed"
data-bs-toggle="collapse"
data-bs-target="#q2">

How are organizations verified?

</button>

</h2>

<div
id="q2"
class="accordion-collapse collapse"
data-bs-parent="#faq">

<div class="accordion-body">

Every organization submits government
registration documents, PAN details,
and bank verification before approval.

</div>

</div>

</div>

<div class="accordion-item">

<h2 class="accordion-header">

<button
class="accordion-button collapsed"
data-bs-toggle="collapse"
data-bs-target="#q3">

Is my payment secure?

</button>

</h2>

<div
id="q3"
class="accordion-collapse collapse"
data-bs-parent="#faq">

<div class="accordion-body">

Yes. Payments are processed using
secure payment gateways.

</div>

</div>

</div>

<div class="accordion-item">

<h2 class="accordion-header">

<button
class="accordion-button collapsed"
data-bs-toggle="collapse"
data-bs-target="#q4">

Will I receive a donation receipt?

</button>

</h2>

<div
id="q4"
class="accordion-collapse collapse"
data-bs-parent="#faq">

<div class="accordion-body">

Yes. A donation receipt will be generated
after a successful donation.

</div>

</div>

</div>

</div>

</section>
<!-- ================= CALL TO ACTION ================= -->

<section class="bg-success text-white py-5">

    <div class="container text-center">

        <h2>

            Together We Can Make a Difference

        </h2>

        <p>

            Support verified organizations and help create
            a better future for everyone.

        </p>

        <a href="organizations.php"
           class="btn btn-warning btn-lg">

            Donate Now

        </a>

    </div>

</section>

<!-- ================= FOOTER ================= -->

<footer class="bg-dark text-white pt-5">

    <div class="container">

        <div class="row">

            <div class="col-lg-4">

                <h4>Direct Link Hands</h4>

                <p>

                    Connecting donors with verified
                    organizations through secure and
                    transparent donations.

                </p>

            </div>

            <div class="col-lg-4">

                <h5>Quick Links</h5>

                <ul class="list-unstyled">

                    <li>
                        <a href="index.php" class="text-white text-decoration-none">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="about.php" class="text-white text-decoration-none">
                            About
                        </a>
                    </li>

                    <li>
                        <a href="organizations.php" class="text-white text-decoration-none">
                            Organizations
                        </a>
                    </li>

                    <li>
                        <a href="contact.php" class="text-white text-decoration-none">
                            Contact
                        </a>
                    </li>

                    <li>
                        <a href="login.php" class="text-white text-decoration-none">
                            Login
                        </a>
                    </li>

                </ul>

            </div>

            <div class="col-lg-4">

                <h5>Contact</h5>

                <p>📍 Narhe, Pune, Maharashtra</p>

                <p>📧 support@directlinkhands.com</p>

                <p>📞 +91 9876543210</p>

            </div>

        </div>

        <hr>

        <div class="text-center pb-3">

            © 2026 Direct Link Hands. All Rights Reserved.

        </div>

    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="js/script.js"></script>

</body>

</html>