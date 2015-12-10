<?php
//philum_plugin_installation 
session_start();

function plug_install($qd){if(!$qd)return;
$table["art"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_art` (
  `id` mediumint(6) NOT NULL auto_increment,
  `ib` mediumint(6) NOT NULL,
  `name` tinytext collate latin1_general_ci NOT NULL,
  `mail` tinytext collate latin1_general_ci NOT NULL,
  `day` int(10) NOT NULL,
  `nod` varchar(255) collate latin1_general_ci NOT NULL,
  `frm` varchar(255) collate latin1_general_ci NOT NULL,
  `suj` varchar(255) collate latin1_general_ci NOT NULL default "0",
  `re` int(2) NOT NULL,
  `lu` int(255) NOT NULL default "0",
  `img` text collate latin1_general_ci NOT NULL,
  `thm` tinytext collate latin1_general_ci NOT NULL,
  `host` mediumint(7) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `day_nod` (`day`,`nod`),
  KEY `suj` (`suj`),
  KEY `frm` (`frm`),
  KEY `ib` (`ib`)
) ENGINE=MyISAM collate latin1_general_ci;';

$table["txt"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_txt` (
  `id` int(11) NOT NULL auto_increment,
  `msg` longtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM collate latin1_general_ci;';

$table["idy"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_idy` (
  `id` int(7) NOT NULL auto_increment,
  `ib` int(7) NOT NULL,
  `name` varchar(255) collate latin1_general_ci NOT NULL default "",
  `mail` varchar(255) collate latin1_general_ci NOT NULL default "",
  `day` int(10) NOT NULL,
  `nod` varchar(255) collate latin1_general_ci NOT NULL default "",
  `frm` int(11) NOT NULL,
  `suj` varchar(255) collate latin1_general_ci NOT NULL default "0",
  `msg` mediumtext collate latin1_general_ci NOT NULL,
  `re` ENUM("0","1","2","3","4") NOT NULL,
  `lu` int(7) NOT NULL,
  `img` mediumtext collate latin1_general_ci NOT NULL default "",
  `thm` mediumtext collate latin1_general_ci NOT NULL default "",
  `host` varchar(255) collate latin1_general_ci NOT NULL default "",
  PRIMARY KEY  (`id`),
  KEY `nod_frm` (`day`,`frm`),
  KEY `nod_suj` (`day`,`suj`),
  KEY `nod_nod` (`day`,`nod`)
) ENGINE=MyISAM collate latin1_general_ci;';

$table["user"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_user` (  
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(50) collate latin1_general_ci NOT NULL default "",
  `pass` varchar(10) collate latin1_general_ci NOT NULL default "",
  `mail` varchar(255) collate latin1_general_ci NOT NULL default "",
  `day` int(11) NOT NULL,
  `clr` varchar(255) collate latin1_general_ci NOT NULL default "",
  `ip` varchar(255) collate latin1_general_ci NOT NULL default "",
  `rstr` varchar(255) collate latin1_general_ci NOT NULL default "",
  `mbrs` mediumtext collate latin1_general_ci NOT NULL,
  `hub` varchar(255) collate latin1_general_ci NOT NULL default "",
  `nbarts` int(10) NOT NULL,
  `config` mediumtext collate latin1_general_ci NOT NULL,
  `struct` mediumtext collate latin1_general_ci NOT NULL,
  `dscrp` mediumtext collate latin1_general_ci NOT NULL,
  `menus` mediumtext collate latin1_general_ci NOT NULL,
  `active` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `one` (`name`)
) ENGINE=MyISAM  collate latin1_general_ci;';

$table["live"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_live` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iq` int(11) NOT NULL,
  `qb` int(3) NOT NULL,
  `page` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `qb` (`qb`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;';

$table['ips']='
CREATE TABLE IF NOT EXISTS `'.$qd.'_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT "",
  `nav` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ref` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `nb` int(10) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;';

$table["stat"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_stat` (
  `id` int(7) NOT NULL auto_increment,
  `qb` varchar(255) collate latin1_general_ci NOT NULL default "",
  `day` int(10) NOT NULL,
  `pag` longtext collate latin1_general_ci NOT NULL,
  `nbu` int(9) collate latin1_general_ci NOT NULL default "0",
  `nbv` int(9) collate latin1_general_ci NOT NULL default "0",
  PRIMARY KEY (`id`),
  KEY `qb` (`qb`,`day`)
) ENGINE=MyISAM collate latin1_general_ci ;';

$table["datas"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_data` (
  `id` int(7) NOT NULL auto_increment,
  `ib` int(7) NOT NULL,
  `qb` varchar(255) collate latin1_general_ci NOT NULL default "",
  `day` int(10) NOT NULL,
  `cat` varchar(255) collate latin1_general_ci NOT NULL default "",
  `val` varchar(255) collate latin1_general_ci NOT NULL default "",
  `msg` mediumtext collate latin1_general_ci,
  PRIMARY KEY  (`id`),
  KEY `nod_qb` (`qb`,`day`),
  KEY `id_ib_val` (`ib`,`val`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ;';

$table["_sys"]='
CREATE TABLE IF NOT EXISTS `_sys` (
  `id` int(7) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default "",
  `page` varchar(255) NOT NULL default "",
  `maj` int(10) NOT NULL,
  `func` mediumblob,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM COLLATE=latin1_general_ci ;';

$table["_tags"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_tags` (
  `id` tinyint(7) NOT NULL,
  `cat` tinytext collate latin1_general_ci NOT NULL,
  `tag` tinytext collate latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;';

$table["_tagart"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_tagart` (
  `id` tinyint(4) NOT NULL,
  `idart` tinyint(7) NOT NULL,
  `idtag` tinyint(7) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;';

//relationnal
/*$table["_cat"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_cat` (
  `id` tinyint(4) NOT NULL,
  `cat` tinytext collate latin1_general_ci NOT NULL,
  `active` enum(\'0\',\'1\') collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;';

$table["_hubs"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_hubs` (
  `id` tinyint(4) NOT NULL,
  `hub` tinytext collate latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;';

$table["_mbrs"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_mbrs` (
  `id` tinyint(4) NOT NULL,
  `name` smallint(255) NOT NULL,
  `auth` enum(\'0\',\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\') collate latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;';*/

/*$table["_opt"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_opt` (
  `id` tinyint(4) NOT NULL,
  `opt` tinytext collate latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;';
*/


if($_SESSION['auth']>6 or $_SESSION['first'])
foreach($table as $k=>$sql){
	$req=mysql_query($sql) or die(mysql_error()); 
	$ret.=divc('',$qd.'_'.$k.': ok');}
$_SESSION['first']='';
return $ret;}

//require('../params/_connectx.php');
//require('../prog/lib.php');
//echo plug_install('pub');

?>