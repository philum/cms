<?php //philum_install
class install{
static function db($qd=''){if(!$qd)$qd=ses('qd');// && 1==2
if(sql::$enc=='utf8'){$charset='utf8mb4'; $langset='utf8mb4_unicode_ci';}
else{$charset='latin1'; $langset='latin1_general_ci';}
$collate='collate '.$langset;
//$instructions='ENGINE=MyISAM '.$collate.' DEFAULT CHARSET='.$charset.';';
$instructions='ENGINE=InnoDB '.$collate.' DEFAULT CHARSET='.$charset.';';
$ret["art"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_art` (
  `id` int(7) NOT NULL auto_increment,
  `ib` int(7) NOT NULL,
  `name` varchar(55) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `day` int(10) NOT NULL,
  `nod` varchar(25) NOT NULL,
  `frm` varchar(255) NOT NULL,
  `suj` varchar(255) NOT NULL default "0",
  `re` int(2) NOT NULL,
  `lu` int(7) NOT NULL default "0",
  `img` text NOT NULL,
  `thm` varchar(255) NOT NULL,
  `host` int(7) NOT NULL,
  `lg` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `day_nod` (`day`,`nod`),
  KEY `suj` (`suj`),
  KEY `frm` (`frm`),
  KEY `ib` (`ib`)
) '.$instructions;

$ret["txt"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_txt` (
  `id` int(7) NOT NULL auto_increment,
  `msg` longtext NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT INDEX `search` (`msg`)
) '.$instructions;

$ret["trk"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_trk` (
  `id` int(7) NOT NULL auto_increment,
  `ib` int(7) NOT NULL,
  `name` varchar(255) NOT NULL default "",
  `mail` varchar(255) NOT NULL default "",
  `day` int(10) NOT NULL,
  `nod` varchar(255) NOT NULL default "",
  `frm` varchar(25) NOT NULL default "",
  `suj` varchar(255) NOT NULL default "",
  `msg` mediumtext NOT NULL,
  `re` ENUM("0","1","2","3","4") NOT NULL,
  `host` varchar(255) NOT NULL default "",
  `lg` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nod` (`nod`),
  KEY `suj` (`suj`)
) '.$instructions;

$ret["user"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_user` (  
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(55) NOT NULL default "",
  `pass` varchar(55) NOT NULL default "",
  `mail` varchar(255) NOT NULL default "",
  `day` int(10) NOT NULL,
  `clr` varchar(255) NOT NULL default "",
  `ip` varchar(255) NOT NULL default "",
  `rstr` varchar(255) NOT NULL default "",
  `mbrs` mediumtext NOT NULL,
  `hub` varchar(255) NOT NULL default "",
  `nbarts` int(7) NOT NULL,
  `config` mediumtext NOT NULL,
  `struct` mediumtext NOT NULL,
  `dscrp` mediumtext NOT NULL,
  `menus` mediumtext NOT NULL,
  `active` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `one` (`name`)
) '.$instructions;

$ret["live"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_live` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iq` int(11) NOT NULL,
  `qb` int(3) NOT NULL,
  `page` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `qb` (`qb`)
) '.$instructions;

$ret["live2"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_live2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iq` int(11) NOT NULL,
  `qb` int(3) NOT NULL,
  `page` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `qb` (`qb`)
) '.$instructions;

$ret['ips']='
CREATE TABLE IF NOT EXISTS `'.$qd.'_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL DEFAULT "",
  `nav` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `nb` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`)
) '.$instructions;

$ret['iqs']='
CREATE TABLE IF NOT EXISTS `'.$qd.'_iqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iq` int(11) NOT NULL,
  `ok` int(2) NOT NULL,
  `usr` varchar(25) NOT NULL default "",
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) '.$instructions;

