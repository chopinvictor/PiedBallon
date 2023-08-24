<?php
require_once('crud.php');
require_once('fonctions.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/register.css">
        <title>Connexion</title>
    </head>
    <body>
<main>
    <form action="connexionValidation.php" method="POST">
        <h2>Connexion</h2>
        <div>
            <label>Email</label>
            <input type="email" name="email" value=<?php echo ($_POST) ? $_POST['email'] : "" ?>>
        </div>
        <div>
            <label>Mot de passe</label>
            <input type="password" name="mdp" minlength="4" maxlength="20" required>
        </div>
        <button type="submit">Se connecter</button>
        <footer>Pas de compte ? <a href="register.php">Inscrivez-vous</a></footer>
    </form>
</main>
</body>
</html>