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

if ($emailStmt->rowCount() && password_verify($_POST['password'], $emailStmt->fetch()['password'])) {

    $activestmt = $db->prepare("SELECT * FROM users WHERE email=:input_email AND activated='1'");
    $activestmt->execute([
        'input_email' => $email
    ]);

    if ($activestmt->rowCount()) {


        foreach ($activestmt->fetchAll() as $row) {
            // var_dump($row);
            // die;
            $passwordCheck = password_verify($password, $row['password']);

            if ($passwordCheck) {
                $updateUserStmt = $db->prepare("UPDATE `users` SET `last_login`=CURRENT_TIMESTAMP WHERE email=:input_email");
                $updateUserStmt->execute([
                    'input_email' => $email
                ]);
                // store data in session
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['privilege'] = $row['privilege'];

                if (isset($_SESSION['logged_in'], $_SESSION['email'], $_SESSION['password']) && $_SESSION['logged_in'] === true) {
                    // header to home page
                    header("location: ../views/home.php");
                } else {
                    die('failed to login');
                }
            } else {
                die('Incorrect Email or Password, Please try again');
            }
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