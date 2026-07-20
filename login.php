<?php
include("php/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Direct Link Hands</title>

    <link rel="stylesheet" href="style.css">

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

<!-- Login -->

<section class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card shadow-lg border-0">

                <div class="card-body p-5">

                    <h2 class="text-center mb-4">

                        Login

                    </h2>

                    <form action="php/login_process.php" method="POST">

                        <div class="mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Password

                            </label>

                            <input
                                type="password"
                                class="form-control"
                                name="password"
                                required>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Login As

                            </label>

                            <select
                                class="form-select"
                                name="role"
                                required>

                                <option value="donor">Donor</option>

                                <option value="organization">Organization</option>

                                <option value="admin">Admin</option>

                            </select>

                        </div>

                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn btn-success btn-lg">

                                Login

                            </button>

                        </div>

                    </form>

                    <hr>

                    <p class="text-center">

                        Don't have an account?

                        <a href="register.php">

                            Register Here

                        </a>

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- Footer -->

<footer class="bg-dark text-white text-center p-3">

    © 2026 Direct Link Hands | All Rights Reserved

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>