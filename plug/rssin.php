<?php
//philum_plugin_rss_input 

function template_rss(){
return '[[_URL§_SUJ:url]§h2:html]
[[_OPT§txtsmall2:css]§[float:right:style]:div]
[_DATE§txtsmall:css] 
[_ARTEDIT§[reponse_ID:id]:div]
	[[_THUMB_MSG§[panel justy:class]:div]
	§[art_ID:id][_STY:class]:div]';}

function pane_base($url,$suj,$frm,$day,$img,$msg,$alx){
static $id; $id++;
//$msg=ereg_replace('width='."^[_a-zA-Z0-9.]+$","",$msg);//([[:digit:]]*)
$ara=array("<![CDATA[","]]>");
$suj=str_replace($ara," ",$suj);
$url=str_replace($ara," ",$url);
$msg=str_replace($ara," ",$msg);
if($img!="")$gmi='<img src="'.$img.'" class="imgl" border="0" height="72">';
$id_art=recognize_article($url,clean_title($suj),$alx);//already_exists
if($id_art)$opt.=popart($id_art);
elseif($_SESSION["USE"]==$_SESSION["qb"] or $_SESSION["auth"]>3){$purl=ajx($url,'');
	$opt.=ljb('txtx','SaveJ','popup_addArt___'.$purl.'_1',"save").' ';
	//$opt.=ljb('txtbox','SaveIf',$purl,'save').' ';
	$opt.=btd('btc'.$id,lj('txtx','btc'.$id.'_batch__xd_'.$purl.'_p','+')).' ';
	$opt.=ljb('txtx','Close','art'.$id,'x');}
$panout=array('sty'=>'tab','id'=>$id,'suj'=>$suj,'date'=>$day,'tag'=>" ",'opt'=>$opt,'thumb'=>$gmi,'msg'=>$msg,'url'=>$url);
$ret=template_build(template_rss(),$panout);
return divd('article',$ret);}

function plug_rssin($u){req('pop,art,tri,spe');
Head::add('jslink','/prog/utils.js');
if($_GET['rssurl'])foreach($_GET as $k=>$v){if($k=="rssurl")$u=$v; else $u.='&'.$k.'='.$v;}
$u=str_replace('http://','',$u);
if($u){$alx=alx(); $rss=load_xml('http://'.$u,1);
	$ret.=bal('h1',lkt('','http://'.$u,preplink($u)));
	$ret.=lkt("",'/?plug=rssin&rssurl='.$u,picto('url'));
	foreach($rss as $k=>$v)
		if($v[1])$ret.=pane_base($v[1],$v[0],"",rss_date($v[2]),"",$v[3],$alx);}
return $ret;}
?> 