<?php
include 'assests/db.php';
require_once 'vendor/GoogleAuthenticator.php';

$ga = new PHPGangsta_GoogleAuthenticator();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $secretKey = $ga->createSecret();

    // Check if email exists
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "Email already exists!";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (email, password, secret_key) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $password, $secretKey);

        if ($stmt->execute()) {
            header("Location: assests/setup_2fa.php?email=$email");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>
