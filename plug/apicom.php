<?php
//philum_plugin_apicom

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

function apicom_ex(){
$r['hub']=ses('qb');//else default: current hub
$r['cat']='word1|word2';//multi; else not hidden cats
$r['nocat']='word1|word2';//multi
//$r['catid']='idcat1|idcat2';
$r['nochilds']='0';
$r['priority']='1|2|3|4';//multi
//$r['notpublished']=1;//auth(6) or auth(4)+user=author
$r['owner']='user';//published by user
if(auth(4))$r['minday']='14';//nb of days//dig
if(auth(4))$r['maxday']='7';//nb of days
$r['from']=date('Y-m-d',ses('dayb'));//nb of days//dig
$r['until']=date('Y-m-d',ses('daya'));//nb of days
$r['date']='[Y]-[m]-[d]';//
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
$ut=explode(' ',prmb(18).' utag'); foreach($ut as $v)if($v)$r[$v]='word1|word2';
$r['folder']='word';
$r['related']='id';
$r['relatedby']='id';
$r['poll']='fav|like|poll|mood|[user polls]';
$r['cluster']='cluster of tags';
$r['search']='word1|word2';
$r['fullsearch']='word1|word2';
$r['title']='word';//search on title
$r['lang']='fr|en|es';
$r['order']='id-desc|mostread';//order by, using defaut prmb(9)
//builders
$r['cmd']='panel/track';
$r['preview']='1/2/3/auto';
$r['media']='video/mp3/pdf/twitter';
$r['search_whole']='1';
$r['random']=1;
$r['page']=1;
$r['nbyp']='20';
$r['ti']='cat/tag/folder';//title with url $r['cat']
$r['nodig']=1;//no time system
$r['noheader']=1;
$r['nopages']=1;//no pages
$r['json']=1;
$r['file']=1;
//$r['cols']=3;//columns
if(auth(4))$r['t']=nms(69);//title if no url title
if(auth(4))$r['template']='read';
$r['file']='filename';
if(auth(4))$r['verbose']='1';
if(auth(6))$r['seesql']='1';
//$r['nbarts']='23';//used by API
return $r;}

function apicom_search($p,$id){
$r['search']='word';
$r['cat']='word1|word2';//multi;
$r['nocat']='word1|word2';//multi
$r['tag']='word1|word2';
$ut=explode(' ',prmb(18).' utag'); foreach($ut as $v)if($v)$r[$v]='word1|word2';
$r['folder']='word';
$r['lang']='fr|en|es';
$r['date']='[Y]-[m]-[d]';
//$r['title']='word';//search on title
//$r['json']=1;
//$r['file']=1;
$r['priority']='1|2|3|4';//multi
//$r['owner']='user';//published by user
return apicom_form($r,$p,$id);}

function apicom_build($p,$o,$res=''){
req('pop,art,spe,mod');
list($p,$o)=ajxp($res,$p,$o);
$ret=api::call($p,$o);
return $ret;}

function apicom_cat(){return ses('line');}

function apicom_form($r,$p,$id){
$ra=explode_k($p,',',':'); $tgs=prmb(18).' utag'; $ret='';
foreach($r as $k=>$v){
	$o=atb('onclick',atjr('apijumptoarea',['inp'.$k,$id]));
	$o.=atb('onkeyup',atjr('apijumptoarea',['inp'.$k,$id]));
	$o.=atb('placeholder',$v);
	//if(isset($rb[$k]))$hlp=' ('.$rb[$k].')';
	if($k=='cat')$bt=togbub('hidden','inp'.$k.'_cat','category');
	elseif($k=='tag' or strpos($tgs,$k)!==false)$bt=togbub('hidden','inp'.$k.'_tag__'.ajx($k),$k);
	//select_j('inp'.$k,'tag',$k,$k,'','2');
	elseif($k=='folder')$bt=togbub('hidden','inp'.$k.'_vfld__'.ajx($k),$k);
	//select_j('inp'.$k,'vfld',$k,$k,'','2');
	else $bt=$k;
	$ret.=div('',input('inp'.$k,val($ra,$k),$o).' '.btn('small',$bt));}
return $ret;}

function apicom_menu($p,$o,$rid){if($o && $o!=1)$rid=$o; $ret='';
if(!$p)$p='hub:'.ses('qb').',minday:'.ses('nbj').',nbyp:'.prmb(6);
$rb=msql_read('lang','helps_api','',1);
$o=atb('onclick','apijumptoinputs()').atb('onkeyup','apijumptoinputs()');
$ret=bal('textarea',atd('inp').$o.atb('cols',64).atb('row',4),$p).' ';
$ret.=lj('',$rid.'_plug__3_apicom_apicom*build___inp',picto('ok')).' ';
$ret.=hlpbt('api').' ';
//$ret.=ljb('','apijumpall',implode_k($r,',',':'),picto('after')).br();
$ret.=divd('loadself','');
$r=apicom_ex();
$rt=apicom_form($r,$p,'inp');
$ret.=div(atc('cols').ats('width:620px;'),$rt);
return $ret;}

function plug_apicom($p,$o){$rid='plg'.randid();
//Head::add('jscode',apicom_js());
if($o)$bt=apicom_menu($p,$o,$rid).br();
else $bt=toggle('',$rid.'2_plug_apicom_apicom*menu_'.ajx($p).'_'.$rid,picto('menu'));
if($p)$ret=apicom_build($p,''); else $ret='';
return $bt.divd($rid.'2','').divd($rid,$ret);}

?>