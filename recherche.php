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
                <h3>Responsable du Site</h3>
                <p>
                    Victoria Heddad<br>
                    Adresse e-mail : <a href="mailto:victoriahedda04@gmail.com">victoriahedda04@gmail.com</a>
                </p>
            </section>
            <section>
                <h3>Hébergeur</h3>
                <p>
                    Nom : o2switch<br>
                    Adresse : Chemin des Pardiaux, 63000 Clermont-Ferrand, France<br>
                    Téléphone : 04 44 44 60 40
                </p>
            </section>
            <section>
                <h3>Catégorie d'Images</h3>
                <p>
                    Photo Veuve Noire :<br>
                    <a href="https://www.pinterest.fr/pin/318981586121955742/">Pinterest</a><br>
                    <a href="https://www.google.com/imgres?imgurl=https://fr.web.img3.acsta.net/r_654_368/newsv7/21/07/30/15/03/4397879.jpg&tbnid=KTeZ-AUjp3QTmM&vet=1&imgrefurl=https://www.allocine.fr/article/fichearticle_gen_carticle%3D18701598.html&docid=ycaknk5AHwY9HM&w=654&h=368&itg=1&hl=fr-FR&source=sh/x/im/m1/4&kgs=aa08626b63e78db6&shem=abme,ssic,trie">AlloCiné</a><br>

                    Photo Spider-Man No Way Home :<br>
                    <a href="https://www.pinterest.fr/pin/161285230399817940/">Pinterest</a><br>
                    <a href="https://www.google.com/imgres?imgurl=https://wallpapers.com/images/featured/spiderman-p4ashmgeamn2mvkn.jpg&tbnid=NfdJJYsnnl5oqM&vet=1&imgrefurl=https://wallpapers.com/spiderman&docid=ftqC55grzjSrIM&w=1920&h=1080&itg=1&hl=fr-FR&source=sh/x/im/m1/4&kgs=585983fb91a45961&shem=abme,ssic,trie">Fonds d'écran</a><br>

                    Photos Dunes :<br>
                    <a href="https://www.pinterest.fr/pin/36099234506348651/">Pinterest</a><br>
                    <a href="https://www.google.com/imgres?imgurl=https://blog.teufelaudio.fr/wp-content/uploads/2024/02/dune-2-imago415303603-2.jpg&tbnid=75w25ICwLAR0zM&vet=1&imgrefurl=https://blog.teufelaudio.fr/dune-lepopee-du-desert-continue/&docid=wnrx-TyI_hXwHM&w=1500&h=800&hl=fr-FR&source=sh/x/im/m1/4&kgs=82e6299c1f82493e&shem=abme,ssic,trie">Teufel</a><br>

                    Principe de la photo :<br>
                    <a href="https://www.pinterest.fr/pin/1337074881567351/">Pinterest</a><br>
                    <a href="https://www.google.com/imgres?imgurl=https://snobinart.fr/wp-content/uploads/2020/08/Tenet-affiche.jpg&tbnid=rYd3k47kzAaZ9M&vet=1&imgrefurl=https://snobinart.fr/culture/critique-cine-tenet-est-il-vraiment-le-chef-doeuvre-annonce/&docid=-CVFX6kSmnWPHM&w=1920&h=1200&hl=fr-FR&source=sh/x/im/m1/4&kgs=3b45147d56f63c53&shem=abme,ssic,trie">Snobinart</a><br>

                    Photo Luca :<br>
                    <a href="https://www.pinterest.fr/pin/1337074883123456/">Pinterest</a><br>
                    <a href="https://www.google.com/imgres?imgurl=https://fr.web.img5.acsta.net/newsv7/21/06/23/18/29/1314186.jpg&tbnid=ZZcLsPt5Iba16M&vet=1&imgrefurl=https://www.allocine.fr/diaporamas/cinema/diaporama-18700529/&docid=0BaRNvkV_zhGDM&w=1280&h=720&itg=1&hl=fr-FR&source=sh/x/im/m1/4&kgs=0c5458c32b01412e&shem=abme,ssic,trie">AlloCiné</a><br>

                    Photo Top Gun Maverick :<br>
                    <a href="https://twitter.com/moviemenfes/status/1772228193963168251">X</a><br>
                    <a href="https://www.google.com/imgres?imgurl=https://ds.static.rtbf.be/article/image/1920x1080/2/d/0/f5f2b301e7397493b5303c62d0046eb1-1653463265.jpg&tbnid=Lhho0uslc__fEM&vet=1&imgrefurl=https://www.rtbf.be/article/top-gun-maverick-un-pur-divertissement-al-ancienne-terriblement-efficace-a-voir-sur-grand-ecran-10999318&docid=7DZgutwrV5YGMM&w=1920&h=1079&itg=1&hl=fr-FR&source=sh/x/im/m1/4&kgs=388fdcef08f0ff0d&shem=abme,ssic,trie">RTBF</a><br>

                    Photo Le Batman :<br>
                    <a href="https://www.pinterest.fr/pin/140806232709697/">Pinterest</a><br>
                    <a href="https://www.google.com/imgres?imgurl=https://www.screentune.com/wp-content/uploads/2022/03/Critique_The_Batman_2022-_ScreenTune.png&tbnid=KCfZoTBFyUYJhM&vet=1&imgrefurl=https://www.screentune.com/critique-the-batman-2022/&docid=xe7dQx2S0FHUbM&w=1920&h=1080&hl=fr-FR&source=sh/x/im/m1/4&kgs=352e29a571d0a1a8&shem=abme,ssic,trie">ScreenTune</a><br>

                    Photo Les minions :<br>
                    <a href="https://www.pinterest.fr/pin/4925880834006994/">Pinterest</a><br>
                    <a href="https://images.app.goo.gl/eiJ4EZP6cxGp5dXBA">La une</a><br>

                    Photo Avatar 2 :<br>
                    <a href="https://www.pinterest.fr/pin/1055599905912530/">Pinterest</a><br>
                    <a href="https://www.google.com/imgres?imgurl=https://imgsrc.cineserie.com/2016/11/Avatar-2-une-date-de-sortie-sur-pr%25C3%25A9cise.jpg?ver%3D1&tbnid=d79iW4GdOcissM&vet=1&imgrefurl=https://www.cineserie.com/news/cinema/avatar-2-une-date-de-sortie-se-precise-653419/&docid=oGPwA8tXaQPzNM&w=1200&h=632&itg=1&hl=fr-FR&source=sh/x/im/m1/4&kgs=51612c1ad8d55571&shem=abme,ssic,trie">Ciné Série</a><br>

                    Photo des dominations de Jurassic World :<br>
                    <a href="https://www.pinterest.fr/pin/78179743524720122/">Pinterest</a><br>
                    <a href="https://www.google.com/imgres?imgurl=https://static.mensup.fr/21/2022/06/photo_article/759036/298830/1200-L-jurassic-world-3-partir-de-quel-ge-les-enfants-peuvent-voir-le-film.jpg&tbnid=uaXjKYGxANra5M&vet=1&imgrefurl=https://www.koolmag.fr/cine/jurassic-world-3--a-partir-de-quel-age-les-enfants-peuvent-voir-le-film--759036&docid=UU_zu3OmQDiQaM&w=1200&h=640&itg=1&hl=fr-FR&source=sh/x/im/m1/4&kgs=267cb29f95ad84c4&shem=abme,ssic,trie">Kool Mag</a><br>

                    Toutes les définitions des photos sont compressées pour le site.
                </p>
            </section>
            <section>
                <h3>Protection des Données (RGPD)</h3>
                <p>
                    Pour toute question ou demande relative à la protection des données, veuillez me contacter à l'adresse suivante : <a href="mailto:victoraheddad@edu.univ-eiffel.fr">victoraheddad@edu.univ-eiffel.fr</a>
                </p>
            </section>
            <section>
                <h3>Droits d'Auteur</h3>
                <p>
                    Tous droits réservés. Aucun contenu du site ne peut être reproduit ou utilisé sans autorisation préalable de Victoria Heddad.
                </p>
            </section>
            <section>
                <h3>Cookies</h3>
                <p>Ce site n'utilise pas de Cookies.</p>
            </section>
            <section>
                <h3>Réservations de Places de Cinéma à Champs-sur-Marne</h3>
                <p>
                    InstantCiné est un service fictif de réservation de places de cinéma créé dans le cadre de la SAE 2.03. Toutes les réservations ne vous enverront qu'un e-mail de validation.
                </p>
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
