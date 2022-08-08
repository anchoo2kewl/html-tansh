<?php
$configs = include('config.php');

if ( isset($_POST['name']) && isset($_POST['number']) && isset($_POST['email'])) {
    $name=htmlspecialchars($_POST['name']);
    $email=htmlspecialchars($_POST['email']);
    $number=htmlspecialchars($_POST['number']);
    if(!is_numeric($number) || empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location: /?message=failure");
    } else {
        header("location: /?message=success");
    }
    
} else {
    header("location: /?message=failure");
}
die;    