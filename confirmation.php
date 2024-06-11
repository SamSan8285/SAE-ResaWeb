<?php
$status = $_GET['status'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de Réservation</title>
    <style>
        :root {
            --neon-white: #fff;
            --neon-gray: #ccc;
            --main-color: #ff2c1f;
            --neon-red: #c40003;
            --text-color: #020307;
            --bg-color: #020307;
            --sh-color: #1b1c1f;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: var(--neon-white);
        }
        .container {
            background-color: var(--sh-color);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .container h1 {
            font-size: 24px;
            color: var(--main-color);
        }
        .container p {
            font-size: 18px;
            color: var(--neon-gray);
            margin: 20px 0;
        }
        .container .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: var(--neon-white);
            background-color: var(--main-color);
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .container .btn:hover {
            background-color: var(--neon-red);
        }

        .success {
            color: var(--success-color);
            box-shadow: 0 0 10px var(--success-color);
        }
        .error {
            color: var(--neon-red);
            box-shadow: 0 0 10px var(--neon-red);
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($status == 'success'): ?>
            <h1 class="success">Confirmation de Réservation</h1>
            <p>Votre réservation a été envoyée avec succès.</p>
        <?php elseif ($status == 'error'): ?>
            <h1 class="error">Erreur de Réservation</h1>
            <p>Une erreur est survenue lors de l'envoi de votre réservation. Veuillez réessayer.</p>
        <?php else: ?>
            <h1>Statut Inconnu</h1>
            <p>Nous ne pouvons pas déterminer le statut de votre réservation.</p>
        <?php endif; ?>
        <a href="index.php" class="btn">Retour à l'accueil</a>
    </div>
</body>

</html>
