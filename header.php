<?php
// Vous pouvez commencer une session si besoin pour gérer les connexions d'utilisateurs
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Échanges de Services Étudiants</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Bienvenue sur la plateforme d'échanges de services entre étudiants</h1>
        <p>Proposez et demandez des services pour vous entraider au quotidien !</p>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Si l'utilisateur est connecté, rediriger vers Account.php -->
            <a href="Account.php" class="user-icon" title="Mon Compte">👤</a>
        <?php else: ?>
            <!-- Sinon, rediriger vers connexion.php -->
            <a href="connexion.php" class="user-icon" title="Connexion">👤</a>
        <?php endif; ?>

        <a href="index.php" class="home-icon" title="Home"><i class="fa-solid fa-house"></i></a>
    </header>
</body>
</html>
