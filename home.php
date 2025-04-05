<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard">
        <h1>Welcome, <?php echo $_SESSION["username"]; ?>!</h1>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
