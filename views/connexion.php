<?php include '../includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

</head>

<body>

    <main>
        <div class="form-container">
            <form class="form" action="login.php" method="POST">
                <h1 class="text-center">Connexion</h1>
                <div>
                    <label class="label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="input" placeholder="Votre email" required />
                </div>

                <div>
                    <label class="label" for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" class="input" placeholder="Votre mot de passe"
                        required />
                </div>

                <div class="text-center">
                    <button type="submit" class="button">Connexion</button>
                </div>
                <div>
                    <p>Pas de compte ? <a href="registration.php">Inscrivez-vous !</a></p>
                </div>
            </form>

        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

</body>

</html>