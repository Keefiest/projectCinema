-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour cinemahmed
CREATE DATABASE IF NOT EXISTS `cinemahmed` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `cinemahmed`;

-- Listage de la structure de la table cinemahmed. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(20) COLLATE utf8_bin NOT NULL,
  `sexe` varchar(6) COLLATE utf8_bin NOT NULL,
  `date_naissance` date NOT NULL,
  `photo` text COLLATE utf8_bin,
  PRIMARY KEY (`id_acteur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinemahmed.acteur : ~7 rows (environ)
DELETE FROM `acteur`;
/*!40000 ALTER TABLE `acteur` DISABLE KEYS */;
INSERT INTO `acteur` (`id_acteur`, `nom`, `prenom`, `sexe`, `date_naissance`, `photo`) VALUES
	(1, 'Maguire', 'Tobey', 'Homme', '1975-06-27', 'https://fr.web.img6.acsta.net/c_310_420/pictures/15/09/18/11/52/030640.jpg'),
	(2, 'Dafoe', 'Willem', 'Homme', '1955-07-22', 'https://fr.web.img3.acsta.net/pictures/19/05/21/11/46/2788235.jpg'),
	(3, 'Eastwood', 'Clint', 'Homme', '1930-05-31', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/07/ClintEastwoodCannesMay08.jpg/640px-ClintEastwoodCannesMay08.jpg'),
	(4, 'Pattinson', 'Robert', 'Homme', '1986-05-13', 'https://www.grazia.fr/wp-content/uploads/grazia/2022/02/robert-pattinson-cheveux-peroxydes-tatoue-est-meconnaissable-0-jjpg-jpg-scaled.jpg'),
	(5, 'Kravitz', 'Zoe', 'Femme', '1988-12-01', 'https://fr.web.img5.acsta.net/pictures/20/01/07/12/54/3975258.jpg'),
	(6, 'Bale', 'Christian', 'Homme', '1974-01-30', 'https://fr.web.img6.acsta.net/c_310_420/pictures/19/01/22/16/22/0699464.jpg'),
	(7, 'Freeman', 'Morgan', 'Homme', '1937-05-01', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e4/Morgan_Freeman_Deauville_2018.jpg/260px-Morgan_Freeman_Deauville_2018.jpg');
/*!40000 ALTER TABLE `acteur` ENABLE KEYS */;

-- Listage de la structure de la table cinemahmed. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `id_film` int(11) NOT NULL,
  `id_acteur` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  PRIMARY KEY (`id_film`,`id_acteur`,`id_role`),
  KEY `id_acteur` (`id_acteur`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `casting_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `casting_ibfk_2` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `casting_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinemahmed.casting : ~7 rows (environ)
DELETE FROM `casting`;
/*!40000 ALTER TABLE `casting` DISABLE KEYS */;
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 1, 1),
	(2, 1, 1),
	(1, 2, 2),
	(4, 3, 5),
	(5, 4, 3),
	(5, 5, 4),
	(6, 6, 3);
/*!40000 ALTER TABLE `casting` ENABLE KEYS */;

-- Listage de la structure de la table cinemahmed. contient
CREATE TABLE IF NOT EXISTS `contient` (
  `id_film` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL,
  PRIMARY KEY (`id_film`,`id_genre`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `contient_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `contient_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinemahmed.contient : ~7 rows (environ)
DELETE FROM `contient`;
/*!40000 ALTER TABLE `contient` DISABLE KEYS */;
INSERT INTO `contient` (`id_film`, `id_genre`) VALUES
	(1, 1),
	(2, 1),
	(5, 1),
	(1, 2),
	(2, 2),
	(3, 3),
	(4, 4);
/*!40000 ALTER TABLE `contient` ENABLE KEYS */;

-- Listage de la structure de la table cinemahmed. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) COLLATE utf8_bin NOT NULL,
  `date_sortie` date NOT NULL,
  `duree` int(11) NOT NULL DEFAULT '0',
  `synopsis` text COLLATE utf8_bin NOT NULL,
  `note` int(11) NOT NULL DEFAULT '0',
  `affiche` text COLLATE utf8_bin,
  `id_realisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_realisateur` (`id_realisateur`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinemahmed.film : ~7 rows (environ)
DELETE FROM `film`;
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
INSERT INTO `film` (`id_film`, `titre`, `date_sortie`, `duree`, `synopsis`, `note`, `affiche`, `id_realisateur`) VALUES
	(1, 'Spiderman 1', '2002-06-12', 121, 'Orphelin, Peter Parker est élevé par sa tante May et son oncle Ben dans le quartier Queens de New York. Tout en poursuivant ses études à l\'université, il trouve un emploi de photographe au journal Daily Bugle. Il partage son appartement avec Harry Osborn, son meilleur ami, et rêve de séduire la belle Mary Jane.', 5, 'https://fr.web.img5.acsta.net/medias/nmedia/00/00/00/33/spiderman.jpg', 1),
	(2, 'Spiderman 2', '2004-07-14', 136, 'Ecartelé entre son identité secrète de Spider-Man et sa vie d\'étudiant, Peter Parker n\'a pas réussi à garder celle qu\'il aime, Mary Jane, qui est aujourd\'hui comédienne et fréquente quelqu\'un d\'autre. Guidé par son seul sens du devoir, Peter vit désormais chacun de ses pouvoirs à la fois comme un don et comme une malédiction.', 4, 'https://fr.web.img4.acsta.net/medias/nmedia/18/35/16/02/18380826.jpg', 5),
	(3, 'Les Evadés', '1995-03-01', 141, 'Red, condamné à perpétuité, et Andy Dufresne, un gentil banquier injustement condamné pour meurtre, se lient d\'une amitié inattendue qui va durer plus de vingt ans. Ensemble, ils découvrent l\'espoir comme l\'ultime moyen de survie. Sous des conditions terrifiantes et la menace omniprésente de la violence, les deux condamnés à perpétuité récupèrent leurs âmes et retrouvent la liberté dans leurs cœurs.', 5, 'https://fr.web.img3.acsta.net/medias/nmedia/18/63/30/68/18686447.jpg', 2),
	(4, 'Unforgiven', '1992-09-12', 131, 'Kansas 1880. William Munny, redoutable hors-la-loi reconverti dans l\'élevage va, à la demande d\'un jeune tueur, reprendre du service pour venger une prostituée défigurée par un cow-boy sadique.', 4, 'https://m.media-amazon.com/images/M/MV5BODM3YWY4NmQtN2Y3Ni00OTg0LWFhZGQtZWE3ZWY4MTJlOWU4XkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_.jpg', 3),
	(5, 'The Batman', '2022-03-02', 173, 'Deux années à arpenter les rues en tant que Batman et à insuffler la peur chez les criminels ont mené Bruce Wayne au coeur des ténèbres de Gotham City. Avec seulement quelques alliés de confiance - Alfred Pennyworth, le lieutenant James Gordon - parmi le réseau corrompu de fonctionnaires et de personnalités de la ville, le justicier solitaire s\'est imposé comme la seule incarnation de la vengeance parmi ses concitoyens. Lorsqu\'un tueur s\'en prend à l\'élite de Gotham par une série de machinations sadiques, une piste d\'indices cryptiques envoie le plus grand détective du monde sur une enquête dans la pègre, où il rencontre des personnages tels que Selina Kyle, alias Catwoman, Oswald Cobblepot, alias le Pingouin, Carmine Falcone et Edward Nashton, alias l’Homme-Mystère. Alors que les preuves s’accumulent et que l\'ampleur des plans du coupable devient clair, Batman doit forger de nouvelles relations, démasquer le coupable et rétablir un semblant de justice au milieu de l’abus de pouvoir et de corruption sévissant à Gotham City depuis longtemps.', 4, 'https://fr.web.img5.acsta.net/pictures/22/02/16/17/42/3125788.jpg', 4),
	(6, 'The Dark Knight Rises', '2012-06-20', 164, 'Il y a huit ans, Batman a disparu dans la nuit : lui qui était un héros est alors devenu un fugitif. S\'accusant de la mort du procureur-adjoint Harvey Dent, le Chevalier Noir a tout sacrifié au nom de ce que le commissaire Gordon et lui-même considéraient être une noble cause. Et leurs actions conjointes se sont avérées efficaces pour un temps puisque la criminalité a été éradiquée à Gotham City grâce à l\'arsenal de lois répressif initié par Dent.', 5, 'https://fr.web.img6.acsta.net/c_310_420/medias/nmedia/18/83/56/27/20158098.jpg', 1),
	(8, 'El Camino', '2019-10-11', 122, '&Agrave; la suite de sa tragique &eacute;vasion, Jesse doit accepter son pass&eacute; s&#039;il veut se construire un avenir... ou quelque chose qui y ressemble plus ou moins.\r\n\r\nUn film qui fait suite au final de la s&eacute;rie Breaking Bad, suivant les aventures de Jesse Pinkman ...', 4, 'https://fr.web.img3.acsta.net/c_310_420/pictures/19/09/24/17/24/4667551.jpg', 6);
/*!40000 ALTER TABLE `film` ENABLE KEYS */;

-- Listage de la structure de la table cinemahmed. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `nom_genre` varchar(15) COLLATE utf8_bin NOT NULL,
  `desc_genre` text COLLATE utf8_bin,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinemahmed.genre : ~5 rows (environ)
DELETE FROM `genre`;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` (`id_genre`, `nom_genre`, `desc_genre`) VALUES
	(1, 'Science Fiction', ' Comme son nom l\'indique, elle consiste à raconter des fictions reposant sur des progrès scientifiques et techniques obtenus dans un futur plus ou moins lointain (il s\'agit alors également d\'anticipation), parfois dans un passé fictif1 ou dans un univers parallèle au nôtre, ou des progrès physiquement impossibles, du moins en l\'état actuel de nos connaissances. Elle met ainsi en œuvre les thèmes devenus classiques du voyage dans le temps, du voyage interplanétaire ou interstellaire, de la colonisation de l\'espace, de la rencontre avec des extra-terrestres, de la confrontation entre l\'espèce humaine et ses créations, notamment les robots et les clones, ou de la catastrophe apocalyptique planétaire.'),
	(2, 'Action', 'Le film d\'action est un genre cinématographique qui met en scène une succession de scènes spectaculaires souvent stéréotypées (courses-poursuites, fusillades, explosions…) construites autour d\'un conflit résolu de manière violente, généralement par la mort des ennemis du héros.'),
	(3, 'Drame', 'Le drame est un genre cinématographique qui traite des situations généralement non épiques dans un contexte sérieux, sur un ton plus susceptible d\'inspirer la tristesse que le rire. Néanmoins, le drame évoque étymologiquement l\'action. Il a regagné récemment la popularité dans beaucoup de pays du monde (Prison Break, Dr House). Généralement, un drame repose sur un scénario abordant avec le moins d\'humour possible un thème grave (la mort, la misère, le viol, la toxicomanie…) qui peut être douloureux, révoltant ; une injustice. Il peut s’inspirer de l\'histoire (avec des thèmes comme la Seconde Guerre mondiale comme dans Elle s\'appelait Sarah) ou de l\'actualité comme dans Lion. '),
	(4, 'Western', 'Le western est un genre cinématographique dont l\'action se déroule généralement en Amérique du Nord, plus spécialement aux États-Unis, lors de la conquête de l\'Ouest dans les dernières décennies du xixe siècle. Ce sous-genre du film historique apparaît dès l\'invention du peinture prenant pour sujet l\'Ouest américain.'),
	(5, 'Thriller', 'Le thriller (anglicisme, de &laquo; to thrill &raquo; : faire fr&eacute;mir) est un genre artistique utilisant le suspense ou la tension narrative pour provoquer chez le lecteur ou le spectateur une excitation ou une appr&eacute;hension et le tenir en haleine jusqu&#039;au d&eacute;nouement de l&#039;intrigue');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;

-- Listage de la structure de la table cinemahmed. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(20) COLLATE utf8_bin NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` varchar(6) COLLATE utf8_bin NOT NULL,
  `photo` text COLLATE utf8_bin,
  PRIMARY KEY (`id_realisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinemahmed.realisateur : ~6 rows (environ)
DELETE FROM `realisateur`;
/*!40000 ALTER TABLE `realisateur` DISABLE KEYS */;
INSERT INTO `realisateur` (`id_realisateur`, `nom`, `prenom`, `date_naissance`, `sexe`, `photo`) VALUES
	(1, 'Raimi', 'Sam', '1959-10-23', 'Homme', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Sam_Raimi_by_Gage_Skidmore_2.jpg/1200px-Sam_Raimi_by_Gage_Skidmore_2.jpg'),
	(2, 'Darabont', 'Frank', '1959-01-28', 'Homme', 'https://club-stephenking.fr/wp-content/uploads/2021/11/frankdarabont.jpg'),
	(3, 'Eastwood', 'Clint', '1930-05-31', 'Homme', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/07/ClintEastwoodCannesMay08.jpg/640px-ClintEastwoodCannesMay08.jpg'),
	(4, 'Reeves', 'Matt', '1966-04-27', 'Homme', 'https://m.media-amazon.com/images/M/MV5BYmM5NTA4ZGMtMGJhYy00YzlhLThlM2QtZjFjY2Y5YmJjOTE2XkEyXkFqcGdeQXVyNzg5MzIyOA@@._V1_UY1200_CR84,0,630,1200_AL_.jpg'),
	(5, 'Nolan', 'Christopher', '1970-06-30', 'Homme', 'https://fr.web.img5.acsta.net/c_310_420/pictures/14/10/30/10/59/215487.jpg'),
	(6, 'Gilligan', 'Vince', '1967-02-10', 'Homme', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e2/Vince_Gilligan_by_Gage_Skidmore_3.jpg/220px-Vince_Gilligan_by_Gage_Skidmore_3.jpg');
/*!40000 ALTER TABLE `realisateur` ENABLE KEYS */;

-- Listage de la structure de la table cinemahmed. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(20) COLLATE utf8_bin NOT NULL,
  `desc_role` text COLLATE utf8_bin,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinemahmed.role : ~6 rows (environ)
DELETE FROM `role`;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id_role`, `nom_role`, `desc_role`) VALUES
	(1, 'Spiderman', 'Peter Parker, alias Spider-Man est un super-héros évoluant dans l\'univers Marvel de la maison d\'édition Marvel Comics. Créé par le scénariste Stan Lee et le dessinateur Steve Ditko, le personnage de fiction apparaît pour la première fois dans le comic book Amazing Fantasy (vol. 1) #15 en août 1962.'),
	(2, 'Bouffon Vert', 'Norman Osborn, alias le Bouffon vert ou le Gobelin vert au Québec (« Green Goblin » en VO) est un super-vilain évoluant dans l\'univers Marvel de la maison d\'édition Marvel Comics. Créé par le scénariste Stan Lee et le dessinateur Steve Ditko, le personnage de fiction apparaît pour la première fois dans le comic book Amazing Spider-Man (vol. 1) #14 en juillet 1964.'),
	(3, 'Batman', 'Bruce Wayne, alias Batman, est un super-héros de fiction appartenant à l\'univers de DC Comics. Créé par le dessinateur Bob Kane et le scénariste Bill Finger, il apparaît pour la première fois dans le comic book Detective Comics no 27 en 1939 - mai 1939 comme date sur la couverture mais la date réelle de parution est le 30 mars 1939 - sous le nom de The Bat-Man. '),
	(4, 'Catwoman', 'Catwoman alias Selina Kyle est un personnage de fiction de l\'Univers DC. Créée par Bill Finger et Bob Kane, elle apparaît pour la première fois dans le comic book Batman #1 en 1940.'),
	(5, 'William Munny', 'William Munny, redoutable hors-la-loi reconverti dans l\'élevage va, à la demande d\'un jeune tueur, reprendre du service pour venger une prostituée défigurée par un cow-boy sadique.'),
	(6, 'Le Pingouin', 'Oswald Chesterfield Cobblepot, dit le Pingouin, est un super-vilain de l&#039;univers de DC Comics et un opposant r&eacute;current de Batman. Cr&eacute;&eacute; par Bill Finger et Bob Kane, il appara&icirc;t pour la premi&egrave;re fois dans Detective Comics #58 en d&eacute;cembre 1941.');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
