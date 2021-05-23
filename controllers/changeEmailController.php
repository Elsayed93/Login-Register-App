<?php

session_start();

require_once '../includes/connectionDB.php';


if (
    isset($_SESSION['logged_in'])
    && $_SESSION['logged_in'] === true
) {

    if (isset($_POST['oldEmail'], $_POST['newEmail'], $_POST['password'])) {

        $old_email = $_POST['oldEmail'];
        $new_email = $_POST['newEmail'];
        $hashed_password = $_SESSION['password'];
        $input_password = $_POST['password'];

        // //  >>> if a new email is exist in DB, show error message
        $chackNewEmailStmt = $db->prepare("SELECT `email` FROM `users` WHERE email=:new_email");
        $chackNewEmailStmt->execute([
            'new_email' => $new_email
        ]);

        if ($chackNewEmailStmt->rowCount()) {
            die('this email is already taken, please enter another email');
        }
        //  >>> end email exist checking

        if ($old_email !== $_SESSION['email'] || !password_verify($input_password, $hashed_password)) {
            die('Email or password is an incorrect');
        } else {
            // email validation
            $new_email = filter_var($new_email, FILTER_VALIDATE_EMAIL);
            if (!$new_email) {
                die('Inappropriate Email, please enter a valid email');
            }

            //Update new email
            $updateEmailStmt = $db->prepare("UPDATE `users` SET `email`=:new_email WHERE email=:old_email");
            $updateEmailStmt->execute([
                'new_email' => $new_email,
                'old_email' => $old_email,
            ]);

            if ($updateEmailStmt->rowCount()) {
                $_SESSION['email'] = $new_email;
                die('<h3>Email has been updated successfully</h3>');
            } else {
                die('Unknown Error');
            }
        }
        //
        //
    } else {
        header("Location: ../views/changeEmail.php");
        die;
    }
} else {
    die('You Should Login');
}
