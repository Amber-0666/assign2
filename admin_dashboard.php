<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin UI</title>
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body id="admin-dashboard">

    <?php include 'navbar.php'; ?>

    <aside id="admin_dashboard-aside">
        <h1>Welcome Admin!</h1>
        <p><a href="view_enquiry.php">View Enquiry</a></p>
        <p><a href="view_joinus.php">View Join Us</a></p>
        <p><a href="view_membership.php">View Membership</a></p>
    </aside>

    <main id="admin_dashboard_info">
        <h2>Welcome back, Admin!</h2>
        <p id="admin-msg">
            This is your dashboard, where you can manage all user accounts efficiently. <br>
            From here, you can <strong>add</strong>, <strong>edit</strong>, or <strong>delete</strong> user information, as well as monitor system activity and maintain overall site integrity.
        </p>
        <p id="admin-msg">
            Use the navigation menu beside to access the user management panel, update system settings, or view reports.
        </p>
    </main>
    
</body>
</html>
