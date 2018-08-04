-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  sam. 04 août 2018 à 13:28
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

CREATE TABLE `action` (
  `id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime DEFAULT NULL,
  `dateDemande` datetime NOT NULL,
  `estValide` tinyint(1) NOT NULL,
  `estRefuse` tinyint(1) NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commentaire` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `action`
--

INSERT INTO `action` (`id`, `type_id`, `user_id`, `article_id`, `dateDebut`, `dateFin`, `dateDemande`, `estValide`, `estRefuse`, `slug`, `etat`, `commentaire`) VALUES
(2, NULL, 1, 4, '2018-04-27 00:00:00', '2018-04-27 00:00:00', '2018-04-27 23:54:24', 1, 0, 'robe-soiree-2', 'en cours', 'OK'),
(3, NULL, 1, 4, '2018-05-23 11:04:30', NULL, '2018-05-23 11:04:30', 1, 0, 'robe-soiree', 'attente', 'Achat'),
(5, NULL, 1, 4, '2018-05-23 11:15:18', NULL, '2018-05-23 11:15:18', 0, 1, 'robe-soiree2018-05-23', 'refuse', 'Achat'),
(6, NULL, 2, 3, '2018-07-30 00:00:00', '2018-08-14 00:00:00', '2018-07-24 17:34:42', 0, 1, 'veste-mango-originale2018-07-30', 'refuse', ''),
(7, NULL, 2, 3, '2018-07-24 00:00:00', '2018-07-24 00:00:00', '2018-07-24 19:09:47', 1, 0, 'veste-mango-originale2018-07-24', 'attente', ''),
(8, NULL, 2, 5, '2018-07-24 19:23:14', NULL, '2018-07-24 19:23:14', 1, 0, 'sweat-le-fabuleux-shaman2018-07-24', 'attente', 'Achat');

-- --------------------------------------------------------

--
-- Structure de la table `app_user`
--

CREATE TABLE `app_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `localite` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) NOT NULL,
  `porte_feuille` double NOT NULL,
  `roles` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `estAccepte` tinyint(1) NOT NULL,
  `phoneNumber` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `app_user`
--

INSERT INTO `app_user` (`id`, `username`, `password`, `mail`, `date_creation`, `localite`, `points`, `porte_feuille`, `roles`, `estAccepte`, `phoneNumber`) VALUES
(1, 'Natacha', '$2y$13$ArvWto7vMkAA7KWPBisqIee8PQf0uKlgrQxjR6sGnWiRwqfFg//Pa', 'natachasanquer@free.fr', '2018-04-26 19:55:57', 'Nantes', 35, 0, 'ROLE_ADMIN', 1, '0699777500'),
(2, 'test', '$2y$13$uORd1vAUJJYeavsFL3igDuKVk49wOtyEZc8hafydjv3Awqf.f7K3y', 'test@test.fr', '2018-04-27 00:01:56', 'Nantes', 10, 0, 'ROLE_USER', 1, '0000000000');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `taille_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `caution` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `titre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `marque` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `aVendre` tinyint(1) NOT NULL,
  `estArchive` tinyint(1) NOT NULL,
  `estAccepte` tinyint(1) NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `user_id`, `taille_id`, `type_id`, `caution`, `date_creation`, `description`, `titre`, `marque`, `aVendre`, `estArchive`, `estAccepte`, `slug`) VALUES
(3, 1, 3, 21, 75, '2018-04-27 23:51:04', 'veste motif animaux', 'veste mango originale', 'mango', 0, 0, 1, 'veste-mango-originale'),
(4, 2, 3, 24, 35, '2018-04-27 23:52:29', 'parfait pour un gala', 'Robe soirée', 'Naf naf', 1, 0, 1, 'robe-soiree'),
(5, 1, 3, 16, 20, '2018-04-28 16:56:01', 'Sweat hakuna matelas', 'Sweat Le Fabuleux Shaman', 'Le fabuleux Shaman', 1, 0, 1, 'sweat-le-fabuleux-shaman'),
(6, 1, 1, 16, 20, '2018-07-29 19:37:17', 'test', 'Test', 'test', 0, 0, 0, 'test'),
(7, 1, 1, 21, 1, '2018-07-29 19:38:56', 'veste', 'veste', 'veste', 0, 0, 0, 'veste');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `action_id` int(11) DEFAULT NULL,
  `note` int(11) NOT NULL,
  `commentaire` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id`, `user_id`, `article_id`) VALUES
