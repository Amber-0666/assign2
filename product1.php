<?php
// Database connection (adjust if necessary)
$servername = "localhost";
$username = "root";
$password = "";
$database = "brewngo";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get search input
$search = $_GET['search'] ?? '';
$search = trim($search);

// Prepare SQL query
if (!empty($search)) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ?");
    $param = "%$search%";
    $stmt->bind_param("s", $param);
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
    <title>Basic Brew</title>
    <link rel="stylesheet" href="styles/style.css">
    <style>
        .search-container { margin: 30px auto; text-align: center; }
        .search-input { padding: 10px; width: 300px; border: 1px solid #aaa; border-radius: 5px; font-size: 16px; }
        .search-button {
            padding: 10px 20px; border: none; background-color: #7a3e3e;
            color: white; border-radius: 5px; font-weight: 600; font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.15); cursor: pointer;
        }
        .search-button:hover { background-color: #5e2e2e; transform: scale(1.05); }
        .product_menu { display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; margin-top: 40px; }
        .product_item { background: #fff8ef; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 250px; }
        .product_item img { width: 100%; height: 200px; object-fit: cover; border-radius: 10px; }
        .product_item h3 { margin: 15px 0 10px; color: #7a3e3e; }
    </style>
</head>
<body class="index-body">

<?php include 'navbar.php'; ?>

<header>
    <div class="header-upper">
        <h1>Basic Brew</h1>
        <p class="subtitle">Balanced and Delightful<br>Find out Our Homemade Coffee, Complemented with Rich Aroma and Flavor</p>
    </div>
</header>

<div class="search-container">
    <form method="get" action="">
        <input type="text" name="search" class="search-input" placeholder="Search product name..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="search-button">Search</button>
    </form>
</div>

<div class="product_menu">
<?php
if ($result->num_rows > 0):
    while($row = $result->fetch_assoc()):
?>
    <div class="product_item">
        <img src="styles/images/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
        <h3><?= htmlspecialchars($row['name']) ?></h3>
        <p>MP: RM <?= number_format($row['price_mp'], 2) ?> | NP: RM <?= number_format($row['price_np'], 2) ?></p>
    </div>
<?php
    endwhile;
else:
    echo "<p>No products found.</p>";
endif;

$conn->close();
?>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
