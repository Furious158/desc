<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<main>


</main>
</body>

<?php include 'footer.php'; ?>

</html>


<?php

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Redirige vers la page d'inscription avec une URL de retour
    header('Location: registration.php?redirect_to=find_service.php');
    exit;
}

// Code de la page pour demander un service...
?>
