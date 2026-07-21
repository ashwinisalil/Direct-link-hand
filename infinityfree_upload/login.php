<?php
/**
 * ===============================================================
 * LOGIN PAGE (login.php)
 * ===============================================================
 * ONE login form handles THREE different account types, chosen
 * with the "Login As" dropdown: Donor, Organization, or Admin.
 * Depending on the choice, we check a different database table
 * and set a different $_SESSION variable:
 *
 *   Donor        -> checks "users" table        -> $_SESSION['user_id']
 *   Organization -> checks "organizations" table -> $_SESSION['org_id']
 *   Admin        -> checks "admin" table         -> $_SESSION['admin_id']
 *
 * includes/navbar.php looks at these same session variables to
 * decide what menu links to show.
 * ===============================================================
 */

require_once 'includes/db.php';
$pageTitle = 'Login';

// Already logged in as something? Skip the login page.
if (isset($_SESSION['user_id']) || isset($_SESSION['org_id']) || isset($_SESSION['admin_id'])) {
    redirect('index.php');
}

$error = '';
// Remembers which dropdown option was chosen, so it stays selected
// if the login fails and the page reloads.
$loginType = $_POST['login_type'] ?? 'user';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = 'Please enter both email and password.';
    } else {

        if ($loginType === 'admin') {
            // ---- ADMIN LOGIN ----
            // Admins can type either their username or their email
            // in the same box, so we check both columns with OR.
            $stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE username = ? OR email = ?");
            mysqli_stmt_bind_param($stmt, "ss", $email, $email);
            mysqli_stmt_execute($stmt);
            $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

            // password_verify() checks the typed password against the
            // hashed one stored in the database (see password_hash()
            // used back in register.php).
            if ($row && password_verify($password, $row['password'])) {
                $_SESSION['admin_id'] = $row['admin_id'];
                redirect('admin/dashboard.php');
            } else {
                $error = 'Invalid admin credentials.';
            }

        } elseif ($loginType === 'organization') {
            // ---- ORGANIZATION LOGIN ----
            $stmt = mysqli_prepare($conn, "SELECT * FROM organizations WHERE email = ?");
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

            if ($row && password_verify($password, $row['password'])) {
                // Even with the right password, an organization can't log
                // in until an admin has approved it (see admin/organizations.php).
                if ($row['status'] !== 'Approved') {
                    $error = 'Your organization account is not approved yet.';
                } else {
                    $_SESSION['org_id']   = $row['org_id'];
                    $_SESSION['org_name'] = $row['organization_name'];
                    redirect('organization/dashboard.php');
                }
            } else {
                $error = 'Invalid organization credentials.';
            }

        } else {
            // ---- DONOR LOGIN (default) ----
            $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

            if ($row && password_verify($password, $row['password'])) {
                $_SESSION['user_id']   = $row['user_id'];
                $_SESSION['full_name'] = $row['full_name'];
                redirect('index.php');
            } else {
                $error = 'Invalid email or password.';
            }
        }
    }
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<main class="container page">
    <p class="eyebrow">Access</p>
    <h1>Login</h1>
    <p class="page-lede">Donor, organization, or admin &mdash; pick the right lane below.</p>

    <?php if ($error): ?>
        <p class="alert alert-error"><?= e($error) ?></p>
    <?php endif; ?>

    <div class="form-wrap">
        <div class="ticket-stub">
            <span>Login Ticket</span>
            <span class="ticket-stub-right">Access</span>
        </div>
        <form method="POST" class="form" novalidate>
            <label for="login_type">Login As</label>
            <select id="login_type" name="login_type">
                <option value="user" <?= $loginType === 'user' ? 'selected' : '' ?>>Donor</option>
                <option value="organization" <?= $loginType === 'organization' ? 'selected' : '' ?>>Organization</option>
                <option value="admin" <?= $loginType === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>

            <label for="email">Email / Username</label>
            <input type="text" id="email" name="email" required value="<?= e($_POST['email'] ?? '') ?>">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</main>

<?php include 'includes/footer.php'; ?>
