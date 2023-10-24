<?php

// autorisation des requêtes HTTP sans authentification
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialisation de l'API
include_once('../../core/initialize.php');

// instanciation de Match
$joueur = new Joueurs($db);

$joueur->id_joueur = $_GET['id'];
$joueur->readSingleJoueurs();

if (isset($joueur->id_joueur)) {
	$joueur_arr = [
		'id' => $joueur->id_joueur,
		'nom' => $joueur->nom,
		'prenom' => $joueur->prenom,
		'nationalite_joueur' => $joueur->nationalite_joueur,
		'numero' => $joueur->numero,
		'id_equipe' => $joueur->id_equipe
	];

	// construction du JSON
	print_r(json_encode($joueur_arr));
} else {
	echo json_encode(['message' => 'aucun joueur trouvé']);
}

