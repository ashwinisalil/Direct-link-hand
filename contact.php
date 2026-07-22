<?php
require_once 'includes/db.php';
$pageTitle = 'Contact Us';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $message === '') {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
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
        <form method="POST" class="form" novalidate>
            <label for="name">Name</label>
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
