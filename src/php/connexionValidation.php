<?php
require_once('crud.php');
require_once('fonctions.php');
$users = GetAllUtilisateurs();
session_start();

foreach($users as $user){
    if(($_POST['mdp'] == $user['mot_de_passe']) && ($_POST['email'] == $user['adresse_mail']))
    {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['mdp'] = $_POST['mdp'];
        $_SESSION['admin'] = $user['est_admin'];
        redirect('index.php');
        exit();
    }
}
alert("La combinaison email / mot de passe est erronée");
redirect("login.php");