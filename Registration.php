<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/cards.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <main>
        <div class="form-container">
            <div class="form-card">
                <h2>Inscription</h2>
                <form action="register.php" method="POST">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required>

                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email" placeholder="Entrez votre adresse email" required>

                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>

                    <button type="submit" class="btn">S'inscrire</button>
                </form>
                <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a>.</p>
            </div>
        </div>
    </main>
</body>
</html>

<?php include 'footer.php'; ?>
