
<?php 
session_start();

if(empty($_SESSION) || ($_SESSION['admin']!==1)){
    header("Location: ../php/login.php");
}


    if (isset($_POST['equipe_crea'])) {
        if (!empty($_POST['equipe_nom']) && !empty($_POST['equipe_prenom_entraineur']) && !empty($_POST['equipe_nom_entraineur']) &&!empty($_POST['equipe_nom_entraineur_adjoint']) && !empty($_POST['equipe_prenom_entraineur_adjoint'])){

            require_once('bdd.php');
            $nom = strip_tags( $_POST['equipe_nom']);
            $arb_prenom = strip_tags($_POST['equipe_prenom_entraineur']);
            $arb_non =strip_tags($_POST['equipe_nom_entraineur']);
            $arb_non_adjoint = strip_tags($_POST['equipe_nom_entraineur_adjoint']);
            $arb_prenom_adjoint = strip_tags($_POST['equipe_prenom_entraineur_adjoint']);
            $id_club = strip_tags($_SESSION['id_club']);

          $insertequipe = $db->prepare('INSERT INTO equipes(nom_equipe,prenom_entraineur,entraineur_nom,entraineur_adjoint_nom,entraineur_adjoint_prenom,id_club)VALUES(?,?,?,?,?,?)');
            $insertequipe->execute(array($nom,$arb_prenom,$arb_non,$arb_non_adjoint,$arb_prenom_adjoint,$id_club));

        };
    
    }




$id_arbitre=3;
$id_club = $_SESSION['id_club'];
$lieu_club = $_SESSION['lieu_club'];
require_once('bdd.php');

$query = "SELECT * FROM equipes WHERE id_club=?";
$getmatch = $db->prepare($query);
$getmatch->execute([$id_club]);

$club= $getmatch->fetchAll(PDO::FETCH_OBJ);

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
        <button class="button_svg_edit" onclick="ActionPopup('popup_arbitre')" style="font-size: 2em; font-weight:300; top:20px; right:20px;position:absolute;">+</button>
        <div class="principal arbitre">
            <h2><?= "Equipes du club ".$lieu_club ?></h2>
            <?php
                foreach($club as $Value) : 
                    $nombre_match = $Value->nb_match_joues;
                    $nom_equipe = $Value->nom_equipe;
                    $id_equipe = $Value->id_equipe ;
                    ?>
                   <div class="card_container">
                    <a href=<?php echo "../php/equipe_hub.php?id_equipe=".$id_equipe ?>><p class="card_number Division_number"><?= $nombre_match ?></p></a>
                        <a href=<?php echo "../php/equipe_hub.php?id_equipe=".$id_equipe ?>><p class="card_info Division_name"><?= $nom_equipe ?> </p></a>
                        <a href=<?php echo "../php/equipe_delete.php?id_equipe=".$id_equipe ?>><button class="button_svg_edit" style="color:red;">X</button></a>
                    </div>                
            <?php endforeach ?>
        </div>
        <div class="add_player" id="popup_arbitre">
            <button class="btn_close" onclick="ActionPopup('popup_arbitre')"><svg class="svg_icon_edit" ><use class="svg_nav_all" xlink:href="#svg_close"/></svg></button>
            <h1>Création d'une équipe</h1>
            <form action="" method="POST" class="form">
                <div class="input_container">
                    <div class="input_card">
                        <div class="name_player">
                            <h3>Nom d'équipe</h3>
                            <input name="equipe_nom" type="text">
                        </div>
                        <div class="name_player">
                            <h3>prenom entraineur</h3>
                            <input name="equipe_prenom_entraineur" type="text">
                        </div>
                        <div class="name_player">
                            <h3>nom entraineur</h3>
                            <input name="equipe_nom_entraineur" type="text">
                        </div>
                        <div class="name_player">
                            <h3>nom entraineur</h3>
                            <input name="equipe_nom_entraineur_adjoint" type="text">
                        </div>
                        <div class="name_player">
                            <h3>Prenom entraineur adjoint</h3>
                            <input name="equipe_prenom_entraineur_adjoint" type="text">
                        </div>
                        
                        <button name="equipe_crea" type="submit" class="save_player">Enregistré</button>
                    </div>
                </div>
            </form>
        </div>


    </section>

</body>
<hide class="hide">


<svg id="svg_close" viewBox="0 0 64 64" stroke-width="3" stroke="#000000" fill="none">
		<line x1="8.06" y1="8.06" x2="55.41" y2="55.94" />
		<line x1="55.94" y1="8.06" x2="8.59" y2="55.94" />
	</svg>

</hide>   

</html>