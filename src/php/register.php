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
        <title>Inscription</title>
    </head>
    <body>
<main>
    <form action="inscriptionValidation.php" method="POST">
        <h2>Inscription</h2>
        <div>
            <label>Email</label>
            <input type="email" name="email" value=<?php echo ($_POST) ? $_POST['email'] : "" ?>>
        </div>
        <div style="display:flex; gap: 1%;">
            <div>
                <label>Nom</label>
                <input type="text" name="nom" value=<?php echo ($_POST) ? $_POST['nom'] : "" ?>>
            </div>
            <div>
                <label>Prénom</label>
                <input type="text" name="prenom" value=<?php echo ($_POST) ? $_POST['prenom'] : "" ?>>
            </div>
        </div>
        <div>
            <label>Mot de passe</label>
            <input type="password" name="mdp" minlength="4" maxlength="20" required>
        </div>
        <div>
            <label>Confimer le mot de passe</label>
            <input type="password" name="mdp2" minlength="4" maxlength="20" required>
        </div>
        <button type="submit">S'inscrire</button>
        <footer>Déjà Membre ? <a href="login.php">Connectez-vous</a></footer>
    </form>
</main>
</body>
</html>