<?php

class Evenements
{
	// BDD propriétés
	private $conn;

	// évènements propriétés
	public $id_evenement;
	public $horodatage;
	public $id_match;

	// constructeur avec connexion à la BDD
	public function __construct($db)
	{
		$this->conn = $db;
	}

	// récupération des évènements
	public function readAllEvenements()
	{
		$query = 'SELECT * FROM evenements ';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	public function readSingleEvenement()
	{
		$query = 'SELECT * FROM evenements WHERE id_evenement = ? LIMIT 1';

		$stmt = $this->conn->prepare($query);
		// bind du paramètre
		$stmt->bindParam(1, $this->id_evenement);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_evenement = $row['id_evenement'];
		$this->horodatage = $row['horodatage'];
		$this->id_match = $row['id_match'];

		return $stmt;
	}
}
