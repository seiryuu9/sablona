<?php

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/classes/Database.php');


class Users extends Database
{
    private $rola;
    protected $connection;

    public function __construct()
    {
        $this->rola = "pouzivatel";
        $this->connect();
        $this->connection = $this->getConnection();
    }

    public function register($login, $email, $password)
    { try{
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM pouzivatelia WHERE (login = ? OR email = ?) LIMIT 1;";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $login);
        $statement->bindParam(2, $email);
        $statement->execute();
        $existingUser = $statement->fetch();
        if ($existingUser) {
            throw new Exception("Uzivatel uz existuje!");
        }
        $sql = "INSERT INTO pouzivatelia (login, email, heslo, rola) VALUES (?, ?, ?, ?);";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $login);
        $statement->bindParam(2, $email);
        $statement->bindParam(3, $hashedPassword);
        $statement->bindParam(4, $this->rola);
        $statement->execute();

    } catch (Exception $e)
    {
    echo "Chyba pri vkladani do databazy: " . $e->getMessage();
    } finally {
        $this->connection = null;
    }
    }

    public function login($email, $password){
        $sql = "SELECT * FROM pouzivatelia WHERE email = ?;";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $email);
        $statement->execute();
        $user = $statement->fetch();
        if(!$user){
            throw new Exception("Nebylo nalezeno!");
        }

        $storedPassword = $user['heslo'];
        if(!password_verify($password, $storedPassword)){
            throw new Exception("Nespravne heslo!");
        }
        session_start();
        $_SESSION['user_id'] = $user['ID'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['rola'] = $user['rola'];
    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        header("Location: http://localhost/cvicnasablona/index.php");
        exit();
    }

    public function isAdmin(){
        session_start();
        if(isset($_SESSION['rola']) && $_SESSION['user_id']) {
            if ($_SESSION['rola'] == 'admin') {
                return true;
            } else {
                echo "session sa spustil, ale nie je admin";
            }
        } else {
            echo "session sa nespustil";
            return false;
        }
    }

}