<?php
// Inclusion de la connexion à la base de données
require 'conn.php';

// Préparer et exécuter la requête pour obtenir les films à l'affiche
$filmsALAffiche = [];
$filmsBientot = [];

$query = "SELECT titre_film, image_path, image_slider, disponibilite, synopsis FROM film";
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
    $titreFilm = mysqli_real_escape_string($mysqli, $titreFilm);

    // Requête pour obtenir les informations du film en utilisant l'alias 'f' pour la table 'film'
    $query = "SELECT f.titre_film, f.duree, GROUP_CONCAT(g.genre SEPARATOR ', ') AS genres, r.nom as realisateur_nom, r.prenom as realisateur_prenom, f.synopsis, f.trailer_url
              FROM film f
              JOIN film_genre fg ON f.id = fg.film_id
              JOIN genre g ON fg.genre_id = g.id
              JOIN realisateur r ON f.fk_id_rea = r.id
              WHERE f.titre_film = ?
              GROUP BY f.id";

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

// Convertit une durée en minutes en format H:M pour une meilleur lisibilité
function convertDurationToHours($minutes) {
    $hours = floor($minutes / 60);
    $remainingMinutes = $minutes % 60;
    $result = "{$hours}h";
    if ($remainingMinutes > 0) {
        $result .= "{$remainingMinutes}m";
    }
    return $result;
}
?>
