<?php
session_start();
require_once '../includes/connectionDB.php';

if (isset($_SESSION['logged_in'])  && $_SESSION['logged_in'] === true) {
    if (
        isset($_POST['oldPassword'], $_POST['newPassword'])
        && !empty($_POST['oldPassword'])
        && !empty($_POST['newPassword'])
        && !empty($_POST['confirm-newPassword'])
    ) {
        // receive old and new passwords
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $hashed_password = $_SESSION['password'];
        $confirm_newPassword = $_POST['confirm-newPassword'];
        $email = $_SESSION['email'];

        //check if old password is correct
        if (!password_verify($oldPassword, $hashed_password)) {
            die('Incorrect Password');
        }

        //new password validation 
        $uppercase = preg_match('@[A-Z]@', $newPassword);
        $lowercase = preg_match('@[a-z]@', $newPassword);
        $number    = preg_match('@[0-9]@', $newPassword);

        if (!$uppercase || !$lowercase || !$number || strlen($newPassword) < 8 || strlen($newPassword) > 30) {
            die("password does not meet the requirements");
        }

        // check if confirm password equal to new password
        if ($confirm_newPassword !== $newPassword) {
            die('Password and confirm password does not match');
        }

        // encrypt password
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $confirm_newPassword = password_hash($confirm_newPassword, PASSWORD_DEFAULT);

        // Update new password and new confirmation password
        $newPassStmt = $db->prepare("UPDATE `users` SET `password`=:newPassword,`confirm_password`=:newConfirmPass WHERE email=:email");
        $newPassStmt->execute([
            'newPassword' => $newPassword,
            'newConfirmPass' => $confirm_newPassword,
            'email' => $email
        ]);

        //if updated 
        if ($newPassStmt->rowCount()) {
            echo ('Your password has been updated successfully');
            $_SESSION['password'] = $newPassword;
            die;
        } else {
            die('unknown error');
        }
        //
    } else {
        die('You should enter all fields');
    }
    //
} else {
    die('you should login');
}
