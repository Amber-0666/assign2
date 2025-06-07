<?php
// Database config
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'Brewngo';

// Connect to database
$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die('Database connection failed: ' . $mysqli->connect_error);
}

// Check for ID in GET request
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Prepare delete statement
    $stmt = $mysqli->prepare("DELETE FROM register WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $mysqli->close();
        // Redirect to confirmation page
        header("Location: delete_success.php");
        exit;
    } else {
        echo "Failed to delete the record.";
    }

    $stmt->close();
} else {
    echo "Invalid member ID.";
}

$mysqli->close();
?>
