#  Système de Réservation d'Évènements

Ce projet est une application web complète permettant aux utilisateurs de réserver des évènements via un formulaire. Les administrateurs peuvent consulter les réservations via un tableau de bord sécurisé avec affichage sous forme de cartes.

---

##  Fonctionnalités

###  Authentification
- Connexion sécurisée des administrateurs avec vérification du mot de passe.
- Redirection si non connecté.
- Déconnexion sécurisée avec destruction de session.

###  Réservation
- Formulaire de réservation avec :
  - Nom
  - Nom de l'évènement (liste déroulante)
  - Date
  - Heure
- Enregistrement des données en base via PDO (sécurisé contre les injections SQL)

###  Tableau de bord admin (`dashboard.php`)
- Accessible uniquement aux comptes connectés
- Affichage des réservations sous forme de **cartes**
- Suppression possible via un bouton (AJAX)
- Design responsive

---

##  Structure du projet

RESERVATION/
├── admin/
│   ├── dashboard.php
│   ├── login.php
│   └── logout.php
├── backend/
│   ├── compte.php
│   ├── liste_reservations.php
│   ├── reserver.php
│   ├── supprimer_reservation.php
│   └── verifier_connexion.php
├── config/
│   └── connexion.php
├── includes/
│   ├── footer.php
│   └── header.php
├── sql/
│   └── schema.sql
├── about.php
├── index.php
├── reservation.js
├── style.css
├── README.md
└── .gitignore



---

##  Technologies utilisées

-  **HTML5 / CSS3 / JavaScript**
-  **PHP 8+**
-  **MySQL**
-  Sécurité : `password_hash`, `prepared statements`, validation côté serveur
-  Architecture simple mais modulaire

---

##  Installation et Lancement

### 1. Pré-requis

- Serveur local comme [XAMPP](https://www.apachefriends.org/index.html)
- PHP & MySQL installés
- Navigateur web moderne

### 2. Cloner le projet

'''bash

git clone https://github.com/Evrard-Noumbi-3il/Reservation.git
cd Reservation

### 3. Lancer le projet
Placer le dossier dans htdocs (si tu utilises XAMPP)

Démarrer Apache et MySQL dans XAMPP

Accéder dans le navigateur :
 http://localhost/Reservation/index.php


### À venir / améliorations possibles

 - Ajout de pagination ou scroll infini

 - Confirmation de suppression

 - Meilleure responsivité mobile

 - Statistiques et graphiques

 - Notifications par email

### Auteur

Nom : NOUMBI Danol
École : 3il ingénieurs
GitHub : @Evrard-Noumbi-3il