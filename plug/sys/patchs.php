<?php //patches

//22
function patch_msql(){
$r=explorer('msql');
foreach($r as $k=>$v){
	$d=read_file($v);
	$d=str_replace('_menus_','_',$d);
	file_put_contents($v,$d);}
return 'ok';}

//20
function patch_iqs(){
ses('qdk','pub_iqs');
$ra=install::db(); $sql=$ra['iqs']; if($sql)qr($sql);
return 'ok';}

function patch_qdt(){
//qr('ALTER TABLE `'.ses('qdw').'` CHANGE `typ` `ib` INT(11) NOT NULL;');
return 'ok';}

function patch_web(){
qr('ALTER TABLE `'.ses('qdw').'` CHANGE `typ` `ib` INT(11) NOT NULL;');
return 'ok';}

//translate members to new table mbr
function patch_mbr(){
$ra=install::db(); $sql=$ra['mbr']; qr($sql);
$r=sql('name,mbrs','qdu','kv',''); $rc=[]; pr($r);
foreach($r as $k=>$v){$rb=explode(',',$v);
	foreach($rb as $kb=>$vb){[$ath,$usr]=opt($vb,'::'); //p([$k,$usr,$ath]);
	$ex=sql('id','qdb','v',['name'=>$usr,'hub'=>$k]);
	if($usr && $k!='admin' && !$ex)sqlsav('qdb',[$usr,$k,$ath]);}}}

//poll becom favs//19
function patch_poll(){
$ok=ses('ok'); if($ok)return;
//ib,iq,type,poll
qr('ALTER TABLE `pub_poll` ADD `type` VARCHAR(11) NOT NULL AFTER `iq`',1);
qr(' RENAME TABLE `pub_poll` TO `pub_favs`;',1);//qdpl=>qdf
ses('qdf','pub_favs');
$r=sql('ib,val,msg','qdd','','val="agree" and msg!="false" and msg!="true" and msg!="1"');
foreach($r as $k=>$v){[$ib,$val,$msg]=$v; $rb=[$ib,$msg,$val,1];
if($ib<10000000 && $msg)$nid=sqlsav('qdf',$rb);}

$r=sql('ib,val,msg','qdd','','val="like" and msg!="false" and msg!="true" and msg!="1"');
foreach($r as $k=>$v){[$ib,$val,$msg]=$v; $rb=[$ib,$msg,$val,1];
if($msg)$nid=sqlsav('qdf',$rb);}

$r=sql('ib,val,msg','qdd','','val="fav" and msg!="false" and msg!="true" and msg!="1"');
foreach($r as $k=>$v){[$ib,$val,$msg]=$v; $rb=[$ib,$msg,$val,1];
$nid=sqlsav('qdf',$rb);}

qr('DELETE FROM `pub_data` WHERE val="agree" and msg!="false" and msg!="true" and msg!="1"');
qr('DELETE FROM `pub_data` WHERE val="like" and msg!="false" and msg!="true" and msg!="1"');
qr('DELETE FROM `pub_data` WHERE val="fav" and msg!="false" and msg!="true" and msg!="1"');
ses('ok',1);}

function patch_trklg(){
$ok=ses('ok'); if($ok)return;
qr('ALTER TABLE `pub_trk` ADD `lg` VARCHAR(2) NOT NULL AFTER `host`');
qr('UPDATE `pub_trk` SET lg=suj');
qr('UPDATE `pub_trk` SET ib=frm');
qr('UPDATE `pub_trk` SET suj=""');
qr('UPDATE `pub_trk` SET frm="" where concat("",frm * 1) = frm');//del numbers only
ses('ok',1);}

function qlerror($ret){
//die($ret.mysqli_error());
$ret.=mysqli_error();
return $ret.br();}

//181225
function patch_lastup(){
$r=explore('_datas'); //pr($r);
foreach($r as $k=>$v){
$rb=explode('_',$v);
if($rb[2]=='lastupdate.txt'){echo $id=$rb[1].' ';
$d=read_file('_datas/'.$v);
echo $tim=strtotime($d);
utag_sav($id,'lastup',$tim);
unlink('_datas/'.$v);
}}}

//180406
function patch_lg(){
qr('ALTER TABLE '.$_SESSION['qda'].'` ADD `lg` VARCHAR(2) NOT NULL;',1);
$r=sql('ib,msg','qdd','kv','val="lang"');
if($r)foreach($r as $k=>$v)sql::upd('qda',['lg'=>$v],$k);
qr('update '.$_SESSION['qda'].' set lg="fr" where lg=""');
qr('delete from '.$_SESSION['qdd'].' where val="lang"'); sql::reflush('qdd',1);}

