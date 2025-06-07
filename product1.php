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

// Get search filter (we'll hardcode category to "Basic Brew" for this page)
$search = $_GET['search'] ?? '';
$category = "Basic Brew"; // Fixed for this page

// Build query dynamically
$query = "SELECT * FROM products WHERE category = ? ";
$params = [$category];
$types = "s";

if (!empty($search)) {
    $query .= "AND name LIKE ? ";
    $params[] = "%$search%";
    $types .= "s";
}

$query .= "ORDER BY name";
$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Brew</title>
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/style.css">
    <style>
        .search-form {
            margin: 20px auto;
            text-align: center;
        }
        .search-form input[type="text"] {
            padding: 10px;
            width: 250px;
            border-radius: 5px;
            border: 1px solid #aaa;
        }
        .search-form button {
            padding: 10px 20px;
            background-color: #7a3e3e;
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .search-form button:hover {
            background-color: #5a2e2e;
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

<!-- Search form -->
<form method="get" class="search-form">
    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search Basic Brew products...">
    <button type="submit">Search</button>
</form>

<section class="product_sidebar">
    <aside>
        <div class="product_nav">
        <p>LIST</p> 
        <hr>
        <br>
            <nav class="product_selection">
                <ul>
                    <li class="Basic_Brew" id="target_page"><a href="product1.php">Basic Brew</a></li>
                    <li class="Artisan_Brew"><a href="product2.php">Artisan Brew</a></li>
                    <li class="Non-coffee"><a href="product3.php">Non-coffee</a></li>     
                    <li class="Hot_Beverages"><a href="product4.php">Hot Beverages</a></li>
                </ul>
                <hr>
                <br>
            </nav>
            <ol class="product_extra">
                <li>&starf; MP : Member Price / NP : Normal Price</li>
                <li>&starf; All Price are in Ringgit Malaysia (RM)</li>
                <li>&starf; Add on RM 2 for Oat Milk</li>
            </ol> 
        </div>
    </aside>
    
    <!-- Dynamic product listing from database -->
    <?php if ($result && $result->num_rows > 0): ?>
        <div class="products-grid">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                    <h3><?= htmlspecialchars($row['name']) ?></h3>
                    <p><strong>Price:</strong> RM <?= $row['price_mp'] ?> (MP) | RM <?= $row['price_np'] ?> (NP)</p>
                    <p><?= htmlspecialchars($row['description']) ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="product_menu">
            <!-- Fallback to original static content if no search or no results -->
            <div>
                <figure><a href="#Americano"><img src="styles/images/No_image.jpg" alt="Americano"></a></figure>
                <dl>    
                    <dt>Americano</dt>
                    <dd>MP | NP</dd>
                    <dd>8.90 | 10.90</dd>
                </dl>
                <hr>
            </div>
            <div>
                <figure><a href="#Latte"><img src="styles/images/Latte.jpg" alt="Latte"></a></figure>
                <dl>    
                    <dt>Latte</dt>
                    <dd>MP | NP</dd>
                    <dd>10.90 | 12.90</dd>
                </dl>
                <hr>
            </div>
            <div>
                <figure><a href="#Cappuccino"><img src="styles/images/Cappuccino.jpg" alt="Cappuccino"></a></figure>
                <dl>    
                    <dt>Cappuccino</dt>
                    <dd>MP | NP</dd>
                    <dd>11.90 | 13.90</dd>
                </dl>
                <hr>
            </div>
            <div>
                <figure><a href="#Aerocano"><img src="styles/images/Aerocano.jpg" alt="Aerocano"></a></figure>
                <dl>        
                    <dt>Aerocano</dt>
                    <dd>MP | NP</dd>
                    <dd>10.90 | 12.90</dd>
                </dl>    
                <hr>
            </div>        
            <div>
                <figure><a href="#Aero-latte"><img src="styles/images/Aero-Latte.jpg" alt="Aero-latte"></a></figure>
                <dl>    
                    <dt>Aero-latte</dt>
                    <dd>MP | NP</dd>
                    <dd>12.90 | 14.90</dd>
                </dl>    
                <hr>
            </div>
        </div>
    <?php endif; ?>
</section>

<!-- Original popup details sections -->
<section class="product_details">
    <div id="Americano" class="overlay">
        <div id="Return_List_01" class="pop_up">
            <a href="#Return_List_01" class="close-button">x</a>
            <figure>
                <img src="styles/images/No_image.jpg" alt="Americano">
                <figcaption>
                    <p class="pop_up_name">Americano</p>
                    <p class="pop_up_member">MP | NP</p>
                    <p class="pop_up_price">8.90 | 10.90</p>
                    <p class="pop_up_desc">Chilled Espresso Poured Over Cold Water and Ice for a Bold Flavor.</p>
                </figcaption>
            </figure>
        </div>
    </div>
    <!-- Other popup sections remain unchanged -->
</section>

<?php include 'footer.php'; ?>

</body>
</html>

<?php $conn->close(); ?>