<?php include 'header.php'; ?>
<?php
// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}

// Récupérer les informations utilisateur depuis la base de données
require 'db.php';
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    if (!$user) {
        // Si l'utilisateur n'existe pas, déconnectez-le
        session_destroy();
        header("Location: connexion.php");
        exit;
    }
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}

// Gérer l'upload de la photo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
    $file = $_FILES['profile_picture'];
    if ($file['error'] === 0) {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($ext, $allowed_exts)) {
            $newFileName = uniqid('profile_', true) . '.' . $ext;
            $uploadDir = 'uploads/profile_pictures/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Crée le dossier s'il n'existe pas
            }
            $uploadPath = $uploadDir . $newFileName;

            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                // Mettre à jour la base de données
                $stmt = $pdo->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
                $stmt->execute([$uploadPath, $_SESSION['user_id']]);
                header("Location: Account.php"); // Rafraîchir pour afficher la nouvelle photo
                exit;
            } else {
                echo "Erreur lors du téléchargement.";
            }
        } else {
            echo "Format de fichier non supporté. Seuls les formats JPG, JPEG, PNG, et GIF sont acceptés.";
        }
    } else {
        echo "Erreur lors de l'upload.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte</title>
</head>
<body>
<main class="account-container">
    <h1>Bienvenue sur votre compte</h1>
    <p>Username : <?php echo htmlspecialchars($user['username']); ?></p>
    <p>Email : <?php echo htmlspecialchars($user['email']); ?></p>
    <p>Points : <?php echo htmlspecialchars($user['points']); ?></p> </p>

    <!-- Afficher la photo de profil, ou utiliser la photo par défaut -->
    <img src="<?php echo !empty($user['profile_picture']) ? htmlspecialchars($user['profile_picture']) : 'uploads/profile_pictures/default-user.png'; ?>" alt="Photo de profil" style="width: 150px; height: 150px; border-radius: 50%;">

    <!-- Formulaire pour ajouter/modifier la photo de profil -->
    <form action="Account.php" method="POST" enctype="multipart/form-data">
        <label for="profile_picture">Changer votre photo de profil :</label>
        <input type="file" name="profile_picture" id="profile_picture" accept=".jpg, .jpeg, .png, .gif">
        <button type="submit">Mettre à jour</button>
    </form>

    <a href="logout.php">Déconnexion</a>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
