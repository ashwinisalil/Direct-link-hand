<?php
include("php/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Donate Now | Direct Link Hands</title>

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
<a class="nav-link" href="index.php">Home</a>
</li>

<li class="nav-item">
<a class="nav-link" href="about.php">About</a>
</li>

<li class="nav-item">
<a class="nav-link" href="organizations.php">Organizations</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="donate.php">Donate</a>
</li>

<li class="nav-item">
<a class="nav-link" href="contact.php">Contact</a>
</li>

<li class="nav-item">
<a class="nav-link" href="login.php">Login</a>
</li>

</ul>

</div>

</div>

</nav>

<!-- ================= PAGE HEADER ================= -->

<section class="hero">

<div class="container text-center">

<h1>

Donate Now

</h1>

<p>

Every contribution creates a positive impact.

</p>

</div>

</section>

<!-- ================= DONATION SECTION ================= -->

<section class="container py-5">

<div class="row">

<!-- Left -->

<div class="col-lg-7">

<div class="card shadow border-0">

<div class="card-body p-4">

<h3>

Hope Hospital

</h3>

<p class="text-success">

❤️ Heart Surgery Campaign

</p>

<p>

Help poor children receive life-saving heart surgeries.

</p>

<p>

<strong>Goal:</strong> ₹10,00,000

</p>

<p>

<strong>Raised:</strong> ₹6,80,000

</p>

<div class="progress mb-4">

<div class="progress-bar bg-success"
style="width:68%;">

68%

</div>

</div>

<hr>

<h4>

Choose Donation Amount

</h4>

<div class="row mt-4">

<div class="col-6 col-md-3 mb-3">

<button
class="btn btn-outline-success w-100 amount-btn"
data-value="100">

₹100

</button>

</div>

<div class="col-6 col-md-3 mb-3">

<button
class="btn btn-outline-success w-100 amount-btn"
data-value="500">

₹500

</button>

</div>

<div class="col-6 col-md-3 mb-3">

<button
class="btn btn-outline-success w-100 amount-btn"
data-value="1000">

₹1000

</button>

</div>

<div class="col-6 col-md-3 mb-3">

<button
class="btn btn-outline-success w-100 amount-btn"
data-value="5000">

₹5000

</button>

</div>

</div>

<div class="mb-4">

<label>

Custom Amount

</label>

<input
type="number"
id="amount"
class="form-control"
placeholder="Enter Amount">

</div>

<h4>

Donor Details

</h4>

<!-- <form action="php/donate_process.php" method="POST"> -->
    <form id="donationForm" action="php/donate_process.php" method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>

Full Name

</label>

<input
type="text"
name="fullname"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>

Email

</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>

Mobile

</label>

<input
type="text"
name="mobile"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>

City

</label>

<input
type="text"
name="city"
class="form-control">

</div>

<div class="mb-3">

<label>

Message (Optional)

</label>

<textarea
rows="3"
name="message"
class="form-control"
placeholder="Write a message..."></textarea>

</div>

<hr>

<h4 class="mb-3">

Select Payment Method

</h4>
<div class="form-check mb-2">

<input class="form-check-input"
type="radio"
name="payment"
value="Net Banking"
checked>

<label class="form-check-label">

<i class="fa-solid fa-building-columns text-primary"></i>

Net Banking

</label>

</div>

<div class="form-check mb-2">

<input class="form-check-input"
type="radio"
name="payment"
value="UPI">

<label class="form-check-label">

<i class="fa-brands fa-google-pay text-success"></i>

UPI

</label>

</div>

<div class="form-check mb-2">

<input class="form-check-input"
type="radio"
name="payment"
value="Card">

<label class="form-check-label">

<i class="fa-solid fa-credit-card text-danger"></i>

Debit / Credit Card

</label>

</div>

<div class="form-check mb-4">

<input class="form-check-input"
type="radio"
name="payment"
value="Wallet">

<label class="form-check-label">

Wallet

</label>

</div>

</div>

</form>

</div>

</div>

</div>

<!-- ================= RIGHT SIDE ================= -->

<div class="col-lg-5">

<div class="card shadow border-0 sticky-top" style="top:90px;">

<div class="card-body">

<h3 class="text-center mb-4">

Donation Summary

</h3>

<table class="table">

<tr>

<td>

Campaign

</td>

<td>

Heart Surgery

</td>

</tr>

<tr>

<td>

Organization

</td>

<td>

Hope Hospital

</td>

</tr>

<tr>

<td>

Platform Fee

</td>

<td>

₹0

</td>

</tr>

<tr>

<td>

Donation

</td>

<td>

<strong id="displayAmount">

₹0

</strong>

</td>

</tr>

<tr class="table-success">

<td>

Total

</td>

<td>

<strong id="totalAmount">

₹0

</strong>

</td>

</tr>

</table>

<div class="form-check my-3">

<input
class="form-check-input"
type="checkbox"
required>

<label class="form-check-label">

I agree to the Terms &
Privacy Policy.

</label>

</div>

<div class="d-grid">

<!-- <button
type="submit"
form=""

class="btn btn-success btn-lg"> -->
<button
type="submit"
form="donationForm"
class="btn btn-success btn-lg">

<i class="fa-solid fa-heart"></i>

Proceed to Payment

</button>

</div>

<div class="text-center mt-4">

<img src="images/payment.png"
class="img-fluid"
width="220">

<p class="mt-3">

100% Secure Payments

</p>

</div>

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

Connecting donors with verified organizations through secure and transparent donations.

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

<!-- ================= JAVASCRIPT ================= -->

<script>

const buttons = document.querySelectorAll(".amount-btn");

const amount = document.getElementById("amount");

const display = document.getElementById("displayAmount");

const total = document.getElementById("totalAmount");

buttons.forEach(btn => {

btn.addEventListener("click", function(e){

e.preventDefault();

amount.value = this.dataset.value;

display.innerHTML = "₹" + this.dataset.value;

total.innerHTML = "₹" + this.dataset.value;

});

});

amount.addEventListener("keyup", function(){

display.innerHTML = "₹" + this.value;

total.innerHTML = "₹" + this.value;

});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="js/script.js"></script>

</body>

</html>