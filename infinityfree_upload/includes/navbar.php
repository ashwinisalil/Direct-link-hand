<!--
    NAVBAR - the top navigation menu, included on every page.

    The links change depending on who is logged in:
      - Nobody logged in      -> show Login / Register
      - $_SESSION['user_id']  -> a DONOR is logged in
      - $_SESSION['org_id']   -> an ORGANIZATION is logged in
      - $_SESSION['admin_id'] -> an ADMIN is logged in

    These session values are set in login.php (or register.php for
    a new donor) when someone successfully signs in, and cleared in
    logout.php.
-->
<header class="site-header">
    <nav class="navbar container">
        <a href="<?= BASE_URL ?>/index.php" class="brand">Direct Link Hands</a>
        <ul class="nav-links">
            <!-- These 5 links are always visible to everyone -->
            <li><a href="<?= BASE_URL ?>/index.php">Home</a></li>
            <li><a href="<?= BASE_URL ?>/about.php">About</a></li>
            <li><a href="<?= BASE_URL ?>/organizations.php">Organizations</a></li>
            <li><a href="<?= BASE_URL ?>/donate.php">Donate</a></li>
            <li><a href="<?= BASE_URL ?>/contact.php">Contact</a></li>

            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- A DONOR is logged in -->
                <li><a href="<?= BASE_URL ?>/history.php">My Donations</a></li>
                <li><a href="<?= BASE_URL ?>/logout.php">Logout (<?= e($_SESSION['full_name']) ?>)</a></li>

            <?php elseif (isset($_SESSION['org_id'])): ?>
                <!-- An ORGANIZATION is logged in -->
                <li><a href="<?= BASE_URL ?>/organization/dashboard.php">Org Dashboard</a></li>
                <li><a href="<?= BASE_URL ?>/logout.php">Logout</a></li>

            <?php elseif (isset($_SESSION['admin_id'])): ?>
                <!-- The ADMIN is logged in -->
                <li><a href="<?= BASE_URL ?>/admin/dashboard.php">Admin Dashboard</a></li>
                <li><a href="<?= BASE_URL ?>/logout.php">Logout</a></li>

            <?php else: ?>
                <!-- Nobody is logged in yet -->
                <li><a href="<?= BASE_URL ?>/login.php">Login</a></li>
                <li><a href="<?= BASE_URL ?>/register.php" class="nav-cta">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
