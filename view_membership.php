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

// Adjusted query to match your 'register' table columns
$sql = "SELECT id, fullname, email, loginid, created_at FROM register ORDER BY created_at DESC";

$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>View Memberships</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 40px;
        background-color: #f8f9fa;
    }
    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
        border: 1px solid #ddd;
        padding: 12px 15px;
        text-align: left;
    }
    th {
        background-color: #007BFF;
        color: white;
        font-weight: 600;
    }
    tr:nth-child(even) {
        background-color: #f1f3f5;
    }
    tr:hover {
        background-color: #e9ecef;
    }
    p.no-data {
        text-align: center;
        font-style: italic;
        color: #666;
    }
</style>
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
// Close DB connection
$mysqli->close();
?>

</body>
</html>
