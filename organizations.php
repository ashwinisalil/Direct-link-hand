<?php
include("php/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Verified Organizations | Direct Link Hands</title>

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
<a href="index.php" class="nav-link">Home</a>
</li>

<li class="nav-item">
<a href="about.php" class="nav-link">About</a>
</li>

<li class="nav-item">
<a href="organizations.php" class="nav-link active">Organizations</a>
</li>

<li class="nav-item">
<a href="donate.php" class="nav-link">Donate</a>
</li>

<li class="nav-item">
<a href="contact.php" class="nav-link">Contact</a>
</li>

<li class="nav-item">
<a href="login.php" class="nav-link">Login</a>
</li>

</ul>

</div>

</div>

</nav>

<!-- ================= PAGE HEADER ================= -->

<section class="hero">

<div class="container text-center">

<h1>

Verified Organizations

</h1>

<p>

Donate with confidence to trusted and verified organizations.

</p>

</div>

</section>

<!-- ================= SEARCH ================= -->

<section class="container py-5">

<div class="row">

<div class="col-lg-8 mx-auto">

<input
type="text"
id="searchInput"
class="form-control form-control-lg"
placeholder="Search organization...">

</div>

</div>

</section>

<!-- ================= FILTER BUTTONS ================= -->

<section class="container mb-5 text-center">

<button class="btn btn-success m-2">All</button>

<button class="btn btn-outline-success m-2">Hospital</button>

<button class="btn btn-outline-success m-2">Education</button>

<button class="btn btn-outline-success m-2">Medicine</button>

<button class="btn btn-outline-success m-2">Orphan Home</button>

<button class="btn btn-outline-success m-2">Old Age Home</button>

<button class="btn btn-outline-success m-2">Animal Welfare</button>

</section>

<!-- ================= ORGANIZATION CARDS ================= -->

<section class="container pb-5">

<div class="row g-4">

<!-- CARD 1 -->

<div class="col-lg-4 col-md-6">

<div class="card shadow h-100">

<img
src="images/organizations/hospital.png"
class="card-img-top"
alt="Hospital">

<div class="card-body">

<span class="badge bg-success mb-2">

Verified

</span>

<h4>

Hope Hospital

</h4>

<p class="text-success fw-bold">

Hospital

</p>

<p>

Providing free treatment and surgeries for financially weaker patients.

</p>

<small>

₹6,80,000 Raised of ₹10,00,000

</small>

<div class="progress mt-2 mb-3">

<div
class="progress-bar bg-success"
style="width:68%">

</div>

</div>

<a
href="organization-details.php"
class="btn btn-success">

View Details

</a>

<a
href="donate.php"
class="btn btn-warning">

Donate

</a>

</div>

</div>

</div>

<!-- CARD 2 -->

<div class="col-lg-4 col-md-6">

<div class="card shadow h-100">

<img
src="images/organizations/education.png"
class="card-img-top"
alt="Education">

<div class="card-body">

<span class="badge bg-success mb-2">

Verified

</span>

<h4>

Bright Future Foundation

</h4>

<p class="text-success fw-bold">

Education

</p>

<p>

Supporting education for underprivileged children.

</p>

<small>

₹4,25,000 Raised of ₹8,00,000

</small>

<div class="progress mt-2 mb-3">

<div
class="progress-bar bg-success"
style="width:53%">

</div>

</div>

<a
href="organization-details.php"
class="btn btn-success">

View Details

</a>

<a
href="donate.php"
class="btn btn-warning">

Donate

</a>

</div>

</div>

</div>


<!-- CARD 3 -->

<div class="col-lg-4 col-md-6">

<div class="card shadow h-100">

<img
src="images/organizations/medicine.png"
class="card-img-top"
alt="Medicine">

<div class="card-body">

<span class="badge bg-success mb-2">

Verified

</span>

<h4>

Health For All

</h4>

<p class="text-success fw-bold">

Free Medicine

</p>

<p>

Providing medicines to poor families free of cost.

</p>

<small>

₹3,10,000 Raised of ₹5,00,000

</small>

<div class="progress mt-2 mb-3">

<div
class="progress-bar bg-success"
style="width:62%">

</div>

</div>

<a
href="organization-details.php"
class="btn btn-success">

View Details

</a>

<a
href="donate.php"
class="btn btn-warning">

Donate

</a>

</div>

</div>

</div>

<!-- CARD 4 -->

<div class="col-lg-4 col-md-6">

<div class="card shadow h-100">

<img
src="images/organizations/orphan.png"
class="card-img-top"
alt="Orphan Home">

<div class="card-body">

<span class="badge bg-success mb-2">

Verified

</span>

<h4>

Smile Orphan Home

</h4>

<p class="text-success fw-bold">

Orphan Home

</p>

<p>

Providing shelter, education and healthcare for orphan children.

</p>

<small>

₹4,60,000 Raised of ₹7,00,000

</small>

<div class="progress mt-2 mb-3">

<div
class="progress-bar bg-success"
style="width:66%">

</div>

</div>

<a
href="organization-details.php"
class="btn btn-success">

View Details

</a>

<a
href="donate.php"
class="btn btn-warning">

Donate

</a>

</div>

</div>

</div>

<!-- CARD 5 -->

<div class="col-lg-4 col-md-6">

<div class="card shadow h-100">

<img
src="images/organizations/oldage.png"
class="card-img-top"
alt="Old Age Home">

<div class="card-body">

<span class="badge bg-success mb-2">

Verified

</span>

<h4>

Golden Age Home

</h4>

<p class="text-success fw-bold">

Old Age Home

</p>

<p>

Caring for senior citizens with healthcare, shelter and daily support.

</p>

<small>

₹2,80,000 Raised of ₹6,00,000

</small>

<div class="progress mt-2 mb-3">

<div
class="progress-bar bg-success"
style="width:47%">

</div>

</div>

<a
href="organization-details.php"
class="btn btn-success">

View Details

</a>

<a
href="donate.php"
class="btn btn-warning">

Donate

</a>

</div>

</div>

</div>

<!-- CARD 6 -->

<div class="col-lg-4 col-md-6">

<div class="card shadow h-100">

<img
src="images/organizations/animal.png"
class="card-img-top"
alt="Animal Welfare">

<div class="card-body">

<span class="badge bg-success mb-2">

Verified

</span>

<h4>

Animal Care Foundation

</h4>

<p class="text-success fw-bold">

Animal Welfare

</p>

<p>

Rescuing injured animals and providing food, shelter and medical care.

</p>

<small>

₹2,40,000 Raised of ₹4,00,000

</small>

<div class="progress mt-2 mb-3">

<div
class="progress-bar bg-success"
style="width:60%">

</div>

</div>

<a
href="organization-details.php"
class="btn btn-success">

View Details

</a>

<a
href="donate.php"
class="btn btn-warning">

Donate

</a>

</div>

</div>

</div>

</div>

</section>
<!-- ================= FOOTER ================= -->

<footer class="bg-dark text-white pt-5">

<div class="container">

<div class="row">

<div class="col-md-4">

<h4>

Direct Link Hands

</h4>

<p>

Connecting donors directly with verified organizations through secure and transparent donations.

</p>

</div>

<div class="col-md-4">

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

<div class="col-md-4">

<h5>

Contact

</h5>

<p>

📧 support@directlinkhands.com

</p>

<p>

📞 +91 9876543210

</p>

<p>

📍 Narhe, Pune, Maharashtra

</p>

</div>

</div>

<hr class="bg-light">

<p class="text-center pb-3">

© 2026 Direct Link Hands. All Rights Reserved.

</p>

</div>

</footer>

<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->

<script src="js/script.js"></script>

</body>

</html>