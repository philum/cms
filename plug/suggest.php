<?php
//philum_plugin_suggest

function plink($f){return lkt('popbt',$f,preplink($f));}

function sugg_mail($from,$f){
$dest=$_SESSION['qbin']['adminmail'];
$suj='philum - suggest_article'; $msg=$from.' suggest: '.$f;
send_mail_html($dest,$suj,$msg,$from,'');}

function sugg_import($f,$o='',$res=''){list($f,$o)=ajxp($res,$f,$o);
if(substr($f,0,4)!='http')return; req('tri,pop'); $_GET['urlsrc']=$f;
list($suj,$msg)=vacuum($f,''); $msg=format_txt($msg,'','');
$ret=balc('h2','',clean_title($suj)).br().$msg;
return $ret;}

function sugg_recall(){$nod=nod('suggest');
$r=msql_read('',$nod,''); $js='popup_call__3_ajxf_batch*preview_';
if($r)foreach($r as $k=>$v){$j=ajx($v[2]); $lnk=lka($v[2],picto('url'));
if(!$v[1])$ret.=br().lj('popbt',$js.$j.'_'.$k,$v[0].' '.preplink($v[2])).' '.$lnk;}
return $ret;}

function sugg_rapport($m){
$r=read_vars('msql/users/',nod('suggest'),'');
if($r)foreach($r as $k=>$v){$id='';
	if($v[3])$id=sql('id','qda','v','mail="'.$v[3].'"'); 
	if($id)$art=lj('popw','popup_popart__3_'.$id.'_3',nms(89));
	$pub=$v[1]?$art:btn('popbt',nms(56)); 
	if($v[3]==$m)$ra[]=array($v[0],plink($v[2]),$pub);}
return btn('txtcadr','rapport').br().make_divtable($ra);}

function sugg_pad($p,$o,$res=''){$p=ajxg($res);
$d=sugg_import($p);
$ret.=divedit('sugpad','tab justy scroll','',$j,$d);
$ret.=lj('popsav','sugg_plug__3_suggest_sugg*j___sugurl|sugnam|sugpad',nms(126)).' ';
return $ret;}

function sugg_alx($r,$u){
if($r)foreach($r as $k=>$v){if($v[2]==$u)return true;}}

function sugg_j($v1,$v2,$res){req('spe');
$nod=nod('suggest'); $ra=ajxr($res);
$dfb['_menus_']=array('day','ok','url','mail','msg','iq');
$r=read_vars('msql/users/',$nod,$dfb); $lnk=trim($ra[0]);
$alx=sugg_alx($r,$lnk); $rap='popup_plup___suggest_sugg*rapport_'.ajx($ra[1]);
if($lnk && $alx)return lj('txtyl',$rap,nms(56));
$ret=sugg_import($lnk);
$r[]=array(date('ymdHi'),'',$lnk,$ra[1],'',ses('iq')); if($r[0])$r=msq_reorder($r);
if($lnk && !$alx){msql_save('',$nod,$r); if($ra[1])sugg_mail($ra[1],$lnk);
	return lj('txtyl','popup_call__3__batch*preview_'.ajx($lnk),nms(56)).' '.$ret;}
else return lj('txtyl',$rap,'404 not found');}

function plug_suggest($p){
Head::add('csscode','.tab{font-size:large; border:1px dotted silver; background:white; padding:16px; width:100%; height:400px;}');
if(auth(4))$ms=' '.msqlink('',nod('suggest'));
$ret.=input(1,'sugnam" size="26','mail','',1).' '.hlpbt('suggest').$ms.' ';//nms(38)
$ret.=input(1,'sugurl" size="26','url','',1).' ';
//$ret.=lj('popsav','sugpad_plug__3_suggest_sugg*import___sugurl',nms(132)).' ';
$ret.=lj('popsav','sugg_plug__3_suggest_sugg*j___sugurl|sugnam',nms(126)).' ';
return $ret.divd('sugg','').sugg_recall();}//sugg_pad($p,$o).

?>