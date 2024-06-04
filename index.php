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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <li><a href="#" id="open-legal"> Mention Légal </a></li>
        </ul>
        <form action="recherche.php" method="GET">
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
                <!-- Contenu long des mentions légales -->
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Mauris vel tellus non nunc mattis lobortis. Mauris in ultricies enim. Quisque nec est eleifend nulla ultrices aliquet. Phasellus at rutrum nisl. Nulla facilisi. Sed elementum metus facilisis erat vulputate, ut viverra lacus imperdiet. Donec gravida turpis nisi, auctor ultricies quam consectetur vel. Nulla vitae mauris non felis mollis faucibus. Pellentesque non suscipit ligula. Morbi non sem eros. Mauris et quam.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Mauris vel tellus non nunc mattis lobortis. Mauris in ultricies enim. Quisque nec est eleifend nulla ultrices aliquet. Phasellus at rutrum nisl. Nulla facilisi. Sed elementum metus facilisis erat vulputate, ut viverra lacus imperdiet. Donec gravida turpis nisi, auctor ultricies quam consectetur vel. Nulla vitae mauris non felis mollis faucibus. Pellentesque non suscipit ligula. Morbi non sem eros. Mauris et quam.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Mauris vel tellus non nunc mattis lobortis. Mauris in ultricies enim. Quisque nec est eleifend nulla ultrices aliquet. Phasellus at rutrum nisl. Nulla facilisi. Sed elementum metus facilisis erat vulputate, ut viverra lacus imperdiet. Donec gravida turpis nisi, auctor ultricies quam consectetur vel. Nulla vitae mauris non felis mollis faucibus. Pellentesque non suscipit ligula. Morbi non sem eros. Mauris et quam.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Mauris vel tellus non nunc mattis lobortis. Mauris in ultricies enim. Quisque nec est eleifend nulla ultrices aliquet. Phasellus at rutrum nisl. Nulla facilisi. Sed elementum metus facilisis erat vulputate, ut viverra lacus imperdiet. Donec gravida turpis nisi, auctor ultricies quam consectetur vel. Nulla vitae mauris non felis mollis faucibus. Pellentesque non suscipit ligula. Morbi non sem eros. Mauris et quam.</p>
                <!-- Ajoutez plus de contenu ici -->
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
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="main.js"></script>
<script src="popup-mention.js"></script>
</html>
