<?php
//philum_plugin_install

function install_db($qd=''){if(!$qd)$qd=ses('qd');// && 1==2
if(ses('enc')=='utf-8'){$charset='utf8mb4'; $langset='utf8mb4_general_ci';}
else{$charset='latin1'; $langset='latin1_general_ci';}
$collate='collate '.$langset;
$instructions='ENGINE=MyISAM '.$collate.' DEFAULT CHARSET='.$charset.';';
$table["art"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_art` (
  `id` int(7) NOT NULL auto_increment,
  `ib` int(7) NOT NULL,
  `name` tinytext NOT NULL,
  `mail` tinytext NOT NULL,
  `day` int(10) NOT NULL,
  `nod` varchar(25) NOT NULL,
  `frm` varchar(55) NOT NULL,
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

$table["txt"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_txt` (
  `id` int(7) NOT NULL auto_increment,
  `msg` longtext NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT INDEX `search` (`msg`)
) '.$instructions;

$table["trk"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_trk` (
  `id` int(7) NOT NULL auto_increment,
  `ib` int(7) NOT NULL,
  `name` varchar(255) NOT NULL default "",
  `mail` varchar(255) NOT NULL default "",
  `day` int(10) NOT NULL,
  `nod` varchar(255) NOT NULL default "",
  `frm` int(7) NOT NULL,
  `suj` varchar(255) NOT NULL default "0",
  `msg` mediumtext NOT NULL,
  `re` ENUM("0","1","2","3","4") NOT NULL,
  `host` varchar(255) NOT NULL default "",
  `lg` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nod` (`nod`),
  KEY `suj` (`suj`)
) '.$instructions;

$table["user"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_user` (  
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default "",
  `pass` varchar(50) NOT NULL default "",
  `mail` varchar(255) NOT NULL default "",
  `day` int(11) NOT NULL,
  `clr` varchar(255) NOT NULL default "",
  `ip` varchar(255) NOT NULL default "",
  `rstr` varchar(255) NOT NULL default "",
  `mbrs` mediumtext NOT NULL,
  `hub` varchar(255) NOT NULL default "",
  `nbarts` int(10) NOT NULL,
  `config` mediumtext NOT NULL,
  `struct` mediumtext NOT NULL,
  `dscrp` mediumtext NOT NULL,
  `menus` mediumtext NOT NULL,
  `active` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `one` (`name`)
) '.$instructions;

$table["live"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_live` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iq` int(11) NOT NULL,
  `qb` int(3) NOT NULL,
  `page` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `qb` (`qb`)
) '.$instructions;

$table["live2"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_live2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iq` int(11) NOT NULL,
  `qb` int(3) NOT NULL,
  `page` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `qb` (`qb`)
) '.$instructions;

$table['ips']='
CREATE TABLE IF NOT EXISTS `'.$qd.'_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL DEFAULT "",
  `nav` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `nb` int(10) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`)
) '.$instructions;

$table['iqs']='
CREATE TABLE IF NOT EXISTS `'.$qd.'_iqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iq` int(10) NOT NULL,
  `ok` int(2) NOT NULL,
  `usr` varchar(25) NOT NULL default "",
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) '.$instructions;

