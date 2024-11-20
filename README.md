# Configuration et exécution du projet

Suivez les étapes ci-dessous pour configurer le projet sur votre machine locale.

## Prérequis

Avant de commencer, assurez-vous que vous avez installé [XAMPP](https://www.apachefriends.org/fr/index.html).

### Étape 1 : Télécharger et installer XAMPP

1. Téléchargez XAMPP depuis le site officiel : [Télécharger XAMPP](https://www.apachefriends.org/fr/index.html).
2. Installez XAMPP sur votre machine en suivant les instructions d'installation.

### Étape 2 : Démarrer les services Apache et MySQL

1. Ouvrez le **XAMPP Control Panel**.
2. Cliquez sur **Start** pour démarrer les services **Apache** et **MySQL**. Cela permettra d'exécuter votre serveur local et de gérer la base de données.

### Étape 3 : Accéder à phpMyAdmin

1. Ouvrez votre navigateur et allez sur [http://localhost:8080/phpmyadmin](http://localhost:8080/phpmyadmin).
2. Vous serez redirigé vers l'interface de gestion de la base de données MySQL, phpMyAdmin.

### Étape 4 : Créer une base de données

1. Dans phpMyAdmin, cliquez sur l'onglet **Bases de données**.
2. Créez une nouvelle base de données en l'appelant `desc_bdd` (sans les guillemets).

### Étape 5 : Créer la table `users`

1. Dans phpMyAdmin, sélectionnez la base de données `desc_bdd`.
2. Allez dans l'onglet **SQL** et entrez le code suivant pour créer la table `users` :

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    profile_picture VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

En créer une autre nommée posts et entrer le code ci-dessous :

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

## Étape 6 :

Rendez-vous sur http://localhost:8080/desc/index.php.
