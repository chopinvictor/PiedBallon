<?php 

session_start();

if(empty($_SESSION)){
    header("Location: ../php/login.php");
}



require_once('bdd.php');

$id_equipe= $_SESSION['id_equipe'];

$query = "SELECT m1.id_match, m1.date_match, m1.lieu_match, m1.score_equipe_1, m1.score_equipe_2, m1.est_fini,
c2.lieu AS lieu_adversaire, e2.id_equipe AS id_adversaire
FROM matchs AS m1
INNER JOIN equipe_joue AS ej1 ON m1.id_match = ej1.id_match
INNER JOIN equipes AS e1 ON ej1.id_equipe = e1.id_equipe
INNER JOIN equipe_joue AS ej2 ON m1.id_match = ej2.id_match
INNER JOIN equipes AS e2 ON ej2.id_equipe = e2.id_equipe
INNER JOIN clubs AS c2 ON e2.id_club = c2.id_club
WHERE e1.id_equipe = ?;";

$getmatch = $db->prepare($query);
$getmatch->execute([$_SESSION['id_equipe']]);

$matchs= $getmatch->fetchAll(PDO::FETCH_OBJ);

$tab_finis = array();
$tab_pas_finis = array();

foreach ($matchs as $Value) {
    $Statut = $Value->est_fini;

    if ($Statut == 1) {
        $tab_finis[] = $Value; // Ajoutez $Value à $tab_finis
    } else {
        $tab_pas_finis[] = $Value; // Ajoutez $Value à $tab_pas_finis
    }
}


var_dump($tab_finis);
var_dump($tab_pas_finis);

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
        <?php foreach($joueur as $Value) : ;
                $nom = $Value->nom;
                $prenom = $Value->prenom;
                $nationalite = $Value->nationalite_joueur;
                $numero = $Value->numero;
                $id_joueur = $Value->id_joueur;
                ?>
        
       
        
                    <div class="card_container">
                        <p class="card_number Division_number"><?= $numero ?></p>
                        <p class="card_info Division_name"><?= $nom." ".$prenom ?> </p>
                        <a href=<?php echo "../php/joueur_delete.php?id_joueur=".$id_joueur ?>><button class="button_svg_edit" style="font: 1.5em; color:red;" >X</button></a>
                    </div>                
            <?php endforeach ?>
        <div>

        </div>
    </div>
    <div class="future">
        <h2>Match à venir</h2>
        <div>

        </div>
    </div>
</body>
</html>