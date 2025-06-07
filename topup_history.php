<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Top Up History</title>
    <link rel="stylesheet" href="styles/style.css" />
</head>
<body>

<?php include 'navbar.php'; ?>

<?php
if (!isset($_SESSION['register-ID'])) {
    header("Location: login.php");
    exit;
}
$loginID = $_SESSION['register-ID'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BrewnGo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT amount, topup_date FROM topup_history WHERE register_ID = ? ORDER BY topup_date DESC");
$stmt->bind_param("s", $loginID);
$stmt->execute();
$result = $stmt->get_result();

$history = [];
while ($row = $result->fetch_assoc()) {
    $history[] = $row;
}

$stmt->close();
$conn->close();
?>

<main id="topup-history-container">
    <h2>Your Top Up History</h2>

    <?php if (count($history) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Amount (RM)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($history as $record): ?>
                    <tr>
                        <td><?= htmlspecialchars($record['topup_date']) ?></td>
                        <td><?= number_format($record['amount'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have no top up history yet.</p>
    <?php endif; ?>

    <a href="login_profile.php" id="topup-history-btn">Back to Profile</a>
</main>

<?php include 'footer.php'; ?>

</body>
</html>