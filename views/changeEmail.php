<?php
session_start();
require_once '../includes/header.php';
require_once '../includes/navBar.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

?>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Change Your Email</h5>
                            <form action="../controllers/changeEmailController.php" method="POST">
                                <div class="mb-3">
                                    <label for="oldEmail" class="form-label">Old Email address</label>
                                    <input type="email" class="form-control" id="oldEmail" name="oldEmail" placeholder="enter old email">
                                </div>
                                <div class="mb-3">
                                    <label for="newEmail" class="form-label">New Email address</label>
                                    <input type="email" class="form-control" id="newEmail" name="newEmail" placeholder="enter new email">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="enter your password">
                                </div>
                                <button type="submit" class="btn btn-primary">Change Email</button>
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