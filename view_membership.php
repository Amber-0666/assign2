<?php
// view_membership.php

// Database connection settings
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'brewngo';

// Connect to MySQL database
$mysqli = new mysqli($host, $user, $pass, $db);

// Check connection
if ($mysqli->connect_error) {
    die('Database connection failed: ' . $mysqli->connect_error);
}

// Query to fetch all membership records in ascending order by created_at
$sql = "SELECT id, fullname, email, loginid, created_at FROM register ORDER BY created_at ASC";

$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>View Memberships</title>
<link rel="stylesheet" href="styles/style.css">
</head>
<body>

<h1>All Membership Records</h1>

<?php if ($result && $result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Login ID</th>
                <th>Registered At</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['fullname']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['loginid']) ?></td>
                <td><?= htmlspecialchars($row['created_at']) ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="no-data">No membership records found.</p>
<?php endif; ?>

<?php
$mysqli->close();
?>

</body>
</html>
