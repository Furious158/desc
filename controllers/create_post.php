<?php
require '../php/db.php'; // Connexion à la base de données
session_start();

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id']; // ID de l'utilisateur connecté
    $type = $_POST['type']; // Type : "demande" ou "offre"
    $category = $_POST['category']; // Catégorie sélectionnée
    $details = $_POST['details']; // Détails du post
    $disponibilites = $_POST['disponibilites'] ?? null; // Disponibilités (optionnel)
    $prix_par_heure = $_POST['prix_par_heure'] ?? null; // Prix (optionnel pour les offres)

    $stmt = $pdo->prepare("
        INSERT INTO posts (user_id, type, category, details, disponibilites, prix_par_heure)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$user_id, $type, $category, $details, $disponibilites, $prix_par_heure]);

    // Redirection vers la page d'accueil ou une page de confirmation
    header('Location: index.php'); // Redirige vers la page d'accueil
    exit;
}
?>
