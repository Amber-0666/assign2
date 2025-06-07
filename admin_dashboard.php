<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin UI</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body class="admin-dashboard">

    <?php include 'navbar.php'; ?>

    <aside class="admin_dashboard-aside">
        <h1>Welcome Admin!</h1>
        <p><a href="view_enquiry.php">View Enquiry</a></p>
        <p><a href="view_joinus.php">View Join Us</a></p>
        <p><a href="view_membership.php">View Membership</a></p>
    </aside>

    <main class="admin_dashboard_info">
        <h2>Welcome back, Admin!</h2>
        <p class="admin-msg">
            This is your dashboard, where you can manage all user accounts efficiently. <br>
            From here, you can <strong>add</strong>, <strong>edit</strong>, or <strong>delete</strong> user information, as well as monitor system activity and maintain overall site integrity.
        </p>
        <p class="admin-msg">
            Use the navigation menu beside to access the user management panel, update system settings, or view reports.
        </p>
    </main>

<style>

.admin_dashboard-aside {
    padding: 20px;
    background-color: #e7cdab;
    float: left;
    width: 20%;
    min-height: 100vh;
}

.admin_dashboard-aside h1 {
    font-size: 25px;
    color: brown; 
    margin-bottom: 30px;
    text-align: center;
}

.admin_dashboard-aside a {
    display: block;
    color: white;
    font-size: 20px;
    text-decoration: none;
    margin: 10px 0;
    background-color: brown;
    box-shadow: 0 4px 8px rgba(165, 42, 42, 0.5);
    box-radius: 10px;
    padding: 10px;
    text-align: center;
}

.admin_dashboard-aside a:hover {
    color: red; 
}

.admin_dashboard_info {
    display: flex;
    flex-direction: column;
    justify-content: center;   /* Vertical center */
    align-items: center;       /* Horizontal center */
    width: 80%; 
    height: 100vh;               /* Remaining width after aside (20%) */
    float: left;
    padding: 20px;
    color: black;
}

.admin_dashboard_info h2 {
    font-size: 40px;
    margin-bottom: 20px;
    text-align: center; 
    color: brown; 
}

.admin-msg {
    font-size: 20px;
    text-align: center;
    max-width: 600px;
}


</style>

</body>
</html>
