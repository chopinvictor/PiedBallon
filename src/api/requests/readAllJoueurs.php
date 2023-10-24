<?php

// autorisation des requêtes HTTP sans authentification
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
// initialisation de l'API
include_once('../core/initialize.php');

$match = new Joueurs($db);

// query
$result = $match->readAllJoueurs();

// nombre de ligne
$num = $result->rowCount();

if ($num > 0) {
	$joueur_arr = [];
	$joueur_arr['data'] = [];

	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$match_item = [
			'id_joueur' => $id_joueur,
			'nom' => $nom,
			'prenom' => $prenom,
			'nationalite_joueur' => $nationalite_joueur,
			'numero' => $numero,
			'id_equipe' => $id_equipe
		];
		array_push($joueur_arr['data'], $match_item);
	}
	// convertion en JSON
	echo json_encode($joueur_arr);

} else {
	echo json_encode(['message' => 'aucun match trouvé']);
}
