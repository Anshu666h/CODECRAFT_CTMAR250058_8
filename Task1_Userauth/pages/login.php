<?php
include 'assests/db.php';
require_once 'vendor/GoogleAuthenticator.php';
session_start();

$ga = new PHPGangsta_GoogleAuthenticator();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $otp = isset($_POST['otp']) ? $_POST['otp'] : null; // ✅ Prevent undefined key error

    // Fetch user details
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            if ($otp) { // ✅ Check if OTP is provided
                // Verify OTP
                if ($ga->verifyCode($user['secret_key'], $otp, 2)) {
                    $_SESSION['email'] = $email;
                    echo "Login successful! Redirecting...";
                    header("refresh:2; url=dashboard.php");
                } else {
                    echo "Invalid OTP!";
                }
            } else {
                echo "OTP is required!";
            }
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No account found!";
    }
}
?>
