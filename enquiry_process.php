<?php
// === Enable error reporting ===
error_reporting(E_ALL);
ini_set('display_errors', 1);

// === Database connection ===
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'brewngo';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// === Initialize inserted variable ===
$inserted = false;

// === Sanitize and validate input ===
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

// === Validation check ===
if ($firstName && $lastName && $email && $phone && $street && $city && $state && $postcode && $enquiryType && $message) {
    // === Insert into database ===
    $stmt = $conn->prepare("INSERT INTO enquiry (first_name, last_name, email, phone, street, city, state, postcode, enquiry_type, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $firstName, $lastName, $email, $phone, $street, $city, $state, $postcode, $enquiryType, $message);
    $inserted = $stmt->execute();
    $stmt->close();
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
    <style>
        .confirmation-container {
            max-width: 800px;
            margin: 80px auto;
            padding: 30px 40px;
            background: #fff7f0;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .confirmation-container h2 {
            text-align: center;
            color: #7a3e3e;
            margin-bottom: 20px;
            font-size: 28px;
        }
        .confirmation-container p, .confirmation-container li {
            font-size: 16px;
            margin: 10px 0;
            color: #333;
        }
        .confirmation-container ul {
            list-style: none;
            padding: 0;
        }
        .back-home-btn {
            display: block;
            margin: 30px auto 0;
            width: fit-content;
            padding: 10px 25px;
            background-color: #7a3e3e;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
        }
        .back-home-btn:hover {
            background-color: #5e2e2e;
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<main>
    <div class="confirmation-container">
        <?php if ($inserted): ?>
            <h2>Enquiry Submitted Successfully!</h2>
            <p>Thank you, <?= htmlspecialchars($firstName) . ' ' . htmlspecialchars($lastName) ?>, for reaching out.</p>
            <ul>
                <li><strong>Email:</strong> <?= htmlspecialchars($email) ?></li>
                <li><strong>Phone:</strong> <?= htmlspecialchars($phone) ?></li>
                <li><strong>Address:</strong> <?= htmlspecialchars($street) ?>, <?= htmlspecialchars($city) ?>, <?= htmlspecialchars($state) ?> <?= htmlspecialchars($postcode) ?></li>
                <li><strong>Enquiry Type:</strong> <?= htmlspecialchars($enquiryType) ?></li>
                <li><strong>Message:</strong> <?= nl2br(htmlspecialchars($message)) ?></li>
            </ul>
        <?php else: ?>
            <h2>Submission Failed</h2>
            <p>Sorry, there was a problem submitting your enquiry. Please try again later.</p>
        <?php endif; ?>
        <a href="index.php" class="back-home-btn">Back to Home</a>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
