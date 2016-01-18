<?php
//philum_plugin_suggest

function sugg_mail($from,$f){
$dest=$_SESSION['qbin']['adminmail'];
$suj='philum - suggest_article'; $msg=$from.' suggest: '.$f;
send_mail_html($dest,$suj,$msg,$from,'');}

//if(is_link($f))echo 'is_link';
function suggest_import($f){if(substr($f,0,4)!='http')return; req('tri,pop');
if(is_link($f))$meta=get_meta_tags($f); $_GET['urlsrc']=$f;
list($defid,$r)=verif_defcon($f); $auv=auto_video($f);
if($auv){$ret=balc('h2','',$meta['title']).format_txt_r($auv,2,'');}
elseif(substr($meta['generator'],0,6)=='philum'){$ret=rss_art($f,1);}
elseif($defid && $r[0]){list($suj,$msg)=vacuum($f,''); $msg=format_txt($msg,'','');
	if(strlen($msg)>400)$msg=divd('scroll',$msg);
	$ret=balc('h2','',clean_title($suj)).br().divc('panel justy',$msg).br();}
elseif(is_link($f)){$reb=read_file($f);
	if($reb){$ret=balc('h2','',embed_detect($reb,'<title>','</title>',''));
	$ret.=divc('panel justy',$meta['description']);}
	else $ret=btn('txtred','no content detected');}
$ret.=plink($f);
return $ret;}

function sugg_recall(){
$nod=$_SESSION['qb'].'_suggest';
$r=msql_read('',$nod,''); $js='popup_call__3_ajxf_batch*preview_';
if($r)foreach($r as $k=>$v){$j=ajx($v[1]); $lnk=lka($v[1],picto('url'));
if(!$v[3])$ret.=br().lj('popbt',$js.$j.'_'.$k,$v[0].' '.preplink($v[1])).' '.$lnk;}
return $ret;}

function sugg_rapport($m){
$r=read_vars('msql/users/',ses('qb').'_suggest','');
if($r)foreach($r as $k=>$v){$id='';
	if($v[3])$id=sql('id','qda','v','mail="'.$v[1].'"'); 
	if($id)$art=lj('popw','popup_popart__3_'.$id.'_3',nms(89));
	$pub=$v[3]?$art:btn('popbt',nms(56)); 
	if($v[2]==$m)$ra[]=array($v[0],plink($v[1]),$pub);}
return btn('txtcadr','rapport').br().make_divtable($ra);}

function sugg_alx($r,$u){
if($r)foreach($r as $k=>$v){if($v[1]==$u)return true;}}

function suggest_j($v1,$v2,$res){req('spe');
$nod=ses('qb').'_suggest'; $ra=ajxr($res);
$dfb['_menus_']=array('day','url','mail','ok','iq');
$r=read_vars('msql/users/',$nod,$dfb); $lnk=trim($ra[0]);
$alx=sugg_alx($r,$lnk); $rap='popup_plup___suggest_sugg*rapport_'.ajx($ra[1]);
$view='popup_call__3__batch*preview_'.ajx($lnk);
if($alx)return lj('popdel',$rap,nms(56)); 
$r[]=array(date("ymdHi"),$lnk,$ra[1],'',ses(iq)); if($r[0])$r=msq_reorder($r);
$ret=suggest_import($lnk);
if($ret){msql_save('',$nod,$r);
	sugg_mail($ra[1],$lnk);
	return lj('txtyl',$view,nms(56)).' '.$ret;}
else return lj('txtyl',$rap,'404 not found');}

function plug_suggest($t){if($t)$ret.=btn('txtcadr',$t).br();
$r=msq_where('',ses('qb').'_suggest',4,ses(iq),1);
$ret=btn('txtcadr',nms(126)).' ';
if(auth(4))$ret.=msqlink('',$_SESSION['qb'].'_suggest').' ';
$ret.=hlpbt('suggest').br();
$ret.=input(1,'sugurl" size="26','url','',1).br();
$ret.=input(1,'sugnam" size="26','mail','',1).br();//nms(38)
$ret.=lj('popsav','sug_plug__3_suggest_suggest*j_1_2_sugurl|sugnam',nms(28)).' ';
$rec=sugg_recall();
return $ret.divd('sug','').$rec.br();}

?>