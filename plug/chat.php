<?php
//philum_plugin_chat

function chatdata($p){;
return msql::read_b('',nod('chat_'.$p),'',1,['time','name','msg']);}

function chaterz($p,$erz){$nod=ses('qb').'_chat_'.$p;
msql::modif('',$nod,$erz,'del'); return chatread($p);}

function chatsav($p,$nm,$msg){req('pop,spe'); $nod=ses('qb').'_chat_'.$p; $ret=ajxg($msg);
if($ret)msql::modif('',$nod,[time(),$nm,embed_links($ret)],'push');
return chatread($p);}

function chatnm($p,$nm,$res){
$j='popup_plup__x_chat__'.$p.'_'.substr($res,0,-1).'_nam'.$p;
$d=autoclic('" id="nam'.$p,'name',8,'20','search');
return $d.lj('popbt',$j,picto('kright'));}

function chatread($p){$nm=ses('muse'); $c='txtsmall'; $r=chatdata($p); $ret='';
if($r){$r=array_reverse_b($r,50); $ret='';
foreach($r as $k=>$v){$erz=''; $msg=$v[2];
	if($nm==$v[1] or auth(6))$erz=lj($c,'cht'.$p.'_chat___chaterz_'.$p.'_'.$k,'(x)');
	$bt=btn('popbt',$v[1]).' '.btn($c.'2',mkday($v[0],'ymd:Hi')).$erz;
	if(!function_exists('correct_txt'))req('pop,spe');
	//$msg=codeline::parse($msg,'','sconn2');
	$msg=conn::read($msg,'','');
	$ret.=divc('track',$bt.$msg);}}
return scroll($r,$ret,7);}

function chatform($p,$msg){$nm=ses('muse');
$d=lj('popbt','cht'.$p.'_chat___chatread_'.$p,picto('reload'),att('#'.$p));
$d.=autoclic('" id="msg'.$p,'message',18,'1000','search');
if($nm)$j='cht'.$p.'_plug___chat_chatsav_'.$p.'_'.$nm.'_msg'.$p;
else $j='popup_plup__x_chat_chatnm_'.$p.'__msg'.$p;
$d.=ljb('popbt',sj($j),'',picto('kright'));
return '<form name="chat'.$p.'" action="javascript:'.sj($j).'">'.$d.'</form>';
return $ret;}

function plug_chat($p,$msg,$res=''){
$p=$p?normalize($p):'public'; ses('muse',$res?ajxg($res):ses('USE'));
return chatform($p,$msg).divd('cht'.$p,chatread($p));}

?>