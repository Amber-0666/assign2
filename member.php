<?php
session_start();
$loginSuccess = isset($_SESSION['login_success']) && $_SESSION['login_success'];
$loginError = $_SESSION['login_error'] ?? '';
$loginID = $_SESSION['register-ID'] ?? '';
unset($_SESSION['login_success'], $_SESSION['login_error']);
?>
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

<main id="confirmation-container">
  <div class="confirmation-box">
    <?php if ($loginSuccess): ?>
      <h2 class="success-title">Login Successful!</h2>
      <p class="welcome-msg">
        Welcome back, <strong><?php echo htmlspecialchars($loginID); ?></strong>! We're delighted to have you here again.
      </p>
      <p class="info-msg">
        Feel free to browse our latest products and exciting promotions tailored just for you.  
        You can search for anything you like using the search bar at the top — from your favorite drinks to exclusive deals.
      </p>
      <a class="btn btn-primary" href="index.php">Go to Front Page</a>
    <?php else: ?>
      <h2 class="error-title">Login Failed</h2>
      <p class="error-msg"><?php echo htmlspecialchars($loginError); ?></p>
      <p class="info-msg">
        Don’t worry, you can try logging in again. Make sure you enter the correct login ID and password.
        If you forgot your password, please contact our team for assistance.
      </p>
      <a class="btn btn-secondary" href="login.php">Try Again</a>
    <?php endif; ?>
  </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
