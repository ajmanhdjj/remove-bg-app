Application PHP pour Supprimer les Arrière-Plans d'Images
Une application web PHP simple qui permet aux utilisateurs d'uploader une image et de supprimer son arrière-plan à l'aide de l'API Remove.bg.
Fonctionnalités

Upload d'images (JPG, PNG, max 5 Mo).
Suppression automatique de l'arrière-plan via l'API Remove.bg.
Affichage de l'image originale et sans fond côte à côte.
Téléchargement de l'image résultante avec fond transparent.

Prérequis

Serveur PHP avec l'extension curl activée.
Clé API Remove.bg (à stocker dans config.php, non inclus dans le dépôt).
Dossier uploads/ avec permissions d'écriture (ex. chmod 777 uploads/ sur Linux).

Installation

Clone le dépôt :git clone https://github.com/ton-utilisateur/remove-bg-app.git


Crée un fichier config.php avec ta clé API Remove.bg :<?php
define('REMOVE_BG_API_KEY', 'ta-clé-api-ici');
?>


Crée un dossier uploads/ dans le répertoire du projet.
Configure un serveur PHP (ex. XAMPP, WAMP, ou un serveur en ligne).
Accède à http://localhost/remove-bg-app/index.php dans ton navigateur.

Utilisation

Ouvre index.php dans ton navigateur.
Upload une image (JPG ou PNG).
Visualise et télécharge l'image sans arrière-plan.

Dépendances

PHP 7.4+ avec les extensions curl et gd.
API Remove.bg (inscription sur https://www.remove.bg/api pour obtenir une clé).

Remarques

Le dossier uploads/ et config.php sont exclus du dépôt via .gitignore pour des raisons de sécurité.
L'API Remove.bg offre 50 crédits gratuits par mois (1 crédit par image).

Auteur
AJMAN HADJIBOUDINE
Licence
MIT License