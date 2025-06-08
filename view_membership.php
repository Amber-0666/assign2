<?php
// Database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'Brewngo';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die('Database connection failed: ' . $mysqli->connect_error);
}

$mysqli->set_charset("utf8");

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

<?php include 'navbar.php'; ?>

<aside id="admin_dashboard-aside">
    <h1>Welcome Admin!</h1>
    <p><a href="view_enquiry.php">View Enquiry</a></p>
    <p><a href="view_joinus.php">View Join Us</a></p>
    <p><a href="view_membership.php">View Membership</a></p>
</aside>

<div class="View-page">
    <h1>All Membership Records</h1>

    <?php if ($result && $result->num_rows > 0): ?>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Login ID</th>
                        <th>Registered At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td data-label="ID"><?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="Full Name"><?= htmlspecialchars($row['fullname'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="Email"><?= htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="Login ID"><?= htmlspecialchars($row['loginid'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="Registered At"><?= htmlspecialchars($row['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="actions" data-label="Actions">
                            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="no-data">No membership records found.</p>
    <?php endif; ?>

    <div class="add-member-actions">
        <a href="Add_account.php" class="add-member-btn">Add New Member</a>
    </div>
</div>

<?php $mysqli->close(); ?>

</body>
</html>
