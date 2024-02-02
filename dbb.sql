-- Adminer 4.8.1 MySQL 11.1.3-MariaDB-1:11.1.3+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `product_number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_product` (`id_product`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `cart` (`id`, `id_user`, `id_product`, `product_number`) VALUES
(1,	26,	2,	1),
(2,	26,	1,	1),
(3,	26,	2,	2),
(4,	26,	274,	5),
(5,	26,	324,	10),
(6,	26,	1,	1),
(7,	26,	267,	25);

DROP TABLE IF EXISTS `commentaries`;
CREATE TABLE `commentaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `commentary` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_product` (`id_product`),
  CONSTRAINT `commentaries_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  CONSTRAINT `commentaries_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `commentaries` (`id`, `id_user`, `id_product`, `rating`, `commentary`, `date`) VALUES
(6,	26,	1,	5,	'très bonne baguette',	'2024-01-31 15:10:00'),
(7,	26,	3,	0,	'remborser MOI , a fuir !!!',	'2024-01-31 15:45:20');

DROP TABLE IF EXISTS `composition`;
CREATE TABLE `composition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) DEFAULT NULL,
  `id_order` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_product` (`id_product`),
  KEY `id_order` (`id_order`),
  CONSTRAINT `composition_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`),
  CONSTRAINT `composition_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `composition` (`id`, `id_product`, `id_order`, `quantity`) VALUES
(1,	1,	1,	1),
(2,	2,	1,	20);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_composition` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_composition` (`id_composition`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_composition`) REFERENCES `composition` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `orders` (`id`, `id_user`, `id_composition`, `order_date`, `status`, `delivery_address`, `update_date`) VALUES
(1,	27,	1,	'2024-02-01 08:25:33',	'PrÃ©paration',	NULL,	'2024-02-01 15:19:51');

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `product` (`id`, `name`, `price`, `description`, `category`, `stock`) VALUES
(1,	'Photo de Pommes',	2.49,	'Une belle photo de pomme pour votre plus grand plaisir',	'A4',	2),
(2,	'Photo de Myrtille',	7.99,	'La myrtille, ca pique mais c est excellent.',	'A3',	93),
(3,	'Photo de Groseille',	13.99,	'Parce que la groseille est minuscule est fine pas comme son nom.',	'A2',	23),
(262,	'Photo de Bananes',	9.99,	'Une superbe photo de bananes fraîches',	'A3',	150),
(263,	'Photo d\'Oranges',	6.99,	'Une magnifique photo d\'oranges juteuses',	'A2',	300),
(264,	'Photo de Fraises',	12.99,	'Une délicieuse photo de fraises bien mûres',	'A4',	75),
(265,	'Photo de Kiwis',	4.99,	'Une photo exotique de kiwis verts',	'A3',	200),
(266,	'Photo de Mangues',	11.99,	'Une superbe photo de mangues sucrées',	'A2',	100),
(267,	'Photo de Cerises',	8.99,	'Une photo alléchante de cerises rouges',	'A4',	50),
(268,	'Photo de Raisins',	7.99,	'Une belle photo de raisins bien juteux',	'A3',	400),
(269,	'Photo de Ananas',	10.99,	'Une photo tropicale d\'ananas dorés',	'A2',	225),
(270,	'Photo de Poires',	5.99,	'Une photo appétissante de poires juteuses',	'A4',	175),
(271,	'Photo de Framboises',	13.99,	'Une photo séduisante de framboises fraîches',	'A3',	125),
(272,	'Photo de Citrons',	3.99,	'Une photo vive de citrons jaunes',	'A2',	350),
(273,	'Photo de Myrtilles',	11.49,	'Une photo succulente de myrtilles sauvages',	'A4',	90),
(274,	'Photo de Papayes',	10.49,	'Une photo exotique de papayes mûres',	'A3',	180),
(275,	'Photo de Grenades',	9.49,	'Une photo éclatante de grenades juteuses',	'A2',	270),
(276,	'Photo de Pommes de terre',	7.49,	'Une photo de pommes de terre fraîchement récoltées',	'A4',	300),
(277,	'Photo de Tomates',	5.49,	'Une photo colorée de tomates juteuses',	'A3',	400),
(278,	'Photo de Poivrons',	6.99,	'Une photo vibrante de poivrons rouges, verts et jaunes',	'A2',	200),
(279,	'Photo de Courgettes',	4.99,	'Une photo de courgettes fraîchement coupées',	'A4',	250),
(280,	'Photo de Carottes',	3.99,	'Une photo de carottes croquantes',	'A3',	350),
(281,	'Photo de Brocolis',	5.99,	'Une photo de brocolis verts et sains',	'A2',	180),
(282,	'Photo de Choux-fleurs',	6.49,	'Une photo de choux-fleurs blancs et frais',	'A4',	220),
(283,	'Photo de Concombres',	4.49,	'Une photo de concombres verts et croustillants',	'A3',	280),
(284,	'Photo de Aubergines',	8.49,	'Une photo de belles aubergines violettes',	'A2',	150),
(285,	'Photo de Courges',	7.49,	'Une photo de courges oranges et denses',	'A4',	200),
(286,	'Photo de Pastèques',	9.99,	'Une photo de pastèques juteuses et sucrées',	'A3',	120),
(287,	'Photo de Melons',	8.99,	'Une photo de melons mûrs et rafraîchissants',	'A2',	180),
(288,	'Photo de Raisin de table',	11.49,	'Une photo de raisins de table colorés et succulents',	'A4',	90),
(289,	'Photo de Citrouilles',	6.99,	'Une photo de citrouilles orange vif',	'A3',	150),
(290,	'Photo de Patates douces',	10.49,	'Une photo de patates douces riches et sucrées',	'A2',	200),
(291,	'Photo de Pêches',	8.49,	'Une photo de pêches juteuses et parfumées',	'A4',	120),
(292,	'Photo de Nectarines',	7.99,	'Une photo de nectarines veloutées et sucrées',	'A3',	180),
(293,	'Photo de Prunes',	6.49,	'Une photo de prunes mûres et juteuses',	'A2',	250),
(294,	'Photo de Cerises de terre',	9.99,	'Une photo de cerises de terre acidulées et délicieuses',	'A4',	100),
(295,	'Photo de Figues',	12.49,	'Une photo de figues violettes et sucrées',	'A3',	150),
(296,	'Photo de Mangoustans',	14.99,	'Une photo de mangoustans exotiques et parfumés',	'A2',	80),
(297,	'Photo de Litchis',	13.99,	'Une photo de litchis frais et juteux',	'A4',	120),
(298,	'Photo de Grenadilles',	11.99,	'Une photo de grenadilles acidulées et rafraîchissantes',	'A3',	200),
(299,	'Photo de Kumquats',	10.99,	'Une photo de kumquats orange vif et sucrés',	'A2',	250),
(300,	'Photo de Durians',	14.99,	'Une photo de durians épineux et odorants',	'A4',	80),
(301,	'Photo de Mangoustaniers',	13.99,	'Une photo de mangoustaniers chargés de fruits',	'A3',	150),
(302,	'Photo de Pamplemousses',	9.99,	'Une photo de pamplemousses juteux et acidulés',	'A4',	120),
(303,	'Photo de Cerisiers',	8.99,	'Une photo de cerisiers en fleurs et de fruits',	'A3',	180),
(304,	'Photo de Noyers',	11.49,	'Une photo de noyers verts et de noix',	'A4',	3),
(305,	'Photo de Noix',	9.49,	'Une photo de noix fraîches et croquantes',	'A3',	200),
(306,	'Photo de Châtaignes',	8.49,	'Une photo de châtaignes grillées et savoureuses',	'A2',	180),
(307,	'Photo de Pistaches',	12.99,	'Une photo de pistaches salées et croustillantes',	'A4',	150),
(308,	'Photo de Amandes',	10.99,	'Une photo d\'amandes naturelles et nutritives',	'A3',	250),
(309,	'Photo de Noisettes',	11.49,	'Une photo de noisettes fraîches et croquantes',	'A2',	200),
(310,	'Photo de Arachides',	7.99,	'Une photo d\'arachides grillées et salées',	'A4',	300),
(311,	'Photo de Manguiers',	14.49,	'Une photo de manguiers chargés de fruits mûrs',	'A3',	120),
(312,	'Photo de Citronniers',	12.99,	'Une photo de citronniers verts et chargés de fruits',	'A2',	180),
(313,	'Photo de Orangers',	10.99,	'Une photo d\'orangers pleins d\'agrumes juteux',	'A4',	250),
(314,	'Photo de Bananiers',	11.49,	'Une photo de bananiers chargés de régimes de bananes',	'A3',	200),
(315,	'Photo de Ananasiers',	13.99,	'Une photo d\'ananasiers tropicaux et généreux',	'A2',	150),
(316,	'Photo de Papayers',	9.99,	'Une photo de papayers chargés de fruits tropicaux',	'A4',	300),
(317,	'Photo de Raisiniers',	12.49,	'Une photo de raisiniers chargés de grappes de raisins',	'A3',	180),
(318,	'Photo de Pêchers',	7.99,	'Une photo de pêchers en fleurs et de fruits juteux',	'A4',	200),
(319,	'Photo de Châtaigniers',	9.49,	'Une photo de châtaigniers couverts de châtaignes',	'A2',	220),
(320,	'Photo de Pistachiers',	13.99,	'Une photo de pistachiers bien chargés de pistaches',	'A4',	180),
(321,	'Photo de Amandiers',	11.99,	'Une photo d\'amandiers fleuris et de fruits mûrs',	'A3',	250),
(322,	'Photo de Noisetiers',	10.99,	'Une photo de noisetiers bien garnis de noisettes',	'A2',	200),
(323,	'Photo de Arachidiers',	8.99,	'Une photo d\'arachidiers prêts à être récoltés',	'A4',	300),
(324,	'Photo du fruit du demon',	99998.99,	'Le fruit le plus cheater A SELEUMENT ',	'a4',	300),
(325,	'kaki',	1.78,	'petit kaki des familles',	'A4',	492);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `users` (`id`, `username`, `password`, `role`, `email`) VALUES
(26,	'admin',	'8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',	'admin',	'admin@gmail.com'),
(27,	'user',	'8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',	'user',	'user@gmail.com'),
(28,	'test',	'8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',	'user',	'test@gmail.com'),
(29,	'lolo',	'3583e2784d4accd7b12ddebc153b0dacb41db7e947a5736a58230a3f03935eb1',	'user',	'lolo@gmail.com');

-- 2024-02-01 17:47:07
