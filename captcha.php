<?php
session_start();

// if( isset($_SESSION['username']) ) header('Location: index.php');
function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = substr(str_shuffle($characters),0,$length);
    return $randomString;
}

$_SESSION['captcha_id'] = generateRandomString();

?>