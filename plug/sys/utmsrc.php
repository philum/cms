<?php //model
#usage retrouve url depuis feedburner
#tag: tri

function utmsrc_utf($d){
$enc=between(strtolower($d),"charset=",'"');
if(strtolower($enc)=="utf-8")$d=utf8_decode_b($d);
return $d;}

//$f='http://dailygeekshow.com/2014/10/16/homme-femme-maquillage-transformation-celebrites/?utm_source=feedburner&utm_medium=feed&utm_campaign=Feed%3A+DailyGeekShow+%28Daily+Geek+Show%29';
function plug_utmsrc($f='',$o=''){
$d=get_file($f); $d=utmsrc_utf($d); //eco($d,1);
$u=between($d,'<meta property="og:url" content="','"');//echo $u;
return $u;}

?>