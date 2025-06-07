<?php
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<?php
// Define navigation structure
$navItems = [
    'PRODUCTS' => [
        'Basic Brew' => 'product1.php',
        'Artisan Brew' => 'product2.php',
        'Non-Coffee' => 'product3.php',
        'Hot Beverages' => 'product4.php'
    ],
    'ACTIVITIES' => [
        'Coming Soon' => 'coming_soon.php',
        'Current Activities' => 'current.php',
        'Past Activities' => 'past_activities.php'
    ],
    'JOIN US' => 'joinus.php',
    'ENQUIRY FORM' => 'enquiry.php',
    'MEMBERSHIP REGISTRATION' => 'registration.php'
];

$currentPage = basename($_SERVER['PHP_SELF']);

function isDropdownActive($items, $currentPage) {
    if (is_array($items)) {
        return in_array($currentPage, $items) ? 'active' : '';
    }
    return ($currentPage === $items) ? 'active' : '';
}
?>
<!-- Stop PHP code here - the rest is HTML -->
<nav class="navbar">
    <div class="nav-logo">
        <a href="index.php"><img src="styles/images/logo.png" alt="Logo"></a>
    </div>
    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <label for="nav-toggle" class="nav-toggle-label">
        <span></span>
        <span></span>
        <span></span>
    </label>
    <ul class="nav-menu">
        <?php foreach ($navItems as $label => $item): ?>
            <?php if (is_array($item)): ?>
                <li class="nav-dropdown <?= isDropdownActive($item, $currentPage) ?>">
                    <a href="#" class="nav-dropbtn"><?= $label ?></a>
                    <div class="nav-dropdown-content">
                        <?php foreach ($item as $subLabel => $url): ?>
                            <a href="<?= $url ?>" class="<?= ($currentPage === $url) ? 'active' : '' ?>">
                                <?= $subLabel ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </li>
            <?php else: ?>
                <li class="<?= ($currentPage === $item) ? 'active' : '' ?>">
                    <a href="<?= $item ?>"><?= $label ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if (isset($_SESSION['admin-ID'])): 
            $adminname = htmlspecialchars($_SESSION['admin-ID']); 
        ?>
            <li><a href="logout.php">LOGOUT</a></li>
            <li><a href=""><?= strtoupper($adminname) ?></a></li>
        <?php elseif (isset($_SESSION['register-ID'])): 
            $username = htmlspecialchars($_SESSION['register-ID']);
        ?>
            <li><a href="logout.php">LOGOUT</a></li>
            <li><a href="login_profile.php"><?= strtoupper($username) ?></a></li>
        <?php else: ?>
            <li class="<?= ($currentPage === 'login.php') ? 'active' : '' ?>"><a href="login.php">LOGIN</a></li>
        <?php endif; ?>
    </ul>
</nav>
<!-- File ends here - no closing PHP tag needed -->