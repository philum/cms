<?php
//philum_plugin_suggest

//function plink($f){return lkt('popbt',$f,preplink($f));}

function sugg_mail($from,$f){
$dest=$_SESSION['qbin']['adminmail'];
$suj='philum - suggest_article'; $msg=$from.' suggest: '.$f;
mails::send_html($dest,$suj,$msg,$from,'');}

function sugg_import($f,$o='',$res=''){list($f,$o)=ajxp($res,$f,$o);
if(substr($f,0,4)!='http')return; req('pop'); $_GET['urlsrc']=$f;
list($suj,$msg)=conv::vacuum($f,'');
if(!$suj && !$msg){list($suj,$msg,$img)=web::getmetas($f); $msg=$img.' '.$msg;}
$msg=conn::read($msg,'','test');
return balb('h1',clean_title($suj)).divc('panel justy',$msg);}

function sugg_recall(){$nod=nod('suggest'); $ret='';
$r=msql_read('',$nod,''); $js='popup_vacuum__3_';
if($r)foreach($r as $k=>$v){$j=ajx($v[2]); $lnk=lka($v[2],picto('url'));
if(!$v[1])$ret.=br().lj('popbt',$js.$j.'_'.$k,$v[0].' '.preplink($v[2])).' '.$lnk;}
return $ret;}

function sugg_rapport($m){
$r=msql::read_b('',nod('suggest'),'');
if($r)foreach($r as $k=>$v){$id='';
	if($v[3])$id=sql('id','qda','v','mail="'.$v[3].'"'); 
	if($id)$art=lj('popw','popup_popart__3_'.$id.'_3',nms(89));
	$pub=$v[1]?$art:btn('popbt',nms(56)); 
	if($v[3]==$m)$ra[]=array($v[0],lka('popbt',$v[2]),$pub);}
return btn('txtcadr','rapport').br().divtable($ra);}

/*function sugg_pad($p,$o,$res=''){$p=ajxg($res);
$d=sugg_import($p);
$ret.=divedit('sugpad','tab justy scroll','',$j,$d);
$ret.=lj('popsav','sugg_plug__3_suggest_sugg*j___sugurl|sugnam|sugpad',nms(126)).' ';
return $ret;}*/

function sugg_alx($r,$d){$md5=md5($d);
if($r)foreach($r as $k=>$v){if(md5($v[5])==$md5)return true;}}

function sugg_j($v1,$v2,$res){req('spe');
$nod=nod('suggest'); $ra=ajxr($res);
$dfb['_menus_']=['day','ok','url','mail','tit','msg','iq'];
$r=msql::read_b('',$nod,'','',$dfb);
$alx=sugg_alx($r,$ra[2]); $rap='popup_plup___suggest_sugg*rapport_'.ajx($ra[1]);
if($ra[1] && $alx)return lj('txtyl',$rap,nms(56));
$r[]=[date('ymdHi'),'',$ra[3],$ra[0],$ra[1],$ra[2],ses('iq')]; if(isset($r[0]))$r=msql::reorder($r);
if((!$ra[1] or !$ra[2]) or !$ra[3])return btn('txtyl','niet');
elseif(!$alx){msql::save('',$nod,$r); if($ra[0])sugg_mail($ra[0],$ra[1]);
	return btn('txtred',helps('userforms'));
	return lj('txtred','popup_vacuum__3_'.ajx($lnk),nms(56));}
else return lj('txtyl',$rap,nms(37));}

function sugg_web(){
$ret=input1('sugurl','url',30,'',1).' ';
$ret.=lj('popsav','sugtxt_plug__3_suggest_sugg*import___sugurl',nms(132)).' ';
return $ret;}

function sugg_edit(){
$ret=input1('sugmail','e-mail',20,'',1);
$ret.=sugg_web();
//$ret.=togbub('plug','suggest_sugg*web','importer du web','popbt').' ';
$ret.=hlpbt('suggest').br();
$ret.=input1('sugtit',nms(71),50,'editor',1);
$ret.=lj('popsav','sugg_plug___suggest_sugg*j___sugmail|sugtit|sugtxt|sugurl',nms(126));
$ret.=divedit('sugtxt','editarea justy','','','');
return $ret;}

function sugg_form(){
$ret=input1('sugurl','url','26','',1).' ';
$ret.=input1('sugmail','mail','14','',1).' '.hlpbt('suggest').' ';//nms(38)
$ret.=lj('popbt','sugg_plug__3_suggest_sugg*import___sugurl',nms(65)).' ';
$ret.=lj('popsav','sugg_plug__3_suggest_sugg*j___sugmail|||sugurl',nms(126)).' ';
return $ret;}

function plug_suggest($p){
//if(auth(6))else $ret=sugg_form();
$ret=sugg_edit();
if(auth(4))$bt=msqbt('',nod('suggest')); else $bt='';
return divd('sugg',$ret).sugg_recall().$bt;}//sugg_pad($p,$o).//

?>