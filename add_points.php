 
<?php
session_start(); // Démarrer la session

require 'db.php'; // Connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id']; // ID de l'utilisateur connecté

// Vérifier si le bouton a été cliqué
if (isset($_POST['add_points'])) {
    // Le nombre de points à ajouter (par exemple, 10 points)
    $pointsToAdd = 10;

    try {
        // Incrémenter les points de l'utilisateur
        $stmt = $pdo->prepare("UPDATE users SET points = points + ? WHERE id = ?");
        $stmt->execute([$pointsToAdd, $userId]);

        // Afficher un message de succès
        echo "<p>Vous avez ajouté {$pointsToAdd} points à votre compte.</p>";
        echo "<a href='index.php'>Retour à l'accueil</a>";
    } catch (PDOException $e) {
        // Si une erreur se produit, afficher un message d'erreur
        die("Erreur lors de l'ajout de points : " . $e->getMessage());
    }
} else {
    // Si le formulaire n'a pas été soumis, rediriger l'utilisateur
    header('Location: index.php');
    exit;
}
?>
