<?php
// === Enable error reporting for debugging ===
error_reporting(E_ALL);
ini_set('display_errors', 1);

// === Database connection ===

$host = 'localhost';
$username = 'root';
$password = ''; 
$database = 'enquiry'; 

$conn = new mysqli($host, $username, $password, $database);

// Check for DB connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// === Sanitize and validate input ===
$firstName   = htmlspecialchars($_POST['first-name'] ?? '');
$lastName    = htmlspecialchars($_POST['last-name'] ?? '');
$email       = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$phone       = preg_match('/^[0-9]{10}$/', $_POST['phone'] ?? '') ? $_POST['phone'] : false;
$street      = htmlspecialchars($_POST['street'] ?? '');
$city        = htmlspecialchars($_POST['city'] ?? '');
$state       = htmlspecialchars($_POST['state'] ?? '');
$postcode    = preg_match('/^[0-9]{5}$/', $_POST['postcode'] ?? '') ? $_POST['postcode'] : false;
$enquiryType = htmlspecialchars($_POST['enquiry-type'] ?? '');
$message     = htmlspecialchars($_POST['message'] ?? '');

// === Validation check ===
if (!$firstName || !$lastName || !$email || !$phone || !$street || !$city || !$state || !$postcode || !$enquiryType || !$message) {
    echo "<p>Error: Please ensure all fields are filled in correctly.</p>";
    exit();
}

// === Insert into database ===
$stmt = $conn->prepare("INSERT INTO enquiry (first_name, last_name, email, phone, street, city, state, postcode, enquiry_type, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssss", $firstName, $lastName, $email, $phone, $street, $city, $state, $postcode, $enquiryType, $message);

$inserted = $stmt->execute();
$stmt->close();
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

<main class="confirmation-container">
    <?php if ($inserted): ?>
        <h2>Enquiry Submitted Successfully!</h2>
        <p>Thank you, <?= $firstName ?> <?= $lastName ?>, for reaching out.</p>
        <ul>
            <li><strong>Email:</strong> <?= $email ?></li>
            <li><strong>Phone:</strong> <?= $phone ?></li>
            <li><strong>Address:</strong> <?= "$street, $city, $state $postcode" ?></li>
            <li><strong>Enquiry Type:</strong> <?= $enquiryType ?></li>
            <li><strong>Message:</strong><br><?= nl2br($message) ?></li>
        </ul>
    <?php else: ?>
        <h2>Submission Failed</h2>
        <p>Sorry, there was a problem submitting your enquiry. Please try again later.</p>
    <?php endif; ?>
    <a href="index.php" class="back-home-btn">Back to Home</a>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
