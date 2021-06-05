<?php

require_once 'connectionDB.php';
require_once 'header.php';

$userNameStmt = $db->prepare("SELECT `user_name` FROM `users` WHERE `email`=:email");
$userNameStmt->execute([
    'email' => $_SESSION['email'],
]);

$userName = $userNameStmt->fetch();
?>



<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand ms-3" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5 pe-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black;">
                        <?php
                        echo $userName['user_name'];
                        ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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
            <!-- <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
        </div>
    </div>
</nav>