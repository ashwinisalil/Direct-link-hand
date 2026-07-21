<?php
/**
 * ===============================================================
 * ORGANIZATION: UPLOAD DOCUMENTS (organization/upload_documents.php)
 * ===============================================================
 * Lets a logged-in organization upload its verification files
 * (registration certificate, PAN card, government certificate).
 * These are stored on disk in /uploads, and their FILE NAMES are
 * saved in the organization_documents table (not the file
 * contents themselves — that's how file uploads normally work).
 * ===============================================================
 */

require_once '../includes/db.php';
$pageTitle = 'Upload Documents';

if (!isset($_SESSION['org_id'])) {
    redirect('../login.php');
}

$org_id = $_SESSION['org_id'];
$error = '';
$success = '';

$uploadDir = '../uploads/';
$allowedExt = ['pdf', 'jpg', 'jpeg', 'png'];
$maxSize = 5 * 1024 * 1024; // 5 MB, in bytes

/**
 * handleUpload()
 * Validates and saves ONE uploaded file, returning its new filename
 * on success, or null if nothing was uploaded / something went wrong
 * (in which case $error is filled in by reference).
 *
 * $fieldName must match the <input type="file" name="..."> in the form.
 */
function handleUpload($fieldName, $orgId, $uploadDir, $allowedExt, $maxSize, &$error) {
    // If the admin/org didn't pick a new file for this slot, that's fine —
    // we just keep whatever was uploaded before.
    if (empty($_FILES[$fieldName]['name'])) {
        return null;
    }

    $file = $_FILES[$fieldName];

    // UPLOAD_ERR_OK means PHP received the file with no problems
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $error = 'Error uploading ' . $fieldName . '.';
        return null;
    }

    if ($file['size'] > $maxSize) {
        $error = ucfirst(str_replace('_', ' ', $fieldName)) . ' must be under 5MB.';
        return null;
    }

    // Only allow the file types we expect — blocks someone uploading
    // a .php or .exe file disguised with a misleading name.
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt)) {
        $error = 'Only PDF, JPG, and PNG files are allowed for ' . $fieldName . '.';
        return null;
    }

    // Build a unique filename so two organizations' files never collide,
    // e.g. "org7_pan_card_1721474512.pdf"
    $filename = 'org' . $orgId . '_' . $fieldName . '_' . time() . '.' . $ext;
    $destination = $uploadDir . $filename;

    // move_uploaded_file() moves the file from PHP's temporary upload
    // location into our permanent /uploads folder.
    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        $error = 'Failed to save ' . $fieldName . '.';
        return null;
    }

    return $filename;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Try to handle all 3 possible files (any of them can be skipped)
    $regCert  = handleUpload('registration_certificate', $org_id, $uploadDir, $allowedExt, $maxSize, $error);
    $panCard  = handleUpload('pan_card', $org_id, $uploadDir, $allowedExt, $maxSize, $error);
    $govtCert = handleUpload('government_certificate', $org_id, $uploadDir, $allowedExt, $maxSize, $error);

    if ($error === '') {
        // Does this organization already have a documents row?
        $stmt = mysqli_prepare($conn, "SELECT * FROM organization_documents WHERE org_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $org_id);
        mysqli_stmt_execute($stmt);
        $existing = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

        if ($existing) {
            // UPDATE existing row. For any file that wasn't re-uploaded
            // this time (handleUpload returned null), keep the old filename
            // using the "??" (null coalescing) operator.
            $reg  = $regCert  ?? $existing['registration_certificate'];
            $pan  = $panCard  ?? $existing['pan_card'];
            $govt = $govtCert ?? $existing['government_certificate'];

            $stmt = mysqli_prepare($conn, "UPDATE organization_documents SET
                registration_certificate = ?, pan_card = ?, government_certificate = ?, uploaded_at = NOW()
                WHERE org_id = ?");
            mysqli_stmt_bind_param($stmt, "sssi", $reg, $pan, $govt, $org_id);
            mysqli_stmt_execute($stmt);
        } else {
            // First time uploading — INSERT a new row
            $stmt = mysqli_prepare($conn, "INSERT INTO organization_documents
                (org_id, registration_certificate, pan_card, government_certificate)
                VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "isss", $org_id, $regCert, $panCard, $govtCert);
            mysqli_stmt_execute($stmt);
        }
        $success = 'Documents uploaded successfully. They will be reviewed by our team.';
    }
}

// Load whatever is currently on file, to show "Current: filename.pdf" hints
$stmt = mysqli_prepare($conn, "SELECT * FROM organization_documents WHERE org_id = ?");
mysqli_stmt_bind_param($stmt, "i", $org_id);
mysqli_stmt_execute($stmt);
$docs = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

include '../includes/header.php';
include '../includes/navbar.php';
?>

<main class="container page">
    <h1>Upload Verification Documents</h1>

    <?php if ($success): ?>
        <p class="alert alert-success"><?= e($success) ?></p>
    <?php endif; ?>
    <?php if ($error): ?>
        <p class="alert alert-error"><?= e($error) ?></p>
    <?php endif; ?>

    <!-- enctype="multipart/form-data" is REQUIRED on any form that
         uploads files — without it, $_FILES would stay empty. -->
    <form method="POST" enctype="multipart/form-data" class="form" novalidate>
        <label for="registration_certificate">Registration Certificate (PDF/JPG/PNG)</label>
        <input type="file" id="registration_certificate" name="registration_certificate" accept=".pdf,.jpg,.jpeg,.png">
        <?php if (!empty($docs['registration_certificate'])): ?>
            <p class="file-status">Current: <?= e($docs['registration_certificate']) ?></p>
        <?php endif; ?>

        <label for="pan_card">PAN Card (PDF/JPG/PNG)</label>
        <input type="file" id="pan_card" name="pan_card" accept=".pdf,.jpg,.jpeg,.png">
        <?php if (!empty($docs['pan_card'])): ?>
            <p class="file-status">Current: <?= e($docs['pan_card']) ?></p>
        <?php endif; ?>

        <label for="government_certificate">Government Certificate (PDF/JPG/PNG)</label>
        <input type="file" id="government_certificate" name="government_certificate" accept=".pdf,.jpg,.jpeg,.png">
        <?php if (!empty($docs['government_certificate'])): ?>
            <p class="file-status">Current: <?= e($docs['government_certificate']) ?></p>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
