<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BrewnGo";

$conn = new mysqli($servername, $username, $password, $dbname);
$loginError = "";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_POST['register-ID'], $_POST['login-Password'])) {
    $_SESSION['login_error'] = "Please fill both the login ID and password fields.";
    header("Location: member.php");
    exit();
}

$loginID = $_POST['register-ID'];
$loginPassword = $_POST['login-Password'];

// Check user
$stmt = $conn->prepare("SELECT `register-ID`, `register-Password` FROM user WHERE `register-ID` = ?");
$stmt->bind_param("s", $loginID);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $storedpassword);
    $stmt->fetch();

    if ($loginPassword === $storedpassword) {
        $_SESSION['user_id'] = $id;
        $_SESSION['register-ID'] = $id;
        $_SESSION['is_admin'] = false;
        $_SESSION['login_success'] = true;
        unset($_SESSION['login_error']);
        header("Location: member.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid Username or Password";
        header("Location: member.php");
        exit();
    }
}

// Check admin
$stmt = $conn->prepare("SELECT `admin-ID`, `admin-Password` FROM admin WHERE `admin-ID` = ?");
$stmt->bind_param("s", $loginID);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($admin_id, $admin_pass);
    $stmt->fetch();

    if ($loginPassword === $admin_pass) {
        $_SESSION['user_id'] = $admin_id;
        $_SESSION['admin-ID'] = $admin_id;
        $_SESSION['is_admin'] = true;
        $_SESSION['role'] = 'admin';
        unset($_SESSION['login_error']);
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid Username or Password";
        header("Location: member.php");
        exit();
    }
}

$_SESSION['login_error'] = "Invalid Username or Password";
header("Location: member.php");
exit();
?>
