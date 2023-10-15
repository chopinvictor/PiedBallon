<?php
require_once('bdd.php');
require_once('fonctions.php');
//var_dump($_POST);

if(isset($_POST['send'])){
    if(!empty($_POST['username']) && !empty($_POST['mdp']) && !empty($_POST['email']) ){
        // strip_tags pour enlever le code html sql etc etc 
        $username = strip_tags($_POST['username']);
        $email = strip_tags($_POST['email']);
        $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT);

        $insertUser = $db-> prepare('INSERT INTO list_user(UserName,Password,Email)VALUES(?,?,?)');
        $insertUser->execute(array($username,$mdp,$email));
        
        $getUser = $db->prepare('SELECT * FROM list_user WHERE UserName = ? AND Password = ? AND Email = ?');
        $getUser->execute(array($username,$mdp,$email));

        if($getUser->rowCount()>0){
            $_SESSION['Username'] = $username;
            $_SESSION['id'] = $getUser->fetch()['Id_list_user'];
            header("Location: ../HTML/identification.php");
            exit();
        }

        echo $_SESSION['id'];

    }else{
        echo "veuillez saisir tout pd";
    }
}


?>

<!-- <script type='text/javascript'>alert("heaejhazilejai");</script> -->

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
    <form action="" method="POST">
        <h2>Inscription</h2>
        <div>
            <label>Email:</label>
            <input type="email" name="email">
        </div>
        <div style="display:flex; gap: 1%;">
            <div>
                <label>Nom</label>
                <input type="text" name="nom">
            </div>
            <div>
                <label>Prénom</label>
                <input type="text" name="prenom">
            </div>
        </div>
        <div>
            <label>Mot de passe:</label>
            <input type="password" name="mdp">
        </div>
        <div>
            <label>Confimer le mot de passe:</label>
            <input type="password" name="mdp2">
        </div>
        <button name="send" type="submit">S'inscrire</button>
        <footer>Déjà Membre ? <a href="login.php">Connectez-vous</a></footer>
    </form>
</main>
</body>
</html>