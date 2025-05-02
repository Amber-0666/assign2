<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input fields safely
    $firstName = htmlspecialchars($_POST["first-name"]);
    $lastName = htmlspecialchars($_POST["last-name"]);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $phone = preg_match("/^[0-9]{10}$/", $_POST["phone"]) ? $_POST["phone"] : false;
    $street = htmlspecialchars($_POST["street"]);
    $city = htmlspecialchars($_POST["city"]);
    $state = $_POST["state"];
    $postcode = preg_match("/^[0-9]{5}$/", $_POST["postcode"]) ? $_POST["postcode"] : false;

    if (!$firstName || !$lastName || !$email || !$phone || !$street || !$city || !$state || !$postcode) {
        echo "<p>Error: Please ensure all fields are filled correctly.</p>";
    } else {
        echo "<h2>Application Received!</h2>";
        echo "<p>Thank you, $firstName $lastName, for applying. We will review your application.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>