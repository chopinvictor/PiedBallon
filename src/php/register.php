<?php
require_once('bdd.php');
require_once('fonctions.php');
//var_dump($_POST);

session_start();
 


if(isset($_POST['send'])){
    var_dump($_POST['send']);
    if(!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['mdp']) && ($_POST['mdp2'] == $_POST['mdp']) && !empty($_POST['email']) ){
        // strip_tags pour enlever le code html sql etc etc 
        $prenom = strip_tags($_POST['prenom']);
        $nom = strip_tags($_POST['nom']);
        $email = strip_tags($_POST['email']);
        $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT);

        $exist = $db->prepare('SELECT * FROM utilisateurs WHERE adresse_mail = ?');
        $exist->execute(array($email));

        if($exist->rowCount()==0){  
            $insertUser = $db-> prepare('INSERT INTO utilisateurs(nom , prenom, mot_de_passe, adresse_mail)VALUES(?,?,?,?)');
            $insertUser->execute(array($nom,$prenom,$mdp,$email));
            
            $getUser = $db->prepare('SELECT * FROM utilisateurs WHERE nom = ? AND prenom = ? AND mot_de_passe = ? AND adresse_mail = ?');
            $getUser->execute(array($nom,$prenom,$mdp,$email));

            header("Location: ../php/login.php");


        }else{
            echo "l'email est déjà utilisé veuillez en saisir une autre";
        }




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