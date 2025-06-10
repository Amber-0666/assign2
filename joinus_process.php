<?php

session_start();  

// === Enable error reporting for debugging ===
error_reporting(E_ALL);
ini_set('display_errors', 1);

// === Connect to DB ===
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'brewngo'; 

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die('DB Connection failed: ' . $mysqli->connect_error);
}

// Sanitize and validate input
$firstName = htmlspecialchars($_POST['first-name'] ?? '');
$lastName = htmlspecialchars($_POST['last-name'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$phone = preg_match('/^[0-9]{10}$/', $_POST['phone'] ?? '') ? $_POST['phone'] : '';
$street = htmlspecialchars($_POST['street'] ?? '');
$city = htmlspecialchars($_POST['city'] ?? '');
$state = htmlspecialchars($_POST['state'] ?? '');
$postcode = preg_match('/^[0-9]{5}$/', $_POST['postcode'] ?? '') ? $_POST['postcode'] : '';

$cvFileName = 'No file uploaded';
$photoFileName = 'No file uploaded';

$errors = [];
if (!$firstName || !$lastName || !$email || !$phone || !$street || !$city || !$state || !$postcode) {
    $errors[] = 'All fields must be filled in with valid data.';
}

// === Handle CV Upload ===
if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
    $cvFileType = mime_content_type($_FILES['cv']['tmp_name']);
    if ($cvFileType !== 'application/pdf') {
        $errors[] = 'CV must be a PDF file.';
    } else {
        $cvDir = 'uploads/cv/';
        if (!file_exists($cvDir)) mkdir($cvDir, 0777, true);
        $cvFileName = uniqid('cv_') . '_' . basename($_FILES['cv']['name']);
        move_uploaded_file($_FILES['cv']['tmp_name'], $cvDir . $cvFileName);
    }
} else {
    $errors[] = 'CV file upload error.';
}

// === Handle Photo Upload ===
$maxPhotoSize = 200 * 1024; // 200KB

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    if ($_FILES['photo']['size'] > $maxPhotoSize) {
        $errors[] = 'Photo file exceeds the 200KB limit.';
    } else {
        $photoDir = 'uploads/photo/';
        if (!file_exists($photoDir)) mkdir($photoDir, 0777, true);
        $photoFileName = uniqid('photo_') . '_' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $photoDir . $photoFileName);
    }
} else {
    $errors[] = 'Photo file upload error.';
}

// If errors found, save them to session and redirect to error page
if (!empty($errors)) {
    $_SESSION['upload_errors'] = $errors;
    header('Location: joinus_error.php');
    exit;
}

// === Insert into DB ===
$stmt = $mysqli->prepare("INSERT INTO joinus 
    (first_name, last_name, email, phone, street, city, state, postcode, cv_filename, photo_filename)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die('Prepare failed: ' . $mysqli->error);
}

$stmt->bind_param("ssssssssss", 
    $firstName, $lastName, $email, $phone, $street, $city, $state, $postcode, $cvFileName, $photoFileName);

if (!$stmt->execute()) {
    die('Insert failed: ' . $stmt->error);
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Join Us Confirmation</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="website icon" href="styles/images/websitelogo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <?php include 'navbar.php'; ?>

<main id="confirmation-container">
    <h2>Application Confirmation</h2>
    <p>Thank you, <?= htmlspecialchars($firstName) ?> <?= htmlspecialchars($lastName) ?>, for applying to join our team. 
    Here's the information you submitted:</p>

    <div class="info-grid">
        <div><strong>Email:</strong> <?= htmlspecialchars($_POST['email'] ?? '') ?></div>
        <div><strong>Phone:</strong> <?= htmlspecialchars($_POST['phone'] ?? '') ?></div>
        <div><strong>Address:</strong> <?= htmlspecialchars($_POST['street'] ?? '') ?>, 
            <?= htmlspecialchars($_POST['city'] ?? '') ?>, 
            <?= htmlspecialchars($_POST['state'] ?? '') ?> 
            <?= htmlspecialchars($_POST['postcode'] ?? '') ?>
        </div>
        <div><strong>Uploaded CV:</strong> <?= htmlspecialchars($_FILES['cv']['name'] ?? 'No file uploaded') ?></div>
        <div><strong>Uploaded Photo:</strong> <?= htmlspecialchars($_FILES['photo']['name'] ?? 'No file uploaded') ?></div>
    </div>

    <a href="joinus.php">Back to Join Us Page</a>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
