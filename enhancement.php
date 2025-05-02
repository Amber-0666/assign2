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
    <title>Enhancement</title>
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="profile-body">

    <?php include 'navbar.php'; ?>

    <?php
    // Enhancements Section
    echo '<div class="enhancement-container">
        <h1 class="enhancement-title">ENHANCEMENTS</h1>';

    // Enhancements Data
    $enhancements = [
        [
            'title' => 'Automatic Typing',
            'description' => 'Typing animation is added to the homepage to make it more modern and engaging. It creates a real-time typing effect, showing different words one by one as if someone is typing them. This catches the user\'s attention and highlights key messages in a fun and interactive way.',
            'benefits' => [
                'Attracts attention',
                'Makes the website more interactive',
                'Shows important messages clearly',
                'Gives the site a modern look'
            ],
            'usage' => ['Homepage'],
            'video' => 'styles/images/Enhancement(Automatic-typing).mp4',
            'source' => 'https://www.youtube.com/watch?v=yefgBA1CecI'
        ],
        [
            'title' => 'Hamburger Menu',
            'description' => 'The hamburger menu is a responsive navigation solution that automatically appears when the screen size is reduced. It transforms the full navigation bar into a compact three-line icon that expands to show menu items when clicked.',
            'benefits' => [
                'Saves valuable screen space on mobile devices',
                'Provides clean, uncluttered mobile browsing',
                'Maintains all navigation functionality',
                'Follows modern web design standards',
                'Improves mobile user experience significantly'
            ],
            'usage' => ['All pages'],
            'video' => 'styles/images/Hamburger_Enhancement.mp4',
            'source' => 'https://www.youtube.com/watch?v=QQlxvj_GKss'
        ],
        [
            'title' => 'Non-JavaScript Pop-up',
            'description' => 'A non-JavaScript pop-up or overlay is an additional feature that opens up a pop-up to show relevant information based on where the pop-up is opened from. It is created using only HTML and CSS, without relying on JavaScript functions, making it simple and easy to understand for beginners.',
            'benefits' => [
                'Unique interface that attracts viewer attention',
                'Additional area for more relevant details',
                'Gives webpage a modern design',
                'Simple and friendly user interface'
            ],
            'usage' => ['Basic Brew', 'Artisan Brew', 'Non-Coffee', 'Hot Beverages'],
            'video' => 'styles/images/Non-JavaScript_Pop-up.mp4',
            'source' => 'https://www.youtube.com/watch?v=IM3BITYPBd4'
        ],
        [
            'title' => 'Flip Card',
            'description' => 'A flip card effect is incorporated into the design to add a dynamic and interactive touch. It allows users to see additional information as the card flips to reveal its back face when hovered over or clicked.',
            'benefits' => [
                'Enhances user engagement',
                'Provides an interactive experience',
                'Presents information compactly',
                'Adds a modern and sleek design touch'
            ],
            'usage' => ['Homepage', 'Past Activities'],
            'video' => 'styles/images/Flip-Card.mp4',
            'source' => 'https://youtu.be/NCLdf661ILE?si=K_rsfwLCdA_8ucNj'
        ],
        [
            'title' => 'Image Slider',
            'description' => 'An image slider is a web design element that displays multiple images in a sequence, often with smooth transitions like sliding or fading. It allows users to view content interactively, making it ideal for showcasing products, portfolios, or stories in a visually appealing and space-efficient manner.',
            'benefits' => [
                'Attracts user attention with dynamic visuals',
                'Highlights multiple images or content in a compact space',
                'Improves website interactivity and user engagement',
                'Adds a modern and polished appearance to the design',
                'Enables seamless storytelling or showcasing of products'
            ],
            'usage' => ['Past Activities'],
            'video' => 'styles/images/Image-slider.mp4',
            'source' => 'https://youtu.be/1CZhGDU5cWM?si=ljhFvXbK43zor05-'
        ],
        [
            'title' => 'Expanding Image',
            'description' => 'Expanding image functionality allows users to enlarge images for a closer view, enhancing interactivity and providing detailed visual exploration.',
            'benefits' => [
                'Improves user interaction with dynamic visuals',
                'Allows users to explore images in greater detail',
                'Enhances website accessibility and usability',
                'Adds a professional and engaging design element',
                'Creates a visually immersive experience'
            ],
            'usage' => ['Past Activities'],
            'video' => 'styles/images/Expanding-image.mp4',
            'source' => 'https://youtu.be/ly4Dqz2Mz8s?si=MXO9lj7OIpwnRPN-'
        ]
    ];

    // Generate Enhancements
    foreach ($enhancements as $enhancement) {
        echo '<div class="enhancement-content">
            <div class="title-enhancement-content">' . $enhancement['title'] . '</div>
            <div class="enhancement-info">
                <p>' . $enhancement['description'] . '</p>
                <h2><strong>Benefits:</strong></h2>
                <ul>';
        foreach ($enhancement['benefits'] as $benefit) {
            echo '<li>' . $benefit . '</li>';
        }
        echo '</ul>
                <h2><strong>Where it\'s used:</strong></h2>';
        foreach ($enhancement['usage'] as $usage) {
            echo '<a href="index.php" class="enhancement-button">' . $usage . '</a>';
        }
        echo '</div>
            <div class="enhancement-video">
                <p>Here is a video demonstrating the ' . strtolower($enhancement['title']) . ' in action:</p>
                <video class="demo-video" width="560" height="315" controls>
                    <source src="' . $enhancement['video'] . '" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <br>
                <a href="' . $enhancement['source'] . '" target="_blank" class="enhancement-button">Source</a>
            </div>
        </div>';
    }

    echo '</div>';
    ?>

    <?php include 'footer.php'; ?>

    <?php
    // End output buffering and flush
    ob_end_flush();
    ?>
</body>
</html>
