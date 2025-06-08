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

$sql = "SELECT id, first_name, last_name, email, phone, city, state FROM joinus ORDER BY id ASC";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Join Us Applications</title>
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

    <h1>Applicants List</h1>

    <?php if ($result && $result->num_rows > 0): ?>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td data-label="ID"><?= htmlspecialchars($row['id']) ?></td>
                        <td data-label="First Name"><?= htmlspecialchars($row['first_name']) ?></td>
                        <td data-label="Last Name"><?= htmlspecialchars($row['last_name']) ?></td>
                        <td data-label="Email"><?= htmlspecialchars($row['email']) ?></td>
                        <td data-label="Phone"><?= htmlspecialchars($row['phone']) ?></td>
                        <td data-label="City"><?= htmlspecialchars($row['city']) ?></td>
                        <td data-label="State"><?= htmlspecialchars($row['state']) ?></td>
                        <td class="actions" data-label="Actions">
                            <a href="edit_applicant.php?id=<?= $row['id'] ?>">Edit</a>
                            <a href="delete_applicant.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this applicant?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="no-data">No applications found.</p>
    <?php endif; ?>

    <div class="add-member-actions">
        <a href="add_applicant.php" class="add-member-btn">Add New Applicant</a>
    </div>     
</div>

<?php $mysqli->close(); ?>
<?php include 'footer.php'; ?>
</body>
</html>

