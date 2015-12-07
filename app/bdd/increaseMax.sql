-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 07 Décembre 2015 à 11:07
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `increase`
--

-- --------------------------------------------------------

--
-- Structure de la table `acl`
--

CREATE TABLE IF NOT EXISTS `acl` (
  `id` int(11) NOT NULL,
  `idTypeUser` int(11) NOT NULL,
  `idRessource` int(11) NOT NULL,
  `idOperation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `acl`
--

INSERT INTO `acl` (`id`, `idTypeUser`, `idRessource`, `idOperation`) VALUES
(0, 2, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE IF NOT EXISTS `operation` (
  `id` int(11) NOT NULL,
  `operation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `operation`
--

INSERT INTO `operation` (`id`, `operation`) VALUES
(0, 'read'),
(1, 'write');

-- --------------------------------------------------------

--
-- Structure de la table `ressource`
--

CREATE TABLE IF NOT EXISTS `ressource` (
  `id` int(11) NOT NULL,
  `libelle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ressource`
--

INSERT INTO `ressource` (`id`, `libelle`) VALUES
(0, 'Users');

-- --------------------------------------------------------

--
-- Structure de la table `typeuser`
--

CREATE TABLE IF NOT EXISTS `typeuser` (
  `id` int(11) NOT NULL,
  `libelle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `typeuser`
--

INSERT INTO `typeuser` (`id`, `libelle`) VALUES
(0, 'admin'),
(1, 'author'),
(2, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `identite` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `idTypeUser` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `mail`, `password`, `identite`, `image`, `idTypeUser`) VALUES
(1, 'jcheron@kobject.net', '$2y$10$1podjrx6s6NeMMU97kO9ieO9E4MGg/JIllmjhaIzXD8uj9wayd5HW', 'JC HERON', '', 0),
(2, 'igor.minar@gmail.com', '$2y$10$1jAl.Hii8J1jqgtMYDDFl.SC.eq9PrkMaLsQzFoC10PuCUdWiQB7S', 'Igor MINAR', '', 1),
(3, 'admin@local.fr', '$2y$10$h/kYGan/D464AYnGb7kIJOfdxr.lIRi4Xs3FLZL3pCk/bzEfRMLSa', 'Admin', '', 0),
(4, 'misko.hevery@gmail.com', '$2y$10$A1DZxj8ku./r1zdEGId2ze8wcvY1WeVpLf52ctk/5pt9Eu7tqysSO', 'Miško Hevery', '', 1),
(5, 'pete.bacon@gmail.com', '$2y$10$HeVuKkXRC1i3gLxMcd/k8us09AVaKVMyQCoa4qFD08BrZoblVPVWG', 'Pete Bacon Darwin', '', 2),
(7, 'moi2@kobject.net', '$2y$10$fQrpTJdf3qKYrbEoPiA0uOpy9b4FTsDcWRPqP68940q.15wFA6/wW', 'Moideux AZERTYUIOP', '', 2),
(8, 'moi3@kobject.net', '$2y$10$Pn1l.MHAWWfXROi0QcjUY.izuaBa9O4duEl4FrZOKalsLX1vqj2L2', 'Moitrois AZERTYUIOP', '', 2),
(9, 'moi4@kobject.net', '$2y$10$Np601n8MVQHHPO.XndXUzOedZUWKvW2rb/p90KPn0oLc3nYdNbFum', 'Moiquatre AZERTYUIOP', '', 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `acl`
--
ALTER TABLE `acl`
 ADD PRIMARY KEY (`id`), ADD KEY `idRessource` (`idRessource`), ADD KEY `idOperation` (`idOperation`), ADD KEY `idTypeUser` (`idTypeUser`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ressource`
--
ALTER TABLE `ressource`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeuser`
--
ALTER TABLE `typeuser`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `mail_UNIQUE` (`mail`), ADD KEY `idTypeUser` (`idTypeUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `acl`
--
ALTER TABLE `acl`
ADD CONSTRAINT `acl_ibfk_2` FOREIGN KEY (`idRessource`) REFERENCES `ressource` (`id`),
ADD CONSTRAINT `acl_ibfk_3` FOREIGN KEY (`idOperation`) REFERENCES `operation` (`id`),
ADD CONSTRAINT `acl_ibfk_4` FOREIGN KEY (`idTypeUser`) REFERENCES `typeuser` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idTypeUser`) REFERENCES `typeuser` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