(1, 1, 4),
(2, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `etat_lieu`
--

CREATE TABLE `etat_lieu` (
  `id` int(11) NOT NULL,
  `commentaires` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `url_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `article_id`, `url_image`, `user_id`) VALUES
(2, NULL, 'Natacha.jpeg', 1),
(5, 3, 'veste mango originaleimg_20171118_234825.jpg.jpeg', NULL),
(6, 4, 'Robe soiréeimg_20171118_235329.jpg.jpeg', NULL),
(7, 5, 'Sweat Le Fabuleux Shamanproducts_5267296_image1_medium.jpg.jpeg', NULL),
(8, NULL, 'inconnu.jpeg', 2),
(9, 6, 'Testcoming soon.png.png', NULL),
(10, 7, 'vesteMessage caché.jpg.jpeg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `text` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `conversation_id` int(11) DEFAULT NULL,
  `membre` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `taille`
--

CREATE TABLE `taille` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `taille`
--

INSERT INTO `taille` (`id`, `libelle`) VALUES
(1, 'XXS / 32'),
(2, 'XS / 36'),
(3, 'S / 34'),
(4, 'S/M /38'),
(5, 'M / 40'),
(6, 'L / 42'),
(7, '35'),
(8, '36'),
(9, '37'),
(10, '38'),
(11, '39'),
(12, '40'),
(13, '41');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `libelle`, `points`) VALUES
(13, 'basic', 20),
(14, 'pantalon', 20),
(15, 'jupe', 20),
(16, 'haut', 20),
(18, 'accessoire', 20),
(19, 'robe de tous les jours', 20),
(20, 'sac', 40),
(21, 'veste', 40),
(22, 'chaussures', 40),
(23, 'manteau', 60),
(24, 'robe soirée', 60);

-- --------------------------------------------------------

--
-- Structure de la table `type_action`
--

CREATE TABLE `type_action` (
  `id` int(11) NOT NULL,
  `libelle` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_47CC8C92989D9B62` (`slug`),
  ADD KEY `IDX_47CC8C92C54C8C93` (`type_id`),
  ADD KEY `IDX_47CC8C92A76ED395` (`user_id`),
  ADD KEY `IDX_47CC8C927294869C` (`article_id`);

--
-- Index pour la table `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_88BDF3E9F85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_88BDF3E95126AC48` (`mail`),
  ADD UNIQUE KEY `UNIQ_88BDF3E9E85E83E4` (`phoneNumber`);

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_23A0E66989D9B62` (`slug`),
  ADD KEY `IDX_23A0E66A76ED395` (`user_id`),
  ADD KEY `IDX_23A0E66FF25611A` (`taille_id`),
  ADD KEY `IDX_23A0E66C54C8C93` (`type_id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8F91ABF09D32F035` (`action_id`);

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8A8E26E9A76ED395` (`user_id`),
  ADD KEY `IDX_8A8E26E97294869C` (`article_id`);

--
-- Index pour la table `etat_lieu`
--
ALTER TABLE `etat_lieu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C53D045F996B28` (`url_image`),
  ADD KEY `IDX_C53D045F7294869C` (`article_id`),
  ADD KEY `IDX_C53D045FA76ED395` (`user_id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6BD307F9AC0396` (`conversation_id`);

--
-- Index pour la table `taille`
--
ALTER TABLE `taille`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8CDE5729A4D60759` (`libelle`);

--
-- Index pour la table `type_action`
--
ALTER TABLE `type_action`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_641BE7AAA4D60759` (`libelle`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `action`
--
ALTER TABLE `action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `app_user`
--
ALTER TABLE `app_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `etat_lieu`
--
ALTER TABLE `etat_lieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `taille`
--
ALTER TABLE `taille`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `type_action`
--
ALTER TABLE `type_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `action`
--
ALTER TABLE `action`
  ADD CONSTRAINT `FK_47CC8C927294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_47CC8C92A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`),
  ADD CONSTRAINT `FK_47CC8C92C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type_action` (`id`);

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E66A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`),
  ADD CONSTRAINT `FK_23A0E66C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`),
  ADD CONSTRAINT `FK_23A0E66FF25611A` FOREIGN KEY (`taille_id`) REFERENCES `taille` (`id`);

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF09D32F035` FOREIGN KEY (`action_id`) REFERENCES `action` (`id`);

--
-- Contraintes pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `FK_8A8E26E97294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_8A8E26E9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045F7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_C53D045FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_B6BD307F9AC0396` FOREIGN KEY (`conversation_id`) REFERENCES `conversation` (`id`);
