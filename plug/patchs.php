<?php
//philum_plugin_patches 
session_start();
error_reporting(0);
//require_once("../progb/lib.php");
//require_once('../params/_connectx.php');

function qlerror($ret){
//die($ret.mysql_error());
$ret.=mysql_error();
return $ret.br();}

//150521
function patch_passwd(){connect(); echo 'ok';
msquery('ALTER TABLE '.$_SESSION['qdu'].' CHANGE `pass` `pass` VARCHAR( 41 ) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL DEFAULT "";');
$r=sql('id,pass','qdu','kv',''); 
foreach($r as $k=>$v)//echo $v.br();
if(strlen($v)<30)
msquery('UPDATE '.$_SESSION['qdu'].' SET pass=PASSWORD("'.$v.'") WHERE id='.$k);
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
if($open)mysql_query($sql) or $ret.=qlerror('ips:exists'); $ret.=$sql.br().br();

$sql='
INSERT INTO `'.ses(qd).'_ips` SELECT * FROM `'.ses(qd).'_eye` ;';
if($open)mysql_query($sql) or $ret.=qlerror('ips_copy_eye'); $ret.=$sql.br().br();

$sql='alter table '.ses(qdp).' drop iq, drop pag, add ref varchar(255) COLLATE latin1_general_ci NOT NULL after nav, add time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP';
if($open)mysql_query($sql) or $ret.=qlerror('alter_ips:error'); $ret.=$sql.br().br();

$sql='CREATE TABLE IF NOT EXISTS `'.ses(qd).'_live` (`id` int(11) NOT NULL AUTO_INCREMENT,
  `iq` int(11) NOT NULL,`qb` int(3) NOT NULL,
  `page` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`), KEY `qb` (`qb`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;';
if($open)mysql_query($sql) or $ret.=qlerror('live:exists'); $ret.=$sql.br().br();

modif_vars('server','program_patches',array(1),'140615');
$_SESSION['stsys']='yes';
return $ret;}

//130602
function patch_userart(){
msquery('ALTER TABLE `'.ses('qdu').'` CHANGE `menus` `menus` SMALLINT(10) NULL ');
$r=sql('name','qdu','',''); //p($r);
foreach($r as $k=>$v){
	list($id,$day)=sql('id,day','qda','r','suj="'.$v.'" AND frm="user" LIMIT 1');
	if($id)echo $v.'_'.$id.'_'.$day.br();
	if(!$id)update('qdu','hub','','name',$v);
	update('qdu','menus',$day>0?$day:'','name',$v);
	delete('qda',$id); delete('qdm',$id);}
$r=sql('id,name','qda','kv','frm="user"'); p($r);
foreach($r as $k=>$v){delete('qda',$k); delete('qdm',$k);}}

//130430
function patch_sql(){
//qda
$r=array('day day INT(10) NOT NULL','ib ib INT(7) NOT NULL','name name TINYTEXT CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL','mail mail TINYTEXT CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL','re re ENUM("0","1","2","3","4") NOT NULL','lu lu INT(7) NOT NULL','host host MEDIUMINT(7) NOT NULL');//'frm frm TINYTEXT CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL',
foreach($r as $k=>$v){msquery('ALTER TABLE '.ses('qda').' CHANGE '.$v.';');
$ret.='qda'.$v.br();}
//qdi
$r=array('ib ib INT(7) NOT NULL','day day INT(10) NOT NULL','re re INT(7) NOT NULL','lu lu INT(7) NOT NULL','re re ENUM("0","1","2","3","4") NOT NULL');
foreach($r as $k=>$v){msquery('ALTER TABLE '.ses('qdi').' CHANGE '.$v.';');
$ret.='qdi'.$v.br();}
//qdd
$r=array('ib ib INT(7) NOT NULL','day day INT(10) NOT NULL');
foreach($r as $k=>$v){msquery('ALTER TABLE '.ses('qdd').' CHANGE '.$v.';');
$ret.='qdd'.$v.br();}
//qds
$r=array('day day INT(7) NOT NULL','nbu nbu INT(10) NOT NULL','nbv nbv INT(10) NOT NULL');
foreach($r as $k=>$v){msquery('ALTER TABLE '.ses('qds').' CHANGE '.$v.';');
$ret.='qde'.$v.br();}
//qde
$r=array('iq iq INT(7) NOT NULL','nb nb INT(10) NOT NULL');
foreach($r as $k=>$v){msquery('ALTER TABLE '.ses('qde').' CHANGE '.$v.';');
$ret.='qde'.$v.br();}
echo $ret.btn('txtalert','patch d\'optimisation des tables appliqué avec succès');}

//120805
/*function patch_htaccess(){
$txt=msql_read('system','default_htaccess',1);
$ok=write_file('.htaccess',$txt);
if($ok)return btn('txtyl',$ok).' '.hlpbt('htaccess');
return btn('txtyl',lkc('txtx','/?admin=htaccess','admin/htaccess'));}*/

//111215
/*function patch_art_priority_2(){
$rq=res("id,thm",$_SESSION['qda']); //.' WHERE nod="'.$_SESSION['qb'].'"'
while($data=mysql_fetch_array($rq)){$prm=''; $dthm=$data['thm'];
//$dthm=str_replace(array('Stay','Une'),array(2,1),$dthm);
$dthm=str_replace(array('***','**','*'),array(3,2,1),$dthm);
if(strpos($dthm,'3')!==false){
	$thm=str_replace(array(', 3','3'),'',$dthm); $prm=4;}
if(strpos($dthm,'2')!==false){
	$thm=str_replace(array(', 2','2'),'',$dthm); $prm=3;}
if(strpos($dthm,'1')!==false){
	$thm=str_replace(array(', 1','1'),'',$dthm); $prm=2;}
	if($prm){$nb++; //echo $id.':'.$thm.'_'.$prm.br();
	//update('qda','thm',$thm,"id",$data['id']); update('qda','re',$prm,"id",$data['id']);
	msquery('UPDATE '.$_SESSION['qda'].' SET thm="'.$thm.'", re="'.$prm.'" WHERE id="'.$data['id'].'" LIMIT 1');}}
echo $nb.' modifs';}*/

//111210
/*function patch_art_priority(){
$rq=res("id,thm",$_SESSION['qda'].' WHERE nod="'.$_SESSION['qb'].'"');
while($data=mysql_fetch_array($rq)){$thm='';
	if(strpos($data['thm'],'Une')!==false){$thm=str_replace('Une','*',$data['thm']);}
	if(strpos($data['thm'],'Stay')!==false){$thm=str_replace('Stay','**',$data['thm']);}
	if($thm){$nb++; //echo $thm.'_';
	update('qda','thm',$thm,"id",$data['id'],$_SESSION['qb']);}}
echo $nb.' modifs';}*/

//110614
/*function patch_globalc($func){
$hubs=sql('name','qdu','k','');
foreach($hubs as $k=>$v){call_user_func($func,$k);}}
//patch_globalc('patch_mods');

function patch_global_b($func){
$hubs=explore('msql/users/','files',1);
foreach($hubs as $k=>$v){
	list($hb,$nd,$xt)=split('_',$v);
	call_user_func($func,$hb);
	echo $hb.': ok'.br();}}*/
//patch_globalc('patch_mods');

//110703
/*function msq_select_globalc($dr,$nd){
$r=explore('msql/'.$dr,'files',1); $n=count($r);
for($i=0;$i<$n;$i++){$rb=split("[_.]",$r[$i]);
if($rb[1]==$nd && is_numeric($rb[2]) && $rb[3]!='sav')$ret[]=$rb[0].'_'.$rb[1].'_'.$rb[2];}
return $ret;}

function patch_correct_option($nod){ 
$dfb=array("block","module","param","title","condition","command","option","cache","hide","template","nobr");
$r=plug_motor('msql/users/',$nod,'');
if(count($r['_menus_'])<11){echo $nod.' '.count($r['_menus_']); unset($r['_menus_']);
//backup_old
	if($r){$valu=dump($r,$nod);	write_file('msql/users/'.$nod.'_sav.php',$valu);}
foreach($r as $k=>$v){
	if($v[6]=='nobr'){$r[$k][6]=''; $r[$k][10]='1';}
	else $r[$k][10]='';}
msql_save('users',$nod,$r,$dfb);}}

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
$r=plug_motor($bs,$nd,""); 
$r['_menus_'][]='template';
$r=repair_nbofcols($r);
save_vars($bs,$nd.'_1',$r);
//$rb=plug_motor($bs,$nd.'_1',"");
//if($rb){$erz=unlink($bs.$nd.'.php'); 
//	if($erz)echo $nd.': erased'.br();}
return $r;}*/

function plug_patchs($p,$o){
if(function_exists($p))return call_user_func($p,$o);
}

?>