<?php //feed

class feed{

static function array_to_xml($r,&$x){
foreach($r as $k=>$v){if(is_numeric($k))$k='item'.$k;
if(is_array($v)){$sub=$x->addChild($k); self::array_to_xml($v,$sub);}
else $x->addChild($k,htmlspecialchars(utf8enc($v)));}}

static function xml_to_array($d){
$x=simplexml_load_string($d,'SimpleXMLElement',LIBXML_NOCDATA);
return json_decode(json_encode($x),TRUE);}

static function build($p,$o){
if(!$p)$p=147000;
$r=sql('*','qda','ar','id>'.$p.'');
require('plug/tiers/simple_html_dom.php');
$x=new SimpleXMLElement('<?xml version="1.0"?><data></data>');
$f='users/'.ses('qb').'/export'.$p.'.xml';
self::array_to_xml($r,$x);
$res=$x->asXML($f);
return $f;}

static function import($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$d=get_file($p);
$r=self::xml_to_array($d);
//sqlsav('qda',$r);
return tabler($r);}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$f=self::build($p,$o);
$res=lk($f);
return $res;}

static function menu($p,$o,$rid){$res=input('inp',$p).' ';
$res.=lj('',$rid.'_feed,call_inp',picto('upload')).' ';
$res.=lj('',$rid.'_feed,import_inp',picto('download')).' ';
return $res;}

static function home($p,$o){$rid=randid('feed');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}

}
?>