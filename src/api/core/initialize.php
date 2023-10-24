<?php

// require_once('../../php/bdd.php');

$dsn = 'mysql:host=localhost;dbname=piedballon;charset=utf8';
$username = 'root';
$password = '';
$db = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

require_once('Equipes.php');
require_once('Matchfoot.php');
require_once('Joueurs.php');
require_once('Evenements.php');
