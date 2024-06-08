<?php
// Inclure le fichier de connexion
$mysqli = include 'conn.php';

// Vérifiez que l'objet $mysqli est bien défini
if (!$mysqli) {
    die("Erreur lors de la connexion à la base de données.");
}

$sql = "SELECT * FROM film ORDER BY ID ASC";
$result = $mysqli->query($sql);

if ($result === false) {
    die("Erreur lors de l'exécution de la requête : " . $mysqli->error);
}

// Affiche les résultats pour le débogage
$films = [];
while ($row = $result->fetch_assoc()) {
    $films[] = $row;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstantCiné</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="icon/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /></head>
<body>
<header>
    <a href="index.php" class="logo">
        <i class='bx bxs-movie'></i> InstantCiné
    </a>

    <ul class="navbar">
        <li><a href="#home"> Accueil </a></li>
        <li><a href="#movies"> Cinéma </a></li>
        <li><a href="#coming"> Prochainement </a></li>
        <li><a href="#" id="open-legal"> Mention Légal </a></li>
    </ul>
    <form action="recherche.php" id="menu-hamburger" method="GET">
    <i class="fa-solid fa-bars" id="menu-icon"></i>
        <div class="search-container">
            <input type="text" name="recherche" id="search-box" placeholder="Rechercher...">
        </div>
    </form>
</header>


    <!-- Popup mentions légales -->
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



    <section class="home swiper" id="home">
        <div class="swiper-wrapper">
            <?php if (isset($films) && count($films) > 0): ?>
                <?php foreach ($films as $row): ?>
                    <div class="swiper-slide container">
                        <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="">
                        <div class="home-text">
                            <span>Nos film à l'affiche</span>
                            <h1><?php echo htmlspecialchars($row['titre_film']); ?></h1>
                            <a href="info-film.php?film=<?php echo htmlspecialchars($row['titre_film']); ?>" class="btn">Séances</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun film trouvé</p>
            <?php endif; ?>
        </div>
        <div class="swiper-pagination"></div>
    </section>

    <section id="pop">
        <p class="intro">
            Bienvenue sur InstantCiné, votre cinéma à Champs-sur-Marne.
            Notre cinéma vous invite à plonger dans un univers de rêve et d'évasion !
            Réservez vos places en ligne dès maintenant et découvrez les prochains films à l'affiche.
        </p>
        <img class="popcorn" src="images/popcorn.gif" alt=" gif d'un homme mangeant du pop corn">
    </section>

    <?php require 'recuperation.php'; ?>
    <section class="toujours-affiche">
        <div class="affiche-haut">
            <h2 id="movies">Toujours à l'affiche :</h2>
            <a href="recherche.php" class="voirplus">Voir Plus -></a>
        </div>
        <div class="film-affiche" id="toujours-disponible">
            <!-- PHP pour afficher les films à l'affiche -->
            <?php foreach ($filmsALAffiche as $film): ?>
                <a href="info-film.php?film=<?php echo urlencode($film['titre_film']); ?>">
                    <img src="<?php echo htmlspecialchars($film['image_path']); ?>" alt="<?php echo htmlspecialchars($film['titre_film']); ?>">
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="toujours-affiche">
        <div class="affiche-haut">
            <h2 id="coming">Bientôt à l'affiche :</h2>
            <a href="recherche.php" class="voirplus">Voir Plus -></a>
        </div>
        <div class="film-affiche" id="bientot-disponible">
            <!-- PHP pour afficher les films bientôt à l'affiche -->
            <?php foreach ($filmsBientot as $film): ?>
                <a href="info-film.php?film=<?php echo urlencode($film['titre_film']); ?>">
                    <img src="<?php echo htmlspecialchars($film['image_path']); ?>" alt="<?php echo htmlspecialchars($film['titre_film']); ?>">
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <h3> InstantCiné </h3>
            <p>Pour plus d'informations, retrouvez-nous sur nos sites Youtube, Instagram et X !</p>
            <ul class="socials">    
                <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-youtube"></i></i></li>
                <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></i></a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2024 InstantCiné <span> Tous droits réservés &copy;</span> </p>
        </div>
    </footer>

</body>
<script src="hamburger.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="main.js"></script>
<script src="popup-mention.js"></script>
</html>
