<?php
// Inclusion de la connexion à la base de données
require 'conn.php';

// Préparer et exécuter la requête pour obtenir les films à l'affiche
$filmsALAffiche = [];
$filmsBientot = [];

$query = "SELECT titre_film, image_path, disponibilite FROM film";
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        if ($row['disponibilite'] === "a l'affiche") {
            $filmsALAffiche[] = $row;
        } elseif ($row['disponibilite'] === "bientot") {
            $filmsBientot[] = $row;
        }
    }
    $result->close();
}

// Utiliser getFilmDetails ou d'autres fonctions ici

// Fermer la connexion après toutes les opérations
$mysqli->close();

function getFilmDetails($mysqli, $titreFilm) {
    require "conn.php";
    // Nettoyez le titre du film pour éviter les injections SQL
    $titreFilm = mysqli_real_escape_string($mysqli, $titreFilm);
    $filmDetails = null;

    // Requête pour obtenir les informations du film
    $query = "SELECT titre_film, duree, fk_id_genre, synopsis, trailer_url, fk_id_rea FROM film WHERE titre_film = ?";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("s", $titreFilm);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $filmDetails = $row;
        }
        $stmt->close();
    }

    return $filmDetails;
}
?>
