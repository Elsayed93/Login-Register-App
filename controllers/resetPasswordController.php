<?php

session_start();
require_once '../includes/connectionDB.php';

$email = $_POST['email'];

// check if this email is exist
$emailCheckStmt = $db->prepare("SELECT email FROM users WHERE email=:input_email");
$emailCheckStmt->execute([
    'input_email' => $email,
]);

if ($emailCheckStmt->rowCount()) {
    //create token and update it in DB
    function generateRandomString($length = 10)
    {
        $characters = '0123456789akjhsdajbxnvshjshf7237462387462842098sjflskdfm.sdfmOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    // $token = random_bytes(20);
    $token = generateRandomString(20);

    $_SESSION['token'] = $token;
    $_SESSION['email'] = $email;

    echo "<a href='recoveryPasswordController.php?token={$token}&email={$email}'>{$token} </a>";
    //
} else {
    die('An incorrect Email');
}
