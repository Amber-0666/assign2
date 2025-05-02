<?php
    echo '<footer class="footer">
        <div class="footer_container">
            <div class="footer_row">
                <div class="footer_logo">
                    <a href="index.php"><img src="styles/images/logo.png" alt="Logo"></a>
                </div>';

    // Team Section
    echo '<div class="footer-col">
                    <h4 class="footer-h4">TEAM</h4>
                    <ul class="footer_ul">';
    $teamMembers = [
        'Chua Yong Kang' => 'Chua_profile.php',
        'Roxas Teo' => 'Roxas_profile.php',
        'Michelle Tan' => 'Michelle_profile.php',
        'Amberlyn Lim' => 'Amberlyn_profile.php'
    ];
    foreach ($teamMembers as $name => $link) {
        echo "<li><a href=\"$link\">$name</a></li>";
    }
    echo '</ul>
                </div>';

    // Products Section
    echo '<div class="footer-col">
                    <h4 class="footer-h4">PRODUCTS</h4>
                    <ul class="footer_ul">';
    $products = [
        'Basic Brew' => 'product1.php',
        'Artisan Brew' => 'product2.php',
        'Non-Coffee' => 'product3.php',
        'Hot Beverages' => 'product4.php'
    ];
    foreach ($products as $name => $link) {
        echo "<li><a href=\"$link\">$name</a></li>";
    }
    echo '</ul>
                </div>';

    // Activities Section
    echo '<div class="footer-col">
                    <h4 class="footer-h4">ACTIVITIES</h4>
                    <ul class="footer_ul">';
    $activities = [
        'Coming Soon' => 'coming_soon.php',
        'Current Activities' => 'current.php',
        'Past Activities' => 'past_activities.php'
    ];
    foreach ($activities as $name => $link) {
        echo "<li><a href=\"$link\">$name</a></li>";
    }
    echo '</ul>
                </div>';

    // Quick Links Section
    echo '<div class="footer-col">
                    <div class="footer-quick-links-1">
                        <h4 class="footer-h4"><a href="joinus.php">JOIN US</a></h4>
                        <h4 class="footer-h4"><a href="enquiry.php">ENQUIRY FORM</a></h4>
                        <h4 class="footer-h4"><a href="registration.php">MEMBERSHIP REGISTRATION</a></h4>
                        <h4 class="footer-h4"><a href="login.php">LOGIN</a></h4>
                    </div>
                </div>';

    echo '<div class="footer-col">
                    <div class="footer-quick-links-1">
                        <h4 class="footer-h4"><a href="acknowledgement.php">ACKNOWLEDGEMENT</a></h4>
                        <h4 class="footer-h4"><a href="enhancement.php">ENHANCEMENT</a></h4>  
                    </div> 
                </div>';

    // Social Links Section
    echo '<div class="footer-col">
                    <h4 class="footer-h4">FOLLOW US</h4>
                    <div class="footer-social-links">
                        <a href="https://www.facebook.com/share/18M9JEQBPr/"><i class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/brewngo.coffee/"><i class="bx bxl-instagram"></i></a>
                    </div>
                </div>';

    // Contact Section
    echo '<div class="footer-col">
                    <h4 class="footer-h4">CONTACT US FOR ORDER!</h4>
                    <div class="footer-whatsapp">
                        <a href="https://api.whatsapp.com/send?phone=601116531886&text=Hello%2C%20I%20want%20to%20pre-order%20%F0%9F%98%84%0ADate%3A%20%0A%0A1.%20Order%3A%20%0A-%20%0A-%0A%0A2.%20Pick-up%2FDelivery%0APick-up%20Point%20%F0%9F%9B%8D%EF%B8%8F%20%0A%5B%20%5D%20Old%20KPJ%20Hospital%20(opposite%20stutong%20market)%0A%0ADelivery%20%F0%9F%9A%99%20%0A%5B%20%5D%20Jalan%20Song%0A%5B%20%5D%20BDC%20%0A%5B%20%5D%20101%20%0A%5B%20%5D%20Tabuan%20Area%20%0A%5B%20%5D%20Swinburne%20%0A%0A3.%20Time%20%E2%8F%B0%20%0A%5B%20%5D%2011.30am%20%0A%5B%20%5D%2012.30pm%20%0A%5B%20%5D%201.30pm%20%0A%5B%20%5D%202.30pm%20%0A%5B%20%5D%203.30pm%20%0A%5B%20%5D%204pm%20(last%20order)"><i class="bx bx-mobile"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>';

?>
