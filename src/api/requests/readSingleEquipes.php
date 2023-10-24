<?php

// autorisation des requêtes HTTP sans authentification
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialisation de l'API
include_once('../core/initialize.php');

// instanciation de Match
$equipe = new Equipes($db);

$equipe->id_equipe = $_GET['id'];
$equipe->readSingleEquipes();

if (isset($equipe->id_equipe)) {
	$equipe_arr = [
		'id' => $equipe->id_equipe,
		'nb_match_joues' => $equipe->nb_match_joues,
		'nb_match_gagnes' => $equipe->nb_match_gagnes,
		'nb_match_egalites' => $equipe->nb_match_egalites,
		'entraineur_nom' => $equipe->entraineur_nom,
		'entraineur_prenom' => $equipe->entraineur_prenom,
		'entraineur_adjoint_nom' => $equipe->entraineur_adjoint_nom,
		'entraineur_adjoint_prenom' => $equipe->entraineur_adjoint_prenom,
		'id_club' => $equipe->id_club,
	];

	// construction du JSON
	print_r(json_encode($equipe_arr));
} else {
	echo json_encode(['message' => 'aucun equipe trouvé']);
}

