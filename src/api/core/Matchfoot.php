<?php

class Matchfoot
{
	// BDD propriétés
	private $conn;

	// matchs propriétés
	public $id_match;
	public $date_match;
	public $lieu_match;
	public $score_equipe_1;
	public $score_equipe_2;
	public $est_fini;

	// constructeur avec connexion à la BDD
	public function __construct($db)
	{
		$this->conn = $db;
	}

	// récupération des matchs
	public function readAllMatch()
	{
		$query = 'SELECT * FROM matchs ';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	public function readSingleMatch()
	{
		$query = 'SELECT * FROM matchs WHERE id_match = ? LIMIT 1';

		$stmt = $this->conn->prepare($query);
		// bind du paramètre
		$stmt->bindParam(1, $this->id_match);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_match = $row['id_match'];
		$this->date_match = $row['date_match'];
		$this->lieu_match = $row['lieu_match'];
		$this->score_equipe_1 = $row['score_equipe_1'];
		$this->score_equipe_2 = $row['score_equipe_2'];
		$this->est_fini = $row['est_fini'];

		return $stmt;
	}
}
