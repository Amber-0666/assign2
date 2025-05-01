<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Activities</title>
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="current-body">

    <?php include 'navbar.php'; ?>

    <header>
        <div class="header-content">
            <h1>Current Activities</h1>
            <p class="subtitle">Right now, the coffee’s hot and the vibes are even warmer.</p>
        </div>
    </header>

    <aside>
        <div>
            <div class="gallery">
                <div class="gallery-item">
                    <a href="#current-1"><img src="styles/images/Join_membership_rm10_voucher.jpg" alt="Join membership"></a>
                    <div class="gallery-caption">Sign up our membership</div>
                </div>

                <div class="gallery-item">
                    <a href="#current-2"><img src="styles/images/Free_oranges.jpg" alt="Free Oranges"></a>
                    <div class="gallery-caption">Free Oranges</div>
                </div>
            </div>
        </div>
    </aside>

    <section class="current-activities">
        <div class="current-row">
            <dl class="current-col" id="current-1">
                <dt>Sign up our membership
                <img src="styles/images/Join_membership_rm10_voucher.jpg" alt="Join Membership">
                </dt>
                <dd>Say hello to 2025! 
                    <br>And say hello to your new coffee favourite --- us!
                    Get this RM10 voucher when you sign up our membership.
                    Visit us now!
                </dd>
            </dl>

            <dl class="current-col" id="current-2">
                <dt>Free Oranges
                <img src="styles/images/Free_oranges.jpg" alt="Free Oranges">
                </dt>
                <dd>Redeem free oranges from us when you purchase 2 drinks & more.
                    Starting from Saturday, 25 January 2025, and while stocks last.
                    Visit us now!
                </dd>
            </dl>
        </div>
    </section>

    <?php include 'footer.php'; ?>

</body>
</html>