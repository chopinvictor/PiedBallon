<?php

session_start();
require_once('./bdd.php');


if(empty($_SESSION) || ($_SESSION['admin']!==1)){
    header("Location: ../php/login.php");
}


$query = "SELECT * FROM equipes";
$getmatch = $db->prepare($query);
$getmatch->execute();

$equipe= $getmatch->fetchAll(PDO::FETCH_OBJ);

// colonne 'est_fini' dans la table matchs
$estFini;

function create($db, $date_match, $lieu_match, $score_equipe_1, $score_equipe_2, $est_fini)
{
	$query = "INSERT INTO matchs(date_match, lieu_match, score_equipe_1, score_equipe_2, est_fini)
      VALUES (?,?,?,?,?)";

	$return = $db->prepare($query);


	$return->execute(
		array(
			$date_match,
			$lieu_match,
			$score_equipe_1,
			$score_equipe_2,
			$est_fini
		)
	);


	$query = "SELECT * 
	FROM matchs
	WHERE date_match = ? AND lieu_match = ?";
	$getmatch = $db->prepare($query);
	$getmatch->execute(array($date_match, $lieu_match));

	$id= $getmatch->fetchAll(PDO::FETCH_OBJ);
	$id_match = $id[0]->id_match;

	$query = "INSERT INTO equipe_joue(id_match,id_equipe)
	VALUES (?,?)";
  	$return = $db->prepare($query);
  	$return->execute(
	  array(
		  
		  $id_match,$_POST['equipe_une'],
	  )
  );

  $query = "INSERT INTO equipe_joue(id_match,id_equipe)
  VALUES (?,?)";

	$return = $db->prepare($query);


	$return->execute(
	array(
		
		$id_match,$_POST['equipe_deux'],
	)
);

	$return->closeCursor();
	header("Location: ../php/club.php");
}

if (isset($_POST['send'])) {
	if (
		!empty($_POST['lieu_match']) && !empty($_POST['date_match']) && !empty($_POST['est_fini'])
	) {
		$estFini = $_POST['est_fini'];

		create($db, $_POST['date_match'], $_POST['lieu_match'], $_POST['score_equipe_1'], $_POST['score_equipe_2'], intval($estFini));
	}
}


// header("Location: ../php/general.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Création d'un match</title>
	<link rel="stylesheet" href="../css/match_create.css" />
</head>

<body>
	<h1>Créer un match</h1>

	<form id="formModifier" action=" " method="POST" class="form">

		<label class="form-row">Lieu du match</label>
		<input type="text" name="lieu_match" placeholder="" required class="" />
		<label class="form-row">Date du match</label>
		<input type="date" name="date_match" placeholder="" required class="" />
		<label class="form-row">Score de l'équipe 1</label>
		<input type="number" name="score_equipe_1" placeholder="" required class="" />
		<label class="form-row">Score de l'équipe 2</label>
		<input type="number" name="score_equipe_2" placeholder="" required class="" />

		<div class="match-termine">
			<label class="form-row">Match terminé</label>
			<input type="checkbox" name="est_fini" value="1" />
		</div>
		<div class="name_player">
			<label for="equipe_une" >equipe 1</label>
				<select name="equipe_une" id="select_team">
					
					<?php
                foreach($equipe as $Value) : ;
                    $nom = $Value->nom_equipe;
					$id=$Value->id_equipe ; ?>
					<option value="<?= $id?>"><?= $nom?></option>
            <?php endforeach ?>
				</select>
		</div>
		<div class="name_player">
			<label for="equipe_deux" >equipe 2</label>
				<select name="equipe_deux" id="select_team">
					
					<?php
                foreach($equipe as $Value) : ;
                    $nom = $Value->nom_equipe;
					$id=$Value->id_equipe ; ?>
					<option value=<?= $id?>><?= $nom?></option>
            <?php endforeach ?>
				</select>
		</div>


		<button name="send" type="submit">Créer</button>

	</form>

</body>

</html>