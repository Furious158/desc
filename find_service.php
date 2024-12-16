<?php
require 'db.php'; // Connexion à la base de données



// Récupérer les paramètres de recherche
$category = $_GET['category'] ?? '';
$location = $_GET['location'] ?? '';
$type = $_GET['type'] ?? '';

// Construire la requête SQL avec des filtres dynamiques
$query = "SELECT * FROM posts WHERE type = 'offre'";
$params = [];

if ($category) {
    $query .= " AND category = :category";
    $params[':category'] = $category;
}
if ($location) {
    $query .= " AND details LIKE :location"; // Hypothèse : "details" inclut des informations sur la localisation
    $params[':location'] = '%' . $location . '%';
}
if ($type) {
    $query .= " AND type = :type";
    $params[':type'] = $type;
}

// Ajout de pagination (exemple : 10 résultats par page)
$limit = 10;
$offset = 0; // Vous pouvez ajuster ceci en fonction de la page actuelle (ex. : page 2 -> $offset = 10)
$query .= " LIMIT :limit OFFSET :offset";

// Ajouter les paramètres de pagination
$params[':limit'] = $limit;
$params[':offset'] = $offset;

// Préparer et exécuter la requête
$stmt = $pdo->prepare($query);
foreach ($params as $key => $value) {
    // Bind dynamique des paramètres pour la requête
    if ($key === ':limit' || $key === ':offset') {
        $stmt->bindValue($key, $value, PDO::PARAM_INT);
    } else {
        $stmt->bindValue($key, $value, PDO::PARAM_STR);
    }
}
$stmt->execute();

// Récupérer les résultats
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la recherche</title>
</head>
<body>
<main>
<h1>Résultats de la recherche</h1>

    <?php if (count($services) > 0): ?>
        <ul>
            <?php foreach ($services as $service): ?>
                <li>
                    <h1>Type : <?= htmlspecialchars($service['type']) ?></h1>
                    <p><?= htmlspecialchars($service['details']) ?></p>
                    <p>Catégorie : <?= htmlspecialchars($service['category']) ?></p>
                    <p>Localisation : <?= htmlspecialchars($service['location'] ?? 'Non spécifié') ?></p>
                    <form method="POST" action="request_service.php">
                        <input type="hidden" name="service_id" value="<?= $service['id'] ?>">
                        <button type="submit">Demander ce service</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun service trouvé.</p>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
