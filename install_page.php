<?php
// Vérifier si le fichier install.lock existe pour éviter une réinstallation
if (file_exists('install.lock')) {
    die('L\'installation a déjà été effectuée. Si vous souhaitez réinstaller, supprimez le fichier install.lock.');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 50px;
        }

        h1 {
            color: #333;
        }

        .button-container {
            margin-top: 20px;
        }

        .btn {
            padding: 15px 30px;
            background-color: #007BFF;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 20px;
            padding: 10px;
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            display: none;
        }
    </style>
</head>

<body>

    <h1>Installation de la Base de Données</h1>
    <p>Cliquez sur le bouton ci-dessous pour démarrer l'installation de la base de données.</p>

    <!-- Formulaire pour démarrer l'installation -->
    <div class="button-container">
        <form action="install.php" method="POST">
            <button type="submit" class="btn">Démarrer l'installation</button>
        </form>
    </div>

    <!-- Message de confirmation de l'installation -->
    <div class="message" id="success-message">
        Installation terminée avec succès !
    </div>

    <?php
    // Si le formulaire a été soumis (via la méthode POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Inclure le script d'installation
        include 'install.php';

        // Afficher le message de succès
        echo "<script>document.getElementById('success-message').style.display = 'block';</script>";
    }
    ?>

</body>

</html>