-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 23 oct. 2023 à 21:41
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

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
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nationalite_arbitre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `arbritres`
--

INSERT INTO `arbritres` (`id_arbitre`, `nom`, `prenom`, `nationalite_arbitre`) VALUES
(1, 'Turpin', 'Clément', 'France'),
(2, 'Frappart', 'Stéphanie', 'France'),
(3, 'Letexier', 'François', 'France'),
(4, 'Makkelie', 'Danny', 'Pays-bas'),
(5, 'Marciniak', 'Szymon', 'Pologne'),
(6, 'Zitouni', 'Kader', 'Tunisie'),
(7, 'Marciniak', 'Szymon', 'Pologne'),
(8, 'Zwayer', 'Felix', 'Allemagne');

-- --------------------------------------------------------

--
-- Structure de la table `buts`
--

CREATE TABLE `buts` (
  `id_but` int(11) NOT NULL,
  `nom_buteur` varchar(50) NOT NULL,
  `id_joueur` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `buts`
--

INSERT INTO `buts` (`id_but`, `nom_buteur`, `id_joueur`, `id_evenement`) VALUES
(1, 'Gorgelin', 1, 7),
(2, 'Desmas', 2, 8),
(3, 'Gautier', 3, 9);

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

CREATE TABLE `clubs` (
  `id_club` int(11) NOT NULL,
  `lieu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clubs`
--

INSERT INTO `clubs` (`id_club`, `lieu`) VALUES
(1, 'Le Havre'),
(2, 'PSG'),
(3, 'Lorient'),
(4, 'Toulouse'),
(5, 'Montpellier'),
(6, 'Lens'),
(7, 'Lyon'),
(8, 'Nice');

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE `equipes` (
  `id_equipe` int(11) NOT NULL,
  `nb_match_joues` int(11) NOT NULL,
  `nb_match_gagnes` int(11) NOT NULL,
  `nb_match_egalites` int(11) NOT NULL,
  `entraineur_nom` varchar(50) NOT NULL,
  `entraineur_prenom` varchar(50) NOT NULL,
  `entraineur_adjoint_nom` varchar(50) NOT NULL,
  `entraineur_adjoint_prenom` varchar(50) NOT NULL,
  `id_club` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`id_equipe`, `nb_match_joues`, `nb_match_gagnes`, `nb_match_egalites`, `entraineur_nom`, `entraineur_prenom`, `entraineur_adjoint_nom`, `entraineur_adjoint_prenom`, `id_club`) VALUES
(1, 9, 2, 4, 'Elsner', 'Luka', 'Costa', 'Serge', 1),
(2, 10, 3, 5, 'Martinez', 'Carles', 'Galtier', 'Jordan ', 4),
(3, 11, 6, 3, 'Enrique', 'Luis', 'Al-Khelaïfi', 'Nasser', 2),
(4, 8, 3, 3, 'Der Zakarian', 'Michel', 'Rizzetto', 'Franck', 5),
(5, 11, 1, 7, 'Le Bris', 'Régis', 'Goetze', 'Ingo', 3),
(6, 11, 3, 5, 'Haise', 'Franck', 'Ramaré', 'Johann', 6),
(7, 8, 3, 0, 'Grosso', 'Fabio', 'Vulliez', 'Jean-François', 7),
(8, 9, 5, 4, 'Farioli', 'Francesco', 'Sablé', 'Julien', 8);

-- --------------------------------------------------------

--
-- Structure de la table `equipe_joue`
--

CREATE TABLE `equipe_joue` (
  `id_equipe` int(11) NOT NULL,
  `id_match` int(11) NOT NULL,
  `domicile` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `id_evenement` int(11) NOT NULL,
  `horodatage` int(11) NOT NULL,
  `id_match` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`id_evenement`, `horodatage`, `id_match`) VALUES
(1, 14, 1),
(2, 34, 1),
(3, 35, 1),
(4, 49, 1),
(5, 62, 1),
(6, 72, 1),
(7, 14, 1),
(8, 33, 1),
(9, 68, 1),
(10, 14, 1),
(11, 34, 1),
(12, 68, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fautes`
--

CREATE TABLE `fautes` (
  `id_faute` int(11) NOT NULL,
  `est_fautif` tinyint(1) NOT NULL,
  `id_joueur` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL,
  `carton_jaune` tinyint(1) NOT NULL,
  `carton_rouge` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `joue`
--

CREATE TABLE `joue` (
  `id_joueur` int(11) NOT NULL,
  `id_poste` int(11) NOT NULL,
  `titulaire` tinyint(1) NOT NULL,
  `capitaine` tinyint(1) DEFAULT NULL,
  `entree` int(11) NOT NULL,
  `sortie` int(11) NOT NULL,
  `remplacant` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `joue`
--

INSERT INTO `joue` (`id_joueur`, `id_poste`, `titulaire`, `capitaine`, `entree`, `sortie`, `remplacant`) VALUES
(1, 40, 1, 1, 1, 90, NULL),
(2, 41, 1, NULL, 1, 90, NULL),
(3, 42, 1, NULL, 1, 90, NULL),
(4, 43, 1, NULL, 1, 90, NULL),
(5, 44, 1, NULL, 1, 90, NULL),
(6, 45, 1, NULL, 1, 90, NULL),
(7, 46, 1, NULL, 1, 90, NULL),
(8, 47, 1, NULL, 1, 90, NULL),
(9, 48, 1, NULL, 1, 35, NULL),
(10, 49, 1, NULL, 1, 62, NULL),
(11, 50, 1, NULL, 1, 49, NULL),
(12, 51, 0, NULL, 35, 90, 1),
(13, 52, 0, NULL, 62, 90, 1),
(14, 53, 0, NULL, 49, 90, 1),
(25, 40, 1, 1, 1, 90, NULL),
(26, 41, 1, NULL, 1, 90, NULL),
(27, 42, 1, NULL, 1, 90, NULL),
(28, 43, 1, NULL, 1, 90, NULL),
(29, 44, 1, NULL, 1, 90, NULL),
(30, 45, 1, NULL, 1, 90, NULL),
(31, 46, 1, NULL, 1, 90, NULL),
(32, 47, 1, NULL, 1, 90, NULL),
(33, 48, 1, NULL, 1, 14, NULL),
(34, 49, 1, NULL, 1, 34, NULL),
(35, 50, 1, NULL, 1, 72, NULL),
(36, 51, 0, NULL, 14, 90, 1),
(37, 52, 0, NULL, 34, 90, 1),
(38, 53, 0, NULL, 72, 90, 1);

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

CREATE TABLE `joueurs` (
  `id_joueur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nationalite_joueur` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `id_equipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `joueurs`
--

INSERT INTO `joueurs` (`id_joueur`, `nom`, `prenom`, `nationalite_joueur`, `numero`, `id_equipe`) VALUES
(1, 'Gorgelin', 'Mathieu', 'France', 1, 1),
(2, 'Desmas', 'Arthur', 'France', 16, 1),
(3, 'Gautier', 'Lloris', 'France', 7, 1),
(4, 'Salmier', 'Yoann', 'Guyanne francaise', 6, 1),
(5, 'Sangante', 'Arouna', 'Sénégal', 18, 1),
(6, 'Thiare', 'Aliou', 'Sénégal', 22, 1),
(7, 'El Hajjam', 'Oualid', 'Maroc', 44, 1),
(8, 'Operi', 'Christopher', 'Côte d Ivoire', 15, 1),
(9, 'Nego', 'Loïc', 'Hongrie', 34, 1),
(10, 'Aloïs', 'Confais', 'France', 4, 1),
(11, 'Daler', 'Kuzyaev', 'Russie', 13, 1),
(12, 'Targhalline', 'Oussama', 'Maroc', 19, 1),
(13, 'Ndiaye', 'Rassoul', 'Sénégal', 41, 1),
(14, 'Mbemba', 'Nolan', 'Congo', 25, 1),
(15, 'Touré', 'Abdoulaye', 'Guinée', 3, 1),
(16, 'Kechta', 'Yassine', 'Maroc', 17, 1),
(17, 'Diawara', 'Kandet', 'France', 26, 1),
(18, 'Grandsir', 'Samuel', 'France', 23, 1),
(19, 'Logbo', 'Elysée', 'France', 8, 1),
(20, 'Bayo', 'Mohamed', 'Guinéé', 33, 1),
(21, 'Casimir', 'Josue', 'France', 27, 1),
(22, 'Alioui', 'Nabil', 'France', 37, 1),
(23, 'Sabbi', 'Emmanuel', 'Etas-Unis', 29, 1),
(24, 'Soumaré', 'Issa', 'Sénégal', 39, 1),
(25, 'Tenas', 'Arnau', 'Espagne', 1, 3),
(26, 'Navas', 'Keylor', 'Costa Rica', 3, 3),
(27, 'Letellier', 'Alexandre', 'France', 21, 3),
(28, 'Rico', 'Sergio', 'Espagne', 14, 3),
(29, 'Donnarumma', 'Gianluigi', 'Italie', 5, 3),
(30, 'Pedrito', 'Marquinhos', 'Brésil', 15, 3),
(31, 'Skriniar', 'Milan', 'Slovaquie', 23, 3),
(32, 'Kimpembe', 'Presnel', 'France', 26, 3),
(33, 'Mukiele', 'Nordi', 'France', 19, 3),
(34, 'Hakimi', 'Achraf', 'Maroc', 14, 3),
(35, 'Kurzawa', 'Layvin', 'France', 33, 3),
(36, 'Hernandez', 'Lucas ', 'France', 17, 3),
(37, 'Mendes', 'Nuno', 'Portugal', 35, 3),
(38, 'Ugarte', 'Manuel', 'Portugal', 21, 3),
(39, 'Ruiz', 'Fabian', 'Espagne', 27, 3),
(40, 'Pereira', 'Danilo', 'Portugal', 38, 3),
(41, 'Yoli', 'Vitinha', 'Portugal', 44, 3),
(42, 'Kang-in', 'Lee', 'Coree', 8, 3),
(43, 'Ndour', 'Cher', 'Italie', 9, 3),
(44, 'Soler', 'Carlos', 'Espagne', 11, 3),
(45, 'Zaïre-Emery', 'Warren', 'France', 22, 3),
(46, 'Mbappe', 'Kylian', 'France', 10, 3),
(47, 'Ramos', 'Goncalo', 'Portugal', 43, 3),
(48, 'Dembele', 'Ousmane', 'France', 11, 3),
(49, 'Asensio', 'Marco', 'Espagne', 35, 3),
(50, 'Kolo', 'Randal', 'Muani', 11, 3),
(51, 'Sirigu', 'Salvatore', 'Italie', 8, 3),
(52, 'Boulhendi', 'Teddy', 'Algérie', 17, 3),
(53, 'Bulka', 'Marcin', 'Pologne', 13, 3),
(54, 'Mendy', 'Antoine', 'France', 17, 3),
(55, 'Todibo', 'Jean-Clair', 'France', 3, 3),
(56, 'Dante', 'David', 'Brésil', 10, 3),
(57, 'Lotomba', 'Jordan', 'Suisse', 24, 3),
(58, 'Atal', 'Youcef', 'Algérie', 14, 3),
(59, 'Amraoui', 'Ayoub', 'Maroc', 16, 3),
(60, 'Perraud', 'Romain', 'France', 29, 3),
(61, 'Bard', 'Melvin', 'France', 44, 3),
(62, 'Ndayishimiye', 'Youssouf', 'Burundi', 33, 3),
(63, 'Sirigu', 'Salvatore', 'Italie', 8, 3),
(64, 'Boulhendi', 'Teddy', 'Algérie', 17, 3),
(65, 'Bulka', 'Marcin', 'Pologne', 13, 3),
(66, 'Mendy', 'Antoine', 'France', 17, 3),
(67, 'Todibo', 'Jean-Clair', 'France', 3, 3),
(68, 'Dante', 'David', 'Brésil', 10, 3),
(69, 'Lotomba', 'Jordan', 'Suisse', 24, 3),
(70, 'Atal', 'Youcef', 'Algérie', 14, 3),
(71, 'Amraoui', 'Ayoub', 'Maroc', 16, 3),
(72, 'Perraud', 'Romain', 'France', 29, 3),
(73, 'Bard', 'Melvin', 'France', 10, 3),
(74, 'Ndayishimiye', 'Youssouf', 'Burundi', 33, 3),
(75, 'Thuram', 'Khéphren', 'France', 20, 3),
(76, 'Sanson', 'Morgan', 'France', 36, 3),
(77, 'Beka Beka', 'Alexis', 'France', 41, 3),
(78, 'Rosario', 'Pablo', 'Pays-Bas', 13, 3),
(79, 'Boudaoui', 'Hicham', 'Algérie', 44, 3),
(80, 'Boga', 'Jérémie ', 'Côte d Ivoire', 42, 3),
(81, 'Mannone', 'Vito', 'Italie', 1, 5),
(82, 'Youfeigane', 'Dominique', 'Suisse', 33, 5),
(83, 'Mvogo', 'Yvon', 'Centrafrique', 24, 5),
(84, 'Gomis', 'Alfred', 'Sénégal', 36, 5),
(85, 'Talbi', 'Montassar', 'Tunisie', 41, 5),
(86, 'Touré', 'Isaak', 'France', 7, 5),
(87, 'Laporte', 'Julien', 'France', 18, 5),
(88, 'Mouyokolo', 'Loris', 'Sénégal', 20, 5),
(89, 'Mendy', 'Formose', 'Côte d Ivoire', 9, 5),
(90, 'Meïté', 'Bamo', 'Congo', 6, 5),
(91, 'Kalulu', 'Gedeon', 'Brésil', 36, 5),
(92, 'Silva', 'Igor', 'Guinée', 29, 5),
(93, 'Sylla', 'Dembo', 'France', 15, 5),
(94, 'Le Goff', 'Vincent', 'France', 43, 5),
(95, 'Mendy', 'Benjamin', 'Cameroun', 17, 5),
(96, 'Yongwa', 'Darline', 'Nigeria', 0, 5),
(97, 'Innocent', 'Bonke', 'France', 28, 5),
(98, 'Bakayoko', 'Tiémoué', 'France', 32, 5),
(99, 'Bertaud', 'Dimitry', 'France', 33, 4),
(100, 'Dizdarevic', 'Belmin', 'France', 12, 4),
(101, 'Lecomte', 'Benjamin', 'France', 15, 4),
(102, 'Tchato', 'Enzo', 'France', 1, 4),
(103, 'Kouyaté', 'Boubakar', 'France', 10, 4),
(104, 'Omeragic', 'Becir', 'Suisse', 3, 4),
(105, 'Sakho', 'Mamadou', 'France', 25, 4),
(106, 'Jullien', 'Christopher', 'France', 19, 4),
(107, 'Estève', 'Maxime', 'France', 29, 4),
(108, 'Mincarelli Davin', 'Lucas', 'Bosnie-Herzégovine', 10, 4),
(109, 'Sacko', 'Falaye', 'France', 41, 4),
(110, 'Sylla', 'Issiaga', 'Cameroun', 20, 4),
(111, 'Sainte-Luce', 'Théo', 'Mali', 14, 4),
(112, 'Chotard', 'Joris', 'Jordanie', 11, 4),
(113, 'Savanier', 'Téji', 'France', 33, 4),
(114, 'Fayad', 'Khalil', 'Tunisie', 42, 4),
(115, 'Leroy', 'Léo', 'France', 25, 4),
(116, 'Ferri', 'Jordan', 'France', 15, 4),
(117, 'Al Tamari', 'Mousa', 'Jordanie', 9, 4),
(118, 'Khazri', 'Wahbi', 'Tunisie', 32, 4),
(119, 'Wahi', 'Elye', 'France', 17, 4),
(120, 'Nordin', 'Arnaud', 'Nigeria', 7, 4),
(121, 'Yeboah', 'Kelvin', 'Italie', 5, 4),
(122, 'Adams', 'Akor', 'Nigeria', 23, 4),
(123, 'Delaye', 'Sacha', 'France', 21, 4),
(124, 'Issoufou', 'Yanis', 'France', 16, 4),
(125, 'Dominguez', 'Álex', 'Espagne', 7, 2),
(126, 'Lacombe', 'Justin', 'France', 9, 2),
(127, 'Nicolaisen', 'Rasmus', 'Danemark', 22, 2),
(128, 'Costa', 'Logan', 'Cap Vert', 10, 2),
(129, 'Diarra', 'Moussa', 'Mali', 23, 2),
(130, 'Mawissa Elebi', 'Christian', 'France', 6, 2),
(131, 'Keben', 'Kévin', 'Cameroun', 19, 2),
(132, 'Rouault', 'Anthony', 'France', 44, 2),
(133, 'Desler', 'Mikkel', 'Danemark', 3, 2),
(134, 'Kamanzi', 'Warren', 'Norvège', 31, 2),
(135, 'Suazo', 'Gabriel', 'Chili', 11, 2),
(136, 'Zandén', 'Oliver', 'Suède', 24, 2),
(137, 'Alex Bangré', 'Mamady', 'Burkina Faso', 4, 2),
(138, 'Spierings', 'Stijn', 'Pays-Bas', 34, 2),
(139, 'Cásseres Jr.', 'Cristian', 'Venezuela', 43, 2),
(140, 'Gelabert', 'César', 'France', 12, 2),
(141, 'Sierro', 'Vincent', 'France', 32, 2),
(142, 'Chaïbi', 'Farès', 'Algérie', 40, 2),
(143, 'Leca', 'Jean-Louis', 'France', 12, 6),
(144, 'Samba', 'Brice', 'France', 1, 6),
(145, 'Fariñez', 'Wuilker', 'Venezuela', 23, 6),
(146, 'Pandor', 'Yannick', 'Comores', 9, 6),
(147, 'Mbala', 'Keny', 'France', 26, 6),
(148, 'Khusanov', 'Abdukodir', 'Ouzbékistan', 36, 6),
(149, 'Le Cardinal', 'Julien', 'France', 14, 6),
(150, 'Danso', 'Kevin', 'Autriche', 22, 6),
(151, 'Medina', 'Facundo', 'Argentine', 40, 6),
(152, 'Gradit', 'onathan', 'France', 44, 6),
(153, 'Aguilar', 'Ruben', 'France', 35, 6),
(154, 'Haïdara', 'Massadio', 'Mali', 21, 6),
(155, 'Machado', 'Deiver', 'Colombie', 14, 6),
(156, 'Maouassa', 'Faitout', 'France', 23, 6),
(157, 'Abdul Samed', 'Salis', 'Ghana', 19, 6),
(158, 'Sylla', 'Fodé', 'France', 10, 6),
(159, 'Diouf', 'Andy', 'France', 3, 6),
(160, 'Spierings', 'Stijn', 'Pays-Bas', 24, 6),
(161, 'Costa', 'David', 'Portugal', 33, 6),
(162, 'Frankowski', 'Przemyslaw', 'Pologne', 20, 6),
(163, 'Thomasson', 'Adrien', 'France', 34, 6);

-- --------------------------------------------------------

--
-- Structure de la table `matchs`
--

CREATE TABLE `matchs` (
  `id_match` int(11) NOT NULL,
  `date_match` datetime NOT NULL,
  `lieu_match` varchar(50) NOT NULL,
  `score_equipe_1` int(11) NOT NULL,
  `score_equipe_2` int(11) NOT NULL,
  `est_fini` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `matchs`
--

INSERT INTO `matchs` (`id_match`, `date_match`, `lieu_match`, `score_equipe_1`, `score_equipe_2`, `est_fini`) VALUES
(1, '2023-10-18 18:00:00', 'Parc des Princes', 3, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `id_club` int(11) NOT NULL,
  `id_match` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `participe`
--

INSERT INTO `participe` (`id_club`, `id_match`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `postes`
--

CREATE TABLE `postes` (
  `id_poste` int(11) NOT NULL,
  `poste` varchar(50) NOT NULL,
  `id_match` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `postes`
--

INSERT INTO `postes` (`id_poste`, `poste`, `id_match`) VALUES
(40, 'Gardien', 1),
(41, 'Défenseur central gauche', 1),
(42, 'Défenseur central droit', 1),
(43, 'Arrière gauche', 1),
(44, 'Arrière droit', 1),
(45, 'Milieu défensif', 1),
(46, 'Milieu offensif', 1),
(47, 'Milieu gauche', 1),
(48, 'Milieu droit', 1),
(49, 'Avant centre gauche', 1),
(50, 'Avant centre droit', 1),
(51, 'Milieu droit', 1),
(52, 'Avant-centre gauche', 1),
(53, 'Avant-centre droit', 1);

-- --------------------------------------------------------

--
-- Structure de la table `questions_securite`
--

CREATE TABLE `questions_securite` (
  `id_question` int(11) NOT NULL,
  `question` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `remplace`
--

CREATE TABLE `remplace` (
  `id_joueur` int(11) NOT NULL,
  `est_remplacé` tinyint(1) DEFAULT NULL,
  `id_remplacement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `remplace`
--

INSERT INTO `remplace` (`id_joueur`, `est_remplacé`, `id_remplacement`) VALUES
(9, 1, 3),
(10, 1, 5),
(11, 1, 4),
(12, 0, 3),
(13, 0, 5),
(14, 0, 4),
(33, 1, 1),
(34, 1, 2),
(35, 1, 6),
(36, 0, 1),
(37, 0, 2),
(38, 0, 6);

-- --------------------------------------------------------

--
-- Structure de la table `remplacements`
--

CREATE TABLE `remplacements` (
  `id_remplacement` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `remplacements`
--

INSERT INTO `remplacements` (`id_remplacement`, `id_evenement`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Structure de la table `reponses_securite`
--

CREATE TABLE `reponses_securite` (
  `id_utilisateur` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `reponse` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse_mail` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `est_admin` tinyint(1) NOT NULL
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
-- Index pour la table `remplace`
--
ALTER TABLE `remplace`
  ADD PRIMARY KEY (`id_joueur`),
  ADD KEY `id_remplacement` (`id_remplacement`);

--
-- Index pour la table `remplacements`
--
ALTER TABLE `remplacements`
  ADD PRIMARY KEY (`id_remplacement`),
  ADD UNIQUE KEY `id_evenement` (`id_evenement`);

--
-- Index pour la table `reponses_securite`
--
ALTER TABLE `reponses_securite`
  ADD PRIMARY KEY (`id_utilisateur`,`id_question`),
  ADD KEY `id_question` (`id_question`);

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
  MODIFY `id_arbitre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `buts`
--
ALTER TABLE `buts`
  MODIFY `id_but` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id_club` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `fautes`
--
ALTER TABLE `fautes`
  MODIFY `id_faute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `joueurs`
--
ALTER TABLE `joueurs`
  MODIFY `id_joueur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT pour la table `matchs`
--
ALTER TABLE `matchs`
  MODIFY `id_match` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `postes`
--
ALTER TABLE `postes`
  MODIFY `id_poste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `questions_securite`
--
ALTER TABLE `questions_securite`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `remplacements`
--
ALTER TABLE `remplacements`
  MODIFY `id_remplacement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- Contraintes pour la table `remplace`
--
ALTER TABLE `remplace`
  ADD CONSTRAINT `remplace_ibfk_1` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`),
  ADD CONSTRAINT `remplace_ibfk_2` FOREIGN KEY (`id_remplacement`) REFERENCES `remplacements` (`id_remplacement`);

--
-- Contraintes pour la table `remplacements`
--
ALTER TABLE `remplacements`
  ADD CONSTRAINT `remplacements_ibfk_1` FOREIGN KEY (`id_evenement`) REFERENCES `evenements` (`id_evenement`);

--
-- Contraintes pour la table `reponses_securite`
--
ALTER TABLE `reponses_securite`
  ADD CONSTRAINT `reponses_securite_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `reponses_securite_ibfk_2` FOREIGN KEY (`id_question`) REFERENCES `questions_securite` (`id_question`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
