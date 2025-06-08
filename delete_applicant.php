<?php
// Database config
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'brewngo';

// Connect to database
$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die('Database connection failed: ' . $mysqli->connect_error);
}

// Check for ID in GET request
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Delete from joinus table
    $stmt = $mysqli->prepare("DELETE FROM joinus WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $mysqli->close();

        // Redirect to confirmation page with joinus type
        header("Location: delete_success.php?type=joinus");
        exit;
    } else {
        echo "Failed to delete the applicant.";
    }

    $stmt->close();
} else {
    echo "Invalid applicant ID.";
}

$mysqli->close();
?>
