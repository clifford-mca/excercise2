<?php
include("db.php");
include("send_email.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $verification_code = md5(rand());  // Generate a unique verification code

    // Insert the user into the database with 'pending' status
    $sql = "INSERT INTO users (username, email, password, verification_code, status) 
            VALUES ('$username', '$email', '$password', '$verification_code', 'pending')";

    if ($conn->query($sql) === TRUE) {
        // Prepare the verification email
        $subject = "Email Verification";
        $message = "
            <html>
            <head><title>Email Verification</title></head>
            <body>
                <p>Thank you for signing up! Please click the link below to verify your email address:</p>
                <a href='http://localhost/auth_system_with_email_verification/verify.php?code=$verification_code'>Verify your email</a>
            </body>
            </html>
        ";

        // Send the email
        $email_sent = sendVerificationEmail($email, $subject, $message);

        if ($email_sent) {
            echo "<script>alert('Registration successful! Please check your email for verification.'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Failed to send verification email.');</script>";
        }
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="" method="post">
        <h2>Sign Up</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
        <a href="index.php">Already have an account? Login</a>
    </form>
</body>
</html>
