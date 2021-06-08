<?php

session_start();
require_once '../includes/header.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

?>
    </head>

    <body>
        <?php require_once '../includes/navBar.php'; ?>

        <div class="container mt-3">
            <?php if (isset($_SESSION['success_postCreated'])) {
            ?>
                <div class="row mt-3">
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                        <div class="alert alert-success" role="alert">
                            <?php
                            echo $_SESSION['success_postCreated'];
                            unset($_SESSION['success_postCreated']);
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            } elseif (isset($_SESSION['failed_postCreated'])) {
            ?>
                <div class="row mt-3">
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                        <div class="alert alert-danger" role="alert">
                            <?php
                            echo $_SESSION['success_postCreated'];
                            unset($_SESSION['success_postCreated']);
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <div class="row">
                <div>
                    <h2> Welcome <span style="text-decoration: underline;"> <?php echo $_SESSION['user_name'];  // get user name from navBar page
                                                                            ?> </span> to home page </h2>
                </div>
            </div>
            <!-- <div class="row mt-3">
                <div class="col-md-2">
                    <a href="../controllers/logOut.php" class="btn btn-primary">Log Out</a>
                </div>
                <div class="col-md-3">
                    <a href="changeEmail.php" class="btn btn-primary">Change My Email</a>
                </div>

                <div class="col-md-3">
                    <a href="changePassword.php" class="btn btn-primary">Change My Password</a>
                </div>

                <div class="col-md-3">
                    <a href="changeUserName.php" class="btn btn-primary">Change User Name</a>
                </div>
            </div> -->
        </div>


    </body>

    </html>
<?php
} else {
    die('You should login');
}
?>