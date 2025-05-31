<?php

// Clear all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Clear the remember me cookie (if set)
if (isset($_COOKIE['rememberme'])) {
    setcookie('rememberme', '', time() - 3600, '/', '', false, true);
}

// Redirect to login page
header("Location: login.php");
exit;