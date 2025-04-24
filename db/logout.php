<?php
define ('__ROOT__', dirname(dirname(__FILE__)));
include_once(__ROOT__.'/classes/Users.php');
$users = new Users();
$users->logout();
?>