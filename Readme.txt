*** INSTALLATION DE PROJET LARAVEL ***
1 - Téléchargement et installation de Composer
URL : https://getcomposer.org/download/
Etapes pour le téléchargement : Sur le titre Windows installer, cliquer sur Composer-Setup.exe pour télécharger la dernière version de composer
Etapes pour l'installation :
 - Exécuter Composer-Setup.exe
 - Installation options : Ne pas cocher Developper mode si vous voulez désinstaller Composer dans le futur. Appuyez sur Next
 - Choisissez la version de php de votre choix (la version de php doit être supérieur à 8.1.0) puis appuyez sur Next
 - Proxy settings : Cochez "Use a proxy server to connect to internet" si vous avez un serveur proxy, sinon ignorez et appuyez sur Next
 - Vérifiez les paramètres et après avoir bien vérifier, appuyez sur Install pour procéder à l'installation
 - Ouvrir cmd et taper composer pour vérifier la version de composer
Utilité de Composer : Composer sert à installer les projets Laravel sur l'ordinateur

2 - Téléchargement et installation de WampServer
URL : https://www.wampserver.com/
Etapes pour le téléchargement : 
 - Sur la page de wampserver, appuyez sur télécharger et choisir la version qui convient à votre système
 - cliquez sur le fichier .exe pour télécharger wampserver
 - téléchargez la version 3.3.5 avec le langage PHP version 8.3.6 qui est inclut dedans
Etapes pour l'installation :
 - Executer WampServer.exe
 - Suivez les instructions donner par WampServer
 
3 - Téléchargement et installation de le dernière version de VScode (1.95)
URL : https://code.visualstudio.com/download
Etapes pour le téléchargement :
 - Choisir le système d'exploitation de votre machine
 - Télécharger le fichier 
Etapes pour l'installtion :
 - Cliquer sur le fichier que vous venez de télécharger
 - Accepter les termes en cliquant toujours sur "suivant"

4 - Récupérez le projet dans GitHub
URL du projet : 
 - opj-accuiel : https://github.com/Nathan386-dot/tpi-/tree/main/opj-accueil
 - substitut_ecran : https://github.com/Nathan386-dot/tpi-/tree/main/substitut_ecran
 - affichage : https://github.com/Nathan386-dot/tpi-/tree/main/affichage
 Il y a deux façons de récupérer le projet : soit cloner le projet, soit télécharger le fichier compressé du projet
 
5 - Lancement du projet 
 - Décompresser le fichier zip
 - Entrer dans le dossier opj-accueil pour l'écran d'accueil des OPJ, dans le dossier substitut_ecran pour les substitus et l'admin des substituts et enfin dans le dossier affichage pour l'écran d'affichage de la file d'attente
 - Ouvir un terminal ensuite exécuter le commande "composer install"
 - Configurer la base de donnée dans le fichier .env de chaque projet par :
DB_CONNECTION=mysql (mysql pour MySQL, remplacer par pgsql pour PostegreSQL)
DB_HOST=127.0.0.1
DB_PORT=3306 (3306 pour MySQL, remplacer par 5432 pour PostgreSQL)
DB_DATABASE=laravel (nom de la base de données) (exemple : attente)
DB_USERNAME=root (utilisateur de la base de données) (par défaut : root)
DB_PASSWORD= (mot de passe de la base de données) (par défaut : (vide))
 - Modifier le fichier « .env.example » en « .env » si le fichier « .env » n’existe pas encore
 - Enregistrer le fichier et revenir dans le terminal et exécuter la commande :
php artisan key:generate
php artisan migrate
 - Vous pouvez aussi entrer dans phpmyadmin via WampServer et importer la base de donnée qui se trouve dans le fichier database mais si vous faites cela, il n'est plus nécessaire de faire "php artisan migrate" ni de configurer votre base de donnée : 
 entrer dans phpmyadmin puis connecter vous; créer une base de donnée nommée "attente", ensuite appuyer sur le bouton importer puis appuyer sur choisir un fichier et naviguer vers le dossier database du projet; choisir le fichier "attente" puis appuyer sur importer qui se situe tout en bas
 - Lancement du projet : 
php artisan serve --port=8000 ou --port=8001 ou --port=8002 (les ports doivent être différentes afin d'éviter un confusion dans l'ouverture des pages)
