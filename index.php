<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Échanges de Services Étudiants</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>

<?php
// Vous pouvez commencer une session si besoin pour gérer les connexions d'utilisateurs
session_start();
?>

<header>
    <h1>Bienvenue sur la plateforme d'échanges de services entre étudiants</h1>
    <p>Proposez et demandez des services pour vous entraider au quotidien !</p>
</header>

<main>
    <section class="introduction">
        <h2>Facilitez vos échanges de services</h2>
        <p>Cette plateforme vous permet de proposer des services (comme l'aide aux devoirs, le prêt de matériel, etc.) ou de demander des services dont vous avez besoin.</p>
    </section>

    <section class="actions">
        <h2>Commencez maintenant</h2>
        <div class="buttons">
            <a href="proposer_service.php" class="btn">Proposer un Service</a>
            <a href="rechercher_service.php" class="btn">Rechercher un Service</a>
        </div>
    </section>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Échanges de Services Étudiants. Tous droits réservés.</p>
</footer>

</body>
</html>
