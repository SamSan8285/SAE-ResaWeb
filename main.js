document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper(".home", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 6000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
    navbarLinks.forEach(link => {
        link.addEventListener('click', () => {
            // Retirer la classe 'home-active' de tous les liens
            navbarLinks.forEach(navLink => {
                navLink.classList.remove('home-active');
            });

            // Ajouter la classe 'home-active' uniquement sur le lien cliqué
            if (link.innerText === 'Accueil') {
                link.classList.add('home-active');
            }

            // Fermer le menu hamburger
            navbar.classList.remove('active');
            document.body.style.overflow = '';
            closeMenuIcon.style.display = 'none';
        });
    });

    const searchBox = document.getElementById('search-box');
    const resultsContainer = document.getElementById('results');

    searchBox.addEventListener('input', function () {
        const searchTerm = this.value.trim();
        resultsContainer.innerHTML = ''; // Nettoyer les résultats précédents

        if (searchTerm.length > 0) {
            fetch(`recuperation.php?term=${encodeURIComponent(searchTerm)}`)
                .then(response => response.json())
                .then(films => {
                    films.forEach(film => {
                        const div = document.createElement('div');
                        div.textContent = film.titre_film; // Assumer que chaque film a un 'titre_film'
                        resultsContainer.appendChild(div);
                    });
                })
                .catch(error => console.error('Erreur lors de la récupération des données:', error));
        }
    });


});