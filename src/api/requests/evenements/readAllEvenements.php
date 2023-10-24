<?php

// autorisation des requêtes HTTP sans authentification
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialisation de l'API
include_once('../../core/initialize.php');

// instanciation de Evenements
$evenement = new Evenements($db);

// query
$result = $evenement->readAllEvenements();

// nombre de ligne
$num = $result->rowCount();

if ($num > 0) {
	$evenement_arr = [];
	$evenement_arr['data'] = [];

	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$evenement_item = [
			'id_evenement' => $id_evenement,
			'horodatage' => $horodatage,
			'id_match' => $id_match,
		];
		array_push($evenement_arr['data'], $evenement_item);
	}
	// convertion en JSON
	echo json_encode($evenement_arr);

} else {
	echo json_encode(['message' => 'aucun évènements trouvé']);
}
