<?php

require_once 'connectionDB.php';
require_once 'header.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $userName = $_SESSION['user_name'];

    $getProfilePic = $db->prepare("SELECT image FROM `users` WHERE id=:userId");
    $getProfilePic->execute([
        ':userId' =>  $_SESSION['user_id']
    ]);

    $profile_pic = $getProfilePic->fetch();
    if (!$profile_pic) {
        $profile_pic = 'error loading image';
    }
}

?>



<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #d4d4d4!important;">
    <div class="container-fluid">
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        ?>
            <a class="navbar-brand ms-3" href="/php/Login-Register-App/index.php"><img src="/php/Login-Register-App/images/<?php echo $profile_pic['image'] ?>" alt="profile picture" id="profilePic"></a>
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
                            <li><a class="dropdown-item" href="/php/Login-Register-App/views/Posts/createPost.php">create a Post</a></li>
                            <?php
                            // var_dump($_SESSION);
                            // die;
                            if ($_SESSION['privilege'] == 1) {
                            ?>
                                <li><a class="dropdown-item" href="/php/Login-Register-App/views/Posts/allPosts.php">All Posts</a></li>
                            <?php
                            }
                            ?>
                            <li><a class="dropdown-item" href="/php/Login-Register-App/views/changeProfileImage.php">Change profile Image</a></li>
                            <li><a class="dropdown-item" href="/php/Login-Register-App/views/changeUserName.php">Change User Name</a></li>
                            <li><a class="dropdown-item" href="/php/Login-Register-App/views/changeEmail.php">Change My Email</a></li>
                            <li><a class="dropdown-item" href="/php/Login-Register-App/views/changePassword.php">Change My Password</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/php/Login-Register-App/controllers/logOut.php">Log Out</a></li>
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
            </div>
    </div>
</nav>