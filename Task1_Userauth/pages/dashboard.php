<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../index.html");
    exit();
}

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="assests/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="dashboard-container">
    <div class="dashboard-card">
        <h2>Welcome, <?php echo htmlspecialchars($email); ?> 🎉</h2>
        <p>You're successfully logged in!</p>
        <div class="dashboard-links">
            <a href="profile.php" class="dashboard-btn"><i class="fas fa-user"></i> Profile</a>
            <a href="settings.php" class="dashboard-btn"><i class="fas fa-cog"></i> Settings</a>
            <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
</div>

</body>
</html>
