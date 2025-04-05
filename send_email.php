<?php
function sendVerificationEmail($to, $subject, $message) {
    $headers = "From: no-reply@example.com\r\n";  // Use a valid email address for the 'From' field
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";  // Specify HTML format for the email

    // Send the email using PHP's mail function
    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}
?>
