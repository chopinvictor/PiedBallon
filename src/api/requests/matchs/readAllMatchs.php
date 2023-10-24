<?php

// autorisation des requêtes HTTP sans authentification
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialisation de l'API
include_once('../../core/initialize.php');

// instanciation de Match
$match = new Matchfoot($db);

// query
$result = $match->readAllMatch();

// nombre de ligne
$num = $result->rowCount();

if ($num > 0) {
	$match_arr = [];
	$match_arr['data'] = [];

	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$match_item = [
			'id_match' => $id_match,
			'date_match' => $date_match,
			'lieu_match' => $lieu_match,
			'score_equipe_1' => $score_equipe_1,
			'score_equipe_2' => $score_equipe_2,
			'est_fini' => $est_fini
		];
		array_push($match_arr['data'], $match_item);
	}
	// convertion en JSON
	echo json_encode($match_arr);

} else {
	echo json_encode(['message' => 'aucun match trouvé']);
}
