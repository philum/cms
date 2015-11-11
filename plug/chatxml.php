<?php
//philum_plugin_chatxml

function chtses($p,$v){$d='chtxlst'.$p;
if($v=='a')return $_SESSION[$d]; else $_SESSION[$d]=$v;}

function chatxcanal($p){
$ar=read_file(philum().'/plug/microsql.php?canalchat=='); $r=explode(';',$ar);
$ret=btn('txtcadr',nms(102)).br(); $j='popup_plup__x_chatxml__';
if($r)foreach($r as $k=>$v){$ret.=lj($v==$p?'active':'',$j.$v,$v).br();}
return divc('nbp',$ret);}

function chatxsav($p,$nm,$res){$msg=ajxg($res); if(is_numeric($nm))chtses($p,'0');
$msg=str_replace(array(' ',"\n","&"),array(':space:',':line:','(and)'),$msg);
$f=philum().'/plug/microsql.php?chat='.$p.'&name='.$nm.'&msg='.ajx($msg).'&suj='.$nm.'&host='.$_SERVER['HTTP_HOST'].'/'.ses('qb').'&admail='.$_SESSION['qbin']['adminmail'];
if($msg or is_numeric($nm))read_file($f); return chatxcall($p);}

function chatxinvite($p,$to=''){
$ret=input(1,'chtxvt',$to?$to:'mail','search').' ';
$ret.=lj('','chtxinvt_plug___chatxml_chatxinvit_'.$p.'__chtxvt',picto('kright'));
return popup(nms(109),divd('chtxinvt',$ret));}

function chatxinvitx($p,$w){list($w,$nm)=split('/',$w);
$to=read_file('http://'.$w.'/plug/microsql.php?kmail='.$nm);
return chatxinvite($p,$to);}

function chatxinvit($p,$nm,$to){$nm=ses('muse'); $to=ajxg($to);
$msg=str_replace('_NAME',$nm,helps('chatcall')); $url=host().'/module/chatxml/'.$p;
if($to){send_mail_txt($to,$msg,$url,$nm,''); return nms(109).' '.nms(79).'e';}
else return nms(114);}

function chatxnm($p,$nm,$res){
$j='popup_plup__x_chatxml__'.$p.'_'.substr($res,0,-1).'_namx'.$p;
$d=autoclic('" id="namx'.$p,'name',8,'20','search');
return $d.lj('popbt',$j,picto('kright'));}

function chatxcall($p){//chtses($p,'0');
if(!function_exists('miniconn'))req('tri,pop,spe');
list($r,$r1)=chatxdata($p); return chatxread($p,$r);}

function chatxform($p){$nm=ses('muse');
$d.=lj('txtcadr','popup_plup__x_chatxml__'.$p,pictxt('reload',$p)).' ';
$d.=lj('','chtx'.$p.'_plug__13_chatxml_chatxcall_'.$p,picto('loading')).' ';
$d.=loadjs('chatx',$p,'live').' '.hlpbt('chatxml').' ';
$d.=lj('','popup_plup__x_chatxml_chatxcanal_'.$p,picto('rss')).' ';
$d.=lj('','popup_plug___chatxml_chatxinvite_'.$p,picto('mail')).' ';
//$d.=lj('','chtx'.$p.'_plug___chatxml_chatxsav_'.$p.'_2',picto('del')).' ';
if(auth(6))$d.=msqlink('clients','chat_'.$p).' '; $d.=hlpbt('miniconn').br();
if($nm)$j='SaveBbc(\''.$p.'\',\''.$nm.'\')';
else $j=sj('popup_plup__x_chatxml_chatxnm_'.$p.'__msgx'.$p);
$sty='min-height:16px; border:1px solid #777; max-width:328px; max-height:200px; overflow-y:auto;';
$d.=divedit('msgx'.$p,'track',$sty,'','');
$d.=ljb('',$j,'',divc('popsav" style="width:332px;',nms(28)));
return $d;}

function chatxdata($p){$lst=chtses($p,'a'); 
//echo philum().'plug/microxml.php?table=/msql/clients/chat_'.$p.'&last='.$lst;
require('plug/microxml.php'); $r=clkt(philum().'/msql/clients/chat_'.$p,$lst);
if($r){unset($r['_menus_']); $r1=$r[1]; unset($r[1]); 
	$r=array_reverse_b($r,20); if($r)chtses($p,key($r));}
return array($r,$r1);}

function chathead($p,$r1){
if(!function_exists('miniconn'))req('tri,pop,spe');
$sty='class="bkg" style="border-color:white; padding:4px;"';
if(strchr_b($r1[3],'/')==ses('USE'))
	$erz=lj('txtsmall','chtx'.$p.'_plug___chatxml_chatxsav_'.$p.'_1','(x)'); $msg=$r1[2];
$msg=correct_txt($msg,'','sconn'); $msg=miniconn($msg); 
return div($sty,$erz.nl2br(stripslashes($msg)));}

function chatxread($p,$r){$c='txtsmall'; $nm=ses('muse'); $use=ses('USE');
if($r)foreach($r as $k=>$v){$erz=''; $ml=''; $msg=$v[2];
if($use && ($v[1]==$nm or $p==$use))
	$erz=lj($c,'chtx'.$p.'_plug___chatxml_chatxsav_'.$p.'_'.$k,picto('sclose'));
if(strchr_b($v[3],'/')==$use)
	$ml=lj('popbt','popup_plug___chatxml_chatxinvitx_'.$p.'_'.ajx($v[3]),'@').'';
$bt=lkt('popbt','http://'.$v[3],$v[1]).' '.btn($c.'2',mkday($v[0],'ymd:hi'));
$msg=correct_txt(html_entity_decode($msg),'','sconn'); $msg=miniconn($msg,strdeb($v[3],'/')); 
$ret.=divc('track',$ml.$bt.$erz.br().nl2br(stripslashes($msg)));}
return $ret;}

function plug_chatxml($p,$msg='',$res=''){if(!$p)return chatxcanal('public');
$p=normalize($p); ses('muse',$res?ajxg($res):ses('USE')); chtses($p,'0');
list($r,$r1)=chatxdata($p); $form=chatxform($p); $head=chathead($p,$r1);
$sty='id="chtx'.$p.'" style="width:344px;"';
return $head.$form.scroll_b($r,div($sty,chatxread($p,$r)),5,344);}

?>