$table["stat"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_stat` (
  `id` int(7) NOT NULL auto_increment,
  `qb` varchar(255) NOT NULL default "",
  `day` int(10) NOT NULL,
  `nbu` int(9) NOT NULL default "0",
  `nbv` int(9) NOT NULL default "0",
  PRIMARY KEY (`id`),
  KEY `qb` (`qb`,`day`)
) '.$instructions;

$table["data"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_data` (
  `id` int(7) NOT NULL auto_increment,
  `ib` int(7) NOT NULL,
  `val` varchar(55) NOT NULL default "",
  `msg` varchar(255) NOT NULL default "",
  PRIMARY KEY (`id`),
  KEY `ib_val` (`ib`,`val`)
) '.$instructions;

$table["_sys"]='
CREATE TABLE IF NOT EXISTS `_sys` (
  `id` int(7) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default "",
  `page` varchar(255) NOT NULL default "",
  `maj` int(10) NOT NULL,
  `func` mediumblob,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) '.$instructions;

$table["meta"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_meta` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `cat` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

/*$table["_meta-ai"]=' 
ALTER TABLE `'.ses('qd').'_meta`
MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;';*/

$table["meta_art"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_meta_art` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idart` int(7) NOT NULL,
  `idtag` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$table["meta_clust"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_meta_clust` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtag` int(11) NOT NULL,
  `word` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$table["meta_mul"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_meta_mul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtag` int(11) NOT NULL,
  `tg` varchar(255) NOT NULL,
  `lg` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$table["favs"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_favs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ib` bigint(11) NOT NULL,
  `iq` bigint(11) NOT NULL,
  `type` varchar(11) NOT NULL,
  `poll` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$table["search"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_search` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `word` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$table["search_art"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_search_art` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `ib` int(7) NOT NULL,
  `art` int(7) NOT NULL,
  `nb` int(7) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$table["yandex"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_yandex` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `ref` varchar(11) NOT NULL,
  `txt` text NOT NULL,
  `lang` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$table["web"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_web` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `typ` varchar(3) NOT NULL,
  `url` varchar(255) NOT NULL,
  `tit` varchar(255) NOT NULL,
  `txt` longtext NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$table["twit"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_twit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ib` int(11) DEFAULT NULL,
  `twid` bigint(26) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT "",
  `screen_name` varchar(255) NOT NULL DEFAULT "",
  `user_id` bigint(26) DEFAULT NULL,
  `date` varchar(255) NOT NULL DEFAULT "",
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
  `lang` varchar(10) NOT NULL DEFAULT "",
  PRIMARY KEY (`id`),
  KEY `ib` (`ib`),
  UNIQUE KEY `twid` (`twid`)
) '.$instructions;

//todo
/**/$table["cat"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_cat` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `qb` tinytext NOT NULL,
  `cat` tinytext NOT NULL,
  `active` enum(\'0\',\'1\') NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$table["hub"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_hub` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `hub` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$table["mbr"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_mbr` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `hub` varchar(25) NOT NULL,
  `auth` enum(\'0\',\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\') NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;

$table["img"]='
CREATE TABLE IF NOT EXISTS `'.$qd.'_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ib` int(7) NOT NULL,
  `im` varchar(255) NOT NULL,
  `dc` varchar(255) NOT NULL,
  `no` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) '.$instructions;
//  `sz` varchar(25) NOT NULL,

return $table;}

function tables_defs(){
$r['art']=['id'=>'ai','ib'=>'int','name'=>'var25','mail'=>'var50','day'=>'int','nod'=>'var','frm'=>'var','suj'=>'var','re'=>'int','lu'=>'int','img'=>'var','thm'=>'var','host'=>'var','lg'=>'var2','key'=>'KEY `nod_frm` (`day`,`frm`), KEY `suj` (`suj`), KEY `nod_day` (`day`,`nod`)'];
$r['txt']=['id'=>'ai','msg'=>'long'];
$r['trk']=['id'=>'ai','ib'=>'int','name'=>'var','mail'=>'var','day'=>'int','nod'=>'var','frm'=>'var','suj'=>'var','msg'=>'long','re'=>'int','host'=>'var','key'=>'KEY `nod` (`nod`), KEY `suj_nod` (`suj`,`nod`), KEY `day_nod` (`day`,`nod`)'];
$r['user']=['id'=>'ai','name'=>'var','pass'=>'var','mail'=>'var','day'=>'int','clr'=>'var','ip'=>'var','rstr'=>'var','mbrs'=>'var','hub'=>'var','nbarts'=>'int','config'=>'var','struct'=>'var','dscrp'=>'var','menus'=>'var','active'=>'int','key'=>'UNIQUE KEY `one` (`name`)'];
$r['data']=['id'=>'ai','ib'=>'var','val'=>'var','msg'=>'var','key'=>'KEY `ib_val` (`ib`,`val`)'];
$r['sys']=['id'=>'ai','name'=>'var','page'=>'var','maj'=>'int','func'=>'var'];
$r['live']=['id'=>'ai','iq'=>'int','qb'=>'int','page'=>'var','time'=>'time','key'=>
'KEY `qb` (`qb`)'];
$r['live2']=['id'=>'ai','iq'=>'int','qb'=>'int','page'=>'var','time'=>'time','key'=>
'KEY `qb` (`qb`)'];
$r['ips']=['id'=>'ai','ip'=>'var','nav'=>'var','ref'=>'var','nb'=>'int','time'=>'time','key'=>
'KEY `ip` (`ip`)'];
$r['iqs']=['id'=>'ai','iq'=>'int','ok'=>'int','usr'=>'var','time'=>'time'];
$r['stat']=['id'=>'ai','qb'=>'var','day'=>'int','nbu'=>'int','nbv'=>'int','key'=>'KEY `qb` (`qb`,`day`)'];
$r['meta']=['id'=>'ai','qb'=>'var','cat'=>'var','tag'=>'var'];
$r['meta_art']=['id'=>'ai','idart'=>'int','idtag'=>'int'];
$r['meta_clust']=['id'=>'ai','idart'=>'int','word'=>'var'];
$r['meta_mul']=['id'=>'ai','idart'=>'int','tg'=>'var','lg'=>'var2'];
$r['favs']=['id'=>'ai','ib'=>'int','iq'=>'int','poll'=>'int'];
$r['mbr']=['id'=>'ai','name'=>'var','hub'=>'var','auth'=>'int'];
$r['img']=['id'=>'ai','ib'=>'int','im'=>'var','dc'=>'var','no'=>'int'];
$r['yandex']=['id'=>'ai','ref'=>'var25','txt'=>'long','lang'=>'var2'];
$r['web']=['id'=>'ai','typ'=>'var3','url'=>'var','tit'=>'var','txt'=>'long','img'=>'var'];
$r['twit']=['id'=>'ai','ib'=>'int','twid'=>'bint','name'=>'var','screen_name'=>'var','date'=>'var','text'=>'text','media'=>'var','reply_id'=>'bint','reply_name'=>'var','favs'=>'int','retweet'=>'int','followers'=>'int','friends'=>'int','quote_id'=>'bint','quote_name'=>'var'];
//umm
/*$r['bdvoc']=['id'=>'ia','ref'=>'svar','idart'=>'sint','date'=>'svar','lang'=>'2var','voc'=>'var','txt'=>'text','sound'=>'svar'];
$r['dicoen']=['id'=>'ia','mot'=>'svar'];
$r['dicofr']=['id'=>'ia','mot'=>'svar','sound'=>'var'];
$r['bdvoc']=['id'=>'ia','voc'=>'var','def'=>'bvar','snd'=>'svar','typ'=>'word/expression/name/planet/unit'];
$r['gaia']=['id'=>'ia','gid'=>'bint','ra'=>'double','dc'=>'double','parallax'=>'double','pmra'=>'double','pmdec'=>'double','mag'=>'double'];*/
//$r['bdvoc']=['id'=>'ia',''=>'',];
return $r;}

function plug_install($qd){
if(!$qd)return;
$r=install_db($qd); $ret='';
if(ses('auth')>6 or ses('first'))
foreach($r as $k=>$sql){
	$req=mysqli_query($_SESSION['qr'],$sql);
	if(mysqli_connect_errno())print_r(mysqli_connect_error());
	else $ret.=divc('',$qd.'_'.$k.': ok');}
$_SESSION['first']='';
return $ret;}

?>