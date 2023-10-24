<?php

// autorisation des requêtes HTTP sans authentification
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialisation de l'API
include_once('../../core/initialize.php');

// instanciation de Match
$match = new Matchfoot($db);

$match->id_match = $_GET['id'];
$match->readSingleMatch();

if (isset($match->id_match)) {
	$match_arr = [
		'id' => $match->id_match,
		'date_match' => $match->date_match,
		'lieu_match' => $match->lieu_match,
		'score_equipe_1' => $match->score_equipe_1,
		'score_equipe_2' => $match->score_equipe_2,
		'est_fini' => $match->est_fini
	];

	// construction du JSON
	print_r(json_encode($match_arr));
} else {
	echo json_encode(['message' => 'aucun match trouvé']);
}

