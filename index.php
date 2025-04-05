<?php
include("db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the user exists and the email is verified
    $result = $conn->query("SELECT * FROM users WHERE email='$email' AND status='verified'");
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["username"] = $user["username"];
        header("Location: home.php");
    } else {
        echo "<script>alert('Invalid email or password, or your email is not verified.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="" method="post">
        <h2>Login</h2>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <a href="register.php">Don't have an account? Sign Up</a>
    </form>
</body>
</html>
