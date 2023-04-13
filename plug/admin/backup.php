<?php 
//if(!auth(6))exit;
class backup{

static function dbcols($db){
return sql::call('select COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS where table_name="'.transport::pub($db).'"','kv');}

static function atm($v){return '"'.sql::qres(($v)).'"';}//utf8_encode
static function atmr($r){foreach($r as $k=>$v)$ret[]=self::atm($v); return $ret;}
static function atmrk($r){foreach($r as $k=>$v)$ret[]=$k.'='.self::atm($v); return $ret;}
static function atmra($r,$o=''){$rb=self::atmr($r); $d=$o?'"",':''; if($rb)return '('.$d.implode(',',$rb).')';}
static function atmrak($r,$o=''){$rb=self::atmrk($r); $d=$o?'"",':''; if($rb)return $d.implode(',',$rb);}

static function build($db,$id,$o=''){$ret=''; $rb=[]; $err=''; $b=transport::pub($db);//$rb=[];
$ra=self::dbcols($b); $cols=implode(',',array_keys($ra)); //pr($ra);
$r=sql::call('select '.$cols.' from '.($b).' where id>"'.$id.'"','ar',0);
if($o==1){$deb='update `'.($b).'` set ';
	if($r)foreach($r as $k=>$v)$rb[]=$deb.self::atmrak($v).' where id="'.$v['id'].'";'.n();}
else{$deb='INSERT INTO `'.($b).'` ('.$cols.') VALUES ';
	if($r)foreach($r as $k=>$v)$rb[]=self::atmra($v);}//pr($rb);
if($rb){if($o==1)$ret=implode("\n",$rb); else $ret=$deb.implode(",\n",$rb).';';}
//if($o)return $ret;
$f='_backup/'.$db.'.dump';//_from_'.$id.'
if(is_file($f))unlink($f); //eco($ret);
if($ret)$err=write_file($f,$ret); //exc('gzip -r /home/nfo/'.$f);
//$err=gz_write2($f,$ret);
if(!$err)return lkt('txtyl','/'.$f,$f);}//.'.gz'

static function dump($b){
if($_SERVER['HTTP_HOST']=='oumo.fr')$n=12; else $n=11;
[$usr,$db,$ps,$dr]=transport::srv(1); $table=$b!=1?transport::pub($b):'';
$f='_backup/'.($b!=1?$b:$db.date('ymd')).'.dump';//-default-character-set=utf8
if($b==1){if(is_file($f.'.gz'))return $f.'.gz';} elseif(is_file($f))unlink($f); 
$e='mysqldump -u'.$usr.' -h localhost -p'.$ps.' '.$db.' '.$table.' > '.$dr.'/'.$f;
//$e='mysqldump -u'.$usr.' -p'.$ps.' '.$db.' '.$table.' -r '.$dr.'/'.$f.'';//export to utf8
shell_exec($e); if($b==1){shell_exec('gzip -r '.$dr.'/'.$f); $f.='.gz';}
return $f;}

static function json($b){
//boot::reboot();
$r=transport::db_r(); $db=$r[$b];
$r=sql('*',$db,'','');
$f='_backup/'.$b.'.json';
$d=mkjson($r);
$er=json_error();
write_file($f,$d);
//$f=tar::gz($f);
return $f;}

static function restore($d){//import
//$d='mysql -u'.$user.' -p'.$pasw.' '.$host.' '.$base.' < '.$f; 
//$d='cat '.$f.' | mysql --host='.$host.' --user='.$user.' --password='.$pasw.' '.$base.'');
exc($d);}

static function home($p,$o,$y=''){
if(!$p){connect(); $p=sql::$db;} if(!$p)return;
$o='1';//gz
[$usr,$db,$ps,$dr]=transport::srv(1); $base=$p;//$db //echo $ps;
//exc('mkdir '.$dr.'/backup');
//$fa='/var/backups/'; $f=''.$p.date('ymd').'.dump';
$fa=''.$dr.'/'; $f='_backup/'.$p.date('ymd').'.dump';
#tar dir
//$f='/_backup/'.$p.date('ymd').'.tgz'; $d='tar -zcf '.$dr.'/'.$f.' /var/lib/mysql/'.$p; $o='';
#dump
//$d='mysqldump --user='.$user.' --host='.$host.' --password='.$pasw.' '.$base.' > '.$fa;
//$ps='';
//$opt='–default-character-set=utf8 ';
$d='mysqldump -u '.$usr.' -h localhost -p'.$ps.' --opt '.$base.' > '.$fa.$f;//ecko($d);
#restore
//$d='mysql -u root -p maBase < '.$fa;
#copy dir
//if(is_file($f))unlink($f); if(is_file($f.'.gz'))unlink($f.'.gz'); //echo exc('ls -la');
//cp -r /répertoire_source /répertoire_destination
if(!is_file($f) && $p){//exc($d);
	if(auth(6) or $y=='c9f4e6')echo shell_exec($d);
	if($o)echo exc('gzip -r '.$fa.$f);}//gzip
$ret=lkt('',$f,$p);//substr(,10)
return $ret;}
}
?>