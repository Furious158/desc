

<?php
$stmt = $pdo->query("
    SELECT 
        posts.id AS post_id,
        users.username,
        users.profile_picture,
        posts.type,
        posts.category,
        posts.details,
        posts.disponibilites,
        posts.prix_par_heure,
        posts.created_at
    FROM posts
    JOIN users ON posts.user_id = users.id
    ORDER BY posts.created_at DESC
");

$posts = $stmt->fetchAll();

foreach ($posts as $post) {
    echo '<div class="post">';
    echo '<img src="' . htmlspecialchars($post['profile_picture']) . '" alt="Profile Picture">';
    echo '<h3>' . htmlspecialchars($post['username']) . '</h3>';
    echo '<p>Type : ' . htmlspecialchars($post['type']) . '</p>';
    echo '<p>Catégorie : ' . htmlspecialchars($post['category']) . '</p>';
    echo '<p>' . htmlspecialchars($post['details']) . '</p>';
    if ($post['disponibilites']) {
        echo '<p>Disponibilités : ' . htmlspecialchars($post['disponibilites']) . '</p>';
    }
    if ($post['prix_par_heure']) {
        echo '<p>Prix par heure : ' . htmlspecialchars($post['prix_par_heure']) . '€</p>';
    }
    echo '<p>Publié le : ' . htmlspecialchars($post['created_at']) . '</p>';
    echo '</div>';
}
?>
