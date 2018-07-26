-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2014 a las 23:08:30
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `solucion_admin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_ak_profiles`
--

CREATE TABLE IF NOT EXISTS `wani_ak_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `configuration` longtext,
  `filters` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `wani_ak_profiles`
--

INSERT INTO `wani_ak_profiles` (`id`, `description`, `configuration`, `filters`) VALUES
(1, 'Default Backup Profile', '###AES128###dZzEAy6hCIPSNF/0jF3cBgp6blLvWEeOYAv6gOicY2q1UCSbH42wZHAROyJjsr/X06BqFUp7YMygDlLro126PKGgIWj9kbvuW39VOfwvMqwVjsmc97zTwlvp1SpfM6pNpm/yuUZyc/XxHln4PY/ba76dOftDlBMOvGRzzSeIF4s07YA/dhoV8Pi22sjCQZS1UgUv2FjjOyiEli7sU7s0WPuK1qF3PxMvgM60WyoT99o3/RMi3bafbdmzq9xgTpyzZVEMOqYGAwYif/mhP0aejaYfdgU8DRb2C7EfJ29bhfG0E0XCc6X5eWSqtCqdpc4SKMaDlJrjEufXkWzhd5Ws8muOE6gpM1ldlWstlmK/pKZ4hisnmAHleForwjfB2Jhjn3ZM7wDFIjz5V5aOYdSQBr30gsK4CmJgaumIYQxphFjrokiYAqs26/AwxLvifIdZL8TkEnT+Dy7xXN8+MWpNXIIE0+6pQBFAkOrlrACkJqIHs6SL6J/o722PlFuWwaAKaNqtuIc4oL4fDQ+IHjT7fml7T3QRIhL5/aL1h7UkGf29t/uloRdftCiIPJlMw7/t3jQ08SWj96k/R6XYXCnnKLSIdqZQpOdRM7CYJUryiWr3+avVo3ycOJuuYQL3v8x8nIovw3FQNFPswIrWRbNP3YqrI93swWq0FrS4KC5AImOKiX4PFDzx7AdnLRVDcBM733QXI8ZoVbrpLeLAcUhINgw7rmvz4dpIq5lTEBg3734mv44L2pBOP5leUMb4OHj8RoOOvR/SvIYWVox2lxqfgnCBmy10Cc5q4wXd5PQuZlil7Tt3eQqG0zxR8qn5QXrvJnl/Mgw/TDG2onY9OJp42NJKzCnvkdpW3RJdkXc08rvfNuMuuBXY8oyKzJI/CJU+ccC96Nwzc6RBE4G9oeXBFeqojoS22dfIlDfZ7qU0cCBpGBSI3yYsR5Ezbe6W1wE8TfdFwBlzEqAM1vLbgcJDBBUOJ6dh2Qp2TswfKr6z1sBLm8Az2xZWxy0xTgToG0mLhpLb6jfqZbeIvkDdtFlxYPAjOWIQIgPSSFU4zM4mqjC3vWCQA/lmbT01yW230pu9b0xbpnwH+yUmf2ZkbDFsnCcRgAYtZOx8PoDEBrnfXnJ2DM1rvVIqPoTH6OoaEXuu+Xw/1EVDp+mGmAmJE/E+NYNlJTpmBs7cTL1mLeBzOKqEjJIEnUD0aaHIzeSmXtaae39VS1Rj/LXyHpGFpQlU0aaFFCdlEFdOGu3yBre9U9H+vaA5L0T4gJeTsUxmk8d0vptPnT2oiygMlVobo8XpFTIm88kG3FChM+tMTS/fKC4zNVOALvPcxKzO8XsZ13PuNyZgxmg4QGYBHNSgJgl5l3ZIstml6++jic99PaCzjfgt9Jy9a0HWoBzkABndq9SH2XvclmSwpFY+z45qRXHMPGlYie+Sjhk+BAw9hxqEWHRaUOzdlExqgRgydFiyjVstRmjv4WBjqUeOYe+9tKN22RF1WDB8O6FcCqM2I40sfXNF1EYoX6Zfd+aZYjN1bO4rQjegIygDAYvtTCnrgwH3LdEspkgBM+GFIicnM2OqXef505yX66989LWCBLlUOAs0L3+Y6z80lSjkfxKoN58lZnJSb8pTcF1WomxLkqgoRLehDhNA7QLP6Gtx1zJ5puclcUzAdpJQlrCHhj/lKOzpsGlNNdy7V6ZwIHrlN9OiGhfBF+UCPkgJsS1biSN0Oj+UM2sWodUeI5Otl6RXsdDT7BIZTkBx4cfGAW61+D5IxMdFCxZq5oLhl/tS9yU42sbE4mGjPWtcOuVWVl/qBEUcEEOeUvdk6HSfGtSp/BnWzfraUzZ52N5TTRU88NOHbBpu37DGD5S9vgf6Lt5EMTOq2u6zRStI/A3k0hL+XVH/wm8kaY9uWPyWtuFwkig3zy3TOCLbjdCl9uJC/UhgN+UPzHB2FTh9Xyij16rgLTqaLsiBO5MkDaQHUbBTcrEBcxl6lV435fiQqh6TiVfQkFZWSGcLA2LPfFoypL3L3BnJKL30F6pokhXhmggmaSqJnlMd2KXpxR7eILRTVWovyiXiyBUt9UglefxfjTFO2t13++GWLdsqOjC2lvFW5W3wmAUOlhQaZ7cM9vdxdK7wgjFEiFSvAVM6+RB+ND0v8hT00r5HnbQ4l+D8zDJWx5IV1mKrvkZigS/fAklZE0eiOnVlIgv80MzLYz10PHZPdBvsI8mJtrqmvrAMrCXk7tml7QiWpdnfDT2gKamJ0FMgGGf/gJUGAAA=', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_ak_stats`
--

