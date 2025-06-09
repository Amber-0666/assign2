<?php
// Start session and enable error reporting
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'auto_import.php'; 

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'brewngo';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Create products table if not exists
$createTableSQL = "CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price_mp DECIMAL(5,2) NOT NULL,
    price_np DECIMAL(5,2) NOT NULL,
    image VARCHAR(255),
    description TEXT,
    UNIQUE KEY name_category (name, category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (!$conn->query($createTableSQL)) {
    die("Error creating products table: " . $conn->error);
}

// 2. Insert sample data if table is empty
$countResult = $conn->query("SELECT COUNT(*) as count FROM products");
if ($countResult === false) {
    die("Error checking products table: " . $conn->error);
}

$row = $countResult->fetch_assoc();
if ($row['count'] == 0) {
    // Insert all products
    $insertSQL = "INSERT INTO products (name, category, price_mp, price_np, image, description) VALUES 
        ('Americano', 'Basic Brew', 8.90, 10.90, 'styles/images/No_image.jpg', 'Chilled Espresso Poured Over Cold Water and Ice for a Bold Flavor.'),
        ('Latte', 'Basic Brew', 10.90, 12.90, 'styles/images/Latte.jpg', 'Espresso Combined with Cold Milk and Ice for a Smooth Sip.'),
        ('Cappuccino', 'Basic Brew', 11.90, 13.90, 'styles/images/Cappuccino.jpg', 'Classic Blend of Rich Espresso, with Cold Milk and a Light Foamy Top.'),
        ('Aerocano', 'Basic Brew', 10.90, 12.90, 'styles/images/Aerocano.jpg', 'Made by Steaming Espresso, Ice and Icy Cold Water to Create a Bold and Silky Aftertaste.'),
        ('Aero-latte', 'Basic Brew', 12.90, 14.90, 'styles/images/Aero-Latte.jpg', 'Made by Freshly-brewed Latte, Ice and Icy Cold Water to Create a Smooth and Silky Aftertaste.'),
        
        ('Butterscotch Latte', 'Artisan Brew', 11.90, 13.90, 'styles/images/Butterscotch_Latte.jpg', 'Rich Espresso, Creamy Milk, and Butterscotch Syrup Served Over Ice.'),
        ('Butterscotch Creme', 'Artisan Brew', 14.90, 16.90, 'styles/images/Butterscotch_Creme_Latte.jpg', 'Rich Espresso, Creamy Milk, Butterscotch Syrup and Topped with a Creamy Foam.'),
        ('Mint Latte', 'Artisan Brew', 12.90, 14.90, 'styles/images/Mint_Latte.jpg', 'Espresso, Cool Mint, and Creamy Milk Blend and Served Over Ice.'),
        ('Vienna Latte', 'Artisan Brew', 14.90, 16.90, 'styles/images/Vienna_Latte.jpg', 'Rich and Velvety Drink Combining Cream with Roasted Nuts and Savory Undertones.'),
        ('Pistachio Latte', 'Artisan Brew', 15.90, 17.90, 'styles/images/Pistachio_Latte.jpg', 'Chilled Espresso, Creamy Milk, and Pistachio Syrup, Served Over Ice.'),
        ('Strawberry Latte', 'Artisan Brew', 14.90, 16.90, 'styles/images/Strawberry_Latte.jpg', 'Blend of Fruits with the Richness of Nuts for Invigorating Flavor.'),
        ('Mocha', 'Artisan Brew', 11.90, 13.90, 'styles/images/Mocha.jpg', 'Espresso, Milk, and Chocolate Syrup Served Over Ice.'),
        ('Mint Mocha', 'Artisan Brew', 12.90, 14.90, 'styles/images/No_image.jpg', 'Espresso, Milk, Chocolate Syrup, and Hint of Minty Flavors.'),
        ('Orange Mocha', 'Artisan Brew', 12.90, 14.90, 'styles/images/Orange_Mocha.jpg', 'Espresso, Milk, Chocolate Syrup, Finished with Orange Syrup.'),
        ('Yuzu Americano', 'Artisan Brew', 13.90, 15.90, 'styles/images/Yuzu_Americano.jpg', 'Chilled Espresso with Cold Water and Ice Combined with Zesty Citrus.'),
        ('Cheese Americano', 'Artisan Brew', 13.90, 15.90, 'styles/images/Cheese_Americano.jpg', 'Chilled Espresso with Cheesy Cream Foam.'),
        ('Orange Americano', 'Artisan Brew', 13.90, 15.90, 'styles/images/Orange_Americano.jpg', 'Chilled Espresso with Fruity Aftertaste.'),
        
        ('Chocolate', 'Non-coffee', 13.90, 15.90, 'styles/images/No_image.jpg', 'Milk Mixed with Chocolate Syrup and Served Cold.'),
        ('Mint Chocolate', 'Non-coffee', 13.90, 15.90, 'styles/images/No_image.jpg', 'Milk Mixed with Chocolate Syrup with Minty Aftertaste.'),
        ('Orange Chocolate', 'Non-coffee', 13.90, 15.90, 'styles/images/No_image.jpg', 'Milk Mixed with Chocolate Syrup and Zesty Orange.'),
        ('Yuzu Soda', 'Non-coffee', 13.90, 15.90, 'styles/images/No_image.jpg', 'Sparkling Drink with Zesty, Tangy, Citrusy Flavor.'),
        ('Strawberry Soda', 'Non-coffee', 13.90, 15.90, 'styles/images/Strawberry_Soda.jpg', 'Fizzy Blend with Strawberry Syrup.'),
        ('Yuzu Cheese', 'Non-coffee', 13.90, 15.90, 'styles/images/Yuzu_Cheese.jpg', 'Tangy Drink with Cheesy Cream Foam.'),
        ('Yuri Matcha', 'Non-coffee', 13.90, 15.90, 'styles/images/Yuri_Matcha.jpg', 'Smooth Blend of Premium Matcha and Creamy Milk.'),
        ('Strawberry Matcha', 'Non-coffee', 14.90, 16.90, 'styles/images/Strawberry_Matcha.jpg', 'Matcha and Creamy Milk with Strawberry Aftertaste.'),
        ('Yuzu Matcha', 'Non-coffee', 14.90, 16.90, 'styles/images/Yuzu_Matcha.jpg', 'Premium Matcha with Creamy Milk and Zesty Syrup.'),
        ('Houjicha', 'Non-coffee', 13.90, 15.90, 'styles/images/Houjicha.jpg', 'Roasted Japanese Green Tea Served With Ice.'),
        
        ('Americano', 'Hot Beverages', 7.90, 9.90, 'styles/images/No_image.jpg', 'Espresso Blended with Hot Water for a Smooth, Rich Flavor.'),
        ('Latte', 'Hot Beverages', 9.90, 11.90, 'styles/images/No_image.jpg', 'Espresso Mixed with Steamed Milk, Topped with Foam.'),
        ('Butterscotch Latte', 'Hot Beverages', 10.90, 12.90, 'styles/images/No_image.jpg', 'Espresso, Steamed Milk and Butterscotch Syrup, Topped with Foam.'),
        ('Cappuccino', 'Hot Beverages', 10.90, 12.90, 'styles/images/No_image.jpg', 'Rich Espresso, Steamed Milk, Thick Velvety Foam.'),
        ('Chocolate', 'Hot Beverages', 12.90, 14.90, 'styles/images/No_image.jpg', 'Steamed Milk mixed with Chocolate Syrup.'),
        ('Yuri Matcha', 'Hot Beverages', 13.90, 14.90, 'styles/images/No_image.jpg', 'Premium Matcha and Creamy Milk, Served Hot.'),
        ('Houjicha', 'Hot Beverages', 13.90, 14.90, 'styles/images/No_image.jpg', 'Roasted Japanese Green Tea.')
    ";

    if (!$conn->query($insertSQL)) {
        die("Error inserting products: " . $conn->error);
    }
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
</head>

<body class="index-body">
    
<?php include 'navbar.php'; ?>

<header>
    <div class="header-upper">
        <h1>Basic Brew</h1>
        <p class="subtitle">Balanced and Delightful<br>Find out Our Homemade Coffee, Complemented with Rich Aroma and Flavor</p>
    </div>
</header>

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
            $query = "SELECT * FROM products WHERE category = 'Basic Brew' AND name LIKE ? ORDER BY name";
            $searchParam = "%$search%";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $searchParam);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $productId = str_replace(' ', '', $row['name']);
                    echo '<div>
                        <figure><a href="#'.$productId.'"><img src="'.$row['image'].'" alt="'.$row['name'].'"></a></figure>
                        <dl>    
                            <dt>'.$row['name'].'</dt>
                            <dd>MP | NP</dd>
                            <dd>'.$row['price_mp'].' | '.$row['price_np'].'</dd>
                        </dl>
                        <hr>
                    </div>';
                    
                    echo '<div id="'.$productId.'" class="overlay">
                        <div id="Return_List_'.$productId.'" class="pop_up">
                            <a href="#Return_List_'.$productId.'" class="close-button">x</a>
                            <figure>
                                <img src="'.$row['image'].'" alt="'.$row['name'].'">
                                <figcaption>
                                    <p class="pop_up_name">'.$row['name'].'</p>
                                    <p class="pop_up_member">MP | NP</p>
                                    <p class="pop_up_price">'.$row['price_mp'].' | '.$row['price_np'].'</p>
                                    <p class="pop_up_desc">'.$row['description'].'</p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>';
                }
            } else {
                echo '<div style="grid-column: 1/-1; text-align:center;">
                    <p class="no-results">No products found matching "'.htmlspecialchars($search).'"</p>
                </div>';
            }
        }
        
        // Always display Basic Brew products (filtered by category)
        $query = "SELECT * FROM products WHERE category = 'Basic Brew' ORDER BY name";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productId = str_replace(' ', '', $row['name']);
                echo '<div>
                    <figure><a href="#'.$productId.'"><img src="'.$row['image'].'" alt="'.$row['name'].'"></a></figure>
                    <dl>    
                        <dt>'.$row['name'].'</dt>
                        <dd>MP | NP</dd>
                        <dd>'.$row['price_mp'].' | '.$row['price_np'].'</dd>
                    </dl>
                    <hr>
                </div>';
                
                echo '<div id="'.$productId.'" class="overlay">
                    <div id="Return_List_'.$productId.'" class="pop_up">
                        <a href="#Return_List_'.$productId.'" class="close-button">x</a>
                        <figure>
                            <img src="'.$row['image'].'" alt="'.$row['name'].'">
                            <figcaption>
                                <p class="pop_up_name">'.$row['name'].'</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">'.$row['price_mp'].' | '.$row['price_np'].'</p>
                                <p class="pop_up_desc">'.$row['description'].'</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>';
            }
        }
        ?>
    </div>
</section>

<?php include 'footer.php'; ?>

</body>
</html>

<?php $conn->close(); ?>