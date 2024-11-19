Pour faire marcher le code sur votre machine il faut :

Telecharger XAMPP : https://www.apachefriends.org/fr/index.html

Lancer Apache et mySQL

Aller sur phpMyAdmin (http://localhost:8080/phpmyadmin)

Créer une nouvelle base de donnée et l'appeler : desc_bdd.

Créer une nouvelle table nommée users et ensuite aller dans la section SQL et entrer le code ci-dessous :

CREATE TABLE users (

    id INT AUTO_INCREMENT PRIMARY KEY,
    
    username VARCHAR(50) NOT NULL UNIQUE,
    
    email VARCHAR(100) NOT NULL UNIQUE,
    
    password VARCHAR(255) NOT NULL,
    
    profile_picture VARCHAR(255) DEFAULT NULL, 
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
);

En créer une autre nommée posts et entrer le code ci-dessous : 

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

Rendez-vous sur http://localhost:8080/desc/index.php.
