<?php
//philum_plugin_oldconn

function oldconn_build($p,$o){
$repl=msql::val('system','connectors_old',$p,0);
if($o=='ynd'){$r=sql('id,txt','ynd','kv','txt like "%'.$p.']%"',1); $n=count($r);}
else{$r=sql('id,msg','qdm','kv','msg like "%'.$p.']%"',1); $n=count($r);}
if($r)foreach($r as $k=>$v){
	//qr('UPDATE '.qd('msg').' SET msg=REPLACE(msg,"'.$p.'","'.$repl.'") WHERE id='.$v.' limit 1',1);
	$msg=str_replace($p.']',$repl.']',$v);
	if($o=='ynd')update('ynd','txt',$msg,'id',$k);
	else update('qdm','msg',$msg,'id',$k);}//pr(array_keys($r));
return $p.'=>'.$repl.' in '.$n.' docs';}

function oldconn_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); $ret='';
if($p)return oldconn_build($p,$o);
$r=msql::read_b('system','connectors_old','',1);
if($r)foreach($r as $k=>$v){
	$n=sql('count(id)','qdm','v','msg like "%'.$k.']%"');
	if(!$n)$ret.=$k.': all is clean in msg';
	else $ret.=lj('txtbox',$o.'b_plug__3_oldconn_oldconn*build_'.$k.'_','replace '.$k.' by '.$v[0].' in '.$n.' docs');
	$ret.=br();
	$n=sql('count(id)','ynd','v','txt like "%'.$k.']%"');
	if(!$n)$ret.=$k.': all is clean in yandex';
	else $ret.=lj('txtbox',$o.'b_plug__3_oldconn_oldconn*build_'.$k.'_ynd','replace '.$k.' by '.$v[0].' in '.$n.' yandex');
	$ret.=br();}
return $ret.divd($o.'b','');}

function oldconn_r(){
$r=msql_read('system','connectors_old','',1);
if($r)foreach($r as $k=>$v)$rb[$k]=$k;
return $rb;}

function oldconn_menu($p,$o,$rid){
$ret=select_j('inp','pfunc','','oldconn/oldconn_r','','2');
//$ret=togbub('plug','oldconn_oldconn*r',btn('popbt','select...'));
$j=$rid.'_plug__3_oldconn_oldconn*j_';
$ret.=inputj('inp',$p,$j.'__inp');
$ret.=lj('',$j.'__inp',picto('ok'));
$ret.=lj('',$j.'_ynd_inp',picto('ok'));
$ret.=lj('popsav',$j,'all');
return $ret;}

function plug_oldconn($p,$o){$rid=randid('plg');
$bt=oldconn_menu($p,$o,$rid); $ret='';
if($p)$ret=oldconn_build($p,$o);
$bt.=msqbt('system','connectors_old');
return $bt.divd($rid,$ret);}

?>