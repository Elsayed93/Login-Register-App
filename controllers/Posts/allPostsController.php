<?php

// session_start();
require_once '../../includes/connectionDB.php';

try {
    //code...
    // get all user's posts
    $getAllPosts = $db->prepare("SELECT * FROM `posts` WHERE `user_id`=:userId");
    $getAllPosts->execute([
        ':userId' => $_SESSION['user_id'],
    ]);

    $_SESSION['all_posts'] = $getAllPosts->fetchAll();
    // header('location: ../views/Posts/allPosts.php');
} catch (\PDOException $th) {
    //throw $th;
    die('Error: ' . $th->getMessage());
}
