<?php

require_once('../php/bdd.php');

define('APP_NAME', 'Pied Ballon');

function read_all($db)
{
	$query = 'SELECT * FROM matchs';
	$return = $db->query($query);
	$result = [];

	while ($row = $return->fetch(PDO::FETCH_ASSOC)) {
		array_push($result, $row);
	}
	$return->closeCursor();

	return json_encode($result);
}

header('Content-Type: application/json');
echo read_all($db);