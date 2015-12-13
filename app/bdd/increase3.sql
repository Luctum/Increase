-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 13 Décembre 2015 à 23:13
-- Version du serveur :  5.6.26
-- Version de PHP :  5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `increase`
--

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL,
  `objet` varchar(255) DEFAULT NULL,
  `content` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idUser` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `idFil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `objet`, `content`, `date`, `idUser`, `idProjet`, `idFil`) VALUES
(2, 'Essai', 'Aucun contenu', '2015-03-12 23:00:00', 1, 1, NULL),
(7, 'Ok', 'Rien à répondre', '2015-03-13 13:33:51', 2, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE IF NOT EXISTS `projet` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text,
  `dateLancement` date DEFAULT NULL,
  `dateFinPrevue` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `idClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `projet`
--

INSERT INTO `projet` (`id`, `nom`, `description`, `dateLancement`, `dateFinPrevue`, `image`, `idClient`) VALUES
(1, 'Increase', 'A Phalcon web application to manage the progress of projects, and improve communication with the customer', '2015-03-16', '2015-03-29', 'http://orig13.deviantart.net/ceee/f/2013/272/5/a/yolo_png__read_description__by_thdianaduh-d6oljyx.png', 1),
(2, 'Open-beer', 'A free, public database, API and web application for beer information.1', '2015-03-15', '2015-03-29', 'http://www.ibiblio.org/themug/desktops/OS10.3/Aqua%20Red.jpg', 1),
(3, 'Essai', 'test&lt;html&gt;\r\n\r\nU wot m8 gr8', '2015-03-10', '2015-03-09', 'https://pbs.twimg.com/profile_images/603720828115648512/gh9H1A7T.png', 1),
(4, 'ChatonMignon', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus posuere euismod sem, sit amet gravida ligula placerat cursus. Suspendisse lacinia felis eu ante aliquam, vitae vehicula sem convallis. Donec odio magna, aliquet eget augue sit amet, viverra venenatis metus. Nulla odio nulla, euismod ac erat et, vestibulum ullamcorper elit. Donec aliquam lobortis purus, quis tempus leo dignissim vel. Morbi egestas egestas magna, id volutpat tellus aliquam ut. Pellentesque bibendum lectus odio.123', '2015-12-07', '2016-02-10', 'http://www.mon-chaton.fr/system/imgs/230/200/chaton-pas_mignon-3.jpeg?1329837117', 4);

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE IF NOT EXISTS `tache` (
  `id` int(11) NOT NULL,
  `libelle` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `avancement` smallint(6) DEFAULT NULL,
  `codeUseCase` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tache`
--

INSERT INTO `tache` (`id`, `libelle`, `date`, `avancement`, `codeUseCase`) VALUES
(1, 'Interview client +rédaction', '2015-03-22', 70, 'I-UC1'),
(2, 'MCD', '2015-03-22', 100, 'I-UC2'),
(3, 'Génération base', '2015-03-22', 100, 'I-UC3'),
(4, 'Uses cases', '2015-03-23', 100, 'I-UC4'),
(5, 'Connexion REST', '2015-03-13', 50, 'OB-UC1'),
(6, 'Liste des bières', '2015-03-22', 100, 'OB-UC2'),
(7, 'Liste des bières par brasserie', '2015-03-22', 10, 'OB-UC2'),
(8, '4a', '0000-00-00', 50, '456');

-- --------------------------------------------------------

--
-- Structure de la table `usecase`
--

CREATE TABLE IF NOT EXISTS `usecase` (
  `id` int(11) NOT NULL,
  `code` varchar(15) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `poids` smallint(6) DEFAULT NULL,
  `avancement` smallint(6) DEFAULT NULL,
  `idProjet` int(11) NOT NULL,
  `idDev` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `usecase`
--

INSERT INTO `usecase` (`id`, `code`, `nom`, `poids`, `avancement`, `idProjet`, `idDev`) VALUES
(18, 'I-UC1', 'Règles de gestion', 3, 50, 1, 2),
(19, 'I-UC2', 'Analyse des données', 2, 100, 1, 2),
(21, 'I-UC4', 'Analyse fonctionnelle', 20, 100, 1, 4),
(22, 'OB-UC1', 'Connexion au server REST', 15, 0, 2, 5),
(23, 'OB-UC2', 'Gestion des bières (liste/ajout/modification)', 10, 0, 2, 5),
(30, '456', '456', 45, 0, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `identite` varchar(100) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `mail`, `password`, `identite`, `role`, `image`) VALUES
(1, 'jcheron@kobject.net', 'ffffff9afffffff15b336e6affffff9619ffffff92ffffff8537ffffffdf30ffffffb2ffffffe6ffffffa2376569fffffffcfffffff9ffffffd7ffffffe773ffffffecffffffceffffffde65606529ffffffa0', 'JC HERON', 'user', 'https://avatars3.githubusercontent.com/u/2511052?v=3&s=460'),
(2, 'igor.minar@gmail.com', 'ffffff9afffffff15b336e6affffff9619ffffff92ffffff8537ffffffdf30ffffffb2ffffffe6ffffffa2376569fffffffcfffffff9ffffffd7ffffffe773ffffffecffffffceffffffde65606529ffffffa0', 'Igor MINAR', 'author', 'http://www.allodocteurs.fr/media/8307-petit-chaton-mignon.jpg'),
(3, 'admin@local.fr', 'ffffff8c6976ffffffe5ffffffb5410415ffffffbdffffffe908ffffffbd4dffffffee15ffffffdfffffffb167ffffffa9ffffffc873fffffffc4bffffffb8ffffffa81f6f2affffffb448ffffffa918', 'Admin', 'admin,user,author', 'http://ns414171.ip-37-187-143.eu/img/cms/shutterstock_67043077.jpg'),
(4, 'misko.hevery@gmail.com', '15ffffffe2ffffffb0ffffffd3ffffffc338ffffff91ffffffebffffffb0fffffff1ffffffef60ffffff9effffffc419420c20ffffffe320ffffffceffffff94ffffffc65fffffffbcffffff8c331244ffffff8effffffb225', 'Miško Hevery', 'author', 'http://img0.mxstatic.com/wallpapers/d40ec85e419a7cf211add7540bab50c5_large.jpeg'),
(5, 'pete.bacon@gmail.com', '15ffffffe2ffffffb0ffffffd3ffffffc338ffffff91ffffffebffffffb0fffffff1ffffffef60ffffff9effffffc419420c20ffffffe320ffffffceffffff94ffffffc65fffffffbcffffff8c331244ffffff8effffffb225', 'Pete Bacon Darwin', 'author', 'http://www.drinkamara.com/wp-content/uploads/2015/03/bacon_blog_post.jpg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_message_user1_idx` (`idUser`),
  ADD KEY `fk_message_projet1_idx` (`idProjet`),
  ADD KEY `fk_message_message1_idx` (`idFil`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom_UNIQUE` (`nom`),
  ADD KEY `fk_projet_user1_idx` (`idClient`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tache_useCase1_idx` (`codeUseCase`);

--
-- Index pour la table `usecase`
--
ALTER TABLE `usecase`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `usecase`
--
ALTER TABLE `usecase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
