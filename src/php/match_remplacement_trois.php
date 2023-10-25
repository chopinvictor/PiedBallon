
<?php 


session_start();


if(empty($_SESSION) || ($_SESSION['admin']!==1)){
    header("Location: ../php/login.php");
}



$id_match = $_SESSION['id_match'];
$id_equipe = $_GET['id_equipe'];
$temps_jeux= $_GET['temps_jeux'];
$id_joueur_remplace= $_GET['id_joueur'];
$id_joueur_remplacer= $_GET['id_joueur_remplace'];



require_once('bdd.php');

$query = "INSERT INTO evenements (id_match, horodatage) VALUES (?, ?)";
$getmatch = $db->prepare($query);
$getmatch->execute([$id_match, $temps_jeux]);

$query = "SELECT* FROM evenements  WHERE(id_match=? AND horodatage=?)";
$getmatch = $db->prepare($query);
$getmatch->execute([$id_match,$temps_jeux]);

$arbitre= $getmatch->fetchAll(PDO::FETCH_OBJ);

$id_evenement=$arbitre[0]->id_evenement;

$query = "INSERT INTO remplacements (id_evenement) VALUES (?)";
$insertRemplacement = $db->prepare($query);
$insertRemplacement->execute([$id_evenement]);

$query = "SELECT* FROM remplacements  WHERE(id_evenement=?)";
$getmatch = $db->prepare($query);
$getmatch->execute([$id_evenement]);

$arbitre= $getmatch->fetchAll(PDO::FETCH_OBJ);

$id_remplacement=$arbitre[0]->id_remplacement;


$query = "INSERT INTO remplace (id_joueur, est_remplacé, id_remplacement) VALUES (?, ?, ?)";
$insertRemplacement = $db->prepare($query);
$insertRemplacement->execute([$id_joueur_remplace, 0, $id_remplacement]);


$query = "INSERT INTO remplace (id_joueur, est_remplacé, id_remplacement) VALUES (?, ?, ?)";
$insertRemplacement = $db->prepare($query);
$insertRemplacement->execute([$id_joueur_remplacer, 1, $id_remplacement]);

header("Location: ../php/match.php")


?>
</html>