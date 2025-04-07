<?php

namespace formular;
error_reporting(E_ALL);
ini_set('display_errors', "On");
if (!defined('__ROOT__')) {
    define('__ROOT__', dirname(dirname(__FILE__)));
} //root je cesta ku korenovemu adresaru projektu
require_once(__ROOT__.'/classes/Database.php');

use Database;
use Exception;

class Kontakt extends Database{

    protected $conn;

    public function __construct(){

        parent::__construct();
        $this->conn = $this->getConnection();
    }


public function ulozitSpravu($meno, $email, $sprava) {
    $sql = "INSERT INTO  udaje(meno, email, sprava) 
    VALUE ('" . $meno . "', '" . $email . "', '" . $sprava . "')";
    $statement = $this->conn->prepare($sql);

    try {
        $insert = $statement->execute();
        header("Location: http://localhost/cvicnasablona/thankyou.php");
        http_response_code(200);
        return $insert;
    } catch (Exception $exception) {
        return http_response_code(404);
    }
}
public function __destruct() {
    $this->conn = null;
}
}
