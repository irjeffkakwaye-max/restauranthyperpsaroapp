-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 13 avr. 2026 à 14:50
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `restaurant_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password_hash`, `created_at`) VALUES
(1, 'Jeff BMS', '$2y$10$FGNyVfaW9rKCeOfIlsf17uihVrccu/lHGf6oBqE4Nfza/jAs/S8RK', '2026-04-13 10:37:28'),
(3, 'joseph@gmail.com', '$2y$10$yCen2mzEo5tO93SQhAURyuAFMxoTr0UcJ//5Qntk4mjOOM.trI95y', '2026-04-13 10:39:57');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `ID_Client` int(11) NOT NULL,
  `Nom` varchar(100) DEFAULT NULL,
  `Telephone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`ID_Client`, `Nom`, `Telephone`) VALUES
(1, 'Jean Dupont', '0991234567'),
(2, 'Marie Lemaire', '0819876543'),
(3, 'Patrick Mbayo', '0825554444'),
(4, 'jeff', '45465655775'),
(5, 'jeff b', '45465655775'),
(6, 'jeff', '45465655775'),
(7, 'jeff b', '45465655775');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `ID_Commande` int(11) NOT NULL,
  `id_resa` int(11) DEFAULT NULL,
  `id_menu` varchar(100) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`ID_Commande`, `id_resa`, `id_menu`, `quantite`) VALUES
(1, 1, 'Poulet rôti', 2),
(2, 2, 'Pizza Margherita', 3),
(3, 3, 'Poisson grillé', 1),
(4, 1, '3', 2),
(5, 1, '3', 2);

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
  `ID_Menu` int(11) NOT NULL,
  `NomPlat` varchar(100) NOT NULL,
  `Prix` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`ID_Menu`, `NomPlat`, `Prix`) VALUES
(1, 'Poulet rôti', 12.50),
(2, 'Poisson grillé', 15.00),
(3, 'Pizza Margherita', 10.00),
(4, 'Salade César', 8.50);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `ID_Resa` int(11) NOT NULL,
  `DateResa` date DEFAULT NULL,
  `Heure` time DEFAULT NULL,
  `ID_Client` int(11) DEFAULT NULL,
  `ID_Table` int(11) DEFAULT NULL,
  `NbPersonnes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`ID_Resa`, `DateResa`, `Heure`, `ID_Client`, `ID_Table`, `NbPersonnes`) VALUES
(1, '2026-04-15', '19:00:00', 1, 1, 2),
(2, '2026-04-16', '20:30:00', 2, 2, 4),
(3, '2026-04-17', '18:45:00', 3, 1, 3),
(4, '2026-04-02', '23:24:00', 4, 1, 1),
(5, '2026-04-02', '23:32:00', 5, 1, 1),
(6, '2026-04-02', '23:24:00', 6, 1, 1),
(7, '2026-04-02', '23:32:00', 7, 1, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID_Client`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`ID_Commande`),
  ADD KEY `id_resa` (`id_resa`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ID_Menu`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ID_Resa`),
  ADD KEY `ID_Client` (`ID_Client`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `ID_Client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `ID_Commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
  MODIFY `ID_Menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ID_Resa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`id_resa`) REFERENCES `reservation` (`ID_Resa`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`ID_Client`) REFERENCES `client` (`ID_Client`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
