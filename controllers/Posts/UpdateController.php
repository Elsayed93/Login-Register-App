<?php
session_start();
require_once '../../includes/functions.php';
require_once '../../includes/connectionDB.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

    if (!isset($_POST['title']) || empty($_POST['title'])) {
        // var_dump(header('../../views/Posts/edit.php'));
        // die;
        $_SESSION['errors'] = 'title shouldn\'t be empty!';
        header('../../views/Posts/edit.php');
    }

    if (!isset($_POST['content']) || empty($_POST['content'])) {
        $_SESSION['errors'] = 'content shouldn\'t be empty!';
        header('location: ../../views/Posts/edit.php');
    }

    if (isset($_POST['post_id'], $_POST['submit_post']) && !empty($_POST['post_id']) && ($_POST['submit_post'] === 'Submit')) {
        // .... code here 
        $postTitle = $_POST['title'];
        $postContent = $_POST['content'];
        /**
         * fields validation 
         * 
         * 
         * post title validation
         */
        $postTitle = postValidation($postTitle);
        if (strlen($postTitle) > 50) {
            $_SESSION['errors'] = 'post title should not be more than 50';
            header('location: ../../views/Posts/edit.php');
        }

        // post content validation
        $postContent = postValidation($postContent);
        if (!$postContent) {
            $_SESSION['errors'] = 'Enter a valid Post Content';
            header('location: ../../views/Posts/edit.php');
        }

        // update post 
        $updatePost = $db->prepare("UPDATE `posts` SET `title`=:postTitle,`content`=:postContent,`updated_at`=CURRENT_TIMESTAMP WHERE id = :post_id");
        $updatePost->execute([
            ':postTitle' => $postTitle,
            ':postContent' => $postContent,
            // ':user_id' => $_SESSION['user_id'],
            ':post_id' => $_POST['post_id'],
        ]);

        if ($updatePost->rowCount()) {
            $_SESSION['success_update'] = 'Post has been Updated Successfully';
            header('location: ../../views/Posts/allPosts.php');
        }else{
            $_SESSION['errors'] = 'Post has not been Updated Successfully';
            header('location: ../../views/Posts/edit.php');
        }
    } else {
        header('location: ../../views/Posts/allPosts.php');
    }
    //

} else {
?>
    <p class="lead"> You have to <a href="../index.php">Login</a></p>
<?php
}
?>