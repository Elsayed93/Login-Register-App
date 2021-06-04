<?php

session_start();
require_once '../includes/header.php';

$email = $_SESSION['email'];
$password = $_SESSION['password'];

if (isset($_SESSION) && $_SESSION['logged_in'] === true) {
?>

    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Change Your User Name</h5>
                            <form action="../controllers/changeUserNameController.php" method="POST">
                                <input type="hidden" name="email" value="<?php echo $email ?>">

                                <div class="mb-3">
                                    <label for="newUserName" class="form-label">New User Name</label>
                                    <input type="text" class="form-control" id="newUserName" name="newUserName" placeholder="enter user name">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="enter your password">
                                </div>
                                <button type="submit" class="btn btn-primary">Change User Name</button>
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
