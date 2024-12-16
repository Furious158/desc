<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/cards.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>

<main>
    <div class="form-container">
        <!-- Affichage du message d'erreur si présent -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert">
                <?php
                echo htmlspecialchars($_SESSION['message']); // Affiche le message
                unset($_SESSION['message']); // Supprime le message pour éviter qu'il réapparaisse
                ?>
            </div>
        <?php endif; ?>

        <div class="form-card">
            <form class="form" action="login.php" method="POST">
                <h1 class="text-center">Connexion</h1>

                <div>
                    <label class="label" for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="input"
                        placeholder="Votre email"
                        required
                    />
                </div>

                <div>
                    <label class="label" for="password">Mot de passe</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="input"
                        placeholder="Votre mot de passe"
                        required
                    />
                </div>

                <div class="text-center">
                    <button type="submit" class="button">Connexion</button>
                </div>
                <div>
                    <p>Pas de compte ? <a href="registration.php">Inscrivez-vous !</a></p>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
