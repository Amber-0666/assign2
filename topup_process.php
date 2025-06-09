<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BrewnGo";

if (!isset($_SESSION['register-ID'])) {
    die("You must be logged in to perform top-up.");
}

$userId = $_SESSION['register-ID'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['amount'], $_POST['ewallet'])) {
        $_SESSION['topup_error'] = "Please provide amount and select an e-wallet.";
        header("Location: topup.php");
        exit;
    }

    $amount = floatval($_POST['amount']);
    $ewallet = $_POST['ewallet'];
    $validEwallets = ['tng', 'grabpay', 'boost'];

    if ($amount <= 0 || !in_array($ewallet, $validEwallets)) {
        $_SESSION['topup_error'] = "Invalid top-up details.";
        header("Location: topup.php");
        exit;
    }

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->begin_transaction();

    try {
        // Insert pending transaction
        $stmt = $conn->prepare("INSERT INTO topup_history (register_ID, amount, `e-wallet`, status) VALUES (?, ?, ?, 'pending')");
        $stmt->bind_param("sds", $userId, $amount, $ewallet);
        if (!$stmt->execute()) {
            throw new Exception("Failed to create top-up record.");
        }
        $topupId = $stmt->insert_id;
        $stmt->close();

        // Update balance
        $stmt = $conn->prepare("UPDATE user SET balance = balance + ? WHERE `register-ID` = ?");
        $stmt->bind_param("ds", $amount, $userId);
        if (!$stmt->execute()) {
            throw new Exception("Failed to update balance.");
        }
        $stmt->close();

        // Mark top-up as successful
        $stmt = $conn->prepare("UPDATE topup_history SET status = 'success' WHERE id = ?");
        $stmt->bind_param("i", $topupId);
        $stmt->execute();
        $stmt->close();

        $conn->commit();

        $_SESSION['topup_success'] = "Top-up successful! RM " . number_format($amount, 2) . " added via " . strtoupper($ewallet) . ".";
        $_SESSION['topup_status'] = "success";
    } catch (Exception $e) {
        $conn->rollback();

        // If topup record exists, mark it as fail
        if (isset($topupId)) {
            $conn->query("UPDATE topup_history SET status = 'fail' WHERE id = $topupId");
        }

        $_SESSION['topup_error'] = "Top-up failed: " . $e->getMessage();
        $_SESSION['topup_status'] = "fail";
    }

    $conn->close();
    header("Location: topup.php");
    exit;
} else {
    header("Location: topup.php");
    exit;
}