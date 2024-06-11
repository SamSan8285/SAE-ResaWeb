<?php
// Paramètres de connexion à la base de données en ligne
// $servername = "localhost";
// $username = "heddad_victoria";
// $password = "J2s0Sf9Oqmm0";
// $dbname = "heddad_cinema";


// Paramètres de connexion à la base de données en localhost via XAMPP ou WAMP
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";


// Création de la connexion
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($mysqli->connect_error) {
    die("Connexion échouée : " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8mb4");
// Retournez l'objet mysqli pour une utilisation ultérieure
return $mysqli;
?>
  