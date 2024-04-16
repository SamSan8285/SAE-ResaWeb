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

    <section class="home swiper" id="home">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide container">
                <img src="Images/home1.jpeg" alt="">
                <div class="home-text">
                    <span>iuewfgyfg</span>
                    <h1>Dune</h1>
                    <a href="#" class="btn">Séances</a>
                    <a href="#" class="play"> Bande-annonce
                        <i class="bx bx-play"></i>
                    </a>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide container">
                <img src="Images/home2.png" alt="">
                <div class="home-text">
                    <span>iuewfgyfg</span>
                    <h1>Spider-Man: <br> No Way Home </h1>
                    <a href="#" class="btn">Séances</a>
                    <a href="#" class="play"> Bande-annonce
                        <i class="bx bx-play"></i>
                    </a>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide container">
                <img src="Images/home3.jpeg" alt="">
                <div class="home-text">
                    <span>iuewfgyfg</span>
                    <h1>Black Widow </h1>
                    <a href="#" class="btn">Séances</a>
                    <a href="#" class="play"> Bande-annonce
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
        <img class="popcorn" src="Images/popcorn.gif" alt=" gif fd'un homme mangeant du pop corn">
    </section>


    <?php
    require 'recuperation.php';
    ?>
    <section class="toujours-affiche">
        <h2>Toujours à l'affiche :</h2>
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
    <h2>Bientôt à l'affiche :</h2>
    <div class="film-affiche" id="bientot-disponible">
        <!-- PHP pour afficher les films bientôt à l'affiche -->
        <?php foreach ($filmsBientot as $film): ?>
            <a href="info-film.php?film=<?php echo urlencode($film['titre_film']); ?>">
                <img src="<?php echo htmlspecialchars($film['image_path']); ?>" alt="<?php echo htmlspecialchars($film['titre_film']); ?>">
            </a>
        <?php endforeach; ?>
    </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="main.js"></script>

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
    <p>copyright &copy;2024 InstantCiné <span>Victoria Heddad</span> </p>
</div>

</footer>

</body>

</html>