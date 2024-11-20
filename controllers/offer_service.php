<?php include '../includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

    <title>Document</title>
</head>

<body>
    <main>
        <main>
            <section class="category-selection">
                <h2>Choisissez une catégorie</h2>
                <form action="categorie_details.php" method="POST">
                    <div class="form-group">
                        <label for="categorie">Catégorie :</label>
                        <select id="categorie" name="categorie" required>
                            <option value="" disabled selected>-- Sélectionnez une catégorie --</option>
                            <option value="aide_aux_devoirs">Aide aux devoirs ou aux cours</option>
                            <option value="pret_materiel">Prêt de matériel (livres, ordinateurs, etc.)</option>
                            <option value="cours_particuliers">Cours particuliers dans des matières spécifiques</option>
                            <option value="etudes_groupe">Organisation d'études de groupe</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-submit">Valider</button>
                </form>
            </section>
        </main>


    </main>

    <?php include '../includes/footer.php'; ?>

</body>

</html>