// popup.js
document.getElementById('info-btn').addEventListener('click', function () {
    document.getElementById('popup-form').style.display = 'flex';
});

document.getElementById('popup-form').querySelector('.close-btn').addEventListener('click', function () {
    document.getElementById('popup-form').style.display = 'none';
});

document.getElementById('reservation-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Empêche le comportement par défaut du formulaire
    document.getElementById('popup-form').style.display = 'none';
    this.submit(); // Soumet le formulaire après avoir fermé le popup
});
