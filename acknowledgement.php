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
    <title>Acknowledgement</title>
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="profile-body">

    <?php include 'navbar.php'; ?>

    <?php
    // Acknowledgement Section
    echo '<section class="acknowledgement">
        <h1>Acknowledgement</h1>
        <div class="acknowledgement-container">';

    // Social Media Acknowledgement
    echo '<div class="social-media-acknowledgement">
            <h3>Brew & Go Accounts</h3>
            <ol>';
    $socialMediaLinks = [
        'https://www.facebook.com/share/18M9JEQBPr/',
        'https://www.instagram.com/brewngo.coffee/'
    ];
    foreach ($socialMediaLinks as $link) {
        echo "<li><a href=\"$link\">$link</a></li>";
    }
    echo '</ol>
        </div>';

    // Icon Acknowledgement
    echo '<div class="icon-acknowledgement">
            <h3>Icon</h3>
            <ol>
                <li><a href="https://boxicons.com/">https://boxicons.com/</a></li>
            </ol>
        </div>';

    // Picture Acknowledgement
    echo '<div class="picture-acknowledgement">
            <h3>Pictures</h3>
            <ol>';
    $pictureLinks = [
        'https://www.nicepng.com/ourpic/u2e6y3u2q8w7t4t4_technology-png-transparent-image-innovation/',
        'https://www.kindpng.com/imgv/ixmxbwJ_login-bg-hd-png-download/',
        'https://www.facebook.com/share/18M9JEQBPr/',
        'https://www.foodpanda.my/restaurant/shkl/brew-and-go-one-jaya-mall',
        'https://images.app.goo.gl/eXMVhTgTooxKNgwN8'
    ];
    foreach ($pictureLinks as $link) {
        echo "<li><a href=\"$link\">$link</a></li>";
    }
    echo '</ol>
        </div>';

    // Website Design Acknowledgement
    echo '<div class="website-design-acknowledgement">
            <h3>Website Design</h3>
            <ol>';
    $designLinks = [
        'https://www.landingfolio.com/inspiration/login',
        'https://youtu.be/YOb67OKw62s?si=PfjPLKLIW4sAlNNY',
        'https://youtu.be/ZdJSHEczi_0?si=fDeMZ98h5gWSWKRv',
        'https://youtu.be/oYRda7UtuhA?si=Adc52eblaH2axJLV',
        'https://www.w3schools.com/Html/',
        'https://zuscoffee.com/bm/menu/'
    ];
    foreach ($designLinks as $link) {
        echo "<li><a href=\"$link\">$link</a></li>";
    }
    echo '</ol>
        </div>';

    echo '</div>
    </section>';
    ?>

    <?php include 'footer.php'; ?>

    <?php
    // End output buffering and flush
    ob_end_flush();
    ?>
</body>
</html>
