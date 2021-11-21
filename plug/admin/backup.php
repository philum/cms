<?php
//philum_plugin_backup
//if(!auth(6))exit;

function backup_dbcols($db){
return sql_b('select COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS where table_name="'.ts_pub($db).'"','kv');}

function b_atm($v){return '"'.qres(($v)).'"';}//utf8_encode
function b_atmr($r){foreach($r as $k=>$v)$ret[]=b_atm($v); return $ret;}
function b_atmrup($r){foreach($r as $k=>$v)$ret[]=$k.'='.b_atm($v); return $ret;}
function b_mysqlra($r,$o=''){$rb=b_atmr($r); $d=$o?'"",':''; if($rb)return '('.$d.implode(',',$rb).')';}
function b_mysqlrup($r,$o=''){$rb=b_atmrup($r); $d=$o?'"",':''; if($rb)return $d.implode(',',$rb);}

function backup_build($db,$id,$o=''){$ret=''; $rb=[]; $err=''; $b=ts_pub($db);//$rb=[];
$ra=backup_dbcols($b); $cols=implode(',',array_keys($ra)); //pr($ra);
$r=sql_b('select '.$cols.' from '.($b).' where id>'.$id,'ar',0);
if($o==1){$deb='update `'.($b).'` set ';
	if($r)foreach($r as $k=>$v)$rb[]=$deb.b_mysqlrup($v).' where id="'.$v['id'].'";';}
else{$deb='INSERT INTO `'.($b).'` ('.$cols.') VALUES ';
	if($r)foreach($r as $k=>$v)$rb[]=b_mysqlra($v);}//pr($rb);
if($rb){if($o==1)$ret=implode("\n",$rb); else $ret=$deb.implode(",\n",$rb).';';}
//if($o)return $ret;
$f='_backup/'.$db.'.dump';//_from_'.$id.'
if(is_file($f))unlink($f); //eco($ret);
if($ret)$err=write_file($f,$ret); //exc('gzip -r /home/nfo/'.$f);
//$err=gz_write2($f,$ret);
if(!$err)return lkt('txtyl','/'.$f,$f);}//.'.gz'

function backup_dump($b){
if($_SERVER['HTTP_HOST']=='oumo.fr')$n=12; else $n=11;
list($usr,$db,$ps,$dr)=transport_srv(); $table=$b!=1?ts_pub($b):'';
$f='_backup/'.($b!=1?$b:$db.date('ymd')).'.dump';//–default-character-set=utf8
if($b==1){if(is_file($f.'.gz'))return $f.'.gz';} elseif(is_file($f))unlink($f); 
$e='mysqldump -u'.$usr.' -h localhost -p'.$ps.' '.$db.' '.$table.' > /home/'.$dr.'/'.$f;
//$e='mysqldump -u'.$usr.' -p'.$ps.' '.$db.' '.$table.' -r /home/'.$dr.'/'.$f.'';//export to utf8
shell_exec($e); if($b==1){shell_exec('gzip -r /home/'.$dr.'/'.$f); $f.='.gz';}
return $f;}

function backup_json($b){
//req('boot'); reboot();
$r=db_r(); $db=$r[$b];
$r=sql('*',$db,'','');
$f='_backup/'.$b.'.json';
$d=mkjson($r);
$er=json_error();
write_file($f,$d);
//$f=tar::gz($f);
return $f;}

function backup_restore($d){//import
$d='mysql -u'.$user.' -p'.$pasw.' '.$host.' '.$base.' < '.$f; 
//$d='cat '.$f.' | mysql --host='.$host.' --user='.$user.' --password='.$pasw.' '.$base.'');
exc($d);}

function plug_backup($p,$o){
if(!$p){require('params/_connectx.php'); $p=$db;} if(!$p)return;
$o='1';//db
reqp('backup'); reqp('transport');
list($usr,$db,$ps,$dr)=transport_srv(); $base=$p; //echo $ps;
//exc('mkdir /home/'.$dr.'/backup');
//$fa='/var/backups/'; $f=''.$p.date('ymd').'.dump';
$fa='/home/'.$dr.'/'; $f='_backup/'.$p.date('ymd').'.dump';
#tar dir
//$f='/_backup/'.$p.date('ymd').'.tgz'; $d='tar -zcf /home/nfo'.$f.' /var/lib/mysql/'.$p; $o='';
#dump
//$d='mysqldump --user='.$user.' --host='.$host.' --password='.$pasw.' '.$base.' > '.$fa;
//$ps='';
$d='mysqldump -u '.$usr.' -h localhost -p'.$ps.' --opt '.$base.' > '.$fa.$f; //ecko($d);
#restore
//$d='mysql -u root -p maBase < '.$fa;
#copy dir
//cp -r /répertoire_source /répertoire_destination
if(!is_file($f) && $p){exc($d);
	if($o)exc('gzip -r '.$fa.$f);}//gzip
$ret=lkt('',$f,$p);//substr(,10)
return $ret;}

?>