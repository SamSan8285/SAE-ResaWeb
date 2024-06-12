<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Charge automatiquement les fichiers nécessaires

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupére les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $heure = $_POST['heure'];

    echo "Données du formulaire récupérées : Nom = $nom, Prénom = $prenom, Email = $email, Heure = $heure<br>";

    $mail = new PHPMailer(true);
    try {
        // Paramètres SMTP
        $mail->isSMTP();
        $mail->Host = 'mail.heddad.butmmi.o2switch.site'; // Hôte SMTP réel trouvé
        $mail->SMTPAuth = true;
        $mail->Username = 'heddad@heddad.butmmi.o2switch.site'; // Adresse email
        $mail->Password = 'WwiMrOXQ1Ooa'; // Mot de passe de ton compte email
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Utilise SSL car le port est 465
        $mail->Port = 465; // Utilise le port trouvé pour SSL

        echo "Configuration SMTP effectuée.<br>";

        // Encodage UTF-8
        $mail->CharSet = 'UTF-8';
        
        // Destinataires
        $mail->setFrom('heddad@heddad.butmmi.o2switch.site', 'InstantCiné');
        $mail->addAddress($email, "$nom $prenom"); // Utilise l'adresse email fournie dans le formulaire

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->isHTML(true);
$mail->Subject = 'InstantCiné - Confirmation de réservation';
$mail->Body    = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            .container { margin: 20px; padding: 20px; border: 1px solid #ddd; }
            .header { font-size: 24px; font-weight: bold; margin-bottom: 20px; }
            .content { font-size: 16px; }
            .footer { margin-top: 20px; font-size: 12px; color: #666; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>Confirmation de réservation</div>
            <div class='content'>
                <p>Bonjour $nom $prenom,</p>
                <p>Merci d'avoir choisi InstantCiné. Nous avons bien reçu votre réservation.</p>
                <p>Voici les détails de votre réservation :</p>
                <ul>
                    <li><strong>Nom :</strong> $nom $prenom</li>
                    <li><strong>Email :</strong> $email</li>
                    <li><strong>Heure :</strong> $heure</li>
                </ul>
                <p>Merci de vous présenter à la séance prévue.</p>
            </div>
            <div class='footer'>
                <p>InstantCiné</p>
                <p>Ceci est un email généré automatiquement, merci de ne pas y répondre.</p>
            </div>
        </div>
    </body>
    </html>
";
$mail->AltBody = "Bonjour $nom $prenom,\n\nMerci d'avoir choisi InstantCiné. Nous avons bien reçu votre réservation.\n\nVoici les détails de votre réservation :\n- Nom : $nom $prenom\n- Email : $email\n- Heure : $heure\n\nMerci de vous présenter à la séance prévue.\n\nInstantCiné\nCeci est un email généré automatiquement, merci de ne pas y répondre.";


        echo "Contenu de l'email configuré.<br>";

        $mail->send();
        echo "Email envoyé avec succès.<br>";
        header('Location: confirmation.php?status=success');
        exit();
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}<br>";
        header('Location: confirmation.php?status=error');
        exit();
    }
} else {
    echo 'Méthode de requête non valide.';
}
?>
