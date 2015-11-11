<?php
//philum_plugin_goog

function goog_rss_date($d){//Mon, 01 Aug 2011 09:34:34 GMT+00:00
list($mon,$day,$month,$year,$hour,$gmt)=explode(' ',$d);
$ret=strtotime($day.' '.$month.' '.$year);
return $ret;}

function goog_link($d){
return substr($d,strrpos($d,'http'));}

function goog_see($d){
$ret=read_file($d);
//if(mb_detect_encoding($ret,'UTF-8'))$ret=utf8_decode($ret);//or !strpos($ret,'Ã©')
return popup('',$ret);}

function goog_defs($url){
$current=str_replace(array('http://','www.'),'',$url);
$current=substr($current,0,strpos($current,'/'));
$basedefs=$_SESSION['rstr'][18]==0?'public':$_SESSION["qb"];
if($current)$r=msql_read('',$basedefs.'_defcons',$current); //p($r);
echo $basedefs.'_defcons:'.$current.' ';
if($r)return true;}

function plug_goog($var,$id){$d=urlencode($var);
$url='http://news.google.fr/news?q='.$d.'&ie=&output=rss';//UTF-8//
$rss=read_rss($url,"item",array("pubDate","link","title","description"));
foreach($rss as $k=>$v){
	$v[0]=goog_rss_date($v[0]);
	$v[1]=goog_link($v[1]);
	/*$v[3]=html_entity_decode($v[3]);
	$v[3]=converthtml($v[3]); $v[3]=del_tables($v[3]);
	$v[3]=format_txt_r($v[3],'','');*/
	$r[$v[0]]=array($v[1],utf8_decode($v[2]),$v[3]);//if($k)
	}
//$ret=txarea('',$f,60,20);
if($r)krsort($r);
foreach($r as $k=>$v){
	//$see=ljb('txtx','SaveJ','popup_plug___goog_goog*see_'.ajx($v[0],''),'see').' ';
	if($_SESSION['auth']>4){$sav='';
		//$sav=ljb('txtx','SaveJ','popup_batch__xx_'.ajx($v[0],''),'batch');
		//if(goog_defs($v[0]))
		$sav=ljb('txtx','SaveD','content_addArt_'.ajx($v[0],''),'import').' ';
		}
	if($v[0])$ret.=date('Y/m/d',$k).' '.$see.$sav.br().lkt('',$v[0],$v[1]?$v[1]:$v[0]).br().br();}//.$v[2].br()
//if(mb_detect_encoding($ret,'UTF-8'))$ret=utf8_decode($ret);//or !strpos($ret,'Ã©')
return $ret;}

?>