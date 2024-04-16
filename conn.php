<?php
// Paramètres de connexion à la base de données
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

// Retournez l'objet mysqli pour une utilisation ultérieure
return $mysqli;
?>
  