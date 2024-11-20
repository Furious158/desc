<?php include 'includes/header.php'; ?>
<?php
require 'php/db.php'; // Inclure la connexion à la base de données

// Récupérer tous les posts
try {
    $stmt = $pdo->prepare("
        SELECT posts.*, users.username, users.profile_picture 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        ORDER BY posts.created_at DESC
    ");
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer tous les posts
} catch (PDOException $e) {
    die("Erreur lors de la récupération des posts : " . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme d'échange de services</title>

    <!-- Lier le fichier CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/responsive.css">


</head>
<main>
    <section class="introduction">
        <h2>Facilitez vos échanges de services</h2>
        <p>Cette plateforme vous permet de proposer des services (comme l'aide aux devoirs, le prêt de matériel, etc.)
            ou de demander des services dont vous avez besoin.</p>
    </section>

    <section class="actions">
        <h2>Commencez maintenant</h2>
        <div class="buttons">
            <a href="controllers/offer_service.php" class="btn">Offer a service</a>
            <a href="controllers/find_service.php" class="btn">Find a service</a>
        </div>
    </section>

    <section class="posts">
        <h2>Derniers posts</h2>
        <?php if (!empty($posts)): ?>
            <div class="post-list">
                <?php foreach ($posts as $post): ?>
                    <article class="post">
                        <div class="post-header">
                            <!-- Affichage du nom de l'utilisateur et de sa photo -->
                            <img src="<?php echo htmlspecialchars($post['profile_picture'] ?? 'default-avatar.png'); ?>"
                                alt="Photo de profil" class="profile-picture">
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
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Aucun post disponible pour le moment.</p>
        <?php endif; ?>
    </section>
</main>


<?php include 'includes/footer.php'; ?>

</body>

</html>