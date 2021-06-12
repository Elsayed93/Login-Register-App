<?php
session_start();
require_once '../../includes/header.php';
//
// var_dump($_SESSION);
// die;

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
?>

    </head>

    <body>
        <?php require_once '../../includes/navBar.php'; ?>
        <div class="container">
            <?php if (isset($_SESSION['errors'])) {
            ?>
                <div class="row mt-3">
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                        <div class="alert alert-danger" role="alert">
                            <?php
                            echo $_SESSION['errors'];
                            unset($_SESSION['errors']);
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Create A Post</h5>
                            <form action="../controllers/Posts/createPostController.php" method="POST" autocomplete="off">
                                <div class="mb-3">
                                    <label for="post_title" class="form-label">Post Title</label>
                                    <input type="text" name="title" class="form-control" id="post_title" placeholder="Post Title">
                                </div>
                                <div class="mb-3">
                                    <label for="post_content" class="form-label">Post Content</label>
                                    <textarea class="form-control" name="content" id="post_content" rows="10" placeholder="post content"></textarea>
                                </div>
                                <input type="submit" class="btn btn-primary" name="submit_post" value="Submit">
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
?>
    <p class="lead"> You have to <a href="../index.php">Login</a></p>
<?php
}
