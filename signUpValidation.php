<?php

require_once 'connectionDB.php';
require_once 'functions.php';

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

    // >>>>>>>>>>>>>>>>>>>>>> data validation

    //username validation
    $userName = validateData($userName); // trim and Convert special characters to HTML entities

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

    // password validation
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
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
            header("refresh:5;index.php");
        }
    } catch (PDOException $error) {
        echo "Error: {$error->getMessage()}";
        die();
    }
} else {
    var_dump($_POST);
    echo '<hr>';
    echo 'you should fill all fields';
}
