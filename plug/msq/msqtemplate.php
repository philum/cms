<?php //msqtemplate
class msqtemplate{

static function conform_order($r,$rb){
foreach($rb as $k=>$v){$ret[$k]=$r[$k];}
return $ret;}

static function build($nod,$tmp){
[$dr,$nod]=split_right('/',$nod,0); if(!$dr)$dr='users';
$r=msql::read_b($dr,$nod); $mnu=$r['_menus_']; unset($r['_menus_']);
//$rb=array_keys_r($r,0); asort($rb); $r=self::conform_order($r,$rb);
if($r)foreach($r as $k=>$v){$tpl=$tmp;
	if(is_array($v)){$n=count($v)-1;
	for($i=$n;$i>=0;$i--){
		if($v[$i])$tpl=str_replace(['_'.$i,'_'.$mnu[$i]],$v[$i],$tpl);
		else $tpl=str_replace(['_'.$i,'_'.$mnu[$i]],'',$tpl);}}
	else $tpl=str_replace(['_0','_'.$mnu],$v,$tpl);
	$tpl=str_replace('_key',$k,$tpl);
	$ret.=codeline::parse($tpl,'','codeline');}
return conn::parser($ret);}

static function read($nod,$p){
$r=msql::read_b('',$nod);
if(isset($r['_menus_'])){$mnu=$r['_menus_']; unset($r['_menus_']);}
if(substr($p,0,1)=='x')$p=substr($p,1); else $o='x';
$rb=array_keys_r($r,$p); if($o)arsort($rb); else asort($rb); $r=self::conform_order($r,$rb);
foreach($mnu as $k=>$v){$pb=ajx($o.$v,0);
	$tts[]=lj('','msqt_msqtemplate,read___'.ajx($nod,0).'_'.$o.$k,$v);}
foreach($r as $k=>$v){
	if($v)foreach($v as $ka=>$va){
		if($mnu[$ka]=='date')$va=date('d/m/Y',$va);
	$r[$k][$ka]=$va;}}
array_unshift($r,$tts);
return tabler($r,'txtred','txtx');}

static function home($nod,$tmp){
$ret=lj('txtbox','msqt_msqtemplate,home___'.ajx($nod).'_'.ajx($tmp),picto('ok')).br();
if($tmp){$tpl=msql::val('',nod('template'),$tmp);
	if(!$tpl)$tpl=msql::val('','public_template',$tmp);
	$ret.=self::build($nod,$tpl);}
elseif($nod)$ret.=self::read($nod,0);
return divd('msqt',stripslashes($ret));}
}
?>