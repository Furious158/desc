<?php
// Vérifiez si la catégorie a été envoyée depuis la page précédente
if (!isset($_POST['categorie'])) {
    echo "<p>Erreur : aucune catégorie sélectionnée.</p>";
    exit;
}

// Récupérer la catégorie sélectionnée
$categorie = htmlspecialchars($_POST['categorie']);
?>

<?php include '../includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <title>Détails de la catégorie</title>
</head>

<body>
    <main>
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
                <input type="text" id="disponibilites" name="disponibilites"
                    placeholder="Ex : Lundi au vendredi, 14h-18h" required>
            </div>
            <div class="form-group">
                <label for="prix">Prix par heure (en €) :</label>
                <input type="number" id="prix" name="prix_par_heure" min="0" step="0.01" placeholder="Ex : 15" required>
            </div>
            <div class="form-group">
                <label for="details">Détails :</label>
                <textarea id="details" name="details" rows="5" placeholder="Décrivez votre service ou votre demande"
                    required></textarea>
            </div>

            <button type="submit" name="submit" class="btn-submit">Publier</button>
        </form>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>

</html>
