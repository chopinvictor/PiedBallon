<?php 

session_start();


if(empty($_SESSION) || ($_SESSION['admin']!==1)){
    header("Location: ../php/login.php");
}



require_once('bdd.php');

$id_arbitre = $_GET['id_arbitre'];

$query = "SELECT * FROM arbitres WHERE id_arbitre =?";
$getmatch = $db->prepare($query);
$getmatch->execute([$id_arbitre]);
$arbitre= $getmatch->fetchAll(PDO::FETCH_OBJ);






if (isset($_POST['arbitre_send_modif'])) {

    if(!empty($_POST['arbitre_nom_modif'])&& !empty($_POST['arbitre_prenom_modif']) ){
    $insertTraining = $db->prepare('UPDATE arbitres SET nom=? , prenom=?,  nationalite_arbitre=?WHERE id_arbitre=?   ');
    $insertTraining->execute(array(strip_tags($_POST['arbitre_nom_modif']),strip_tags($_POST['arbitre_prenom_modif']),strip_tags($_POST['arbitre_nationalite_modif']),strip_tags($id_arbitre)));
    header("Location: ../php/arbitre.php");

}

}
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

<section class="parametre all_Participant">
        <!-- modification des arbitres  -->
        <div class="add_player" id="popup_arbitre_edit">
            <h1>Modification d'un Arbitre</h1>
            <form class="form" action="" method="POST">
                <div class="input_container">
                    <div class="input_card">
                        <div class="name_player">
                            <h3>Nom</h3>
                            <input name="arbitre_nom_modif" type="text">
                        </div>
                        <div class="name_player">
                            <h3>Prénom</h3>
                            <input name="arbitre_prenom_modif" type="text">
                        </div>
                        <div class="name_player">
                            <label for="arbitre_nationalite_modif" >Nationalité</label>
                            <select name="arbitre_nationalite_modif" id="select_team">
                                <option value="France">France</option>
                                <option value="France">France</option>
                                <option value="France">France</option>
                                <option value="France">France</option>
                                <option value="France">France</option>
                            </select>
                        </div>
                        <button name="arbitre_send_modif" type="submit" class=" save_player">Enregistré</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
