<?php //statsrv
class statsrv{

static function date($d){//11/Jun/2015:18:09:14
$ra=explode('/',$d); $rb=explode(':',$ra[2]); //p($rb);
$hours=mktime($rb[1]+1,$rb[2],$rb[3],1,1,1970);
$ret=strtotime($ra[0].' '.$ra[1].' '.$rb[0]);
//return mktime(1,0,0,1,1,1970);//zero
return $ret+$hours;}

static function build($p,$o){
$dr='/var/log/apache2'; 
//$f='error.log'; 
$f='access.log'; 
//$f='other_vhosts_access.log';   
//$r=explore($dr); p($r);
//echo $d=file_get_contents($dr.'/'.$f,FALSE,NULL,100,1000);
$d=file_get_contents($dr.'/'.$f,NULL,NULL,0,10000);
/*$d='w41k.com:80 66.249.67.73 - - [11/Jun/2015:18:09:14 +0200] "GET /34758 HTTP/1.1" 403 505 "-" "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)" [2] => w41k.com:80 85.170.69.142 - -';*/
$r=explode("\n",$d); //p($r);
foreach($r as $k=>$v){
	//$ra=explode('-',$v);
	$rb=explode(' ',$v); //p($rb);
	$ip=$rb[1]; $day=substr($rb[4],1); $pag=$rb[7];
	$day=self::date($day);
	$day=mkday($day,'ymdHis');
	$ret[]=[$ip,$day,$pag];
	//$ret[$ip][]=[$day,$pag];
}
pr($ret);//
//echo count($ret);
return $ret;}

static function call($p,$o,$prm=''){
$p=$prm[0]??$p;
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$ret.=input('inp',$p,'').' ';
$ret.=lj('',$rid.'_statsrv,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid='plg'.randid();
$bt=self::menu($p,$o,$rid); $ret=self::call($p,$o);
//$bt.=msqbt('',ses('qb').'_statsrv');
return $bt.divd($rid,$ret);}
}
?>