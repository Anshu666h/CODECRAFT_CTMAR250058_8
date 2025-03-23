<?php
include 'db.php';
require_once '../vendor/GoogleAuthenticator.php';

$ga = new PHPGangsta_GoogleAuthenticator();

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $stmt = $conn->prepare("SELECT secret_key FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $secretKey = $user['secret_key'];

        $qrCodeUrl = $ga->getQRCodeGoogleUrl("MyWebsite ($email)", $secretKey, "MyWebsite");

        echo "<h2>Scan this QR Code with Google Authenticator</h2>";
        echo "<img src='$qrCodeUrl'>";
        echo "<p>Secret Key: <strong>$secretKey</strong></p>";
        echo "<a href='index.html'>Go to Login</a>";
    } else {
        echo "User not found!";
    }
}
?>
