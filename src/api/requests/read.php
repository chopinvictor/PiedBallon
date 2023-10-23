<?php

// autorisation des requêtes HTTP sans authentification
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialisation de l'API
include_once('../core/initialize.php');

// instanciation de Post
$post = new Post($db);

// query
$result = $post->read();

// nombre de ligne
$num = $result->rowCount();

if ($num > 0) {
	$post_arr = [];
	$post_arr['data'] = [];

	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$post_item = [
			'id' => $id,
			'nom' => $post_nom,
			'prenom' => $post_prenom,
			'age' => $post_age
		];
		array_push($post_arr['data'], $post_item);
	}
	// convertion en JSON
	echo json_encode($post_arr);

} else {
	echo json_encode(['message' => 'aucun poste trouvé']);
}
