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

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt = $mysqli->prepare("DELETE FROM enquiry WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $mysqli->close();
        header("Location: delete_success.php?type=enquiry");
        exit;
    } else {
        echo "Failed to delete the enquiry.";
    }

    $stmt->close();
} else {
    echo "Invalid enquiry ID.";
}

$mysqli->close();
?>
