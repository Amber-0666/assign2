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
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);

    if ($firstName && $lastName && $email && $phone && $city && $state) {
        $stmt = $mysqli->prepare("INSERT INTO joinus (first_name, last_name, email, phone, city, state) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstName, $lastName, $email, $phone, $city, $state);
        $stmt->execute();
        $stmt->close();

        header("Location: add_success.php?type=joinus");
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
    <title>Add New Applicant</title>
    <link rel="stylesheet" href="styles/style.css" />
</head>
<body>
<div id="add-member-page">
    <h1>Add New Applicant</h1>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form id="register-form" method="POST" action="">
        <div class="form-register-group">
            <div class="form-register-row">
                <div class="form-register-col">
                    <label for="first_name">First Name*</label>
                    <input type="text" id="first_name" name="first_name" required
                        placeholder="Enter first name" pattern="[A-Za-z]{1,25}"
                        maxlength="25" title="Alphabetical characters only, max 25 characters">
                </div>
                <div class="form-register-col">
                    <label for="last_name">Last Name*</label>
                    <input type="text" id="last_name" name="last_name" required
                        placeholder="Enter last name" pattern="[A-Za-z]{1,25}"
                        maxlength="25" title="Alphabetical characters only, max 25 characters">
                </div>
            </div>

            <div class="form-register-row">
                <div class="form-register-col">
                    <label for="email">Email*</label>
                    <input type="email" id="email" name="email" required
                        placeholder="your.email@example.com">
                </div>
                <div class="form-register-col">
                    <label for="phone">Phone*</label>
                    <input type="text" id="phone" name="phone" required
                        placeholder="Enter phone number" pattern="\d{7,15}"
                        title="Numbers only, 7 to 15 digits" maxlength="15">
                </div>
            </div>

            <div class="form-register-row">
                <div class="form-register-col">
                    <label for="city">City*</label>
                    <input type="text" id="city" name="city" required
                        placeholder="Enter city name" pattern="[A-Za-z ]{1,50}"
                        title="City name, max 50 characters" maxlength="50">
                </div>
                <div class="form-register-col">
                    <label for="state">State*</label>
                    <input type="text" id="state" name="state" required
                        placeholder="Enter state name" pattern="[A-Za-z ]{1,50}"
                        title="State name, max 50 characters" maxlength="50">
                </div>
            </div>

            <div class="form-submit-row">
                <button type="submit" class="submit-btn">Submit Application</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
