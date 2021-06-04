<?php

require_once '../includes/connectionDB.php';
require_once '../includes/functions.php';

if (
    isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirmation-password'], $_POST['register'])
    && !empty($_POST['username'])
    && !empty($_POST['email'])
    && !empty($_POST['password'])
    && !empty($_POST['confirmation-password'])
    && ($_POST['register'] === 'register')


) {
    // var_dump($_POST);
    // die;
    $userName = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmation-password'];

    // >>>>>>>>>>>>>>>>>>>>>> data validation <<<<<<<<<<<<<<<<<<<<<<<<<< //

    //username validation
    $userName = validateData($userName); // trim and Convert special characters to HTML entities

    if (strlen($userName) < 5) {
        die('username must be more 5 characters');
    }
    if (strlen($userName) > 30) { // user name length
        die('user name must be no more than 30 characters');
    }

    if (((int) $userName)) { // if username is number
        echo 'username is not valid, it should not start with number';
        die();
    }

    //email validation
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
        echo "Invalid Email";
        die;
    }

    // check if username or email is exist
    $userNameStmt =  $db->prepare("SELECT user_name from users WHERE user_name=:username");
    $userNameStmt->execute([
        'username' => $userName
    ]);

    // $emailStmt =  $db->prepare("SELECT email from users WHERE email=:email");
    // $emailStmt->execute([
    //     'email' => $email
    // ]);

    if ($userNameStmt->rowCount()) {
        die('user name is exist, please enter another one');
    } else {
        $emailStmt =  $db->prepare("SELECT email from users WHERE email=:email");
        $emailStmt->execute([
            'email' => $email
        ]);

        if ($emailStmt->rowCount()) {
            die('Email is exist, please enter another one');
        }
    }


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

    // >>>>>>>>>>>>>>>>>>>>>> data registeration <<<<<<<<<<<<<<<<<<<<<<<<<< //
    try {
        // query 
        $stmt = $db->prepare("INSERT INTO users (`user_name`, `email`, `password`, `confirm_password`)
                                VALUES (:username, :email, :pass, :confirm_pass)");

        $stmt->execute([
            "username" => $userName,
            "email" => $email,
            "pass" => $password,
            "confirm_pass" => $confirmPassword,
        ]);

        if ($stmt->rowCount()) {
            echo '<h3>You have register successfully</h3>';
            header("refresh:5;../index.php");
        }
        //
    } catch (PDOException $error) {
        echo "Error: {$error->getMessage()}";
        die();
    }
    //
} else {
    echo 'you should fill all fields';
}
