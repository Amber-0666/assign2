<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Status</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php include 'navbar.php'; ?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assign2db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$loginSuccess = false;
$loginError = "";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_POST['register-ID'], $_POST['login-Password'])) {
    $loginError = "Please fill both the login ID and password fields.";
} else {
    // Get form inputs
    $loginID = $_POST['register-ID'];
    $loginPassword = $_POST['login-Password'];

    // Prepare statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT ID, `register-Password` FROM user WHERE `register-ID` = ?");
    $stmt->bind_param("s", $loginID);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($loginPassword, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['register-ID'] = $loginID;
            $loginSuccess = true;
        } else {
            $loginError = "Invalid Username or Password";
        }
    } else {
        $loginError = "Invalid Username or Password";
    }

    $stmt->close();
}

$conn->close();
?>

<main class="confirmation-container">
    <?php if ($loginSuccess): ?>
        <h2>Login Successful!</h2>
        <p>Welcome, <?php echo htmlspecialchars($loginID); ?>.</p>
        <button class="enquiry-submit-btn"><a href="index.php" class="back-home-btn">Go to front page</a></button>
    <?php else: ?>
        <h2>Login Failed</h2>
        <p><?php echo htmlspecialchars($loginError); ?></p>
        <button class="enquiry-submit-btn"><a href="login.php" class="back-home-btn">Try Again</a></button>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>

</body>
</html>