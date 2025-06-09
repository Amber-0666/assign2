
<?php
// Start session and enable error reporting
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include auto_import first to ensure database exists
include 'auto_import.php';

// Database connection
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verify products table exists
$table_check = $conn->query("SHOW TABLES LIKE 'products'");
if ($table_check->num_rows == 0) {
    die("Products table not found. Please check your database setup.");
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
                displayStaticContent();
            }
        } else {
            displayStaticContent();
        }

        function displayStaticContent() {
            ?>
            <!-- STATIC PRODUCT CARDS -->
            <div>
                <figure><a href="#Americano"><img src="styles/images/No_image.jpg" alt="Americano"></a></figure>
                <dl><dt>Americano</dt><dd>MP | NP</dd><dd>8.90 | 10.90</dd></dl><hr>
            </div>
            <div>
                <figure><a href="#Latte"><img src="styles/images/Latte.jpg" alt="Latte"></a></figure>
                <dl><dt>Latte</dt><dd>MP | NP</dd><dd>10.90 | 12.90</dd></dl><hr>
            </div>
            <div>
                <figure><a href="#Cappuccino"><img src="styles/images/Cappuccino.jpg" alt="Cappuccino"></a></figure>
                <dl><dt>Cappuccino</dt><dd>MP | NP</dd><dd>11.90 | 13.90</dd></dl><hr>
            </div>
            <div>
                <figure><a href="#Aerocano"><img src="styles/images/Aerocano.jpg" alt="Aerocano"></a></figure>
                <dl><dt>Aerocano</dt><dd>MP | NP</dd><dd>10.90 | 12.90</dd></dl><hr>
            </div>
            <div>
                <figure><a href="#Aero-latte"><img src="styles/images/Aero-Latte.jpg" alt="Aero-latte"></a></figure>
                <dl><dt>Aero-latte</dt><dd>MP | NP</dd><dd>12.90 | 14.90</dd></dl><hr>
            </div>

            <!-- STATIC POPUP MODALS -->
            <div id="Americano" class="overlay">
                <div id="Return_List_Americano" class="pop_up">
                    <a href="#Return_List_Americano" class="close-button">x</a>
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
            <div id="Latte" class="overlay">
                <div id="Return_List_Latte" class="pop_up">
                    <a href="#Return_List_Latte" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/Latte.jpg" alt="Latte">
                        <figcaption>
                            <p class="pop_up_name">Latte</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">10.90 | 12.90</p>
                            <p class="pop_up_desc">Espresso Combined with Cold Milk and Ice for a Smooth Sip.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div id="Cappuccino" class="overlay">
                <div id="Return_List_Cappuccino" class="pop_up">
                    <a href="#Return_List_Cappuccino" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/Cappuccino.jpg" alt="Cappuccino">
                        <figcaption>
                            <p class="pop_up_name">Cappuccino</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">11.90 | 13.90</p>
                            <p class="pop_up_desc">Classic Blend of Rich Espresso, with Cold Milk and a Light Foamy Top.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div id="Aerocano" class="overlay">
                <div id="Return_List_Aerocano" class="pop_up">
                    <a href="#Return_List_Aerocano" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/Aerocano.jpg" alt="Aerocano">
                        <figcaption>
                            <p class="pop_up_name">Aerocano</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">10.90 | 12.90</p>
                            <p class="pop_up_desc">Made by Steaming Espresso, Ice and Icy Cold Water to Create a Bold and Silky Aftertaste.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div id="Aero-latte" class="overlay">
                <div id="Return_List_Aero-latte" class="pop_up">
                    <a href="#Return_List_Aero-latte" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/Aero-Latte.jpg" alt="Aero-latte">
                        <figcaption>
                            <p class="pop_up_name">Aero-latte</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">12.90 | 14.90</p>
                            <p class="pop_up_desc">Made by Freshly-brewed Latte, Ice and Icy Cold Water to Create a Smooth and Silky Aftertaste.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>

<?php include 'footer.php'; ?>

</body>
</html>

<?php $conn->close(); ?>
