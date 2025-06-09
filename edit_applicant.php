<?php
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
    die('Invalid applicant ID.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);

    if ($first_name && $last_name && $email && $phone && $city && $state) {
        $stmt = $mysqli->prepare("UPDATE joinus SET first_name = ?, last_name = ?, email = ?, phone = ?, city = ?, state = ? WHERE id = ?");
        $stmt->bind_param("ssssssi", $first_name, $last_name, $email, $phone, $city, $state, $id);
        $stmt->execute();
        $stmt->close();

        header("Location: edit_success.php?type=joinus");
        exit;
    } else {
        $error = "All fields are required.";
    }
} else {
    $stmt = $mysqli->prepare("SELECT first_name, last_name, email, phone, city, state FROM joinus WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();

    if (!$data) {
        die("Applicant not found.");
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Applicant</title>
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link rel="stylesheet" href="styles/style.css" />
</head>
<body>
    <div id="edit-page">
        <form method="post" class="edit-form" action="">
            <?php if (!empty($error)): ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <label for="first_name">First Name*</label>
            <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($data['first_name']) ?>" required maxlength="25" pattern="[A-Za-z\s]+" title="Letters only">

            <label for="last_name">Last Name*</label>
            <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($data['last_name']) ?>" required maxlength="25" pattern="[A-Za-z\s]+" title="Letters only">

            <label for="email">Email Address*</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required>

            <label for="phone">Phone*</label>
            <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($data['phone']) ?>" required maxlength="15" pattern="[0-9]+" title="Numbers only">

            <label for="city">City*</label>
            <input type="text" id="city" name="city" value="<?= htmlspecialchars($data['city']) ?>" required maxlength="50">

            <label for="state">State*</label>
            <input type="text" id="state" name="state" value="<?= htmlspecialchars($data['state']) ?>" required maxlength="50">

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>

