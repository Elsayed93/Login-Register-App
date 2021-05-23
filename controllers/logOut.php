<?php

session_start();
if(isset($_SESSION)){
    
    session_unset();
}

// var_dump($_SESSION);
echo '<h3>You are logged out, We hope to see you soon :)';
