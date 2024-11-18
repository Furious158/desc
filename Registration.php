<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css"> <!-- Assure-toi que le chemin vers le CSS est correct -->
</head>
<body>
<div class="form-container">
    <div class="form">
        <h1 class="text-center">Inscription</h1>
        <form action="register.php" method="POST">
            <label class="label" for="username">Nom d'utilisateur</label>
            <input class="input" type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required>
            
            <label class="label" for="email">Adresse email</label>
            <input class="input" type="email" id="email" name="email" placeholder="Entrez votre adresse email" required>
            
            <label class="label" for="password">Mot de passe</label>
            <input class="input" type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
            
            <button class="button" type="submit">S'inscrire</button>
        </form>
        <div class="message text-center">
            <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a>.</p>
        </div>
    </div>
</div>
</body>
</html>

<?php include 'footer.php'; ?>
