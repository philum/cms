<?php
//philum_plugin_umdico

function udc_source(){//AADOAUGOO
$r=msql_read('users','ummo_umvoc_1','');
$sql='where nod="ummo" and substring(frm,1,1)!="_" and frm!="études" and frm!="Idéogrammes"  and frm!="AiooyaaOaxiiboo" and re>0 and msg like ';
if($r)foreach($r as $k=>$v){if($k!='_menus_')
	$rb=sql_inner('frm','qdm','qda','id','k',$sql.'"% '.$v[0].' %"','');
	if($rb){$rb=array_keys($rb); $v[3]=count($rb)?implode(', ',$rb):''; $rc[$k]=$v;}}
$r=msql_modif('','ummo_umvoc_1',$rc,'','arr','');}

function udc_imz($f,$n='2'){
list($w,$hb)=fwidth($f);
$w=round($w/$n);$h=round($h/$n);
return divs('width:'.$w.'px;',image('/'.$f,$w,$h));;}

function udc_build($p){
if($p=='1' && auth(6))$r=udc_source();
$r=msql_read('users','ummo_umvoc_1','',1);
if($r)foreach($r as $k=>$v)$ra[$v[0]]=$v; ksort($ra);
if($ra)foreach($ra as $k=>$v){
	//if(strpos($v[3],'Eyaoloowa')!==false){}
	//$rb[$k][]=divc('title',$k);
	$rb[$k][]=lj('','popup_plup___umvoc_ud*glossary_'.ajx($k),$k).' ';
	$f='users/ummo/glyphes/'.strtoupper($k).'.png';
	$rb[$k][]=is_file($f)?udc_imz($f,6):'';
	//$rb[$k][]=is_file($f)?image('/'.$f,'',''):'';
	$rb[$k][]=stripslashes($v[1]);
	$rb[$k][]=lj('','popup_search___'.ajx($k),picto('search',16));
	$rb[$k][]=$v[3];}
return make_table($rb);}

function plug_umdico($p,$o){
ses('qdvoc',qd('umvoc'));
ses('qdvoc_b',qd('umvoc_arts'));
$ret=udc_build($p);
$ret.=msqlink('','ummo_umvoc_1','').' ';
$ret.=lkt('','/plug/umvoc',picto('link'));
return $ret;}

?>