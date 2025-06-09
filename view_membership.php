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
$allowed_sort = ['id', 'fullname', 'created_at'];
$allowed_order = ['ASC', 'DESC'];

$sort_by = (isset($_GET['sort_by']) && in_array($_GET['sort_by'], $allowed_sort)) ? $_GET['sort_by'] : 'created_at';
$order = (isset($_GET['order']) && in_array($_GET['order'], $allowed_order)) ? $_GET['order'] : 'ASC';

// Prepare SQL with search and sort
$sql = "SELECT id, fullname, email, loginid, created_at FROM register";

if ($search !== '') {
    $search_esc = $mysqli->real_escape_string($search);
    $sql .= " WHERE fullname LIKE '%$search_esc%'";
}

$sql .= " ORDER BY $sort_by $order";

$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>View Memberships</title>
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
    <h1>All Membership Records</h1>

    <!-- Search and Filter Form -->
    <form method="GET" class="view_search">
        <input
            type="text"
            name="search"
            class="view_search_input"
            placeholder="Search by Full Name..."
            value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>"
        />

        <select name="sort_by" class="view_sortby">
            <option value="id" <?= $sort_by === 'id' ? 'selected' : '' ?>>Sort by ID</option>
            <option value="fullname" <?= $sort_by === 'fullname' ? 'selected' : '' ?>>Sort by Full Name</option>
            <option value="created_at" <?= $sort_by === 'created_at' ? 'selected' : '' ?>>Sort by Registered At</option>
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
                            <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
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
