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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<header>
    <a href="index.php" class="logo">
        <i class='bx bxs-movie'></i> InstantCiné
    </a>

    <ul class="navbar">
        <li><a href="index.php"> Accueil </a></li>
        <li><a href="index.php#movies"> Cinéma </a></li>
        <li><a href="index.php#coming"> Prochainement </a></li>
        <li><a href="#" id="open-legal"> Mention Légal </a></li>
    </ul>
    <form action="recherche.php" id="menu-hamburger" method="GET">
    <i class="fa-solid fa-bars" id="menu-icon"></i>
        <div class="search-container">
            <input type="text" name="recherche" id="search-box" placeholder="Rechercher...">
        </div>
    </form>
</header>

<div id="legal-popup" class="popup-mentions-container" style="display: none;">
    <div class="popup-mentions-content">
        <div class="popup-mentions-header">
            <h2>Mentions Légales</h2>
            <button id="close-popup" class="popup-mentions-close-btn">&times;</button>
        </div>
        <div class="popup-mentions-body">
            <section>
                <h3>Crédits Photos</h3>
                <ul>
                    <li>Photo du litchi prise ici : <a href="https://www.cultures-sucre.com/parcours-gourmands/le-litchi/">Culture sucre</a> (Définition de la photo compressée pour le site).</li>
                    <li>Photo du sweatshirt prise ici : <a href="https://www.pinterest.fr/pin/351912460188790/">Pinterest</a> (Définition de la photo compressée pour le site).</li>
                    <li>Photo du Printemps prise ici : <a href="https://virginiehilssone.com/le-printemps-une-saison-rude-pour-notre-sante/">Photo par Virginnie Hilssone</a> (Définition de la photo compressée pour le site).</li>
                    <li>Photo du bleu pastel prise ici : <a href="https://fr.freepik.com/vecteurs-libre/aquarelle-texture-fond_1313322.htm#query=bleu%20pastel&position=10&from_view=keyword&track=ais&uuid=0c35a657-cb4f-4e85-a84b-02a0d3b9e856">Freepik</a> (Définition de la photo compressée pour le site).</li>
                    <li>Photo de la rose rouge prise ici : <a href="https://fr.wikipedia.org/wiki/Baccara_(rose)">Wikipedia</a> (Définition de la photo compressée pour le site).</li>
                    <li>Photo du loup prise ici : <a href="https://pixabay.com/fr/photos/loup-gris-loup-des-bois-loup-7589920/">Pixabay</a> (Définition de la photo compressée pour le site).</li>
                    <li>Photo du feu prise ici : <a href="https://www.lenergietoutcompris.fr/actualites-conseils/feu-de-cheminee-comment-eviter-laccident">Lenergietoutcompris</a> (Définition de la photo compressée pour le site).</li>
                </ul>
            </section>
            <section>
                <h3>Stockage des Données</h3>
                <p>
                    Les données entrées lorsque vous créez votre analogie sont enregistrées sur un serveur en France.
                    Votre mail et votre adresse IP sont également stockés sur le serveur pendant 1 an (toutes les données
                    seront supprimées l'été prochain). La personne en charge du traitement de ces données est Philipe
                    GAMBETTE (<a href="mailto:philippe.gambette@univ-eiffel.fr">philippe.gambette@univ-eiffel.fr</a>) pour plus de détails.
                </p>
            </section>
            <section>
                <h3>Éditeur du Site</h3>
                <p>
                    Site édité par Victoria Heddad (<a href="mailto:victoria.heddad@univ-eiffel.fr">victoria.heddad@univ-eiffel.fr</a>) dans le cadre de la SAE 1.05
                </p>
                <p>&copy; Victoria Heddad, 2023.</p>
            </section>
        </div>
    </div>
</div>

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
<script src="hamburger.js"></script>
<script src="popup-mention.js"></script>
</html>
