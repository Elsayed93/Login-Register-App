<?php

require_once '../includes/connectionDB.php';

if (
    isset($_POST['newPassword'], $_POST['confirm-newPassword'])
    && !empty($_POST['newPassword'])
    && !empty($_POST['confirm-newPassword'])
) {
    $password = $_POST['newPassword'];
    $confirmPassword = $_POST['confirm-newPassword'];
    $token = $_POST['token'];
    $email = $_POST['email'];
    // $email = $_SESSION['email'];
    // $token = $_SESSION['token'];

    // password validation
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    if (!$uppercase || !$lowercase || !$number || strlen($password) < 8 || strlen($password) > 30) {
        echo "password does not meet the requirements";
        die;
    }

    //confirmation password validation
    if ($confirmPassword !== $password) {
        echo "Password and confirm password does not match";
        die;
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $confirmPassword = password_hash($confirmPassword, PASSWORD_DEFAULT);
    }

    $newPAssword = $db->prepare("UPDATE `users` SET `password`=:input_password, confirm_password=:confirm_password WHERE email=:get_email AND  `token`=:token");
    $newPAssword->execute([
        'input_password' => $password,
        'confirm_password' => $confirmPassword,
        'token' => $token,
        'get_email' => $email,
    ]);

    if ($newPAssword->rowCount()) {
        $tokenDelete = $db->prepare("UPDATE `users` SET `token`=null WHERE `email`=:get_email");
        $tokenDelete->execute([
            'get_email' => $email,
        ]);

        if ($tokenDelete->rowCount()) {
            die('password has been changed successfully, please try <a href="../index.php"> login </a>');
            //
        } else {
            die('invalid token');
        }
        //
    } else {
        die('unknown error');
    }
    //
} else {
    die('please try again');
}
