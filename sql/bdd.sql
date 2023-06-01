-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour gametest9
CREATE DATABASE IF NOT EXISTS `gametest9` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `gametest9`;

-- Listage de la structure de table gametest9. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table gametest9.categorie : ~3 rows (environ)
INSERT INTO `categorie` (`id`, `name`) VALUES
	(1, 'Minecraft'),
	(2, 'GTA5'),
	(6, 'Dofus');

-- Listage de la structure de table gametest9. t_server
CREATE TABLE IF NOT EXISTS `t_server` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `vote` int NOT NULL,
  `img` varchar(255) NOT NULL,
  `subscribe` int NOT NULL,
  `discord` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_categorie` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `t_server_user_FK` (`id_user`),
  KEY `t_server_categorie0_FK` (`id_categorie`),
  CONSTRAINT `t_server_categorie0_FK` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`),
  CONSTRAINT `t_server_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table gametest9.t_server : ~6 rows (environ)
INSERT INTO `t_server` (`id`, `name`, `description`, `vote`, `img`, `subscribe`, `discord`, `link`, `ip`, `id_user`, `id_categorie`) VALUES
	(1, 'OneBlock', '⭐ OneBlockFrance  ⭐OneBlock ✔ ⭐ Survie ✔⭐ Farm2Win⭐  Ouvert aux cracks ✔ ⭐ Staff à l\'écoute ⭐ Une bonne communauté ⭐ 1.17.1 - 1.19+ ⭐ On vous attends, rejoignez-nous ! ⭐ (T)chat agréable et bonne entente ! ⭐', 9036, 'https://serveur-minecraft-vote.fr/storage/medias/0/0/3/367/oSdAi6rXWAPHxoW1AkUc.png', 1, 'https://discord.gg', 'oneblockfrance.fr', 'oneblockfrance.fr', 2, 1),
	(2, 'FrenchSky', 'SKYBLOCK CAPITALISTE Farm2Win 1.19.2 | MC.FRENCHSKY.NET 5 ans d\'expérience -Economie travaillée - Entreprises - Usines - Commerce - Farming - Items légendaires - Pets Version 2, ouvert depuis Aout! Rejoins nous et tente ta chance sur ton île FrenchSky, remplis les défis les uns après les autres, amasse richesse et notoriété, monte en grades et deviens le meilleur joueur du serveur !', 6200, 'https://serveur-minecraft-vote.fr/storage/medias/0/0/0/70/fgcEeY1GxeKHSPn27uWC.jpg', 1, 'https://discord.gg', 'serveurvote.frenchsky.net', 'serveurvote.frenchsky.net', 2, 1),
	(3, 'EuroCraft', 'EuroCraft est un serveur Pvp Faction unique en son genre! De nouvelles armes, outils et même armures sont ce qui fait l\'originalité du serveur', 556, 'https://serveur-minecraft-vote.fr/storage/medias/0/2/22/2237/GrACqFYQB98eeKM0ptt6.png', 1, 'https://discord.gg', 'play.euracraft.fr', 'play.euracraft.fr', 1, 1),
	(4, 'SurvivalWorld', 'SurvivalWorld est l\'endroit parfait si vous cherchez un endroit où créer votre aventure Minecraft ! Seul ou entre amis, accomplissez les quêtes, grimpez les échelons de vos métiers favoris mais attention à la pêche qui est plus qu\'addictive grâce à son système complet, vous êtes prévenus. Repoussez vos limites pour tenter d\'obtenir de nouveaux items qui regorgent d\'histoire, avec des enchantements spéciaux qui les rendent tous aussi délirants les uns que les autres !', 7003, 'https://serveur-minecraft-vote.fr/storage/medias/0/0/3/347/01JDDC72aGFpsn9k2RCd.png', 1, 'https://discord.gg', 'play.survivalWorld.fr', 'play.survivalWorld.fr', 2, 1),
	(9, 'Lost Legacy', 'Le serveur "Lost Legacy" ouvre ces portes !  Serveur RPG/FANTASY (Classe, montures, familiers, donjons, boss, etc...)  - Nouveaux items, nouveaux mobs, etc - Plus de 1000h+ de contenues - Grades - Boss/Donjons - Système de pêche amélioré - Système de minage amélioré - Event (Pinata, largage, concours de pêche, etc...) - Economie et système de vente  Venez nombreux vous amusez parmi nous ! :D', 1, 'https://serveur-minecraft-vote.fr/storage/medias/0/1/11/1118/q6vU1D6qwS37RZ83vSAV.png', 0, 'Lostlegacy.fr', 'Lostlegacy.fr', 'Lostlegacy.fr', 2, 1),
	(10, 'ARCADIA 2.66', 'Arcadia est basé sur le Gameplay du mythique serveur Arkalys, des améliorations et nouveautés sont évidemment de la partie !', 0, 'https://serveur-prive.net/template/img/thumb/3aaa8ca872cd50936e4d08c52c0c94bf.png', 0, 'arcadiagame.com', 'https://arcadia-game.com/', 'arcadia-game.com/', 2, 2);

-- Listage de la structure de table gametest9. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table gametest9.user : ~0 rows (environ)
INSERT INTO `user` (`id`, `username`, `email`, `password`, `permission`) VALUES
	(1, 'alphacast', 'alpha@gmail.com', 'me', 0),
	(2, 'Bastien_Life', 'brapaud13008@gmail.com', '4b5a7e8031a9e02cd9c7155949bbcb9e', 1);

-- Listage de la structure de table gametest9. vote
CREATE TABLE IF NOT EXISTS `vote` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `is_activate` int NOT NULL,
  PRIMARY KEY (`id`,`id_user`),
  KEY `vote_user0_FK` (`id_user`),
  CONSTRAINT `vote_t_server_FK` FOREIGN KEY (`id`) REFERENCES `t_server` (`id`),
  CONSTRAINT `vote_user0_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table gametest9.vote : ~4 rows (environ)
INSERT INTO `vote` (`id`, `id_user`, `is_activate`) VALUES
	(1, 2, 1),
	(3, 2, 1),
	(4, 2, 1),
	(9, 2, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
