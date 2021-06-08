<?php

session_start();
// var_dump($_SESSION);
// die;
require_once '../includes/header.php';
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

?>

    </head>

    <body>
        <?php

        require_once '../includes/navBar.php';
        if (isset($_SESSION['all_posts']) && $_SESSION['all_posts'] !== false) {
        ?>
            <div class="container mt-5">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php
                    foreach ($_SESSION['all_posts'] as $key => $post) {
                        # code...

                    ?>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $post['title'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $post['user_name'] ?></h6>
                                    <p class="card-text"><?php echo $post['content'] ?></p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted"><strong>updated At:</strong> <?php echo $post['updated_at'] ?></small>
                                    <br>
                                    <small class="text-muted"><strong>Created At:</strong> <?php echo $post['created_at'] ?></small>
                                </div>
                            </div>
                        </div>

                    <?php
                    } ?>
                </div>
            </div>
        <?php
        } else {
            die('<p class="lead">There is no Posts </p>');
        }
        ?>

    </body>
    </html>

<?php
} else {
    die('<p class="lead">You need to <a href="../index.php">login</a>');
}
?>