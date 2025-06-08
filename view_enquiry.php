<?php
// Enable error reporting for debugging during development (remove for production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'brewngo';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

// Handle search and sorting inputs
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sort_by_allowed = ['id', 'first_name'];
$order_allowed = ['ASC', 'DESC'];

$sort_by = (isset($_GET['sort_by']) && in_array($_GET['sort_by'], $sort_by_allowed)) ? $_GET['sort_by'] : 'id';
$order = (isset($_GET['order']) && in_array($_GET['order'], $order_allowed)) ? $_GET['order'] : 'DESC';

// Prepare SQL with search and sort
$sql = "SELECT id, first_name, last_name, email, phone, city, state, enquiry_type, message FROM enquiry";

if ($search !== '') {
    $search_esc = $conn->real_escape_string($search);
    $sql .= " WHERE first_name LIKE '%$search_esc%'";
}

$sql .= " ORDER BY $sort_by $order";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Enquiries</title>
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
    <h1>Customer Enquiries</h1>

    <!-- Search and Filter Form -->
    <form method="GET" class="view_search" style="text-align:center; margin-bottom:20px;">
        <input
            type="text"
            name="search"
            class="view_search_input"
            placeholder="Search by First Name..."
            value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>"
            />

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
                        <th>Enquiry Type</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td data-label="ID"><?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="First Name"><?= htmlspecialchars($row['first_name'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="Last Name"><?= htmlspecialchars($row['last_name'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="Email"><?= htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="Phone"><?= htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="City"><?= htmlspecialchars($row['city'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="State"><?= htmlspecialchars($row['state'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="Enquiry Type"><?= htmlspecialchars($row['enquiry_type'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="Message"><?= nl2br(htmlspecialchars($row['message'], ENT_QUOTES, 'UTF-8')) ?></td>
                        <td class="actions" data-label="Actions">
                            <a href="edit_enquiry.php?id=<?= $row['id'] ?>">Edit</a>
                            <a href="delete_enquiry.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this enquiry?');">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="no-data">No enquiries found.</p>
    <?php endif; ?>

    <div class="add-member-actions">
        <a href="add_enquiry.php" class="add-member-btn">Add New Enquiry</a>
    </div>
</div>

<?php $conn->close(); ?>
<?php include 'footer.php'; ?>

</body>
</html>
