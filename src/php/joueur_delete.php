<?php

session_start();

if(empty($_SESSION)){
    header("Location: ../php/login.php");
}



require_once('bdd.php');


$id_joueur = $_GET['id_joueur'];


$insertArbitre = $db->prepare('DELETE FROM joueurs
WHERE id_joueur = ? ');
$insertArbitre->execute(array($id_joueur));

header("Location: ../php/joueur.php");

?>