<?php

class Equipes
{
	// BDD propriétés
	private $conn;

	// matchs propriétés
	public $id_equipe;
	public $nb_match_joues;
	public $nb_match_gagnes;
	public $nb_match_egalites;
	public $entraineur_nom;
	public $entraineur_prenom;
	public $entraineur_adjoint_nom;
	public $entraineur_adjoint_prenom;
	public $id_club;

	// constructeur avec connexion à la BDD
	public function __construct($db)
	{
		$this->conn = $db;
	}

	// récupération des matchs
	public function readAllEquipes()
	{
		$query = 'SELECT * FROM equipes ';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	public function readSingleEquipes()
	{
		$query = 'SELECT * FROM equipes WHERE id_equipe = ? LIMIT 1';

		$stmt = $this->conn->prepare($query);
		// bind du paramètre
		$stmt->bindParam(1, $this->id_equipe);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_equipe = $row['id_equipe'];
		$this->nb_match_joues = $row['nb_match_joues'];
		$this->nb_match_gagnes = $row['nb_match_gagnes'];
		$this->nb_match_egalites = $row['nb_match_egalites'];
		$this->entraineur_nom = $row['entraineur_nom'];
		$this->entraineur_prenom = $row['entraineur_prenom'];
		$this->entraineur_adjoint_nom = $row['entraineur_adjoint_nom'];
		$this->entraineur_adjoint_prenom = $row['entraineur_adjoint_prenom'];
		$this->id_club = $row['id_club'];

		return $stmt;
	}
}
