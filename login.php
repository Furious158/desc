<?php
session_start(); // Toujours démarrer la session au tout début du script
require 'db.php';

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