CREATE TABLE IF NOT EXISTS `wani_ak_stats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `comment` longtext,
  `backupstart` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `backupend` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('run','fail','complete') NOT NULL DEFAULT 'run',
  `origin` varchar(30) NOT NULL DEFAULT 'backend',
  `type` varchar(30) NOT NULL DEFAULT 'full',
  `profile_id` bigint(20) NOT NULL DEFAULT '1',
  `archivename` longtext,
  `absolute_path` longtext,
  `multipart` int(11) NOT NULL DEFAULT '0',
  `tag` varchar(255) DEFAULT NULL,
  `filesexist` tinyint(3) NOT NULL DEFAULT '1',
  `remote_filename` varchar(1000) DEFAULT NULL,
  `total_size` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_fullstatus` (`filesexist`,`status`),
  KEY `idx_stale` (`status`,`origin`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `wani_ak_stats`
--

INSERT INTO `wani_ak_stats` (`id`, `description`, `comment`, `backupstart`, `backupend`, `status`, `origin`, `type`, `profile_id`, `archivename`, `absolute_path`, `multipart`, `tag`, `filesexist`, `remote_filename`, `total_size`) VALUES
(4, 'Backup taken on Jueves, 13 Marzo 2014 15:08', '', '2014-03-13 18:08:39', '2014-03-13 18:09:24', 'complete', 'backend', 'full', 1, 'wanitta.jpa', '/home/content/25/11352825/html/PruebasID/wanitta/administrator/components/com_akeeba/backup/wanitta.jpa', 1, 'backend', 1, NULL, 17753493);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_ak_storage`
--

CREATE TABLE IF NOT EXISTS `wani_ak_storage` (
  `tag` varchar(255) NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data` longtext,
  PRIMARY KEY (`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_assets`
--

CREATE TABLE IF NOT EXISTS `wani_assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Anidadas al conjunto padre.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Anidadas conjunto lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Anidadas conjunto rgt.',
  `level` int(10) unsigned NOT NULL COMMENT 'Nivel de la caché en el árbol anidado.',
  `name` varchar(50) NOT NULL COMMENT 'Nombre único para el activo.\n',
  `title` varchar(100) NOT NULL COMMENT 'Título descriptivo para el activo.',
  `rules` varchar(5120) NOT NULL COMMENT 'Control de acceso codificado de JSON.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_asset_name` (`name`),
  KEY `idx_lft_rgt` (`lft`,`rgt`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Volcado de datos para la tabla `wani_assets`
--

INSERT INTO `wani_assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES
(1, 0, 0, 113, 0, 'root.1', 'Root Asset', '{"core.login.site":{"6":1,"2":1},"core.login.admin":{"6":1},"core.login.offline":{"6":1},"core.admin":{"8":1},"core.manage":{"7":1},"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(2, 1, 1, 2, 1, 'com_admin', 'com_admin', '{}'),
(3, 1, 3, 6, 1, 'com_banners', 'com_banners', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(4, 1, 7, 8, 1, 'com_cache', 'com_cache', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(5, 1, 9, 10, 1, 'com_checkin', 'com_checkin', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(6, 1, 11, 12, 1, 'com_config', 'com_config', '{}'),
(7, 1, 13, 16, 1, 'com_contact', 'com_contact', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(8, 1, 17, 22, 1, 'com_content', 'com_content', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(9, 1, 23, 24, 1, 'com_cpanel', 'com_cpanel', '{}'),
(10, 1, 25, 26, 1, 'com_installer', 'com_installer', '{"core.admin":[],"core.manage":{"7":0},"core.delete":{"7":0},"core.edit.state":{"7":0}}'),
(11, 1, 27, 28, 1, 'com_languages', 'com_languages', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(12, 1, 29, 30, 1, 'com_login', 'com_login', '{}'),
(13, 1, 31, 32, 1, 'com_mailto', 'com_mailto', '{}'),
(14, 1, 33, 34, 1, 'com_massmail', 'com_massmail', '{}'),
(15, 1, 35, 36, 1, 'com_media', 'com_media', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":{"5":1}}'),
(16, 1, 37, 38, 1, 'com_menus', 'com_menus', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(17, 1, 39, 40, 1, 'com_messages', 'com_messages', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(18, 1, 41, 76, 1, 'com_modules', 'com_modules', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(19, 1, 77, 80, 1, 'com_newsfeeds', 'com_newsfeeds', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(20, 1, 81, 82, 1, 'com_plugins', 'com_plugins', '{"core.admin":{"7":1},"core.manage":[],"core.edit":[],"core.edit.state":[]}'),
(21, 1, 83, 84, 1, 'com_redirect', 'com_redirect', '{"core.admin":{"7":1},"core.manage":[]}'),
(22, 1, 85, 86, 1, 'com_search', 'com_search', '{"core.admin":{"7":1},"core.manage":{"6":1}}'),
(23, 1, 87, 88, 1, 'com_templates', 'com_templates', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(24, 1, 89, 92, 1, 'com_users', 'com_users', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(25, 1, 93, 96, 1, 'com_weblinks', 'com_weblinks', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(26, 1, 97, 98, 1, 'com_wrapper', 'com_wrapper', '{}'),
(27, 8, 18, 21, 2, 'com_content.category.2', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(28, 3, 4, 5, 2, 'com_banners.category.3', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(29, 7, 14, 15, 2, 'com_contact.category.4', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(30, 19, 78, 79, 2, 'com_newsfeeds.category.5', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(31, 25, 94, 95, 2, 'com_weblinks.category.6', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(32, 24, 90, 91, 1, 'com_users.category.7', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(33, 1, 99, 100, 1, 'com_finder', 'com_finder', '{"core.admin":{"7":1},"core.manage":{"6":1}}'),
(34, 1, 101, 102, 1, 'com_joomlaupdate', 'com_joomlaupdate', '{"core.admin":[],"core.manage":[],"core.delete":[],"core.edit.state":[]}'),
(35, 1, 103, 104, 1, 'com_tags', 'com_tags', '{"core.admin":[],"core.manage":[],"core.manage":[],"core.delete":[],"core.edit.state":[]}'),
(36, 1, 105, 106, 1, 'com_contenthistory', 'com_contenthistory', '{}'),
(37, 1, 107, 108, 1, 'com_ajax', 'com_ajax', '{}'),
(38, 1, 109, 110, 1, 'com_postinstall', 'com_postinstall', '{}'),
(39, 18, 42, 43, 2, 'com_modules.module.1', 'Menú Principal', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(40, 18, 44, 45, 2, 'com_modules.module.2', 'Login', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(41, 18, 46, 47, 2, 'com_modules.module.3', 'Popular Articles', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(42, 18, 48, 49, 2, 'com_modules.module.4', 'Recently Added Articles', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(43, 18, 50, 51, 2, 'com_modules.module.8', 'Toolbar', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(44, 18, 52, 53, 2, 'com_modules.module.9', 'Quick Icons', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(45, 18, 54, 55, 2, 'com_modules.module.10', 'Logged-in Users', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(46, 18, 56, 57, 2, 'com_modules.module.12', 'Admin Menu', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(47, 18, 58, 59, 2, 'com_modules.module.13', 'Admin Submenu', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(48, 18, 60, 61, 2, 'com_modules.module.14', 'User Status', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(49, 18, 62, 63, 2, 'com_modules.module.15', 'Title', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(50, 18, 64, 65, 2, 'com_modules.module.16', 'Acceso', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(51, 18, 66, 67, 2, 'com_modules.module.17', 'Breadcrumbs', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(52, 18, 68, 69, 2, 'com_modules.module.79', 'Multilanguage status', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(53, 18, 70, 71, 2, 'com_modules.module.86', 'Joomla Version', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(54, 18, 72, 73, 2, 'com_modules.module.87', 'Wanitta', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(55, 27, 19, 20, 3, 'com_content.article.1', 'Wanitta', '{"core.delete":{"1":0,"6":1},"core.edit":{"1":0,"6":1,"4":1},"core.edit.state":{"1":0,"6":1,"5":1}}'),
(56, 1, 111, 112, 1, 'com_akeeba', 'akeeba', '{}'),
(57, 18, 74, 75, 2, 'com_modules.module.88', 'Linea', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_associations`
--

CREATE TABLE IF NOT EXISTS `wani_associations` (
  `id` int(11) NOT NULL COMMENT 'A reference to the associated item.',
  `context` varchar(50) NOT NULL COMMENT 'The context of the associated item.',
  `key` char(32) NOT NULL COMMENT 'The key for the association computed from an md5 on associated ids.',
  PRIMARY KEY (`context`,`id`),
  KEY `idx_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_banners`
--

CREATE TABLE IF NOT EXISTS `wani_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `custombannercode` varchar(2048) NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `params` text NOT NULL,
  `own_prefix` tinyint(1) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reset` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `language` char(7) NOT NULL DEFAULT '',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_state` (`state`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`),
  KEY `idx_banner_catid` (`catid`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_banner_clients`
--

CREATE TABLE IF NOT EXISTS `wani_banner_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `metakey` text NOT NULL,
  `own_prefix` tinyint(4) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_banner_tracks`
--

CREATE TABLE IF NOT EXISTS `wani_banner_tracks` (
  `track_date` datetime NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`track_date`,`track_type`,`banner_id`),
  KEY `idx_track_date` (`track_date`),
  KEY `idx_track_type` (`track_type`),
  KEY `idx_banner_id` (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_categories`
--

CREATE TABLE IF NOT EXISTS `wani_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '',
  `extension` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `metadesc` varchar(1024) NOT NULL COMMENT 'La meta descripción de la página.',
  `metakey` varchar(1024) NOT NULL COMMENT 'Las palabras clave para la página.',
  `metadata` varchar(2048) NOT NULL COMMENT 'Propiedades de metadatos codificados JSON.',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`extension`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_path` (`path`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `wani_categories`
--

INSERT INTO `wani_categories` (`id`, `asset_id`, `parent_id`, `lft`, `rgt`, `level`, `path`, `extension`, `title`, `alias`, `note`, `description`, `published`, `checked_out`, `checked_out_time`, `access`, `params`, `metadesc`, `metakey`, `metadata`, `created_user_id`, `created_time`, `modified_user_id`, `modified_time`, `hits`, `language`, `version`) VALUES
(1, 0, 0, 0, 13, 0, '', 'system', 'ROOT', 'root', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{}', '', '', '', 42, '2011-01-01 00:00:01', 0, '0000-00-00 00:00:00', 0, '*', 1),
(2, 27, 1, 1, 2, 1, 'uncategorised', 'com_content', 'Sin categoría', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '0000-00-00 00:00:00', 0, '*', 1),
(3, 28, 1, 3, 4, 1, 'uncategorised', 'com_banners', 'Sin categoría', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":"","foobar":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '0000-00-00 00:00:00', 0, '*', 1),
(4, 29, 1, 5, 6, 1, 'uncategorised', 'com_contact', 'Sin categoría', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '0000-00-00 00:00:00', 0, '*', 1),
(5, 30, 1, 7, 8, 1, 'uncategorised', 'com_newsfeeds', 'Sin categoría', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '0000-00-00 00:00:00', 0, '*', 1),
(6, 31, 1, 9, 10, 1, 'uncategorised', 'com_weblinks', 'Sin categoría', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '0000-00-00 00:00:00', 0, '*', 1),
(7, 32, 1, 11, 12, 1, 'uncategorised', 'com_users', 'Sin categoría', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '0000-00-00 00:00:00', 0, '*', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_contact_details`
--

CREATE TABLE IF NOT EXISTS `wani_contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  `sortname1` varchar(255) NOT NULL,
  `sortname2` varchar(255) NOT NULL,
  `sortname3` varchar(255) NOT NULL,
  `language` char(7) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Establecer si el artículo aparece.',
  `xreference` varchar(50) NOT NULL COMMENT 'Una referencia para los vínculos a datos externos conjuntos.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_content`
--

CREATE TABLE IF NOT EXISTS `wani_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` varchar(5120) NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Establecer si el artículo aparece.',
  `language` char(7) NOT NULL COMMENT 'El código de idioma para el artículo.',
  `xreference` varchar(50) NOT NULL COMMENT 'Una referencia para los vínculos a datos externos conjuntos.',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `wani_content`
--

INSERT INTO `wani_content` (`id`, `asset_id`, `title`, `alias`, `introtext`, `fulltext`, `state`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`, `featured`, `language`, `xreference`) VALUES
(1, 55, 'Wanitta', 'wanitta', '<p> </p>\r\n<p style="text-align: center;">SOFTWARE ADMINISTRATIVO  </p>\r\n<p style="text-align: center;"><img src="images/Logo.png" alt="" width="501" height="246" /></p>', '', 1, 2, '2014-02-21 21:08:03', 211, '', '2014-07-16 23:02:06', 211, 0, '0000-00-00 00:00:00', '2014-02-21 21:08:03', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"0","link_titles":"0","show_intro":"0","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_icons":"0","show_print_icon":"0","show_email_icon":"0","show_vote":"0","show_hits":"0","show_noauth":"0","alternative_readmore":"","article_layout":"","show_publishing_options":"0","show_article_options":"0","show_urls_images_backend":"0","show_urls_images_frontend":"0"}', 20, 0, '', '', 1, 1814, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_contentitem_tag_map`
--

CREATE TABLE IF NOT EXISTS `wani_contentitem_tag_map` (
  `type_alias` varchar(255) NOT NULL DEFAULT '',
  `core_content_id` int(10) unsigned NOT NULL COMMENT 'PK from the core content table',
  `content_item_id` int(11) NOT NULL COMMENT 'PK from the content type table',
  `tag_id` int(10) unsigned NOT NULL COMMENT 'PK from the tag table',
  `tag_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Date of most recent save for this tag-item',
  `type_id` mediumint(8) NOT NULL COMMENT 'PK from the content_type table',
  UNIQUE KEY `uc_ItemnameTagid` (`type_id`,`content_item_id`,`tag_id`),
  KEY `idx_tag_type` (`tag_id`,`type_id`),
  KEY `idx_date_id` (`tag_date`,`tag_id`),
  KEY `idx_tag` (`tag_id`),
  KEY `idx_type` (`type_id`),
  KEY `idx_core_content_id` (`core_content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Maps items from content tables to tags';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_content_frontpage`
--

CREATE TABLE IF NOT EXISTS `wani_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_content_rating`
--

CREATE TABLE IF NOT EXISTS `wani_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(10) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_content_types`
--

CREATE TABLE IF NOT EXISTS `wani_content_types` (
  `type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_title` varchar(255) NOT NULL DEFAULT '',
  `type_alias` varchar(255) NOT NULL DEFAULT '',
  `table` varchar(255) NOT NULL DEFAULT '',
  `rules` text NOT NULL,
  `field_mappings` text NOT NULL,
  `router` varchar(255) NOT NULL DEFAULT '',
  `content_history_options` varchar(5120) DEFAULT NULL COMMENT 'JSON string for com_contenthistory options',
  PRIMARY KEY (`type_id`),
  KEY `idx_alias` (`type_alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `wani_content_types`
--

INSERT INTO `wani_content_types` (`type_id`, `type_title`, `type_alias`, `table`, `rules`, `field_mappings`, `router`, `content_history_options`) VALUES
(1, 'Article', 'com_content.article', '{"special":{"dbtable":"#__content","key":"id","type":"Content","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"state","core_alias":"alias","core_created_time":"created","core_modified_time":"modified","core_body":"introtext", "core_hits":"hits","core_publish_up":"publish_up","core_publish_down":"publish_down","core_access":"access", "core_params":"attribs", "core_featured":"featured", "core_metadata":"metadata", "core_language":"language", "core_images":"images", "core_urls":"urls", "core_version":"version", "core_ordering":"ordering", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"catid", "core_xreference":"xreference", "asset_id":"asset_id"}, "special":{"fulltext":"fulltext"}}', 'ContentHelperRoute::getArticleRoute', '{"formFile":"administrator\\/components\\/com_content\\/models\\/forms\\/article.xml", "hideFields":["asset_id","checked_out","checked_out_time","version"],"ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time", "version", "hits"],"convertToInt":["publish_up", "publish_down", "featured", "ordering"],"displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"} ]}'),
(2, 'Weblink', 'com_weblinks.weblink', '{"special":{"dbtable":"#__weblinks","key":"id","type":"Weblink","prefix":"WeblinksTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"state","core_alias":"alias","core_created_time":"created","core_modified_time":"modified","core_body":"description", "core_hits":"hits","core_publish_up":"publish_up","core_publish_down":"publish_down","core_access":"access", "core_params":"params", "core_featured":"featured", "core_metadata":"metadata", "core_language":"language", "core_images":"images", "core_urls":"urls", "core_version":"version", "core_ordering":"ordering", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"catid", "core_xreference":"xreference", "asset_id":"null"}, "special":{}}', 'WeblinksHelperRoute::getWeblinkRoute', '{"formFile":"administrator\\/components\\/com_weblinks\\/models\\/forms\\/weblink.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","featured","images"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time", "version", "hits"], "convertToInt":["publish_up", "publish_down", "featured", "ordering"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"} ]}'),
(3, 'Contact', 'com_contact.contact', '{"special":{"dbtable":"#__contact_details","key":"id","type":"Contact","prefix":"ContactTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"name","core_state":"published","core_alias":"alias","core_created_time":"created","core_modified_time":"modified","core_body":"address", "core_hits":"hits","core_publish_up":"publish_up","core_publish_down":"publish_down","core_access":"access", "core_params":"params", "core_featured":"featured", "core_metadata":"metadata", "core_language":"language", "core_images":"image", "core_urls":"webpage", "core_version":"version", "core_ordering":"ordering", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"catid", "core_xreference":"xreference", "asset_id":"null"}, "special":{"con_position":"con_position","suburb":"suburb","state":"state","country":"country","postcode":"postcode","telephone":"telephone","fax":"fax","misc":"misc","email_to":"email_to","default_con":"default_con","user_id":"user_id","mobile":"mobile","sortname1":"sortname1","sortname2":"sortname2","sortname3":"sortname3"}}', 'ContactHelperRoute::getContactRoute', '{"formFile":"administrator\\/components\\/com_contact\\/models\\/forms\\/contact.xml","hideFields":["default_con","checked_out","checked_out_time","version","xreference"],"ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time", "version", "hits"],"convertToInt":["publish_up", "publish_down", "featured", "ordering"], "displayLookup":[ {"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"} ] }'),
(4, 'Newsfeed', 'com_newsfeeds.newsfeed', '{"special":{"dbtable":"#__newsfeeds","key":"id","type":"Newsfeed","prefix":"NewsfeedsTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"name","core_state":"published","core_alias":"alias","core_created_time":"created","core_modified_time":"modified","core_body":"description", "core_hits":"hits","core_publish_up":"publish_up","core_publish_down":"publish_down","core_access":"access", "core_params":"params", "core_featured":"featured", "core_metadata":"metadata", "core_language":"language", "core_images":"images", "core_urls":"link", "core_version":"version", "core_ordering":"ordering", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"catid", "core_xreference":"xreference", "asset_id":"null"}, "special":{"numarticles":"numarticles","cache_time":"cache_time","rtl":"rtl"}}', 'NewsfeedsHelperRoute::getNewsfeedRoute', '{"formFile":"administrator\\/components\\/com_newsfeeds\\/models\\/forms\\/newsfeed.xml","hideFields":["asset_id","checked_out","checked_out_time","version"],"ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time", "version", "hits"],"convertToInt":["publish_up", "publish_down", "featured", "ordering"],"displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"} ]}'),
(5, 'User', 'com_users.user', '{"special":{"dbtable":"#__users","key":"id","type":"User","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"name","core_state":"null","core_alias":"username","core_created_time":"registerdate","core_modified_time":"lastvisitDate","core_body":"null", "core_hits":"null","core_publish_up":"null","core_publish_down":"null","access":"null", "core_params":"params", "core_featured":"null", "core_metadata":"null", "core_language":"null", "core_images":"null", "core_urls":"null", "core_version":"null", "core_ordering":"null", "core_metakey":"null", "core_metadesc":"null", "core_catid":"null", "core_xreference":"null", "asset_id":"null"}, "special":{}}', 'UsersHelperRoute::getUserRoute', ''),
(6, 'Article Category', 'com_content.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', 'ContentHelperRoute::getCategoryRoute', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'),
(7, 'Contact Category', 'com_contact.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', 'ContactHelperRoute::getCategoryRoute', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'),
(8, 'Newsfeeds Category', 'com_newsfeeds.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', 'NewsfeedsHelperRoute::getCategoryRoute', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'),
(9, 'Weblinks Category', 'com_weblinks.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', 'WeblinksHelperRoute::getCategoryRoute', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'),
(10, 'Tag', 'com_tags.tag', '{"special":{"dbtable":"#__tags","key":"tag_id","type":"Tag","prefix":"TagsTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"featured", "core_metadata":"metadata", "core_language":"language", "core_images":"images", "core_urls":"urls", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"null", "core_xreference":"null", "asset_id":"null"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path"}}', 'TagsHelperRoute::getTagRoute', '{"formFile":"administrator\\/components\\/com_tags\\/models\\/forms\\/tag.xml", "hideFields":["checked_out","checked_out_time","version", "lft", "rgt", "level", "path", "urls", "publish_up", "publish_down"],"ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}, {"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"}, {"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'),
(11, 'Banner', 'com_banners.banner', '{"special":{"dbtable":"#__banners","key":"id","type":"Banner","prefix":"BannersTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"name","core_state":"published","core_alias":"alias","core_created_time":"created","core_modified_time":"modified","core_body":"description", "core_hits":"null","core_publish_up":"publish_up","core_publish_down":"publish_down","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"images", "core_urls":"link", "core_version":"version", "core_ordering":"ordering", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"catid", "core_xreference":"null", "asset_id":"null"}, "special":{"imptotal":"imptotal", "impmade":"impmade", "clicks":"clicks", "clickurl":"clickurl", "custombannercode":"custombannercode", "cid":"cid", "purchase_type":"purchase_type", "track_impressions":"track_impressions", "track_clicks":"track_clicks"}}', '', '{"formFile":"administrator\\/components\\/com_banners\\/models\\/forms\\/banner.xml", "hideFields":["checked_out","checked_out_time","version", "reset"],"ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time", "version", "imptotal", "impmade", "reset"], "convertToInt":["publish_up", "publish_down", "ordering"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}, {"sourceColumn":"cid","targetTable":"#__banner_clients","targetColumn":"id","displayColumn":"name"}, {"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"} ]}'),
(12, 'Banners Category', 'com_banners.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special": {"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', '', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'),
(13, 'Banner Client', 'com_banners.client', '{"special":{"dbtable":"#__banner_clients","key":"id","type":"Client","prefix":"BannersTable"}}', '', '', '', '{"formFile":"administrator\\/components\\/com_banners\\/models\\/forms\\/client.xml", "hideFields":["checked_out","checked_out_time"], "ignoreChanges":["checked_out", "checked_out_time"], "convertToInt":[], "displayLookup":[]}'),
(14, 'User Notes', 'com_users.note', '{"special":{"dbtable":"#__user_notes","key":"id","type":"Note","prefix":"UsersTable"}}', '', '', '', '{"formFile":"administrator\\/components\\/com_users\\/models\\/forms\\/note.xml", "hideFields":["checked_out","checked_out_time", "publish_up", "publish_down"],"ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"],"displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}, {"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}, {"sourceColumn":"user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}, {"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'),
(15, 'User Notes Category', 'com_users.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', '', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}, {"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_core_log_searches`
--

CREATE TABLE IF NOT EXISTS `wani_core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_extensions`
--

CREATE TABLE IF NOT EXISTS `wani_extensions` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `element` varchar(100) NOT NULL,
  `folder` varchar(100) NOT NULL,
  `client_id` tinyint(3) NOT NULL,
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  `access` int(10) unsigned NOT NULL DEFAULT '1',
  `protected` tinyint(3) NOT NULL DEFAULT '0',
  `manifest_cache` text NOT NULL,
  `params` text NOT NULL,
  `custom_data` text NOT NULL,
  `system_data` text NOT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '0',
  PRIMARY KEY (`extension_id`),
  KEY `element_clientid` (`element`,`client_id`),
  KEY `element_folder_clientid` (`element`,`folder`,`client_id`),
  KEY `extension` (`type`,`element`,`folder`,`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10007 ;

--
-- Volcado de datos para la tabla `wani_extensions`
--

INSERT INTO `wani_extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(1, 'com_mailto', 'component', 'com_mailto', '', 0, 1, 1, 1, '{"name":"com_mailto","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_MAILTO_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(2, 'com_wrapper', 'component', 'com_wrapper', '', 0, 1, 1, 1, '{"name":"com_wrapper","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_WRAPPER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(3, 'com_admin', 'component', 'com_admin', '', 1, 1, 1, 1, '{"name":"com_admin","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_ADMIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(4, 'com_banners', 'component', 'com_banners', '', 1, 1, 1, 0, '{"name":"com_banners","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_BANNERS_XML_DESCRIPTION","group":""}', '{"purchase_type":"3","track_impressions":"0","track_clicks":"0","metakey_prefix":"","save_history":"1","history_limit":10}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(5, 'com_cache', 'component', 'com_cache', '', 1, 1, 1, 1, '{"name":"com_cache","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CACHE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(6, 'com_categories', 'component', 'com_categories', '', 1, 1, 1, 1, '{"name":"com_categories","type":"component","creationDate":"December 2007","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CATEGORIES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(7, 'com_checkin', 'component', 'com_checkin', '', 1, 1, 1, 1, '{"name":"com_checkin","type":"component","creationDate":"Unknown","author":"Joomla! Project","copyright":"(C) 2005 - 2008 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CHECKIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(8, 'com_contact', 'component', 'com_contact', '', 1, 1, 1, 0, '{"name":"com_contact","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CONTACT_XML_DESCRIPTION","group":""}', '{"show_contact_category":"hide","save_history":"1","history_limit":10,"show_contact_list":"0","presentation_style":"sliders","show_name":"1","show_position":"1","show_email":"0","show_street_address":"1","show_suburb":"1","show_state":"1","show_postcode":"1","show_country":"1","show_telephone":"1","show_mobile":"1","show_fax":"1","show_webpage":"1","show_misc":"1","show_image":"1","image":"","allow_vcard":"0","show_articles":"0","show_profile":"0","show_links":"0","linka_name":"","linkb_name":"","linkc_name":"","linkd_name":"","linke_name":"","contact_icons":"0","icon_address":"","icon_email":"","icon_telephone":"","icon_mobile":"","icon_fax":"","icon_misc":"","show_headings":"1","show_position_headings":"1","show_email_headings":"0","show_telephone_headings":"1","show_mobile_headings":"0","show_fax_headings":"0","allow_vcard_headings":"0","show_suburb_headings":"1","show_state_headings":"1","show_country_headings":"1","show_email_form":"1","show_email_copy":"1","banned_email":"","banned_subject":"","banned_text":"","validate_session":"1","custom_reply":"0","redirect":"","show_category_crumb":"0","metakey":"","metadesc":"","robots":"","author":"","rights":"","xreference":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(9, 'com_cpanel', 'component', 'com_cpanel', '', 1, 1, 1, 1, '{"name":"com_cpanel","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CPANEL_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10, 'com_installer', 'component', 'com_installer', '', 1, 1, 1, 1, '{"name":"com_installer","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_INSTALLER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(11, 'com_languages', 'component', 'com_languages', '', 1, 1, 1, 1, '{"name":"com_languages","type":"component","creationDate":"2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_LANGUAGES_XML_DESCRIPTION","group":""}', '{"administrator":"es-ES","site":"es-ES"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(12, 'com_login', 'component', 'com_login', '', 1, 1, 1, 1, '{"name":"com_login","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(13, 'com_media', 'component', 'com_media', '', 1, 1, 0, 1, '{"name":"com_media","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_MEDIA_XML_DESCRIPTION","group":""}', '{"upload_extensions":"bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,GIF,ICO,JPG,JPEG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS","upload_maxsize":"10","file_path":"images","image_path":"images","restrict_uploads":"1","allowed_media_usergroup":"3","check_mime":"1","image_extensions":"bmp,gif,jpg,png","ignore_extensions":"","upload_mime":"image\\/jpeg,image\\/gif,image\\/png,image\\/bmp,application\\/x-shockwave-flash,application\\/msword,application\\/excel,application\\/pdf,application\\/powerpoint,text\\/plain,application\\/x-zip","upload_mime_illegal":"text\\/html"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(14, 'com_menus', 'component', 'com_menus', '', 1, 1, 1, 1, '{"name":"com_menus","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_MENUS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(15, 'com_messages', 'component', 'com_messages', '', 1, 1, 1, 1, '{"name":"com_messages","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_MESSAGES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(16, 'com_modules', 'component', 'com_modules', '', 1, 1, 1, 1, '{"name":"com_modules","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_MODULES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(17, 'com_newsfeeds', 'component', 'com_newsfeeds', '', 1, 1, 1, 0, '{"name":"com_newsfeeds","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_NEWSFEEDS_XML_DESCRIPTION","group":""}', '{"newsfeed_layout":"_:default","save_history":"1","history_limit":5,"show_feed_image":"1","show_feed_description":"1","show_item_description":"1","feed_character_count":"0","feed_display_order":"des","float_first":"right","float_second":"right","show_tags":"1","category_layout":"_:default","show_category_title":"1","show_description":"1","show_description_image":"1","maxLevel":"-1","show_empty_categories":"0","show_subcat_desc":"1","show_cat_items":"1","show_cat_tags":"1","show_base_description":"1","maxLevelcat":"-1","show_empty_categories_cat":"0","show_subcat_desc_cat":"1","show_cat_items_cat":"1","filter_field":"1","show_pagination_limit":"1","show_headings":"1","show_articles":"0","show_link":"1","show_pagination":"1","show_pagination_results":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(18, 'com_plugins', 'component', 'com_plugins', '', 1, 1, 1, 1, '{"name":"com_plugins","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_PLUGINS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(19, 'com_search', 'component', 'com_search', '', 1, 1, 1, 0, '{"name":"com_search","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_SEARCH_XML_DESCRIPTION","group":""}', '{"enabled":"0","show_date":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(20, 'com_templates', 'component', 'com_templates', '', 1, 1, 1, 1, '{"name":"com_templates","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_TEMPLATES_XML_DESCRIPTION","group":""}', '{"template_positions_display":"0","upload_limit":"2","image_formats":"gif,bmp,jpg,jpeg,png","source_formats":"txt,less,ini,xml,js,php,css","font_formats":"woff,ttf,otf","compressed_formats":"zip"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(21, 'com_weblinks', 'component', 'com_weblinks', '', 1, 1, 1, 0, '{"name":"com_weblinks","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_WEBLINKS_XML_DESCRIPTION","group":""}', '{"target":"0","save_history":"1","history_limit":5,"count_clicks":"1","icons":1,"link_icons":"","float_first":"right","float_second":"right","show_tags":"1","category_layout":"_:default","show_category_title":"1","show_description":"1","show_description_image":"1","maxLevel":"-1","show_empty_categories":"0","show_subcat_desc":"1","show_cat_num_links":"1","show_cat_tags":"1","show_base_description":"1","maxLevelcat":"-1","show_empty_categories_cat":"0","show_subcat_desc_cat":"1","show_cat_num_links_cat":"1","filter_field":"1","show_pagination_limit":"1","show_headings":"0","show_link_description":"1","show_link_hits":"1","show_pagination":"2","show_pagination_results":"1","show_feed_link":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(22, 'com_content', 'component', 'com_content', '', 1, 1, 0, 1, '{"name":"com_content","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CONTENT_XML_DESCRIPTION","group":""}', '{"article_layout":"_:default","show_title":"1","link_titles":"1","show_intro":"1","show_category":"1","link_category":"1","show_parent_category":"0","link_parent_category":"0","show_author":"1","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"1","show_item_navigation":"1","show_vote":"0","show_readmore":"1","show_readmore_title":"1","readmore_limit":"100","show_icons":"1","show_print_icon":"1","show_email_icon":"1","show_hits":"1","show_noauth":"0","show_publishing_options":"1","show_article_options":"1","save_history":"1","history_limit":10,"show_urls_images_frontend":"0","show_urls_images_backend":"1","targeta":0,"targetb":0,"targetc":0,"float_intro":"left","float_fulltext":"left","category_layout":"_:blog","show_category_title":"0","show_description":"0","show_description_image":"0","maxLevel":"1","show_empty_categories":"0","show_no_articles":"1","show_subcat_desc":"1","show_cat_num_articles":"0","show_base_description":"1","maxLevelcat":"-1","show_empty_categories_cat":"0","show_subcat_desc_cat":"1","show_cat_num_articles_cat":"1","num_leading_articles":"1","num_intro_articles":"4","num_columns":"2","num_links":"4","multi_column_order":"0","show_subcategory_content":"0","show_pagination_limit":"1","filter_field":"hide","show_headings":"1","list_show_date":"0","date_format":"","list_show_hits":"1","list_show_author":"1","orderby_pri":"order","orderby_sec":"rdate","order_date":"published","show_pagination":"2","show_pagination_results":"1","show_feed_link":"1","feed_summary":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(23, 'com_config', 'component', 'com_config', '', 1, 1, 0, 1, '{"name":"com_config","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CONFIG_XML_DESCRIPTION","group":""}', '{"filters":{"1":{"filter_type":"NH","filter_tags":"","filter_attributes":""},"9":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"6":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"7":{"filter_type":"NONE","filter_tags":"","filter_attributes":""},"2":{"filter_type":"NH","filter_tags":"","filter_attributes":""},"3":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"4":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"5":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"8":{"filter_type":"NONE","filter_tags":"","filter_attributes":""}}}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(24, 'com_redirect', 'component', 'com_redirect', '', 1, 1, 0, 1, '{"name":"com_redirect","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_REDIRECT_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(25, 'com_users', 'component', 'com_users', '', 1, 1, 0, 1, '{"name":"com_users","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_USERS_XML_DESCRIPTION","group":""}', '{"allowUserRegistration":"1","new_usertype":"2","guest_usergroup":"13","sendpassword":"1","useractivation":"1","mail_to_admin":"0","captcha":"","frontend_userparams":"1","site_language":"0","change_login_name":"0","reset_count":"10","reset_time":"1","minimum_length":"4","minimum_integers":"0","minimum_symbols":"0","minimum_uppercase":"0","save_history":"1","history_limit":5,"mailSubjectPrefix":"","mailBodySuffix":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(27, 'com_finder', 'component', 'com_finder', '', 1, 1, 0, 0, '{"name":"com_finder","type":"component","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_FINDER_XML_DESCRIPTION","group":""}', '{"show_description":"1","description_length":255,"allow_empty_query":"0","show_url":"1","show_advanced":"1","expand_advanced":"0","show_date_filters":"0","highlight_terms":"1","opensearch_name":"","opensearch_description":"","batch_size":"50","memory_table_limit":30000,"title_multiplier":"1.7","text_multiplier":"0.7","meta_multiplier":"1.2","path_multiplier":"2.0","misc_multiplier":"0.3","stemmer":"snowball"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(28, 'com_joomlaupdate', 'component', 'com_joomlaupdate', '', 1, 1, 0, 1, '{"name":"com_joomlaupdate","type":"component","creationDate":"February 2012","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_JOOMLAUPDATE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(29, 'com_tags', 'component', 'com_tags', '', 1, 1, 1, 1, '{"name":"com_tags","type":"component","creationDate":"December 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.1.0","description":"COM_TAGS_XML_DESCRIPTION","group":""}', '{"tag_layout":"_:default","save_history":"1","history_limit":5,"show_tag_title":"0","tag_list_show_tag_image":"0","tag_list_show_tag_description":"0","tag_list_image":"","show_tag_num_items":"0","tag_list_orderby":"title","tag_list_orderby_direction":"ASC","show_headings":"0","tag_list_show_date":"0","tag_list_show_item_image":"0","tag_list_show_item_description":"0","tag_list_item_maximum_characters":0,"return_any_or_all":"1","include_children":"0","maximum":200,"tag_list_language_filter":"all","tags_layout":"_:default","all_tags_orderby":"title","all_tags_orderby_direction":"ASC","all_tags_show_tag_image":"0","all_tags_show_tag_descripion":"0","all_tags_tag_maximum_characters":20,"all_tags_show_tag_hits":"0","filter_field":"1","show_pagination_limit":"1","show_pagination":"2","show_pagination_results":"1","tag_field_ajax_mode":"1","show_feed_link":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(30, 'com_contenthistory', 'component', 'com_contenthistory', '', 1, 1, 1, 0, '{"name":"com_contenthistory","type":"component","creationDate":"May 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.0","description":"COM_CONTENTHISTORY_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(31, 'com_ajax', 'component', 'com_ajax', '', 1, 1, 1, 0, '{"name":"com_ajax","type":"component","creationDate":"August 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.0","description":"COM_AJAX_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(32, 'com_postinstall', 'component', 'com_postinstall', '', 1, 1, 1, 1, '{"name":"com_postinstall","type":"component","creationDate":"September 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.0","description":"COM_POSTINSTALL_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(100, 'PHPMailer', 'library', 'phpmailer', '', 0, 1, 1, 1, '{"name":"PHPMailer","type":"library","creationDate":"2001","author":"PHPMailer","copyright":"(c) 2001-2003, Brent R. Matzelle, (c) 2004-2009, Andy Prevost. All Rights Reserved., (c) 2010-2013, Jim Jagielski. All Rights Reserved.","authorEmail":"jimjag@gmail.com","authorUrl":"https:\\/\\/github.com\\/PHPMailer\\/PHPMailer","version":"5.2.6","description":"LIB_PHPMAILER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(101, 'SimplePie', 'library', 'simplepie', '', 0, 1, 1, 1, '{"name":"SimplePie","type":"library","creationDate":"2004","author":"SimplePie","copyright":"Copyright (c) 2004-2009, Ryan Parman and Geoffrey Sneddon","authorEmail":"","authorUrl":"http:\\/\\/simplepie.org\\/","version":"1.2","description":"LIB_SIMPLEPIE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(102, 'phputf8', 'library', 'phputf8', '', 0, 1, 1, 1, '{"name":"phputf8","type":"library","creationDate":"2006","author":"Harry Fuecks","copyright":"Copyright various authors","authorEmail":"hfuecks@gmail.com","authorUrl":"http:\\/\\/sourceforge.net\\/projects\\/phputf8","version":"0.5","description":"LIB_PHPUTF8_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(103, 'Joomla! Platform', 'library', 'joomla', '', 0, 1, 1, 1, '{"name":"Joomla! Platform","type":"library","creationDate":"2008","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"http:\\/\\/www.joomla.org","version":"13.1","description":"LIB_JOOMLA_XML_DESCRIPTION","group":""}', '{"mediaversion":"95de7e0ca6a4b201f8be8f30da008e29"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(104, 'IDNA Convert', 'library', 'idna_convert', '', 0, 1, 1, 1, '{"name":"IDNA Convert","type":"library","creationDate":"2004","author":"phlyLabs","copyright":"2004-2011 phlyLabs Berlin, http:\\/\\/phlylabs.de","authorEmail":"phlymail@phlylabs.de","authorUrl":"http:\\/\\/phlylabs.de","version":"0.8.0","description":"LIB_IDNA_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(105, 'FOF', 'library', 'fof', '', 0, 1, 1, 1, '{"name":"FOF","type":"library","creationDate":"2013-12-14","author":"Nicholas K. Dionysopoulos \\/ Akeeba Ltd","copyright":"(C)2011-2013 Nicholas K. Dionysopoulos","authorEmail":"nicholas@akeebabackup.com","authorUrl":"https:\\/\\/www.akeebabackup.com","version":"2.1.1","description":"LIB_FOF_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(200, 'mod_articles_archive', 'module', 'mod_articles_archive', '', 0, 1, 1, 0, '{"name":"mod_articles_archive","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters.\\n\\t\\tAll rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_ARTICLES_ARCHIVE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(201, 'mod_articles_latest', 'module', 'mod_articles_latest', '', 0, 1, 1, 0, '{"name":"mod_articles_latest","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LATEST_NEWS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(202, 'mod_articles_popular', 'module', 'mod_articles_popular', '', 0, 1, 1, 0, '{"name":"mod_articles_popular","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_POPULAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(203, 'mod_banners', 'module', 'mod_banners', '', 0, 1, 1, 0, '{"name":"mod_banners","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_BANNERS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(204, 'mod_breadcrumbs', 'module', 'mod_breadcrumbs', '', 0, 1, 1, 1, '{"name":"mod_breadcrumbs","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_BREADCRUMBS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(205, 'mod_custom', 'module', 'mod_custom', '', 0, 1, 1, 1, '{"name":"mod_custom","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_CUSTOM_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(206, 'mod_feed', 'module', 'mod_feed', '', 0, 1, 1, 0, '{"name":"mod_feed","type":"module","creationDate":"July 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_FEED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(207, 'mod_footer', 'module', 'mod_footer', '', 0, 1, 1, 0, '{"name":"mod_footer","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_FOOTER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(208, 'mod_login', 'module', 'mod_login', '', 0, 1, 1, 1, '{"name":"mod_login","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(209, 'mod_menu', 'module', 'mod_menu', '', 0, 1, 1, 1, '{"name":"mod_menu","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_MENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(210, 'mod_articles_news', 'module', 'mod_articles_news', '', 0, 1, 1, 0, '{"name":"mod_articles_news","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_ARTICLES_NEWS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(211, 'mod_random_image', 'module', 'mod_random_image', '', 0, 1, 1, 0, '{"name":"mod_random_image","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_RANDOM_IMAGE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(212, 'mod_related_items', 'module', 'mod_related_items', '', 0, 1, 1, 0, '{"name":"mod_related_items","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_RELATED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(213, 'mod_search', 'module', 'mod_search', '', 0, 1, 1, 0, '{"name":"mod_search","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_SEARCH_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(214, 'mod_stats', 'module', 'mod_stats', '', 0, 1, 1, 0, '{"name":"mod_stats","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_STATS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(215, 'mod_syndicate', 'module', 'mod_syndicate', '', 0, 1, 1, 1, '{"name":"mod_syndicate","type":"module","creationDate":"May 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_SYNDICATE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(216, 'mod_users_latest', 'module', 'mod_users_latest', '', 0, 1, 1, 0, '{"name":"mod_users_latest","type":"module","creationDate":"December 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_USERS_LATEST_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(217, 'mod_weblinks', 'module', 'mod_weblinks', '', 0, 1, 1, 0, '{"name":"mod_weblinks","type":"module","creationDate":"July 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_WEBLINKS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(218, 'mod_whosonline', 'module', 'mod_whosonline', '', 0, 1, 1, 0, '{"name":"mod_whosonline","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_WHOSONLINE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(219, 'mod_wrapper', 'module', 'mod_wrapper', '', 0, 1, 1, 0, '{"name":"mod_wrapper","type":"module","creationDate":"October 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_WRAPPER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(220, 'mod_articles_category', 'module', 'mod_articles_category', '', 0, 1, 1, 0, '{"name":"mod_articles_category","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_ARTICLES_CATEGORY_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(221, 'mod_articles_categories', 'module', 'mod_articles_categories', '', 0, 1, 1, 0, '{"name":"mod_articles_categories","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_ARTICLES_CATEGORIES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(222, 'mod_languages', 'module', 'mod_languages', '', 0, 1, 1, 1, '{"name":"mod_languages","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LANGUAGES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(223, 'mod_finder', 'module', 'mod_finder', '', 0, 1, 0, 0, '{"name":"mod_finder","type":"module","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_FINDER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(300, 'mod_custom', 'module', 'mod_custom', '', 1, 1, 1, 1, '{"name":"mod_custom","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_CUSTOM_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(301, 'mod_feed', 'module', 'mod_feed', '', 1, 1, 1, 0, '{"name":"mod_feed","type":"module","creationDate":"July 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_FEED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(302, 'mod_latest', 'module', 'mod_latest', '', 1, 1, 1, 0, '{"name":"mod_latest","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LATEST_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(303, 'mod_logged', 'module', 'mod_logged', '', 1, 1, 1, 0, '{"name":"mod_logged","type":"module","creationDate":"January 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LOGGED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(304, 'mod_login', 'module', 'mod_login', '', 1, 1, 1, 1, '{"name":"mod_login","type":"module","creationDate":"March 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(305, 'mod_menu', 'module', 'mod_menu', '', 1, 1, 1, 0, '{"name":"mod_menu","type":"module","creationDate":"March 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_MENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(307, 'mod_popular', 'module', 'mod_popular', '', 1, 1, 1, 0, '{"name":"mod_popular","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_POPULAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(308, 'mod_quickicon', 'module', 'mod_quickicon', '', 1, 1, 1, 1, '{"name":"mod_quickicon","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_QUICKICON_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(309, 'mod_status', 'module', 'mod_status', '', 1, 1, 1, 0, '{"name":"mod_status","type":"module","creationDate":"Feb 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_STATUS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(310, 'mod_submenu', 'module', 'mod_submenu', '', 1, 1, 1, 0, '{"name":"mod_submenu","type":"module","creationDate":"Feb 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_SUBMENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(311, 'mod_title', 'module', 'mod_title', '', 1, 1, 1, 0, '{"name":"mod_title","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_TITLE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(312, 'mod_toolbar', 'module', 'mod_toolbar', '', 1, 1, 1, 1, '{"name":"mod_toolbar","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_TOOLBAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(313, 'mod_multilangstatus', 'module', 'mod_multilangstatus', '', 1, 1, 1, 0, '{"name":"mod_multilangstatus","type":"module","creationDate":"September 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_MULTILANGSTATUS_XML_DESCRIPTION","group":""}', '{"cache":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(314, 'mod_version', 'module', 'mod_version', '', 1, 1, 1, 0, '{"name":"mod_version","type":"module","creationDate":"January 2012","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_VERSION_XML_DESCRIPTION","group":""}', '{"format":"short","product":"1","cache":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(315, 'mod_stats_admin', 'module', 'mod_stats_admin', '', 1, 1, 1, 0, '{"name":"mod_stats_admin","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_STATS_XML_DESCRIPTION","group":""}', '{"serverinfo":"0","siteinfo":"0","counter":"0","increase":"0","cache":"1","cache_time":"900","cachemode":"static"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(316, 'mod_tags_popular', 'module', 'mod_tags_popular', '', 0, 1, 1, 0, '{"name":"mod_tags_popular","type":"module","creationDate":"January 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.1.0","description":"MOD_TAGS_POPULAR_XML_DESCRIPTION","group":""}', '{"maximum":"5","timeframe":"alltime","owncache":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(317, 'mod_tags_similar', 'module', 'mod_tags_similar', '', 0, 1, 1, 0, '{"name":"mod_tags_similar","type":"module","creationDate":"January 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.1.0","description":"MOD_TAGS_SIMILAR_XML_DESCRIPTION","group":""}', '{"maximum":"5","matchtype":"any","owncache":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(400, 'plg_authentication_gmail', 'plugin', 'gmail', 'authentication', 0, 0, 1, 0, '{"name":"plg_authentication_gmail","type":"plugin","creationDate":"February 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_GMAIL_XML_DESCRIPTION","group":""}', '{"applysuffix":"0","suffix":"","verifypeer":"1","user_blacklist":""}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(401, 'plg_authentication_joomla', 'plugin', 'joomla', 'authentication', 0, 1, 1, 1, '{"name":"plg_authentication_joomla","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_AUTH_JOOMLA_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(402, 'plg_authentication_ldap', 'plugin', 'ldap', 'authentication', 0, 0, 1, 0, '{"name":"plg_authentication_ldap","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_LDAP_XML_DESCRIPTION","group":""}', '{"host":"","port":"389","use_ldapV3":"0","negotiate_tls":"0","no_referrals":"0","auth_method":"bind","base_dn":"","search_string":"","users_dn":"","username":"admin","password":"bobby7","ldap_fullname":"fullName","ldap_email":"mail","ldap_uid":"uid"}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(404, 'plg_content_emailcloak', 'plugin', 'emailcloak', 'content', 0, 1, 1, 0, '{"name":"plg_content_emailcloak","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CONTENT_EMAILCLOAK_XML_DESCRIPTION","group":""}', '{"mode":"1"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(406, 'plg_content_loadmodule', 'plugin', 'loadmodule', 'content', 0, 1, 1, 0, '{"name":"plg_content_loadmodule","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_LOADMODULE_XML_DESCRIPTION","group":""}', '{"style":"xhtml"}', '', '', 0, '2011-09-18 15:22:50', 0, 0),
(407, 'plg_content_pagebreak', 'plugin', 'pagebreak', 'content', 0, 1, 1, 0, '{"name":"plg_content_pagebreak","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CONTENT_PAGEBREAK_XML_DESCRIPTION","group":""}', '{"title":"1","multipage_toc":"1","showall":"1"}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(408, 'plg_content_pagenavigation', 'plugin', 'pagenavigation', 'content', 0, 1, 1, 0, '{"name":"plg_content_pagenavigation","type":"plugin","creationDate":"January 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_PAGENAVIGATION_XML_DESCRIPTION","group":""}', '{"position":"1"}', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(409, 'plg_content_vote', 'plugin', 'vote', 'content', 0, 1, 1, 0, '{"name":"plg_content_vote","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_VOTE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(410, 'plg_editors_codemirror', 'plugin', 'codemirror', 'editors', 0, 1, 1, 1, '{"name":"plg_editors_codemirror","type":"plugin","creationDate":"28 March 2011","author":"Marijn Haverbeke","copyright":"","authorEmail":"N\\/A","authorUrl":"","version":"3.15","description":"PLG_CODEMIRROR_XML_DESCRIPTION","group":""}', '{"lineNumbers":"1","lineWrapping":"1","matchTags":"1","matchBrackets":"1","marker-gutter":"1","autoCloseTags":"1","autoCloseBrackets":"1","autoFocus":"1","theme":"default","tabmode":"indent"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(411, 'plg_editors_none', 'plugin', 'none', 'editors', 0, 1, 1, 1, '{"name":"plg_editors_none","type":"plugin","creationDate":"August 2004","author":"Unknown","copyright":"","authorEmail":"N\\/A","authorUrl":"","version":"3.0.0","description":"PLG_NONE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(412, 'plg_editors_tinymce', 'plugin', 'tinymce', 'editors', 0, 1, 1, 0, '{"name":"plg_editors_tinymce","type":"plugin","creationDate":"2005-2013","author":"Moxiecode Systems AB","copyright":"Moxiecode Systems AB","authorEmail":"N\\/A","authorUrl":"tinymce.moxiecode.com","version":"4.0.10","description":"PLG_TINY_XML_DESCRIPTION","group":""}', '{"mode":"1","skin":"0","mobile":"0","entity_encoding":"raw","lang_mode":"1","text_direction":"ltr","content_css":"1","content_css_custom":"","relative_urls":"1","newlines":"0","invalid_elements":"script,applet,iframe","extended_elements":"","html_height":"550","html_width":"750","resizing":"1","element_path":"1","fonts":"1","paste":"1","searchreplace":"1","insertdate":"1","colors":"1","table":"1","smilies":"1","hr":"1","link":"1","media":"1","print":"1","directionality":"1","fullscreen":"1","alignment":"1","visualchars":"1","visualblocks":"1","nonbreaking":"1","template":"1","blockquote":"1","wordcount":"1","advlist":"1","autosave":"1","contextmenu":"1","inlinepopups":"1","custom_plugin":"","custom_button":""}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(413, 'plg_editors-xtd_article', 'plugin', 'article', 'editors-xtd', 0, 1, 1, 1, '{"name":"plg_editors-xtd_article","type":"plugin","creationDate":"October 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_ARTICLE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(414, 'plg_editors-xtd_image', 'plugin', 'image', 'editors-xtd', 0, 1, 1, 0, '{"name":"plg_editors-xtd_image","type":"plugin","creationDate":"August 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_IMAGE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(415, 'plg_editors-xtd_pagebreak', 'plugin', 'pagebreak', 'editors-xtd', 0, 1, 1, 0, '{"name":"plg_editors-xtd_pagebreak","type":"plugin","creationDate":"August 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_EDITORSXTD_PAGEBREAK_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(416, 'plg_editors-xtd_readmore', 'plugin', 'readmore', 'editors-xtd', 0, 1, 1, 0, '{"name":"plg_editors-xtd_readmore","type":"plugin","creationDate":"March 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_READMORE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(417, 'plg_search_categories', 'plugin', 'categories', 'search', 0, 1, 1, 0, '{"name":"plg_search_categories","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_CATEGORIES_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(418, 'plg_search_contacts', 'plugin', 'contacts', 'search', 0, 1, 1, 0, '{"name":"plg_search_contacts","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_CONTACTS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `wani_extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(419, 'plg_search_content', 'plugin', 'content', 'search', 0, 1, 1, 0, '{"name":"plg_search_content","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_CONTENT_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(420, 'plg_search_newsfeeds', 'plugin', 'newsfeeds', 'search', 0, 1, 1, 0, '{"name":"plg_search_newsfeeds","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_NEWSFEEDS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(421, 'plg_search_weblinks', 'plugin', 'weblinks', 'search', 0, 1, 1, 0, '{"name":"plg_search_weblinks","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_WEBLINKS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(422, 'plg_system_languagefilter', 'plugin', 'languagefilter', 'system', 0, 0, 1, 1, '{"name":"plg_system_languagefilter","type":"plugin","creationDate":"July 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SYSTEM_LANGUAGEFILTER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(423, 'plg_system_p3p', 'plugin', 'p3p', 'system', 0, 1, 1, 0, '{"name":"plg_system_p3p","type":"plugin","creationDate":"September 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_P3P_XML_DESCRIPTION","group":""}', '{"headers":"NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(424, 'plg_system_cache', 'plugin', 'cache', 'system', 0, 0, 1, 1, '{"name":"plg_system_cache","type":"plugin","creationDate":"February 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CACHE_XML_DESCRIPTION","group":""}', '{"browsercache":"0","cachetime":"15"}', '', '', 0, '0000-00-00 00:00:00', 9, 0),
(425, 'plg_system_debug', 'plugin', 'debug', 'system', 0, 1, 1, 0, '{"name":"plg_system_debug","type":"plugin","creationDate":"December 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_DEBUG_XML_DESCRIPTION","group":""}', '{"profile":"1","queries":"1","memory":"1","language_files":"1","language_strings":"1","strip-first":"1","strip-prefix":"","strip-suffix":""}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(426, 'plg_system_log', 'plugin', 'log', 'system', 0, 1, 1, 1, '{"name":"plg_system_log","type":"plugin","creationDate":"April 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_LOG_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(427, 'plg_system_redirect', 'plugin', 'redirect', 'system', 0, 0, 1, 1, '{"name":"plg_system_redirect","type":"plugin","creationDate":"April 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_REDIRECT_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(428, 'plg_system_remember', 'plugin', 'remember', 'system', 0, 1, 1, 1, '{"name":"plg_system_remember","type":"plugin","creationDate":"April 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_REMEMBER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 7, 0),
(429, 'plg_system_sef', 'plugin', 'sef', 'system', 0, 1, 1, 0, '{"name":"plg_system_sef","type":"plugin","creationDate":"December 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEF_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 8, 0),
(430, 'plg_system_logout', 'plugin', 'logout', 'system', 0, 1, 1, 1, '{"name":"plg_system_logout","type":"plugin","creationDate":"April 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SYSTEM_LOGOUT_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(431, 'plg_user_contactcreator', 'plugin', 'contactcreator', 'user', 0, 0, 1, 0, '{"name":"plg_user_contactcreator","type":"plugin","creationDate":"August 2009","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CONTACTCREATOR_XML_DESCRIPTION","group":""}', '{"autowebpage":"","category":"34","autopublish":"0"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(432, 'plg_user_joomla', 'plugin', 'joomla', 'user', 0, 1, 1, 0, '{"name":"plg_user_joomla","type":"plugin","creationDate":"December 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2009 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_USER_JOOMLA_XML_DESCRIPTION","group":""}', '{"strong_passwords":"1","autoregister":"1"}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(433, 'plg_user_profile', 'plugin', 'profile', 'user', 0, 0, 1, 0, '{"name":"plg_user_profile","type":"plugin","creationDate":"January 2008","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_USER_PROFILE_XML_DESCRIPTION","group":""}', '{"register-require_address1":"1","register-require_address2":"1","register-require_city":"1","register-require_region":"1","register-require_country":"1","register-require_postal_code":"1","register-require_phone":"1","register-require_website":"1","register-require_favoritebook":"1","register-require_aboutme":"1","register-require_tos":"1","register-require_dob":"1","profile-require_address1":"1","profile-require_address2":"1","profile-require_city":"1","profile-require_region":"1","profile-require_country":"1","profile-require_postal_code":"1","profile-require_phone":"1","profile-require_website":"1","profile-require_favoritebook":"1","profile-require_aboutme":"1","profile-require_tos":"1","profile-require_dob":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(434, 'plg_extension_joomla', 'plugin', 'joomla', 'extension', 0, 1, 1, 1, '{"name":"plg_extension_joomla","type":"plugin","creationDate":"May 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_EXTENSION_JOOMLA_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(435, 'plg_content_joomla', 'plugin', 'joomla', 'content', 0, 1, 1, 0, '{"name":"plg_content_joomla","type":"plugin","creationDate":"November 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CONTENT_JOOMLA_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(436, 'plg_system_languagecode', 'plugin', 'languagecode', 'system', 0, 0, 1, 0, '{"name":"plg_system_languagecode","type":"plugin","creationDate":"November 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SYSTEM_LANGUAGECODE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 10, 0),
(437, 'plg_quickicon_joomlaupdate', 'plugin', 'joomlaupdate', 'quickicon', 0, 1, 1, 1, '{"name":"plg_quickicon_joomlaupdate","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_QUICKICON_JOOMLAUPDATE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(438, 'plg_quickicon_extensionupdate', 'plugin', 'extensionupdate', 'quickicon', 0, 1, 1, 1, '{"name":"plg_quickicon_extensionupdate","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_QUICKICON_EXTENSIONUPDATE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(439, 'plg_captcha_recaptcha', 'plugin', 'recaptcha', 'captcha', 0, 0, 1, 0, '{"name":"plg_captcha_recaptcha","type":"plugin","creationDate":"December 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CAPTCHA_RECAPTCHA_XML_DESCRIPTION","group":""}', '{"public_key":"","private_key":"","theme":"clean"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(440, 'plg_system_highlight', 'plugin', 'highlight', 'system', 0, 1, 1, 0, '{"name":"plg_system_highlight","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SYSTEM_HIGHLIGHT_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 7, 0),
(441, 'plg_content_finder', 'plugin', 'finder', 'content', 0, 0, 1, 0, '{"name":"plg_content_finder","type":"plugin","creationDate":"December 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CONTENT_FINDER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(442, 'plg_finder_categories', 'plugin', 'categories', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_categories","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_CATEGORIES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(443, 'plg_finder_contacts', 'plugin', 'contacts', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_contacts","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_CONTACTS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(444, 'plg_finder_content', 'plugin', 'content', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_content","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_CONTENT_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(445, 'plg_finder_newsfeeds', 'plugin', 'newsfeeds', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_newsfeeds","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_NEWSFEEDS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(446, 'plg_finder_weblinks', 'plugin', 'weblinks', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_weblinks","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_WEBLINKS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(447, 'plg_finder_tags', 'plugin', 'tags', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_tags","type":"plugin","creationDate":"February 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_TAGS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(448, 'plg_twofactorauth_totp', 'plugin', 'totp', 'twofactorauth', 0, 1, 1, 0, '{"name":"plg_twofactorauth_totp","type":"plugin","creationDate":"August 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.0","description":"PLG_TWOFACTORAUTH_TOTP_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(449, 'plg_authentication_cookie', 'plugin', 'cookie', 'authentication', 0, 1, 1, 0, '{"name":"plg_authentication_cookie","type":"plugin","creationDate":"July 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_AUTH_COOKIE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(450, 'plg_twofactorauth_yubikey', 'plugin', 'yubikey', 'twofactorauth', 0, 1, 1, 0, '{"name":"plg_twofactorauth_yubikey","type":"plugin","creationDate":"September 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.0","description":"PLG_TWOFACTORAUTH_YUBIKEY_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(503, 'beez3', 'template', 'beez3', '', 0, 1, 1, 0, '{"name":"beez3","type":"template","creationDate":"25 November 2009","author":"Angie Radtke","copyright":"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.","authorEmail":"a.radtke@derauftritt.de","authorUrl":"http:\\/\\/www.der-auftritt.de","version":"3.1.0","description":"TPL_BEEZ3_XML_DESCRIPTION","group":""}', '{"wrapperSmall":"53","wrapperLarge":"72","sitetitle":"","sitedescription":"","navposition":"center","templatecolor":"nature"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(504, 'hathor', 'template', 'hathor', '', 1, 1, 1, 0, '{"name":"hathor","type":"template","creationDate":"May 2010","author":"Andrea Tarr","copyright":"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.","authorEmail":"hathor@tarrconsulting.com","authorUrl":"http:\\/\\/www.tarrconsulting.com","version":"3.0.0","description":"TPL_HATHOR_XML_DESCRIPTION","group":""}', '{"showSiteName":"0","colourChoice":"0","boldText":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(506, 'protostar', 'template', 'protostar', '', 0, 1, 1, 0, '{"name":"protostar","type":"template","creationDate":"4\\/30\\/2012","author":"Kyle Ledbetter","copyright":"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"","version":"1.0","description":"TPL_PROTOSTAR_XML_DESCRIPTION","group":""}', '{"templateColor":"","logoFile":"","googleFont":"1","googleFontName":"Open+Sans","fluidContainer":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(507, 'isis', 'template', 'isis', '', 1, 1, 1, 0, '{"name":"isis","type":"template","creationDate":"3\\/30\\/2012","author":"Kyle Ledbetter","copyright":"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"","version":"1.0","description":"TPL_ISIS_XML_DESCRIPTION","group":""}', '{"templateColor":"","logoFile":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(600, 'English (United Kingdom)', 'language', 'en-GB', '', 0, 1, 1, 1, '{"name":"English (United Kingdom)","type":"language","creationDate":"2013-03-07","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.1","description":"en-GB site language","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(601, 'English (United Kingdom)', 'language', 'en-GB', '', 1, 1, 1, 1, '{"name":"English (United Kingdom)","type":"language","creationDate":"2013-03-07","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.1","description":"en-GB administrator language","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(604, 'Español (Formal Internacional)', 'language', 'es-ES', '', 1, 1, 1, 0, '{"name":"Espa\\u00f1ol (Formal Internacional)","type":"language","creationDate":"20-01-2014","author":"Proyecto Joomla! Spanish","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. Todos los derechos reservados.","authorEmail":"joomlaspanish@joomlaspanish.org","authorUrl":"www.joomlaspanish.org","version":"3.2.1","description":"es-ES idioma administrador para Joomla 3.2.1","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(605, 'Español (España)', 'language', 'es-ES', '', 0, 1, 1, 0, '{"name":"Espa\\u00f1ol (Espa\\u00f1a)","type":"language","creationDate":"20-01-2014","author":"Joomla! Spanish","copyright":"Copyright (C) 2005 - 2013 Open Source Matters & joomlaspanish.org. All rights reserved.","authorEmail":"joomlaspanish@joomlaspanish.org","authorUrl":"www.joomlaspanish.org","version":"3.2.1","description":"es-ES Idiomas parte frontend Joomla! 3.2 por www.joomlaspanish.org","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(700, 'files_joomla', 'file', 'joomla', '', 0, 1, 1, 1, '{"name":"files_joomla","type":"file","creationDate":"December 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.1","description":"FILES_JOOMLA_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10000, 'st_vela', 'template', 'st_vela', '', 0, 1, 1, 0, '{"name":"st_vela","type":"template","creationDate":"14 March 2013","author":"Neo","copyright":"Copyright (C) 2005 - 2012 JoomAvatar All rights reserved.","authorEmail":"beautifultemplates@gmail.com","authorUrl":"http:\\/\\/www.beautiful-templates.com","version":"1.0.0","description":"AVATAR_DREAM_DESCRIPTION","group":""}', '{"google_analytics":"","copyright":"1","template_panel_setting":"1","active_responsive":"0","load_jquery":"1","template_showcase":"","template_background":"","doctype":"5","show_main_body":"1","hide_menu_items":"0","show_message":"1","404_itemid":"","template_width":"960px","avatar_header_block":"block-default-width","avatar_header_inside_block":"block-default-width","avatar_tool_block":"block-default-width","avatar_body_top_block":"block-default-width","avatar_body_middle_block":"block-default-width","avatar_body_bottom_block":"block-default-width","avatar_footer_inside_block":"block-default-width","avatar_footer_block":"block-default-width","avatar_full_1_block":"block-default-width","avatar_full_2_block":"block-default-width","avatar_full_3_block":"block-default-width","avatar_full_4_block":"block-default-width","avatar_full_5_block":"block-default-width","avatar_full_6_block":"block-default-width","top_left":"33.33","top_right":"33.33","promo_top_left":"33.33","promo_top_right":"33.33","promo_bottom_left":"33.33","promo_bottom_right":"33.33","left":"23","right":"23","inner_left":"23","inner_right":"23","footer_left":"33.33","footer_right":"33.33","google_font_api":"0","go_to_top":"0","go_to_top_text":"","css3_effect":"0","css3_effect_scroll":".avatar-css3-effect-scroll","optimize":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10001, 'pri_blog', 'template', 'pri_blog', '', 0, 1, 1, 0, '{"name":"pri_blog","type":"template","creationDate":"Dec 2013","author":"Devpri","copyright":"Copyright (C)2010 - 2013 Devpri. All rights reserved.","authorEmail":"contact@devpri.com","authorUrl":"http:\\/\\/www.devpri.com","version":"1.2","description":"\\n\\t\\t\\n\\t\\tPRI Blog is a Responsive Joomla! Blog Template perfect for your personal blog. It\\u2019s fully responsive and optimized for desktops, tablets and smartphones. With Helix II framework you can manage the presets and colors of your blog, you have full control over the layout and module positions.\\n\\t\\t\\n\\t","group":""}', '{"layout_width":"1170","layout_type":"responsive","logo_type":"image","logo_position":"logo","logo_type_text":"PRI Simple","logo_type_slogan":"Responsive Joomla! Template","logo_width":"220","logo_height":"50","footer_position":"copyright","showcp":"1","copyright":"Copyright \\u00a9  {year} Devpri - All Rights Reserved.","jcredit":"0","showtop":"1","preset":"preset1","preset1_header":"#f8f8f8","preset1_bg":"#f5f5f5","preset1_text":"#666666","preset1_link":"#287099","preset2_header":"#f8f8f8","preset2_bg":"#f5f5f5","preset2_text":"#666666","preset2_link":"#FF4900","preset3_header":"#f8f8f8","preset3_bg":"#f5f5f5","preset3_text":"#666666","preset3_link":"#5FC26C","preset4_header":"#f8f8f8","preset4_bg":"#f5f5f5","preset4_text":"#666666","preset4_link":"#8254A4","preset5_header":"#f8f8f8","preset5_bg":"#f5f5f5","preset5_text":"#666666","preset5_link":"#F7A749","preset6_header":"#f8f8f8","preset6_bg":"#f5f5f5","preset6_text":"#666666","preset6_link":"#21B8EF","menu":"mainmenu","menutype":"mega","menu_col_width":"200","show_menu_image":"1","menu_image_position":"1","submenu_position":"0","init_x":"0","init_y":"0","sub_x":"0","sub_y":"0","body_font":"","header_font":"","header_selectors":"","other_font":"","cache_time":"60","compress_css":"0","compress_js":"0","enable_ga":"0","ga_code":"","loadjquery":"0","loadfromcdn":"0","lessoption":"1","hide_component_area":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10002, 'JoomLike', 'template', 'joomlike', '', 0, 1, 1, 0, '{"name":"JoomLike","type":"template","creationDate":"10.11.2012","author":"Fio","copyright":"Copyright (c) 2012 - vonfio.de","authorEmail":"ich@vonfio.de","authorUrl":"http:\\/\\/www.vonfio.de","version":"3.2.0","description":"\\n\\t\\n\\t<link rel=\\"stylesheet\\" type=\\"text\\/css\\" href=\\"..\\/templates\\/joomlike\\/admin\\/style.css\\" \\/>\\n\\t<style type=\\"text\\/css\\" media=\\"all\\">\\n\\t\\t<!--\\n\\t\\t#wrap1 {padding:0px 0px 4px 0px;}  \\n\\t\\t.jl_container {text-align: center; } .jl_center { margin: 0 auto; width: 150px;}\\n\\t\\t\\n\\t\\t.jl_title { font-family: Arial, Helvetica, sans-serif; font-weight: normal; font-style: italic; color: #DDD; font-size: 21px; text-align: left !important; padding: 10px 0 0 20px;}\\n\\t\\t.jl_head1 { font-size: 46px; color: #888; height: 46px; line-height: 46px; }\\n\\t\\t.jl_head3 { font-size: 36px; color: #888; height: 46px; line-height: 50px; }\\n\\t\\t.jl_head2 { font-size: 36px; color: #DDD; text-decoration: underline; height: 46px; line-height: 46px;}\\n\\t\\t.jl_head2 span { color: #858585; text-decoration: none; font-size: 21px;}\\n\\t\\t.jl_head1, .jl_head2, .jl_head3 { float: left; }\\n\\n\\t\\t#wrap1 img {float:left; margin: 5px 10px 10px 0;}\\n\\t\\t\\n\\t\\t.wrap2 {background:#fff;padding: 20px; font-family: Arial; font-size:13px; color: #4d4d4d; line-height: 24px;}\\n\\t\\t\\n\\t\\t.leftart {margin: 16px 0 0 0; font-weight: normal!important; }\\n\\t\\t\\n\\t\\t.livedemo { margin-top: 28px; }\\n.clear { clear: both; height: 0; line-height:0;}\\n\\t\\t-->\\n\\t<\\/style>\\n\\t\\n\\t<div id=\\"wrap1\\">  \\n\\t\\n\\t\\t<div class=\\"jl_title\\"><div class=\\"jl_head1\\">J<\\/div><div class=\\"jl_head2\\"><span>OOM<\\/span><\\/div><div class=\\"jl_head3\\">L<\\/div><div class=\\"jl_head2\\"><span>IKE<\\/span><\\/div><\\/div>\\n\\t\\t<div class=\\"clear\\"><\\/div>\\n\\t\\t\\n\\t\\t<div class=\\"wrap2\\">  \\n\\t\\t\\n\\t\\t\\t<a title=\\"Visit the official website!\\" href=\\"http:\\/\\/joomla2.vonfio.de\\/demo\\/joomlike.html\\" target=\\"_blank\\"> <img src=\\"..\\/templates\\/joomlike\\/template_thumbnail.png\\" border=\\"0\\" alt=\\"Logo\\" \\/><\\/a>       \\n\\t\\t\\t\\t\\t\\t\\n\\t\\t\\t<div class=\\"leftart\\">            \\n\\t\\t\\t\\t\\t\\t \\n\\t\\t\\t<p><strong>Version:<\\/strong> 3.2.0<br \\/><a href=\\"http:\\/\\/www.vonfio.de\\" target=\\"_blank\\">Check for Updates<\\/a><\\/p>\\n\\t\\t\\t<p><strong>License: <\\/strong><a href=\\"http:\\/\\/creativecommons.org\\/licenses\\/by-sa\\/3.0\\/\\" target=\\"_blank\\">Creative Commons<\\/a><\\/p>  \\n\\t\\t\\t\\n\\t\\t\\t<p class=\\"livedemo\\"> <a href=\\"http:\\/\\/joomla2.vonfio.de\\/demo\\/joomlike\\/beispiel.html\\" target=\\"_blank\\">View Joomlike in action<\\/a><\\/p>\\n\\t\\t\\t<p class=\\"livedemo\\"> <a href=\\"http:\\/\\/joomla2.vonfio.de\\/demo\\/joomlike\\/modulpositionen-joomlike.html\\" target=\\"_blank\\">View all module positions<\\/a><\\/p>\\n\\t\\t\\t\\n\\t\\t\\t<p>There are 5 module classes (\\"blue\\", \\"red\\", \\"green\\", \\"yellow\\", \\"blank\\")<\\/p>\\n\\t\\t\\t<p>To hide content use \\"hide-content\\" as pageclass.<\\/p>\\n\\t\\t\\t\\n\\t\\t\\t<\\/div>\\n\\t\\t\\t\\n\\t\\t<\\/div>\\n\\t\\t<\\/div>\\n\\t\\t\\t\\t\\t\\t\\n\\t\\n\\t","group":""}', '{"colorVariation":"blue","templateWidth":"920px","sidebarWidth":"25","cellpadding":"0.5em","bootstrap":"1","googleFont":"1","googleFontFamily":"Carrois Gothic","fontfamily":"Helvetica, Arial, sans-serif","fontsize":"14px","linkcolor":"#6699CC","backlink":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10003, 'System - Helix Framework', 'plugin', 'helix', 'system', 0, 1, 1, 0, '{"name":"System - Helix Framework","type":"plugin","creationDate":"March 2011","author":"JoomShaper.com","copyright":"Copyright (C) 2010 - 2013 JoomShaper. All rights reserved.","authorEmail":"support@joomshaper.com","authorUrl":"www.joomshaper.com","version":"2.1.4","description":"Helix Framework - JoomShaper Template Framework for Joomla 2.5 and 3.X","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10004, 'plg_system_lazydbbackup', 'plugin', 'lazydbbackup', 'system', 0, 1, 1, 0, '{"name":"plg_system_lazydbbackup","type":"plugin","creationDate":"June 28th, 2013","author":"Robert Gastaud","copyright":"GNU General Public License version 2 or later","authorEmail":"rg-consultant@robertg-conseil.fr","authorUrl":"www.joomxtensions.com","version":"3.1.2","description":"PLG_LAZYDBBKP_XML_DESCRIPTION","group":""}', '{"site_only":"0","compress":"1","drop_tables":"1","create_tables":"1","struct_only":"0","locks":"0","foreign_key":"1","comments":"1","xdays":"1","backuptime":"20:00","backupfreq":"1","backuppath":"\\/media","encrypt":"0","password":"","name_format":"0","test":"1","sendmail":"1","addurl":"1","recipient":"jair.quinto@idsolutions-group.com","subject":"Wanitta","body":"Wanitta","config_bkp":"1","user_bkp":"0","menu_bkp":"0","content_bkp":"0","category_bkp":"0","installer_bkp":"0","module_bkp":"0","plugin_bkp":"1","template_bkp":"0","language_bkp":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10005, 'akeeba', 'component', 'com_akeeba', '', 1, 1, 0, 0, '{"name":"Akeeba","type":"component","creationDate":"2014-02-13","author":"Nicholas K. Dionysopoulos","copyright":"Copyright (c)2006-2012 Nicholas K. Dionysopoulos","authorEmail":"nicholas@dionysopoulos.me","authorUrl":"http:\\/\\/www.akeebabackup.com","version":"3.10.1","description":"Akeeba Backup Core - Full Joomla! site backup solution, Core Edition.","group":""}', '{"siteurl":"http:\\/\\/idsolution-group.com\\/wanitta\\/","jlibrariesdir":"\\/home\\/content\\/25\\/11352825\\/html\\/PruebasID\\/wanitta\\/libraries","jversion":"1.6","liveupdate":"stuck=0\\nlastcheck=1394722243\\nupdatedata=\\"Tzo4OiJzdGRDbGFzcyI6ODp7czo5OiJzdXBwb3J0ZWQiO2I6MTtzOjU6InN0dWNrIjtiOjA7czo3OiJ2ZXJzaW9uIjtzOjY6IjMuMTAuMiI7czo0OiJkYXRlIjtzOjEwOiIyMDE0LTAzLTA5IjtzOjk6InN0YWJpbGl0eSI7czo2OiJzdGFibGUiO3M6MTE6ImRvd25sb2FkVVJMIjtzOjg0OiJodHRwOi8vY2RuLmFrZWViYWJhY2t1cC5jb20vZG93bmxvYWRzL2FrZWViYWJhY2t1cC8zLjEwLjIvY29tX2FrZWViYS0zLjEwLjItY29yZS56aXAiO3M6NzoiaW5mb1VSTCI7czo2NDoiaHR0cHM6Ly93d3cuYWtlZWJhYmFja3VwLmNvbS9kb3dubG9hZHMvYWtlZWJhLWJhY2t1cC8zLTEwLTIuaHRtbCI7czoxMjoicmVsZWFzZW5vdGVzIjtzOjQ0MDI6IjxoMz5SZWxlYXNlIGhpZ2hsaWdodHM8L2gzPjxwPiA8Yj5XZWJEQVYgc3VwcG9ydCAoUHJvZmVzc2lvbmFsIHJlbGVhc2Ugb25seSk8L2I+LiAgICBZb3UgY2FuIG5vdyBhdXRvbWF0aWNhbGx5IHVwbG9hZCBiYWNrdXAgYXJjaGl2ZXMgdG8gYW55IFdlYkRBVi1lbmFibGVkIHN0b3JhZ2Ugc2VydmljZS4gVGhpcyBhbGxvd3MgeW91IHRvIGNvbm5lY3QgICAgdG8gbW9yZSB0aGFuIDQwICh5ZXMsIGZvcnR5ISkgbmV3IGNsb3VkIHN0b3JhZ2UgZW5naW5lcyBpbmNsdWRpbmcgdGhlIGZyZXF1ZW50bHkgYXNrZWQgQm94LmNvbSBhbmQgQ29weS5jb20gc3RvcmFnZSAgICBzZXJ2aWNlcy48L3A+PHA+IDxiPlVwbG9hZCBLaWNrc3RhcnQgd2l0aCB0aGUgYmFja3VwIChQcm9mZXNzaW9uYWwgcmVsZWFzZSBvbmx5KTwvYj4uICAgIFlvdSBjYW4gbm93IHRlbGwgQWtlZWJhIEJhY2t1cCB0byB1cGxvYWQga2lja3N0YXJ0LnBocCBhdCB0aGUgc2FtZSB0aW1lIGl0IHVwbG9hZHMgeW91ciBiYWNrdXAgYXJjaGl2ZSB0byByZW1vdGUgICAgc3RvcmFnZSAoZS5nLiBGVFAgb3IgU0ZUUCksIGFsbG93aW5nIHlvdSB0byBwZXJmb3JtIGFuIGVhc3kgc2l0ZSBtb3ZlIHdpdGhvdXQgZXZlciBsZWF2aW5nIHRoZSBjb21mb3J0IG9mIHlvdXIgICAgYnJvd3Nlci4gWWVzLCBpdCB3b3JrcyBvbiBtb2JpbGUgZGV2aWNlcywgdG9vICh1c2luZyBhIHRhYmxldCBpcyBzdHJvbmdseSByZWNvbW1lbmRlZCkhPC9wPjxwPiA8Yj4iTGFyZ2Ugc2l0ZSBzY2FubmVyIiBlbmdpbmU8L2I+LiAgICBPdXIgcmVndWxhciBmaWxlIHNjYW5uZXIgZW5naW5lICgiU21hcnQgc2Nhbm5lciIpIHdvcmtzIGJlc3Qgd2hlbiB5b3UgZG9uJ3QgaGF2ZSBkaXJlY3RvcmllcyB3aXRoIGh1bmRyZWRzIG9yICAgIHRob3VzYW5kcyBvZiBmaWxlcywgb3IgdmVyeSBkZWVwbHkgbmVzdGVkIGRpcmVjdG9yaWVzIHdpdGggb3ZlciAxMDAgZmlsZXMgZWFjaC4gVGhlIG5ldyAiTGFyZ2Ugc2l0ZSBzY2FubmVyIiBlbmdpbmUgICAgaXMgb3B0aW1pc2VkIGV4YWN0bHkgZm9yIHRob3NlIHNpdGVzLCBlLmcuIHZlcnkgYWN0aXZlIGJsb2dzLCBuZXdzIHNpdGVzLCBlLWNvbW1lcmNlIHNpdGVzIHdpdGggdG9ucyBvZiBpbWFnZXMgZXRjLjwvcD48cD4gPGI+SW1wcm92ZWQgU3lzdGVtIFJlc3RvcmUgUG9pbnRzPC9iPi4gT24gcG9wdWxhciByZXF1ZXN0LCBvdXIgU3lzdGVtIFJlc3RvcmUgUG9pbnRzIGZlYXR1cmUgbm93IHN1cHBvcnRzIHZpcnR1YWxseSAgICBldmVyeSB0eXBlIG9mIGV4dGVuc2lvbiBwYWNrYWdlIGF2YWlsYWJsZSBmb3IgSm9vbWxhISwgaW5jbHVkaW5nIHRoZSBhbGwtaW1wb3J0YW50ICJwYWNrYWdlIiBhbmQgImxpYnJhcnkiIHR5cGVzLiAgICBNb3Jlb3ZlciB3ZSBoYXZlIGlkZW50aWZpZWQgYW5kIGZpeGVkIGEgYnVnIHdoaWNoIHdvdWxkIHByZXZlbnQgeW91IGZyb20gdGFraW5nIFN5c3RlbSBSZXN0b3JlIFBvaW50cyBmb3IgICAgY29tcG9uZW50cy48L3A+PHA+IDxiPlN0YWJpbGl0eSBpbXByb3ZlbWVudHM8L2I+LiAgICBXZSBoYXZlIGlkZW50aWZpZWQgYW5kIGFkZHJlc3NlZCBzZXZlcmFsIGlzc3VlcyBjYXVzZWQgYnkgdW5zY3J1cHVsb3VzIGhvc3QgYW5kIHVzZXIgaW50ZXJhY3Rpb24gd2l0aCBvdXIgc29mdHdhcmUuICAgIEluc3RlYWQgb2YgZmFpbGluZyBvdXQgY29sZCwgb3VyIHNvZnR3YXJlIHdpbGwgbm93IGF0dGVtcHQgdG8gZGV0ZWN0IHRoZXNlIGV4dGVybmFsIHByb2JsZW1zIGFuZCB3b3JrIGFyb3VuZCB0aGVtLiAgICBJZiBpdCdzIG5vdCBwb3NzaWJsZSBhIHdhcm5pbmcgd2lsbCBiZSBpc3N1ZWQsIHBvaW50aW5nIHlvdSB0byB0aGUgcmlnaHQgZGlyZWN0aW9uIGZvciBmaXhpbmcgdGhlIHJvb3QgY2F1c2UgICAgeW91cnNlbGYuPC9wPjxoMz5QSFAgNS4zLCA1LjQgb3IgNS41IGlzIHJlcXVpcmVkPC9oMz48cD4gVGhpcyB2ZXJzaW9uIHJlcXVpcmVzIFBIUCA1LjMsIDUuNCBvciA1LjUuIFRoZSByYXRpb25hbGUgYmVoaW5kIHRoaXMgaXMgZXhwbGFpbmVkIGluIG91ciA8YSBocmVmPSJodHRwczovL3d3dy5ha2VlYmFiYWNrdXAuY29tL2hvbWUvbmV3cy81NS1nZW5lcmFsLzE1MDEtZW5kLW9mLXBocDUyLXN1cHBvcnQuaHRtbCI+IHN0YXRlbWVudCBvZiBtaWQtRmVicnVhcnkgMjAxMzwvYT4uIEl0IHdvbid0IGluc3RhbGwgb24gaG9zdHMgcnVubmluZyBQSFAgNS4yIG9yIGVhcmxpZXIuIFBIUCA1LjMuNCBvciBsYXRlciBpcyByZXF1aXJlZCwgZHVlIHRvIHNob3ctc3RvcHBlciBidWdzIGluICAgIGVhcmxpZXIgdmVyc2lvbnMgb2YgUEhQIDUuMy4gTW9yZW92ZXIsIGR1ZSB0byB0aGUgbmVjZXNzYXJ5IEpvb21sYSEgQVBJIGNoYW5nZXMgICAgZm91bmQgb25seSBpbiBKb29tbGEhIDIuNS42IG9yIGxhdGVyLCB0aGlzIHZlcnNpb24gd2lsbCBub3QgaW5zdGFsbCBvbiBKb29tbGEhICAgIDIuNS41IG9yIGVhcmxpZXIgdmVyc2lvbnMuIEluIGFueSBjYXNlLCBpdCB3aWxsIHRlbGwgeW91IGV4YWN0bHkgd2h5IGl0IGNhbm5vdCBiZSBpbnN0YWxsZWQgKG1pbmltdW0gUEhQIG9yIEpvb21sYSEgdmVyc2lvbiBub3Qgc2F0aXNmaWVkKS48L3A+PGgzPkpvb21sYSEgMi41IGFuZCAzLjIgYXJlIHN1cHBvcnRlZDwvaDM+PHA+IFRoaXMgdmVyc2lvbiBvZiBBa2VlYmEgQmFja3VwIGNhbiBiZSBpbnN0YWxsZWQgb24gSm9vbWxhISAyLjUuNiBvciBhbnkgbGF0ZXIgMi41LnggcmVsZWFzZSwgYXMgd2VsbCBhcyBhbnkgMy4yLnggcmVsZWFzZS4gSXQgaXMgbm90IGNvbXBhdGlibGUgd2l0aCBKb29tbGEhIDMuMCBvciAzLjEuIFRoZXNlIHZlcnNpb25zIG9mIEpvb21sYSEgYXJlIG9sZCBhbmQgdnVsbmVyYWJsZS4gICAgSWYgeW91IGFyZSB1c2luZyB0aGVtIHBsZWFzZSB1cGdyYWRlIHRvIDMuMi48L3A+PGgzPkNoYW5nZWxvZzwvaDM+PGg0PkJ1ZyBmaXhlczwvaDQ+PHVsPiA8bGk+W0xPV10gU3RlcCBhbmQgc3Vic3RlcCBub3Qgc2hvd24gZHVyaW5nIGRhdGFiYXNlIGJhY2t1cDwvbGk+IDxsaT5bTE9XXSBUaGUgYmFja3VwIGFyY2hpdmUgc2l6ZSB3YXMgcmVwb3J0ZWQgaW5jb3JyZWN0bHkgd2hlbiB0aGUgIlByb2Nlc3MgZWFjaCBwYXJ0IGltbWVkaWF0ZWx5IiBvcHRpb24gaXMgZW5hYmxlZDwvbGk+IDxsaT5bTUVESVVNXSBXZWJEQVYgZmFpbHMgd2hlbiB0aGUgYmFzZSBVUkwgZG9lcyBub3QgY29udGFpbiBhIHRyYWlsaW5nIHNsYXNoIChlLmcuIEJveC5jb20ncyBiYXNlIFVSTCk8L2xpPiA8bGk+W01FRElVTV0gV2ViREFWIG92ZXIgU1NMIChIVFRQUykgZmFpbHMgb24gaG9zdHMgd2l0aG91dCBhIHN5c3RlbS13aWRlIGNlcnRpZmljYXRlIGF1dGhvcml0eSByb290PC9saT48L3VsPjxoND5OZXcgZmVhdHVyZXM8L2g0Pjx1bD4gPGxpPltQUk9dIENST04gc2NyaXB0IHRvIGNoZWNrIGZvciBmYWlsZWQgYmFja3VwczwvbGk+IDxsaT5bUFJPXSBTcGVjaWFsIEFOR0lFIHZlcnNpb25zIGZvciBXb3JkUHJlc3MsIHBocEJCIGFuZCBtaXNjZWxsYW5lb3VzIFBIUCBzY3JpcHRzIGFsbG93IHlvdSB0byBiYWNrdXAgYW5kIHJlc3RvcmUgZXZlbiBtb3JlIHNpdGVzIGFuZCBzY3JpcHRzITwvbGk+PC91bD48aDQ+TWlzY2VsbGFuZW91cyBjaGFuZ2VzPC9oND48dWw+IDxsaT5JbnN0cnVjdCBicm93c2VycyB0byBOT1QgYXV0by1jb21wbGV0ZSBwYXNzd29yZCBmaWVsZHMgaW4gdGhlIGNvbmZpZ3VyYXRpb24gcGFnZS4gU29tZSBicm93c2VycyB3aWxsIFNUSUxMIHBlcmZvcm0gYXV0by1jb21wbGV0aW9uLjwvbGk+IDxsaT5MaXZlIFVwZGF0ZSBub3cgdXNlcyBkYXRhYmFzZSBzdG9yYWdlIHRvIHNvbHZlIGlzc3VlcyB3aXRoIGl0IGdldHRpbmcgc3R1Y2sgb24gc29tZSBzaXRlczwvbGk+IDxsaT5MaXZlIFVwZGF0ZSBub3cgdXNlcyB0aGUgc2FtZSBCb290c3RyYXAgc3R5bGUgYXMgdGhlIHJlc3Qgb2YgdGhlIGNvbXBvbmVudDwvbGk+IDxsaT5Ob3cgdXNpbmcgdGhlIGJ1aWx0LWluIEpvb21sYSEgZXh0ZW5zaW9ucyB1cGRhdGVyIGluc3RlYWQgb2YgTGl2ZSBVcGRhdGUgdG8gZGVsaXZlciB1cGRhdGVzPC9saT4gPGxpPlRoZSBzaXplIG9mIHRoZSBmYWlsZWQgYmFja3VwIGlzIHN0b3JlZCB3aGVuIHRoZSBiYWNrdXAgcmVjb3JkIGlzIGJlaW5nIGNsZWFuZWQgdXAgYXV0b21hdGljYWxseTwvbGk+IDxsaT5VcGRhdGUgYmFja3VwIGR1cmF0aW9uIGFmdGVyIHBvc3QtcHJvY2Vzc2luZyBpcyBmaW5pc2hlZCwgZ2l2aW5nIG1vcmUgYWNjdXJhdGUgaW5mb3JtYXRpb24gYWJvdXQgYmFja3VwcyB1cGxvYWRpbmcgdGhlaXIgYXJjaGl2ZXMgdG8gcmVtb3RlIHN0b3JhZ2U8L2xpPjwvdWw+PGg0PlJlbW92ZWQgZmVhdHVyZXM8L2g0Pjx1bD4gPGxpPlJlbW92aW5nIHRoZSBvYnNvbGV0ZSAiQWtlZWJhIEJhY2t1cCBOb3RpZmljYXRpb24gTW9kdWxlIjwvbGk+PC91bD4iO30=\\"","lastversion":"3.10.1","minstability":"stable","acceptlicense":true,"acceptsupport":true,"acceptbackuptest":true,"angieupgrade":1}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10006, 'AkeebaStrapper', 'file', 'files_strapper', '', 0, 1, 0, 0, '{"name":"AkeebaStrapper","type":"file","creationDate":"2014-01-04 11:07:34","author":"Nicholas K. Dionysopoulos","copyright":"(C) 2012-2013 Akeeba Ltd.","authorEmail":"nicholas@dionysopoulos.me","authorUrl":"https:\\/\\/www.akeebabackup.com","version":"rev6C30429-1388826454","description":"Namespaced jQuery, jQuery UI and Bootstrap for Akeeba products.","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_filters`
--

CREATE TABLE IF NOT EXISTS `wani_finder_filters` (
  `filter_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL,
  `created_by_alias` varchar(255) NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `map_count` int(10) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `params` mediumtext,
  PRIMARY KEY (`filter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links` (
  `link_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `indexdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `md5sum` varchar(32) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `state` int(5) DEFAULT '1',
  `access` int(5) DEFAULT '0',
  `language` varchar(8) NOT NULL,
  `publish_start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `list_price` double unsigned NOT NULL DEFAULT '0',
  `sale_price` double unsigned NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL,
  `object` mediumblob NOT NULL,
  PRIMARY KEY (`link_id`),
  KEY `idx_type` (`type_id`),
  KEY `idx_title` (`title`),
  KEY `idx_md5` (`md5sum`),
  KEY `idx_url` (`url`(75)),
  KEY `idx_published_list` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`list_price`),
  KEY `idx_published_sale` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`sale_price`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_terms0`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_terms0` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_terms1`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_terms1` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_terms2`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_terms2` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_terms3`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_terms3` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_terms4`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_terms4` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_terms5`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_terms5` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_terms6`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_terms6` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_terms7`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_terms7` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_terms8`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_terms8` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_terms9`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_terms9` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_termsa`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_termsa` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_termsb`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_termsb` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_termsc`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_termsc` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_termsd`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_termsd` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_termse`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_termse` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_links_termsf`
--

CREATE TABLE IF NOT EXISTS `wani_finder_links_termsf` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_taxonomy`
--

CREATE TABLE IF NOT EXISTS `wani_finder_taxonomy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `state` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `access` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `state` (`state`),
  KEY `ordering` (`ordering`),
  KEY `access` (`access`),
  KEY `idx_parent_published` (`parent_id`,`state`,`access`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `wani_finder_taxonomy`
--

INSERT INTO `wani_finder_taxonomy` (`id`, `parent_id`, `title`, `state`, `access`, `ordering`) VALUES
(1, 0, 'ROOT', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_taxonomy_map`
--

CREATE TABLE IF NOT EXISTS `wani_finder_taxonomy_map` (
  `link_id` int(10) unsigned NOT NULL,
  `node_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`node_id`),
  KEY `link_id` (`link_id`),
  KEY `node_id` (`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_terms`
--

CREATE TABLE IF NOT EXISTS `wani_finder_terms` (
  `term_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `weight` float unsigned NOT NULL DEFAULT '0',
  `soundex` varchar(75) NOT NULL,
  `links` int(10) NOT NULL DEFAULT '0',
  `language` char(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `idx_term` (`term`),
  KEY `idx_term_phrase` (`term`,`phrase`),
  KEY `idx_stem_phrase` (`stem`,`phrase`),
  KEY `idx_soundex_phrase` (`soundex`,`phrase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_terms_common`
--

CREATE TABLE IF NOT EXISTS `wani_finder_terms_common` (
  `term` varchar(75) NOT NULL,
  `language` varchar(3) NOT NULL,
  KEY `idx_word_lang` (`term`,`language`),
  KEY `idx_lang` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `wani_finder_terms_common`
--

INSERT INTO `wani_finder_terms_common` (`term`, `language`) VALUES
('a', 'en'),
('about', 'en'),
('after', 'en'),
('ago', 'en'),
('all', 'en'),
('am', 'en'),
('an', 'en'),
('and', 'en'),
('ani', 'en'),
('any', 'en'),
('are', 'en'),
('aren''t', 'en'),
('as', 'en'),
('at', 'en'),
('be', 'en'),
('but', 'en'),
('by', 'en'),
('for', 'en'),
('from', 'en'),
('get', 'en'),
('go', 'en'),
('how', 'en'),
('if', 'en'),
('in', 'en'),
('into', 'en'),
('is', 'en'),
('isn''t', 'en'),
('it', 'en'),
('its', 'en'),
('me', 'en'),
('more', 'en'),
('most', 'en'),
('must', 'en'),
('my', 'en'),
('new', 'en'),
('no', 'en'),
('none', 'en'),
('not', 'en'),
('noth', 'en'),
('nothing', 'en'),
('of', 'en'),
('off', 'en'),
('often', 'en'),
('old', 'en'),
('on', 'en'),
('onc', 'en'),
('once', 'en'),
('onli', 'en'),
('only', 'en'),
('or', 'en'),
('other', 'en'),
('our', 'en'),
('ours', 'en'),
('out', 'en'),
('over', 'en'),
('page', 'en'),
('she', 'en'),
('should', 'en'),
('small', 'en'),
('so', 'en'),
('some', 'en'),
('than', 'en'),
('thank', 'en'),
('that', 'en'),
('the', 'en'),
('their', 'en'),
('theirs', 'en'),
('them', 'en'),
('then', 'en'),
('there', 'en'),
('these', 'en'),
('they', 'en'),
('this', 'en'),
('those', 'en'),
('thus', 'en'),
('time', 'en'),
('times', 'en'),
('to', 'en'),
('too', 'en'),
('true', 'en'),
('under', 'en'),
('until', 'en'),
('up', 'en'),
('upon', 'en'),
('use', 'en'),
('user', 'en'),
('users', 'en'),
('veri', 'en'),
('version', 'en'),
('very', 'en'),
('via', 'en'),
('want', 'en'),
('was', 'en'),
('way', 'en'),
('were', 'en'),
('what', 'en'),
('when', 'en'),
('where', 'en'),
('whi', 'en'),
('which', 'en'),
('who', 'en'),
('whom', 'en'),
('whose', 'en'),
('why', 'en'),
('wide', 'en'),
('will', 'en'),
('with', 'en'),
('within', 'en'),
('without', 'en'),
('would', 'en'),
('yes', 'en'),
('yet', 'en'),
('you', 'en'),
('your', 'en'),
('yours', 'en');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_tokens`
--

CREATE TABLE IF NOT EXISTS `wani_finder_tokens` (
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `weight` float unsigned NOT NULL DEFAULT '1',
  `context` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `language` char(3) NOT NULL DEFAULT '',
  KEY `idx_word` (`term`),
  KEY `idx_context` (`context`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_tokens_aggregate`
--

CREATE TABLE IF NOT EXISTS `wani_finder_tokens_aggregate` (
  `term_id` int(10) unsigned NOT NULL,
  `map_suffix` char(1) NOT NULL,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `term_weight` float unsigned NOT NULL,
  `context` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `context_weight` float unsigned NOT NULL,
  `total_weight` float unsigned NOT NULL,
  `language` char(3) NOT NULL DEFAULT '',
  KEY `token` (`term`),
  KEY `keyword_id` (`term_id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_finder_types`
--

CREATE TABLE IF NOT EXISTS `wani_finder_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `mime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_languages`
--

CREATE TABLE IF NOT EXISTS `wani_languages` (
  `lang_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang_code` char(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `title_native` varchar(50) NOT NULL,
  `sef` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `sitename` varchar(1024) NOT NULL DEFAULT '',
  `published` int(11) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `idx_sef` (`sef`),
  UNIQUE KEY `idx_image` (`image`),
  UNIQUE KEY `idx_langcode` (`lang_code`),
  KEY `idx_access` (`access`),
  KEY `idx_ordering` (`ordering`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `wani_languages`
--

INSERT INTO `wani_languages` (`lang_id`, `lang_code`, `title`, `title_native`, `sef`, `image`, `description`, `metakey`, `metadesc`, `sitename`, `published`, `access`, `ordering`) VALUES
(1, 'en-GB', 'English (UK)', 'English (UK)', 'en', 'en', '', '', '', '', 1, 0, 1),
(3, 'es-ES', 'Español (Formal Internacional) (ES)', 'Español (Formal Internacional) (ES)', 'es', 'es', '', '', '', '', 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_menu`
--

CREATE TABLE IF NOT EXISTS `wani_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL COMMENT 'The type of menu this item belongs to. FK to #__menu_types.menutype',
  `title` varchar(255) NOT NULL COMMENT 'The display title of the menu item.',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'The SEF alias of the menu item.',
  `note` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(1024) NOT NULL COMMENT 'The computed path of the menu item based on the alias field.',
  `link` varchar(1024) NOT NULL COMMENT 'The actually link the menu item refers to.',
  `type` varchar(16) NOT NULL COMMENT 'The type of link: Component, URL, Alias, Separator',
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The published state of the menu link.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'The parent menu item in the menu tree.',
  `level` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The relative level in the tree.',
  `component_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__extensions.id',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__users.id',
  `checked_out_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'The time the menu item was checked out.',
  `browserNav` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The click behaviour of the link.',
  `access` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The access level required to view the menu item.',
  `img` varchar(255) NOT NULL COMMENT 'The image of the menu item.',
  `template_style_id` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL COMMENT 'JSON encoded data for the menu item.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `home` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `language` char(7) NOT NULL DEFAULT '',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_client_id_parent_id_alias_language` (`client_id`,`parent_id`,`alias`,`language`),
  KEY `idx_componentid` (`component_id`,`menutype`,`published`,`access`),
  KEY `idx_menutype` (`menutype`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_path` (`path`(255)),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127 ;

--
-- Volcado de datos para la tabla `wani_menu`
--

INSERT INTO `wani_menu` (`id`, `menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`, `level`, `component_id`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`, `template_style_id`, `params`, `lft`, `rgt`, `home`, `language`, `client_id`) VALUES
(1, '', 'Menu_Item_Root', 'root', '', '', '', '', 1, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 0, '', 0, '', 0, 99, 0, '*', 0),
(2, 'menu', 'com_banners', 'Banners', '', 'Banners', 'index.php?option=com_banners', 'component', 0, 1, 1, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 1, 10, 0, '*', 1),
(3, 'menu', 'com_banners', 'Banners', '', 'Banners/Banners', 'index.php?option=com_banners', 'component', 0, 2, 2, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 2, 3, 0, '*', 1),
(4, 'menu', 'com_banners_categories', 'Categorías', '', 'Banners/Categorías', 'index.php?option=com_categories&extension=com_banners', 'component', 0, 2, 2, 6, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-cat', 0, '', 4, 5, 0, '*', 1),
(5, 'menu', 'com_banners_clients', 'Clientes', '', 'Banners/Clientes', 'index.php?option=com_banners&view=clients', 'component', 0, 2, 2, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-clients', 0, '', 6, 7, 0, '*', 1),
(6, 'menu', 'com_banners_tracks', 'Tracks', '', 'Banners/Tracks', 'index.php?option=com_banners&view=tracks', 'component', 0, 2, 2, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-tracks', 0, '', 8, 9, 0, '*', 1),
(7, 'menu', 'com_contact', 'Contactos', '', 'Contactos', 'index.php?option=com_contact', 'component', 0, 1, 1, 8, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 47, 52, 0, '*', 1),
(8, 'menu', 'com_contact', 'Contactos', '', 'Contactos/Contactos', 'index.php?option=com_contact', 'component', 0, 7, 2, 8, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 48, 49, 0, '*', 1),
(9, 'menu', 'com_contact_categories', 'Categorías', '', 'Contactos/Categorías', 'index.php?option=com_categories&extension=com_contact', 'component', 0, 7, 2, 6, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact-cat', 0, '', 50, 51, 0, '*', 1),
(10, 'menu', 'com_messages', 'Mensajes', '', 'Mensajes', 'index.php?option=com_messages', 'component', 0, 1, 1, 15, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages', 0, '', 53, 58, 0, '*', 1),
(11, 'menu', 'com_messages_add', 'Nuevo mensaje privado', '', 'Mensajes/Nuevo mensaje privado', 'index.php?option=com_messages&task=message.add', 'component', 0, 10, 2, 15, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-add', 0, '', 54, 55, 0, '*', 1),
(12, 'menu', 'com_messages_read', 'Leer mensaje privado', '', 'Mensajes/Leer mensaje privado', 'index.php?option=com_messages', 'component', 0, 10, 2, 15, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-read', 0, '', 56, 57, 0, '*', 1),
(13, 'menu', 'com_newsfeeds', 'Noticias Feeds', '', 'Noticias Feeds', 'index.php?option=com_newsfeeds', 'component', 0, 1, 1, 17, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 59, 64, 0, '*', 1),
(14, 'menu', 'com_newsfeeds_feeds', 'Feeds', '', 'Noticias Feeds/Feeds', 'index.php?option=com_newsfeeds', 'component', 0, 13, 2, 17, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 60, 61, 0, '*', 1),
(15, 'menu', 'com_newsfeeds_categories', 'Categorías', '', 'Noticias Feeds/Categorías', 'index.php?option=com_categories&extension=com_newsfeeds', 'component', 0, 13, 2, 6, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds-cat', 0, '', 62, 63, 0, '*', 1),
(16, 'menu', 'com_redirect', 'Redireccionar', '', 'Redireccionar', 'index.php?option=com_redirect', 'component', 0, 1, 1, 24, 0, '0000-00-00 00:00:00', 0, 0, 'class:redirect', 0, '', 65, 66, 0, '*', 1),
(17, 'menu', 'com_search', 'Búsqueda básica', '', 'Búsqueda básica', 'index.php?option=com_search', 'component', 0, 1, 1, 19, 0, '0000-00-00 00:00:00', 0, 0, 'class:search', 0, '', 67, 68, 0, '*', 1),
(18, 'menu', 'com_weblinks', 'Enlaces Web', '', 'Enlaces Web', 'index.php?option=com_weblinks', 'component', 0, 1, 1, 21, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks', 0, '', 69, 74, 0, '*', 1),
(19, 'menu', 'com_weblinks_links', 'Enlaces', '', 'Enlaces Web/Enlaces', 'index.php?option=com_weblinks', 'component', 0, 18, 2, 21, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks', 0, '', 70, 71, 0, '*', 1),
(20, 'menu', 'com_weblinks_categories', 'Categorías', '', 'Enlaces Web/Categorías', 'index.php?option=com_categories&extension=com_weblinks', 'component', 0, 18, 2, 6, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks-cat', 0, '', 72, 73, 0, '*', 1),
(21, 'menu', 'com_finder', 'Búsqueda inteligente', '', 'Búsqueda inteligente', 'index.php?option=com_finder', 'component', 0, 1, 1, 27, 0, '0000-00-00 00:00:00', 0, 0, 'class:finder', 0, '', 75, 76, 0, '*', 1),
(22, 'menu', 'com_joomlaupdate', 'Actualizar Joomla!', '', 'Actualizar Joomla!', 'index.php?option=com_joomlaupdate', 'component', 1, 1, 1, 32, 0, '0000-00-00 00:00:00', 0, 0, 'class:joomlaupdate', 0, '', 77, 78, 0, '*', 1),
(23, 'main', 'com_tags', 'Etiquetas', '', 'Etiquetas', 'index.php?option=com_tags', 'component', 0, 1, 1, 29, 0, '0000-00-00 00:00:00', 0, 1, 'class:tags', 0, '', 79, 80, 0, '', 1),
(24, 'main', 'com_postinstall', 'Mensajes posteriores a la instalación', '', 'Mensajes posteriores a la instalación', 'index.php?option=com_postinstall', 'component', 0, 1, 1, 32, 0, '0000-00-00 00:00:00', 0, 1, 'class:postinstall', 0, '', 81, 82, 0, '*', 1),
(101, 'mainmenu', 'Inicio', 'inicio', '', 'inicio', 'index.php?option=com_content&view=article&id=1', 'component', 1, 1, 1, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"0","link_titles":"0","show_intro":"0","info_block_position":"1","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_vote":"0","show_icons":"0","show_print_icon":"0","show_email_icon":"0","show_hits":"0","show_tags":"0","show_noauth":"0","urls_position":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":1,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 11, 12, 1, '*', 0),
(102, 'mainmenu', 'Principal', 'principal', '', 'principal', 'index.php?option=com_wrapper&view=wrapper', 'component', -2, 1, 1, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/wanitta\\/Documents\\/PrincipalCP\\/clientes\\/kardex.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"modules"}', 83, 88, 0, '*', 0),
(103, 'mainmenu', 'Proveedores', 'proveedores', '', 'principal/proveedores', 'index.php?option=com_wrapper&view=wrapper', 'component', -2, 102, 2, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/wanitta\\/Documents\\/PrincipalCP\\/prove\\/kardex.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 84, 85, 0, '*', 0),
(104, 'mainmenu', 'Clientes', 'clientes', '', 'principal/clientes', 'index.php?option=com_wrapper&view=wrapper', 'component', -2, 102, 2, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/wanitta\\/Documents\\/PrincipalCP\\/clientes\\/kardex.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":0,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 86, 87, 0, '*', 0),
(105, 'main', 'COM_AKEEBA', 'com-akeeba', '', 'com-akeeba', 'index.php?option=com_akeeba', 'component', 0, 1, 1, 10005, 0, '0000-00-00 00:00:00', 0, 1, '../media/com_akeeba/icons/akeeba-16.png', 0, '', 89, 90, 0, '', 1),
(106, 'mainmenu', 'Nómina', 'nomina', '', 'nomina', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 1, 1, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/nomina\\/views\\/stin_nomina_lista.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 23, 24, 0, '*', 0),
(107, 'mainmenu', 'Inventario', 'inventario', '', 'inventario', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 1, 1, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/inventario\\/views\\/invent_ini.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 27, 30, 0, '*', 0),
(108, 'mainmenu', 'Entradas', 'compras', '', 'compras', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 1, 1, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/compras\\/views\\/compras_ini.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 31, 32, 0, '*', 0),
(109, 'mainmenu', 'Principal', 'principal-1', '', 'principal-1', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 1, 1, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/clientes\\/views\\/kardex.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 13, 22, 0, '*', 0),
(110, 'mainmenu', 'Clientes', 'clientes1', '', 'principal-1/clientes1', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 109, 2, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/clientes\\/views\\/kardex.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 14, 15, 0, '*', 0),
(111, 'mainmenu', 'Proveedores', 'proveedores-1', '', 'principal-1/proveedores-1', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 109, 2, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/proveedores\\/views\\/kardex.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 16, 17, 0, '*', 0),
(112, 'mainmenu', 'Caja', 'caja', '', 'caja', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 1, 1, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/caja\\/views\\/dia_dia.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 25, 26, 0, '*', 0),
(113, 'mainmenu', 'Salidas', 'ventas', '', 'ventas', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 1, 1, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/facturacion\\/views\\/fact_ini.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 33, 42, 0, '*', 0),
(114, 'mainmenu', 'Facturación', 'facturacion', '', 'ventas/facturacion', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 113, 2, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/facturacion\\/views\\/fact_ini.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 34, 35, 0, '*', 0),
(115, 'mainmenu', 'Devoluciones', 'devoluciones', '', 'ventas/devoluciones', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 113, 2, 2, 216, '2014-09-18 20:13:44', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/devoluciones\\/views\\/dev_ini.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 36, 37, 0, '*', 0),
(116, 'mainmenu', 'Créditos', 'creditos', '', 'ventas/creditos', 'index.php?option=com_wrapper&view=wrapper', 'component', -2, 113, 2, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/wanitta\\/Documents\\/PrincipalCP\\/c111lientes\\/kardex.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 38, 39, 0, '*', 0),
(117, 'mainmenu', 'Reportes', 'historial', '', 'ventas/historial', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 113, 2, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/facturacion\\/views\\/fact_histo.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 40, 41, 0, '*', 0),
(118, 'mainmenu', 'Agenda', 'agenda', '', 'agenda', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 1, 1, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/agenda\\/controllers\\/calendario.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 43, 46, 0, '*', 0),
(119, 'mainmenu', 'Despachos', 'despacho', '', 'inventario/despacho', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 107, 2, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/despachos\\/views\\/desp_ini.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 28, 29, 0, '*', 0),
(120, 'mainmenu', 'Reportes', 'reportes-agenda', '', 'agenda/reportes-agenda', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 118, 2, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/agenda\\/controllers\\/reportes.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 44, 45, 0, '*', 0),
(121, 'mainmenu', 'Acceso', 'controlacceso', '', 'principal-1/controlacceso', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 109, 2, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/ingreso\\/kardex_t.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 18, 19, 0, '*', 0),
(122, 'mainmenu', 'Asistencia', 'asistencia', '', 'principal-1/asistencia', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 109, 2, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/ingreso\\/basc_hist2.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 20, 21, 0, '*', 0),
(123, 'mainmenu', 'Insumos', 'insumos', '', 'produccion/insumos', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 124, 2, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/insumos\\/views\\/insumos_ini.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 92, 93, 0, '*', 0),
(124, 'mainmenu', 'Producción', 'produccion', '', 'produccion', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 1, 1, 2, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"url":"\\/administrativo\\/Documents\\/produccion\\/controllers\\/listaOrdenProduccion.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 91, 98, 0, '*', 0),
(125, 'mainmenu', 'Pre-producción', 'procesos', '', 'produccion/procesos', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 124, 2, 2, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"url":"\\/administrativo\\/Documents\\/produccion\\/controllers\\/produccion.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 94, 95, 0, '*', 0),
(126, 'mainmenu', 'Configuración', 'colores', '', 'produccion/colores', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 124, 2, 2, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"url":"\\/administrativo\\/Documents\\/produccion\\/controllers\\/listaprocesos.php","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 96, 97, 0, '*', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_menu_types`
--

CREATE TABLE IF NOT EXISTS `wani_menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL,
  `title` varchar(48) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_menutype` (`menutype`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `wani_menu_types`
--

INSERT INTO `wani_menu_types` (`id`, `menutype`, `title`, `description`) VALUES
(1, 'mainmenu', 'Menú principal', 'El menú principal del sitio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_messages`
--

CREATE TABLE IF NOT EXISTS `wani_messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_messages_cfg`
--

CREATE TABLE IF NOT EXISTS `wani_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_modules`
--

CREATE TABLE IF NOT EXISTS `wani_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `title` varchar(100) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) NOT NULL DEFAULT '',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=89 ;

--
-- Volcado de datos para la tabla `wani_modules`
--

INSERT INTO `wani_modules` (`id`, `asset_id`, `title`, `note`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `published`, `module`, `access`, `showtitle`, `params`, `client_id`, `language`) VALUES
(1, 39, 'Menú Principal', '', '', 1, 'top', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 1, '{"menutype":"mainmenu","base":"","startLevel":"1","endLevel":"0","showAllChildren":"0","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"_menu","cache":"1","cache_time":"900","cachemode":"itemid","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(2, 56, 'Acceso', '', '', 1, 'login', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '', 1, '*'),
(3, 57, 'Artículos populares', '', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_popular', 3, 1, '{"count":"5","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(4, 58, 'Últimos artículos creados', '', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_latest', 3, 1, '{"count":"5","ordering":"c_dsc","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(8, 59, 'Barra de herramientas', '', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_toolbar', 3, 1, '', 1, '*'),
(9, 60, 'Iconos rápidos', '', '', 1, 'icon', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_quickicon', 3, 1, '', 1, '*'),
(10, 61, 'Usuarios conectados', '', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_logged', 3, 1, '{"count":"5","name":"1","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(12, 62, 'Menú Administrador', '', '', 1, 'menu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 3, 1, '{"layout":"","moduleclass_sfx":"","shownew":"1","showhelp":"1","cache":"0"}', 1, '*'),
(13, 63, 'Submenú Administrador', '', '', 1, 'submenu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_submenu', 3, 1, '', 1, '*'),
(14, 64, 'Estado usuario', '', '', 2, 'status', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_status', 3, 1, '', 1, '*'),
(15, 65, 'Título', '', '', 1, 'title', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_title', 3, 1, '', 1, '*'),
(16, 50, 'Acceso', '', '', 1, 'right', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '{"pretext":"","posttext":"","login":"114","logout":"101","greeting":"1","name":"0","usesecure":"0","usetext":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(17, 67, 'Ruta', '', '', 1, 'position-2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_breadcrumbs', 1, 1, '{"moduleclass_sfx":"","showHome":"1","homeText":"","showComponent":"1","separator":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(79, 68, 'Estado Multilenguaje', '', '', 1, 'status', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_multilangstatus', 3, 1, '{"layout":"_:default","moduleclass_sfx":"","cache":"0"}', 1, '*'),
(86, 69, 'Versión de Joomla', '', '', 1, 'footer', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_version', 3, 1, '{"format":"short","product":"1","layout":"_:default","moduleclass_sfx":"","cache":"0"}', 1, '*'),
(87, 54, 'Wanitta', '', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="images/logoW.png" alt="" /></p>', 1, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"0","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(88, 57, 'Linea', '', '', 1, 'right', 211, '2014-08-04 16:54:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_whosonline', 3, 1, '{"showmode":"2","layout":"_:default","moduleclass_sfx":"","cache":"0","filter_groups":"0","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_modules_menu`
--

CREATE TABLE IF NOT EXISTS `wani_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `wani_modules_menu`
--

INSERT INTO `wani_modules_menu` (`moduleid`, `menuid`) VALUES
(2, 0),
(3, 0),
(4, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(12, 0),
(13, 0),
(14, 0),
(15, 0),
(16, 101),
(17, 0),
(79, 0),
(86, 0),
(87, 0),
(88, 101);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_newsfeeds`
--

CREATE TABLE IF NOT EXISTS `wani_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `link` varchar(200) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(10) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(10) unsigned NOT NULL DEFAULT '3600',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` text NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `images` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_overrider`
--

CREATE TABLE IF NOT EXISTS `wani_overrider` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `constant` varchar(255) NOT NULL,
  `string` text NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_postinstall_messages`
--

CREATE TABLE IF NOT EXISTS `wani_postinstall_messages` (
  `postinstall_message_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `extension_id` bigint(20) NOT NULL DEFAULT '700' COMMENT 'FK to #__extensions',
  `title_key` varchar(255) NOT NULL DEFAULT '' COMMENT 'Lang key for the title',
  `description_key` varchar(255) NOT NULL DEFAULT '' COMMENT 'Lang key for description',
  `action_key` varchar(255) NOT NULL DEFAULT '',
  `language_extension` varchar(255) NOT NULL DEFAULT 'com_postinstall' COMMENT 'Extension holding lang keys',
  `language_client_id` tinyint(3) NOT NULL DEFAULT '1',
  `type` varchar(10) NOT NULL DEFAULT 'link' COMMENT 'Message type - message, link, action',
  `action_file` varchar(255) DEFAULT '' COMMENT 'RAD URI to the PHP file containing action method',
  `action` varchar(255) DEFAULT '' COMMENT 'Action method name or URL',
  `condition_file` varchar(255) DEFAULT NULL COMMENT 'RAD URI to file holding display condition method',
  `condition_method` varchar(255) DEFAULT NULL COMMENT 'Display condition method, must return boolean',
  `version_introduced` varchar(50) NOT NULL DEFAULT '3.2.0' COMMENT 'Version when this message was introduced',
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`postinstall_message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `wani_postinstall_messages`
--

INSERT INTO `wani_postinstall_messages` (`postinstall_message_id`, `extension_id`, `title_key`, `description_key`, `action_key`, `language_extension`, `language_client_id`, `type`, `action_file`, `action`, `condition_file`, `condition_method`, `version_introduced`, `enabled`) VALUES
(1, 700, 'PLG_TWOFACTORAUTH_TOTP_POSTINSTALL_TITLE', 'PLG_TWOFACTORAUTH_TOTP_POSTINSTALL_BODY', 'PLG_TWOFACTORAUTH_TOTP_POSTINSTALL_ACTION', 'plg_twofactorauth_totp', 1, 'action', 'site://plugins/twofactorauth/totp/postinstall/actions.php', 'twofactorauth_postinstall_action', 'site://plugins/twofactorauth/totp/postinstall/actions.php', 'twofactorauth_postinstall_condition', '3.2.0', 1),
(2, 700, 'COM_CPANEL_MSG_EACCELERATOR_TITLE', 'COM_CPANEL_MSG_EACCELERATOR_BODY', 'COM_CPANEL_MSG_EACCELERATOR_BUTTON', 'com_cpanel', 1, 'action', 'admin://components/com_admin/postinstall/eaccelerator.php', 'admin_postinstall_eaccelerator_action', 'admin://components/com_admin/postinstall/eaccelerator.php', 'admin_postinstall_eaccelerator_condition', '3.2.0', 1),
(3, 700, 'COM_CPANEL_WELCOME_BEGINNERS_TITLE', 'COM_CPANEL_WELCOME_BEGINNERS_MESSAGE', '', 'com_cpanel', 1, 'message', '', '', '', '', '3.2.0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_redirect_links`
--

CREATE TABLE IF NOT EXISTS `wani_redirect_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `old_url` varchar(255) NOT NULL,
  `new_url` varchar(255) NOT NULL,
  `referer` varchar(150) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_link_old` (`old_url`),
  KEY `idx_link_modifed` (`modified_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_schemas`
--

CREATE TABLE IF NOT EXISTS `wani_schemas` (
  `extension_id` int(11) NOT NULL,
  `version_id` varchar(20) NOT NULL,
  PRIMARY KEY (`extension_id`,`version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `wani_schemas`
--

INSERT INTO `wani_schemas` (`extension_id`, `version_id`) VALUES
(700, '3.2.1'),
(10005, '3.6.0-2012-07-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_session`
--

CREATE TABLE IF NOT EXISTS `wani_session` (
  `session_id` varchar(200) NOT NULL DEFAULT '',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `guest` tinyint(4) unsigned DEFAULT '1',
  `time` varchar(14) DEFAULT '',
  `data` mediumtext,
  `userid` int(11) DEFAULT '0',
  `username` varchar(150) DEFAULT '',
  PRIMARY KEY (`session_id`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `wani_session`
--

INSERT INTO `wani_session` (`session_id`, `client_id`, `guest`, `time`, `data`, `userid`, `username`) VALUES
('84qabhgj4p5ifc5f6e1jlb37m1', 0, 0, '1414422411', '__default|a:8:{s:15:"session.counter";i:69;s:19:"session.timer.start";i:1414420774;s:18:"session.timer.last";i:1414422408;s:17:"session.timer.now";i:1414422411;s:22:"session.client.browser";s:109:"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.104 Safari/537.36";s:8:"registry";O:24:"Joomla\\Registry\\Registry":1:{s:7:"\\0\\0\\0data";O:8:"stdClass":2:{s:5:"users";O:8:"stdClass":1:{s:5:"login";O:8:"stdClass":1:{s:4:"form";O:8:"stdClass":2:{s:6:"return";s:52:"index.php?option=com_wrapper&view=wrapper&Itemid=114";s:4:"data";a:0:{}}}}s:13:"rememberLogin";b:1;}}s:4:"user";O:5:"JUser":46:{s:9:"\\0\\0\\0isRoot";b:1;s:2:"id";s:3:"211";s:4:"name";s:13:"Super Usuario";s:8:"username";s:9:"adminsaga";s:5:"email";s:33:"jair.quinto@idsolutions-group.com";s:8:"password";s:60:"$2y$10$3IBYkVD3c824WkMaqSqd8OzSWNP8bo8UmpNgRA7wUp4OmF9ZagTmW";s:14:"password_clear";s:0:"";s:5:"block";s:1:"0";s:9:"sendEmail";s:1:"1";s:12:"registerDate";s:19:"2014-02-21 18:39:40";s:13:"lastvisitDate";s:19:"2014-10-24 14:51:00";s:10:"activation";s:1:"0";s:6:"params";s:92:"{"admin_style":"","admin_language":"","language":"","editor":"","helpsite":"","timezone":""}";s:6:"groups";a:1:{i:8;s:1:"8";}s:5:"guest";i:0;s:13:"lastResetTime";s:19:"0000-00-00 00:00:00";s:10:"resetCount";s:1:"0";s:12:"requireReset";N;s:10:"\\0\\0\\0_params";O:24:"Joomla\\Registry\\Registry":1:{s:7:"\\0\\0\\0data";O:8:"stdClass":6:{s:11:"admin_style";s:0:"";s:14:"admin_language";s:0:"";s:8:"language";s:0:"";s:6:"editor";s:0:"";s:8:"helpsite";s:0:"";s:8:"timezone";s:0:"";}}s:14:"\\0\\0\\0_authGroups";a:2:{i:0;i:1;i:1;i:8;}s:14:"\\0\\0\\0_authLevels";a:5:{i:0;i:1;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:6;}s:15:"\\0\\0\\0_authActions";N;s:12:"\\0\\0\\0_errorMsg";N;s:10:"\\0\\0\\0_errors";a:0:{}s:3:"aid";i:0;s:8:"usertype";s:5:"Tokin";s:9:"usertype2";s:7:"general";s:6:"agenda";s:1:"0";s:8:"clientes";s:1:"0";s:11:"proveedores";s:1:"0";s:6:"nomina";s:1:"0";s:10:"inventario";s:1:"0";s:7:"compras";s:1:"0";s:12:"cotizaciones";s:1:"0";s:7:"pedidos";s:1:"0";s:6:"ventas";s:1:"0";s:12:"devoluciones";s:1:"0";s:4:"caja";s:1:"0";s:7:"ingreso";s:1:"0";s:4:"auto";s:1:"1";s:9:"despachos";s:1:"0";s:14:"registro_excel";s:1:"0";s:11:"orden_corte";s:1:"0";s:7:"insumos";s:1:"0";s:6:"otpKey";s:0:"";s:4:"otep";s:0:"";}s:13:"session.token";s:32:"f6ec5e3f5d90131f5d218565d1cc3e56";}', 211, 'adminsaga');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_tags`
--

CREATE TABLE IF NOT EXISTS `wani_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `metadesc` varchar(1024) NOT NULL COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) NOT NULL COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) NOT NULL COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tag_idx` (`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_path` (`path`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `wani_tags`
--

INSERT INTO `wani_tags` (`id`, `parent_id`, `lft`, `rgt`, `level`, `path`, `title`, `alias`, `note`, `description`, `published`, `checked_out`, `checked_out_time`, `access`, `params`, `metadesc`, `metakey`, `metadata`, `created_user_id`, `created_time`, `created_by_alias`, `modified_user_id`, `modified_time`, `images`, `urls`, `hits`, `language`, `version`, `publish_up`, `publish_down`) VALUES
(1, 0, 0, 1, 0, '', 'ROOT', 'root', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{}', '', '', '', 0, '2011-01-01 00:00:01', '', 0, '0000-00-00 00:00:00', '', '', 0, '*', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_template_styles`
--

CREATE TABLE IF NOT EXISTS `wani_template_styles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(50) NOT NULL DEFAULT '',
  `client_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `home` char(7) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_template` (`template`),
  KEY `idx_home` (`home`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `wani_template_styles`
--

INSERT INTO `wani_template_styles` (`id`, `template`, `client_id`, `home`, `title`, `params`) VALUES
(4, 'beez3', 0, '0', 'Beez3 - Predeterminada', '{"wrapperSmall":"53","wrapperLarge":"72","logo":"images\\/joomla_black.gif","sitetitle":"Joomla!","sitedescription":"Open Source Content Management","navposition":"left","templatecolor":"personal","html5":"0"}'),
(5, 'hathor', 1, '0', 'Hathor - Predeterminada', '{"showSiteName":"0","colourChoice":"","boldText":"0"}'),
(7, 'protostar', 0, '0', 'protostar - Predeterminada', '{"templateColor":"","logoFile":"","googleFont":"1","googleFontName":"Open+Sans","fluidContainer":"0"}'),
(8, 'isis', 1, '1', 'isis - Predeterminada', '{"templateColor":"","logoFile":""}'),
(9, 'st_vela', 0, '0', 'st_vela - Defecto', '{"copyright":"1","template_panel_setting":"1","active_responsive":"0","load_jquery":"1","template_showcase":"-1","template_background":"0","doctype":"5","show_main_body":"1","hide_menu_items":["101"],"show_message":"1","404_article":"","404_itemid":0,"template_width":"960px","avatar_header_block":"block-default-width","avatar_header_inside_block":"block-default-width","avatar_tool_block":"block-default-width","avatar_body_top_block":"block-default-width","avatar_body_middle_block":"block-default-width","avatar_body_bottom_block":"block-default-width","avatar_footer_inside_block":"block-default-width","avatar_footer_block":"block-default-width","avatar_full_1_block":"block-default-width","avatar_full_2_block":"block-default-width","avatar_full_3_block":"block-default-width","avatar_full_4_block":"block-default-width","avatar_full_5_block":"block-default-width","avatar_full_6_block":"block-default-width","top_left":33.33,"top_right":33.33,"promo_top_left":33.33,"promo_top_right":33.33,"promo_bottom_left":33.33,"promo_bottom_right":33.33,"left":23,"right":23,"inner_left":23,"inner_right":23,"footer_left":33.33,"footer_right":33.33,"link_color":"","hover_color":"","body_font":"","menu_font":"","google_font_api":"0","google_font_api_key":"","google_font_content":"","customize_css":"","go_to_top":"0","go_to_top_text":"","go_to_top_css":"","css3_effect":"0","optimize":"0"}'),
(10, 'pri_blog', 0, '1', 'pri_blog - Defecto', '{"layout_width":"1170","layout_type":"responsive","logo_type":"image","logo_position":"logo","logo_type_image":"images\\/logo2.png","logo_type_text":"PRI Simple","logo_type_slogan":"Responsive Joomla! Template","logo_width":"200","logo_height":"50","footer_position":"copyright","showcp":"1","copyright":"Copyright \\u00a9  {year} ID Solutions - All Rights Reserved.","jcredit":"0","showtop":"1","preset":"preset3","preset1_header":"#f8f8f8","preset1_bg":"#f5f5f5","preset1_text":"#666666","preset1_link":"#287099","preset2_header":"#f8f8f8","preset2_bg":"#f5f5f5","preset2_text":"#666666","preset2_link":"#FF4900","preset3_header":"#f8f8f8","preset3_bg":"#f5f5f5","preset3_text":"#666666","preset3_link":"#2caea6","preset4_header":"#f8f8f8","preset4_bg":"#f5f5f5","preset4_text":"#666666","preset4_link":"#8254A4","preset5_header":"#f8f8f8","preset5_bg":"#f5f5f5","preset5_text":"#666666","preset5_link":"#F7A749","preset6_header":"#f8f8f8","preset6_bg":"#f5f5f5","preset6_text":"#666666","preset6_link":"#21B8EF","layout":[{"name":"Header","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"0","children":[{"span":"4","offset":"","type":"modules","position":"logo","style":"","customclass":"","responsiveclass":""},{"span":"8","offset":"","type":"modules","position":"menu","style":"none","customclass":"","responsiveclass":""}]},{"name":"Feature","class":"container","responsive":"hidden-phone","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"40px 0","children":[{"span":"12","offset":"","type":"modules","position":"feature","style":"sp_xhtml","customclass":"","responsiveclass":""}]},{"name":"Top","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"40px 0px","children":[{"span":"3","offset":"","type":"modules","position":"top1","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"top2","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"top3","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"top4","style":"sp_xhtml","customclass":"","responsiveclass":""}]},{"name":"Utility","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"30px 0","children":[{"span":"3","offset":"","type":"modules","position":"utility1","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"utility2","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"utility3","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"utility4","style":"sp_xhtml","customclass":"","responsiveclass":""}]},{"name":"MainTop","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"40px 0","children":[{"span":"3","offset":"","type":"modules","position":"maintop1","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"maintop2","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"maintop3","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"maintop4","style":"sp_xhtml","customclass":"","responsiveclass":""}]},{"name":"Main Body","class":"container","responsive":"","backgroundcolor":"rgba(246, 180, 74, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"30px 0","children":[{"span":"3","offset":"","type":"modules","position":"left","style":"xhtml","customclass":"","responsiveclass":""},{"span":"6","offset":"","type":"message","position":"","style":"xhtml","customclass":"","responsiveclass":"","children":[{"name":"ContentTop","class":"","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"","children":[{"span":"4","offset":"","type":"modules","position":"contenttop1","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"4","offset":"","type":"modules","position":"contenttop2","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"4","offset":"","type":"modules","position":"contenttop3","style":"sp_xhtml","customclass":"","responsiveclass":""}]},{"name":"Component Area","class":"","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"","children":[{"span":"12","offset":"","type":"component","position":"","style":"xhtml","customclass":"","responsiveclass":""}]},{"name":"ContentBottom","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"40px 0","children":[{"span":"6","offset":"","type":"modules","position":"contentbottom1","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"6","offset":"","type":"modules","position":"contentbottom2","style":"sp_xhtml","customclass":"","responsiveclass":""}]}]},{"span":"3","offset":"","type":"modules","position":"right","style":"sp_xhtml","customclass":"","responsiveclass":""}]},{"name":"MainBottom","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"","children":[{"span":"3","offset":"","type":"modules","position":"mainbottom1","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"mainbottom2","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"mainbottom3","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"mainbottom4","style":"sp_xhtml","customclass":"","responsiveclass":""}]},{"name":"Media","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"40px 0","padding":"40px 0","children":[{"span":"12","offset":"","type":"modules","position":"media","style":"sp-xhtml","customclass":"","responsiveclass":""}]},{"name":"Bottom","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"40px 0","children":[{"span":"6","offset":"","type":"modules","position":"bottom1","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"6","offset":"","type":"modules","position":"bottom2","style":"sp_xhtml","customclass":"","responsiveclass":""}]},{"name":"Breadcrumb","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"","children":[{"span":"12","offset":"","type":"modules","position":"breadcrumb","style":"none","customclass":"","responsiveclass":""}]},{"name":"Footer","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"40px 0","children":[{"span":"4","offset":"","type":"modules","position":"footer1","style":"sp_flat","customclass":"","responsiveclass":""},{"span":"4","offset":"","type":"modules","position":"footer2","style":"sp_flat","customclass":"","responsiveclass":""},{"span":"4","offset":"","type":"modules","position":"footer3","style":"sp_flat","customclass":"","responsiveclass":""}]},{"name":"Copyright","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"10px 0","children":[{"span":"9","offset":"","type":"modules","position":"copyright","style":"none","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"social","style":"none","customclass":"","responsiveclass":""}]}],"menu":"mainmenu","menutype":"mega","menu_col_width":"200","show_menu_image":"1","menu_image_position":"1","submenu_position":"0","init_x":"0","init_y":"0","sub_x":"0","sub_y":"0","body_font":"","body_selectors":"","header_font":"","header_selectors":"","other_font":"","other_selectors":"","cache_time":"60","compress_css":"0","compress_js":"0","enable_ga":"0","ga_code":"","loadjquery":"0","loadfromcdn":"0","lessoption":"1","hide_component_area":"0"}'),
(11, 'joomlike', 0, '0', 'JoomLike - Defecto', '{"colorVariation":"blue","templateWidth":"920px","sidebarWidth":"25","cellpadding":"0.5em","bootstrap":"1","googleFont":"1","googleFontFamily":"Carrois Gothic","fontfamily":"Helvetica, Arial, sans-serif","fontsize":"14px","linkcolor":"#6699CC","backlink":"1"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_ucm_base`
--

CREATE TABLE IF NOT EXISTS `wani_ucm_base` (
  `ucm_id` int(10) unsigned NOT NULL,
  `ucm_item_id` int(10) NOT NULL,
  `ucm_type_id` int(11) NOT NULL,
  `ucm_language_id` int(11) NOT NULL,
  PRIMARY KEY (`ucm_id`),
  KEY `idx_ucm_item_id` (`ucm_item_id`),
  KEY `idx_ucm_type_id` (`ucm_type_id`),
  KEY `idx_ucm_language_id` (`ucm_language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_ucm_content`
--

CREATE TABLE IF NOT EXISTS `wani_ucm_content` (
  `core_content_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `core_type_alias` varchar(255) NOT NULL DEFAULT '' COMMENT 'FK to the content types table',
  `core_title` varchar(255) NOT NULL,
  `core_alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `core_body` mediumtext NOT NULL,
  `core_state` tinyint(1) NOT NULL DEFAULT '0',
  `core_checked_out_time` varchar(255) NOT NULL DEFAULT '',
  `core_checked_out_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `core_access` int(10) unsigned NOT NULL DEFAULT '0',
  `core_params` text NOT NULL,
  `core_featured` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `core_metadata` varchar(2048) NOT NULL COMMENT 'JSON encoded metadata properties.',
  `core_created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `core_created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `core_created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `core_modified_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Most recent user that modified',
  `core_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `core_language` char(7) NOT NULL,
  `core_publish_up` datetime NOT NULL,
  `core_publish_down` datetime NOT NULL,
  `core_content_item_id` int(10) unsigned DEFAULT NULL COMMENT 'ID from the individual type table',
  `asset_id` int(10) unsigned DEFAULT NULL COMMENT 'FK to the #__assets table.',
  `core_images` text NOT NULL,
  `core_urls` text NOT NULL,
  `core_hits` int(10) unsigned NOT NULL DEFAULT '0',
  `core_version` int(10) unsigned NOT NULL DEFAULT '1',
  `core_ordering` int(11) NOT NULL DEFAULT '0',
  `core_metakey` text NOT NULL,
  `core_metadesc` text NOT NULL,
  `core_catid` int(10) unsigned NOT NULL DEFAULT '0',
  `core_xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `core_type_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`core_content_id`),
  KEY `tag_idx` (`core_state`,`core_access`),
  KEY `idx_access` (`core_access`),
  KEY `idx_alias` (`core_alias`),
  KEY `idx_language` (`core_language`),
  KEY `idx_title` (`core_title`),
  KEY `idx_modified_time` (`core_modified_time`),
  KEY `idx_created_time` (`core_created_time`),
  KEY `idx_content_type` (`core_type_alias`),
  KEY `idx_core_modified_user_id` (`core_modified_user_id`),
  KEY `idx_core_checked_out_user_id` (`core_checked_out_user_id`),
  KEY `idx_core_created_user_id` (`core_created_user_id`),
  KEY `idx_core_type_id` (`core_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains core content data in name spaced fields' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_ucm_history`
--

CREATE TABLE IF NOT EXISTS `wani_ucm_history` (
  `version_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ucm_item_id` int(10) unsigned NOT NULL,
  `ucm_type_id` int(10) unsigned NOT NULL,
  `version_note` varchar(255) NOT NULL DEFAULT '' COMMENT 'Optional version name',
  `save_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `character_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Number of characters in this version.',
  `sha1_hash` varchar(50) NOT NULL DEFAULT '' COMMENT 'SHA1 hash of the version_data column.',
  `version_data` mediumtext NOT NULL COMMENT 'json-encoded string of version data',
  `keep_forever` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=auto delete; 1=keep',
  PRIMARY KEY (`version_id`),
  KEY `idx_ucm_item_id` (`ucm_type_id`,`ucm_item_id`),
  KEY `idx_save_date` (`save_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `wani_ucm_history`
--

INSERT INTO `wani_ucm_history` (`version_id`, `ucm_item_id`, `ucm_type_id`, `version_note`, `save_date`, `editor_user_id`, `character_count`, `sha1_hash`, `version_data`, `keep_forever`) VALUES
(7, 1, 1, '', '2014-07-08 22:57:49', 211, 1862, 'c1612881e82d425a4ef4467aa3751f9b83747a89', '{"id":1,"asset_id":"55","title":"Wanitta","alias":"wanitta","introtext":"<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">SOFTWARE ADMINISTRATIVO\\u00a0<\\/p>\\r\\n<p>\\u00a0<\\/p>\\r\\n<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\"><img src=\\"images\\/Logo.png\\" alt=\\"\\" width=\\"500\\" height=\\"400\\" \\/><\\/p>","fulltext":"","state":1,"catid":"2","created":"2014-02-21 21:08:03","created_by":"211","created_by_alias":"","modified":"2014-07-08 22:57:49","modified_by":"211","checked_out":"211","checked_out_time":"2014-07-08 22:56:27","publish_up":"2014-02-21 21:08:03","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"0\\",\\"link_titles\\":\\"0\\",\\"show_intro\\":\\"0\\",\\"show_category\\":\\"0\\",\\"link_category\\":\\"0\\",\\"show_parent_category\\":\\"0\\",\\"link_parent_category\\":\\"0\\",\\"show_author\\":\\"0\\",\\"link_author\\":\\"0\\",\\"show_create_date\\":\\"0\\",\\"show_modify_date\\":\\"0\\",\\"show_publish_date\\":\\"0\\",\\"show_item_navigation\\":\\"0\\",\\"show_icons\\":\\"0\\",\\"show_print_icon\\":\\"0\\",\\"show_email_icon\\":\\"0\\",\\"show_vote\\":\\"0\\",\\"show_hits\\":\\"0\\",\\"show_noauth\\":\\"0\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"0\\",\\"show_article_options\\":\\"0\\",\\"show_urls_images_backend\\":\\"0\\",\\"show_urls_images_frontend\\":\\"0\\"}","version":10,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"896","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(8, 1, 1, '', '2014-07-08 22:58:15', 211, 1862, '0a6581dbb5f74818b608e3088ec78845870a4d76', '{"id":1,"asset_id":"55","title":"Wanitta","alias":"wanitta","introtext":"<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">SOFTWARE ADMINISTRATIVO\\u00a0<\\/p>\\r\\n<p>\\u00a0<\\/p>\\r\\n<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\"><img src=\\"images\\/Logo.png\\" alt=\\"\\" width=\\"638\\" height=\\"400\\" \\/><\\/p>","fulltext":"","state":1,"catid":"2","created":"2014-02-21 21:08:03","created_by":"211","created_by_alias":"","modified":"2014-07-08 22:58:15","modified_by":"211","checked_out":"211","checked_out_time":"2014-07-08 22:57:49","publish_up":"2014-02-21 21:08:03","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"0\\",\\"link_titles\\":\\"0\\",\\"show_intro\\":\\"0\\",\\"show_category\\":\\"0\\",\\"link_category\\":\\"0\\",\\"show_parent_category\\":\\"0\\",\\"link_parent_category\\":\\"0\\",\\"show_author\\":\\"0\\",\\"link_author\\":\\"0\\",\\"show_create_date\\":\\"0\\",\\"show_modify_date\\":\\"0\\",\\"show_publish_date\\":\\"0\\",\\"show_item_navigation\\":\\"0\\",\\"show_icons\\":\\"0\\",\\"show_print_icon\\":\\"0\\",\\"show_email_icon\\":\\"0\\",\\"show_vote\\":\\"0\\",\\"show_hits\\":\\"0\\",\\"show_noauth\\":\\"0\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"0\\",\\"show_article_options\\":\\"0\\",\\"show_urls_images_backend\\":\\"0\\",\\"show_urls_images_frontend\\":\\"0\\"}","version":11,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"896","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(9, 1, 1, '', '2014-07-08 22:58:29', 211, 2006, '740667b9ed12a3ae6ca88d5a84ac7552b082888c', '{"id":1,"asset_id":"55","title":"Wanitta","alias":"wanitta","introtext":"<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">SOFTWARE ADMINISTRATIVO\\u00a0<\\/p>\\r\\n<p>\\u00a0<\\/p>\\r\\n<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\"><img src=\\"images\\/Logo.png\\" alt=\\"\\" width=\\"638\\" height=\\"400\\" \\/><\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>","fulltext":"","state":1,"catid":"2","created":"2014-02-21 21:08:03","created_by":"211","created_by_alias":"","modified":"2014-07-08 22:58:29","modified_by":"211","checked_out":"211","checked_out_time":"2014-07-08 22:58:15","publish_up":"2014-02-21 21:08:03","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"0\\",\\"link_titles\\":\\"0\\",\\"show_intro\\":\\"0\\",\\"show_category\\":\\"0\\",\\"link_category\\":\\"0\\",\\"show_parent_category\\":\\"0\\",\\"link_parent_category\\":\\"0\\",\\"show_author\\":\\"0\\",\\"link_author\\":\\"0\\",\\"show_create_date\\":\\"0\\",\\"show_modify_date\\":\\"0\\",\\"show_publish_date\\":\\"0\\",\\"show_item_navigation\\":\\"0\\",\\"show_icons\\":\\"0\\",\\"show_print_icon\\":\\"0\\",\\"show_email_icon\\":\\"0\\",\\"show_vote\\":\\"0\\",\\"show_hits\\":\\"0\\",\\"show_noauth\\":\\"0\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"0\\",\\"show_article_options\\":\\"0\\",\\"show_urls_images_backend\\":\\"0\\",\\"show_urls_images_frontend\\":\\"0\\"}","version":12,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"897","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(10, 1, 1, '', '2014-07-08 22:59:18', 211, 2198, 'cdeed615b691ec62bf99c0b7029cb53beaf228ee', '{"id":1,"asset_id":"55","title":"Wanitta","alias":"wanitta","introtext":"<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">SOFTWARE ADMINISTRATIVO\\u00a0<\\/p>\\r\\n<p>\\u00a0<\\/p>\\r\\n<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\"><img src=\\"images\\/Logo.png\\" alt=\\"\\" width=\\"638\\" height=\\"400\\" \\/><\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>","fulltext":"","state":1,"catid":"2","created":"2014-02-21 21:08:03","created_by":"211","created_by_alias":"","modified":"2014-07-08 22:59:18","modified_by":"211","checked_out":"211","checked_out_time":"2014-07-08 22:58:29","publish_up":"2014-02-21 21:08:03","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"0\\",\\"link_titles\\":\\"0\\",\\"show_intro\\":\\"0\\",\\"show_category\\":\\"0\\",\\"link_category\\":\\"0\\",\\"show_parent_category\\":\\"0\\",\\"link_parent_category\\":\\"0\\",\\"show_author\\":\\"0\\",\\"link_author\\":\\"0\\",\\"show_create_date\\":\\"0\\",\\"show_modify_date\\":\\"0\\",\\"show_publish_date\\":\\"0\\",\\"show_item_navigation\\":\\"0\\",\\"show_icons\\":\\"0\\",\\"show_print_icon\\":\\"0\\",\\"show_email_icon\\":\\"0\\",\\"show_vote\\":\\"0\\",\\"show_hits\\":\\"0\\",\\"show_noauth\\":\\"0\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"0\\",\\"show_article_options\\":\\"0\\",\\"show_urls_images_backend\\":\\"0\\",\\"show_urls_images_frontend\\":\\"0\\"}","version":13,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"898","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(11, 1, 1, '', '2014-07-08 22:59:38', 211, 2150, '6bdba0577d63d221813cc1a86a807ac452aebd92', '{"id":1,"asset_id":"55","title":"Wanitta","alias":"wanitta","introtext":"<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">SOFTWARE ADMINISTRATIVO\\u00a0<\\/p>\\r\\n<p>\\u00a0<\\/p>\\r\\n<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\"><img src=\\"images\\/Logo.png\\" alt=\\"\\" width=\\"638\\" height=\\"400\\" \\/><\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>","fulltext":"","state":1,"catid":"2","created":"2014-02-21 21:08:03","created_by":"211","created_by_alias":"","modified":"2014-07-08 22:59:38","modified_by":"211","checked_out":"211","checked_out_time":"2014-07-08 22:59:18","publish_up":"2014-02-21 21:08:03","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"0\\",\\"link_titles\\":\\"0\\",\\"show_intro\\":\\"0\\",\\"show_category\\":\\"0\\",\\"link_category\\":\\"0\\",\\"show_parent_category\\":\\"0\\",\\"link_parent_category\\":\\"0\\",\\"show_author\\":\\"0\\",\\"link_author\\":\\"0\\",\\"show_create_date\\":\\"0\\",\\"show_modify_date\\":\\"0\\",\\"show_publish_date\\":\\"0\\",\\"show_item_navigation\\":\\"0\\",\\"show_icons\\":\\"0\\",\\"show_print_icon\\":\\"0\\",\\"show_email_icon\\":\\"0\\",\\"show_vote\\":\\"0\\",\\"show_hits\\":\\"0\\",\\"show_noauth\\":\\"0\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"0\\",\\"show_article_options\\":\\"0\\",\\"show_urls_images_backend\\":\\"0\\",\\"show_urls_images_frontend\\":\\"0\\"}","version":14,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"899","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(12, 1, 1, '', '2014-07-16 23:00:16', 211, 2150, '98a1cbf4ce4bed5404ce0b305824bc504639e439', '{"id":1,"asset_id":"55","title":"Wanitta","alias":"wanitta","introtext":"<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">SOFTWARE ADMINISTRATIVO\\u00a0<\\/p>\\r\\n<p>\\u00a0<\\/p>\\r\\n<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\"><img src=\\"images\\/Logo.png\\" alt=\\"\\" width=\\"528\\" height=\\"331\\" \\/><\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>","fulltext":"","state":1,"catid":"2","created":"2014-02-21 21:08:03","created_by":"211","created_by_alias":"","modified":"2014-07-16 23:00:16","modified_by":"211","checked_out":"211","checked_out_time":"2014-07-16 23:00:00","publish_up":"2014-02-21 21:08:03","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"0\\",\\"link_titles\\":\\"0\\",\\"show_intro\\":\\"0\\",\\"show_category\\":\\"0\\",\\"link_category\\":\\"0\\",\\"show_parent_category\\":\\"0\\",\\"link_parent_category\\":\\"0\\",\\"show_author\\":\\"0\\",\\"link_author\\":\\"0\\",\\"show_create_date\\":\\"0\\",\\"show_modify_date\\":\\"0\\",\\"show_publish_date\\":\\"0\\",\\"show_item_navigation\\":\\"0\\",\\"show_icons\\":\\"0\\",\\"show_print_icon\\":\\"0\\",\\"show_email_icon\\":\\"0\\",\\"show_vote\\":\\"0\\",\\"show_hits\\":\\"0\\",\\"show_noauth\\":\\"0\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"0\\",\\"show_article_options\\":\\"0\\",\\"show_urls_images_backend\\":\\"0\\",\\"show_urls_images_frontend\\":\\"0\\"}","version":15,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"923","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(13, 1, 1, '', '2014-07-16 23:00:46', 211, 2072, '3cf48de06b53ca187e182e18c103c3d7cf383e8c', '{"id":1,"asset_id":"55","title":"Wanitta","alias":"wanitta","introtext":"<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">SOFTWARE ADMINISTRATIVO\\u00a0\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\"><img src=\\"images\\/Logo.png\\" alt=\\"\\" width=\\"528\\" height=\\"331\\" \\/><\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>","fulltext":"","state":1,"catid":"2","created":"2014-02-21 21:08:03","created_by":"211","created_by_alias":"","modified":"2014-07-16 23:00:46","modified_by":"211","checked_out":"211","checked_out_time":"2014-07-16 23:00:16","publish_up":"2014-02-21 21:08:03","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"0\\",\\"link_titles\\":\\"0\\",\\"show_intro\\":\\"0\\",\\"show_category\\":\\"0\\",\\"link_category\\":\\"0\\",\\"show_parent_category\\":\\"0\\",\\"link_parent_category\\":\\"0\\",\\"show_author\\":\\"0\\",\\"link_author\\":\\"0\\",\\"show_create_date\\":\\"0\\",\\"show_modify_date\\":\\"0\\",\\"show_publish_date\\":\\"0\\",\\"show_item_navigation\\":\\"0\\",\\"show_icons\\":\\"0\\",\\"show_print_icon\\":\\"0\\",\\"show_email_icon\\":\\"0\\",\\"show_vote\\":\\"0\\",\\"show_hits\\":\\"0\\",\\"show_noauth\\":\\"0\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"0\\",\\"show_article_options\\":\\"0\\",\\"show_urls_images_backend\\":\\"0\\",\\"show_urls_images_frontend\\":\\"0\\"}","version":16,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"924","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(14, 1, 1, '', '2014-07-16 23:01:17', 211, 2072, 'd5d1856661f426ccc6519b24123c9b43d65a6c93', '{"id":1,"asset_id":"55","title":"Wanitta","alias":"wanitta","introtext":"<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">SOFTWARE ADMINISTRATIVO\\u00a0\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\"><img src=\\"images\\/Logo.png\\" alt=\\"\\" width=\\"501\\" height=\\"246\\" \\/><\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>","fulltext":"","state":1,"catid":"2","created":"2014-02-21 21:08:03","created_by":"211","created_by_alias":"","modified":"2014-07-16 23:01:17","modified_by":"211","checked_out":"211","checked_out_time":"2014-07-16 23:00:46","publish_up":"2014-02-21 21:08:03","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"0\\",\\"link_titles\\":\\"0\\",\\"show_intro\\":\\"0\\",\\"show_category\\":\\"0\\",\\"link_category\\":\\"0\\",\\"show_parent_category\\":\\"0\\",\\"link_parent_category\\":\\"0\\",\\"show_author\\":\\"0\\",\\"link_author\\":\\"0\\",\\"show_create_date\\":\\"0\\",\\"show_modify_date\\":\\"0\\",\\"show_publish_date\\":\\"0\\",\\"show_item_navigation\\":\\"0\\",\\"show_icons\\":\\"0\\",\\"show_print_icon\\":\\"0\\",\\"show_email_icon\\":\\"0\\",\\"show_vote\\":\\"0\\",\\"show_hits\\":\\"0\\",\\"show_noauth\\":\\"0\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"0\\",\\"show_article_options\\":\\"0\\",\\"show_urls_images_backend\\":\\"0\\",\\"show_urls_images_frontend\\":\\"0\\"}","version":17,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"925","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(15, 1, 1, '', '2014-07-16 23:01:34', 211, 1880, '9cf86243a3e5ffe496e49c8b0bf6168b3c9ca838', '{"id":1,"asset_id":"55","title":"Wanitta","alias":"wanitta","introtext":"<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">SOFTWARE ADMINISTRATIVO\\u00a0\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\"><img src=\\"images\\/Logo.png\\" alt=\\"\\" width=\\"501\\" height=\\"246\\" \\/><\\/p>\\r\\n<p style=\\"text-align: center;\\">\\u00a0<\\/p>","fulltext":"","state":1,"catid":"2","created":"2014-02-21 21:08:03","created_by":"211","created_by_alias":"","modified":"2014-07-16 23:01:34","modified_by":"211","checked_out":"211","checked_out_time":"2014-07-16 23:01:17","publish_up":"2014-02-21 21:08:03","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"0\\",\\"link_titles\\":\\"0\\",\\"show_intro\\":\\"0\\",\\"show_category\\":\\"0\\",\\"link_category\\":\\"0\\",\\"show_parent_category\\":\\"0\\",\\"link_parent_category\\":\\"0\\",\\"show_author\\":\\"0\\",\\"link_author\\":\\"0\\",\\"show_create_date\\":\\"0\\",\\"show_modify_date\\":\\"0\\",\\"show_publish_date\\":\\"0\\",\\"show_item_navigation\\":\\"0\\",\\"show_icons\\":\\"0\\",\\"show_print_icon\\":\\"0\\",\\"show_email_icon\\":\\"0\\",\\"show_vote\\":\\"0\\",\\"show_hits\\":\\"0\\",\\"show_noauth\\":\\"0\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"0\\",\\"show_article_options\\":\\"0\\",\\"show_urls_images_backend\\":\\"0\\",\\"show_urls_images_frontend\\":\\"0\\"}","version":18,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"926","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(16, 1, 1, '', '2014-07-16 23:01:54', 211, 1832, '60f318021440355682467613bcc2a65a8e7a474e', '{"id":1,"asset_id":"55","title":"Wanitta","alias":"wanitta","introtext":"<p>\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\">SOFTWARE ADMINISTRATIVO\\u00a0\\u00a0<\\/p>\\r\\n<p style=\\"text-align: center;\\"><img src=\\"images\\/Logo.png\\" alt=\\"\\" width=\\"501\\" height=\\"246\\" \\/><\\/p>","fulltext":"","state":1,"catid":"2","created":"2014-02-21 21:08:03","created_by":"211","created_by_alias":"","modified":"2014-07-16 23:01:54","modified_by":"211","checked_out":"211","checked_out_time":"2014-07-16 23:01:34","publish_up":"2014-02-21 21:08:03","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"0\\",\\"link_titles\\":\\"0\\",\\"show_intro\\":\\"0\\",\\"show_category\\":\\"0\\",\\"link_category\\":\\"0\\",\\"show_parent_category\\":\\"0\\",\\"link_parent_category\\":\\"0\\",\\"show_author\\":\\"0\\",\\"link_author\\":\\"0\\",\\"show_create_date\\":\\"0\\",\\"show_modify_date\\":\\"0\\",\\"show_publish_date\\":\\"0\\",\\"show_item_navigation\\":\\"0\\",\\"show_icons\\":\\"0\\",\\"show_print_icon\\":\\"0\\",\\"show_email_icon\\":\\"0\\",\\"show_vote\\":\\"0\\",\\"show_hits\\":\\"0\\",\\"show_noauth\\":\\"0\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"0\\",\\"show_article_options\\":\\"0\\",\\"show_urls_images_backend\\":\\"0\\",\\"show_urls_images_frontend\\":\\"0\\"}","version":19,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"927","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_updates`
--

CREATE TABLE IF NOT EXISTS `wani_updates` (
  `update_id` int(11) NOT NULL AUTO_INCREMENT,
  `update_site_id` int(11) DEFAULT '0',
  `extension_id` int(11) DEFAULT '0',
  `name` varchar(100) DEFAULT '',
  `description` text NOT NULL,
  `element` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `folder` varchar(20) DEFAULT '',
  `client_id` tinyint(3) DEFAULT '0',
  `version` varchar(10) DEFAULT '',
  `data` text NOT NULL,
  `detailsurl` text NOT NULL,
  `infourl` text NOT NULL,
  PRIMARY KEY (`update_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Available Updates' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_update_sites`
--

CREATE TABLE IF NOT EXISTS `wani_update_sites` (
  `update_site_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `location` text NOT NULL,
  `enabled` int(11) DEFAULT '0',
  `last_check_timestamp` bigint(20) DEFAULT '0',
  PRIMARY KEY (`update_site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Update Sites' AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `wani_update_sites`
--

INSERT INTO `wani_update_sites` (`update_site_id`, `name`, `type`, `location`, `enabled`, `last_check_timestamp`) VALUES
(1, 'Joomla Core', 'collection', 'http://update.joomla.org/core/list.xml', 1, 0),
(2, 'Directorio de Extensiones Joomla', 'collection', 'http://update.joomla.org/jed/list.xml', 1, 0),
(3, 'Accredited Joomla! Translations', 'collection', 'http://update.joomla.org/language/translationlist_3.xml', 1, 0),
(4, 'System - Helix Framework', 'extension', 'http://www.joomshaper.com/updates/plg_system_helix.xml', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_update_sites_extensions`
--

CREATE TABLE IF NOT EXISTS `wani_update_sites_extensions` (
  `update_site_id` int(11) NOT NULL DEFAULT '0',
  `extension_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`update_site_id`,`extension_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Links extensions to update sites';

--
-- Volcado de datos para la tabla `wani_update_sites_extensions`
--

INSERT INTO `wani_update_sites_extensions` (`update_site_id`, `extension_id`) VALUES
(1, 700),
(2, 700),
(3, 600),
(4, 10003);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_usergroups`
--

CREATE TABLE IF NOT EXISTS `wani_usergroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Adjacency List Reference Id',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `title` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_usergroup_parent_title_lookup` (`parent_id`,`title`),
  KEY `idx_usergroup_title_lookup` (`title`),
  KEY `idx_usergroup_adjacency_lookup` (`parent_id`),
  KEY `idx_usergroup_nested_set_lookup` (`lft`,`rgt`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `wani_usergroups`
--

INSERT INTO `wani_usergroups` (`id`, `parent_id`, `lft`, `rgt`, `title`) VALUES
(1, 0, 1, 18, 'Publico'),
(2, 1, 8, 15, 'Registrado'),
(3, 2, 9, 14, 'Autor'),
(4, 3, 10, 13, 'Editor'),
(5, 4, 11, 12, 'Publicador'),
(6, 1, 4, 7, 'Gestor'),
(7, 6, 5, 6, 'Administrador'),
(8, 1, 16, 17, 'Super Usuarios'),
(9, 1, 2, 3, 'Invitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_users`
--

CREATE TABLE IF NOT EXISTS `wani_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `usertype` varchar(255) NOT NULL,
  `usertype2` varchar(255) NOT NULL,
  `agenda` tinyint(1) NOT NULL,
  `clientes` tinyint(1) NOT NULL,
  `proveedores` tinyint(1) NOT NULL,
  `nomina` tinyint(1) NOT NULL,
  `inventario` tinyint(1) NOT NULL,
  `compras` tinyint(1) NOT NULL,
  `cotizaciones` tinyint(1) NOT NULL,
  `pedidos` tinyint(1) NOT NULL,
  `ventas` tinyint(1) NOT NULL,
  `devoluciones` tinyint(1) NOT NULL,
  `caja` tinyint(4) NOT NULL,
  `ingreso` tinyint(1) NOT NULL COMMENT 'control Acceso',
  `auto` tinyint(1) NOT NULL COMMENT 'Autorizados C. Acceso',
  `despachos` tinyint(1) NOT NULL,
  `registro_excel` tinyint(1) NOT NULL,
  `orden_corte` tinyint(1) NOT NULL,
  `insumos` tinyint(1) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `lastResetTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date of last password reset',
  `resetCount` int(11) NOT NULL DEFAULT '0' COMMENT 'Count of password resets since lastResetTime',
  `otpKey` varchar(1000) NOT NULL DEFAULT '' COMMENT 'Two factor authentication encrypted keys',
  `otep` varchar(1000) NOT NULL DEFAULT '' COMMENT 'One time emergency passwords',
  PRIMARY KEY (`id`),
  KEY `idx_name` (`name`),
  KEY `idx_block` (`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=228 ;

--
-- Volcado de datos para la tabla `wani_users`
--

INSERT INTO `wani_users` (`id`, `name`, `username`, `usertype`, `usertype2`, `agenda`, `clientes`, `proveedores`, `nomina`, `inventario`, `compras`, `cotizaciones`, `pedidos`, `ventas`, `devoluciones`, `caja`, `ingreso`, `auto`, `despachos`, `registro_excel`, `orden_corte`, `insumos`, `email`, `password`, `block`, `sendEmail`, `registerDate`, `lastvisitDate`, `activation`, `params`, `lastResetTime`, `resetCount`, `otpKey`, `otep`) VALUES
(211, 'Super Usuario', 'adminsaga', 'Tokin', 'general', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 'jair.quinto@idsolutions-group.com', '$2y$10$3IBYkVD3c824WkMaqSqd8OzSWNP8bo8UmpNgRA7wUp4OmF9ZagTmW', 0, 1, '2014-02-21 18:39:40', '2014-10-27 14:40:10', '0', '{"admin_style":"","admin_language":"","language":"","editor":"","helpsite":"","timezone":""}', '0000-00-00 00:00:00', 0, '', ''),
(214, 'JUAN ZAPATA', 'juan.zapata', 'JuanZ', 'general', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'juan.zapata@idsolutions-group.com', '$2y$10$6l2ww4tADQEma8nkY7wRIeCZrNYYGKbv2QnGWr8BDmjxbuiANfXk6', 0, 0, '2014-03-06 14:48:08', '2014-09-11 22:06:19', '', '{}', '0000-00-00 00:00:00', 0, '', ''),
(215, 'Santiago Del Valle', 'sdelvalle57', 'sdelvalle57', 'general', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'sdelvalle57@gmail.com', '$2y$10$atC5cuWoWhFqiRs6B/Z3aO2QdZ7Re.b8vAADooRqCXMVKhkoEBfAm', 0, 0, '2014-03-11 15:12:05', '2014-09-05 18:46:52', '', '{"admin_style":"","admin_language":"","language":"","editor":"","helpsite":"","timezone":""}', '0000-00-00 00:00:00', 0, '', ''),
(216, 'ahinestrosa', 'ahinestrosa', 'ahinestrosa', 'general', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ahinestrosa1984@gmail.com', '$2y$10$lWhxpyObbsOikGgnnxupZO8p7p44YDGky8QJmmQ0pMKSwVfxC9f3a', 0, 0, '2014-03-13 15:04:46', '2014-09-12 14:17:45', '', '{"admin_style":"","admin_language":"","language":"","editor":"","helpsite":"","timezone":""}', '0000-00-00 00:00:00', 0, '', ''),
(223, 'mario', 'mgiraldo', 'mgiraldo', 'general', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'mgiraldo@idsolutons-group.com', '1af37acad7692b9482ba57d122bebe86:DZxhpyCd6OUhELLd6RvCDts6Z0HJYWgf', 0, 0, '2014-07-09 21:32:37', '2014-08-21 17:09:01', '', '{"admin_style":"","admin_language":"","language":"","editor":"","helpsite":"","timezone":""}', '0000-00-00 00:00:00', 0, '', ''),
(224, 'prueba', 'prueba', 'prueba', 'Lleras', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'davidgol87@hotmail.com', '$2y$10$eTyxgVjbpfNfu0S7/j36WuXdgtTyeGau2LbuMmSvC7.k.cVEXXBGS', 0, 0, '2014-07-17 21:25:39', '2014-10-22 16:15:25', '', '{}', '0000-00-00 00:00:00', 0, '', ''),
(226, 'DIEGO BOHORQUEZ', 'DIEGODAB', 'DIEGODAB', 'general', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'gerencia@elropario.com', '$2y$10$aQdAIZ6kJmW/B80oYmIdouaioJ0xNDY5I4Yq5HkJmrWKKgEUDIQ1q', 0, 0, '2014-07-21 14:30:03', '2014-07-21 14:30:57', '', '{}', '0000-00-00 00:00:00', 0, '', ''),
(227, 'Fredis vergara', 'fdvergara', 'fdvergara', 'general', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'davidgol87@hotmail.com', '$2y$10$x9T2Iscicyxnb.ShDFdFfu.cSR.0FojsFyUVzkX61M4zMU5QuDX9m', 0, 0, '2014-08-30 16:59:16', '2014-09-12 02:21:23', '29efa0ffb9d08416491d417fc5fffa9b', '{}', '0000-00-00 00:00:00', 0, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_user_keys`
--

CREATE TABLE IF NOT EXISTS `wani_user_keys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `series` varchar(255) NOT NULL,
  `invalid` tinyint(4) NOT NULL,
  `time` varchar(200) NOT NULL,
  `uastring` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `series` (`series`),
  UNIQUE KEY `series_2` (`series`),
  UNIQUE KEY `series_3` (`series`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `wani_user_keys`
--

INSERT INTO `wani_user_keys` (`id`, `user_id`, `token`, `series`, `invalid`, `time`, `uastring`) VALUES
(17, 'ahinestrosa', '$2y$10$0zW2ntMd3FfsUHP5DP.a3.Kzm7T/sW/adwcfoX3s7RXFp31piNi2C', 'pXGam5xh8snvNF70OxGk', 0, '1411768306', 'b8e9f7375a723844c17549db9e2c4e0a'),
(18, 'ahinestrosa', '$2y$10$MaS0hJw2C.mBGU/4GNk/6uzCj/SQlfJgLK43eNfJVVnGtEWNlJCsy', 'FqrFWmrJq0SaMtQ4B1CJ', 0, '1411827265', 'b8e9f7375a723844c17549db9e2c4e0a'),
(19, 'ahinestrosa', '$2y$10$SzHf8J6pW7zx7zPUxbDg0e6LpX1yEXVK1HR0aIS7X06NLCtvxxcJG', 'RajSdOSlzbTZxeGklvwf', 0, '1411850158', 'b8e9f7375a723844c17549db9e2c4e0a'),
(20, 'ahinestrosa', '$2y$10$./WbWQQintpMUHOtBoeVa.zNQAp0VBX0TbA6tRUOm4Hv4I7gcQ1iC', '0IRenJ3cXpmolZSy9qCP', 0, '1411915409', 'b8e9f7375a723844c17549db9e2c4e0a'),
(21, 'ahinestrosa', '$2y$10$dBXQErjm/MkgEp0h65u/X.zlH2wQn//yJDLIYjGDHkdskr4GQJX8C', 'NHYPF0y2drxQPqoLeNEl', 0, '1412174822', 'b8e9f7375a723844c17549db9e2c4e0a'),
(22, 'ahinestrosa', '$2y$10$83.p3osYaYWkNN07k4IbTer5PnMrS0aJlALzGANrnKB0Dndy.lMXu', '3zgk7e3GXdQU4Roc5OHN', 0, '1412708816', 'b8e9f7375a723844c17549db9e2c4e0a'),
(23, 'ahinestrosa', '$2y$10$BlmSSEyiwF4ahhT.CPnqEOWD9ANlD1YAuLD8Z2Xd.Cnlp8.Edho9C', 'KRj7MRUrglpmRd9Dnkp1', 0, '1412716247', 'b8e9f7375a723844c17549db9e2c4e0a'),
(24, 'ahinestrosa', '$2y$10$fUvppXhlbkr64ug/bH7HpuXtD8oVIFVYWgvKtaIrnY3tSrGjP3Zem', 'W91svtzV2r8nI82ETIMy', 0, '1412952234', 'b8e9f7375a723844c17549db9e2c4e0a'),
(25, 'ahinestrosa', '$2y$10$ksftyrWIlQaWZQeX4GXD0.dUXDAAXBBpJs/ZjIcL6kby155gS3j4i', 'cw6TGJNwGl3AqkLlUKhx', 0, '1414248588', '645575d72374b9351c5487730b54696d'),
(26, 'ahinestrosa', '$2y$10$tOwqjw/ef9OsXR0UegQimeoFRhUza4YbWJz1q9MDnLzMu4LvBbhq.', 'SRY2GP3keHBqMbaPuzRg', 0, '1414784369', '645575d72374b9351c5487730b54696d'),
(27, 'ahinestrosa', '$2y$10$NgtQvldB4YPB1OXlSIFs3uJ5y2/fr5048Pp8WACjDtI8TiFjnDueq', 'JpuaCAFgjWX6w8fuJGL5', 0, '1415478970', '645575d72374b9351c5487730b54696d'),
(28, 'ahinestrosa', '$2y$10$ajmveeDIIU/gWdoARUKUjuKzB6/MSBTKvYqj9JXIBOzmrDwzzLRWa', 'usxBVymg7WnV8BdBsCED', 0, '1415630200', '645575d72374b9351c5487730b54696d'),
(29, 'juan.zapata', '$2y$10$/bGvf6OYXX71ztn87TxQk.AsuswkWAMT3/lAJmf6.8UH/nP8quNI6', 'rFilsINHmVtGcIQz7xZp', 0, '1415657179', '11d0d047371407c7bc7ec7b845f63dda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_user_notes`
--

CREATE TABLE IF NOT EXISTS `wani_user_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(100) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL,
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `review_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_category_id` (`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_user_profiles`
--

CREATE TABLE IF NOT EXISTS `wani_user_profiles` (
  `user_id` int(11) NOT NULL,
  `profile_key` varchar(100) NOT NULL,
  `profile_value` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `idx_user_id_profile_key` (`user_id`,`profile_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Simple user profile storage table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_user_usergroup_map`
--

CREATE TABLE IF NOT EXISTS `wani_user_usergroup_map` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__users.id',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__usergroups.id',
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `wani_user_usergroup_map`
--

INSERT INTO `wani_user_usergroup_map` (`user_id`, `group_id`) VALUES
(211, 8),
(212, 2),
(213, 2),
(214, 2),
(215, 2),
(215, 8),
(216, 8),
(217, 2),
(218, 2),
(219, 2),
(220, 2),
(221, 2),
(223, 8),
(224, 2),
(225, 2),
(226, 2),
(227, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_viewlevels`
--

CREATE TABLE IF NOT EXISTS `wani_viewlevels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `title` varchar(100) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_assetgroup_title_lookup` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `wani_viewlevels`
--

INSERT INTO `wani_viewlevels` (`id`, `title`, `ordering`, `rules`) VALUES
(1, 'Publico', 0, '[1]'),
(2, 'Registrado', 1, '[6,2,8]'),
(3, 'Especial', 2, '[6,3,8]'),
(5, 'Invitado', 0, '[9]'),
(6, 'Super usuarios', 0, '[8]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wani_weblinks`
--

CREATE TABLE IF NOT EXISTS `wani_weblinks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `language` char(7) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if link is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `images` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
