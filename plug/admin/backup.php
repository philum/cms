<?php
//philum_plugin_backup
if(!auth(6))exit;

function backup_restore($d){//import
$d='mysql -u'.$user.' -p'.$pasw.' '.$host.' '.$base.' < '.$f; 
//$d='cat '.$f.' | mysql --host='.$host.' --user='.$user.' --password='.$pasw.' '.$base.'');
exc($d);}

function plug_backup($p,$o){
$p=$p?$p:''; $o='1';//philumnet//philuminfo
$user='root'; $host='localhost'; $pasw=base64_decode('bGdyM3Zkdng='); $base=$p;
//exc('mkdir /home/w41k/backup');
//$f='/var/backups/'.$p.date('ymd').'.sql';
$f='/_backup/'.$p.date('ymd').'.sql'; $fa='/home/nfo'.$f;
#dump
$d='mysqldump -u'.$user.' -h'.$host.' -p'.$pasw.' '.$base.' > '.$fa;
#tar dir
//$f='/_backup/'.$p.date('ymd').'.tgz'; $d='tar -zcf /home/nfo'.$f.' /var/lib/mysql/'.$p; $o='';
#dump
//$d='mysqldump --user='.$user.' --host='.$host.' --password='.$pasw.' '.$base.' > '.$fa;
#restore
//$d='mysql -u root -p maBase < '.$fa;
#copy dir
//cp -r /répertoire_source /répertoire_destination
if(!is_file($f) && $d){exc($d);
	if($o)exc('gzip -r '.$fa);}//gzip
$ret=lkc('',$f.'.gz',$p);//substr(,10)
return $ret;}

?>