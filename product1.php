<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'brewngo';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$search = $_GET['search'] ?? '';
$category = 'Basic Brew';

if (!empty($search)) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE category = ? AND name LIKE ?");
    $param = "%$search%";
    $stmt->bind_param("ss", $category, $param);
} else {
    $stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->bind_param("s", $category);
}
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Basic Brew</title>
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body class="index-body">

<?php include 'navbar.php'; ?>

<!-- Here's the key fix: we add z-index to the entire header -->
<header style="position: relative; z-index: 999;">
    <div class="header-upper">
        <h1>Basic Brew</h1>
        <p class="subtitle">Balanced and Delightful<br>Find out Our Homemade Coffee, Complemented with Rich Aroma and Flavor</p>

        <form method="get" style="margin-top: 20px;">
            <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search product name..." style="padding:10px; width:300px; border-radius:5px; border:1px solid #aaa;">
            <button type="submit" style="padding:10px 20px; border:none; background-color:#7a3e3e; color:white; border-radius:5px; margin-left:10px;">Search</button>
        </form>
    </div>
</header>

<section class="product_sidebar">
    <aside>
        <div class="product_nav">
            <p>LIST</p> <hr><br>
            <nav class="product_selection">
                <ul>
                    <li class="Basic_Brew" id="target_page"><a href="product1.php">Basic Brew</a></li>
                    <li class="Artisan_Brew"><a href="product2.php">Artisan Brew</a></li>
                    <li class="Non-coffee"><a href="product3.php">Non-coffee</a></li>
                    <li class="Hot_Beverages"><a href="product4.php">Hot Beverages</a></li>
                </ul><hr><br>
            </nav>
            <ol class="product_extra">
                <li>★ MP : Member Price / NP : Normal Price</li>
                <li>★ All Price are in Ringgit Malaysia (RM)</li>
                <li>★ Add on RM 2 for Oat Milk</li>
            </ol>
        </div>
    </aside>

    <div class="product_menu">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div>
                    <figure><img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>"></figure>
                    <dl>
                        <dt><?= htmlspecialchars($row['name']) ?></dt>
                        <dd>MP | NP</dd>
                        <dd><?= number_format($row['price_mp'], 2) ?> | <?= number_format($row['price_np'], 2) ?></dd>
                    </dl>
                    <hr>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</section>

<?php include 'footer.php'; ?>
<?php $conn->close(); ?>
</body>
</html>
