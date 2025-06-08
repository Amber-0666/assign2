<?php
session_start();

// Retrieve errors from session if available
$errors = $_SESSION['upload_errors'] ?? [];
unset($_SESSION['upload_errors']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Join Us Application Error</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php include 'navbar.php'; ?>

<main id="confirmation-container">
    <h2>Application Error</h2>

    <?php if (!empty($errors)): ?>
        <p>Please fix the following errors before submitting your application:</p>
        <div class="error-messages">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No specific errors provided.</p>
    <?php endif; ?>

    <a href="joinus.php">Back to Join Us Page</a>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
