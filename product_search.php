<?php
// Enable error reporting during development
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

// Get search term
$search = $_GET['search'] ?? '';

// Prepare search query
if (!empty($search)) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR category LIKE ?");
    $param = "%$search%";
    $stmt->bind_param("ss", $param, $param);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM products");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Search</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .search-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }
        .search-form input[type=\"text\"] {
            width: 300px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #aaa;
        }
        .search-form button {
            padding: 10px 20px;
            border: none;
            background-color: #7a3e3e;
            color: #fff;
            border-radius: 5px;
            margin-left: 10px;
            cursor: pointer;
        }
        .products-grid {
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
        .product-card h3 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="search-container">
    <h1>Product Search</h1>

    <form method="get" class="search-form">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Enter product name or category">
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
