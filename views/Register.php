<?php
require '../php/db.php';

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
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            die("Nom d'utilisateur ou email déjà utilisé.");
        }
        die("Erreur : " . $e->getMessage());
    }
}
?>