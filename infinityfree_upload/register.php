<?php
/**
 * ===============================================================
 * REGISTRATION PAGE (register.php)
 * ===============================================================
 * This ONE page handles TWO different registration forms:
 *   1. Donor registration  -> saves into the "users" table,
 *      logs the person in immediately.
 *   2. Organization registration -> saves into the "organizations"
 *      table with status = 'Pending'. They CANNOT log in yet -
 *      an admin must approve them first (see admin/organizations.php).
 *
 * Which form is active is controlled by the hidden input
 * <input type="hidden" name="reg_type" ...> further down, which
 * JavaScript (js/script.js) updates when the user clicks the
 * "Donor" / "Organization" tab at the top of the page.
 * ===============================================================
 */

require_once 'includes/db.php';
$pageTitle = 'Register';

// If someone is already logged in as a donor or organization,
// there's no reason for them to see the register page again.
if (isset($_SESSION['user_id']) || isset($_SESSION['org_id'])) {
    redirect('index.php');
}

$error = '';
$success = '';

// Work out which tab should be active. On first page load this
// comes from the URL (?type=organization), and after a failed
// submission it comes from the form itself, so the user doesn't
// lose their place.
$reg_type = $_POST['reg_type'] ?? ($_GET['type'] ?? 'donor');
if (!in_array($reg_type, ['donor', 'organization'])) {
    $reg_type = 'donor'; // fallback if someone tampers with the URL
}

// Organization form needs a list of categories for its dropdown
// (Education, Healthcare, Orphanage, etc.)
$categories = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name"), MYSQLI_ASSOC);

