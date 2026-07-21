<?php
/**
 * ===============================================================
 * CONTACT PAGE (contact.php)
 * ===============================================================
 * A simple contact form. Anyone (logged in or not) can send a
 * message, which is saved into the "contacts" table for the
 * admin team to read later.
 * ===============================================================
 */

require_once 'includes/db.php';
$pageTitle = 'Contact Us';

$success = '';
$error = '';

// This block only runs when the form has been submitted (POST request).
// On a normal page visit (GET request) it's skipped, and an empty
// form is shown instead.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Read the submitted values. trim() removes accidental leading/
    // trailing spaces. The "?? ''" means "use an empty string if
    // this field wasn't sent at all" — avoids PHP warnings.
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // ---- Basic validation ----
    if ($name === '' || $email === '' || $message === '') {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // ---- Save to database using a PREPARED STATEMENT ----
        // The "?" marks are placeholders. mysqli_stmt_bind_param()
        // safely inserts the real values in their place. This
        // protects against SQL Injection attacks, where someone
        // could type malicious SQL code into a form field.
        $stmt = mysqli_prepare($conn, "INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");

        // "ssss" means all 4 values are strings (s = string, i = integer, d = double)
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $message);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $success = 'Thank you. Your message has been sent.';
    }
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<main class="container page">
    <p class="eyebrow">Get in touch</p>
    <h1>Contact Us</h1>
    <p class="page-lede">Questions about a donation, an organization's status, or registering your own organization &mdash; send it here.</p>

    <!-- Show success or error message if the form was just submitted -->
    <?php if ($success): ?>
        <p class="alert alert-success"><?= e($success) ?></p>
    <?php endif; ?>
    <?php if ($error): ?>
        <p class="alert alert-error"><?= e($error) ?></p>
    <?php endif; ?>

    <div class="form-wrap">
        <div class="ticket-stub">
            <span>Message Ticket</span>
            <span class="ticket-stub-right">Draft</span>
        </div>
        <!-- method="POST" means form data is sent invisibly in the request body
             (as opposed to GET, which would show it in the URL) -->
        <form method="POST" class="form" novalidate>
            <label for="name">Name</label>
            <!-- value="<?= e($_POST['name'] ?? '') ?>" re-fills this field with
                 whatever the user typed if the form had a validation error,
                 so they don't have to retype everything -->
            <input type="text" id="name" name="name" required value="<?= e($_POST['name'] ?? '') ?>">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required value="<?= e($_POST['email'] ?? '') ?>">

            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" value="<?= e($_POST['subject'] ?? '') ?>">

            <label for="message">Message</label>
            <textarea id="message" name="message" rows="6" required><?= e($_POST['message'] ?? '') ?></textarea>

            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
