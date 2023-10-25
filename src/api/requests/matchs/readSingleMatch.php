<?php

// autorisation des requêtes HTTP sans authentification
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialisation de l'API
include_once('../../core/initialize.php');

// instanciation de Match
$match = new Matchfoot($db);

$id_match = $_GET['id'];
$match->readSingleMatch($id_match);

if (isset($match->id_match)) {
	$match_arr = [
		'id' => $match->id_match,
		'date_match' => $match->date_match,
		'lieu_match' => $match->lieu_match,
		'score_equipe_1' => $match->score_equipe_1,
		'score_equipe_2' => $match->score_equipe_2,
		'est_fini' => $match->est_fini,
		'nom_club_1' => $match->nom_club_1,
		'nom_club_2' => $match->nom_club_2,
		'arbitres' => $match->arbitres,
		'remplacements' => $match->remplacements,
		'buts' => $match->buts,
		'fautes' => $match->fautes
	];

	// construction du JSON
	print_r(json_encode($match_arr));
} else {
	echo json_encode(['message' => 'aucun match trouvé']);
}

