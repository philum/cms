<?php
//philum_plugin_hadopi

function make_table_b($r){
if($r){foreach($r as $k=>$v){$td="";
	if($v)foreach($v as $ka=>$va){$td.=balc("td",'',$va);}
$tr.=balc("tr",'',$td);}}
return balc("table",'',$tr);}

function clean_date($date){//'AAAA-MM-JJTHH:MM:SS+00:00' or 'AAAA-MM-JJTHH:MM:SSZ'
if(ereg("^[0-9]",$date) and ereg("(([[:digit:]]|-)*)T(([[:digit:]]|:)*)[^[:digit:]].*",$date,$temp)){$date=$temp[1].' '.$temp[3];}
$date=strtotime($date);//date('d/m/Y h:i',)
return $date;}

function read_rss_b($f,$t,$r){$data=read_file($f);
$tmp=preg_split("/<\/?".$t.">/",$data);
foreach($r as $v){
	$tmp2=preg_split("/<\/?".$v.">/",$tmp[0]);
	$ret[0][]=@$tmp2[1];}
for($i=1;$i<sizeof($tmp);$i+=2){
	if($r){foreach($r as $k=>$v){
		$tmp2=preg_split("/<\/?".$v.">/",$tmp[$i]);
		if($tmp2)$ret[$i][$r[$k]]=@$tmp2[1];}}}
return $ret;}

function xml2array($keys){
$url="http://www.hadopi-data.fr/export.xml";
$rss=read_rss_b($url,"temoignage",$keys); 
array_shift($rss);//del_first
foreach($rss as $k=>$v){//good_dates
	foreach($v as $ka=>$va){
		if(substr($ka,0,4)=='date')$va=clean_date($va);
		$ret[$k][$ka]=$va;}}
return $ret;}

function draw_bar($n){
for($i=0;$i<$n;$i++){$ret.='|';}
return $ret;}

function asci_graph($r){
$width=40; $max=max($r); $ratio=$width/$max; $sum=array_sum($r);
$ret[]=array('valeur','nombre','pourcentage','graph');
foreach($r as $k=>$v){$ret[]=array($k,$v,round($v/$sum*100,2).'%',draw_bar($v*$ratio));}
//$ret[]=array('total',$sum,'','');
return $ret;}

function stats($keys,$r){
if($r)foreach($r as $k=>$v){$tot++;
	foreach($v as $ka=>$va){
	if($ka=='fai')$ra[$ka][$va]+=1;
	if($ka=='film')$ra[$ka][$va==1?'oui':'non']+=1;
	if($ka=='musique')$ra[$ka][$va==1?'oui':'non']+=1;
	if($ka=='jeuxvideo')$ra[$ka][$va==1?'oui':'non']+=1;
	if($ka=='codepostal')$ra[$ka][substr($va,0,2)]+=1;
	if($ka=='type_courrier')$ra[$ka][$va]+=1;
	if($ka=='date_courrier')$ra[$ka][strftime("%G %B %d",$va)]+=1;
	if($ka=='date_collecteIP')$ra[$ka][strftime("%G %B %d",$va)]+=1;}}
//p($ra);
$ret.=balc('h2','','Total').$tot.br().br(); 
foreach($ra as $k=>$v){
	$ret.=balc('h2','',$k); 
	if(substr($k,0,4)=='date')krsort($v); else arsort($v);
	$ret.=make_table_b(asci_graph($v)).br();}
return $ret;}

function plug_hadopi(){
/*if(!$_SESSION['xmlarray'])$_SESSION['xmlarray']=xml2array();
$rss=$_SESSION['xmlarray'];*/
$keys=array('date_courrier','type_courrier','fai','date_collecteIP','musique','film','jeuxvideo','codepostal');
$r=xml2array($keys); //p($rss);
$ret.=stats($keys,$r);
//array_unshift($r,$keys);//add_table_index $ret=make_table_b($r);
return $ret;}

function hadopi(){return plug_hadopi();}

?>