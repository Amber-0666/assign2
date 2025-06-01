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
$stmt = $conn->prepare("SELECT `fullname`, `email`, `loginid`, `created_at` FROM register WHERE `loginid` = ?");
$stmt->bind_param("s", $loginID);
$stmt->execute();
$result = $stmt->get_result();

$userInfo = $result->fetch_assoc();

$stmt->close();
$conn->close();

?>

<main id="confirmation-container">
    <h2>Welcome to Your Profile</h2>

    <?php if ($userInfo): ?>
        <p><strong>Name:</strong> <?= htmlspecialchars($userInfo['fullname']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($userInfo['email']) ?></p>
        <p><strong>User ID:</strong> <?= htmlspecialchars($userInfo['loginid']) ?></p>
        <p><strong>Registration Date:</strong> <?= htmlspecialchars($userInfo['created_at']) ?></p>
    <?php else: ?>
        <p>User information not found??</p>
    <?php endif; ?>

    <button class="enquiry-reset-btn"><a href="logout.php" class="back-home-btn">Logout</a></button>
</main>

<?php include 'footer.php'; ?>

</body>
</html>

