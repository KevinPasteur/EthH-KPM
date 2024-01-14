<a name="retour-en-haut"></a>
<h1 align="center">
  EthH KPM
  <br>
</h1>

<h4 align="center">Application web sécurisée pour le cours d'Ethical Hacking
    <br>
</h4>

<p align="center">
  <a href="#à-propos-du-projet">À propos du projet</a> •
  <a href="#organisation">Organisation</a> •
  <a href="#librairies">Librairies</a> •
  <a href="#installation">Installation</a> •
  <a href="#problèmes">Problèmes</a> •
  <a href="#sécurités">Sécurités</a> •
  <a href="#identification-des-faiblesses">Identification des faiblesses</a> •
  <a href="#fonctionnalités-manquantes">Fonctionnalités manquantes</a> •
  <a href="#contact">Contact</a>
</p>

## À propos du projet
Dans le cadre du projet du cours à option Ethical Hacking de la HEIG-VD en Ingénierie des Médias, notre équipe réalise une application web sécurisée avec 3 fonctionnalités définies. 

- Système d'authentification
- Chat
- Page administrateur

L'objectif, démontrer nos compétences en développement sécurisé.
<br>
### Développé avec

[![Laravel][Laravel.com]][Laravel-url] [![TailwindCSS][TailwindCSS.com]][TailwindCSS-url] [![MongoDB][MongoDB.com]][MongoDB-url] [![Vite][Vite.com]][Vite-url]

<br>

## Organisation

- <b> Système d'authentification </b> : Kévin - Patrick
- <b> Chat </b> : Patrick - Miguel
- <b> Page d'administrateur </b> : Kévin - Miguel

<br>

## Librairies
- <b> Laravel (v10) </b> : Framework PHP
    - <b> PHP (v8.2) - Thread Safe - x64  </b>
    - <b> Tailwind CSS (v3.1) </b> : Framework CSS
    - <b> Vite (v5.0) </b> : Outil front-end JavaScript
    - <b> Laravel Breeze (v1.27) </b> : Package qui implémente les fonctionnalités d'authentication de Laravel
    - <b> Laravel-MongoDB (v4.1) </b> : Package MongoDB basé sur Eloquent model et Query builder pour Laravel
    - <b> Enlightn (v2.7) </b> : Package permettant de tester notre application fournissant des informations sur la performance, sécurité, ...
    - <b> Laravel-CP (v2.8) </b> : Package permettant de gérer les CSP
 
- <b> MongoDB (MongoDB 7.0.5 Community) </b> : Base de données NoSQL

<br>

## Installation

### Pré-requis

