<?php
session_start();
require_once '../includes/header.php';

?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Active Your Email</h5>
                        <form action="../controllers/activeEmailController.php" method="POST">
                            <div class="mb-3">
                                <label for="activateEmail" class="form-label">Enter Email address</label>
                                <input type="email" class="form-control" id="activateEmail" name="activateEmail" placeholder="enter your email">
                            </div>
                            <button type="submit" class="btn btn-primary">Active Email</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>