//160606
function patch_tracks(){
$qdi=qd('idy'); $qdk=qd('tracks');
$sql='RENAME TABLE '.$qdi.' TO '.$qdk.';'; qr($sql);
$sql='ALTER TABLE '.$qdk.' DROP lu, DROP img, DROP thm;'; qr($sql);
//$sql='ALTER TABLE '.$qdk.' CHANGE `ib` `i.ib` INT(7) NOT NULL, CHANGE `name` `i.name` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL DEFAULT "", CHANGE `mail` `i.mail` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL DEFAULT "", CHANGE `day` `i.day` INT(10) NOT NULL, CHANGE `nod` `i.nod` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL DEFAULT "", CHANGE `frm` `i.frm` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL DEFAULT "", CHANGE `suj` `i.suj` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL DEFAULT "0", CHANGE `msg` `i.msg` MEDIUMTEXT CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL, CHANGE `re` `i.re` ENUM("0","1","2","3","4") CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL, CHANGE `lu` `i.lu` INT(7) NOT NULL, CHANGE `img` `i.img` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL DEFAULT "", CHANGE `thm` `i.thm` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL DEFAULT "", CHANGE `host` `i.host` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL DEFAULT "";';
//qr($sql);
}

//160215
function patch_qdd(){
//qr('ALTER TABLE `'.ses('qdd').'` DROP `qb`;');
$r=sql('*','qdlk','','poll=1'); p($r);
//foreach($r as $k=>$v)sql::sav('qdd',[$v[1],'fav',$v[2]]);
}

function patch_fav(){
$r=msql::read('',ses('qb').'_fav','','1'); p($r);
foreach($r as $k=>$v){$rb=explode(' ',$v);
	//foreach($rb as $vb)sql::sav('qdd',[$vb,'fav',$k]);
	}
}

//160101
function patch_tags(){
$table["_meta"]='
CREATE TABLE IF NOT EXISTS `'.ses('qd').'_meta` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `cat` varchar(255) collate latin1_general_ci NOT NULL,
  `tag` varchar(255) collate latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;';
/*
$table["_meta-id"]='
ALTER TABLE `'.ses('qd').'_meta`
ADD PRIMARY KEY (`id`);';*/

$table["_meta_art"]='
CREATE TABLE IF NOT EXISTS `'.ses('qd').'_meta_art` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idart` int(7) NOT NULL,
  `idtag` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;';
/*
$table["_meta_art-id"]='
ALTER TABLE `'.ses('qd').'_meta_art`
ADD PRIMARY KEY (`id`);';*/

foreach($table as $k=>$sql){
	$req=mysqli_query($sql) or die(mysqli_error()); 
	$ret.=divc('',ses('qd').''.$k.': created');}

$ret.=lka('/app/tagpatch/','Apply patch to fill the new databases (click on each links)');
return $ret;}

//150521
function patch_passwd(){echo 'ok';
qr('ALTER TABLE '.$_SESSION['qdu'].' CHANGE `pass` `pass` VARCHAR( 41 ) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL DEFAULT "";');
$r=sql('id,pass','qdu','kv',''); 
foreach($r as $k=>$v)//echo $v.br();
if(strlen($v)<30)
qr('UPDATE '.$_SESSION['qdu'].' SET pass=PASSWORD("'.$v.'") WHERE id='.$k);
}

//141110
function repsep($d,$k,$f,$n){
$doc=read_file('/msql/'.$d.'/'.$f);
$doc=str_replace('§','$',$doc);
write_file('/msql/'.$d.'/'.$f,$doc);}

function patch_varseparator(){
$r=walk_dir('/msql','repsep');}

//140615
function patch_sql_stats(){$open=1;
$sql='CREATE TABLE `'.ses(qd).'_ips` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT,
`ip` varchar( 255 ) COLLATE latin1_german1_ci NOT NULL DEFAULT "",
`iq` int( 7 ) NOT NULL,
`nav` varchar( 255 ) COLLATE latin1_german1_ci NOT NULL DEFAULT "",
`pag` longtext COLLATE latin1_german1_ci NOT NULL,
`nb` int( 10 ) NOT NULL,
PRIMARY KEY (`id`),
KEY `ip` (`ip`)
) ENGINE = MYISAM DEFAULT CHARSET = latin1 COLLATE = latin1_german1_ci;';
if($open)mysqli_query($sql) or $ret.=qlerror('ips:exists'); $ret.=$sql.br().br();

$sql='
INSERT INTO `'.ses(qd).'_ips` SELECT * FROM `'.ses(qd).'_eye` ;';
if($open)mysqli_query($sql) or $ret.=qlerror('ips_copy_eye'); $ret.=$sql.br().br();

$sql='alter table '.ses(qdp).' drop iq, drop pag, add ref varchar(255) COLLATE latin1_general_ci NOT NULL after nav, add time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP';
if($open)mysqli_query($sql) or $ret.=qlerror('alter_ips:error'); $ret.=$sql.br().br();

$sql='CREATE TABLE IF NOT EXISTS `'.ses(qd).'_live` (`id` int(11) NOT NULL AUTO_INCREMENT,
  `iq` int(11) NOT NULL,`qb` int(3) NOT NULL,
  `page` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`), KEY `qb` (`qb`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;';
if($open)mysqli_query($sql) or $ret.=qlerror('live:exists'); $ret.=$sql.br().br();

msql::modif('server','program_patches',[1],140615);
$_SESSION['stsys']='yes';
return $ret;}

