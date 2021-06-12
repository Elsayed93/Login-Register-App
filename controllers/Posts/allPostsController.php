<?php

// session_start();
require_once '../../includes/connectionDB.php';

try {
    //code...
    // get all posts
    $getAllPosts = $db->prepare("SELECT * FROM `posts`");
    $getAllPosts->execute();

    $_SESSION['all_posts'] = $getAllPosts->fetchAll();
    // header('location: ../views/Posts/allPosts.php');
} catch (\PDOException $th) {
    //throw $th;
    die('Error: ' . $th->getMessage());
}
