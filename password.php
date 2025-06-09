<?php
// Start session and enable error reporting
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Status</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php include 'navbar.php'; ?>

<main id="pass-container">
    <h2>Change Your Password</h2>
    <form method="POST" action="password_process.php">
        <label>Current Password:</label><br>
        <input type="password" name="current_password" required><br><br>

        <label>New Password:</label><br>
        <input type="password" name="new_password" required><br><br>

        <label>Confirm New Password:</label><br>
        <input type="password" name="confirm_password" required><br><br>

        <a href="login_profile.php" class="change-pass-btn">Return</a>
        <button type="submit" class="change-pass-btn">Change Password</button>
    </form>
</main>

<?php include 'footer.php'; ?>
</body>
</html>