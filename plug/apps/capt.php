<?php //capt

class capt{

/*static function url_check($url){$r=@get_headers($url);
return is_array($r)?preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$r[0]):false;}

static function clean($text){//remove everything
return html_entity_decode(trim(str_replace(';','-',preg_replace('/\s+/S'," ",strip_tags($text)))));}

static function dom($f){
//if(self::url_check($f)){}else $ret='URL not reachable!';
$d=file_get_contents($f);
$d=html_detect($d,'<div id="liste">');
$dom=new DomDocument;
$dom->validateOnParse=true;
$dom->loadHtml($d);
$r=$dom->getElementsByTagName('resultat'); pr($dom);
//$ret=self::clean($dom->getElementByClass('resultat')->textContent);
return $ret;}

static function preg($f){
$r=file_get_contents($f);
if(preg_match('%.*?<html[^>]*>.*?<head>.*?<title>.*?</title>.*?</head>.*?<body[^>]*>(.*?)</body>.*?</html>%si',$r,$m))$ret=$m[1]; else $ret='';
return $ret;}

static function simplexml($f){
$d=file_get_contents($f);
$d=html_detect($d,'<div id="liste">');
$r=simplexml_load_string($d); p($r);
foreach($r as $k=>$v){}
return $ret;}

static function xml($f){
//if(self::url_check($f)){}else $ret='URL not reachable!';
$d=file_get_contents($f);
$d=html_detect($d,'<div id="liste">');
$dom=new DomDocument;
$dom->loadXML($d);
foreach($r as $v){$ret.=$v->nodeValue;}
//$ret.=self::clean($doc->getElementByClass('resultat')->textContent);
//$ret.=childnode['href'];
return $ret;}*/

static function read($f){
$d=file_get_contents($f); //$d=utf8dec_b($d);
$d=html_detect($d,'<div id="liste">');
$http=http(domain($f));
$dom=new DomDocument;
$dom->validateOnParse=true;
libxml_use_internal_errors(true);
$dom->loadHtml($d);
//$r=$dom->getElementsByTagName('div')->class('resultat');
//pr($dom);
foreach($dom->getElementsByTagName('a') as $k=>$v){//p($v);
	if($v->getAttribute('class')=='txt-no-underline'){
		$u=$http.$v->getAttribute('href');
		$ra[]=$u;
		$rf[]=self::read2($u);}}//if($k<10)
foreach($dom->getElementsByTagName('span') as $k=>$v){
	if($v->getAttribute('class')=='lien')$rb[]=utf8dec_b(trim($v->nodeValue));}
foreach($dom->getElementsByTagName('div') as $k=>$v){
	if($v->getAttribute('class')=='resultat'){
		$vb=$v->getElementsByTagName('p')->item(1)->nodeValue;
		[$x,$nm,$adr,$ard]=explode("\n",$vb);
		$rc[]=trim($ard);}}
echo $n=count($ra);
for($i=0;$i<$n;$i++){
	$re=[$ra[$i],$rb[$i],$rc[$i]];
	if($rf[$i])$re+=$rf[$i];
	$rd[]=$re;}
//pr($rd);
return $rd;}

static function read2($f){
$d=file_get_contents($f); //$d=utf8dec_b($d);
$d=html_detect($d,'<div id="renseignement" class="Card frame table">');
//$http=http(domain($f));
$dom=new DomDocument;
$dom->validateOnParse=true;
libxml_use_internal_errors(true);
$dom->loadHtml($d);//pr($dom);
foreach($dom->getElementsByTagName('tr') as $k=>$v){//pr($v);
	$col=utf8dec_b(trim($v->childNodes[0]->nodeValue));
	$val=utf8dec_b(trim($v->childNodes[2]->nodeValue));
	if($col=='Statut' or $col=='Adresse (RCS)' or $col=='Code postal' or $col=='Ville' or $col=='Forme juridique' or $col=='Capital social' or $col=='Date création entreprise' or $col=='Chiffre d\'affaires')$rb[$col]=$val;}
$n=count($rb);
//pr($rb);
return $rb;}

static function build($p,$o){
//$r=msql::read_b('',nod('capt_1'));//p($r);
$f='https://www.societe.com/cgi-bin/liste?nom=&dirig=&pre=&ape='.$p.'&dep='.$o;//4637z//
$r=self::read($f);
msql::save('',nod('capt_'.$p.'-'.$o),$r,'');
$ret=msql::dump($r,'naf');
return $ret;}

static function call($p,$o,$prm){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$ret=input('inp1','4637z').' '.input('inp2','75').' ';
//4637z,4641z,4661z,4665z,4646z,4647z,4648z
$ret.=lj('',$rid.'_capt_call_inp1,inp2',picto('ok')).' ';
return $ret;}

//$f='https://www.societe.com/cgi-bin/liste?nom=&dirig=&pre=&ape=4637z&dep=75';
static function home($p,$o){$rid=randid('capt');
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::build($p,$o);
$bt.=msqbt('',nod('capt_1'));
return $bt.divd($rid,$ret);}

}
?>