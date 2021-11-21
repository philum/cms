<?php
//philum_plugin_channel

function output_arts_from_cache($http,$otp){
$npg=$_SESSION['prmb'][6]; $page=$_SESSION['page'];
$min=($page-1)*$npg; $max=$page*$npg;
	if(is_array($otp)){foreach($otp as $id=>$nb){if(is_numeric($id)){$i++; 
	if($i>=$min && $i<$max){$mg=$http.'/imgc/'.art_img($nb[3],$rb[1]);
		if(is_link($mg))$ret.=btn('imgl',image($mg,'',50));
		$ret.=balb('h2',lka($http.'/'.$id,$nb[2]));
		$ret.=btn('txtx',$nb[1]).' ';
		if(rstr(27))$ret.=btn('txtsmall',mkday($nb[0],1)).' '.pub_link($nb[9]).' ';
		if(rstr(25))$ret.=btn('txtsmall',art_length($nb[8]));
		$ret.=br().br();}}}}
$n_pages=nb_page($i,$npg,$page);
return $n_pages.$ret.$n_pages;}

function channel_tri($r,$d,$n){
foreach($r as $k=>$v){
	if(strpos($d,$v[$n])!==false or $k==$d)$ret[$k]=$v;}
return $ret;}

function channel($p,$t,$d=''){$ra=explode(' ',$p); $ret='';
foreach($ra as $ka=>$va){list($kab,$vab)=explode(':',$va);$sc[$vab]=$kab;}
if($sc['site']){reqp('microxml');
$site='http://'.$sc['site']; $t=lka($site,$sc['site'].'/'.$sc['hub']);
$load=mx_call($sc['site'].'/msql/users/'.$sc['hub'].'_cache');}
else $load=msql_read('users',$sc['hub'].'_cache','',1);
if($load){
	if($sc['cat'])$load=channel_tri($load,$sc['cat'],1);
	if($sc['parent'])$load=channel_tri($load,$sc['art'],10);
	if($sc['art'])$load=channel_tri($load,$sc['art'],'');
	if($sc['tag'])$load=channel_tri($load,$sc['tag'],5);
	if($sc['last'])$load=array_slice($load,0,$sc['last'],true);
	$t=build_titl($load,(!$t?$sc['hub']:$t),1,$sc['hub']);
	if($d=='articles'){
		if($site)$ret.=output_arts_from_cache($site,$load);
		else $ret.=output_arts($load,2,'');}
	elseif($load){
		foreach($load as $k=>$v)$re[]=llk('',$site.'/'.$k,html_entity_decode($v[2]));
		$ret=implode('',$re);
		$ret=balc('ul','panel pubart',$ret);}}
return $t.$ret;}

function plug_channel($p,$t,$d='articles'){req('mod,art,spe');
$_GET['call']='';//microxml
$p='philum.fr:site newworld:hub'; $o=1; $ret='';
if($o){$n=$o*1000; $j='SaveJ("chan_channel___'.$p.'_'.$t.'_'.$d.'");';
	$ret=js_code(temporize('channeltimer',$j,$n));}
	$ret.=divd('chan',channel($p,$t,$d));
return $ret;}

?>