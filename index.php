

<?php
include("php/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Direct Link Hands | Verified Donation Platform</title>

    <link rel="stylesheet" href="css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<!-- ================= NAVBAR ================= -->

<nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top">

<div class="container">

<!-- <a class="navbar-brand fw-bold"< href="#"> -->
    <a class="navbar-brand fw-bold" href="index.php"></a>
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
<!--<a href="index.html" class="nav-link active">Home</a> -->

<a href="index.php" class="nav-link active">Home</a>
</li>

<li class="nav-item">
<!--<a href="about.html" class="nav-link">About</a>-->
<a href="about.php" class="nav-link">About</a>
</li>

<li class="nav-item">
<!-- <a href="organizations.html" class="nav-link">Organizations</a> -->
<a href="organizations.php" class="nav-link">Organizations</a>
</li>

<li class="nav-item">
<!-- <a href="contact.html" class="nav-link">Contact</a> -->
<a href="contact.php" class="nav-link">Contact</a>
</li>

<li class="nav-item">
<!-- <a href="login.html" class="nav-link">Login</a> -->
<a href="login.php" class="nav-link">Login</a>
</li>

</ul>

</div>

</div>

</nav>

<!-- ================= HERO ================= -->

<section class="hero">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-6">

<h1>

Donate With Trust

</h1>

<p>

Support verified hospitals, orphanages,
schools and NGOs.
Your contribution reaches organizations
securely through verified payment methods.

</p>

<!-- <a href="organizations.html" -->
<!-- class="btn btn-warning btn-lg"> -->

<a href="organizations.php"
class="btn btn-warning btn-lg">

Donate Now

</a>

</div>

<div class="col-lg-6 text-center">

<img src="images/donation.png"
class="img-fluid hero-img">

</div>

</div>

</div>

</section>

<!-- ================= CATEGORIES ================= -->

<section class="container py-5">

<h2 class="text-center mb-5">

Donation Categories

</h2>

<div class="row g-4">

<div class="col-md-3">

<div class="category-card">

<i class="fa-solid fa-hospital"></i>

<h5>Hospitals</h5>

</div>

</div>

<div class="col-md-3">

<div class="category-card">

<i class="fa-solid fa-book"></i>

<h5>Education</h5>

</div>

</div>

<div class="col-md-3">

<div class="category-card">

<i class="fa-solid fa-pills"></i>

<h5>Free Medicine</h5>

</div>

</div>

<div class="col-md-3">

<div class="category-card">

<i class="fa-solid fa-child-reaching"></i>

<h5>Orphan Homes</h5>

</div>

</div>

</div>

</section>

<!-- ================= VERIFIED ORGANIZATIONS ================= -->

<section class="bg-light py-5">

<div class="container">

<h2 class="text-center mb-5">

Verified Organizations

</h2>

<div class="row">

<div class="col-md-4">

<div class="card shadow">

<img src="images/org1.jpg"
class="card-img-top">

<div class="card-body">

<h5>

Helping Hands Foundation

</h5>

<span class="badge bg-success">

Verified

</span>

<p class="mt-3">

Providing education
for poor children.

</p>

<!-- <a href="organization-details.html"
class="btn btn-success"> -->

<a href="organization-details.php"
class="btn btn-success">

View Details

</a>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow">

<img src="images/org2.jpg"
class="card-img-top">

<div class="card-body">

<h5>

Hope Hospital

</h5>

<span class="badge bg-success">

Verified

</span>

<p class="mt-3">

Helping poor patients
with free treatment.

</p>

<!-- <a href="organization-details.html"
class="btn btn-success">


View Details

</a> -->

<a href="organization-details.php" class="btn btn-success">
    View Details
</a>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow">

<img src="images/org3.jpg"
class="card-img-top">

<div class="card-body">

<h5>

Smile Orphan Home

</h5>

<span class="badge bg-success">

Verified

</span>

<p class="mt-3">

Supporting orphan children.

</p>

<!-- <a href="organization-details.html"
class="btn btn-success">

View Details

</a> -->
<a href="organization-details.php" class="btn btn-success">
    View Details
</a>

</div>

</div>

</div>

</div>

</div>

</section>

<!-- ================= WHY US ================= -->

<section class="container py-5">

<h2 class="text-center">

Why Choose Direct Link Hands?

</h2>

<div class="row mt-5">

<div class="col-md-3">

<h1>✔</h1>

<p>Verified Organizations</p>

</div>

<div class="col-md-3">

<h1>🔒</h1>

<p>Secure Payments</p>

</div>

<div class="col-md-3">

<h1>📈</h1>

<p>Transparent Donations</p>

</div>

<div class="col-md-3">

<h1>❤️</h1>

<p>Direct Impact</p>

</div>

</div>

</section>

<!-- ================= FOOTER ================= -->

<footer class="bg-success text-white text-center p-4">

<h4>Direct Link Hands
</h4>

<p>

Changing lives through trusted donations.

</p>

<p>

© 2026 Direct Link Hands
</p>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="js/script.js"></script>

</body>
</html>