<?php

// autorisation des requêtes HTTP sans authentification
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialisation de l'API
include_once('../core/initialize.php');

// instanciation de Post
$post = new Post($db);

$post->id = isset($GET['id']) ? $_GET['id'] : die();
$post->read_single();

$post_arr = [
	'id' => $post->id,
	'nom' => $post->post_nom,
	'prenom' => $post->post_prenom,
	'age' => $post->post_age
];

// construction du JSON
print_r(json_encode($post_arr));