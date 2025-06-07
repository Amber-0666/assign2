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

// Get search filter
$search = $_GET['search'] ?? '';
$hasSearch = !empty($search);
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
        /* Search form styling that matches original design */
        .search-form {
            margin: 20px auto;
            text-align: center;
            max-width: 500px;
        }
        .search-form input[type="text"] {
            padding: 10px 15px;
            width: 60%;
            border-radius: 20px;
            border: 1px solid #7a3e3e;
            font-family: inherit;
            font-size: 14px;
        }
        .search-form button {
            padding: 10px 20px;
            background-color: #7a3e3e;
            color: white;
            border: none;
            border-radius: 20px;
            margin-left: 10px;
            cursor: pointer;
            font-family: inherit;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .search-form button:hover {
            background-color: #5a2e2e;
            transform: translateY(-2px);
        }
        .no-results {
            text-align: center;
            color: #7a3e3e;
            font-style: italic;
            margin: 20px 0;
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

<!-- Added search form - matches original aesthetic -->
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
    
    <div class="product_menu">
        <?php
        if ($hasSearch) {
            // Search database if there's a search term
            $query = "SELECT * FROM products WHERE category = 'Basic Brew' AND name LIKE ? ORDER BY name";
            $searchParam = "%$search%";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $searchParam);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div>
                        <figure><a href="#'.str_replace(' ', '', $row['name']).'"><img src="'.$row['image'].'" alt="'.$row['name'].'"></a></figure>
                        <dl>    
                            <dt>'.$row['name'].'</dt>
                            <dd>MP | NP</dd>
                            <dd>'.$row['price_mp'].' | '.$row['price_np'].'</dd>
                        </dl>
                        <hr>
                    </div>';
                }
            } else {
                echo '<div style="grid-column: 1/-1; text-align:center;">
                    <p class="no-results">No products found matching "'.htmlspecialchars($search).'"</p>
                </div>';
                // Show original content after no results message
                include 'original_basic_brew_products.php';
            }
        } else {
            // Show original content when no search
            include 'original_basic_brew_products.php';
        }
        ?>
    </div>
</section>

<?php include 'footer.php'; ?>

</body>
</html>
<?php $conn->close(); ?>