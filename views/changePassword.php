<?php
session_start();
require_once '../includes/header.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

?>
    </head>

    <body>
    <?php require_once '../includes/navBar.php'; ?>

        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Change Your Password</h5>
                            <form action="../controllers/changePasswordController.php" method="POST">
                                <div class="mb-3">
                                    <label for="oldPassword" class="form-label">Old Password</label>
                                    <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="enter old password">
                                </div>
                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="enter new password">
                                </div>
                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm-newPassword" name="confirm-newPassword" placeholder="confirm password">
                                </div>
                                <button type="submit" class="btn btn-primary">Change Password</button>
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
    die('You should login');
}

?>