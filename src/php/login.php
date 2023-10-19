
<?php

require_once('bdd.php');
require_once('fonctions.php');
$return = null;

if (isset($_POST['send'])) {
    if (!empty($_POST['email'] && !empty($_POST['mdp']))) {

        $query = "SELECT * FROM utilisateurs WHERE adresse_mail =? ";
        
        $return = $db->prepare($query);
        $return->execute([$_POST['email']]);
        $user = $return->fetch(PDO::FETCH_OBJ);

        var_dump($_POST['mdp']);

        var_dump($user); 

        var_dump(password_verify($_POST['mdp'], $user-> mot_de_passe ));
        // header("Location: ../php/general.php");

        if (!empty($user)) {
            

            if (password_verify($_POST['mdp'], $user-> mot_de_passe )) {
                
                session_start();
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['id'] = $user->id_utilisateur;
                echo "<p>ttest</p>";
                header("Location: ../php/general.php");
                exit();
            }
        }
        echo "<p style='color:red;'> Votre mots de passe ou votre identifiant est incorrect <p>";
    }
};



?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/register.css">
        <title>Login</title>
    </head>
    <body>
<main>
    <form action="" method="POST">
        <h2>login</h2>
        <div>
            <label>Email:</label>
            <input type="email" name="email">
        </div>
        <div>
            <label>Mot de passe:</label>
            <input type="password" name="mdp">
        </div>
        <button name="send" type="submit">S'inscrire</button>
        <footer>Vous n'êtes pas membre ? <a href="register.php">Inscrivez-vous</a></footer>
    </form>
</main>
</body>
</html>