<?php
session_start();
require_once '../../includes/connectionDB.php';
// var_dump($_SESSION);
// die;
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // code ... 

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        // check if post is exist
        $postCheck = $db->prepare("SELECT * FROM `posts` WHERE id =:post_id AND `user_id`=:userID");
        $postCheck->execute([
            ':post_id' => $_GET['id'],
            ':userID' => $_SESSION['user_id'],
        ]);

        if ($postCheck->rowCount() == true) {
            $post = $postCheck->fetch();
            // var_dump($post);
            // die;
            require_once '../../includes/header.php';
?>
            </head>

            <body>
                <?php require_once '../../includes/navBar.php'; ?>
                <div class="container mt-5">

                    <div class="col-md-6">
                        <div class="card" style="height: 200px;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $post['title'] ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $post['user_name'] ?></h6>
                                <p class="card-text"><?php echo $post['content'] ?></p>
                            </div>
                            <div class="card-footer">
                                <div>
                                    <a href="../../views/Posts/edit.php?id=<?php echo $post['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="../../controllers/Posts/deleteController.php?id=<?php echo $post['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                                <small class="text-muted"><strong>updated At:</strong> <?php echo $post['updated_at'] ?></small>
                                <br>
                                <small class="text-muted"><strong>Created At:</strong> <?php echo $post['created_at'] ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </body>

            </html>

<?php
        } else {
            die('404: Not Found');
        }
        //
    } else {

        die('404: Not Found');
    }
    //
} else {
    die('<p class="lead">You need to <a href="../../index.php">login</a>');
}
