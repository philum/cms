<?php
//philum_plugin_vacuum
ini_set('display_errors',1);
//error_reporting(6135);
/*if(is_file('../prog/lib.php'))require_once('../prog/lib.php');*/

function array_to_xml($r,&$xml){
foreach($r as $k=>$v){if(is_numeric($k))$k='item'.$k;
if(is_array($v)){$subnode=$xml->addChild($k); array_to_xml($v,$subnode);}
else{$xml->addChild($k,htmlspecialchars($v));}}}

function mkxml($r,$f){
$xml=new SimpleXMLElement('<?xml version="1.0"?><data></data>');
array_to_xml($r,$xml); //pr($xml);
return $xml;}//->asXML($f)

function vacuum_build($f,$o){
$f=ajx($f,1); if(!$f)return; $er='';
$f=str_replace('|','/',urldecode($f)); getb('urlsrc',http($f));
list($ti0,$tx0,$im)=web::metas($f);
list($ti,$tx,$html,$defid,$defs)=conv::vacuum($f,'');
//if($defs)foreach($defs as $k=>$v)$defs[$k]=htmlentities($v);
//$rb=['text-start','text-end','title-start','title-end','footer','utf8','post-treat','last-update','option-start','option-end']; $rb=array_combine($rb,$defs); $rb=json_encode($rb);
if(!$im){req('art'); $ims=play_conn($d,'.jpg'); $img=embed_detect($ims,'[',']');
$domain=strto($f,'/'); if($img)$im=http($domain.'/'.$img);}
$r=['title'=>$ti?$ti:$ti0,'image'=>$im];//,'defs'=>$rb
//$tx=hooks($tx);
if($o=='conn')$r['content']=$tx?$tx:$tx0;
else $r['content']=$html?$html:$tx0; //parse($tx); pr($r);
//$r=utf_r($r);
//$xml=mkxml($r,$f); //eco($r['content']);
$ret=mkjson($r);
$er=json_last_error();//echo $er;
if(!$er)return $ret;}

function vacuum_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=vacuum_build($p,$o);
return $ret;}

function vacuum_menu($p,$o,$rid){
$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_vacuum_vacuum*j___inp',picto('ok')).' ';
return $ret;}

function plug_vacuum($p,$o){$rid=randid('plg');
if(!$p)$bt=vacuum_menu($p,$o,$rid);
else return vacuum_build($p,$o);
return $bt.divd($rid,$ret);}

?>