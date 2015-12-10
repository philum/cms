<?php
//philum_plugin_backup
session_start();
error_reporting(6135);
ini_set('display_errors','1');
if(!auth(6))exit;

function backup_restore($d){//import
$d='mysql -u'.$user.' -p'.$pasw.' '.$host.' '.$base.' < '.$f; 
//$d='cat '.$f.' | mysql --host='.$host.' --user='.$user.' --password='.$pasw.' '.$base.'');
exc($d);}

function plug_backup($p,$o){
$p=$p?$p:''; $o='1';//philumnet//philuminfo
$user='root'; $host='localhost'; $pasw=base64_decode('bGdyM3Zkdng='); $base=$p;
//exc('mkdir /home/w41k/backup');
$f='/var/backups/'.$p.date('ymd').'.sql';
$d='mysqldump -u'.$user.' -h'.$host.' -p'.$pasw.' '.$base.' > '.$f;
//$d='mysqldump --user='.$user.' --host='.$host.' --password='.$pasw.' '.$base.' > '.$f;
//$d='mysqldump -u '.$user.' -p '.$pasw.' -h '.$host.' --opt '.$base.' > '.$f;
if(!is_file($f))exc($d);
if(is_file($f))if($o)exc('gzip -r '.$f);//gzip
$ret=lkc('',$f.'.gz',$p);//substr(,10)
return $ret;}

?>