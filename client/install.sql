CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `sort` smallint(11) NOT NULL,
  `show` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;



CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `config_data` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `config_data` (`key`, `value`) VALUES
('metadescr', ''),
('site_name', ''),
('site_pqiwi', '0'),
('site_pyandex', '0'),
('stblok', '1'),
('sitefon', ''),
('slide1', ''),
('slide2', ''),
('slide3', ''),
('vkblok', '1'),
('jivoid', ''),
('templates', 'Default'),
('site_pwebmoney', '0'),
('site_pinfo', ''),
('site_counters', ''),
('wmid', ''),
('wmk_file', ''),
('WMR', ''),
('WMZ', ''),
('WMU', ''),
('wm_key_date', ''),
('wm_pass', ''),
('qiwi_num', ''),
('qiwi_pass', ''),
('yad_client_id', ''),
('mpblok', '1'),
('yad_token', ''),
('site_logo', ''),
('site_flogo', ''),
('yad_wallet', ''),
('ppblok', '1'),
('wmid_n', '1'),
('kblok', '1'),
('site_ppkolvo', '1'),
('site_tptovar', '0'),
('vptsite', '1'),
('site_infokontakt', ''),
('ppcolor', '#2a9fd6'),
('pplimit', '3'),
('ssb', '9'),
('block_1', ''),
('block_2', ''),
('block_3', ''),
('block_4', ''),
('block_5', ''),
('block_6', ''),
('jobsite', '1'),
('prichina', '0'),
('ss1', ''),
('ss2', ''),
('ss3', ''),
('su1', ''),
('su2', ''),
('su3', ''),
('block_sl', '1'),
('version', '2.3'),
('f_id', ''),
('f_key_1', ''),
('site_pkassa', ''),
('f_key_2', ''),
('item', ''),
('items', ''),
('items_main', ''),
('item_page', ''),
('main', 'Магазин создан'),
('page', ''),
('replace', '1'),
('reviews', ''),
('reviews_form', ''),
('vk_hash', ''),
('vk_active', ''),
('ik_key', ''),
('ik_id', ''),
('ik_status', ''),
('ik_test', ''),
('pr_id', ''),
('pr_status', ''),
('pr_key', ''),
('rk_login', ''),
('rk_password_1', ''),
('rk_password_2', ''),
('rk_status', ''),
('search', '');


CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `rank` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `info` varchar(256) NOT NULL,
  `descr` text NOT NULL,
  `descrdop` text NOT NULL,
  `iconurl` varchar(255) NOT NULL,
  `price_rub` varchar(256) NOT NULL,
  `price_dlr` varchar(256) NOT NULL,
  `price_final` varchar(256) NOT NULL,
  `type_Item` text NOT NULL,
  `skidka` varchar(256) NOT NULL,
  `viewed` varchar(255) NOT NULL DEFAULT '0',
  `min_order` int(10) NOT NULL,
  `sell_method` tinyint(1) NOT NULL,
  `goods` text NOT NULL,
  `del` int(11) NOT NULL,
  `onmain` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;



CREATE TABLE IF NOT EXISTS `ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `ip` (`id`, `ip`) VALUES
(1, '255.255.255.255');

CREATE TABLE IF NOT EXISTS `kupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL,
  `pago` int(255) NOT NULL,
  `kupon_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `percentage` varchar(255) CHARACTER SET utf8 NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `goods` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `ip_address` varchar(255) NOT NULL,
  `attempts` int(1) NOT NULL,
  `lastLogin` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `login_attempts` (`ip_address`, `attempts`, `lastLogin`) VALUES
('7.7.7.7', 0, '1407497876');


CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `price` varchar(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `session_key` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `fund` varchar(255) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `redeemed` int(12) NOT NULL,
  `goods` text NOT NULL,
  `downlands` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET cp1251 NOT NULL,
  `slug` varchar(100) CHARACTER SET cp1251 NOT NULL,
  `order` int(11) NOT NULL,
  `body` text CHARACTER SET cp1251 NOT NULL,
  `loader` int(11) NOT NULL,
  `tpl` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `vdata` datetime DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `group` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `shoutbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rating` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `li` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `views` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `sviews` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `views` (`id`, `sviews`) VALUES
(1, 1);
