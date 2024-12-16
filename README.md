# Guide d'installation et de configuration

Suivez les étapes ci-dessous pour exécuter ce projet localement sur votre machine.

---

## Prérequis

### Télécharger et installer XAMPP

1. Téléchargez XAMPP : [https://www.apachefriends.org/fr/index.html](https://www.apachefriends.org/fr/index.html).
2. Installez XAMPP et lancez le panneau de contrôle.
3. Activez **Apache** et **MySQL**.

---

## Configuration de la base de données

### Étape 1 : Accéder à phpMyAdmin

1. Ouvrez votre navigateur et accédez à : [http://localhost:8080/phpmyadmin](http://localhost:8080/phpmyadmin).

### Étape 2 : Créer une base de données

1. Cliquez sur **Nouvelle Base de Données**.
2. Entrez le nom **`desc_bdd`** et cliquez sur **Créer**.

### Étape 3 : Ajouter les tables

#### Table `users`

1. Sélectionnez la base de données **`desc_bdd`**.
2. Allez dans l'onglet **SQL** et copiez le code suivant :

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    profile_picture VARCHAR(255) DEFAULT NULL, -- Colonne pour la photo de profil
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

1. Toujours dans la base de données **`desc_bdd`**, allez dans l'onglet **SQL** et insérez ce code :

```sql
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    type ENUM('demande', 'offre') NOT NULL,
    category VARCHAR(255) NOT NULL,
    details TEXT NOT NULL,
    disponibilites TEXT,
    prix_par_heure DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

---

Lancer l'application

1. Placez les fichiers du projet dans le dossier `htdocs` de XAMPP.
   Exemple : `C:/xampp/htdocs/desc/`
2. Ouvrez un navigateur web et accédez à l'URL suivante :
   [http://localhost:8080/desc/index.php](http://localhost:8080/desc/index.php).

---

Fonctionnalités disponibles
Utilisateurs (users)

- Colonnes :
  - `username` : Nom d'utilisateur unique.
  - `email` : Adresse e-mail unique.
  - `password` : Mot de passe haché.
  - `profile_picture` : (Facultatif) Photo de profil.

Publications (posts)

- Types :

  - `demande` : Annonce pour demander un service.
  - `offre` : Annonce pour offrir un service.

- Colonnes clés :
  - `category` : Catégorie du service.
  - `details` : Description détaillée.
  - `disponibilites` : Disponibilités associées.
  - `prix_par_heure` : Tarif horaire.

---

Notes supplémentaires

- Port de MySQL : Si vous utilisez un autre port que 8080, modifiez l'URL appropriée.
- Fichier `db.php` : Configurez les identifiants de connexion à votre base de données MySQL dans ce fichier.

---

Ressources utiles

- XAMPP - Documentation Officielle : https://www.apachefriends.org/faq.html
- phpMyAdmin - Documentation : https://www.phpmyadmin.net/docs/
