<?php
//philum_plugin_chat

function chatdata($p){$dr=root().'msql/users/'; $dfb['_menus_']=array('time','name','msg');
$r=plug_motor($dr,ses('qb').'_chat_'.$p,$dfb); if($r)unset($r['_menus_']); return $r;}

function chaterz($p,$erz){$nod=ses('qb').'_chat_'.$p;
modif_vars('users',$nod,$erz,'del'); return chatread($p);}

function chatsav($p,$nm,$msg){$nod=ses('qb').'_chat_'.$p; $ret=ajxg($msg);
if($ret)modif_vars('users',$nod,array(time(),$nm,$ret),'push');
return chatread($p);}

function chatnm($p,$nm,$res){
$j='popup_plup__x_chat__'.$p.'_'.substr($res,0,-1).'_nam'.$p;
$d=autoclic('" id="nam'.$p,'name',8,'20','search');
return $d.lj('popbt',$j,picto('kright'));}

function chatread($p){$nm=ses('muse'); $c='txtsmall'; $r=chatdata($p);
if($r){$r=array_reverse_b($r,50);
foreach($r as $k=>$v){$erz=''; $msg=$v[2];
	if($nm==$v[1] or auth(6))$erz=lj($c,'cht'.$p.'_chat___chaterz_'.$p.'_'.$k,'(x)');
	$bt=btn('popbt',$v[1]).' '.btn($c.'2',mkday($v[0],'dhi')).$erz.br();
	if(!function_exists('miniconn'))req('tri,pop,spe'); $msg=miniconn($msg); 
	$ret.=divc('track',$bt.$msg);}}
return scroll($r,$ret,7);}

function chatform($p,$msg){$nm=ses('muse');
$d.=ljb('popbt" title="#'.$p,'SaveD','cht'.$p.'_chat_chatread_'.$p,picto('reload'));
$d.=autoclic('" id="msg'.$p,'message',18,'1000','search');
if($nm)$j='cht'.$p.'_plug___chat_chatsav_'.$p.'_'.$nm.'_msg'.$p;
else $j='popup_plup__x_chat_chatnm_'.$p.'__msg'.$p;
//$jb=' getbyid(\'msg'.$p.'\').value=\'\';';
$d.=ljb('popbt',sj($j).$jb,'',picto('kright'));
return '<form name="chat'.$p.'" action="javascript:'.sj($j).$jb.'">'.$d.'</form>';
//$ret=temporize("chatimer","SaveD('cht".$p.'_chat_chatread_'.$p."');",($mx?$mx:5*1000));
return $ret;}

function plug_chat($p,$msg,$res=''){//$_SESSION['muse']='';
$p=$p?normalize($p):'public'; ses('muse',$res?ajxg($res):ses('USE'));
return chatform($p,$msg).divd('cht'.$p,chatread($p));}

?>