<?php
session_start();
require_once 'includes/header.php';


if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('location:views/home.php');
} else {
?>
    <!-- custom css style -->
    <link rel="stylesheet" href="css/home.css">

    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Sign In</h5>
                            <form class="form-signin" action="controllers/signInValidation.php" method="POST">
                                <div class="form-label-group">
                                    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                                    <label for="inputEmail">Email address</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                                    <label for="inputPassword">Password</label>
                                </div>

                                <!-- <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Remember password</label>
                        </div> -->
                                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                               
                                <div class="form-label-group mt-2">
                                    <a href="views/resetPassword.php">Reset Password</a>
                                </div>

                                <hr class="my-4">

                                <div class="_6ltg"><a role="button" href="register.php" ajaxify="/reg/spotlight/" id="u_0_2_h8" style="color: white;text-decoration: none;">Create New Account</a></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>

<?php

}


?>