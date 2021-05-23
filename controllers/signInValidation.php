<?php

session_start();
require_once '../includes/connectionDB.php';

if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];
} else {
    die('Please enter your email');
}

if (isset($_POST['password']) && !empty($_POST['password'])) {
    $password = $_POST['password'];
} else {
    die('Please enter your password');
}


$emailStmt = $db->prepare("SELECT email, `password` FROM users WHERE email=:input_email");
$emailStmt->execute([
    'input_email' => $email
]);

if ($emailStmt->rowCount()) {

    $activetmt = $db->prepare("SELECT email, `password` FROM users WHERE email=:input_email AND activated='1'");
    $activetmt->execute([
        'input_email' => $email
    ]);

    if ($activetmt->rowCount()) {

        $password = password_verify($password, $emailStmt->fetch()['password']);
        if ($password) {
            // update statement
            $updateUserStmt = $db->prepare("UPDATE `users` SET `last_login`=CURRENT_TIMESTAMP WHERE email=:input_email");
            $updateUserStmt->execute([
                'input_email' => $email
            ]);

          

            foreach($activetmt->fetchAll() as $row){
                // var_dump($row);
                $_SESSION['logged_in'] = true;
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                // var_dump( $_SESSION['email']);
            }
            // die;
        
            // header to home page
            // var_dump($activetmt->fetch());
            // die;
            header("refresh:.5;../views/home.php");
        } else {
            die('Incorrect Email or Password, Please try again');
        }
    } else {
        die('Please Active Your Email');
    }
    //
} else {
    die('Incorrect Email or Password, Please try again');
}
