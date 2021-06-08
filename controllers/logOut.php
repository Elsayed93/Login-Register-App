<?php

session_start();

if (isset($_SESSION)) {
    
    session_unset();
}
require_once '../includes/navBar.php';
?>
<div class="container mt-3">
    <h3>You are logged out, We hope to see you soon </h3>
</div>