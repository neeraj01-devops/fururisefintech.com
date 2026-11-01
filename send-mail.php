<?php
// ==============================
// BUSINESS MAIL INTEGRATION
// ==============================

// Only allow POST request
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid Request");
}

// ==============================
// SANITIZE INPUTS
// ==============================

function clean_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

$name    = clean_input($_POST['name'] ?? '');
$phone   = clean_input($_POST['phone'] ?? '');
$email   = clean_input($_POST['email'] ?? '');
$message = clean_input($_POST['message'] ?? '');

// ==============================
// VALIDATION
// ==============================

if (empty($name) || empty($phone) || empty($email) || empty($message)) {
    echo "<script>alert('All fields are required.'); window.history.back();</script>";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format.'); window.history.back();</script>";
    exit;
}

// ==============================
// EMAIL SETTINGS
// ==============================

// Main Business Email
$to = "info@futurisefintech.com";

// Add 3 Copy Emails (comma separated)
$ccEmails = "futurerisefintech@gmail.com, support@futurisefintech.com";

$subject = "New Partnership Request - Futurise Fintech";

// Email Body
$body = "
New Partnership Request Received

-------------------------------------
Full Name : $name
Phone     : $phone
Email     : $email
-------------------------------------

Message:
$message
";

// Headers
$headers  = "From: no-reply@futurisefintech.com\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "CC: $ccEmails\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// ==============================
// SEND MAIL
// ==============================

if (mail($to, $subject, $body, $headers)) {

    echo "<script>
            alert('Thank you! Your partnership request has been submitted successfully.');
            window.history.back();
          </script>";

} else {

    echo "<script>
            alert('Sorry! Something went wrong. Please try again.');
            window.history.back();
          </script>";
}

?>