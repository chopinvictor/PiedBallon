<?php 

session_start();

if(empty($_SESSION)){
    header("Location: ../php/login.php");
}


require_once('bdd.php');

$date_match = $_GET['date_match'];
$lieu_match = $_GET['lieu_match']



?>