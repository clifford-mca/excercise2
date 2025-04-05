<?php
include("db.php");

if (isset($_GET['code'])) {
    $verification_code = $_GET['code'];

    // Query to check if the verification code exists in the database and if the status is 'pending'
    $sql = "SELECT * FROM users WHERE verification_code='$verification_code' AND status='pending'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if ($user) {
        // If the user exists and the verification code matches, update the status to 'verified'
        $sql = "UPDATE users SET status='verified' WHERE verification_code='$verification_code'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Email verified successfully! You can now log in.'); window.location='index.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Invalid verification code or your email is already verified.";
    }
}
?>