//130602
function patch_userart(){
qr('ALTER TABLE `'.ses('qdu').'` CHANGE `menus` `menus` SMALLINT(10) NULL ');
$r=sql('name','qdu','',''); //p($r);
foreach($r as $k=>$v){
	[$id,$day]=sql('id,day','qda','r','suj="'.$v.'" AND frm="user" LIMIT 1');
	if($id)echo $v.'_'.$id.'_'.$day.br();
	if(!$id)sql::upd('qdu',['hub'=>''],['name'=>$v]);
	sql::upd('qdu',['menus'=>$day>0?$day:''],['name'=>$v]);
	sql::del('qda',$id); sql::del('qdm',$id);}
$r=sql('id,name','qda','kv','frm="user"'); p($r);
foreach($r as $k=>$v){sql::del('qda',$k); sql::del('qdm',$k);}}

//130430
function patch_sql(){
//qda
$r=array('day day INT(10) NOT NULL','ib ib INT(7) NOT NULL','name name TINYTEXT CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL','mail mail TINYTEXT CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL','re re ENUM("0","1","2","3","4") NOT NULL','lu lu INT(7) NOT NULL','host host MEDIUMINT(7) NOT NULL');//'frm frm TINYTEXT CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL',
foreach($r as $k=>$v){qr('ALTER TABLE '.ses('qda').' CHANGE '.$v.';');
$ret.='qda'.$v.br();}
//qdi
$r=array('ib ib INT(7) NOT NULL','day day INT(10) NOT NULL','re re INT(7) NOT NULL','lu lu INT(7) NOT NULL','re re ENUM("0","1","2","3","4") NOT NULL');
foreach($r as $k=>$v){qr('ALTER TABLE '.ses('qdi').' CHANGE '.$v.';');
$ret.='qdi'.$v.br();}
//qdd
$r=array('ib ib INT(7) NOT NULL','day day INT(10) NOT NULL');
foreach($r as $k=>$v){qr('ALTER TABLE '.ses('qdd').' CHANGE '.$v.';');
$ret.='qdd'.$v.br();}
//qds
$r=array('day day INT(7) NOT NULL','nbu nbu INT(10) NOT NULL','nbv nbv INT(10) NOT NULL');
foreach($r as $k=>$v){qr('ALTER TABLE '.ses('qds').' CHANGE '.$v.';');
$ret.='qde'.$v.br();}
//qde
$r=array('iq iq INT(7) NOT NULL','nb nb INT(10) NOT NULL');
foreach($r as $k=>$v){qr('ALTER TABLE '.ses('qde').' CHANGE '.$v.';');
$ret.='qde'.$v.br();}
echo $ret.btn('txtalert','patch d\'optimisation des tables appliqué avec succès');}

//120805
/*function patch_htaccess(){
$txt=msql::val('system','default_htaccess',1);
$ok=write_file('.htaccess',$txt);
if($ok)return btn('txtyl',$ok).' '.hlpbt('htaccess');
return btn('txtyl',lkc('txtx','/?admin=htaccess','admin/htaccess'));}*/

