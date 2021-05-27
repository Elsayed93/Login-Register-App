<?php

session_start();
require_once '../includes/connectionDB.php';
require_once '../includes/header.php';

if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];
} else {
    die('Please enter your email');
}

if (
    isset($_POST['password']) && !empty($_POST['password'])
) {
    $password = $_POST['password'];
} else {
    die('Please enter your password');
}


$emailStmt = $db->prepare("SELECT email, `password` FROM users WHERE email=:input_email");
$emailStmt->execute([
    'input_email' => $email
]);

// var_dump($_POST['password']);
// // var_dump(password_verify($_POST['password'], $emailStmt->fetch()['password']));
// // var_dump($emailStmt->fetch()['password']);
// die;
if ($emailStmt->rowCount() && password_verify($_POST['password'], $emailStmt->fetch()['password'])) {

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

            // store data in session
            foreach ($activetmt->fetchAll() as $row) {
                // var_dump($row);
                $_SESSION['logged_in'] = true;
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                // var_dump( $_SESSION['email']);
            }

            // header to home page
            header("location: ../views/home.php");
        } else {
            die('Incorrect Email or Password, Please try again');
        }
    } else {
?>
        <div class="container mt-5">
            <div class="row mt-3">
                <?php echo ("<p class='lead'> Please Active Your Email </p>"); ?>

            </div>
            <div class="row">
                <dive class="col-md-4">
                    <a href="../views/activeEmail.php" class="btn btn-primary">Activate Your Email</a>
                </dive>
            </div>
        </div>
<?php

    }
    //
} else {
    die('Incorrect Email or Password, Please try again');
}
?>