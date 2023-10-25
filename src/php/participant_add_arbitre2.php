<?php

session_start();


if(empty($_SESSION) || ($_SESSION['admin']!==1)){
    header("Location: ../php/login.php");
}


$id_match = $_SESSION['id_match'];

require_once('bdd.php');


$id_arbitre = $_GET['id_arbitre'];

$insertArbitre = $db->prepare('INSERT INTO arbitre_match(id_arbitre,id_match)VALUES(?,?)');
$insertArbitre->execute(array($id_arbitre,$id_match));

header("Location: ../php/participant.php");

?>