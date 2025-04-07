<?php

namespace otazkyodpovede;
define('__ROOT__', dirname(dirname(__FILE__))); //root je cesta ku korenovemu adresaru projektu
require_once(__ROOT__.'/db/config.php'); //sablona/
use PDO; //php data object - pripojenie k databaze (akejkolvek)
class QnA{
    private $conn;

    public function __construct() {
        $this->connect();
    }
    private function connect()
    {
        $config = DATABASE; //zoznam v config.php

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->conn = new PDO(
                'mysql:host=' . $config['HOST'] . ';dbname=' . $config['DBNAME'] . ';port=' . $config['PORT'],
                $config['USER_NAME'], $config['PASSWORD'], $options
            );
        }catch (PDOException $e) {
            die("Chyba pripojenia: " . $e->getMessage());
        }
    }
    public function insertQnA(){ //dava qna z json do tabulky v databaze
        try {
            $this->conn->exec("ALTER TABLE qna ADD UNIQUE (otazka)"); // prida unique constraint(otazka musi bit unikatna), inak insert ignore nefunguje
            // Načítanie JSON súboru
            $data = json_decode(file_get_contents
            (__ROOT__.'/data/datas.json'), true); //zoznam
            $otazky = $data["otazky"];
            $odpovede = $data["odpovede"];
            // Vloženie otázok a odpovedí v rámci transakcie
            $this->conn->beginTransaction(); //metoda z pdo

            $sql = "INSERT IGNORE INTO qna (otazka, odpoved) VALUES (:otazka, :odpoved)"; //placeholders :

            $statement = $this->conn->prepare($sql);

            for ($i = 0; $i < count($otazky); $i++) {
                $statement->bindParam(':otazka', $otazky[$i]);
                $statement->bindParam(':odpoved', $odpovede[$i]);
                $statement->execute();
            }
            $this->conn->commit();
        }
         catch (Exception $e) {
             echo "Chyba pri vkladaní dát do databázy: " . $e->getMessage();
             $this->conn->rollback(); // Vrátenie späť zmien v prípade chyby
            }
        }
        public function getQnA() { //vypise otazky a odpovede
            try {
                $sql = "SELECT otazka, odpoved FROM qna";
                $statement = $this->conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll(); //vrati vsetky riadky

                echo '<section class="container">';
                foreach ($result as $row) {
                    echo '<div class="accordion">';
                    echo '<div class="question">' . htmlspecialchars($row['otazka']) . '</div>'; //htmlspecialchars pouzivam, ked v echo pouzivam php, aby sa z toho stala html entita
                    echo '<div class="answer">' . htmlspecialchars($row['odpoved']) . '</div>';
                    echo '</div>';
                }
                echo '</section>';
            } catch (PDOException $e) {
                echo "Chyba pri načítaní dát: " . $e->getMessage();
            } finally {
                $this->conn = null;
           }
        }
    }
