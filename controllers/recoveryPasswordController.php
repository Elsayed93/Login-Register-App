<?php

session_start();
require_once '../includes/connectionDB.php';

// var_dump('get', $_GET);
// echo '<hr>';

// var_dump($_SESSION);
// die;

$email = $_GET['email'];
$token = $_GET['token'];

if (
    isset($_GET['email'], $_GET['token'])
    && !empty($email = $_GET['email'])
    && !empty($token = $_GET['token'])
    && $email === $_SESSION['email']
    && $token === $_SESSION['token']
) {
    // var_dump('asdad');
    // die;
    // $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    // if (!$email) {
    //     die('an inappropriate email');
    // }
    // go to new password form page
    header('location: ../views/recoveryPassword.php');
    if ($tokenEmailCheck->rowCount()) {
        // show new password form
        header('location: ../views/recoveryPassword.php');
        // validate new password and update it in DB and Delete Token
    } else {
        die('incorrect email');
    }
} else {
    die('incorrect email or token');
}
