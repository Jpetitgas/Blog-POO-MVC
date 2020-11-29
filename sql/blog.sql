-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 29 nov. 2020 à 09:00
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `id_post` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `valided` tinyint(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `id_user`, `id_post`, `comment`, `valided`, `date`) VALUES
(105, 1, 41, 'imauve au caramel. Gaufrette danoise de muffin aux prunes et au sucre. Jujubes en poudre jelly-o cake. RÃ©glisse jujubes biscuit pain d\'Ã©pice garniture jujubes sucre prune sucette citron gouttes. GÃ¢teau Ã  la poudre de pÃ¢te d\'amande. Pudding de cannes de bonbon tiramisu. GÃ¢teau barre de chocolat tarte massepain rouleau sucrÃ© jujubes rouleau sucrÃ© griffe d\'ours chocolat. Gummies bonbons griffe d\'ours beignet Ã  la rÃ©glisse douce danois. Nappage de dragÃ©e et guimauve halva.', 1, '2020-11-23 09:25:55'),
(102, 1, 41, 'GÃ¢teau Ã  l\'avoine', 1, '2020-11-21 17:11:02'),
(107, 1, 44, 'Croissant jelly sugar plum dessert tootsie roll. Candy canes halvah gingerbread. Sesame snaps drag&amp;amp;eacute;e apple pie sweet roll biscuit. Jelly-o liquorice icing I love fruitcake I love. Muffin bear claw cake cake marshmallow liquorice I love bonbon. Brownie tart I love caramels cake sweet roll. Brownie marzipan topping jelly beans.&amp;am', 1, '2020-11-23 17:24:28'),
(110, 1, 44, 'dernier commentaire rÃ©digÃ©', 1, '2020-11-28 17:31:56');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `chapo` longtext NOT NULL,
  `content` longtext NOT NULL,
  `author` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_maj` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `chapo`, `content`, `author`, `date`, `date_maj`) VALUES
(41, 'Brownie avoine gÃ¢teau caramel', 'GÃ¢teau Ã  l\'avoine Jujubes GÃ¢teau Ã  la rÃ©glisse Snaps au sÃ©same. GÃ¢teau aux carottes au pouding aux biscuits tarte au citron gouttes. Tarte biscuit gÃ¢teau aux fruits tarte aux caramels crÃ¨me glacÃ©e gelÃ©e de griffe d\'ours.', 'GÃ¢teau aux carottes Ã  la gelÃ©e biscuit en poudre chupa chups halva soufflÃ© halva. Tarte aux pommes au caramel et tarte aux pommes gummi ours gÃ¢teau aux sucettes biscuit gummi ours. GÃ¢teau aux fruits en poudre de prune au sucre. GÃ¢teau tarte au brownie danois halva muffin. GÃ¢teau au chocolat tarte aux guimauves sucette jujubes tarte Ã  la barbe Ã  papa soufflÃ© massepain. GÃ¢teau au chocolat gÃ¢teau aux fruits tarte au brownie gÃ¢teau Ã  l\'avoine. Pouding de gÃ¢teau aux caramels aux fÃ¨ves Ã  la gelÃ©e sucrÃ©es. Pouding soufflÃ© aux caramels de tarte aux pommes. Donut barre de chocolat gÃ¢teau aux carottes gummi ours bonbon cannes de bonbon pain d\'Ã©pice gÃ©latine haricots pÃ¢tisserie.\r\n\r\nIce cream marzipan tootsie roll candy canes chocolate apple pie fruitcake. Chocolate chocolate cake muffin jelly muffin chocolate bar. Gingerbread tootsie roll pie wafer. Sweet marzipan marshmallow sweet roll chupa chups candy dessert dragÃ©e. Pie chocolate cake marzipan jelly. Gummies muffin cupcake. Candy marshmallow donut donut dragÃ©e cookie cake gummi bears gingerbread. Icing topping marzipan sweet roll macaroon cotton candy croissant marshmallow tootsie roll. DragÃ©e halvah wafer ice cream. SoufflÃ© jelly beans sesame snaps powder jelly-o topping jelly. Donut lollipop tiramisu cupcake chocolate bar carrot cake carrot cake cookie. Candy canes liquorice cupcake biscuit danish. DragÃ©e soufflÃ© candy canes biscuit chocolate bar chocolate bar topping.\r\n\r\nDragÃ©e gelÃ©e de gÃ¢teau aux carottes danoises gummies sÃ©same gÃ¢teaux aux carottes danoises. Gummies de pÃ¢tisserie gummies de gÃ¢teau au chocolat. Gouttes de citron brownie Ã  la pÃ¢tisserie. Gummi au pudding Ã  la rÃ©glisse. Donut massepain sucette gelÃ©e haricots croissant carotte gÃ¢teau pÃ¢tisserie. GÃ¢teau aux carottes et au caramel Dessert au gÃ¢teau tiramisu. SÃ©same snaps jujubes bonbons de glaÃ§age beignet. Biscuit Ã  tarte aux biscuits de dessert. Biscuit danois Bonbon. Caramels griffe d\'ours brownie gÃ¢teau aux fruits macaron chupa chups chocolat. Cupcake biscuit gÃ¢teau griffe d\'ours cannes de bonbon sÃ©same snaps gÃ¢teau d\'avoine gÃ¢teau aux carottes en poudre. GelÃ©e de bonbons danois.\r\n\r\nGÃ¢teau au chocolat caramel jujubes beignet de bonbons. Gummi Jelly-o Oat Cake Ours Macaron Donut Sucre Prune. Biscuit barre de chocolat gÃ¢teau Ã  l\'avoine tootsie roll gÃ¢teau de pain d\'Ã©pice crÃ¨me glacÃ©e Ã  la guimauve au caramel. Gaufrette danoise de muffin aux prunes et au sucre. Jujubes en poudre jelly-o cake. RÃ©glisse jujubes biscuit pain d\'Ã©pice garniture jujubes sucre prune sucette citron gouttes. GÃ¢teau Ã  la poudre de pÃ¢te d\'amande. Pudding de cannes de bonbon tiramisu. GÃ¢teau barre de chocolat tarte massepain rouleau sucrÃ© jujubes rouleau sucrÃ© griffe d\'ours chocolat. Gummies bonbons griffe d\'ours beignet Ã  la rÃ©glisse douce danois. Nappage de dragÃ©e et guimauve halva. GÃ¢teau aux biscuits Ã  la crÃ¨me glacÃ©e Ã  la gelÃ©e PÃ¢tisserie jujubes gÃ¢teau au chocolat biscuit gÃ¢teau aux fruits tootsie rouleau sucre prune avoine gÃ¢teau.', 1, '2020-11-21 14:11:42', '2020-11-21 14:11:42'),
(44, ' Cake fruitcake', 'ollipop sweet sweet roll pie cotton candy icing. I love chocolate cotton candy I love cookie. Oat cake oat cake chocolate bar brownie candy canes sugar plum. Apple pie pastry chocolate jujubes.', 'Cake fruitcake lollipop caramels marzipan marshmallow toffee cheesecake drag&amp;eacute;e. Bear claw chupa chups pie. Wafer tiramisu chocolate cake souffl&amp;eacute; &amp;lt;b&amp;gt;sweet sesame snaps&amp;lt;/b&amp;gt; souffl&amp;eacute; sweet roll. Lemon drops I love gummies gummi bears jelly-o souffl&amp;eacute;. Marzipan bear claw oat cake topping topping I love jujubes. Dessert bonbon marshmallow fruitcake tart cupcake marzipan sweet roll. I love cupcake bonbon marzipan fruitcake souffl&amp;eacute; muffin caramels muffin. Biscuit dessert liquorice ice cream lollipop candy canes sweet roll cheesecake. Caramels cookie chocolate cake croissant. Bonbon carrot cake sweet roll souffl&amp;eacute; dessert pudding cotton candy jujubes. Icing lollipop ice cream. Gingerbread carrot cake I love. Jelly chocolate cake I love drag&amp;eacute;e sugar plum. Pudding cookie cake biscuit croissant jujubes marzipan lemon drops apple pie. Cake jelly beans tiramisu jelly-o I love. Donut cookie icing. I love danish tootsie roll topping chocolate bar cheesecake. Chocolate carrot cake gummi bears sweet roll chocolate bar. Biscuit chocolate carrot cake fruitcake oat cake oat cake. Bear claw caramels dessert apple pie apple pie brownie sesame snaps. I love cake cupcake. I love caramels jelly muffin. I love biscuit I love tootsie roll. Oat cake cookie bonbon ice cream tart souffl&amp;eacute;. Tootsie roll I love pie gingerbread tiramisu jelly-o jelly beans wafer. Pudding danish muffin gummies. Cotton candy marshmallow sweet danish bear claw cotton candy topping bonbon bonbon. Icing gummi bears cake pie cotton candy marzipan. Cookie halvah toffee biscuit cheesecake sweet roll cotton candy cake halvah. Sesame snaps cheesecake oat cake gummies sesame snaps. Liquorice tiramisu caramels tart chocolate. Croissant jelly sugar plum dessert tootsie roll. Candy canes halvah gingerbread. Sesame snaps drag&amp;eacute;e apple pie sweet roll biscuit. Jelly-o liquorice icing I love fruitcake I love. Muffin bear claw cake cake marshmallow liquorice I love bonbon. Brownie tart I love caramels cake sweet roll. Brownie marzipan topping jelly beans.&amp;amp;gt;&amp;gt;&amp;gt;&lt;/p&gt;&gt;>>', 1, '2020-11-22 19:10:09', '2020-11-23 17:47:46'),
(45, 'Cupcake ipsum dolor s\'asseoir', 'GÃ¢teau au fromage danois au citron gouttes barre de chocolat gummi porte pain d\'Ã©pice. La garniture de gummi porte des snaps au sÃ©same aux prunes de sucre. GelÃ©e de brownie danoise. GÃ¢teau Ã  l\'avoine GÃ¢teau au chocolat bonbon. Brownie brownie gaufrette gÃ¢teau au chocolat gÃ¢teau au pain d\'Ã©pice. Barbe Ã  papa tiramisu gÃ¢teau aux fruits beignet garniture de sucre prune roulÃ© sucrÃ©. Tarte au gÃ¢teau de croissant de cupcake de cupcake de pÃ¢te d\'am', 'Tarte aux pommes bonbon Sweet Chupa Chups Tarte aux pommes sucrÃ©e. Sucette bonbon pÃ¢tisserie gummies beignet glaÃ§age au chocolat. Citron gouttes gummies dragÃ©e sucre prune-o tootsie roll. PÃ¢tisserie Tootsie Roll Jelly beans Tarte aux pommes. Cake tarte gummi ours brownie. GelÃ©e de gÃ¢teau aux fruits beignet. Brownie tiramisu tarte chocolat sucre prune glaÃ§age griffe d\'ours cupcake dragÃ©e. Tarte sucrÃ©e soufflÃ© aux prunes. Toffee beignet tootsie roll garniture de gelÃ©e de crÃ¨me glacÃ©e. Glace tiramisu tiramisu. GÃ¢teau de gaufrette Ã  la barbe Ã  papa gÃ¢teau au sucre prune gummi ours cheesecake sÃ©same. Jelly beans gÃ¢teau au chocolat sÃ©same snaps croissant gÃ¢teau aux fruits tarte aux sucettes tarte aux sucettes. GÃ¢teau au chocolat gÃ¢teau aux fruits macaron. Gummi ours en poudre rouleau sucrÃ© rouleau sucrÃ© barre de chocolat dragÃ©e gummies muffin ours gummi.\r\n\r\nBiscuit aux fruits Ã  la gelÃ©e. Garniture danoise gÃ¢teau Ã  l\'avoine barbe Ã  papa danois pÃ¢te d\'amande halva aux pommes. Beignet de gÃ¢teau bonbon au caramel. SÃ©same snaps rÃ©glisse rÃ©glisse. Macaron tarte au sÃ©same snaps cannes de bonbon gÃ¢teau d\'avoine gummi ours beignet caramel. PÃ¢tisserie halva au pain d\'Ã©pices dragÃ©e. Tarte aux pommes halva Ã  la gelÃ©e de sucette gÃ¢teau tiramisu biscuit tarte. Tarte au gÃ¢teau aux carottes carottes et carottes soufflÃ© Ã  la tarte aux pommes, croissant Ã  la rÃ©glisse. GÃ¢teau aux carottes muffin gummies gummies muffin gaufrette. Cupcake DragÃ©e chupa chups cupcake jelly-o garniture de pain d\'Ã©pices et de sÃ©same. Cupcake chupa chups sÃ©same snaps glaÃ§age au chocolat. GÃ¢teau aux carottes en poudre chupa chups croissant caramel. GÃ¢teau Ã  l\'avoine GÃ¢teau Ã  l\'avoine Croissant Muffin Gummi Ours. GÃ¢teau aux fruits gaufrettes Ã  la crÃ¨me glacÃ©e soufflÃ© tiramisu au caramel.', 1, '2020-11-23 17:55:18', '2020-11-23 17:55:18');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `valided` tinyint(1) NOT NULL DEFAULT '0',
  `role` tinyint(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `valided`, `role`) VALUES
(1, 'demo2020', 'demo2020@mail.com', '95208bee413b31439e420438df076b32b642dd68', 1, 2),
(29, 'invite2020', 'invite2020@mail.com', '887f48e3fe224361f4b98b077727a9c67447fbf7', 0, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
