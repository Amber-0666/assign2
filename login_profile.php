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

// Get balance from user table by register-ID
$stmt2 = $conn->prepare("SELECT balance FROM user WHERE `register-ID` = ?");
$stmt2->bind_param("s", $loginID);
$stmt2->execute();
$stmt2->bind_result($balance);
$stmt2->fetch();
$stmt2->close();

$conn->close();
?>

<main id="login-profile-container">
    <h2>Welcome to Your Profile, <?= htmlspecialchars($userInfo['loginid']) ?> </h2>

    <?php if ($userInfo): ?>
        <p><strong>Full Name:</strong> <?= htmlspecialchars($userInfo['fullname']) ?></p><br>
        <p><strong>Email:</strong> <?= htmlspecialchars($userInfo['email']) ?></p><br>
        <p><strong>User ID:</strong> <?= htmlspecialchars($userInfo['loginid']) ?></p><br>
        <p><strong>Registration Date:</strong> <?= htmlspecialchars($userInfo['created_at']) ?></p><br>    
        
        <a href="password.php" class="login-profile-btn">Change Password?</a>
        <a href="logout.php" class="login-profile-btn">Logout</a>
    <?php else: ?>
        <p>User information not found???</p><br>
        <p>Click<a href="login.php" class="login-profile-btn">here</a>to login</p>
    <?php endif; ?>
    
</main>
<main id="login-profile-container">
    <h2>Top-Up</h2>   
    <p><strong>Balance:</strong> RM <?= number_format($balance ?? 0, 2) ?></p>

    <a href="topup.php" class="login-profile-btn">Top Up Now</a>
    <a href="topup_history.php" class="login-profile-btn">Top Up History</a>
</main>

<?php include 'footer.php'; ?>

</body>
</html>

