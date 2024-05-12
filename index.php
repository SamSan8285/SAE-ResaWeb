<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstantCiné</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="icon/favicon.ico" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

    <form action="recherche.php" method="GET">
    <div class="search-container">
        <input type="text" name="recherche" id="search-box" placeholder="Rechercher...">
    </div>
</form>

    </header>

    <section class="home swiper" id="home">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide container">
                <img src="images/home1.jpeg" alt="">
                <div class="home-text">
                    <span>Nos film à l'affiche</span>
                    <h1>Dune</h1>
                    <a href="#" class="btn">Séances</a>
                    </a>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide container">
                <img src="images/home2.jpeg" alt="">
                <div class="home-text">
                    <span>Nos film à l'affiche</span>
                    <h1>Spider-Man: <br> No Way Home </h1>
                    <a href="#" class="btn">Séances</a>
                        <i class="bx bx-play"></i>
                    </a>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide container">
                <img src="images/home3.jpeg" alt="">
                <div class="home-text">
                    <span>Nos film à l'affiche</span>
                    <h1>Black Widow </h1>
                    <a href="#" class="btn">Séances</a>
                        <i class="bx bx-play"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </section>

    <section id="pop">
        <p class="intro">
            Bienvenue sur InstantCiné, votre cinéma à Champs-sur-Marne.
            Notre cinéma vous invite à plonger dans un univers de rêve et d'évasion !
            Réservez vos places en ligne dès maintenant et découvrez les prochains films à l'affiche.
        </p>
        <img class="popcorn" src="images/popcorn.gif" alt=" gif fd'un homme mangeant du pop corn">
    </section>


    <?php
    require 'recuperation.php';
    ?>
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
     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque officiis 
        tempora debitis enim quia!</p>
        
    <ul class="socials">
        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
        <li><i href="#" class="fa-brands fa-youtube" style="color: var(color);"></i></a></li>
        <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
    </ul>
</div>
<div class="footer-bottom">
    <p>copyright &copy;2024 InstantCiné <span> Tous droits réservés &copy;</span> </p>
</div>

</footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="main.js"></script>
</html>