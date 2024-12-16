<?php
require 'db.php'; // Inclure la connexion à la base de données

// Vérifier si l'ID du post est passé en paramètre
if (!isset($_GET['id'])) {
    die("Post non spécifié.");
}

$postId = intval($_GET['id']);

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
        die("Post introuvable.");
    }
} catch (PDOException $e) {
    die("Erreur lors de la récupération du post : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du post</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="css/cards.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
<?php include 'header.php'; ?>

<main>
    <section class="post-details-page">
        <div class="post-header">
            <img src="<?php echo htmlspecialchars($post['profile_picture'] ?? 'default-avatar.png'); ?>" alt="Photo de profil" class="profile-picture">
            <h3><?php echo htmlspecialchars($post['username']); ?></h3>
        </div>
        <div class="post-details">
            <p><strong>Type :</strong> <?php echo htmlspecialchars($post['type']); ?></p>
            <p><strong>Catégorie :</strong> <?php echo htmlspecialchars($post['category']); ?></p>
            <p><strong>Détails :</strong> <?php echo htmlspecialchars($post['details']); ?></p>
            <?php if ($post['disponibilites']): ?>
                <p><strong>Disponibilités :</strong> <?php echo htmlspecialchars($post['disponibilites']); ?></p>
            <?php endif; ?>
            <?php if ($post['prix_par_heure']): ?>
                <p><strong>Prix par heure :</strong> <?php echo htmlspecialchars($post['prix_par_heure']); ?> €</p>
            <?php endif; ?>
        </div>
        <p class="post-date">Publié le : <?php echo date("d/m/Y H:i", strtotime($post['created_at'])); ?></p>
        <a href="purchase.php?post_id=<?php echo $post['id']; ?>" class="btn btn-purchase">Acheter cette offre</a>
    </section>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
