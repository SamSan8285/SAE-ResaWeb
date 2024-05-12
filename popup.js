document.getElementById('info-btn').addEventListener('click', function() {
    document.getElementById('popup-form').style.display = 'flex';
});

document.getElementById('popup-form').querySelector('.close-btn').addEventListener('click', function() {
    document.getElementById('popup-form').style.display = 'none';
});

document.getElementById('reservation-form').addEventListener('submit', function(event) {
    event.preventDefault();
    // Process form data here, for example, send it to a server
    alert('Réservation enregistrée !');
    document.getElementById('popup-form').style.display = 'none';
});
