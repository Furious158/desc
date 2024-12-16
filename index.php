<?php include 'header.php'; ?>
<?php
require 'db.php'; // Inclure la connexion à la base de données

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

// Récupérer les paramètres de recherche
$type = $_GET['type'] ?? '';
$category = $_GET['category'] ?? '';

// Construire la requête SQL avec des filtres dynamiques
$query = "
    SELECT posts.*, users.username, users.profile_picture 
    FROM posts 
    JOIN users ON posts.user_id = users.id
    WHERE 1=1
";
$params = [];

// Filtrer par type
if (!empty($type)) {
    $query .= " AND posts.type = :type";
    $params[':type'] = $type;
}

// Filtrer par catégorie
if (!empty($category)) {
    $query .= " AND posts.category = :category";
    $params[':category'] = $category;
}


// Ajouter un tri par date (du plus récent au plus ancien)
$query .= " ORDER BY posts.created_at DESC";

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des posts : " . $e->getMessage());
}




 if (isset($_SESSION['user_id'])): ?>
    <!-- Bouton provisoire pour incrémenter les points -->
    <form action="add_points.php" method="POST">
        <button type="submit" name="add_points" class="btn">Ajouter des points</button>
    </form>


    
<?php endif; ?>



<main>

<section class="introduction">
        <h2>Facilitez vos échanges de services</h2>
        <p>Cette plateforme vous permet de proposer des services (comme l'aide aux devoirs, le prêt de matériel, etc.) ou de demander des services dont vous avez besoin.</p>
        <p>Créez votre compte dès maintenant et recevez 20 points de bienvenue pour bien commencer votre expérience !<p>
    </section>

    
    <section class="actions">
        <h2>Commencez maintenant</h2>
        <div class="buttons">
            <a href="<?php echo isset($_SESSION['user_id']) ? 'offer_service.php' : 'registration.php?redirect_to=offer_service.php'; ?>" class="btn">Proposer ou demander un service</a>
        </div>
    </section>

 <!-- Barre de recherche -->
 <section class="search-bar">
        <h2>Rechercher un service</h2>
        <form method="GET" action="index.php">
            <label for="type">Type :</label>
            <select name="type" id="type">
                <option value="">Tous</option>
                <option value="demande" <?= $type === 'demande' ? 'selected' : '' ?>>Demande</option>
                <option value="offre" <?= $type === 'offre' ? 'selected' : '' ?>>Offre</option>
            </select>
            
            <label for="category">Catégorie :</label>
        <select name="category" id="category">
            <option value="">Toutes</option>
            <option value="aide_aux_devoirs" <?= $category === 'aide_aux_devoirs' ? 'selected' : '' ?>>Aide aux devoirs ou aux cours</option>
            <option value="pret_materiel" <?= $category === 'pret_materiel' ? 'selected' : '' ?>>Prêt de matériel</option>
            <option value="cours_particuliers" <?= $category === 'cours_particuliers' ? 'selected' : '' ?>>Cours particuliers dans des matières spécifiques</option>
            <option value="etudes_groupe" <?= $category === "etudes_groupe" ? 'selected' : '' ?>>Organisation d'études de groupe</option>
        </select>

            <button type="submit" class="btn">Rechercher</button>
        </form>
    </section>

    <section class="posts">
        <h2>Derniers posts</h2>
        <?php if (!empty($posts)): ?>
            <div class="post-list">
                <?php foreach ($posts as $post): ?>
                    <article class="post">
                        <div class="post-header">
                            <!-- Affichage du nom de l'utilisateur et de sa photo -->
                            <img src="<?php echo htmlspecialchars($post['profile_picture'] ?? 'default-avatar.png'); ?>" alt="Photo de profil" class="profile-picture">
                            <h3><?php echo htmlspecialchars($post['username']); ?></h3>
                        </div>
                        <div class="post-details">
                            <p><strong>Type :</strong> <?php echo htmlspecialchars($post['type']); ?></p>
                            <p><strong>Détails :</strong> <?php echo htmlspecialchars($post['details']); ?></p>
                            <p><strong>Points requis :</strong> <?php echo htmlspecialchars($post['points_requis']); ?></p>
                            <?php if ($post['disponibilites']): ?>
                                <p><strong>Disponibilités :</strong> <?php echo htmlspecialchars($post['disponibilites']); ?></p>
                            <?php endif; ?>
                        </div>
                        <p class="post-date">Publié le : <?php echo date("d/m/Y H:i", strtotime($post['created_at'])); ?></p>
                        <a href="post.php?id=<?php echo $post['id']; ?>" class="btn btn-see-more">Voir plus</a>

                        <!-- Boutons Modifier et Supprimer (si utilisateur est le créateur) -->
                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                            <div class="post-actions">
                                <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-edit">Modifier</a>
                                <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="btn btn-delete" onclick="return confirm('Voulez-vous vraiment supprimer ce post ?');">Supprimer</a>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Aucun post disponible pour le moment.</p>
        <?php endif; ?>
    </section>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
