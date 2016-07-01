<?php
//philum_plugin_apicom

function apicom_ex(){
$r['hub']=ses('qb');
$r['cat']='word1|word2';//multi; else not hidden cats
$r['nocat']='word1|word2';//multi
//$r['nochilds']='0';
$r['priority']='1|2|3|4';//multi
//$r['notpublished']=1;//auth(6) or auth(4)+user=author
//$r['owner']='user';//published by user
//$r['hub']='hub';//else default: current hub
if(auth(4))$r['minday']='14';//nb of days//dig
if(auth(4))$r['maxday']='7';//nb of days
$r['from']=date('Y-m-d',ses('dayb'));//nb of days//dig
$r['until']=date('Y-m-d',ses('daya'));//nb of days
//$r['mintime']='min timestamp';
//$r['maxtime']='max timestamp';
//$r['dig']='temporal field - days';
if(auth(4))$r['minid']='id';//id min, using >
if(auth(4))$r['maxid']='id';//id max, using <=
if(auth(4))$r['nbchars']='>400';//nb of signs of article
$r['source']='url';
$r['parent']='id';
$r['id']='id1|id2|id3';//list if ids
$r['tag']='word1|word2';
$ut=explode(' ',prmb(18)); $n=count($ut); for($i=0;$i<$n;$i++)$r[$ut[$i]]='word1|word2';
$r['search']='word';
$r['title']='word';//search on title
$r['lang']='eng';
$r['order']='id-desc';//order by, using defaut prmb(9)
//builders
$r['json']=1;
$r['preview']='1/2/3/auto';
$r['page']='1';
$r['nbyp']='20';
//$r['link']='cat';//title with url $r['cat']
$r['nodig']=1;//no time system
$r['nopages']=1;//no pages
//$r['cols']=3;//columns
if(auth(4))$r['t']=nms(69);//title if no url title
if(auth(4))$r['template']='read';
$r['file']='filename';
if(auth(4))$r['verbose']='1';
if(auth(6))$r['seesql']='1';
//$r['nbarts']='23';//used by API
return $r;}

function apicom_j($p,$o,$res=''){
req('api,pop,art,spe,tri,mod');
list($p,$o)=ajxp($res,$p,$o);
$ret=api_call($p,$o);
return $ret;}

function apicom_cat(){return ses('line');}

function apicom_menu($p,$o,$rid){if($o && $o!=1)$rid=$o;
if(!$p)$p='hub:'.ses('qb').',minday:'.ses('nbj').',nbyp:'.prmb(6);
$rb=msql_read('lang','helps_api','',1);
$r=apicom_ex();
foreach($r as $k=>$v){
	$o=atb('onclick','apijumptoarea(\'inp'.$k.'\')');
	$o.=atb('onkeyup','apijumptoarea(\'inp'.$k.'\')');
	$o.=atb('placeholder',$v);
	if($rb[$k])$hlp=' ('.$rb[$k].')';
	if($k=='cat')$hlp=select_j('inp'.$k,'pfunc','','apicom/apicom_cat','','2');
	if($k=='tag' or strpos(prmb(18),$k)!==false)$hlp=select_j('inp'.$k,'tag','',$k,'','2');
	$ret.=div('',inp('inp'.$k,'',$o).' '.btn('small',($k=='cat'?'category':$k).$hlp));}
$ret=divc('cols',$ret);
$o=atb('onclick','apijumptoinputs()').atb('onkeyup','apijumptoinputs()');
$ret.=ljb('','apijumpall',implode_k($r,',',':'),picto('right')).br();
$ret.=balb('textarea',atd('inp').$o.atb('cols',64).atb('row',4),$p).' ';
$ret.=lj('',$rid.'_plug__3_api_api*j___inp',picto('reload')).' ';
$ret.=hlpbt('api');
return $ret;}

function apicom_js(){return "
function apijumptoarea(d){var res=[]; var ok=0;
	var p=d.substr(3); var o=getbyid(d); var k=o.id; var v=o.value;
	var content=getbyid('inp');
	var r=(content.value).split(',');
	for(i=0;i<r.length;i++){var kv=r[i].split(':'); //if(r[i]=='undefined')r[i]='';
		if(kv[0]==p){if(v)res.push(p+':'+v); var ok=1;} else if(r[i])res.push(r[i]);}
	if(!ok && v)res.push(p+':'+v);
	var ret=res.join(','); if(ret!=undefined)content.value=ret;
}
function apijumptoinputs(){
	var content=getbyid('inp');
	var r=(content.value).split(',');
	for(i=0;i<r.length;i++){var kv=r[i].split(':');
		var ob=getbyid('inp'+kv[0]);
		if(ob!=undefined && kv[1]!=undefined)ob.value=kv[1];}
}
function apijumpall(arr){
	if(arr)var r=arr.split(','); var res=[]; var content=getbyid('inp');
	if(r!=undefined)for(i=0;i<r.length;i++)if(r[i]){
		var v=r[i].split(':')[0];
		var ob=getbyid('inp'+v);
		if(ob!=undefined && ob.value)res.push(v+':'+ob.value);}
	var ret=res.join(','); if(ret)content.value=ret;
}
";}

function plug_apicom($p,$o){$rid='plg'.randid();
Head::add('jscode',apicom_js());
if($o)$bt=apicom_menu($p,$o,$rid).br();
else $bt=lj('','popup_plup___apicom_apicom*menu_'.ajx($p).'_'.$rid,picto('menu'));
if($p)$ret=apicom_j($p,'');
return $bt.divd($rid,$ret);}

if($_GET['query']){//ini_set('display_errors','1'); error_reporting(E_ALL);
session_start(); require('../prog/lib.php'); require('../params/_connectx.php');
echo apicom_j($_GET['query'].',json:1','');}

?>