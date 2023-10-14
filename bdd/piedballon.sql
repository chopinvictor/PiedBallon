CREATE TABLE Arbritres(
   id_arbitre INT AUTO_INCREMENT,
   nom VARCHAR(50)  NOT NULL,
   prenom VARCHAR(50)  NOT NULL,
   nationalite_arbitre VARCHAR(50)  NOT NULL,
   PRIMARY KEY(id_arbitre)
);

CREATE TABLE Clubs(
   id_club INT AUTO_INCREMENT,
   lieu VARCHAR(50)  NOT NULL,
   PRIMARY KEY(id_club)
);

CREATE TABLE Equipes(
   id_equipe INT AUTO_INCREMENT,
   nb_match_joues INT NOT NULL,
   nb_match_gagnes INT NOT NULL,
   nb_match_egalites INT NOT NULL,
   prenom_entraineur VARCHAR(50)  NOT NULL,
   entraineur_nom VARCHAR(50)  NOT NULL,
   entraineur_prenom VARCHAR(50)  NOT NULL,
   entraineur_adjoint_nom VARCHAR(50)  NOT NULL,
   entraineur_adjoint_prenom VARCHAR(50)  NOT NULL,
   id_club INT NOT NULL,
   PRIMARY KEY(id_equipe),
   FOREIGN KEY(id_club) REFERENCES Clubs(id_club)
);

CREATE TABLE Matchs(
   id_match INT AUTO_INCREMENT,
   date_match DATE NOT NULL,
   lieu_match VARCHAR(50)  NOT NULL,
   score_equipe_1 INT NOT NULL,
   score_equipe_2 INT NOT NULL,
   est_fini BOOLEAN NOT NULL,
   PRIMARY KEY(id_match)
);

CREATE TABLE Evenements(
   id_evenement INT AUTO_INCREMENT,
   horodatage INT NOT NULL,
   id_match INT NOT NULL,
   PRIMARY KEY(id_evenement),
   FOREIGN KEY(id_match) REFERENCES Matchs(id_match)
);

CREATE TABLE Postes(
   id_poste INT AUTO_INCREMENT,
   poste VARCHAR(50)  NOT NULL,
   id_match INT NOT NULL,
   PRIMARY KEY(id_poste),
   FOREIGN KEY(id_match) REFERENCES Matchs(id_match)
);

CREATE TABLE Utilisateurs(
   id_utilisateur INT AUTO_INCREMENT,
   nom VARCHAR(50)  NOT NULL,
   prenom VARCHAR(50)  NOT NULL,
   adresse_mail VARCHAR(50)  NOT NULL,
   mot_de_passe VARCHAR(50)  NOT NULL,
   est_admin BOOLEAN NOT NULL,
   PRIMARY KEY(id_utilisateur)
);

CREATE TABLE Questions_securite(
   id_question INT AUTO_INCREMENT,
   question VARCHAR(50)  NOT NULL,
   PRIMARY KEY(id_question)
);

CREATE TABLE Joueurs(
   id_joueur INT AUTO_INCREMENT,
   nom VARCHAR(50)  NOT NULL,
   prenom VARCHAR(50)  NOT NULL,
   nationalite_joueur VARCHAR(50)  NOT NULL,
   club VARCHAR(50)  NOT NULL,
   numero INT NOT NULL,
   id_equipe INT NOT NULL,
   PRIMARY KEY(id_joueur),
   FOREIGN KEY(id_equipe) REFERENCES Equipes(id_equipe)
);

CREATE TABLE Buts(
   id_but INT AUTO_INCREMENT,
   nom_buteur VARCHAR(50)  NOT NULL,
   id_joueur INT NOT NULL,
   id_evenement INT NOT NULL,
   PRIMARY KEY(id_but),
   UNIQUE(id_evenement),
   FOREIGN KEY(id_joueur) REFERENCES Joueurs(id_joueur),
   FOREIGN KEY(id_evenement) REFERENCES Evenements(id_evenement)
);

CREATE TABLE Fautes(
   id_faute INT AUTO_INCREMENT,
   est_fautif BOOLEAN NOT NULL,
   id_joueur INT NOT NULL,
   id_evenement INT NOT NULL,
   PRIMARY KEY(id_faute),
   UNIQUE(id_evenement),
   FOREIGN KEY(id_joueur) REFERENCES Joueurs(id_joueur),
   FOREIGN KEY(id_evenement) REFERENCES Evenements(id_evenement)
);

CREATE TABLE Remplacements(
   id_remplacement INT AUTO_INCREMENT,
   id_joueur INT NOT NULL,
   id_evenement INT NOT NULL,
   PRIMARY KEY(id_remplacement),
   UNIQUE(id_evenement),
   FOREIGN KEY(id_joueur) REFERENCES Joueurs(id_joueur),
   FOREIGN KEY(id_evenement) REFERENCES Evenements(id_evenement)
);

CREATE TABLE participe(
   id_club INT,
   id_match INT,
   PRIMARY KEY(id_club, id_match),
   FOREIGN KEY(id_club) REFERENCES Clubs(id_club),
   FOREIGN KEY(id_match) REFERENCES Matchs(id_match)
);

CREATE TABLE equipe_joue(
   id_equipe INT,
   id_match INT,
   PRIMARY KEY(id_equipe, id_match),
   FOREIGN KEY(id_equipe) REFERENCES Equipes(id_equipe),
   FOREIGN KEY(id_match) REFERENCES Matchs(id_match)
);

CREATE TABLE arbitre_match(
   id_arbitre INT,
   id_match INT,
   est_principal BOOLEAN,
   PRIMARY KEY(id_arbitre, id_match),
   FOREIGN KEY(id_arbitre) REFERENCES Arbritres(id_arbitre),
   FOREIGN KEY(id_match) REFERENCES Matchs(id_match)
);

CREATE TABLE joue(
   id_joueur INT,
   id_poste INT,
   titulaire BOOLEAN NOT NULL,
   capitaine BOOLEAN NOT NULL,
   suppleant BOOLEAN NOT NULL,
   entree INT NOT NULL,
   sortie INT NOT NULL,
   PRIMARY KEY(id_joueur, id_poste),
   FOREIGN KEY(id_joueur) REFERENCES Joueurs(id_joueur),
   FOREIGN KEY(id_poste) REFERENCES Postes(id_poste)
);

CREATE TABLE reponses_securite(
   id_utilisateur INT,
   id_question INT,
   reponse VARCHAR(255) ,
   PRIMARY KEY(id_utilisateur, id_question),
   FOREIGN KEY(id_utilisateur) REFERENCES Utilisateurs(id_utilisateur),
   FOREIGN KEY(id_question) REFERENCES Questions_securite(id_question)
);
