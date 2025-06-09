


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

// Get search filter
$search = $_GET['search'] ?? '';
$hasSearch = !empty($search);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Non-coffee</title>
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body class="index-body">
    
    <?php include 'navbar.php'; ?>

    <header>
        <div class="header-upper">
            <h1>Non-coffee</h1>
            <p class="subtitle">Caffeine-free and Refreshing<br>Discover Our Non-coffee Series</p>
        </div>
    </header>

    <form method="get" class="search-form">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search Non-coffee products...">
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
                        <li class="Non-coffee" id="target_page"><a href="product3.php">Non-coffee</a></li>     
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
                $query = "SELECT * FROM products WHERE category = 'Non-coffee' AND name LIKE ? ORDER BY name";
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
                    <figure><a href="#Chocolate"><img src="styles/images/No_image.jpg" alt="Chocolate"></a></figure>
                    <dl>
                        <dt>Chocolate</dt>
                        <dd>MP | NP</dd>
                        <dd>13.90 | 15.90</dd>  
                    </dl>
                    <hr>
                </div>
                <diV>
                    <figure><a href="#Mint_Chocolate"><img src="styles/images/No_image.jpg" alt="Mint Chocolate"></a></figure>
                    <dl>
                        <dt>Mint Chocolate</dt>
                        <dd>MP | NP</dd>
                        <dd>13.90 | 15.90</dd>
                    </dl>
                    <hr>
                </diV>
                <div>
                    <figure><a href="#Orange_Chocolate"><img src="styles/images/No_image.jpg" alt="Orange Chocolate"></a></figure>
                    <dl> 
                        <dt>Orange Chocolate</dt>
                        <dd>MP | NP</dd>
                        <dd>13.90 | 15.90</dd>
                    </dl>
                    <hr>
                </div>
                <div>
                    <figure><a href="#Yuzu_Soda"><img src="styles/images/No_image.jpg" alt="Yuzu Soda"></a></figure>
                    <dl> 
                        <dt>Yuzu Soda</dt>
                        <dd>MP | NP</dd>
                        <dd>13.90 | 15.90</dd>
                    </dl>
                    <hr>
                </div>
                <div>
                    <figure><a href="#Strawberry_Soda"><img src="styles/images/Strawberry_Soda.jpg" alt="Strawberry Soda"></a></figure>
                    <dl>
                        <dt>Strawberry Soda</dt>
                        <dd>MP | NP</dd>
                        <dd>13.90 | 15.90</dd>
                    </dl>
                    <hr>
                </div>
                <div>
                    <figure><a href="#Yuzu_Cheese"><img src="styles/images/Yuzu_Cheese.jpg" alt="Yuzu Cheese"></a></figure>
                    <dl>
                        <dt>Yuzu Cheese</dt>
                        <dd>MP | NP</dd>
                        <dd>13.90 | 15.90</dd>
                    </dl>
                    <hr>
                </div>
                <div>
                    <figure><a href="#Yuri_Matcha"><img src="styles/images/Yuri_Matcha.jpg" alt="Yuri Matcha"></a></figure>
                    <dl>
                        <dt>Yuri Matcha</dt>
                        <dd>MP | NP</dd>
                        <dd>13.90 | 15.90</dd>
                    </dl>
                    <hr>
                </div>
                <div>
                    <figure><a href="#Strawberry_Matcha"><img src="styles/images/Strawberry_Matcha.jpg" alt="Strawberry Matcha"></a></figure>
                    <dl>
                        <dt>Strawberry Matcha</dt>
                        <dd>MP | NP</dd>
                        <dd>14.90 | 16.90</dd>
                    </dl>
                    <hr>
                </div>
                <div>
                    <figure><a href="#Yuzu_Matcha"><img src="styles/images/Yuzu_Matcha.jpg" alt="Yuzu Matcha"></a></figure>
                    <dl>
                        <dt>Yuzu Matcha</dt>
                        <dd>MP | NP</dd>
                        <dd>14.90 | 16.90</dd>
                    </dl>
                    <hr>
                </div>
                <div>
                    <figure><a href="#Houjicha"><img src="styles/images/Houjicha.jpg" alt="Houjicha"></a></figure>
                    <dl>
                        <dt>Houjicha</dt>
                        <dd>MP | NP</dd>
                        <dd>13.90 | 15.90</dd>
                    </dl>
                    <hr>
                </div>

                <!-- STATIC POPUP MODALS -->
                <div id="Chocolate" class="overlay">
                    <div id="Return_List_Chocolate" class="pop_up">
                        <a href="#Return_List_Chocolate" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/No_image.jpg" alt="Chocolate">
                            <figcaption>
                                <p class="pop_up_name">Chocolate</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">13.90 | 15.90</p>
                                <p class="pop_up_desc">Milk Mixed with Chocolate Syrup and Served Cold.</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div id="Mint_Chocolate" class="overlay">
                    <div id="Return_List_Mint_Chocolate" class="pop_up">
                        <a href="#Return_List_Mint_Chocolate" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/No_image.jpg" alt="Mint Chocolate">
                            <figcaption>
                                <p class="pop_up_name">Mint Chocolate</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">13.90 | 15.90</p>
                                <p class="pop_up_desc">Milk Mixed with Chocolate Syrup and Served Cold, with a Minty Aftertaste.</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div id="Orange_Chocolate" class="overlay">
                    <div id="Return_List_Orange_Chocolate" class="pop_up">
                        <a href="#Return_List_Orange_Chocolate" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/No_image.jpg" alt="Orange Chocolate">
                            <figcaption>
                                <p class="pop_up_name">Orange Chocolate</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">13.90 | 15.90</p>
                                <p class="pop_up_desc">Milk Mixed with Chocolate Syrup and Served Cold, with a Zesty Aftertaste.</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div id="Yuzu_Soda" class="overlay">
                    <div id="Return_List_Yuzu_Soda" class="pop_up">
                        <a href="#Return_List_Yuzu_Soda" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/No_image.jpg" alt="Yuzu Soda">
                            <figcaption>
                                <p class="pop_up_name">Yuzu Soda</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">13.90 | 15.90</p>
                                <p class="pop_up_desc">A Sparkling Drink with Zesty, Tangy and Citrusy Flavor.</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div id="Strawberry_Soda" class="overlay">
                    <div id="Return_List_Strawberry_Soda" class="pop_up">
                        <a href="#Return_List_Strawberry_Soda" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/Strawberry_Soda.jpg" alt="Strawberry Soda">
                            <figcaption>
                                <p class="pop_up_name">Strawberry Soda</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">13.90 | 15.90</p>
                                <p class="pop_up_desc">Fizzy Blend with Strawberry Syrup for a Fruity Aftertaste.</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div id="Yuzu_Cheese" class="overlay">
                    <div id="Return_List_Yuzu_Cheese" class="pop_up">
                        <a href="#Return_List_Yuzu_Cheese" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/Yuzu_Cheese.jpg" alt="Yuzu Cheese">
                            <figcaption>
                                <p class="pop_up_name">Yuzu Cheese</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">13.90 | 15.90</p>
                                <p class="pop_up_desc">A Tangy Drink with Cheesy Cream Foam on Top.</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div id="Yuri_Matcha" class="overlay">
                    <div id="Return_List_Yuri_Matcha" class="pop_up">
                        <a href="#Return_List_Yuri_Matcha" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/Yuri_Matcha.jpg" alt="Yuri Matcha">
                            <figcaption>
                                <p class="pop_up_name">Yuri Matcha</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">13.90 | 15.90</p>
                                <p class="pop_up_desc">Smooth Blend of Premium Matcha and Creamy Milk</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div id="Strawberry_Matcha" class="overlay">
                    <div id="Return_List_Strawberry_Matcha" class="pop_up">
                        <a href="#Return_List_Strawberry_Matcha" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/Strawberry_Matcha.jpg" alt="Strawberry Matcha">
                            <figcaption>
                                <p class="pop_up_name">Strawberry Matcha</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">14.90 | 16.90</p>
                                <p class="pop_up_desc">Smooth Blend of Premium Matcha and Creamy Milk, with Strawberry Aftertaste.</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div id="Yuzu_Matcha" class="overlay">
                    <div id="Return_List_Yuzu_Matcha" class="pop_up">
                        <a href="#Return_List_Yuzu_Matcha" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/Yuzu_Matcha.jpg" alt="Yuzu Matcha">
                            <figcaption>
                                <p class="pop_up_name">Yuzu Matcha</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">14.90 | 16.90</p>
                                <p class="pop_up_desc">Premium Matcha Drink with Creamy Milk and Zesty Syrup.</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div id="Houjicha" class="overlay">
                    <div id="Return_List_Houjicha" class="pop_up">
                        <a href="#Return_List_Houjicha" class="close-button">x</a>
                        <figure>
                            <img src="styles/images/Houjicha.jpg" alt="Houjicha">
                            <figcaption>
                                <p class="pop_up_name">Houjicha</p>
                                <p class="pop_up_member">MP | NP</p>
                                <p class="pop_up_price">13.90 | 15.90</p>
                                <p class="pop_up_desc">Roasted Japanese Green Tea Served With Ice.</p>
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