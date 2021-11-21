<?php
//philum_plugin_mailist 

/*$voc=array('register'=>':: Incription à la liste de diffusion',
'see_newsletter'=>':: Newsletter actuelle',
'answer_success'=>'email envoyé',
'answer_exists'=>'mail already exists',
'answer_not_exists'=>'mail no exists',
'answer_error'=>'please fill form',
'form_name'=>'name',
'form_mail'=>'email',
'form_button'=>'ok',
'welcome_mail'=>'Merci pour votre inscription',
'unregister'=>':: Désabonnement',
'unregister_success'=>'Votre email a été effacé',
'adios_mail'=>'clic this link to confirm unsubscribe');*/

function ml_ra(){$defsb['_menus_']=['name','re','date','ip','id'];
return msql::read_b('',nod('mails'),'','',$defsb);}
function ml_rb(){return msql::read('',nod('mails'),'');}
function ml_rm($r,$d){msql::modif('',nod('mails'),$r,$d);}
function ml_rs($r){msql::save('',nod('mails'),$r);}
function mailvoc(){return msql_read('lang','helps_newsletter','');}

/*function mailist_upgrade($p){//patch
$r=msql_read('',$_SESSION['qb'].'_mails','');
if($r)foreach($r as $k=>$v){if(substr($v[0],0,1)=='_' && !$v[4])$upg=1;}
if($p==1 && $upg)return lj('txtx','popup_plupin__3_maillist_upgrade','upgrade');
elseif($upg){foreach($r as $k=>$v){
	if(substr($v[0],0,1)=='_'){$v[0]=substr($v[0],1); $re=0;}
	elseif($k=='_menus_')$re='re'; else $re=1; 
	$rb[$k]=array($v[0],$re,$v[1],$v[2],$v[3]);}
	ml_rs($rb);
	return 'updated';}}*/

function mailist_confirm($voc,$vrf){$r=ml_rb();
if($r)foreach($r as $k=>$v){if($v[0]==$vrf)$r[$k][2]=0;} ml_rs($r);
return divc('txtalert',$voc['welcome_mail']).' ';}

function mailist_save($a,$b,$res){
$r=ml_rb(); list($m,$n,$p)=ajxr($res); $voc=sesmk('mailvoc'); $n=strto($m,'@');
if(strpos($m,'@')!==false && strpos($m,'.')!==false && strpos($m,'?')===false){$m=trim($m);
	if(!$r[$m]){$p=0; $msg=$voc['welcome_mail'].br().$voc['adios_mail']; $dt=time();
	$sent=mails::send_html($m,'newsletter',$msg,'','?plug=mailist&p=confirm&o='.$dt);
		if($sent=='not_sent')return divc('txtyl',$m.' :: '.$voc['answer_success']);
		else{$r[$m]=array($n,$p,$dt,$ip,$_SESSION['iq']); ml_rs($r);
			return divc('txtyl',$m.' :: '.$voc['answer_success']);}}
	else return duvc('txtyl',$voc['answer_exists']);}
else return divc('txtyl',$voc['answer_error']);}

function mailist_form(){$voc=sesmk('mailvoc');
$ret=btn('txtcadr',$voc['register']).' ';
$ret.=input1('umail',$voc['form_mail'],22,'',1).' ';
//$ret.=input1('uname',$voc['form_name'],'10','',1).' ';
//$ret.=checkbox_j(1,'uopt','1','').' ';//|uopt
$ret.=lj('txtbox','cbk_mailist___mailist*save_1_2_umail','ok').' ';
return $ret;}

function mailist_unsc($p){$r=ml_rb(); $voc=sesmk('mailvoc');
$rk=array_keys_r($r,0); $k=in_array_b($p,$rk);
if($r[$k][2]==$_GET['confirm']){$r[$k][2]=0; ml_rs($r);
return divc('txtalert',$voc['unregister_success']).br();}}

function mailist_unsb($a,$b,$res){$r=ml_ra(); $p=ajxg($res);
$rk=array_keys_r($r,0); $k=in_array_b($p,$rk);
if($k){$voc=sesmk('mailvoc');
$msg=divc('txtblc',$voc['unregister']).br();
$lnk='?plug=mailist&p=unsubscribe&o='.$p.'&confirm='.$r[$k][2];
$tx=$msg.lka('http://'.$_SERVER['HTTP_HOST'].$lnk,$voc['adios_mail']).br().br();
$sent=mails::send_html($p,$voc['unregister'],$tx,'',$go);
	if($sent!='not_sent')$ret.=$voc['uns_mail'].': '.$p.' :: '.$voc['adios_mail'].br();
	else $ret.='mail not sent';}
else $ret.=$voc['answer_not_exists'];
return divc('txtalert',$ret).' ';}

function mailist_uns($o){$voc=sesmk('mailvoc');
if($o)return mailist_unsb($a,$b,$o);
$ret=btn('txtcadr',$voc['unregister']).' ';
$ret.=input1('unmail',$voc['form_mail'],'14','',1).' ';
$ret.=lj('txtbox','cbk_mailist___mailist*unsb_1_2_unmail','ok').' ';
return $ret;}

function mailist_read(){req('mod,art,spe,pop');
return build_modules('newsletter','');}

function plug_mailist($p,$o){//$id=randid('cbk');
if($p=='')$ret=mailist_form($o);
if($p=='uns')$ret=mailist_uns($o);
if($p=='read')$ret=mailist_read();
$ret.=br().br(); $voc=sesmk('mailvoc');
if($p=='unsubscribe')$ret=mailist_unsc($o);
if($p=='confirm')$ret.=mailist_confirm($voc,$o);
if($p)$ret.=lj('txtx','cbk_plugin__3_maillist',$voc['register']).' ';
if($p!='uns')$ret.=lj('txtx','cbk_plugin__3_maillist_uns',$voc['unregister']).' ';
if($p!='read')$ret.=lj('txtx','cbk_plugin__3_maillist_read',$voc['see_newsletter']).' ';
//if($_SESSION['auth']>5)$ret.=mailist_upgrade(1);
if($_SESSION['auth']>5)$ret.=msqbt('users',$_SESSION['qb'].'_mails').' ';
return divd('cbk',$ret);}

?>