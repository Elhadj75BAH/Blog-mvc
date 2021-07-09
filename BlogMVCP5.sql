-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 09 juil. 2021 à 22:40
-- Version du serveur :  8.0.25-0ubuntu0.20.04.1
-- Version de PHP : 7.2.34-8+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `BlogMVCP5`
--

-- --------------------------------------------------------

--
-- Structure de la table `BlogPost`
--

CREATE TABLE `BlogPost` (
  `ID` int NOT NULL,
  `Titre` varchar(80) NOT NULL,
  `Image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Contenu` longtext NOT NULL,
  `Chapo` varchar(80) NOT NULL,
  `Date_creation` datetime NOT NULL,
  `Auteur` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `BlogPost`
--

INSERT INTO `BlogPost` (`ID`, `Titre`, `Image`, `Contenu`, `Chapo`, `Date_creation`, `Auteur`) VALUES
(6, 'MVC', '', 'Cet événement se déclenche après l\'affichage d\'un nouvel onglet (et donc l\'onglet actif précédent est masqué). Utilisez event.targetet event.relatedTargetpour cibler respectivement l\'onglet actif précédent et le nouvel onglet actif.', 'chapo', '2021-06-24 14:09:00', 'Elhadj'),
(7, 'PHP', '', 'Cet événement se déclenche après l\'affichage d\'un nouvel onglet (et donc l\'onglet actif précédent est masqué). Utilisez event.targetet event.relatedTargetpour cibler respectivement l\'onglet actif précédent et le nouvel onglet actif.', 'php mvc', '2021-06-23 17:10:00', 'Elhadj'),
(9, 'SYMFONY', '', 'Symfony est un ensemble de composants PHP ainsi qu\'un framework MVC libre écrit en PHP. Il fournit des fonctionnalités modulables et adaptables qui permettent de faciliter et d’accélérer le développement d\'un site web. (Wikipédia)', 'framework MVC libre écrit en PHP', '2021-06-27 15:08:00', 'Elhadj'),
(10, 'PHP 8', '', 'HP: Hypertext Preprocessor, plus connu sous son sigle PHP, est un langage de programmation libre, principalement utilisé pour produire des pages Web dynamiques via un serveur HTTP, mais pouvant également fonctionner comme n\'importe quel langage interprété de façon locale. PHP est un langage impératif orienté objet', 'Php 8 est écrit en C', '2021-06-24 14:13:00', 'Elhadj'),
(13, 'React JS', '', 'React est une bibliothèque JavaScript libre développée par Facebook depuis 2013. Le but principal de cette bibliothèque est de faciliter la création d\'application web monopage, via la création de composants dépendant d\'un état et générant une page HTML à chaque changement d\'état. \r\nProgrammé en : JavaScript\r\n(Wikipédia)', 'Bibliothèque', '2021-06-26 10:01:00', 'Elhadj'),
(14, 'LMS Moodle', '', 'Moodle est une plateforme d\'apprentissage en ligne libre distribuée sous la Licence publique générale GNU écrite en PHP. Développée à partir de principes pédagogiques, elle permet de créer des communautés s\'instruisant autour de contenus et d\'activités. Wikipédia', 'e-learning', '2021-06-27 14:01:00', 'Elhadj');

-- --------------------------------------------------------

--
-- Structure de la table `Commentaires`
--

CREATE TABLE `Commentaires` (
  `id` int NOT NULL,
  `contenu` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Date_creation` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `article_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `Commentaires`
--

INSERT INTO `Commentaires` (`id`, `contenu`, `Date_creation`, `status`, `article_id`, `user_id`) VALUES
(67, '  first comment', '2021-06-25 23:52:16', 0, 9, 21),
(70, 'Moodle pas vraiment fan :-)   ', '2021-06-28 10:51:44', 1, 14, 21),
(115, '  Au top Merci  !!', '2021-07-09 22:32:56', 1, 9, 22);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `id` int NOT NULL,
  `nom` varchar(80) NOT NULL,
  `prenom` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(80) NOT NULL,
  `motdepasse` varchar(80) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`id`, `nom`, `prenom`, `email`, `motdepasse`, `admin`) VALUES
(21, 'BAH', 'Elhadj ', 'admin@admin.com', '$2y$10$n0Wuzzai4jPCDmORbyQqJ.ORdRHVJap2xvdBOdqJyOrZMu6qQs4M2', 2),
(22, 'Diallo ', 'Zarry', 'test@test.com', '$2y$10$6SF5LUclXJjQvC4f7XQvDuygihpAXSj5pTCPDOTnt/dIoVGS3M8TG', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `BlogPost`
--
ALTER TABLE `BlogPost`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Commentaires`
--
ALTER TABLE `Commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `BlogPost`
--
ALTER TABLE `BlogPost`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `Commentaires`
--
ALTER TABLE `Commentaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Commentaires`
--
ALTER TABLE `Commentaires`
  ADD CONSTRAINT `Commentaires_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Commentaires_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `BlogPost` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
