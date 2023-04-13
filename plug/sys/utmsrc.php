<?php 
#retrouve url depuis feedburner
class model{

static function utmsrc_utf($d){
$enc=between(strtolower($d),"charset=",'"');
if(strtolower($enc)=="utf-8")$d=utf8dec_b($d);
return $d;}

//$f='http://dailygeekshow.com/2014/10/16/homme-femme-maquillage-transformation-celebrites/?utm_source=feedburner&utm_medium=feed&utm_campaign=Feed%3A+DailyGeekShow+%28Daily+Geek+Show%29';
static function home($f='',$o=''){
$d=get_file($f); $d=self::utmsrc_utf($d); //eco($d,1);
$u=between($d,'<meta property="og:url" content="','"');//echo $u;
return $u;}
}
?>