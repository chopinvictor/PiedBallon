<?php

class Post
{
	// BDD propriétés
	private $conn;
	private $table = 'posts';

	// posts propriétés
	public $id;
	public $post_nom;
	public $post_prenom;
	public $post_age;

	// constructeur avec connexion à la BDD
	public function __construct($db)
	{
		$this->conn = $db;
	}

	// récupération des posts
	public function read()
	{
		$query = 'SELECT
			id,
			post_nom,
			post_prenom,
			post_age
			FROM
			' . $this->table . '
		';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	public function read_single()
	{
		$query = 'SELECT
			id,
			post_nom,
			post_prenom,
			post_age
			FROM
			' . $this->table . '
			WHERE id = ? LIMIT 1';

		$stmt = $this->conn->prepare($query);
		// bind du paramètre
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];
		$this->post_nom = $row['post_nom'];
		$this->post_prenom = $row['post_prenom'];
		$this->post_age = $row['post_age'];

		return $stmt;
	}
}
