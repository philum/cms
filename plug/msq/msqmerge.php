<?php //msqmerge
//conjoint à msqarts, qui fabrique des tables par catégories

function msqm_msg($d){
$d=str_replace('&nbsp;',' ',$d);
$r=explode(' ',$d);
foreach($r as $k=>$v){if(substr($v,0,1)!='@')$ret.=$v;
	if(substr($v,-1)!="\n")$ret.=' ';}
return $ret;}

function msqmerge($r,$d){$d=strend($d,'_');
if($r)foreach($r as $k=>$v){$dy=substr($v[1],0,6); 
$msg=$v[2]; 
$msg=delconn($msg);
$msg=msqm_msg($msg); //echo 'eee';
//$msg=miniconn($msg);
//$msg=embed_links($msg);
//$msg=conn::read($msg,'','');
$msg=codeline::parse($msg,'','sconn');
$msg=nl2br($msg);
$ret[$v[0]]=array($d,lka($v[0],$dy),$msg,lka($v[3],picto('tw')));}
return $ret;}

function msqmerge_build($p,$o){
$r=explode(',',$p); $ra=array();
if($r && $p)foreach($r as $k=>$v){//echo $v;
$r=msql_read('',$v);//pr($r);
if($r)$ra+=msqmerge($r,$v);}
ksort($ra);
return tabler($ra);}

function msqmerge_j($p,$o,$res=''){
[$p,$o]=ajxp($res,$p,$o);
$ret=msqmerge_build($p,$o);
return $ret;}

function msqmerge_default(){return 'ummo_arts_Oaxiiboo6,ummo_arts_OolgaWaam,ummo_arts_OomoToa,ummo_arts_OyagaaAyooYissaa';}

function msqmerge_menu($p,$o,$rid){
$p=$p?$p:msqmerge_default();
$ret=input1('inp',$p,'').' ';
$ret.=lj('',$rid.'_plug__2_msqmerge_msqmerge*j___inp',picto('ok')).' ';
return $ret;}

function plug_msqmerge($p,$o){$rid='plg'.randid(); 
$bt=msqmerge_menu($p,$o,$rid); $ret=msqmerge_j($p,$o);
return $bt.divd($rid,$ret);}

?>