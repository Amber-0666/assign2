<?php
session_start(); // Start session for anti-spam

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'brewngo';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Anti-spam logic: prevent submissions within 60 seconds
$cooldown_seconds = 60;
$now = time();
$allow_submission = true;
$spam_message = "";

if (isset($_SESSION['last_submission_time'])) {
    $time_since_last = $now - $_SESSION['last_submission_time'];
    if ($time_since_last < $cooldown_seconds) {
        $allow_submission = false;
        $spam_message = "You are submitting too fast! Please wait ".($cooldown_seconds - $time_since_last)." seconds before submitting again.";
    }
}

$inserted = false;

// Process form only if allowed
if ($allow_submission) {
    $firstName = htmlspecialchars($_POST['first-name'] ?? '');
    $lastName = htmlspecialchars($_POST['last-name'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $phone = preg_match('/^[0-9]{10}$/', $_POST['phone'] ?? '') ? $_POST['phone'] : false;
    $street = htmlspecialchars($_POST['street'] ?? '');
    $city = htmlspecialchars($_POST['city'] ?? '');
    $state = htmlspecialchars($_POST['state'] ?? '');
    $postcode = preg_match('/^[0-9]{5}$/', $_POST['postcode'] ?? '') ? $_POST['postcode'] : false;
    $enquiryType = htmlspecialchars($_POST['enquiry-type'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    if ($firstName && $lastName && $email && $phone && $street && $city && $state && $postcode && $enquiryType && $message) {
        $stmt = $conn->prepare("INSERT INTO enquiry (first_name, last_name, email, phone, street, city, state, postcode, enquiry_type, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $firstName, $lastName, $email, $phone, $street, $city, $state, $postcode, $enquiryType, $message);
        $inserted = $stmt->execute();
        $stmt->close();

        // Store submission time into session
        $_SESSION['last_submission_time'] = $now;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enquiry Confirmation</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php include 'navbar.php'; ?>

<main id="confirmation-container">
    <?php if (!$allow_submission): ?>
        <h2>Spam Detected!</h2>
        <p><?= htmlspecialchars($spam_message) ?></p>

    <?php elseif ($inserted): ?>
        <h2>Enquiry Confirmation</h2>
        <p>Thank you, <?= htmlspecialchars($firstName) . ' ' . htmlspecialchars($lastName) ?>, for reaching out. Here's the information you submitted:</p>

        <div class="info-grid">
            <div><strong>Email:</strong> <?= htmlspecialchars($email) ?></div>
            <div><strong>Phone:</strong> <?= htmlspecialchars($phone) ?></div>
            <div><strong>Address:</strong> <?= htmlspecialchars($street) ?>, <?= htmlspecialchars($city) ?>, <?= htmlspecialchars($state) ?> <?= htmlspecialchars($postcode) ?></div>
            <div><strong>Enquiry Type:</strong> <?= htmlspecialchars($enquiryType) ?></div>
            <div><strong>Message:</strong> <?= nl2br(htmlspecialchars($message)) ?></div>
        </div>

    <?php else: ?>
        <h2>Submission Failed</h2>
        <p>Sorry, there was a problem submitting your enquiry. Please try again later.</p>
    <?php endif; ?>

    <a href="enquiry.php">Back to Enquiry Page</a>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
