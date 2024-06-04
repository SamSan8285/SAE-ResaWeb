<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $to = htmlspecialchars($_POST['email']);
    $heure = htmlspecialchars($_POST['heure']);
    
    $subject = "Bienvenue sur RésaKingdom";
    $message = "$prenom $nom,\n\nBienvenue sur RésaKingdom ! Plongez au coeur des mondes enchantés de la série Kingdom Hearts. Ici, chaque réservation vous ouvre les portes d'une aventure épique.\n\nHeure de réservation : $heure\n\nRéservez votre voyage dès maintenant!";
    $message = wordwrap($message, 70, "\r\n");

    $headers = [
        "From" => "no-reply@site.fr",
        "Bcc" => "diatabec@gmail.com",
    ];

    // Convert headers array to string
    $headersString = '';
    foreach ($headers as $key => $value) {
        $headersString .= "$key: $value\r\n";
    }

    if (mail($to, $subject, $message, $headersString)) {
        echo 'Confirmation de réservation envoyée avec succès';
    } else {
        echo 'Erreur lors de l\'envoi de la confirmation de réservation';
    }
}
?>
