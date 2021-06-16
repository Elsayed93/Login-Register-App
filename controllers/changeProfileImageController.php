<?php

session_start();
// var_dump($_POST);
// echo '<hr>';
// var_dump($_FILES);
// echo '<hr>';
// var_dump($_SESSION);
// die;

if (isset($_FILES['profileImage']) && !empty($_FILES['profileImage'])) {

    $image_type = $_FILES['profileImage']['type'];
    $image_size = $_FILES['profileImage']['size']; // in Byte
    $error = $_FILES['profileImage']['error'];

    $image_extension = explode('.', $_FILES['profileImage']['name']);
    $image_extension = strtolower(end($image_extension));

    // check if image extension is in my extensions 
    $extensions = ['jpeg', 'jpg', 'png', 'gif'];
    if (!(in_array($image_extension, $extensions))) {
        die('not valid image extension');
    }

    // size validation 
    if ($image_size > 20000) {
        die('Image size should not be more than 20 kB');
    }

    // move image from tmp path to server directory

    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["profileImage"]["tmp_name"];
        // basename() may prevent filesystem traversal attacks;
        // further validation/sanitation of the filename may be appropriate
        $name = basename($_FILES["profileImage"]["name"]);
        // var_dump($name);
        // die;
        // change image name to be random 
        $name = time() . rand(1, 100) . $name;
        if (move_uploaded_file($tmp_name, "../images/$name")) {
            // insert image name in DB
            require_once '../includes/connectionDB.php';

            $insertImage = $db->prepare("UPDATE `users` SET `image`=:image_name WHERE id=:user_id");
            $insertImage->execute([
                ':image_name' => $name,
                ':user_id' => $_SESSION['user_id']
            ]);

            if ($insertImage->rowCount()) {
                $_SESSION['image_upload_success'] = 'Profile Picture has been changed successfully';
                header('location: ../index.php');
            } else {
                $_SESSION['image_upload_failed'] = 'Profile Picture has not been changed';
                header('location: ../views/changeProfileUmage.php');
            }
            //
        } else {
            die('an error occured, can\'t upload image');
        }
    }

    //

} else {
    die('no image choosen, please try again');
}
