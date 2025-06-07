<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Change Status</title>
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
$changeSuccess = false;

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to change your password.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Get current password from register table
    $stmt = $conn->prepare("SELECT password, id FROM register WHERE loginid = ?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $stmt->bind_result($saved_Password, $saved_id);
    $stmt->fetch();
    $stmt->close();

    if ($currentPassword !== $saved_Password) {
            $loginError = "Current password is incorrect.";
        } elseif ($newPassword !== $confirmPassword) {
            $loginError = "New passwords do not match.";
        } else {
            // Update register password
            $stmt = $conn->prepare("UPDATE register SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $newPassword, $saved_id);
            $successRegister = $stmt->execute();
            $stmt->close();

            // Update user password
            $stmt = $conn->prepare("UPDATE user SET `register-Password` = ? WHERE id = ?");
            $stmt->bind_param("si", $newPassword, $saved_id);
            $successUser = $stmt->execute();
            $stmt->close();

            if ($successRegister && $successUser) {
                $changeSuccess = true;
            } else {
                $loginError = "Failed to update password. Please try again.";
            }
        }
    }

?>

<main id="pass-process-container">
    <?php if ($changeSuccess): ?>
      <h2>Password change successful</h2>
      <p>
        Click the button below to return to front page
      </p>
      <a href="index.php" class="pass-process-btn">Go to Front Page</a>
    <?php else: ?>
      <h2>Password Change Failed</h2>
      <p><?= htmlspecialchars($loginError ?: "Please fill out the form.") ?></p>
      <a href="password.php" class="pass-process-btn">Try Again</a>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
