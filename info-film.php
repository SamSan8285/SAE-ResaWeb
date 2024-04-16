<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

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


<header>
    <a href="#" class="logo">
        <i class='bx bxs-movie'></i> InstantCiné
    </a>
    <div class="bx bx-menu" id="menu-icon"></div>

    <ul class="navbar">
        <li><a href="index.html" class="home-active"> Acceuil </a></li>
        <li><a href="#movies"> Cinéma </a></li>
        <li><a href="#coming"> Pochainement </a></li>
        <li> <a href=""> Mention Légal </a></li>
    </ul>


    <link class="search-bar" rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <form action="">
        <input type="search" required>
        <i class="fa fa-search"></i>
        <a class="search" href="javascript:void(0)" id="clear-btn">Clear</a>
    </form>

</header>



<body>
    
    <br>

    <div class="synopsis">
    <h2 class="bande-annonce">Bande-annonce :</h2>
    <iframe width="560" height="315" src="<?php echo htmlspecialchars($trailer_url); ?>"
    title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
    allowfullscreen></iframe>
    <a><?php echo htmlspecialchars($duree); ?> | Genre ID: <?php echo htmlspecialchars($fk_id_genre); ?><br>
        Par Réalisateur ID: <?php echo htmlspecialchars($fk_id_rea); ?></a>

    <h4>Synopsis & Info</h4>
    <br>
    <a><?php echo htmlspecialchars($synopsis); ?></a>
</div>

    
    <a href="#" class="btn"> Séances </a>
    
</body>
</html>