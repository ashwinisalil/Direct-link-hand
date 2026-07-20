<?php
include("php/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Organization Details | Direct Link Hands</title>

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

<button
class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">

<a href="index.php" class="nav-link">

Home

</a>

</li>

<li class="nav-item">

<a href="about.php" class="nav-link">

About

</a>

</li>

<li class="nav-item">

<a href="organizations.php" class="nav-link active">

Organizations

</a>

</li>

<li class="nav-item">

<a href="donate.php" class="nav-link">

Donate

</a>

</li>

<li class="nav-item">

<a href="contact.php" class="nav-link">

Contact

</a>

</li>

<li class="nav-item">

<a href="login.php" class="nav-link">

Login

</a>

</li>

</ul>

</div>

</div>

</nav>

<!-- ================= PAGE HEADER ================= -->

<section class="hero">

<div class="container text-center">

<h1>

Hope Hospital

</h1>

<p>

Verified Healthcare Organization

</p>

</div>

</section>

<!-- ================= ORGANIZATION DETAILS ================= -->

<section class="container py-5">

<div class="row">

<!-- Left Side -->

<div class="col-lg-5">

<img
src="images/organizations/hospital.png"
class="img-fluid rounded shadow">

<div class="mt-4">

<img
src="images/gallery1.jpg"
class="img-thumbnail me-2"
width="100">

<img
src="images/gallery2.jpg"
class="img-thumbnail me-2"
width="100">

<img
src="images/gallery3.jpg"
class="img-thumbnail"
width="100">

</div>

</div>

<!-- Right Side -->

<div class="col-lg-7">

<span class="badge bg-success fs-6">

Verified Organization

</span>

<h2 class="mt-3">

Hope Hospital

</h2>

<p class="text-success fw-bold">

Category : Hospital

</p>

<p>

Hope Hospital is a charitable healthcare institution dedicated to providing free medical treatment, life-saving surgeries, medicines, and emergency care to economically weaker patients across India.

</p>

<hr>

<div class="row">

<div class="col-md-6">

<p>

<strong>

Registration No.

</strong>

NGO/HSP/2026/4589

</p>

<p>

<strong>

Established

</strong>

2010

</p>

<p>

<strong>

Location

</strong>

Pune, Maharashtra

</p>

</div>

<div class="col-md-6">

<p>

<strong>

Email

</strong>

info@hopehospital.org

</p>

<p>

<strong>

Phone

</strong>

+91 9876543210

</p>

<p>

<strong>

Website

</strong>

www.hopehospital.org

</p>

</div>

</div>

<hr>

<h4>

Donation Progress

</h4>

<p>

₹6,80,000 Raised of ₹10,00,000 Goal

</p>

<div class="progress mb-4">

<div
class="progress-bar bg-success"
style="width:68%">

68%

</div>

</div>

<div class="d-grid gap-2">

<a
href="donate.php"
class="btn btn-warning btn-lg">

<i class="fa-solid fa-heart"></i>

Donate Now

</a>

</div>

</div>

</div>

</section>

<!-- ================= QUICK STATS ================= -->

<section class="container pb-5">

<div class="row">

<div class="col-md-3">

<div class="stat-box">

<h2>

15+

</h2>

<p>

Years of Service

</p>

</div>

</div>

<div class="col-md-3">

<div class="stat-box">

<h2>

25,000+

</h2>

<p>

Patients Helped

</p>

</div>

</div>

<div class="col-md-3">

<div class="stat-box">

<h2>

320+

</h2>

<p>

Medical Camps

</p>

</div>

</div>

<div class="col-md-3">

<div class="stat-box">

<h2>

₹2.4 Cr

</h2>

<p>

Funds Utilized

</p>

</div>

</div>

</div>

</section><!-- ================= ACTIVE CAMPAIGNS ================= -->

<section class="container py-5">

<h2 class="text-center mb-5">

Active Campaigns

</h2>

<div class="row">

<!-- Campaign 1 -->

<div class="col-lg-4 mb-4">

<div class="card shadow h-100">

<img
src="images/campaigns/campaign1.jpg"
class="card-img-top">

<div class="card-body">

<h5>

Free Heart Surgery

</h5>

<p>

Help poor patients receive life-saving heart surgeries.

</p>

<p>

<strong>Goal:</strong> ₹5,00,000

</p>

<p>

<strong>Raised:</strong> ₹3,40,000

</p>

<div class="progress">

<div
class="progress-bar bg-success"
style="width:68%">

68%

</div>

</div>

<a
href="donate.php"
class="btn btn-success mt-3 w-100">

Donate

</a>

</div>

</div>

</div>

<!-- Campaign 2 -->

<div class="col-lg-4 mb-4">

<div class="card shadow h-100">

<img
src="images/campaigns/campaign2.jpg"
class="card-img-top">

<div class="card-body">

<h5>

Cancer Medicine Support

</h5>

<p>

Provide free medicines to cancer patients.

</p>

<p>

<strong>Goal:</strong> ₹8,00,000

</p>

<p>

<strong>Raised:</strong> ₹5,20,000

</p>

<div class="progress">

<div
class="progress-bar bg-success"
style="width:65%">

65%

</div>

</div>

<a
href="donate.php"
class="btn btn-success mt-3 w-100">

Donate

</a>

</div>

</div>

</div>

<!-- Campaign 3 -->

<div class="col-lg-4 mb-4">

<div class="card shadow h-100">

<img
src="images/campaigns/campaign3.jpg"
class="card-img-top">

<div class="card-body">

<h5>

Free Medical Camp

</h5>

<p>

Organizing health check-up camps in villages.

</p>

<p>

<strong>Goal:</strong> ₹2,00,000

</p>

<p>

<strong>Raised:</strong> ₹1,50,000

</p>

<div class="progress">

<div
class="progress-bar bg-success"
style="width:75%">

75%

</div>

</div>

<a
href="donate.php"
class="btn btn-success mt-3 w-100">

Donate

</a>

</div>

</div>

</div>

</div>

</section>

<!-- ================= CERTIFICATES ================= -->

<section class="bg-light py-5">

<div class="container">

<h2 class="text-center mb-5">

Verification & Certificates

</h2>

<div class="row text-center">

<div class="col-md-3">

<img
src="images/certificates/certificate.png"
class="img-fluid rounded shadow mb-3">

<h5>

Registration Certificate

</h5>

</div>

<div class="col-md-3">

<img
src="images/certificates/pan.png"
class="img-fluid rounded shadow mb-3">

<h5>

PAN Certificate

</h5>

</div>

<div class="col-md-3">

<img
src="images/certificates/80g.png"
class="img-fluid rounded shadow mb-3">

<h5>

80G Certificate

</h5>

</div>

<div class="col-md-3">

<img
src="images/certificates/bank.png"
class="img-fluid rounded shadow mb-3">

<h5>

Verified Bank Account

</h5>

</div>

</div>

</div>

</section><!-- ================= WHY DONATE ================= -->

<section class="container py-5">

<h2 class="text-center mb-5">

Why Donate to Hope Hospital?

</h2>

<div class="row">

<div class="col-md-6">

<ul class="list-group shadow">

<li class="list-group-item">
✅ Government Registered Organization
</li>

<li class="list-group-item">
✅ Transparent Donation Reports
</li>

<li class="list-group-item">
✅ Secure Online Payments
</li>

<li class="list-group-item">
✅ Regular Campaign Updates
</li>

<li class="list-group-item">
✅ 15+ Years of Public Service
</li>

</ul>

</div>

<div class="col-md-6">

<img
src="images/why-donate.png"
class="img-fluid rounded shadow">

</div>

</div>

</section>

<!-- ================= DONOR REVIEWS ================= -->

<section class="container py-5">

<h2 class="text-center mb-5">

Donor Reviews

</h2>

<div class="row">

<div class="col-lg-4">

<div class="card shadow p-4 h-100">

<h5>⭐⭐⭐⭐⭐</h5>

<p>

Very transparent organization.
I received regular updates after donating.

</p>

<strong>

- Rahul Sharma

</strong>

</div>

</div>

<div class="col-lg-4">

<div class="card shadow p-4 h-100">

<h5>⭐⭐⭐⭐⭐</h5>

<p>

Secure payment process and verified documents.
Highly recommended.

</p>

<strong>

- Priya Verma

</strong>

</div>

</div>

<div class="col-lg-4">

<div class="card shadow p-4 h-100">

<h5>⭐⭐⭐⭐⭐</h5>

<p>

My donation reached the organization directly.
Excellent platform.

</p>

<strong>

- Amit Patil

</strong>

</div>

</div>

</div>

</section>

<!-- ================= LATEST UPDATES ================= -->

<section class="bg-light py-5">

<div class="container">

<h2 class="text-center mb-5">

Latest Updates

</h2>

<div class="card shadow">

<div class="card-body">

<h4>

June 2026 Medical Camp

</h4>

<p>

Hope Hospital successfully organized a free medical camp where more than 600 patients received treatment.

</p>

<hr>

<h4>

New ICU Equipment Installed

</h4>

<p>

With the support of donors, advanced ICU equipment has been installed.

</p>

<hr>

<h4>

Free Medicine Distribution

</h4>

<p>

More than 1,200 families received free medicines during this campaign.

</p>

</div>

</div>

</div>

</section><!-- ================= CONTACT ================= -->

<section class="container py-5">

<div class="row">

<div class="col-lg-6">

<h2 class="mb-4">

Contact Information

</h2>

<div class="card shadow border-0">

<div class="card-body">

<p>

<i class="fa-solid fa-location-dot text-success"></i>

Pune, Maharashtra, India

</p>

<p>

<i class="fa-solid fa-phone text-success"></i>

+91 9876543210

</p>

<p>

<i class="fa-solid fa-envelope text-success"></i>

info@hopehospital.org

</p>

<p>

<i class="fa-solid fa-globe text-success"></i>

www.hopehospital.org

</p>

</div>

</div>

</div>

<div class="col-lg-6">

<h2 class="mb-4">

Location

</h2>

<div class="card shadow border-0">

<img
src="images/map-placeholder.png"
class="img-fluid rounded"
alt="Map">

</div>

</div>

</div>

</section>

<!-- ================= CALL TO ACTION ================= -->

<section class="bg-success text-white py-5">

<div class="container text-center">

<h2>

Every Donation Creates Hope

</h2>

<p>

Help us provide better healthcare to thousands of people.

</p>

<a
href="donate.php"
class="btn btn-warning btn-lg">

<i class="fa-solid fa-heart"></i>

Donate Now

</a>

</div>

</section>

<!-- ================= FOOTER ================= -->

<footer class="bg-dark text-white pt-5">

<div class="container">

<div class="row">

<div class="col-lg-4">

<h4>

Direct Link Hands

</h4>

<p>

Connecting donors directly with verified organizations through secure and transparent donations.

</p>

</div>

<div class="col-lg-2">

<h5>

Quick Links

</h5>

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

<a href="donate.php" class="text-white text-decoration-none">

Donate

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

<div class="col-lg-3">

<h5>

Categories

</h5>

<ul class="list-unstyled">

<li>🏥 Hospital</li>

<li>🎓 Education</li>

<li>💊 Medicine</li>

<li>🏠 Orphan Home</li>

<li>👴 Old Age Home</li>

<li>🐶 Animal Welfare</li>

</ul>

</div>

<div class="col-lg-3">

<h5>

Contact

</h5>

<p>

📍 Pune, Maharashtra

</p>

<p>

📧 support@directlinkhands.com

</p>

<p>

📞 +91 9876543210

</p>

</div>

</div>

<hr class="bg-light">

<div class="text-center pb-3">

© 2026 Direct Link Hands. All Rights Reserved.

</div>

</div>

</footer>

<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->

<script src="js/script.js"></script>

</body>

</html>