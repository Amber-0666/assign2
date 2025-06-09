<?php
// Start session and enable error reporting
session_start();
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

// Get search and category filters
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

// Build query dynamically
$query = "SELECT * FROM products WHERE 1 ";
$params = [];
$types = "";

if (!empty($search)) {
    $query .= "AND name LIKE ? ";
    $params[] = "%$search%";
    $types .= "s";
}

if (!empty($category)) {
    $query .= "AND category = ? ";
    $params[] = $category;
    $types .= "s";
}

$query .= "ORDER BY category, name";
$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .products-container { 
            max-width: 1200px; 
            margin: 50px auto; 
            padding: 20px; 
        }

        .search-form input[type="text"], 
        .search-form select {
            padding: 10px; 
            width: 250px; 
            border-radius: 
            5px; border: 
            1px solid #aaa;
        }

        .search-form button {
            padding: 10px 20px; 
            background-color: #7a3e3e; 
            color: white;
            border: none; 
            border-radius: 5px; 
            margin-left: 10px; 
            cursor: pointer;
        }
        .products-grid {
            margin-top: 30px;
            display: grid; 
            grid-template-columns: 
            repeat(auto-fit, minmax(250px, 1fr)); 
            gap: 20px;
        }
        .product-card {
            border: 1px solid #ddd; 
            padding: 15px; 
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc; 
            text-align: center;
        }
        .product-card img {
            width: 100%; 
            height: 200px; 
            object-fit: cover; 
            margin-bottom: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="products-container">
    <h1>Product Catalog</h1>

    <form method="get" class="search-form">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search product name...">

        <select name="category">
            <option value="">All Categories</option>
            <option value="Basic Brew" <?= ($category=="Basic Brew")?"selected":"" ?>>Basic Brew</option>
            <option value="Artisan Brew" <?= ($category=="Artisan Brew")?"selected":"" ?>>Artisan Brew</option>
            <option value="Non-coffee" <?= ($category=="Non-coffee")?"selected":"" ?>>Non-coffee</option>
            <option value="Hot Beverages" <?= ($category=="Hot Beverages")?"selected":"" ?>>Hot Beverages</option>
        </select>

        <button type="submit">Search</button>
    </form>

    <?php if ($result && $result->num_rows > 0): ?>
        <div class="products-grid">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                    <h3><?= htmlspecialchars($row['name']) ?></h3>
                    <p><strong>Category:</strong> <?= htmlspecialchars($row['category']) ?></p>
                    <p><strong>Price:</strong> RM <?= $row['price_mp'] ?> (MP) | RM <?= $row['price_np'] ?> (NP)</p>
                    <p><?= htmlspecialchars($row['description']) ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p style="margin-top:20px;">No products found.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>

<?php $conn->close(); ?>
