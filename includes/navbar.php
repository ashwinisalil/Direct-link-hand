<header class="site-header">
    <nav class="navbar container">
        <a href="/Direct-link-hand/index.php" class="brand">Direct Link Hands</a>
        <ul class="nav-links">
            <li><a href="/Direct-link-hand/index.php">Home</a></li>
            <li><a href="/Direct-link-hand/about.php">About</a></li>
            <li><a href="/Direct-link-hand/organizations.php">Organizations</a></li>
            <li><a href="/Direct-link-hand/donate.php">Donate</a></li>
            <li><a href="/Direct-link-hand/contact.php">Contact</a></li>

            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="/Direct-link-hand/history.php">My Donations</a></li>
                <li><a href="/Direct-link-hand/logout.php">Logout (<?= e($_SESSION['full_name']) ?>)</a></li>

            <?php elseif (isset($_SESSION['org_id'])): ?>
                <li><a href="/Direct-link-hand/organization/dashboard.php">Org Dashboard</a></li>
                <li><a href="/Direct-link-hand/logout.php">Logout</a></li>

            <?php elseif (isset($_SESSION['admin_id'])): ?>
                <li><a href="/Direct-link-hand/admin/dashboard.php">Admin Dashboard</a></li>
                <li><a href="/Direct-link-hand/logout.php">Logout</a></li>

            <?php else: ?>
                <li><a href="/Direct-link-hand/login.php">Login</a></li>
                <li><a href="/Direct-link-hand/register.php" class="nav-cta">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
