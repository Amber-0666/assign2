<?php
// === Enable error reporting for debugging ===
error_reporting(E_ALL);
ini_set('display_errors', 1);

// === Connect to DB ===
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'brewngo';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die('DB Connection failed: ' . $mysqli->connect_error);
}

// === Sanitize & Validate Input ===
$firstName = trim($_POST['register-first-name'] ?? '');
$lastName = trim($_POST['register-last-name'] ?? '');
$fullName = $firstName . ' ' . $lastName;
$email = filter_var($_POST['register-email'] ?? '', FILTER_VALIDATE_EMAIL);
$loginID = trim($_POST['register-ID'] ?? '');
$password = $_POST['register-Password'] ?? '';  // plain password, NOT hashed

$errors = [];
if (!$firstName || !$lastName || !$email || !$loginID || !$password) {
    $errors[] = 'All fields are required and must be valid.';
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo '<p style="color:red;">' . htmlspecialchars($error) . '</p>';
    }
    echo '<a href="registration.php">Go Back</a>';
    exit;
}

// === Insert into DB (password saved as plain text) ===
$stmt = $mysqli->prepare("INSERT INTO register (fullname, email, loginid, password) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die('Prepare failed: ' . $mysqli->error);
}

$stmt->bind_param("ssss", $fullName, $email, $loginID, $password);
if (!$stmt->execute()) {
    die('Insert failed: ' . $stmt->error);
}

$stmt2 = $mysqli->prepare("INSERT INTO user (`register-ID`, `register-Password`) VALUES (?, ?)");
if (!$stmt2) {
    die('Prepare failed: ' . $mysqli->error);
}

$stmt2->bind_param("ss", $loginID, $password);
if (!$stmt2->execute()) {
    die('Insert failed: ' . $stmt->error);
}

$stmt->close();
$stmt2->close();
$mysqli->close();
?>

<!-- === Confirmation Page === -->
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
    <p>Thank you, <?= htmlspecialchars($fullName) ?>, for registering! Here's what you submitted:</p>

    <div class="info-grid">
        <div><strong>Email:</strong> <?= htmlspecialchars($email) ?></div>
        <div><strong>Login ID:</strong> <?= htmlspecialchars($loginID) ?></div>
        <div><strong>Password:</strong> <?= htmlspecialchars($password) ?></div>
    </div>

    <a href="registration.php">Back to Registration Page</a>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
