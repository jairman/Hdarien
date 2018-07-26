/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2011-03-20 19:43:49
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `tb_departamento`
-- ----------------------------
DROP TABLE IF EXISTS `tb_departamento`;
CREATE TABLE `tb_departamento` (
  `id_dep` varchar(2) NOT NULL DEFAULT '',
  `det_dep` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_dep`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_departamento
-- ----------------------------
INSERT INTO `tb_departamento` VALUES ('1', 'dep1');
INSERT INTO `tb_departamento` VALUES ('2', 'dep2');

-- ----------------------------
-- Table structure for `tb_distrito`
-- ----------------------------
DROP TABLE IF EXISTS `tb_distrito`;
CREATE TABLE `tb_distrito` (
  `id_pro` int(3) DEFAULT NULL,
  `id_dis` int(3) NOT NULL,
  `det_dis` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_dis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_distrito
-- ----------------------------
INSERT INTO `tb_distrito` VALUES ('1', '1', 'dis1');
INSERT INTO `tb_distrito` VALUES ('1', '2', 'dis2');
INSERT INTO `tb_distrito` VALUES ('2', '3', 'dis3');
INSERT INTO `tb_distrito` VALUES ('2', '4', 'dis4');
INSERT INTO `tb_distrito` VALUES ('3', '5', 'dis5');
INSERT INTO `tb_distrito` VALUES ('3', '6', 'dis6');
INSERT INTO `tb_distrito` VALUES ('4', '7', 'dis7');
INSERT INTO `tb_distrito` VALUES ('4', '8', 'dis8');

-- ----------------------------
-- Table structure for `tb_provincia`
-- ----------------------------
DROP TABLE IF EXISTS `tb_provincia`;
CREATE TABLE `tb_provincia` (
  `id_dep` int(3) DEFAULT NULL,
  `id_pro` int(3) NOT NULL DEFAULT '0',
  `det_pro` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_provincia
-- ----------------------------
INSERT INTO `tb_provincia` VALUES ('1', '1', 'pro1');
INSERT INTO `tb_provincia` VALUES ('1', '2', 'pro2');
INSERT INTO `tb_provincia` VALUES ('2', '3', 'pro3');
INSERT INTO `tb_provincia` VALUES ('2', '4', 'pro4');
