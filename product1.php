<?php
// Connect to database for product search
$host = "localhost";
$username = "root";
$password = "";
$database = "brewngo";  // your correct database name

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle search
$searchResults = null;
if (isset($_GET['search'])) {
    $searchTerm = "%" . $conn->real_escape_string($_GET['search']) . "%";
    $sql = "SELECT * FROM products WHERE name LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $searchResults = $stmt->get_result();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Basic Brew</title>
    <link rel="stylesheet" href="styles/style.css">
    <style>
        /* Search button hover */
        .search-button {
            padding: 10px 20px;
            border: none;
            background-color: #7a3e3e;
            color: white;
            border-radius: 5px;
            font-weight: 600;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.15);
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #5e2e2e;
            transform: scale(1.05);
        }
    </style>
</head>

<body class="index-body">

<?php include 'navbar.php'; ?>

<header style="position: relative; z-index: 1;">
    <div class="header-upper">
        <h1>Basic Brew</h1>
        <p class="subtitle">Balanced and Delightful<br>Find out Our Homemade Coffee, Complemented with Rich Aroma and Flavor</p>

        <!-- Search Form -->
        <form method="GET" action="" style="margin-top: 30px;">
            <input type="text" name="search" placeholder="Search product name..." style="padding: 10px; border-radius: 5px; width: 250px;">
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>
</header>

<section class="product_sidebar">
    <aside>
        <div class="product_nav">
            <p>LIST</p>
            <hr><br>
            <nav class="product_selection">
                <ul>
                    <li class="Basic_Brew" id="target_page"><a href="product1.php">Basic Brew</a></li>
                    <li class="Artisan_Brew"><a href="product2.php">Artisan Brew</a></li>
                    <li class="Non-coffee"><a href="product3.php">Non-coffee</a></li>
                    <li class="Hot_Beverages"><a href="product4.php">Hot Beverages</a></li>
                </ul>
                <hr><br>
            </nav>
            <ol class="product_extra">
                <li>★ MP : Member Price / NP : Normal Price</li>
                <li>★ All Price are in Ringgit Malaysia (RM)</li>
                <li>★ Add on RM 2 for Oat Milk</li>
            </ol>
        </div>
    </aside>

    <div class="product_menu">
        <?php if ($searchResults !== null): ?>
            <?php if ($searchResults->num_rows > 0): ?>
                <?php while($product = $searchResults->fetch_assoc()): ?>
                    <div>
                        <figure><img src="<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>"></figure>
                        <dl>
                            <dt><?= htmlspecialchars($product['name']) ?></dt>
                            <dd>MP | NP</dd>
                            <dd><?= $product['price_mp'] ?> | <?= $product['price_np'] ?></dd>
                        </dl>
                        <hr>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="color: brown; font-weight: bold;">No products found.</p>
            <?php endif; ?>
        <?php else: ?>
            <!-- Default hardcoded products if no search -->
            <div>
                <figure><img src="styles/images/No_image.jpg" alt="Americano"></figure>
                <dl><dt>Americano</dt><dd>MP | NP</dd><dd>8.90 | 10.90</dd></dl><hr>
            </div>
            <div>
                <figure><img src="styles/images/Latte.jpg" alt="Latte"></figure>
                <dl><dt>Latte</dt><dd>MP | NP</dd><dd>10.90 | 12.90</dd></dl><hr>
            </div>
            <div>
                <figure><img src="styles/images/Cappuccino.jpg" alt="Cappuccino"></figure>
                <dl><dt>Cappuccino</dt><dd>MP | NP</dd><dd>11.90 | 13.90</dd></dl><hr>
            </div>
            <div>
                <figure><img src="styles/images/Aerocano.jpg" alt="Aerocano"></figure>
                <dl><dt>Aerocano</dt><dd>MP | NP</dd><dd>10.90 | 12.90</dd></dl><hr>
            </div>
            <div>
                <figure><img src="styles/images/Aero-Latte.jpg" alt="Aero-latte"></figure>
                <dl><dt>Aero-latte</dt><dd>MP | NP</dd><dd>12.90 | 14.90</dd></dl><hr>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
