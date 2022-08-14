<?php
class export_bases{

static function export($su,$sn,$pw,$db,$file){
exc('mysqldump -h"'.$su.'" -u"'.$sn.'" -p"'.$pw.'" '.$db.' '.$file.' > '.$file.'.sql');
return '<a href="'.$file.'.sql">'.$file.': saved => right-clic</a><br>';}

static function import(){
//exc('mysqldump -h"'.$su.'" -u"'.$sn.'" -p"'.$pw.'" '.$db.' '.$file.' < '.$file.'.sql');
}

static function home(){
$ret='<a href="?export=_art">_art</a> ';
$ret.='<a href="?export=_txtt">_txt</a> ';
$ret.='<a href="?export=_user">_user</a> ';
$ret.='<a href="?export=_eye">_eye</a> ';
$ret.='<a href="?export=_idy">_idy</a>';
$ret.='<br><br>';
//export
if($_GET['export']!="" && auth(5)){
$file='pub_'.$_GET['export'];
//$ret.=self::export($host,$user,$pass,$db,$file);}
return $ret;}

}
?>