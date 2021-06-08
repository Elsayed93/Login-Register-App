<?php

session_start();
require_once '../includes/connectionDB.php';
require_once '../includes/functions.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    if (
        isset($_POST['title'], $_POST['content'], $_POST['submit_post'])
        && !empty($_POST['title'])
        && !empty($_POST['content'])
        && $_POST['submit_post'] === 'Submit'
    ) {

        $postTitle = $_POST['title'];
        $postContent = $_POST['content'];
        $userId = $_SESSION['user_id'];
        $userName = $_SESSION['user_name'];

        // post title validation
        $postTitle = postValidation($postTitle);
        if (strlen($postTitle) > 50) {
            die('post title should not be more than 50');
        }

        // // post content validation
        $postContent = postValidation($postContent);

        // store post in DB
        try {
            //code...
            $postStmt = $db->prepare("INSERT INTO `posts`( `title`, `content`, `user_id`, `user_name`) VALUES (:title,:content,:user_id,:user_name)");
            $postStmt->execute([
                ':title' => $postTitle,
                ':content' => $postContent,
                ':user_id' => $userId,
                ':user_name' => $userName,
            ]);

            if ($postStmt->rowCount()) {
                $_SESSION['success_postCreated'] = 'Post has been created successfully';
                header('location: ../views/home.php');
            } else {
                $_SESSION['failed_postCreated'] = 'Post has not been created';
                header('location: ../views/home.php');
            }
        } catch (\PDOException $th) {
            //throw $th;
            echo "Error: " . $th->getMessage();
            die;
        }

        // 
    } else {
        $_SESSION['errors'] = 'You should fill all Inputs';
        header('location: ../views/createPost.php');
    }
} else {
    die('You have to loggin ');
}
