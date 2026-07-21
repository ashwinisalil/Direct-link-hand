<?php
/**
 * ===============================================================
 * ORGANIZATION PROFILE EDITOR (organization/profile.php)
 * ===============================================================
 * Lets a logged-in organization update its own details: name,
 * category, address, description, and bank details for receiving
 * donations. Does NOT let them change their email/password or
 * approval status from here.
 * ===============================================================
 */

require_once '../includes/db.php';
$pageTitle = 'Organization Profile';

if (!isset($_SESSION['org_id'])) {
    redirect('../login.php');
}

$org_id = $_SESSION['org_id'];
$error = '';
$success = '';

$categories = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name"), MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $organization_name = trim($_POST['organization_name'] ?? '');
    // "?: null" turns an empty dropdown selection into a real NULL value
    // instead of an empty string, which keeps the category_id column clean.
    $category_id        = $_POST['category_id'] ?: null;
    $phone               = trim($_POST['phone'] ?? '');
    $address             = trim($_POST['address'] ?? '');
    $city                = trim($_POST['city'] ?? '');
    $state               = trim($_POST['state'] ?? '');
    $pincode             = trim($_POST['pincode'] ?? '');
    $description         = trim($_POST['description'] ?? '');
    $bank_name           = trim($_POST['bank_name'] ?? '');
    $account_number      = trim($_POST['account_number'] ?? '');
    $ifsc_code           = trim($_POST['ifsc_code'] ?? '');
    $account_holder      = trim($_POST['account_holder'] ?? '');

    if ($organization_name === '') {
        $error = 'Organization name is required.';
    } else {
        // Update every editable column in one query. Notice we do NOT
        // touch "email", "password", or "status" here — those are
        // intentionally left out so this form can't be used to change them.
        $stmt = mysqli_prepare($conn, "UPDATE organizations SET
            organization_name = ?, category_id = ?, phone = ?,
            address = ?, city = ?, state = ?, pincode = ?,
            description = ?, bank_name = ?, account_number = ?,
            ifsc_code = ?, account_holder = ?
            WHERE org_id = ?");
        mysqli_stmt_bind_param($stmt, "sisssssssssi",
            $organization_name, $category_id, $phone, $address, $city, $state, $pincode,
            $description, $bank_name, $account_number, $ifsc_code, $account_holder, $org_id);
        mysqli_stmt_execute($stmt);
        $success = 'Profile updated successfully.';
    }
}

// Re-fetch the (now updated) organization details to display in the form
$stmt = mysqli_prepare($conn, "SELECT * FROM organizations WHERE org_id = ?");
mysqli_stmt_bind_param($stmt, "i", $org_id);
mysqli_stmt_execute($stmt);
$org = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

include '../includes/header.php';
include '../includes/navbar.php';
?>

<main class="container page">
    <h1>Edit Organization Profile</h1>

    <?php if ($success): ?>
        <p class="alert alert-success"><?= e($success) ?></p>
    <?php endif; ?>
    <?php if ($error): ?>
        <p class="alert alert-error"><?= e($error) ?></p>
    <?php endif; ?>

    <form method="POST" class="form" novalidate>
        <label for="organization_name">Organization Name *</label>
        <input type="text" id="organization_name" name="organization_name" required
               value="<?= e($org['organization_name']) ?>">

        <label for="category_id">Category</label>
        <select id="category_id" name="category_id">
            <option value="">-- Select --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= e($cat['category_id']) ?>" <?= ($org['category_id'] == $cat['category_id']) ? 'selected' : '' ?>>
                    <?= e($cat['category_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" value="<?= e($org['phone']) ?>">

        <label for="address">Address</label>
        <textarea id="address" name="address" rows="3"><?= e($org['address']) ?></textarea>

        <label for="city">City</label>
        <input type="text" id="city" name="city" value="<?= e($org['city']) ?>">

        <label for="state">State</label>
        <input type="text" id="state" name="state" value="<?= e($org['state']) ?>">

        <label for="pincode">Pincode</label>
        <input type="text" id="pincode" name="pincode" value="<?= e($org['pincode']) ?>">

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5"><?= e($org['description']) ?></textarea>

        <h2>Bank Details (for receiving donations)</h2>

        <label for="bank_name">Bank Name</label>
        <input type="text" id="bank_name" name="bank_name" value="<?= e($org['bank_name']) ?>">

        <label for="account_number">Account Number</label>
        <input type="text" id="account_number" name="account_number" value="<?= e($org['account_number']) ?>">

        <label for="ifsc_code">IFSC Code</label>
        <input type="text" id="ifsc_code" name="ifsc_code" value="<?= e($org['ifsc_code']) ?>">

        <label for="account_holder">Account Holder Name</label>
        <input type="text" id="account_holder" name="account_holder" value="<?= e($org['account_holder']) ?>">

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
