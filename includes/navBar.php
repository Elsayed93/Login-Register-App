<?php

require_once 'connectionDB.php';
require_once 'header.php';

// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';
// die;
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $userName = $_SESSION['user_name'];
}

?>



<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #d4d4d4!important;">
    <div class="container-fluid">
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        ?>
            <a class="navbar-brand ms-3" href="../index.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">


                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5 pe-5">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black;">
                            <?php
                            echo $userName;
                            ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../views/createPost.php">create a Post</a></li>
                            <?php
                            // var_dump($_SESSION);
                            // die;
                            if ($_SESSION['privilege'] == 1) {
                            ?>
                                <li><a class="dropdown-item" href="../controllers/allPostsController.php">All Posts</a></li>
                            <?php
                            }
                            ?>
                            <li><a class="dropdown-item" href="../views/changeUserName.php">Change User Name</a></li>
                            <li><a class="dropdown-item" href="../views/changeEmail.php">Change My Email</a></li>
                            <li><a class="dropdown-item" href="../views/changePassword.php">Change My Password</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../controllers/logOut.php">Log Out</a></li>
                        </ul>
                    </li>
                </ul>

            <?php
        } else {
            ?>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5 pe-5">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black;">
                            Welcome
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../index.php">Login</a></li>
                            <li><a class="dropdown-item" href="../register.php">Create An Account</a></li>
                        </ul>
                    </li>
                </ul>
            <?php
        }
            ?>
            <!-- <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
            </div>
    </div>
</nav>