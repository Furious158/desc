<?php
require 'db.php'; // Connexion à la base de données

session_start();

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id']; // ID de l'utilisateur connecté
    $type = $_POST['type']; // Type : "demande" ou "offre"
    $category = $_POST['category']; // Catégorie sélectionnée
    $details = $_POST['details']; // Détails du post
    $disponibilites = $_POST['disponibilites'] ?? null; // Disponibilités (optionnel)
    $points_requis = $_POST['points_requis'] ?? 0;

    $stmt = $pdo->prepare("
        INSERT INTO posts (user_id, type, category, details, disponibilites, points_requis)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$user_id, $type, $category, $details, $disponibilites, $points_requis]);

    header('Location: index.php'); // Redirige vers la page d'accueil
    exit;
}
?>
