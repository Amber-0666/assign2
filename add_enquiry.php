<?php
// Database config
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'brewngo';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die('Database connection failed: ' . $mysqli->connect_error);
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $street = trim($_POST['street'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $state = trim($_POST['state'] ?? '');
    $postcode = trim($_POST['postcode'] ?? '');
    $enquiry_type = trim($_POST['enquiry_type'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($first_name && $last_name && $email && $phone && $street && $city && $state && $postcode && $enquiry_type && $message) {
        $stmt = $mysqli->prepare("INSERT INTO enquiry (first_name, last_name, email, phone, street, city, state, postcode, enquiry_type, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $first_name, $last_name, $email, $phone, $street, $city, $state, $postcode, $enquiry_type, $message);

        if ($stmt->execute()) {
            $stmt->close();
            $mysqli->close();
            header("Location: view_enquiry.php?type=enquiry");
            exit;
        } else {
            $error = "Failed to add enquiry. Please try again.";
        }
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add New Enquiry</title>
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link rel="stylesheet" href="styles/style.css" />
</head>
<body>
    <div id="add-member-page">
        <h1>Add New Enquiry</h1>
        <?php if ($error): ?>
            <p style="color:red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form id="register-form" method="post" action="">
            <div class="form-register-group">
                <div class="form-register-row">
                    <div class="form-register-col">
                        <label for="first_name">First Name*</label>
                        <input type="text" id="first_name" name="first_name" required maxlength="25" pattern="[A-Za-z\s]+" title="Letters only">
                    </div>
                    <div class="form-register-col">
                        <label for="last_name">Last Name*</label>
                        <input type="text" id="last_name" name="last_name" required maxlength="25" pattern="[A-Za-z\s]+" title="Letters only">
                    </div>
                </div>

                <div class="form-register-row">
                    <div class="form-register-col">
                        <label for="email">Email Address*</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-register-col">
                        <label for="phone">Phone*</label>
                        <input type="text" id="phone" name="phone" required maxlength="15" pattern="[0-9]+" title="Numbers only">
                    </div>
                </div>

                <div class="form-register-row">
                    <div class="form-register-col">
                        <label for="street">Street*</label>
                        <input type="text" id="street" name="street" required maxlength="100">
                    </div>
                    <div class="form-register-col">
                        <label for="city">City*</label>
                        <input type="text" id="city" name="city" required maxlength="50">
                    </div>
                </div>

                <div class="form-register-row">
                    <div class="form-register-col">
                        <label for="state">State*</label>
                        <input type="text" id="state" name="state" required maxlength="50">
                    </div>
                    <div class="form-register-col">
                        <label for="postcode">Postcode*</label>
                        <input type="text" id="postcode" name="postcode" required maxlength="10" pattern="[0-9]+" title="Numbers only">
                    </div>
                </div>

                <div class="form-register-row">
                    <div class="form-register-col">
                        <label for="enquiry_type">Enquiry Type*</label>
                        <input type="text" id="enquiry_type" name="enquiry_type" required maxlength="50">
                    </div>
                    <div class="form-register-col">
                        <label for="message">Message*</label>
                        <textarea id="message" name="message" required maxlength="500" rows="5"></textarea>
                    </div>
                </div>

                <div class="form-submit-row">
                    <button type="submit" class="submit-btn">Add Enquiry</button>
                </div>
            </div>
        </form>

    </div>
</body>
</html>
