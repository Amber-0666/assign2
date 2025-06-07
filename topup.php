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
<?php 
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

<div id="topup-container">
    <h2>Top Up Your Balance</h2>

    <p><strong>Balance:</strong> RM <?= number_format($balance ?? 0, 2) ?></p>

    <form method="POST" action="topup_process.php">
        <label for="amount">Top-Up Amount (RM):</label><br>
        <input type="number" min="1" placeholder="Enter amount (e.g. 10.00)" name="amount" required><br><br>
        <button type="submit" id="topup-submit-btn">Top Up</button>
    </form>

    <a href="login_profile.php" id="topup-btn">Return</a>

</div>
<?php include 'footer.php'; ?>

</body>
</html>