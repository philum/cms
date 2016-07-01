<?php
//philum_plugin_channel

function output_pages_from_cache($http,$otp){
$npg=$_SESSION['prmb'][6]; $page=$_SESSION['page'];
$min=($page-1)*$npg; $max=$page*$npg;
	if(is_array($otp)){foreach($otp as $id=>$nb){if(is_numeric($id)){$i++; 
	if($i>=$min && $i<$max){$mg=$http.'/imgc/'.first_img($nb[3]);
		if(is_link($mg))$ret.=btn('imgl',image($mg,'',50));
		$ret.=bal('h2',lka($http.'/'.$id,$nb[2]));
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

function channel($p,$t,$d=''){$ra=explode(' ',$p);
foreach($ra as $ka=>$va){list($kab,$vab)=split(':',$va);$sc[$vab]=$kab;}
if($sc['site']){require_once('plug/microxml.php');
$site='http://'.$sc['site']; $t=lka($site,$sc['site'].'/'.$sc['hub']);
$load=clkt($sc['site'].'/msql/users/'.$sc['hub'].'_cache');}
else $load=msql_read('users',$sc['hub'].'_cache','',1);
if($load){
	if($sc['cat'])$load=channel_tri($load,$sc['cat'],1);
	if($sc['parent'])$load=channel_tri($load,$sc['art'],10);
	if($sc['art'])$load=channel_tri($load,$sc['art'],'');
	if($sc['tag'])$load=channel_tri($load,$sc['tag'],5);
	if($sc['last'])$load=splice($load,$sc['last']);
	$t=build_titl($load,(!$t?$sc['hub']:$t),1,$sc['hub']);
	if($d=='articles'){
		if($site)$ret.=output_pages_from_cache($site,$load);
		else $ret.=output_pages($load,2,'');}
	elseif($load){
		foreach($load as $k=>$v)$re[]=llk('',$site.'/'.$k,html_entity_decode($v[2]));
		$ret=implode('',$re);
		$ret=balc('ul','panel pubart',$ret);}}
return $t.$ret;}

function plug_channel($p,$t,$d='articles'){req('mod,art,spe');
$_GET['call']='';//microxml
$p='philum.org:site newworld:hub';
if($o){$n=$o*1000; $j='SaveD("chan_channel_'.$p.'_'.$t.'_'.$d.'");';
	$ret=js_code(temporize('channeltimer',$j,$n));}
	$ret.=divd('chan',channel($p,$t,$d));
return $ret;}

?>