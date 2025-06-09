<?php
// Start session and enable error reporting
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BrewnGo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$loginID = $_SESSION['register-ID'];

$stmt = $conn->prepare("SELECT balance FROM user WHERE `register-ID` = ?");
$stmt->bind_param("s", $loginID);
$stmt->execute();
$stmt->bind_result($balance);
$stmt->fetch();
$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Top Up Balance</title>
    <link rel="stylesheet" href="styles/style.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php include 'navbar.php'; ?>

<main id="topup-container">
    <h2>Top Up Your Balance</h2>

    <p><strong>Balance:</strong> RM <?= number_format($balance ?? 0, 2) ?></p>

    <?php if (isset($_SESSION['topup_status'])): ?>
    <div class="<?= $_SESSION['topup_status'] === 'success' ? 'status-success' : 'status-fail' ?>">
        <?= $_SESSION['topup_status'] === 'success' 
            ? htmlspecialchars($_SESSION['topup_success']) 
            : htmlspecialchars($_SESSION['topup_error']) ?>
    </div>
    <?php 
    unset($_SESSION['topup_status'], $_SESSION['topup_success'], $_SESSION['topup_error']); 
    ?>
<?php endif; ?>

    <form method="POST" action="topup_process.php">
        <label for="amount">Top-Up Amount (RM):</label><br>
        <input type="number" step="0.01" min="1" max="50" placeholder="Enter amount (e.g. 10.00)" name="amount" required><br><br>

        <label for="ewallet">Choose E-Wallet:</label><br>
        <select name="ewallet" required>
            <option value="tng">Touch 'n Go</option>
            <option value="grabpay">GrabPay</option>
            <option value="boost">Boost</option>
        </select><br><br>
        <button type="submit" id="topup-submit-btn">Top Up</button>
    </form>

    <a href="login_profile.php" id="topup-btn">Return to Profile</a>

</main>
<?php include 'footer.php'; ?>

</body>
</html>