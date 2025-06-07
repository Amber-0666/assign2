<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start output buffering
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brew&Go Homepage</title>
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="index-body">

    <?php include 'navbar.php'; ?>
    <?php include 'createtable.php'; ?>

    <?php
    // Hero Section
    echo '<section class="index-hero">
        <div class="index-hero-content">
            <h1>Welcome to Brew&Go</h1>
            <h2 class="index-text-flow">
                <span>S</span>
                <span>t</span>
                <span>a</span>
                <span>r</span>
                <span>t</span>
                &ensp;
                <span>y</span>
                <span>o</span>
                <span>u</span>
                <span>r</span>
                &ensp;
                <span>m</span>
                <span>o</span>
                <span>r</span>
                <span>n</span>
                <span>i</span>
                <span>n</span>
                <span>g</span>
                &ensp;
                <span>w</span>
                <span>i</span>
                <span>t</span>
                <span>h</span>
                &ensp;
                <span>u</span>
                <span>s</span>
                <span>!</span>
            </h2>
        </div>
    </section>';

    // About Section
    echo '<section class="index-about">
        <div class="index-about-content">
            <h2>About Us</h2>
            <p>Discover the Magic of Our Cozy Coffee Cart</p>
            <hr>
            <p>Nestled in the heart of the city, our cozy little coffee cart is your new go-to spot for extraordinary coffee experiences!</p>
            <hr>
            <div class="index-container">
                <div class="index-container1">
                    <div class="index-card">
                        <div class="index-front">
                            <img src="styles/images/Drinks.jpg" alt="Drinks">
                        </div>
                        <div class="index-back">
                            <h3 class="index-h3">Indulge in Unique Flavors</h3>
                            <p>Strawberry Latte: A sweet twist on your classic</p>
                            <p>Mint Latte: Refreshing and satisfying</p>
                            <p>Vienna Latte: Rich and creamy</p>
                            <p>Cheese Americano: Bold coffee with a savory kick</p>
                        </div>
                    </div>
                </div>

                <div class="index-container1">
                    <div class="index-card">
                        <div class="index-front">
                            <img src="styles/images/Tarts.jpg" alt="Tarts">
                        </div>
                        <div class="index-back">
                            <h3 class="index-h3">Enjoy our freshly baked mini tarts</h3>
                            <p>Egg tarts</p>
                            <p>Chicken Mushroom tarts</p>
                            <p>Chocolate Almond tarts</p>
                            <p>Fruit tarts</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>';

    // Location Section
    echo '<section class="index-location">
        <h1>Our Location</h1>
        <div class="index-row">
            <div class="index-location-col">
                <a href="https://maps.app.goo.gl/UyZX28i2Wwv7eTpG8" target="_blank"><img src="styles/images/OneJaya.jpg" alt="One Jaya"></a>
                <div class="index-layer">
                    <div class="index-text-in-picture">One Jaya</div>
                </div>
            </div>
            <div class="index-location-col">
                <a href="https://maps.app.goo.gl/oVgoSSdjoLfqubFN8" target="_blank"><img src="styles/images/PlazaMerdeka.jpg" alt="Plaza Merdeka"></a>
                <div class="index-layer">
                    <div class="index-text-in-picture">Plaza Merdeka</div>
                </div>
            </div>
        </div>
    </section>';

    // Footer Section
    echo '<footer class="footer">
        <div class="footer_container">
            <div class="footer_row">
                <div class="footer_logo">
                    <a href="index.php"><img src="styles/images/logo.png" alt="Logo"></a>
                </div>

                <div class="footer-col">
                    <h4 class="footer-h4">TEAM</h4>
                    <ul class="footer_ul">';
                    
    // Team Members
    $teamMembers = [
        'Chua Yong Kang' => 'Chua_profile.php',
        'Roxas Teo Xuan Hao' => 'Roxas_profile.php',
        'Michelle Tan Mei Xuan' => 'Michelle_profile.php',
        'Amberlyn Lim Xi En' => 'Amberlyn_profile.php'
    ];
    
    foreach ($teamMembers as $name => $link) {
        echo "<li><a href=\"$link\">$name</a></li>";
    }
    
    echo '</ul></div>

                <div class="footer-col">
                    <h4 class="footer-h4">PRODUCTS</h4>
                    <ul class="footer_ul">';
                    
    // Products
    $products = [
        'Basic Brew' => 'product1.php',
        'Artisan Brew' => 'product2.php',
        'Non-Coffee' => 'product3.php',
        'Hot Beverages' => 'product4.php'
    ];
    
    foreach ($products as $name => $link) {
        echo "<li><a href=\"$link\">$name</a></li>";
    }
    
    echo '</ul></div>

                <div class="footer-col">
                    <h4 class="footer-h4">ACTIVITIES</h4>
                    <ul class="footer_ul">';
                    
    // Activities
    $activities = [
        'Coming Soon' => 'coming_soon.php',
        'Current Activities' => 'current.php',
        'Past Activities' => 'past_activities.php'
    ];
    
    foreach ($activities as $name => $link) {
        echo "<li><a href=\"$link\">$name</a></li>";
    }
    
    echo '</ul></div>

                <div class="footer-col">
                    <div class="footer-quick-links-1">
                        <h4 class="footer-h4"><a href="joinus.php">JOIN US</a></h4>
                        <h4 class="footer-h4"><a href="enquiry.php">ENQUIRY FORM</a></h4>
                        <h4 class="footer-h4"><a href="registration.php">MEMBERSHIP REGISTRATION</a></h4>
                        <h4 class="footer-h4"><a href="login.php">LOGIN</a></h4>
                    </div>
                </div>

                <div class="footer-col">
                    <div class="footer-quick-links-1">
                        <h4 class="footer-h4"><a href="acknowledgement.php">ACKNOWLEDGEMENT</a></h4>
                        <h4 class="footer-h4"><a href="enhancement.php">ENHANCEMENT</a></h4>
                    </div>
                </div>

                <div class="footer-col">
                    <h4 class="footer-h4">FOLLOW US</h4>
                    <div class="footer-social-links">
                        <a href="https://www.facebook.com/share/18M9JEQBPr/"><i class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/brewngo.coffee/"><i class="bx bxl-instagram"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4 class="footer-h4">CONTACT US FOR ORDER!</h4>
                    <div class="footer-whatsapp">
                        <a href="https://api.whatsapp.com/send?phone=601116531886&text=Hello%2C%20I%20want%20to%20pre-order%20%F0%9F%98%84%0ADate%3A%20%0A%0A1.%20Order%3A%20%0A-%20%0A-%0A%0A2.%20Pick-up%2FDelivery%0APick-up%20Point%20%F0%9F%9B%8D%EF%B8%8F%20%0A%5B%20%5D%20Old%20KPJ%20Hospital%20(opposite%20stutong%20market)%0A%0ADelivery%20%F0%9F%9A%99%20%0A%5B%20%5D%20Jalan%20Song%0A%5B%20%5D%20BDC%20%0A%5B%20%5D%20101%20%0A%5B%20%5D%20Tabuan%20Area%20%0A%5B%20%5D%20Swinburne%20%0A%0A3.%20Time%20%E2%8F%B0%20%0A%5B%20%5D%2011.30am%20%0A%5B%20%5D%2012.30pm%20%0A%5B%20%5D%201.30pm%20%0A%5B%20%5D%202.30pm%20%0A%5B%20%5D%203.30pm%20%0A%5B%20%5D%204pm%20(last%20order)"><i class="bx bx-mobile"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4 class="footer-h5">WATCH OUR VIDEO</h4>
                    <div class="footer-youtube">
                        <a href="https://youtu.be/u86NYtirztY?si=w6qQGdWtdbXLqTXp"><i class="bx bxl-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>';

    // End output buffering and flush
    ob_end_flush();
    ?>
</body>
</html>