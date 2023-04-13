<?php //vacuum
class vacuum{

static function array_to_xml($r,&$xml){
foreach($r as $k=>$v){if(is_numeric($k))$k='item'.$k;
if(is_array($v)){$subnode=$xml->addChild($k); self::array_to_xml($v,$subnode);}
else{$xml->addChild($k,htmlspecialchars($v));}}}

static function mkxml($r,$f){
$xml=new SimpleXMLElement('<?xml version="1.0"?><data></data>');
self::array_to_xml($r,$xml); //pr($xml);
return $xml;}//->asXML($f)

static function build($f,$o){
$f=ajx($f,1); if(!$f)return; $er='';
$f=str_replace('|','/',urldecode($f)); ses::$urlsrc=http($f);
[$ti0,$tx0,$im]=web::metas($f);
[$ti,$tx,$html,$defid,$defs]=conv::vacuum($f,'');
//if($defs)foreach($defs as $k=>$v)$defs[$k]=htmlentities($v);
//$rb=['text-start','text-end','title-start','title-end','footer','utf8','post-treat','last-update','option-start','option-end']; $rb=array_combine($rb,$defs); $rb=json_encode($rb);
if(!$im){$ims=art::play_conn($d,'.jpg'); $img=between($ims,'[',']');
$domain=strto($f,'/'); if($img)$im=http($domain.'/'.$img);}
$r=['title'=>$ti?$ti:$ti0,'image'=>$im];//,'defs'=>$rb
//$tx=hooks($tx);
if($o=='conn')$r['content']=$tx?$tx:$tx0;
else $r['content']=$html?$html:$tx0; //parse($tx); pr($r);
//$r=utf_r($r);
//$xml=self::mkxml($r,$f); //eco($r['content']);
$ret=mkjson($r);
$er=json_last_error();//echo $er;
if(!$er)return $ret;}

static function call($p,$o,$prm=[]){$p=$prm[0]??$p;
return self::build($p,$o);}

static function menu($p,$o,$rid){
$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_vacuum,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('plg');
if(!$p)$bt=self::menu($p,$o,$rid);
else return self::build($p,$o);
return $bt.divd($rid,'');}

}
?>