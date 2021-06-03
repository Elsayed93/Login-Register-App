<?php

require_once '../includes/connectionDB.php';
require_once '../includes/header.php';

if (
    isset($_GET['email'], $_GET['token'])
    && !empty($email = $_GET['email'])
    && !empty($token = $_GET['token'])
    // && $email === $_SESSION['email']
    // && $token === $_SESSION['token']
) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    // check if token and email are exist
    $emailAndTokenCheck = $db->prepare("SELECT `email`,`token` FROM `users` WHERE `email`=:get_email AND `token` = :get_token");
    $emailAndTokenCheck->execute([
        'get_email' => $email,
        'get_token' => $token,
    ]);

    if ($emailAndTokenCheck->rowCount()) {

?>
        </head>

        <body>
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                        <div class="card card-signin my-5">
                            <div class="card-body">
                                <h5 class="card-title text-center">Reset Your Password</h5>
                                <form action="newPasswordController.php" method="POST">
                                    <input type="hidden" name="token" value="<?php echo $token ?>">
                                    <input type="hidden" name="email" value="<?php echo $email ?>">
                                    <div class="mb-3">
                                        <label for="newPassword" class="form-label">New Password</label>
                                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="enter new password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="newPassword" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm-newPassword" name="confirm-newPassword" placeholder="confirm password">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Reset Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>

        </html>
<?php
    } else {
        die('incorrect email or token');
    }
    //
} else {
    die('Please enter your email');
}
