
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="stylesheet.css">
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

        <form class="form" action="connexion.php" method="POST">
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
</main>

<?php include 'footer.php'; ?>

</body>
</html>


<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']); // Récupérer l'email
    $password = $_POST['password']; // Récupérer le mot de passe

    try {
        // Requête pour chercher l'utilisateur par email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Vérification du mot de passe
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['message'] = "Connexion réussie. Bienvenue, " . htmlspecialchars($user['username']) . "!";
            header("Location: Account.php"); // Redirection après connexion
            exit;
        } else {
            // Erreur d'authentification
            $_SESSION['message'] = "Email ou mot de passe incorrect.";
            header("Location: connexion.php");
            exit;
        }
    } catch (PDOException $e) {
        // Gestion des erreurs de base de données
        $_SESSION['message'] = "Erreur : " . $e->getMessage();
        header("Location: connexion.php");
        exit;
    }
}
?>