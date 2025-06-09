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

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die('Invalid enquiry ID.');
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
        $stmt = $mysqli->prepare("UPDATE enquiry SET first_name=?, last_name=?, email=?, phone=?, street=?, city=?, state=?, postcode=?, enquiry_type=?, message=? WHERE id=?");
        $stmt->bind_param("ssssssssssi", $first_name, $last_name, $email, $phone, $street, $city, $state, $postcode, $enquiry_type, $message, $id);

        if ($stmt->execute()) {
            $stmt->close();
            $mysqli->close();
            header("Location: view_enquiry.php?type=enquiry");
            exit;
        } else {
            $error = "Failed to update enquiry. Please try again.";
        }
    } else {
        $error = "All fields are required.";
    }
} else {
    // Load current data
    $stmt = $mysqli->prepare("SELECT first_name, last_name, email, phone, street, city, state, postcode, enquiry_type, message FROM enquiry WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();

    if (!$data) {
        die("Enquiry not found.");
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Enquiry</title>
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link rel="stylesheet" href="styles/style.css" />
</head>
<body>
    <div id="edit-page">
        <?php if ($error): ?>
            <p style="color:red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post" class="edit-form" action="">
            <label for="first_name">First Name*</label>
            <input type="text" id="first_name" name="first_name" required maxlength="25" pattern="[A-Za-z\s]+" title="Letters only" value="<?= htmlspecialchars($data['first_name']) ?>">

            <label for="last_name">Last Name*</label>
            <input type="text" id="last_name" name="last_name" required maxlength="25" pattern="[A-Za-z\s]+" title="Letters only" value="<?= htmlspecialchars($data['last_name']) ?>">

            <label for="email">Email Address*</label>
            <input type="email" id="email" name="email" required value="<?= htmlspecialchars($data['email']) ?>">

            <label for="phone">Phone*</label>
            <input type="text" id="phone" name="phone" required maxlength="15" pattern="[0-9]+" title="Numbers only" value="<?= htmlspecialchars($data['phone']) ?>">

            <label for="street">Street*</label>
            <input type="text" id="street" name="street" required maxlength="100" value="<?= htmlspecialchars($data['street']) ?>">

            <label for="city">City*</label>
            <input type="text" id="city" name="city" required maxlength="50" value="<?= htmlspecialchars($data['city']) ?>">

            <label for="state">State*</label>
            <input type="text" id="state" name="state" required maxlength="50" value="<?= htmlspecialchars($data['state']) ?>">

            <label for="postcode">Postcode*</label>
            <input type="text" id="postcode" name="postcode" required maxlength="10" pattern="[0-9]+" title="Numbers only" value="<?= htmlspecialchars($data['postcode']) ?>">

            <label for="enquiry_type">Enquiry Type*</label>
            <input type="text" id="enquiry_type" name="enquiry_type" required maxlength="50" value="<?= htmlspecialchars($data['enquiry_type']) ?>">

            <label for="message">Message*</label>
            <textarea id="message" name="message" required maxlength="500" rows="5"><?= htmlspecialchars($data['message']) ?></textarea>

            <button type="submit">Update Enquiry</button>
        </form>
    </div>
</body>
</html>