// Only process form data if the form was actually submitted.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($reg_type === 'organization') {
        // =========================================================
        // ORGANIZATION REGISTRATION
        // =========================================================
        // Every field name below starts with "org_" — this matches
        // the "org_..." input names in the HTML form further down,
        // and keeps them from clashing with the donor fields (which
        // start with "donor_") since both fieldsets exist in the
        // same <form> at the same time.
        $organization_name = trim($_POST['org_name'] ?? '');
        $category_id        = $_POST['org_category_id'] ?: null; // empty string becomes NULL
        $email               = trim($_POST['org_email'] ?? '');
        $phone               = trim($_POST['org_phone'] ?? '');
        $password            = $_POST['org_password'] ?? '';
        $confirm             = $_POST['org_confirm_password'] ?? '';
        $address             = trim($_POST['org_address'] ?? '');
        $city                = trim($_POST['org_city'] ?? '');
        $state               = trim($_POST['org_state'] ?? '');
        $pincode             = trim($_POST['org_pincode'] ?? '');
        $description         = trim($_POST['org_description'] ?? '');
        $bank_name           = trim($_POST['org_bank_name'] ?? '');
        $account_number      = trim($_POST['org_account_number'] ?? '');
        $ifsc_code           = trim($_POST['org_ifsc_code'] ?? '');
        $account_holder      = trim($_POST['org_account_holder'] ?? '');

        // ---- Validation checks, in order ----
        if ($organization_name === '' || $email === '' || $password === '') {
            $error = 'Please fill in all required organization fields.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        } elseif (strlen($password) < 6) {
            $error = 'Password must be at least 6 characters.';
        } elseif ($password !== $confirm) {
            $error = 'Passwords do not match.';
        } else {
            // Check the email isn't already used by another organization
            $stmt = mysqli_prepare($conn, "SELECT org_id FROM organizations WHERE email = ?");
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

            if (mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))) {
                $error = 'An organization with this email already exists.';
            } else {
                // NEVER store plain-text passwords. password_hash() turns
                // "admin123" into something like "$2y$10$abc123..." which
                // cannot be reversed back into the original password.
                $hashed = password_hash($password, PASSWORD_DEFAULT);

                // New organizations always start as "Pending" — they only
                // become visible to donors after an admin approves them.
                $status = 'Pending';

                // Prepared statement with 15 "?" placeholders, one per column.
                $stmt = mysqli_prepare($conn, "INSERT INTO organizations
                    (organization_name, category_id, email, password, phone, address, city, state,
                     pincode, description, bank_name, account_number, ifsc_code, account_holder, status)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                // Type string "sisssssssssssss" tells mysqli the data type of
                // each value in order: s=string, i=integer.
                // (organization_name=s, category_id=i, email=s, password=s, ...)
                mysqli_stmt_bind_param(
                    $stmt, "sisssssssssssss",
                    $organization_name, $category_id, $email, $hashed, $phone, $address, $city, $state,
                    $pincode, $description, $bank_name, $account_number, $ifsc_code, $account_holder, $status
                );
                mysqli_stmt_execute($stmt);

                // Note: we do NOT log the organization in here, because
                // they still need to be approved by an admin first.
                $success = 'Your organization has been submitted for review. '
                         . 'You will be able to log in once an admin approves your account.';
            }
        }

    } else {
        // =========================================================
        // DONOR REGISTRATION  (default / normal user)
        // =========================================================
        $full_name = trim($_POST['donor_full_name'] ?? '');
        $email     = trim($_POST['donor_email'] ?? '');
        $phone     = trim($_POST['donor_phone'] ?? '');
        $password  = $_POST['donor_password'] ?? '';
        $confirm   = $_POST['donor_confirm_password'] ?? '';
        $gender    = $_POST['donor_gender'] ?? '';
        $address   = trim($_POST['donor_address'] ?? '');
        $city      = trim($_POST['donor_city'] ?? '');
        $state     = trim($_POST['donor_state'] ?? '');
        $pincode   = trim($_POST['donor_pincode'] ?? '');

        // ---- Validation checks, in order ----
        if ($full_name === '' || $email === '' || $password === '') {
            $error = 'Please fill in all required fields.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        } elseif (strlen($password) < 6) {
            $error = 'Password must be at least 6 characters.';
        } elseif ($password !== $confirm) {
            $error = 'Passwords do not match.';
        } else {
            // Check the email isn't already registered
            $stmt = mysqli_prepare($conn, "SELECT user_id FROM users WHERE email = ?");
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_fetch_assoc($result)) {
                $error = 'An account with this email already exists.';
            } else {
                $hashed = password_hash($password, PASSWORD_DEFAULT);

                $stmt = mysqli_prepare($conn, "INSERT INTO users
                    (full_name, email, phone, password, gender, address, city, state, pincode)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "sssssssss",
                    $full_name, $email, $phone, $hashed, $gender, $address, $city, $state, $pincode);
                mysqli_stmt_execute($stmt);

                // mysqli_insert_id() returns the auto-increment ID MySQL just
                // generated for this new row — i.e. the new user's user_id.
                $_SESSION['user_id']   = mysqli_insert_id($conn);
                $_SESSION['full_name'] = $full_name;

                // A donor can start using the site immediately after registering.
                redirect('index.php');
            }
        }
    }
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<main class="container page">
    <p class="eyebrow">Join</p>
    <h1>Create an Account</h1>
    <p class="page-lede">Register as a donor to start giving, or register your organization to start receiving direct donations.</p>

    <?php if ($success): ?>
        <p class="alert alert-success"><?= e($success) ?></p>
    <?php endif; ?>
    <?php if ($error): ?>
        <p class="alert alert-error"><?= e($error) ?></p>
    <?php endif; ?>

    <!-- Tab-style toggle: clicking either radio button calls
         toggleRegType() in js/script.js, which shows/hides the
         matching fieldset below and updates the hidden reg_type input. -->
    <div class="reg-toggle">
        <label class="reg-toggle-option">
            <input type="radio" name="reg_type_display" value="donor"
                   <?= $reg_type === 'donor' ? 'checked' : '' ?>
                   onchange="toggleRegType('donor')">
            <span>Donor</span>
        </label>
        <label class="reg-toggle-option">
            <input type="radio" name="reg_type_display" value="organization"
                   <?= $reg_type === 'organization' ? 'checked' : '' ?>
                   onchange="toggleRegType('organization')">
            <span>Organization</span>
        </label>
    </div>

    <div class="form-wrap">
        <div class="ticket-stub">
            <span>Registration Ticket</span>
            <span class="ticket-stub-right" id="reg-ticket-type"><?= $reg_type === 'organization' ? 'Organization' : 'Donor' ?></span>
        </div>

        <!-- IMPORTANT: this is ONE <form> containing BOTH fieldsets.
             Only the visible one's fields are meaningful — PHP decides
             which set of $_POST values to use based on reg_type above. -->
        <form method="POST" class="form" novalidate>
            <!-- This hidden field tells PHP which form was actually filled in.
                 JavaScript keeps it in sync with the tab that's showing. -->
            <input type="hidden" name="reg_type" id="reg_type" value="<?= e($reg_type) ?>">

            <!-- ============ DONOR fields ============ -->
            <div id="donor-fields" style="<?= $reg_type === 'organization' ? 'display:none;' : '' ?>">

                <p class="form-section-title">Account</p>
                <div class="form-grid cols-2">
                    <div class="form-field">
                        <label for="donor_full_name">Full Name *</label>
                        <input type="text" id="donor_full_name" name="donor_full_name" value="<?= e($_POST['donor_full_name'] ?? '') ?>">
                    </div>
                    <div class="form-field">
                        <label for="donor_email">Email *</label>
                        <input type="email" id="donor_email" name="donor_email" value="<?= e($_POST['donor_email'] ?? '') ?>">
                    </div>
                    <div class="form-field">
                        <label for="donor_phone">Phone</label>
                        <input type="text" id="donor_phone" name="donor_phone" value="<?= e($_POST['donor_phone'] ?? '') ?>">
                    </div>
                    <div class="form-field">
                        <label for="donor_gender">Gender</label>
                        <select id="donor_gender" name="donor_gender">
                            <option value="">-- Select --</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label for="donor_password">Password *</label>
                        <input type="password" id="donor_password" name="donor_password" minlength="6">
                    </div>
                    <div class="form-field">
                        <label for="donor_confirm_password">Confirm Password *</label>
                        <input type="password" id="donor_confirm_password" name="donor_confirm_password" minlength="6">
                    </div>
                </div>

                <p class="form-section-title">Address (optional)</p>
                <div class="form-grid">
                    <div class="form-field">
                        <label for="donor_address">Street Address</label>
                        <textarea id="donor_address" name="donor_address" rows="2"><?= e($_POST['donor_address'] ?? '') ?></textarea>
                    </div>
                </div>
                <div class="form-grid cols-3">
                    <div class="form-field">
                        <label for="donor_city">City</label>
                        <input type="text" id="donor_city" name="donor_city" value="<?= e($_POST['donor_city'] ?? '') ?>">
                    </div>
                    <div class="form-field">
                        <label for="donor_state">State</label>
                        <input type="text" id="donor_state" name="donor_state" value="<?= e($_POST['donor_state'] ?? '') ?>">
                    </div>
                    <div class="form-field">
                        <label for="donor_pincode">Pincode</label>
                        <input type="text" id="donor_pincode" name="donor_pincode" value="<?= e($_POST['donor_pincode'] ?? '') ?>">
                    </div>
                </div>
            </div>

            <!-- ============ ORGANIZATION fields ============ -->
            <div id="org-fields" style="<?= $reg_type === 'organization' ? '' : 'display:none;' ?>">

                <p class="form-section-title">Organization Details</p>
                <div class="form-grid cols-2">
                    <div class="form-field">
                        <label for="org_name">Organization Name *</label>
                        <input type="text" id="org_name" name="org_name" value="<?= e($_POST['org_name'] ?? '') ?>">
                    </div>
                    <div class="form-field">
                        <label for="org_category_id">Category</label>
                        <select id="org_category_id" name="org_category_id">
                            <option value="">-- Select --</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= e($cat['category_id']) ?>"
                                    <?= (($_POST['org_category_id'] ?? '') == $cat['category_id']) ? 'selected' : '' ?>>
                                    <?= e($cat['category_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-field">
                        <label for="org_email">Email *</label>
                        <input type="email" id="org_email" name="org_email" value="<?= e($_POST['org_email'] ?? '') ?>">
                    </div>
                    <div class="form-field">
                        <label for="org_phone">Phone</label>
                        <input type="text" id="org_phone" name="org_phone" value="<?= e($_POST['org_phone'] ?? '') ?>">
                    </div>
                    <div class="form-field">
                        <label for="org_password">Password *</label>
                        <input type="password" id="org_password" name="org_password" minlength="6">
                    </div>
                    <div class="form-field">
                        <label for="org_confirm_password">Confirm Password *</label>
                        <input type="password" id="org_confirm_password" name="org_confirm_password" minlength="6">
                    </div>
                </div>

                <p class="form-section-title">Address</p>
                <div class="form-grid">
                    <div class="form-field">
                        <label for="org_address">Street Address</label>
                        <textarea id="org_address" name="org_address" rows="2"><?= e($_POST['org_address'] ?? '') ?></textarea>
                    </div>
                </div>
                <div class="form-grid cols-3">
                    <div class="form-field">
                        <label for="org_city">City</label>
                        <input type="text" id="org_city" name="org_city" value="<?= e($_POST['org_city'] ?? '') ?>">
                    </div>
                    <div class="form-field">
                        <label for="org_state">State</label>
                        <input type="text" id="org_state" name="org_state" value="<?= e($_POST['org_state'] ?? '') ?>">
                    </div>
                    <div class="form-field">
                        <label for="org_pincode">Pincode</label>
                        <input type="text" id="org_pincode" name="org_pincode" value="<?= e($_POST['org_pincode'] ?? '') ?>">
                    </div>
                </div>

                <p class="form-section-title">About the Organization</p>
                <div class="form-grid">
                    <div class="form-field">
                        <label for="org_description">Description</label>
                        <textarea id="org_description" name="org_description" rows="4"><?= e($_POST['org_description'] ?? '') ?></textarea>
                    </div>
                </div>

                <p class="form-section-title">Bank Details</p>
                <div class="form-grid cols-2">
                    <div class="form-field">
                        <label for="org_bank_name">Bank Name</label>
                        <input type="text" id="org_bank_name" name="org_bank_name" value="<?= e($_POST['org_bank_name'] ?? '') ?>">
                    </div>
                    <div class="form-field">
                        <label for="org_account_holder">Account Holder Name</label>
                        <input type="text" id="org_account_holder" name="org_account_holder" value="<?= e($_POST['org_account_holder'] ?? '') ?>">
                    </div>
                    <div class="form-field">
                        <label for="org_account_number">Account Number</label>
                        <input type="text" id="org_account_number" name="org_account_number" value="<?= e($_POST['org_account_number'] ?? '') ?>">
                    </div>
                    <div class="form-field">
                        <label for="org_ifsc_code">IFSC Code</label>
                        <input type="text" id="org_ifsc_code" name="org_ifsc_code" value="<?= e($_POST['org_ifsc_code'] ?? '') ?>">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" id="reg-submit-btn">Register as Donor</button>
        </form>
    </div>

    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</main>

<?php include 'includes/footer.php'; ?>
