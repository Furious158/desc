<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Suppression uniquement si le post appartient à l'utilisateur connecté
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
    $stmt->execute([$post_id, $_SESSION['user_id']]);

    header("Location: index.php");
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>
