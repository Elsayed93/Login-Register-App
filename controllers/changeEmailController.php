<?php

session_start();

require_once '../includes/connectionDB.php';


if (
    isset($_SESSION['logged_in'])
    && $_SESSION['logged_in'] === true
) {
    // var_dump($_POST);
    // die;

    if (isset($_POST['oldEmail'], $_POST['newEmail'], $_POST['password'])) {

        // var_dump($_SESSION);
        // echo '<hr>';
        // var_dump($_POST);
        // die;

        // die('logged');
        $old_email = $_POST['oldEmail'];
        $new_email = $_POST['newEmail'];
        $hashed_password = $_SESSION['password'];
        $input_password = $_POST['password'];

        if ($old_email !== $_SESSION['email'] || !password_verify($input_password, $hashed_password)) {
            die('Email or password is an incorrect');
        } else {
            // die('pass');
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
