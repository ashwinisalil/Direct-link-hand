<?php
include("php/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <title>About Us | DonateDirect</title> -->
    <title>About Us | Direct Link Hands</title>

    <link rel="stylesheet" href="css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

    <!-- ================= NAVBAR ================= -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top">

        <div class="container">

            <!-- <a class="navbar-brand fw-bold" href="index.html">
                
                <i class="fa-solid fa-hand-holding-heart"></i> DonateDirect
            </a> -->
            <a class="navbar-brand fw-bold" href="index.php">
    <i class="fa-solid fa-hand-holding-heart"></i> Direct Link Hands
</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="menu">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <!-- <a href="index.html" class="nav-link">Home</a> -->
                        <a href="index.php" class="nav-link">Home</a>
                    </li>

                    <li class="nav-item">
                        <!-- <a href="about.html" class="nav-link active">About</a> -->
                    <a href="about.php" class="nav-link active">About</a>
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

    <!-- ================= PAGE HEADER ================= -->

    <section class="hero">

        <div class="container text-center">

            <!-- <h1>About DonateDirect</h1> -->
            <h1>About Direct Link Hands</h1>

            <p>
                Building Trust Between Donors and Verified Organizations
            </p>

        </div>

    </section>

    <!-- ================= ABOUT ================= -->

    <section class="container py-5">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <img src="images/about.jpg" class="img-fluid rounded shadow" alt="About Direct Link Hands">

            </div>

            <div class="col-lg-6">

                <h2>Who We Are</h2>

                <p>

                    <!-- DonateDirect is a secure online donation platform that connects generous donors with verified
                    hospitals, schools, orphan homes, NGOs, and charitable organizations. -->
                       Direct Link Hands is a secure online donation platform that 
                          connects generous donors with verified hospitals, schools, orphan homes, 
                          NGOs, and charitable organizations.
                </p>

                <p>

                    Every organization is carefully verified before it is allowed to receive donations, ensuring
                    transparency and trust throughout the donation process.

                </p>

            </div>

        </div>

    </section>

    <!-- ================= MISSION ================= -->

    <section class="bg-light py-5">

        <div class="container">

            <div class="row text-center">

                <div class="col-md-4">

                    <i class="fa-solid fa-bullseye fa-3x text-success mb-3"></i>

                    <h3>Our Mission</h3>

                    <p>

                        To make charitable giving transparent, secure, and accessible for everyone.

                    </p>

                </div>

                <div class="col-md-4">

                    <i class="fa-solid fa-eye fa-3x text-success mb-3"></i>

                    <h3>Our Vision</h3>

                    <p>

                        A world where every donation reaches the right people with complete transparency.

                    </p>

                </div>

                <div class="col-md-4">

                    <i class="fa-solid fa-heart fa-3x text-success mb-3"></i>

                    <h3>Our Values</h3>

                    <p>

                        Trust, honesty, accountability, compassion, and community service.

                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- ================= WHY CHOOSE US ================= -->

    <section class="container py-5">

        <!-- <h2 class="text-center mb-5">Why Choose DonateDirect?</h2> -->
        <h2 class="text-center mb-5">Why Choose Direct Link Hands?</h2>

        <div class="row">

            <div class="col-md-6">

                <ul class="list-group shadow">

                    <li class="list-group-item">
                        ✅ Verified Organizations Only
                    </li>

                    <li class="list-group-item">
                        ✅ Secure Online Payments
                    </li>

                    <li class="list-group-item">
                        ✅ Transparent Donation Tracking
                    </li>

                    <li class="list-group-item">
                        ✅ Direct Donation to Organization
                    </li>

                    <li class="list-group-item">
                        ✅ Instant Donation Receipt
                    </li>

                </ul>

            </div>

            <div class="col-md-6">

                <img src="images/mission.jpg" class="img-fluid rounded shadow" alt="Mission">

            </div>

        </div>

    </section>

    <!-- ================= HOW IT WORKS ================= -->

    <section class="bg-success text-white py-5">

        <div class="container">

            <h2 class="text-center text-white mb-5">How It Works</h2>

            <div class="row text-center">

                <div class="col-md-3">

                    <i class="fa-solid fa-user-plus fa-3x mb-3"></i>

                    <h5>Register</h5>

                    <p>Create your donor account.</p>

                </div>

                <div class="col-md-3">

                    <i class="fa-solid fa-building fa-3x mb-3"></i>

                    <h5>Select Organization</h5>

                    <p>Browse verified organizations.</p>

                </div>

                <div class="col-md-3">

                    <i class="fa-solid fa-credit-card fa-3x mb-3"></i>

                    <h5>Donate</h5>

                    <p>Donate securely using the payment gateway.</p>

                </div>

                <div class="col-md-3">

                    <i class="fa-solid fa-hand-holding-heart fa-3x mb-3"></i>

                    <h5>Make Impact</h5>

                    <p>Your donation helps those who need it most.</p>

                </div>

            </div>

        </div>

    </section>

    <!-- ================= TEAM ================= -->

    <section class="container py-5">

        <h2 class="text-center mb-5">Our Team</h2>

        <div class="row">

            <div class="col-md-4">

                <div class="card shadow">

                    <img src="images/team1.jpg" class="card-img-top" alt="Team Member">

                    <div class="card-body text-center">

                        <h5>Project Administrator</h5>

                        <p>Verification & Platform Management</p>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card shadow">

                    <img src="images/team2.jpg" class="card-img-top" alt="Team Member">

                    <div class="card-body text-center">

                        <h5>Support Team</h5>

                        <p>Helping donors and organizations.</p>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card shadow">

                    <img src="images/team3.jpg" class="card-img-top" alt="Team Member">

                    <div class="card-body text-center">

                        <h5>Technical Team</h5>

                        <p>Maintaining website security and performance.</p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- ================= FOOTER ================= -->

    <footer class="bg-success text-white text-center p-4">
<!-- 
        <h4>DonateDirect</h4>

        <p>Helping People Through Trusted Donations.</p>

        <p>© 2026 DonateDirect | All Rights Reserved</p> -->

        <h4>Direct Link Hands</h4>

           <p>Changing Lives Through Trusted Donations.</p>

             <p>© 2026 Direct Link Hands | All Rights Reserved</p>

    </footer>

     
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>