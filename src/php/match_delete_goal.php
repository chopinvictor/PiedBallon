<?php

session_start();


if(empty($_SESSION) || ($_SESSION['admin']!==1)){
    header("Location: ../php/login.php");
}

$id_match = $_SESSION['id_match'];

require_once('bdd.php');


$id_equipe_une = intval($_GET['id_equipe_une']);
$id_equipe_deux= intval($_GET['id_equipe_deux']);

if($id_equipe_une< $id_equipe_deux){

    $insertgoal = $db->prepare('UPDATE matchs
    SET score_equipe_1 = score_equipe_1 - 1
    WHERE id_match = ?');
    $insertgoal->execute(array($id_match));


}else{
    $insertgoal = $db->prepare('UPDATE matchs
    SET score_equipe_2 = score_equipe_2 - 1
    WHERE id_match = ?');
    $insertgoal->execute(array($id_match));
}

header("Location: ../php/match.php");

?>