$ret["stat"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_stat` (
  `id` int(7) NOT NULL auto_increment,
  `qb` varchar(255) NOT NULL default "",
  `day` int(10) NOT NULL,
  `nbu` int(9) NOT NULL default "0",
  `nbv` int(9) NOT NULL default "0",
  PRIMARY KEY (`id`),
  KEY `qb` (`qb`,`day`)
) '.$instructions;

$ret["data"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_data` (
  `id` int(7) NOT NULL auto_increment,
  `ib` int(7) NOT NULL,
  `val` varchar(55) NOT NULL default "",
  `msg` varchar(255) NOT NULL default "",
  PRIMARY KEY (`id`),
  KEY `ib_val` (`ib`,`val`)
) '.$instructions;

$ret["_sys"]='
CREATE TABLE IF NOT EXISTS `_sys` (
  `id` int(7) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default "",
  `page` varchar(255) NOT NULL default "",
  `maj` int(10) NOT NULL,
  `func` mediumblob,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) '.$instructions;

$ret["meta"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_meta` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `cat` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

/*$ret["_meta-ai"]=' 
ALTER TABLE `'.ses('qd').'_meta`
MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;';*/

$ret["meta_art"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_meta_art` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idart` int(7) NOT NULL,
  `idtag` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$ret["meta_clust"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_meta_clust` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtag` int(11) NOT NULL,
  `word` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$ret["meta_mul"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_meta_mul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtag` int(11) NOT NULL,
  `tg` varchar(255) NOT NULL,
  `lg` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$ret["favs"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_favs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ib` int(11) NOT NULL,
  `iq` int(11) NOT NULL,
  `type` varchar(25) NOT NULL,
  `poll` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$ret["search"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_search` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `word` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$ret["search_art"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_search_art` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `ib` int(7) NOT NULL,
  `art` int(7) NOT NULL,
  `nb` int(7) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$ret["yandex"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_yandex` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `ref` varchar(11) NOT NULL,
  `txt` text NOT NULL,
  `lang` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$ret["web"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_web` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `ib` int(7) NOT NULL,
  `url` varchar(255) NOT NULL,
  `tit` varchar(255) NOT NULL,
  `txt` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;//typ?

$ret["twit"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_twit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ib` int(11) DEFAULT NULL,
  `twid` bigint(26) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT "",
  `screen_name` varchar(255) NOT NULL DEFAULT "",
  `user_id` bigint(26) DEFAULT NULL,
  `date` int(10) NOT NULL DEFAULT "",
  `text` mediumtext NOT NULL,
  `media` varchar(255) NOT NULL DEFAULT "",
  `mentions` varchar(255) NOT NULL DEFAULT "",
  `reply_id` bigint(26) DEFAULT NULL,
  `reply_name` varchar(255) NOT NULL DEFAULT "",
  `favs` int(11) DEFAULT NULL,
  `retweet` int(11) DEFAULT NULL,
  `followers` int(11) DEFAULT NULL,
  `friends` int(11) DEFAULT NULL,
  `quote_id` bigint(26) DEFAULT NULL,
  `quote_name` varchar(255) NOT NULL DEFAULT "",
  `retweeted` bigint(26) NOT NULL DEFAULT "",
  `lang` varchar(2) NOT NULL DEFAULT "",
  PRIMARY KEY (`id`),
  KEY `ib` (`ib`),
  UNIQUE KEY `twid` (`twid`)
) '.$instructions;

//todo
/**/$ret["cat"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_cat` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `qb` varchar(55) NOT NULL,
  `cat` varchar(55) NOT NULL,
  `active` enum(\'0\',\'1\') NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$ret["hub"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_hub` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `hub` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$ret["mbr"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_mbr` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `hub` varchar(25) NOT NULL,
  `auth` enum(\'0\',\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\') NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$ret["img"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ib` int(7) NOT NULL,
  `im` varchar(255) NOT NULL,
  `dc` varchar(255) NOT NULL,
  `no` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;
//  `sz` varchar(25) NOT NULL,

return $ret;}

static function home1($qd='pub'){
$r=self::db($qd); $ret='';
if(ses('auth')>6 or ses('first'))
foreach($r as $k=>$sql){
	$req=mysqli_query(sql::$qr,$sql);
	if(mysqli_connect_errno())print_r(mysqli_connect_error());
	else $ret.=divc('',$qd.'_'.$k.': ok');}
$_SESSION['first']='';
return $ret;}

static function home($qd='pub'){
ses('qd',$qd);
return sqldb::batchinstall();}
}
?>