Pour cloner cette application, vous aurez besoin de [PHP](https://www.php.net/downloads.php), [Git](https://git-scm.com/downloads), [Composer](https://getcomposer.org/download/), [Node.js](https://nodejs.org/en/download/) (qui inclue [npm](http://npmjs.com)) et d'un serveur [MongoDB](https://www.mongodb.com/try/download/community) (Privilégiez la version Community 7.0.5) installés sur votre ordinateur.

#### Installation de l'extension MongoDB pour PHP
Laravel ayant mis en place tout récemment [l'intégration de MongoDB](https://laravel-news.com/mongodb-laravel-integration), il faut pour l'activer ajouter l'extension PHP pour MongoDB et l'activer dans le php.ini.

Nous avons détaillé plus bas la procédure d'installation de l'extension pour Windows et Mac. Si un problème devait survenir, voici le [lien de la procédure](https://www.php.net/manual/en/mongodb.installation.windows.php).

<i> Cette partie peut parfois poser problème, n'hésitez pas à nous contacter pour plus de détails </i>

<b> Windows </b>

Rendez-vous sur le github [mongo-php-driver](https://github.com/mongodb/mongo-php-driver/releases/).

Dans la liste qui vous est proposé, il vous faudra choisir la bonne version du driver (.dll) pour ce faire, vous devrez connaître votre version de PHP et le type de Thread (Safe or not).

<i> Pour le développement de l'application, nous avons utilisé la version de PHP 8.2 (x64) en Thread Safe </i>

```bash
# Connaître sa version de PHP
$ php --version

# Connaître son type de Thread
$ php -i|findstr "Thread"

```

Après avoir téléchargé la bonne version de la dll, il vous faudra la déposer (uniquement la dll) dans le dossier "ext" de votre installation de PHP.

```bash
# Trouver son dossier de configuration
$ php --ini
```

Ensuite, ouvrez votre fichier php.ini qui se trouve à la racine du dossier. Recherchez la liste des extensions et ajoutez-y cette ligne.

```bash
# ...Le reste de vos extensions...
extension=php_mongodb.dll
```

Sauvegardez et vous avez à présent fini l'installation de l'extension.

<b> Mac </b>

Rendez-vous sur le github [mongo-php-driver](https://github.com/mongodb/mongo-php-driver/releases/).

Exécutez la commande suivante qui vous installera l'extension.

```bash
$ pecl install mongodb-1.17.2
```

#### Éviter l'erreur de certificat pour Google Recaptcha
Comme nous travaillons actuellement dans un environnement de développement local, cURL n'est pas capable de vérifier le certificat SSL du serveur de Google Recaptcha produisant ainsi une erreur.

Pour résoudre ce problème, il vous faudra installer le bundle de certificats CA.

Depuis ce lien [curl.haxx.se/ca/cacert.pem](http://curl.haxx.se/ca/cacert.pem), téléchargez le cacert.pem et placez le dans votre installation de PHP. 

Ouvrez votre php.ini et trouvez cette ligne 
```bash
;curl.cainfo
```

Remplacez la par
```bash
curl.cainfo = "<Lien vers votre emplacement du cacert.pem>"
```

<i> Faites attention à bien enlever le point-virgule du début de ligne (;) </i>

Sauvegardez et vous pourrez alors utiliser la partie Google Recaptcha à l'inscription.

### Installer l'application
Ensuite, exécutez ces lignes de commandes.

```bash
# Cloner le repo
$ git clone https://github.com/KevinPasteur/EthH-KPM

# Aller dans le répertoire
$ cd EthH-KPM

# Installation des dépendances
$ composer i
$ npm i
```

### Configuration .env
Renommez le .env.example en .env (À la racine du projet). 

Générez ensuite une nouvelle clé d'application

```bash
# Génération d'une nouvelle clé
$ php artisan key:generate
```

Ajoutez les clés pour Google Recaptcha (fournies par email) dans le .env (les variables se trouvent à la fin du fichier).

```bash
GOOGLE_RECAPTCHA_KEY=<Insérer Key>
GOOGLE_RECAPTCHA_SECRET=<Insérer Secret>
```
### Exécuter les migrations
Pour créer les tables et peupler la base de données, exécutez la commande suivante. 

```bash
# Exécute les migrations et les seeders
$ php artisan migrate:refresh --seed
```
### Lancer l'application
Pour lancer l'application, vous devrez exécutez les commandes suivante en étant dans le répertoire du projet.

```bash
# Crée le bundle Vite
$ npm run build

# Lancer le serveur
$ php artisan serve
```

### Identifiants de test
Pour pouvoir tester l'application dans les meilleures conditions, nous vous avons au préalable créé différents comptes pour tester chaque rôle.

- Email : <nom du rôle en minuscule, sans accent>@<nom du rôle en minuscule, sans accent>.com
- Mot de passe : Pa$$w0rdEth123

```bash
# Exemple
Email : administrateur@administrateur.com
Mot de passe : Pa$$w0rdEth123
```

<p align="right">(<a href="#retour-en-haut">retour en haut</a>)</p>

## Problèmes
- <b> Intégration avec MongoDB </b> : Laravel ayant mis en place tout récemment [l'intégration de MongoDB](https://laravel-news.com/mongodb-laravel-integration) sans passer par un package, il manque encore de la documentation pour certaines parties qui étaient disponibles dans l'ancien package.

<p align="right">(<a href="#retour-en-haut">retour en haut</a>)</p>

## Sécurités
### Intégrées
- <b> Protection CSRF </b> : Laravel fournit une protection CSRF pour toutes les requêtes POST, PUT, PATCH, et DELETE via un token CSRF
- <b> Protection XSS </b> : Les balises Blade ( {{ }} ) échappent automatiquement le contenu, ce qui aide à prévenir les attaques XSS
- <b> Protection injections SQL </b> : Laravel utilise l'ORM Eloquent qui prépare et exécute les requêtes SQL de manière sécurisée, évitant les injections SQL
- <b> Hashage des mots de Passe </b> : Utilisation de l'algorithme Bcrypt pour le hashage des mots de passe
- <b> Authentification </b> : Mise en place d'un système d'authentification via Laravel Breeze
- <b> Validations des entrées </b> : Validation stricte des données côté serveur via les Request Forms de Laravel
- <b> Rate Limiting </b> : Le middleware de limitation de taux intégré aide à limiter le nombre de requêtes par utilisateur

### Développées
- <b> Saisie du mot de passe lors des opérations sensibles </b> : Demande à l'administrateur de saisir à nouveau son mot de passe avant d'exécuter des opérations critiques (comme les changements de rôle)
- <b> Captcha à l'enregistrement </b> : Utilisation du Recaptcha v2 de Google lors de l'inscription d'un utilisateur
- <b> RBAC </b> : Système de contrôle d'accès basé sur les rôles afin de gérer l'accès à différentes parties de l'application
- <b> Journalisation </b> : Enregistre les différentes activités des utilisateur, en particulier sur les actions critiques (Enregistrement, Connexion, Changement de rôle)
- <b> Content-Security-Policy </b> : Nous avons intégré le package [Laravel CSP](https://github.com/spatie/laravel-csp) pour nous permettre de gérer le contrôle de sources des ressources pour prévenir les attaques XSS

<p align="right">(<a href="#retour-en-haut">retour en haut</a>)</p>

## Identification des faiblesses
Afin d'identifier les potentiels faiblesses de notre application, nous avons utilisé plusieurs moyens :

- Les recommandations du cours
- La [Laravel Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/Laravel_Cheat_Sheet.html) de l'OWASP sur les sécurités pour une application Laravel
- Le package [Enlightn](https://www.laravel-enlightn.com/) qui permet de scanner notre code Laravel et nous fournis différentes informations sur les performances, la sécurité et d'autres recommandations
  
<p align="right">(<a href="#retour-en-haut">retour en haut</a>)</p>

## Fonctionnalités manquantes
- La fonctionnalité bonus "Gestionnaire de fichiers partagé" n'a pas été implémentée

<p align="right">(<a href="#retour-en-haut">retour en haut</a>)</p>

## Contact
La team KPM - HEIG-VD - Ingénierie des Médias

<p align="right">(<a href="#retour-en-haut">retour en haut</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[MongoDB-url]: https://www.mongodb.com/
[MongoDB.com]: https://img.shields.io/badge/MongoDB-%234ea94b.svg?style=for-the-badge&logo=mongodb&logoColor=white
[Laravel-url]: https://laravel.com/
[Laravel.com]: https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white
[TailwindCSS-url]: https://tailwindcss.com/
[TailwindCSS.com]: https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white
[Vite-url]: https://vitejs.dev/
[Vite.com]: https://img.shields.io/badge/vite-%23646CFF.svg?style=for-the-badge&logo=vite&logoColor=white
