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
    <title>Hot Beverages</title>
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body class="index-body">
    
    <?php include 'navbar.php'; ?>

    <header>
        <div class="header-upper">
            <h1>Hot Beverages</h1>
            <p class="subtitle">Warm and Comforting<br>Try Out Our Hot-beverages</p>
        </div>
    </header>
    
    <form method="get" class="search-form">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search Hot Beverages products...">
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
                        <li class="Basic_Brew"><a href="product1.php">Basic Brew</a></li>
                        <li class="Artisan_Brew"><a href="product2.php">Artisan Brew</a></li>
                        <li class="Non-coffee"><a href="product3.php">Non-coffee</a></li>     
                        <li class="Hot_Beverages" id="target_page"><a href="product4.php">Hot Beverages</a></li>
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
                $query = "SELECT * FROM products WHERE category = 'Hot Beverages' AND name LIKE ? ORDER BY name";
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
                    <dl><dt>Americano</dt><dd>MP | NP</dd><dd>7.90 | 9.90</dd></dl><hr>
                </div>
                <div>
                    <figure><a href="#Latte"><img src="styles/images/No_image.jpg" alt="Latte"></a></figure>
                    <dl><dt>Latte</dt><dd>MP | NP</dd><dd>9.90 | 11.90</dd></dl><hr> 
                </div>
                <div>
                    <figure><a href="#Butterscotch_Latte"><img src="styles/images/No_image.jpg" alt="Butterscotch Latte"></a></figure>
                    <dl><dt>Butterscotch Latte</dt><dd>MP | NP</dd><dd>10.90 | 12.90</dd></dl><hr>
                </div>
                <div>
                    <figure><a href="#Cappuccino"><img src="styles/images/No_image.jpg" alt="Cappuccino"></a></figure>
                    <dl><dt>Cappuccino</dt><dd>MP | NP</dd><dd>10.90 | 12.90</dd></dl><hr>
                </div>
                <div>
                    <figure><a href="#Chocolate"><img src="styles/images/No_image.jpg" alt="Chocolate"></a></figure>
                    <dl><dt>Chocolate</dt><dd>MP | NP</dd><dd>12.90 | 14.90</dd></dl><hr>
                </div>
                <div>
                    <figure><a href="#Yuri_Matcha"><img src="styles/images/No_image.jpg" alt="Yuri Matcha"></a></figure>
                    <dl><dt>Yuri Matcha</dt><dd>MP | NP</dd><dd>13.90 | 14.90</dd></dl><hr>
                </div>
                <div>
                    <figure><a href="#Houjicha"><img src="styles/images/No_image.jpg" alt="Houjicha"></a></figure>
                    <dl><dt>Houjicha</dt><dd>MP | NP</dd><dd>13.90 | 14.90</dd></dl><hr>
                </div>

                <!-- STATIC POPUP MODALS -->
                <div id="Americano" class="overlay">
                    <div id="Return_List_01" class="pop_up">
                        <a href="#Return_List_01" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/No_image.jpg" alt="Americano">
                            <figcaption>
                                <p class="pop_up_name">Americano</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">7.90 | 9.90</p>
                                <p class="pop_up_desc">Espresso Blended with Hot Water for a Smooth, Rich Flavor.</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div id="Latte" class="overlay">
                    <div id="Return_List_02" class="pop_up">
                        <a href="#Return_List_02" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/No_image.jpg" alt="Latte">
                            <figcaption>
                                <p class="pop_up_name">Latte</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">9.90 | 11.90</p>
                                <p class="pop_up_desc">Espresso Mixed with Steamed Milk, Topped with a Light Layer of Foam. Creamy and Comforting.</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div id="Butterscotch_Latte" class="overlay">
                    <div id="Return_List_03" class="pop_up">
                        <a href="#Return_List_03" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/No_image.jpg" alt="Cappucino">
                            <figcaption>
                                <p class="pop_up_name">Butterscotch Latte</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">10.90 | 12.90</p>
                                <p class="pop_up_desc">Espresso Blended with Steamed Milk and Sweet Butterscotch Syrup, Topped with White Foam.</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div id="Cappuccino" class="overlay">
                    <div id="Return_List_04" class="pop_up">
                        <a href="#Return_List_04" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/No_image.jpg" alt="Aerocano">
                            <figcaption>
                                <p class="pop_up_name">Cappuccino</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">10.90 | 12.90</p>
                                <p class="pop_up_desc">Classic Blend of Rich Espresso, Steamed Milk, and a Thick Layer of Velvety Foam.</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div id="Chocolate" class="overlay">
                    <div id="Return_List_05" class="pop_up">
                        <a href="#Return_List_05" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/No_image.jpg" alt="Aero-latte">
                            <figcaption>
                                <p class="pop_up_name">Chocolate</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">12.90 | 14.90</p>
                                <p class="pop_up_desc">Steamed Milk mixed with Chocolate Syrup for a Smooth and Chocolatey Taste.</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div id="Yuri_Matcha" class="overlay">
                    <div id="Return_List_06" class="pop_up">
                        <a href="#Return_List_06" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/No_image.jpg" alt="Aerocano">
                            <figcaption>
                                <p class="pop_up_name">Yuri Matcha</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">13.90 | 14.90</p>
                                <p class="pop_up_desc">Smooth Blend of Premium Matcha and Creamy Milk, Served Hot.</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div id="Houjicha" class="overlay">
                    <div id="Return_List_07" class="pop_up">
                        <a href="#Return_List_07" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/No_image.jpg" alt="Aero-latte">
                            <figcaption>
                                <p class="pop_up_name">Houjicha</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">13.90 | 14.90</p>
                                <p class="pop_up_desc">Roasted Japanese Green Tea</p>
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