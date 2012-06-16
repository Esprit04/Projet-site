/*
Navicat MySQL Data Transfer

Source Server         : bdd
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : projet

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2012-06-14 17:00:18
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `bannis`
-- ----------------------------
DROP TABLE IF EXISTS `bannis`;
CREATE TABLE `bannis` (
  `pseudo` varchar(255) DEFAULT NULL,
  `adresse_ip` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bannis
-- ----------------------------

-- ----------------------------
-- Table structure for `commentaires`
-- ----------------------------
DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_nouveaute` int(11) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `commentaire` text NOT NULL,
  `date_commentaire` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of commentaires
-- ----------------------------

-- ----------------------------
-- Table structure for `comptes`
-- ----------------------------
DROP TABLE IF EXISTS `comptes`;
CREATE TABLE `comptes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_de_compte` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `question_secrete` varchar(255) NOT NULL,
  `reponse_secrete` varchar(255) NOT NULL,
  `rang` varchar(255) NOT NULL,
  `derniere_ip` char(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of comptes
-- ----------------------------

-- ----------------------------
-- Table structure for `livre`
-- ----------------------------
DROP TABLE IF EXISTS `livre`;
CREATE TABLE `livre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_envoi` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of livre
-- ----------------------------

-- ----------------------------
-- Table structure for `nouveautes`
-- ----------------------------
DROP TABLE IF EXISTS `nouveautes`;
CREATE TABLE `nouveautes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auteur` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of nouveautes
-- ----------------------------
