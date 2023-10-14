-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 23 août 2023 à 10:24
-- Version du serveur : 10.4.27-MariaDB
-- Version de php : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `piedballon`
--

-- --------------------------------------------------------

--
-- Structure de la table `arbitre_match`
--

CREATE TABLE `arbitre_match` (
  `id_arbitre` int(11) NOT NULL,
  `id_match` int(11) NOT NULL,
  `est_principal` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `arbritres`
--

CREATE TABLE `arbritres` (
  `id_arbitre` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `nationalite_arbitre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `a_defini`
--

CREATE TABLE `a_defini` (
  `id_utilisateur` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `reponse` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `buts`
--

CREATE TABLE `buts` (
  `id_but` int(11) NOT NULL,
  `nom_buteur` varchar(50) DEFAULT NULL,
  `id_joueur` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

CREATE TABLE `clubs` (
  `id_club` int(11) NOT NULL,
  `lieu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clubs`
--

INSERT INTO `clubs` (`id_club`, `lieu`) VALUES
(1, 'manchester'),
(2, 'argentine'),
(3, 'suisse'),
(4, 'portugal'),
(5, 'nigeria'),
(6, 'hongrie'),
(7, 'france');

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE `equipes` (
  `id_equipe` int(11) NOT NULL,
  `nb_match_joues` int(11) DEFAULT NULL,
  `nb_match_gagnes` int(11) DEFAULT NULL,
  `nb_match_egalites` int(11) DEFAULT NULL,
  `id_club` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`id_equipe`, `nb_match_joues`, `nb_match_gagnes`, `nb_match_egalites`, `id_club`) VALUES
(1, NULL, NULL, NULL, 1),
(2, NULL, NULL, NULL, 4),
(3, NULL, NULL, NULL, 2),
(4, NULL, NULL, NULL, 5),
(5, NULL, NULL, NULL, 3),
(6, NULL, NULL, NULL, 6),
(7, NULL, NULL, NULL, 7);

-- --------------------------------------------------------

--
-- Structure de la table `equipe_joue`
--

CREATE TABLE `equipe_joue` (
  `id_equipe` int(11) NOT NULL,
  `id_match` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `id_evenement` int(11) NOT NULL,
  `horodatage` int(11) DEFAULT NULL,
  `id_match` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fautes`
--

CREATE TABLE `fautes` (
  `id_faute` int(11) NOT NULL,
  `est_fautif` tinyint(1) DEFAULT NULL,
  `id_joueur` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `joue`
--

CREATE TABLE `joue` (
  `id_joueur` int(11) NOT NULL,
  `id_poste` int(11) NOT NULL,
  `titulaire` tinyint(1) DEFAULT NULL,
  `capitaine` tinyint(1) DEFAULT NULL,
  `suppleant` tinyint(1) DEFAULT NULL,
  `entree` int(11) DEFAULT NULL,
  `sortie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

CREATE TABLE `joueurs` (
  `id_joueur` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `nationalite_joueur` varchar(50) DEFAULT NULL,
  `club` varchar(50) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `id_equipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `joueurs`
--

INSERT INTO `joueurs` (`id_joueur`, `nom`, `prenom`, `nationalite_joueur`, `club`, `numero`, `id_equipe`) VALUES
(1, 'haaland', 'erling', 'norvège', 'manchester city', 9, 1),
(2, 'benzema', 'karim', 'france', 'real madrid', 9, 7);

-- --------------------------------------------------------

--
-- Structure de la table `matchs`
--

CREATE TABLE `matchs` (
  `id_match` int(11) NOT NULL,
  `date_match` date DEFAULT NULL,
  `score_equipe_1` int(11) DEFAULT NULL,
  `score_equipe_2` int(11) DEFAULT NULL,
  `est_fini` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `id_club` int(11) NOT NULL,
  `id_match` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `postes`
--

CREATE TABLE `postes` (
  `id_poste` int(11) NOT NULL,
  `poste` varchar(50) DEFAULT NULL,
  `id_match` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `questions_securite`
--

CREATE TABLE `questions_securite` (
  `id_question` int(11) NOT NULL,
  `question` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `remplacements`
--

CREATE TABLE `remplacements` (
  `id_remplacement` int(11) NOT NULL,
  `id_joueur` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse_mail` varchar(50) DEFAULT NULL,
  `mot_de_passe` varchar(50) DEFAULT NULL,
  `est_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `arbitre_match`
--
ALTER TABLE `arbitre_match`
  ADD PRIMARY KEY (`id_arbitre`,`id_match`),
  ADD KEY `id_match` (`id_match`);

--
-- Index pour la table `arbritres`
--
ALTER TABLE `arbritres`
  ADD PRIMARY KEY (`id_arbitre`);

--
-- Index pour la table `a_defini`
--
ALTER TABLE `a_defini`
  ADD PRIMARY KEY (`id_utilisateur`,`id_question`),
  ADD KEY `id_question` (`id_question`);

--
-- Index pour la table `buts`
--
ALTER TABLE `buts`
  ADD PRIMARY KEY (`id_but`),
  ADD UNIQUE KEY `id_evenement` (`id_evenement`),
  ADD KEY `id_joueur` (`id_joueur`);

--
-- Index pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id_club`);

--
-- Index pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id_equipe`),
  ADD KEY `id_club` (`id_club`);

--
-- Index pour la table `equipe_joue`
--
ALTER TABLE `equipe_joue`
  ADD PRIMARY KEY (`id_equipe`,`id_match`),
  ADD KEY `id_match` (`id_match`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`id_evenement`),
  ADD KEY `id_match` (`id_match`);

--
-- Index pour la table `fautes`
--
ALTER TABLE `fautes`
  ADD PRIMARY KEY (`id_faute`),
  ADD UNIQUE KEY `id_evenement` (`id_evenement`),
  ADD KEY `id_joueur` (`id_joueur`);

--
-- Index pour la table `joue`
--
ALTER TABLE `joue`
  ADD PRIMARY KEY (`id_joueur`,`id_poste`),
  ADD KEY `id_poste` (`id_poste`);

--
-- Index pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD PRIMARY KEY (`id_joueur`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- Index pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD PRIMARY KEY (`id_match`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`id_club`,`id_match`),
  ADD KEY `id_match` (`id_match`);

--
-- Index pour la table `postes`
--
ALTER TABLE `postes`
  ADD PRIMARY KEY (`id_poste`),
  ADD KEY `id_match` (`id_match`);

--
-- Index pour la table `questions_securite`
--
ALTER TABLE `questions_securite`
  ADD PRIMARY KEY (`id_question`);

--
-- Index pour la table `remplacements`
--
ALTER TABLE `remplacements`
  ADD PRIMARY KEY (`id_remplacement`),
  ADD UNIQUE KEY `id_evenement` (`id_evenement`),
  ADD KEY `id_joueur` (`id_joueur`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `arbritres`
--
ALTER TABLE `arbritres`
  MODIFY `id_arbitre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `buts`
--
ALTER TABLE `buts`
  MODIFY `id_but` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id_club` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fautes`
--
ALTER TABLE `fautes`
  MODIFY `id_faute` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `joueurs`
--
ALTER TABLE `joueurs`
  MODIFY `id_joueur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `matchs`
--
ALTER TABLE `matchs`
  MODIFY `id_match` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `postes`
--
ALTER TABLE `postes`
  MODIFY `id_poste` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `questions_securite`
--
ALTER TABLE `questions_securite`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `remplacements`
--
ALTER TABLE `remplacements`
  MODIFY `id_remplacement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `arbitre_match`
--
ALTER TABLE `arbitre_match`
  ADD CONSTRAINT `arbitre_match_ibfk_1` FOREIGN KEY (`id_arbitre`) REFERENCES `arbritres` (`id_arbitre`),
  ADD CONSTRAINT `arbitre_match_ibfk_2` FOREIGN KEY (`id_match`) REFERENCES `matchs` (`id_match`);

--
-- Contraintes pour la table `a_defini`
--
ALTER TABLE `a_defini`
  ADD CONSTRAINT `a_defini_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `a_defini_ibfk_2` FOREIGN KEY (`id_question`) REFERENCES `questions_securite` (`id_question`);

--
-- Contraintes pour la table `buts`
--
ALTER TABLE `buts`
  ADD CONSTRAINT `buts_ibfk_1` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`),
  ADD CONSTRAINT `buts_ibfk_2` FOREIGN KEY (`id_evenement`) REFERENCES `evenements` (`id_evenement`);

--
-- Contraintes pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `equipes_ibfk_1` FOREIGN KEY (`id_club`) REFERENCES `clubs` (`id_club`);

--
-- Contraintes pour la table `equipe_joue`
--
ALTER TABLE `equipe_joue`
  ADD CONSTRAINT `equipe_joue_ibfk_1` FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id_equipe`),
  ADD CONSTRAINT `equipe_joue_ibfk_2` FOREIGN KEY (`id_match`) REFERENCES `matchs` (`id_match`);

--
-- Contraintes pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD CONSTRAINT `evenements_ibfk_1` FOREIGN KEY (`id_match`) REFERENCES `matchs` (`id_match`);

--
-- Contraintes pour la table `fautes`
--
ALTER TABLE `fautes`
  ADD CONSTRAINT `fautes_ibfk_1` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`),
  ADD CONSTRAINT `fautes_ibfk_2` FOREIGN KEY (`id_evenement`) REFERENCES `evenements` (`id_evenement`);

--
-- Contraintes pour la table `joue`
--
ALTER TABLE `joue`
  ADD CONSTRAINT `joue_ibfk_1` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`),
  ADD CONSTRAINT `joue_ibfk_2` FOREIGN KEY (`id_poste`) REFERENCES `postes` (`id_poste`);

--
-- Contraintes pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD CONSTRAINT `joueurs_ibfk_1` FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id_equipe`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `participe_ibfk_1` FOREIGN KEY (`id_club`) REFERENCES `clubs` (`id_club`),
  ADD CONSTRAINT `participe_ibfk_2` FOREIGN KEY (`id_match`) REFERENCES `matchs` (`id_match`);

--
-- Contraintes pour la table `postes`
--
ALTER TABLE `postes`
  ADD CONSTRAINT `postes_ibfk_1` FOREIGN KEY (`id_match`) REFERENCES `matchs` (`id_match`);

--
-- Contraintes pour la table `remplacements`
--
ALTER TABLE `remplacements`
  ADD CONSTRAINT `remplacements_ibfk_1` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`),
  ADD CONSTRAINT `remplacements_ibfk_2` FOREIGN KEY (`id_evenement`) REFERENCES `evenements` (`id_evenement`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
