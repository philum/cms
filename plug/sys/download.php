<?php //download
class download{
static $conn=1;

static function download_gzip($f){
header('Content-Type: application/x-bzip');
header('Content-Disposition: attachment; filename='.$f);
echo bzcompress($f);}

static function file($f,$nmf){
header('Content-type: application/octet-stream' );
header('Content-Disposition: attachment; filename='.$nmf);
flush();//Envoie le buffer
readfile($f);}

static function eye($f){
$nod=$_SESSION['qb'].'_downloads';
$dy=date('ymdhi',time()); $r=[$f,hostname()]; 
if($_SESSION['qb'])msql::modif('',$nod,$r,'row',['file','ip'],$dy);}

static function rednm($d){
if(strrpos($d,'/')!==false)$d=substr($d,strrpos($d,'/')+1);
//if(strrpos($d,'.')!==false)$d=substr($d,0,strpos($d,'.'));
return normalize($d);}

static function home($p,$o){
$dir='_datas/dl/'; $f=base64_decode($p);
if($f!='../' && strpos($f,'params')===false && is_file($f)){
	//nb_of_dwnl
	$nm=self::rednm($f); $nmf=$nm.'.txt';
	if(is_file($dir.$nmf))$nb=read_file($dir.$nmf);
	write_file($dir.$nmf,$nb=$nb?$nb+1:1);
	self::eye($f);
	self::file($f,$nm);}}
}
?>