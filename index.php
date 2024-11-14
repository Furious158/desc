<?php include 'header.php'; ?>

<?php
// Vous pouvez commencer une session si besoin pour gérer les connexions d'utilisateurs
session_start();
?>

<main>
    <section class="introduction">
        <h2>Facilitez vos échanges de services</h2>
        <p>Cette plateforme vous permet de proposer des services (comme l'aide aux devoirs, le prêt de matériel, etc.) ou de demander des services dont vous avez besoin.</p>
    </section>

    <section class="actions">
        <h2>Commencez maintenant</h2>
        <div class="buttons">
            <a href="offer_service.php" class="btn">Offer a service</a>
            <a href="find_service.php" class="btn">Find a service</a>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
