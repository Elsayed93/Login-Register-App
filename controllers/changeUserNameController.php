<?php

session_start();
require_once '../includes/connectionDB.php';
require_once '../includes/functions.php';

if (
    isset($_SESSION['logged_in'], $_SESSION['email'], $_POST['email'], $_POST['newUserName'], $_POST['password'])
    && $_SESSION['logged_in'] == true
) {
    if (!$_POST['email'] === $_SESSION['email']) {
        die('email is not correct');
    }
    if (empty($_POST['newUserName']) && empty($_POST['password'])) {
        die('you should enter user name and password');
    }
    if (!$_POST['email'] === $_SESSION['email']) {
        die('Incorrect Email');
    }
    // check if password correct
    $password = password_verify($_POST['password'], $_SESSION['password']);
    if ($password) {
        $newUserName = $_POST['newUserName'];
        $email = $_POST['email'];

        // >> user name validation
        $newUserName = validateData($newUserName); // trim and special html characters
        if ((int) $newUserName) { // 
            die('user name should start with character not number');
        }
        if (strlen($newUserName) < 5) { // user name length
            die('user name should at least 5 characters');
        }
        if (strlen($newUserName) > 30) { // user name length
            die('user name must be no more than 30 characters');
        }
        // >>  end user name validation 

        // check if user name is exist in DB
        $userNameCheck = $db->prepare("SELECT `user_name` FROM `users` WHERE `user_name`=:newUserName");
        $userNameCheck->execute([
            'newUserName' => $newUserName
        ]);

        if ($userNameCheck->rowCount()) {
            die('this user name is exist, please choose another one');
        }


        // update new user name
        $userNameUpdate = $db->prepare("UPDATE `users` SET `user_name`=:new_userName WHERE `email`=:email");
        $userNameUpdate->execute([
            'new_userName' => $newUserName,
            'email' => $email,
        ]);

        if ($userNameUpdate->rowCount()) {
            die('user name has been updated successfully :)');
        } else {
            die('sorry :( , user name has not been updated');
        }
        //
    } else {
        die('incorrect password');
    }
    //
} else {
    die('you should login');
}
