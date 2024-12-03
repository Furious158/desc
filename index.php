<?php
require '/xampp/htdocs/desc/php/db.php'; // Connexion à la base de données

// Récupérer tous les posts
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header.php'; ?>

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

<?php if ($posts): ?>
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <h3><?php echo htmlspecialchars($post['category']); ?></h3>
            <p><?php echo htmlspecialchars($post['details']); ?></p>
            <p>Prix : <?php echo htmlspecialchars($post['prix_par_heure']); ?> €</p>
            <p>Disponibilité : <?php echo htmlspecialchars($post['disponibilites']); ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucun service trouvé.</p>
<?php endif; ?>

</main>


<?php include 'includes/footer.php'; ?>

</body>

</html>