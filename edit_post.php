<?php include 'header.php'; ?>
<?php
require 'db.php';


// Vérification que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Récupération du post
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
    $stmt->execute([$post_id, $_SESSION['user_id']]);
    $post = $stmt->fetch();

    // Vérification que le post existe et appartient à l'utilisateur
    if (!$post) {
        echo "Post introuvable ou vous n'avez pas les droits.";
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}

// Traitement de la mise à jour
if (isset($_POST['submit'])) {
    $type = $_POST['type'];
    $category = $_POST['category'];
    $details = $_POST['details'];
    $disponibilites = $_POST['disponibilites'] ?? null;
    $points_requis = $_POST['points_requis'] ?? 0;

    $stmt = $pdo->prepare("
        UPDATE posts 
        SET type = ?, category = ?, details = ?, disponibilites = ?, points_requis = ?
        WHERE id = ? AND user_id = ?
    ");
    $stmt->execute([$type, $category, $details, $disponibilites, $points_requis, $post_id, $_SESSION['user_id']]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<main>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le post</title>
</head>
<body>
<h2>Modifier le post</h2>
<form action="edit_post.php?id=<?php echo $post_id; ?>" method="POST">
    <label for="type">Type :</label>
    <select id="type" name="type" required>
        <option value="offre" <?php if ($post['type'] == 'offre') echo 'selected'; ?>>Offre</option>
        <option value="demande" <?php if ($post['type'] == 'demande') echo 'selected'; ?>>Demande</option>
    </select>
    <br>

    <label for="category">Catégorie :</label>
    <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($post['category']); ?>" required>
    <br>

    <label for="details">Détails :</label>
    <textarea id="details" name="details" rows="5" required><?php echo htmlspecialchars($post['details']); ?></textarea>
    <br>

    <label for="disponibilites">Disponibilités :</label>
    <input type="text" id="disponibilites" name="disponibilites" value="<?php echo htmlspecialchars($post['disponibilites']); ?>">
    <br>

    <label for="points_requis">Points requis :</label>
    <input type="number" id="points_requis" name="points_requis" value="<?php echo htmlspecialchars($post['points_requis']); ?>" min="0" step="1.0" required>
    <br>

    <button type="submit" name="submit">Mettre à jour</button>
</form>

</main>
<?php include 'footer.php'; ?>

</body>
</html>
