<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if (!$email) {
        die("Email invalide.");
    }

    // Vérification de la force du mot de passe
    if (strlen($password) < 8) {
        die("Le mot de passe doit comporter au moins 8 caractères.");
    }

    // Hachage du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashedPassword]);
        echo "Inscription réussie.";
        header("Location: connexion.php");
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            die("Nom d'utilisateur ou email déjà utilisé.");
        }
        die("Erreur : " . $e->getMessage());
    }
}
?>


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
        <form action="Registration.php" method="POST">
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
