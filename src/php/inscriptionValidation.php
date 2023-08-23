<?php
require_once('bdd.php');
require_once('fonctions.php');
session_start();

var_dump($_POST['mdp']);
var_dump($_POST['mdp2']);
alert("retard");

?>

<?php


if($_POST['mdp'] == $_POST['mdp2']){
    alert("Votre compte à bien été enregistré. Veuillez vous connecter.");
    header("location:index.php");
}
else{
    alert("Les mots de passe ne correspondent pas.");
    header("location:register.php");
}
