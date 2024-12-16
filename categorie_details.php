<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la catégorie</title>
</head>
<body>
<main>
    <?php
    // Vérifiez que la catégorie a été transmise depuis la page précédente
    if (!isset($_POST['categorie'])) {
        echo "<p>Erreur : aucune catégorie sélectionnée.</p>";
        exit;
    }

    // Récupérez la catégorie sélectionnée
    $categorie = htmlspecialchars($_POST['categorie']);
    ?>

    <h2>Publier une annonce pour la catégorie : <?php echo $categorie; ?></h2>
    <form action="create_post.php" method="POST">
        <!-- Champ caché pour transmettre la catégorie -->
        <input type="hidden" name="category" value="<?php echo $categorie; ?>">

        <div class="form-group">
            <label for="type">Type :</label>
            <select id="type" name="type" required>
                <option value="offre">Offre</option>
                <option value="demande">Demande</option>
            </select>
        </div>

        <div class="form-group">
            <label for="disponibilites">Disponibilités :</label>
            <input type="text" id="disponibilites" name="disponibilites" placeholder="Ex : Lundi au vendredi, 14h-18h" required>
        </div>
        <div class="form-group">
            <label for="points_requis">Points requis :</label>
            <input type="number" id="points_requis" name="points_requis" min="0" step="1.0" placeholder="Ex : 15" required>
        </div>
        <div class="form-group">
            <label for="details">Détails :</label>
            <textarea id="details" name="details" rows="5" placeholder="Décrivez votre service ou votre demande" required></textarea>
        </div>

        <button type="submit" name="submit" class="btn-submit">Publier</button>
    </form>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
