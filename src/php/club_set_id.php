<?php
session_start();

if(empty($_SESSION)){
    header("Location: ../php/login.php");
}

$_SESSION['id_club'] = $_GET['id_club'];
$_SESSION['lieu_club'] = $_GET['lieu_club'];
header("Location: ../php/equipe.php");

?>