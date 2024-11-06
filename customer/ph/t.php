<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Create a PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Set the mail server settings for Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tkxu8800@gmail.com'; // Replace with your Gmail username
    $mail->Password = 'Dev@1721982'; // Replace with your generated App Password
    $mail->SMTPSecure = 'tls'; // or 'ssl' if your server requires it
    $mail->Port = 587; // Change the port if necessary

    // Set other options
    $mail->setFrom('tkxu8800@gmail.com', 'X u Tk'); // Replace with your Gmail username and name
    $mail->addAddress('devmakwana184@gmail.com'); // Replace with the recipient's email address

    // Set the subject and body of the email
    $mail->Subject = 'Test Email';
    $mail->Body = 'This is a test email.';

    // Send the email
    $mail->send();

    echo 'Email sent successfully.';
} catch (Exception $e) {
    echo 'Error sending email: ' . $e->getMessage();
}
?>
