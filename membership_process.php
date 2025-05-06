<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve and sanitize POST data
$firstName = htmlspecialchars($_POST['register-first-name'] ?? '');
$lastName = htmlspecialchars($_POST['register-last-name'] ?? '');
$email = htmlspecialchars($_POST['register-email'] ?? '');
$loginID = htmlspecialchars($_POST['register-ID'] ?? '');
$password = htmlspecialchars($_POST['register-Password'] ?? '');

// You might hash the password or validate more, depending on your system
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Registration Confirmation</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main class="confirmation-container">
        <h2>Registration Confirmation</h2>
        <p>Thank you for registering! Here's is your information:</p>
        <ul>
            <li><strong>First Name:</strong> <?= $firstName ?></li>
            <li><strong>Last Name:</strong> <?= $lastName ?></li>
            <li><strong>Email:</strong> <?= $email ?></li>
            <li><strong>Login ID:</strong> <?= $loginID ?></li>
            <li><strong>Password:</strong> <?= $password?></li>
        </ul>
        <a href="index.php" class="back-home-btn">Back to Home</a>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