//111215
/*function patch_art_priority_2(){
$rq=res("id,thm",$_SESSION['qda']); //.' WHERE nod="'.$_SESSION['qb'].'"'
while($data=sql::qrr($rq)){$prm=''; $dthm=$data['thm'];
//$dthm=str_replace(array('Stay','Une'),array(2,1),$dthm);
$dthm=str_replace(array('***','**','*'),array(3,2,1),$dthm);
if(strpos($dthm,'3')!==false){
	$thm=str_replace(array(', 3','3'),'',$dthm); $prm=4;}
if(strpos($dthm,'2')!==false){
	$thm=str_replace(array(', 2','2'),'',$dthm); $prm=3;}
if(strpos($dthm,'1')!==false){
	$thm=str_replace(array(', 1','1'),'',$dthm); $prm=2;}
	if($prm){$nb++; //echo $id.':'.$thm.'_'.$prm.br();
	//sql::upd('qda',['thm'=>$thm],$data['id']); sql::upd('qda',['re'=>$prm],$data['id']);
	qr('UPDATE '.$_SESSION['qda'].' SET thm="'.$thm.'", re="'.$prm.'" WHERE id="'.$data['id'].'" LIMIT 1');}}
echo $nb.' modifs';}*/

//111210
/*function patch_art_priority(){
$rq=res("id,thm",$_SESSION['qda'].' WHERE nod="'.$_SESSION['qb'].'"');
while($data=sql::qrr($rq)){$thm='';
	if(strpos($data['thm'],'Une')!==false){$thm=str_replace('Une','*',$data['thm']);}
	if(strpos($data['thm'],'Stay')!==false){$thm=str_replace('Stay','**',$data['thm']);}
	if($thm){$nb++; //echo $thm.'_';
	sql::upd('qda',['thm'=>$thm],$data['id'],$_SESSION['qb']);}}
echo $nb.' modifs';}*/

//110614
/*function patch_globalc($func){
$hubs=sql('name','qdu','k','');
foreach($hubs as $k=>$v){call_user_func($func,$k);}}
//patch_globalc('patch_mods');

function patch_global_b($func){
$hubs=explore('msql/users/','files',1);
foreach($hubs as $k=>$v){
	[$hb,$nd,$xt]=explode('_',$v);
	call_user_func($func,$hb);
	echo $hb.': ok'.br();}}*/
//patch_globalc('patch_mods');

//110703
/*function msq_select_globalc($dr,$nd){
$r=explore('msql/'.$dr,'files',1); $n=count($r);
for($i=0;$i<$n;$i++){$rb=explode("[_.]",$r[$i]);
if($rb[1]==$nd && is_numeric($rb[2]) && $rb[3]!='sav')$ret[]=$rb[0].'_'.$rb[1].'_'.$rb[2];}
return $ret;}

function patch_correct_option($nod){ 
$dfb=["block","module","param","title","condition","command","option","cache","hide","template","nobr"];
$r=read_vars('msql/users/',$nod,'');
if(count($r['_menus_'])<11){echo $nod.' '.count($r['_menus_']); unset($r['_menus_']);
//backup_old
	if($r){$valu=msql::dump($r,$nod);	write_file('msql/users/'.$nod.'_sav.php',$valu);}
foreach($r as $k=>$v){
	if($v[6]=='nobr'){$r[$k][6]=''; $r[$k][10]='1';}
	else $r[$k][10]='';}
msql::save('users',$nod,$r,$dfb);}}

function patch_nobr(){
$r=msq_select_globalc('users','mods'); //p($r);
foreach($r as $k=>$v){patch_correct_option($v);}//if($v=='dev_mods_1')
}*/

//110428
/*function repair_nbofcols($r){
$nb=count($r['_menus_']);
foreach($r as $k=>$v){$ra='';
	for($i=0;$i<$nb;$i++){$ra[$i]=$v[$i];}
	$ret[$k]=$ra;}
return $ret;}*/

/*function patch_mods($qb){
$bs='msql/users/'; $nd=$qb.'_mods';
$r=read_vars($bs,$nd,""); 
$r['_menus_'][]='template';
$r=repair_nbofcols($r);
save_vars($bs,$nd.'_1',$r);
//$rb=read_vars($bs,$nd.'_1',"");
//if($rb){$erz=unlink($bs.$nd.'.php'); 
//	if($erz)echo $nd.': erased'.br();}
return $r;}*/

class patchs{
static function home($p,$o){
if(function_exists($p))return $p($o);}
}
?>