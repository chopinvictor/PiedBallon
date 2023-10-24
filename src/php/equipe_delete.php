<?php

session_start();

if(empty($_SESSION)){
    header("Location: ../php/login.php");
}



require_once('bdd.php');

$id_equipe = $_GET['id_equipe'];


$insertArbitre = $db->prepare('DELETE FROM equipes
WHERE id_equipe =?');
$insertArbitre->execute(array($id_equipe));

header("Location: ../php/equipe.php");

?>