<?php

// autorisation des requêtes HTTP sans authentification
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialisation de l'API
include_once('../../core/initialize.php');

// instanciation de Match
$equipe = new Equipes($db);

$id_equipe = $_GET['id'];
$equipe->readSingleEquipe($id_equipe);

if (isset($equipe->id_equipe)) {
	$equipe_arr = [
		'id_equipe' => $equipe->id_equipe,
		'nb_match_joues' => $equipe->nb_match_joues,
		'nb_match_gagnes' => $equipe->nb_match_gagnes,
		'nb_match_egalites' => $equipe->nb_match_egalites,
		'nb_ratio' => intdiv(($equipe->nb_match_gagnes * 100), $equipe->nb_match_joues),
		'entraineur_nom' => $equipe->entraineur_nom,
		'entraineur_prenom' => $equipe->entraineur_prenom,
		'entraineur_adjoint_nom' => $equipe->entraineur_adjoint_nom,
		'entraineur_adjoint_prenom' => $equipe->entraineur_adjoint_prenom,
		'id_club' => $equipe->id_club,
		'nom_club' => $equipe->nom_club,
		'joueurs' => $equipe->joueurs,
		'classement'=> $equipe->classement,
		'nb_buts_marques'=> $equipe->nb_buts_marques,
		'nb_buts_encaisses'=> $equipe->nb_buts_encaisses,
		'nb_cartons_rouges'=> $equipe->nb_cartons_rouges,
		'nb_cartons_jaunes'=> $equipe->nb_cartons_jaunes
	];

	// construction du JSON
	print_r(json_encode($equipe_arr));
} else {
	echo json_encode(['message' => 'aucun equipe trouvé']);
}

