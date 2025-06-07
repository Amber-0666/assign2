<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'Brewngo';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die('Database connection failed: ' . $mysqli->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die('Invalid member ID.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $loginid = trim($_POST['loginid']);

    if ($fullname && $email && $loginid) {
        $stmt = $mysqli->prepare("UPDATE register SET fullname = ?, email = ?, loginid = ? WHERE id = ?");
        $stmt->bind_param("sssi", $fullname, $email, $loginid, $id);
        $stmt->execute();
        $stmt->close();

        header("Location: edit_success.php");
        exit;
    } else {
        $error = "All fields are required.";
    }
} else {
    $stmt = $mysqli->prepare("SELECT fullname, email, loginid FROM register WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();

    if (!$data) {
        die("Member not found.");
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Member</title>
    <link rel="stylesheet" href="styles/style.css" />
</head>
<body>
    <div id="edit-membership-page">
        <form method="post" class="edit-form" action="">
            <label for="edit-fullname">Full Name*</label>
            <input
                type="text"
                id="edit-fullname"
                name="fullname"
                value="<?= htmlspecialchars($data['fullname']) ?>"
                required
                placeholder="Enter your full name"
                pattern="[A-Za-z\s]{1,50}"
                title="Alphabetical characters and spaces only, max 50 characters"
                maxlength="50"
            />

            <label for="edit-email">Email Address*</label>
            <input
                type="email"
                id="edit-email"
                name="email"
                value="<?= htmlspecialchars($data['email']) ?>"
                required
                placeholder="your.email@example.com"
            />

            <label for="edit-loginid">Login ID*</label>
            <input
                type="text"
                id="edit-loginid"
                name="loginid"
                value="<?= htmlspecialchars($data['loginid']) ?>"
                required
                placeholder="Enter your Login ID"
                pattern="[A-Za-z]{1,10}" 
                title="Alphabetical characters only, max 10 characters"
                maxlength="10"
            />

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>