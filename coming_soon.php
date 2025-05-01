<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon</title>
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="coming_soon-body">
    
    <?php include 'navbar.php'; ?>

    <header>
        <div class="header-content">
            <h1>Coming Soon</h1>
            <p class="subtitle">New brews, new views — something exciting is always on the horizon.</p>
        </div>
    </header>

    <aside>
        <div class="gallery">
            <div class="gallery-item">
                <a href="#coming_soon-1"><img src="styles/images/Plaza_Merdeka_Opening_Place.jpg" alt="Plaza Merdeka Grand Opening"></a>
                <div class="gallery-caption">Plaza Merdeka Grand Opening</div>
            </div>

            <div class="gallery-item">
                <a href="#coming_soon-2"><img src="styles/images/One_Free_Drink.jpg" alt="One Free Drink"></a>
                <div class="gallery-caption">March Promo</div>
            </div>
        </div>
    </aside>

    <section class="coming_soon-activities">
        <div class="coming_soon-row">
            <dl class="coming_soon-col" id="coming_soon-1">
                <dt>Plaza Merdeka Grand Opening
                    <img src="styles/images/Plaza_Merdeka_Grand_Opening.jpg" alt="Plaza Merdeka Grand Opening">
                </dt>
                <dd>Join us as we mark our new chapter!
                    <br>The Grand Opening of Brew & Go 2.0 happening this 22nd February 2025, Saturday at 10.30am!
                    There will be a lion dance performance and fun lucky draw games.
                    See ya!
                </dd>
            </dl>

            <dl class="coming_soon-col" id="coming_soon-2">
                <dt>March Promo
                    <img src="styles/images/March_promo.png" alt="March Promo">
                </dt>
                <dd>Get 1 FREE drink and 1 RM10 voucher if you topup
                    with a minimum of RM50!
                    Only available at our <a href="https://maps.app.goo.gl/oVgoSSdjoLfqubFN8"><strong>Plaza Merdeka</strong></a> outlet.
                </dd>
            </dl>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    
</body>
</html>