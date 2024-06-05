document.addEventListener('DOMContentLoaded', function () {
    var openPopup = document.getElementById('open-legal');
    var closePopup = document.getElementById('close-popup');
    var popupContainer = document.getElementById('legal-popup');

    openPopup.addEventListener('click', function (event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        popupContainer.style.display = 'flex';
        document.body.classList.add('modal-open'); // Désactiver le scroll en arrière-plan
    });

    closePopup.addEventListener('click', function () {
        popupContainer.style.display = 'none';
        document.body.classList.remove('modal-open'); // Réactiver le scroll en arrière-plan
    });

    // Fermer le popup si l'utilisateur clique en dehors du contenu
    popupContainer.addEventListener('click', function (event) {
        if (event.target === popupContainer) {
            popupContainer.style.display = 'none';
            document.body.classList.remove('modal-open'); // Réactiver le scroll en arrière-plan
        }
    });
});
