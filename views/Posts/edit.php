<?php
session_start();
require_once '../../includes/header.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    if (isset($_GET) && !empty($_GET['id'])) {
        // get post with id 
        require_once '../../includes/connectionDB.php';
        $getPost = $db->prepare("SELECT * From `posts` WHERE id=:id");
        $getPost->execute([
            ':id' => $_GET['id'],
        ]);

        $post = $getPost->fetch();
        if ($post === false) {
?>
            <div class="container mt-5">
                <p class='lead'>404: Not Found</p>
            </div>
        <?php
            die;
        }
    } else {
        ?>
        <div class="container mt-5">
            <p class='lead'>404: Not Found</p>
        </div>
    <?php
        die;
    }

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
                            <form action="../../controllers/Posts/UpdateController.php" method="POST" autocomplete="off">
                                <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
                                <div class="mb-3">
                                    <label for="post_title" class="form-label">Post Title</label>
                                    <input type="text" name="title" class="form-control" id="post_title" value="<?php echo $post['title'] ?>" placeholder="Post Title">
                                </div>
                                <div class="mb-3">
                                    <label for="post_content" class="form-label">Post Content</label>
                                    <textarea class="form-control" name="content" id="post_content" rows="10" placeholder="post content"><?php echo $post['content'] ?></textarea>
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
