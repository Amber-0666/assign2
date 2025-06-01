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
$dbname = "BrewnGo";

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

$stmt = $conn->prepare("SELECT `register-ID`, `register-Password` FROM user WHERE `register-ID` = ?");
    $stmt->bind_param("s", $loginID);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $storedpassword);
        $stmt->fetch();

        if ($loginPassword === $storedpassword) {
            $_SESSION['user_id'] = $id;
            $_SESSION['register-ID'] = $id;
            $_SESSION['is_admin'] = false;
            $loginSuccess = true;
        } else {
            $loginError = "Invalid Username or Password";
        }
    } else {
        // Check in admin table
        $stmt = $conn->prepare("SELECT `admin-ID`, `admin-Password` FROM admin WHERE `admin-ID` = ?");
        $stmt->bind_param("s", $loginID);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($admin_id, $admin_pass);
            $stmt->fetch();

            if ($loginPassword === $admin_pass) {
                $_SESSION['user_id'] = $admin_id;
                $_SESSION['admin-ID'] = $admin_id;
                $_SESSION['is_admin'] = true;
                $loginSuccess = true;
            } else {
                $loginError = "Invalid Username or Password";
            }
        } else {
            $loginError = "Invalid Username or Password";
        }
    }

    $stmt->close();
}

$conn->close();
?>

<main id="confirmation-container">
    <div>
        <?php if ($loginSuccess): ?>
            <h2>Login Successful!</h2>
            <p>Welcome, <?php echo htmlspecialchars($loginID); ?>.</p>
            <a href="index.php">Go to front page</a>
        <?php else: ?>
            <h2>Login Failed</h2>
            <p><?php echo htmlspecialchars($loginError); ?></p>
            <a href="login.php">Try Again</a>
        <?php endif; ?>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>