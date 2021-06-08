<?php


// clear inputs data 
function validateData($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);

    return $data;
}

// post title && content validation
function postValidation($data)
{
    $data = validateData($data);
    $data = filter_var($data, FILTER_SANITIZE_STRING);
    return $data;
}
