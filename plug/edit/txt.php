<?php
//philum_plugin_txt

function txt_log(){return $_SESSION['auth']>6?$_SESSION['qb']:$_SESSION['USE'];}

function txt_j($n,$b,$res){$nd=txt_log(); $rb=ajxr($res);
$rb[1]=html_entity_decode_b($rb[1]);
if(!$n)$n=msq_find_last('users',$nd,'txt');
msql_modif('users',$nd.'_txt_'.$n,$rb,'','one',1);
return btn('txtyl','ok');}

function txt_del($d){$nd=txt_log();
if($d)unlink('msql/users/'.$nd.'_txt_'.$d.'.php');
return btn('txtyl','deleted');}

function st_paste($d){$ret=hidden('','cka','m'.$d);
$ret.=ljb('" title="copy" id="cka1','mem_storage','_m1___cka0',picto('copy')).' ';
$ret.=ljb('" title="paste" id="ckb1','mem_storage','_m1_1__ckb0',picto('paste'));
return btn('nbp',$ret).' ';}

function stx_files($nd,$tx){$r=msq_choose('',$nd,'txt'); if($r)asort($r);
$ret=lj('txtbox','pop_plup___txt_stx*files_'.$nd.'_'.$tx,picto('reload')).br();
if($r)foreach($r as $k=>$i){$rb=msql_read('',$nd.'_txt_'.$i,'1');
	if($rb)$ret.=$i.': '.ljb($cs,'notepad_open',$nd.'_txt_'.$i.'_'.$tx,$rb[0]).br();}
return divc('nbp',$ret);}

function stx_btn($d,$nd,$tx){//version,node,
$r=msq_choose('',$nd,'txt'); $nxt=msq_find_next($r); $tt='txtbox" title="';
if($d){$ret.=btd('bck','').' '; $tar='tit|txtarea';
	$ret.=btd('bts',lj('popbt','bck_plug__xd_txt_txt*j_'.$d.'__'.$tar,nms(27))).' ';
	$ret.=ljb('txtx','notepad_open',$nd.'_txt_'.$d.'_'.$tx,$d).' ';//reload
	$ret.=lj($tt.nms(43),'bck_plug__xd_txt_txt*del_'.$d.'_'.$tx,picto('del'));
	$ret.=lj($tt.nms(42),'plgtxt_plug___txt_plug*txt__'.$tx,picto('close'));}
if($nd){
	$ret.=lj($tt.nms(44),'plgtxt_plug___txt_plug*txt_'.$nxt.'_'.$tx,picto('add'));
	$ret.=lj($tt.nms(25),'popup_plup___txt_stx*files_'.$nd.'_'.$tx,picto('get'));}
if($d)$ret.=msqlink('',$nd.'_txt_'.$d);
return $ret;}

function plug_txt($d,$tx){$nd=txt_log();
if($d)$ra=msql_read('',$nd.'_txt_'.$d,''); $msg=stripslashes($ra[1][1]);
$msg=html_entity_decode_b($msg);
if($d && !$ra && $nd)msql_modif('users',$nd.'_txt_'.$d,array('title',''),'','one',1);
$ret.=st_paste($d).' ';
if($d)$ret.=input('text','tit',stripslashes($ra[1][0])).' ';
$ret.=stx_btn($d,$nd,$tx).br();
if(!$tx)$ret.=txarea('txtarea',$msg,44,4,ats('width:100vw; height:90vh; font-size:large; padding:16px;'));
return btd('plgtxt',$ret);}

?>