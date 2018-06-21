-- Adminer 4.6.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `images` (`id`, `image`) VALUES
(20,	'images.jpeg'),
(29,	'girl-profile-picture-for-facebook-13.jpg'),
(30,	'friendly+face.jpg'),
(31,	'img_504590.png');

-- 2018-05-29 14:03:50
