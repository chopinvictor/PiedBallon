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
	public $nom_equipe_1;
	public $nom_equipe_2;
	public $entraineur_nom_e1;
	public $entraineur_nom_e2;
	public $entraineur_prenom_e1;
	public $entraineur_prenom_e2;
	public $entraineur_adjoint_nom_e1;
	public $entraineur_adjoint_nom_e2;
	public $entraineur_adjoint_prenom_e1;
	public $entraineur_adjoint_prenom_e2;
	public $id_club_e1;
	public $id_club_e2;
	public $est_fini;
	public $arbitres = [];

	// constructeur avec connexion à la BDD
	public function __construct($db)
	{
		$this->conn = $db;
	}

	// récupération des matchs
	// public function readAllMatch()
	// {
	// 	$query = 'SELECT matchs.*, SUBSTRING_INDEX(GROUP_CONCAT(clubs.lieu ORDER BY eq.id_equipe ASC), ",", 1) AS nom_club_1, SUBSTRING_INDEX(GROUP_CONCAT(clubs.lieu ORDER BY eq.id_equipe DESC), ",", 1) AS nom_club_2
	// 			FROM matchs
	// 			INNER JOIN equipe_joue AS eq ON matchs.id_match = eq.id_match
	// 			INNER JOIN clubs ON eq.id_equipe = clubs.id_club
	// 			GROUP BY matchs.id_match';
	// 	$stmt = $this->conn->prepare($query);
	// 	$stmt->execute();

	// 	return $stmt;
	// }
	public function readAllMatch()
	{
		$query = 'SELECT matchs.*,
		SUBSTRING_INDEX(GROUP_CONCAT(clubs.lieu ORDER BY eq.id_equipe ASC), ",", 1) AS nom_club_1,
		SUBSTRING_INDEX(GROUP_CONCAT(clubs.lieu ORDER BY eq.id_equipe DESC), ",", 1) AS nom_club_2
				FROM matchs
				INNER JOIN equipe_joue AS eq ON matchs.id_match = eq.id_match
          		INNER JOIN equipes as e on e.id_equipe = eq.id_equipe
				INNER JOIN clubs ON e.id_club = clubs.id_club
				GROUP BY matchs.id_match';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	public function readSingleMatch($id)
	{
		$query = 'SELECT matchs.*,
        SUBSTRING_INDEX(GROUP_CONCAT(clubs.lieu ORDER BY eq.id_equipe ASC), ",", 1) AS nom_club_1,
        SUBSTRING_INDEX(GROUP_CONCAT(clubs.lieu ORDER BY eq.id_equipe DESC), ",", 1) AS nom_club_2
                FROM matchs
                INNER JOIN equipe_joue AS eq ON matchs.id_match = eq.id_match
                INNER JOIN equipes on equipes.id_equipe = eq.id_equipe
                INNER JOIN clubs ON equipes.id_club = clubs.id_club
                WHERE matchs.id_match = ?
                GROUP BY matchs.id_match';
		$stmt = $this->conn->prepare($query);
		$stmt->execute([$id]);

		$queryArbitres = 'SELECT * 
						FROM arbitres 
						INNER JOIN arbitre_match on arbitres.id_arbitre = arbitre_match.id_arbitre 
						WHERE id_match = ? ORDER BY arbitre_match.est_principal DESC' ;
		$stmtArb = $this->conn->prepare($queryArbitres);
		$stmtArb->execute([$id]);

		$queryRemplacements = 'SELECT joueurs.nom, evenements.*, remplacements.id_remplacement, remplace.est_remplace
					FROM evenements
					INNER JOIN remplacements ON remplacements.id_evenement = evenements.id_evenement
					INNER JOIN remplace ON remplace.id_remplacement = remplacements.id_remplacement
					INNER JOIN joueurs ON joueurs.id_joueur = remplace.id_joueur
					WHERE id_match = ?';
		$stmtRem = $this->conn->prepare($queryRemplacements);
		$stmtRem->execute([$id]);

		$queryButs = 'SELECT evenements.*, joueurs.nom, clubs.lieu as nom_equipe
						FROM evenements
						INNER JOIN buts ON buts.id_evenement = evenements.id_evenement
						INNER JOIN joueurs ON joueurs.id_joueur = buts.id_joueur
                        INNER JOIN equipes on equipes.id_equipe = joueurs.id_equipe
                        INNER JOIN clubs on clubs.id_club = equipes.id_club
						WHERE evenements.id_match=?';
		$stmtButs = $this->conn->prepare($queryButs);
		$stmtButs->execute([$id]);

		$queryFautes = 'SELECT joueurs.nom, evenements.*, fautes.carton_rouge, fautes.carton_jaune
						FROM evenements
						INNER JOIN fautes ON fautes.id_evenement = evenements.id_evenement
						INNER JOIN faute_joueurs ON faute_joueurs.id_faute = fautes.id_faute
						INNER JOIN joueurs ON joueurs.id_joueur = faute_joueurs.id_joueur
						WHERE id_match=? AND faute_joueurs.est_fautif = 1
						ORDER BY evenements.horodatage ';
		$stmtFau = $this->conn->prepare($queryFautes);
		$stmtFau->execute([$id]);

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$row2 = $stmtArb->fetchAll(PDO::FETCH_ASSOC);
		$row3 = $stmtRem->fetchAll(PDO::FETCH_ASSOC);
		$row4 = $stmtButs->fetchAll(PDO::FETCH_ASSOC);
		$row5 = $stmtFau->fetchAll(PDO::FETCH_ASSOC);

		$this->id_match = $row['id_match'];
		$this->date_match = $row['date_match'];
		$this->lieu_match = $row['lieu_match'];
		$this->score_equipe_1 = $row['score_equipe_1'];
		$this->score_equipe_2 = $row['score_equipe_2'];
		$this->est_fini = $row['est_fini'];
		$this->nom_club_1 = $row['nom_club_1'];
		$this->nom_club_2 = $row['nom_club_2'];
		$this->arbitres = $row2;
		$this->remplacements = $row3;
		$this->buts = $row4;
		$this->fautes = $row5;

		return $stmt;
	}
}
