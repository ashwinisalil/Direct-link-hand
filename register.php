<?php
include("php/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--<title>Register | KindBridge</title>-->
<title>Register | Direct Link Hands</title>
    <link rel="stylesheet" href="css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-success">

<div class="container">

<a class="navbar-brand fw-bold" href="index.php">

<i class="fa-solid fa-hand-holding-heart"></i>

Direct Link Hands

</a>

</div>

</nav>

<!-- Register -->

<section class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow-lg border-0">

<div class="card-body p-5">

<h2 class="text-center mb-4">

Create Your Account

</h2>

<!-- Select Role -->

<div class="mb-4">

<label class="form-label">

Register As

</label>

<select class="form-select" id="role" name="role">

<option value="donor">

Donor

</option>

<option value="organization">

Organization

</option>

</select>

</div>

<form action="php/register_process.php" method="POST" enctype="multipart/form-data"></form>

<input type="hidden" name="user_role" id="user_role" value="donor">

<!-- ================= DONOR ================= -->

<div id="donorForm">

<div class="row">

<div class="col-md-6 mb-3">

<label>Full Name</label>

<input
type="text"
name="fullname"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Mobile Number</label>

<input
type="text"
name="mobile"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Date of Birth</label>

<input
type="date"
name="dob"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Gender</label>

<select class="form-select" name="gender">

<option>Male</option>

<option>Female</option>

<option>Other</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="col-12 mb-3">

<label>Address</label>

<textarea
class="form-control"
name="address"
rows="3"
required></textarea>

</div>

</div>

</div>

<!-- ================= ORGANIZATION ================= -->

<div id="organizationForm" style="display:none;">

<div class="row">

<div class="col-md-6 mb-3">

<label>Organization Name</label>

<input
type="text"
name="org_name"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Category</label>

<select class="form-select" name="category">

<option>Hospital</option>

<option>Education</option>

<option>Medicine</option>

<option>Orphan Home</option>

<option>Old Age Home</option>

<option>Animal Welfare</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Organization Email</label>

<input
type="email"
name="org_email"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Phone</label>

<input
type="text"
name="phone"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Registration Number</label>

<input
type="text"
name="registration_no"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>PAN Number</label>

<input
type="text"
name="pan"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Bank Name</label>

<input
type="text"
name="bank_name"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>IFSC Code</label>

<input
type="text"
name="ifsc"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Account Number</label>

<input
type="text"
name="account_no"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Upload Registration Certificate</label>

<input
type="file"
name="certificate"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Upload PAN Card</label>

<input
type="file"
name="pan_file"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Upload Cancelled Cheque</label>

<input
type="file"
name="cheque"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Upload Organization Logo</label>

<input
type="file"
name="logo"
class="form-control">

</div>

<div class="col-12 mb-3">

<div class="col-md-6 mb-3">

    <label>Organization Password</label>

    <input
        type="password"
        name="org_password"
        class="form-control"
        required>

</div>

<label>Organization Description</label>

<textarea
rows="4"
name="description"
class="form-control"></textarea>

</div>

</div>

</div>

<div class="d-grid mt-3">

<button class="btn btn-success btn-lg">

Register

</button>

</div>

</form>

<p class="text-center mt-4">

Already have an account?

<!--<a href="login.html"> -->

    <a href="login.php"></a>

Login

</a>

</p>

</div>

</div>

</div>

</div>

</section>

<footer class="bg-dark text-white text-center p-3">

© 2026 KindBridge | All Rights Reserved

</footer>

<script>

const role = document.getElementById("role");
const donor = document.getElementById("donorForm");
const organization = document.getElementById("organizationForm");
const hiddenRole = document.getElementById("user_role");

role.addEventListener("change", function () {

    if (role.value === "donor") {

        donor.style.display = "block";
        organization.style.display = "none";
        hiddenRole.value = "donor";

    } else {

        donor.style.display = "none";
        organization.style.display = "block";
        hiddenRole.value = "organization";

    }

});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>