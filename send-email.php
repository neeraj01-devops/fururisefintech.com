<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = htmlspecialchars($_POST['username']);
    $email   = htmlspecialchars($_POST['email']);
    $phone   = htmlspecialchars($_POST['phone']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $to = "info@futurisefintech.com";

    $headers  = "From: noreply@futurisefintech.com\r\n";   // ⚠ user email mat use karo
    $headers .= "Reply-To: $email\r\n";
    
    // ✅ CC Emails
    $headers .= "Cc: futurerisefintech@gmail.com, support@futurisefintech.com\r\n";
    
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $body = "
    <h3>New Consultation Request</h3>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Phone:</strong> $phone</p>
    <p><strong>Service:</strong> $subject</p>
    <p><strong>Message:</strong> $message</p>
    ";

    if (mail($to, "New Consultation Request", $body, $headers)) {
        echo "<script>alert('Message Sent Successfully!'); window.history.back();</script>";
    } else {
        echo "<script>alert('Error sending message. Try again.'); window.history.back();</script>";
    }

}
?>