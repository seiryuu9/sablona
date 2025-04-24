<?php

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/classes/Database.php');

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if (empty($username) || empty($email) || empty($password)){
    die("Vsetky polia musia byt vyplnene!");
}

try{
    $user = new Users();
    $user->register($username, $email, $password);
    return header("location: ../thankyou.php");
} catch (Exception $e) {
    http_response_code(404);
    die("Chyba pri odosielani spravy do databazy");
}
