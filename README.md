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
    - <b> PHP (v8.1) </b>
    - <b> Tailwind CSS (v3.1) </b> : Framework CSS
    - <b> Vite (v5.0) </b> : Outil front-end JavaScript
    - <b> Laravel Breeze (v1.27) </b> : Package qui implémente les fonctionnalités d'authentication de Laravel
    - <b> Laravel-MongoDB (v4.1) </b> : Package MongoDB basé sur Eloquent model et Query builder pour Laravel
 
- <b> MongoDB (MongoDB v6.0.3 Community) </b> : Base de données NoSQL


<br>

## Installation
Pour cloner cette application en local, vous aurez besoin de [Git](https://git-scm.com/downloads) et d'un serveur [MongoDB](https://www.mongodb.com/) installés sur votre ordinateur.

<p align="right">(<a href="#retour-en-haut">retour en haut</a>)</p>

## Problèmes
- <b> Intégration avec MongoDB </b> :
- <b> Intégration du Recaptcha de Google </b> :

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
- <b> Journalisation </b> : Enregistre les différentes activités des utilisateur, en particulier sur les actions critiques

<p align="right">(<a href="#retour-en-haut">retour en haut</a>)</p>

## Identification des faiblesses

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
