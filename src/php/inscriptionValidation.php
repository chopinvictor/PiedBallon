<?php
require_once('crud.php');
require_once('fonctions.php');
$users = GetAllUtilisateurs();
$regex = "/^([ \x{00c0}-\x{01ff}a-zA-Z\'\-])+$/u";

var_dump(isValidEmail($_POST['email'] ));
var_dump($_POST['mdp'] == $_POST['mdp2']);
var_dump(preg_match($regex, $_POST['nom']));
var_dump(preg_match($regex, $_POST['prenom']));

foreach($users as $user){
    if($user['adresse_mail'] == $_POST['email'])
    {
        alert("Cette adresse email est déjà utilisée par un compte, veuillez en choisir une autre.");
        redirect("register.php");
    }
}

if(($_POST['mdp'] == $_POST['mdp2']) && (isValidEmail($_POST['email'] )) && (preg_match($regex, $_POST['nom'])) && (preg_match($regex, $_POST['prenom']))){
    alert("Votre compte à bien été enregistré. Veuillez vous connecter.");
    CreateUtilisateur($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['est_admin']);
    redirect("login.php");


}
else
{
    echo "<form id='myForm' action='register.php' method='post'>";
    foreach ($_POST as $a => $b) {
        echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
    }
    echo "</form><script type='text/javascript'>document.getElementById('myForm').submit();</script>";
    alert("Les mots de passe ne correspondent pas ou l'adresse mail n'est pas correcte");
    redirect("register.php?areudumb");
}