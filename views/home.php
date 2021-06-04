<?php

session_start();
require_once '../includes/header.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

?>
    </head>

    <body>

        <div class="container mt-3">

            <div class="row">
                <div class="col-4">
                    <h2> Welcome to home page </h2>
                </div>
            </div>
            <div class="row mt-3">
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
            </div>
        </div>


    </body>

    </html>
<?php
} else {
    die('You should login');
}
?>