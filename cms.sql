/*
Navicat MySQL Data Transfer

Source Server         : Test
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2012-07-08 21:10:41
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
INSERT INTO `bannis` VALUES (null, '92.103.140.47');
INSERT INTO `bannis` VALUES (null, '92.103.140.45');
INSERT INTO `bannis` VALUES (null, '92.103.140.46');
INSERT INTO `bannis` VALUES (null, '92.103.140.44');
INSERT INTO `bannis` VALUES (null, '92.103.140.40');
INSERT INTO `bannis` VALUES (null, '92.103.140.42');
INSERT INTO `bannis` VALUES (null, '92.103.140.41');
INSERT INTO `bannis` VALUES (null, '92.103.140.39');
INSERT INTO `bannis` VALUES (null, '92.103.140.38');
INSERT INTO `bannis` VALUES (null, '92.103.140.37');
INSERT INTO `bannis` VALUES (null, '92.103.140.35');
INSERT INTO `bannis` VALUES (null, '92.103.140.43');
INSERT INTO `bannis` VALUES (null, '92.103.140.34');
INSERT INTO `bannis` VALUES (null, '92.103.140.33');
INSERT INTO `bannis` VALUES (null, '92.103.140.32');
INSERT INTO `bannis` VALUES (null, '92.103.140.36');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of commentaires
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of nouveautes
-- ----------------------------
