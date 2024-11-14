<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>

<main>
    <div class="form-container">
        <form class="form">
            <div>
                <label class="label" for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    class="input"
                    placeholder="Votre email"
                    required
                />
            </div>

            <div>
                <label class="label" for="password">Mot de passe</label>
                <input
                    type="password"
                    id="password"
                    class="input"
                    placeholder="Votre mot de passe"
                    required
                />
            </div>

            <div class="text-center">
                <button
                    type="submit"
                    class="button"
                >
                    Connexion
                </button>
            </div>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
