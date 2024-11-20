<?php

// Définir les informations de connexion à la base de données
$host = 'localhost';  // Hôte de la base de données (par défaut localhost)
$dbname = 'test_db';  // Nom de la base de données
$username = 'root';   // Nom d'utilisateur de la base de données
$password = '';       // Mot de passe de la base de données

// Vérification si le fichier 'install.lock' existe
if (file_exists('install.lock')) {
    // Vérifie si la base de données existe déjà
    try {
        $pdo = new PDO("mysql:host=$host", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si la base de données existe
        $stmt = $pdo->query("SHOW DATABASES LIKE '$dbname'");
        if ($stmt->rowCount() > 0) {
            // Si la base de données existe, on redirige immédiatement
            echo "La base de données '$dbname' existe déjà. Vous allez être redirigé vers l'index.<br>";

            // Afficher un indicateur de chargement avant la redirection
            echo "<div id='loading'>
                    <div class='loader'></div>
                  </div>";
            // Mettre en pause pour afficher l'animation de chargement avant de rediriger
            sleep(3); // Attendre 3 secondes pour afficher l'animation
            // Redirection automatique vers l'index après 3 secondes
            header("Refresh: 3; url=index.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
    }
}

// Connexion à MySQL (en utilisant PDO)
try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si la base de données existe
    $stmt = $pdo->query("SHOW DATABASES LIKE '$dbname'");
    if ($stmt->rowCount() == 0) {
        // Créer la base de données si elle n'existe pas
        $pdo->exec("CREATE DATABASE $dbname");
        echo "Base de données '$dbname' créée avec succès.<br>";
    }

    // Sélectionner la base de données
    $pdo->exec("USE $dbname");

    // Créer les tables si elles n'existent pas déjà
    $sql = "
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            profile_picture VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS posts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            category VARCHAR(255) NOT NULL,
            type VARCHAR(255) NOT NULL,
            details TEXT,
            price DECIMAL(10, 2),
            availability TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );
    ";

    // Exécuter la création des tables
    $pdo->exec($sql);
    echo "Tables créées avec succès.<br>";

    // Créer un fichier 'install.lock' pour marquer que l'installation est terminée
    file_put_contents('install.lock', ''); // Crée un fichier vide

    // Afficher un message de succès
    echo "Installation terminée avec succès. Vous allez être redirigé vers l'index.<br>";

    // Afficher un indicateur de chargement
    echo "<div id='loading'>
            <div class='loader'></div>
          </div>";

    // Mettre en pause pour afficher l'animation de chargement avant de rediriger
    sleep(3); // Attendre 3 secondes pour afficher l'animation

    // Redirection automatique vers l'index après 3 secondes
    header("Refresh: 3; url=index.php");

} catch (PDOException $e) {
    echo "Erreur lors de la connexion ou de la création de la base de données : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation</title>

    <!-- CSS intégré pour l'animation de chargement -->
    <style>
        /* Style global pour le corps de la page */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        #loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Pour centrer l'animation verticalement */
        }

        .loader {
            border: 8px solid #f3f3f3;
            /* Gris clair */
            border-top: 8px solid #3498db;
            /* Bleu */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        /* Animation pour faire tourner le cercle */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <!-- Le contenu de la page est généré par PHP -->
</body>

</html>