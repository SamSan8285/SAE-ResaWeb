# InstantCiné

Ce projet est un site web pour le cinéma InstantCiné, conçu pour permettre aux utilisateurs de voir les films à l'affiche, réserver des places, et obtenir des informations sur les films à venir.


## URL du site web en ligne
https://resaweb.heddad.butmmi.o2switch.site/

## Contenu des fichiers

### index.php
Affiche la page d'accueil avec les films actuellement à l'affiche. Les informations des films sont récupérées depuis une base de données.

### info-film.php
Affiche les informations détaillées pour un film spécifique sélectionné par l'utilisateur.

### mail.php
Gestion de l'envoi de courriels pour des notifications ou confirmations de réservation.

### recherche.php
Permet la recherche de films dans la base de données et affiche les résultats de recherche à l'utilisateur.

### recuperation.php
Script de récupération des films à partir de la base de données pour l'affichage sur différentes sections du site.

### style.css
Fichier de styles pour le site web. Définit l'apparence et la disposition des éléments de la page.

### main.js
Gestion des interactions principales sur le site, y compris la navigation et l'affichage dynamique des éléments.

### popup.js
Gère l'affichage des fenêtres contextuelles pour les informations supplémentaires sur les films.

### popup-mention.js
Gère l'affichage et la fermeture des mentions légales via une fenêtre contextuelle.

### hamburger.js
Gestion du menu de navigation mobile (menu hamburger).

## Icones

Nous avons utilisé des icônes pour améliorer l'interface utilisateur. Nous n'avons pas intégré de comptes réels pour ces icônes conformément à une discussion avec Gaëlle Charpentier.

## Instructions

1. **Installation :**
   - Assurez-vous d'avoir un serveur web et PHP installés.
   - Clonez ce dépôt dans le répertoire de votre serveur web.
     'https://github.com/SamSan8285/SAE-ResaWeb.git'
   - Importez la base de données fournie (BDD/cinema.sql) dans votre système de gestion de bases de données.

2. **Configuration :**
   - Modifiez les paramètres de connexion à la base de données dans le fichier `conn.php`.

3. **Utilisation :**
   - Accédez à la page d'accueil via l'URL : 
   'http://localhost/SAE-ResaWeb/index.php' pour voir les films actuellement à l'affiche.
   - Utilisez la barre de recherche pour trouver des films spécifiques.
   - Cliquez sur les films pour voir plus de détails et réserver des places.

## Exécution des scripts

- **index.php** : Charge les films et affiche la page d'accueil.
- **info-film.php** : Affiche les informations détaillées d'un film.
- **mail.php** : Envoie des courriels.
- **recherche.php** : Gère la recherche de films.
- **recuperation.php** : Récupère les informations des films pour affichage.
- **style.css** : Fichier de style pour le site.
- **main.js** : Gère les interactions principales.
- **popup.js** : Gère les fenêtres contextuelles pour les films.
- **popup-mention.js** : Gère la fenêtre contextuelle des mentions légales.
- **hamburger.js** : Gère le menu de navigation mobile.

---

### Notes Spéciales

- **Icones :** Comme discuté avec Gaëlle Charpentier, nous avons laissé les icônes sans intégrer de comptes réels.
- **Accessibilité :** Des efforts ont été faits pour rendre le site accessible, y compris l'ajout d'attributs ARIA et des descriptions pour les lecteurs d'écran.

---

Pour toute question ou assistance, n'hésitez pas à me contacter.
