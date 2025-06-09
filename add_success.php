<?php
// PHP logic for redirection based on URL parameter
$redirectTo = "view_membership.php";

if (isset($_GET['type'])) {
    if ($_GET['type'] === 'enquiry') {
        $redirectTo = "view_enquiry.php";
    } elseif ($_GET['type'] === 'joinus') {
        $redirectTo = "view_joinus.php";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Update Successful</title>
    <meta http-equiv="refresh" content="3;url=<?= $redirectTo ?>" />
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link rel="stylesheet" href="styles/style.css" />
</head>
<body>
    <div id="edit-success-page">
        <div class="message-box">
            <h1>Member registered successfully!</h1>
            <p>You will be redirected shortly...</p>
        </div>
    </div>
</body>
</html>
