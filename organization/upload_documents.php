<?php
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
$maxSize = 5 * 1024 * 1024; // 5 MB

function handleUpload($fieldName, $orgId, $uploadDir, $allowedExt, $maxSize, &$error) {
    if (empty($_FILES[$fieldName]['name'])) {
        return null; // no file selected, keep existing
    }

    $file = $_FILES[$fieldName];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $error = 'Error uploading ' . $fieldName . '.';
        return null;
    }

    if ($file['size'] > $maxSize) {
        $error = ucfirst(str_replace('_', ' ', $fieldName)) . ' must be under 5MB.';
        return null;
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt)) {
        $error = 'Only PDF, JPG, and PNG files are allowed for ' . $fieldName . '.';
        return null;
    }

    $filename = 'org' . $orgId . '_' . $fieldName . '_' . time() . '.' . $ext;
    $destination = $uploadDir . $filename;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        $error = 'Failed to save ' . $fieldName . '.';
        return null;
    }

    return $filename;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $regCert  = handleUpload('registration_certificate', $org_id, $uploadDir, $allowedExt, $maxSize, $error);
    $panCard  = handleUpload('pan_card', $org_id, $uploadDir, $allowedExt, $maxSize, $error);
    $govtCert = handleUpload('government_certificate', $org_id, $uploadDir, $allowedExt, $maxSize, $error);

    if ($error === '') {
        $stmt = mysqli_prepare($conn, "SELECT * FROM organization_documents WHERE org_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $org_id);
        mysqli_stmt_execute($stmt);
        $existing = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

        if ($existing) {
            $reg  = $regCert  ?? $existing['registration_certificate'];
            $pan  = $panCard  ?? $existing['pan_card'];
            $govt = $govtCert ?? $existing['government_certificate'];

            $stmt = mysqli_prepare($conn, "UPDATE organization_documents SET
                registration_certificate = ?, pan_card = ?, government_certificate = ?, uploaded_at = NOW()
                WHERE org_id = ?");
            mysqli_stmt_bind_param($stmt, "sssi", $reg, $pan, $govt, $org_id);
            mysqli_stmt_execute($stmt);
        } else {
            $stmt = mysqli_prepare($conn, "INSERT INTO organization_documents
                (org_id, registration_certificate, pan_card, government_certificate)
                VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "isss", $org_id, $regCert, $panCard, $govtCert);
            mysqli_stmt_execute($stmt);
        }
        $success = 'Documents uploaded successfully. They will be reviewed by our team.';
    }
}

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
