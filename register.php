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
    <!-- 
    <?php require_once 'includes/navBar.php' ?>
     -->
        <!-- register form -->
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Register Page</h5>
                            <form action="controllers/signUpValidation.php" method="POST">
                                <div class="mb-3">
                                    <label for="username" class="form-label">User Name</label>
                                    <input name="username" type="text" class="form-control" id="username" placeholder="enter your username">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter your email">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="enter your password">
                                </div>
                                <div class="mb-3">
                                    <label for="confirmation-password" class="form-label">Confirmation Pasword</label>
                                    <input name="confirmation-password" type="password" class="form-control" id="confirmation-password" placeholder="confirm password">
                                </div>
                                <button name="register" type="submit" class="btn btn-primary mb-5" value="register">Register</button>
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