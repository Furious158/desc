# **_Configuration et exécution du projet_**

Suivez les étapes ci-dessous pour configurer et exécuter le projet sur votre machine locale.

## **_Installation automatique de la base de données_**

Le projet est conçu pour **automatiser l'installation de la base de données**. Une fois les services **Apache** et **MySQL** démarrés, l'application s'occupe de **créer la base de données** et les tables nécessaires.

1. Assurez-vous que **XAMPP** est installé et que les services **Apache** et **MySQL** sont démarrés.
2. Rendez-vous sur [http://localhost:8080/desc/install_page.php](http://localhost:8080/desc/install_page.php).
3. L'application initialisera automatiquement la **base de données** si elle ne trouve pas les tables nécessaires.

---

### **_Instructions manuelles (si l'installation automatique échoue)_**

Si, pour une raison quelconque, **l'installation automatique ne fonctionne pas**, vous pouvez suivre ces étapes pour configurer manuellement la base de données.

### **_Étape 1 : Accéder à phpMyAdmin_**

1. Ouvrez votre navigateur et allez sur **[http://localhost:8080/phpmyadmin](http://localhost:8080/phpmyadmin)**.
2. Vous serez redirigé vers l'interface de gestion de la base de données **MySQL**, **phpMyAdmin**.

### **_Étape 2 : Créer une base de données_**

1. Dans **phpMyAdmin**, cliquez sur l'onglet **Bases de données**.
2. Créez une nouvelle base de données en l'appelant **`desc_bdd`** (sans les guillemets).

### **_Étape 3 : Créer la table `users`_**

1. Dans **phpMyAdmin**, sélectionnez la base de données **`desc_bdd`**.
2. Allez dans l'onglet **SQL** et entrez le code suivant pour créer la table **`users`** :

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

3. Cliquez sur **Exécuter** pour créer la table `users`.

### **_Étape 4 : Créer la table `posts`_**

1. Toujours dans **phpMyAdmin**, dans la base de données **`desc_bdd`**, allez à l'onglet **SQL** et entrez le code suivant pour créer la table **`posts`** :

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

2. Cliquez sur **Exécuter** pour créer la table **posts**.

### **_Étape 5 : Accéder au projet_**

Une fois les étapes précédentes terminées, rendez-vous sur **[http://localhost:8080/desc/index.php](http://localhost:8080/desc/index.php)** pour voir et interagir avec votre projet sur votre serveur local.

---

## **_Remarques_**

- **Automatisation réussie** : Si **l'installation automatique fonctionne**, vous n'avez pas besoin de suivre les étapes manuelles.
- **Vérification de l'environnement** : Si vous rencontrez des problèmes, vérifiez que les services **Apache** et **MySQL** sont actifs.
- **Support** : Si vous continuez à rencontrer des problèmes, consultez les logs d'erreur de **MySQL** et d'**Apache** ou contactez le support du projet.
