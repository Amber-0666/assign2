<?php
// Enable error reporting during development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'brewngo';

// Connect to MySQL
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the database exists
$db_exists = $conn->select_db($db);

if (!$db_exists) {
    $sql_file = __DIR__ . '/brewngo_product.sql';
    if (file_exists($sql_file)) {
        // Run SQL import command
        $command = "mysql -u $user " . ($pass ? "-p$pass " : "") . "< \"$sql_file\"";
        system($command, $return_val);

        if ($return_val === 0) {
            echo "<p><strong>✅ Database 'brewngo' imported successfully.</strong></p>";
        } else {
            echo "<p><strong>❌ Database import failed.</strong></p>";
        }
    } else {
        echo "<p><strong>❌ SQL file not found: brewngo_product.sql</strong></p>";
    }
}

// Reconnect with DB selected
$conn = new mysqli($host, $user, $pass, $db);
?>
