<?php 

session_start();

if(empty($_SESSION)){
    header("Location: ../php/login.php?groscon");
}


require_once('bdd.php');



$id_match = $_GET['id_match'];
$date_match = $_GET['match_date'];
$lieu_match = $_GET['match_lieu'];



    $insertTraining = $db->prepare('UPDATE matchs SET lieu_match=? , date_match=?  WHERE  id_match=? ');
    $insertTraining->execute(array(strip_tags($lieu_match),strip_tags($date_match),strip_tags($id_match)));
    header("Location: ../php/general.php?3".$lieu_match);





?>