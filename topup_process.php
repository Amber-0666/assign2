<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Top Up Confirmation</title>
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

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to perform top-up.");
}

$userId = $_SESSION['user_id'];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = floatval($_POST['amount']);

    if ($amount <= 0) {
        $_SESSION['topup_error'] = "Please enter a valid top-up amount.";
        header("Location: topup.php");
        exit;
    }

    // Update balance in DB
    $stmt = $conn->prepare("UPDATE user SET balance = balance + ? WHERE `register-ID` = ?");
    $stmt->bind_param("ds", $amount, $userId);

    if ($stmt->execute()) {
        // Get updated balance
        $stmt->close();

        $stmt = $conn->prepare("SELECT balance FROM user WHERE id = ?");
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $stmt->bind_result($newBalance);
        $stmt->fetch();
        $stmt->close();

        $_SESSION['balance'] = $newBalance;
        $_SESSION['topup_success'] = "Top-up successful! RM " . number_format($amount, 2) . " has been added.";

        // Insert topup record
        $stmt2 = $conn->prepare("INSERT INTO topup_history (register_ID, amount) VALUES (?, ?)");
        $stmt2->bind_param("sd", $userId, $amount);
        $stmt2->execute();
        $stmt2->close();
    } else {
        $_SESSION['topup_error'] = "Top-up failed. Please try again.";
    }

    $conn->close();
}
?>

<main id="topup-process-container">
    <h2>Top Up Confirmation</h2>
    <p>
        Thank you, <?= htmlspecialchars($_SESSION['user_id']) ?>.
        <?= isset($_SESSION['topup_success']) ? htmlspecialchars($_SESSION['topup_success']) : '' ?>
    </p>

    <a href="login_profile.php" class="topup-process-btn">Back to Profile</a>
    <a href="topup.php" class="topup-process-btn">Top Up Again</a>
    
</main>
<?php include 'footer.php'; ?>

</body>
</html>