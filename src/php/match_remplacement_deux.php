
<?php 


session_start();


if(empty($_SESSION) || ($_SESSION['admin']!==1)){
    header("Location: ../php/login.php");
}




$id_equipe = $_GET['id_equipe'];
$temps_jeux= $_GET['temps_jeux'];
$id_joueur_remplace= $_GET['id_joueur'];


require_once('bdd.php');

$query = "SELECT * FROM joueurs WHERE id_equipe=?";
$getmatch = $db->prepare($query);
$getmatch->execute([$id_equipe]);

$arbitre= $getmatch->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/participant.css">
    <title>Pied Ballon</title>
    <script src="../js/popup.js"></script>
    <script src="../js/edit.js" ></script>
</head>
<body>

    <section class="parametre all_Participant">
        <div class="principal arbitre">
            <h2>Choisir le joueur qui va sortir</h2>
            <?php
                foreach($arbitre as $Value) : ;
                    $nom = $Value->nom;
                    $prenom = $Value->prenom;
                    $nationalite = $Value->nationalite_joueur;
                    $id_arbitre = $Value->id_joueur;
                    ?>
                    <div class="card_container">
                        <p class="card_number Division_number">1</p>
                        <p class="card_info Division_name"><?= $nom." ".$prenom ?> </p>
                        <a href=<?php echo "../php/match_remplacement_trois.php?id_equipe=".$id_equipe."&temps_jeux=".$temps_jeux."&id_joueur=".$id_joueur_remplace."&id_joueur_remplace=".$id_arbitre ?>><button class="button_svg_edit" style="font-size: 1.5em;">+</button></a>
                    </div>                
            <?php endforeach ?>
        </div>

    </section>

</body>

</html>