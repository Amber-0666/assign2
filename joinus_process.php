<?php
// === Enable error reporting ===
error_reporting(E_ALL);
ini_set('display_errors', 1);

// === Sanitize and validate input ===
$firstName = htmlspecialchars($_POST['first-name'] ?? '');
$lastName = htmlspecialchars($_POST['last-name'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$phone = preg_match('/^[0-9]{10}$/', $_POST['phone'] ?? '') ? $_POST['phone'] : '';
$street = htmlspecialchars($_POST['street'] ?? '');
$city = htmlspecialchars($_POST['city'] ?? '');
$state = htmlspecialchars($_POST['state'] ?? '');
$postcode = preg_match('/^[0-9]{5}$/', $_POST['postcode'] ?? '') ? $_POST['postcode'] : '';

// === Handle file uploads ===
$cvFileName = 'No file uploaded';
$photoFileName = 'No file uploaded';

if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
    $cvFileName = basename($_FILES['cv']['name']);
    // Not moving the file, just displaying info
}

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $photoFileName = basename($_FILES['photo']['name']);
    // Not moving the file, just displaying info
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Join Us Confirmation</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php include 'navbar.php'; ?>

<main id = "confirmation-container">
    <h2>Application Confirmation</h2>
    <p>Thank you, <?= $firstName ?> <?= $lastName ?>, for applying to join our team. Here's the information you submitted:</p>
    
    <div class="info-grid">
        <div><strong>Email:</strong> <?= htmlspecialchars($email) ?></div>
        <div><strong>Phone:</strong> <?= htmlspecialchars($phone) ?></div>
        <div><strong>Address:</strong> <?= "$street, $city, $state $postcode" ?></div>
        <div><strong>Uploaded CV:</strong> <?= $cvFileName ?></div>
        <div><strong>Uploaded Photo:</strong> <?= $photoFileName ?></div>
    </div>
    
    <a href="joinus.php">Back to Join Us Page</a>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
