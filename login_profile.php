<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>User Profile</title>
    <link rel="stylesheet" href="styles/style.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php include 'navbar.php'; ?>

<?php

// Check if user is logged in by verifying session variables
if (!isset($_SESSION['user_id'], $_SESSION['register-ID'])) {
    // Not logged in, redirect to login page
    header("Location: login.php");
    exit;
}

$loginID = $_SESSION['register-ID'];

// DB connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BrewnGo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute query to fetch user info by register-ID
$stmt = $conn->prepare("SELECT `register-first-name`, `register-last-name`, `register-email`, `register-ID`, `created_at` FROM membership WHERE `register-ID` = ?");
$stmt->bind_param("s", $loginID);
$stmt->execute();
$result = $stmt->get_result();

$userInfo = $result->fetch_assoc();

$stmt->close();
$conn->close();

?>

<main class="confirmation-container">
    <h2>Welcome to Your Profile</h2>

    <?php if ($userInfo): ?>
        <p><strong>First Name:</strong> <?= htmlspecialchars($userInfo['register-first-name']) ?></p>
        <p><strong>Last Name:</strong> <?= htmlspecialchars($userInfo['register-last-name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($userInfo['register-email']) ?></p>
        <p><strong>User ID:</strong> <?= htmlspecialchars($userInfo['register-ID']) ?></p>
        <p><strong>Registration Date:</strong> <?= htmlspecialchars($userInfo['created_at']) ?></p>
    <?php else: ?>
        <p>User information not found??</p>
    <?php endif; ?>

    <button class="enquiry-submit-btn"><a href="logout.php" class="back-home-btn">Logout</a></button>
</main>

<?php include 'footer.php'; ?>

</body>
</html>

