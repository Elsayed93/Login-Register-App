<?php


// clear inputs data 
function validateData($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);

    return $data;
}
