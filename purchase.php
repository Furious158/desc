<?php
session_start(); // Démarrer la session pour accéder aux données utilisateur

require 'db.php'; // Inclure la connexion à la base de données

// Vérifier si l'ID du post est passé en paramètre
if (!isset($_GET['post_id'])) {
    die("Aucune offre spécifiée.");
}

$postId = intval($_GET['post_id']);

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page d'inscription avec une URL de retour
    header('Location: Registration.php?redirect_to=' . urlencode("purchase.php?post_id={$postId}"));
    exit;
}

// Récupérer les détails du post
try {
    $stmt = $pdo->prepare("
        SELECT posts.*, users.username, users.profile_picture 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        WHERE posts.id = ?
    ");
    $stmt->execute([$postId]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        die("Offre introuvable.");
    }
} catch (PDOException $e) {
    die("Erreur lors de la récupération du post : " . $e->getMessage());
}

// Logique d'achat (à implémenter ici)
echo "Merci pour votre intérêt pour l'offre : " . htmlspecialchars($post['details']);
?>
