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

<!-- Added search form here -->
<form method="get" action="products.php" class="search-form">
    <input type="text" name="search" placeholder="Search product name...">
    <input type="hidden" name="category" value="Basic Brew">
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
        <diV>
            <figure><a href="#Aerocano"><img src="styles/images/Aerocano.jpg" alt="Aerocano"></a></figure>
            <dl>        
                <dt>Aerocano</dt>
                <dd>MP | NP</dd>
                <dd>10.90 | 12.90</dd>
            </dl>    
            <hr>
        </diV>        
      
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
</section>

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
    <div id="Latte" class="overlay">
        <div id="Return_List_02" class="pop_up">
            <a href="#Return_List_02" class="close-button">x</a>
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
        <div id="Return_List_03" class="pop_up">
            <a href="#Return_List_03" class="close-button">x</a>
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
        <div id="Return_List_04" class="pop_up">
            <a href="#Return_List_04" class="close-button">x</a>
            <figure>
                <img src="styles/images/Aerocano.jpg" alt="Aerocano">
                <figcaption>
                    <p class="pop_up_name">Aerocano</p>
                    <p class="pop_up_member">MP | NP</p>
                    <p class="pop_up_price">10.90 | 12.90</p>
                    <p class="pop_up_desc">Made by Steaming Espresso, Ice and Icy Clid Water to Create a Bold and Silky Aftertaste.</p>
                </figcaption>
            </figure>
        </div>
    </div>
    <div id="Aero-latte" class="overlay">
        <div id="Return_List_05" class="pop_up">
            <a href="#Return_List_05" class="close-button">x</a>
            <figure>
                <img src="styles/images/Aero-Latte.jpg" alt="Aero-latte">
                <figcaption>
                    <p class="pop_up_name">Aero-latte</p>
                    <p class="pop_up_member">MP | NP</p>
                    <p class="pop_up_price">12.90 | 14.90</p>
                    <p class="pop_up_desc">Made by Freshly-brewed Latte, Ice and Icy Clid Water to Create a Smooth and Silky Aftertaste.</p>
                </figcaption>
            </figure>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

</body>
</html>