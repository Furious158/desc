<?php include '../includes/header.php'; ?>
<?php require '../php/db.php'; // Inclure la connexion à la base de données ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/css/find_services.css">

    <title>Trouver un service</title>
</head>

<body>
    <main>
        <section class="service-search">
            <h2>Trouver un service</h2>
            <form action="find_service.php" method="GET">
                <div class="form-group">
                    <label for="category">Catégorie :</label>
                    <select id="category" name="category" required>
                        <option value="" disabled selected>-- Sélectionnez une catégorie --</option>
                        <option value="aide_aux_devoirs">Aide aux devoirs</option>
                        <option value="pret_materiel">Prêt de matériel</option>
                        <option value="cours_particuliers">Cours particuliers</option>
                        <option value="etudes_groupe">Etudes de groupe</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="location">Localisation :</label>
                    <input type="text" id="location" name="location" placeholder="Entrez la localisation"
                        value="<?php echo htmlspecialchars($_GET['location'] ?? ''); ?>">
                </div>

                <button type="submit" class="btn-submit">Rechercher</button>
            </form>
        </section>

        <section class="service-results">
            <h2>Services disponibles</h2>

            <?php
            // Vérifier si le formulaire a été soumis
            $category = $_GET['category'] ?? '';
            $location = $_GET['location'] ?? '';

            // Préparer la requête SQL avec des filtres
            $sql = "SELECT * FROM posts WHERE 1=1";

            if ($category) {
                $sql .= " AND category = :category";
            }

            if ($location) {
                $sql .= " AND details LIKE :location"; // Rechercher dans les détails
            }

            try {
                $stmt = $pdo->prepare($sql);
                if ($category) {
                    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
                }

                if ($location) {
                    $location = "%$location%"; // Ajouter les pourcentages pour la recherche partielle
                    $stmt->bindParam(':location', $location, PDO::PARAM_STR);
                }

                $stmt->execute();
                $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($posts):
                    foreach ($posts as $post):
                        ?>
                        <div class="card">
                            <h3><?php echo htmlspecialchars($post['category']); ?></h3>
                            <p><?php echo htmlspecialchars($post['details']); ?></p>
                            <button class="button">Demander ce service</button>
                        </div>
                        <?php
                    endforeach;
                else:
                    echo "<p>Aucun service trouvé correspondant à votre recherche.</p>";
                endif;
            } catch (PDOException $e) {
                echo "<p>Erreur lors de la récupération des services : " . $e->getMessage() . "</p>";
            }
            ?>

        </section>
    </main>
</body>

<?php include '../includes/footer.php'; ?>

</html>