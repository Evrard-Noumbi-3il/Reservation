# Système de Réservation d'Évènements

Application web permettant aux utilisateurs de réserver des salles pour des évènements, et aux administrateurs de gérer ces réservations via un tableau de bord sécurisé.

---

## Fonctionnalités

### Réservation (public)
- Formulaire de réservation : nom, nom de l'évènement, date, heure
- Validation côté client (JavaScript) et côté serveur (PHP)
- Vérification des doublons de créneaux par évènement
- Protection CSRF sur tous les formulaires
- Redirection avec messages de succès ou d'erreur

### Authentification (admin)
- Connexion sécurisée avec hachage `bcrypt` (`password_hash`)
- Protection contre la fixation de session (`session_regenerate_id`)
- Blocage temporaire après 5 tentatives échouées (anti-bruteforce)
- Déconnexion avec destruction complète de session

### Tableau de bord admin
- Accessible uniquement aux administrateurs connectés
- Affichage des réservations sous forme de cartes, triées par date et heure
- Suppression via AJAX (requête POST + token CSRF)
- Design responsive

---

## Sécurité

| Mesure | Détail |
|---|---|
| Injections SQL | Requêtes préparées PDO sur toutes les requêtes |
| CSRF | Token aléatoire (`bin2hex(random_bytes(32))`) vérifié sur chaque formulaire |
| Bruteforce | Blocage 5 minutes après 5 tentatives de connexion échouées |
| Session fixation | `session_regenerate_id(true)` après chaque connexion réussie |
| Suppression sécurisée | Action en POST uniquement, protégée par session et CSRF |
| Erreurs masquées | Les détails d'erreur SQL sont loggés, jamais affichés à l'utilisateur |

---

## Structure du projet

```
Reservation/
├── admin/
│   ├── dashboard.php          # Tableau de bord admin
│   ├── login.php              # Page de connexion
│   └── logout.php             # Déconnexion
├── backend/
│   ├── compte.php             # Création du compte admin (à exécuter une seule fois)
│   ├── liste_reservations.php # Liste des réservations (usage interne)
│   ├── reserver.php           # Traitement du formulaire de réservation
│   ├── supprimer_reservation.php # Suppression d'une réservation (POST + CSRF)
│   └── verifier_connexion.php # Vérification des identifiants admin
├── config/
│   └── connexion.php          # Connexion PDO à la base de données
├── includes/
│   ├── footer.php             # Pied de page commun
│   └── header.php             # En-tête et navigation (chemins dynamiques)
├── sql/
│   └── schema.sql             # Schéma SQL (tables reservations et compte)
├── about.php                  # Page À propos
├── index.php                  # Page principale — formulaire de réservation
├── reservation.js             # Logique JS (validation + suppression AJAX)
├── style.css                  # Feuille de styles
└── README.md
```

---

## Technologies utilisées

- **HTML5 / CSS3 / JavaScript (ES6)**
- **PHP 8+**
- **MySQL**
- **PDO** — requêtes préparées
- **XAMPP** — environnement de développement local

---

## Installation

### 1. Prérequis

- [XAMPP](https://www.apachefriends.org/index.html) (ou tout serveur Apache + PHP 8+ + MySQL)
- Navigateur web moderne

### 2. Cloner le projet

```bash
git clone https://github.com/Evrard-Noumbi-3il/Reservation.git
```

Placer le dossier cloné dans `htdocs` (XAMPP) :

```
C:/xampp/htdocs/Reservation/
```

### 3. Configurer la base de données

Démarrer **Apache** et **MySQL** dans le panneau XAMPP, puis ouvrir [phpMyAdmin](http://localhost/phpmyadmin) et importer le fichier SQL :

```
sql/schema.sql
```

Ou via la ligne de commande :

```bash
mysql -u root -p < sql/schema.sql
```

### 4. Configurer la connexion

Vérifier les paramètres dans `config/connexion.php` ( Ou créer le fichier) :

```php
$host   = 'localhost';
$dbname = 'reservation';
$user   = 'root';
$pass   = '';  // À adapter selon votre configuration

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    error_log($e->getMessage());
    die("Erreur de connexion à la base de données.");
}
?>
```

### 5. Créer le compte administrateur

Ouvrir une seule fois dans le navigateur :

```
http://localhost/Reservation/backend/compte.php
```

>**Supprimer ou protéger ce fichier après exécution.** Il ne doit pas rester accessible en ligne.

Les identifiants par défaut sont :
- Nom : `admin`
- Mot de passe : `admin`

> **Changer le mot de passe immédiatement** en modifiant `compte.php` avant de l'exécuter.

### 6. Accéder à l'application

| Page | URL |
|---|---|
| Formulaire de réservation | http://localhost/Reservation/index.php |
| Connexion admin | http://localhost/Reservation/admin/login.php |
| Tableau de bord | http://localhost/Reservation/admin/dashboard.php |
| À propos | http://localhost/Reservation/about.php |

---

## Améliorations prévues

- [ ] Pagination ou défilement infini dans le dashboard
- [ ] Notifications par email à la réservation
- [ ] Statistiques et graphiques d'occupation
- [ ] Meilleure responsivité mobile
- [ ] Rôles utilisateurs (admin / gestionnaire / visiteur)
- [ ] Export CSV des réservations

---

## Auteur

**NOUMBI Danol Evrard**  
GitHub : [@Evrard-Noumbi-3il](https://github.com/Evrard-Noumbi-3il)