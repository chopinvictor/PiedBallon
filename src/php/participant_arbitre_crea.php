<?php

session_start();

if(empty($_SESSION)){
    header("Location: ../php/login.php");
}



require_once('bdd.php');


$arbitre_nom_crea = $_GET['arbitre_nom_crea'];
$arbitre_nationalite_crea = $_GET['arbitre_nationalite_crea'];
$arbitre_prenom_crea = $_GET['arbitre_prenom_crea'];

$insertArbitre = $db->prepare('INSERT INTO arbitres(nom,prenom,nationalite_arbitre)VALUES(?,?,?)');
$insertArbitre->execute(array($arbitre_nom_crea,$arbitre_prenom_crea,$arbitre_nationalite_crea));

header("Location: ../php/arbitre.php");

?>