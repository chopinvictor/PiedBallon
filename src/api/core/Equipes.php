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
		$query = 'SELECT equipes.*, SUBSTRING_INDEX(GROUP_CONCAT(clubs.lieu ORDER BY equipes.id_equipe ASC), ",", 1) AS nom_club
					FROM equipes
					INNER JOIN clubs ON equipes.id_club = clubs.id_club
					GROUP BY equipes.id_equipe';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	public function readSingleEquipe($id)
	{
		$query = 'SELECT equipes.*, SUBSTRING_INDEX(GROUP_CONCAT(clubs.lieu ORDER BY equipes.id_equipe ASC), ",", 1) AS nom_club FROM equipes INNER JOIN clubs ON equipes.id_club = clubs.id_club WHERE equipes.id_equipe = ?';
		$stmt = $this->conn->prepare($query);
		$stmt->execute([$id]);

		$queryJoueurs = 'SELECT * FROM `joueurs` WHERE id_equipe = ?';
		$stmtJou = $this->conn->prepare($queryJoueurs);
		$stmtJou->execute([$id]);
		
		$queryClassement = 'SELECT buts.id_joueur, COUNT(buts.id_joueur) as nb_buts_joueur, buts.nom_buteur
								FROM `buts`
								INNER JOIN joueurs as j on j.id_joueur = buts.id_joueur
								WHERE j.id_equipe = ?
								GROUP BY id_joueur
								ORDER BY nb_buts_joueur DESC
								LIMIT 5';
		$stmtCla = $this->conn->prepare($queryClassement);
		$stmtCla->execute([$id]);

		$queryButsMarques = 'SELECT COUNT(b.id_but) as nb_buts_marques
								FROM `buts` as b
								INNER JOIN joueurs as j on j.id_joueur = b.id_joueur
								INNER JOIN equipes as e on e.id_equipe = j.id_equipe
								WHERE j.id_equipe = ?';
		$stmtBma = $this->conn->prepare($queryButsMarques);
		$stmtBma->execute([$id]);

		$queryButsEncaisses = 'SELECT COUNT(b.id_but) as nb_buts_encaisses
								FROM `buts` as b
								INNER JOIN joueurs as j on j.id_joueur = b.id_joueur
								INNER JOIN equipes as e on e.id_equipe = j.id_equipe
								WHERE j.id_equipe <> ?';
		$stmtBen = $this->conn->prepare($queryButsEncaisses);
		$stmtBen->execute([$id]);

		$queryCartonsJaunes = 'SELECT COUNT(f.id_faute) as nb_cartons_jaunes
									FROM `fautes` as f
									INNER JOIN faute_joueurs as fj on fj.id_faute = f.id_faute
									INNER JOIN joueurs as j on j.id_joueur = fj.id_joueur
									WHERE J.id_equipe = ? AND f.carton_jaune = 1';
		$stmtCja = $this->conn->prepare($queryCartonsJaunes);
		$stmtCja->execute([$id]);

		$queryCartonsRouges = 'SELECT COUNT(f.id_faute) as nb_cartons_rouges
								FROM `fautes` as f
								INNER JOIN faute_joueurs as fj on fj.id_faute = f.id_faute
								INNER JOIN joueurs as j on j.id_joueur = fj.id_joueur
								WHERE J.id_equipe = ? AND f.carton_rouge = 1';
		$stmtCro = $this->conn->prepare($queryCartonsRouges);
		$stmtCro->execute([$id]);

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$row2 = $stmtJou->fetchAll(PDO::FETCH_ASSOC);
		$row3 = $stmtCla->fetchAll(PDO::FETCH_ASSOC);
		$row4 = $stmtBma->fetch(PDO::FETCH_ASSOC);
		$row5 = $stmtBen->fetch(PDO::FETCH_ASSOC);
		$row6 = $stmtCja->fetch(PDO::FETCH_ASSOC);
		$row7 = $stmtCro->fetch(PDO::FETCH_ASSOC);

		$this->id_equipe = $row['id_equipe'];
		$this->nb_match_joues = $row['nb_match_joues'];
		$this->nb_match_gagnes = $row['nb_match_gagnes'];
		$this->nb_match_egalites = $row['nb_match_egalites'];
		$this->entraineur_nom = $row['entraineur_nom'];
		$this->entraineur_prenom = $row['entraineur_prenom'];
		$this->entraineur_adjoint_nom = $row['entraineur_adjoint_nom'];
		$this->entraineur_adjoint_prenom = $row['entraineur_adjoint_prenom'];
		$this->id_club = $row['id_club'];
		$this->nom_club = $row['nom_club'];
		$this->joueurs = $row2;
		$this->classement = $row3;
		$this->nb_buts_marques = $row4['nb_buts_marques'];
		$this->nb_buts_encaisses = $row5['nb_buts_encaisses'];
		$this->nb_cartons_jaunes = $row6['nb_cartons_jaunes'];
		$this->nb_cartons_rouges = $row7['nb_cartons_rouges'];

		return $stmt;
	}
}
