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

    // Get loginid before deleting
    $stmt_get = $mysqli->prepare("SELECT loginid FROM register WHERE id = ?");
    $stmt_get->bind_param("i", $id);
    $stmt_get->execute();
    $stmt_get->bind_result($loginid);
    $stmt_get->fetch();
    $stmt_get->close();

    // Delete from register table
    $stmt = $mysqli->prepare("DELETE FROM register WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();

        // Delete from user table
        $stmt2 = $mysqli->prepare("DELETE FROM user WHERE `register-ID` = ?");
        $stmt2->bind_param("s", $loginid);
        $stmt2->execute();
        $stmt2->close();

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
