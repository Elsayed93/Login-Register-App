<?php
session_start();
require_once '../includes/header.php';

if(isset($_SESSION)){
    echo "
    <div class='container mt-3'>
        <p class='lead'>you are logging in, go to home ? </p><a href='../index.php' class='btn btn-primary'>home </a>
    </div>
    ";
    die;
}
?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Reset Your Password</h5>
                        <form action="../controllers/resetPasswordController.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="enter your email">
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