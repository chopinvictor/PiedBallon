<?php 

session_start();

if(empty($_SESSION)){
    header("Location: ../php/login.php?");
}


require_once('bdd.php');



$id_arbitre = $_GET['id_arbitre'];
$arbitre_nom_modif = $_GET['arbitre_nom_modif'];
$arbitre_nationalite_modif = $_GET['arbitre_nationalite_modif'];
$arbitre_prenom_modif = $_GET['arbitre_prenom_modif'];



    $insertTraining = $db->prepare('UPDATE arbitres SET nom=? , prenom=?,  nationalite_arbitre=?WHERE id_arbitre=?   ');
    $insertTraining->execute(array(strip_tags($arbitre_nom_modif),strip_tags($arbitre_prenom_modif),strip_tags($arbitre_nationalite_modif),strip_tags($id_arbitre)));
    header("Location: ../php/participant.php");





?>