<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'brewngo';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die('Database connection failed: ' . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['register-first-name']);
    $lastName = trim($_POST['register-last-name']);
    $email = trim($_POST['register-email']);
    $loginid = trim($_POST['register-ID']);
    $password = trim($_POST['register-Password']); // plaintext for now
    $fullname = $firstName . ' ' . $lastName;

    if ($fullname && $email && $loginid && $password) {
        $stmt = $mysqli->prepare("INSERT INTO register (fullname, email, loginid, password, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $fullname, $email, $loginid, $password);
        $stmt->execute();
        $stmt->close();

        header("Location: add_success.php");
        exit;
    } else {
        $error = "All fields are required.";
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add New Member</title>
    <link rel="stylesheet" href="styles/style.css" />
</head>
<body>
<div id="add-member-page">
    <h1>Add New Member</h1>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form id="register-form" method="POST" action="">
        <div class="form-register-group">

            <div class="form-register-row">
                <div class="form-register-col">
                    <label for="register-first-name">First Name*</label>
                    <input type="text" id="register-first-name" name="register-first-name" required 
                        placeholder="Enter your first name"
                        pattern="[A-Za-z]{1,25}" 
                        title="Alphabetical characters only, max 25 characters"
                        maxlength="25">
                </div>
                <div class="form-register-col">
                    <label for="register-last-name">Last Name*</label>
                    <input type="text" id="register-last-name" name="register-last-name" required 
                        placeholder="Enter your last name"
                        pattern="[A-Za-z]{1,25}"
                        title="Alphabetical characters only, max 25 characters"
                        maxlength="25">
                </div>
            </div>

            <div class="form-register-row">
                <div class="form-register-col">
                    <label for="register-email">Email Address*</label>
                    <input type="email" id="register-email" name="register-email" required 
                        placeholder="your.email@example.com">
                </div>
                <div class="form-register-col">
                    <label for="register-ID">Login ID*</label>
                    <input type="text" id="register-ID" name="register-ID" required 
                        placeholder="Enter your Login ID"
                        pattern="[A-Za-z]{1,10}" 
                        title="Alphabetical characters only, max 10 characters"
                        maxlength="10">
                </div>
                <div class="form-register-col">
                    <label for="register-Password">Password*</label>
                    <input type="text" id="register-Password" name="register-Password" required 
                        placeholder="Enter your Password"
                        pattern="[A-Za-z]{1,25}" 
                        title="Alphabetical characters only, max 25 characters"
                        maxlength="25">
                </div>
            </div>

            <div class="form-submit-row">
                <button type="submit" class="submit-btn">Register Member</button>
            </div>

        </div>
    </form>
</div>
</body>
</html>
