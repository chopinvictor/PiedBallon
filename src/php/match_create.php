<?php

session_start();
require_once('./bdd.php');

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

	$return->closeCursor();
}

if (isset($_POST['send'])) {
	if (
		!empty($_POST['lieu_match']) && !empty($_POST['date_match']) && !empty($_POST['score_equipe_1']) && !empty($_POST['score_equipe_2']) && !empty($_POST['est_fini'])
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

		<button name="send" type="submit">Créer</button>

	</form>

</body>

</html>