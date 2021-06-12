<?php
session_start();
// require_once '../../includes/functions.php';
require_once '../../includes/connectionDB.php';
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
        // delete a post, if not exist >>> not found 
        $deletePost = $db->prepare("DELETE FROM `posts` WHERE id =:post_id");
        $deletePost->execute([
            ':post_id' => $_GET['id'],
        ]);
        //
        if ($deletePost->rowCount()) {
            $_SESSION['success_delete'] = 'Post has been deleted Successfully';
            header('location: ../../views/Posts/allPosts.php');
        } else {
            $_SESSION['errors'] = 'Post has not been deleted Successfully';
            header('location: ../../views/Posts/allPosts.php');
        }
    } else {
        ?>
        <div class="container mt-5">
            <p class='lead'>404: Not Found</p>
        </div>
    <?php
        die;
    }
} else {
    ?>
    <p class="lead"> You have to <a href="../index.php">Login</a></p>
<?php
}
?>