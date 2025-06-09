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

// Handle search and sorting inputs
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sort_by = isset($_GET['sort_by']) && in_array($_GET['sort_by'], ['id', 'first_name']) ? $_GET['sort_by'] : 'id';
$order = isset($_GET['order']) && in_array($_GET['order'], ['ASC', 'DESC']) ? $_GET['order'] : 'ASC';

// Prepare SQL with search and sort
$sql = "SELECT id, first_name, last_name, email, phone, city, state FROM joinus";

if ($search !== '') {
    $search = $mysqli->real_escape_string($search);
    $sql .= " WHERE first_name LIKE '%$search%'";
}

$sql .= " ORDER BY $sort_by $order";

$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Join Us Applications</title>
    <link rel="website icon" href="styles/images/websitelogo.png">
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

    <!-- Search and Filter Form -->
    <form method="GET" class="view_search">
        <input type="text" name="search" class="view_search_input" 
        placeholder="Search by First Name..." value="<?= htmlspecialchars($search) ?>">
        
        <select name="sort_by" class="view_sortby">
            <option value="id" <?= $sort_by === 'id' ? 'selected' : '' ?>>Sort by ID</option>
            <option value="first_name" <?= $sort_by === 'first_name' ? 'selected' : '' ?>>Sort by First Name</option>
        </select>

        <select name="order" class="view_order">
            <option value="ASC" <?= $order === 'ASC' ? 'selected' : '' ?>>Ascending</option>
            <option value="DESC" <?= $order === 'DESC' ? 'selected' : '' ?>>Descending</option>
        </select>

        <button type="submit" class="view_apply">Apply</button>
    </form>

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
</body>
</html>

