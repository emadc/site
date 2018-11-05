-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 31 Octobre 2018 à 17:46
-- Version du serveur :  5.7.24-0ubuntu0.18.04.1
-- Version de PHP :  7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `site`
--

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `id_routes` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `date_modif` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `route` varchar(255) DEFAULT NULL,  
  `item_text` varchar(255) NOT NULL,
  `item_link` varchar(255) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `param_type` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `menu` tinyint(1) DEFAULT '0',
  `visible` tinyint(1) DEFAULT '1',
  `editable` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
--
-- Contenu de la table `pages`
--

INSERT INTO `pages` (`id`, `id_routes`, `title`, `text`, `image`, `link`, `date_modif`) VALUES
(1, 2, 'welcame', 'welcame welcame welcame welcame welcame welcame welcame welcame ', 'welcame.png', 'welcame_link', '2018-11-05 09:03:17'),
(2, 3, 'bottom', 'bottom bottom bottom bottom bottom bottom bottom bottom ', 'bottom.jpg', 'bottom_link', '2018-11-05 09:05:08');

--
-- Contenu de la table `routes`
--

INSERT INTO `routes` (`id`, `route`, `item_text`, `item_link`, `controller`, `method`, `param_type`, `area`, `role`, `parent`, `menu`, `visible`, `editable`) VALUES
(2, 'welcame', 'welcame', NULL, 'Page', 'showPage', 'get', NULL, NULL, NULL, 0, 0, 1),
(3, 'bottom', 'bottom', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1),
(4, 'protect', 'protect', NULL, 'Page', 'showProtected', 'get', 'PRIVATE', 'ADMIN', NULL, 0, 1, 1),
(5, NULL, 'Home', 'index.php', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1);