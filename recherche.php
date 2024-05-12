<?php
require 'conn.php';  // Inclusion de la connexion à la base de données

// Préparation des filtres
$recherche = $_GET['recherche'] ?? '';
$ordre = $_GET['ordre'] ?? 'ASC';
$genre = $_GET['genre'] ?? '';

// Requête pour obtenir les genres
$genreQuery = "SELECT DISTINCT genre FROM genre ORDER BY genre";
$genreResult = $mysqli->query($genreQuery);
$genres = [];
while ($row = $genreResult->fetch_assoc()) {
    $genres[] = $row['genre'];
}

// Construction de la requête principale pour les films
$sql = "SELECT f.*, GROUP_CONCAT(g.genre ORDER BY g.genre SEPARATOR ', ') AS genres 
        FROM film f
        LEFT JOIN film_genre fg ON f.id = fg.film_id
        LEFT JOIN genre g ON fg.genre_id = g.id
        WHERE f.titre_film LIKE CONCAT('%', ?, '%')";

$params = [$recherche];  // Paramètres pour le bind_param

// Filtrer par genre si spécifié
if (!empty($genre)) {
    $sql .= " AND g.genre = ?";
    $params[] = $genre;
}

// Ajouter l'ordre de tri
$sql .= " GROUP BY f.id ORDER BY f.annee_sortie $ordre";

$query = $mysqli->prepare($sql);
$query->bind_param(str_repeat("s", count($params)), ...$params);
$query->execute();
$result = $query->get_result();

$filmsALAffiche = [];
$filmsBientot = [];

while ($film = $result->fetch_assoc()) {
    if ($film['disponibilite'] === 'a l\'affiche') {
        $filmsALAffiche[] = $film;
    } elseif ($film['disponibilite'] === 'bientot') {
        $filmsBientot[] = $film;
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de Recherche</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
        <a href="index.php" class="logo">
            <i class='bx bxs-movie' ></i> InstantCiné
        </a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="" class="home-active"> Accueil </a></li>
            <li><a href="#movies"> Cinéma </a></li>
            <li><a href="#coming"> Prochainement </a></li>
            <li> <a href=""> Mention Légal </a></li>
        </ul>
</header>

<!-- Affichage des films toujours à l'affiche -->
<form id="form-movie-search" action="recherche.php" method="GET">
    <input type="text" name="recherche" placeholder="Rechercher..." value="<?php echo htmlspecialchars($recherche); ?>">
    <select name="ordre">
        <option value="ASC" <?php echo $ordre == 'ASC' ? 'selected' : ''; ?>>Date Ascendante</option>
        <option value="DESC" <?php echo $ordre == 'DESC' ? 'selected' : ''; ?>>Date Descendante</option>
    </select>
    <select name="genre">
        <option value="">Tous les genres</option>
        <?php foreach ($genres as $g): ?>
            <option value="<?php echo htmlspecialchars($g); ?>" <?php echo ($genre == $g) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($g); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Filtrer</button>
</form>
<section class="toujours-affiche">
 <div class="search-movies">
    <h2 id="movies">Toujours à l'affiche :</h2>
</div>
    <div class="film-affiche <?php echo (count($filmsALAffiche) <= 3) ? 'special-justify' : ''; ?>" id="toujours-disponible">
        <?php foreach ($filmsALAffiche as $film): ?>
            <a href="info-film.php?film=<?php echo urlencode($film['titre_film']); ?>">
                <img src="<?php echo htmlspecialchars($film['image_path']); ?>" alt="<?php echo htmlspecialchars($film['titre_film']); ?>">
            </a>
        <?php endforeach; ?>
    </div>
</section>


<!-- Affichage des films bientôt à l'affiche -->
<section class="toujours-affiche">
    <h2 id="coming">Bientôt à l'affiche :</h2>
    <div class="film-affiche <?php echo (count($filmsALAffiche) <= 3) ? 'special-justify' : ''; ?>"  id="bientot-disponible">
        <?php foreach ($filmsBientot as $film): ?>
            <a href="info-film.php?film=<?php echo urlencode($film['titre_film']); ?>">
                <img src="<?php echo htmlspecialchars($film['image_path']); ?>" alt="<?php echo htmlspecialchars($film['titre_film']); ?>">
            </a>
        <?php endforeach; ?>
    </div>
</section>

</body>
</html>
