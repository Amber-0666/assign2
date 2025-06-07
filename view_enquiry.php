<?php
// === Enable error reporting for debugging ===
error_reporting(E_ALL);
ini_set('display_errors', 1);

// === Database connection ===
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'enquiry';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// === Retrieve all enquiries sorted by latest first ===
$sql = "SELECT * FROM enquiry ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Enquiries</title>
    <link rel="icon" type="image/png" href="styles/images/websitelogo.png">
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>

<?php include 'navbar.php'; ?>

<header class="view-header">
    <div class="view-header-content">
        <h1>All Customer Enquiries</h1>
        <p class="view-subtitle">Admin View: Submitted enquiries from customers</p>
    </div>
</header>

<main>
    <div class="view-content-container">
        <?php if ($result && $result->num_rows > 0): ?>
            <table class="enquiry-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Postcode</th>
                        <th>Enquiry Type</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['first_name']) ?></td>
                            <td><?= htmlspecialchars($row['last_name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['phone']) ?></td>
                            <td><?= htmlspecialchars($row['street']) ?></td>
                            <td><?= htmlspecialchars($row['city']) ?></td>
                            <td><?= htmlspecialchars($row['state']) ?></td>
                            <td><?= htmlspecialchars($row['postcode']) ?></td>
                            <td><?= htmlspecialchars($row['enquiry_type']) ?></td>
                            <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-records">No enquiries found.</p>
        <?php endif; ?>
        
        <div class="view-back-btn">
            <a href="index.php" class="back-home-btn">Back to Home</a>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>

<?php
$conn->close();
?>
