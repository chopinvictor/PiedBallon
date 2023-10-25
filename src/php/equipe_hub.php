<?php 

session_start();

if(empty($_SESSION) || ($_SESSION['admin']!==1)){
    header("Location: ../php/login.php");
}

$_SESSION['id_equipe']=$_GET['id_equipe'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/equipe_hub.css">
</head>
<body>
<section class="Default_exo">
        <h1 class="choose_traning">Equipe</h1>
        <div class="container">
            <div class="card">
                <div class="card_img">
                    <img src="../MEDIA/mbappe.jpg" alt="">
                </div>
                <div class="card_info">
                    <h3>Joueur</h3>
                    <div id="boutton plus">
                        <a href="../php/joueur.php"><input type="submit" class="boutton_plus" value="Ajouter joueur" /></a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card_img">
                    <img src="../MEDIA/duree-match-football.jpg" alt="">
                </div>
                <div class="card_info">
                    <h3>Match</h3>
                    <div id="boutton plus">
                        <a href="../php/match_view.php"><input type="submit" class="boutton_plus" value="Match" /></a>
                    </div>
                </div>
            </div>
            <!-- <div class="card">
                <div class="card_img">
                    <img src="../MEDIA/equipe.jpg" alt="">
                </div>
                <div class="card_info">
                    <h3>Equipe</h3>
                    <div id="boutton plus">
                        <a href="../"><input type="submit" class="boutton_plus" value="Modifier equipe" /></a>
                    </div>
                </div>
            </div> -->
        </div>
    </section>
</body>
</html>