const menuIcon = document.getElementById('menu-icon');
const navbar = document.querySelector('.navbar');
const navbarLinks = document.querySelectorAll('.navbar a');

menuIcon.addEventListener('click', () => {
    navbar.classList.toggle('active');
    if (navbar.classList.contains('active')) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = '';
    }
});

navbarLinks.forEach(link => {
    link.addEventListener('click', (event) => {
        if (link.id !== 'open-legal') {
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
        } else {
            // Laisser le menu ouvert pour "Mention Légal"
            event.preventDefault();
        }
    });
});
