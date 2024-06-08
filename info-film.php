<?php   
require 'conn.php';
require 'recuperation.php';
if (isset($_GET['film'])) {
    $titreFilm = $_GET['film']; 
    // Assurez-vous que $mysqli est toujours ouvert à ce point
    $filmDetails = getFilmDetails($mysqli, $titreFilm);
    $trailer_url = $filmDetails['trailer_url'] ?? '';
    $duree = $filmDetails['duree'] ?? 'Non spécifié';
    $fk_id_genre = $filmDetails['fk_id_genre'] ?? 'Non spécifié';
    $fk_id_rea = $filmDetails['fk_id_rea'] ?? 'Non spécifié';
    $synopsis = $filmDetails['synopsis'] ?? 'Non spécifié';
    // Utilisez $filmDetails pour afficher les informations
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Document</title>
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

    <br>
    <div class="info">
        <div class="container-info">
            <h2 class="bande-annonce">Bande-annonce :</h2>
            <div class="all-info">   
            <iframe width="560" height="315" src="<?php echo htmlspecialchars($trailer_url); ?>"
            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen></iframe>
            <div class="info-right">
                <h1 class="bande-annonce separateur-film"><?php echo htmlspecialchars($titreFilm) ?></h1>
                <a class="separateur-film"><?php echo htmlspecialchars(convertDurationToHours($duree)); ?> | Genre: <?php echo htmlspecialchars($filmDetails['genres']); ?><br>
                Par le Réalisateur <?php echo htmlspecialchars($filmDetails['realisateur_nom']) . ' ' . htmlspecialchars($filmDetails['realisateur_prenom']); ?></a>
                <h3 id="separator" class="separateur-film">Synopsis & Info</h3>
                <a id="synopsis" class="separateur-film"><?php echo htmlspecialchars($synopsis); ?></a>
                <a id="info-btn" class="btn"> Séances </a>
            </div>
            </div> 
        </div>
    </div>

    <!-- Popup Form -->
    <div id="popup-form" class="popup-container" style="display:none;">
    <div class="popup-content">
        <div class="popup-header">
            <h2>Réservez votre séance</h2>
            <span class="close-btn">&times;</span>
        </div>
        <form id="reservation-form" action="mail.php" method="POST">
            <div class="input-group">
                <div class="flex-75">
                    <label for="nom">Nom</label>
                    <input type="text" placeholder="Entrez votre nom" id="nom" name="nom" required>
                </div>
                <div class="flex-25">
                    <label for="prenom">Prénom</label>
                    <input type="text" placeholder="Entrez votre prénom" id="prenom" name="prenom" required>
                </div>
            </div>
            <div class="input-group">
                <div class="flex-75">
                    <label for="email">Email</label>
                    <input type="email" placeholder="Entrez votre email" id="email" name="email" required>
                </div>
                <div class="flex-25">
                    <label for="heure">Heure</label>
                    <select id="heure" name="heure">
                        <option value="10:00">10:00</option>
                        <option value="14:00">14:00</option>
                        <option value="18:00">18:00</option>
                        <option value="20:00">20:00</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="submit-btn">Réserver</button>
        </form>
    </div>
</div>

<script src="hamburger.js"></script>
<script src="popup-mention.js"></script>
    <script src="popup.js"></script>
</body>
</html>
