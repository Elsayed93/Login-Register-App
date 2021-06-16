<?php

session_start();
require_once '../includes/header.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

?>
    </head>

    <body>
        <?php

        require_once '../includes/navBar.php';

        if (isset($_SESSION['image_upload_failed']) && !empty($_SESSION['image_upload_failed'])) {
        ?>
            <div class="row mt-3">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="alert alert-success" role="alert">
                        <?php
                        echo $_SESSION['image_upload_failed'];
                        unset($_SESSION['image_upload_failed']);
                        ?>
                    </div>
                </div>
            </div>

        <?php

        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Change Your Profile Image</h5>

                            <form action="../controllers/changeProfileImageController.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="profileImage" class="form-label">Upload Image</label>
                                    <input type="file" class="form-control" id="profileImage" name="profileImage" placeholder="upload image">
                                </div>
                                <button type="submit" class="btn btn-primary">Change Image</button>
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
    die(' <p class="lead">You need to <a href="/php/Login-Register-App/index.php">Loggin</a></p>');
}
