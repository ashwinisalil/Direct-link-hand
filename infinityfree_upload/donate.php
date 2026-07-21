<?php
/**
 * ===============================================================
 * DONATE PAGE (donate.php)
 * ===============================================================
 * Lets a logged-in donor send money to an organization. On submit,
 * it creates TWO database rows:
 *   1. A row in "donations"            (the donation record itself)
 *   2. A row in "payment_transactions" (the payment gateway record)
 *
 * NOTE: This is a simplified/demo flow. A real donation site would
 * call an actual payment gateway (Razorpay, Stripe, PayPal, etc.)
 * here and only mark the donation "Completed" after the gateway
 * confirms the payment succeeded.
 * ===============================================================
 */

require_once 'includes/db.php';
$pageTitle = 'Donate';

// Must be logged in as a donor to give — otherwise send them to log in first.
if (!isset($_SESSION['user_id'])) {
    redirect('login.php');
}

$error = '';
$success = '';

// If they arrived via a link like donate.php?org_id=5 (from the
// homepage or organizations page), pre-select that organization.
$selected_org = $_GET['org_id'] ?? ($_POST['org_id'] ?? '');

// Dropdown list of all approved organizations to choose from.
$organizations = mysqli_fetch_all(mysqli_query($conn, "SELECT org_id, organization_name FROM organizations
                                                         WHERE status = 'Approved' ORDER BY organization_name"), MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $org_id         = $_POST['org_id'] ?? '';
    $amount         = $_POST['amount'] ?? '';
    $payment_method = $_POST['payment_method'] ?? '';

    if ($org_id === '' || $amount === '' || $payment_method === '') {
        $error = 'Please fill in all required fields.';
    } elseif (!is_numeric($amount) || $amount <= 0) {
        $error = 'Please enter a valid donation amount.';
    } else {
        // Generate simple unique-ish reference codes for this donation.
        // uniqid() is based on the current time in microseconds, so it's
        // "good enough" for a demo project (a real payment gateway would
        // give you its own transaction ID instead).
        $receipt_number = 'DLH-' . strtoupper(uniqid());
        $payment_id     = 'PAY-' . strtoupper(uniqid());
        $user_id        = $_SESSION['user_id'];
        $status         = 'Completed';

        // ---- Step 1: record the donation itself ----
        $stmt = mysqli_prepare($conn, "INSERT INTO donations
            (user_id, org_id, amount, payment_id, payment_method, payment_status, donation_date, receipt_number)
            VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)");
        // Type string "iidssss": i=user_id, i=org_id, d=amount(decimal), then strings
        mysqli_stmt_bind_param($stmt, "iidssss",
            $user_id, $org_id, $amount, $payment_id, $payment_method, $status, $receipt_number);
        mysqli_stmt_execute($stmt);

        // mysqli_insert_id() gives us the donation_id MySQL just created,
        // so we can link the payment_transactions row to it below.
        $donation_id = mysqli_insert_id($conn);

        // ---- Step 2: record the "payment gateway" transaction ----
        $txStatus = 'Success';
        $stmt = mysqli_prepare($conn, "INSERT INTO payment_transactions
            (donation_id, payment_gateway, transaction_reference, amount, transaction_status, transaction_date)
            VALUES (?, ?, ?, ?, ?, NOW())");
        mysqli_stmt_bind_param($stmt, "issds",
            $donation_id, $payment_method, $payment_id, $amount, $txStatus);
        mysqli_stmt_execute($stmt);

        $success = "Thank you. Receipt {$receipt_number} has been recorded.";
    }
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<main class="container page">
    <p class="eyebrow">Transfer</p>
    <h1>Make a Donation</h1>
    <p class="page-lede">Choose the organization, set the amount, and the transfer is recorded immediately with a receipt number.</p>

    <?php if ($success): ?>
        <p class="alert alert-success"><?= e($success) ?></p>
    <?php endif; ?>
    <?php if ($error): ?>
        <p class="alert alert-error"><?= e($error) ?></p>
    <?php endif; ?>

    <div class="form-wrap">
        <div class="ticket-stub">
            <span>Transfer Ticket</span>
            <span class="ticket-stub-right">New</span>
        </div>
        <form method="POST" class="form" novalidate>
            <label for="org_id">Organization *</label>
            <select id="org_id" name="org_id" required>
                <option value="">-- Select Organization --</option>
                <?php foreach ($organizations as $org): ?>
                    <!-- "selected" is added automatically if this org matches
                         the one passed in via the URL (?org_id=..) -->
                    <option value="<?= e($org['org_id']) ?>" <?= ($selected_org == $org['org_id']) ? 'selected' : '' ?>>
                        <?= e($org['organization_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="amount">Amount (INR) *</label>
            <input type="number" id="amount" name="amount" min="1" step="0.01" required>

            <label for="payment_method">Payment Method *</label>
            <select id="payment_method" name="payment_method" required>
                <option value="">-- Select --</option>
                <option value="UPI">UPI</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="Net Banking">Net Banking</option>
            </select>

            <button type="submit" class="btn btn-primary">Confirm Donation</button>
        </form>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
