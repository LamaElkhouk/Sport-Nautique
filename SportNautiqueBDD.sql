-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 08 déc. 2020 à 23:55
-- Version du serveur :  5.7.31-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `SportNautique`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `nom` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom`) VALUES
(1, 'en mer'),
(2, 'dans l\'océan'),
(3, 'en eau vive');

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `id` int(11) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `num_tel` int(11) NOT NULL,
  `sexe` varchar(64) NOT NULL,
  `naissance` date NOT NULL,
  `email` varchar(64) NOT NULL,
  `mdp` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`id`, `nom`, `num_tel`, `sexe`, `naissance`, `email`, `mdp`) VALUES
(1, 'Martin Dupont', 645784578, 'H', '2020-11-09', 'dupont@gmail.com', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9'),
(2, 'Lamia El khoukhi', 627286879, 'Femme', '1999-08-09', 'lamia@gmail.com', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9'),
(3, 'teste teste', 666124512, 'Homme', '2020-11-10', 'teste@gmail.com', '46070d4bf934fb0d4b06d9e2c46e346944e322444900a435d7d9a95e6d7435f5'),
(4, 'marnie  durand', 645784578, 'Femme', '2020-11-20', 'marnie@gmail.com', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9'),
(5, 'visiteur visiteur', 666666666, 'Homme', '2020-12-09', 'visiteur@gmail.com', '359d6d57e0a84624a1ff4dae25b68bbc207c58ac0a98c1e648c7e6c97c333a42'),
(6, 'admin', 666666666, 'Homme', '2020-12-09', 'admin@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

CREATE TABLE `ligne_commande` (
  `id_commande` int(11) NOT NULL,
  `id_sport` int(11) NOT NULL,
  `nb_seance_sport` int(11) NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`id_commande`, `id_sport`, `nb_seance_sport`, `id_client`) VALUES
(1, 12, 8, 5),
(2, 3, 2, 5),
(3, 10, 1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `sport_nautique`
--

CREATE TABLE `sport_nautique` (
  `id_sport` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `img` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sport_nautique`
--

INSERT INTO `sport_nautique` (`id_sport`, `id_categorie`, `nom`, `description`, `prix`, `img`) VALUES
(1, 3, 'Le Rafting', '\r\nLudique, elle comprend une embarcation de 5 à 10 personnes, avec ce qu’on appelle un barreur à l’arrière, qui est le « raft master » ou le guide qu’il faudra scrupuleusement écouter pour avancer en toute sécurité sur l’eau.', '12', 'img/sports/rafting.jpg'),
(2, 3, 'le kayak', 'Si vous êtes casse cou, vous pouvez passer aux embarcations rigides et vous tester notamment aux différents types de kayak.', '12', 'img/sports/kayak.jpg'),
(3, 3, 'Le canoë', '\r\nc\'est comme une balade sur l’eau mais en mode trekking :\r\nce qu\'on appelle canoë de type randonnée est un canoë de rivière où l’on peut aussi facilement placer des bidons étanches ou transporter son matériel de camping.', '20', 'img/sports/canoe.jpg'),
(4, 3, 'le canyonning', '\r\nIl consiste à descendre rivières, torrents, gorges, avec ou sans présence d\'eau, et pouvant présenter cascades, ou autres reliefs à franchir.', '16', 'img/sports/canyonning.jpg'),
(5, 1, 'le surf', 'Le surf se pratique sur une planche choisie en fonction du niveau et de la morphologie du surfeur.', '21', 'img/sports/surf.jpg'),
(6, 1, 'le kitsurf', 'Le kitesurf provient du mot anglais « kite » qui signifie « cerf-volant ».\r\nc\'est un sport nautique de glisse qui consiste à se déplacer sur une étendue d’eau grâce à l’énergie du vent ', '13', 'img/sports/kitesurf.jpg'),
(7, 1, 'vol en flyboard', 'Impressionnez tout vos amis avec cet impressionnant sport nautique.', '20', 'img/sports/flyboard.jpg'),
(8, 1, 'le paddle', 'aussi connu sous le nom de stand-up paddle ou SUP est un sport nautique proche du surf qui se pratique sur une planche un peu plus grande.\r\n La particularité du paddle réside surtout dans l’utilisation d’une pagaie (« paddle » en anglais) et le fait que le paddler reste pratiquement toujours debout', '18', 'img/sports/paddle.jpg'),
(9, 2, 'marche sous-marine', '\r\nAvec ce système unique de plongée, n’importe qui peut se retrouver 20 000 lieues sous les mers !', '26', 'img/sports/marche_sous-marine.jpg'),
(10, 2, 'plongée en apnée', 'Voilà une manière beaucoup plus simple et très efficace pour découvrir la faune sous-marine !', '18', 'img/sports/plongee_en_apnee.jpg'),
(11, 2, 'plongée en sunba', 'la plongée en sunba est similaire à la marche sous-marine mais avec un degré de liberté supérieur !', '17', 'img/sports/sunba.jpg'),
(12, 2, 'Snorkeling avec les baleines', 'Oui, c’est possible ! Admirez les géants des océans avec seulement votre masque et tuba !', '20', 'img/sports/snorkeling.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_sport` (`id_sport`,`id_client`);

--
-- Index pour la table `sport_nautique`
--
ALTER TABLE `sport_nautique`
  ADD PRIMARY KEY (`id_sport`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `sport_nautique`
--
ALTER TABLE `sport_nautique`
  MODIFY `id_sport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
