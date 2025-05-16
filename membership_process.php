<?php
// === Enable error reporting for debugging ===
error_reporting(E_ALL);
ini_set('display_errors', 1);

// === Sanitize and validate input ===
$firstName = htmlspecialchars($_POST['register-first-name'] ?? '');
$lastName = htmlspecialchars($_POST['register-last-name'] ?? '');
$email = filter_var($_POST['register-email'] ?? '', FILTER_VALIDATE_EMAIL);
$loginID = htmlspecialchars($_POST['register-ID'] ?? '');
$password = htmlspecialchars($_POST['register-Password'] ?? ''); // Consider hashing this before storing
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

<main id="confirmation-container">
    <h2>Registration Confirmation</h2>
    <p>Thank you, <?= $firstName ?> <?= $lastName ?>, for registering! Here's the information you submitted:</p>

    <div class="info-grid">
        <div><strong>Email:</strong> <?= htmlspecialchars($email) ?></div>
        <div><strong>Login ID:</strong> <?= $loginID ?></div>
        <div><strong>Password:</strong> <?= $password ?></div>
    </div>

    <a href="registration.php">Back to Registration Page</a>
</main>

<?php include 'footer.php'; ?>

</body>
</html>

