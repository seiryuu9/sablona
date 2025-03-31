<?php
//include_once 'config.php';
//
//// Možnosti
//$options = array(
//    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//);
//
//// Pripojenie PDO
//try {
//    $conn = new PDO('mysql:host='.$host.';dbname='.$dbname.";port=".$port, $username,
//        $password, $options);
//} catch (PDOException $e) {
//    die("Chyba pripojenia: " . $e->getMessage());
//}
//
//// Získanie údajov z formulára
//$meno = $_GET["meno"];
//$email = $_GET["email"];
//$sprava = $_GET["sprava"];
//// SQL príkaz INSERT
//$sql = "INSERT INTO udaje (meno, email, sprava)
//    VALUE ('".$meno."', '".$email."', '".$sprava."')";
//$statement = $conn->prepare($sql);
//try {
//    $insert = $statement->execute();
//    header("Location: http://localhost/sablona/thankyou.php");
//    return $insert;
//} catch (\Exception $exception) {
//    return false;
//}
//// Zatvorenie pripojenia
//$conn = null;

require_once('../classes/Kontakt.php');

use formular\Kontakt;

$meno = $_POST['meno'];
$email = $_POST['email'];
$sprava = $_POST['sprava'];

// Overenie údajov
if (empty($meno) || empty($email) || empty($sprava)) {
    die('Chyba: Všetky polia sú povinné!');
}
// Uloženie správy do databázy
$kontakt = new Kontakt();
$ulozene = $kontakt->ulozitSpravu($meno, $email, $sprava);

if ($ulozene) {
    header('Location: ../thankyou.php');
} else {
    die('Chyba pri odosielaní správy do databázy!');
    http_response_code(404);
}
