<?php 

session_start();


if(empty($_SESSION) || ($_SESSION['admin']!==2)){
    header("Location: ../php/login.php");
}




require_once('bdd.php');

$id_equipe= $_SESSION['id_equipe'];

$query = "SELECT *
FROM equipe_joue ej
INNER JOIN equipes e ON ej.id_equipe = e.id_equipe
INNER JOIN matchs AS m ON ej.id_match = m.id_match
WHERE ej.id_equipe = ?";

$getmatch = $db->prepare($query);
$getmatch->execute([$_SESSION['id_equipe']]);

$tab_all_equipe= array();
$matchs= $getmatch->fetchAll(PDO::FETCH_OBJ);

    foreach($matchs as $Value):
        
        $id_match = $Value->id_match;

        $queryd = "SELECT e.nom_equipe AS nom_adversaire , e.id_equipe AS id_adversaire, m.est_fini, ej.id_match
        FROM equipe_joue AS ej
        INNER JOIN equipes AS e ON ej.id_equipe = e.id_equipe
        INNER JOIN matchs AS m ON ej.id_match = m.id_match
        WHERE ej.id_match = ? AND  ej.id_equipe <> ? ;";

        $getequipe = $db->prepare($queryd);
        $getequipe->execute([$id_match, $id_equipe]);
        $equipe= $getequipe->fetchAll(PDO::FETCH_OBJ);;

        $tab_all_equipe[] = $equipe;

    endforeach;

$tab_finis = array();
$tab_pas_finis = array();
$count = 0;

foreach ($matchs as $Value) {
    $Statut = $Value->est_fini;

    if ($Statut == 1) {
        $tab_finis[] = $Value; // Ajoutez $Value à $tab_finis
        $tab_finis_vs[]= $tab_all_equipe[$count][0];
    } else {
        $tab_pas_finis[] = $Value; // Ajoutez $Value à $tab_pas_finis
        $tab_pas_finis_vs[]= $tab_all_equipe[$count][0];
    }
    $count=$count+1;
};



$count_html=0;
$count_html_aps = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/match_view.css">
</head>
<body>
    <div class="historique">
        <h2>Historique des matchs</h2>
        <div class="container">
        <?php
                foreach($tab_finis as $Value) : 
                    $nom_equipe = $Value->nom_equipe;
                    $nom_adversaire = $tab_finis_vs[$count_html]->nom_adversaire;
                    $id_adversaire = $tab_finis_vs[$count_html]->id_adversaire;
                    $id_match = $Value->id_match;
                    $count_html=$count_html +1;


                    ?>
                    <a href= <?php echo "../php/general_na.php?id_equipe=".$id_equipe. "&id_adversaire=". $id_adversaire."&id_match=".$id_match ?> ><div class="text">
                        <p style="margin:5px ;"><?php echo " -  ".$nom_equipe." " ?></p>
                        <p style="margin:5px ;">VS</p>
                        <p style="margin:5px ;"><?php echo " -  ".$nom_adversaire ?></p>
                    </div></a>

            <?php endforeach ?>
        </div>
    </div>
    <div class="future">
        <h2>Match à venir</h2>
        <div class="container">
        <?php
                foreach($tab_pas_finis as $Value) : 
                    $nom_equipe = $Value->nom_equipe;
                    $id_match = $Value->id_match;
                    $nom_adversaire = $tab_pas_finis_vs[$count_html_aps]->nom_adversaire;
                    $id_adversaire = $tab_finis_vs[$count_html_aps]->id_adversaire;
                    $count_html=$count_html_aps +1;

                    
                    ?>
                    <a href= <?php echo "../php/general_na.php?id_equipe=".$id_equipe. "&id_adversaire=". $id_adversaire."&id_match=".$id_match ?> ><div class="text">
                        <p style="margin:5px ;"><?php echo "-  ".$nom_equipe." " ?></p>
                        <p style="margin:5px ;"> VS </p>
                        <p style="margin:5px ;"><?php echo "-  ".$nom_adversaire ?></p>
                    </div></a>


            <?php endforeach ?>
        </div>
    </div>
</body>
</html>