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
    <title>Document</title>
</head>
<body>
    <header>
        <a href="index.php" class="logo">
            <i class='bx bxs-movie'></i> InstantCiné
        </a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="" class="home-active"> Accueil </a></li>
            <li><a href="#movies"> Cinéma </a></li>
            <li><a href="#coming"> Prochainement </a></li>
            <li> <a href=""> Mention Légal </a></li>
        </ul>

        <form action="recherche.php" method="GET">
            <div class="search-container">
                <input type="text" name="recherche" id="search-box" placeholder="Rechercher...">
            </div>
        </form>
    </header>

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
    <script src="popup.js"></script>
</body>
</html>
