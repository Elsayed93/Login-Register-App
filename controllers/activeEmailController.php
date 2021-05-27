<?php

$activateEmail = $_POST['activateEmail'];

$to      = $activateEmail;
$subject = 'Simple Email Test via PHP';
$message = 'hello, This is test email send by PHP Script';
$headers = array(
    'From' => 'elsayed@example.com',
    'Reply-To' => 'elsayed@example.com',
    'X-Mailer' => 'PHP/' . phpversion()
);

if (mail($to, $subject, $message, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}
