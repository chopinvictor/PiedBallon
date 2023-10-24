<?php

class Joueurs
{
	// BDD propriétés
	private $conn;

	// matchs propriétés
	public $id_joueur;
	public $nom;
	public $prenom;
	public $nationalite_joueur;
	public $numero;
	public $id_equipe;

	// constructeur avec connexion à la BDD
	public function __construct($db)
	{
		$this->conn = $db;
	}

	// récupération des matchs
	public function readAllJoueurs()
	{
		$query = 'SELECT * FROM joueurs ';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	public function readSingleJoueurs()
	{
		$query = 'SELECT * FROM joueurs WHERE id_joueur = ? LIMIT 1';

		$stmt = $this->conn->prepare($query);
		// bind du paramètre
		$stmt->bindParam(1, $this->id_joueur);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_joueur = $row['id_joueur'];
		$this->nom = $row['nom'];
		$this->prenom = $row['prenom'];
		$this->nationalite_joueur = $row['nationalite_joueur'];
		$this->id_equipe = $row['id_equipe'];

		return $stmt;
	}
}
