<?php

session_start();


if(empty($_SESSION) || ($_SESSION['admin']!==1)){
    header("Location: ../php/login.php");
}



require_once('bdd.php');

$id_match = $_SESSION['id_match'];
$id_arbitre = $_GET['id_arbitre'];


$insertArbitre = $db->prepare('DELETE FROM arbitre_match
WHERE id_match = ? AND id_arbitre = ?');
$insertArbitre->execute(array($id_match,$id_arbitre));

header("Location: ../php/participant.php");

?>