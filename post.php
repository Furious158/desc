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

// Gestion de l'achat de l'offre
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start(); // Démarrer la session pour accéder aux données utilisateur

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        header('Location: Registration.php?redirect_to=' . urlencode("post.php?id={$postId}"));
        exit;
    }

    $userId = $_SESSION['user_id']; // ID de l'utilisateur connecté
    $sellerId = $post['user_id']; // ID du vendeur
    $pointsRequis = intval($post['points_requis']); // Points requis pour acheter l'offre

    // Empêcher un utilisateur d'acheter son propre post
    if ($userId === $sellerId) {
        $_SESSION['error_message'] = "Vous ne pouvez pas acheter votre propre offre."; // Message d'erreur
        header("Location: post.php?id={$postId}");
        exit;
    }

    // Vérifier si l'utilisateur a déjà acheté cette offre
    $stmt = $pdo->prepare("SELECT * FROM transactions WHERE user_id = ? AND post_id = ?");
    $stmt->execute([$userId, $postId]);
    $existingTransaction = $stmt->fetch();

    if ($existingTransaction) {
        $_SESSION['error_message'] = "Vous avez déjà acheté cette offre."; // Message d'erreur
        header("Location: post.php?id={$postId}");
        exit;
    }

    // Récupérer le solde de l'utilisateur actuel
    $stmt = $pdo->prepare("SELECT points FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("Utilisateur introuvable.");
    }

    $userPoints = intval($user['points']); // Points actuels de l'utilisateur

    // Vérifier si l'utilisateur a assez de points
    if ($userPoints < $pointsRequis) {
        $_SESSION['error_message'] = "Vous n'avez pas assez de points pour acheter cette offre."; // Message d'erreur
        header("Location: post.php?id={$postId}");
        exit;
    }

    // Début de la transaction pour garantir l'intégrité des données
    $pdo->beginTransaction();

    try {
        // Décrémenter les points de l'acheteur
        $stmt = $pdo->prepare("UPDATE users SET points = points - ? WHERE id = ?");
        $stmt->execute([$pointsRequis, $userId]);

        // Incrémenter les points du vendeur
        $stmt = $pdo->prepare("UPDATE users SET points = points + ? WHERE id = ?");
        $stmt->execute([$pointsRequis, $sellerId]);

        // Enregistrer l'achat dans la table transactions
        $stmt = $pdo->prepare("INSERT INTO transactions (user_id, post_id) VALUES (?, ?)");
        $stmt->execute([$userId, $postId]);

        // Commit de la transaction
        $pdo->commit();

        $_SESSION['success_message'] = "Achat réussi ! Vous avez dépensé {$pointsRequis} points pour l'offre : <strong>" . htmlspecialchars($post['details']) . "</strong>";
        header("Location: post.php?id={$postId}"); // Rediriger pour afficher le message de succès
        exit;

    } catch (PDOException $e) {
        // En cas d'erreur, annuler la transaction
        $pdo->rollBack();
        die("Erreur lors de l'achat : " . $e->getMessage());
    }
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du post</title>
    <link rel="stylesheet" href="stylesheet.css">
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
            <p><strong>Détails :</strong> <?php echo htmlspecialchars($post['details']); ?></p>
            <p><strong>Points requis:</strong> <?php echo htmlspecialchars($post['points_requis']); ?></p>
            <?php if ($post['disponibilites']): ?>
                <p><strong>Disponibilités :</strong> <?php echo htmlspecialchars($post['disponibilites']); ?></p>
            <?php endif; ?>
        </div>
        <p class="post-date">Publié le : <?php echo date("d/m/Y H:i", strtotime($post['created_at'])); ?></p>

        <!-- Affichage des messages d'erreur ou de succès -->
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($_SESSION['error_message']); ?>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_SESSION['success_message']); ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <!-- Formulaire d'achat -->
        <form action="post.php?id=<?php echo $postId; ?>" method="POST">
            <button type="submit" class="btn btn-purchase">Acheter cette offre</button>
        </form>
    </section>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
