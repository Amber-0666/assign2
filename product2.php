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
    <title>Artisan Brew</title>
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/style.css">
    <style>
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
        <h1>Artisan Brew</h1>
        <p class="subtitle">Bold and Exciting<br>Discover Our Brew with Many Elements and Twist that Suits Your Taste</p>
    </div>
</header>

<form method="get" class="search-form">
    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search Artisan Brew products...">
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
                    <li class="Artisan_Brew" id="target_page"><a href="product2.php">Artisan Brew</a></li>
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
                <li>&starf; Extra Espresso Shot for RM 2</li>
            </ol> 
        </div>
    </aside>
    
    <div class="product_menu">
        <?php
        if ($hasSearch) {
            $query = "SELECT * FROM products WHERE category = 'Artisan Brew' AND name LIKE ? ORDER BY name";
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
                <figure><a href="#Butterscotch_Latte"><img src="styles/images/Butterscotch_Latte.jpg" alt="Butterscotch Latte"></a></figure>
                <dl>    
                    <dt>Butterscotch Latte</dt>
                    <dd>MP | NP</dd>
                    <dd>11.90 | 13.90</dd>    
                </dl>
                <hr>
            </div>
            <div>
                <figure><a href="#Butterscotch_Creme"><img src="styles/images/Butterscotch_Creme_Latte.jpg" alt="Butterscotch Creme"></a></figure>
                <dl>
                    <dt>Butterscotch Creme</dt>
                    <dd>MP | NP</dd>
                    <dd>14.90 | 16.90</dd>
                </dl>
                <hr>
            </div>
            <div>
                <figure><a href="#Mint_Latte"><img src="styles/images/Mint_Latte.jpg" alt="Mint Latte"></a></figure>
                <dl>
                    <dt>Mint Latte</dt>
                    <dd>MP | NP</dd>
                    <dd>12.90 | 14.90</dd>
                </dl>
                <hr>
            </div>
            <div>
                <figure><a href="#Vienna_Latte"><img src="styles/images/Vienna_Latte.jpg" alt="Vienna Latte"></a></figure>
                <dl>
                    <dt>Vienna Latte</dt>
                    <dd>MP | NP</dd>
                    <dd>14.90 | 16.90</dd>
                </dl>
                <hr>
            </div>
            <div>
                <figure><a href="#Pistachio_Latte"><img src="styles/images/Pistachio_Latte.jpg" alt="Pistachio Latte"></a></figure>
                <dl>
                    <dt>Pistachio Latte</dt>
                    <dd>MP | NP</dd>
                    <dd>15.90 | 17.90</dd>
                </dl>
                <hr>
            </div>
            <div>
                <figure><a href="#Strawberry_Latte"><img src="styles/images/Strawberry_Latte.jpg" alt="Strawberry Latte"></a></figure>
                <dl>
                    <dt>Strawberry Latte</dt>
                    <dd>MP | NP</dd>
                    <dd>14.90 | 16.90</dd>
                </dl>
                <hr>
            </div>
            <div>
                <figure><a href="#Mocha"><img src="styles/images/Mocha.jpg" alt="Mocha"></a></figure>
                <dl>
                    <dt>Mocha</dt>
                    <dd>MP | NP</dd>
                    <dd>11.90 | 13.90</dd>
                </dl>
                <hr>
            </div>
            <div>
                <figure><a href="#Mint_Mocha"><img src="styles/images/No_image.jpg" alt="Mint Mocha"></a></figure>
                <dl>
                    <dt>Mint Mocha</dt>
                    <dd>MP | NP</dd>
                    <dd>12.90 | 14.90</dd>
                </dl>
                <hr>
            </div>
            <div>
                <figure><a href="#Orange_Mocha"><img src="styles/images/Orange_Mocha.jpg" alt="Orange Mocha"></a></figure>
                <dl>    
                    <dt>Orange Mocha</dt>
                    <dd>MP | NP</dd>
                    <dd>12.90 | 14.90</dd>
                </dl>
                <hr>
            </div>
            <div>
                <figure><a href="#Yuzu_Americano"><img src="styles/images/Yuzu_Americano.jpg" alt="Yuzu Americano"></a></figure>
                <dl>
                    <dt>Yuzu Americano</dt>
                    <dd>MP | NP</dd>
                    <dd>13.90 | 15.90</dd>
                </dl>
                <hr>
            </div>
            <div>
                <figure><a href="#Cheese_Americano"><img src="styles/images/Cheese_Americano.jpg" alt="Cheese Americano"></a></figure>
                <dl>
                    <dt>Cheese Americano</dt>
                    <dd>MP | NP</dd>
                    <dd>13.90 | 15.90</dd>
                </dl>
                <hr>
            </div>
            <div>
                <figure><a href="#Orange_Americano"><img src="styles/images/Orange_Americano.jpg" alt="Orange Americano"></a></figure>
                <dl>
                    <dt>Orange Americano</dt>
                    <dd>MP | NP</dd>
                    <dd>13.90 | 15.90</dd>
                </dl>
                <hr>
            </div>

            <!-- STATIC POPUP MODALS -->
            <div id="Butterscotch_Latte" class="overlay">
                <div id="Return_List_ButterscotchLatte" class="pop_up">
                    <a href="#Return_List_ButterscotchLatte" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/Butterscotch_Latte.jpg" alt="Butterscotch Latte">
                        <figcaption>    
                            <p class="pop_up_name">Butterscotch Latte</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">11.90 | 13.90</p>
                            <p class="pop_up_desc">Rich Espresso, Creamy Milk, and Butterscotch Syrup Served Over Ice.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div id="Butterscotch_Creme" class="overlay">
                <div id="Return_List_ButterscotchCreme" class="pop_up">
                    <a href="#Return_List_ButterscotchCreme" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/Butterscotch_Creme_Latte.jpg" alt="Butterscotch Creme">
                        <figcaption>
                            <p class="pop_up_name">Butterscotch Creme</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">14.90 | 16.90</p>
                            <p class="pop_up_desc">Rich Espresso, Creamy Milk, Butterscotch Syrup and Topped with a Creamy Foam.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div id="Mint_Latte" class="overlay">
                <div id="Return_List_MintLatte" class="pop_up">
                    <a href="#Return_List_MintLatte" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/Mint_Latte.jpg" alt="Mint Latte">
                        <figcaption>
                            <p class="pop_up_name">Mint Latte</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">12.90 | 14.90</p>
                            <p class="pop_up_desc">Espresso, Cool Mint, and Creamy Milk Blend and Served Over Ice.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div id="Vienna_Latte" class="overlay">
                <div id="Return_List_ViennaLatte" class="pop_up">
                    <a href="#Return_List_ViennaLatte" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/Vienna_Latte.jpg" alt="Vienna Latte">
                        <figcaption>
                            <p class="pop_up_name">Vienna Latte</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">14.90 | 16.90</p>
                            <p class="pop_up_desc">This Rich and Velvety Drink Combines the Smoothness of Cream with the Robust Flavors of Roasted Nuts and a Hint of Savory Undertones.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div id="Pistachio_Latte" class="overlay">
                <div id="Return_List_PistachioLatte" class="pop_up">
                    <a href="#Return_List_PistachioLatte" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/Pistachio_Latte.jpg" alt="Pistachio Latte">
                        <figcaption>
                            <p class="pop_up_name">Pistachio Latte</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">15.90 | 17.90</p>
                            <p class="pop_up_desc">Chilled Espresso, Creamy Milk, and Pistachio Syrup, Served Over Ice.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div id="Strawberry_Latte" class="overlay">
                <div id="Return_List_StrawberryLatte" class="pop_up">
                    <a href="#Return_List_StrawberryLatte" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/Strawberry_Latte.jpg" alt="Strawberry Latte">
                        <figcaption>
                            <p class="pop_up_name">Strawberry Latte</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">14.90 | 16.90</p>
                            <p class="pop_up_desc">This Vibrant and Refreshing Drink Blends the Zest of Fruits with the Richness of Nuts, Creating a Lively and Invigorating Flavor Experience.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div id="Mocha" class="overlay">
                <div id="Return_List_Mocha" class="pop_up">
                    <a href="#Return_List_Mocha" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/Mocha.jpg" alt="Mocha">
                        <figcaption>
                            <p class="pop_up_name">Mocha</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">11.90 | 13.90</p>
                            <p class="pop_up_desc">Espresso, Milk, and Chocolate Syrup Served Over Ice.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div id="Mint_Mocha" class="overlay">
                <div id="Return_List_MintMocha" class="pop_up">
                    <a href="#Return_List_MintMocha" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/No_image.jpg" alt="Mint Mocha">
                        <figcaption>
                            <p class="pop_up_name">Mint Mocha</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">12.90 | 14.90</p>
                            <p class="pop_up_desc">Espresso, Milk, and Chocolate Syrup Served Over Ice, with Hint of Minty Flavors.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div id="Orange_Mocha" class="overlay">
                <div id="Return_List_OrangeMocha" class="pop_up">
                    <a href="#Return_List_OrangeMocha" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/Orange_Mocha.jpg" alt="Orange Mocha">
                        <figcaption>
                            <p class="pop_up_name">Orange Mocha</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">12.90 | 14.90</p>
                            <p class="pop_up_desc">Espresso, Milk, and Chocolate Syrup Served Over Ice, with Orange Syrup to Finish.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div id="Yuzu_Americano" class="overlay">
                <div id="Return_List_YuzuAmericano" class="pop_up">
                    <a href="#Return_List_YuzuAmericano" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/Yuzu_Americano.jpg" alt="Yuzu Americano">
                        <figcaption>
                            <p class="pop_up_name">Yuzu Americano</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">13.90 | 15.90</p>
                            <p class="pop_up_desc">Chilled Espresso Poured Over Cold Water and Ice Combined with a Zesty and Citrusy Flavor.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div id="Cheese_Americano" class="overlay">
                <div id="Return_List_CheeseAmericano" class="pop_up">
                    <a href="#Return_List_CheeseAmericano" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/Cheese_Americano.jpg" alt="Cheese Americano">
                        <figcaption>
                            <p class="pop_up_name">Cheese Americano</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">13.90 | 15.90</p>
                            <p class="pop_up_desc">Chilled Espresso Poured over Cold Water and Ice with Chessy Cream Foam.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div id="Orange_Americano" class="overlay">
                <div id="Return_List_OrangeAmericano" class="pop_up">
                    <a href="#Return_List_OrangeAmericano" class="close-button">x</a>
                    <figure>
                        <img src="styles/images/Orange_Americano.jpg" alt="Orange Americano">
                        <figcaption>
                            <p class="pop_up_name">Orange Americano</p>
                            <p class="pop_up_member">MP | NP</p>
                            <p class="pop_up_price">13.90 | 15.90</p>
                            <p class="pop_up_desc">Chilled Espresso Poured over Cold Water and Ice with a Fruity Aftertaste.</p>
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