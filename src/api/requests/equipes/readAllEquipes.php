<?php

// autorisation des requêtes HTTP sans authentification
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
// initialisation de l'API
include_once('../../core/initialize.php');

$equipe = new Equipes($db);

// query
$result = $equipe->readAllEquipes();

// nombre de ligne
$num = $result->rowCount();

if ($num > 0) {
	$equipe_arr = [];
	$equipe_arr['data'] = [];

	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$equipe_item = [
			'id' => $id_equipe,
			'nb_match_joues' => $nb_match_joues,
			'nb_match_gagnes' => $nb_match_gagnes,
			'nb_match_egalites' => $nb_match_egalites,
			'entraineur_nom' => $entraineur_nom,
			'entraineur_prenom' => $entraineur_prenom,
			'entraineur_adjoint_nom' => $entraineur_adjoint_nom,
			'entraineur_adjoint_prenom' => $entraineur_adjoint_prenom,
			'id_club' => $id_club,
		];
		array_push($equipe_arr['data'], $equipe_item);
	}
	// convertion en JSON
	echo json_encode($equipe_arr);

} else {
	echo json_encode(['message' => 'aucun equipe trouvée']);
}
